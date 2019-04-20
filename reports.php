<?php include 'templates/header.php'; ?>

<!-- Make reports  - to pdf -->
<!-- https://www.phpflow.com/php/generate-pdf-file-mysql-database-using-php/ -->

<div class="container" style="padding-top:50px">
<h2>Reports</h2>
<form class="form-inline" method="post" action="inventory_report.php">
<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
Inventory List</button>
</form>

<form class="form-inline" method="post" action="order_report.php">
<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
Orders List</button>
</form>


<img id="printer" src="printer.png">

</div>

<?php include 'templates/footer.php'; ?>