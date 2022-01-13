<?php 
require_once 'C:/xampp/htdocs/Project/BusinessServiceLayer/controller/menuController.php';

$sql = "SELECT * FROM `menu`";
$res = mysqli_query($connection, $sql);

$menu = new menuController();

// display menu list according pages, menu_status and menu_category

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
    $data = $menu->viewMenuListPage($offset, $number_of_records, $term);
    $total = $menu->viewMenuList()->rowCount();
} else {
    $term = '';
    $data = $menu->viewMenuListPage($offset, $number_of_records,'');
    $total = $menu->viewMenuList()->rowCount();
    if ($total == 0){
        $errmsg = 'No menu found.';
    }
}

$pages_needed = ceil($total / $number_of_records);

require_once '../../libs/custSession.php';

$name = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en" >

<head>

	<title>View Menu</title>
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
		    <link href="/Project/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}

.price {
  color: grey;
  font-size: 22px;
}

.status {
  color: green;
  font-size: 16px;
}

.picture {
	width : 100%;

}

.menu{
    transition: all 0.25s ease ;
    -webkit-transition: all 0.25s ease ;
    -moz-transition: all 0.25s ease ;
    -ms-transition: all 0.25s ease ;
    -o-transition: all 0.25s ease ;
    margin-bottom: 1rem;
}

.card:hover {box-shadow: 2px 2px 20px 5px #c99c9c;}

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

body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
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

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>

</head>

<body>

<?php
$row=0;
$sno = $row + 1;
?>

<!-- HEADER DINGO -->
  
 <div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:80px">D I N G O F O O D</h1>
    <p style="color: black">Everything's Fresh Here at DingoFood</p><br>
  </div>
</div>

<!-- NAVBAR -->

  <div id="menu-nav">

  <div style="list-style-type: none;" id="navigation-bar">

	<ul>
        <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/home.php"><i class="fa fa-home"></i><span>Home</span></a></li>
        <li><a href="/Project/ApplicationLayer/ManageMenuInterface/viewMenu.php"><i class="fa fa-book"></i><span>Menu</span></a></li>
        <li><a href="/Project/ApplicationLayer/ManageOrderInterface/cart.php"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
        <li><a href="/Project/ApplicationLayer/ManageRefundInterface/refundList.php"><i class="fa fa-money"></i><span>Refund</span></a></li>
        <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/logout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fa fa-sign-out"></i><span>Sign Out</span></a></li>
                
        <a href="/Project/ApplicationLayer/ManageCustomerInterface/customerProfile.php" id="topnav-right"><i class="fa fa-user"></i><span>Hello <?php echo $name; ?></span></a>
    </ul>

  </div>
  
</div>

<!-- DISPLAY MENU ACCORDING MENU_CATEGORY -->

<div class="container" style="margin-top:20px">
        <center><h2><?php echo isset($_GET['menu_category'])? $_GET['menu_category']: '';?> Menu</h2>
        <div class="row">
        	<center>
        		<a href="viewMenu.php">All</a> .
                <a href="viewMenu.php?menu_category=Cake">Cake</a> .
                <a href="viewMenu.php?menu_category=Beverage">Beverage</a> .
                <a href="viewMenu.php?menu_category=Mini Bites">Mini Bites</a>
<br><br><br>

<!-- DISPLAY MENU -->

            <div class="col-sm-20 main-content">
                <div class="row">
            <?php
                if (isset($errmsg)){
                    echo "<h3>$errmsg</h3>";
                }
                foreach($data as $row){
                    $menu_id = $row['menu_id'];
                    echo "<div class='col-sm-4'>
                    		<div class='card'>
                    		<a href='/Project/ApplicationLayer/ManageOrderInterface/addOrder_Cart.php?menu_id=$menu_id'>
                    		<img class='picture' src='/Project/img/". $row['menu_image'] ."'></a>
                    			<h3>".$row['menu_name'] ."</h3>
                    		
                    			<p class='price'>RM". $row['menu_price'] ."</p>
                    			<p>". $row['menu_description'] ."</p>
      							<p class='status'> ". $row['menu_status'] ."</p>
      							<p><a href='/Project/ApplicationLayer/ManageOrderInterface/addOrder_Cart.php?id=" . $row['menu_id'] . "'><button>Add to Cart</button></a></p>
                    		</div>
                    		<br><br>
                    	</div>";
   				}
            ?>
        		</div>
<br>

<!-- MENU PAGE NUMBER -->

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                    for ($x = 1; $x <= $pages_needed; $x++) {
                        if(isset($_GET['menu_category'])){
                            $menu_category = $_GET['menu_category'];
                            echo "<li class='page-item'><a class='page-link' href='viewMenu.php?pageno=$x&menu_category=$menu_category&term=$term'>". $x ."</a></li>";
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='viewMenu.php?pageno=$x&term=$term'>". $x ."</a></li>";
                        }
                    }
                ?>
            </ul>
        </nav>

            </div>
        </div>
    </div>

<!-- FOOTER -->

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
