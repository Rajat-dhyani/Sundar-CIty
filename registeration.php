<?php

if(isset($_POST['signupform'])){
  include("database.php");

  $name = trim(mysql_escape_string($_POST['username']));
  $email = trim(mysql_escape_string($_POST['email']));

  $query_verify_email = "SELECT * FROM user WHERE email ='$email'" ;
  $existed_email = mysqli_query($conn,$query_verify_email);
  if (!$existed_email) {
      echo ' System Error';
 }
 if (mysqli_affected_rows($conn) == 1) { //If the Insert Query was successfull.
     echo '<div>Already registered </div>';
   }  else {
     $passwords = trim(mysql_escape_string($_POST['password']));
     $password = md5($passwords);
     $phoneno = trim(mysql_escape_string($_POST['phoneno']));

     $query_create_user = "INSERT INTO user (email,name, password, phoneno) VALUES ( '$email','$name',  '$password','$phoneno')";
     $created_user = mysqli_query($conn,$query_create_user);
     if (!$created_user) {
         echo 'Query Failed '.$query_create_user;
     }
     if (mysqli_affected_rows($conn) == 1) { //If the Insert Query was successfull.
         echo '<div>successfully registered </div>';
       } else { // If it did not run OK.
         echo '<div>You could not be registered due to a system error. We apologize for any inconvenience.</div>';
       }
     }
   }


?>
