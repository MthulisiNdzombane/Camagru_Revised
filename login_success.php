<?php
ini_set('display_errors', 1);
session_start();
    if(isset($_SESSION["username"])) {
        echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
        echo '<meta http-equiv="refresh" content="0.5;gallery.php"/>';
    }
?>
