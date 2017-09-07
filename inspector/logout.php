<?php
session_start();
$_SESSION['inspectorid']="";
session_destroy();
header('Location: ../index.php');
?>
