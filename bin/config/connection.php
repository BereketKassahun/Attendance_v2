<?php

session_start();

// Connection parameters
$serverName = "DESKTOP-ABD5D4G\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "Image_print",
    "Uid" => "",
    "PWD" => ""
);

// Establish connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}


?>