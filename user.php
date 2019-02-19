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
    <title>Camagru_Profile</title>
</head>
<body>
    <h2>User Search</h2><br /><br />
    <form class="rightc" action="includes/user.inc.php" method="POST">
        <table>
            <tr><td>Username:</td><td><input type="text" id="username" name="username"></td></tr>
            <tr><td>Email:</td><td><input type="text" id="mail" name="mail"></td></tr>
            <tr><td><input type="submit" id="submit" name="submit" value="View Profile!"></td></tr>
        </table>
    </form>
</body>
</html>