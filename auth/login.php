<?php
// Initialize the session
session_start();

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}
 
// Include config file
require_once('../config/db_connect.php');

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>


        
<?php include("../template/header.php"); ?>
<?php include("../template/auth_nav.php") ?>

<section class="container grey-text">
    <h2 class="center">Se connecter</h2>
    <p class="center red-text">
        <?php 
        if(!empty($login_err)){
            echo  $login_err;
        }        
        ?>
    </p>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="white" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
            <div class="red-text"> <?php echo $username_err; ?></div>
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>">
            <div class="red-text"> <?php echo $password_err; ?></div>
        </div>
        <div class="center">
            <input type="submit" value="Login" name="Submit" class="btn brand z-depth-0">
            <p>Vous n'avez pas de compte? <a href="register.php">Creer une compte</a>.</p>
        </div>
    </form>
</section>
<?php include("../template/footer.php"); ?>