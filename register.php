
<?php 

if (isset($_POST['stdbtn'])) {
    
}

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$bb=$id[3].$id[4].$id[5];

	$batch = $bb;
	$semester = $_POST['semester'];
	// $credit = $_POST['credit'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username,id, email,batch,semester,credit, password)
					VALUES ('$username','$id', '$email','$batch','$semester','','$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				header('location:login.php');

				// echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";

			} else {
				// echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			// echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		// echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>






















<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  <div class="login-wrapper">
    
<form action="" class="form" method="POST">
      
       <a href="login.php" class="close">&times;</a>
      <img src="avatar.png" alt="">
      <h2>Sign Up</h2>

       <div class="input-group">
				<input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                 <label for="username">Name</label>

			</div>
			<div class="input-group">
				<input type="text" id="Student Id" name="id" value="<?php echo $id; ?>" required>
                 <label for="Student Id">Student ID</label>

			</div>
			<div class="input-group">
				<input type="email" id="Email" name="email" value="<?php echo $email; ?>" required>
				<label for="Email">Email</label>
			</div>
			
			<div class="input-group">
				<input type="text" id="Semester" name="semester" value="<?php echo $semester; ?>" required>
				<label for="Semester">Current Semester</label>
			</div>
			

			<div class="input-group">
				<input type="password" id="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
				<label for="Password">Password</label>
            </div>
            <div class="input-group">
				<input type="password" id="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
				<label for="Confirm Password">Confirm Password</label>
			</div>
			<div class="input-group">
            
                  <button name="submit" class="submit-btn">Register</button>
				
			</div>






      

      
  


  </form>




    
</body>
</html>




















