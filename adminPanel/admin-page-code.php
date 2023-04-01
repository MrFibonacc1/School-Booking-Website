<?php 

//This page allows the admin to change their schools name and code
//It gets the required variables from the global PHP variables created when someone logs in
//It connects to the database and gets the admin's current school code and name
//The admin then can input their new name and code, via a PHP form
//Once the submit is done, the PHP form creates variables for all inputs by user
//It goes into the database and first checks if the input is not duplicated in the database
//If the new school name and code are not already in use, the new data will be inputted into the database under the 
//admin's name and details


include 'config.php';

error_reporting(0);


session_start();

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}
$adminusername = ($_SESSION['adminusername']);
$get_id = ($_SESSION['id']);




// $getit = mysqli_query($conn, "SELECT special_code FROM adminusers WHERE adminusername='$adminusername'");
// $current_code = mysqli_query($conn, $getit);

$code_1 = "SELECT special_code FROM adminusers WHERE id='$get_id'";
$code_result = mysqli_query($conn, $code_1);
$code_check = mysqli_num_rows($code_result);

if($code_check > 0 ){

    while ($row = mysqli_fetch_assoc($code_result)){
        // $current_code = $row['1'];
        $current_code = $row['special_code'];

    }
}
$old_code = $code_1;


$school_1 = "SELECT school FROM adminusers WHERE id='$get_id'";
$school_result = mysqli_query($conn, $school_1);
$school_check = mysqli_num_rows($school_result);

if($school_check > 0 ){

    while ($row = mysqli_fetch_assoc($school_result)){
        // $current_code = $row['1'];
        $current_name = $row['school'];

    }
}











if (isset($_POST['submit'])) {
	$code = ($_POST['code']);
    $school_name = ($_POST['school']);
    
	$sql = "SELECT * FROM adminusers WHERE id='$get_id'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// $row = mysqli_fetch_assoc($result);
        $con_2 = mysqli_query($conn, "Update users set school_1 = '$school_name' where code_1 = '$current_code'");

        $sql_2 = "SELECT * FROM adminusers WHERE special_code='$code'";
		$code_check_new = mysqli_query($conn, $sql_2);
        
        if (!$code_check_new->num_rows > 0) {
            $con_3 = mysqli_query($conn, "Update users set code_1 = '$code' where school_1 = '$school_name'");

            $con = mysqli_query($conn, "Update adminusers set special_code = '$code', school = '$school_name' where id = '$get_id'");
    
        }else{
            echo "<script>alert('Code is already in use!')</script>";
            $con_4 = mysqli_query($conn, "Update adminusers set school = '$school_name' where id = '$get_id'");


        }


     
        $result = mysqli_query($conn, $sql);

        if ($result) {
            
            echo "<script>alert('Wow! User Registration Completed.')</script>";

            $code_1 = "SELECT special_code FROM adminusers WHERE id='$get_id'";
            $code_result = mysqli_query($conn, $code_1);
            $code_check = mysqli_num_rows($code_result);
            
            if($code_check > 0 ){
            
                while ($row = mysqli_fetch_assoc($code_result)){
                    // $current_code = $row['1'];
                    $current_code = $row['special_code'];
            
                }
            }

            $current_name = $school_name;




            header("Location: admin-page-code.php");

            
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }



	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}

}
////////////////////////////////////////////////////////////////////////////////
// if (isset($_POST['submit2'])) {
//     $school_name = $_POST['schoolname'];

//     $sql_2 = "SELECT * FROM adminusers WHERE adminusername='$adminusername'";
// 	$result = mysqli_query($conn, $sql_2);
// 	if ($result->num_rows > 0) {
// 		$row = mysqli_fetch_assoc($result);
//         $adminusername = ($_SESSION['adminusername']);

//         $con_2 = mysqli_query($conn, "Update adminusers set school_name = '$school_name' where adminusername = '$adminusername'  ");
//         $result = mysqli_query($conn, $con_2);

//         if ($result) {
//             echo "<script>alert('Wow! User Registration Completed.')</script>";

//             $school_1= "SELECT school_name FROM adminusers WHERE adminusername='$adminusername'";
//             $school_result = mysqli_query($conn, $school_1);
//             $school_check = mysqli_num_rows($school_result);
            
//             if($school_check > 0 ){
            
//                 while ($row = mysqli_fetch_assoc($school_result)){
//                     // $current_code = $row['1'];
//                     $current_schoolname = $row['school_name'];
            
//                 }
//             }else{
//                 echo "<script>alert('Woops! Something Wrong Went.')</script>";
//             }

          
//             $_POST['schoolname'] = "";
            
//         } else {
//             echo "<script>alert('Woops! Something Wrong Went.')</script>";
//         }


//     }
// 	 else {
// 		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
// 	}


// }


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

        <li = class="list active">
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







<section class="teach-page" id="school-code">

<div class="profile-title">
<h1 class="heading"> <span></span>Code</h1>
</div>
                    <div class="code-center">

                        

                        <form action="admin-page-code.php" method="POST" class="special-code">

                        <div class="code-content">
                        <h1>Current Name:</h1>
                        <h2> 
                        <?php echo $current_name ?> </h2>
                        </div>

                        <div class="code-content">
                        <h1>Current Code:</h1>
                        <h2> 
                        <?php echo $current_code ?> </h2>
                        </div>

                        <div class="input-content">
                                    <input type="text" placeholder="Code" name="code" value="<?php echo $current_code?>" >
                                </div>

                        <div class="input-content" id="input-content-id">
                                    <input type="text" placeholder="Schoolname" name="school" value="<?php echo $current_name?>" >
                                </div>


                        <div class="input-content">
                                    <button name="submit" class="code-button">Update</button>
                                </div>

                        </form>
                        </div>

<!-- 
\/////////////////////////////////////////////////////////////////////////////////////////////////////
/ -->




                        <!-- <div class="code-center">

                        

                        <form action="admin-page.php" method="POST" class="special-code">

                        <div class="code-content">
                        <h1>School Name:</h1>
                        <h2> 
                            
                        
                    </h2>
                        </div>

                        <div class="input-content">
                                    <input type="text" placeholder="Schoolname" name="school" value="" >
                                </div>

                        <div class="input-content">
                                    <button name="submit" class="code-button">Change</button>
                                </div>

                        </form>
                        </div> -->


</section>




</div>

</body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>