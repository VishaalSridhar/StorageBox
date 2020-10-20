<!DOCTYPE html>
<?php $thisPage="upload"; ?>
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
<?php
//session_start();
$thisPage = "upload";
require 'includes/dbh.inc.php';
include('templateHeader.php');
//require 'includes/login.inc.php';
// Include the database configuration file
if(isset($_SESSION['userId'])) {
$statusMsg = '';


// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$userID2 = $_SESSION['userId'];

if(isset($_POST["submit1"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'JPEG');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
          $insert = $conn->query("INSERT into filesdb (filename, uploaded_on, mail) VALUES ('".$fileName."', NOW(), '".$userID2."')");
          //  $insert = $conn->query("INSERT into filesdb (filename, uploaded_on, username) VALUES ('".$fileName."', NOW(), '".$_SESSION[\"userI\"]."')");
            if($insert) {
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again with a valid file (filenames must be unique!).";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
}
else {
  echo "Please login or signup.";
}
?>
<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>
