<?php
    include_once "includes/db_connect.php";
    include_once "includes/functions.php";
    include_once 'includes/header.php';
?>

<!DOCTYPE html>
<html>
    <body>
        <div class="container">
            <div class="jumbotron">
                <?php if(login_check($mysqli) == true) : ?>
                    <!-- RGB Editor (Repo Page) -->
                    <div class="rgbColumn">
                        <!-- Header -->
                        <h2><?php echo htmlentities($_SESSION['username']); ?>, Welcome to the Image Repository<h2>
                        <br>

                        <!-- RGB Editor Aligned to Left Column -->
                        <div class="container">
                            <form method="POST" enctype="multipart/form-data">
                                <!-- Red -->
                                <input type="checkbox" id="red" name="rgba[]" value="r">
                                <label to="red" id="r">R</label>

                                <br>
                                <br>

                                <!-- Green -->
                                <input type="checkbox" id="green" name="rgba[]" value="g">
                                <label to="green" id="g">G</label>

                                <br>
                                <br>

                                <!-- Blue -->
                                <input type="checkbox" id="blue" name="rgba[]" value="b">
                                <label to="blue" id="b">B</label>

                                <br>
                                <br>

                                <!-- Alpha -->
                                <input type="checkbox" id="alpha" name="rgba[]">
                                <label to="alpha" id="a">A</label>

                                <br>
                                <br>

                                <!-- File Upload -->
                                <input type="file" name="image" id="image">
                                <br>
                                <input type="submit" name="sub_btn" id="submit" class="btn btn-primary btn-sm" value="Upload Image File">
                                <input type="submit" name="scan" id="scan" class="btn btn-primary btn-sm" value="Scan Image">
                            </form>
                        </div>
                    </div>
                    <!-- Image Aligned to Right Column -->
                    <div class="col-sm-10">
                        <?php
                            require "includes/scanner.php";

                            $scanner = new GetMostCommonColors();

                            // upload image
                            if(isset($_POST['sub_btn']))
                            {
                                if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
                                {
                                    echo "No File Selected";
                                }else
                                {
                                    Upload($image, $folder);
                                    Display($image, $folder);
                                }
                            }
                        ?>
                    </div>
                <!-- If not logged in display message instead of content -->
                <?php else : ?>
                    <div class='container'>
                        <div class='jumbotron'>
                            You are not authorized to view this page. Please <a href="login.php">login</a> or <a href="register.php">register</a> an account to proceed.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
