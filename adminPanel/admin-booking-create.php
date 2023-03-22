<?php 

// This config.php file is requried to connect to the database

include 'config.php';

//Check and reports any connection to database errors

error_reporting(0);

//Starts session to get and create glboal variables

session_start();

//Checks if the user is admin, if not admin, then send back to home page

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}


$adminusername = ($_SESSION['adminusername']);
$get_id = ($_SESSION['id']);

//Gets the logged in users current name by checking if ID matches the ID when user logged in
//It connects to the databse to check and get all the information of the user
//The same process is used to get other user information which can be see until line 100

$name_1 = "SELECT adminusername FROM adminusers WHERE id='$get_id'";
$name_result = mysqli_query($conn, $name_1);
$name_check = mysqli_num_rows($name_result);

if($name_check > 0 ){

    while ($row = mysqli_fetch_assoc($name_result))
    {
        // $current_code = $row['1'];
        $get_name = $row['adminusername'];

    }
}

//Gets the admins school name by checking with ID number

$school_1 = "SELECT school FROM adminusers WHERE id='$get_id'";
$school_result = mysqli_query($conn, $school_1);
$school_check = mysqli_num_rows($school_result);

if($school_check > 0 ){

    while ($row = mysqli_fetch_assoc($school_result)){
        // $current_code = $row['1'];
        $current_school = $row['school'];

    }
}



$email_1 = "SELECT email FROM adminusers WHERE id='$get_id'";
$email_result = mysqli_query($conn, $email_1);
$email_check = mysqli_num_rows($email_result);

if($email_check > 0 ){

    while ($row = mysqli_fetch_assoc($email_result)){
        // $current_code = $row['1'];
        $get_email = $row['email'];

    }
}

$code_1 = "SELECT special_code FROM adminusers WHERE id='$get_id'";
$code_result = mysqli_query($conn, $code_1);
$code_check = mysqli_num_rows($code_result);

if($code_check > 0 ){

    while ($row = mysqli_fetch_assoc($code_result)){
        // $current_code = $row['1'];
        $current_code = $row['special_code'];

    }
}


$table_1 = "SELECT locations_table FROM adminusers WHERE id='$get_id'";
$table_1_result = mysqli_query($conn, $table_1);
$table_check = mysqli_num_rows($table_1_result);

if($table_check > 0 ){

    while ($row = mysqli_fetch_assoc($table_1_result)){
        // $current_code = $row['1'];
        $table_name = $row['locations_table'];

    }
}



//This is a listener and checks when the user clicks the submit button on the PHP form
//The input from the user will be saved and then it can be used to update the database or add to the database

if (isset($_POST['submit'])) {
	$name = ($_POST['fullname']);
    $booking_name = ($_POST['booking_name']);
    $location = ($_POST['location']);

    $date = ($_POST['date']);
    $time_start = ($_POST['time_start']);
    $time_end = ($_POST['time_end']);

    $description = "blank";


    

    
    

		// $row = mysqli_fetch_assoc($result);

        $sql_3 = "INSERT INTO $table_name (name, email, description, school_code, location, school, date, time_start, time_end)
			VALUES ('$name', '$get_email', '$description', '$current_code', '$location', '$current_school', '$date', '$time_start', '$time_end')";
			$result = mysqli_query($conn, $sql_3);

        if ($result) {
            echo "<script>alert('Wow! User Registration Completed.')</script>";


            
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }


}




?>



<!DOCTYPE html>
<html lang="en">



<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
 
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">

</head>

<body id="teach-content">

<!-- This is the nav bar for the admin page and appears on left side of the screen,
this contains all the nav to other pages.  -->

    <div class="adminnavigation">

<ul>
        <li = class="list">
            <a href="admin-page-profile.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Profile</span>
               
                
            </a>
        </li>

        <li = class="list">
            <a href="admin-page-location.php">
            <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Locations</span>
                
            </a>
        </li>

        <li = class="list active">
            <a href="admin-booking-create.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Add Booking</span>
            </a>
        </li>

        <li = class="list">
            <a href="admin-page-code.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Code</span>
            </a>
        </li>

        <li = class="list">
            <a href="admin-page-requests.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Teachers</span>
            </a>
        </li>

        <li = class="list">
            <a href="index.php">
            <span class = "icon"><ion-icon name="home-outline"></ion-icon></span>

                <span class = "title">Home</span>
            </a>
        </li>

        <li = class="list">
            <a href="logout.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Sign Out</span>
            </a>
        </li>


    </ul>

</div>

<!-- Importing a script for JQuery -->

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>

// This is for JQuery and changes the admin nav bar to be the one selected by the user

const list = document.querySelectorAll('.list');
function activeLink(){
    list.forEach((item) =>
    item.classList.remove('active'));
    this.classList.add('active');
}
list.forEach((item) =>
item.addEventListener('click',activeLink));

</script>

<!-- The main body and content of the page -->

<div id="teach-pages">

<section class="teach-page" id="admin-profile">
<div class="profile-title"> 

<!-- Title of section -->

<h1 class="heading"> <span></span>Add Booking</h1>
</div>

    <div class="code-center">

    <!-- This is the PHP form where user insert their content and change or add data to the database -->

      <form action="admin-booking-create.php" method="POST" class="special-code">

                        

                
                    <div class="booking_main">

                        <div class="box_create">

                                <div class="input-content specialcase">
                                            <input type="text" placeholder="Fullname" name="fullname" value="" required>
                                </div>

                                <div class="input-content specialcase" id="input-content-id">
                                            <input type="text" placeholder="Booking Name" name="booking_name" value="" required>
                                </div>

                                <div class="input-content specialcase">
                                    <select name="location" placeholder = "Select Location" class="select_d" required>
                                            <option value="">Select Location</option>

                            <?php

                            //Connecting and doing a loop for the number of unique locations in the database of the selected school

                                $number = mysqli_query($conn, "SELECT DISTINCT(location) FROM $table_name ORDER BY location ASC");

                                while ($row = mysqli_fetch_array($number, MYSQLI_NUM)) {
                                
                                //Saves each variable
                                $location_name = $row[0];


                            ?>


                                            <option value="<?php echo $location_name ?>"><?php echo $location_name ?></option>

                                            <?php  } ?>
                                           
                                    </select>
                                </div>

                        </div>

                        <!-- Creates the same number of boxes with the users information to accept or deny the request -->

                         <div class="box_create">

                        
                            <div class="input-content specialcase">
                                        <input type="date" placeholder="dd/mm/yy" name="date" value="" required>
                            </div>

                            <div class="input-content specialcase" id="input-content-id">
                                        <input type="time" placeholder="dd/mm/yy" name="time_start" value="" required>
                            </div>

                            <div class="input-content specialcase" id="input-content-id">
                                        <input type="time" placeholder="dd/mm/yy" name="time_end" value="" required
                                        min="2022-01-01">
                            </div>


                        </div>
                    
                    </div>      
                        
                    <!-- This is the submit button  -->

                    <div class="input-content createbooking">
                        <button name="submit" class="code-button">Add</button>
                    </div>

                    

                    

                        </form>


    </div>







</section>


</div>

</body>

<!-- Avoids the pop up from reappearing when the page is refreshed, because of PHP form -->

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>