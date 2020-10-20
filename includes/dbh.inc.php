<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
$sql = "CREATE DATABASE website";
$conn->query($sql);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->close();

$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$dbName1 = "website";
$conn = new mysqli($servername, $username, $password, $dbName1);

if ($conn->connect_error) {
die("Connection failed: " . $conn1->connect_error);
}
$userTable = "CREATE TABLE users(
id int AUTO_INCREMENT,
username VARCHAR(255),
pwd VARCHAR(255),
mail VARCHAR(255),
activated int DEFAULT 0,
code int,
PRIMARY KEY (id)
)";

$conn->query($userTable);

$userFiles = "CREATE TABLE filesdb(
  id int AUTO_INCREMENT,
  filename VARCHAR(255) UNIQUE,
  uploaded_on datetime NOT NULL,
  mail VARCHAR(255),
  PRIMARY KEY (id)
)";

$conn->query($userFiles);


/*
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "website";


// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE website";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully with the name newDB";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$file = fopen("databaseCreation.sql", "r") or die("Could not open sql file");
$txt_file = fread($file, filesize("databaseCreation.sql"));
$rows = explode(";", $txt_file);

foreach ($rows as $row) {
  if(!empty($row)) {
    $GLOBALS['conn']->query($row);
  }
}

fclose($file);
*/
 ?>
