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
<!--<p style="text-align: center; font-size: 18px;">You can change your password below!<br></p><br>-->


</div>
</article>
</section>
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>
