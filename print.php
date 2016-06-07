<?php

/*
include 'conn.php';
include 'session.php';
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10, $first_name = $_SESSION['first_name'] . " " . $first_name = $_SESSION['last_name']);
$pdf->Output();
*/
?>


<?php

/*

require_once("dbcontroller.php");
$db_handle = new DBController();
*/
/*					
$result = $pdo->query("SELECT t_phonebook_det.id, t_phonebook_det.name, t_phonebook_det.surname, t_phonebook_det.address, t_phonebook_det.title
					FROM t_phonebook_det");
					
$header = $pdo->query("SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='phonebook' 
    AND `TABLE_NAME`='t_phonebook_det'");


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);		
foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(10,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->SetFont('Arial','',12);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(10,12,$column,1);
}
$pdf->Output();

*/
?>

<?php
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');

//Connect to your database
/*include("conectmysql.php");*/

include 'conn.php';
//include 'session.php';


//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10, $first_name = $_SESSION['first_name'] . " " . $first_name = $_SESSION['last_name']);

//set initial y axis position per page
$y_axis_initial = 25;

//print column titles
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($y_axis_initial);
$pdf->SetX(25);
$pdf->Cell(30, 6, 'name', 1, 0, 'L', 1);
$pdf->Cell(100, 6, 'surname', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'address', 1, 0, 'R', 1);
//Set Row Height
$row_height = 6;

$y_axis = $y_axis_initial + $row_height;

//Select the Products you want to show in your PDF file


$sql = "select name, surname, address from t_phonebook_det ORDER BY name";
$result = $pdo->query($sql);


//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;



while($row= $result->fetch(PDO::FETCH_ASSOC))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetFont('Arial', 'B', 10);
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
        $pdf->Cell(30, 6, 'name', 1, 0, 'L', 1);
        $pdf->Cell(100, 6, 'surname', 1, 0, 'L', 1);
        $pdf->Cell(30, 6, 'address', 1, 0, 'R', 1);
        
        //Go to next row
        $y_axis = $y_axis_initial + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $code = $row['name'];
    $price = $row['surname'];
    $name = $row['address'];

	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetFont('Arial', 'B', 10);
    $pdf->SetY($y_axis);
    $pdf->SetX(25);
    $pdf->Cell(30, 6, $code, 1, 0, 'L', 1);
    $pdf->Cell(100, 6, $name, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $price, 1, 0, 'R', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

$pdo = null;

//Send file
$pdf->Output();
?>