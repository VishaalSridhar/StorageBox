  <!DOCTYPE html>
<?php $thisPage="signup"; ?>
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

  <main>
    <div style="text-align: center;">
    <h1>Sign Up</h1>
    <?php

      if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
          echo '<p style="text-align: center; color: red;">Fill in all the fields!</p>';
        }
        else if ($_GET['error'] == "invalidmailuid") {
            echo '<p style="text-align: center; color: red;">Invalid username or e-mail!</p>';
        }
        else if ($_GET['error'] == "invalidmail") {
            echo '<p style="text-align: center; color: red;">Invalid e-mail!</p>';
        }
        else if ($_GET['error'] == "invaliduid") {
            echo '<p style="text-align: center; color: red;">Invalid username!</p>';
        }
        else if ($_GET['error'] == "passwordcheck") {
            echo '<p style="text-align: center; color: red;">Your passwords do not match!</p>';
        }
        else if ($_GET['error'] == "usertaken") {
            echo '<p style="text-align: center; color: red;">Username already taken!</p>';
        }
      }
      else if (isset($_GET['signup']) == "success") {
        echo '<p style="text-align: center; color: red;">Sign up Successful! Please login to get your activation code!</p>';
      }

     ?>
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="uid" placeholder="Username"><br>
      <input type="text" name="mail" placeholder="E-mail"><br>
      <input type="password" name="pwd" placeholder="Password"><br>
      <input type="password" name="pwd-repeat" placeholder="Repeat Password"><br>
      <button type="submit" name="signup-submit">Sign Up</button>
    </form>
  </div>
  </main>

<footer style="position: fixed; bottom: 0; left: 8px; width: 100%; text-align: center; background-color: blue; color: yellow;">
<?php include('templateFooter.php'); ?>
</footer>
</body>
</html>
