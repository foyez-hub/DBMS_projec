





<?php
       include_once("class/function.php");
    
  
?>

<?php
  include_once("includes/head.php");
?>

<?php
include_once("includes/admin_topnav.php");
?>

<div id="layoutSidenav">
    <?php
    include_once("includes/admin_sidenav.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <?php

                 if(isset($view)){
                    
                    if($view=="adminSS"){

                      include("adminSectionSchedeulView.php");
                       
                      }
                      if($view=="adminOC"){

                      include("adminOpenCourseView.php");
                       
                      }

                     if($view=="adminC"){

                      include("adminCoursesView.php");
                       
                      }
                      if($view=="adminshow"){
                        include("adminMain.php");
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

