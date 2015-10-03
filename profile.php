<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
require("includes/connection.php");
if(isset($_SESSION['user_id'] ))

{   
	$user_id = $_SESSION['user_id'];
    $sql_cond="SELECT * FROM Users WHERE user_id=1";
    $query_cond=mysql_query($sql_cond);

    if(mysql_num_rows($query_cond)!=0) {
        $row_cond=mysql_fetch_array($query_cond);
        $user_first_name=$row_cond['firstname'];
        $_SESSION['AvatarId'] = $row_cond['AvatarId'];
        ?>

        <div class="page-header">
            <h1><?php require("show_avatar_image.php"); ?> <?php echo $user_first_name ?></h1>
        </div>

        <?php 
            if(isset($_GET['success'])) {
                if($_GET['success']=='1') {
                    ?>
                        <div class='alert alert-success' role='alert'> 
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <?php echo $_GET['message']; ?>
                        </div>
                    <?php
                }else {
                    ?>
                        <div class='alert alert-danger' role='alert'> 
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <?php echo $_GET['message']; ?>
                        </div>
                    <?php
                }
            }
         ?>

        <form action="update_profile.php" method="post" class="form" role="form">

            <div class="form-group">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value=<?php echo $row_cond['user_id'] ?>><br>
                <fieldset disabled>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value=<?php echo $row_cond['username'] ?>><br>
                </fieldset>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value=<?php echo $row_cond['email'] ?>><br>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value=<?php echo $row_cond['firstname'] ?>><br>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value=<?php echo $row_cond['lastname'] ?>><br>
                <input type="submit" class="form-control btn btn-success" value="Update info" name="update-prof"/>
            </div>

        </form><br>

        <button data-toggle="collapse" data-target="#upload-avatar" class="btn btn-info btn-block col-xs-8">Upload/Change your Avatar</button><br>
        <div class="collapse" id="upload-avatar">
            <form action="avatar_upload_submit.php" method="post" enctype="multipart/form-data" class="form" role="form">
                <div class="form-group">
                    <input type="file" name="file_upload" /><br>
                    <input type="submit" name="submit" value="upload avatar" class="btn btn-success"/>
                </div>  
            </form>
        </div>
        <br>
        <button data-toggle="collapse" data-target="#change-pass" class="btn btn-warning btn-block col-xs-8">Change your password</button><br><br>
        <div class="collapse" id="change-pass">
            <form action="update_profile.php" method="post" enctype="multipart/form-data" class="form" role="form">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value=<?php echo $row_cond['user_id'] ?>><br>
                    <input type="password" class="form-control" id="o-pass" name="o-pass" placeholder="Old Password"><br>
                    <input type="password" class="form-control" id="n-pass" name="n-pass" placeholder="New Password"><br>
                    <input type="password" class="form-control" id="con-pass" name="con-pass" placeholder="Password Confirmation"><br>
                    <input type="submit" name="change-pass" value="Change Password" class="btn btn-danger btn-block"/>
                </div>  
            </form>

        </div>
        <?php
        
    }

    
}

else{
    ?>
<div class='alert alert-info' role='alert'>
    <h4><strong>Please <a href="index.php?page=login" style="color: green;">login</a> to continue.</strong></h4>
</div>
<?php
}

?>

