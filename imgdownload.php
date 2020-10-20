  <!DOCTYPE html>
<?php $thisPage="img"; ?>
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
  require 'includes/dbh.inc.php';
 ?>
</section>
<section>
<h2 style="text-align: center; font-size: 25px;">Image File Download</h2>
<article>
<div id ="intro">
<p style="text-align: center; font-size: 18px;">Hello everyone! Use this page to download image files!</p><br>
<?php
if(isset($_SESSION['userId'])) {
  $imgURL = "";
  $sql = "SELECT * FROM filesdb WHERE mail=?";
  $prepared = $conn->prepare($sql);
  $prepared->bind_param("s", $_SESSION['userId']);
  $prepared->execute();
  $result2 = $prepared->get_result();
  if($result2->num_rows > 0){
    while($row = $result2 ->fetch_assoc()){
        $imageURL = 'uploads/'.$row["filename"];
        ?>
        <span style="width: 25%;  margin-bottom: 100px; text-align: center;" class="tempClass" >
        <form method="post">
          <input type="submit" name="download" value="<?php echo $row['filename'] ?>">Download</input>
        </form>
        <br />
        <img src="<?php echo $imageURL; ?>" style="width: 400px; height: 250px;" alt="" />
        </span>
      <?php
    }
  } else {
      echo "<p>No image(s) found...</p>";
      }
  }
  if (isset($_POST['download'])) {
    //download_file($FilePaths);
    if( file_exists($imageURL)) {

     $fsize = filesize($imageURL);
     $path_parts = pathinfo($imageURL);
     $ext = strtolower($path_parts["extension"]);

     switch ($ext) {
       case "pdf": $ctype="application/pdf"; break;
       case "gif": $ctype="image/gif"; break;
       case "png": $ctype="image/png"; break;
       case "jpeg":
       case "jpg": $ctype="image/jpg"; break;
       default: $ctype="application/force-download";
     }

     header("Pragma: public");
     header("Expires: 0");
     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
     header("Cache-Control: private",false);
     header("Content-Type: $ctype");
     header("Content-Disposition: attachment; filename=\"".basename($imageURL)."\";" );
     header("Content-Transfer-Encoding: binary");
     header("Content-Length: ".$fsize);
     ob_clean();
     flush();
     readfile($imageURL);

   }
   else {
     die('File Not Found');

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
