<?php



   $conn= mysqli_connect('localhost','root','','login_register_pure_coding');


   if(isset($_GET['title'])){

     
    
    $delete_course=$_GET['title'];

    $str = (explode(",", $delete_course));

  
    

    
    $sql="DELETE FROM `section selection` WHERE `Course Code`='$str[0]' AND `section`='$str[1]'";

       if(mysqli_query($conn,$sql)==TRUE){

      header('location:adminSectionSchedeulView.php');


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

        <div class="col-sm-1">
            
        </div>


        <div class="col-sm-15 pt-4 mt-4 border border-success">

            <h3 class="text-center p-2 m-2 bg-success text-black">Section Selection</h3>

              <?php
                    
                    $sq ="SELECT * FROM `section selection`";
                     $query = mysqli_query($conn,$sq);

                     echo "<table class='table table-success'>

                         <tr> 
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Section</th>
                                <th>Credit</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Department</th>
                                <th >Action</th>


                                      </tr>";



                    while($data=mysqli_fetch_assoc($query)){

                   
                     $Course_Code=$data['Course Code'];
                      $Course_Title=$data['Course Title'];
                       $Section=$data['Section'];
                       $Credit=$data['Credit'];
                       $Day=$data['Day'];
                       $Time=$data['Time'];
                       $Room=$data['Room'];
                       $Department=$data['Department'];
                        
                       $pass=$Course_Code.",".$Section;

                       echo "<tr> 
                                <td> $Course_Code </td>
                                <td> $Course_Title </td>
                                <td> $Section</td>
                                <td> $Credit</td>
                                <td> $Day</td>
                                <td> $Time</td>
                                <td> $Room</td>
                                <td> $Department</td>
                                <td><span class='btn btn-success'>
                                         <a href='edit1.php?title=$pass'class='text-white text-decoration-none'> Edit</a>
                                         </span> 

                                       <span class='btn btn-danger'>

                                       <a href='adminSectionSchedeulView.php?title=$pass' class='text-white text-decoration-none'>
                                         
                                        Delete  </span>

                                       </td>

                                      </tr>"; 
                       


                       }

              ?>



        </div>

            </div>
        </div>

</body>
</html>