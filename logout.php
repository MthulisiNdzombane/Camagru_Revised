<?php
    session_start();
    session_destroy();
    header("refresh: 0.4; URL=index.php");
    echo "<script> alert ('C U soon!') </script>";
?>