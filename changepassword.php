<!DOCTYPE html>
<?php $thisPage="changepassword";
//session_start();?>
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
<?php include('templateHeader.php');
  require 'includes/dbh.inc.php'; ?>
</section>
<section>
<h2 style="text-align: center; font-size: 25px;">Welcome!</h2>
<article>
<div id ="intro">
<p style="text-align: center; font-size: 18px;">You can change your password below!<br></p><br>
  <p style="text-align: center; font-size: 20px;">
    <form method="post">
      <input type="text" name="currpassword">Current Password: </input>
      <input type="text" name="newpassword">New Password: </input>
      <input type="text" name="newrepeatpassword">Repeat Password: </input>
      <input type="submit" name="submit5">Submit</input>
    </form>
  </p>
  <?php
  if(isset($_POST['submit5'])) {
  //  header("Location: www.youtube.com");
    //echo "<p>HELLO WORLD 2</p>";
     $sql = "SELECT pwd FROM users WHERE mail=?";
     $prepared = $conn->prepare($sql);
     $prepared->bind_param("s", $_SESSION['userId']);
     $prepared->execute();
     $result = $prepared->get_result();
     $row = $result->fetch_assoc();
     $checkcurrpass = $row['pwd'];
     $prepared->close();
    // echo "Your curr password is: ";
     // echo $checkcurrpass;
     if(!password_verify($_POST['currpassword'], $checkcurrpass)) {
       echo "Your current password is incorrect.";
      // header("Location: changepassword.php");
       //exit();
     }
     elseif($_POST['newpassword'] != $_POST['newrepeatpassword']) {
       echo "Your new passwords don't match.";
      // header("Location: changepassword.php");
       //exit();
     }
     else {
       $hashedPwd1 = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
       $sql = "UPDATE users SET pwd =? WHERE mail=?";
       $prepared = $conn->prepare($sql);
       $prepared->bind_param("ss", $hashedPwd1, $_SESSION['userId']);
       $prepared->execute();
       $prepared->close();
       echo "Your password has been changed!";
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
