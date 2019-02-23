<?php
    session_start();

    include('config/connection.php');

    if (isset($_GET['user']))
    {
      $code = $_GET['code'];
      $stmt = $conn->prepare("SELECT * FROM users WHERE code=:code");
      $stmt->bindParam(':code', $code);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result['email'] == $_GET['user'])
      {
        $stmt = $conn->prepare('UPDATE users SET isVerified=1 WHERE code=:code');
        $stmt->bindParam(':code', $_GET['code']);
        $stmt->execute();
      }
    }
?>
<!doctype html>
<html>
    <head>
        <title>Verification</title>
        <link rel="stylesheet" type="text/css" href="./css/verified.css">
    </head>
    <body>
    <br><br><br><br><br><br><br>
        <a href = "http://localhost:8080/camagru/">Home</a>
    </body>

<?php
    include 'footer.php';
    header("Refresh:1; index.php");
?>
