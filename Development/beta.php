<?php session_start(); ?>
<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Beta Preview - Billboard</title>
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
                    <h2>Beta Preview</h2>
                    <p>Welcome to Beta Preview! In this page, you can try out some features which are not published yet. </p>
                    <b>List of features published as Beta now:</b>
                    <ul>
                        <li><a href="./pmcompose.php">Private Messages</a></li>
                    </ul>
                    <p>If you have any suggestions about features, please send them from the form below:</p>
                    <form method="post" action="">
                        <textarea placeholder="Any suggestions will be welcomed!"></textarea>
                        <input type="submit" value="Send">
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>