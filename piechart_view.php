<?php

// include 'config.php';
  $con = mysqli_connect("localhost","root","","login_register_pure_coding");
  if($con){
    echo "<br>";
  }
  else echo "Not conntected";



  if (isset($_POST['submit'])) {

    // echo "lo";
    $fromsearch = $_POST['searchcontent'];
    // echo $fromsearch;

}



$title="";





$search_arr=array();

if(isset($fromsearch)){
$sql = "SELECT * FROM `course offering` WHERE `Course Title` LIKE '%$fromsearch%' ";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array(($result))) {
      $title=$row['Course Title'];
      // echo $title;
      array_push($search_arr,$title);

  }
 

}

}

$ch=false;
   if(isset($_GET['ti']))  {
    $title=$_GET['ti'];
    $ch=true;

         // echo $title;

  }


?>
<html>
  <head>


    <style type="text/css">


*{
 margin: 0px;
 padding: 0px;
}
body{
 font-family: arial;
}
.main{

 margin: 2%;
}

.card{
     width: 23%;
     display: inline-block;
     box-shadow: 2px 2px 20px black;
     border-radius: 5px; 
     margin: 2%;
    }
.card{
     position: relative;
     left: 760px;
     bottom:480px;
    }
.image img{
  width: 100%;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  

 
 }

.title{
 
  text-align: center;
  padding: 10px;
  
 }

h1{
  font-size: 20px;
 }

.des{
  padding: 3px;
  text-align: center;
 
  padding-top: 10px;
        border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}
button{
  margin-top: 40px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
  padding:10px;
}
button:hover{
  background-color: black;
  color: white;
  transition: .5s;
  cursor: pointer;
}

</style>








    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      // <link rel="stylesheet" href="css/course_review.css">
       
        // <link rel="stylesheet" href="css/profilestyle.css">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {


        var data = google.visualization.arrayToDataTable([
          ['a', 'contribution',],

         <?php



        //Aggregate function

        $sql = "SELECT COUNT(stu_Id),difficulty FROM `coursereview` WHERE course_title='$title' GROUP BY difficulty";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {

            echo"['".$result['difficulty']."',".$result['COUNT(stu_Id)']."],";
          }
          




         ?>
         
        ]);

        var options = {
          title: 'Course Difficulty'

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }















    </script>
  </head>
  <body>

    <!-- start of search -->

       <div class="container">
            <!-- <div class="row">
                <div class="col"></div>
                <div class="col-md-8"> -->

                    <form action="" method="post">
                  <div class="search-box">
                  <div class="topnav">
  <a class="active" href="#home"><i class="fas fa-search" style="font-size: 1.50em;"></i> </a>


  <input type="text" placeholder="Search" name="searchcontent">

</div>
            
               <a class="search-btn" href="#"  name="">
               <div class="input-group">
                <button name="submit" class="btn"></button>
                </div>
                </a>
            </div>
            </form>
           
        </div>


 
        <div class="card-body pt-0">

                  <table class="table table-bordered">
                   

                    <?php

                    if(count($search_arr)>0){
                              echo '<tr>';
                              // echo '<td></td>';
                              echo '<td style="text-align:center"><h4>Course Title</h4></td>';
                              echo '<tr>';

                    
                   

                
                 
                      foreach($search_arr as $i){

                      echo "<tr>";
                     
                      echo '<td style="text-align:center"><a href="Piechart.php?ti='.$i.'"> <h5><p style="color:black">'.$i.'</p></h5></a></td>';


                    //  echo "<td>" . $i . "</td>";
                    


                      echo "</tr>";
                    


              
                    }

                  }
                    ?>

                  </table>

               
                  

              </div>


          <?php
          if($ch)
          {
          echo "      ".$title.":" ;
          }
          ?>



        <!-- end of search -->

<!-- start of pie chart -->
  <?php

    if($ch){

         echo '<div id="piechart" style="width: 900px; height: 500px;"></div>';
}


  ?>


<!-- end of pie chart -->



 <?php

 if($ch)
{ echo '<div class="card">

<div class="image">
   <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Gfp-missouri-st-louis-clubhouse-pond-and-scenery.jpg/1199px-Gfp-missouri-st-louis-clubhouse-pond-and-scenery.jpg">
</div>
<div class="title">
 <h1>';
  }
?>


 <?php
  if($ch){
 echo $title;
 }
 ?>
 <?php

 if($ch)
 {
  echo '
 </h1>
</div>
<div class="des">
<p>Course prerequisite:
  ';
  }
  ?>

<?php
if($ch)
{
  $sql = "SELECT Prerequisite FROM `course offering` WHERE `Course Title`='$title' ";
         $fire = mysqli_query($con,$sql);
          $result = mysqli_fetch_assoc($fire);
          if(is_array($result))
          {
          if($result['Prerequisite'] == '-1')
          {
            echo "No Prerequisite Needed.";
          }
          else  {
            echo $result['Prerequisite'];  
          }
          }
}
          
          

?>
  <?php
  if($ch)
{
echo '</p>
<p>Offered Semester: ';
}
?>
<?php
if($ch)
{
  $sql = "SELECT  Semester FROM `course offering` WHERE `Course Title`='$title' ";
         $fire = mysqli_query($con,$sql);
          $result = mysqli_fetch_assoc($fire);
          if(is_array($result))

          { 
           echo $result['Semester'];
         }

}
?>
 <?php
 if($ch)
 {
echo '
 <p>
  Description: ';
  }
  ?>
   <?php
   if($ch)
{
  $sql = "SELECT  description FROM `course offering` WHERE `Course Title`='$title' ";
         $fire = mysqli_query($con,$sql);
          $result = mysqli_fetch_assoc($fire);
          if(is_array($result))
          {
          echo $result['description'];
            }
          }

?>

 </p>

</div>
</div>


  </body>
</html>


<!-- 
<!DOCTYPE html>
<html>
<head>
 <title>Cards</title>
</head>


<body>

<div class="main">

cards -->

<!-- <div class="card">

<div class="image">
   <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Gfp-missouri-st-louis-clubhouse-pond-and-scenery.jpg/1199px-Gfp-missouri-st-louis-clubhouse-pond-and-scenery.jpg">
</div>
<div class="title">
 <h1>
Write title Here</h1>
</div>
<div class="des">
 <p>You can Add Desccription Here...</p>
<button>Read More...</button>
</div>
</div> -->
<!--cards -->




<!-- <div class="card">

<div class="image">
   <img src="https://cdn.pixabay.com/photo/2015/11/07/11/41/lake-1031405_1280.jpg">
</div>
<div class="title">
 <h1>
Write title Here</h1>
</div>
<div class="des">
 <p>You can Add Desccription Here...</p>
<button>Read More...</button>
</div>
</div>
</div>
</body>
</html> -->
