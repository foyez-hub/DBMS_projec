
<?php
  session_start();

if (!isset($_SESSION['st_email'])) {
    $eemail=$_SESSION['st_email'];
  }
  if (isset($_SESSION['username'])) {
    $name=$_SESSION['username'];
  }
  if (isset($_SESSION['st_email'])) {
    $eemail=$_SESSION['st_email'];
  }
  include 'config.php';
      $sql = "SELECT * FROM users WHERE email='$eemail'";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows > 0) {
          $row = mysqli_fetch_assoc($result);
          $id=$row['id'];
      } 

$canvote=true;
$title=$_GET['title'];

$str = str_replace(' ', '', $title);
// echo $str;

$sql2="SELECT * FROM `completed_courses` WHERE `stu_Id`='$id' AND `course_title`='$str'";
    $result2 = mysqli_query($conn, $sql2);
  //  echo $result2->num_rows;
		if ($result2->num_rows > 0) {



if(isset($_POST['submit'])){

    $sql1="SELECT * FROM `coursereview` WHERE `stu_Id`='$id' AND `course_title`='$title'";
    $result1 = mysqli_query($conn, $sql1);
		if ($result1->num_rows == 0) {
      
              $dif=$_POST['language'];
              $sql = "INSERT INTO `coursereview`(`stu_Id`, `course_title`, `difficulty`) VALUES ('$id','$title','$dif')";
                $result = mysqli_query($conn, $sql);
        }

   }
    

  }
  else{
    // header("Location:course_.php");
  
    // echo "<script>alert('Woops! You can't review this course')</script>";
    $canvote=false;

  }







 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Profile Page Design Example</title> -->

    <meta name="author" content="Codeconvey" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>


        <link rel="stylesheet" href="css/rate.css">

</head>


<body>
		



<i class="fa fa-angle-left"></i><a href="course_review.php"> Back</a>

<!-- <input id="rotated" type="checkbox" name="rotated" checked><label for="rotated">Rotate the form</label> -->
<form action="" method="POST">
	<h3 data-text="Choose Your Language">
    <?php 
     if($canvote)  echo  "What is your take on  ".$title;
     else echo "You Can't Review ".$title ."<br>"." First complete this course.";
    
    ?></h3>
	<label data-text="JavaScript">
		<input type="radio" name="language" value="Easy"> Easy
		<span class="dot"></span>
		<span class="dot-shadow"></span>
	</label>
	<label data-text="PHP">
		<input type="radio" name="language" value="Medium"> Medium
		<span class="dot"></span>
		<span class="dot-shadow"></span>
	</label>
	<label data-text="Python">
		<input type="radio" name="language" value="Standard"> Standard
		<span class="dot"></span>
		<span class="dot-shadow"></span>
	</label>
    <button name="submit" class="btn">Rate</button>



</form>

            




   

	</body>
</html>






























