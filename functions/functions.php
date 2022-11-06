<?php

$con= mysqli_connect("localhost","root","","onlineshop");

// get user IP address

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
         //ip from share inernet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

     // creating the shopping cart

function cart()
{
if(isset($_GET['add_cart'])){

 global $con;

 $ip=getIp();

 $pro_id=$_GET['add_cart'];

 $check_pro="select all from cart where ip_add='$id' AND p_id='$pro_id'";

 $run_check= mysqli_query($con, $check_pro);

 if(mysqli_num_rows($run_check>0)){

 	echo"";
 }
 else
 {
 	$insert_pro="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";

 	$run_pro= mysqli_query($con,$insert_pro);

 	echo "<script>window.open('index.php','_self')  </script>";

 }

}

}

 // getting total adding item

function total_items(){

	if(isset($_GET['add_cart'])){

		global $con;

		$ip= getIp();

		$get_items="select * from cart where ip_add='$ip'";

		$run_items =mysqli_query($con,$get_items);

		$count_items = mysqli_num_rows($run_items);
	}


		else{

			global $con;


			$ip= getIp();

		$get_items="select * from cart where ip_add='$ip'";

		$run_items =mysqli_query($con,$get_items);

		$count_items = mysqli_num_rows($run_items);

		}


   echo $count_items;

	
}
//Getting the total price of items in the cart

function total_price(){

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

			$values= array_sum($product_price);

			$total +=$values;


		}
	}

    echo "$".$total;
}



//getting catagorie

function getCats()
	{
		global $con;
 
		$get_cats = "select * from categories";

		$run_cats = mysqli_query($con, $get_cats);

		while ($row_cats = mysqli_fetch_array($run_cats )) {
			
			$cat_id = $row_cats['cat_id'];
			$cat_titel = $row_cats['cat-titel'];

			echo "<li> <a href='index.php?cat=$cat_id'> $cat_titel </a> </li>";

		}

	}

	function getBrand()
	{
		global $con;

		$get_brand = "select * from brands";

		$run_brand = mysqli_query($con, $get_brand);

		while ($row_brand = mysqli_fetch_array($run_brand)) {
			
			$brand_id = $row_brand['brand_id'];
			$brand_titel = $row_brand['brand_titel'];

			echo "<li> <a href='index.php?brand=$brand_id'> $brand_titel </a> </li>";

		}

	}



function getpro(){

	//if(!isset(($_GET['cat']))){
	//	if(!isset($_GET['brand'])){

	global $con;

	$get_pro="select * from products order by RAND() LIMIT 0,6"; 

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

       <p><b> price: $ $pro_price<b></p>

       <a href='details.php?pro_id=$pro_id' style='float:left'> Details>></a>

       <a href='index.php? add_cart=$pro_id'><button style='float:right'> Add to cart</button></a> 

     </div>
     
     ";
	}
}

/*

function getCatpro(){

	if(isset(($_GET['cat']))){

		$cat_id=$_GET['cat'];
		
	global $con;

	$get_cat_pro="select * from products where product_cat='$cat_id'"; 

	$run_cat_pro=mysqli_query($con,$get_cat_pro);

	$count_cats=mysqli_num_rows($run_cat_pro);      //  no product msg
	if($count_cats==0){
		echo "<h2> No products found on this catagory!</h2>";    //
	}

	while ($row_cat_pro=mysqli_fetch_array($run_cat_pro)) {
		
		$pro_id=$row_cat_pro['product_id'];
		$pro_cat=$row_cat_pro['product_cat'];
		$pro_brand=$row_cat_pro['product_brand'];
		$pro_titel=$row_cat_pro['product_titel'];
		$pro_price=$row_cat_pro['product_price'];
		$pro_image=$row_cat_pro['product_image'];

     echo " 

     <div  id='singale_product'>

       <h3> $pro_titel</h3>
       <img src='admin_area/product_images/$pro_image' width='180' height='180'/>

       <p><b> $ $pro_price<b></p>

       <a href='details.php?pro_id=$pro_id' style='float:left'> Details>></a>

       <a href='index.php? pro_id=$pro_id'><button style='float:right'> Add to cart</button></a> 

     </div>
     
     
     ";
	}

}

/*

function getBrandpro(){

	if(isset(($_GET['brand']))){

		$brand_id=$_GET['brand'];
		
	global $con;

	$get_brand_pro="select * from products where product_brand='$brand_id'"; 

	$run_brand_pro=mysqli_query($con,$get_brand_pro);

	$count_brands=mysqli_num_rows($run_brand_pro);      //  no product msg
	if($count_brands==0){
		echo "<h2> No products found on this catagory!</h2>";    //
	}

	while ($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
		
		$pro_id=$row_brand_pro['product_id'];
		$pro_cat=$row_brand_pro['product_cat'];
		$pro_brand=$row_brand_pro['product_brand'];
		$pro_titel=$row_brand_pro['product_titel'];
		$pro_price=$row_brand_pro['product_price'];
		$pro_image=$row_brand_pro['product_image'];

     echo " 

     <div  id='singale_product'>

       <h3> $pro_titel</h3>
       <img src='admin_area/product_images/$pro_image' width='180' height='180'/>

       <p><b> $ $pro_price<b></p>

       <a href='details.php?pro_id=$pro_id' style='float:left'> Details>></a>

       <a href='index.php? pro_id=$pro_id'><button style='float:right'> Add to cart</button></a> 

     </div>
     
     
     ";
	}

}
}


?>