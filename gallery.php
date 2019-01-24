<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <title>Camagru</title>
</head>
<body>
    <div><a class="form_btn" href="index.php">back</a></div> <br />
    <div><a class="form_btn" href="logout.php" action="logout.php">Logout</a></div>
        <div>
            <div class="gallery">
            <a href="images/environment-flowers-friends-543216.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-543216.jpeg"></a>
            <a href="images/backlit-bright-dawn-697243.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-697243.jpeg"></a>
            <a href="images/candle-creepy-dark-236277.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-236277.jpeg"></a>
            <a href="images/close-up-creepy-dark-619418.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-619418.jpeg"></a>
        </div>
    </div>
</body>
</html>