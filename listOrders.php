<?php include 'templates/header.php'; ?>

<?php 
    include 'db_connection.php';
    $connection = OpenCon();


    if ($connection->connect_error) die("Fatal Error 1");

    $query ="SELECT * FROM orders;";
    $result = $connection->query($query);

    if (!$result) die("Fatal Error 2");

    $rows_count = $result->num_rows;
?>  

<h2 align="center">List of Orders</h2>

<table align="center" class="table">
    <tr>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Quantity Ordered</th>
        <th>Purchase Date</th>
        <th>Cost</th>     
        <th>Expiration Date</th>       
        <th>Supplier</th>
        <th>Delivered Date</th>
    </tr>

    <?php 
        for ($j = 0; $j < $rows_count; ++$j) 
        {
            $row = $result->fetch_assoc()
    ?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo $row['product_id']; ?>
                </td>
                <td>
                    <?php echo $row['qty_ordered']; ?>
                </td>
                <td>
                    <?php echo $row['purchase_date']; ?>
                </td>
                <td>
                    <?php echo $row['total_cost']; ?>
                </td>
                <td>
                    <?php echo $row['exp_date']; ?>
                </td>
                <td>
                    <?php echo $row['supplier']; ?>
                </td>
                <td>
                    <?php if ($row['delivered_date'] == NULL) { ?>
                        <a href="registerDelivery.php?id=<?php echo $row['id'] ?>">Register delivery </a>
                    <?php } else { ?>
                        <?php echo $row['delivered_date']; ?>
                    <?php } ?>                                       
                </td>
            </tr>
    <?php 
        }
    ?>
</table>


<?php 
    $result->close();
    
    CloseCon($connection);
?>  

<?php include 'templates/footer.php'; ?>
