<?php 

	if(isset($_GET['action']) && $_GET['action']=="purchase") {
		$sql="SELECT * FROM Cart 
					INNER JOIN Products ON Cart.p_id=Products.id_product 
					WHERE username='aly' and bought=0";
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
		if ($purchase_available) {
			while($row=mysql_fetch_array($query)) {
				$new_quantity=$row['Quantity']-$row['quantity'];
				$sql1="UPDATE Products SET Quantity=".$new_quantity." WHERE id_product=".$row['p_id']."";
				mysql_query($sql1);
				$sql1="";
			}

			$sql="UPDATE Cart SET bought=1 WHERE username='aly' and bought=0";
			mysql_query($sql);
			$message="Your purchase is complete!";
		}

	}



	if(isset($_POST['submit'])){

		foreach ($_POST['quantity'] as $key => $value) {

			if($value==0) {

				$del="DELETE FROM Cart WHERE username='aly' and p_id=$key";
				mysql_query($del);

			}else {

				$update=$sql_update="UPDATE Cart SET quantity=$value WHERE username='aly' and p_id=$key";
            	mysql_query($sql_update);

			}
		}

	}

?>

<h1>Cart</h1>
<?php 

	if (isset($message)) {
		echo "<h2>".$message."</h2>";
	}

 ?>
<a href="index.php?page=products">Back to products</a>
<br>
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

		$sql="SELECT * FROM Cart 
					INNER JOIN Products ON Cart.p_id=Products.id_product 
					WHERE username='aly' and bought=0";
		$query= mysql_query($sql);
		$total=0;
		while($row=mysql_fetch_array($query)) {
			$subtotal=$row['quantity']*$row['Price'];
			$total+=$subtotal;
		
			?>
    <tr>
        <td><?php echo $row['Name']; ?></td>
				<td><input type="text" name="quantity[<?php echo $row['id_product'] ?>]" size="5" value="<?php echo $row['quantity']; ?>" style="text-align:center" /></td>
				<td><?php echo $row['Price'] ?>$</td>
				<td><?php echo $subtotal; ?>$</td>
				<td><?php echo $row['Quantity']; ?></td>
			</tr>

			<?php
        }

    ?>
</table>

	<br><br>
	Total amount = <?php echo $total; ?>$
	<br><br>
	<div class="btn-group">
	    <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus fa-fw"></i>Update Cart</button>
        <a href="index.php?page=checkout" class="btn btn-primary btn-sm" data-toggle="tooltip">Proceed to Checkout</a>
    </div>
	
	<br><br>


</form>