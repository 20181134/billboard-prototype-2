<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>lol - PM</title>
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
                    <h2>lol</h2>
                    <p style="color:#909090;">from: notiftest</p>
                    <p>I found a cat meme</p>
                    <a href="/index.php">Back to Home</a>
                </div>
            </div>
        </main>
    </body>
</html>