<?php 
	require("includes/connection.php");
	
	if(isset($_POST['update-prof'])) {
		$id=$_POST['user_id'];
		$fn=$_POST['firstname'];
		$ln=$_POST['lastname'];
		$email=$_POST['email'];

		$sql="UPDATE Users SET firstname='".$fn."' WHERE id=$id";
		mysql_query($sql);
		$sql1="UPDATE Users SET lastname='".$ln."' WHERE id=$id";
		mysql_query($sql1);
		$sql2="UPDATE Users SET email='".$email."' WHERE id=$id";
		mysql_query($sql2);
		$success=1;
		$message="Your profile has been updated!";


	}

	if(isset($_POST['change-pass'])) {

		$id=$_POST['id'];
		$old=$_POST['o-pass'];
		$new=$_POST['n-pass'];
		$conf=$_POST['con-pass'];
		echo $old;
		echo $new;
		echo $conf;
		$sql="SELECT * FROM Users WHERE id=$id";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		$success=1;
		if ($row['password']==$old) {
			if ($new==$conf) {
				mysql_query("UPDATE Users SET password='".$new."' WHERE id=$id");
				$message="Your password has been changed!";
			}else {
				$message="The new password didn't match the confirmation password!";
				$success=0;
			}
		}else {
			$message="Your old password is incorrect";
			$success=0;
		}


	}


	$url="index.php?page=profile&message=".$message."&success=".$success;
    header('Location: '.$url);


 ?>