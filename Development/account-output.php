<?php session_start(); ?>
<?php
        unset ($_SESSION['user']);
        $pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
        $check = $pdo->prepare('SELECT * FROM userdata where username=:user');
        $check -> bindValue(':user', $_REQUEST['username']);
        if ($check->execute()) {
            if ($data = $check -> fetch(PDO::FETCH_ASSOC)) {
                require 'require1.php';
                echo 'Username has already taken<br>';
                echo '<a href="./index.php">Back to Home</a><br>';
                require 'require2.php';
                //var_dump($data);
            } else {
                if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                    if (!file_exists('avatar')) {
                    mkdir('avatar');
                    }
                $file = 'avatar/'.basename($_FILES['avatar']['tmp_name']).'.png';
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file)) {
                    $stmt = $pdo->prepare('INSERT INTO userdata values(?, ?, ?, ?, ?)');
                    if ($stmt->execute([null, $_REQUEST['username'], $_REQUEST['password'], $file, $_REQUEST['bio']])) {
                        //echo 'データを追加';
                    } else {
                        print_r ($stmt -> errorInfo());
                    }
                    $sql = $pdo->prepare('SELECT * FROM userdata where username=? and password=?');
                    if ($sql->execute([$_REQUEST['username'], $_REQUEST['password']])) {
                        foreach ($sql as $row) {
                            $_SESSION['user']=[
                                'username'=>$row['username'],
                                'profilepic'=>$row['avatar'],
                                'id'=>$row['userid'],
                                'bio'=>$row['profilepage']
                            ];
                        }
                        //echo 'SQL success!';
                        if (!file_exists('user')) {
                            mkdir('user');
                        }
                        $user = file_get_contents('./profile.txt');
                        $user = str_replace('insert_avatar_here', '../'.$_SESSION['user']['profilepic'], $user);
                        $user = str_replace('insert_username_here', $_SESSION['user']['username'], $user);
                        $user = str_replace('insert_userid_here', $_SESSION['user']['id'], $user);
                        $user = str_replace('insert_bio_here', $_SESSION['user']['bio'], $user);
                        file_put_contents('./user/'.$_SESSION['user']['username'].'.php', $user);
                    } else {
                        print_r ($sql -> errorInfo());
                    }
                    header('Location: ./index.php');
                    exit();
                } else {
                    echo 'Something went wrong<br>';
                    echo $file;
                    echo '<br><a href="./index.php">Back</a>';
                }
            } else {
                echo 'Select an avatar<br>';
                echo $_FILES['avatar']['tmp_name'].'is not an uploaded file';
            }
            }
        } else {
            print_r ($check -> errorInfo());
        }
        ?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        
    </body>
</html>