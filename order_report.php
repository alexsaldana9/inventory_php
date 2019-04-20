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
            $this->Cell(80,10,'Orders List',1,0,'C');
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
     
    $result = $connection->query("SELECT id, product_id, qty_ordered  FROM orders") or die("database error 1");
     
    $pdf = new PDF();
    //header
    $pdf->AddPage();
    //foter page
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',12);

    $pdf->Cell(40, 12, 'Id - order',1);
    $pdf->Cell(40, 12, 'Product id',1);
    $pdf->Cell(40, 12, 'Qty ordered',1);


    foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
           $pdf->Cell(40,12,$column,1);
    }
    $pdf->Output();

    CloseCon($connection);
?>
