<?php include 'templates/header.php'; ?>

<h2>Add New Order</h2>
<?php 
    include 'db_connection.php';


    if ($_SERVER["REQUEST_METHOD"] == "GET"){
      $connection = OpenCon();
      if ($connection->connect_error) {
        die("Fatal Error 1"); 
      }

      $query_get ="SELECT id, name FROM products;";
      $result_get = $connection->query($query_get);

      if (!$result_get) {
        die("Fatal Error 2");
      }

      CloseCon($connection);          
    }


    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $connection = OpenCon();

      if ($connection->connect_error) {
        die("Fatal Error 3"); 
      }
    
      $query ="SELECT id, name FROM products;";
      $result = $connection->query($query);

      if (!$result) die("Fatal Error 4");

      $rows_count = $result->num_rows;

      $product_id = test_input($_POST["product_id"]);
      $qty_ordered = test_input($_POST["qty_ordered"]);
      $purchase_date = test_input($_POST["purchase_date"]);
      $total_cost = test_input($_POST["total_cost"]);
      $exp_date = test_input($_POST["exp_date"]);
      $supplier = test_input($_POST["supplier"]);
      $delivered_date = null;

      $stmt=$connection->prepare("INSERT INTO orders (product_id, qty_ordered, purchase_date, total_cost, exp_date, supplier, delivered_date) VALUES (?,?,?,?,?,?,?)");
      $stmt->bind_param("iisisss", $product_id, $qty_ordered, $purchase_date, $total_cost, $exp_date, $supplier,$delivered_date);

      if (!$stmt->execute()) {
        die ("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }

      CloseCon($connection);

      header("Location: listOrders.php");
      exit;
    }


    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>  

<form method = "post" action = "addOrder.php">
    <div class="form-row">
      <div class="form-group col-md-3">
        <div class="form-group">

          <select name='products'>
            <?php
            //To add dropdown menu -- https://www.youtube.com/watch?v=TNPxG2yrPlM
            while ($rows = $result_get->fetch_assoc())
            {
              $product_id = $rows['id'];
              $product_name = $rows['name'];

              echo "<option value='$product_id'> $product_id - $product_name</option>";
            }
            ?>
          </select>

          <label for="start_date">Product Id </label>
          <input type="number" class="form-control" id="product_id" name="product_id" required >
        </div>
        <div class="form-group">
          <label for="start_date">Quantity Ordered </label>
          <input type="number" class="form-control" id="qty_ordered" name="qty_ordered" required>
        </div>
        <div class="form-group">
          <label for="start_date">Purchase Date </label>
          <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
        </div>
        <div class="form-group">
          <label for="start_date">Cost </label>
          <input type="number" class="form-control" id="total_cost" name="total_cost" required>
        </div>
        <div class="form-group">
          <label for="start_date">Expiration Date </label>
          <input type="date" class="form-control" id="exp_date" name="exp_date" required>
        </div>
        <div class="form-group">
          <label for="start_date">Supplier </label>
          <input type="text" class="form-control" id="supplier" name="supplier" required>
        </div>
      </div> 
    </div>
    <div class="form-row">
        <div class="form-group">
            <input type="submit" value="add" class="btn btn-primary">
        </div>
    </div>
</form>

<?php include 'templates/footer.php'; ?>
