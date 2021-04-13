<?php 
include("inc/conn.php");
if ($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['idxoa'])) {
	$idxoa=$_GET['idxoa'];
	$sql= "DELETE FROM category WHERE categoryid={$idxoa}";
	if (pg_query($dbconn,$sql)) {
		echo " Successful Delete".$idxoa;
		header("Location:category.php");
	}else{
		echo "Error".($dbconn);
	}
}
include("inc/header.php");
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$des=$_POST['des'];
	$sql="INSERT INTO category(categoryid, categoryname, categorydes) VALUES ($id,'$name','$des')";
	if(pg_query($dbconn,$sql)){
		$message = "Thêm thành công";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location:category.php');
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
<h3>Add Category</h3>
<form method="POST">
  <label for="id">Category ID:</label> <br>
  <input type="number" id="id" class="us-pw" name="id"><br>
  <label for="name">Category Name:</label><br>
  <input type="text" id="name" class="us-pw" name="name"><br>
  <label for="des">Category Description:</label> <br>
  <input type="number" id="des" class="us-pw" name="des"><br>
<button type="submit"  class="login">Add</button>
</form>
</div>
<div class="col-md-9">
	<table class="table table-bordered">
		<thead>
		<th>Category ID</th>
		<th>Category Name</th>
		<th>Category Description</th>
		</thead>
	<tbody>
		<?php
		$query="SELECT * FROM category";
		$rs= pg_query($dbconn,$query);
		if(pg_num_rows($rs) >0)
		while($row=pg_fetch_assoc($rs)){ 
		 ?>
		 <tr>
		 	<td><?=$row['categoryid']?></td>
		 	<td><?=$row['categoryname']?></td>
			<td><?=$row['categorydes']?></td>
		 	<td><a href="suacategory.php?id=<?=$row['categoryid']?>" style="text-decoration: none;"> Update</a></td>
		 	<td><a href="?idxoa=<?=$row['categoryid']?>"style="text-decoration: none;"> Delete</a></td>
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

