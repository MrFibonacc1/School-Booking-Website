<?php 

//This page showcases all the people who were blocked by a school or an admin
//It gets the required variables globally and then connects to the database to get the number
//of blocked people
//It will create a for loop for that amount of people, each time creating a new row with data
//In each loop, it gets data for every blocked member, if there are any
//The user has the option to unblock them or accept them, which will redirect them to another page
//There are multiple PHP forms used to create the unblock and accept buttons, two PHP forms are 
//on every row of data
//Then the row of data goes into CSS and gets styling to look good


include 'config.php';

error_reporting(0);


session_start();

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}


$adminusername = ($_SESSION['adminusername']);
$get_id = ($_SESSION['id']);

$access_check_1 = "2";

$code_1 = "SELECT special_code FROM adminusers WHERE id='$get_id'";
$code_result = mysqli_query($conn, $code_1);
$code_check = mysqli_num_rows($code_result);

if($code_check > 0 ){

    while ($row = mysqli_fetch_assoc($code_result)){
        // $current_code = $row['1'];
        $current_code = $row['special_code'];

    }
}





$request_number = "SELECT * FROM users WHERE code_1='$current_code' AND access_1 = '$access_check_1'";
$request_result = mysqli_query($conn, $request_number);
$request_check_string = mysqli_num_rows($request_result);
$request_check = (int)$request_check_string;

$location_table_1 = "SELECT locations_table FROM adminusers WHERE id='$get_id'";
$location_result = mysqli_query($conn, $location_table_1);
$location_check = mysqli_num_rows($location_result);

if($location_check > 0 ){

    while ($row = mysqli_fetch_assoc($location_result)){
        // $current_code = $row['1'];
        $get_location_tables = $row['locations_table'];

    }
}






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

        <li = class="list">
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
            <a href="admin-page.php">
                <span class = "icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class = "title">Code</span>
            </a>
        </li>

        <li = class="list active">
            <a href="#view-teachers">
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


<a href="admin-page-requests.php" class="request_1">Join Requests<hr></a>





<a href="admin-page-members.php" class="request_1">Current Members<hr></a>





<a href="admin-page-blocked.php" class="request_1_active">Blocked Members<hr></a>


</div>









<div class="teach-page-1" >






<?php 


$r = mysqli_query($conn, "SELECT username, email FROM users WHERE code_1='$current_code' AND access_1 = '$access_check_1'");

while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
    
     $fullname = $row[0];
     $email = $row['1'];

    //  $_SESSION['name'] = $fullname;
    //  $_SESSION['email'] = $email;
        
  

    
    ?>

    
<div class="request_box">

<div class="request_separation">
    <h1> <?php echo $fullname   ?></h1>
    <h3><br><?php echo $email   ?></h3>
</div>

<div class="request_separation_2">
    
    <!-- <a href="accept_request.php" class="request_buttons" id="req_btn_2">Accept</a> -->
    <form action="accept_request.php" method="POST">
        <input type="hidden" name="name" value="<?php echo $fullname ?>">
        <input type="hidden" name="email" value="<?php echo $email ?>">
        <input type="hidden" name="table" value="<?php echo $get_location_tables ?>">

        <input type="submit" name="submitbtn" class="request_buttons_new" id="req_btn_2" value="Accept">
        
    </form>

    <!-- <a href="deny_request.php" class="request_buttons" id="req_btn_3">Unblock</a> -->


    <form action="deny_request.php" method="POST">
        <input type="hidden" name="name" value="<?php echo $fullname ?>">
        <input type="hidden" name="email" value="<?php echo $email ?>">
        <input type="hidden" name="table" value="<?php echo $get_location_tables ?>">

        <input type="submit" name="submitbtn" class="request_buttons_new" id="req_btn_2" value="Unblock">
        
    </form>

</div>



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