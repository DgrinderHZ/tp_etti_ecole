<link rel="stylesheet" href="../css/materialize.min.css">
</head>
<body class="purple darken-3 white-text">
    <main>
<nav class="white z-depth-0">
        <div class="container">
            <a href="../index.php" class="brand-logo brand-text">ETTI</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li class="white-text">
                 
                <?php 
                // Check if the user is logged in, otherwise redirect to login page
                if(!empty($_SESSION) && (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)): 
                 echo 'Hi, '. $_SESSION["username"];
                ?>
                <li><a href="../ajouter.php" class="btn brand z-depth-0">Ajouter etudiant</a></li>
                <li><a href="logout.php" class="btn brand z-depth-0">logout</a></li>             
                <?php else: ?>
                    <li><a href="register.php" class="btn brand z-depth-0">register</a></li>
                    <li><a href="login.php" class="btn brand z-depth-0">login</a></li>
                <?php endif; ?>
            </li>
            
            
            
        </ul>
        </div>
    </nav>