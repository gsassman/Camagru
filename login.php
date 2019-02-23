<?php
  session_start();

  include('config/connection.php');

  if(isset($_POST['signin']))
  {
    $email = $_POST['email'];
    $pass = hash('whirlpool', $_POST['pass']);

    $select = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $select->bindParam(':email', $email);
    $select->execute();
    $data = $select->fetch(PDO::FETCH_ASSOC);

    if (isset($data['email']))
    {
      if ($data['isVerified'] == 0)
        echo 'Verify your email.';
      else
      {
        if($data['pass'] != $pass)
          echo "invalid email or password";
        else
        {
           $_SESSION['email']=$data['email'];
           $_SESSION['name']=$data['name'];
           $_SESSION['id']=$data['id'];
           header("location: webcampage.php");
        }
      }
    }
    else {
      echo "invalid email or password";
    }
  }
?>
