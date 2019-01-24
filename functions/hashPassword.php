<?php

function hashPassword($password, $action) {

    if ($action == 1)
        return password_hash($password[0], PASSWORD_DEFAULT);
    elseif ($action == 2)
        return password_verify($password[0], $password[1]);
}

// hashing
    // hashPassword([$password], 1);

// verify
    // hashPassword([$passwordFromUser, $passwordFromDatabase], 2);