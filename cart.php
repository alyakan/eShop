<?php 
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
		if(isset($_GET['action']) && $_GET['action']=="purchase") {
			$sql="SELECT * FROM Cart 
						INNER JOIN Products ON Cart.p_id=Products.id_product 
						WHERE user_id='$user_id' and bought=0";
			$query=mysql_query($sql);
			$new_quantity=0;
			$purchase_available=True;
			// Check if all the quantities are available.
			while($row=mysql_fetch_array($query)) {
				$new_quantity=$row['Quantity']-$row['quantity'];
				if ($new_quantity<0) {
					$message="Not enough stock for this product: ".$row['Name'];
					$purchase_available=False;
				}
			}
			if ($purchase_available==1) {
				$sql="SELECT * FROM Cart 
						INNER JOIN Products ON Cart.p_id=Products.id_product 
						WHERE user_id='$user_id' and bought=0";
				$query=mysql_query($sql);
				while($row2=mysql_fetch_array($query)) {
					$new_quantity=$row2['Quantity']-$row2['quantity'];
					$sql1="UPDATE Products SET Quantity=".$new_quantity." WHERE id_product=".$row2['p_id']."";
					mysql_query($sql1);
					$sql1="";
				}

				$sql="UPDATE Cart SET bought=1 WHERE user_id='$user_id' and bought=0";
				mysql_query($sql);
				$message="Your purchase is complete!";
			}

		}
	}


if(isset($_SESSION['user_id'])){

	$user_id = $_SESSION['user_id'];

	if(isset($_POST['submit'])){

		foreach ($_POST['quantity'] as $key => $value) {

			if($value==0) {

				$del="DELETE FROM Cart WHERE user_id='$user_id' and p_id=$key";
				mysql_query($del);

			}else {

				$update=$sql_update="UPDATE Cart SET quantity=$value WHERE user_id='$user_id' and p_id=$key";
            	mysql_query($sql_update);

			}
		}

	}
}
?>

<div class="page-header">
    <h1><i class="fa fa-shopping-cart fa-fw"></i> Cart</h1>
</div>
<?php 

	if (isset($message)) {
		echo "<h2>".$message."</h2>";
	}

 ?>
<br>
<div class="alert alert-info">
  <strong>Info!</strong> To delete an item, enter amount 0 and press Update Cart.
</div>
<form method="post" action="index.php?page=cart" >

<table class="table table-hover table-responsive">
        <tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Item Price</th>
			<th>Subtotal</th>
			<th>Available Stock</th>
		</tr>
   
	<?php
if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
		$sql="SELECT * FROM Cart 
					INNER JOIN Products ON Cart.p_id=Products.id_product 
					WHERE user_id='$user_id' and bought=0";
		$query= mysql_query($sql);
		$total=0;
		while($row=mysql_fetch_array($query)) {
			$subtotal=$row['quantity']*$row['Price'];
			$total+=$subtotal; 
		
			?>
    <tr>
        <td><?php echo $row['Name']; ?></td>
				<td><input type="text" name="quantity[<?php echo $row['id_product'] ?>]" size="5" value="<?php echo $row['quantity']; ?>" style="text-align:center" /></td>
				<td><?php echo $row['Price'] ?><i class="fa fa-usd fa-fw"></i></td>
				<td><?php echo $subtotal; ?><i class="fa fa-usd fa-fw"></i></td>
				<td><?php echo $row['Quantity']; ?></td>
			</tr>

			<?php
        }
    }

    ?>
</table>
	<div class="well">
		Total amount = <strong><?php echo $total; ?></strong><i class="fa fa-usd fa-fw"></i><br><br>
		<div class="btn-group btn-group-justified">
			<div class="btn-group">
				<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-cart-plus fa-fw"></i>Update Cart</button>
			</div>
			
        	<a href="index.php?page=checkout" class="btn btn-success" data-toggle="tooltip"><i class="fa fa-money fa-fw"></i> Proceed to Checkout</a>
        	<a href="index.php?page=products" class="btn btn-primary btn-block"><i class="fa fa-home fa-fw"></i> Back to products</a>
		</div>
	</div>


</form>