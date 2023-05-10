<?php
require 'require1.php';
if (isset($_SESSION['user'])) {
    unset ($_SESSION['user']);
    // header('Location: ./index.php');
    // exit();
    echo "<p>You've been logged out successfully.<br></p>";
    echo '<a href="./index.php">Back to Home</a>';
} else {
    echo "You've already logged out.<br>";
    echo '<a href="./index.php">Back to Home</a>';
}
require 'require2.php';
?>