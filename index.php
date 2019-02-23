<!doctype html>
<html>
    <head>
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
    </head>
        <div id="container">
        <h1>Welcome to Camagru</h1>
         <p><i><u></i></p></u>
       <div class="front">
            <div class="register">
            <h1>Create Account</h1>
                <form method="post" action="signup.php">
                <div><input type="text" name="name" placeholder="User Name" required></div>
                <div><input type="email" name="email" placeholder="Email" required></div>
                <div><input type="password" name="pass" placeholder="Password" required></div>
                <div><input type="password" name="cpass" placeholder="Confirm Password" required></div>
                <div><input class="button" type="submit" name="signup" value="SIGN UP"></div>
                <div><a href="gallery.phtml">Public Gallery</a></div>
                </form>
            </div>


            <div class="register1">
                <h1>Sign In</h1>
                <form method="post" action="login.php" autocomplete="off">
                <div><input type="email" name="email" placeholder="Email" required></div>
                <div><input type="password" name="pass" placeholder="Password" required></div>
                <div><input class="button" type="submit" name="signin" value="LOGIN"></div>
                <div><input class="button" onclick="location.href='forgotpassword.php';" type="submit" name="forgotpassword" value="FORGOT PASSWORD"></div>
            </div>
        </div>
    </div>
    </body>
</html>
<?php
    include 'footer.php';
?>