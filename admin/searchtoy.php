<?php 
include("../inc/conn.php");
if ($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['idxoa'])) {
	$idxoa=$_GET['idxoa'];
	$sql= "DELETE FROM product WHERE productid={$idxoa}";
	if (pg_query($dbconn,$sql)) {
		echo "Successful Delete".$idxoa;
		header('Location:index.php');
	}else{
		echo "Error".($dbconn);
	}
}
 include("inc/header.php");
 ?>
 <?php
 $search = "";
 if( !empty($_GET['Search'])){
   $search = $_GET['Search'];
 }
 ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-3">
	<form class="form-inline my-2 my-lg-0" action="searchtoy.php" method="GET">
	<h3>Search Toy</h3>
	      <input class="form-control mr-sm-2" type="search" placeholder="Enter toy name" name="Search">
	    </form> <br> <br>
</div>
<div class="col-md-9">
<table class="table table-bordered">
		<thead>
		<th>ID</th>
		<th>Product Image</th>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Product Description</th>
		<th>Product Origin</th>
		<th>Category</th>
		<th></th>
		<th></th>
		</thead>
	<tbody>
		<?php
		$query="SELECT *
				FROM product, category WHERE product.categoryid=category.categoryid AND productname LIKE '%{$search}%'";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		 ?>
		 <tr>
		 	<td><?=$row['productid']?></td>
		 	<td><img class="anh-sp" src="../img/<?=$row['productimg']?>"/></td>
		 	<td><?=$row['productname']?></td>
		 	<td><?=$row['productprice']." VND"?></td>
		 	<td><textarea><?=$row['productdes']?></textarea></td>
		 	<td><?=$row['productorigin']?></td>
		 	<td><?=$row['categoryname']?></td>
		 	<td><a href="suaproduct.php?id=<?=$row['productid']?>" style="text-decoration: none;"> Update</a></td>
		 	<td><a href="?idxoa=<?=$row['productid']?>"style="text-decoration: none;"> Delete</a></td>
		 </tr>
		 <?php 
		}
		  ?>
	</tbody>
</table>
</div>
</div>
</div>
