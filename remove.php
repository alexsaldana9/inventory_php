<?php include 'templates/header.php'; ?>

<h2>Register Disposal: </h2>
<p>Deduct from Inventory</p>
<?php 
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

      $stmt=$connection->prepare("DELETE FROM products Where id=?;");
      $stmt->bind_param("i", $id);
      $stmt->execute();


      if (!$stmt) {
        die("Fatal Error 2 post");
      }

      CloseCon($connection);

      header("Location: index.php");
      exit;
    }
?>  

<form method = "post" action = "remove.php">
	 <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <div class="form-row">
      <div class="form-group col-md-3">
        <div class="form-group">
          <label for="start_date">Product Name : <?php echo $row['name']?></label>
          <input type="text" class="form-control" id="name" name="name" required >
        </div>
        <div class="form-group">
          <label for="start_date">Quantity </label>
          <input type="text" class="form-control" id="category" name="category" required >
        </div>  
      </div> 
    </div>
    <div class="form-row">
        <div class="form-group">
            <input type="submit" value="Delete" class="btn btn-primary">
        </div>
    </div>
</form>

<?php include 'templates/footer.php'; ?>
