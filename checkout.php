<?php 
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
	if(isset($_GET['action']) && $_GET['action']=="buy"){
        $id=intval($_GET['id']);

        $sql_buy="INSERT INTO Cart (p_id, quantity, user_id, bought)
            VALUES ($id, 1, '$user_id', 0)";
        mysql_query($sql_buy);
    }

}


 ?>
<div class="page-header">
    <h1><i class="fa fa-money fa-fw"></i> Checkout</h1>
</div>

<form method="post" action="index.php?page=cart" role="form">
	
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
					WHERE user_id=$user_id and bought=0";
		$query= mysql_query($sql);
		$total=0;
		while($row=mysql_fetch_array($query)) {
			$subtotal=$row['quantity']*$row['Price'];
			$total+=$subtotal;
		
			?>

			<tr>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['quantity']; ?></td>
				<td><?php echo $row['Price'] ?><i class="fa fa-usd fa-fw"></i></td>
				<td><?php echo $subtotal; ?><i class="fa fa-usd fa-fw"></i></td>
				<td><?php echo $row['Quantity']; ?></td>
			</tr>

			<?php
		}

	}

	?>
	</table>
	<div class="alert alert-danger">
  		<strong>Careful!</strong> This is your last chance to change your mind.
	</div>
	<div class="well">
		Total amount = <strong><?php echo $total; ?></strong><i class="fa fa-usd fa-fw"></i><br><br>
		<div class="btn-group btn-group-justified">
			<a href="index.php?page=cart" class="btn btn-primary"><i class="fa fa-shopping-cart fa-fw"></i> Go back to cart?</a>
			<a href="index.php?page=cart&action=purchase" class="btn btn-success"><i class="fa fa-money fa-fw"></i> Confirm Purchase</a>
		</div>
	</div>
	

</form>