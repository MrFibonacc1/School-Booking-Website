<?php 

//On this page, the admin can view all current locations
//The admin can access his whole profile which is like the other page
//Admin has option to add new location, delete current location or edit a current location
//Each button is a PHP form put into a for loop
//It will redirect the user to another page
//In order to display all locations for that school, it will get global PHP variables and search the database
//for similar details
//After recieving all the required details, the for loop will continue and create a new row of data which will
//inserted to each div box to be displayed

include 'config.php';

error_reporting(0);


session_start();

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}


$adminusername = ($_SESSION['adminusername']);
$get_id = ($_SESSION['id']);

$access_check_1 = "1";

$code_1 = "SELECT special_code FROM adminusers WHERE id='$get_id'";
$code_result = mysqli_query($conn, $code_1);
$code_check = mysqli_num_rows($code_result);

if($code_check > 0 ){

    while ($row = mysqli_fetch_assoc($code_result)){
        // $current_code = $row['1'];
        $current_code = $row['special_code'];

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








$table_1 = "SELECT locations_table FROM adminusers WHERE id='$get_id'";
$table_1_result = mysqli_query($conn, $table_1);
$table_check = mysqli_num_rows($table_1_result);

if($table_check > 0 ){

    while ($row = mysqli_fetch_assoc($table_1_result)){
        // $current_code = $row['1'];
        $table_name = $row['locations_table'];

    }
}

$table_number = "SELECT DISTINCT (location) FROM $table_name WHERE email = '$get_email' ";
$table_result = mysqli_query($conn, $table_number);
$table_check_string = mysqli_num_rows($table_result);
$get_number_locations = (int)$table_check_string;














// $get_number_locations_check = "SELECT * FROM information_scheme_tables WHERE school_code ='000'";
// $number_locations_result = mysqli_query($conn, $get_number_locations_check);
// $get_number_locations = mysqli_num_rows($number_locations_result);
// $request_check = (int)$request_check_string;








?>


<!DOCTYPE html>
<html lang="en">



<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complete responsive personal portfolio website design tutorial</title>
 
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">

</head>

<body id="teach-content">

<!-- <div id="teach-nav"> -->
    <div class="adminnavigation">

<ul>
        <li = class="list">
            <a href="admin-page-profile.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Profile</span>
               
                
            </a>
        </li>

        <li = class="list active">
            <a href="admin-page-location.php">
            <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Locations</span>
                
            </a>
        </li>

        <li = class="list">
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
            <a href="admin-page-members.php">
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

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>

const list = document.querySelectorAll('.list');
function activeLink(){
    list.forEach((item) =>
    item.classList.remove('active'));
    this.classList.add('active');
}
list.forEach((item) =>
item.addEventListener('click',activeLink));
</script>

<div id="teach-pages">

<div class="profile-title-menu">


<a href="admin-page-location.php" class="request_1_active">Current Locations<hr></a>



<a href="admin-page-create.php" class="request_1">Add Location<hr></a>






</div>





<div class="teach-page-1" >

    <a href="admin-location-view.php" class="view_all" >View All Bookings</a>





<?php 


$r = mysqli_query($conn, "SELECT DISTINCT(location), school FROM $table_name WHERE email = '$get_email' ORDER BY location ASC");

while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
    
   
    $location_name = $row[0];
    $get_school_name = $row[1];


    //  $_SESSION['global_location_name'] = $location_name;
    //  $_SESSION['global_table_name'] = $table_name;
    //  $_SESSION['global_school_name'] = $get_school_name;

    
    ?>

    
<div class="request_box">

<div class="request_separation">
    <h1> <?php echo $location_name   ?></h1>
    <h3><br><?php echo $get_school_name   ?></h3>
</div>

<div class="request_separation_2">
    <!-- <a href="accept_request.php" class="request_buttons" id="req_btn_1" >Accept</a> -->



    <form action="admin-location-bridge.php" method="POST">
        <input type="hidden" name="locationnew" value="<?php echo $location_name ?>">
        <input type="hidden" name="schoolnew" value="<?php echo $get_school_name ?>">
        <input type="hidden" name="tablenew" value="<?php echo $table_name ?>">


        <input type="submit" name="locationbtn" value="Edit" class="request_buttons_new" id="req_btn_2">
        
    </form>




    <form action="admin-location-delete.php" method="POST">
        <input type="hidden" name="locationnew" value="<?php echo $location_name ?>">
        <input type="hidden" name="schoolnew" value="<?php echo $get_school_name ?>">
        <input type="hidden" name="tablenew" value="<?php echo $table_name ?>">

        <input type = "submit" name="submit2" class="request_buttons_new" id="req_btn_2" value="Delete Location">
    </form>

    <!-- <a href="admin-location-edit.php" class="request_buttons" id="req_btn_2">Edit Location</a>

    <a href="admin-location-delete.php" class="request_buttons" id="req_btn_3">Delete Location</a> -->

</div>
<?php  

// if (isset($_POST['locationbtn'])) {
// 	$location = $_POST['location'];
//     // $table_input = $_POST['table'];

// 	// $password = ($_POST['password']);
//     $_SESSION['global_table_name'] = $table_name;
//     $_SESSION['global_location_name'] = $location;
//     header("Location: admin-location-edit.php");

// }

// if (isset($_POST['submit2'])) {
// 	$location = $_POST['location'];
// 	// $password = ($_POST['password']);
    // $_SESSION['global_table_name'] = $table_name;

    // $_SESSION['global_location_name'] = $location_name;

//     header("Location: admin-location-delete.php");

// }



?>


</div>





<?php  }  ?>




























</div>


</div>

</body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>