<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
    include_once 'includes/header.php';

	if (login_check($mysqli) == true) {
	    $logged = 'in';
	} else {
	    $logged = 'out';
	}
?>

<!DOCTYPE html>
<html>
    <body>
		<!-- Login Form -->
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="list-group-item list-group-item-warning">Error Logging In!</p>';
        }
        ?>
        <div class="container">
            <h2>Login</h2>
            <div class="well">
                <form class="form-horizontal" action="includes/process_login.php" method="POST" name="login_form">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">E-mail:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class ="control-label col-sm-3" for="password">
                        Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default" onclick="formhash(this.form, this.form.password);">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
				<div class="container">
	        <?php
	            if (login_check($mysqli) == true) {
	                echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';

	                echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
	            } else {
	                echo '<p>Currently logged ' . $logged . '.</p>';
	                echo "<p>If you don't have a login, please <button type='button' class='btn btn-success' onclick=location.href='register.php'>Register</button></p>";
	            }
	        ?>
				</div>
    </body>
</html>
