<?php
include("../database.php");
$complaintid = $_POST['id'];
$priority = $_POST['priority'];
$status ='In Progress';
$inspectorid = $_POST['inspector'];

$qry = "update complaint set inspector_id='$inspectorid', priority=$priority, status='$status'
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
