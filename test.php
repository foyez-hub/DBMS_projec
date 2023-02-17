<?php 

if (isset($_POST['submit'])) {
  // echo "lo";
  $fromsearch = $_POST['searchcontent'];
  // echo $fromsearch;

}



include 'config.php';


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



?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/profilestyle.css">
        <!-- <link rel="stylesheet" href="css/course_review.css"> -->


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
                background-color:#fff;
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
            /* Add a black background color to the top navigation bar */
.topnav {
  overflow: hidden;
  background-color:#ffffff ;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: center;
  display: block;
  color: red;
  text-align: left;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the "active" element to highlight the current page */
.topnav a.active {
  background-color: #2196F3;
  color: white;
}

/* Style the search box inside the navigation bar */
.topnav input[type=text] {
  float: left;
  padding: 6px;
  border: none;
  margin-top: 10px;
  margin-right: 16px;
  font-size: 20px;
}

/* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}

        </style>
    </head>
    <body>
        

    <!-- <div class="topnav">
  <a class="active" href="#home"><></a>
 
  <input type="text" placeholder="Search..">
</div> -->


        <div class="container">
            <!-- <div class="row">
                <div class="col"></div>
                <div class="col-md-8"> -->

                    <form action="" method="post">
                  <div class="search-box">
                  <div class="topnav">
  <a class="active" href="#home"><i class="fas fa-search" style="font-size: 1.50em;"></i> </a>
  <!-- <button name="submit" class="btn"> <i class="fas fa-search" style="font-size: 1.70em;"></i></button> -->

  <input type="text" placeholder="Search" name="searchcontent">

</div>
               <!-- <input class="search-txt" type="text" name="searchcontent" placeholder="Search Course"> -->
               <a class="search-btn" href="#"  name="">
               <div class="input-group">
				        <button name="submit" class="btn"></button>
		          	</div>
                </a>
            </div>
                            </form>
                        <!-- </fieldset> -->
                <!-- </div>
                <div class="col"></div>
            </div> -->
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
                     
                      echo '<td style="text-align:center"><a href="rateCourse.php?title='.$i.'"> <h5><p style="color:white">'.$i.'</p></h5></a></td>';


                    //  echo "<td>" . $i . "</td>";
                    


                      echo "</tr>";
                    


              
                    }

                  }
                    ?>

                  </table>

               
                  

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