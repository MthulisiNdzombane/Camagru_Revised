<?php 
ini_set('display_errors', 1);
include_once 'config/database.php';
session_start();

    $username=$_SESSION['username'];
    echo '<h3>Hello '.$_SESSION["username"].'</h3>';

    if(empty($_SESSION['username'])) {
        echo $message = '<label>You need to be signed in to view this page</label>';
        echo '<meta http-equiv="refresh" content="0.01;join.php"/>';
         
    }
//Save & Upload Image
if (isset($_POST['save'])) {
        $select = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();
        $data=$select->fetch();
        $id_user=$data['id_user'];
        echo $id_user;
        $pic=$_POST['image'];
        $title="M2_".date("Y/m/d")."_".rand(1000, 1000000);
        $likes=0;

        $stmt=$conn->prepare("INSERT INTO images (username, id_user, photo, title, likes) 
        VALUES (:username, :id_user, :photo, :title, :likes)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':photo', $pic);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':likes', $likes);
        $stmt->execute();
        echo "<script> alert ('Photo Saved!') </script>";
        echo '<meta http-equiv="refresh" content="0;gallery.php"/>';
}

//upload Images
if(isset($_POST['upload'])) {
    $select = $conn->prepare("SELECT * FROM users WHERE username='$username'");
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();
    $data=$select->fetch();
    $id_user=$data['id_user'];
    $title="M2_".date("Y/m/d")."_".rand(1000, 1000000);

    $username = $_SESSION['username'];
    $images = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imageSize = $_FILES['profile']['size'];
    $upload_dir='uploads/';
    $extension=strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions=array("jpeg", "jpg", "png", "gif", "pdf");
    $uphoto=rand(1000, 1000000).".".$extension;
    $likes=0;

    move_uploaded_file($tmp_dir, $upload_dir.$uphoto);
    $file = file_get_contents($upload_dir.$uphoto, true);
    $encoded = "data:image;base64,".base64_encode($file);

    $upload=$conn->prepare("INSERT INTO images(username, photo, title, likes, id_user) VALUES(:username, :photo, :title, :likes, :id_user)");
    $upload->bindParam(':username', $username);
    $upload->bindParam(':photo', $encoded);
    $upload->bindParam(':title', $title);
    $upload->bindParam(':likes', $likes);
    $upload->bindParam(':id_user', $id_user);
    if($upload->execute()){
        echo '<meta http-equiv="refresh" content="0.01;gallery.php"/>';
        echo "<script> alert ('Photo Uploaded! AWE ;)') </script>";
    } else if(!$upload->execute() === TRUE) {
        echo "<script> alert ('Upload Failed. Please try again...') </script>";
        echo '<meta http-equiv="refresh" content="0.01;camera.php"/>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/camera.css">
    <title>Webcam</title>
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

    <div class="booth">
    <video id="video" width="400" height="300" autoplay="true" ondrop="drop(event)"></video>

        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Filters</button>
                <div id="myDropdown" class="dropdown-content">
                    <button  onclick="add_effect(0);"><img src="png/catears.png"/></button>
                    <button  onclick="add_effect(1);"><img src="png/Claus.png"/></button>
                    <button  onclick="add_effect(2);"><img src="png/dab.png"/></button>
                    <button  onclick="add_effect(3);"><img src="png/dtf.png"/></button>
                    <button  onclick="add_effect(4);"><img src="png/Faceless.png"/></button>
                    <button  onclick="add_effect(5);"><img src="png/focku.png"/></button>
                    <button  onclick="add_effect(6);"><img src="png/kodak.png"/></button>
                    <button  onclick="add_effect(7);"><img src="png/Ninja.png"/></button>
                    <button  onclick="add_effect(8);"><img src="png/tears.png"/></button>
                    <button  onclick="add_effect(9);"><img src="png/bugeye.png"/></button>
                    <button  onclick="add_effect(10);"><img src="png/fallout.png"/></button>
                    <button  onclick="add_effect(11);"><img src="png/savage.png"/></button>
                </div>
        </div>
    
        <button id ="capture" onclick="snap();">Take Photo</button>
        <canvas id="filters" width="400" height="300"></canvas>
        <canvas id="canvas" width="400" height="300"></canvas>

        <form action="camera.php" method="post">
            <input id="camera" type="hidden" name="image">
            <input type=submit name="save" value="save">
        </form>
    </div>
    <hr>
        <div>
        <h5 style="color: blue;">Upload a picture of type: jpeg/jpg/png/gif/pdf</h5>
            <form method="post" action="camera.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input type="file" name="profile" required="" accept="*/image"><br>
                </div>
                <div>
                    <button type="submit" name="upload">Upload</button>
                </div>
            </form>
        </div>
 <script>

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>
<script src="js/camera.js"></script>

</body>
</html>