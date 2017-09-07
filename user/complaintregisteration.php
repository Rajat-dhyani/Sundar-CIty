<?php
session_start();

if(isset($_SESSION['userid'])){
  include("../database.php");
  include("complaint.php");

  $allowedExts = array("gif", "jpeg", "jpg", "png","JPEG","JPG");
  $extension = end(explode(".", $_FILES["file"]["name"]));
  if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/jpg")
  || ($_FILES["file"]["type"] == "image/JPEG")
  || ($_FILES["file"]["type"] == "image/JPG")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  || ($_FILES["file"]["type"] == "image/x-png")
  || ($_FILES["file"]["type"] == "image/png"))
     && in_array($extension, $allowedExts))
  {
     if ($_FILES["file"]["error"] > 0)
    {
         echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
     }
   else
   {

		$complaint = new complaint();
		$complaint->userid = $_POST['userid'];
    $complaint->type = $_POST['type'];
    $complaint->location = $_POST['location'];
    $complaint->complaint = $_POST['complaint'];
    $complaint->priority = 0;
    $complaint->status = "Registred";
    $email = $_SESSION['userid'];

        $post_photo=$_FILES['file']['name'];

		    $post_photo_tmp=$_FILES['file']['tmp_name'];

		    $ext = pathinfo($post_photo, PATHINFO_EXTENSION);  // getting image extension

	      if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG')
	       {
	          $src=imagecreatefromjpeg($post_photo_tmp);
	       }
	      if($ext=='png' || $ext=='PNG')
	       {
	          $src=imagecreatefrompng($post_photo_tmp);
	       }
		    if($ext=='gif' || $ext=='GIF')
	       {
	          $src=imagecreatefromgif($post_photo_tmp);
	       }
         $dirname = "assets/img/".$email;

		     if (!is_dir($dirname))
		     {
           mkdir("$dirname", 0777,true);
		     }

		     move_uploaded_file($_FILES["file"]["tmp_name"], $dirname."/" .  $_FILES["file"]["name"]);
         $tmp =  $dirname."/" .  $_FILES["file"]["name"];

         $complaint->imagepath = $tmp;


		     if ($complaint->insert($conn)){

           include('userclass.php');
           $user = new user();
           $user->email = $email;
           $user->selectAll($conn);
           $name = $user->name;
           $email_address = 'rajatdhyani12@gmail.com';
           $message = "You complaint has been registered.\n\n"."we will contact you soon after confirmation of the request";

           // Create the email and send the message
           $to = $email;
           $email_subject = "complaint registered";
           $email_body = "You complaint has been registered.\n\n"."we will contact you soon after confirmation of the request";
           $headers = "From: noreply@rajatdhyani.xyz\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
           $headers .= "Reply-To: $email_address";
           mail($to,$email_subject,$email_body,$headers);
           echo  "Your complaint has been registered";
           return true;
         } else {
           echo  "Invalid request";
           return false;
         }

     }
   }
else
 {
 echo "Invalid file";
 }

} else{
  echo'<script>window.location= "../login.php";</script>';
  end();
}
 ?>
