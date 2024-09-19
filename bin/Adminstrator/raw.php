  <?php

  error_reporting(0);

  include '../config/connection.php';

  
  $sql_schedule = "SELECT * FROM schedule where TITLE = 'workshop'";
  $workshop_schedule = sqlsrv_query($conn, $sql_schedule);
  if ($workshop_schedule === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  $workshop = sqlsrv_fetch_array($workshop_schedule, SQLSRV_FETCH_ASSOC);
  $workshop_employee = $workshop['TITLE'];
  $workshop_min_from = $workshop['mcin_s'];
  $workshop_min_to = $workshop['mcin_e'];
  $workshop_mwar_from = $workshop['mwar_s'];
  $workshop_mwar_to = $workshop['mwar_e'];
  $workshop_mrej_from = $workshop['mrej_s'];
  $workshop_mrej_to = $workshop['mrej_e'];
  $workshop_lout_from = $workshop['lout_s'];
  $workshop_lout_to = $workshop['lout_e'];
  $workshop_acin_from = $workshop['acin_s'];
  $workshop_acin_to = $workshop['acin_e'];
  $workshop_awar_from = $workshop['awar_s'];
  $workshop_awar_to = $workshop['awar_e'];
  $workshop_arej_from = $workshop['arej_s'];
  $workshop_arej_to = $workshop['arej_e'];
  $workshop_el_from = $workshop['el_s'];
  $workshop_el_to = $workshop['el_e'];
  $workshop_hl_from = $workshop['hl_s'];
  $workshop_hl_to = $workshop['hl_e'];

  //schedule Databasetable table
  $sql_schedule = "SELECT * FROM schedule where TITLE = 'office'";
  $office_schedule = sqlsrv_query($conn, $sql_schedule);
  if ($office_schedule === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  $office = sqlsrv_fetch_array($office_schedule, SQLSRV_FETCH_ASSOC);
  $office_employee = $office['TITLE'];

  $office_min_from = $office['mcin_s'];
  $office_min_to = $office['mcin_e'];
  $office_mwar_from = $office['mwar_s'];
  $office_mwar_to = $office['mwar_e'];
  $office_mrej_from = $office['mrej_s'];
  $office_mrej_to = $office['mrej_e'];
  $office_lout_from = $office['lout_s'];
  $office_lout_to = $office['lout_e'];
  $office_acin_from = $office['acin_s'];
  $office_acin_to = $office['acin_e'];
  $office_awar_from = $office['awar_s'];
  $office_awar_to = $office['awar_e'];
  $office_arej_from = $office['arej_s'];
  $office_arej_to = $office['arej_e'];
  $office_el_from = $office['el_s'];
  $office_el_to = $office['el_e'];
  $office_hl_from = $office['hl_s'];
  $office_hl_to = $office['hl_e'];

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
              <a href="" class="nav-link " id="myInput">Settings</a>
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
    </div>

    <div class="az-content az-content-dashboard">
      <div class="container-fluid">
        <div class="az-content-body">

          <div class="az-dashboard-one-title az-minus">
            <div>
              <h2 class="az-dashboard-title">Attendance Registry</h2>
              <!--  <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
              <div class="az-content-breadcrumb">
                <span>Attendance System</span>
                <span>Record</span>

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

              <div class="media">
                <div class="media-body">
                  <button class="btn-sm btn-primary" onclick="printDiv()"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                      <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                      <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg> Print</button>
                </div><!-- media-body -->
              </div><!-- media -->

              <script>
                function printDiv() {
                  var printContents = document.getElementById("mainDiv").innerHTML;
                  var originalContents = document.body.innerHTML;

                  document.body.innerHTML = printContents;
                  window.print();

                  document.body.innerHTML = originalContents;
                }
              </script>
            </div>
          </div><!-- az-dashboard-one-title -->


          <?php

          $username = "";
          $employee  = "";
          $m_c_in = "";
          $m_c_out = "";
          $a_c_in = "";
          $a_c_out = "";
          $m_o_t = "";
          $a_ot = "";
          $o_t_day = "";
          $c_in_stamp = "";
          $c_out_stamp = "";
          $mc_in_stamp = "";
          $mc_out_stamp = "";
          $ac_in_stamp = "";
          $ac_out_stamp = "";

          if (isset($_POST['Analyze_button'])) {

            $sql = "SELECT CHECKINOUT.*, USERINFO.* FROM CHECKINOUT JOIN USERINFO ON CHECKINOUT.USERID = USERINFO.USERID";
            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
              die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
              $user_title = $row['TITLE'];
              $user_id = $row['USERID'];
              $username = $row['NAME'];
              $date = $row['CHECKTIME']->format('Y-m-d');
              $time_str = $row['CHECKTIME']->format('H:i:s');
              $checkType = $row['CHECKTYPE'];

              $sql_check = "SELECT * FROM Raw WHERE userid = ? AND date = ?";
              $params = array($user_id, $date);
              $reso = sqlsrv_query($conn, $sql_check, $params);

              if ($reso === false) {
                die(print_r(sqlsrv_errors(), true));
              }

              $mc_in_stamp = null;
              $ac_in_stamp = null;
              $mc_out_stamp = null;
              $ac_out_stamp = null;

              if ($checkType == "I") {
                if ($office_employee == "office" && $time_str >= $office_min_from && $time_str <= $office_mrej_to) {
                  $mc_in_stamp = $time_str;
                } elseif ($office_employee == "office" && $time_str >= $office_acin_from && $time_str <= $office_arej_to) {
                  $ac_in_stamp = $time_str;
                } elseif ($office_employee == "workshop" && $time_str >= $workshop_min_from && $time_str <= $workshop_mrej_to) {
                  $mc_in_stamp = $time_str;
                } elseif ($office_employee == "workshop" && $time_str >= $workshop_acin_from && $time_str <= $workshop_arej_to) {
                  $ac_in_stamp = $time_str;
                }
              } elseif ($checkType == "O") {
                if ($office_employee == "office" && $time_str >= $office_min_from && $time_str <= $office_lout_to) {
                  $mc_out_stamp = $time_str;
                } elseif ($office_employee == "office" && $time_str >= $office_el_from && $time_str <= $office_hl_to) {
                  $ac_out_stamp = $time_str;
                } elseif ($office_employee == "workshop" && $time_str >= $workshop_lout_from && $time_str <= $workshop_lout_to) {
                  $mc_out_stamp = $time_str;
                } elseif ($office_employee == "workshop" && $time_str >= $workshop_el_from && $time_str <= $workshop_hl_to) {
                  $ac_out_stamp = $time_str;
                }
              }

              if (isset($mc_in_stamp)) {
                if (sqlsrv_has_rows($reso)) {
                  $sql_update = "UPDATE Raw SET m_cin = ? WHERE userid = ? AND date = ?";
                  $params = array($mc_in_stamp, $user_id, $date);
                  $reso = sqlsrv_query($conn, $sql_update, $params);
                } else {
                  $sql_insert = "INSERT INTO Raw (userid, date, m_cin) VALUES (?, ?, ?)";
                  $params = array($user_id, $date, $mc_in_stamp);
                  $reso = sqlsrv_query($conn, $sql_insert, $params);
                }

                if ($reso === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              }

              if (isset($ac_in_stamp)) {
                if (sqlsrv_has_rows($reso)) {
                  $sql_update = "UPDATE Raw SET A_c_in = ? WHERE userid = ? AND date = ?";
                  $params = array($ac_in_stamp, $user_id, $date);
                  $reso = sqlsrv_query($conn, $sql_update, $params);
                } else {
                  $sql_insert = "INSERT INTO Raw (userid, date, A_c_in) VALUES (?, ?, ?)";
                  $params = array($user_id, $date, $ac_in_stamp);
                  $reso = sqlsrv_query($conn, $sql_insert, $params);
                }

                if ($reso === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              }

              if (isset($mc_out_stamp)) {
                if (sqlsrv_has_rows($reso)) {
                  $sql_update = "UPDATE Raw SET m_c_out = ? WHERE userid = ? AND date = ?";
                  $params = array($mc_out_stamp, $user_id, $date);
                  $reso = sqlsrv_query($conn, $sql_update, $params);
                } else {
                  $sql_insert = "INSERT INTO Raw (userid, date, m_c_out) VALUES (?, ?, ?)";
                  $params = array($user_id, $date, $mc_out_stamp);
                  $reso = sqlsrv_query($conn, $sql_insert, $params);
                }

                if ($reso === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              }

              if (isset($ac_out_stamp)) {
                if (sqlsrv_has_rows($reso)) {
                  $sql_update = "UPDATE Raw SET A_c_out = ? WHERE userid = ? AND date = ?";
                  $params = array($ac_out_stamp, $user_id, $date);
                  $reso = sqlsrv_query($conn, $sql_update, $params);
                } else {
                  $sql_insert = "INSERT INTO Raw (userid, date, A_c_out) VALUES (?, ?, ?)";
                  $params = array($user_id, $date, $ac_out_stamp);
                  $reso = sqlsrv_query($conn, $sql_insert, $params);
                }

                if ($reso === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              }
            }
            // sqlsrv_free_stmt($stmt);
            
          $info = " <p class='card-title notification_session card-title-font'>Timestamp Record Merged successfully!.</p>";
          $_SESSION['Analyze_button'] = $info;
          }




          if (isset($_POST['worktime'])) {

            $sql = "SELECT userid, date, m_cin, m_c_out FROM Raw WHERE m_cin IS NOT NULL AND m_c_out IS NOT NULL AND m_w_t IS NULL";
            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
              die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
              $uid = $row['userid'];
              $date = $row['date'];
              $mcin = $row['m_cin'];
              $mcout = $row['m_c_out'];

              if ($mcin && $mcout) {
                $datetime1 = new DateTime($mcin);
                $datetime2 = new DateTime($mcout);
                $interval = $datetime1->diff($datetime2);
                $mwt = $interval->format('%H:%I:%S');

                $sql = "UPDATE Raw SET m_w_t = ? WHERE userid = ? AND date = ?";
                $params = array($mwt, $uid, $date);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              } else {
                echo "Missing morning check-in or check-out for user $uid on $date<br>";
              }
            }


            $sql = "SELECT userid, date, A_c_in, A_c_out FROM Raw WHERE A_c_in IS NOT NULL AND A_c_out IS NOT NULL AND a_w_t IS NULL";
            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
              die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
              $uid = $row['userid'];
              $date = $row['date'];
              $acin = $row['A_c_in'];
              $acout = $row['A_c_out'];

              if ($acin && $acout) {
                $datetime1 = new DateTime($acin);
                $datetime2 = new DateTime($acout);
                $interval = $datetime1->diff($datetime2);
                $awt = $interval->format('%H:%I:%S');

                $sql = "UPDATE Raw SET a_w_t = ? WHERE userid = ? AND date = ?";
                $params = array($awt, $uid, $date);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              } else {
                echo "Missing afternoon check-in or check-out for user $uid on $date<br>";
              }
            }

            // Prepare the SQL statement to select the records that need to be updated
            $sql = "SELECT userid, date, m_w_t, a_w_t, t_w_t FROM Raw WHERE (m_w_t IS NOT NULL AND a_w_t IS NOT NULL)";
            // Execute the SQL statement
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
              die(print_r(sqlsrv_errors(), true));
            }

            // Loop through the records and update the total work time
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
              // Extract the data from the row
              $uid = $row['userid'];
              $date = $row['date'];
              $mwt = $row['m_w_t'];
              $awt = $row['a_w_t'];
              $twt = $row['t_w_t'];

              // Calculate the total work time (twt)
              if ($mwt && $awt) {
                $mwt_seconds = strtotime($mwt) - strtotime('00:00:00');
                $awt_seconds = strtotime($awt) - strtotime('00:00:00');
                $total_seconds = $mwt_seconds + $awt_seconds;
                $total = gmdate('H:i:s', $total_seconds);

                // Update the database with the calculated total work time
                $sql = "UPDATE Raw SET t_w_t = ? WHERE userid = ? AND date = ?";
                $params = array($total, $uid, $date);
                $stmt2 = sqlsrv_query($conn, $sql, $params);
                if ($stmt2 === false) {
                  die(print_r(sqlsrv_errors(), true));
                }
              }
            }

            $info = " <p class='card-title notification_session card-title-font'>Worktime Calculated Successfully!.</p>";
            $_SESSION['worktime'] = $info;
          }

          






          ?>
















          <div class="row row-sm mg-b-20">
            <div class="col-lg-12 ht-lg-100p">
              <div class="card card-dashboard-one">
                <div class="btn-group">

                  <div class="card-header">
                    <div>
                      <h6 class="card-title card-title-font">Record list</h6>
                      <small class="card-text mb-2">Select From - To Date selector below <small>


                          <?php
                          if (isset($_SESSION['worktime'])) {
                          ?>

                            <div class="alert alert-success alert-dismissible" role="alert">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                              <?php
                              echo $_SESSION['worktime'];
                              unset($_SESSION['worktime']);
                              ?>

                            </div>
                          <?php
                          } else if (isset($_SESSION['Analyze_button'])) {
                          ?>

                            <div class="alert alert-success alert-dismissible" role="alert">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                              <?php
                              echo $_SESSION['Analyze_button'];
                              unset($_SESSION['Analyze_button']);
                              ?>

                            </div>



                          <?php
                          }

                          ?>


                          <form method="post" action="#" class="d-flex justify-content-start align-items-center mt-2">
                            <input type="date" name="from_date" value="<?php if (isset($_POST['from_date'])) {
                                                                          echo $_POST['from_date'];
                                                                        } ?>" class="form-control-sm ">&nbsp;&nbsp;
                            <input type="date" name="to_date" value="<?php if (isset($_POST['to_date'])) {
                                                                        echo $_POST['to_date'];
                                                                      } ?>" class="form-control-sm ">&nbsp;
                            <?php
                            $sql = "SELECT USERID, NAME FROM USERINFO";
                            $stmt = sqlsrv_query($conn, $sql);
                            echo '<select class="form-select form-control-sm " name="user" id="agent">';
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                              echo '<option value="' . htmlspecialchars($row['USERID']) . '">';
                              echo htmlspecialchars($row['NAME']);
                              echo '</option>';
                            }
                            echo '</select>';
                            ?>
                            &nbsp;
                            <input type="submit" class="btn-sm btn-primary" name="Analyze_button" value="Merge">&nbsp;
                            <input type="submit" class="btn-sm btn-primary" name="worktime" value="Calculate Worktime">&nbsp;
                            <button name="filter" type="submit" class="btn-sm btn-primary">&nbsp;List&nbsp;</button>&nbsp;&nbsp;

                          </form>
                    </div>
                  </div>
                  <div>
                  </div>
                </div><!-- card-header -->

                <div id="mainDiv" class="table-wrapper m-2">
                  <table>
                    <tbody>

                      <?php

                      if (isset($_POST['filter'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $employee_id = $_POST['user'];

                        $sql = "SELECT NAME,TITLE,PAGER,GENDER,BADGENUMBER,profile FROM USERINFO WHERE USERID = $employee_id";

                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                          die(print_r(sqlsrv_errors(), true));
                        }
                        $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)
                      ?>

                        <?php


                        //holiday_ot
                        $holi_query = "SELECT * FROM Raw WHERE userid = $employee_id AND date BETWEEN '$from_date' AND '$to_date'";
                        $res = sqlsrv_query($conn, $holi_query);
                        if (sqlsrv_has_rows($res)) {

                          $Total_worktime_all = 0;
                          $morning_only = 0;
                          $afternoon_only = 0;
                          $acout_total = 0;
                          $total_time_formatted_row = 0;

                          //sun_ot
                          $sun_Total_worktime_all = 0;
                          $sun_morning_only = 0;
                          $sun_afternoon_only = 0;
                          $sun_total_time_formatted_row = 0;
                          //holi
                          $holi_Total_worktime_all = 0;
                          $holi_morning_only = 0;
                          $holi_afternoon_only = 0;
                          $holi_total_time_formatted_row = 0;

                          //ot_early
                          $ot_early_time_formatted_row = 0;
                          //ot_night
                          $ot_night_time_formatted_row = 0;

                          while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {

                            $morning = $row['M_w_t'];
                            $afternoon = $row['A_w_t'];
                            $Total_worktime = $row['T_w_t'];

                            //morning_only 
                            if ($morning != null && $afternoon == null) {
                              $morning_only += strtotime($morning) - strtotime('00:00:00');
                            }
                            //afternoon_only
                            elseif ($afternoon != null && $morning == null) {
                              $afternoon_only += strtotime($afternoon) - strtotime('00:00:00');
                            }
                            //twt                  
                            if ($Total_worktime != null) {
                              $Total_worktime_all += strtotime($Total_worktime) - strtotime('00:00:00');
                              $total_hours_row = floor($Total_worktime_all / 3600);
                              $total_minutes_row = floor(($Total_worktime_all / 60) % 60);
                              $total_seconds_row = $Total_worktime_all % 60;
                              $total_time_formatted_row = sprintf('%02d:%02d:%02d', $total_hours_row, $total_minutes_row, $total_seconds_row);
                            }
                          }

                          $morning_total_formatted = sprintf('%02d:%02d:%02d', floor($morning_only / 3600), floor(($morning_only / 60) % 60), $morning_only % 60);
                          $afternoon_total_formatted = sprintf('%02d:%02d:%02d', floor($afternoon_only / 3600), floor(($afternoon_only / 60) % 60), $afternoon_only % 60);

                          $eveningArray = explode(':', $total_time_formatted_row);
                          $evening_hours_row = (int) $eveningArray[0];
                          $evening_minutes_row = (int) $eveningArray[1];
                          $evening_seconds_row = (int) $eveningArray[2];
                          $evening_worktime_all = $evening_hours_row * 3600 + $evening_minutes_row * 60 + $evening_seconds_row;

                          $totalSeconds = $morning_only + $afternoon_only + $evening_worktime_all;
                          $totalTime = sprintf('%02d:%02d:%02d', floor($totalSeconds / 3600), floor(($totalSeconds / 60) % 60), $totalSeconds % 60);
                        ?>
                          <div class="col-4 col-margin mt-1">
                            <button type="button" class="mb-1 btn-sm btn-primary  ">
                              <?php $username = $result["NAME"]; ?>
                              <?php echo $username; ?> <span class="badge badge-light"> Report: <?php echo $from_date . "  to  " . $to_date ?> </span> </button>
                            <div class="az-list-item">
                              <div>
                                <h6>Regular Attendance</h6>
                                <span>Morning Only Time Attendance </span><br>
                                <span>Afternoon Only Time Attendance </span><br>
                                <span>Total Daily Attendace </span><br><br>
                                <?php echo '<span  ><mark>Total : ' . $totalTime . ' hours  </mark></span><br> '; ?>
                              </div>
                              <div>
                                <h6 class="tx-primary">&nbsp;</h6>
                                <span><?php echo $morning_total_formatted; ?></span><br>
                                <span><?php echo $afternoon_total_formatted; ?></span><br>
                                <span><?php echo $total_time_formatted_row; ?></span><br>
                                <span>&nbsp;</span><br>
                              </div>
                            </div><!-- list-group-item -->

                          </div>

                          </small>
                        <?php
                        }

                        ?>
                        <style>
                          .notification_session {

                            color: #856404;
                            background-color: #fff3cd;
                            border-color: #ffeeba;
                            padding: 10px 10px;
                          }

                          .col-margin {
                            margin: -5px 0px 10px -10px;
                          }

                          .sub {
                            font-size: 12px;
                          }

                          table {
                            width: 100%;
                            border-collapse: collapse;
                          }

                          th,
                          td {
                            padding: 8px;
                            text-align: left;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          }

                          th:first-child,
                          td:first-child {
                            width: 15%;
                          }

                          th:nth-child(2),
                          td:nth-child(2),
                          th:nth-child(3),
                          td:nth-child(3),
                          th:nth-child(4),
                          td:nth-child(4) {
                            width: 10%;
                          }

                          th:nth-child(5),
                          td:nth-child(5),
                          th:nth-child(6),
                          td:nth-child(6),
                          th:nth-child(7),
                          td:nth-child(7) {
                            width: 15%;
                          }

                          th:nth-child(8),
                          td:nth-child(8),
                          th:nth-child(9),
                          td:nth-child(9),
                          th:nth-child(10),
                          td:nth-child(10) {
                            width: 10%;
                          }
                        </style>

                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Morning-in</th>
                            <th>Lunch-out</th>

                            <th>Afternoon-in</th>
                            <th>Home leave-out</th>


                            <th>Mor.Work Time</th>
                            <th>Aft.Work Time</th>
                            <th>Total Work Time</th>
                          </tr>
                        </thead>

                      <?php
                        // Query the database
                        $sql = "SELECT * FROM Raw WHERE userid = $employee_id AND date BETWEEN '$from_date' AND '$to_date'";
                        $resut = sqlsrv_query($conn, $sql);
                        if (sqlsrv_has_rows($resut)) {

                          // Initialize variables to store the total work time for each user
                          $Total_worktime_all = 0;
                          $morning_only = 0;
                          $afternoon_only = 0;
                          $acout_total = 0;
                          $total_time_formatted_row = 0;

                          while ($row = sqlsrv_fetch_array($resut, SQLSRV_FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";

                            if ($row['m_cin'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['m_cin'] . "</td>";
                            }
                            if ($row['m_c_out'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['m_c_out'] . "</td>";
                            }
                            if ($row['A_c_in'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['A_c_in'] . "</td>";
                            }
                            if ($row['A_c_out'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['A_c_out'] . "</td>";
                            }
                            if ($row['M_w_t'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['M_w_t'] . "</td>";
                            }
                            if ($row['A_w_t'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['A_w_t'] . "</td>";
                            }
                            if ($row['T_w_t'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['T_w_t'] . "</td>";
                            }

                            echo "</tr>";
                          }
                          echo "</table>";
                        }

                        echo " <br>";
                      } else {
                        echo "No Record Found";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>


                <style>
                  .table-wrapper {
                    overflow-x: hidden;
                  }

                  table {
                    width: 100%;
                    border-collapse: collapse;
                    white-space: nowrap;
                  }

                  th,
                  td {
                    padding: 2px 10px;
                    text-align: left;
                    border: 1px solid #ddd;
                    font-size: 14px;
                    font-weight: 400;
                  }

                  th {
                    background-color: #f2f2f2;
                  }

                  #dock-window {
                    position: fixed;
                    bottom: 0;
                    right: 0;
                    background-color: #f2f2f2;
                    border: 1px solid #ccc;
                    padding: 10px;
                    width: 300px;
                    height: 200px;
                    display: none;
                  }

                  #dock-window-header {
                    background-color: #ddd;
                    padding: 5px;
                    cursor: move;
                  }

                  #dock-window-content {
                    height: 150px;
                    /*	overflow: auto; */
                  }

                  #dock-window-close {
                    position: absolute;
                    top: 13px;
                    right: 15px;
                    cursor: pointer;
                  }

                  .in-control {
                    display: block;
                    width: 90%;
                    padding: 5px 10px;
                    font-size: 12px;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #212529;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
                    border-radius: 0.375rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                  }
                </style>
                <!-- card-body -->
              </div><!-- card -->
            </div><!-- col -->
          </div>
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

    <?php include "../include/footer.php"  ?>







    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.resize.js"></script>

    <script src="../js/azia.js"></script>

  </body>

  </html>