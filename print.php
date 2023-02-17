<?php

include("adminpage.php");

    // $delete_course=$_GET['title'];
    // echo $delete_course;

//    if($_GET['title']){ $course=$_GET['title'];
//     echo $course;}
    


    
$conn= mysqli_connect('localhost','root','','login_register_pure_coding');



  







   if(isset($_POST['submit'])){

           $semester= $_POST['semester'];
        //    echo $semester;
           $course_code= $_POST['course_code'];
           $course_title=$_POST['course_title'];
           $course_credit=$_POST['course_credit'];
           $course_prerequisite=$_POST['course_prerequisite'];


      $sql1= "INSERT INTO `course offering`(`Semester`, `Course Code`, `Course Title`, `Credit`, `Prerequisite`) VALUES ('$semester','$course_code','$course_title','$course_credit','$course_prerequisite')";

       if(mysqli_query($conn,$sql1)==TRUE){
           
           header('location:adminCoursesView.php');
        //    echo "Data Updated";


        }
       

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
       
         <form action="" method="POST">
     
    <input type="text" name="semester" value="" > <br><br> 
    Course Code: <br>
    <input type="text" name="course_code" value=""> <br><br>

    Course Tittle: <br>
     <input type="text" name="course_title" value=""> <br><br>


    Course Credit: <br>
     <input type="text" name="course_credit" value=""> <br><br>


    Course Prerequisite: <br>
     <input type="text" name="course_prerequisite" value=""> <br><br>
     <input type="submit" value="Insert" name="submit" class="btn btn-success">




  </form>


            


        </div>

        <div class="col-sm-3">
            
        </div>
            




        </div>
        </div>






</body>
</html>





