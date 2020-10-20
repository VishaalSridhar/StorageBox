<!DOCTYPE html>
<?php $thisPage="img";
require 'includes/dbh.inc.php'; ?>
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
<h2 style="text-align: center; font-size: 25px;">View/Delete Image Files</h2>
<article>
<div id ="intro">
<p style="text-align: center; font-size: 18px;">Hello everyone! Use this page to view/delete image files.</p><br>
<?php
ob_start();
if(isset($_SESSION['userId'])) {
  $sql = "SELECT * FROM filesdb WHERE mail=?";
  $prepared = $conn->prepare($sql);
  $prepared->bind_param("s", $_SESSION['userId']);
  $prepared->execute();
  $result2 = $prepared->get_result();
  if($result2->num_rows > 0){
    while($row = $result2 ->fetch_assoc()){
        $imageURL = 'uploads/'.$row["filename"];
?><span style="width: 25%;  margin-bottom: 100px; text-align: center;" class="tempClass" >
    <form method="post">
      <input type="submit" name="delete" value="Delete"></input>
      <input type="hidden" name="delete1" value="<?php echo $row['filename'] ?>"></input>
    </form>
    <br />
<?php echo "" .$row['filename']. ""; ?>
    <img src="<?php echo $imageURL; ?>" style="width: 400px; height: 250px;" alt="" />
  </span>
<?php
    }
  } else {
    echo "<p>No image(s) found...</p>";
    }
  }
  else {
    echo "Please login to view your files!";
  }
  if(isset($_POST['delete'])) {
    $sql = "DELETE FROM filesdb WHERE filename=?";
    $prepared = $conn->prepare($sql);
    $prepared->bind_param("s", $_POST['delete1']);
    $prepared->execute();
    header("refresh:0;");
    exit();
  }
ob_end_flush();
?>
</div>
</article>
</section>
</body>
<br />
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</html>
