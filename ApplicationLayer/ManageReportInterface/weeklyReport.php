<!DOCTYPE html>
<html>  
<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dingofood';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$conn=mysqli_connect($host,$user,$pass,$database);
if($conn){
}else{
     echo"Connection not successful" . mysqli_error($conn);
     die($conn);
}


require_once '../../BusinessServiceLayer/controller/reportController.php';

$admin_username = $_SESSION['admin_username'];
$report = new reportController();
$data = $report->viewWeeklyReport();
       

?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Weekly Report</title>

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
                    <a href="/Project/ApplicationLayer/ManageAdminInterface/adminHomeM.php"><i class="fa fa-home"></i><span>&nbsp;Home</span></a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/listMenuM.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenuM.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageRefundInterface/refundAdmin.php"><i class="fas fa-money-bill-alt"></i>&nbsp;Refund</a>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <button type="button" class="d-none d-md-inline-block btn btn-md btn-primary shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Report
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/dailyReport.php">Daily</a>
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/weeklyReport.php">Weekly</a>
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/monthlyReport.php">Monthly</a>
                    </div>
             </div>



<?php //DROPDOWN MENU... ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Weekly Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th class="text-left">No</th>
            <th class="text-left">Order Detail</th>
            <th class="text-left">Sales</th>
            <th class="text-left">Tax (5%)</th>
            <th class="text-left">Total</th>
        </tr>
      </thead>

      <?php
      
      $sno=0;
      foreach($data as $row){ 
            $order_detail=$row['order_detail'];
            $sales=$row['order_quantity']*$row['menu_price'];
            $tax = $sales*0.05;
            $total = $sales - $tax;
			$sno ++;
      ?>
      <form action="" method="POST">
      <tbody class="table-hover">
        <tr>
            <td class="text-left"><?php echo $sno; ?></td>
            <td class="text-left"><?php echo $order_detail; ?></td>
            <td class="text-left"><?php echo $sales; ?></td>
            <td class="text-left"><?php echo $tax; ?></td>
            <td class="text-left"><?php echo $total; ?></td>
        </tr>
        </form>
             
      </tbody>
      <?php
      }
      ?>
   </table>
  
   <br />
   <br />  
</div>



  <form method="post">
                    <a class="btn btn-link" href="adminHome.php">Back</a>
    </form>
</div>

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

    <script src="../js/main.js"></script>
</body>
</html>



  </body>
</html>