<?php
require_once('config/db_connect.php');

// la partie suppression d'un user
 if (isset($_POST['id_delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_delete']);

    // enregistrer la requete dans une variable
    $sql = "DELETE FROM modules WHERE id = '$id'";

    // executer la requetes
   if(mysqli_query($conn, $sql)){
    // fermer la connexion
    mysqli_close($conn);
    // c'est supprimé, il allez à users.php
    header('Location: modules.php');
   }else{
    echo "erreur";
   }
 }