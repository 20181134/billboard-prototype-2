<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
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
                        echo 'Signed in as <a href="../signout.php">', $_SESSION['user']['username'], '</a>';
                    } else {
                        echo '<a href="../signin.php">Sign In</a>';
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
                <div class="information">
                    <p class="titletext">Account Info</p>
                    <div class="account-info">
                        <img src="../avatar/phpuCeThA.png" class="prof">
                        <p class="user">notiftest</p>
                    </div>
                    <div class="moreinfo">
                        <!--
                        <p class="desc">Bio: Hello</p>
                        -->
                        <p class="desc">Bio: a</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="timeline">
                        <!--
                            ここから追加するデータ
                        <div class="tweet">
                            <img src="avatar1.jpg" class="avatar1">
                            <div class="cont">
                                <b class="username">Example2</b>
                                <p class="contents1">Hello, World!</p>
                                <p class="time">13:48:38 9/6/2022</p>
                            </div>
                        </div>
                        <hr class="division">
                        -->
                        <!--
                        <div class="tweet">
                            <img src="avatar1.jpg" class="avatar1">
                            <div class="cont">
                                <b class="username">Example2</b>
                                <p class="contents1">Hello, World!</p>
                                <p class="time">13:48:38 9/6/2022</p>
                            </div>
                        </div>
                        <hr class="division">
                        -->
                        <?php
                        $userid = '28';
                        /*
                        $path = __FILE__;
                        //echo basenmae($path);
                        $path2 = basename($path);
                        $path2 = str_replace('.php', '', $path2);
                        $pdo = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=asaaaa_tweet;charset=utf8;', 'asaaaa_admin', 'admin1234');
                        $stmt = $pdo->prepare('SELECT * FROM tweets where uploader=?');
                        if ($stmt->execute([$path2])) {
                            foreach ($stmt as $row) {
                                echo '<div class="tweet">';
                                echo '<img class="avatar1" src="../', $row['avatar'], '">';
                                echo '<div class="cont">';
                                echo '<b class="username">', $row['uploader'], '</b>';
                                echo '<p class="contents1">', $row['contents'], '</p>';
                                echo '<p class="time">', $row['time'], '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr class="division">';
                            }
                        } else {
                            print_r ($stmt -> errorInfo());
                        }*/
                        $pdo = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=asaaaa_tweet;charset=utf8;', 'asaaaa_admin', 'admin1234');
                        $stmt = $pdo->prepare('SELECT * FROM tweets WHERE userid = ? ORDER BY id DESC');
                        if ($stmt->execute([$userid])) {
                            foreach ($stmt as $row) {
                                echo '<div class="tweet">';
                                echo '<img class="avatar1" src="../', $row['avatar'], '">';
                                echo '<div class="cont">';
                                echo '<b class="username">', $row['uploader'], '</b>';
                                echo '<p class="contents1">', $row['contents'], '</p>';
                                echo '<p class="time">', $row['time'], '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr class="division">';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>