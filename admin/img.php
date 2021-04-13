<?php 
include("inc/conn.php");
if ($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['idxoa'])) {
	$idxoa=$_GET['idxoa'];
	$sql= "DELETE FROM product_img WHERE imgid={$idxoa}";
	if (pg_query($dbconn,$sql)) {
		echo " Successful Delete".$idxoa;
		header("Location:img.php");
	}else{
		echo "Error".($dbconn);
	}
}
include("inc/header.php");
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$name=$_POST['name'];
	$pro=$_POST['pro'];
	$sql="INSERT INTO product_img(img_name, productid) VALUES ('$name','$pro')";
	if(pg_query($dbconn,$sql)){
		$message = "Thêm thành công";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location:img.php');
	}
	else{
		echo "Error: ".($dbconn);
	}
}
?>
<br>
<br>
<div class="container-fluid">
<div class="row">
<div class="col-md-3">
<form class="form-inline my-2 my-lg-0" action="searchimg.php" method="GET">
	<h3>Search Toy</h3>
	      <input class="form-control mr-sm-2" type="search" placeholder="Enter toy name" name="Search">
	    </form> <br> <br>
<h3>Add Image</h3>
<form method="POST">
  <label for="name">Image Name:</label><br>
  <input type="text" id="name" class="us-pw" name="name"><br> 
  <label>Choose Product</label>
	<select name="pro" style="width: 170px" placeholder="Choose Product Category" class="form-control" >
	<?php
		$query="SELECT * FROM product";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		?>
    <option selected></option>
    <option value="<?=$row['productid']?>"><?php echo $row['productname'] ?></option>
    <?php 
		}
	?>
	</select> <br> <br>
<button type="submit"  class="login">Add</button>
</form>
</div>
<div class="col-md-9">
	<table class="table table-bordered">
		<thead>
		<th>Image ID</th>
		<th>Image Name</th>
		<th>Product</th>
		</thead>
	<tbody>
		<?php
		$query="SELECT * FROM product_img,product where product.productid=product_img.productid";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		 ?>
		 <tr>
		 	<td><?=$row['imgid']?></td>
		 	<td><?=$row['img_name']?></td>
			<td><?=$row['productname']?></td>
		 	<td><a href="?idxoa=<?=$row['imgid']?>"style="text-decoration: none;"> Delete</a></td>
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

