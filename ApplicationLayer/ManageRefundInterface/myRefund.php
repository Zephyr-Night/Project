<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
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
require_once '../../libs/custSession.php';

$name = $_SESSION['username'];


$no=0;
$num=0;

$status1="";
$status2="Refund Unsuccessful";
$status3="Refund Successful ";
$status4="Pending....";

if (isset($_GET['errormsg'])) {
  echo '<script>alert(" No item selected ")</script>';
}

if (isset($_GET['work'])=="1") {
  echo '<script>alert(" item refund has been request")</script>';
}

$sql="SELECT * FROM refund WHERE refund_status='$status1' OR refund_status='$status2' ";
$result_list_refund=makeConnect($sql);
/* database for list refund to be selected*/

$sql="SELECT * FROM refund WHERE refund_status='$status3' OR refund_status='$status4' ";
$result_confirmation_refund=makeConnect($sql);
/* database for list refund to be process*/


function makeConnect($sql){
  $conn=mysqli_connect("localhost","root","","dingofood");
  $result=mysqli_query($conn,$sql);
  return $result;
}
?>
<head>
    <link rel="stylesheet" href="/Project/css/dingo.css">

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
       <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
           type='text/css'>
       </link>
       <link href="/Project/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       <link rel="stylesheet" href="/Project/css/home.css">
   <style>
   body,
   html {
       height: 50%;
       margin: 0;
       font-family: Arial, Helvetica, sans-serif;
   }

   .hero-image {
       background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("/Project/img/dingoLogo4.jfif");
       height: 50%;
       background-position: center;
       background-repeat: no-repeat;
       background-size: cover;
       position: relative;
   }

   .hero-image2 {
       background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/Project/img/wall4.jpg");
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


   /* Create two equal columns that floats next to each other */
   .column {
       float: left;
       width: 50%;
       padding: 0 10%;
       height: 300px;
       /* Should be removed. Only for demonstration */
   }

   /* Clear floats after the columns */
   .row:after {
       content: "";
       display: table;
       clear: both;
   }
   </style>

</head>

  <body>
    <div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:70px">My Refund </h1>

        </div>
    </div>

    <div id="menu-nav">
        <div style="list-style-type: none;" id="navigation-bar">
           <ul>
                <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/home.php"><i class="fa fa-home"></i><span>Home</span></a></li>
                <li><a href="/Project/ApplicationLayer/ManageMenuInterface/viewMenu.php"><i class="fa fa-book"></i><span>Menu</span></a></li>
                
                <li><a href="/Project/ApplicationLayer/ManageOrderInterface/cart.php"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>

                <li><a href="/Project/ApplicationLayer/ManageRefundInterface/refundList.php"><i class="fa fa-money"></i><span>Refund</span></a></li>
                <li><a href="/Project/ApplicationLayer/ManageRefundInterface/myRefund.php"><i class="material-icons" style="font-size:21px">class</i><span>My Refund</span></a></li>
                
                <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/logout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fa fa-sign-out"></i><span>Sign Out</span></a></li>
                
                <a href="/Project/ApplicationLayer/ManageCustomerInterface/customerProfile.php" id="topnav-right"><i class="fa fa-user"></i><span>Hello <?php echo $name; ?></span></a>
            </ul>

        </div>

    </div>

<center><h3>My Refund  </h3 >

<form method="post">
<table class="table table-striped table-hover">

       <tr class="text-white bg-dark">
         <th >Refund id</th>
         <th>Refund Item</th>
         <th>Time</th>
         <th>Current Status</th>
         <th></th>

      </tr>

<?php if($result_confirmation_refund->num_rows>0){
  while($row=$result_confirmation_refund->fetch_assoc()){
      $num=$num+1;
      $item=$row['item'];
 ?><tr>
        <td><?php echo $row['refund_id'];?></td>
        <td><?php echo $row['item'];?></td>
        <td><?php echo $row['refund_time'];?></td>
        <td><?php echo $row['refund_status']; ?></td>
        <td><?php if ($row["refund_status"]=="Pending....") {

        ?>
        <input type="submit" value="cancel request" class="btn btn-danger" name="Submit1"  onclick="delete_request()" >
        <?php
        }
        ?>
      </td>
      </tr>
<?php
}
if (isset($_POST["Submit1"])) {
  $status="";
  $sql="UPDATE refund SET refund_status='$status'  WHERE item='$item'";
  $result=makeConnect($sql);
   header('location:myRefund.php?Sucsses_cancel_refund');
}
}else {
?>
<tr><td></td><td></td><td>
<?php
  echo "no refund has been made";
?>
</td><td></td></tr>
<?php
 }
 ob_flush();
?>
</table>
<br>
</form>
</center>
</body>
</html>

<script>
    
function delete_request(){
 alert("Your refund request has been delete....thank you");
 }

</script>