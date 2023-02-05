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
}
?>

<!-- SECTION FORMULAIRE -->
<section class="container white-text">
    <h1 class="center">Modifier vos informations du profile</h1>
    <form action="modifier_profile.php" class="white" method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom">
            <div class="red-text"> <?php echo $errors['nom']; ?></div>
        </div>
        <div>
            <label for="prenom">prenom</label>
            <input type="text" id="prenom" name="prenom">
            <div class="red-text"> <?php echo $errors['prenom']; ?></div>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text"id="email" name="email">
            <div class="red-text"> <?php echo $errors['email']; ?></div>
        </div>
        <div>
            <label for="tel">N° tele</label>
            <input type="text" id="tel" name="tel">
            <div class="red-text"> <?php echo $errors['tel']; ?></div>
        </div>
        <div class="center">
            <input type="submit" value="Modifier" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php // insertion des pages templates ?>
<?php require_once("templates/footer.php"); ?>
