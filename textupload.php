<!DOCTYPE html>
<?php $thisPage="text"; ?>
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

?>
</section>
<section>
<h2 style="text-align: center; font-size: 25px;">Text File Upload</h2>
<?php
if(!isset($_SESSION['userId'])) {
  echo "<p style=\"text-align: center; font-size: 30px;\">Please login to continue!<br/>";
  echo "You will be redirected to the login page soon...</p>";
  header("refresh:7; url=login.php");
}
 ?>
<?php if(isset($_SESSION['userId'])) {
  if($_SESSION['activation'] != 1) {
    echo "Please activate your account to access this page <br />";
    echo "You will be redirected to the activation page.";
    header("refresh:5; url=activation.php");
  }
  else {
  ?>
  <article>
  <div id ="intro">
  <p style="text-align: center; font-size: 18px;">Hello everyone! This page will allow you to upload image files. Stay tuned!</p><br>
    <form action="uploadtxt.php" method="post" enctype="multipart/form-data">
        Select Image File to Upload:
        <input type="file" name="file">
        <input type="submit" name="submit1" value="Upload">
    </form>
  </div>
  </article>
  <?php
}
}
?>

</section>
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>