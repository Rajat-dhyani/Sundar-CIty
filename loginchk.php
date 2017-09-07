<?php
 include("database.php");
 $email = $_POST['email'];
 $pass = $_POST['password'];
 $pass = md5($pass);
 $qry = "select * from user where email = '$email' and password = '$pass'";
 $res = mysqli_query($conn,$qry);
 $ans = mysqli_affected_rows($conn);
 if($ans<=0)
	 echo 'User name of password is incorrect';
 else
 	 {
		session_start();
		$_SESSION['userid'] = $email ;
	    echo'<script>window.location= "user/user.php";</script>';
 		end();
	 }
?>
