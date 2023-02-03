<?php
// Include config file
require_once('../config/db_connect.php');

// recuperer les type d'utilistateur

// enregistrer la requete dans une variable
$sql = 'SELECT * FROM type_user';

// executer la requetes
$results = mysqli_query($conn, $sql);

// Transformer en un tableau associative
$type_users = mysqli_fetch_all($results, MYSQLI_ASSOC);
// Liberer les resultats
mysqli_free_result($results);




// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $un = trim($_POST["username"]);
        $sql = "SELECT id FROM user WHERE username = '$un'";
        
        
            /* store result */
            // executer la requetes
            $result = mysqli_query($conn, $sql);
            
            if(!empty(mysqli_fetch_assoc($result))){
                $username_err = "This username is already taken.";
            }else{
                $username = trim($_POST["username"]);
            }
        
   
}
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, id_type) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_username, $param_password , $id_type);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $id_type = $_POST["id_type_user"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../index.php");
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
 

<?php include("../templates/header.php"); ?>
<?php include("../templates/auth_nav.php") ?>

<section class="container grey-text">
    <h2 class="center">Creer compte</h2>
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
        <div>
            <label for="confirm_password">Repeter Mot de passe:</label>
            <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password; ?>">
            <div class="red-text"><?php echo $confirm_password_err; ?></div>
        </div>
        <div class="input-field">
            <lable>Choose your option</label>
            <?php foreach($type_users as $type): ?>
            <p>
            <label>
                <input name="id_type_user" type="radio" checked value="<?php echo $type['id'];?>"/>
                <span class="grey-text"><?php echo $type['titre'];?></span>
            </label>
            </p>
            <?php endforeach; ?>
        </div>
        <div class="center">
            <input type="submit" value="Submit" name="Submit" class="btn brand z-depth-0">
            <input type="reset" value="Reset" name="Reset" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include("../templates/footer.php"); ?>

                
