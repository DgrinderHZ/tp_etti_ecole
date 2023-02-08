<?php
require_once('config/db_connect.php');
include("templates/header.php"); 
include("templates/main_nav.php"); 


// enregistrer la requete dans une variable
$sql = 'SELECT * FROM modules';

// executer la requetes
$results = mysqli_query($conn, $sql);

// Transformer en un tableau associative
$modules = mysqli_fetch_all($results, MYSQLI_ASSOC);

// Liberer les resultats
mysqli_free_result($results);

// fermer la connexion
mysqli_close($conn);
?>



<section class="container purple-text white">
    <table class="highlight responsive-table">
    <thead class="purple white-text">
        <tr>
            <th>Id</th>
            <th>Code</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($modules as $module): ?>
        <tr>
            <td><a href="details_module.php?id=<?php echo htmlspecialchars($module['id']); ?>"><?php echo htmlspecialchars($module['id']); ?></a></td>
            <td><a href="details_module.php?id=<?php echo htmlspecialchars($module['id']); ?>"><?php echo htmlspecialchars($module['code']); ?></a></td>
            <td><?php echo htmlspecialchars($module['titre']); ?></td>
            <td><?php echo htmlspecialchars(substr($module['_description'], 0, 20)); ?></td>
            
            <td>
                <form action="delete_module.php" method="post" style="display: inline;">
                    <input hidden type="text" name="id_delete" value="<?php echo htmlspecialchars($module['id']); ?>">
                    <input type="submit" name="submit" value="Supprimer" class="btn brand z-depth-0">
                </form>
                <form action="update_module.php" method="post" style="display: inline;">
                    <input hidden type="text" name="id" value="<?php echo htmlspecialchars($module['id']); ?>">
                    <input type="submit" name="submit" value="Modifier" class="btn brand z-depth-0">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</section>    



<?php include("templates/footer.php"); ?>