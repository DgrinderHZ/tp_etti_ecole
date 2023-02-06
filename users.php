<?php
require_once('config/db_connect.php');


// enregistrer la requete dans une variable
$sql = 'SELECT * FROM users';

// executer la requetes
$results = mysqli_query($conn, $sql);

// Transformer en un tableau associative
$users = mysqli_fetch_all($results, MYSQLI_ASSOC);

// Liberer les resultats
mysqli_free_result($results);


 // la partie suppression d'un user
 if (isset($_POST['id_delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_delete']);

    // enregistrer la requete dans une variable
    $sql = "DELETE FROM users WHERE id = '$id'";

    // executer la requetes
   if(mysqli_query($conn, $sql)){
    // fermer la connexion
    mysqli_close($conn);
    // c'est supprimé, il allez à users.php
    header('Location: users.php');
   }else{
    echo "erreur";
   }
 }
    // fermer la connexion
    mysqli_close($conn);
?>

<?php include("templates/header.php"); ?>
<?php include("templates/main_nav.php"); ?>


<section class="container purple-text white">
    <table class="highlight responsive-table">
    <thead class="purple white-text">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Username</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Date d'inscription</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['nom']); ?></td>
            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['tel']); ?></td>
            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
            <td>
                <form action="users.php" method="post">
                    <input hidden type="text" name="id_delete" value="<?php echo htmlspecialchars($user['id']); ?>">
                    <input type="submit" name="submit" value="Supprimer" class="btn brand z-depth-0">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</section>    



<?php include("templates/footer.php"); ?>