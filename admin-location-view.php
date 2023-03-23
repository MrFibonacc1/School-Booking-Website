<?php 

//This page is where the admin can view all bookings in each location
//First the page gets the necessary files and connects to teh database
//The required variables are received from the public variable
//The page will make a request to get the number of bookings in the database and make that many rows
//The PHP is done in a for loop to repeat the data for each row, so each row of data is recieved in each cycle
//The data is then displayed in a nested list

include 'config.php';

error_reporting(0);


session_start();

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}



$get_id = ($_SESSION['id']);


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

// $table_number = "SELECT DISTINCT (location) FROM $table_name WHERE email = '$get_email' ";
// $table_result = mysqli_query($conn, $table_number);
// $table_check_string = mysqli_num_rows($table_result);
// $get_number_locations = (int)$table_check_string;






$received_location = $_SESSION['global_location_name'];
$received_school_name = $_SESSION['global_school_name'];
$received_table_name = $_SESSION['global_table_name'];







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


<a href="admin-location-edit.php" class="request_1_active">Current Bookings<hr></a>



</div>


<div class="back_back"> 
        <a href="admin-page-location.php" class="view_all" >Back</a>
    </div>


<div class="edit-container" >

   



<?php 

$number = mysqli_query($conn, "SELECT DISTINCT(location), school FROM $table_name WHERE email =
 '$get_email' ORDER BY location ASC");

while ($row = mysqli_fetch_array($number, MYSQLI_NUM)) {
  

    $location_name = $row[0];
    // $get_school_name = $row[1];

    //  $_SESSION['global_location_name'] = $location_name;
    //  $_SESSION['global_table_name'] = $table_name;
    //  $_SESSION['global_school_name'] = $get_school_name;

    
    ?>


<ul class="responsive-table">
    <li class="table-header " id="table-header-header">
        <div > <?php echo $location_name ?> </div>
       
         
    </li>



    <li class="table-header">
        
            <div class="col col-1">Name</div>
            <div class="col col-2">Email</div>
            <div class="col col-3">Location</div>
            <div class="col col-4">Time</div>
        
    </li>

<?php 

$number_2 = mysqli_query($conn, "SELECT name, email, location, time_start, time_end FROM $table_name WHERE location = '$location_name'");
while ($row = mysqli_fetch_array($number_2, MYSQLI_NUM)) {
    $user_name = $row['0'];
    $user_email = $row['1'];
    $user_location = $row['2'];
    $time_start = $row['3'];
    $time_end = $row['4'];


    $input = $time_start . " to ". $time_end;

?>

    <li class="table-row">
      <div class="col col-1" data-label="Job Id"><?php echo $user_name ?></div>
      <div class="col col-2" data-label="Customer Name"> <?php echo $user_email ?></div>
      <div class="col col-3" data-label="Amount"><?php echo $user_location?></div>
      <div class="col col-4" data-label="Payment Status"><?php echo $input ?></div>
    </li>




   <?php }  ?>
  </ul>

  







<?php } ?>

</div>




</div>







</body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>

<!-- <table>

<th>Name</th>
<th>Email</th>
<th>Location</th>




<?php

//$select = "SELECT * FROM $received_table_name";
//$result = mysqli_query($conn, $select);

//while ($row = mysqli_fetch_array($result)) { ?>
<tr>
<td> <?php //echo $row['name']  ?>  </td>
<td> <?php //echo $row['email']  ?> </td>
<td> <?php //echo $row['location']  ?> </td>



</tr>
<?php //} ?>

</table> -->
