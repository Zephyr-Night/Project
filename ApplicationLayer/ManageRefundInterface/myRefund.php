 
 <html> 
 <body>

<center><h3>My Refund  </h3 ></center>

<form method="post">
<table class="content-table">

       <tr>
         <th>refund id</th>
         <th>Refund Item</th>
         <th>Time</th>
         <th>Current Status</th>

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
        <input type="submit" value="cancel request" class="btn btn1" name="Submit1"  onclick="delete_request()" >
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
   header('location:refundList.php?Sucsses_cancel_refund');
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