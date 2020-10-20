<!DOCTYPE html>
<?php $thisPage="activation"; ?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="finalproject.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<BASE href="http://luna.mines.edu/fall_2019/vsridhar/JQuery%20Basics/Javascript%20Basics">-->
    <meta name="author" content="Pluto">
    <title>Welcome to StorageBox!</title>
</head>

<body class="mob" style="border-style: solid; border-width: 8px; margin: 0px; height: 100%; width: 100%; padding-left: 5px; position: fixed;">
<section style="padding: 0px; margin-top: -10px; width: 100%;"><br>
<?php include('templateHeader.php'); ?>
</section>
<section>
<h2 style="text-align: center; font-size: 25px;">Welcome!</h2>
<article>
<div id ="intro">
<p style="text-align: center; font-size: 18px;">Hello everyone! Welcome to StorageBox, a cool little app where you can upload, delete, and download files.<br>
  <br>This allows you to backup your files to a remote location without using Google Drive or a similar service.</p><br>


  <?php
    include("PHPMailer/src/PHPMailer.php");
    include("PHPMailer/src/Exception.php");
    include("PHPMailer/src/SMTP.php");
    require 'includes/dbh.inc.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
   ?>


  <form  method="post">
    <input type="text" name="curremail">Email: </input>
    <input type="number" name="code1">Activation Code: </input>
    <input type="submit" name="submit3">Submit</input>
  </form>
<?php
  if(isset($_POST['submit3'])) {
    if(empty($_POST['curremail'])) {
      echo "Please enter an email";
   }
   elseif (!FILTER_VAR($_POST['curremail'], FILTER_VALIDATE_EMAIL)) {
      echo "Please enter a valid email";
   }
   elseif (empty($_POST['code1'])) {
     echo "Please enter a activation code";
   }
   else {
     $sql = "SELECT code FROM users WHERE mail=?";
     $prepared = $conn->prepare($sql);
     $prepared->bind_param("s", $_POST['curremail']);
     $prepared->execute();
     $result1 = $prepared->get_result();
     $rowAct = $result1->fetch_assoc();
     $theCode = $rowAct["code"];
    // echo "CODE FROM DB IS: ";
     //echo $_POST['code1'];
     if($_POST['code1'] == $theCode) {
       echo "Your account has been successfully activated! :)";
       $sql1 = "UPDATE users SET activated = 1 WHERE mail=?";
       $prepared1 = $conn->prepare($sql1);
       $prepared1->bind_param("s", $_POST['curremail']);
       $prepared1->execute();
      $prepared1->close();
      session_destroy();
     }
   }
 }

 ?>

</div>
</article>
</section>
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>
