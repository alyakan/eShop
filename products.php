<?php

    if(isset($_GET['action']) && $_GET['action']=="add"){
        $id=intval($_GET['id']);

        $sql_cond="SELECT * FROM Cart WHERE username='aly' and p_id=$id and bought=0";
        $query_cond=mysql_query($sql_cond);

        if(mysql_num_rows($query_cond)!=0) {

            $row_cond=mysql_fetch_array($query_cond);
            $quantity=$row_cond['quantity']+1;
            $sql_update="UPDATE Cart SET quantity=$quantity WHERE username='aly' and p_id=$id";
            mysql_query($sql_update);

        }else {

            $sql1="INSERT INTO Cart (p_id, quantity, username) VALUES
                ($id, 1, 'aly')";
            mysql_query($sql1);

        }
    }

?>



<h1>Product List</h1>

<?php

    if(isset($message)){
        echo "<h2>$message</h2>";
    }

?>

<table>
    <tr>
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
            <td><?php echo $row['Name'] ?></td>
            <td><?php echo $row['Price'] ?>$</td>
            <td><?php echo $row['Quantity'] ?></td>
            <td><a href="index.php?page=products&action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></td>
        </tr>
    <?php
        }

    ?>
</table>