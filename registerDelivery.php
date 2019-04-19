<?php include 'templates/header.php'; ?>

<h2>Register Delivery</h2>
<?php
    include 'user_loggedin.php';
    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
      $connection = OpenCon();
      if ($connection->connect_error) {
        die("Fatal Error 1"); 
      }

      $id = $_GET["id"];

      $query ="SELECT * FROM orders WHERE id=".$id.";";
      $result = $connection->query($query);

      if (!$result) {
        die("Fatal Error 2");
      }

      $row = $result->fetch_assoc();

      CloseCon($connection);          
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST"){

      $connection = OpenCon();
      if ($connection->connect_error) {
        die("Fatal Error 1"); 
      }

      $delivered_date = test_input($_POST["delivered_date"]);
      
      $id = $_POST["id"];

      $stmt=$connection->prepare("UPDATE orders SET delivered_date=? WHERE id=?;");
      $stmt->bind_param("si", $delivered_date, $id);
      $stmt->execute();


      if (!$stmt) {
        die("Fatal Error 2");
      }

      // $qty = $_POST["qty_ordered"];
       // $order_id = $_POST["id"];

      $stmt2=$connection->prepare("UPDATE
                                    products as p
                                    inner join orders as o
                                    on o.product_id = p.id
                                    set p.quantity = p.quantity + o.qty_ordered
                                    where
                                      o.id = ?;");

      $stmt2->bind_param("i", $id);
      $stmt2->execute();


      if (!$stmt2) {
        die("Fatal Error 3");
      }


      CloseCon($connection);

      header("Location: listOrders.php");
      exit;
    }

?>  

<form method = "post" action = "registerDelivery.php">
  <input type="hidden" name="id" value="<?php echo $row['id']?>">

  <label class="item">Order id: <?php echo $row['id']?></label><br>  
  <label class="item">Product id: <?php echo $row['product_id']?></label><br>
  <label class="item">Quantity Ordered: <?php echo $row['qty_ordered']?></label><br>
 

    <div class="form-row">
      <div class="form-group col-md-6">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6 item">
               <label for="start_date" class="title-tag">Delivered date:</label>
            </div>
            <div class="col-sm-6">
              <input type="date" class="form-control" id="delivered_date" name="delivered_date" required />
            </div>
          </div>
        </div>
      </div> 
    </div>

    <div class="form-row">
        <div class="form-group">
            <input type="submit" value="Register Delivery" class="btn btn-primary item" />
        </div>
    </div>
</form>


<?php include 'templates/footer.php'; ?>
