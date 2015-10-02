<?php

/*** begin our session ***/
session_start();

require("includes/connection.php");

/*** check if the users is already logged in ***/
if(isset( $_SESSION['user_id'] ))
{
    $message = 'Users is already logged in';
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM Users 
                WHERE firstname = '$username' AND password = '$password';";
    $query_cond=mysql_query($sql);
    if($query_cond === FALSE) { 
    die(mysql_error()); // TODO: better error handling
    }
    if(mysql_num_rows($query_cond)!=0) {
        $row_cond=mysql_fetch_assoc($query_cond);
        $user_id =$row_cond['id'];
        $_SESSION['user_id'] = $user_id;
        $url = "http://localhost/eShop/index.php";
        header('Location: '.$url);   
        
    }

    else{
        $message = "invalid login details";
    }

}
?>

<html>
    <head>
    <title>Login</title>
    </head>
    <body>
    <?php require("login.php") ?>
    <p><?php echo $message; ?>
    </body>
</html>






