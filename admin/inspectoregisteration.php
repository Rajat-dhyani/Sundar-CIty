<?php
 include("../database.php");
 $email = $_POST['email'];
 $pass = $_POST['password'];
 $pass = md5($pass);
 $qry = "select * from inspector where email = '$email' and password = '$pass'";
 $res = mysqli_query($conn,$qry);
 $ans = mysqli_affected_rows($conn);
 if($ans>=1)
	 echo 'inspector already exits';
 else
 	 {
     $name = $_POST['name'];
     $profession = $_POST['profession'];

     $qry = "insert into inspector (email,name,password,profession)".
 			 " values('$email','$name','$pass','$profession') ";
     $res = mysqli_query($conn,$qry);
     $ans = mysqli_affected_rows($conn);
     if($ans<=0){
         echo "unable to add inspector ".$qry;
       return false;
 		}
 		else{
      echo "Inspector added";
      echo'<script>window.location= "admin.php";</script>';
      end();
    }

	 }
?>
