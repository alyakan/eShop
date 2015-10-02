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
          
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!--         <link rel="stylesheet" href="css/reset.css" /> 
        <link rel="stylesheet" href="css/style.css" />  -->
          
        <title>Shopping cart</title> 
      
    </head> 
      
    <body> 
        <div class="container">
            <div class="jumbotron">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">WebSiteName</a>
                        </div>
                        <div>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">History</a></li>
                                <li><a href="#">Cart</a></li> 
                                <li><a href="#">Profile</a></li> 
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            
                <h1>eShop</h1>
                <p>Where you dreams come true.</p>
            </div><!-- end jumbotron --> 
      
            <div class="main col-md-8"> 

                <?php require($_page.".php"); ?>
                  
            </div><!--end main-->
              
            <div id="sidebar" class="col-md-4" id="cart"> 
                <div class="page-header">
                    <h1>Cart</h1>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                            $sql="SELECT * FROM Cart 
                                    INNER JOIN Products ON Cart.p_id=Products.id_product 
                                    WHERE username='aly' and bought=0";
                            $query=mysql_query($sql);

                            if (mysql_num_rows($query)!=0) {
                                ?>
                                <ul class="list-group">
                                <?php
                                while ($row=mysql_fetch_array($query)) {


                                ?>
                                
                                    <li class="list-group-item"><?php echo $row['Name'] ?> <i class="fa fa-times fa-fw"></i><?php echo $row['quantity'] ?></li>
                                <?php
                                }
                                ?>
                                </ul>
                                <hr />
                                <a href="index.php?page=cart" class="btn btn-info btn-block"><i class="fa fa-shopping-cart fa-fw"></i> Go to cart</a>
                                <?php
                            }else {
                                echo "<h2>Your Cart is empty!</h2>";
                            }
                            if ($_page!='history') {
                            ?>

                            <a href="index.php?page=history" class="btn btn-info btn-block"><i class="fa fa-history fa-fw"></i> View your purchase history</a>
                            <?php
                            }

                        ?>
                    </div>
                </div>
                
            </div><!--end sidebar-->
      
        </div><!--end container-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      
    </body> 
</html>