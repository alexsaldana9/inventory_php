<?php
    session_start();
?>

<?php
    include 'user_loggedin.php';
    include 'db_connection.php';

    include 'fpdf.php';

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            // $this->Image('logo.png',10,-1,70);
            $this->SetFont('Arial','B',13);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(80,10,'Inventory List',1,0,'C');
            // Line break
            $this->Ln(20);
        }
         
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }
 
    $connection = OpenCon();
    $display_heading = array('id'=>'ID', 'name'=> 'Name', 'category'=> 'Category','storage'=> 'Storage', 'reorder_level'=> 'Reorder', 'form'=> 'Form', 'quantity'=> 'Qty');
     
    $result = $connection->query("SELECT id, name, category, storage, reorder_level, form, quantity  FROM products") or die("database error 1");
    $header = $connection->query("SHOW columns FROM products");
     
    $pdf = new PDF();
    //header
    $pdf->AddPage();
    //foter page
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',12);
    foreach($header as $heading) {
        $pdf->Cell(40,12,$display_heading[$heading['Field']],1);
    }
    foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
           $pdf->Cell(40,12,$column,1);
    }
    $pdf->Output();

    CloseCon($connection);
?>
