<?php
    include_once 'includes/functions.php';
    include_once 'includes/header.php';
?>

<!DOCTYPE html>
<html>
    <body>
        <?php
            if (login_check($mysqli) == true) {
                header("Location: repo.php");
            }
        ?>
        
        <!-- Landing Page -->
        <div class="container">
            <div class="jumbotron">
                <div class="page-header">
                    <h2>PICTURE SCANNER + IMAGE ORGANIZATION = NIRVANA</h2>
                </div>
                <p><h5>The picture scanner project enables you to do what you love while avoiding the things that would obstruct you from creating amazing things that change the world.</h5></p>
                
                <div class="page-header">
                    <h2>With the Picture Scanner You can . . .</h2>
                </div>
                
                <div class="container-fluid">
                    <div class="col-sm-4">
                        <h3>Get more done:</h3>
                        <h5>Developers, texture artists, and application developers spend hours searching for and organizing reusable works. The picture scanner software tool alleviates such burdens by creating and assembling a library of disparate color data from various projects and libraries; letting you focus on working toward release date bliss.</h5>
                    </div>
                    <div class="col-sm-4">
                        <h3>Spend less time on it:</h3>
                        <h5>Picture Scanner utilizes color profiles to assist users in photo recognition and retrieval. This makes Picture Scanner useful to a wide range of industries. The software works on multiple platforms and environments so you can continue developing regardless of platform or device.</h5>
                    </div>
                    <div class="col-sm-4">
                        <h3>Make all the awesome things:</h3>
                        <h5>Anybody who needs a faster way to match colors, textures, or pictures will find the software very useful. Whether they need a simple way to match colors in their house or they are developing a major art project which requires them to work with similar colors and textures; the picture scanner is the solution.</h5>
                    </div>
                </div>
                
                <div class="container">
                    <button type="button" class="btn btn-success btn-block" onclick="location.href='register.php'">Register an Account</button>
                    <br>
                    <button type="button" class="btn btn-primary btn-block" onclick="location.href='login.php'">Login</button>
                </div>
            </div>
        </div>
    </body>
</html>