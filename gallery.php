<?php 
    ini_set('display_errors', 1);
    include_once './config/database.php';
    session_start();

    echo '<h3>Hello '.$_SESSION["username"].'</h3>';
    if(empty($_SESSION['username'])) {
        echo "<script> alert ('You need to be signed in to view this page!') </script>";
        header('location: join.php');
    }
    function getLikes($conn, $img_id) {
        $test = array();
        $preview = $conn->prepare("SELECT * FROM images ORDER BY `img_id` DESC");
        $preview->bindParam(':img_id', $img_id);
        $preview->setFetchMode(PDO::FETCH_ASSOC);
        $preview->execute();
        return $preview->fetchAll();
    }
    function getComments($conn, $img_id)
    {
        $comments = $conn->prepare("SELECT * FROM `comments` WHERE img_id=:img_id");
        $comments->bindParam(':img_id', $img_id);
        $comments->setFetchMode(PDO::FETCH_ASSOC);
        $comments->execute();
        return $comments->fetchAll();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/gallery.css">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php if(!isset($_SESSION['username'])): ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="camera.php">Camera</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="user.php">Profile</a></li>
            <li><a href="join.php">Log in</a></li> 
        <?php else: ?>  
            <li><a href="index.php">Home</a></li>
            <li><a href="camera.php">Camera</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="user.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li> 
        <?php endif ?>
    </ul>
    <?php
    $img_id = $_SESSION['username']; 
    foreach(getLikes($conn, $img_id) as $picture): ?>
        <div class="picture">
            <img src="<?= $picture["photo"] ?>" alt="">
            <form action="" method="POST">
                <button type="submit" name="btnLike">Like</button>
                <input type="hidden" name="img_id" value="<?= $picture["img_id"]; ?>">
            </form>
            <br>
            <form action="" method="POST">
                <textarea name="textarea" id="textarea" cols="30" rows="10" placeholder="Post a comment"></textarea>
                <button type="submit" name="btnComment">Send</button>
                <input type="hidden" name="img_id" value="<?= $picture["img_id"]; ?>">
            </form>
            <div class="comments">
                <?php foreach(getComments($conn, $picture["img_id"]) as $comment): ?>
                    <p class="comment"><?= $comment["post"]; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php 
        if(isset($_POST['btnComment'])) {

            $username = $_SESSION["username"];
            $conn = new PDO("mysql:host=localhost;dbname=camagru_db","root","m2licee");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $select = $conn->prepare("SELECT * FROM users WHERE username='$username'");
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $select->execute();
            $data = $select->fetch();
            $_SESSION['id_user'] = $data['id_user'];
            $id_user = $_SESSION['id_user'];

            $stmt = $conn->prepare("INSERT INTO `comments`(`username`, `img_id`, `post`) VALUES (:username,:img_id,:post)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':img_id', $_POST["img_id"]);
            $stmt->bindParam(':post', $post);
            $username = $_SESSION["username"];
            $img_id = $id_user;
            $post = trim($_POST['textarea']);
            $stmt->execute();
            echo '<meta http-equiv="refresh" content="0.01;gallery.php"/>';
            echo "<script> alert ('Comment Posted!') </script>";
        }
        if(isset($_POST['btnLike'])) {
            $img_id = $_POST['img_id'];
            $like = $conn->prepare("UPDATE `images` SET `likes`=likes+1 WHERE `img_id`=$img_id");
            $like->execute();
            echo '<meta http-equiv="refresh" content="0.01;gallery.php"/>';
            echo "<script> alert ('Liked!') </script>";
        } 
    ?>
</body>
</html>
