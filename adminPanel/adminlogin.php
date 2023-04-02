
<?php 

//This is the main login page for admins. 
//The input fields are displayed via a PHP form
//When submitted the data is encrypted with Md5 style
//After connecting to the database, it will search the users to see if anyone matches the details
//If not, the page will say wrong email or password
//Page has external links to other pages, like forgot password and change password

//PHP form gets input and checks if matches with any records in database
//If matches, it will create global variables with the users ID and details
//These global PHP variable can be easily accessible from any php page
//The user is logged in and sent to admin profile

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['adminusername'])) {
    header("Location: admin-page-profile.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM adminusers WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['adminusername'] = $row['adminusername'];
		$_SESSION['id'] = $row['id'];
		header("Location: admin-page-profile.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
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
	<link rel="shortcut icon" type="image/jpg" href="Untitled_design_26_-removebg-preview.png"/>


	<title>Admin Login</title>
</head>
<body id="loginpage">
	<div class="containerlogin">
		<form action="" method="POST" class="login-email">
            <a href="index.php" class="back">Back</a>

			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Admin Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="adminregister.php">Admin Register Here</a>.</p>
			<p class="login-register-text">Forgot Password <a href="adminregister.php">Click Here</a>.</p>

		</form>
	</div>
</bodylogin>
</html>
