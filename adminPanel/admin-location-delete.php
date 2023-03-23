<?php

include 'config.php';

// This config.php file is requried to connect to the database

//Error reporting to check and report and errors

error_reporting(0);

//Creates session to create public variables

session_start();



$received_table_name = $_POST['tablenew'];
$received_location = $_POST['locationnew'];
$received_school_name = $_POST['schoolnew'];

//connects to database


$con = mysqli_query($conn, "DELETE FROM $received_table_name WHERE location = '$received_location'");


//sends user back to previous page

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>