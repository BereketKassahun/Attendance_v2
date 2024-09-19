<?php

error_reporting(0);


include 'function.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    $sql = "SELECT USERID,NAME,PAGER,email,TITLE,Salary FROM USERINFO WHERE USERID=$id";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $usr_name = $row['NAME'];
    $usr_type = $row['TITLE'];
    $usr_phone = $row['PAGER'];
    $usr_email = $row['email'];
    $usr_salary = $row['Salary'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Required meta tags -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">


</head>

<body>
    <div class="az-header">
        <div class="container-fluid">
            <div class="az-header-left">
                <img src="../img/image.ico" width="32px" height="30px">
                <a href="index.html" class="az-logo"><span></span>&nbsp;Image Print Org.</a>
                <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
            </div><!-- az-header-left -->
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="index.php" class="az-logo"><span></span> </a>
                    <a href="" class="close">&times;</a>
                </div><!-- az-header-menu-header -->
                <ul class="nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="Report.php" class="nav-link">Attendance Report</a>
                    </li>
                    <li class="nav-item">
                        <a href="raw.php" class="nav-link">Record</a>
                    </li>
                    <li class="nav-item">
                        <a href="update.php" class="nav-link ">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="" id="myInput" class="nav-link ">Settings</a>
                    </li>
                    <script>
                        const myInput = document.getElementById("myInput");
                        myInput.style.setProperty("cursor", "no-drop", "important");
                    </script>
                </ul>
            </div><!-- az-header-menu -->

            <div class="az-header-right">
                <button type="submit" onclick="<?php echo 'window.location.href = \'../logout.php\''; ?>" value="Continue" class="btn  btn-outline-primary">Logout</button>
            </div><!-- az-header-right -->
        </div><!-- container -->
    </div><!-- az-header -->


    <div class="az-content az-content-dashboard">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">User Management</h2>
                        <!--  <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
                        <div class="az-content-breadcrumb">
                            <span>Attendance System</span>
                            <span>users</span>
                        </div>
                    </div>

                    <script>
                        window.onload = function() {
                            function dateTime() {
                                var date = new Date();
                                document.getElementById("clock").innerText = date.toLocaleTimeString(
                                    'en-US', {
                                        hour12: false
                                    })
                            };
                            setInterval(dateTime, 1000);
                        };
                    </script>

                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                                <label>Day</label>
                                <h6> <?php
                                        $Today = date('y:m:d');
                                        $new = date('l', strtotime($Today));
                                        echo $new ?>
                                </h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>Time</label>
                                <h6><span id="clock"></span></h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>Event [YY:MM:DD]</label>
                                <h6><?php
                                    $Today = date('y:m:d');
                                    $ymd =  date('F d, Y', strtotime($Today));
                                    echo $ymd ?>
                                </h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div>
                </div>
                <section class="section dashboard">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card card-dashboard-one">
                                <div class="card-body" id="tableContainer">
                                    <div class="card-header">
                                        <div>
                                            <p class="card-title"></p>
                                            <div class="btn-group">
                                                <div>
                                                    <h6 class="card-title">Employee List</h6>
                                                    <small class="card-text">employee information and Wage update</small>


                                                    <?php
                                                    if (isset($_SESSION['delete'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                            <?php
                                                            echo $_SESSION['delete'];
                                                            unset($_SESSION['delete']);
                                                            ?>

                                                        </div>
                                                    <?php
                                                    } else if (isset($_SESSION['update_'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                            <?php
                                                            echo $_SESSION['update_'];
                                                            unset($_SESSION['update_']);
                                                            ?>

                                                        </div>
                                                    <?php
                                                    } else if (isset($_SESSION['holiday'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                            <?php
                                                            echo $_SESSION['holiday'];
                                                            unset($_SESSION['holiday']);
                                                            ?>

                                                        </div>
                                                    <?php
                                                    } else if (isset($_SESSION['leave'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                            <?php
                                                            echo $_SESSION['leave'];
                                                            unset($_SESSION['leave']);
                                                            ?>

                                                        </div>
                                                    <?php
                                                    } else if (isset($_SESSION['forget_inout'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                                            <?php
                                                            echo $_SESSION['forget_inout'];
                                                            unset($_SESSION['forget_inout']);
                                                            ?>

                                                        </div>
                                                    <?php
                                                    }
                                                    ?>



                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- card-header -->

                                    <div class="table-responsive" id="dataTable">
                                        <style>
                                            #tableContainer {
                                                height: 450px;
                                                /* Set the desired height */
                                                overflow: auto;
                                                /* Add overflow to enable scrolling */
                                            }
                                        </style>

                                        <table class="table dataTable table-hover mg-b-0" id="datatable" data-toggle="data-table" aria-describedby="datatable_info">
                                            <thead>
                                                <tr>
                                                    <th class="  font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending">ID</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Edit</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Delete</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Name</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">UserID</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Phone</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">BadgeNumber</th>
                                                    <th class="font-weight-light c-font" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">User Type</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Prepare and execute SQL query
                                                $sql = "SELECT USERID,NAME,TITLE,PAGER,GENDER,BADGENUMBER,profile FROM USERINFO";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if ($stmt === false) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                $i = 1;
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <h7 class="text-muted "> <?php echo $i; ?></h7>
                                                        </td>
                                                        <td>
                                                            <a href="update.php?edit=<?php echo $row["USERID"]; ?>" class="btn-sm btn-secondary ">Edit</a>
                                                        </td>
                                                        <td>
                                                            <a href="./function.php?delete_customer=<?php echo $row["USERID"]; ?>" class="btn-sm  btn-danger">Delete</a>
                                                        </td>

                                                        <td>
                                                            <h7 class="text-muted"><?php echo $row['NAME']; ?></h7>
                                                        </td>

                                                        <td>
                                                            <h7 class="text-muted"><?php echo "I.P-" . $row['USERID']; ?></h7>
                                                        </td>
                                                        <td>
                                                            <h7 class="text-muted"><?php echo $row['PAGER']; ?></h7>
                                                        </td>
                                                        <td>
                                                            <h7 class="text-muted "><?php echo $row['BADGENUMBER']; ?></h7>
                                                        </td>
                                                        <td>
                                                            <h7 class="text-muted "><?php echo $row['TITLE']; ?></h7>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div>

                        <div class="col-lg-3 mt-3">
                            <div class="form-upload_wrapper ">
                                <div class="d-flex justify-content-start">
                                    <button class="btn-sm btn-primary active mr-2" data-tab="office">Users</button>
                                    <button class="btn-sm btn-primary" data-tab="workshop">Forget cin/cout</button> &nbsp;
                                    <button class="btn-sm btn-primary" data-tab="custom">Leave</button> &nbsp;
                                    <button class="btn-sm btn-primary" data-tab="holiday">Holiday</button> &nbsp;
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-tab">

                                        <style>
                                            #Input {
                                                pointer-events: none;
                                                cursor: no-drop !important;
                                            }

                                            .profile_set {
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;
                                                border-radius: 50%;
                                            }

                                            .user-profile {
                                                width: 40px;
                                                height: 40px;
                                                border-radius: 50%;
                                                object-fit: cover;
                                            }

                                            #updateBtn {
                                                color: #fff;
                                                cursor: pointer;
                                            }

                                            #updateBtn.success {
                                                background-color: #28a745;
                                            }
                                        </style>

                                        <?php
                                        if (isset($_SESSION['Password'])) {
                                        ?>
                                            <!--  alert  -->
                                            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                                                <?php
                                                echo $_SESSION['Password'];
                                                unset($_SESSION['Password']);
                                                ?>
                                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <small class="mt-1 form-detail text-primary">User Authorization.</small>
                                        <!--user update with profile-->
                                        <form action="./function.php" method="POST" enctype="multipart/form-data" autocomplete="">

                                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                                            <div class="m-1">
                                                <small for="username">User name</small>
                                                <input class="form-control adjuster" id="Input" type="text" placeholder="Enter User Name" value="<?php echo $usr_name; ?>" required>
                                            </div>
                                            <div class="m-1">
                                                <small for="username">Phone</small>
                                                <input class="form-control adjuster" type="number" name="usr_phone" placeholder="Enter Phone Number" value="<?php echo $usr_phone; ?>">
                                            </div>
                                            <div class="m-1">
                                                <small for="username">Email</small>
                                                <input class="form-control adjuster" type="email" name="usr_email" placeholder="Enter Email" value="<?php echo $usr_email; ?>">
                                            </div>

                                            <!--
                                            <div class="m-1">
                                                <small for="username">Salary</small>
                                                <input class="form-control adjuster" type="number" name="usr_salary" placeholder="Enter Salary" value="<?php echo $usr_salary; ?>">
                                            </div>
                                            -->

                                            <div class="m-1">
                                                <small for="password">User type</small><br>
                                                <select class="form-control adjuster" name="user_type" aria-label="Default select example">
                                                    <option value="office">office</option>
                                                    <option value="workshop">workshop</option>
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <button type="submit" name="update_customer" value="Signup" class="btn-sm btn-secondary mt-2">Update Data</button>
                                            </div>
                                            <style>
                                                .adjuster {
                                                    height: 30px;
                                                    margin-right: 8px;
                                                    width: 96%;
                                                }

                                                .password-input {
                                                    padding: 5px;
                                                    border: 1px solid #ccc;
                                                    border-radius: 4px;
                                                    height: 30px;
                                                }

                                                .password-toggle {
                                                    padding: 5px;
                                                    cursor: pointer;
                                                }
                                            </style>
                                            <script>
                                                function togglePasswordVisibility() {
                                                    var passwordInput = document.getElementById("password-input");
                                                    var passwordToggle = document.getElementById("password-toggle");

                                                    if (passwordInput.type === "password") {
                                                        passwordInput.type = "text";
                                                        passwordToggle.classList.remove("fa-eye");
                                                        passwordToggle.classList.add("fa-eye-slash");
                                                    } else {
                                                        passwordInput.type = "password";
                                                        passwordToggle.classList.remove("fa-eye-slash");
                                                        passwordToggle.classList.add("fa-eye");
                                                    }
                                                }
                                            </script>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="workshop" role="tabpanel" aria-labelledby="workshop-tab">
                                        <small class="mt-1 form-detail text-primary">Forget to clock in/out User Data.</small>
                                        <form action="./function.php" method="POST" autocomplete="">
                                            <div class="m-1">
                                                <small>User name</small>
                                                <?php
                                                $sql = "SELECT USERID, NAME FROM USERINFO";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                echo '<select class="form-control adjuster" name="user" id="agent">';
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                    echo '<option value="' . htmlspecialchars($row['USERID']) . '">';
                                                    echo htmlspecialchars($row['NAME']);
                                                    echo '</option>';
                                                }
                                                echo '</select>';
                                                ?>
                                            </div>
                                            <div class="m-1">
                                                <small for="password">Select State type</small>
                                                <select class="form-control adjuster" name="clock_type" aria-label="Default select example">
                                                    <option value="I">Clock-in</option>
                                                    <option value="O">Clock-out</option>
                                                </select>
                                            </div>
                                            <div class="m-1">
                                                <small for="datetime">Date and Time (YYYY-MM-DD HH:MM:SS):</small>
                                                <input class="form-control" type="text" id="my_datetime" name="my_datetime" placeholder="YYYY-MM-DD HH:MM:SS" pattern="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}" required>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="forget" value="Signup" class="btn-sm btn-secondary mt-2">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                                        <small class="mt-1 form-detail text-primary">Leave Ticker </small>
                                        <form action="./function.php" method="POST">
                                            <div class="m-1">
                                                <small>User name</small><br>
                                                <?php
                                                $sql = "SELECT USERID, NAME,TITLE FROM USERINFO";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                echo '<select class="form-control adjuster" name="user" id="agent">';
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                    echo '<option value="' . htmlspecialchars($row['USERID']) . '">';
                                                    echo htmlspecialchars($row['NAME']);
                                                    echo '</option>';
                                                }
                                                echo '</select>';
                                                ?>
                                            </div>
                                            <input type="hidden" name="user_type" value="<?php $user_type ?>">
                                            <div class="m-1">
                                                <small for="from_date">From Date</small><br>
                                                <input class="form-control adjuster" type="date" name="from_date" id="from_date">
                                            </div>
                                            <div class="m-1">
                                                <small for="to_date">To Date</small><br>
                                                <input class="form-control adjuster" type="date" name="to_date" id="to_date">
                                            </div>
                                            <div class="">
                                                <button type="submit" name="leave" value="Signup" class="btn-sm btn-secondary">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="holiday" role="tabpanel" aria-labelledby="custom-tab">
                                        <small class="mt-1 form-detail text-primary">Holiday Ticker </small>
                                        <form action="./function.php" method="POST">

                                            <div class="m-1">
                                                <small for="to_date">Select Date</small>
                                                <input class="form-control adjuster" type="date" name="date" required>
                                            </div>

                                            <div class="m-1">
                                                <small for="to_date">Holiday name</small>
                                                <input class="form-control adjuster" type="text" name="name" required>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="h_ticker" value="Signup" class="btn-sm btn-secondary mt-2">Submit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
                                const buttons = document.querySelectorAll('[data-tab]');
                                const tabContent = document.querySelectorAll('.tab-pane');

                                buttons.forEach((button) => {
                                    button.addEventListener('click', () => {
                                        const tabName = button.dataset.tab;
                                        buttons.forEach(btn => btn.classList.remove('active'));
                                        button.classList.add('active');
                                        tabContent.forEach(tab => {
                                            if (tab.getAttribute('id') === tabName) {
                                                tab.classList.add('show', 'active');
                                            } else {
                                                tab.classList.remove('show', 'active');
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </section>
                <style>
                    .btnsize {

                        padding: 0px 8px;

                    }
                </style>
            </div><!-- az-content-body -->
        </div>
    </div><!-- az-content -->

    <?php include "../include/footer.php"  ?>

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.resize.js"></script>

    <script src="../js/azia.js"></script>

</body>

</html>