<?php include 'templates/header.php'; ?>

<h2>Register Disposal </h2>

<?php
    include 'user_loggedin.php'; 
    include 'db_connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
      $connection = OpenCon();
      if ($connection->connect_error) {
        die("Fatal Error 1 get"); 
      }

      $id = $_GET["id"];

      $query ="SELECT * FROM products WHERE id=".$id.";";
      $result = $connection->query($query);

      if (!$result) {
        die("Fatal Error 2 get");
      }

      $row = $result->fetch_assoc();

      CloseCon($connection);          
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $connection = OpenCon();

      if ($connection->connect_error) {
        die("Fatal Error 1 post"); 
      }

      $id = $_POST["id"];

      $quantity = $_POST["quantity_dipose"];

      $stmt2=$connection->prepare("UPDATE products SET quantity =(quantity - ?) WHERE id=?;");
      $stmt2->bind_param("ii", $quantity, $id);
      $stmt2->execute();


      if (!$stmt2) {
        die("Fatal Error 3 post");
      }


      CloseCon($connection);

      header("Location: index.php");
      exit;
    }
?>  

<form method = "post" action = "remove.php">
	 <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <div class="form-row">
      <div class="form-group col-md-6">

          <label  class="item" for="start_date">Product Name : <?php echo $row['name']?></label>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label class="item" for="start_date">Quantity </label>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="quantity_dipose" name="quantity_dipose" required >
              </div>
            </div>
          </div>

      </div> 
    </div>
    <div class="form-row">
        <div class="form-group">
            <input type="submit" value="Dispose" class="btn btn-primary item">
        </div>
    </div>
</form>

<?php include 'templates/footer.php'; ?>
