
<?php

//This is where a school admin can register their school and create an admin account
//All the inputs are done via a PHP form, which records the input as string variables, when submitted
//It connects with database using SQL to see if name or email already exists
//If not exist, the user will have their details inserted into a new row on the admins table
//The password is encrypted using Md5 style which is very hard to break

//Each time an admin is created, a new table is created. 
//This table will have a direct relationship with the admin's row
//This new table will contain all locations and bookings made in that school and by whoever joins
//The table will also create all the colums and the variable and their types
//Page also creates global PHP variables of the admin's ID and other details


include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['adminusername'])) {
    header("Location: index.php");
}



if (isset($_POST['submit'])) {
	$username = $_POST['adminusername'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$blank = '000';
	$school = "Rename School";

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result2 = mysqli_query($conn, $sql);
		$sql = "SELECT * FROM adminusers WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		
		if (!$result->num_rows > 0 AND !$result2->num_rows > 0) {
			// $sql = "INSERT INTO adminusers (adminusername, email, password, special_code)
			// 		VALUES ('$username', '$email', '$password', '$blank')";

			$input_username = str_replace(' ','',$username);
			$table_name = (string)$input_username;

			$sql_3 = "INSERT INTO adminusers (adminusername, email, password, special_code, school, locations_table)
			VALUES ('$username', '$email', '$password', '$blank', '$school', '$table_name')";
			$result = mysqli_query($conn, $sql_3);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				

					
					$create = "CREATE TABLE IF NOT EXISTS ".$table_name ."(booking_id INT NOT NULL AUTO_INCREMENT,
					name VARCHAR(64) NOT NULL,
					email VARCHAR(64) NOT NULL,
					description TINYBLOB NOT NULL,
					school_code VARCHAR(32) NOT NULL,
					location VARCHAR(64) NOT NULL,
					school VARCHAR(64) NOT NULL,
					date DATE NULL,
					time_start VARCHAR(12) NULL,
					time_end VARCHAR(12) NULL,
					PRIMARY KEY (booking_id)
					)";
				
				
					$create_now = mysqli_query($conn, $create);
					

					$username = "";
					$email = "";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
					$_POST['password'] = "";
					$_POST['cpassword'] = "";

					header("Location: adminlogin.php");







			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
			$_POST['password'] = "";
			$_POST['cpassword'] = "";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
		$_POST['password'] = "";
		$_POST['cpassword'] = "";
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style2.css">

	<title>Admin Register</title>
</head>
<body id="loginpage">
	<div class="containerlogin">
		<form action="" method="POST" class="login-email">
            <a href="index.php" class="back">Back</a>
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Admin Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="adminusername" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Admin Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="adminlogin.php">Admin Login Here</a>.</p>
		</form>
	</div>
</body>
</html>
