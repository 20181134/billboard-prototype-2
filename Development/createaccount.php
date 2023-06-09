<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Create a new account</title>
        <link rel="stylesheet" href="stylesheet.css">
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
        ?>
    </head>
    <body>
        <header>
            <div class="logo">
                <h2>Prototype</h2>
                <a class="headerlinks" href="./index.php">Home</a>
                <a class="headerlinks" href="./profile.php">Profile</a>
                <!--<a class="headerlinks" href="">Private Messages</a>-->
            </div>
            <div class="search">
                <?php
                if (isset($_SESSION['user'])) {
                    echo 'Signed in as <a href="', $_SESSION['user']['profilelink'], '">', $_SESSION['user']['username'], '</a>';
                } else {
                    echo '<a href="./signin.php">Sign In</a>';
                }
                ?>
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="Search">
            </div>
        </header>
        <main>
            <div class="contents">
                <div class="information">
                    <p>Create a new account</p>
                </div>
                <div class="tl">
                    <h2>Create a new account</h2>
                    <form action="account-output.php" method="post" enctype="multipart/form-data">
                        Username: <input type="text" name="username"><br>
                        Password: <input type="password" name="password"><br>
                        Bio: <textarea name="bio"></textarea><br>
                        Avatar: <input type="file" name="avatar"><br>
                        <input type="submit" value="Register">
                    </form>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
