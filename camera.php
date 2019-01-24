<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/camera.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <title>Webcam</title>
</head>
<body>
    <div id="newImages"></div>
    <video id="player" autoplay></video>
    <canvas id="canvas" width="320px" height="240px"></canvas>
    <button class="btn btn-primary" id="capture-btn">snap_</button>
    <div id="pickImage">
        <label>Video is not supported. Pick an Image instead</label>
        <input type="file" accept="uploads/images/*" id="image-picker">
    </div>
<div style="display: none" id="username"><?php session_start(); echo $_SESSION["Username"]; ?></div>
<script src="js/camera.js"></script>
</body>
</html>