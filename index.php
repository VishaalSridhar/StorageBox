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
      <?php
      ob_start();
        //echo "Code is ";
        //echo $_SESSION['firstlogin'];
        if (isset($_SESSION['userId'])) {
          echo "<p>You are logged in!</p>";
          echo "USER ID IS " . $_SESSION['userId'] . "<br/>";
          if($_SESSION['firstlogin'] == NULL) {
            echo "Please check your email for the activation code.";
              //exit();
              if($_SESSION['activation'] != 1) {
              $actCode = "0123456789";
              $code = substr(str_shuffle($actCode), 0 , 6);
              $sql = "UPDATE users SET code =? WHERE mail=?";
              $prepared = $conn->prepare($sql);
              $prepared->bind_param("ss", $code, $_SESSION['userId']);
              $prepared->execute();
              $prepared->close();
              $mail = new PHPMailer(true);
              $mail->isSMTP();                            // Set mailer to use SMTP
              $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
              $mail->SMTPAuth = true;                     // Enable SMTP authentication
              $mail->Username = 'finalprojectwebdev@gmail.com'; // your email id
              $mail->Password = 'testing#@2019'; // your password
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
              $mail->setFrom('finalprojectwebdev@gmail.com', 'Group 9');
              $mail->addAddress($_SESSION['userId']);   // Add a recipient
              $mail->isHTML(true);  // Set email format to HTML
              //$pass = password_verify("S6BFRJ4o","$2y$10$4wUoblBofR/Oc9hkw6ShmumxBt25Da3bOr8AvtRsGd3UDxdrKq4BO");
              $bodyContent = '<h1>Hello,</h1>';
              $bodyContent .= '<p>Please find your activation code below: <br/>' . $code . '<br/> Click here to <a href="localhost/webDevFinalProject-master/activation.php">activate</a> your account.</p>';
              $mail->Subject = 'Email from Group 9';
              $mail->Body    = $bodyContent;
              if(!$mail->send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
              } else {
                echo 'Message has been sent.';
                header("refresh:5; url=activation.php");
              }
            }
          }




          //mail('alphaguacamole@gmail.com', 'test subject', 'hello');
          //echo "Email success";
        }
        else {
          echo "<p>You are not logged in!</p><br/>";
        }
        ob_end_flush();
       ?>

</div>
</article>
</section>
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>
