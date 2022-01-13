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




  <title>Add Menu</title>
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
/*form styles*/
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
/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}
#progressbar li {
    list-style-type: none;
    color: black;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    float: left;
    position: relative;
}
#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 20px;
    line-height: 20px;
    display: block;
    font-size: 10px;
    color: #333;
    background: #333;
    border-radius: 3px;
    margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #ccc;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none; 
}
/*marking active/completed steps green*/    
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
    background: #4CAF50;
    color: black;
}

<!-- RADIO BUTTON-->

/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    left: 26%;
    height: 25px;
    width: 25px;
    background-color: grey;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

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
                <li class="active">
                    <a href="/Project/ApplicationLayer/ManageMenuInterface/addMenu.php"><i class="fa fa-plus"></i>&nbsp;New Menu</a>
                </li>
                <li>
                    <a href="/Project/ApplicationLayer/ManageRefundInterface/refundAdmin.php"><i class="fas fa-money-bill-alt"></i>&nbsp;Refund</a>
                </li>
            
        </nav>

        <!-- Page Content  -->
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
                        <h1 class="h3 mb-0 text-gray-800">Add New Menu</h1>
                    </div>

                    <div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
                        </div>
                        <div class="card-body">

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
                
</div>


<!-- ADD NEW MENU FORM -->

<form id="msform" action="" method="POST" onsubmit="return confirm('Make sure menu information are correct');">

<fieldset>

<h2 style="text-align:center"><b>Add New Menu</b></h2>
<p style = "font-size: 15px; color:grey; text-align: center;">Fill in all new menu details in the fields</p>
<p style = "font-size: 14px; color:red; text-align: center;"><b>* required</b></p><br>

<p style="font-size: 16px; color: black; text-align: left;"> Name <label style="font-size: 16px; color: red;"> * </label></p>
<input type="text" id="menu_name" name="menu_name" required><br/>

<p style="font-size: 16px; color: black; text-align: left"> Price <label style="font-size: 16px; color: red;"> * </label></p>
<input type="float" id="menu_price" name="menu_price" required><br/>

<p style="font-size: 16px; color: black; text-align: left"> Cost <label style="font-size: 16px; color: red;"> * </label></p>
<input type="float" id="cost" name="cost" required><br/>

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

<p style="font-size: 16px; color: black; text-align: left"> Description <label style="font-size: 16px; color: red;"> * </label></p>
<input type="text" id="menu_description" name="menu_description" required><br/>

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

<input class="action-button" type="submit" name="add" value="Add New Menu">
<a href="listMenu.php">Back</a>

</fieldset>
</form>

<br>

<!-- Footer -->
    <footer class="p-4 mb-0 bg-secondary">
     <div class="container">
       <p class="m-0 text-center text-white">&copy; 2021 DINGO FOOD. All Rights Reserved</p>
     </div>
    </footer>

</body>

</html>