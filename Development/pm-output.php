<?php 
session_start(); 
$pdo=new PDO('mysql:host=localhost;dbname=tweet;charset=utf8', 'admin', 'password');
$stmt = $pdo->prepare('INSERT INTO privatemessages values (null, ?, ?, ?, ?, ?, 0, ?, null, null)');
$page = mt_rand();
?>
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
                        if ($stmt->execute([$_SESSION['user']['id'], $_SESSION['user']['username'], $_REQUEST['userid'], $_REQUEST['subject'], $_REQUEST['mainpm'], $page])) {
                            $pmpage = file_get_contents('./pmdefault.txt');
                            $pmpage = str_replace('insert_subject_here', $_REQUEST['subject'], $pmpage);
                            $pmpage = str_replace('insert_username_here', $_SESSION['user']['username'], $pmpage);
                            $pmpage = str_replace('insert_contents_here', $_REQUEST['mainpm'], $pmpage);
                            $pmpage = str_replace('insert_to_here', $_REQUEST['userid'], $pmpage);
                            $pmpage = str_replace('insert_from_here', $_SESSION['user']['id'], $pmpage);
                            if (file_put_contents('./pm/'.$page.'.php', $pmpage)) {
                                echo 'Your message has been sent successfully.<br>';
                                echo '<a href="./index.php">Back to Home</a>';
                            } else {
                                echo 'Error!';
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>