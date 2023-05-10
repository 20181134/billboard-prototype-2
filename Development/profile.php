<?php session_start(); ?>
<?php
        if (isset($_SESSION['user'])) {
            header('Location:./user/'.$_SESSION['user']['username'].'.php');
        } else {
            header('Location:./signin.php');
        }
        ?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        
    </body>
</html>