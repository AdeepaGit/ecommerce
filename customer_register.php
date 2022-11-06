<!DOCTYPE html>
<?php

session_start(); 

include("functions/functions.php");
include("includes/db.php");
?>
<html>
<head>
	<title>	My Online Shop</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">

</head>

<body>
<!-- main container strart from here-->
<div class="main_wrapper">
	<!-- header strart from here-->
	<div class="header_wrapper">
		<a href="index.php"><img id="logo" src="images/logo.png"/></a>
		<img id="banner" src="images/banner.gif" alt="image1" />
		
    </div>
    <!-- header end  here-->
    
    <!-- navigation bar strart from here-->
	<div class="menubar"> 
		
		<ul id="menu">
			<li><a href="index.php">Home</a></li> 
			<li><a href="all_products.php">All Products</a></li>
			<li><a href="customer/my_account.php>">My Account</a></li> 
			<li><a href="#">Sing UP</a></li>
			<li><a href="#">Shopping</a></li>
			<li><a href="#">Contact Us</a></li>
	    </ul>

	    <div id="form">
	  	<form method="get" action="results.php " enctype="multipart/from-data">
	  		<input type="text" name="user_query" placeholder="Search a Products" />
	  		<input type="submit" name="search" value="search">
	  	</form>
	  </div>

	</div>	
	<!-- navigation bar end here-->

	<!-- content_wrapper starts-->

	<div class="content_wrapper">

	<div id="sidebar">	
		<div id =Sidebar_titel>Catagory</div>

		 <ul id="cats">

		 	<?php getCats(); ?>

     <!--
			<li><a href="#"> Latops</a></li>
		    <li><a href="#">Computer</a></li>
			<li><a href="#">Mobiles</a></li>
			<li><a href="#">Cameras</a></li>
			<li><a href="#">iPads</a></li>
			<li><a href="#">Tablets</a></li>
     -->
		 </ul>

	   
	    <div id =Sidebar_titel>Brand</div>
		
		 <ul id="cats">

            <?php getBrand(); ?>
		<!--	<li><a href="#"> HP</a></li>
		    <li><a href="#">DELL</a></li>
			<li><a href="#">Lenavo</a></li>
			<li><a href="#">Asus</a></li>
			<li><a href="#">Apple</a></li>
			<li><a href="#">Huwawei</a></li> -->

		 </ul>
        
	    
	</div>    
	
	<div id="content_area">	
     <?php Cart(); ?>


		<div id="shopping_cart">

			<span style="float: right; font-size: 18px; padding: 5px;line-height: 40px; width: 800px;text-align: right;"> 

			Welcome guest! <b style="color: yellow"> Shopping Cart -</b>Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color: yellow">Go To Cart </a>

			 </span>
			
		</div>
    
		<form action="customer_register.php" method="post" enctype="multipart/form-data">
			<table align="center" width="750" >
			<tr align="center">
				<td colspan="6"><h2>Create an Account</h2></td>
			</tr>

			<tr>
				<td align="right">first Name:</td>
				<td><input type="text" name="c_name" required="" /></td>
			</tr>
			<tr>
				<td align="right">Customer Email:</td>
				<td><input type="text" name="c_email" required=""/></td>
			</tr>
			<tr>
				<td align="right">Customer Password</td>
				<td><input type="Password" name="c_password" required=""/></td>
			</tr>
			<tr>
				<td align="right">Customer Image</td>
				<td><input type="file" name="c_image" /></td>
			</tr> 

			<tr>
				<td align="right"> Customer City</td>
				<td><input type="text" name="c_city"required=""/></td>
			</tr>
			<tr>
				<td align="right">Customer Contact:</td>
				<td><input type="text" name="c_contact"required=""/></td>
			</tr>
			<tr>
				<td align="right">Customer Address</td>
				<td><input type="text" name="c_address"required=""/></td>
			</tr>
			<tr align="center">
				<td  colspan="6"><input type="submit" name="register" value="Create Account"/></td>
				
			</tr>
			</table>
		</form>
         


	</div>

 </div>
    <!-- content_wrapper end-->
	<div id="footer">	<h2 style="text-align: center; padding: 30px; "> &copy; by Adeepa</h2> </div>


	




</div>
<!-- main container end here-->
</body>
</html>

<?php
if(isset($_POST['register'])){

$ip=getIp();

$c_name=$_POST['c_name'];
$c_email=$_POST['c_email'];
$c_password=$_POST['c_password'];

$c_country=$_POST['c_country'];
$c_city=$_POST['c_city'];
$c_contact=$_POST['c_contact'];
$c_address=$_POST['c_address'];


$c_image= $_FILES['c_image']['name'];
$c_image_tmp= $_FILES['c_image']['tmp_name'];

move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

 $insert_c= "insert into customer(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image)
  value('$ip','$c_name','$c_email','$c_password','$c_country','$c_city','$c_contact','$c_address','$c_image')";


	//$insert_c= mysqli_query($con, $insert_c);
	$run_c= mysqli_query($con, $insert_c);

	 //if($insert_c){
	//	echo "<script> alert('successfuly Registered!')</script>"; or
		//echo "<script> window.open (' customer_register.php','self')</script>";
	
     $sel_cart="select * from cart";

     $run_cart=mysqli_query($con,$sel_cart);

   
     $check_cart=mysqli_num_rows($run_cart);


     if($check_cart == 0)
     {

     	$_SESSION['customer_email']=$c_email;

     	echo "<script> alert('Account has been created successfuly, Thanks!')</script>";
     	echo "<script>window.open('customer/my_account.php','_self')</script>";
     	//echo "<script>window.open('checkout.php','_self')</script>";
     }
      else{

          $_SESSION['customer_email']=$c_email;

     	echo "<script> alert('Account has been created successfuly,')</script>";
     	echo "<script>window.open('checkout.php','_self')</script>";
           }


	}


 ?>


