<!doctype html>
<html>
        <title>Reset Password</title>
        <h1>Reset Password</h1>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <form  class="myform" id="form" action="resetpassword.php" method="post">
            <br><br><br><br>
            <label><b>Email</label><br>
            <input name="email" type="email" class="inputvalues"><br>
            <label><b>New Password</label><br>
            <input name="password" type="password" class="inputvalues"><br>
            <label><b>Confirm New Password</label><br>
            <input name="confirm-password" type="password" class="inputvalues"><br>
            
            <input name="confirm" class="buttons" type="submit" value="Update Password"><br>        
        </form>
</html>

<?php
session_start();
include('config/connection.php');

if(isset($_POST['confirm'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm-password'];
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
      
    if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
          echo"password not strong enough";
    }
    else if($cpass != $pass){
        echo "password's do not match";
    }
    else {
        $pass = hash('whirlpool',$_POST['password']);
        $stmt = $conn->prepare("UPDATE users SET pass='$pass' WHERE email='$email'");
        $stmt->execute();
        echo "password Changed.";
        header("refresh:1; index.php");
    }
}
?>
<?php
    require 'footer.php';
    ?>