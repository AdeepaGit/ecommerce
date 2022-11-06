
<?php 
//session_start();     //alread add in chekout page
include("includes/db.php");
//include("functions/functions.php");  //alread add in chekout page
 ?>
<div align="center">

<form method="post" action="" >
	<table width="500" align="center" bgcolor="skyblue">
		<tr align="center" >
			   <td colspan="3"><h2>Login or Register to buy!</h2></td></tr>

			   <tr >

			   <td align="right"><b>Email:</b></td>
			    <td><input type="text"  name="email" placeholder="Enter email" required=""></td> 

			</tr>
			<tr  >

			   <td align="right"><b>Password:</b></td>
			    <td><input type="Password"  name="pass" placeholder="Enter Password" required=""></td> 

			</tr>

			<tr align="center" >
			    <td colspan="3"><a href="checkout.php?forgot_pass" style="padding: 5px;">Forgot Password?</a></td> 

			</tr>
			<tr align="center" >
			    <td colspan="3"><input type="submit"  name="Login" value="Login" style="padding: 5px;"></td> 

			</tr>
	</table>

	<h2 style="padding: 10px"><a href="customer_register.php" style="text-decoration: none;">New? Register Here</a></h2>
</form>


<?php   

if(isset($_POST['Login'])) {
     
     $c_email=$_POST['email'];
     $c_pass=$_POST['pass'];

     $sel_c="select * from customer where customer_pass='$c_pass' AND
      customer_email='$c_email' ";

     $run_c= mysqli_query($con,$sel_c);

     $check_customer=mysqli_num_rows($run_c);

     if($check_customer==0){
     	echo "<script> alert('Password or email is incorrect, plz try again!')</script>";
     	exit();
     }

    // $ip=getIP();
     $sel_cart="select * from cart";

     $run_cart=mysqli_query($con,$sel_cart);

   
     $check_cart=mysqli_num_rows($run_cart);


     if($check_customer>0 AND $check_cart==0){


      $_SESSION['customer_email']=$c_email;

     	echo "<script> alert('you login successfuly, Thanks!')</script>";
     	echo "<script>window.open('customer/my_account.php','_self')</script>";
     	//echo "<script>window.open('checkout.php','_self')</script>";
     }
      else{

          $_SESSION['customer_email']=$c_email;

     	echo "<script> alert('you logged successfuly,')</script>";
     	echo "<script>window.open('checkout.php','_self')</script>";
           }
      
}

?>

</div>