<?php
ini_set('display_errors', 1);
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
            header('refresh: 0.3; URL=../join.php');
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert ('This is not a valid email address!') </script>";
            header('refresh: 0.0; URL=../join.php');

          } else if($_POST['pwd'] == $_POST['pwd-repeat']) {
            $username   = trim($_POST["username"]);
            $email      = trim($_POST["email"]);
            // $password   = trim($_POST["pwd"]);
            // $r_password = trim($_POST["pwd-repeat"]);

            //check for user duplication
            checkDuplicates($username, $email);

            //insert new data into db when users sign-up
            send2Db($_POST);

            //Email verification function
            verify($email);

            echo "<script> alert ('COngratulations. You can proceed to login...') </script>";
                    header('refresh: 0.0; URL=../join.php');
            
        } else {
            echo "<script> alert ('Passwords do not match!') </script>";
            header('refresh: 0.0; URL=../join.php');
        }
    }

    //User login.
    if(isset($_POST["login-submit"])) {
        if(empty($_POST["username"]) || empty($_POST["password"])) {
            echo $message = '<label>All fields are required</label>';
            header('refresh: 0.0; URL=../join.php');
        } 
        else {
        $db = new Database();
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $params = [$username];
        $query = "SELECT `password` FROM users WHERE username=?";
        $hash_password = $db->getRow($query, $params);

            if (password_verify($password, $hash_password['password'])) {
                    $_SESSION["Username"] = trim($_POST["username"]);
                    header ('refresh: 0.0; URL=../gallery.php');

                    echo "<script> alert ('loggin in...') </script>";
            } 
            else {
                    echo "<script> alert ('Login Failed.') </script>";
                    header('refresh: 0.0; URL=../join.php');
            }
        }  
    }
        if(isset($_POST["reset_password"])) {
            header('refresh: 0.0; URL=./../recovery.php');
            echo "<script> alert ('Please provide your email address...') </script>";
    }
    } catch(PDOException $e){
        die($e->getMessage());
        
}
