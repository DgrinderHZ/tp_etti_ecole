<?php
require_once('config/db_connect.php');
include("templates/header.php");
include("templates/main_nav.php");


    $id = $_SESSION["id"];

    // enregistrer la requete dans une variable
    $sql = "SELECT * FROM users WHERE id = '$id'";

    // executer la requetes
    $result = mysqli_query($conn, $sql);

    // Transformer en un tableau associative
    $user = mysqli_fetch_assoc($result);

    // Liberer les resultats
    mysqli_free_result($result);

    // fermer la connexion
    mysqli_close($conn);
 

?>



<div class="container center">
    <h2>Details</h2>
    <?php if ($user): ?>
    <h4>
        <?php 
            echo htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['prenom']);
        ?>
    </h4>
    <p>Tel: <?php echo htmlspecialchars($user['tel']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <!-- UPDATE :  mise à jour -->
    <p><a href="modifier_profile.php">Modifier votre profile</a></p>
    <?php else: ?>
    <p>no data</p>
    <?php endif; ?>
</div>

<?php include("templates/footer.php") ?>