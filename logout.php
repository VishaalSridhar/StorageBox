<!DOCTYPE html>
<?php $thisPage="logout"; ?>
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
<h2 style="text-align: center; font-size: 25px;">Hello!</h2>
<article>
<div id ="intro">
<p style="text-align: center; font-size: 18px;">Thanks for visiting us!!<br></p><br>
<?php
  session_unset();
  session_destroy();
		echo '<form action="includes/login.inc.php" method="post">
		<input type="text" name="mailuid" placeholder="E-mail">
		<input type="password" name="pwd" placeholder="Password">
		<button type="submit" name="login-submit">Login</button>
		</form>
		<a href="signup.php">Sign Up</a>';

if(!isset($_SESSION['userId'])) {
  ?>
  <a href="forgotpassword.php">Forgot Your Password?</a>
  <?php
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
