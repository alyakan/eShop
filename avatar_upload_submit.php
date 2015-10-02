<?php
require("includes/connection.php");
$_SESSION['user_id'] = 1 ; 
if(isset($_POST['submit']))
{
  /* Variable inits */
  $imageName = $imageData = $imageType = null;
  $imageName = mysql_real_escape_string($_FILES["file_upload"]["name"]);
  $imageData = mysql_real_escape_string(file_get_contents($_FILES["file_upload"]["tmp_name"]));
$imageType = mysql_real_escape_string($_FILES["file_upload"]["type"]);
  $imageExtension = explode('.', $imageName)[1]; 
  if(substr($imageType,0,5) == "image"){
    /* upload image to DB */
    $sql = "INSERT INTO `eShop`.`Images` (`ImageName`, `ImageData`, `ImageType`, `ImageExtension`, `id`) VALUES ('$imageName', '$imageData', '$imageType' , '$imageExtension' , NULL)";
    mysql_query($sql);
    if(isset($_SESSION['user_id'] ))
      {   
      $user_id = $_SESSION['user_id'];
      $sql_cond="SELECT * FROM `eShop`.`Images`  order by id desc limit 1";
      $query_cond=mysql_query($sql_cond);
      if(mysql_num_rows($query_cond)!=0) {
          $row_cond=mysql_fetch_assoc($query_cond);
          $avatar_id=$row_cond['id'];
          $sql_update="UPDATE `eShop`.`Users`SET AvatarId=$avatar_id WHERE id=$user_id ";
          mysql_query($sql_update);
          echo "Your Avatar has changed ";

        }
    }
 }
  else{
    echo "Avatar Has to be an image!";
  }
}
?>



