<?php
session_start();
if(isset($_SESSION['userId'])) {

  if (time() - $_SESSION['timestamp'] > 10000) {
    session_destroy();
    header("Location: inactivity.php");
    //exit();
  }
  else {
    $_SESSION['timestamp'] = time();
  }
}
 ?>
<style>
#nav_bar {
	list-style-type: none;
	margin: 0;
	padding: 0;
}

#nav_li {
	display: inline;
	padding-right: 30px;
}
</style>
<h1 style="text-align: center; font-size: 32px; margin-top: -8px; margin-bottom: 5px; padding: 21px;background-color: tomato;">StorageBox</h1>
<hr style="border-width: 3px; border-color: black; margin-top: -8px;">
<div class="navbar">

  <a href="index.php" <?php if ($thisPage=="home")
								echo " style=\"border-color:tomato;background-color:black;color:red;\""; ?>>Home</a>
  <div class="dropdown">
    <button class="dropbtn" <?php if ($thisPage=="text")
								echo " style=\"border-color:tomato;background-color:black;color:red;\""; ?>>Text
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a class ="drop_link" href="textupload.php">Upload</a>
      <a class ="drop_link" href="textdownload.php">Download</a>
      <a class ="drop_link" href="textviewdelete.php">View/Delete</a>
    </div>
  </div>
  <div style="margin-left: 10px;" class="dropdown">
    <button class="dropbtn" <?php if ($thisPage=="img")
								echo " style=\"border-color:tomato;background-color:black;color:red;\""; ?>>Images
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a class ="drop_link" href="imgupload.php">Upload</a>
      <a class ="drop_link" href="imgdownload.php">Download</a>
      <a class ="drop_link" href="imgviewdelete.php">View/Delete</a>
    </div>
  </div>
  <div style="margin-left: 10px;" class="dropdown">
    <button class="dropbtn" <?php if ($thisPage=="vid")
								echo " style=\"border-color:tomato;background-color:black;color:red;\""; ?>>Videos
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a class ="drop_link" href="vidupload.php">Upload</a>
      <a class ="drop_link" href="viddownload.php">Download</a>
      <a class ="drop_link" href="vidviewdelete.php">View/Delete</a>
    </div>
  </div>
  <?php
    if(isset($_SESSION['userId']) && ($thisPage != "logout")) {
      ?>
      <div style="margin-left: 10px;" class="dropdown">
        <button class="dropbtn" <?php if ($thisPage=="account")
    								echo " style=\"border-color:tomato;background-color:black;color:red;\""; ?>>My Account
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a class ="drop_link" href="myaccount.php">View Account Info</a>
          <a class ="drop_link" href="changepassword.php">Change Password</a>
        </div>
      </div>
      <?php
    }
   ?>
  <?php
  if(($thisPage == "logout") && (isset($_SESSION['userId']))) {
    ?>
    <a style="margin-left: 70%;" href="login.php">Login</a>
    <?php
  }
  elseif (isset($_SESSION['userId'])) {
    echo '<a style="margin-left: 62%;" href="logout.php">Logout</a>';
  }
  elseif (!isset($_SESSION['userId'])) {
    echo '<a style="margin-left: 70%;" href="login.php">Login</a>';
  }

    else {
      ?>
      <a style="margin-left: 62%;" href="logout.php">Logout</a>
      <?php
    }
    ?>
    <?php
    /*
    if(isset($_SESSION['userId'])) {
      //session_destroy();
      ?>
      <a style="margin-left: 75%;" href="logout.php">Logout</a>
      <?php
    }
    elseif(!isset($_SESSION['userId'])) {
      ?>

      <?php
    }
    ?>
    */ ?>

</div>


<hr style="border-width: 3px; border-color: black;">
