



<?php  
$cnt=1;

include 'config.php';


if (isset($_SESSION['st_email'])) {
  $eemail=$_SESSION['st_email'];
}
if (!isset($_SESSION['cnty'])) {
  $_SESSION['cnty']=0;
}
if (isset($_POST['cntx'])) {
   ++$_SESSION['cnty'];
}



  $sql = "SELECT * FROM users WHERE email='$eemail'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id=$row['id'];
  

  } 
  else {
    echo "<script>alert('Data not found.')</script>";
  }




if(isset($_POST['submit'])){
  
  // echo $_POST['fname'];
  $var=$_POST['fname'];


  $sql = "INSERT INTO open_course (course_title,student_id,total_vote,vote_count)
          VALUES ('$var','$id','1','1')";

      $result = mysqli_query($conn, $sql);
        
}
/*if(isset($_POST['$oc[$x]'])){
  
  echo $_POST['vote_count'];
  $var=$_POST['vote_count'];




$sql = "SELECT * FROM open_course WHERE student_id='$id'";
          $result = mysqli_query($conn, $sql);

  $sql = "INSERT INTO open_course (vote_count,student_id)

          VALUES ('$var','$id')";


      if ($password == $cpassword) {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO users (username,id, email,batch,semester,credit, password)
          VALUES ('$username','$id', '$email','$batch','$semester','$credit','$password')";
      $result = mysqli_query($conn, $sql);

}*/

$oc=array(); 
$sql = "SELECT * FROM open_course WHERE 1";
  $resultopen = mysqli_query($conn, $sql);
$cnt=1;

if ($resultopen->num_rows > 0) {

    while ($row = mysqli_fetch_array(($resultopen))) {

       array_push($oc, $row['course_title']);

      }
    }
    foreach ($oc as $value) {
      $cnt++;
    }


  
    

    
    foreach ($oc as $i) {
        if(!isset($_SESSION[$i]))
        {
          $_SESSION[$i]=0;   
        }

      }
$vote=array();

    $sql2 = "SELECT * FROM open_course WHERE 1";
    $resultopen = mysqli_query($conn, $sql);
    if ($resultopen->num_rows > 0) {

    while ($row = mysqli_fetch_array(($resultopen))) {

       $vote[$row['movie_name']]=$row['total_vote'];


      }
      
    }


      








    




      


    

    foreach ($oc as $z ) {

    if (isset($_POST[$z])) { 

   

    $sql = "INSERT IGNORE INTO open_course (course_title,student_id,total_vote,vote_count)
          VALUES ('$z','$id','$vote[$z]','0')";
          

      //     $sql3 = "SELECT * FROM open_course WHERE course_title='$z' and 
      //     student_id='$id'";
      // $result3= mysqli_query($conn, $sql3);
      // if($result3->num_rows==0){
      //   $sql = "INSERT INTO open_course (course_title,student_id,total_vote,vote_count)
      //     VALUES ('$z','$id','$vote[$z]','0')";
      //           $re = mysqli_query($conn, $sql);


      // }



      $result54 = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM open_course WHERE course_title='$z' and 
    student_id='$id'";
    $resultopen3 = mysqli_query($conn, $sql2);
    $result = mysqli_fetch_array($resultopen3);

    // echo $result['vote_count'];
    if($result['vote_count']==0)
    {
      // echo " fir ";
      $totalsum=$vote[$z]+1;

      $sql3 = " UPDATE open_course set total_vote='$totalsum'  WHERE 
          course_title='$z' "; 
          $results = mysqli_query($conn, $sql3);
          $sql4 = " UPDATE open_course set vote_count='1'  WHERE course_title='$z' and
       student_id='$id'  "; 
          $results2 = mysqli_query($conn, $sql4);

    }

    
               
    
      }



      
       
    }

      









/*
    $vote=array();

    $sql2 = "SELECT * FROM open_course WHERE 1";
    $resultopen = mysqli_query($conn, $sql);
    if ($resultopen->num_rows > 0) {

    while ($row = mysqli_fetch_array(($resultopen))) {*/
/*       array_push($vote, $row['total_vote']);

       $vote[$row['course_title']]=$row['total_vote'];

      }
    }
  
      /*foreach ($oc as $x) {
        $sql2 = "SELECT * FROM open_course WHERE 'course_title=$x'";
        $resultopen2 = mysqli_query($conn, $sql2);
        $row3 = mysqli_fetch_array($resultopen2);
        array_push($vote, $row3['total_vote']);
        # code...
      }*/
      /*foreach ($vote as $k) {
        echo $k;
        echo "<br>";
        # code...
      }*/




?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=10%, initial-scale=2.0">
  <title>Skills Bars</title>
  <link rel="stylesheet" href="css/open_course.css">
  <link rel="stylesheet" href="css/profilestyle.css">

</head>
<body>

<form action="" method="POST" >
  <label for="fname">Course Title:</label>
  <input type="text" id="fname" name="fname"><br><br>

 <input type="submit" name="submit" value="Submit">
</form>





<?php 


/*echo '<label for="fname">Course Code:</label>';
  echo '<input type="text" id="fname" name="fname"><br><br>';
   

  echo '<input type="submit" name="submit" value="Submit">';*/
  
 

  echo '<form action="" method="POST" >';
for($x=0;$x<$cnt-1;$x++)
{
  
  
 // echo $resultopen2['total_vote'];

  if($x>0 && $oc[$x]==$oc[$x-1] )
  {
    continue;
  }

  echo  '<div class="skill"> 
      
    <div class="skill-name">'.$oc[$x].'<input type="submit" name='.$oc[$x].' value=" + ">'.'</div> 

    <label for="css"></label><br>



    <div class="skill-bar"> 
      <div class="skill-per"  per='.$vote[$oc[$x]].'  style="max-width:'.$vote[$oc[$x]].'%">   </div> 
    </div>
  </div>';
  
  

}
echo '</form>';
  






?>
 



 <!-- // echo "<form action="." "."method="."POST"." >"; -->
  <!-- // echo "<input type="."submit"." name="."bt"." value="."cnt">";  -->



   <!-- /*echo "</"."form".">";*/ -->






  <!-- <div class="skill"> 
    <div class="skill-name"> CSS  <i class="fas fa-plus-circle">  </i> </div> 
    <div class="skill-bar"> 
      <div class="skill-per"  per="7"  style="max-width:70%">   </div> 
    </div>
  </div>

  <div class="skill">
    <div class="skill-name">Javascript <i class="fas fa-plus-circle">  </i>  </div>
    <div class="skill-bar">
      <div class="skill-per" per="60%" style="max-width:60%"></div>
    </div>
  </div> -->


</div>

</body>
</html>