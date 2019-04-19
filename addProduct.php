<?php include 'templates/header.php'; ?>

<h2>Register Product</h2>
<?php
    include 'user_loggedin.php';
    include 'db_connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $connection = OpenCon();

      if ($connection->connect_error) {
        die("Fatal Error 1"); 
      }

      $name = test_input($_POST["name"]);
      $category = test_input($_POST["category"]);
      $storage = test_input($_POST["storage"]);
      $reorder_level = test_input($_POST["reorder_level"]);
      $form = test_input($_POST["form"]);
      $quantity = 0;
     
      error_log('PARAMETERS: name: '.$name.'; category: '.$category.'; storage: '.$storage.'; reorder_level: '.$reorder_level.'; form: '.$form);

      $stmt=$connection->prepare("INSERT INTO products (name, category, storage, reorder_level, form, quantity) VALUES (?,?,?,?,?,?)");
      $stmt->bind_param("sssisi", $name, $category, $storage, $reorder_level, $form, $quantity);
      
      if (!$stmt->execute()) {
        die ("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
      }

      CloseCon($connection);

      header("Location: index.php");
      exit;
    }

?>  

<form method = "post" action = "addProduct.php">
    <div class="form-row">
      <div class="form-group col-md-3">
        <div class="form-group">
          <label for="start_date">Product Name</label>
          <input type="text" class="form-control" id="name" name="name" required >
        </div>
        <div class="form-group">
          <label for="start_date">Category </label>
          <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
          <label for="start_date">Storage Location </label>
          <input type="text" class="form-control" id="storage" name="storage" required>
        </div>
        <div class="form-group">
          <label for="start_date">Re-order Level </label>
          <input type="number" class="form-control" id="reorder_level" name="reorder_level" required>
        </div>
        <div class="form-group">
          <label for="start_date">Dosage Form </label>
          <input type="text" class="form-control" id="form" name="form" required>
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
