<?php 
session_start();
if (!empty($_SESSION['user'])) {
	echo "";
}else{
	header('Location:login.php');
	die;
	}
	require_once("conn.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="https://img.icons8.com/fluent/96/000000/data-configuration.png"/>
	<link rel="stylesheet" type="text/css" href="aset/admin.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Management System </title>
</head>

<body>
<div class="header">
<marquee behavior="alternate" width="10%">>></marquee><h3>Admin page</h3><marquee behavior="alternate" width="10%"><< </marquee>
</div>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container" >
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Product Management <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="category.php"><i class="fa fa-info-circle" aria-hidden="true"></i> Category Management</a>
	      </li>
	     <li class="nav-item">
	        <a class="nav-link" href="invoices.php"><i class="fas fa-cart-plus"></i>Invoice Management </a>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link" href="img.php"><i class="fas fa-cart-plus"></i>Product Image Management </a>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link" href="logout.php"><i class="fas fa-cart-plus"></i>Log out </a>
	      </li>
	    </ul>
	  </div>
  </div>
</nav>
</div>
<br>
<br>