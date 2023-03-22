<?php

// This config.php file is requried to connect to the database

include 'config.php';

error_reporting(0);

//Session need to be started in order to get global variables sent from the other page
session_start();




//This variables are beign received from the other php file

$received_name = $_POST['name'];
$received_email = $_POST['email'];
$received_locations_table = $_POST['table'];

//Default value to check if user has been accepted

$accepted = (int)3;


//Is connecting to the database and is updating the database

$con = mysqli_query($conn, "Update users set access_1 = '$accepted', locations_1 = '$received_locations_table' where username = '$received_name'");


//Send user back to their previous page

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>