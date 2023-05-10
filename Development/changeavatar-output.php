<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Avatar Change</title>
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
                    <?php
                    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=tweet;', 'admin', 'password');
                    if (is_uploaded_file($_FILES['avatar_new']['tmp_name'])) {
                        $file = 'avatar/'.basename($_FILES['avatar_new']['tmp_name']).'.png';
                        $userpage = file_get_contents('./user/'.$_SESSION['user']['username'].'.php');
                        $userpage_new = str_replace($_SESSION['user']['profilepic'], $file, $userpage);
                        file_put_contents('./user/'.$_SESSION['user']['username'].'.php', $userpage_new);
                        if (move_uploaded_file($_FILES['avatar_new']['tmp_name'], $file)) {
                            $stmt = $pdo->prepare('UPDATE userdata SET avatar=? WHERE userid='.$_SESSION['user']['id']);
                            if ($stmt->execute([$file])) {
                                echo 'Update of Userdata DB: Complete <br>';
                            } else {
                                echo 'Update of Userdata DB: Failed<br>';
                            }
                            $stmt2 = $pdo->prepare('UPDATE tweets SET avatar=? WHERE userid='.$_SESSION['user']['id']);
                            if ($stmt2->execute([$file])) {
                                echo 'Update of Tweets DB: Complete <br>';
                                echo 'Your avatar has been updated successfully.<br>';
                                echo 'You need to <a href=./signout.php>sign out</a> to activate your change.';
                            } else {
                                echo 'Update of Tweets DB: Failed';
                            }
                            
                        }
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>