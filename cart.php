<?php 
ob_start();
session_start();
require_once("inc/conn.php");
include("inc/header.php");
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$id =$_POST['id'];

	if (empty($_SESSION['cart'][$id])) {
		$q=pg_query($dbconn,"SELECT * FROM product WHERE productid = {$id}");
		$product = pg_fetch_assoc($q);
		$_SESSION['cart'][$id]=$product;
		$_SESSION['cart'][$id]['sl']=$_POST['sl'];
		header("Location: cart.php");
	}else{
		$sMoi = $_SESSION['cart'][$id]['sl'] + $_POST['sl'];
		$_SESSION['cart'][$id]['sl']=$sMoi;
		header("Location: cart.php");
	}
 }
 ?>
 <div class="container-fluid">
 <div class="row">
 <link rel="stylesheet" type="text/css" href="cart.css">
 	<h3 class="giohang"><i class="fas fa-shopping-cart"></i>  Cart</h3>
  <br>
  <br>
 	<?php 
 	if (!empty($_SESSION['cart'])) {
 		foreach ($_SESSION['cart'] as $item) :
			$tong1 = $item['sl'] * $item['productprice'];
 		?>
 		<div class="products" style="border: 2px solid #E6E6E6">
 	 	<a href="single.php?id=<?php echo $item['productid']?>" style="text-decoration: none;">
 	 	<div><img src="img/<?php echo $item['productimg']?>" class="img-cart"></div>
 	 	<h2>Name: <?php echo $item['productname'] ?></h2>
		  <br>
        <p style="color: red">Price: <?php echo $item['productprice']." $"; ?></p>
		<div style="float: right;padding: 30px">
		  <p style="float: right;" style="padding: 30px;">Number: <?php echo $item['sl'] ?></p> <br> <br>
		  <p style="float: right;" style="padding: 30px;">Total: <?php echo $tong1 ?></p>
		  </div>
		  <br>
		  <br>
        <?php
		echo "<a href='delcart.php?productid=$item[productid]' style='text-decoration: none;'>Delete</a>";
		?>
         </a>
         </div>
         	 <?php
 	endforeach;
 	}
 	else {
	 ?>
	 <div class="login">
	 <div class="wrap">
		 <h4 class="title">Shopping cart is empty</h4>
		 <p class="cart">You have no items in your shopping cart.<br>Click<a href="index.php"> here</a> to continue shopping</p>
	   </div>
	</div>
 		<?php
		 }
 	?>
 	<br>
   <?php
 		 $tong = 0;
 		  foreach ($_SESSION['cart'] as $item ) :
 		 	$tong += $item['sl'] * $item['productprice'];
 		 endforeach;
 		 ?>
	 <?php
	 if ($tong !=0){
		?>
		<a href="delcart.php?productid=0" style="text-decoration: none; color: white;float:right"><button type="button" class="btn btn-danger">Delete All</button></a>
	 <div id="total" class="clearfix" style="padding: 10px;">
 		 <h3>Total All Product: <?php echo number_format($tong) ." $" ?></h3>
 	</div>
	 </div>
 </div>
 <div style="width: 100%;color: red;text-align: center;">
    <marquee behavior="alternate" width="10%">>></marquee>Checkout blow<marquee behavior="alternate" width="10%"><< </marquee>
    </div>
		<div class="container">
			<div class="row">
 	<div class="col-md-6">
 	<form method="POST" action="thanhtoan.php" class="was-validated">
	 <h4>Billing Address</h4>
	 <br>
	 <br>
	 <div class="form-group" class="form-inline">
	 <label for="n"><i class="fa fa-user"></i>Enter FullName</label>
	 <input type="text" class="form-control" id="n" placeholder="Enter FullName" name="name" required>
	 <label for="phone">Enter Phone</label>
	 <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required><br>
	 <label for="add"><i class="fa fa-institution"></i>Enter Address</label> 
	 <input type="text" class="form-control" require id="add" placeholder="Enter Address" name="add" required>
	 <label for="email"> <i class="fa fa-envelope"></i>Email</label>
	 <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email"> <br>
	 <label for="note"> <i class="fa fa-envelope"></i>Message for shop</label>
	 <input type="text" class="form-control" id="note" placeholder="Enter Message" name="note">
	 </div>
	 </div>
	 <div class="col-md-6">
	 <h4>Payment</h4>
	 <br>
	 <br>
    <label for="bank">Select payment bank</label> <br>
	<label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
  <select class="custom-select" required id="bank" name="bank">
    <option selected></option>
    <option value="Visa">Visa</option>
    <option value="Techcombank">MasterCard</option>
    <option value="Airpay">Discovery</option>
    <option value="momo">Viettelpay</option>
  </select>
<div class="form-group">
  <div class="form-group">
  <label for="usr">Order date:</label>
  <input type="text" class="form-control" id="usr" name="date" value="<?php
  date_default_timezone_set('Asia/Ho_Chi_Minh');
echo "". date("Y.m.d h:i:sa");
?>" readonly>
</div>
<div class="form-group">
  <label for="usr">Total</label>
  <input type="text" class="form-control" id="usr" value=" <?php echo number_format($tong) ." $" ?>" readonly name="total">
</div>
<label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label> <br>
		<br>
		<br>
<input type="submit" value="Continue to checkout" class="btn">
<input type="hidden" name="id" value="<?=$item?>">
 	</form>
 	</div>
		<?php
		}
		?>
 </div>
 </div>
		</div>
		</div>
		<br>
		
 <?php 
 include ('inc/footer.php');
 ob_end_flush();
  ?>
  
