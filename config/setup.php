<?php
  include('database.php');

  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $error) {
    echo 'Connection Failed: ' . $error->getMessage();
  }

  $conn->exec("CREATE DATABASE IF NOT EXISTS camagru");
  $conn->exec("USE camagru");
  $conn->exec("CREATE TABLE IF NOT EXISTS users (
          id INT PRIMARY KEY AUTO_INCREMENT,
          name VARCHAR(225) NOT NULL UNIQUE,
          email VARCHAR(255) UNIQUE,
          pass VARCHAR(255) UNIQUE,
          code INT,
          isVerified INT(1) DEFAULT 0,
          notify INT(1) DEFAULT 1)"
          );
  $conn->exec("CREATE TABLE IF NOT EXISTS images (
          name VARCHAR(255) NOT NULL,
          p_id INT(11) PRIMARY KEY AUTO_INCREMENT,
          photo LONGTEXT NOT NULL,
          user_id INT(11) NOT NULL,
          likes INT(255) DEFAULT 0,
          comments VARCHAR(255) DEFAULT NULL)"
          );
  $conn->exec("CREATE TABLE IF NOT EXISTS comments (
          name VARCHAR(255) NOT NULL,
          p_id INT(11) PRIMARY KEY AUTO_INCREMENT,
          pp_id INT(11) NOT NULL,
          comment VARCHAR(255) DEFAULT NULL)"
          // -- commentor VARCHAR(255) DEFAULT NULL,
          // -- comment_id INT(11) PRIMARY KEY AUTO_INCREMENT)
          );
  header('Location: ../index.php');
?>
