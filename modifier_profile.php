<?php // insertion des pages templates ?>
<?php require_once("templates/header.php"); ?>
<?php require_once("templates/main_nav.php");?>

<?php // PARTIE GESTION FORMULAIRE et BASE DE DONNEES

// connection à la base de donnees
require_once('config/db_connect.php');

// Tableau des erreurs
$errors = array("nom"=>'', "prenom"=>'', "tel"=>'', "email"=>'');

// Variables d'aide
$nom = '';
$prenom = '';
$email = '';
$tel = '';

// Validation, Gestion d'erreur, et sauvegarde des données
if(isset($_POST["submit"])){
    //var_dump($_POST); // utile pour voir les information saisie

    // Validation de champ 'nom'
    if(empty($_POST["nom"])){
        $errors['nom'] = "Le nom ne doit pas etre vide!";
    }else{
        $nom = $_POST["nom"];
        $taille = strlen($nom);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$nom)){
            $errors['nom'] = "Veuillez utiliser des lettres et des espaces!";
        }elseif($taille < 2 || $taille > 25 ){
            $errors['nom'] = "Le nom doit etre de taille >= 2 et <= 25!";
        }
    }

    // Validation de champ 'prenom'
    if(empty($_POST["prenom"])){
        $errors['prenom'] = "Le prenom ne doit pas etre vide!";
    }else{
        $prenom = $_POST["prenom"];
        $taille = strlen($prenom);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$prenom)){
            $errors['prenom'] = "Veuillez utiliser des lettres et des espaces!";
        }elseif($taille < 2 || $taille > 25 ){
            $errors['prenom'] = "Le prenom doit etre de taille >= 2 et <= 25!";
        }
    }

    // Validation de champ 'email'
    if(empty($_POST["email"])){
        $errors['email'] = "Le email ne doit pas etre vide!";
    }else{
        $email = $_POST["email"];
        $taille = strlen($email);
        // verifier le format d'email est valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email n'est pas valide (exemple@mail.com)!";
        }elseif($taille < 10 || $taille > 60 ){
            $errors['email'] = "L'email doit etre de taille >= 10 et <= 60!";
        }
    }

     // Validation de champ 'tel'
    if(empty($_POST["tel"])){
        $errors['tel'] = "Le N° de telephone ne doit pas etre vide!";
    }else{
        $tel = $_POST["tel"];
        if(!preg_match("/^(\+\d{3}|0)(\d{9})$/", $tel)){
            $errors['tel'] = "le format du N° de telephone n'est pas valide!";
        }
    }

    if (!array_filter($errors)) {
        // array_filter($errors) retourne true s'il y a des erreurs
        // retourne false s'il n'y a pas des erreurs
        
        //SQL:  modifier les valeurs dans la base de donnée 
        $password = md5($password);
        $id = $_SESSION["id"];
        $sql = $sql = "UPDATE users 
                SET nom='$nom', prenom='$prenom', 
                    tel='$tel', email='$email'
                WHERE id='$id'";
    }
}
?>
<!--  
-- Qu'est-ce que la fonction htmlspecialchars() ?
La fonction htmlspecialchars() convertit les caractères
spéciaux en entités HTML. Cela signifie qu'il remplacera
les caractères HTML tels que < et > par < et >. 
Cela empêche les attaquants d'exploiter le code en injectant
du code HTML ou Javascript (attaques de type Cross-site Scripting XSS)
dans les formulaires.
 -->

<!-- SECTION FORMULAIRE -->
<section class="container white-text">
    <h1 class="center">Modifier vos informations du profile</h1>
    <form action="modifier_profile.php" class="white" method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom);?>">
            <div class="red-text"> <?php echo $errors['nom']; ?></div>
        </div>
        <div>
            <label for="prenom">prenom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom);?>">
            <div class="red-text"> <?php echo $errors['prenom']; ?></div>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text"id="email" name="email" value="<?php echo htmlspecialchars($email);?>">
            <div class="red-text"> <?php echo $errors['email']; ?></div>
        </div>
        <div>
            <label for="tel">N° tele</label>
            <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($tel);?>">
            <div class="red-text"> <?php echo $errors['tel']; ?></div>
        </div>
        <div class="center">
            <input type="submit" value="Modifier" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php // insertion des pages templates ?>
<?php require_once("templates/footer.php"); ?>
