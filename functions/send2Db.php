<?php
function send2Db(array $values) {
    $db = new Database();
    

    $username = trim($values["username"]);
    $email = trim($values["email"]);
    $password = trim($values["pwd"]);
    $r_password = trim($values["pwd-repeat"]);

    $query = "INSERT INTO users(`username`, `email`, `password`) VALUES (?,?,?)";
    $params = [$username, $email, password_hash($password, PASSWORD_DEFAULT)];
    $db->insertRow($query, $params);
}