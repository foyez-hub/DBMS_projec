<?php

  session_start();


  //$view="adminC";
  include("adminpage.php");
  
?>



<?php


    $conn= mysqli_connect('localhost','root','','login_register_pure_coding');



  
     

  if($_GET['title']){

   $getid=$_GET['title'];

   echo $getid;

     $str = (explode(",", $getid));



  
    

    
    $sql="SELECT * 
          FROM `section selection` 
          WHERE `Course Code`='$str[0]' AND `section`='$str[1]'";
   
    $query = mysqli_query($conn,$sql);

    $data= mysqli_fetch_assoc($query);

    
    $course_code=$data['Course Code'];
    $course_title=$data['Course Title'];
    $section=$data['Section'];
    $course_credit=$data['Credit'];
    $day=$data['Day'];
    $time=$data['Time'];
    $room=$data['Room'];
    $department=$data['Department'];



  }


   if(isset($_POST['submit'])){

          



    $course_code=$_POST['CourseCode'];
    $course_title=$_POST['CourseTitle'];
    $section=$_POST['Section'];
    $course_credit=$_POST['Credit'];
    $day=$_POST['Day'];
    $time=$_POST['Time'];
    $room=$_POST['Room'];
    $department=$_POST['Department'];







      $sql1= "UPDATE `section selection` SET `Course Title`='$course_title',`Credit`='$course_credit',`Day`='$day',`Time`='$time',`Room`='$room',`Department`='$department' WHERE `Course Code`='$course_code' AND `Section`='$section' ";

       if(mysqli_query($conn,$sql1)==TRUE){
           
           
           echo "Data Updated";


        }

        else echo "Data Not Updated";










  }


   




?>


<html>
<head>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
        <div class="row">

        <div class="col-sm-3">
            
        </div>

        <div class="col-sm-6 pt-4 mt-4 border border-success">

           <h3 class="text-center p-4 m-4 bg-success text-black">Database Update</h3>
       
         <form action="<?php   echo $_SERVER['PHP_SELF']?>" method="POST">
     
    Course Code: <br>
    <input type="text" name="CourseCode" value="<?php    echo $course_code?>" > <br><br>

    Course Tittle: <br>
     <input type="text" name="CourseTitle" value="<?php    echo $course_title?>"> <br><br>

    Course Section: <br>
    <input type="text" name="Section" value="<?php    echo $section?>" > <br><br>

    Course Credit: <br>
     <input type="text" name="Credit" value="<?php    echo $course_credit?>"> <br><br>

    Day: <br>
     <input type="text" name="Day" value="<?php    echo $day?>"> <br><br>
     
    Time: <br>
     <input type="text" name="Time" value="<?php    echo $time?>"> <br><br>

    Room Number: <br>
     <input type="text" name="Room" value="<?php    echo $room?>"> <br><br> 


     Department: <br>
     <input type="text" name="Department" value="<?php    echo $department ?>"> <br><br>
     <input type="submit" value="Insert" name="submit" class="btn btn-success">




  </form>


            


        </div>

        <div class="col-sm-3">
            
        </div>
            




        </div>
        </div>






</body>
</html>





