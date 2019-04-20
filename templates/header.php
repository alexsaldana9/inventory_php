<?php
    session_start();
?>

<?php
function test_input($data) {
  $data = $data ? $data : "";
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  if (!$data){
    die("Missing required parameter");
  }

  return $data;
}
?>


<!DOCTYPE html>
<!-- 
Pharmacy Inventory Manager
Final Project
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pharmacy Inventory Manager</title>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <script
      src="https://code.jquery.com/jquery-3.4.0.min.js"
      integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
      crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css" />

    </head>
    <body>
        <h1 class="title" align="center">Pharmacy Inventory Manager</h1>

        <div class="container">
            <div class="row">
                <div id="nav-left" class="col-sm-3" align="left">
                    <ul>
                      <li><a href="index.php">--------------------<br><br>Inventory<br><br>--------------------</a></li>
                      <li><a href="addProduct.php"><br>Register Product<br><br>--------------------</a></li>
                      <li><a href="addOrder.php"><br>Add Order<br><br>--------------------</a></li>
                      <li><a href="listOrders.php"><br>Orders<br><br>--------------------</a></li>
                      <li><a href="registerDisposal.php"><br>Register Disposal<br><br>--------------------</a></li>
                      <li><a href="reports.php"><br>Reports<br><br>--------------------</a></li>
                      <li><a href="logout.php"><br>Logout<br><br>--------------------</a></li>
                    </ul>
                </div>
                <div class="col-sm-9" align="left">

 