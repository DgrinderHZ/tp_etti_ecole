<?php
$servername = "localhost";
$username = "admin";
$password = "UM2x]uYoHC[AMf2b";
$dbname = "ecole_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>