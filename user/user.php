<?php
session_start();

if(isset($_SESSION['userid'])):
  include("helper.php");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sundar City - User DashBoards </title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/sundarcity.css" rel="stylesheet">

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Sundar City</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" onclick="showDashboard();" href="#">DashBoard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" onclick="showComplaintForm();" href="#">File complaint</a>
            </li>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" onclick="showFeedback();" href="#">Feedback</a>
          </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
            </li>
            </ul>
        </div>
      </div>
    </nav>
    <div class="head"  style="padding-top: 150px !important;
padding-bottom: 50px !important;">
    <div class="container">
      <div class="intro-text">
        <span class="skills"> Welcome To Sundar City Project </span>
        <hr class="star-light">
        <span class="skills"><?php echo "$user->name" ?> </span>
      </div>
    </div>
  </div>
  <!-- dashboard Section -->
  <section id="dashboard">
    <center>
      <?php if ($RegistredRows > 0) :?>
      <h2 class="text-center">Your Registred complaints</h2>
      <hr class="star-primary">
      <div class="registered">
        <table id="registered" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>Complaint Id</th>
               <th>Type</th>
               <th>Location</th>
               <th>Complaint</th>
               <th>status</th>
               <th>Assigned Inspector</th>
             </tr>
          </thead>
          <tbody>
              <?php
                  while($r = mysqli_fetch_row($RegistredComplaints))
                  {
                    $inspector = fetchInspector($conn,$r[8]);
                      echo "<tr>";
                      echo "<td>".$r[0]."</td>";
                      echo "<td>".$r[2]."</td>";
                      echo "<td>".$r[3]."</td>";
                      echo "<td>".$r[5]."</td>";
                      echo "<td>".$r[6]."</td>";
                      echo "<td>".$inspector[2]."</td>";
                  echo "</tr>";
                  }
               ?>
          </tbody>
       <tbody>
    </table>
  </div>
<?php else:
  endif ?>
</center>
  </section>

  <!-- complaint Section -->
  <section id="complaint" style="display:none;">
    <div class="container">
      <h2 class="text-center">Register Your Complaint Here</h2>
      <hr class="star-primary">
      <div class="row">
        <div class="col-lg-10 ml-auto">
          <p>Please fill the following details.</p>
        </div>
      </div><div class="row">
        <div class="col-lg-8 mx-auto">
          <form name="sendComplaint" id="complaintForm" role="form" action="complaintregisteration.php" method="post" enctype="multipart/form-data">
              <input class="form-control" id="userid" name="userid" type="hidden" value=<?php echo "$user->id" ?>>
            <div class="control-group">
              <div class="form-group controls">
                <label for="location">Select your location</label>
                <select class="form-control" id="location" name="location">
                  <option>Mumbai</option>
                  <option>Delhi</option>
                  <option>Hyderabad</option>
                  <option>Chennai</option>
                  <option>Dehradun</option>
                  <option>Kolkata</option>
                  <option>Bangalore</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group controls">
                <label for="type">Select Type of complaint</label>
                <select class="form-control" id="type" name="type">
                  <option>Potholes & Bad Road Conditions</option>
                  <option>Open garbage dump</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <div class="form-group controls">
                <label>Complaint</label>
                <textarea class="form-control" name="complaint" id="message" rows="5" placeholder="Please enter a short description of your complaint." required data-validation-required-message="Please enter a short description of your complaint." border=1></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group controls">
                <label for="file">Please upload image of the concerned location</label>
                <input type="file" accept="image/*" class="btn btn-primary" name="file"/> <br/><br/>
              </div>
            </div>
          <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-lg" id="RegisterButton">Register Complaint</button>
            </div>
          </form>
          <script>
          $(document).on('click', '#RegisterButton', function(e){
            e.preventDefault();
              $.ajax({
             url: 'updateaction.php',
             type: 'post',
             data: $(complaintForm).serializeArray() ,
               success: function(response) {
               alert(response+ ' please check your mail for further process');
             }
           });
         });
       </script>
        </div>
      </div>
    </div>
  </section>
  <!-- feedback Section -->
  <section id="feedback" style="display:none;">
  </section>

<!-- Footer -->
<footer class="text-center">
  <div class="footer-above">
    <div class="container">
      <div class="row">
        <div class="footer-col col-md-4">
          <h3>Location</h3>
          <p>34 kalpana vihar
            <br>Aam wala Tarla, Dehradun</p>
        </div>
        <div class="footer-col col-md-4">
          <h3>Around the Web</h3>
          <ul class="list-inline">
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-google-plus"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-linkedin"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-dribbble"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="footer-col col-md-4">
          <h3>About Sundar City</h3>
          <p>Sundar City is free to use website for registring complaints against bad road conditions, wastes systems, ill public sectors and the likes.
            <a href="login.php">Register Your complaints</a>.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-below">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          Copyright &copy; Sundar City
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top d-lg-none">
  <a class="btn btn-primary js-scroll-trigger" href="#page-top">
    <i class="fa fa-chevron-up"></i>
  </a>
</div>
<script>
function showDashboard(){
  document.getElementById('feedback').style.display = "none";
  document.getElementById('complaint').style.display = "none";
  document.getElementById('dashboard').style.display = "block";
}
function showComplaintForm(){
  document.getElementById('feedback').style.display = "none";
  document.getElementById('dashboard').style.display = "none";
  document.getElementById('complaint').style.display = "block";
}
function showFeedback(){
  document.getElementById('dashboard').style.display = "none";
  document.getElementById('complaint').style.display = "none";
  document.getElementById('feedback').style.display = "block";
}
$(document).ready(function() {
    $('table.display').DataTable( {
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
    } );
} );
</script>
</body>
</html>
<?php else:
  echo'<script>window.location= "../login.php";</script>';
  end();  # code...
endif ?>
