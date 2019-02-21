<?php
ini_set('display_errors', 1);
include_once 'config/database.php';
require_once './classes/Database.php';
session_start();

echo '<h3>Hello '.$_SESSION["username"].'</h3>';

    if(empty($_SESSION['username'])) {
        echo $message = '<label>You need to be signed in to view this page</label>';
        echo '<meta http-equiv="refresh" content="0;join.php"/>';
    }
    $username =  $_SESSION["username"];

    if(isset($_POST['submit'])) {
        $newusername =  $_POST["username"];
        $email =  $_POST["email"];
        $password =  trim($_POST["password"]);
        $cpassword =  trim($_POST["cpassword"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "$email is a valid email address";
        } else {
            echo $message = '<label>email is invalid</label>';
            echo '<meta http-equiv="refresh" content="0;user.php"/>';
        } if($cpassword != $password){
            echo $message = '<label>Passwords do not match</label>';
            echo '<meta http-equiv="refresh" content="0;user.php"/>';
        } elseif (strlen($password) < 6 || strlen($password) > 12 || !preg_match("#[A-Z]+#", $password)){
            echo $message = '<label>Password must be 6-12 characters and contain at least 1 Capital letter</label>';
            echo '<meta http-equiv="refresh" content="0;user.php"/>';
        } else {
                $conn = new PDO("mysql:host=localhost;dbname=camagru_db","root","m2licee");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $select = $conn->prepare("SELECT * FROM users WHERE username='$username'");
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $select->execute();
                $data=$select->fetch();
                
                
                $id_user=$_SESSION['id_user'];                    
                $pass_hash = password_hash($cpassword, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET email='$email', username='$newusername', `password`='$pass_hash' WHERE id_user='$id_user'");
                $stmt->execute();
                session_destroy();
                echo '<meta http-equiv="refresh" content="0;index.php"/>';
                echo "<script> alert ('Credentials Changed Successfully') </script>";     
            }
        } 

        function getLikes($conn, $img_id) {
            $username =  $_SESSION["username"];

            $select = $conn->prepare("SELECT * FROM users WHERE username='$username'");
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $select->execute();
            $data=$select->fetch();
            $id_user=$data['id_user']; 

            $preview = $conn->prepare("SELECT * FROM images WHERE `id_user`='$id_user' ORDER BY `img_id` DESC");
            $preview->setFetchMode(PDO::FETCH_ASSOC);
            $preview->execute();
            return $preview->fetchAll();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gallery.css">
    <title>Camagru_Profile</title>
</head>
<body>
    <h2>User Profile</h2><br /><br />
    <div>
        <a class="form_btn" href="index.php">Home</a>
        <a class="form_btn" href="gallery.php">Gallery</a>
        <a class="form_btn" href="camera.php">Camera</a>
    </div>

    <form class="rightc" action="user.php" method="POST">
        <table>
            <tr><td>Username:</td><td><input type="text" id="username" name="username"></td></tr>
            <tr><td>Email:</td><td><input type="enail" id="email" name="email"></td></tr>
            <tr><td>Password:</td><td><input type="password" id="password" name="password"></td></tr>
            <tr><td>Confirm-Password:</td><td><input type="password" id="cpassword" name="cpassword"></td></tr>
            <tr><td><input type="submit" id="submit" name="submit" value="Update Credentials!"></td></tr>
        </table>
    </form>

    <?php
    $img_id = $_SESSION['username']; 
    foreach(getLikes($conn, $img_id) as $picture): ?>
        <div class="picture">
            <img src="<?= $picture["photo"] ?>" alt="">
        </div>
    <?php endforeach; ?>

    <div><a class="form_btn" href="logout.php" action="logout.php">Logout</a></div>
</body>
</html>