<?php 

//This is the main profile page for the admin when he first logins
//The page will get the requried variables from the global variables like the admin's ID
//The admin's ID used to get other information about the admin
//This will display the admin's current name in a box and gives them the choice to edit them and change
//their name or email
//When submitting the PHP form, it will connect to the database and check if the new name or email is in use
//If input not in use, it will update the admin's details in the database
//All connections to the database is done through MySqli Queries

include 'config.php';

error_reporting(0);


session_start();

if (!isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}
$adminusername = ($_SESSION['adminusername']);
$get_id = ($_SESSION['id']);


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

$email_1 = "SELECT email FROM adminusers WHERE id='$get_id'";
$email_result = mysqli_query($conn, $email_1);
$email_check = mysqli_num_rows($email_result);

if($email_check > 0 ){

    while ($row = mysqli_fetch_assoc($email_result)){
        // $current_code = $row['1'];
        $get_email = $row['email'];

    }
}

// $get_id = "SELECT id FROM adminusers WHERE adminusername='$adminusername'";
// $id_result = mysqli_query($conn, $get_id);
// $id_check = mysqli_num_rows($id_result);

// if($id_check > 0 ){

//     while ($row = mysqli_fetch_assoc($id_result)){
//         // $current_code = $row['1'];
//         $get_id = $row['id'];

//     }
// }





if (isset($_POST['submit_1'])) {
	$new_name = ($_POST['name']);
    $new_email = ($_POST['email']);
    

    
    
	$sql = "SELECT * FROM adminusers WHERE id = '$get_id'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// $row = mysqli_fetch_assoc($result);

        $con = mysqli_query($conn, "Update adminusers set adminusername = '$new_name', email = '$new_email' where id = '$get_id'");

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Wow! User Registration Completed.')</script>";

            
            $get_name = $new_name;
            $get_email = $new_email; 
            header("Location: admin-page-profile.php");
            // $adminusername = $new_name;



        
            
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }



	} else {
		echo "<script>alert('Woops!  or Password is Wrong.')</script>";
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
        <li = class="list active">
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

<section class="teach-page" id="admin-profile">
<div class="profile-title"> 
<h1 class="heading"> <span></span>Profile</h1>
</div>

    <div class="code-center">


      <form action="admin-page-profile.php" method="POST" class="special-code">

                        

                

                        <div class="input-content">
                                    <input type="text" placeholder="fullname" name="name" value="<?php echo $get_name?>" >
                                </div>

                        <div class="input-content" id="input-content-id">
                                    <input type="email" placeholder="email" name="email" value="<?php echo $get_email?>">
                                </div>
                                
                               
                        


                        <div class="input-content">
                                    <button name="submit_1" class="code-button">Update</button>
                                </div>

                        </form>


    </div>







</section>


</div>

</body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


</html>