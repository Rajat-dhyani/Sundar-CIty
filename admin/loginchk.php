<?php
 include("../database.php");
 $email = $_POST['email'];
 $pass = $_POST['password'];
 $qry = "select * from admin where email = '$email' and password = '$pass'";
 $res = mysqli_query($conn,$qry);
 $ans = mysqli_affected_rows($conn);
 if($ans<=0)
	 echo 'User name of password is incorrect'. $qry;
 else
 	 {
		session_start();
		$_SESSION['adminid'] = $email ;
	    echo'<script>window.location= "admin.php";</script>';
 		end();
	 }
?>
