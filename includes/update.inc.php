<?php
session_start();
require_once '../classes/Database.php';

$values = $_GET;

function update($password, $values = array()) {
    echo "<script> console.log('4')</script>";
    $db = new Database();
    echo "<script> console.log('5')</script>";
    $query = 'UPDATE users SET `password`=? WHERE email=?';
    echo "<script> console.log('6')</script>";
    $params = [$password, $values['email']];
    echo "<script> console.log('7')</script>";
    $db->updateRow($query, $params);
    echo "<script> console.log('8')</script>";
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