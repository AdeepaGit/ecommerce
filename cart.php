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
     <?php Cart(); ?>


		<div id="shopping_cart">

			<span style="float: right; font-size: 17px; padding: 5px;line-height: 40px; width: 800px;text-align: right;"> 

	        
           <?php 
               if(isset($_SESSION['customer_email'])){

               	echo "<b>Welcome:</b>". $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>";
               }
               else{
               	echo "Welcome Gusest!";
               }
            ?>
		

		 <b style="color: yellow"> Shopping Cart -</b>Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="index.php" style="color: yellow">Back to Shop </a>

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
         
         <form action=""  method="post" enctype="multipart/from-data">

  <table align="center" width="700" bgcolor="#ffff99" >

 <tr align="center">


 </tr>
 <tr align="center">
 	<th>Remove</th>
 	<th>Product(s)</th>
 	<th>Quantity</th>
 	<th>Total Price</th>
 </tr>
     <?php 

    $total=0;



	global $con;

	$ip=getIp();

	$sele_price= "select* from cart where ip_add='$ip'";

	$run_price= mysqli_query($con,$sele_price);

	while ($p_price=mysqli_fetch_array($run_price)) {

		$pro_id=$p_price['p_id'];

		$pro_price= "select * from products where product_id='$pro_id'";
		
		$run_pro_price=mysqli_query($con,$pro_price);

		while ($pp_price=mysqli_fetch_array($run_pro_price)) {

			$product_price= array($pp_price['product_price']);
			$product_titel=$pp_price['product_titel'];
			$product_image=$pp_price['product_image'];
			$singal_price=$pp_price['product_price'];

            $values=array_sum($product_price);

            $total += $values;

		//	$values= array_sum($product_price);

		//	$total +=$values;
		//  echo "$".$total;
     ?>

     <tr align="center">
     	<td><input type="checkbox" name="Remove[]" value="<?php echo $pro_id; ?>" /></td>
    
        <td><?php echo $product_titel; ?><br>
        <img src="admin_area/product_images/<?php echo $product_image; ?>"  width="60" height="60"/ >
     	</td>

     	<td>
     	<!--	<input type="text" size="4" name="qty" value="<?php //echo $_SESSION['qty']; ?>"/>  -->
     	<select name="qty">
     		<option>1</option>
     		<option>2</option>
     		<option>3</option>
     	</select>
     	</td>

     	<?php 
        
     	if(isset($_POST['update_cart'])){
     		$qty=$_POST['qty'];
     		$update_qty= "Update cart set qty='$qty'";

     		$run_qty=mysqli_query($con,$update_qty);
     		//$_SESSION['qty']=$qty;

     	    $total=$total*$qty;
     		
     	    }
             
        //  echo   "<script> window.open('cart.php','_self')</script>";
     	 ?>

     	<td>  <?php echo "$". $singal_price ?></td>
     </tr>

      <?php  }} ?>
      <tr  >
      	<td colspan="3" align="right"><b> Sub Total:</b></td>
      	<td  ><?php echo "$". $total; ?></td>

      </tr>
      
      <tr align="center">
      	<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
        <td><input type="submit" name="continue" value="Continue Shopping"/></td>
        <td ><button ><a href="checkout.php" style="text-decoration: none; color: black" >Checkout</a> </button></td>
       </tr>

  </table>
     </form>
         <?php

        function updatecart(){

        global $con;

          $ip=getIp();

        // 

         if(isset($_POST['update_cart'])){

             foreach ($_POST['Remove'] as $Remove_id ) {
             
             $delete_product="delete from cart where p_id='$Remove_id' AND ip_add='$ip'";
             $run_delete= mysqli_query($con,$delete_product);

             if($run_delete){

             	echo "<script> window.open('cart.php','_self')</script>";
             }
             	

             }
             }


          if(isset($_POST['continue'])){

          	echo   "<script> window.open('index.php','_self')</script>";
             }



            echo "@$up_cart =  updatecart()";
        
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