<?php
    include_once 'includes/register.inc.php';
    include_once 'includes/functions.php';
    include_once 'includes/header.php';

    if(login_check($mysqli) == true) {
        header("Location: repo.php");
    }
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
        </div>
    </body>
</html>