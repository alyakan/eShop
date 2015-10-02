<?php
require("includes/connection.php");
$_SESSION['user_id'] = 1 ;

if(isset($_SESSION['user_id'] ))

{   
	$user_id = $_SESSION['user_id'];
    $sql_cond="SELECT * FROM Users WHERE id=1";
    $query_cond=mysql_query($sql_cond);

    if(mysql_num_rows($query_cond)!=0) {
        $row_cond=mysql_fetch_array($query_cond);
        $user_first_name=$row_cond['firstname'];
        $_SESSION['AvatarId'] = $row_cond['AvatarId'];
        echo "<br> logged in as $user_first_name <br> <br>";
        require("show_avatar_image.php");
    }

    require("avatar_upload.php");
}

else{
echo "<h4> please logged in to proceed </h4> ";
}

?>

