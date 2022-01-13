<?php
session_start();
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dingofood';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$conn=mysqli_connect($host,$user,$pass,$database);
if($conn){
}else{
     echo"Connection not successful" . mysqli_error($conn);
}

require_once '../../BusinessServiceLayer/controller/reportController.php';
$report = new reportController();
$data = $report->viewMonthlyReport();

$admin_username = $_SESSION['admin_username'];
?>



<!DOCTYPE html>
<html>  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Monthly Report</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/Project/css/style1.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
  <body>

 <body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Dingo Food</h3>
            </div>

            <ul class="list-unstyled components">
               <p>Admin</p>
                <li>
                    <a href="/Project/ApplicationLayer/ManageAdminInterface/adminHome.php"><i class="fa fa-home"></i><span>&nbsp;Home</span></a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Monthly Report</h1>
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
<div id="centered" class="dropdown"> 
	
<div id="sasa" class="charts-container cf">
  <div class="chart" id="graph-1-container">
    <h2 class="title">Cost</h2>
    <div class="chart-svg">
      <svg class="chart-line" id="chart-1" viewBox="0 0 100 50">
        <defs>
          <clipPath id="clip" x="0" y="0" width="80" height="40" >
            <rect id="clip-rect" x="-80" y="0" width="77" height="38.7"/>
          </clipPath>

        <linearGradient id="gradient-1">
            <stop offset="0" stop-color="#00d5bd" />
            <stop offset="100" stop-color="#24c1ed" />
        </linearGradient>

        <linearGradient id="gradient-2">
            <stop offset="0" stop-color="#954ce9" />
            <stop offset="0.3" stop-color="#954ce9" />
            <stop offset="0.6" stop-color="#24c1ed" />
            <stop offset="1" stop-color="#24c1ed" />
        </linearGradient>


          <linearGradient id="gradient-3" x1="0%" y1="0%" x2="0%" y2="100%">>
            <stop offset="0" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.07"/>
            <stop offset="0.5" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0.13"/>
            <stop offset="1" stop-color="rgba(0, 213, 189, 1)" stop-opacity="0"/>
        </linearGradient>


          <linearGradient id="gradient-4" x1="0%" y1="0%" x2="0%" y2="100%">>
            <stop offset="0" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.07"/>
            <stop offset="0.5" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0.13"/>
            <stop offset="1" stop-color="rgba(149, 76, 233, 1)" stop-opacity="0"/>
        </linearGradient>
          
    </defs>
      </svg>
      <h3 class="valueX"></h3>
    </div>
    <div class="chart-values">
      <p class="h-value">1689h</p>
      <p class="percentage-value"></p>
      <p class="total-gain"></p>
    </div>
    <div class="triangle green"></div>
  </div>


  <div class="chart" id="graph-2-container">
    <h2 class="title">Revenue</h2>
    <div class="chart-svg">
      <svg class="chart-line" id="chart-2" viewBox="0 0 100 50">
      </svg>
      <h3 class="valueX"></h3>
    </div>
    <div class="chart-values">
      <p class="h-value">322h</p>
      <p class="percentage-value"></p>
      <p class="total-gain"></p>
    </div>
    <div class="triangle red"></div>
    
  </div>

      <svg class="chart-circle" id="chart-3" width="0%" viewBox="0 0 0 0"></svg>

      <svg class="chart-circle" id="chart-4" width="0%" viewBox="0 0 0 0"></svg>
   
      <div class="table-title">
            <h3>Data Table</h3>
      </div>

  <div class="card shadow mb-4">
  
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th class="text-left">No</th>
            
            <th class="text-left">Cost</th>
            <th class="text-left">Profit</th>
            <th class="text-left">Revenue</th>
        </tr>
      </thead>
      <?php

      $sno=0;
      foreach($data as $row){ 
            
            $cost=$row['cost'];
            $profit = $row['order_quantity']*$row['menu_price'];
            $total_revenue = $profit-$cost;
			$sno ++;
      ?>
      <form action="" method="POST">
      <tbody class="table-hover">
        <tr>
            <td class="text-left"><?php echo $sno; ?></td>
            
            <td class="text-left"><?php echo $cost; ?></td>
            <td class="text-left"><?php echo $profit; ?></td>
            <td class="text-left"><?php echo $total_revenue; ?></td>
        </tr>
        </form>
             
      </tbody>
      <?php
      }
      ?>
   </table>

  
</div>



<!-- partial -->
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js'></script><script  src="/Project/js/monthlyScript.js"></script>

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
