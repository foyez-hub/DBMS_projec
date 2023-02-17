
<?php
  class student{

    private $conn;
    public function __construct()
    {
        #database host,database user,database pass,database name
        $dbhost='localhost';
        $dbuser='root';
        $dbpass="";
        $dbname='dbms_project';
        $this->conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
        if(!$this->conn){
            die("Error");
        }

        
    }

    public function student_login($data){

      $student_id=$data['student_id'];
      $student_pass=md5($data['student_password']);
      // echo "$student_id";

      $query="SELECT *  FROM  student WHERE id='$student_id'&&pass='$student_pass'";
         $result = $this->conn->query($query);



         if ($result->num_rows > 0) {
         
         
       
          header("location:profile.php");
          //  $qq=mysqli_query($this->conn,$query);
        
          $student_data=mysqli_fetch_assoc($result);
         
         $_SESSION["stuu_id"]=$student_data["id"];
        //  $_SESSION["hi"]="hihiih";


         }
         

         $this->conn->close();
    }

    public function student_signup_info_insert($data){

      
      $student_id=$data['stu_id'];
      echo "$student_id";
     // $student_pass=md5($data['student_password']);



          
    } 






  }


  

  
?>