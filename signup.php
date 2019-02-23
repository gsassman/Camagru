<?php
  session_start();

  include('config/connection.php');

  if(isset($_POST['signup']))
  {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $cpass = $_POST['cpass'];

      if ($pass==$cpass){

      $code = rand(100000, 999999);
      $pass_hash = hash('whirlpool', $pass);
      $insert = $conn->prepare("INSERT INTO users (name, email, pass, code)
      VALUES (:name, :email, :pass, :code)");
      $insert->bindParam(':name', $name);
      $insert->bindParam(':email', $email);
      $insert->bindParam(':pass', $pass_hash);
      $uppercase = preg_match('@[A-Z]@', $pass);
      $lowercase = preg_match('@[a-z]@', $pass);
      $number = preg_match('@[0-9]@', $pass);
      
      if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
          echo"password not strong enough";
          header('Refresh: 1;http://localhost:8080/camagru/index.php');
      }
      else
      $insert->bindParam(':code', $code);
      $insert->execute();

      $str = "your verification link is http://localhost:8080/camagru/verify.php?user=" . $email . "&code=" . $code . " special code is" . $code;
      mail($email, "CAMAGRU Confirmation", $str);
      echo "Link sent: You will be redirected in a few seconds";
      header('Refresh: 1; URL=http://localhost:8080/camagru/index.php');

  }
      else echo"passwords does not match";
      header('Refresh: 1;http://localhost:8080/camagru/index.php');
}

?>
