<?php 
include("inc/conn.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
	$id=$_GET['id'];
	$name=$_POST['name'];
	$des=$_POST['des'];
	$sql="UPDATE category SET categoryname='$name', categorydes='$des', WHERE categoryid=$id ";
	if(pg_query($dbconn,$sql)){
		echo "successfully updated";
	} else {
		echo "Error: " .($dbconn);
	}
}
$id=$_GET['id'];
$sql= pg_query($dbconn,"SELECT * FROM category WHERE categoryid={$id}");
$product = pg_fetch_assoc($sql);
include("inc/header.php");
?>

<div class="rightcolumn">
<h3>Update Category: <?= $product['categoryname']?></h3>
<br><br>
<form method="POST" enctype="multipart/form-data">
	<label>Enter Category Name:</label> <br>
	<input class="us-pw" type="text" name="name" value="<?=$product['categoryname']?>"/> <br>
	<label>Enter Category Description:</label> <br>
	<input class="us-pw" type="text" name="des" value="<?=$product['categorydes']?>"/> <br>
	<img class="anh-sp" src="../img/<?=$product['categoryimg']?>" class="us-pw" > <br> <br>
<input type="submit" name="submit" value="Update" class="login">
</form>
</div>
