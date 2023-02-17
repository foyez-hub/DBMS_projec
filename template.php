
<?php

include_once("class/function.php");
include 'config.php';


if (isset($_SESSION['st_email'])) {
  $eemail = $_SESSION['st_email'];
}


$sql = "SELECT * FROM users WHERE email='$eemail'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
         $id=$row['id'];


}

$sql = "SELECT course_title FROM `selected_course` WHERE stu_Id='$id'";
$result = mysqli_query($conn, $sql);

   $totalselectedcourse=$result->num_rows;
   
     

  
?>

<?php
  include_once("includes/head.php");
?>

<?php
include_once("includes/topnav.php");
?>

<div id="layoutSidenav">
    <?php
    include_once("includes/sidenav.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <?php

                 if(isset($view)){
                    
                      if($view=="Profile"){
                      include("profileDesign.php");
                      }
                      if($view=="recom"){
                        include("recommendation_view.php");
                      }
                      if($view=="section_select"){
                      
                          if($totalselectedcourse>0){
                              include("section_select_view.php");    
                          }
                          else{
                             echo "<script>alert('please select course first!')</script>";
                             include("recommendation_view.php");
                          } 
                      }
                      
                      if($view=="match_friend"){
                        
                        include("match_friend_view.php");

                      }
                      if($view=="OpenCourse"){
                        include("open_course_view.php");
                      }
                      if($view=="coursereview"){
                        include("test.php");
                      }
                      if($view=="piechart"){
                        include("piechart_view.php");
                      }
                    

                      
                 }



                ?>
            </div>

        </main>
        <?php
        include_once("includes/footer.php");
        ?>
    </div>
</div>
<?php
include_once("includes/script.php");
?>
</body>

</html>