#!/usr/bin/php
<?php
  include 'database.php';

  $DB_NAME = "camagru_db";
  
  //establish a connection to the server.
  try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS `".$DB_NAME."`";
    $conn->exec($sql);
    echo "Database spawned<br>";
} catch (PDOException $e) {
  echo $sql . "<br>" . 'Failed to connect: ' . $e->getMessage();
}
  //users table
  try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS $DB_NAME .`users` (
      `id_user` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `username` varchar(20) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(270) NOT NULL,
      `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `token` int(11) DEFAULT NULL,
      `verified` tinyint(1) DEFAULT '0'
      )ENGINE=InnoDB DEFAULT CHARSET=utf8";
      $conn->exec($sql);
      echo "Users-table successfully made<br>";
  } catch (PDOEXcepetion $e) {
      echo 'Failed to create table:'. $e->getMessage();
  }

  //images table
  try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS $DB_NAME .`images` (
      `img_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `username` varchar(255) NOT NULL,
      `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `id_user` int(11) NOT NULL,
      `photo` LONGTEXT NOT NULL,
      `title` VARCHAR(255) NOT NULL,
      `likes` INT(11) DEFAULT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $conn->exec($sql);
    echo "Images-table successfully spawned<br>";
  } catch (PDOEXcepetion $e) {
    echo 'Failed to create table:'. $e->getMessage();
  }

  //comments table
  try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS $DB_NAME .`comments` ( 
      `comment_id` INT PRIMARY KEY AUTO_INCREMENT, 
      `username` VARCHAR(255) NOT NULL, 
      `img_id` INT(11) DEFAULT NULL,
      `post` LONGTEXT NOT NULL )";
    $conn->exec($sql);
    echo "Comments-table successfully created<br>";
  } catch (PDOEXcepetion $e) {
    echo 'Failed to create table:'. $e->getMessage();
  }
  echo "<script> alert ('Database & Tables created successfully!') </script>";
  echo '<meta http-equiv="refresh" content="0.01;../index.php"/>';
?>
