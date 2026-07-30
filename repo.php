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
                            <!-- Upload Form -->
                            <form method="POST" enctype="multipart/form-data">
                                <h4>Upload Image</h4>
                                <input type="file" name="image" id="image" accept="image/gif,image/jpeg,image/png">
                                <br><br>
                                <input type="submit" name="sub_btn" id="submit" class="btn btn-primary btn-sm" value="Upload Image File">
                            </form>

                            <hr>

                            <!-- Scan Form -->
                            <form method="POST" enctype="multipart/form-data">
                                <h4>Color Scan Options</h4>
                                
                                <label>R</label>
                                <input type="checkbox" id="red" name="rgba[]" value="r">
                                
                                <label>G</label>
                                <input type="checkbox" id="green" name="rgba[]" value="g">
                                
                                <label>B</label>
                                <input type="checkbox" id="blue" name="rgba[]" value="b">
                                
                                <label>A</label>
                                <input type="checkbox" id="alpha" name="rgba[]">
                                
                                <br><br>
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
                                } elseif ($_FILES['image']['size'] > 5000000) {
                                    echo "File too large. Maximum 5MB.";
                                } else {
                                    $allowed_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
                                    $detected_type = exif_imagetype($_FILES['image']['tmp_name']);
                                    
                                    if (!in_array($detected_type, $allowed_types)) {
                                        echo "Invalid file type. Only GIF, JPEG, and PNG allowed.";
                                    } else {
                                        Upload($image, $folder);
                                        Display($image, $folder);
                                    }
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
