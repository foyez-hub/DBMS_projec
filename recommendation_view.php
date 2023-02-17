<?php



    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


include 'config.php';
$stoprecom=false;

if (isset($_SESSION['username'])) {
    $name = $_SESSION['username'];
}

if (isset($_SESSION['st_email'])) {
    $eemail = $_SESSION['st_email'];

}


$sql = "SELECT * FROM users WHERE email='$eemail'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id=$row['id'];
    $semester = $row['semester'];

} else {
    // echo "<script>alert('Data not found.')</script>";
}


// all title

$alltitle=array();
$sql = "SELECT * FROM `course offering` WHERE 1";
$i = 0;
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array(($result))) {

    $val1 = $row['Course Title'];
    array_push($alltitle,$val1);


   
  }
}

//all title 





$recom_courses=array();


$ck=false;

for($trimester=1;$trimester<=12;$trimester++){
    if($ck) break;
    
$sql = "SELECT * FROM `course offering` WHERE Semester=$trimester";

$result = mysqli_query($conn, $sql);





if ($result->num_rows > 0) {

    while ($row = mysqli_fetch_array(($result))) {
        if(count($recom_courses)>=7){
            $ck=true;
            break;
        }

        $val1=$row['Course Title'];
        $val2=$row['Course Code'];
        $new_str= str_replace(' ', '',$val1);
        $sqlofCompletedCourse = "SELECT course_title FROM `completed_courses` WHERE stu_Id='$id' AND course_title='$new_str'";
        $resultofCompletedCourse = mysqli_query($conn, $sqlofCompletedCourse);
        $sqlofRunningCourse = "SELECT course_title FROM `running_courses` WHERE stu_Id='$id' AND course_title='$new_str'";
        $resultofRunningCourse  = mysqli_query($conn, $sqlofRunningCourse);
        $sql1 = "SELECT course_title FROM `selected_course` WHERE stu_Id='$id' AND course_title='$new_str'";
        $r1 = mysqli_query($conn, $sql1);

     //Prerequisite
     //subquery

       $in=true;

        $sql2 = "SELECT * FROM `course offering` WHERE `Course Code`=(SELECT `Prerequisite` FROM `course offering` WHERE `Course Title`='$val1')";
        $r2 = mysqli_query($conn, $sql2);
        if($r2->num_rows==0){
            $in=false;
        
        }
        else{

        $Prerequisite= mysqli_fetch_array($r2);
        $tempre=$Prerequisite['Course Title'];

    
        $new_str1 = str_replace(' ', '', $tempre);
    
        $sql3 = "SELECT * FROM `completed_courses` WHERE `course_title`='$new_str1'&&`stu_Id`='$id'";
        $r3 = mysqli_query($conn, $sql3);


        }
    
    
             //Prerequisite end




           if ($resultofRunningCourse ->num_rows ==0&&$resultofCompletedCourse->num_rows==0&&$r1->num_rows==0&&!$in) {

            array_push($recom_courses,$val1);

           }





        
   

    }

    

}

}







if(isset($_GET['mmi'])){

         

    $ti=$_GET['mmi'];


    // count total credit

    $allSelectedCourse=array();
    $sql5 = "SELECT * FROM `selected_course` WHERE stu_Id='$id'";
    $r5 = mysqli_query($conn, $sql5);
    
    while ($row = mysqli_fetch_array(($r5))) {

            $Ctitel=$row['course_title'];
            foreach($alltitle as $title){
                $str = str_replace(' ', '', $title);


                if($str==$Ctitel){
                    array_push($allSelectedCourse,$title);
                    break;

                }
               
            }

        }

      $sumofcredit=0;
        foreach($allSelectedCourse as $i){
            $sql6 = "SELECT * FROM `course offering` WHERE `Course Title`='$i'";
             $r6 = mysqli_query($conn, $sql6);
    
             $row = mysqli_fetch_array($r6);

            $C=$row['Credit'];
            $sumofcredit+=$C;
            // echo $i." ".$sumofcredit."<br>";

            

        }



    //count total credit end


  //find current course credit

         $sqlcur = "SELECT * FROM `course offering` WHERE `Course Title`='$ti'";
             $rccur = mysqli_query($conn, $sqlcur);
    
             $row = mysqli_fetch_array($rccur);

            $CurCredit=$row['Credit'];
            // echo $CurCredit;


  //  find current course credit end





   if($CurCredit+$sumofcredit<=15){

    $new_str = str_replace(' ', '', $ti);

    $sql1 = "SELECT course_title FROM `selected_course` WHERE stu_Id='$id' AND course_title='$new_str'";
    $r1 = mysqli_query($conn, $sql1);

   
        
       if ($r1->num_rows==0 ) {

  
              
              $sql = "INSERT INTO selected_course (stu_id,course_title) VALUES ('$id','$new_str')";
              $result = mysqli_query($conn, $sql);
               

                
            
            }

        

               header("Location:recommendation.php");

        }
        else{

            $stoprecom=true;



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
	<link rel="stylesheet" type="text/css" href="css/table.css">


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
                    <h1 style="color:white;">
                    <?php
                       if($stoprecom){
                        echo '<h2 style="color:white;"> Your Credit limit is full 
                      To Add New Courses You need to remove courses </h2>';

                        echo  '<a href="profile.php"><h3 style="color:Red;">Remove Here</h3></a>';


                       }
                       else{
                        echo "Course Recommendation For  Next Trimester";
                       }
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
                        <!-- <div class="card shadow-sm"> -->

                            <!-- <div class="card-header bg-transparent border-0"> -->
                                <!-- <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Enrolled Courses</h3> -->
                            <!-- </div> -->
                            <!-- <div class="card-body pt-0"> -->
                              <form action="" method="POST">
                                <table class="table table-bordered">

              

                                       <?php
                                       if(!$stoprecom){
                                        echo '
                                         <tr>
                                          <td> Course Title</td>


                                          <td>Add</td>

                                        </tr>';
                                  

                                           for($i=0;$i<count($recom_courses);$i++) { 

                                                     echo "<tr>" ;

                                                     echo "<td>".$recom_courses[$i] ."</td>";
                                                    echo  '<td><a href="recommendation_view.php?mmi='.$recom_courses[$i].'"><h3 style="color:green;"><i class="fa fa-plus-circle"></i></h3></a></td>';

                                                  
                                                 echo "</tr>";
                                               }

                                            }
                                        ?>

                                            
                                </table>
<!-- =================================================<input type="submit" name="submit" value="Add courses" >=============================================== -->
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