<?php
require_once('config/db_connect.php');
include("templates/header.php");
include("templates/main_nav.php");


    $id = mysqli_real_escape_string($conn, $_GET['id']);


    // enregistrer la requete dans une variable
    $sql = "SELECT * FROM modules WHERE id = '$id'";

    // executer la requetes
    $result = mysqli_query($conn, $sql);

    // Transformer en un tableau associative
    $module = mysqli_fetch_assoc($result);

    // Liberer les resultats
    mysqli_free_result($result);

    // fermer la connexion
    mysqli_close($conn);

?>

<div class="container center">
    <h2>Details</h2>
    <?php if ($module): ?>
    <h4>
        <?php 
            echo htmlspecialchars($module['titre']);
        ?>
    </h4>
    <h6>Code: <?php echo htmlspecialchars($module['code']); ?></h6>
    <p> <?php echo htmlspecialchars($module['_description']); ?></p>
    
    <?php else: ?>
    <p>no data</p>
    <?php endif; ?>
</div>

<?php include("templates/footer.php") ?>