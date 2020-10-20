<?php
  if(isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    $GLOBALS['username1'] = $_POST['mailuid'];
    if (empty($mailuid) || empty($password)) {
      header("Location: ../index.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "SELECT * FROM users WHERE mail=?;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $mailuid);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
          $pwdCheck = password_verify($password, $row['pwd']);
          if ($pwdCheck == false) {
            header("Location: ../index.php?error=wrongpwd");
            exit();
          }
          else if ($pwdCheck == true) {
            session_start();
            $_SESSION['firstlogin'] = $row['code'];
            $_SESSION['curruserID'] = $row['username'];
            $_SESSION['activation'] = $row['activated'];
            $_SESSION['userId'] = $row['mail'];
            $_SESSION['userUid'] = $row['uidUsers'];
            $_SESSION['timestamp'] = time();

            header("Location: ../index.php?login=success");
            exit();

          }
          else {
            header("Location: ../index.php?error=wrongpwd");
            exit();
          }
        }
        else {
          header("Location: ../index.php?error=nouser");
          exit();
        }
      }
    }
  }
  else {
    header("Location: ../index.php");
    exit();
  }

 ?>
