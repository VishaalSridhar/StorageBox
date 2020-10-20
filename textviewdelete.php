<!DOCTYPE html>
<?php $thisPage="text";
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
if(isset($_SESSION['userId'])) {
  if($_SESSION['activation'] != 1) {
    echo "Please activate your account to access this page <br />";
    echo "You will be redirected to the activation page.";
    header("refresh:5; url=activation.php");
  }
  else {
  $sql = "SELECT * FROM filesdb WHERE mail=?";
  $prepared = $conn->prepare($sql);
  $prepared->bind_param("s", $_SESSION['userId']);
  $prepared->execute();
  $result2 = $prepared->get_result();
  if($result2->num_rows > 0){
    while($row = $result2 ->fetch_assoc()){
        $imageURL = 'uploads/'.$row["filename"];
      //  echo $row['filename'];
  ?>
    <form method="get">
      <input type="submit" name="delete" value="<?php echo $row['filename'] ?>">Delete</input>
    </form>

  <!--  <iframe src="<?php echo $imageURL; ?>" style="width: 400px; height: 250px;" alt="" /> -->

    <?php
    $path_parts = pathinfo($imageURL);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
      case "pdf": ?><iframe src="<?php echo $imageURL; ?>" style="width: 400px; height: 250px;" alt="" /><?php
                  break;
      case "doc": header('Content-disposition: inline');
                  header('Content-type: application/msword');
                  readfile($imageURL);
                  break;
      case "txt":
                  $f = fopen($imageURL, "r") or exit("Unable to open file!");
                  while(!feof($f)) {
                    echo fgets($f)."<br />";
                  }
                  fclose($f);
                  break;
      default: ?><img src="<?php echo $imageURL; ?>" style="width: 400px; height: 250px;" alt="" /> <?php
    }
     ?>
  <?php
    }
  } else { ?>
    <p>No file(s) found...</p>
  <?php
    }
  }
  }
  else {
    echo "Please login to view your files!";
  }
  //$tempFilename = $_GET['delete'];
  if(isset($_GET['delete'])) {
    $sql = "DELETE FROM filesdb WHERE filename=?";
    $prepared = $conn->prepare($sql);
    $prepared->bind_param("s", $_GET['delete']);
    $prepared->execute();
    //echo "File " . $_GET['delete'] . " Successfully Deleted!";
    header("refresh:0; url=textviewdelete.php");
    ?><script>alert("File <?php echo $_GET['delete']; ?> Successfully Deleted!")</script>";
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
