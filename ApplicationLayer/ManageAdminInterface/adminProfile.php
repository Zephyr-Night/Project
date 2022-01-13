<?php
// Author : NABILAH
// Page to display a single customer profile
require_once '../../libs/database.php';
require_once '../../libs/adminSession.php';
require_once '../../BusinessServiceLayer/controller/adminProfileController.php';


$admin = new adminProfileController();
$data = $admin->admin();
$admin_username = $_SESSION['admin_username'];
?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/Project/css/style1.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Dingo Food</h3>
            </div>

            <ul class="list-unstyled components">
               <p>Admin</p>
                <li class="active">
                    <a href="/ProjectGd/ApplicationLayer/ManageAdminInterface/adminHome.php"><i class="fa fa-home"></i><span>&nbsp;Home</span></a>
                </li>
                <li>
                    <a href="/ProjectGd/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li>
                    <a href="/ProjectGd/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
                </li>
                <li>
                    <a href="/ProjectGd/ApplicationLayer/ManageRefundInterface/refundAdmin.php"><i class="fas fa-money-bill-alt"></i>&nbsp;Refund</a>
                </li>
            
        </nav>

       <!-- Page Content  -->
       <div id="content">

<nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span>Toggle Sidebar</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item ">
                    <a class="nav-link" href="/Project/ApplicationLayer/ManageAdminInterface/adminLogout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fas fa-sign-out-alt"></i>&nbsp;<span>Sign Out</span></a>
                    </li>
                </ul>
            </div>
            
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-user"></i>
                &nbsp; <?php echo $admin_username; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/Project/ApplicationLayer/ManageAdminInterface/adminProfile.php">Profile</a>
                    <a class="dropdown-item" href="/Project/ApplicationLayer/ManageAdminInterface/adminProfileEdit.php">Edit Profile</a>
                </div>
                </div>
        </div>
    </nav>

             <div class="container-fluid">


<!-- PROFILE -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


      <div id="customer-details" class="mx-4">
        <h4><i class="fa fa-user"></i>&nbsp Admin Profile</h4>
        <div id="customer-details-info" class=" mt-3">
          <p>Full name: <strong><?php echo $data["admin_name"]; ?></strong></p>
          <p>Email Address: <strong><?php echo $data["admin_email"] ?></strong></p>
          <p>Phone Number: <strong><?php echo $data["admin_phoneNo"] ?></strong></p>
        </div>
      </div>
    </div>

  </div>

</table>
</div>
</div>
</div>
<br>

    <!-- Footer -->
    <footer class="p-4 mb-0 bg-secondary">
     <div class="container">
       <p class="m-0 text-center text-white">&copy; 2021 DINGO FOOD. All Rights Reserved</p>
     </div>
  </footer>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  
   <!-- Bootstrap core JavaScript -->
    <script src="/Project/vendor/jquery/jquery.min.js"></script>
    <script src="/Project/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/Project/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/Project/js/jqBootstrapValidation.js"></script>
    <script src="/Project/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/Project/js/agency.min.js"></script>



</body>

</html>
