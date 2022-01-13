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
     die($conn);
}

require_once '../../BusinessServiceLayer/controller/reportController.php';
$report = new reportController();
$data = $report->viewAll();

if(isset($_POST['buy'])){
   $report->delete();
}
          
if(isset($_POST['sell'])){
    $report->exportReport();
}
$admin_username = $_SESSION['admin_username'];
?>



<!DOCTYPE html>
<html>  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Daily Report</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/Project/css/style1.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
    <?php
	
    $rowperpage = 90;
    $row = 0;

    // Previous Button
    if(isset($_POST['but_prev'])){
        $row = $_POST['row'];
        $row -= $rowperpage;
        if( $row < 0 ){
            $row = 0;
        }
    }

    // Next Button
    if(isset($_POST['but_next'])){
        $row = $_POST['row'];
        $allcount = $_POST['allcount'];

        $val = $row + $rowperpage;
        if( $val < $allcount ){
            $row = $val;
        }
    }

    // generating orderby and sort url for table header
    function sortorder($fieldname){
        $sorturl = "?order_by=".$fieldname."&sort=";
        $sorttype = "asc";
        if(isset($_GET['order_by']) && $_GET['order_by'] == $fieldname){
            if(isset($_GET['sort']) && $_GET['sort'] == "asc"){
                $sorttype = "asc";
            }
        }
        $sorturl .= $sorttype;
        return $sorturl;
    }

        // count total number of rows
        $sql = "SELECT COUNT(*) AS cntrows FROM report";
        $result = mysqli_query($conn,$sql);
        $fetchresult = mysqli_fetch_array($result);
        $allcount = $fetchresult['cntrows'];

        // selecting rows


        $orderby = " ORDER BY id desc ";
        if(isset($_GET['order_by']) && isset($_GET['sort'])){
            $orderby = ' order by '.$_GET['order_by'].' '.$_GET['sort'];
        }


    ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Report</h1>
                        <button type="button" class="d-none d-md-inline-block btn btn-md btn-primary shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Report
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/dailyReport.php">Daily</a>
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/weeklyReport.php">Weekly</a>
                                <a class="dropdown-item" href="/Project/ApplicationLayer/ManageReportInterface/monthlyReport.php">Monthly</a>
                    </div>
             </div>

            

<div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daily Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th class="text-left">No</th>
            <th class="text-left">Menu ID</th>
            <th class="text-left">Menu Price</th>
            <th class="text-left">Quantity</th>
            <th class="text-left">Total Amount</th>
            <th class="text-left">Delete</th>
            <th class="text-left">Export</th>

        </tr>
      </thead>

        <?php
        $sno = $row;
        $total_revenue=0;
        foreach($data as $row){ 
   
            $menu_id = $row['order_id'];
            $menu_price = $row['menu_price'];
            $quantity = $row['order_quantity'];
            $total_amount = $menu_price * $quantity;
            $total_revenue+=$total_amount;
			$sno ++;
            ?>
            <form action="" method="POST">
            <tr>
                <td align='center'><?php echo $sno; ?></td>
                <td align='center'><?php echo $menu_id; ?></td>
                <td align='center'><?php echo $menu_price; ?></td>
                <td align='center'><?php echo $quantity; ?></td>
                <td align='center'><?php echo $total_amount; ?></td>
                
                <?php
            echo '<td><input type="hidden" name="order_id" value=' . $row['order_id'] . '><button class="btn btn--radius-2 btn--red" type="submit" name="buy" value="BUY">Delete</button></td>';
            echo '<td><input type="hidden" name="order_id" value=' . $row['order_id'] . '><button class="btn btn--radius-2 btn--red" type="submit" name="sell" value="SELL">Export</button></td>';
        
            }

        ?>
        
            </tr>
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
            <th class="text-left" style="text-align:center;">Grand Total</th>
            </tr>
            <tr>
            <td style="text-align:center;"><?php echo $total_revenue; ?></td>
            </tr>
            </form>
            
            

    </table>



  
	
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
