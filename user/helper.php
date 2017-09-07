<?php
include("../database.php");
include("userclass.php");

$email =$_SESSION['userid'];
$user = new user();
$user->email = $email;
$res = $user->selectAll($conn);


if ( !$res){
  echo"error user not found";
  end();
}

$qry = "select * from complaint where user_id='$user->id'";
$RegistredComplaints = mysqli_query($conn,$qry);
$RegistredRows = mysqli_affected_rows($conn);


function fetchInspector($conn,$id){
  $qry = "select * from inspector where id='$id'";
  $inspector = mysqli_query($conn,$qry);
  return mysqli_fetch_row($inspector);
}
 ?>
