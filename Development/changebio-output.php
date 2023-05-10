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
                    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=tweet;', 'admin', 'password');
                    $userpage = file_get_contents('./user/'.$_SESSION['user']['username'].'.php');
                    $userpage_new = str_replace('Bio: '.$_SESSION['user']['bio'], 'Bio: '.$_REQUEST['bio_new'], $userpage);
                    if (file_put_contents('./user/'.$_SESSION['user']['username'].'.php', $userpage_new)) {
                        echo 'Update of Userpage: Complete<br>';
                        $stmt = $pdo->prepare('UPDATE userdata SET profilepage=? WHERE userid='.$_SESSION['user']['id']);
                        if ($stmt->execute([$_REQUEST['bio_new']])) {
                            echo 'Update of SQL DB: Complete<br>';
                            echo 'Your bio has been updated successfully.<br>';
                            echo 'You need to <a href="./signout.php">Sign Out</a> to activate your change.<br>';
                            echo "<p style='color:red;'>NOTE: Please sign out once before changing your bio next time in order to reset SESSION function. Otherwise you'll never be able to change your bio permanently.</p>";
                        } else {
                            echo 'Update of SQL DB: Failed<br>';
                        }
                    } else {
                        echo 'Update of Userpage: Failed<br>';
                        echo 'Contact to the moderator of this website.<br>';
                        echo '<a href="./index.php">Back to Home</a>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>