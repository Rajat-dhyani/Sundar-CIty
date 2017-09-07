<?php
session_start();

if(isset($_SESSION['adminid'])):
  include("helper.php")
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sundar City - Admin DashBoards </title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="../css/sundarcity.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
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
              <a class="nav-link js-scroll-trigger" onclick="showDashboard();">DashBoard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" onclick="showFeedback();">Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" onclick="showInspector();">Add Inspector</a>
          </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
            </li>
            </ul>
        </div>
      </div>
    </nav>
    <div class="head">
    <div class="container">
      <div class="intro-text">
        <span class="skills">Welcome </span>
        <hr class="star-light">
      </div>
    </div>
  </div>
  <!-- dashboard Section -->
  <section id="dashboard">
    <center>
      <?php if ($RegistredRows > 0) :?>
      <h2 class="text-center">Newly Registred complaints</h2>
      <hr class="star-primary">
      <div class="registered">
        <table id="registered" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>Complaint Id</th>
               <th>Type</th>
               <th>Location</th>
               <th>User Id</th>
               <th>Complaint</th>
               <th>Priority</th>
               <th>Assign Inspector</th>
             </tr>
          </thead>
          <tbody>
              <?php
                  while($r = mysqli_fetch_row($RegistredComplaints))
                  {
                    $inspector = fetchInspector($conn,$r[2]);
                    $inspectorRows = mysqli_affected_rows($conn);
                    $username = fetchUserName($conn,$r[1]);
                    if ($inspectorRows > 0){
                      echo "<form method='post'> ";
                      echo "<tr>";
                      echo "<td name='id'>".$r[0]."</td>";
                      echo "<td>".$r[2]."</td>";
                      echo "<td>".$r[3]."</td>";
                      echo "<td>".$username."</td>";
                      echo "<td>".$r[5]."</td>";
                      echo "<td><select name='priority' id='priority$r[1]'>";
                            echo "<option value=0>low priority</option>";
                            echo "<option value=1>medium priority</option>";
                            echo "<option value=2>high priority</option>";
                      echo "</select></td>";
                      echo "<td><select name='inspector' id='inspector$r[0]'>";
                        while ($i = mysqli_fetch_row($inspector)){
                          echo "<option value='$i[0]'>$i[2]</option>";
                       }
                     echo "</select></td> </form>";
                         echo "<script>
                      $(document).on('change', '#inspector$r[0]', function(){
                          $.ajax({
                            url: 'updateaction.php',
                            type: 'post',
                            data: { id: $r[0], priority: $('#priority$r[1]').val(), inspector:$('#inspector$r[0]').val()} ,
                            success: function(response) {
                              alert(response+ 'successfully added inspector');
                            }
                          });
                        });
                      </script>";
                    }  else {
                      echo "<tr>";
                      echo "<td>".$r[0]."</td>";
                      echo "<td>".$r[2]."</td>";
                      echo "<td>".$r[3]."</td>";
                      echo "<td>".$r[1]."</td>";
                      echo "<td>".$r[5]."</td>";
                      echo "<td>".$r[4]."</td>";
                      echo "<td> No inspector found </td>";
                    }
                    echo "</tr>";
                  }
               ?>
          </tbody>
       <tbody>
    </table>
  </div>
<?php else:
  endif ?>
  <?php if ($InProgressRows > 0) :?>
    <h2 class="text-center">In Progress complaints</h2>
      <hr class="star-primary">
      <div class="registered">
        <table id="inprogess" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>Complaint Id</th>
               <th>Type</th>
               <th>Location</th>
               <th>User Id</th>
               <th>Complaint</th>
               <th>Priority</th>
               <th>Change Inspector</th>
             </tr>
          </thead>
          <tbody>
              <?php
                  while($r = mysqli_fetch_row($InProgressComplaints))
                  {
                    $inspector = fetchInspector($conn,$r[2]);
                    $inspectorRows = mysqli_affected_rows($conn);
                    $username = fetchUserName($conn,$r[1]);
                    if ($inspectorRows > 0){
                      echo "<form method='post'> ";
                      echo "<tr>";
                      echo "<td name='id'>".$r[0]."</td>";
                      echo "<td>".$r[2]."</td>";
                      echo "<td>".$r[3]."</td>";
                      echo "<td>".$username."</td>";
                      echo "<td>".$r[5]."</td>";
                      echo "<td><select name='priority' id='priority$r[1]'>";
                            echo "<option value=0>low priority</option>";
                            echo "<option value=1>medium priority</option>";
                            echo "<option value=2>high priority</option>";
                      echo "</select></td>";
                      echo "<td><select name='inspector' id='inspector$r[0]'>";
                        while ($i = mysqli_fetch_row($inspector)){
                          echo "<option value='$i[0]'>$i[2]</option>";
                       }
                     echo "</select></td> </form>";
                         echo "<script>
                      $(document).on('change', '#inspector$r[0]', function(){
                          $.ajax({
                            url: 'updateaction.php',
                            type: 'post',
                            data: { id: $r[0], priority: $('#priority$r[1]').val(), inspector:$('#inspector$r[0]').val()} ,
                              success: function(response) {
                              alert('successfully added inspector');
                            }
                          });
                        });
                      </script>";
                    }  else {
                      echo "<tr>";
                      echo "<td>".$r[0]."</td>";
                      echo "<td>".$r[2]."</td>";
                      echo "<td>".$r[3]."</td>";
                      echo "<td>".$r[1]."</td>";
                      echo "<td>".$r[5]."</td>";
                      echo "<td>".$r[4]."</td>";
                      echo "<td> No inspector found </td>";
                    }
                    echo "</tr>";
                  }
               ?>
          </tbody>
       <tbody>
    </table>
      </div>
    <?php else:
      endif ?>
    <?php if ($CompletedComplaintsRows > 0) :?>
        <h2 class="text-center">Completed complaints</h2>
          <hr class="star-primary">
          <div class="registered">
            <table id="completed" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                   <th>Complaint Id</th>
                   <th>Type</th>
                   <th>Location</th>
                   <th>User Id</th>
                   <th>Complaint</th>
                   <th>Priority</th>
                   <th>Inspector</th>
                   <th>feedback</th>
                 </tr>
              </thead>
              <tbody>
                  <?php
                      while($r = mysqli_fetch_row($CompletedComplaints))
                      {
                        $inspectorname = fetchInspectorName($conn,$r[8]);
                        $username = fetchUserName($conn,$r[1]);
                          echo "<tr>";
                          echo "<td name='id'>".$r[0]."</td>";
                          echo "<td>".$r[2]."</td>";
                          echo "<td>".$r[3]."</td>";
                          echo "<td>".$username."</td>";
                          echo "<td>".$r[5]."</td>";
                          echo "<td>.$r[4].</td>";
                          echo "<td>.$inspectorname.</td>";
                          echo "<td>.<a href='feedback.php?id=$r[0]'> Show Feedback</a>.</td>";
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

 <!-- feedback Section -->
 <section id="feedback" style="display:none;">
 </section>

 <!-- complaint Section -->
 <section id="inspector" style="display:none;">
   <center>
     <h2 class="text-center">Add inspector details</h2>
     <hr class="star-primary">
     <div id="signupbox" class="mainbox col-md-6  col-sm-8 ">
                 <div class="panel panel-info">
                        <div class="panel-body" >
                          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                           <form id="signupform" class="form-horizontal" role="form" action="inspectoregisteration.php" method="post">
                             <div style="margin-bottom: 25px" class="input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                   <input id="username" type="text" class="form-control" name="name"
                                          placeholder="Enter inspector name" required="required">
                             </div>
                             <div style="margin-bottom: 25px" class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                       <input id="email" type="text" class="form-control" name="email"
                                                  placeholder="email" required="required">
                             </div>
                             <div style="margin-bottom: 25px" class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                       <input id="password" type="password" class="form-control" name="password"
                                                 placeholder="password" required="required">
                             </div>
                             <div style="margin-bottom: 25px" class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                         <input id="confirmpassword" type="password" class="form-control" name="confirmpassword"
                                                         placeholder="Confirm password" required="required">
                                         </div>
                              <div style="margin-bottom: 25px" class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-user-secret "></i></span>
                                         <input id="profession" type="text" class="form-control" name="profession"
                                                                  placeholder="Enter inspector's profession" required="required">
                               </div>

                           <div style="margin-top:10px" class="form-group">
                                       <!-- Button -->

                                       <div class="col-sm-12 controls">
                                         <input type="submit" class="btn btn-success btn-default pull-left" value="Add Inspector"
                                          id="signupsubmit"name="signupform" /> <span style="margin-left:4px;">
                                      </div>
                                   </div>
                               </form>



                           </div>
                       </div>
      </div>
   </center>
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
            <a href="login.php">Register Your Complaints</a>.</p>
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
  document.getElementById('inspector').style.display = "none";
  document.getElementById('dashboard').style.display = "block";
}
function showFeedback(){
  document.getElementById('dashboard').style.display = "none";
  document.getElementById('inspector').style.display = "none";
  document.getElementById('feedback').style.display = "block";
}
function showInspector(){
  document.getElementById('dashboard').style.display = "none";
  document.getElementById('feedback').style.display = "none";
  document.getElementById('inspector').style.display = "block";
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
  echo'<script>window.location= "adminlogin.php";</script>';
  end();  # code...
endif ?>
