<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
$check = $pdo->prepare('SELECT * FROM userdata where username=:user');
        $check -> bindValue(':user', $_REQUEST['username_new']);
        if ($check->execute()) {
            if ($data = $check -> fetch(PDO::FETCH_ASSOC)) {
                require 'require1.php';
                echo 'Username has already taken<br>';
                echo '<a href="./index.php">Back to Home</a><br>';
                require 'require2.php';
                var_dump($data);
            } else {
                $userpage = './user/'.$_SESSION['user']['username'].'.php';
                $userpage_no_extension = './user/'.$_SESSION['user']['username'];
                $userpage_new = './user/'.$_REQUEST['username_new'].'.php';
                //rename ($userpage, $userpage_no_extension.'.txt');
                //$cont = fopen($userpage_no_extension.'.txt', 'w');
                $cont = file_get_contents($userpage);
                //echo $cont;
                $cont = str_replace($_SESSION['user']['username'], $_REQUEST['username_new'], $cont);
                file_put_contents ($userpage_new, $cont);
                unlink($userpage);
                $stmt = $pdo->prepare('UPDATE userdata SET username=? where userid='.$_SESSION['user']['id']);
                if ($stmt->execute([$_REQUEST['username_new']])) {
                    require 'require1.php';
                    echo 'Your username has been updated successfully.<br>';
                    //echo '<a href="./index.php>Back to Home</a><br>';
                    echo 'You need to <a href="./signout.php">Log Out</a> and log back in to activate your change.';
                }
                $stmt2 = $pdo->prepare('UPDATE tweets SET uploader=? WHERE userid='.$_SESSION['user']['id']);
                if ($stmt2->execute([$_REQUEST['username_new']])) {
                    echo 'SQL has been updated!';
                } else {
                    echo 'error!';
                }
                require 'require2.php';
                /*
                $userpage = file_get_contents('./user/'.$_SESSION['user']['username'].'.php');
                echo $userpage;
                $userpage = str_replace($_SESSION['user']['username'], $_REQUEST['username_new'], $user);
                file_put_contents('./user/'.$_REQUEST['username_new'].'.php', $userpage);
                */
                

            }
        } else {
            require 'require1.php';
            echo 'Could not check';
            require 'require2.php';
        }
?>