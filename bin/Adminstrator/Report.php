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


$sql = "SELECT userid, date, m_cin, m_c_out FROM cAttendance WHERE m_cin IS NOT NULL AND m_c_out IS NOT NULL AND m_w_t IS NULL";
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

    $sql = "UPDATE cAttendance SET m_w_t = ? WHERE userid = ? AND date = ?";
    $params = array($mwt, $uid, $date);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }
  } else {
    echo "Missing morning check-in or check-out for user $uid on $date<br>";
  }
}


$sql = "SELECT userid, date, A_c_in, A_c_out FROM cAttendance WHERE A_c_in IS NOT NULL AND A_c_out IS NOT NULL AND a_w_t IS NULL";
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

    $sql = "UPDATE cAttendance SET a_w_t = ? WHERE userid = ? AND date = ?";
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
$sql = "SELECT userid, date, m_w_t, a_w_t, t_w_t FROM cAttendance WHERE (m_w_t IS NOT NULL AND a_w_t IS NOT NULL)";
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
    $sql = "UPDATE cAttendance SET t_w_t = ? WHERE userid = ? AND date = ?";
    $params = array($total, $uid, $date);
    $stmt2 = sqlsrv_query($conn, $sql, $params);
    if ($stmt2 === false) {
      die(print_r(sqlsrv_errors(), true));
    }
  }
}

$sql_check = "SELECT a.date, a.userid, a.A_c_in, a.A_c_out, u.Title
              FROM cAttendance a
              INNER JOIN USERINFO u ON a.userid = u.USERID
              WHERE a.A_c_in IS NOT NULL AND a.A_c_out IS NOT NULL";

$result = sqlsrv_query($conn, $sql_check);

if ($result === false) {
  die(print_r(sqlsrv_errors(), true));
}

$early_ot = "16:00:00";
$late_ot = "23:59:00";
$subtracter = "04:00:00";


while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

  $date = $row['date'];
  $user_id = $row['userid'];
  $ac_in = $row['A_c_in'];
  $ac_out = $row['A_c_out'];
  $title = $row['Title'];

  if ($title == "office") {

    $sql_schedule = "SELECT hl_s from schedule WHERE TITLE = 'office' ";
    $result_schedule = sqlsrv_query($conn, $sql_schedule);

    if ($result_schedule === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    $row_jale = sqlsrv_fetch_array($result_schedule, SQLSRV_FETCH_ASSOC);
    $timestamp = $row_jale['hl_s'];

    if ($ac_out > $timestamp && $ac_out <= $early_ot) {
      $overtime_seconds = strtotime($ac_out) - strtotime($timestamp);
      $overtime = gmdate("H:i:s", $overtime_seconds);

      if (isset($overtime)) {
        $sql_update = "UPDATE cAttendance SET ot_early = ?, A_c_out = ? , A_w_t = ?  WHERE userid = ? AND date = ?";
        $params = array($overtime, $timestamp, $subtracter, $user_id, $date);
        $reso = sqlsrv_query($conn, $sql_update, $params);

        if ($reso === false) {
          die(print_r(sqlsrv_errors(), true));
        }
      }
    } elseif ($ac_out > $early_ot && $ac_out <= $late_ot) {
      $overtime_seconds = strtotime($ac_out) - strtotime($timestamp);
      $overtime = gmdate("H:i:s", $overtime_seconds);

      if (isset($overtime)) {


        $value = strtotime($overtime) - strtotime($subtracter);
        $setter = gmdate("H:i:s", $value);

        $sql_update = "UPDATE cAttendance SET ot_early=?, ot_night = ?, A_c_out = ?, A_w_t=? WHERE userid = ? AND date = ?";
        $params = array($subtracter, $setter, $timestamp, $subtracter, $user_id, $date);
        $reso = sqlsrv_query($conn, $sql_update, $params);

        if ($reso === false) {
          die(print_r(sqlsrv_errors(), true));
        }
      }
    }
  } elseif ($title == "workshop") {

    $sql_schedule = "SELECT hl_s from schedule WHERE TITLE = 'workshop' ";
    $result_schedule = sqlsrv_query($conn, $sql_schedule);

    if ($result_schedule === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    $row_jale = sqlsrv_fetch_array($result_schedule, SQLSRV_FETCH_ASSOC);
    $timestamp = $row_jale['hl_s'];

    if ($ac_out > $timestamp && $ac_out <= $early_ot) {
      $overtime_seconds = strtotime($ac_out) - strtotime($timestamp);
      $overtime = gmdate("H:i:s", $overtime_seconds);

      if (isset($overtime)) {
        $sql_update = "UPDATE cAttendance SET ot_early = ?, A_c_out = ?, A_w_t=? WHERE userid = ? AND date = ?";
        $params = array($overtime, $timestamp, $subtracter, $user_id, $date);
        $reso = sqlsrv_query($conn, $sql_update, $params);

        if ($reso === false) {
          die(print_r(sqlsrv_errors(), true));
        }
      }
    } elseif ($ac_out > $early_ot && $ac_out <= $late_ot) {
      $overtime_seconds = strtotime($ac_out) - strtotime($timestamp);
      $overtime = gmdate("H:i:s", $overtime_seconds);


      if (isset($overtime)) {

        $value = strtotime($overtime) - strtotime($subtracter);
        $setter = gmdate("H:i:s", $value);

        $sql_update = "UPDATE cAttendance SET ot_early=?, ot_night = ?, A_c_out = ?, A_w_t=?   WHERE userid = ? AND date = ?";
        $params = array($subtracter, $setter, $timestamp, $subtracter, $user_id, $date);
        $reso = sqlsrv_query($conn, $sql_update, $params);

        if ($reso === false) {
          die(print_r(sqlsrv_errors(), true));
        }
      }
    }
  }
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
            <a href="" class="nav-link" id="myInput">Settings</a>
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
            <h2 class="az-dashboard-title">Attendance Analytics</h2>
            <div class="az-content-breadcrumb">
              <span>Attendance System</span>
              <span>Analytics</span>
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


        <div class="row row-sm mg-b-20">
          <div class="col-lg-12 ht-lg-100p">
            <div class="card card-dashboard-one">
              <div class="btn-group">
                <div class="card-header">
                  <div>
                    <h6 class="card-title card-title-font">Generate Report</h6>
                    <small class="card-text mb-2">Select From - To Date selector below <small>
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
                          echo '<option value="all">All</option>'; // Add the "All" option
                          while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($row['USERID']) . '">';
                            echo htmlspecialchars($row['NAME']);
                            echo '</option>';
                          }
                          echo '</select>';
                          ?>
                          &nbsp;
                          <button name="filter" type="submit" class="btn-sm btn-primary">&nbsp;List&nbsp;</button>&nbsp;
                        </form>
                  </div>
                </div>
                <br>
                <div>
                </div>
              </div><!-- card-header -->



              <div id="mainDiv" class="table-wrapper m-2 ">
                <table>
                  <tbody>

                    <?php

                    if (isset($_POST['filter'])) {
                      $from_date = $_POST['from_date'];
                      $to_date = $_POST['to_date'];
                      $employee_id = $_POST['user'];

                      if ($employee_id === 'all') {
                        $sql = "SELECT NAME,TITLE,PAGER,GENDER,BADGENUMBER,profile FROM USERINFO";
                      } else {
                        $sql = "SELECT NAME,TITLE,PAGER,GENDER,BADGENUMBER,profile FROM USERINFO WHERE USERID = $employee_id";
                      }
                      $stmt = sqlsrv_query($conn, $sql);
                      if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                      }
                      $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)
                    ?>

                      <?php
                      if ($employee_id === 'all') {

                        echo "<br>";
                        $sql = "SELECT * FROM cAttendance WHERE date BETWEEN '$from_date' AND '$to_date'";

                        $sql = "SELECT cAttendance.*, USERINFO.NAME 
                  FROM cAttendance 
                  INNER JOIN USERINFO ON cAttendance.userid = USERINFO.USERID 
                  WHERE cAttendance.date BETWEEN '$from_date' AND '$to_date'";

                        $reslt = sqlsrv_query($conn, $sql);
                        if ($reslt !== false) {
                          $groupedData = array();
                          while ($row = sqlsrv_fetch_array($reslt, SQLSRV_FETCH_ASSOC)) {
                            $userId = $row['userid'];

                            if (array_key_exists($userId, $groupedData)) {
                              $groupedData[$userId][] = $row;
                            } else {
                              $groupedData[$userId] = array($row);
                            }
                          }

                      ?>
                          <section class="container-fluid mb-5  ">
                            <div class="row">
                              <div class="table-fit">

                                <div class="row">
                                  <?php

                                  foreach ($groupedData as $userId => $data) {

                                    $username = $data[0]['NAME'];
                                    $user_salary = $data[0]['Salary'];


                                    $holi_query = "SELECT * FROM cAttendance WHERE userid = $userId AND date BETWEEN '$from_date' AND '$to_date'";
                                    $res = sqlsrv_query($conn, $holi_query);
                                    if (sqlsrv_has_rows($res)) {

                                      $Total_worktime_all = 0;
                                      $morning_only = 0;
                                      $afternoon_only = 0;
                                      $acout_total = 0;
                                      $total_time_formatted_row = 0;
                                      $Total_worktime_all = 0;
                                      //sun_ot
                                      $sun_Total_worktime_all = 0;
                                      $sun_morning_only = 0;
                                      $sun_afternoon_only = 0;
                                      $sun_total_time_formatted_row = 0;

                                      $sun_ot_night_worktime_all = 0;
                                      $sun_ot_night_time_formatted_row  = 0;

                                      $sun_ot_early_worktime_all = 0;
                                      $sun_ot_early_time_formatted_row = 0;


                                      //holi
                                      $holi_Total_worktime_all = 0;
                                      $holi_morning_only = 0;
                                      $holi_afternoon_only = 0;
                                      $holi_total_time_formatted_row = 0;

                                      $holi_ot_night_worktime_all = 0;
                                      $holi_ot_night_time_formatted_row  = 0;

                                      $h_ot_early_worktime_all = 0;
                                      $h_ot_early_time_formatted_row = 0;


                                      //ot_early
                                      $ot_early_time_formatted_row = 0;
                                      $ot_early_worktime_all = 0;
                                      //ot_night
                                      $ot_night_time_formatted_row = 0;
                                      $ot_night_worktime_all = 0;

                                      while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {

                                        $morning = $row['M_w_t'];
                                        $afternoon = $row['A_w_t'];
                                        $Total_worktime = $row['T_w_t'];

                                        $ot_dayz = $row['ot_day'];
                                        $holi_dayz = $row['holiday'];

                                        $ot_early_worktime = $row['ot_early'];
                                        $ot_night_worktime = $row['ot_night'];


                                        //morning_only 
                                        if ($morning != null && $afternoon == null && $ot_dayz == null && $holi_dayz == null) {
                                          $morning_only += strtotime($morning) - strtotime('00:00:00');
                                        }
                                        //afternoon_only
                                        elseif ($afternoon != null && $morning == null && $ot_dayz == null && $holi_dayz == null) {
                                          $afternoon_only += strtotime($afternoon) - strtotime('00:00:00');
                                        }
                                        //twt                  
                                        if ($Total_worktime != null && $ot_dayz == null && $holi_dayz == null) {
                                          $Total_worktime_all += strtotime($Total_worktime) - strtotime('00:00:00');
                                          $total_hours_row = floor($Total_worktime_all / 3600);
                                          $total_minutes_row = floor(($Total_worktime_all / 60) % 60);
                                          $total_seconds_row = $Total_worktime_all % 60;
                                          $total_time_formatted_row = sprintf('%02d:%02d:%02d', $total_hours_row, $total_minutes_row, $total_seconds_row);
                                        }
                                        //ot_early  
                                        if ($ot_early_worktime != null && $ot_dayz == null && $holi_dayz == null) {
                                          $ot_early_worktime_all += strtotime($ot_early_worktime) - strtotime('00:00:00');
                                          $ot_early_hours_row = floor($ot_early_worktime_all / 3600);
                                          $ot_early_minutes_row = floor(($ot_early_worktime_all / 60) % 60);
                                          $ot_early_seconds_row = $ot_early_worktime_all % 60;
                                          $ot_early_time_formatted_row = sprintf('%02d:%02d:%02d', $ot_early_hours_row, $ot_early_minutes_row, $ot_early_seconds_row);
                                        }
                                        //ot_  
                                        if ($ot_night_worktime != null && $ot_dayz == null && $holi_dayz == null) {
                                          $ot_night_worktime_all += strtotime($ot_night_worktime) - strtotime('00:00:00');
                                          $ot_night_hours_row = floor($ot_night_worktime_all / 3600);
                                          $ot_night_minutes_row = floor(($ot_night_worktime_all / 60) % 60);
                                          $ot_night_seconds_row = $ot_night_worktime_all % 60;
                                          $ot_night_time_formatted_row = sprintf('%02d:%02d:%02d', $ot_night_hours_row, $ot_night_minutes_row, $ot_night_seconds_row);
                                        }

                                        if ($ot_dayz == 1 && $holi_dayz == null) {

                                          if ($morning != null && $afternoon == null) {
                                            $sun_morning_only += strtotime($morning) - strtotime('00:00:00');
                                          } elseif ($afternoon != null && $morning == null) {
                                            $sun_afternoon_only += strtotime($afternoon) - strtotime('00:00:00');
                                          }
                                          if ($Total_worktime != null) {
                                            $sun_Total_worktime_all += strtotime($Total_worktime) - strtotime('00:00:00');
                                            $sun_total_hours_row = floor($sun_Total_worktime_all / 3600);
                                            $sun_total_minutes_row = floor(($sun_Total_worktime_all / 60) % 60);
                                            $sun_total_seconds_row = $sun_Total_worktime_all % 60;
                                            $sun_total_time_formatted_row = sprintf('%02d:%02d:%02d', $sun_total_hours_row, $sun_total_minutes_row, $sun_total_seconds_row);
                                          }
                                          if ($ot_night_worktime != null) {
                                            $sun_ot_night_worktime_all += strtotime($ot_night_worktime) - strtotime('00:00:00');
                                            $sun_ot_night_hours_row = floor($sun_ot_night_worktime_all / 3600);
                                            $sun_ot_night_minutes_row = floor(($sun_ot_night_worktime_all / 60) % 60);
                                            $sun_ot_night_seconds_row = $sun_ot_night_worktime_all % 60;
                                            $sun_ot_night_time_formatted_row = sprintf('%02d:%02d:%02d', $sun_ot_night_hours_row, $sun_ot_night_minutes_row, $sun_ot_night_seconds_row);
                                          }
                                          if ($ot_early_worktime != null) {
                                            $sun_ot_early_worktime_all += strtotime($ot_early_worktime) - strtotime('00:00:00');
                                            $sun_ot_early_hours_row = floor($sun_ot_early_worktime_all / 3600);
                                            $sun_ot_early_minutes_row = floor(($sun_ot_early_worktime_all / 60) % 60);
                                            $sun_ot_early_seconds_row = $sun_ot_early_worktime_all % 60;
                                            $sun_ot_early_time_formatted_row = sprintf('%02d:%02d:%02d', $sun_ot_early_hours_row, $sun_ot_early_minutes_row, $sun_ot_early_seconds_row);
                                          }
                                        }

                                        if ($holi_dayz == 1) {
                                          if ($morning != null && $afternoon == null) {
                                            $holi_morning_only += strtotime($morning) - strtotime('00:00:00');
                                          } elseif ($afternoon != null && $morning == null) {
                                            $holi_afternoon_only += strtotime($afternoon) - strtotime('00:00:00');
                                          }
                                          if ($Total_worktime != null) {
                                            $holi_Total_worktime_all += strtotime($Total_worktime) - strtotime('00:00:00');
                                            $holi_total_hours_row = floor($holi_Total_worktime_all / 3600);
                                            $holi_total_minutes_row = floor(($holi_Total_worktime_all / 60) % 60);
                                            $holi_total_seconds_row = $holi_Total_worktime_all % 60;
                                            $holi_total_time_formatted_row = sprintf('%02d:%02d:%02d', $holi_total_hours_row, $holi_total_minutes_row, $holi_total_seconds_row);
                                          }
                                          if ($ot_night_worktime != null) {
                                            $holi_ot_night_worktime_all += strtotime($ot_night_worktime) - strtotime('00:00:00');
                                            $holi_ot_night_hours_row = floor($holi_ot_night_worktime_all / 3600);
                                            $holi_ot_night_minutes_row = floor(($holi_ot_night_worktime_all / 60) % 60);
                                            $holi_ot_night_seconds_row = $holi_ot_night_worktime_all % 60;
                                            $holi_ot_night_time_formatted_row = sprintf('%02d:%02d:%02d', $holi_ot_night_hours_row, $holi_ot_night_minutes_row, $holi_ot_night_seconds_row);
                                          }
                                          if ($ot_early_worktime != null) {
                                            $h_ot_early_worktime_all += strtotime($ot_early_worktime) - strtotime('00:00:00');
                                            $h_ot_early_hours_row = floor($h_ot_early_worktime_all / 3600);
                                            $h_ot_early_minutes_row = floor(($h_ot_early_worktime_all / 60) % 60);
                                            $h_ot_early_seconds_row = $h_ot_early_worktime_all % 60;
                                            $h_ot_early_time_formatted_row = sprintf('%02d:%02d:%02d', $h_ot_early_hours_row, $h_ot_early_minutes_row, $h_ot_early_seconds_row);
                                          }
                                        }
                                      }

                                      $morning_total_formatted = sprintf('%02d:%02d:%02d', floor($morning_only / 3600), floor(($morning_only / 60) % 60), $morning_only % 60);
                                      //////////////////////////
                                      $afternoon_total_formatted = sprintf('%02d:%02d:%02d', floor($afternoon_only / 3600), floor(($afternoon_only / 60) % 60), $afternoon_only % 60);
                                      ///////////////////////////
                                      $eveningArray = explode(':', $total_time_formatted_row);
                                      $evening_hours_row = (int) $eveningArray[0];
                                      $evening_minutes_row = (int) $eveningArray[1];
                                      $evening_seconds_row = (int) $eveningArray[2];
                                      $evening_worktime_all = $evening_hours_row * 3600 + $evening_minutes_row * 60 + $evening_seconds_row;
                                      ///////////////////////////
                                      $totalSeconds = $morning_only + $afternoon_only + $evening_worktime_all;
                                      $totalTime = sprintf('%02d:%02d:%02d', floor($totalSeconds / 3600), floor(($totalSeconds / 60) % 60), $totalSeconds % 60);
                                      ///////////////////////////
                                      $sun_morning_total_formatted = sprintf('%02d:%02d:%02d', floor($sun_morning_only / 3600), floor(($sun_morning_only / 60) % 60), $sun_morning_only % 60);
                                      $sun_afternoon_total_formatted = sprintf('%02d:%02d:%02d', floor($sun_afternoon_only / 3600), floor(($sun_afternoon_only / 60) % 60), $sun_afternoon_only % 60);
                                      $sun_eveningArray = explode(':', $sun_total_time_formatted_row);
                                      $sun_evening_hours_row = (int) $sun_eveningArray[0];
                                      $sun_evening_minutes_row = (int) $sun_eveningArray[1];
                                      $sun_evening_seconds_row = (int) $sun_eveningArray[2];
                                      $sun_evening_worktime_all = $sun_evening_hours_row * 3600 + $sun_evening_minutes_row * 60 + $sun_evening_seconds_row;

                                      $sun_ot_eveningArray = explode(':', $sun_ot_night_time_formatted_row);
                                      $sun_ot_evening_hours_row = (int) $sun_ot_eveningArray[0];
                                      $sun_ot_evening_minutes_row = (int) $sun_ot_eveningArray[1];
                                      $sun_ot_evening_seconds_row = (int) $sun_ot_eveningArray[2];
                                      $sun_ot_evening_worktime_all = $sun_ot_evening_hours_row * 3600 + $sun_ot_evening_minutes_row * 60 + $sun_ot_evening_seconds_row;

                                      $htsun_ot_eveningArray = explode(':', $sun_ot_early_time_formatted_row);
                                      $htsun_ot_evening_hours_row = (int) $htsun_ot_eveningArray[0];
                                      $htsun_ot_evening_minutes_row = (int) $htsun_ot_eveningArray[1];
                                      $htsun_ot_evening_seconds_row = (int) $htsun_ot_eveningArray[2];
                                      $htsun_ot_evening_worktime_all = $htsun_ot_evening_hours_row * 3600 + $htsun_ot_evening_minutes_row * 60 + $htsun_ot_evening_seconds_row;

                                      $sun_totalSeconds = $sun_morning_only + $sun_afternoon_only + $sun_evening_worktime_all + $sun_ot_evening_worktime_all + $htsun_ot_evening_worktime_all;
                                      $sun_totalTime = sprintf('%02d:%02d:%02d', floor($sun_totalSeconds / 3600), floor(($sun_totalSeconds / 60) % 60), $sun_totalSeconds % 60);
                                      ///////////////////////////
                                      $holi_morning_total_formatted = sprintf('%02d:%02d:%02d', floor($holi_morning_only / 3600), floor(($holi_morning_only / 60) % 60), $holi_morning_only % 60);
                                      $holi_afternoon_total_formatted = sprintf('%02d:%02d:%02d', floor($holi_afternoon_only / 3600), floor(($holi_afternoon_only / 60) % 60), $holi_afternoon_only % 60);

                                      $holi_eveningArray = explode(':', $holi_total_time_formatted_row);
                                      $holi_evening_hours_row = (int) $holi_eveningArray[0];
                                      $holi_evening_minutes_row = (int) $holi_eveningArray[1];
                                      $holi_evening_seconds_row = (int) $holi_eveningArray[2];
                                      $holi_evening_worktime_all = $holi_evening_hours_row * 3600 + $holi_evening_minutes_row * 60 + $holi_evening_seconds_row;

                                      $holi_ot_eveningArray = explode(':', $holi_ot_night_time_formatted_row);
                                      $holi_ot_evening_hours_row = (int) $holi_ot_eveningArray[0];
                                      $holi_ot_evening_minutes_row = (int) $holi_ot_eveningArray[1];
                                      $holi_ot_evening_seconds_row = (int) $holi_ot_eveningArray[2];
                                      $holi_ot_evening_worktime_all = $holi_ot_evening_hours_row * 3600 + $holi_ot_evening_minutes_row * 60 + $holi_ot_evening_seconds_row;

                                      $ht_ot_eveningArray = explode(':', $h_ot_early_time_formatted_row);
                                      $ht_ot_evening_hours_row = (int) $ht_ot_eveningArray[0];
                                      $ht_ot_evening_minutes_row = (int) $ht_ot_eveningArray[1];
                                      $ht_ot_evening_seconds_row = (int) $ht_ot_eveningArray[2];
                                      $ht_ot_evening_worktime_all = $ht_ot_evening_hours_row * 3600 + $ht_ot_evening_minutes_row * 60 + $ht_ot_evening_seconds_row;

                                      $holi_totalSeconds = $holi_morning_only + $holi_afternoon_only + $holi_evening_worktime_all + $holi_ot_evening_worktime_all + $ht_ot_evening_worktime_all;
                                      $holi_totalTime = sprintf('%02d:%02d:%02d', floor($holi_totalSeconds / 3600), floor(($holi_totalSeconds / 60) % 60), $holi_totalSeconds % 60);
                                  ?>

                                      <div class="col-4 mb-4">
                                        <div class="card card-dashboard-pageviews">
                                          <div class="card-header">
                                            <h6 class="btn-sm btn-primary"> <?php echo $username; ?> </h6>
                                            
                                          </div>
                                           <p class="card-text">Report: <?php echo $from_date . "  ~  " . $to_date ?></p>

                                          <div class="card-body">
                                            <div class="az-list-item">
                                              <div>
                                                

                                                <h6>Regular Attendance</h6>
                                                <span>Morning Only Time Attendance</span><br>
                                                <span>Afternoon Only Time Attendance</span><br>
                                                <span>Total Daily Attendace</span><br><br>
                                                <?php echo '<span  ><mark>Total : ' . $totalTime . ' hours </mark></span><br> '; ?>
                                              
                                              
                                              </div>
                                              <div>
                                                <h6 class="tx-primary">&nbsp;</h6>
                                                <span><?php echo $morning_total_formatted; ?></span><br>
                                                <span><?php echo $afternoon_total_formatted; ?></span><br>
                                                <span><?php echo $total_time_formatted_row; ?></span><br>
                                                <span>&nbsp; 
                                                   <?php
                                                   $hourly_salary = $user_salary/208;
                                                   $s_wz_ded = $hourly_salary* $totalTime;                                             
                                                   echo $s_wz_ded
                                                   ?>                                               

                                                  </span><br>
                                              </div>
                                            </div><!-- list-group-item -->
                                            <div class="az-list-item">
                                              <div>
                                                <h6>Overtime</h6>
                                                <span>Night overtime</span><br>
                                                <span>Night overtime +4:00</span><br>
                                                <span>Weekend overtime</span><br>
                                                <span>Holiday Overtime</span><br>
                                              </div>
                                              <div>
                                                <h6 class="tx-primary">&nbsp;</h6>
                                                <span><?php echo $ot_early_time_formatted_row ; ?></span><br>
                                                <span><?php echo $ot_night_time_formatted_row ; ?></span><br>
                                                <span><?php echo $sun_totalTime ; ?></span><br>
                                                <span><?php echo $holi_totalTime ; ?></span><br>
                                              </div>
                                            </div><!-- list-group-item -->



                                          </div><!-- card-body -->
                                        </div><!-- card -->
                                      </div>
                                  <?php
                                    }
                                  }

                                  ?>
                                </div>
                              </div>
                            </div>
                          </section>
                        <?php
                        } else {
                          echo "No Record Found";
                        }
                      } else {
                        ?>

                        <style>
                          .fs_8 {
                            font-size: 8px !important;
                          }

                          .user_profile_report {
                            width: 100px;
                            height: 100px;
                            border-radius: 50%;
                            border: 1px solid #ccc;
                            object-fit: cover;
                          }


                          .table-fit {
                            margin: 0px;
                          }
                        </style>

                        <div class="row mb-2 ">

                          <div class="col-md-6">
                            <div class="m_report">

                              <button type="button" class="mb-1 btn-sm btn-primary  ">
                                <?php echo $result["NAME"];  ?> <span class="badge badge-light"> Report: <?php echo $from_date . "  to  " . $to_date ?> </span> | <?php echo $result["TITLE"]; ?>
                              </button>

                            </div>
                          </div>
                        </div>
                        <style>
                          /* .main {
}
*/
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
                            <th>MWT Discarded</th>

                            <th>Afternoon-in</th>
                            <th>Home leave-out</th>
                            <th>AWT Discarded</th>

                            <th>M.W.T</th>
                            <th>A.W.T</th>
                            <th>T.W.T</th>

                            <th><span class='badge badge-secondary'>OT-night(-4:00)</span></th>
                            <th><span class='badge badge-secondary'>OT-night(+4:00)</span></th>
                            <th><span class='badge badge-secondary'>Holiday</span></th>

                          </tr>
                        </thead>





                        <?php

                        // Query the database
                        $sql = "SELECT * FROM cAttendance WHERE userid = $employee_id AND date BETWEEN '$from_date' AND '$to_date'";
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
                            if ($row['M_reject'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td> <span class='badge badge-danger'>Discarded : " . $row['M_reject'] . "</span></td>";
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
                            if ($row['A_reject'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td> <span class='badge badge-danger'>Discarded : " . $row['A_reject'] . "</span></td>";
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
                            if ($row['ot_early'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['ot_early'] . "</td>";
                            }
                            if ($row['ot_night'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td>" . $row['ot_night'] . "</td>";
                            }
                            if ($row['holiday_name'] === null) {
                              echo "<td>null</td>";
                            } else {
                              echo "<td> <span class='badge badge-warning'>" . $row['holiday_name'] . " </span> </td>";
                            }
                            echo "</tr>";

                            // Extract the data from the row
                            $morning = $row['M_w_t'];
                            $afternoon = $row['A_w_t'];
                            // Calculate the total work time for each user
                            if ($morning != null && $afternoon == null) {
                              $morning_only += strtotime($morning) - strtotime('00:00:00');
                            } elseif ($afternoon != null && $morning == null) {
                              $afternoon_only += strtotime($afternoon) - strtotime('00:00:00');
                            }

                            // Extract the data from the row
                            $Total_worktime = $row['T_w_t'];
                            // Calculate the total work time for each user
                            if ($Total_worktime != null) {
                              $Total_worktime_all += strtotime($Total_worktime) - strtotime('00:00:00');
                              // Convert total seconds to time format
                              $total_hours_row = floor($Total_worktime_all / 3600);
                              $total_minutes_row = floor(($Total_worktime_all - ($total_hours_row * 3600)) / 60);
                              $total_time_formatted_row = sprintf('%02d:%02d:%02d', $total_hours_row, $total_minutes_row, $Total_worktime_all % 60);
                            }
                          }
                          echo "</table>";
                          // Format the total work time for each user
                          $morning_total_formatted = gmdate('H:i:s', $morning_only);
                          $afternoon_total_formatted = gmdate('H:i:s', $afternoon_only);
                          // Convert the formatted evening work time into seconds
                          $eveningArray = explode(':', $total_time_formatted_row);
                          $evening_hours_row = (int) $eveningArray[0];
                          $evening_minutes_row = (int) $eveningArray[1];
                          $evening_seconds_row = (int) $eveningArray[2];
                          $evening_worktime_all = $evening_hours_row * 3600 + $evening_minutes_row * 60 + $evening_seconds_row;
                          // Calculate the total number of seconds
                          $totalSeconds = $morning_only + $afternoon_only + $evening_worktime_all;
                          // Format the total time as an hh:mm:ss string
                          $totalTime = sprintf('%02d:%02d:%02d', floor($totalSeconds / 3600), floor(($totalSeconds / 60) % 60), $totalSeconds % 60);
                          // Display the result
                        ?>
                          <div class="mt-2 ">
                            <small class="text1 detail-button"><?php
                              // Calculate the number of days and fractional hours
                              $total_days = floor($totalTime / 24);
                              $fractional_hours = round($totalTime % 24, 2);
                              // echo " <mark>Total : $totalTime  hours    </mark>";
                              ?>
                            </small>
                          </div>

                    <?php
                          echo " <br>";
                          echo " <br>";
                          echo " <br>";
                        } else {
                          echo "No Record Found";
                        }
                      }
                    }
                    ?>
                  </tbody>
                </table>
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
              </div>
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