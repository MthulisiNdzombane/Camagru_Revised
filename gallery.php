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
    <link rel="stylesheet" type="text/css" href="css/camera.css">
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/camera.js"></script>
    <title>Camagru</title>

    <style>

    
    .nested{
        display: grid;
        /* grid-column-gap:1,5em; */
        /* grid-auto-rows:minmax(50px, auto); */
        /* grid-template-columns: repeat(3, 1fr); */
        grid-template-columns: repeat(2, 2fr);
    }

    .grid-wrapper{
        display: grid;
        /* grid-column-gap: 1.5em;
        /* grid-auto-rows:minmax(400px, auto); */
        grid-template-columns: repeat(3, 1fr);
        /* align-self: center */
        /* grid-column:1/1; */
        /* grid-row:1/1; */

    }

    .grid-wrapper > div {
        background: #eee;
        padding: 1em;
    }

    .grid-wrapper >div:nth-child(odd){
        background:#ddd;
    }

    .grid-camera {
        display: grid;
        /* justify-items: stretch; */
    }

    .grid-camera > div {
        background: #fff;
        /* padding: 1em; */
    }

    .btn {
    border-radius: 9px;
    font-family: 'Oswald', sans-serif;
    color: silver;
    font-size: 15%;
    padding: 1px 2px;
    border: solid silver 3px;
    text-transform: uppercase;
    text-decoration: none;
    }

    .btn:hover {
        color: goldenrod;
        border: solid goldenrod 3px;
    }
    </style>
</head>
<body>
    <div><a class="form_btn" href="index.php">back</a></div> <br />
    <div><a class="form_btn" href="logout.php" action="logout.php">Logout</a></div>
        <div class="grid-wrapper">
            <div class="gallery">
                <div class="nested">
                    <div><a href="images/environment-flowers-friends-543216.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-543216.jpeg"></a></div>
                    <div><a href="images/environment-flowers-friends-543216.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-543216.jpeg"></a></div>
                    <div><a href="images/backlit-bright-dawn-697243.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-697243.jpeg"></a></div>
                    <div><a href="images/candle-creepy-dark-236277.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-236277.jpeg"></a></div>
                    <div><a href="images/close-up-creepy-dark-619418.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-619418.jpeg"></a></div>
                    <div><a href="images/environment-flowers-friends-543216.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-543216.jpeg"></a></div>
                    <div><a href="images/environment-flowers-friends-543216.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-543216.jpeg"></a></div>
                    <div><a href="images/backlit-bright-dawn-697243.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-697243.jpeg"></a></div>
                    <div><a href="images/candle-creepy-dark-236277.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-236277.jpeg"></a></div>
                    <div><a href="images/close-up-creepy-dark-619418.jpg" data-lightbox="mygallery" data-title="photography made fun"><img src="images/pexels-photo-619418.jpeg"></a></div>
                </div>
            </div>

            <div class="grid-camera">Camera
                <video id="video" width="640" height="480" autoplay></video>
                <button class="btn" id="snap">snap_</button>
                <canvas id="canvas" width="640" height="480"></canvas>
            </div>

            <div class="grid-wrapper">Filters
                <div class="gallery"> 
                    <div class="nested">
                        <div><a href="png/Faceless.png" data-lightbox="mygallery" data-title="Valamo"><img src="png/Faceless.png"></a></div>
                        <div><a href="png/Faceoff.png" data-lightbox="mygallery" data-title="Faceoff"><img src="png/Faceoff.png"></a></div>
                        <div><a href="png/catears.png" data-lightbox="mygallery" data-title="Smexy"><img src="png/catears.png"></a></div>
                        <div><a href="png/Ninja.png" data-lightbox="mygallery" data-title="Spy"><img src="png/Ninja.png"></a></div>
                        <div><a href="png/dab.png" data-lightbox="mygallery" data-title="Spy"><img src="png/dab.png"></a></div>
                        <div><a href="png/focku.png" data-lightbox="mygallery" data-title="Spy"><img src="png/focku.png"></a></div>
                        <div><a href="png/kodak.png" data-lightbox="mygallery" data-title="Spy"><img src="png/kodak.png"></a></div>
                        <div><a href="png/savage.png" data-lightbox="mygallery" data-title="Spy"><img src="png/savage.png"></a></div>
                        <div><a href="png/tears.png" data-lightbox="mygallery" data-title="Spy"><img src="png/tears.png"></a></div>
                        <div><a href="png/dtf.png" data-lightbox="mygallery" data-title="Spy"><img src="png/dtf.png"></a></div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>