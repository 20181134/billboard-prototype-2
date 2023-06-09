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
                <!--<a class="headerlinks" href="">Private Messages</a>-->
            </div>
            <div class="search">
                <?php
                if (isset($_SESSION['user'])) {
                    echo 'Logged in as <a href="./signout.php">', $_SESSION['user']['username'], '</a>';
                } else {
                    echo '<a href="./signin.php">Log In</a>';
                }
                ?>
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="Search">
            </div>
        </header>
        <main>
            <div class="contents">
                <div class="information"></div>
                <div class="tl">
                    <p>Log In</p>
                    <form action="signin-output.php">
                       Username: <input type="text" name="username"><br>
                        Password: <input type="password" name="password"><br>
                        <input type="submit" value="Sign In">
                    </form>
                    <div class="account-creation">
                        <p>or <a href="./createaccount.php">create a new account</a></p>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
