<?php 

	if(isset($_GET['action']) && $_GET['action']=="buy"){
        $id=intval($_GET['id']);

        $sql_buy="INSERT INTO Cart (p_id, quantity, username, bought)
            VALUES ($id, 1, 'aly', 0)";
        mysql_query($sql_buy);
    }




 ?>

<h1>Checkout</h1>
<h2>This is your last chance to change your mind!</h2>
<a href="index.php?page=cart">Go back to cart?</a>

<form method="post" action="index.php?page=cart" >
	
	<table>
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
				<td><?php echo $row['quantity']; ?></td>
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
	<a href="index.php?page=cart&action=purchase">Confirm Purchase</a>

</form>