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
      <h1 class="az-logo"> <img src="img/image.ico" width="28px" height="25px">&nbsp;<span class="mt-2">Image Print Org.</span></h1>
      <div class="az-signin-header">
        <p>Code Verification</p>
        <p>Check Your email and Enter code.</p>


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

        <form class="mt-3"  action="controller/function.php" method="POST" autocomplete="off">
          <div class="form-group">
            <label>Veification Code</label>
            <input class="form-control" type="number" name="otp" placeholder="--  --  --  --  --  --" required>
          </div><!-- form-group -->

          <button type="submit" name="check-reset-otp" value="Submit"  class="btn btn-az-primary btn-block">Submit</button>
        </form>

      </div><!-- az-signin-header -->
    </div><!-- az-card-signin -->
  </div><!-- az-signin-wrapper -->

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/azia.js"></script>
  
</body>

</html>