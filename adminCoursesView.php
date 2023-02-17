
<?php

if($_GET['title']){
$course=$_GET['title'];
// echo $course;
// include("adminpage.php");



   $conn= mysqli_connect('localhost','root','','login_register_pure_coding');


 
    

    
    $sql="DELETE FROM `course offering` WHERE `Course Title`='$course'";

       if(mysqli_query($conn,$sql)==TRUE){

      // header('location:adminCoursesView.php');


        }


      }
    



?>



<html>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <link rel="stylesheet" type="text/css" href="css/table.css">


</head>
<body>
   <div class="container">
        <div class="row">

        <div class="col-sm-1">
            
        </div>

        <div class="col-sm-10 pt-4 mt-4 border border-black">
 
            <h3 class="text-center p-2 m-2 bg-black text-black">Course Offering</h3>
            
                                      <span class="btn btn-black">
                                      <a href="print.php"> <h3><p>Add New Courses</a>

                                    </span> 
                                    

              <?php
                 $conn= mysqli_connect('localhost','root','','login_register_pure_coding');

                    
                    $sq ="SELECT * FROM `course offering` Where 1";
                     $query = mysqli_query($conn,$sq);

                     echo "<table class='table table-black'>

                         <tr> <th>Semester</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credit</th>
                                <th>Prerequisite</th>
                                <th>Action</th>


                                      </tr>";



                    while($data=mysqli_fetch_assoc($query)){


                    $Semester=$data['Semester'];
                     $Course_Code=$data['Course Code'];
                      $Course_Title=$data['Course Title'];
                       $Credit=$data['Credit'];
                       $Prerequisite=$data['Prerequisite'];


                       echo "<tr> <td> $Semester </td>
                                <td> $Course_Code </td>
                                <td> $Course_Title </td>
                                <td> $Credit </td>
                                <td> $Prerequisite</td>";

                                
                                   

                                    echo '<td>
                                    <span class="btn btn-white">
                                  <a href="adminCoursesView.php?title='.$Course_Title.'"> <h5><p>Delete</a>
                                  </span> 
                                  </td>';

                       }

              ?>



        </div>

        <div class="col-sm-1">
            
        </div>
            




        </div>
        </div>

</body>
</html>