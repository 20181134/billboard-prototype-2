<?php session_start(); ?>
<?php
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_SESSION['user'])) {
                date_default_timezone_set('Asia/Tokyo');
                if (strlen($_REQUEST['new-tweet'])) {
                    if (strpos($_REQUEST['new-tweet'], '@') !== false) {
                        // echo '<script>alert("Mentioned!")</script>';
                        $mention = strstr($_REQUEST['new-tweet'], '@');
                        $mention = strstr($mention, ' ', true);
                        $mention2 = str_replace('@', '', $mention);
                        $request = str_replace($mention, '<a href="./user/'.$mention2.'.php">'.$mention.'</a>', $_REQUEST['new-tweet']);
                    } else {
                        // echo '<script>alert("No mention!")</script>';
                        $request = $_REQUEST['new-tweet'];
                    }
                    $stmt = $pdo->prepare('INSERT INTO tweets values(?, ?, ?, ?, ?, ?)');
                    if ($stmt->execute([null, $request, $_SESSION['user']['username'], $_SESSION['user']['profilepic'], date('Y-m-d H:i:s'), $_SESSION['user']['id']])) {
                        header('Location:./index.php');
                        exit();
                    } else {
                        echo 'Something went wrong<br>';
                        print_r ($stmt -> errorInfo());
                    }
                } else {
                    echo '<script>alert("文章が入力されていません")</script>';
            }
            } else {
                echo '<script>alert("文章を投稿するにはログインしてください");</script>';
            }
        }
        // 削除機能
        if (isset($_POST['del'])) {
            $del = $pdo->prepare('DELETE FROM tweets WHERE id = :id');
            $del -> bindValue(':id', $_REQUEST['del']);
            if ($del -> execute()) {
                header('Location:./index.php');
            } else {
                echo '投稿の削除に失敗しました';
            }
        }
        ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home - Billboard</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <h2>Prototype 1</h2>
                <a class="headerlinks" href="./index.php">Home</a>
                <a class="headerlinks" href="./profile.php">Profile</a>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="headerlinks" href="./accountsetting.php">Account Settings</a>';
                }
                ?>
                <!--<a class="headerlinks" href="">Private Messages</a>-->
            </div>
            <div class="search">
                <div class="breakwater1">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo 'Logged in as <a href="./signout.php">', $_SESSION['user']['username'], '</a>';
                    } else {
                        echo '<a href="./signin.php">Log In</a>';
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
                    <p class="titletext">Account</p>
                    <?php
                    if (!isset($_SESSION['user'])) {
                        echo '<div class="infobar1">';
                        echo '<a href="./signin.php">Sign In</a> or <a href="createaccount.php">Create a new account</a> and tweet now!';
                        echo '</div>';
                    }
                    ?>
                    <div class="account-info">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<img src="', $_SESSION['user']['profilepic'], '" class="prof">';
                            echo '<p class="user">', $_SESSION['user']['username'], '</p>';
                        }
                        ?>
                        <!--
                        <img src="./img25.jpg" class="prof">
                        <p class="user">Example</p>
                        -->
                    </div>
                    <div class="moreinfo">
                        <?php
                        if (isset($_SESSION['user'])) {
                            //echo '<a href="./profile.php">Your profile</a>';
                            // CSSをあとで作成
                        }
                        // Tweet数カウント 一時非表示
                        //if (isset($_SESSION['user'])) {
                        //    $sql = 'SELECT COUNT(*) as cnt FROM userdata';
                        //    $rs = mysql_query($sql);
                        //    $row = mysql_fetch_assoc($rs);
                        //    $count = $row['cnt'];
                        //    echo '<p class="desc">Tweets: ', $count;
                        //}
                        ?>
                        <!--
                        <p class="desc">Tweets: 5</p>
                        <p class="desc">Bio: Hello World</p>
                        -->
                    </div>
                    <!-- What's New Start -->
                    <div class="whatsnew">
                        <p class="titletext">What's new</p>
                        <a class="whatsnewlinks" href="./underconstruction.php"> - Bio Change (5/1/2023)</a><br>
                        <a class="whatsnewlinks" href="./underconstruction.php"> - Avatar Change (4/29/2023)</a><br>
                        <a class="whatsnewlinks" href="./underconstruction.php"> -  Verified Mark (4/29/2023)</a><br>
                        <a class="whatsnewlinks" href="./underconstruction.php"> - Username Change (4/28/2023)</a><br>
                        <a class="whatsnewlinks" href="./underconstruction.php"> - Major Bug Fixes (4/27/2023)</a><br>
                    </div>
                    <!-- What's New End -->
                </div>
                <div class="tl">
                    <p class="title2">What's new?</p>
                    <form action="" method="post">
                        <textarea name="new-tweet" id="text1"></textarea>
                        <input type="submit" value="tweet">
                    </form>
                    <hr class="division">
                        <div class="timeline">
                            <?php
                            // ページング処理のテスト ここから
                            /*
                            $count = $pdo->query('SELECT COUNT(*) FROM tweets');
                            foreach ($count as $row) {
                                $num = $row[0];
                                echo 'count:'.$row[0].'<br>';
                            }
                            echo 'num value: '.$num.'<br>';
                            $max_page = ceil($num / 10);
                            echo 'page: '.$max_page.'<br>';
                            if (!isset($_GET['page'])) {
                                $_GET['page'] = 1;
                            } else {
                                $now = $_GET['page'];
                                echo '$_GET has been set successfully<br>';
                            }
                            $disp_start = $num - 10 * ($now - 1);
                            echo 'disp_start value: '.$disp_start.'<br>';
                            $disp_end = $num - 10 * $now;
                            $disp_end_int = (int)$disp_end;
                            var_dump($disp_end_int);
                            echo '<br>';
                            $disp = $pdo->prepare('SELECT * FROM tweets ORDER BY id DESC LIMIT 10 OFFSET :en');
                            //$disp -> bindValue(':st', $disp_start);
                            $disp -> bindValue(':en', $disp_end_int, PDO::PARAM_INT);
                            if ($disp->execute()) {
                                echo 'success!';
                            foreach ($disp as $row) {
                                echo '<div class="breakwater2">';
                                echo '<div class="tweet">';
                                echo '<a href="./user/'.$row['uploader'].'.php">';
                                echo '<img src="', $row['avatar'], '" class="avatar1">';
                                echo '<div class="cont">';
                                echo '<b class="username">', $row['uploader'], '</b></a>';
                                echo '<p class="contents1">', $row['contents'], '</p>';
                                echo '<p class="time">', $row['time'], '</p>';
                                echo '</div>';//cont
                                echo '</div>';//tweet
                                echo '<form action="" method="post"><input type="hidden" name="del" value='.$row['id'].'>';
                                if ($_SESSION['user']['id'] == $row['userid']) {
                                echo '<input type="submit" value="Delete">';
                                }
                                echo '</form>';
                                echo '</div>';
                                echo '<hr class="division">';
                            }
                            } else {
                                echo 'failure';
                                print_r ($disp -> errorInfo());
                            }
                            for ($i = 1; $i <= $max_page; $i++) {
                                if ($i == $now) {
                                    echo $now;
                                } else {
                                    echo '<a href="./index.php?page='.$i.'">'.$i.'</a>';
                                }
                            }
                            */

                            // ページング処理のテスト ここまで
                            // 以下コメント解除

                            $timeline = $pdo->query('SELECT * FROM tweets ORDER BY id DESC');
                            foreach ($timeline as $row) {
                                echo '<div class="breakwater2">';
                                echo '<div class="tweet">';
                                echo '<a href="./user/'.$row['uploader'].'.php">';
                                echo '<img src="', $row['avatar'], '" class="avatar1">';
                                echo '<div class="cont">';
                                echo '<div style="display:flex;align-items:center;"><b class="username" style="margin-right:8px;">', $row['uploader'], '</b></a>', '<p style="color: #909090;margin:0px;"> @', $row['userid'], '</p>';
                                // moderator icon start
                                if ($row['userid'] == 52 || $row['userid'] == 1 || $row['userid'] == 35) {
                                    echo '<img src="./image002.gif" style="height:20px;object-fit:cover;margin-left:5px;">';
                                }
                                //moderator icon end
                                echo '</div>';
                                echo '<p class="contents1">', $row['contents'], '</p>';
                                echo '<p class="time">', $row['time'], '</p>';
                                echo '</div>';//cont
                                echo '</div>';//tweet
                                echo '<form action="" method="post"><input type="hidden" name="del" value='.$row['id'].'>';
                                if ($_SESSION['user']['id'] == $row['userid']) {
                                echo '<input type="submit" value="Delete">';
                                }
                                echo '</form>';
                                echo '</div>';
                                echo '<hr class="division">';
                            }

                            ?>
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
                            <div class="tweet">
                                <img src="avatar1.jpg" class="avatar1">
                                <div class="cont">
                                    <b class="username">Example2</b>
                                    <p class="contents1">Hello, World!</p>
                                    <p class="time">13:48:38 9/6/2022</p>
                                </div>
                            </div>
                            -->
                        </div>
                </div>
            </div>
        </main>
        <footer>
            <p>Do not use this website for any important purposes.</p><br><p>Created by webdrivertrash. Source code of this website can be checked <a href="https://github.com/20181134/billboard-prototype">here</a>.</p>
        </footer>
    </body>
</html>
