<?php
    include_once 'includes/register.inc.php';
    include_once 'includes/functions.php';
    include_once 'includes/header.php';
?>

<!DOCTYPE html>
<html>
    <body>
        <!-- Registration form -->
        <?php
            if (!empty($error_msg)) {
                echo $error_msg;
            }
        ?>
        <div class="container">
            <div class="container">
                <h1>Register</h1>
                <div class="well">
                    <form class="form-horizontal" form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="POST" name="registration form">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="username">Username:</label>
                            <div class="col-sm-9">
                                <input type='text' class="form-control" id='username' name='username' placeholder='Enter username' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Email:</label>
                            <div class="col-sm-9">
                                <input type='text' class="form-control" id='email' name='email' placeholder='Enter email' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="password">Password:</label>
                            <div class="col-sm-9">
                                <input type='password' class="form-control" id='password' name='password' placeholder='Enter password' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="confirm">Confirm Password:</label>
                            <div class="col-sm-9">
                                <input type='password' class="form-control" name='confirmpwd' id='confirmpwd' placeholder='Confirm Password' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informational sections -->
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
                        <h5>There will always be more to do and never enough time to do it all. Currently, developers, texture artists, and application developers spend hours searching for and organizing reusable works in order to work with pictures, textures, and other images. The picture scanner software tool alleviates such burdens by creating and assembling a library of disparate color data from various projects and libraries; letting you focus on working toward release date bliss and avoid cumbersome search and organization hassle.</h5>
                    </div>
                    <div class="col-sm-4">
                        <h3>Spend less time on it:</h3>
                        <h5>Currently, there is not a tool on the market that works in a cheap, easy to use, and fast way. Picture Scanner utilizes color profiles to assist users in photo recognition and retrieval. This makes Picture Scanner useful to a wide range of industries. In addition, the picture scanner software works on multiple platforms and environments so you can continue developing regardless of platform or device. This software will increase productivity and free up countless cumulative hours of work that could be better spent on other aspects of the project.</h5>
                    </div>
                    <div class="col-sm-4">
                        <h3>Make all the awesome things:</h3>
                        <h5> This software is unlike anything else in the current market. Anybody who needs a faster way to match colors, textures, or pictures will find the software very useful. Whether they need a simple way to match colors in their house or they are developing a major art project which requires them to work with similar colors and textures; the picture scanner is the solution to their problems.</h5>
                    </div>
                </div>
                <div class="container">
                    <button type="button" class="btn btn-success btn-block" onclick="parent.location='register.php'">Register an Account</button>
                </div>
            </div>
        </div>
    </body>
</html>