
<?php
  $msg = "First line of text\nSecond line of text";

  $msg = wordwrap($msg,70);

  mail("g1sassman@gmail.com","My subject",$msg);
?>
