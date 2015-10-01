<?php
    session_start();
    require("includes/connection.php");
    if(isset($_GET['page'])){
        $pages = array("products", "cart", "checkout", "history");

        if(in_array($_GET['page'], $pages)){
            $_page=$_GET['page'];
        }else {
            $_page="products";
        }

    }else {
        $_page="products";
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
                         <a href="index.php?page=cart">Go to cart</a><br>
                         <?php
                    }else {
                        echo "<h2>Your Cart is empty!</h2>";
                    }
                    if ($_page!='history') {
                    ?>

                    <a href="index.php?page=history">View your purchase history</a>
                    <?php
                    }

                ?>
            </div><!--end sidebar-->
      
        </div><!--end container-->
      
    </body> 
</html>