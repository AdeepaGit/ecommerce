<!DOCTYPE html>
<?php

session_start();
include("functions/functions.php");

?>
<html>
<head>
	<title>	My Online Shop</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" media="all">
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
			<li><a href="../index.php">Home</a></li> 
			<li><a href="../all_products.php">All Products</a></li>
			<li><a href="my_account.php">My Account</a></li> 
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
		<div id =Sidebar_titel align="center">My Account</div>


       
        	 <ul id="cats">

		<?php
		if(isset($_SESSION['customer_email'])){

		$user =$_SESSION ['customer_email'];

		$get_img="select * from customer where customer_email='$user'  ";

		$run_img=mysqli_query($con,$get_img);

		$row_img=mysqli_fetch_array($run_img);

		$c_image=$row_img['customer_image'];

		$c_name=$row_img['customer_name'];

		echo" <p text-align='center;'> <img src='customer_images/$c_image' width='150' height='150'/><p>";
		}
		?>

		
        <li> <a href="my_account.php?my_orders"> My Order</a></li> 
        <li> <a href="my_account.php?edit_account">Edit Account</a></li> 
        <li> <a href="my_account.php?change_pass">Change Password</a></li> 
        <li> <a href="my_account.php?delete_account">Delete Account</a></li> 
        <li> <a href="logout.php">LogOut</a></li> 
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>

		 </ul>

	   </div>
	   
	 <div id="content_area">	
	
     <?php Cart(); ?>


		<div id="shopping_cart">

			<span style="float: right; font-size: 17px; padding: 5px;line-height: 40px; width: 800px;text-align: center;"> 
           
           <?php 
               if(isset($_SESSION['customer_email'])){

               	echo "<b>Welcome:</b>". $_SESSION['customer_email'] ;
               }
              
            ?>
		

           <?php
               
               if(!isset($_SESSION['customer_email'])){

               	echo "<a href='../checkout.php' style='color:orange'>Login</a>";
               }
               else{
               	echo "<a href='logout.php' style='color:orange'>Logout</a>";
               }

              ?>
			 </span>
			
		</div>
       

		<div id="product_box"> 

			<h2 style="padding: 20px;">Hello <?php 
          if(isset($_SESSION['customer_email'])){
          echo $c_name;} ?> </h2>  
        <?php
        if(!isset($_GET['my_orders'])){
        	 if(!isset($_GET['edit_account'])){
        	 	 if(!isset($_GET['change_pass'])){
        	 	 	 if(!isset($_GET['delete_account'])){

        	echo " <h2 style='padding: 20px;'>Welcome to Your Account <p></p></h2>
        	 <img src='images/my_account.png' width='500 height='300' />";
        	 	 	 }
        	 	 	}
        	 	 }

        } 

        ?>
        <?php
        if(isset($_GET['edit_account'])){
        	include("edit_account.php");
        }

         if(isset($_GET['change_pass'])){
        	include("change_pass.php");
        }

         if(isset($_GET['delete_account'])){
        	include("delete_account.php");
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