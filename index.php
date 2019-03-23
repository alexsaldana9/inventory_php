<?php include 'templates/top.php'; ?>

<?php 
    include 'db_connection.php';
    $connection = OpenCon();


    if ($connection->connect_error) die("Fatal Error 1");

    $query ="SELECT * FROM products;";
    $result = $connection->query($query);

    if (!$result) die("Fatal Error 2");

    $rows_count = $result->num_rows;
?>  

<h2 align="center">List of Product Orders</h2>

<table align="center" class="table">
    <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Storage Location</th>
        <th>Quantity Ordered</th>
        <th>Re-order Level</th>
        <th>Purchase Date</th>
        <th>Total Cost</th>
        <th>Dosage Form</th>
        <th>Exp Date</th>
        <th>Supplier</th>
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
                    <?php echo $row['name']; ?>
                </td>
                <td>
                    <?php echo $row['category']; ?>
                </td>
                <td>
                    <?php echo $row['storage']; ?>
                </td>
                <td>
                    <?php echo $row['qty_ordered']; ?>
                </td>
                <td>
                    <?php echo $row['reorder_level']; ?>
                </td>
                <td>
                    <?php echo $row['purchase_date']; ?>
                </td>
                <td>
                    <?php echo $row['cost']; ?>
                </td>
                <td>
                    <?php echo $row['form']; ?>
                </td>
                <td>
                    <?php echo $row['exp_date']; ?>
                </td>
                <td>
                    <?php echo $row['supplier']; ?>
                </td>
            </tr>
    <?php 
        }
    ?>
</table>

<a href="addProduct.php"><button>Add Product Order</button></a><br>

<?php 
    $result->close();
    
    CloseCon($connection);
?>  

<?php include 'templates/bottom.php'; ?>
