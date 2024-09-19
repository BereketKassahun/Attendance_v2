<?php


include '../config/connection.php';

if (isset($_POST['offie_submit'])) {
    // Get the form values
    $min_from = $_POST['min_from'];
    $min_to = $_POST['min_to'];
    $mwar_from = $_POST['mwar_from'];
    $mwar_to = $_POST['mwar_to'];
    $mrej_from = $_POST['mrej_from'];
    $mrej_to = $_POST['mrej_to'];
    $lout_from = $_POST['lout_from'];
    $lout_to = $_POST['lout_to'];
    $acin_from = $_POST['acin_from'];
    $acin_to = $_POST['acin_to'];
    $awar_from = $_POST['awar_from'];
    $awar_to = $_POST['awar_to'];
    $arej_from = $_POST['arej_from'];
    $arej_to = $_POST['arej_to'];
    $el_from = $_POST['el_from'];
    $el_to = $_POST['el_to'];
    $hl_from = $_POST['hl_from'];
    $hl_to = $_POST['hl_to'];

    $sql = "UPDATE schedule SET ";
    if (!empty($min_from)) {
        $sql .= "mcin_s=?, ";
        $params[] = $min_from;
    }
    if (!empty($min_to)) {
        $sql .= "mcin_e=?, ";
        $params[] = $min_to;
    }
    if (!empty($mwar_from)) {
        $sql .= "mwar_s=?, ";
        $params[] = $mwar_from;
    }
    if (!empty($mwar_to)) {
        $sql .= "mwar_e=?, ";
        $params[] = $mwar_to;
    }
    if (!empty($mrej_from)) {
        $sql .= "mrej_s=?, ";
        $params[] = $mrej_from;
    }
    if (!empty($mrej_to)) {
        $sql .= "mrej_e=?, ";
        $params[] = $mrej_to;
    }
    if (!empty($lout_from)) {
        $sql .= "lout_s=?, ";
        $params[] = $lout_from;
    }
    if (!empty($lout_to)) {
        $sql .= "lout_e=?, ";
        $params[] = $lout_to;
    }
    if (!empty($acin_from)) {
        $sql .= "acin_s=?, ";
        $params[] = $acin_from;
    }
    if (!empty($acin_to)) {
        $sql .= "acin_e=?, ";
        $params[] = $acin_to;
    }
    if (!empty($awar_from)) {
        $sql .= "awar_s=?, ";
        $params[] = $awar_from;
    }
    if (!empty($awar_to)) {
        $sql .= "awar_e=?, ";
        $params[] = $awar_to;
    }
    if (!empty($arej_from)) {
        $sql .= "arej_s=?, ";
        $params[] = $arej_from;
    }
    if (!empty($arej_to)) {
        $sql .= "arej_e=?, ";
        $params[] = $arej_to;
    }
    if (!empty($el_from)) {
        $sql .= "el_s=?, ";
        $params[] = $el_from;
    }
    if (!empty($el_to)) {
        $sql .= "el_e=?, ";
        $params[] = $el_to;
    }
    if (!empty($hl_from)) {
        $sql .= "hl_s=?, ";
        $params[] = $hl_from;
    }
    if (!empty($hl_to)) {
        $sql .= "hl_e=?, ";
        $params[] = $hl_to;
    }
    // Remove the last comma and space from the SQL statement
    $sql = rtrim($sql, ", ");
    // Add the WHERE clause to update only the row with title="office"
    $sql .= " WHERE title=?";
    // Add the title parameter to the SQL statement parameters
    $params[] = "office";
    // Execute the SQL statement
    $stmt = sqlsrv_query($conn, $sql, $params);
    // Check for SQL query errors
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $info = "<small>Schedule UPDATED Successfully!</small>";
    $_SESSION['update'] = $info;
    echo '<script>window.location.href = "../Adminstrator/index.php";</script>';
}
// Check if the form was submitted
else if (isset($_POST['workshop_submit'])) {
    // Get the form values
    $min_from = $_POST['min_from'];
    $min_to = $_POST['min_to'];
    $mwar_from = $_POST['mwar_from'];
    $mwar_to = $_POST['mwar_to'];
    $mrej_from = $_POST['mrej_from'];
    $mrej_to = $_POST['mrej_to'];
    $lout_from = $_POST['lout_from'];
    $lout_to = $_POST['lout_to'];
    $acin_from = $_POST['acin_from'];
    $acin_to = $_POST['acin_to'];
    $awar_from = $_POST['awar_from'];
    $awar_to = $_POST['awar_to'];
    $arej_from = $_POST['arej_from'];
    $arej_to = $_POST['arej_to'];
    $el_from = $_POST['el_from'];
    $el_to = $_POST['el_to'];
    $hl_from = $_POST['hl_from'];
    $hl_to = $_POST['hl_to'];

    $sql = "UPDATE schedule SET ";
    if (!empty($min_from)) {
        $sql .= "mcin_s=?, ";
        $params[] = $min_from;
    }
    if (!empty($min_to)) {
        $sql .= "mcin_e=?, ";
        $params[] = $min_to;
    }
    if (!empty($mwar_from)) {
        $sql .= "mwar_s=?, ";
        $params[] = $mwar_from;
    }
    if (!empty($mwar_to)) {
        $sql .= "mwar_e=?, ";
        $params[] = $mwar_to;
    }
    if (!empty($mrej_from)) {
        $sql .= "mrej_s=?, ";
        $params[] = $mrej_from;
    }
    if (!empty($mrej_to)) {
        $sql .= "mrej_e=?, ";
        $params[] = $mrej_to;
    }
    if (!empty($lout_from)) {
        $sql .= "lout_s=?, ";
        $params[] = $lout_from;
    }
    if (!empty($lout_to)) {
        $sql .= "lout_e=?, ";
        $params[] = $lout_to;
    }
    if (!empty($acin_from)) {
        $sql .= "acin_s=?, ";
        $params[] = $acin_from;
    }
    if (!empty($acin_to)) {
        $sql .= "acin_e=?, ";
        $params[] = $acin_to;
    }
    if (!empty($awar_from)) {
        $sql .= "awar_s=?, ";
        $params[] = $awar_from;
    }
    if (!empty($awar_to)) {
        $sql .= "awar_e=?, ";
        $params[] = $awar_to;
    }
    if (!empty($arej_from)) {
        $sql .= "arej_s=?, ";
        $params[] = $arej_from;
    }
    if (!empty($arej_to)) {
        $sql .= "arej_e=?, ";
        $params[] = $arej_to;
    }
    if (!empty($el_from)) {
        $sql .= "el_s=?, ";
        $params[] = $el_from;
    }
    if (!empty($el_to)) {
        $sql .= "el_e=?, ";
        $params[] = $el_to;
    }
    if (!empty($hl_from)) {
        $sql .= "hl_s=?, ";
        $params[] = $hl_from;
    }
    if (!empty($hl_to)) {
        $sql .= "hl_e=?, ";
        $params[] = $hl_to;
    }
    // Remove the last comma and space from the SQL statement
    $sql = rtrim($sql, ", ");
    // Add the WHERE clause to update only the row with title="office"
    $sql .= " WHERE title=?";
    // Add the title parameter to the SQL statement parameters
    $params[] = "workshop";
    // Execute the SQL statement
    $stmt = sqlsrv_query($conn, $sql, $params);
    // Check for SQL query errors
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $info = "<small>Schedule UPDATED Successfully!</small>";
    $_SESSION['update'] = $info;
    echo '<script>window.location.href = "../Adminstrator/index.php";</script>';
}
