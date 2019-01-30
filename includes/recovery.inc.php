<?php

session_start();
include '../classes/Database.php';

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
    http://localhost:8080/update.php?email='.$email.'&token='.$new_token.'
    ';

    $headers = 'From: no-reply@camagru.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

    echo "<script> console.log('Email sent')</script>";
}

if(isset($_POST['submit'])) {
    if(isset($_POST['email'])) {
        recovery($_POST['email']);
        // $db = new Database();

        // $email = trim($_POST["email"]);
        // $params = [$email];
        // $query = "UPDATE users SET password=? WHERE email=?";
        // $db->insertRow($query, $params);
    }
}