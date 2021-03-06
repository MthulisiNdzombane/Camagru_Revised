<?php
include_once 'classes/Database.php';

function verify($email) {
    $db = new Database();
    $token = rand(7, 2000000);
    $query = "UPDATE users SET token=?  WHERE email=?";
    $params = [$token, $email];
    $db->insertRow($query, $params);

    $to = $email;
    $subject = 'Signup | Verification';
    $message = '
    Thanks for signing up!

    Please click this link to activate your account:
    http://localhost:8080/Camagru/verify.php?email='.$email.'&token='.$token.'
    ';

    $headers = 'From: no-reply@camagru.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

    echo $message = '<label>Email Verification Sent!!</label>';
}
    $vfr = $_GET['token'];

if (isset($vfr)){
    $db = new Database();
    
    $email = $_GET['email'];
    $query = "SELECT `token` FROM `users` WHERE `email` = '$email'";
    $params = [$email];
    $db_token = $db->getRow($query, $params);
    
    if (isset($vfr)){
        $email = $_GET['email'];
        $query = "UPDATE users SET verified= 1 WHERE email='$email'";
        $params = [$verified, $vfr['email']];
        $db->updateRow($query, $params);
        echo '<meta http-equiv="refresh" content="0;join.php"/>';
    }
}

?>
