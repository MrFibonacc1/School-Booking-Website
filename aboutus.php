
<?php 

session_start();
//This is for strarting a session in Php and is used to connect with other pages, e.g. global php variables

?>

<!DOCTYPE html>
<html>
    <head>
        <title>About Us Section</title>

<!-- Title of page -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <link rel="stylesheet" type="text/css" href="home.css">
    </head>
    <body id="covid-body">

<!-- Main body of the page -->

    <header id="homeheader">
		
		<nav>	
		 <ul class="nav-bar"><div class="bg"></div>

         <!-- This is the nav bar, it uses Php to check if a user session or a admin session is active,
        depending on their session it will take it to their pofile page. -->

         <?php if (($_SESSION['username']) or ($_SESSION['adminusername']) ) { ?> 

        <li><a class="nav-link active" href="index.php">Home</a></li>
        <li><a class="nav-link" href="contactus.php">Contact</a></li>
        <li><a class="nav-link" href="logout.php">Log Out</a></li>

        <?php } else { ?> 

            <!-- If any user is logged in, it will change the nav options, e.g. remove the log in and register button
        and if their is no user logged in, it will add the register and log in button to the nav -->

        <li><a class="nav-link active" href="index.php">Home</a></li>
        <li><a class="nav-link" href="adminlogin.php">Admin</a></li>
        <li><a class="nav-link" href="contactus.php">Contact</a></li>
        <li><a class="nav-link" href="login.php">Login</a></li>
        <li><a class="nav-link" href="register.php">Register</a></li>

        <?php } ?>


		 </ul>
			
			
		</nav>

	</header>

        <div class="section">
            <div class="container">

                <div class="title">
                    <!-- Title of page -->
                    <h1>About Us</h1>

                </div>
                <div class="covid-content">
                    <div class="article">

                            <!-- Content of the about us page -->
                        <h3>A booking service for teachers</h3>
                        <p>EduBooking is a service for physical education teachers to book fields and gyms for sports teams. Built in Ms Torres Grade 12 Computer Science class in 2021. Allows for students to easily view the timings of their sessions without the need of assistance from teachers. </p>
                           
                    </div>
                </div>
                <div class="covid-image-section">
                        <img src="https://p13cdn4static.sharpschool.com/UserFiles/Servers/Server_232765/Image/academics/PhysEd%20Teachers-0734.jpg">
                </div>

<!-- All the social media links -->

    <div class="covid-social">
        <a href=""><i class="fab fa-facebook-f"></i></a>
        <a href=""><i class="fab fa-twitter"></i></a>
        <a href=""><i class="fab fa-instagram"></i></a>
    
    </div>
</div>
</div>
</body>
</html>

