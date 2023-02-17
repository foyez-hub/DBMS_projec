<?php


if (isset($_POST['submit'])) {
    // echo "lo";
    $fromsearch = $_POST['searchcontent'];
    // echo $fromsearch;

}



include 'config.php';



if(isset($fromsearch)){
$sql = "SELECT * FROM `course offering` WHERE `Course Title` LIKE '%$fromsearch%' ";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array(($result))) {
        $title=$row['Course Title'];
        echo $title;

    }
   

}

}

?>

<html>
    <head>
        <meta charset="utf-8"> 
        <link rel="stylesheet" href="css/course_review.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- <title>Awesome Search Box</title> -->
        <link rel="stylesheet" href="css/profilestyle.css">

        <form action="" method="POST">
        <div class="search-box">
            <input class="search-txt" type="text" name="searchcontent" placeholder="search">
            <a class="search-btn" href="#"  name="">
            <div class="input-group">
				<button name="submit" class="btn"> <i class="fas fa-search"></i></button>
			</div>
            </a>
            </div>

</form>

      




            
        
        

        


    <!-- </body> -->




    
</html>

