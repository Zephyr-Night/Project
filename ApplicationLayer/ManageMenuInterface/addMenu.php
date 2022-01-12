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
 
require_once 'C:/xampp/htdocs/Project/libs/database.php';
require_once 'C:/xampp/htdocs/Project/libs/adminSession.php';
require_once 'C:/xampp/htdocs/Project/BusinessServiceLayer/controller/menuController.php';
 
$admin_username = $_SESSION['admin_username'];

$menu = new menuController();

// add new menu details
if(isset($_POST['add'])){
    $menu->addMenu();
}

?>



<!DOCTYPE html>
<html>
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
                <li>
                    <a href="/Project/ApplicationLayer/ManageAdminInterface/adminHomeM.php"><i class="fa fa-home"></i><span>&nbsp;Home</span></a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/listMenuM.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li class="active">
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenuM.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageRefundInterface/refundAdminM.php"><i class="fas fa-money-bill-alt"></i>&nbsp;Refund</a>
                </li>
            
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                                <a class="nav-link" href="#">Sign Out</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Muhammad Fikri</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

             <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add New Menu</h1>
                    </div>



                      <form id="msform" action="" method="POST" onsubmit="return confirm('Make sure menu information are correct');">

                    <fieldset>
                    <p style = "font-size: 15px; color:grey; ">Fill in all new menu details in the fields</p>
                    <p style = "font-size: 14px; color:red; "><b>* required</b></p><br>

                    <div class="form-group">
                    <p style="font-size: 16px; color: black; text-align: left;"> Name <label style="font-size: 16px; color: red;"> * </label></p>
                    <input type="text" id="menu_name" name="menu_name" class="form-control" required><br/>
                    </div>

                    <div class="form-group">
                    <p style="font-size: 16px; color: black; text-align: left"> Price <label style="font-size: 16px; color: red;"> * </label></p>
                    <input type="float" id="menu_price" name="menu_price" class="form-control" required><br/>
                    </div>

                    <div class="form-group">
                    <p style="font-size: 16px; color: black; text-align: left"> Cost <label style="font-size: 16px; color: red;"> * </label></p>
                    <input type="float" id="cost" name="cost" class="form-control" required><br/>
                    </div>

                    <p style="font-size: 16px; color: black; text-align: left"> Category <label style="font-size: 16px; color: red;"> * </label></p>
                    <div style="display:flex; border: 1px solid lightgrey; padding: 13px; border-radius: 4px; font-size: 15px;">
                    <label class="container">Cake 
                        <input type="radio" id="menu_category" name="menu_category" value="Cake" required>
                        <span style="left: 12%" class="checkmark"></span>
                    </label>
                    <label class="container">Beverage
                        <input type="radio" id="menu_category" name="menu_category" value="Beverage">
                        <span style="left:40%" class="checkmark"></span>
                    </label>
                    <label class="container">Mini Bites
                        <input type="radio" id="menu_category" name="menu_category" value="Mini Bites">
                        <span style="left:69%" class="checkmark"></span>
                    </label>
                    </div><br/>

                    <div class="form-group">
                    <p style="font-size: 16px; color: black; text-align: left"> Description <label style="font-size: 16px; color: red;"> * </label></p>
                    <input type="text" id="menu_description" name="menu_description" class="form-control" required><br/>
                    </div>
                    <p style="font-size: 16px; color: black; text-align: left"> Status <label style="font-size: 16px; color: red;"> * </label></p>
                        <div style="display:flex; border: 1px solid lightgrey; padding: 13px; border-radius: 4px; font-size: 15px;">
                        <label class="container">Available
                            <input type="radio" id="menu_status" name="menu_status" value="Available" required>
                            <span style="left: 18%" class="checkmark"></span>
                        </label>
                        <label class="container">Not available
                            <input type="radio" id="menu_status" name="menu_status" value="Not available">
                            <span style="left:59%" class="checkmark"></span>
                        </label>
                        </div><br/>

                    <p style="font-size: 16px; color: black; text-align: left;"> Image <label style="font-size: 16px; color: red;"> * </label></p>
                    <input type="file" id="menu_image" name="menu_image" required><br/>

                    <br>

                    <!-- ACTION BUTTON (SUBMIT NEW MENU) -->

                    <input class="btn btn-primary" type="submit" name="add" value="Add New Menu">
                    <a class="btn btn-link" href="listMenu.php">Back</a>

                    </fieldset>
                    </form>

                    </div>
                

                 <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>  
                    
        </div>

    </div>



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