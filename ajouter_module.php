<?php
require_once('config/db_connect.php');
 include("templates/header.php"); 
 include("templates/main_nav.php"); 
require_once('auth/login_required.php');


$errors = array("code"=>'', "titre"=>'', "description"=>'');
$code = '';
$titre = '';
$description = '';


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
    }
   
   

    if (!array_filter($errors)) {
        // ajouter l'etudiant à la base de donnée
        $password = md5($password);
        $sql = "INSERT INTO modules(code, titre, description)
                VALUES ('$code', '$titre', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // redirect
        header('Location: index.php');
    }
}
?>



<section class="container grey-text">
    <h2 class="center">Ajouter un module</h2>
    <form action="ajouter_module.php" class="white" method="POST">
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
        
        <div class="center">
            <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include("templates/footer.php"); ?>