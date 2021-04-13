<?php 
include("inc/conn.php");
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	$id=$_GET['id'];
	$name=$_POST['name'];
	$price=$_POST['price'];
	$des=$_POST['des'];
	$img=$_POST['img'];
	$origin=$_POST['origin'];
	$category=$_POST['category'];
	$sql="UPDATE product SET productname='$name',productprice='$price',productdes='$des',productimg='$img',categoryid='$category' WHERE productid=$id ";
	if(pg_query($dbconn,$sql)){
			header("Location: suaproduct.php");
	}else{
		echo "Error: " .($dbconn);
	}
}
$id=$_GET['id'];
$sql= pg_query($dbconn,"SELECT * FROM product,category WHERE 
product.categoryid=category.categoryid and productid={$id}");
$product = pg_fetch_assoc($sql);
include("inc/header.php");
?>

</div>
<div class="rightcolumn">
<h3>Update Product: <?= $product['productname']?></h3>
<br><br>
<form method="POST" >
	<label>Enter product name</label> <br>
	<input class="us-pw" type="text" name="name" value="<?=$product['productname']?>"/> <br>
	<label>Enter product price </label> <br>
	<input type="number" name="price" value="<?=$product['productprice']?>" class="us-pw"> <br>
	<label>Enter product description</label> <br> <br>
	<textarea class="us-pw" name="des"><?=$product['productdes']?></textarea> <br>
	<label>Choose product image</label> <br>
	<img class="anh-sp" src="../img/<?=$product['productimg']?>" class="us-pw" > <br> <br>
	<input type="file" name="img" value="<?=$product['productimg']?>"> <br> <br>
	<label>Enter product origin</label> <br>
	<input class="us-pw" type="text" name="origin" value="<?=$product['productorigin']?>"/> <br>
	<label>Enter Category</label> <br>
	<select name="category" style="width: 170px" placeholder="Choose Product Category">
	<?php
		$query="SELECT * FROM category";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		?>
    <option selected value="<?=$product['categoryid']?>"><?=$product['categoryname']?></option>
    <option value="<?=$row['categoryid']?>"><?php echo $row['categoryname'] ?></option>
    <?php 
		}
	?>
	</select> <br> <br>
	<input type="submit" name="submit" value="Update" class="login">
</form>
</div>
