<?php
include 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->

   <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <meta name="description" content="" />
  <meta name="author" content="" />
  <title></title>

  <link href="lib/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/typicons.font/typicons.css" rel="stylesheet">

  <link rel="stylesheet" href="css/azia.css">

</head>

<body class="az-body">

  <div class="az-signin-wrapper">
    <div class="az-card-signin">
    <h1 class="az-logo"> <img src="img/image.ico" width="28px" height="25px">&nbsp;<span class="mt-2" >Image Print Org.</span></h1>
      <div class="az-signin-header">
        <p>Change Password</p>
        <p>Enter Password With Confirmation below.</p>

        <?php
        if (isset($_SESSION['info'])) {
        ?>
          <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
            <?php
            echo $_SESSION['info'];
            unset($_SESSION['info']);
            ?>
          </div>
        <?php
        }
        ?>


        <form class="mt-3" action="controller/function.php" method="POST" autocomplete="off">
          <div class="form-group">
            <label>New Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter new password" required>
          </div>
          <div class="form-group">
            <label>Confirmation Password</label>
            <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
          </div>
          <button type="submit" class="btn btn-az-primary btn-block" name="change-password" value="Change">Change</button>

        </form>
      </div>
 
    </div>
  </div>

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/azia.js"></script>

  <script>
    $(function() {
      'use strict'

    });
  </script>
</body>

</html>