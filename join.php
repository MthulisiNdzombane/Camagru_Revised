<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>
</head>
<body>
    <br />
    
    <a class="form_btn" href="gallery.php">Guest Login</a><br>
    <a class="form_btn" href="index.php">back</a>
    <div class="container">
        <div class="split left">
            <h1> Register </h1>
            <div class="index_form">
                <form class="leftc" action="includes/join.inc.php" method="POST">
                    <input type="text" name="username" placeholder="username"><br>
                    <input type="text" name="email" placeholder="E-mail"><br>
                    <input type="password" name="pwd" placeholder="Password"><br>
                    <input type="password" name="pwd-repeat" placeholder="Confirm password"><br>
                    <button class="form_btn" type="submit" name="signup">Register</button>
                </form>
            </div>
        </div>
        <div class="split right">
            <h1>Login</h1>
            <div class="index_form">
                <form class="rightc" action="includes/join.inc.php" method="POST">
                    <input type="text" name="username" placeholder="username"><br>
                    <input type="password" name="password" placeholder="password"><br>
                    <div>
                        <button id="login-submit" class="form_btn" type="submit" name="login-submit" value="Login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="js/main.js"></script>
    <!-- <script src="js/modal.js"></script> -->
</body>
</html>