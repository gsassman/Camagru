<?php
include_once './config/connection.php';
session_start();

if(empty($_SESSION['email'])){
  $msg =  "you need to be signed in to view this";
  echo "<script LANGUAGE='JavaScript'>
  window.alert('$msg');
  window.location.href='http://localhost:8080/camagru/index.php'; </script>";
}
?>
<?php
session_start();
session_destroy();

header("location:index.php");
?>