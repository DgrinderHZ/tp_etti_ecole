<?php // insertion des pages templates ?>
<?php require_once("templates/header.php"); ?>
<?php require_once("templates/main_nav.php");?>

<?php // PARTIE GESTION FORMULAIRE et BASE DE DONNEES

// connection à la base de donnees
require_once('config/db_connect.php');
$id ='';
// Recuperer les donnees de POST
 if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // enregistrer la requete dans une variable
    $sql = "SELECT * FROM modules WHERE id = '$id'";

    // executer la requetes
    $result = mysqli_query($conn, $sql);

    // Transformer en un tableau associative
    $module = mysqli_fetch_assoc($result);

    // Liberer les resultats
    mysqli_free_result($result);

    $code = $module['code'] ;
    $titre = $module['titre'];
    $description = $module['_description'];
 }else{
    $code =  '';
    $titre = '';
    $description = '';
 }

$errors = array("code"=>'', "titre"=>'', "description"=>'');

if(isset($_POST["submit"])){
   //var_dump($_POST);
    if(empty($_POST["code"])){
        $errors['code'] = "Le code ne doit pas etre vide!";
    }else{
        $code = $_POST["code"];
        if(!preg_match("/^[a-zA-Z-' ]*$/",$code)){
            $errors['code'] = "Veuillez utiliser des lettres et des espaces!";
        }
    }
    if(empty($_POST["titre"])){
        $errors['titre'] = "Le titre ne doit pas etre vide!";
    }else{
        $titre = $_POST["titre"];
        if(!preg_match("/^[a-zA-Z-' ]*$/",$titre)){
            $errors['code'] = "Veuillez utiliser des lettres et des espaces!";
        }
    }
    if(empty($_POST["description"])){
        $errors['description'] = "Le description ne doit pas etre vide!";
    }else{
        $description = $_POST['description'];
    }
   
   

    if (!array_filter($errors)) {

        $sql = "UPDATE modules 
                SET code='$code', titre='$titre', 
                    _description='$description'
                WHERE id='$id'";
        
        // Executer la requete
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }else{
            echo "error";
        }

        // redirection to la page du profile
         header('Location: modules.php');
    }
}

?>


<!-- SECTION FORMULAIRE -->
<section class="container grey-text">
    <h2 class="center">Ajouter un module</h2>
    <form action="update_module.php" class="white" method="POST">
        <div>
            <label for="code">Code:</label>
            <input type="text" name="code" id="code" value="<?php echo htmlspecialchars($code);?>">
            <div class="red-text"> <?php echo $errors['code']; ?></div>
        </div>
        <div>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($titre);?>">
            <div class="red-text"> <?php echo $errors['titre']; ?></div>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($description);?>">
            <div class="red-text"> <?php echo $errors['description']; ?></div>
        </div>
         <input hidden type="text" name="id" value="<?php echo htmlspecialchars($id); ?>">
        
        <div class="center">
            <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php // insertion des pages templates ?>
<?php require_once("templates/footer.php"); ?>
