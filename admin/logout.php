<?php
session_start();
$_SESSION['adminid']="";
session_destroy();
header('Location: ../index.php');
?>
