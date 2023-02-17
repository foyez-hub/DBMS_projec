
<?php

if (!isset($_SESSION['st_email'])) {

  $eemail=$_SESSION['st_email'];

}

if (isset($_SESSION['username'])) {
  

  $name=$_SESSION['username'];
 
}

if (isset($_SESSION['st_email'])) {
  $eemail=$_SESSION['st_email'];
}


include 'config.php';

$sql = "SELECT * FROM `course offering` WHERE 1";
$i=0; 
$result = mysqli_query($conn, $sql);  
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array(($result))) {
     
      $val1 = $row['Course Title'];
      $coursesTitles[$i] = $val1;
      $i++;
  }
}






	$sql = "SELECT * FROM users WHERE email='$eemail'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
    $id=$row['id'];
    $batch=$row['batch'];
    $semester=$row['semester'];
    $credit=$row['credit'];
    $link=$row['imgLink'];
    if($link==NULL){
      $link='profilepic.png';
    }
 


	} 
	else {
		// echo "<script>alert('Data not found.')</script>";
	}


  $cnt=0;

  $sql = "SELECT selected_course.course_title from selected_course where 
  selected_course.stu_Id=some( select users.id from users where users.email= '$eemail')";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      $contain=array();
      
      
       while ($row = mysqli_fetch_array(($result))) {
          $val1=$row['course_title'];

          foreach($coursesTitles as $titles){

            $new_str = str_replace(' ', '', $titles);

            if($new_str==$val1){
              $contain[$cnt]=$titles;
              break;
              
            }
          }

          $cnt++;
        



         
      }
  
  
    }
  
  
    $cnt1=0;

    $sql1 = "SELECT running_courses.course_title from running_courses where 
    running_courses.stu_Id=some( select users.id from users where users.email= '$eemail')";
      $result1 = mysqli_query($conn, $sql1);
      if ($result1->num_rows > 0) {
        $contain1=array();
        
        
         while ($row = mysqli_fetch_array(($result1))) {
            $val2=$row['course_title'];


            foreach($coursesTitles as $titles){

              $new_str = str_replace(' ', '', $titles);
  
              if($new_str==$val2){
                $contain1[$cnt1]=$titles;
                break;
                
              }
            }


            $cnt1++;
        }
    
    
      }





      
    $cnt2=0;
    $sumOfCredit=0;

    $sql2 = "SELECT completed_courses.course_title from completed_courses where 
    completed_courses.stu_Id=some( select users.id from users where users.email= '$eemail')";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2->num_rows > 0) {
        $contain2=array();
        
        
         while ($row = mysqli_fetch_array(($result2))) {
            $val2=$row['course_title'];


            foreach($coursesTitles as $titles){

              $new_str = str_replace(' ', '', $titles);
  
              if($new_str==$val2){



                $sql4 = "SELECT Credit FROM `course offering` WHERE `Course Title`='$titles'";
                $result4 = mysqli_query($conn, $sql4);
                if ($result4->num_rows > 0) {
                  
                  $row1 = mysqli_fetch_assoc($result4);
                  $cr=$row1['Credit'];
             
                  $sumOfCredit+=$cr;
              
                } 


                break;
                
              }
            }


            
        }
    
    
      }


    
      
      
              
    
   if(isset($_GET['mi'])){

    $ti=$_GET['mi'];
    // echo $ti;

 
  
              $new_str = str_replace(' ', '', $ti);
              // echo $new_str;
              
                $sql="DELETE FROM `selected_course` WHERE `course_title`='$new_str' AND `stu_Id`='$id'";

               $re=mysqli_query($conn,$sql);
               if($re){

               }

                
              
                
              



            }
  
      
          
  
  
  
            if(isset($_GET['mmi'])){

              $ti=$_GET['mmi'];
              // echo $ti;
          
           
            
                        $new_str = str_replace(' ', '', $ti);
                        // echo $new_str;
                        
                          $sql="DELETE FROM `running_courses` WHERE `course_title`='$new_str' AND `stu_Id`='$id'";
          
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
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
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
            	<!-- <h1>Student Profile Page</h1> -->
              <h1 style="color:#DAF7A6;"></h1>

                <!-- <p></p> -->
            </div>
        </div>
    </div>
</header>


<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="<?php
             if(isset($link))
            { 
              echo $link;

            }
            ?>" alt="student dp">
            <h3><?php if(isset($name)) echo $name ?></h3>
          </div> 
          <div class="card-body">

            <p class="mb-0"><strong class="pr-1">Student ID:</strong><?php if(isset($id)) echo $id ?></p>
            <!-- <p class="mb-0"><strong class="pr-1">Semester:</strong><?php if(isset($semester)) echo $semester ?></p> -->
            <p class="mb-0"><strong class="pr-1">Department:</strong>CSE</p>
            <p class="mb-0"><strong class="pr-1">Batch:</strong><?php if(isset($batch)) echo $batch?></p>
            <p class="mb-0"><strong class="pr-1">Completed credit:</strong>
            
            <?php
             if(isset($sumOfCredit)) {
              
             
                echo $sumOfCredit;
                echo  '<a href="completed_courses.php?where=profile"><h3 style="color:green;"> Add Courses <i class="fa fa-plus-circle"></i></h3></a>';


             


             }

             ?></p>

          </div>


        </div>
      </div>

       

      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <!-- <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Running Courses</h3> -->
          </div>
          <div class="card-body pt-0">

           
                                 <table class="table table-bordered">
                                  
                                       <?php
                                          // $cnt=0;
                                          
                                           if($cnt1>0){
                                          //  echo "<div "."class="."card-header bg-transparent border-0".">"

                                          //    ."<h2 "."class="."mb-0".">"."<i "."class="."far fa-clone pr-1".">"."</i>"."Running Courses"."</h2>";
                                          //   "</div>";

                                        echo  '<h2 class="mb-0"><i class="far fa-clone pr-1"></i>Running Courses</h2>';
  

                                           for($i=1;$i<=$cnt1;$i++) { 

                                                     echo "<tr>" ;
                                                     echo "<td>"."<h5>".$contain1[$i-1]."</h5>"."</td>";
                                                     echo  '<td><a href="profile.php?mmi='.$contain1[$i-1].'"><h3 style="color:red;"><i class="fa fa-minus-circle"></i></h3></a></td>';

                                                     echo "</tr>";
                                               }
                                                echo '<tr>';
                                               echo  '<td><a href="running_course.php"><h3 style="color:green;"> Add More <i class="fa fa-plus-circle"></i></h3></a></td>';
                                               echo '</tr>';

                                              }
                                              else{

                                                 echo  '<a href="running_course.php"><h3 style="color:green;"> Add Running Courses <i class="fa fa-plus-circle"></i></h3></a>';

                                              }
                                        ?>
                                </table>
          </div>
        </div>
          <div style="height: 26px"></div>
         <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <!-- <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Selected courses for the next Trimester</h3> -->
          </div>
          <div class="card-body pt-0">
          <table class="table table-bordered">
                                     
                                       <?php
                                           if($cnt>0){
                                           echo  '<h2 class="mb-0"><i class="far fa-clone pr-1"></i>Selected courses for the next Trimester</h2>';
                                           for($i=1;$i<=$cnt;$i++) { 

                                                     echo "<tr>" ;
                                                     echo "<td>"."<h5>".$contain[$i-1]."</h5>"."</td>";
                                                     echo  '<td><a href="profile.php?mi='.$contain[$i-1].'"><h3 style="color:red;"><i class="fa fa-minus-circle"></i></h3></a></td>';


                                                     echo "</tr>";
                                                     
                                                     
                                               }
                                               echo '<tr>';
                                               echo  '<td><a href="recommendation.php"><h3 style="color:green;"> Get Recommendation <i class="fa fa-plus-circle"></i></h3></a></td>';
                                               echo '</tr>';
                                              }
                                              else{

                                                
                                                echo  '<a href="recommendation.php"><h3 style="color:green;"> Add new courses for next trimester <i class="fa fa-plus-circle"></i></h3></a>';



                                              }
                                        ?>
                                </table>

            
                                           



              <!-- <p>Hi</p> -->
          </div>
        </div> 
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