<?php
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

require_once '../../libs/database.php';
require_once '../../libs/adminSession.php';

$admin_username = $_SESSION['admin_username'];

$no=0;
$num=0;
$status4="Pending....";


$sql="SELECT * FROM refund WHERE  refund_status='$status4' ";
$result_confirmation_refund=makeConnect($sql);
/* database for list refund to be process*/


function makeConnect($sql){
  $conn=mysqli_connect("localhost","root","","dingofood");
  $result=mysqli_query($conn,$sql);
  return $result;
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DINGO FOOD - Food Ordering System (FOS)</title>

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
                <li>
                    <a href="/Project/ApplicationLayer/ManageAdminInterface/adminHome.php"><i class="fa fa-home"></i><span>&nbsp;Home</span></a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
                </li>
                <li class="active">
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
                    <div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daily Report</h6>
                        </div>
                        <div class="card-body">
                           


                    <center>
    <h2> Refund request list</h2>
    <form method="post">
    <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

           <tr>
             <th>User name</th>
             <th>Refund id</th>
             <th>Refund Item</th>
             <th>Time Request</th>
             <th>Approvement</th>

          </tr>

    <?php if($result_confirmation_refund->num_rows>0){
      while($row=$result_confirmation_refund->fetch_assoc()){
          $num=$num+1;
          $item=$row['item'];
     ?>
          <tr>
            <td></td>
            <td><?php echo $row['refund_id'];?></td>
            <td><?php echo $row['item'];?></td>
            <td><?php echo $row['refund_time'];?></td>
            <td><input type="submit" value="Approve" class="btn btn1" name="yes"></td>
            <td><input type="submit" value="Unapproved" class="btn btn1" name="no"   ></td>
          </tr>
    <?php

    if (isset($_POST["yes"])) {
      $status="Refund Successful";
      $sql="UPDATE refund SET refund_status='$status'  WHERE item='$item'";
      $result=makeConnect($sql);
    }
     if (isset($_POST["no"])) {
    $status="Refund Unsuccessful";
    $sql="UPDATE refund SET refund_status='$status'  WHERE item='$item'";
    $result=makeConnect($sql);

  }
}
}else {
      ?>
    <tr><td></td><td></td><td>
      <?php
      echo "no refund request has been made";

     ?></td><td></td></td><td></td><td></tr>
    <?php } ?>

    </table>
    </form>


</div>   
</div>  

                    </div>
                <br><br><br><br>

                 <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>  
                    
        </div>

    </div>

    <script>

         function yes() {
         alert("Refund Request has been Approve");
        }

        function no() {
         alert("Refund Request has been Reject");
        }

        </script>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>