
<?php
  session_start();
  include 'config.php';
  
  if (isset($_SESSION['st_email'])) {
    $eemail=$_SESSION['st_email'];
  }
  
  



if(isset($_POST['submit'])){

   $namep=$_POST['username'];
   $imglink=$_POST['img'];  

  $sql = "UPDATE `users` SET `username`='$namep',`imgLink`='$imglink'  WHERE `email`='$eemail'";
  
  $result = mysqli_query($conn, $sql);  


 
  

}











 ?>


<!DOCTYPE html>
<html lang="en">
<head>
 

    <meta name="author" content="Codeconvey" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

    <!--Only for demo purpose - no need to add.-->
    <link rel="stylesheet" href="css/demo.css" />
    <link rel="stylesheet" href="css/profile_edit.css" />

	    <link rel="stylesheet" href="css/profilestyle.css">
</head>


<body>
		


<header class="ScriptHeader">
    <div class="rt-container">
    	<div class="col-rt-12">
        	<div class="rt-heading">
            	<!-- <h1>Edit Profile</h1> -->
                <!-- <p></p> -->
            </div>
        </div>
    </div>
</header>


<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              

 

      <div class="container bootstrap snippets bootdey">
      <a href="profile.php"><h1 style="color:White;"><i class="fa fa-angle-left"></i></h1></a>

    <!-- <label class="col-lg-3 control-label"><h5>Change profile picture</h5></label> -->
    <!-- <i class="fa fa-angle-left"></i><a href="course_review.php"> Back</a> -->
    <form action=""  method="POST" >

      <hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="<?php 

$sql = "SELECT * FROM users WHERE email='$eemail'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
$row = mysqli_fetch_array($result);
$name=$row['imgLink'];
echo $name;

;} 
            ?>" class="avatar img-circle img-thumbnail" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control" name="img" value="ji">

        </div>
      </div>

    
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
         
        </div>
        <h3>Personal info</h3>
        

          <div class="form-group">
            <label class="col-lg-3 control-label">User name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php 

                $sql = "SELECT * FROM users WHERE email='$eemail'";
  
                $result = mysqli_query($conn, $sql);
              
               if ($result->num_rows > 0) {
                $row = mysqli_fetch_array($result);
                $name=$row['username'];
                echo $name;
              
              
              }
              
              
              ?>"name="username">
            </div>
          </div>
        

            <!-- <h2>Course info</h2>
            <h2><br></h2>


            <a href="completed_courses.php?where=profileEdit">  <h4 style="color:White;"><i class="fas fa-plus-circle"></i> Add Completed Courses</h4><br> </a>
            <a href="remove_completed_courses.php">  <h4 style="color:#C9144B;"><i class="fas fa-minus-circle"></i> Remove Completed Courses</h4><br> </a>
            <a href="running_course.php?where=profileEdit">  <h4 style="color:White;"><i class="fas fa-plus-circle"></i> Add Running Courses</h4><br> </a>
        -->
        
          <button name="submit" class="btn">Change</button>

</form>

      </div>
  </div>
</div>
<hr>
      



              <!-- <p>Hi</p> -->
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>


	</body>
</html>