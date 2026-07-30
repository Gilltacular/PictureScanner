<?php
    $error = isset($_GET['err']) ? htmlspecialchars($_GET['err'], ENT_QUOTES, 'UTF-8') : '';
     
    if (! $error) {
        $error = 'Oops! An unknown error happened.';
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Secure Login: Error</title>
            <link rel="stylesheet" href="styles/main.css" />
        </head>
        <body>
            <h1>There was a problem</h1>
            <p class="error"><?php echo $error; ?></p>  
        </body>
    </html>
?>