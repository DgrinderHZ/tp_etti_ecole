<?php require_once("templates/header.php"); ?>
<?php require_once("templates/main_nav.php");?>

<section class="container white-text">
    <h1 class="center">Modifier votre informations du profile</h1>
    <form action="" class="white">
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom">
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
            <input type="submit" value="Modifier" class="btn brand z-depth-0">
        </div>
    </form>
</section>
    
<?php require_once("templates/footer.php"); ?>
