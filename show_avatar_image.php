<?php
 $AvatarId = $_SESSION['AvatarId'];
 $sql_cond="SELECT * FROM Images WHERE id= $AvatarId;";
 $query_cond=mysql_query($sql_cond);
 	if($query_cond!=null){
 		if(mysql_num_rows($query_cond)!=0) {
			$row = mysql_fetch_assoc($query_cond);
			$contents = $row['ImageData'];
			$base64 = base64_encode($contents);
			?>
			<img src="data:image/png;base64,<?php echo $base64; ?>" class="img-rounded" width="50" height="50">
			<?php
		}
 	}
	

?>


