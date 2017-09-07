<?php
$host = 'localhost';
 $user = 'root';
 $pass = 'root';
 $db = 'sundar city';

 $conn = mysqli_connect($host, $user, $pass, $db);
 if (!$conn) {
        die('Could not connect to database!');
        }
?>
