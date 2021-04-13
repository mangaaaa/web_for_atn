<?php 
include("inc/conn.php");
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	$id=$_GET['id'];
	$status=$_POST['status'];
$sql="UPDATE invoices SET order_status='$status' WHERE invoice_id=$id ";
if(pg_query($dbconn,$sql)){
	echo "successfully updated";
}else{
	echo "Error: " .($dbconn);
}
}
$id=$_GET['id'];
$sql= pg_query($dbconn,"SELECT * FROM invoices WHERE invoice_id={$id}");
$product = pg_fetch_assoc($sql);
include("inc/header.php");
?>

<div class="rightcolumn">
<h3>Update Invoice Status : <?= $product['invoice_id']?></h3>
<br><br>
<form method="POST" enctype="multipart/form-data">
	<label>Invoice Status:</label> <br>
	<select name="status" style="width: 170px" placeholder="Choose Product Category">
	<?php
		$query="SELECT * FROM invoices";
		$rs= pg_query($dbconn,$query);
		?>
    <option selected value="<?=$product['order_status']?>"><?=$product['order_status']?></option>
	<option value="Đã xác nhận">Đã xác nhận</option>
    <option value="Đang giao">Đang giao</option>
    <option value="Đã giao">Đã giao</option>
	<option value="Đã Hủy">Đã hủy</option>
	</select> <br> <br>
	<input type="submit" name="submit" value="Update" class="login">
</form>
</div>
