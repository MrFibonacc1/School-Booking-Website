<?php 

//This page is for editing the locations name. 
//I start a session and connect to database so that i can get global PHP variables and update the database 
//Using several methods i first get the users name and other information like email
//I have a PHP form that when submitted will get the users input
//If the users input is valid and is not repeated in the database, it will connect to the database and update it

//Most pages have a nav bar which connects to other pages

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






$received_location = $_SESSION['global_location_name'];
$received_school_name = $_SESSION['global_school_name'];
$received_table_name = $_SESSION['global_table_name'];

// $received_location = $_POST['locationnew'];
// $received_school_name = $_POST['schoolnew'];







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



<a href="admin-page-create.php" class="request_1">Create New Location<hr></a>






</div>

<?php


if (isset($_POST['submit'])) {
	$change_location = $received_location;
    $new_location = ($_POST['location']);

    

    
    
	$sql = "SELECT * FROM $table_name WHERE location = '$change_location'";
	$result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM $table_name WHERE location = '$new_location'";
	$result_2 = mysqli_query($conn, $sql);

	if ($result->num_rows > 0 && !$result_2->num_rows) {
		// $row = mysqli_fetch_assoc($result);

        $con = mysqli_query($conn, "Update $table_name set location = '$new_location' where location = '$received_location'");

        // $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Wow! User Registration Completed.')</script>";
            $received_location = $new_location;
            $change_location = $new_location;
            $_SESSION['global_location_name'] = $new_location;

            
            // $get_name = $new_name;
            // $get_email = $new_email; 
            header("Location: admin-location-edit.php");
            // $adminusername = $new_name;



        
            
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }



	} else {
		echo "<script>alert('Woops!  ormmm Password is Wrong.')</script>";
	}

}

?>





    <div class="teach-page-1" >

        <a href="admin-page-location.php" class="view_all" >Back</a>


        
            <div class="request_box">

                <div class="request_separation">
                    <h1> <?php echo $received_location   ?></h1>
                    <h3><br><?php echo $received_school_name   ?></h3>
                </div>
<!-- Line -->
                <div class="request_separation_2">
                    <!-- <a href="accept_request.php" class="request_buttons" id="req_btn_1" >Accept</a> -->



                    <a href="admin-location-view.php" class="request_buttons" id="req_btn_4">View All Bookings</a>



                </div>



            </div>


            <div class="code-center" id="space_above">


                        <form action="admin-location-edit.php" method="POST" class="special-code">

                       
                        <div class="input-content">
                                    <input type="text" placeholder="location" name="location" value="<?php echo $received_location?>" >
                                </div>

                        <div class="input-content">
                                    <button name="submit" class="code-button">Change</button>
                                </div>

                        </form>


            </div>





    </div>

    


</div>

</body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>