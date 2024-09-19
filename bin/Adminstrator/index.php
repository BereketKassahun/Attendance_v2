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
        <title>Home</title>
        <!-- vendor css -->
        <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
        <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
        <!-- azia CSS -->
        <link rel="stylesheet" href="../css/azia.css">
        <link rel="stylesheet" href="../css/tab.css">
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
                  <a href="" id="myInput" class="nav-link">Settings</a>
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

              <div class="az-dashboard-one-title">
                <div>
                  <h2 class="az-dashboard-title">Hi <?php echo $_SESSION['name'] ?> , welcome back!</h2>
                  <!--  <p class="az-dashboard-text">Your web analytics dashboard template.</p> -->
                  <div class="az-content-breadcrumb">
                    <span>Attendance System</span>
                    <span>Home</span>

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
              </div><!-- az-dashboard-one-title -->


              <div class="row row-sm mg-b-20">
                <div class="col-lg-8 ht-lg-100p">
                  <div class="card card-dashboard-one">
                    <div class="card-header">
                      <div>
                        <h6 class="card-title">Biometrics Attendance Metrics</h6>
                        <small class="card-text">Users time-stamp Record.</small>
                      </div>
                      <div class="btn-group">
                        <form method="post" action="#" class="d-flex justify-content-start align-items-center">
                          <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" class="form-cont form-control-sm ">&nbsp;
                          <button type="submit" class="btn">List</button>&nbsp;
                          <button type="submit" name="all" value="all" class="btn ">All Data</button>&nbsp;
                          <button type="submit" name="all" value="all" class="btn btn-primary ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                            </svg> Refresh
                          </button>

                        </form>

                      </div>
                    </div><!-- card-header -->



                    <div class="card-body">
                      <section class=" mx-2 ">
                        <div class="row">
                          <br>

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

                          $date = date('Y-m-d');
                          if (isset($_POST['date'])) {
                            $date = $_POST['date'];
                          }
                          $sql = "SELECT CHECKINOUT.*, USERINFO.* FROM CHECKINOUT JOIN USERINFO ON CHECKINOUT.USERID = USERINFO.USERID ";
                          if (isset($_POST['all'])) {
                          } else {
                            $sql .= " WHERE CONVERT(date, checktime) = ?";
                          }
                          $params = array($date);
                          $stmt = sqlsrv_prepare($conn, $sql, $params);
                          if (!$stmt) {
                            die(print_r(sqlsrv_errors(), true));
                          }
                          $result = sqlsrv_execute($stmt);
                          if (!$result) {
                            die(print_r(sqlsrv_errors(), true));
                          }

                          if (sqlsrv_has_rows($stmt)) {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                          ?>
                              <div class="col-md-3 attendance-card">
                                <div class="card p-3 mb-2">
                                  <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                      <div class="icon"> <i class="bx bxl-dribbble"></i> </div>
                                      <div class="c-details">
                                        <span class="mb-1 fw-light "> <?php echo  $row['NAME']; ?> </span>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="m-0">
                                    <span class="text1">
                                      <?php
                                      $user_title = $row['TITLE'];
                                      $user_id = $row['USERID'];
                                      $username = $row['NAME'];

                                      $date = $row['CHECKTIME'];
                                      $date_str = $date->format('Y-m-d H:i:s');
                                      $datetime = $date_str;
                                      $datetimeArr = explode(" ", $datetime);
                                      $date = $datetimeArr[0];
                                      $time_str = $datetimeArr[1];

                                      //ot_variable
                                      $early_ot = "16:00:00";
                                      $late_ot = "23:59:00";
                                      $checkType = $row['CHECKTYPE'];


                                      $sql_select_holidays = "SELECT holiday, holiday_name FROM Holiday";
                                      $res_holidays = sqlsrv_query($conn, $sql_select_holidays);

                                      $holidays = array();
                                      $holidays_name = array();
                                      while ($row = sqlsrv_fetch_array($res_holidays)) {
                                        $holidays[] = $row['holiday'];
                                        $holidays_name[] = $row['holiday_name'];
                                      }

                                      foreach ($holidays as $index => $holiday) {
                                        $current_holiday_name = $holidays_name[$index];
                                        $sql_update_attendance = "UPDATE cAttendance SET holiday = 1, holiday_name = '$current_holiday_name' WHERE date = ?";
                                        $params = array($holiday);
                                        $res_update_attendance = sqlsrv_query($conn, $sql_update_attendance, $params);
                                      }


                                      $sql_check = "SELECT * FROM cAttendance WHERE userid = ? AND date = ?";
                                      $params = array($user_id, $date);
                                      $reso = sqlsrv_query($conn, $sql_check, $params);

                                      if ($reso === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                      }

                                      $holi_fetcher = sqlsrv_fetch_array($reso, SQLSRV_FETCH_ASSOC);


                                      if ($holi_fetcher !== null) {
                                        $date_ck = $holi_fetcher['date'];
                                        $holi_fetcher_date = $holi_fetcher['holiday'];
                                        $acin_chk = $holi_fetcher['A_c_in'];
                                      } else {
                                        $date_ck = null;
                                        $holi_fetcher_date = null;
                                      }
                                      if ($holi_fetcher_date == 1) {
                                        $sql_holidays = "SELECT holiday_name FROM Holiday WHERE holiday = ?";
                                        $params_holidays = array($date_ck);
                                        $date_holidays = sqlsrv_query($conn, $sql_holidays, $params_holidays);

                                        if ($date_holidays === false) {
                                          die(print_r(sqlsrv_errors(), true));
                                        }

                                        $dt_pic = sqlsrv_fetch_array($date_holidays);
                                        $ho_days = $dt_pic['holiday_name'];

                                        echo '<span class="badge badge-primary">' . $ho_days . '</span> &nbsp; <br>';
                                      }


                                      $day = date('l', strtotime($date_str));
                                      if ($day == "Sunday") {
                                        echo '<span class="badge badge-primary">sunday</span> &nbsp; <br>';
                                        $o_t_day = "Sunday";
                                        $ot_day = "1";

                                        //check-in office
                                        if ($checkType == "I" && $office_employee == "office") {
                                          echo '<a class="badge badge-secondary">check in</a> ';
                                          if ($time_str >= $office_min_from  && $time_str <= $office_mwar_to) {
                                            $mc_in_stamp = $time_str;

                                            if (isset($mc_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, m_cin = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $office_min_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_cin , ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $office_min_to, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_acin_from && $time_str <= $office_awar_to) {
                                            $ac_in_stamp = $time_str;
                                            if (isset($ac_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, A_c_in = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $office_acin_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_in ,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $office_acin_to, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                          //reject
                                          elseif ($time_str >= $office_mrej_from && $time_str <= $office_mrej_to) {
                                            $mrej_stamp = $time_str;
                                            if (isset($mrej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, M_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $mrej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, M_reject, ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $mrej_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_arej_from && $time_str <= $office_arej_to) {
                                            $arej_stamp = $time_str;

                                            if (isset($arej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, A_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $arej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_reject,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $arej_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }

                                        //checkout office             
                                        elseif ($checkType == "O" && $office_employee == "office") {
                                          echo '<a class="badge badge-secondary">check out</a> ';
                                          if ($time_str >= $office_lout_from && $time_str <= $office_lout_to) {
                                            $mc_out_stamp = $time_str;
                                            if (isset($mc_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, m_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $office_lout_from, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_c_out,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $office_lout_from, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_el_from && $time_str <= $office_hl_to) {
                                            $ac_out_stamp = $time_str;
                                            if (isset($ac_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, A_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $ac_out_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_out,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $ac_out_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }

                                        //check-in workshop
                                        elseif ($checkType == "I" && $office_employee == "workshop") {
                                          echo '<a class="badge badge-success">check in</a> ';
                                          if ($time_str >= $workshop_min_from  && $time_str <= $workshop_mwar_to) {
                                            $mc_in_stamp = $time_str;
                                            if (isset($mc_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, m_cin = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $workshop_min_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_cin,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $workshop_min_to, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_acin_from && $time_str <= $workshop_awar_to) {
                                            $ac_in_stamp = $time_str;
                                            if (isset($ac_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=? A_c_in = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $workshop_acin_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_in,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $workshop_acin_to, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_mrej_from && $time_str <= $workshop_mrej_to) {
                                            $mrej_stamp = $time_str;

                                            if (isset($mrej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, M_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $mrej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, M_reject,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $mrej_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_arej_from && $time_str <= $workshop_arej_to) {
                                            $arej_stamp = $time_str;

                                            if (isset($arej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, A_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $arej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_reject,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $arej_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }

                                        //checkout workshop
                                        elseif ($checkType == "O" && $workshop_employee == "workshop") {
                                          echo '<a class="badge badge-warning">check out</a> ';
                                          if ($time_str >= $workshop_lout_from && $time_str <= $workshop_lout_to) {
                                            $mc_out_stamp = $time_str;
                                            if (isset($mc_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, m_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $workshop_lout_from, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_c_out,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $workshop_lout_from, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_el_from && $time_str <= $workshop_hl_to) {
                                            $ac_out_stamp = $time_str;
                                            if (isset($ac_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET ot_day=?, A_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ot_day, $ac_out_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_out,ot_day) VALUES (?, ?, ?,?)";
                                                $params = array($user_id, $date, $ac_out_stamp, $ot_day);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        } else {
                                          echo '<a class="badge badge-danger">user click unknown button</a> ';
                                        }
                                      } else {
                                        $o_t_day = "";
                                        //check-in office
                                        if ($checkType == "I" && $office_employee == "office") {
                                          echo '<a class="badge badge-secondary">check in</a> ';
                                          if ($time_str >= $office_min_from  && $time_str <= $office_mwar_to) {
                                            $mc_in_stamp = $time_str;
                                            if (isset($mc_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET m_cin = ? WHERE userid = ? AND date = ?";
                                                $params = array($office_min_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_cin) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $office_min_to);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_acin_from && $time_str <= $office_awar_to) {
                                            $ac_in_stamp = $time_str;
                                            if (isset($ac_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_c_in = ? WHERE userid = ? AND date = ?";
                                                $params = array($office_acin_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_in) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $office_acin_to);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                          //reject
                                          elseif ($time_str >= $office_mrej_from && $time_str <= $office_mrej_to) {
                                            $mrej_stamp = $time_str;

                                            if (isset($mrej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET M_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($mrej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, M_reject) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $mrej_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_arej_from && $time_str <= $office_arej_to) {
                                            $arej_stamp = $time_str;

                                            if (isset($arej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($arej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_reject) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $arej_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }
                                        //check-in workshop
                                        elseif ($checkType == "I" && $office_employee == "workshop") {
                                          echo '<a class="badge badge-success">check in</a> ';
                                          if ($time_str >= $workshop_min_from  && $time_str <= $workshop_mwar_to) {
                                            $mc_in_stamp = $time_str;

                                            if (isset($mc_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET m_cin = ? WHERE userid = ? AND date = ?";
                                                $params = array($workshop_min_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_cin) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $workshop_min_to);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_acin_from && $time_str <= $workshop_awar_to) {
                                            $ac_in_stamp = $time_str;
                                            if (isset($ac_in_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_c_in = ? WHERE userid = ? AND date = ?";
                                                $params = array($workshop_acin_to, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_in) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $workshop_acin_to);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_mrej_from && $time_str <= $workshop_mrej_to) {
                                            $mrej_stamp = $time_str;

                                            if (isset($mrej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET M_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($mrej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, M_reject) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $mrej_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_arej_from && $time_str <= $workshop_arej_to) {
                                            $arej_stamp = $time_str;

                                            if (isset($arej_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_reject = ? WHERE userid = ? AND date = ?";
                                                $params = array($arej_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_reject) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $arej_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }
                                        //checkout office             
                                        elseif ($checkType == "O" && $office_employee == "office") {
                                          echo '<a class="badge badge-secondary">check out</a> ';

                                          if ($time_str >= $office_lout_from && $time_str <= $office_lout_to) {
                                            $mc_out_stamp = $time_str;

                                            if (isset($mc_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET m_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($office_lout_from, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_c_out) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $office_lout_from);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $office_el_from && $time_str <= $office_hl_to) {
                                            $ac_out_stamp = $time_str;
                                            if (isset($ac_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ac_out_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_out) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $ac_out_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        }
                                        //checkout workshop
                                        elseif ($checkType == "O" && $workshop_employee == "workshop") {
                                          echo '<a class="badge badge-warning">check out</a> ';

                                          if ($time_str >= $workshop_lout_from && $time_str <= $workshop_lout_to) {
                                            $mc_out_stamp = $time_str;

                                            if (isset($mc_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET m_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($workshop_lout_from, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, m_c_out) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $workshop_lout_from);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          } elseif ($time_str >= $workshop_el_from && $time_str <= $workshop_hl_to) {
                                            $ac_out_stamp = $time_str;
                                            if (isset($ac_out_stamp)) {
                                              if (sqlsrv_has_rows($reso)) {
                                                $sql_update = "UPDATE cAttendance SET A_c_out = ? WHERE userid = ? AND date = ?";
                                                $params = array($ac_out_stamp, $user_id, $date);
                                                $reso = sqlsrv_query($conn, $sql_update, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              } else {
                                                $sql_insert = "INSERT INTO cAttendance (userid, date, A_c_out) VALUES (?, ?, ?)";
                                                $params = array($user_id, $date, $ac_out_stamp);
                                                $reso = sqlsrv_query($conn, $sql_insert, $params);

                                                if ($reso === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                                }
                                              }
                                            }
                                          }
                                        } else {
                                          echo '<a class="badge badge-danger">user click unknown button</a> ';
                                        }
                                      }


                                      if ($checkType == "I" && $user_title == "office") {
                                        if ($time_str >= $office_min_from  && $time_str < $office_min_to) {
                                          $overtime_seconds = strtotime($office_min_from) - strtotime($time_str);
                                          $overtime = gmdate("H:i:s", $overtime_seconds);
                                          echo '<span class="badge badge-success">Morning Present: ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_mwar_from && $time_str <= $office_mwar_to) {
                                          echo '<span class="badge badge-warning">Morning Warning : ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_mrej_from && $time_str <= $office_mrej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_acin_from && $time_str <= $office_acin_to) {
                                          echo '<span class="badge badge-success">Afternoon Present: ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_awar_from && $time_str <= $office_awar_to) {
                                          echo '<span class="badge badge-warning">Afternoon Warning : ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_arej_from && $time_str <= $office_arej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        }
                                      } else if ($checkType == "I" && $user_title == "workshop") {
                                        if ($time_str >= $workshop_min_from  && $time_str < $workshop_min_to) {
                                          echo '<span class="badge badge-success">Morning Present: ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_mwar_from && $time_str <= $workshop_mwar_to) {
                                          echo '<span class="badge badge-warning">Morning Warning : ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_mrej_from && $time_str <= $workshop_mrej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_acin_from && $time_str <= $workshop_acin_to) {
                                          echo '<span class="badge badge-success">Afternoon Present: ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_awar_from && $time_str <= $workshop_awar_to) {
                                          echo '<span class="badge badge-warning">Afternoon Warning : ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_arej_from && $time_str <= $workshop_arej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        }
                                      } else if ($checkType == "O" && $user_title == "office") {
                                        if ($time_str >= $office_mrej_from  && $time_str <= $office_lout_from) {
                                          echo '<span class="badge badge-danger"> Early Leave Lunch Break : ' . $time_str . ' </span>';
                                        } else if ($time_str >= $office_lout_from  && $time_str <= $office_lout_to) {
                                          echo '<span class="badge badge-success">Lunch Break : ' . $time_str . ' </span>';
                                        } else if ($time_str > $office_hl_from && $time_str <= $office_hl_to) {
                                          echo '<span class="badge badge-success">Leave : ' . $time_str . ' </span>';
                                        } else if ($time_str >= $office_el_from && $time_str <= $office_el_to) {
                                          echo '<span class="badge badge-warning"> Early leave : ' . $time_str . '</span>';
                                        } else if ($time_str >= $office_arej_from && $time_str <= $office_arej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        }
                                      } else if ($checkType == "O" && $user_title == "workshop") {
                                        if ($time_str >= $workshop_mrej_from  && $time_str <= $workshop_lout_from) {
                                          echo '<span class="badge badge-danger"> Early Leave Lunch Break : ' . $time_str . ' </span>';
                                        } else if ($time_str >= $workshop_lout_from  && $time_str <= $workshop_lout_to) {
                                          echo '<span class="badge badge-success">Lunch Break : ' . $time_str . ' </span>';
                                        } else if ($time_str > $workshop_hl_from && $time_str <= $workshop_hl_to) {
                                          echo '<span class="badge badge-success">Leave : ' . $time_str . ' </span>';
                                        } else if ($time_str >= $workshop_el_from && $time_str <= $workshop_el_to) {
                                          echo '<span class="badge badge-warning"> Early leave : ' . $time_str . '</span>';
                                        } else if ($time_str >= $workshop_arej_from && $time_str <= $workshop_arej_to) {
                                          echo '<span class="badge badge-danger">Discarded : ' . $time_str . '</span>';
                                        }
                                      }
                                      ?>
                                    </span>
                                  </div>
                                  <div class="mt-1 "> <span class=" date_card text1 detail-button"> <?php echo "Date : $date"; ?> </span> </div>
                                </div>
                              </div>
                          <?php
                            }
                          } else {
                            echo "<p class='text-center m-auto'> No Data Found. sorry!! </p>";
                          }

                          ?>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>






                <div class="col-lg-4 ht-lg-100p">
                  <div class="tab">
                    <button class="tablink active" onclick="openTab('office')">Office Schedule</button>
                    <button class="tablink" onclick="openTab('workshop')">Workshop Schedule</button>
                  </div>
                  <div id="office" class="tabcontent p-0 " style="display: block;">
                    <form action="../controller/schedule.php" class="form-inline" method="POST">
                      <div class="row">
                        <div class="col-12 mt-2 schedule_element1">
                          <lable>Schedule for Office Workers</lable> <br>
                          <small class="margin-time" for="datetime">Time (HH:MM:SS)</small>
                        </div>

                        <?php
                        if (isset($_SESSION['update'])) {
                        ?>
                          <div class="col-8 mx-3 alert alert-success alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                            ?>
                          </div>
                        <?php
                        }
                        ?>

                        <div class="mt-2">
                          <div class="input-group adjuster">
                            <div class="input-group-prepend col-4">
                              <div class="input-group-text">
                                Morning Check-in :
                              </div>
                            </div><!-- input-group-prepend -->
                            &nbsp; <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="min_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_min_from ?>">
                            &nbsp; <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="min_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_min_to ?>">

                          </div><!-- input-group -->
                        </div>
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Morning warning :
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mwar_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_mwar_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mwar_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_mwar_to ?>">

                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Morning Rejected :
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp; <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mrej_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_mrej_from ?>">
                          &nbsp; <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mrej_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_mrej_to ?>">

                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Lunch Check-out :
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster " pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="lout_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_lout_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="lout_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_lout_to ?>">
                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Afternoon Check-in:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="acin_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_acin_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="acin_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_acin_to ?>">
                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Afternoon warning:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="awar_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_awar_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="awar_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_awar_to ?>">
                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Afternoon Rejected:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="arej_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_arej_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="arej_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_arej_to ?>">
                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text">
                              Early Leave:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="el_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_el_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="el_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_el_to ?>">
                        </div><!-- input-group -->
                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Home Leave:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="hl_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $office_hl_from ?>">
                          &nbsp;<input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="hl_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $office_hl_to ?>">
                        </div><!-- input-group -->

                        <div class="col-12">
                          <div class="d-flex justify-content-end mt-3">
                            <input type="submit" name="offie_submit" class="btn-primary btn-sm" value="Update">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div id="workshop" class="tabcontent p-0">
                    <form action="../controller/schedule.php" class="form-inline" method="POST">
                      <div class="row">
                        <div class="col-12 mt-2 schedule_element1">
                          <lable>Schedule for Workshop Workers</lable> <br>
                          <small class="margin-time" for="datetime">Time (HH:MM:SS)</small>
                        </div>

                        <div class="mt-2">
                          <div class="input-group adjuster">
                            <div class="input-group-prepend col-4">
                              <div class="input-group-text  ">
                                Morning Check-in:
                              </div>
                            </div>
                            &nbsp;
                            <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="min_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_min_from ?>">
                            &nbsp;
                            <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="min_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_min_to ?>">
                          </div>
                        </div>
                        <style>
                          .adjuster {
                            height: 30px;
                            margin-right: 8px;
                          }
                        </style>

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Morning warning:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mwar_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_mwar_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mwar_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_mwar_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Morning Reject:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mrej_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_mrej_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="mrej_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_mrej_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Lunch Check-out:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="lout_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_lout_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="lout_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_lout_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Afternoon Check-in:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="acin_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_acin_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="acin_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_acin_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Afternoon warning:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="awar_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_awar_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="awar_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_awar_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Afternoon Rejected:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="arej_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_arej_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="arej_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_arej_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Early Leave:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="el_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_el_from ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="el_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_el_to ?>">
                        </div><!-- input-group -->

                        <div class="input-group adjuster ">
                          <div class="input-group-prepend col-4">
                            <div class="input-group-text  ">
                              Home Leave:
                            </div>
                          </div><!-- input-group-prepend -->
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="hl_from" placeholder="From:- 00:00:00" step="1" value="<?php echo $workshop_hl_from  ?>">
                          &nbsp;
                          <input class="form-control adjuster" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text" name="hl_to" placeholder="To:- 00:00:00" step="1" value="<?php echo $workshop_hl_to ?>">
                        </div><!-- input-group -->

                        <div class="col-12">
                          <div class="d-flex justify-content-end mt-3">
                            <input type="submit" name="workshop_submit" class="btn-primary btn-sm" value="Update">
                          </div>
                        </div>

                      </div>
                    </form>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>

        <?php include "../include/footer.php"  ?>


        <script src="../lib/jquery/jquery.min.js"></script>
        <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script>
          function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
          }
        </script>
        <script src="../lib/jquery.flot/jquery.flot.js"></script>
        <script src="../lib/jquery.flot/jquery.flot.resize.js"></script>

        <script src="../js/azia.js"></script>

      </body>

      </html>