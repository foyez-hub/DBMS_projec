<?php 



$friendCourse=array();
if (isset($_POST['submit'])) {



      foreach ($_POST['offene_pukte'] as $key => $value) {
        $val=$_POST['offene_pukte'][$key];
        array_push($friendCourse,$val);

    }

}


if (isset($_SESSION['st_email'])) {
    $eemail=$_SESSION['st_email'];
  }
  

  if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
  }
  
  // if button is pressed, increment counter
  if (isset($_POST['button'])) {
    ++$_SESSION['counter'];
  }
  
  // reset counter
  if (isset($_POST['reset'])) {

    // $_SESSION['counter'] = 0;
    $sql11 = "DELETE FROM `friendandme` WHERE 1";
      $result11 = mysqli_query($conn, $sql11);


  }
  
  function sampling($chars, $size, $combinations = array())
  {
  
    # if it's the first iteration, the first set 
    # of combinations is the same as the set of characters
    if (empty($combinations)) {
      $combinations = $chars;
    }
  
    # we're done if we're at size 1
    if ($size == 1) {
      return $combinations;
    }
  
    # initialise array to put new values in
    $new_combinations = array();
  
    # loop through existing combinations and character set to create strings
    foreach ($combinations as $combination) {
      foreach ($chars as $char) {
        $new_combinations[] = $combination . $char;
      }
    }
  
    # call same function again for the next iteration
    return sampling($chars, $size - 1, $new_combinations);
  }
  
  function istimematch($s1, $s2)
  {
  
    $str = (explode(" - ", $s1));
    //echo $str[0]." ".$str[1];
  
    $split1 = (explode(" ", $str[0]));
    $startTime = $split1[0];
    $split3 = (explode(":", $startTime));
  
    $starthour = $split3[0];
    $startminute = $split3[1];
  
  
    $split2 = (explode(" ", $str[1]));
    $endTime = $split2[0];
  
    $split4 = (explode(":", $endTime));
  
    $endhour = $split4[0];
    $endminute = $split4[1];
  
    if ($starthour < 6) $starthour += 12;
    if ($endhour < 6) $endhour += 12;
    $s1St = ($starthour * 60) + $startminute;
    $s1Ed = ($endhour * 60) + $endminute;
  
  
    $str = (explode(" - ", $s2));
    //echo $str[0]." ".$str[1];
  
    $split1 = (explode(" ", $str[0]));
    $startTime = $split1[0];
    $split3 = (explode(":", $startTime));
  
    $starthour = $split3[0];
    $startminute = $split3[1];
  
  
    $split2 = (explode(" ", $str[1]));
    $endTime = $split2[0];
  
    $split4 = (explode(":", $endTime));
  
    $endhour = $split4[0];
    $endminute = $split4[1];
  
    if ($starthour < 6) $starthour += 12;
    if ($endhour < 6) $endhour += 12;
    $s2St = ($starthour * 60) + $startminute;
    $s2Ed = ($endhour * 60) + $endminute;
  
    if ($s1St >= $s2St && $s1St <= $s2Ed || $s1Ed >= $s2St && $s1Ed <= $s2Ed) {
      return true;
    }
    return false;
  }
  function is_conflit($arr)
  {
  
    foreach ($arr as $i) {
  
      foreach ($arr as $j) {
        if ($i != $j) {
          $split1 = (explode(",", $i));
          $split2 = (explode(",", $j));
          $splitday1 = (explode(" ", $split1[1]));
          $splitday2 = (explode(" ", $split2[1]));
          $iseq = false;
          if (count($splitday1) == count($splitday2) && $split1[1] == $split2[1]) {
            $iseq = true;
          } else if (count($splitday1) == 1 && count($splitday2) == 2) {
            if ($splitday1[0] == $splitday2[0] || $splitday1[0] == $splitday2[1]) {
              $iseq = true;
            }
          } else if (count($splitday1) == 2 && count($splitday2) == 1) {
  
            if ($splitday2[0] == $splitday1[0] || $splitday2[0] == $splitday1[1]) {
              $iseq = true;
            }
          }
  
  
          if ($iseq) {
  
            if (istimematch($split1[0], $split2[0])) {
  
              return true;
            }
          }
        }
      }
    }
    return false;
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
  
      } 
      else {
          // echo "<script>alert('Data not found.')</script>";
      }
  
  
      $contain=array();

  
    $sql = "SELECT selected_course.course_title from selected_course where 
    selected_course.stu_Id=some( select users.id from users where users.email= '$eemail')";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows > 0) {
        
        
         while ($row = mysqli_fetch_array(($result))) {
            $val1=$row['course_title'];
  
            foreach($coursesTitles as $titles){
  
              $new_str = str_replace(' ', '', $titles);
  
              if($new_str==$val1){
                // $contain[$cnt]=$titles;
                array_push($contain,$titles);
                break;
                
              }
            }
  
        
          
  
  
  
           
        }
    
    
      }




$friendAndme=array();
foreach($contain as $i){
    array_push($friendAndme,$i);
}


foreach($friendCourse as $friend){
    $isNotmatch=true;
    

    foreach($contain as $me){
        
        if($me==$friend){

            $isNotmatch=false;
            break;

        }

    }

  if($isNotmatch) array_push($friendAndme,$friend);

}

foreach($friendAndme as $i){
   $sqltime = "SELECT * FROM `friendandme` WHERE `Title`='$i' AND `stu_Id`='$id'";
   $resulttime = mysqli_query($conn, $sqltime);
   if($resulttime->num_rows==0){
  $sql = "INSERT INTO `friendandme`(`Title`, `stu_Id`) VALUES ('$i','$id')";
  $result = mysqli_query($conn, $sql);
   }

       
}
$newfriendandMe=array();

$sqltime = "SELECT * FROM `friendandme` WHERE `stu_Id`='$id'";
$resulttime = mysqli_query($conn, $sqltime);
while ($row1 = mysqli_fetch_array(($resulttime))) {
    array_push($newfriendandMe,$row1['Title']);


}



$allSecltion=array();

foreach($newfriendandMe as $i){
    // echo $i."<br>";
$sqltime = "SELECT * FROM `section selection` WHERE `Course Title`='$i'";
$resulttime = mysqli_query($conn, $sqltime);

$courseTimes = array();
$ii = 0;
while ($row1 = mysqli_fetch_array(($resulttime))) {
  //  echo $row1['Time']."<br>";
  $title = $row1['Course Title'];
  $courseTimes[$ii] = $row1['Time'];
  $sec = $row1['Section'];
  $day = $row1['Day'];
  if ($day[0] == ' ') {
    $day = $day[1] . $day[2] . $day[3];
  }
  $fullstr = $title . "," . $courseTimes[$ii] . "," . $sec . "," . $day . "|";
  array_push($allSecltion, $fullstr);
//   echo $fullstr;
  $ii++;
}

}


$recoms = array();

$output = sampling($allSecltion, count($newfriendandMe));

foreach ($output as $str) {

  $ctimes = array();
  $isunique = array();
  $split = (explode("|", $str));
  foreach ($split as $s) {
    if ($s != "") {
      $split1 = (explode(",", $s));
      array_push($isunique, $split1[0]);
      array_push($ctimes, $split1[1] . "," . $split1[3]);
    }
  }

  $mp = array();
  $unique = true;

  foreach ($isunique as $e) {
    if (array_key_exists($e, $mp) == false) {
      $mp[$e] = true;
    } else {

      $unique = false;
    }
  }




  if ($unique) {

    if (!is_conflit($ctimes)) {
    //   echo $str."<br>";

      array_push($recoms, $str);
    }
  }
}







$incre = $_SESSION['counter'];








?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/profilestyle.css">
        <!-- <link rel="stylesheet" href="css/table.css" /> -->
        <style>

            body{
                background-color:#f5f5f5;
            }

            form{
                margin: 50px auto;
            }

            .form-row{
                margin-top: 10px;
            }

            fieldset 
            {
                border: 1px solid #ddd !important;
                margin: 0;
                min-width: 0;
                padding: 30px;       
                position: relative;
                border-radius:4px;
                background-color:#097B84;
                padding-left:10px!important;
            }	

            legend
            {
                font-size:14px;
                font-weight:bold;
                margin-bottom: 0px; 
                width: 35%; 
                border: 1px solid #ddd;
                border-radius: 4px; 
                padding: 5px 5px 5px 10px; 
                background-color: #ffffff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-md-8">

                    <form action="" method="post" enctype="">

                        <fieldset>
                            <!-- <legend>ITC Form</legend> -->

                            <h5>Input your friend courses </h5>
                            <div id="dynamic_field3">
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="offene_pukte[]" placeholder="Course Title or Code">
                                    </div>
                                    <!-- <div class="col">
                                        <input type="text" class="form-control" name="intern[]" placeholder="Intern">
                                    </div> -->

                                    <div class="col">
                                        <td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row"><br>
                                <div class="col">
                                    <button type="submit" id='submit' name="submit" class="btn btn-primary " value="Save">Match</p>
</a>  
</button>
                                </div>
                            </div>
                            <br>
                            </form>
                        </fieldset>
                </div>
                <div class="col"></div>
            </div>
        </div>
      
      
        <div class="card-body pt-0">
                <form action="" method="POST">
                  <table class="table table-bordered">
                    <!-- <tr>

                      <td>Selected Course</td>



                      <td>Section</td>
                      <td>Time</td>
                      <td>Day</td>
 
                    </tr> -->

                    <?php
                        
                    
                     if($incre>=count($recoms)){
                      
                      if (isset($_SESSION['counter'])) {
                        $_SESSION['counter'] = 1;

                      }
                      $incre=$_SESSION['counter'];

                     }
                    
                    if($incre<count($recoms)){

                      echo '<tr>';
                      echo '<td><h4>Selected Course</h4></td>';
                     echo '<td><h4>Section</h4></td>';
                     echo '<td><h4>Time</h4></td>';
                     echo '<td><h4>Day</h4></td>';
                     echo '</tr>';

                    $printdata = $recoms[$incre];
                    $split = (explode("|", $printdata));
                    foreach ($split as $data) {
                      if ($data != "") {

                        $split1 = (explode(",", $data));
                        
                      echo "<tr>";


                      for ($j = 1; $j <= 4; $j++) {


                        if ($j == 1)   echo '<td><h4><p style="color:white">'.$split1[0].'</p></h4></td>';

                        else if ($j == 2) {
                          echo '<td><h4><p style="color:white">'.$split1[2].'</p></h4></td>';

                          // echo "<td>" . $split1[2] . "</td>";
                        } else if ($j == 3) {

                          // echo "<td>" . $split1[1] . "</td>";
                          echo '<td><h4><p style="color:white">'.$split1[1].'</p></h4></td>';

                        } else if ($j == 4) {

                          echo '<td><h4><p style="color:white">'.$split1[3].'</p></h4></td>';

                        }

                      }

                      echo "</tr>";
                    


                  }
                }
              }

                    ?>

                  </table>

                  <input type="hidden" name="counter" value="<?php echo $_SESSION['counter']; ?>" />



                  <input type="submit" name="reset" value="Match again" />

                                   ==========================================================================<input type="submit" name="button" value="Shuffle" />=================================================================
                  

                </form>
              </div>

              

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                var i = 1;
               

                $('#add3').click(function () {
                    i++;
                    $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <input type="text" class="form-control"  name="offene_pukte[]"> </div>  <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove3', function () {
                    var button_id = $(this).attr("id");

                    $('#row3' + button_id + '').remove();
                });



            });
        </script>

    </body>
</html>