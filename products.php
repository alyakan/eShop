<?php
    if(isset($_GET['action']) && $_GET['action']=="add"){ 
        if(!isset($_SESSION['user_id'])) {
            $url="index.php?page=login&message=Please login before you can make a purchase";
            header('Location: '.$url);
        }
    }
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['action']) && $_GET['action']=="add"){
            $id=intval($_GET['id']);
            $sql_cond="SELECT * FROM Cart WHERE user_id= $user_id and p_id=$id and bought=0";
            $query_cond=mysql_query($sql_cond);
            if(mysql_num_rows($query_cond)!=0) {
                $row_cond=mysql_fetch_array($query_cond);
                $quantity=$row_cond['quantity']+1;
                $sql_update="UPDATE Cart SET quantity=$quantity WHERE user_id='$user_id' and p_id=$id";
                mysql_query($sql_update);

            }
            else {

                $sql1="INSERT INTO Cart (p_id, quantity, user_id) VALUES
                    ($id, 1,'$user_id')";
                mysql_query($sql1);

            }
    }
    
}

?>
<div class="page-header">
    <h1><i class="fa fa-list fa-fw"></i> Product List</h1>
</div>


<?php

    if(isset($message)){
        echo "<div class='alert alert-info' role='alert'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$message."</div>";
    }

?>
<table class="table table-hover table-responsive">
    <tr>
        <th>Picture</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>

    <?php

        $sql="SELECT * FROM Products ORDER BY Name ASC";
        $query=mysql_query($sql);

        while ($row=mysql_fetch_array($query)) {

    ?>
    <tr>
        <td><img src="cinqueterre.jpg" class="img-rounded" alt="Cinque Terre" width="50" height="50"></td>
        <td><?php echo $row['Name'] ?></td>
        <td><?php echo $row['Price'] ?> <i class="fa fa-usd fa-fw"></i></td>
        <td>
            <?php
                if ($row['Quantity']==0) {
                    echo "Out of stock";
                }else {
                    echo $row['Quantity']; 
                }
                
            ?>
        </td>
        <td>
            <div class="btn-group">
                <?php if ($row['Quantity']==0){ ?>
                    <a href="index.php?page=checkout&action=buy&id=<?php echo $row['id_product'] ?>" class="btn btn-primary btn-sm disabled" data-toggle="tooltip" title="Proceed to checkout with this item!">Buy this item</a>
                    <a href="index.php?page=products&action=add&id=<?php echo $row['id_product'] ?>" class="btn btn-primary btn-sm disabled"><i class="fa fa-cart-plus fa-fw"></i> Add to cart</a>
                <?php }else { ?>
                    <a href="index.php?page=checkout&action=buy&id=<?php echo $row['id_product'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Proceed to checkout with this item!">Buy this item</a>
                    <a href="index.php?page=products&action=add&id=<?php echo $row['id_product'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus fa-fw"></i> Add to cart</a>
                <?php } ?>
            </div>
        </td>
    </tr>
    <?php
        }

    ?>
</table>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>




