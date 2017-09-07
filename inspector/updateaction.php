<?php
include("../database.php");
$complaintid = $_POST['id'];
$priority = $_POST['priority'];
$status = $_POST['status'];

$qry = "update complaint set priority=$priority, status='$status'
        where id='$complaintid'";

$res = mysqli_query($conn,$qry);
$ans = mysqli_affected_rows($conn);
if($ans<=0)
 return false;
else {
  echo $qry;
   //return true;
  # code...
}?>
