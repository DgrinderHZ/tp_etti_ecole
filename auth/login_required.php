<?php

    session_start();

// Check if the user is logged in, if not then redirect him to login page
// Check if the user is logged in, otherwise redirect to login page
if(empty($_SESSION) || (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)){
    header("location: auth/login.php");
    exit;
}
?>