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
                    <!--
                <?php
                    if (isset($_SESSION['user'])) {
                        echo 'Signed in as <a href="./signout.php">', $_SESSION['user']['username'], '</a>';
                    } else {
                        echo '<a href="./signin.php">Sign In</a>';
                    }
                ?>
                -->
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
                    <h2>Notifications</h2>
                    <div class="pm">
                        <!--
                        <div class="pmcontents">
                            <form action="/message.php">
                                <b class="subject">Hello from: webdrivertrash</b>
                                <input type="submit" value="Read">
                            </form>
                        </div>
                        <div class="pmcontents">
                            <p class="subject">1st from: webdrivertrash</p>
                            <input type="submit" value="Read">
                        </div>
                        -->
                        <?php
                        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=tweet', 'admin', 'password');
                        $notification = $pdo->query('SELECT * FROM privatemessages WHERE to_='.$_SESSION['user']['id'].' ORDER BY id DESC');
                        foreach ($notification as $row) {
                            echo '<div class="pmcontents">';
                            echo '<form action="./message.php" style="display:flex;align-items:center;">';
                            if ($row['readstatus'] == 0) {
                                echo '<b class="subject">'.$row['subject_'].' (from: '.$row['user1'].')</b>';
                            } else {
                                echo '<p class="subject" style="margin-top:0px;margin-bottom:0px;">'.$row['subject_'].' (from: '.$row['user1'].')</p>';
                            }
                            echo '<input type="hidden" value="'.$row['page_'].'" name="pmpage">';
                            echo '<input type="submit" value="Read">';
                            echo '</form>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>