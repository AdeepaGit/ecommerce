
<!DOCTYPE>

<?php 
include("includes/db.php");
?>

<html>
<head>
	<title>Insert Product</title>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script >
	tinymce.init({selector:'textarea'});
</script>
	
</head>

<body bgcolor="skyblue">

	<form action="insert_product.php " method="post"
	enctype="multipart/form-data">

		<table align="center" width="750" border="1" bgcolor="#ffff99">

			<tr  >
				<td colspan="8"> 
					<h2 style="text-align: center;">Insert New Post Here</h2>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Titel:</b></td>
				<td >
					<input type="text" name="product_titel" size="60" />
				</td>
			</tr> 
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td >
					
					<select name="product_cat" >
						<option>Select a Catagory</option>
						<?php
						$get_cats = "select * from categories";

		                $run_cats = mysqli_query($con, $get_cats);

		                while ($row_cats = mysqli_fetch_array($run_cats )) {
			
			            $cat_id = $row_cats['cat_id'];
			            $cat_titel = $row_cats['cat-titel'];

			            echo "<option value='$cat_id'> $cat_titel </option>";
                            }
		                  ?>
		              </select>

				</td>
			</tr> 
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td >
					<select name="product_brand" >
						<option>Select a Brand</option>
						<?php
						$get_brand = "select * from brands";

		$run_brand = mysqli_query($con, $get_brand);

		while ($row_brand = mysqli_fetch_array($run_brand)) {
			
			$brand_id = $row_brand['brand_id'];
			$brand_titel = $row_brand['brand_titel'];

			echo "<option value='$brand_id'>  $brand_titel </option>";
			    }
			    ?>
		              </select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Image:</b></td>
				<td >
					<input type="file" name="product_image" />
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td >
					<input type="text" name="product_price" />
				</td>
			</tr> 
			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td >
					<textarea  name="product_desc" cols="20" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Keyword:</b></td>
				<td >
					<input type="text" name="product_keywords" size="50" />
				</td>
			</tr>

			<tr align="center">
				
				<td colspan="8"  >
					<input type="submit" name="insert_post" value="Insert Product Now" />
				</td>
			</tr>
		</table>
	</form>


</body>
</html>

<?php

if(isset($_POST['insert_post']))
{
  //getting text data from field

	$product_titel=$_POST['product_titel'];
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$product_keywords=$_POST['product_keywords'];

	 //getting image data from field

	$product_image=$_FILES['product_image']['name'];
	$product_image_temp=$_FILES['product_image']['tmp_name'];

	 move_uploaded_file($product_image_temp,"product_images/$product_image" );

	$insert_product="Insert into products (product_cat,product_brand, 
	product_titel,product_price,product_desc,product_image,product_keywords) value('$product_cat','$product_brand','$product_titel',
	'$product_price','$product_desc',
	'$product_image','$product_keywords')";


	$insert_pro= mysqli_query($con, $insert_product);

	if($insert_pro){
		echo "<script> alert('successfuly Inserted!')</script>";
		echo "<script> window.open (' insert_product.php','self')</script>";
	}




}
?>