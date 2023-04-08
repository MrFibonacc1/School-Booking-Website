<?php

//This page acts as a bridge
//When the block button is clicked on the requests page
//This page will gets that users details via a global variable
//It will connect with the database and update the users status to being blocked
//Being blocked will make the user unable to send requests to that school
//The page will first check if a user is blocked before allowing that user to do anything

include 'config.php';

error_reporting(0);


session_start();

// $received_name = $_SESSION['name'];
// $received_email = $_SESSION['email'];

$received_name = $_POST['name'];
$received_email = $_POST['email'];
$received_locations_table = $_POST['table'];



$accepted = (int)2;

$con = mysqli_query($conn, "Update users set access_1 = '$accepted' where username = '$received_name'");






header('Location: ' . $_SERVER['HTTP_REFERER']);?>