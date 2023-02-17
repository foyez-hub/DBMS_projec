
<?php

if($_GET['tt']){
$course=$_GET['tt'];


}



?>



<html>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">

        <div class="col-sm-1">
            
        </div>

        <div class="col-sm-10 pt-4 mt-4 border border-success">

            <h3 class="text-center p-2 m-2 bg-success text-black">
              <?php echo $course;
              ?>
              </h3>
            
                                   
                                    

              <?php
                 $conn= mysqli_connect('localhost','root','','login_register_pure_coding');

                    
                    $sq ="SELECT * FROM `open_course` Where course_title='$course'";
                     $query = mysqli_query($conn,$sq);

                     echo "<table class='table table-success'>

                         <tr> <th>Name</th>
                                <th>Student Id</th>
                                <th>Email</th>

                                      </tr>";
                     

                    while($data=mysqli_fetch_assoc($query)){

                     //join query
                     $Student_Id=$data['student_id'];
                     
                     $sq1 ="SELECT * FROM users JOIN open_course WHERE users.id='$Student_Id' and open_course.student_id='$Student_Id' and open_course.course_title='$course'";

                     $query1 = mysqli_query($conn,$sq1);
                     $data1=mysqli_fetch_assoc($query1);
                     $Name=$data1['username'];
                     $Email=$data1['email'];
                        
                    echo "<tr>";
                    echo '<td>'.$Name.'</td>';
                    echo  '<td> '.$Student_Id.' </td>';
                    echo '<td>'. $Email .'</td>';
                        
                   
                   echo '</tr>';



                      }

                 

                  

                      

                   
                       
                      

                     

                                
                                   

                                   

                       
                     

              ?>



        </div>

            
        </div>
            




        </div>
        </div>

</body>
</html>

 <!-- $sq1 ="SELECT * FROM `users` Where `id`='$Student_Id'"; -->
