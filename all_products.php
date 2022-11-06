<!DOCTYPE html>
<?php
session_start();
include("functions/functions.php");
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
			<li><a href="customer/my_account.php">My Account</a></li> 
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
		<div id="shopping_cart">

			<span style="float: right; font-size: 17px; padding: 5px;line-height: 40px; width: 800px;text-align: center;"> 
           
           <?php 
               if(isset($_SESSION['customer_email'])){

               	echo "<b>Welcome:</b>". $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>";
               }
               else{
               	echo "Welcome Gusest!:";
               }
            ?>
		


			 <b style="color: yellow"> Shopping Cart -</b>Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color: yellow">Go To Cart </a>
             <?php
               
               if(!isset($_SESSION['customer_email'])){

               	echo "<a href='checkout.php' style='color:orange'>Login</a>";
               }
               else{
               	echo "<a href='logout.php' style='color:orange'>Logout</a>";
               }

              ?>
			 </span>
			
		</div>

		<div id="product_box"> 
         

         <?php $get_pro="select * from products "; 

	$run_pro=mysqli_query($con,$get_pro);
	while ($row_pro=mysqli_fetch_array($run_pro)) {
		
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_titel=$row_pro['product_titel'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];

     echo " 

     <div  id='singale_product'>

       <h3> $pro_titel</h3>
       <img src='admin_area/product_images/$pro_image' width='180' height='180'/>

       <p><b> $ $pro_price<b></p>

       <a href='details.php?pro_id=$pro_id' style='float:left'> Details>></a>

       <a href='index.php? pro_cat=$pro_id'><button style='float:right'> Add to cart</button></a> 

     </div>
     
     ";
	}
   
 ?>
         
         
         
		</div>


	</div>

 </div>
    <!-- content_wrapper end-->
	<div id="footer">	<h2 style="text-align: center; padding: 30px; "> &copy; by Adeepa</h2> </div>


	




</div>
<!-- main container end here-->
</body>
</html>