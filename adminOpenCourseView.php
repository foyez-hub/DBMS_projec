



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
/*       array_push($vote, $row['total_vote']);*/

       $vote[$row['course_title']]=$row['total_vote'];

      }
    }
/*  foreach ($vote as $k) {
      echo $k."   ";
        # code...
      }  */  
    foreach ($oc as $z ) {

    if (isset($_POST[$z])) { 



      $sql2 = "SELECT * FROM open_course WHERE course_title='$z'";
    $resultopen3 = mysqli_query($conn, $sql2);
    $result = mysqli_fetch_array($resultopen3);

    echo $result['student_id']." ";






    }
  }
      








    




      


    
      /*foreach ($oc as $z ) {
        # code...
     
      
      if(!$result54){
               die("ERROR".mysqli_error($con));
           }
    
    }*/
    

      









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
      
  <div class="skill-name">'.$oc[$x]."      ".'<a href="adminopencourseDetails.php?tt='.$oc[$x].'"><i class="fa fa-eye"></i>
</a>'.'</div>  




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

<!-- 
 <div class="skill-name">'.$oc[$x].'<input type="submit" name='.$oc[$x].' value=" View
     Details ">'.'</div>  -->