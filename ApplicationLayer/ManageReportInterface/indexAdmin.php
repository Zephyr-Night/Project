<?php
session_start();

/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dingofood';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$conn = mysqli_connect($host, $user, $pass, $database);
if ($conn) {
} else {
  echo "Connection not successful" . mysqli_error($conn);
  die($conn);
}

require_once '../../BusinessServiceLayer/controller/reportController.php';
$report = new reportController();
$dataDaily = $report->viewAll();
$report = new reportController();
$dataWeekly = $report->viewWeeklyReport();
$report = new reportController();
$dataMonthly = $report->viewMonthlyReport();

if (isset($_POST['buy'])) {
  $report->delete();
}

if (isset($_POST['sell'])) {
  $report->exportReport();
}
$admin_username = $_SESSION['admin_username'];

?>

<html>

<head>
  <title>Monthly Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="/Project/css/monthlyStyle.css">
  </script>

  <link rel="stylesheet" href="\Project\css\homePage.css">
  <link rel="stylesheet" href="\Project\css\tableMonthly.css">
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    .background {
      position: relative;
      height: 100vh;
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .background::before {
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/Project/img/adminbg.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      content: "";
      background-size: cover;
      position: absolute;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;

    }

    .hero-image {
      background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("/Project/img/dingoLogo5.jfif");
      height: 20%;
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

    .button {
      background-color: #e74c3c;
      /* Green */
      border: none;
      color: white;
      padding: 10px 50px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      -webkit-transition-duration: 0.4s;
      /* Safari */
      transition-duration: 0.4s;
      cursor: pointer;
    }

    .button1 {
      background-color: white;
      color: black;
      border: 4px solid #e74c3c;
    }

    .button1:hover {
      background-color: #e74c3c;
      color: white;
    }

    #centered {
      display: flex;
      justify-content: center;
      text-align: center;
    }

    h2 {
      font-size: 5em;
      font-family: Aclonica;
    }

    .collapsible {
      background-color: #ffffff;
      color: black;
      display: block;
      cursor: pointer;
      padding: 18px;
      width: 100%;

      border: none;
      text-align: center;
      outline: none;
      border-radius: 12px;

      margin-top: 50px;
      font-size: 2em;
      font-family: Aclonica;
    }

    .active,
    .collapsible:hover {
      background-color: #555;
      color: white;
    }

    .content {
      padding: 0 18px;
      color: black;
      display: none;
      overflow: hidden;
      background-color: #f1f1f1;
    }
  </style>
  <?php

  $rowperpage = 90;
  $row = 0;

  // Previous Button
  if (isset($_POST['but_prev'])) {
    $row = $_POST['row'];
    $row -= $rowperpage;
    if ($row < 0) {
      $row = 0;
    }
  }

  // Next Button
  if (isset($_POST['but_next'])) {
    $row = $_POST['row'];
    $allcount = $_POST['allcount'];

    $val = $row + $rowperpage;
    if ($val < $allcount) {
      $row = $val;
    }
  }

  // generating orderby and sort url for table header
  function sortorder($fieldname)
  {
    $sorturl = "?order_by=" . $fieldname . "&sort=";
    $sorttype = "asc";
    if (isset($_GET['order_by']) && $_GET['order_by'] == $fieldname) {
      if (isset($_GET['sort']) && $_GET['sort'] == "asc") {
        $sorttype = "asc";
      }
    }
    $sorturl .= $sorttype;
    return $sorturl;
  }

  // count total number of rows
  $sql = "SELECT COUNT(*) AS cntrows FROM report";
  $result = mysqli_query($conn, $sql);
  $fetchresult = mysqli_fetch_array($result);
  $allcount = $fetchresult['cntrows'];

  // selecting rows


  $orderby = " ORDER BY id desc ";
  if (isset($_GET['order_by']) && isset($_GET['sort'])) {
    $orderby = ' order by ' . $_GET['order_by'] . ' ' . $_GET['sort'];
  }


  ?>
</head>

<body>

  <div class="hero-image">
    <div class="hero-text">
      <h1 style="font-size:70px">D I N G O F O O D</h1>
    </div>
  </div>

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
  <div class="background">
    <div style="position: relative; margin-top: 50px; margin-left: 50px; margin-right: 50px; margin-bottom: 50px; ">
      <h2><b>Sales Report</b></h2>
      <button type="button" class="collapsible">Daily Report</button>
      <div class="content">
        <!-- Table for Daily Report -->
        <table class="table-fill">
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
          $total_revenue = 0;
          foreach ($dataDaily as $row) {

            $menu_id = $row['order_id'];
            $menu_price = $row['menu_price'];
            $quantity = $row['order_quantity'];
            $total_amount = $menu_price * $quantity;
            $total_revenue += $total_amount;
            $sno++;
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
              <table class="table-fill">
                <tr>
                  <th class="text-left" style="text-align:center;">Grand Total</th>
                </tr>
                <tr>
                  <td style="text-align:center;"><?php echo $total_revenue; ?></td>
                </tr>
            </form>
        </table>
      </div>

      <button type="button" class="collapsible">Weekly Report</button>
      <div class="content">
        <!-- Table for Weekly report -->
        <table class="table-fill">
          <thead>
            <tr>
              <th class="text-left">No</th>
              <th class="text-left">Order Detail</th>
              <th class="text-left">Sales</th>
              <th class="text-left">Tax (5%)</th>
              <th class="text-left">Total</th>
            </tr>
          </thead>

          <?php

          $sno = 0;
          foreach ($dataWeekly as $row) {
            $order_detail = $row['order_detail'];
            $sales = $row['order_quantity'] * $row['menu_price'];
            $tax = $sales * 0.05;
            $total = $sales - $tax;
            $sno++;
          ?>
            <form action="" method="POST">
              <tbody class="table-hover">
                <tr>
                  <td class="text-left"><?php echo $sno; ?></td>
                  <td class="text-left"><?php echo $order_detail; ?></td>
                  <td class="text-left"><?php echo $sales; ?></td>
                  <td class="text-left"><?php echo $tax; ?></td>
                  <td class="text-left"><?php echo $total; ?></td>
                </tr>
            </form>

            </tbody>
          <?php
          }
          ?>
        </table>
      </div>

      <button type="button" class="collapsible">Monthly Report</button>
      <div class="content">
        <!-- Table for Monthly Report -->
        <table class="table-fill" style="max-width:none;">
          <thead>
            <tr>
              <th class="text-left">No</th>

              <th class="text-left">Cost</th>
              <th class="text-left">Profit</th>
              <th class="text-left">Revenue</th>
            </tr>
          </thead>
          <?php

          $sno = 0;
          foreach ($dataMonthly as $row) {

            $cost = $row['cost'];
            $profit = $row['order_quantity'] * $row['menu_price'];
            $total_revenue = $profit - $cost;
            $sno++;
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

    </div>
  </div>

  <script src="/Project/js/report.js"></script>