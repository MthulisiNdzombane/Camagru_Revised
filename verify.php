<?php

include_once 'classes/Database.php';
// // include 'includes/join.inc.php';

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
    http://localhost:8080/Camagru_Revised/verify.php?email='.$email.'&token='.$token.'
    ';

    $headers = 'From: no-reply@camagru.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

    echo "<script> console.log('Email sent')</script>";
}
    //vfr = verify-variable
    $vfr = $_GET;

if (isset($vfr['token'])){
    $db = new Database();
    
    $email = $_GET['email'];
    
    $query = "SELECT `token` FROM `users` WHERE `email` = ?";
    $params = [$email];
    $db_token = $db->getRow($query, $params);
    
    if ($db_token['token'] == $vfr['token']){

        $verified = 1;
        $query = "UPDATE users SET verified= ? WHERE email=?";
        $params = [$verified, $vfr['email']];
        $db->updateRow($query, $params);
        header('location: join.php');
    }
}

?>
