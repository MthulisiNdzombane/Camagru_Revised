#!/usr/bin/php
<?php
  include 'config.php';

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
    $sql = "CREATE TABLE $DB_NAME .`users` (
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
    $sql = "CREATE TABLE $DB_NAME .`images` (
      `img_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `img_path` varchar(255) NOT NULL,
      `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `user_id` int(11) NOT NULL,
      FOREIGN KEY (user_id) REFERENCES users(id_user)
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
    $sql = "CREATE TABLE `camagru_db`.`comments` ( 
      `id_user` INT(25) NOT NULL AUTO_INCREMENT , 
      `post` VARCHAR(255) NOT NULL , 
      `date_posted` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
      `img_id` INT(25) NOT NULL ,
      FOREIGN KEY (id_user) REFERENCES users(id_user),
      FOREIGN KEY (img_id) REFERENCES images(img_id) , 
    PRIMARY KEY (`id_user`)) ENGINE = InnoDB;";
    $conn->exec($sql);
    echo "Comments-table successfully created<br>";
  } catch (PDOEXcepetion $e) {
    echo 'Failed to create table:'. $e->getMessage();
  }

  // //likes table
  // try {
    
  // } catch (PDOEXcepetion $e) {
  //   echo 'Failed to create table:'. $e->getMessage();
  // }
?>
