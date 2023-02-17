<?php

session_start();
if (isset($_SESSION['username'])) {
    $name = $_SESSION['username'];
}

if (isset($_SESSION['st_email'])) {
    $eemail = $_SESSION['st_email'];
}


include 'config.php';

if(isset($_GET['where'])){
    $type=$_GET['where'];
    // echo $type;
}


$sql = "SELECT * FROM users WHERE email='$eemail'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $semester = $row['semester'];
} else {
    echo "<script>alert('Data not found.')</script>";
}




$sql = "SELECT * FROM `course offering` WHERE 1";

$result = mysqli_query($conn, $sql);

$arrlength = $result->num_rows;
$contain = array();
$contain_right = array();

$cnt = 0;


if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array(($result))) {
        $val1 = $row['Course Title'];
        $val2 = $row['Course Code'];

        $contain[$cnt] = $val1;

        $contain_right[$cnt] = $val2;



        $cnt++;
    }
} else {
    echo "<script>alert('Data not found.')</script>";
}

//checkbox data

if (isset($_POST['submit'])) {
    $val = $_POST['data'];

    foreach ($val as $vall) {


       echo $val1;
        $sql = "SELECT course_title FROM `completed_courses` WHERE stu_Id='$id' AND course_title='$vall'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows == 0) {
            echo $val1;
            $sql = "INSERT INTO completed_courses (stu_id,course_title) VALUES ('$id','$vall')";
            $result = mysqli_query($conn, $sql);
            if ($result) {


                header("Location:profile.php");
            }
        } else {


            echo "<script>alert('Opps! already added.')</script>";
        }
    }
}





if(isset($_GET['mmi'])){

    $ti=$_GET['mmi'];
    // echo $ti;

 
  
              $new_str = str_replace(' ', '', $ti);
              // echo $new_str;
              
                $sql="DELETE FROM `completed_courses` WHERE `course_title`='$new_str' AND `stu_Id`='$id'";

               $re=mysqli_query($conn,$sql);
               if($re){

               }

                
              
                
              



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
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

    <!--Only for demo purpose - no need to add.-->
    <link rel="stylesheet" href="css/demo.css" />
    <link rel="stylesheet" href="css/table.css" />

    <link rel="stylesheet" href="css/profilestyle.css">
</head>


<body>



    <header class="ScriptHeader">
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="rt-heading">
                    <!-- <h1><p class="text-left"> <a href="profile.php"> Back</a>.</p></h1> -->
                    <!-- se . text-right  -->

                    <!-- <body style="color:red;"> -->

                    <h1 style="color:MediumVioletRed;">Select Completed Courses</h1>


                    
                    <h1 style="color:red;">
                    <?php
                        echo '<p class="text-left"> <a href="profile.php">Back</a></p>';

                   

                    ?>
               
                    </h1>


                    <!-- <p></p> -->
                </div>
            </div>
        </div>
    </header>


    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent">


                    <div class="col-lg-15">
                        <div class="card shadow-sm">

                            <div class="card-header bg-transparent border-0">
                                <!-- <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Enrolled Courses</h3> -->
                            </div>
                            <div class="card-body pt-0">
                                <form action="" method="POST">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <h4>Select</h4>
                                            </td>
                                            <td>
                                                <h4>Course Title</h4>
                                            </td>


                                            <td>
                                                <h4>Course Code<h4>
                                            </td>

                                        </tr>

                                        <?php


                                        for ($i = 1; $i <= $arrlength; $i++) {

                                            echo "<tr>";


                                           


                                                echo "<td>" . $contain[$i - 1] . "</td>";
                                                echo "<td  >" . $contain_right[$i - 1] . "</td>";
                                                $new_str = str_replace(' ', '', $contain[$i - 1]);

                                                $sql = "SELECT * FROM `completed_courses` WHERE stu_Id='$id' AND course_title='$new_str'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result->num_rows >0) {
                                                     echo  '<td><a href="completed_courses.php?mmi='.$contain[$i-1].'"><h3 style="color:red;"><i class="fa fa-minus-circle"></i></h3></a></td>';
                                                }
                
                                                else   {
                                                    $new_str = str_replace(' ', '', $contain[$i - 1]);
                                                    // echo '<td> <h3 style="color:green;"><i class="fa fa-plus-circle"></i></h3>';
                                                    echo "<td> <h1>". "<input type=" . "checkbox" . " name=" . "data[] " . "value=" . $new_str . ">"."</h1>";
                                                    echo '</td>';
                                                }


                                            
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                    =================================================<input type="submit" name="submit" value="Add courses">===============================================
                                </form>
                            </div>
                        </div>
                        <div style="height: 26px"></div>
                        <!-- <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>About me</h3>
          </div>
          <div class="card-body pt-0">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->

        </div>
        </div>
        </div>
    </section>



    <!-- Analytics -->

</body>

</html>