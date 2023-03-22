<?php

include 'config.php';

// This config.php file is requried to connect to the database

//Error reporting to check and report and errors

error_reporting(0);

//Starts session to get global variables

session_start();


$received_location = $_POST['locationnew'];
$received_school_name = $_POST['schoolnew'];
$table_name = $_POST['tablenew'];

//Created global php variables

$_SESSION['global_location_name'] = $received_location;

$_SESSION['global_school_name'] = $received_school_name;

$_SESSION['global_table_name'] = $table_name;

//Send user to this page

header("Location: admin-location-edit.php");
?>