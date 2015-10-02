<div class="page-header">
    <h1><i class="fa fa-history fa-fw"></i> History</h1>
</div>
<?php 


	$sql="SELECT * FROM Cart 
            INNER JOIN Products ON Cart.p_id=Products.id_product 
            WHERE user_id=1' and bought=0";
    $query=mysql_query($sql);
    ?>

	<table class="table table-hover table-responsive">
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Item Price</th>
			<th>Subtotal</th>
		</tr>


	<?php

		$sql="SELECT * FROM Cart 
					INNER JOIN Products ON Cart.p_id=Products.id_product 
					WHERE user_id=1 and bought=1";
		$query= mysql_query($sql);
		$total=0;
		while($row=mysql_fetch_array($query)) {
			$subtotal=$row['quantity']*$row['Price'];
		
			?>

			<tr>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['quantity']; ?></td>
				<td><?php echo $row['Price'] ?><i class="fa fa-usd fa-fw"></i></td>
				<td><?php echo $subtotal; ?><i class="fa fa-usd fa-fw"></i></td>
			</tr>

			<?php

		}

	?>
	</table>
	<div class="well" >
		<a href="index.php?page=products" class="btn btn-primary btn-block"><i class="fa fa-home fa-fw"></i> Back to products</a>
	</div>

