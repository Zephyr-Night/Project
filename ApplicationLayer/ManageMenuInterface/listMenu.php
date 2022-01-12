<?php 
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
//require_once('C:/xampp/htdocs/Project/libs/config.php');
require_once 'C:/xampp/htdocs/Project/BusinessServiceLayer/controller/menuController.php';

$admin_username = $_SESSION['admin_username'];

$sql = "SELECT * FROM `menu`";
$res = mysqli_query($connection, $sql);

$menu = new menuController();
///$data = $menu->viewAllMenu();

// delete a specific menu
if (isset($_POST['delete'])) {
    $menu->deleteMenu();
}

// display menu list according pages and menu_category

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

if (isset($_GET['recordnum'])) {
    $number_of_records = $_GET['recordnum'];
} else {
    $number_of_records = 6;
}

$offset = ($pageno - 1) * $number_of_records;

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $data = $menu->viewMenuListPageAdmin($offset, $number_of_records, $term);
    $total = $menu->viewMenuList()->rowCount();
} else {
    $term = '';
    $data = $menu->viewMenuListPageAdmin($offset, $number_of_records,'');
    $total = $menu->viewMenuListAdmin()->rowCount();
    if ($total == 0){
        $errmsg = 'No results found.';
    }
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

<?php
$row=0;
$sno = $row + 1;
?>


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
                <li class="active">
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i>&nbsp;List</a>
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


            <h1><?php echo isset($_GET['menu_category'])? $_GET['menu_category']: '';?> List Menu [
                <a href="listMenu.php">All</a> .
                <a href="listMenu.php?menu_category=Cake">Cake</a> .
                <a href="listMenu.php?menu_category=Beverage">Beverage</a> .
                <a href="listMenu.php?menu_category=Mini Bites">Mini Bites</a> ]</h1>
                    
                    </div>



             <div class="row">

                        <table id="emp_table" width="100%" border="0" >
      <tr class="tr_header" >
        <th class="solid"><a>No</a></th>
        <th class="solid"><a>Name</a></th>
        <th class="solid"><a>Price</a></th>
        <th class="solid"><a>Cost</a></th>
        <th class="solid"><a>Category</a></th>
        <th class="solid"><a>Description</a></th>
        <th class="solid"><a>Status</a></th>
        <th class="solid"><a>Image</a></th>
        <th class="solid"><a>Image File</a></th>
        <th class="solid"><a>Action</a></th>
      </tr>
      <?php 

        foreach($data as $row){
      ?>
      <tr text-align="center">
        <td class="solid"><?php echo $sno; ?></td>
        <td class="solid"><?php echo $row['menu_name']; ?></td>
        <td class="solid">RM <?php echo $row['menu_price']; ?></td>
        <td class="solid">RM <?php echo $row['cost']; ?></td>
        <td class="solid"><?php echo $row['menu_category']; ?></td>
        <td class="solid"><?php echo $row['menu_description']; ?></td>
        <td class="solid"><?php echo $row['menu_status']; ?></td>
        <td class="solid"><img src="/Project/img/<?php echo $row["menu_image"]; ?>" style="width:40px"></td>
        <td><?php echo $row['menu_image']; ?></td>

<!-- ACTION BUTTON (EDIT/DELETE MENU) -->

        <td><form action="" method="POST" onsubmit="return confirm('Are you sure want to delete?');">
          <button class="button btn1" input type="button" name = "edit" value="Edit" onclick="location.href='editMenu.php?id=<?=$row['menu_id']?>'">Edit</button><br>
          <input type="hidden" name="menu_id" value="<?=$row['menu_id']?>"><br>
          <button class="button btn2" input type="submit" name="delete" value="Delete">Delete</button>
        </form></td>


      </tr>
      <?php
      $sno++;
      } 
      ?>
    </table>


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