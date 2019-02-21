<?php
  $servername = 'localhost';
  $username   = 'root';
  $password   = 'm2licee';

try{
    $conn = new PDO("mysql:host=localhost;dbname=camagru_db","root","m2licee");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $sql . "<br>" . 'Failed to connect: ' . $e->getMessage();
}
?>
