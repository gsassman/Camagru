<?PHP

include_once 'config/connection.php';
session_start();
if(empty($_SESSION['email'])){
    $msg =  "you need to be signed in to view this";
    echo "<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://localhost:8080/camagru/index.php'; </script>";
  }
   if(isset($_POST['confirm']) && (!empty($_POST['notify']))){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];
    $id = $_SESSION['id'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
      
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
          echo"password not strong enough";
    }
    else if ($cpassword != $password){
        echo "password's do not match";
    } else { 
        $password = hash('whirlpool',$_POST['password']);
        $stmt = $conn->prepare("UPDATE users SET notify =1, name='$username', pass='$password', email = '$email' WHERE id='$id'");
        $stmt->execute();
            $msg =  "you will now receieve notifications on likes and comments";
            echo "<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            // window.location.href='http://localhost:8080/camagru/update.php'; </script>";
        echo "Your changes have been made. You will be redirected";
        header('Refresh: 2; URL=http://localhost:8080/camagru/update.php');
    }
}
    if(isset($_POST['confirm']) && (empty($_POST['notify']))){ 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $email = $_POST['email'];
        $id = $_SESSION['id'];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
          
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
              echo"password not strong enough";
        }
        else if ($cpassword != $password){
            echo "password's do not match";
        } else { 
            $password = hash('whirlpool',$_POST['password']);
            $stmt = $conn->prepare("UPDATE users SET notify=0,  name='$username', pass='$password', email = '$email' WHERE id='$id'");
            $stmt->execute();
            echo "Your changes have been made. You will be redirected";
            header('Refresh: 2; URL=http://localhost:8080/camagru/update.php');
        }
}
?>
<!doctype html>
<html>
        <title>Update</title>
        <h1>Update Profile</h1>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <form  class="myform" id="form" action="update.php" method="post">
            <br><br><br><br>
            <label><b> New Username</label><br>
            <input name="username" type="text" class="inputvalues"><br>
            <label><b> New Email</label><br>
            <input name="email" type="email" class="inputvalues"><br>
            <label><b> New Password</label><br>
            <input name="password" id="password" type="password" class="inputvalues"><br>
            <label><b> Confirm New Password</label><br>
            <input name="cpassword" id="cpassword" type="password" class="inputvalues"><br>
            <input type="checkbox" name="notify" value='notify'> Notifications<br>
            
            <input name="confirm" class="buttons" type="submit" id="update_btn" value="Confirm Update" /><br>
            
            <a href="webcampage.php">Webcampage<br>
           

        </form>
</html>
<?php
    include 'footer.php';
?>