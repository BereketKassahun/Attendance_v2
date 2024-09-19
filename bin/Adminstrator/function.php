<?php

include '../config/connection.php';

$id = 0;
$edit_state = false;
//declare to view placeholder on form

//user_mgt
$usr_name = "";
$usr_phone = "";
$usr_gender = "";
$usr_email = "";
$usr_salary = "";


if (isset($_POST['forget'])) {
    $user_type = $_POST['user'];
    $clock_type = $_POST['clock_type'];
    $dateTimeValue = $_POST['my_datetime'];
    $dateTimeValue = str_replace("T", " ", $dateTimeValue);

    $sql = "INSERT INTO CHECKINOUT (USERID,CHECKTYPE,CHECKTIME) VALUES (?,?,?)";
    $params = array($user_type, $clock_type, $dateTimeValue);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_execute($stmt);

    $info = " <p class='card-title notification_session card-title-font'>Forget Clock In/Out Set Successfully!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
    $_SESSION['forget_inout'] = $info;
    echo '<script>window.location.href = "./update.php";</script>';

}

if (isset($_POST['leave'])) {
    $user_type = $_POST['user'];
    // echo $user_type;
    $sql = "SELECT TITLE FROM USERINFO WHERE USERID = ?";
    $params = array($user_type);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $user_role = $row['TITLE'];
        //  echo $user_role;

        if ($user_role == "workshop") {
            $sql = "SELECT mcin_e, lout_s, acin_e, hl_s FROM schedule WHERE TITLE = ?";
            $params = array($user_role);
            $stmt = sqlsrv_prepare($conn, $sql, $params);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            if (sqlsrv_execute($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $mornin_in = date("H:i:s", strtotime($row['mcin_e']) - 5);
                $afternoon_in = date("H:i:s", strtotime($row['acin_e']) - 5);
                $lunch_in = $row['lout_s'];
                $home_leave_in = $row['hl_s'];
                $modified_leave = date("H:i:s", strtotime($home_leave_in) + 5);

                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];

                $current_date = strtotime($from_date);
                $end_date = strtotime($to_date);

                while ($current_date <= $end_date) {
                    if (date('w', $current_date) != 0) {  // 0 = Sunday
                        $clock_in = "I";

                        $dateTime_morning_in = date('Y-m-d', $current_date) . " " . $mornin_in;
                        $dateTime_afternoon_in = date('Y-m-d', $current_date) . " " . $afternoon_in;

                        $dateTime_lunch_in = date('Y-m-d', $current_date) . " " . $lunch_in;
                        $dateTime_home_leave_in = date('Y-m-d', $current_date) . " " . $modified_leave;

                        echo $dateTime_home_leave_in . "<br>";

                        $sql1 = "INSERT INTO CHECKINOUT (USERID, CHECKTYPE, CHECKTIME) VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?), (?, ?, ?)";
                        $params = array($user_type, $clock_in, $dateTime_morning_in, $user_type, $clock_in, $dateTime_afternoon_in, $user_type, 'O', $dateTime_lunch_in, $user_type, 'O', $dateTime_home_leave_in);
                        $stmt1 = sqlsrv_prepare($conn, $sql1, $params);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        sqlsrv_execute($stmt1);
                    }

                    $current_date += 86400;  // Add one day to the current date
                }
            }

            $info = " <p class='card-title notification_session card-title-font'> User Leave SET Successfully!!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
            $_SESSION['leave'] = $info;
            echo '<script>window.location.href = "./update.php";</script>';

        }

        //office
        else if ($user_role == "office") {
            $sql = "SELECT mcin_e, lout_s, acin_e, hl_s FROM schedule WHERE TITLE = ?";
            $params = array($user_role);
            $stmt = sqlsrv_prepare($conn, $sql, $params);


            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            if (sqlsrv_execute($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $mornin_in = date("H:i:s", strtotime($row['mcin_e']) - 5);
                $afternoon_in = date("H:i:s", strtotime($row['acin_e']) - 5);
                $lunch_in = $row['lout_s'];
                $home_leave_in = $row['hl_s'];
                $modified_leave = date("H:i:s", strtotime($home_leave_in) + 5);

                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];

                $current_date = strtotime($from_date);
                $end_date = strtotime($to_date);

                while ($current_date <= $end_date) {
                    if (date('w', $current_date) != 0) {  // 0 = Sunday
                        $clock_in = "I";

                        $dateTime_morning_in = date('Y-m-d', $current_date) . " " . $mornin_in;
                        $dateTime_afternoon_in = date('Y-m-d', $current_date) . " " . $afternoon_in;

                        $dateTime_lunch_in = date('Y-m-d', $current_date) . " " . $lunch_in;
                        $dateTime_home_leave_in = date('Y-m-d', $current_date) . " " . $modified_leave;

                        $sql1 = "INSERT INTO CHECKINOUT (USERID, CHECKTYPE, CHECKTIME) VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?), (?, ?, ?)";
                        $params = array($user_type, $clock_in, $dateTime_morning_in, $user_type, $clock_in, $dateTime_afternoon_in, $user_type, 'O', $dateTime_lunch_in, $user_type, 'O', $dateTime_home_leave_in);
                        $stmt1 = sqlsrv_prepare($conn, $sql1, $params);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        sqlsrv_execute($stmt1);
                    }

                    $current_date += 86400;  // Add one day to the current date
                }
            }
            $info = " <p class='card-title notification_session card-title-font'> User Leave SET Successfully!!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
            $_SESSION['leave'] = $info;
            echo '<script>window.location.href = "./update.php";</script>';

        }
    }
}

if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];
    $usr_phone = $_POST['usr_phone'];
    $usr_email = $_POST['usr_email'];
    $user_type = $_POST['user_type'];
    $usr_salary = $_POST['usr_salary'];



    $sql = "UPDATE USERINFO SET PAGER = ? , email= ? ,TITLE = ? ,Salary = ? WHERE USERID = ?";
    $params = array($usr_phone, $usr_email, $user_type, $usr_salary, $id);
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data_check = sqlsrv_execute($stmt);

    if ($data_check) {

        $info = " <p class='card-title notification_session card-title-font'>User Information Successfully updated!!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
        $_SESSION['update_'] = $info;
        echo '<script>window.location.href = "./update.php";</script>';

    } else {
     
       $info = " <p class='card-title notification_session card-title-font'>Unknown error!!</p>";
       $_SESSION['update_'] = $info;
       echo '<script>window.location.href = "./update.php";</script>';

    }
}

if (isset($_GET['delete_customer'])) {
    $id = $_GET['delete_customer'];

    $sql = "DELETE FROM USERINFO WHERE USERID = ?";
    $params = array($id);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_execute($stmt);

    $info = " <p class='card-title notification_session card-title-font'>User Deleted Successfully! &nbsp;&nbsp;&nbsp;&nbsp;</p>";
    $_SESSION['delete'] = $info;
    echo '<script>window.location.href = "./update.php";</script>';

}

if (isset($_POST['h_ticker'])) {
    $date = $_POST['date'];
    $date_ass_name = $_POST['name'];

    $sql_insert = "INSERT INTO Holiday (holiday,holiday_name) VALUES (?,?)";
    $params = array($date, $date_ass_name);
    $reso = sqlsrv_query($conn, $sql_insert, $params);

    if ($reso==true) {
        $info = " <p class='card-title notification_session card-title-font'>Holiday set Successfully!!&nbsp;&nbsp;&nbsp;&nbsp;</p>";
        $_SESSION['holiday'] = $info;
        echo '<script>window.location.href = "./update.php";</script>';

    } else {
        $info = " <p class='card-title notification_session card-title-font'>Holiday Insertion error!!&nbsp;&nbsp;&nbsp;&nbsp;</p>";
        $_SESSION['holiday'] = $info;
        echo '<script>window.location.href = "./update.php";</script>';

    }
 
}
