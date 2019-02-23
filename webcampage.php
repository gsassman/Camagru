<?php
  echo file_get_contents("nav.phtml" );
  include_once './config/connection.php';
  session_start();
  
  if(empty($_SESSION['email'])){
    $msg =  "you need to be signed in to view this";
    echo "<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://localhost:8080/camagru/index.php'; </script>";
  }
  ?>
<html>
<head>
      <title>Camagru</title>
</head>
<body>

    <div class="booth">
        <video id="video"></video>
        <img id="image" height="640px" width="480px" style="display:none;"/>
        <br>
        <button id="snap_button" onclick="javascript:Shot()">Take Picture</button>
        <form action="" method="post" enctype="multipart/form-data">
        <input name='img' id='img' type='hidden'/>
        <form action="saveimage.php" method=post>
        <input type="submit" name="Save" value="Save"></form>
        <!-- <input name='' id='user' type='hidden' value='<?=$_SESSION[login];?>'/> -->
        <div class="heading">
</div>
    
        </form>
    </div>
    <script src="webcam.js"></script>
    <input type='file' accept="image/*" onchange="readURL(this);" />
   <br/>
   <img id="image" height="640px" width="480px" style="display: none;"/>
 </div>
 </article>
    <form id="img_filter">
    <label for="dance" class="dance">
      <input type="radio" name="img_filter" value="img/dance.png" id="dance" onchange="myimage('dance')">
      <img class="img" src="img/dance.png" height="64" width="64">
    </label>
    <label for="cave" class="cave">
      <input type="radio" name="img_filter" value="img/cave.png" id="cave" onchange="myimage('cave')">
      <img class="img" src="img/cave.png" height="64" width="64">
    </label>
    <label for="ship" class="ship">
      <input type="radio" name="img_filter" value="img/ship.png" id="ship" onchange="myimage('ship')">
      <img class="img" src="img/ship.png" height="64" width="64">
    </label>
    <label for="skull" class="skull">
      <input type="radio" name="img_filter" value="img/skull.png" id="skull" onchange="myimage('skull')">
      <img class="img" src="img/skull.png" height="64" width="64">
    </label>
    <label for="mummy" class="mummy">
      <input type="radio" name="img_filter" value="img/mummy.png" id="mummy" onchange="myimage('mummy')">
      <img class="img" src="img/mummy.png" height="64" width="64">
    </label>
     </form>
   <div class="videobox">
   <div id="canvas"></div>
   <form method='post' accept-charset='utf-8' name='form'>
     <input name='user' id='user' type='hidden' value='<?=$_SESSION[login];?>'/>
   </form>
 </div>
</html>
</body>
</html>
<?php
    include 'footer.php'
    ?>

<?php
  session_start();
  $user_id=$_SESSION['id'];
  $image=$_POST['img'];
  try{
      if(isset($_POST['img']))
      $con = new PDO("mysql:host=localhost;dbname=camagru","root","password");
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $photos="INSERT INTO images(photo, name, likes, `user_id`) VALUES ('$image', 'name', '0', $user_id)";
      $con->exec($photos);
  }
  catch(PDOException $e)
  {
      echo "error".$e->getMessage();
  }