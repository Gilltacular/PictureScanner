<?php
    include_once "includes/db_connect.php";
    include_once "includes/functions.php";
    sec_session_start();

    if (!login_check($mysqli)) {
        header("Location: login.php");
        exit();
    }

    // Get the most recent uploaded image
    if ($stmt = $mysqli->prepare("SELECT image_name FROM photos ORDER BY id DESC LIMIT 1")) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $image_name = $row['image_name'];
            $image_path = "uploads/" . $image_name;
            
            // Get scan options (note: rgba filtering not implemented in scanner)
            $rgba = isset($_POST['rgba']) ? $_POST['rgba'] : ['r', 'g', 'b'];
            $channel_filter = implode("", $rgba);
            
            require "includes/scanner.php";
            $scanner = new GetMostCommonColors();
            
            // Call the scanner with correct parameters: (image, count)
            $colors = $scanner->Get_Color($image_path, 20);
            
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Color Scan Results</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container">
                    <h1>Color Scan Results</h1>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" class="img-responsive thumbnail" style="max-width: 300px;"><br><br>
                    
                    <h3>Channels Selected (for reference): <?php echo htmlspecialchars($channel_filter); ?></h3>
                    <p class="text-muted"><small>Note: The scanner analyzes full RGB colors. Channel selection would require additional implementation.</small></p>
                    
                    <h4>Most Common Colors (Top 20):</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RGB Value (Hex)</th>
                                <th>Percentage</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter = 1;
                            foreach ($colors as $hex => $percentage): 
                                // Ensure hex value has # prefix for CSS
                                $hex_color = strpos($hex, '#') === 0 ? $hex : '#' . $hex;
                            ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><code><?php echo htmlspecialchars($hex_color); ?></code></td>
                                    <td><?php echo number_format($percentage * 100, 2); ?>%</td>
                                    <td>
                                        <div style="width: 50px; height: 50px; background-color: <?php echo htmlspecialchars($hex_color); ?>; border: 1px solid #ccc;"></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <a href="repo.php" class="btn btn-primary">Back to Repository</a>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "<p>No image uploaded yet.</p><a href='repo.php'>Go back</a>";
        }
    }
?>
