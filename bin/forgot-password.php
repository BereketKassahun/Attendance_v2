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
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
      <h1 class="az-logo"> <img src="img/image.ico" width="28px" height="25px">&nbsp;<span class="mt-2" >Image Print Org.</span></h1>
        <div class="az-signin-header">

          <p>Forget Password ?</p>
          <p>Enter your email address below.</p>

          
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

          <form action="./controller/function.php" method="POST" autocomplete="" class="mt-3">
            <div class="form-group">
              <label>Email</label>
              <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="" >
            </div><!-- form-group -->

<div class="" >
            <button type="submit" name="check-email" value="Continue" class="btn btn-az-primary btn-block">Continue</button>

</div>



          </form>
        </div><!-- az-signin-header -->
       
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
    <a href="index.php" class="m-2">Back</a>


    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
 
    <script src="js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
