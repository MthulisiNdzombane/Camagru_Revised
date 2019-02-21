<?php

require_once '../classes/Database.php';

function checkDuplicates($username, $email) {

    $db = new Database();

    $query = "SELECT * FROM users WHERE username=?";
    $params = [$username];

    if(($db->getRows($query, $params))) {
        echo "<script> alert ('Username already taken!') </script>";
        die();
    }

    $query = "SELECT * FROM users WHERE email=?";
    $params = [$email];

    if(($db->getRows($query, $params))) {
        echo "<script> alert ('Email already taken!') </script>";
            die();
    }
}