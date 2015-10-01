<?php
    session_start();
    require("includes/connection.php");
    if(isset($_GET['page'])){
        $pages = array("products", "cart", "checkout");

        if(in_array($_GET['page'], $pages)){
            $_page=$_GET['page'];
        }else {
            $_page="products";
        }

    }else {
        $_page="products";
    }

if(!isset($_SESSION['user_id']))
{
    $message = 'you are not logged in';
}
else
{
    try
    {
        /*** connect to database ***/
        /*** mysql hostname ***/
        $mysql_hostname = 'localhost';

        /*** mysql username ***/
        $mysql_username = 'tutorial';

        /*** mysql password ***/
        $mysql_password = 'supersecretpassword';

        /*** database name ***/
        $mysql_dbname = 'tutorials';


        /*** select the users name from the database ***/
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT username FROM users 
        WHERE user_id = :user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $username = $stmt->fetchColumn();

        /*** if we have no something is wrong ***/
        if($username == false)
        {
            $message = 'Access Error';
        }
        else
        {
            $message = 'you are logged in as '.$username;
        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
  
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
          
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <link rel="stylesheet" href="css/reset.css" /> 
        <link rel="stylesheet" href="css/style.css" /> 
          
        <title>Shopping cart</title> 
      
    </head> 
      
    <body> 
          
        <div id="container"> 
      
            <div id="main"> 

                <?php require($_page.".php"); ?>
                  
            </div><!--end main-->
              
            <div id="sidebar"> 
                <h1>Cart</h1>
                <?php
                    $sql="SELECT * FROM Cart 
                            INNER JOIN Products ON Cart.p_id=Products.id_product 
                            WHERE username='aly' and bought=0";
                    $query=mysql_query($sql);

                    if (mysql_num_rows($query)!=0) {
                        while ($row=mysql_fetch_array($query)) {


                        ?>
                        <p><?php echo $row['Name'] ?> x<?php echo $row['quantity'] ?></p>
                        <?php
                        }
                        ?>
                         <hr />
                         <a href="index.php?page=cart">Go to cart</a>
                         <?php
                    }else {
                        echo "<h2>Your Cart is empty!</h2>";
                    }


                ?>
            </div><!--end sidebar-->
      
        </div><!--end container-->
    <?php if( isset( $_SESSION['user_id'] ) ): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
         <a href="adduser.php">register here</a> <p>OR</p><a href="login.php">login</a>
    <?php endif; ?>
    </body> 
</html>