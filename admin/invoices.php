<?php 
include("inc/conn.php");
include("inc/header.php");
?>
<div class="container">
<div class="row">
<div class="col-md-2">\
<h3>View by</h3>
		<div class="list-group">
	<a href="viewinvoice.php?status_order=Chờ xác nhận" class="list-group-item list-group-item-action">Chờ xác nhận</a>
  <a href="viewinvoice.php?status_order=Đã xác nhận" class="list-group-item list-group-item-action">Đã xác nhận</a>
  <a href="viewinvoice.php?status_order=Đang giao" class="list-group-item list-group-item-action">Đang giao</a>
  <a href="viewinvoice.php?status_order=Đã giao" class="list-group-item list-group-item-action">Đã giao</a>
  <a href="viewinvoice.php?status_order=Đã hủy" class="list-group-item list-group-item-action">Đã hủy</a>
</div>
		</div>
<div class="col-md-10">
<br>
	<form action="searchorder.php" method="GET">
	      <input class="form-control" type="search" placeholder="Enter oderID to search" name="Search">
	    </form>
		<br>
		<table class="table table-bordered">
		<thead>
		<th>Invoice ID</th>
		<th>Status</th>
		<th>Created Date</th>
		<th>Total</th>
		<th>Shipping Address</th>
		<th>Customer Name</th>
		<th>Customer Phone</th>
		<th>Customer Email</th>
		<th>Message of Customer</th>
		</thead>
	<tbody>
		<?php
		$query="SELECT * FROM invoices ";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		?>
		 <tr>
		 	<td><?=$row['invoice_id']?></td>
		 	<td><?=$row['order_status']?></td>
		 	<td><?=$row['create_date']?></td>
			<td><?=$row['total']?></td>
			<td><?=$row['shipping_address']?></td>
			<td><?=$row['cusname']?></td>
			<td><?=$row['cusphone']?></td>
			<td><?=$row['cusemail']?></td>
			<td><?=$row['note']?></td>
		 	<td><a href="suainvoice.php?id=<?=$row['invoice_id']?>" style="text-decoration: none;"> Update</a></td>
		 </tr>
		<?php 
		}
		?>
	</tbody>
</table>
		</div>
</div>
</div>
</body>
</html>

