<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>hey - PM</title>
        <link rel="stylesheet" href="../stylesheet.css">
    </head>
    <body>
    <header>
            <div class="logo">
                <h2>Prototype</h2>
                <a class="headerlinks" href="../index.php">Home</a>
                <a class="headerlinks" href="../profile.php">Profile</a>
                <a class="headerlinks" href="">Private Messages</a>
            </div>
            <div class="search">
                <div class="breakwater1">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo 'Signed in as <a href="./signout.php">', $_SESSION['user']['username'], '</a>';
                    } else {
                        echo '<a href="./signin.php">Sign In</a>';
                    }
                ?>
                </div>
                <!-- Signed in as <a href="">Example</a> -->
                <form action="search-output.php" method="post" class="headersearch">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="Search">
                </form>
            </div>
        </header>
        <main>
            <div class="contents">
                <div class="information"></div>
                <div class="tl">
                    <?php 
                    $toid = 29;
                    $fromid = 28;
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['id'] == $toid || $_SESSION['user']['id'] == $fromid) {
                            $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=tweet', 'admin', 'password');
                            $stmt = $pdo->prepare('UPDATE privatemessages SET readstatus=1 WHERE page_=?');
                            $path = __FILE__;
                            $filename = basename($path, '.php');
                            if($stmt->execute([$filename])) {
                                echo 'Done';
                            }
                            echo '<h2>hey</h2>
                            <p style="color:#909090;">from: notiftest</p>
                            <p>wow</p>
                            <a href="/index.php">Back to Home</a>';
                        } else {
                            echo "You don't have permission to access this page.";
                        }
                    } else {
                        echo "You don't have permission to access this page.";
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>