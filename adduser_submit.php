<?php
/*** begin our session ***/

/*require("includes/connection.php");
*/
session_start();

require("includes/connection.php");


/*** first check that both the username, password and form token have been sent ***/
if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);

}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
        $url="index.php?page=adduser&message=$message";
        header('Location: '.$url);
}
elseif (!($_POST['password'] == $_POST['conpass']))
{
    $message = "Passwords dont match";
    $url="index.php?page=adduser&message=$message";
    header('Location: '.$url);

}
else
{   
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING); 
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);   
    $sql = "INSERT INTO `eShop`.`Users` (`id`, `username`,`firstname`, `lastname`, `password`, `email`) VALUES
        (NULL, '$username','$firstname','$lastname','$password', '$email');";
    mysql_query($sql);   
    $sql_cond="SELECT * FROM Users order by id desc limit 1";
    $query_cond=mysql_query($sql_cond);
    if(mysql_num_rows($query_cond)!=0) {
        $row_cond=mysql_fetch_assoc($query_cond);
        $_SESSION['user_id'] = $row_cond['id'];
        $_SESSION['username'] =  $row_cond['firstname'];;
        $url = "http://localhost/eShop/index.php";
        header('Location: '.$url);
    }

    else{
        $message = "invalid  details";
        $url="index.php?page=adduser&message=$message";
        header('Location: '.$url);
    }
}
   
?>






<html>
    <head>
    <title>Register</title>
    </head>
    <body>
    <p><?php echo $message; ?>
    </body>
</html>
