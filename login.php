<?php include 'templates/header.php'; ?>

<?php 
    include 'db_connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

    	$username = test_input($_POST["username"]);
      $password = test_input($_POST["password"]);

      $connection = OpenCon();
      if ($connection->connect_error) {
        die("Fatal Error 1"); 
      }

      $query = "SELECT * FROM users WHERE username='".$username."' AND password =password('".$password."');";
      $result = $connection->query($query);

      //echo $query;

      if (!$result) {
        die("Fatal Error 2");
      }

      $row = $result->fetch_assoc();

      CloseCon($connection);

      if ($row['username'] == $username){
      	$_SESSION['username'] = $username;
				header("Location: index.php");
      	exit;
      }
      else {
      	$errorMessage = "Login failed";
      }      
    }
?>  

<?php echo $errorMessage ?>

<form method = "post" action = "login.php">
    <div class="form-row">
      <div class="form-group col-md-3">
        <div class="form-group">
          <label for="start_date">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required >
        </div>
        <div class="form-group">
          <label for="start_date">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required >
        </div>  
      </div> 
    </div>
    <div class="form-row">
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
     $("#nav-left").hide(); 
  });

</script>


<?php include 'templates/footer.php'; ?>