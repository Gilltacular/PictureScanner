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
                        <h2><?php echo htmlentities($_SESSION['username']); ?>, Welcome to the Image Repository</h2>
                        <br>

                        <!-- Upload Form with Image Preview -->
                        <div class="container">
                            <form method="POST" enctype="multipart/form-data">
                                <h4>Upload Image</h4>
                                <input type="file" name="image" id="image" accept="image/gif,image/jpeg,image/png">
                                <br><br>
                                <input type="submit" name="sub_btn" id="submit" class="btn btn-primary btn-sm" value="Upload Image File">
                            </form>

                            <?php
                                // Handle file upload
                                if(isset($_POST['sub_btn']))
                                {
                                    if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
                                    {
                                        echo "<p>No File Selected</p>";
                                    } elseif ($_FILES['image']['size'] > 5000000) {
                                        echo "<p>File too large. Maximum 5MB.</p>";
                                    } else {
                                        $allowed_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
                                        $detected_type = exif_imagetype($_FILES['image']['tmp_name']);
                                        
                                        if (!in_array($detected_type, $allowed_types)) {
                                            echo "<p>Invalid file type. Only GIF, JPEG, and PNG allowed.</p>";
                                        } else {
                                            $image = $_FILES['image']['name'];
                                            $folder = "uploads/";
                                            move_uploaded_file($_FILES['image']['tmp_name'], $folder . $image);

                                            if ($stmt = $mysqli->prepare("INSERT INTO photos(image_name, image_path) VALUES(?, ?)")) {
                                                $stmt->bind_param('ss', $image, $folder);
                                                $stmt->execute();

                                                if($stmt->affected_rows > 0){
                                                    echo "<p>Image uploaded successfully!</p>";
                                                    
                                                    // Display uploaded image inline
                                                    $safe_image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
                                                    echo "<div class='row' style='margin-top: 20px;'>";
                                                    echo "<div class='col-sm-12'>";
                                                    echo "<img src='{$folder}{$safe_image}' class='img-responsive thumbnail' style='max-width: 300px;' onclick=\"openModal(this.src)\">";
                                                    echo "</div></div>";

                                                    // JavaScript for modal
                                                    echo "<script>
                                                        function openModal(src) {
                                                            var modal = document.getElementById('myModal');
                                                            var modalImg = document.getElementById('img01');
                                                            modal.style.display = 'block';
                                                            modalImg.src = src;
                                                        }
                                                    </script>";
                                                } else{
                                                    echo "<p>Image not uploaded</p>";
                                                }
                                                $stmt->close();
                                            }
                                        }
                                    }
                                }
                            ?>

                            <hr>

                            <!-- Color Scan Form (Uses most recently uploaded image) -->
                            <form method="POST" action="scan.php">
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
                                <input type="submit" name="scan" id="scan" class="btn btn-primary btn-sm" value="Scan Latest Image">
                            </form>
                        </div>
                    </div>
                <!-- If not logged in display message instead of content -->
                <?php else : ?>
                    <div class='container'>
                        <div class='jumbotron'>
                            <p>You are not authorized to view this page. Please <a href="login.php">login</a> or <a href="register.php">register</a> an account to proceed.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="myModal" class="modal" style="display:none;">
            <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
            <img class="modal-content" id="img01">
        </div>
    </body>
</html>
