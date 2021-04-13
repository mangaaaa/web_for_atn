<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$id=$_POST['id'];
	$name=$_POST['productname'];
	$price=$_POST['productprice'];
	$des=$_POST['productdes'];
	$img=$_POST['img'];
	$origin=$_POST['productorigin'];
	$category=$_POST['category'];
	$sql="INSERT INTO product(productid,productname, productprice, productdes, productimg, productorigin, categoryid) 
		  VALUES ('$id','$name','$price','$des','$img','$origin',$category)";
	if(pg_query($dbconn,$sql)){
		$message = "Thêm thành công";
	echo "<script type='text/javascript'>alert('$message');</script>";
		header("Location: index.php");
	}
	else{
		echo "Error: ".($dbconn);
	}
}
?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-3">
	<form class="form-inline my-2 my-lg-0" action="searchtoy.php" method="GET">
	<h3>Search Toy</h3>
	      <input class="form-control mr-sm-2" type="search" placeholder="Enter toy name" name="Search">
	    </form> <br> <br>
	<h3>Add Product</h3>
	<form method="POST">
	<div class="form-group">
	<input type="text" name="id" class="form-control"  placeholder="Enter Product ID"> <br>
	<input type="text" name="productname" class="form-control"  placeholder="Enter Product Name"> <br>
	<input type="number" name="productprice" class="form-control"  placeholder="Enter Product Price"> <br>
	<textarea name="productdes" class="form-control"  placeholder="Enter Product Description"></textarea> <br>
	<label>Choose Product picture</label> <br>
	<input type="file" name="img"> <br> <br>
	<input type="text" name="productorigin" class="form-control"  placeholder="Enter Product Origin"> <br>
	<label>Choose Category</label>
	<select name="category" style="width: 170px" placeholder="Choose Product Category" class="form-control" >
	<?php
		$query="SELECT * FROM category";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		?>
    <option selected></option>
    <option value="<?=$row['categoryid']?>"><?php echo $row['categoryname'] ?></option>
    <?php 
		}
	?>
	</select> <br> <br>
	<input type="submit" name="submit" value="Add" class="login"> 
	</div>
</form>
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
				FROM product, category WHERE product.categoryid=category.categoryid";
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
