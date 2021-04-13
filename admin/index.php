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
 include("product.php");
 ?>
