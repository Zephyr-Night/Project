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
$menu_id = $_GET['id']; 
//echo "This is menu id: " . $menu_name;
$data = $menu->viewMenu($menu_id);

// edit a specific menu details
if(isset($_POST['edit'])){
    $menu->editMenu();
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


<title>Edit Menu</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script language="javascript" type="text/javascript">
    window.history.forward();
    </script>
        
    <meta charset="UTF-8">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
                rel="stylesheet"  type='text/css'></link>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/homePage.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
                rel="stylesheet"  type='text/css'>
        </link>
            <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/Project/css/home.css">

<!-- STYLE -->

<style>
  /*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

html {
    height: 100%;
}

body {
    font-family: montserrat, arial, verdana;
}

#msform {
    width: 50%;
    margin: 50px auto;
    text-align: center;
    position: relative;
}
#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 100%;    
    
    /*stacking fieldsets above each other*/
    position: relative;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}
/*inputs*/
#msform input, #msform textarea {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 13px;
}
/*buttons*/
#msform .action-button {
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

#msform .action-button:hover {
  opacity: 0.7;
}

/*headings*/
.fs-title {
    font-size: 15px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
}
.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}
/* */
#div_pagination{
    width:100%;
    margin-top:5px;
    text-align:center;
}

/* <!-- BUTTON STYLE --> */
.button {
    background-color: #e74c3c; /* Green */
    border: none;
    color: white;
    padding: 10px 50px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/Project/css/style1.css">


/* Style the indicator (dot/circle) */
.container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}

body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: white;
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

</style>

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
                    <a href="/ProjectGd/ApplicationLayer/ManageMenuInterface/listMenu.php"><i class="fa fa-list"></i>&nbsp;List</a>
                </li>
                <li class="active">
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
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
                            <a class="nav-link" href="/Project/ApplicationLayer/ManageAdminInterface/adminLogout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fas fa-sign-out-alt"></i>&nbsp;<span>Sign Out</span></a>
                            </li>
                            <li class="nav-item active">
                            <a class="nav-link" href="/Project/ApplicationLayer/ManageAdminInterface/adminProfile.php"><i class="fa fa-user"></i><span>&nbsp; <?php echo $admin_username; ?> </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

             <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
                    </div>

<!-- EDIT MENU FORM -->

<?php

    foreach($data as $row){
?>
   <div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
                        </div>
                        <div class="card-body">
<form id="msform" action="" method="POST" onsubmit="return confirm('Are you sure want to update?');">

<fieldset>

<h2 style="text-align:center"><b>Edit Menu</b></h2>
<p style = "font-size: 15px; color:grey; text-align: center;">Save your edit when done!</p>
<p style = "font-size: 14px; color:red; text-align: center;"><b>* required</b></p><br>

<input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>"/>

<center><img src="../../img/<?php echo $row['menu_image'];?>" height="130" width="150"></center>  

<br>
<p style="font-size: 16px; color: grey;">Menu ID : <?= $row['menu_id']?></p>
<br>
<div class="form-group">
<p style="font-size: 16px; color: black; text-align: left;"> Name <label style="font-size: 16px; color: red;"> * </label></p>
    <input type="text" id="menu_name" name="menu_name" class="form-control"  value="<?php echo $row['menu_name']; ?>" /><br/>
</div>


<div class="form-group">
<p style="font-size: 16px; color: black; text-align: left"> Price <label style="font-size: 16px; color: red;"> * </label></p>
    <input type="float" id="menu_price" name="menu_price" class="form-control" value="<?php echo $row['menu_price']; ?>" /><br/>
</div>

<div class="form-group">
<p style="font-size: 16px; color: black; text-align: left"> Cost <label style="font-size: 16px; color: red;"> * </label></p>
    <input type="float" id="cost" name="cost" class="form-control" value="<?php echo $row['cost']; ?>" /><br/>
</div>


<p style="font-size: 16px; color: black; text-align: left"> Category <label style="font-size: 16px; color: red;"> * </label></p>
    <div style="display:flex; border: 1px solid lightgrey; padding: 13px; border-radius: 4px; font-size: 15px;">
    <label class="container">Cake
        <input type="radio" id="menu_category" name="menu_category" <?=$row['menu_category']=="Cake" ? "checked" : ""?> value="Cake">
       
        <span style="left: 12%" class="checkmark"></span>
    </label>
    <label class="container">Beverage
        <input type="radio" id="menu_category" name="menu_category" <?=$row['menu_category']=="Beverage" ? "checked" : ""?> value="Beverage">
        <span style="left:40%" class="checkmark"></span>
    </label>
    <label class="container">Mini Bites
        <input type="radio" id="menu_category" name="menu_category" <?=$row['menu_category']=="Mini Bites" ? "checked" : ""?> value="Mini Bites">
        <span style="left:69%" class="checkmark"></span>
    </label>
    </div><br/>

<div class="form-group">
<p style="font-size: 16px; color: black; text-align: left"> Description <label style="font-size: 16px; color: red;"> * </label></p>
    <input type="text" id="menu_description" name="menu_description" class="form-control" value="<?php echo $row['menu_description']; ?>" /><br/>
</div>


<p style="font-size: 16px; color: black; text-align: left"> Status <label style="font-size: 16px; color: red;"> * </label></p>
    <div style="display:flex; border: 1px solid lightgrey; padding: 13px; border-radius: 4px; font-size: 15px;">
    <label class="container">Available
        <input type="radio" id="menu_status" name="menu_status" <?=$row['menu_status']=="Available" ? "checked" : ""?> value="Available">
        <span style="left: 18%" class="checkmark"></span>
    </label>
    <label class="container">Not available
        <input type="radio" id="menu_status" name="menu_status" <?=$row['menu_status']=="Not available" ? "checked" : ""?> value="Not available">
        <span style="left:59%" class="checkmark"></span>
    </label>
    </div><br/>

<div class="form-group">
<p style="font-size: 16px; color: black; text-align: left"> Image <label style="font-size: 16px; color: red;"> * </label></p>
    <input type="text" id="menu_image" name="menu_image" class="form-control" value="<?php echo $row['menu_image']; ?>" /><br/>
</div>

<br><br>

<!-- ACTION BUTTON (SUBMIT EDIT MENU) -->

<input type="submit" class="btn btn-dark" name="edit" value="Save">
 <a class="btn btn-link" href="listMenu.php">Back</a>
<?php
    }
?>

</fieldset>
</form>

</div>
</div>
<!-- Footer -->
    <footer class="p-4 mb-0 bg-secondary">
     <div class="container">
       <p class="m-0 text-center text-white">&copy; 2021 DINGO FOOD. All Rights Reserved</p>
     </div>
    </footer>

</body>

</html>

