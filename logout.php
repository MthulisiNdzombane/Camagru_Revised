<?php
    session_start();
    session_destroy();
    echo "<script> alert ('C U soon!') </script>";
    header("refresh: 0.4; URL=join.php");
?>