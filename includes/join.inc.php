<?php
// ini_set('display_errors', 1);
session_start();
require_once '../classes/Database.php';
require_once '../functions/send2Db.php';
require_once '../functions/hashPassword.php';
require_once '../functions/checkDuplicates.php';
require_once './../verify.php';

try {
    //Registering a User and capturing all info.
    if(isset($_POST["signup"])){
        //Error handling [empty fields]
        if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["pwd"]) || empty($_POST["pwd-repeat"])) {
            echo '<meta http-equiv="refresh" content="0.01;../join.php"/>';
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert ('$email is invalid') </script>";
          } else if($_POST['pwd'] == $_POST['pwd-repeat']) {
            $username   = trim($_POST["username"]);
            $email      = trim($_POST["email"]);
            //check for user duplication
            checkDuplicates($username, $email);
            //insert new data into db when users sign-up
            send2Db($_POST);
            //Email verification function
            verify($email);
                        
            echo "<script> alert ('Please check your email for verification...') </script>";
            echo '<meta http-equiv="refresh" content="0.01;../join.php"/>';
        } else {
            echo "<script> alert ('Passwords do not match!') </script>";
        }
    }

    //User login.
    if(isset($_POST["login-submit"])) {
        if(empty($_POST["username"]) || empty($_POST["password"])) {
            echo "<script> alert ('All fields must be filled in!') </script>";
            echo '<meta http-equiv="refresh" content="0.01;../join.php"/>';
        } else {
            $db = new Database();
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $params = [$username];
            $query = "SELECT `password` FROM users WHERE username=?";
            $hash_password = $db->getRow($query, $params);

            if (password_verify($password, $hash_password['password'])) {
                    $_SESSION["username"] = trim($_POST["username"]);
                    header ('location: ../login_success.php');
                    echo '<meta http-equiv="refresh" content="0.01;../login_success.php"/>';
                    
            } 
            else {
                echo "<script> alert ('Login failed. Please try again...') </script>";
                echo '<meta http-equiv="refresh" content="0.01;../join.php"/>';
            }
        }  
    }
        if(isset($_POST["reset_password"])) {
            echo '<meta http-equiv="refresh" content="0;../recovery.php"/>';
    }
    } catch(PDOException $e){
        die($e->getMessage());
}
