<!DOCTYPE html>
<?php $thisPage="home"; ?>
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
<p style="text-align: center; font-size: 18px;">Reset your password below. You will get an email with your new password.</p><br>


  <?php
    include("PHPMailer/src/PHPMailer.php");
    include("PHPMailer/src/Exception.php");
    include("PHPMailer/src/SMTP.php");
    require 'includes/dbh.inc.php';
    //include("includes/login.inc.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
   ?>
   <form  method="post">
     <input type="text" name="forgotemail">Email: </input>
     <input type="submit" name="submit2">Submit</input>
   </form>
   <?php
   if(isset($_POST['submit2'])) {
     if(empty($_POST['forgotemail'])) {
       echo "Please enter an email";
    }
    elseif (!FILTER_VAR($_POST['forgotemail'], FILTER_VALIDATE_EMAIL)) {
       echo "Please enter a valid email";
      //header("Location: forgotpassword.php?error=invalidmail=".$_POST['forgotemail']);
      //exit();
    }
    else {

      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $newPassword =  substr(str_shuffle($str_result), 0, 8);
      $hashedPwd1 = password_hash($newPassword, PASSWORD_DEFAULT);
      $sql = "UPDATE users SET pwd =? WHERE mail=?";
      $prepared = $conn->prepare($sql);
      $prepared->bind_param("ss", $hashedPwd1, $_POST['forgotemail']);
      $prepared->execute();
      $prepared->close();


      //echo "USER ID IS " . $_SESSION['userId'] . "<br/>";
      $mail = new PHPMailer(true);
      $mail->isSMTP();                            // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                     // Enable SMTP authentication
      $mail->Username = 'finalprojectwebdev@gmail.com'; // your email id
      $mail->Password = 'testing#@2019'; // your password
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
      $mail->setFrom('finalprojectwebdev@gmail.com', 'Group 9');
      $mail->addAddress($_POST['forgotemail']);   // Add a recipient
      $mail->isHTML(true);  // Set email format to HTML

      $bodyContent = '<h1>Hello,</h1>';
      $bodyContent .= '<p>Please find your new password below: <br/>'. $newPassword . '<br/> </p>';
      $mail->Subject = 'Group 9 - New Password';
      $mail->Body    = $bodyContent;
      if(!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message has been sent.';
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
