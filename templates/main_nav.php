<link rel="stylesheet" href="css/materialize.min.css">
</head>

<body class="purple darken-3 white-text">
    <main>
        <nav class="white  z-depth-0">
            <div class="container">
                <a href="index.php" class="brand-logo brand-text">ETTI</a>
                <ul id="nav-mobile" class="right hide-on-small-and-down">
                    <li class="white-text">
                    <li class="purple-text">
                        <?php 
                        // Initialize the session
                        session_start();
                        ?>

                        <?php
                         // Check if the user is logged in, otherwise redirect to login page 
                         if(!empty($_SESSION) && (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]===true)): 
                            echo 'Hi, ' .
                            $_SESSION["username"]; ?>
                            <?php 
                            if($_SESSION['id_type_user']== 3): ?>
                                <li><a href="users.php" class="btn brand z-depth-0">Users</a></li>
                                <li><a href="ajouter_module.php" class="btn brand z-depth-0">+Modules</a></li>
                                <?php endif; ?>
                        </li>
                        <li><a href="profile.php" class="btn brand z-depth-0">Profile</a></li>
                        <li><a href="auth/logout.php" class="btn brand z-depth-0">logout</a></li>
                        <?php else: ?>
                        <li><a href="auth/register.php" class="btn brand z-depth-0">register</a></li>
                        <li><a href="auth/login.php" class="btn brand z-depth-0">login</a></li>
                        <?php endif; ?>
                        </li>



                </ul>
            </div>
        </nav>