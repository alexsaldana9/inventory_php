<?php include 'templates/header.php'; ?>

<?php 
    include 'user_loggedin.php';
    include 'db_connection.php';
    $connection = OpenCon();


    if ($connection->connect_error) die("Fatal Error 1");

    $query ="SELECT * FROM products;";
    $result = $connection->query($query);

    if (!$result) die("Fatal Error 2");

    $rows_count = $result->num_rows;
?>  

<h2 align="center">Inventory</h2>

<table align="center" class="table">
    <tr>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Storage Location</th>     
        <th>Re-order Level</th>       
        <th>Dosage Form</th>
        <th>Quantity on Hand</th>
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
                    <?php echo $row['reorder_level']; ?>
                </td>
                <td>
                    <?php echo $row['form']; ?>
                </td>
                <td>
                    <?php echo $row['quantity']; ?>
                </td>
            </tr>

            <?php
                if ($row['quantity'] < $row['reorder_level'])
                {
            ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger" role="alert">
                        <?php
                            echo "Need to Order: " . $row['id'] . " - ". $row['name'] . " - to refill inventory";
                        ?>
                        </div>
                    </td>
                </tr>
            <?php
                }
            ?>
    <?php 
        }
    ?>
</table>



<?php 
    $result->close();
    
    CloseCon($connection);
?>  

<?php include 'templates/footer.php'; ?>
