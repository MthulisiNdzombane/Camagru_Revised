<?php
ini_set('display_errors', 1);
session_start();
include 'classes/Database.php';

function recovery($email) {
    $db = new Database();
    $new_token = rand(7, 2000000);
    $query = "UPDATE users SET token=? WHERE email=?";
    $params = [$new_token, $email];
    $db->insertRow($query, $params);

    $to = $email;
    $subject = 'Password Recovery';
    $message = '
    Please use the forwarded link to recover your password... 

    Please click this link to recover your account password:
    http://localhost:8080/Camagru_Revised/update.php?email='.$email.'&token='.$new_token.'
    ';

    $headers = 'From: no-reply@camagru.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email
    echo "<script> alert('Email sent') </script>";
}

if(isset($_POST['submit'])) {
    if(isset($_POST['email'])) {
        recovery($_POST['email']);
        $db = new Database();
        $email = trim($_POST['email']);
        $params = [$email];
        $query = "UPDATE users SET password=? WHERE email=?";
        $db->insertRow($query, $params);
    }
}

?>

<!DOCTYPE HTML>
<html>  
<body>
    <form action="" method="POST">
        <input type="text" name="email" placeholder="Email required"><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>
