<?php
session_start();
require_once '../classes/Database.php';

$values = $_GET;

function update($password, $values = array()) {
    $db = new Database();
    $query = 'UPDATE users SET `password`=? WHERE email=?';
    $params = [$password, $values['email']];
    $db->updateRow($query, $params);
}

if(isset($_POST['submit'])) {
    if(isset($_POST['password']) != isset($_POST['repeat_password'])) {
        echo 'Passwords do not match.';
        die();
    } else if(isset($_POST['password']) == isset($_POST['repeat_password'])) {
        $password = trim($_POST['password']);
        $repeat_password = trim($_POST["pwd-repeat"]);
        update($password, $_GET);

        header('refresh: 0.2; URL=../join.php');
    }
}