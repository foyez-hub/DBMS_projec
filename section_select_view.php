<?php

// session_start();

if (isset($_SESSION['username'])) {
  $name = $_SESSION['username'];
}

if (isset($_SESSION['st_email'])) {
  $eemail = $_SESSION['st_email'];

  //echo $eemail;
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
  $_SESSION['counter'] = 0;
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
      $match=false;

      $SplitOfCombination = (explode("|", $combination));
      foreach($SplitOfCombination as $i){

      $splitchar = (explode(",", $char));
      $splitcombination = (explode(",", $i));

      if($splitchar[0]==$splitcombination[0]){
        // echo "match ";
        // echo $splitchar[0];
        // echo " ";
        // echo $splitcombination[0];
        // echo "<br>";
         $match=true;
         break;

      }

    }

     if(!$match) {
      // echo $char." ".$combination."<br>";

      $new_combinations[] = $combination . $char;

     }




      
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

$sql = "SELECT * FROM users WHERE email='$eemail'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id=$row['id'];

}



$alltitle=array();
$sql = "SELECT * FROM `course offering` WHERE 1";

$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array(($result))) {

    $val1 = $row['Course Title'];
    array_push($alltitle,$val1);


   
  }
}


$totalselected=0;
$allSelectedCourse=array();
$sql5 = "SELECT * FROM `selected_course` WHERE stu_Id='$id'";
$r5 = mysqli_query($conn, $sql5);

while ($row = mysqli_fetch_array(($r5))) {
  $totalselected++;

        $Ctitel=$row['course_title'];
        foreach($alltitle as $title){
            $str = str_replace(' ', '', $title);


            if($str==$Ctitel){
                array_push($allSelectedCourse,$title);
                break;

            }
           
        }

    }

// foreach($allSelectedCourse as $i){
//   echo $i."<br>";
// }



$allSecltion=array();

//concatanation course name 
foreach($allSelectedCourse as $cc){
  // echo $cc." <br>";

  $sqla = "SELECT * FROM `section selection` WHERE `Course Title`='$cc'";

$resulta = mysqli_query($conn, $sqla);

//  echo $resulta->num_rows." <br>";

while ($row1 = mysqli_fetch_array($resulta)){
          
          $title = $row1['Course Title'];
          // echo $title."<br>";
          $courseTimes = $row1['Time'];
          $sec = $row1['Section'];
          $day = $row1['Day'];
        
          $fullstr = $title . "," . $courseTimes. "," . $sec . "," . $day . "|";
          array_push($allSecltion, $fullstr);

         

   }



}
        
//concatanation course name end 


$recoms = array();
foreach($allSecltion as $a){
  // echo "all sec->  ".$a."<br>";
}

$output = sampling($allSecltion, $totalselected);

foreach ($output as $str) {
  
  // echo $str." "."<br>";


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
      //  echo $str."<br>";

      array_push($recoms, $str);
    }
  }
}

$incre = $_SESSION['counter'];

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
          <h1><br></h1>

          <!-- <p></p> -->
        </div>
      </div>
    </div>
  </header>


  <section>
    <div class="rt-container">
      <div class="col-rt-12">
        <div class="Scriptcontent">

          <!-- <form method="POST">
    <input type="hidden" name="counter" value="<?php echo $_SESSION['counter']; ?>" />
    <input type="submit" name="button" value="Counter" />
    <input type="submit" name="reset" value="Reset" />
    <br/><?php echo $_SESSION['counter']; ?>
 </form> -->

          <div class="col-lg-15">
            <div class="card shadow-sm">

              <div class="card-header bg-transparent border-0">
                <!-- <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Enrolled Courses</h3> -->
              </div>
              <div class="card-body pt-0">
                <form action="" method="POST">
                  <table class="table table-bordered">
                    <tr>

                      <td><br></td>



                      <td>Section</td>
                      <td>Time</td>
                      <td>Day</td>
                      <!-- <h1><?php echo $printinfo ?></h1> -->

                    </tr>

                    <?php
                    // echo $incre;
                    
                     if($incre>=count($recoms)){
                      
                      if (isset($_SESSION['counter'])) {
                        $_SESSION['counter'] = 1;

                      }
                      $incre=$_SESSION['counter'];

                     }
                    
                    if($incre<count($recoms)){
                    $printdata = $recoms[$incre];
                    $split = (explode("|", $printdata));
                    foreach ($split as $data) {
                      if ($data != "") {
                        $split1 = (explode(",", $data));
                        
                    
                     
                   

                      echo "<tr>";

                      for ($j = 1; $j <= 4; $j++) {


                        if ($j == 1) echo "<td>" . $split1[0] . "</td>";
                        else if ($j == 2) {

                          echo "<td>" . $split1[2] . "</td>";
                        } else if ($j == 3) {

                          echo "<td>" . $split1[1] . "</td>";
                        } else if ($j == 4) {

                          echo "<td>" . $split1[3] . "</td>";
                        }
                      }

                      echo "</tr>";
                    


                  }
                }
              }

                    ?>
                  </table>

                  <input type="hidden" name="counter" value="<?php echo $_SESSION['counter']; ?>" />



                  <!-- <input type="submit" name="reset" value="Reset" /> -->

                  =================================================<input type="submit" name="button" value="Shuffle" />===============================================
                  

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