<?php

  session_start();


  //$view="adminC";
  include("adminpage.php");
  
?>



<?php


    $conn= mysqli_connect('localhost','root','','login_register_pure_coding');



  


  if($_GET['id']){

    $getid=$_GET['id'];

    $sq="SELECT * FROM `users` WHERE id=$getid";

    $query = mysqli_query($conn,$sq);

    $data= mysqli_fetch_assoc($query);

    $id=$data['id'];
    $username=$data['username'];
    $email=$data['email'];
    $password=$data['password'];
    $batch=$data['batch'];
    $semester=$data['semester'];
    $credit=$data['credit'];
   

    



  }


   if(isset($_POST['submit'])){

    $id=$_POST['id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $batch=$_POST['batch'];
    $semester=$_POST['semester'];
    $credit=$_POST['credit'];
    

           


      $sql1= "UPDATE `users` SET username='$username',email='$email',password ='NULL',batch='$batch',semester='$semester',credit='$credit' WHERE id='$id' ";

       if(mysqli_query($conn,$sql1)==TRUE){
           
           
         //header('location:adminpage.php');
          


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
       
         <form action="<?php   echo $_SERVER['PHP_SELF']?>" method="POST">
     
     <input type="text" name="password" value="<?php    echo $password?>" hidden> <br><br>

    User name: <br>
    <input type="text" name="username" value="<?php    echo $username?>"> <br><br>

    Email: <br>
    <input type="text" name="email" value="<?php    echo $email?>"> <br><br>

     Batch: <br>
     <input type="text" name="batch" value="<?php    echo $batch?>"> <br><br>


    Semester: <br>
     <input type="text" name="semester" value="<?php    echo $semester?>"> <br><br>


     Credit: <br>
     <input type="text" name="credit" value="<?php    echo $credit?>"> <br><br>
     

     <input type="text" name="id" value="<?php    echo $id?>" hidden > <br><br> 


     <input type="submit" value="Insert" name="submit" class="btn btn-success">




  </form>


            


        </div>

        <div class="col-sm-3">
            
        </div>
            




        </div>
        </div>






</body>
</html>



