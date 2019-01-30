<?php 
// require_once './classes/Database.php';
// session_start(); 
// echo "<script> console.log('Email sent1')</script>";
// $details = $_GET;

// function token_verify($details) {
//     echo "<script> console.log('Email sent3')</script>";
//     $db = new Database();
//     $query = "SELECT `token` FROM users WHERE email=?";
//     $params = [$details['token'], $details['email']];
//     // print_r($params);
//     echo "<script> console.log('Email sent4')</script>";
//     $result = $db->getRow($query, $params);
//     if(1) {
//         echo "<script> console.log('Email sent5')</script>";
//        header('location: update.php');
//     }
//     else
//     {
//         echo "<script> console.log('Email sent4')</script>";
//         echo "Invalid Token!, Please request a new one.";
//         header('refresh: 3.0; URL=./recovery.php');
//     }
// }
// echo "<script> console.log('Email sent2')</script>";
//     token_verify($details);
?>


<?php

function update($params) {
    $db = new Database();
    $query = 'UPDATE users SET `password`=? WHERE token=?';
    $db->updateRow($query, $params);
}

if (isset($_POST['submit']))
{
    if($_POST['password'] != $_POST['repeat_password'])
    {
        echo 'Passwords do not match.';
        die();
    } 
    else if($_POST['password'] == $_POST['repeat_password']) 
    {
        $password = trim($_POST['password']);
        $params = [password_hash($password, PASSWORD_DEFAULT), $_POST['token']];
        update($params);
        header('location: ../join.php');
    }
}

echo '<!DOCTYPE html>
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Update</title>
</head>
<body>
    <form action="includes/update.inc.php" method="post">
    <input type="text" placeholder="email" name="email" value="'.$_GET['email'].'"><br>
    <input type="text" value="'.$_GET['token'].'"><br>
    <input type="text" placeholder="Type new password" name="password"><br>
    <input type="text" placeholder="Confirm new password" name="repeat_password"><br>
    <input type="submit" name="submit">
    </form>
</body>
</html>';

?>
