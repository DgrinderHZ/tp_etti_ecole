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
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text"id="email" name="email">
        </div>
        <div>
            <label for="tel">N° tele</label>
            <input type="text" id="tel" name="tel">
        </div>
        <div class="center">
            <input type="submit" value="Modifier" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php // insertion des pages templates ?>
<?php require_once("templates/footer.php"); ?>
