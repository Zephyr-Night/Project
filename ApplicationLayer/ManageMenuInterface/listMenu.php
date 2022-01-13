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
<html lang="en" >

<head>

  <title>List Menu</title>
	<script language="javascript" type="text/javascript">
	window.history.forward();
	</script>
	
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300'>

		<meta name="author" content="">

		<title>DINGO FOOD - Food Ordering System (FOS)</title>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
				rel="stylesheet"  type='/Project/text/css'>
		</link>
		    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/Project/css/home.css">

<!-- STYLE -->

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}

#emp_table {
    border:3px solid lavender;
    border-radius:3px;
}

/* Table header */

.tr_header th a{
    color: black;
  text-align: center;
    text-decoration: none;
}

.tr_header{
    background-color: #ff99b3 ;
}

.tr_header th{
    color:black;
    padding:10px 0px;
    letter-spacing: 1px;
  text-align: center;
}

/* Table rows and columns */
#emp_table td{
    padding:10px;
  text-align: center;
}
#emp_table tr:nth-child(even){
    background-color:lavender;
    color:black;
}

#content{
    border:1px solid darkgrey;
    border-radius:3px;
    padding:5px;
    width: 100%;
    margin: 0 auto;
}

/* */
#div_pagination{
    width:100%;
    margin-top:5px;
    text-align:center;
}

body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: #c69f9f;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("/Project/img/dingoLogo3.jfif");
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}

ul {
    list-style-type: none;

}

/* Button */
.btn {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.btn1 {
  background-color: #4CAF50; 
  color: black; 
  width: 80px;
  height: 25px;
  border: 2px solid #4CAF50;
}


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


.btn2 {
  background-color: #f44336; 
  color: black; 
  width: 80px;
  height: 25px;
  border: 2px solid #f44336;
}


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


<!-- HEADER DINGO -->

<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:70px">D I N G O F O O D</h1>
    <p style="color: black">Everything's Fresh Here at DingoFood</p><br>
  </div>
</div>

<!-- NAVBAR -->

<div id="menu-nav">
  <div style="list-style-type: none;" id="navigation-bar">
 <ul>
      <li><a href="/Project/ApplicationLayer/ManageAdminInterface/adminHome.php"><i class="fa fa-home"></i><span>Home</span></a></li>
      <li><a href="/Project/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i><span>List</span></a></li>
      <li><a href="/Project/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i><span>New Menu</span></a></li>
      <li><a href="/Project/ApplicationLayer/ManageRefundInterface/refundAdmin.php"><i class="fa fa-money"></i><span>Refund</span></a></li>
      <li><a href="/Project/ApplicationLayer/ManageReportInterface/indexAdmin.php"><i class="fa fa-bar-chart"></i><span>Report</span></a></li>
    <li><a href="/Project/ApplicationLayer/ManageAdminInterface/adminLogout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fa fa-sign-out"></i><span>Sign Out</span></a></li>
    <a href="/Project/ApplicationLayer/ManageAdminInterface/adminProfile.php" id="topnav-right"><i class="fa fa-user"></i><span>Hello <?php echo $admin_username; ?> </span></a>
    </ul>
  </div>
</div>

<!-- DISPLAY MENU ACCORDING MENU_CATEGORY -->

<div class="container" style="margin-top:20px">
          <center><h2><?php echo isset($_GET['menu_category'])? $_GET['menu_category']: '';?> List Menu [
                <a href="listMenu.php">All</a> .
                <a href="listMenu.php?menu_category=Cake">Cake</a> .
                <a href="listMenu.php?menu_category=Beverage">Beverage</a> .
                <a href="listMenu.php?menu_category=Mini Bites">Mini Bites</a> ]</h2>
<br>

<!-- DISPLAY MENU -->


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
                <li class="active">
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