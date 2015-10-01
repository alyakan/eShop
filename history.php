<h1>History</h1>
<br>
<a href="index.php?page=products">Back to products</a>
<br>
<?php 


	$sql="SELECT * FROM Cart 
            INNER JOIN Products ON Cart.p_id=Products.id_product 
            WHERE username='aly' and bought=0";
    $query=mysql_query($sql);
    ?>

	<table>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Item Price</th>
			<th>Subtotal</th>
		</tr>


	<?php

		$sql="SELECT * FROM Cart 
					INNER JOIN Products ON Cart.p_id=Products.id_product 
					WHERE username='aly' and bought=1";
		$query= mysql_query($sql);
		$total=0;
		while($row=mysql_fetch_array($query)) {
			$subtotal=$row['quantity']*$row['Price'];
		
			?>

			<tr>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['quantity']; ?></td>
				<td><?php echo $row['Price'] ?>$</td>
				<td><?php echo $subtotal; ?>$</td>
			</tr>

			<?php

		}

	?>
	</table>
<?php

 ?>