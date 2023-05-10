<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
    <header>
            <div class="logo">
                <h2>Prototype</h2>
                <a class="headerlinks" href="./index.php">Home</a>
                <a class="headerlinks" href="./profile.php">Profile</a>
                <!-- <a class="headerlinks" href="">Private Messages</a> -->
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
                    <a href="./changename.php">Change Usermane</a><br>
                    <!-- <a href="./changebio.php">Change Bio</a><br>
                    <a href="./deleteaccount.php">Deactivate Account</a><br>
                    <a href="./changepassword.php">Change Password</a><br>
                    <a href="./index.php">Back to Home</a> -->
                    <a href="./changeavatar.php">Change Avatar</a><br>
                    <a href="./changebio.php">Change Bio</a><br>
                    <a href="https://www.youtube.com/watch?v=7nQ2oiVqKHw&pp=ygUSV2luZG93cyBYUCBTdGFydHVw">Change Password</a><br>
                    <a href="https://www.youtube.com/watch?v=QH2-TGUlwu4&pp=ygUIbnlhbiBjYXQ%3D" style="color:red;">Deactivate Account</a><br>
                    <a href="./index.php">Back to Home</a>
                </div>
            </div>
        </main>
    </body>
</html>