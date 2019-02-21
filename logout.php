<?php
    ini_set('display_errors', 1);
    session_start();
    session_destroy();
    echo '<meta http-equiv="refresh" content="0.01;index.php"/>';
    echo "<script> alert ('C U soon!') </script>";
?>