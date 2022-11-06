
<h2 style="text-align: center;">Do you really want to Delete your account?</h2>
<form action="" method="post">
<br>
<input type="submit" name="yes" value="Yes I want"/>	
<input type="submit" name="No" value="No I was joking"/>	

 


</form>
<?php

if(isset($_SESSION['customer_email'])){

$user= $_SESSION['customer_email'];

if (isset($_POST['yes'])) {
	
	$delete_customer="delete from customer where customer_email='$user'";


	$run_customer=mysqli_query($con,$delete_customer);


	echo "<script> alert('Your account has been Deleted')</script>";
	echo "<script> window.open('../index.php','_self')</script>";

}
if (isset($_POST['No'])) {

    echo "<script> alert('oh! do not joke aigain!')</script>";
	echo "<script> window.open(' my_account.php,'_self')</script>";

}  
}


if(!isset($_SESSION['customer_email'])){



if (isset($_POST['yes'])) {
	
	echo "<script> alert('Your not loging')</script>";
	echo "<script> window.open('../checkout.php','_self')</script>";

}
if (isset($_POST['No'])) {

    echo "<script> alert('oh! do not joke aigain!')</script>";
	echo "<script> window.open(' my_account.php,'_self')</script>";

}  
}

?>