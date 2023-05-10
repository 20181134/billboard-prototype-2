<?php
require 'require1.php';
unset ($_SESSION['user']);
$pdo = new PDO('mysql:host=localhost;dbname=tweet;charset=utf8;', 'admin', 'password');
$stmt = $pdo->prepare('SELECT * FROM userdata where username=? and password=?');
if ($stmt->execute([$_REQUEST['username'], $_REQUEST['password']])) {
    foreach ($stmt as $row) {
        $_SESSION['user']=[
            'username'=>$row['username'],
            'profilepic'=>$row['avatar'],
            'id'=>$row['userid'],
            'bio'=>$row['profilepage']
            ];
    }
}
if (isset($_SESSION['user'])) {
    echo "<p>You've logged in successfully.</p><br>";
    echo '<a href="./index.php">Back to Home</a>';
} else {
    echo 'Username or password is incorrect<br>';
    echo '<a href="./index.php">Back to Home</a>';
}
    require 'require2.php';
?>&#239;