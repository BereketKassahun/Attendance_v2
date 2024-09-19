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

    <!-- vendor css -->
    <link href="lib/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
                  <h1 class="az-logo"> <img src="img/image.ico" width="28px" height="25px">&nbsp;<span class="mt-2" >Image Print Org.</span></h1>
        <div class="az-signin-header">
          <p>Welcome back!</p>
          <p>Please sign in to continue</p>

          <?php
              if (isset($_SESSION['info'])) {
              ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php
                  echo $_SESSION['info'];
                  unset($_SESSION['info']);
                  ?>
                </div>
              <?php
              }
              ?>

          <form action="controller/function.php" method="POST" autocomplete="" class="mt-3">

            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter your email" required="" >
            </div><!-- form-group -->

            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Your password" required="">
            </div><!-- form-group -->

            <button type="submit" class="btn btn-az-primary btn-block" name="login">Sign In</button>

          </form>

        </div><!-- az-signin-header -->

        <div class="az-signin-footer">
          <label class="mt-2" ><a  href="forgot-password.php">Forgot password?</a></label>
        </div><!-- az-signin-footer -->

      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
