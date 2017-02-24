<?php
    include_once 'includes/register.inc.php';
    include_once 'includes/functions.php';

    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Picture Scanner Home</title>
        <link rel="stylesheet" href="styles/main.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- sha512 source -->
        <script type="text/JavaScript" src="js/sha512.js"></script>

        <!--  -->
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>

    <body>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Picture Scanner Home</title>
        <link rel="stylesheet" href="styles/main.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- sha512 source -->
        <script type="text/JavaScript" src="js/sha512.js"></script>

        <!--  -->
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>

    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if(login_check($mysqli) == false) : ?>
                        <a class="navbar-brand" href="index.php">Picture Scanner</a>
                    <?php else : ?>
                        <a class="navbar-brand" href="repo.php">Picture Scanner</a>
                    <?php endif; ?>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="inactive">
                            <a href="about.php">About</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- right side of nav bar items -->
                        <div class="span7 text-center">
                            <li>
                                <?php if(login_check($mysqli) == false) : ?>
                                    <button type="button" class="btn btn-default" onclick="parent.location='login.php'">Login</button>
                                    <button type="button" class="btn btn-success" onclick="parent.location='register.php'">Register</button>
                                <?php else : ?>
                                    <button type="button" class="btn btn-default" onclick="parent.location='includes/logout.php'">Logout</button>
                                <?php endif; ?>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
