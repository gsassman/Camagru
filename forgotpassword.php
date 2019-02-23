<!doctype html>
<html>
        <title>Forgot Password</title>
        <h1>Forgot Password</h1>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <form  class="myform" id="form" action="forgotpassword.php" method="post">
            <br><br><br><br>
            <label><b>Confirm Email</label><br>
            <input name="email" type="email" class="inputvalues" placeholder=<?php echo $_SESSION['email'];?>><br>
            
            <input name="confirm" class="buttons" type="submit" id="forgot_btn" value="Submit"><br>
            <a href = "index.php">Back to HomePage</a>
        </form>
</html>

<?php
    session_start();
    include('config/connection.php');
    
    if(isset($_POST['confirm']))
    {
        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        if($stmt->rowCount() == 1)
        {
            $id = $row['id'];
      
            $message= "
                Hello , $email
                <br /><br />
                Click Following Link To Reset Your Password 
                <br /><br />
                <a href='http://localhost:8080/camagru/resetpassword.php?userid=$id&email=$email'>
            click here to reset your password</a>
                <br /><br />
                thank you :)
                ";
                $headers = "Content-Type: text/html";
            $subject = "password reset";
            mail($email,$subject, $message, $headers);
            $msg = " We have sent an email to $email.Please click on the password reset link in the email to generate new password.";
     }
     else
     {
      $msg = "<strong>Sorry!</strong> this email not found. ";
     }
    }
    ?>

<?php
    include 'footer.php';
?>