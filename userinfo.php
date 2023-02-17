<?php

  session_start();


  //$view="adminC";
  include("adminpage.php");

   $conn= mysqli_connect('localhost','root','','login_register_pure_coding');
  
?>




<html>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">

       
        <div class="col-sm-10 pt-4 mt-4 border border-success">

            <h3 class="text-center p-2 m-2 bg-success text-black">Users</h3>

              <?php
                    
                    $sq ="SELECT * FROM `users`";
                     $query = mysqli_query($conn,$sq);

                     echo "<table class='table table-success'>

                         <tr> <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                
                                
                                <th>Batch</th>
                                

                               
                                
                                
                                


                                      </tr>";



                    while($data=mysqli_fetch_assoc($query)){

                     $id=$data['id'];
                     $username=$data['username'];
                     $email=$data['email'];
                     //$password=$data['password'];
                     $batch=$data['batch'];
                     //$semester=$data['semester'];
                     
                       

                       echo "<tr> <td> $id </td>
                                <td>$username </td>
                                <td>$email</td>
                                
                                
                                <td>$batch</td>
                               
                                
                                
                                

                                      </tr>"; 
                       


                       }

              ?>



        </div>





        </div>
        </div>

</body>
</html>