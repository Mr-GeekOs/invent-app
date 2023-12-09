<?php

//include("phpToPDF.php");
require('modules/fpdf/fpdf.php');

//$PDF=new phpToPDF();
$PDF=new FPDF('P','mm',array(80,125));
$PDF->AddPage();
$PDF->SetFont('Arial','B',16);


// Définition des propriétés du tableau.
$proprietesTableau = array(
		'TB_ALIGN' => 'L',
		'L_MARGIN' => 15,
		'BRD_COLOR' => array(0,92,177),
		'BRD_SIZE' => '0.3',
);

// Définition des propriétés du header du tableau.
$proprieteHeader = array(
		'T_COLOR' => array(150,10,10),
		'T_SIZE' => 12,
		'T_FONT' => 'Arial',
		'T_ALIGN' => 'C',
		'V_ALIGN' => 'T',
		'T_TYPE' => 'B',
		'LN_SIZE' => 7,
		'BG_COLOR_COL0' => array(170, 240, 230),
		'BG_COLOR' => array(170, 240, 230),
		'BRD_COLOR' => array(0,92,177),
		'BRD_SIZE' => 0.2,
		'BRD_TYPE' => '1',
		'BRD_TYPE_NEW_PAGE' => '',
);

// Contenu du header du tableau.
$contenuHeader = array(
		50, 50, 50,
		"Titre de la première colonne", "année N-1", "année N",
);

// Définition des propriétés du reste du contenu du tableau.
$proprieteContenu = array(
		'T_COLOR' => array(0,0,0),
		'T_SIZE' => 10,
		'T_FONT' => 'Arial',
		'T_ALIGN_COL0' => 'L',
		'T_ALIGN' => 'R',
		'V_ALIGN' => 'M',
		'T_TYPE' => '',
		'LN_SIZE' => 6,
		'BG_COLOR_COL0' => array(245, 245, 150),
		'BG_COLOR' => array(255,255,255),
		'BRD_COLOR' => array(0,92,177),
		'BRD_SIZE' => 0.1,
		'BRD_TYPE' => '1',
		'BRD_TYPE_NEW_PAGE' => '',
);

// Contenu du tableau.
$contenuTableau = array(
		"champ 1", 1, 2,
		"champ 2", 3, 4,
		"champ 3", 5, 6,
		"champ 4", 7, 8,
);


// D'abord le PDF, puis les propriétés globales du tableau.
// Ensuite, le header du tableau (propriétés et données) puis le contenu (propriétés et données)
$PDF->drawTableau($PDF, $proprietesTableau, $proprieteHeader, $contenuHeader, $proprieteContenu, $contenuTableau);

$PDF->Output();

?>

<?php
/*require('modules/fpdf/fpdf.php');

class PDF extends FPDF
{	
}
	
include "modules/general/parametre-db.inc.php";

$pdf = new FPDF('P','mm',array(80,125));
$pdf->SetFont('Times','',9);

$list=mysql_query("select * from produits limit 0,80 ");
while ($result = mysql_fetch_array($list))
{

	
	
	
	
	
	$pdf->Cell(20,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
	$pdf->Cell(20,5,'Words Here',1,0,'L',0);
	$pdf->Cell(20,5,'Words Here',1,0,'L',0);
	$pdf->Cell(20,5,'Words Here','LR',1,'C',0);  // cell with left and right borders
	$pdf->Cell(20,5,'[ x ] abc',1,0,'L',0);
	$pdf->Cell(20,5,'[ x ] checkbox1',1,0,'L',0);
	$pdf->Cell(20,5,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
	$pdf->Cell(20,5,'[ x ] def',1,0,'L',0);
	$pdf->Cell(20,5,'[ x ] checkbox2',1,0,'L',0);
	
	
	/*
	
	//$x = $pdf->GetX();
	//$y = $pdf->GetY();
	
	
	
	
	
	
	
	
// width of the firs cell
$w1 = 35;

// width of the second cell
$w2 = 10;

// width of the third cell
$w3 = 20;

// find the cursor's position and store it
$y1 = $pdf->GetY();
$x1 = $pdf->GetX();

$pdf->SetXY($x1+$w1, $pdf->GetY());

// the "multiCell" cell, which will resize automaticly
$pdf->MultiCell($w1, 10, utf8_decode($result['nom']), 1, "L"); 

// find the cursor position after the second cell was displayed
$y2 = $pdf->GetY();

// find the height of the multiCell
$hCell = $y2 - $y1;

// setting the cursor to the initial coordonates to display the first cell
$pdf->SetXY($x1, $y1);

// display the first cell
$pdf->Cell($w1, $hCell, "celula 1", 1, 0, "C");

// setting cursor to the new calculated location
$pdf->SetXY($x1+$w1+$w2, $y1);

// display the third cell
$pdf->Cell($w3, $hCell, "celula 3", 1, 0, "C");

// a new row to go to the next line.
$pdf->Ln();
	
	
		
	
	
	
	
	//$pdf->MultiCell(35, 6, utf8_decode($result['nom']), 1, 1); $pdf->SetXY($x + 35, $y);
	//$pdf->MultiCell(20, 6, $result['prixvente'], 1, 1); $pdf->SetXY($x + 20, $y);
	//$pdf->MultiCell(10, 6, $result['qtmin'], 1, 1);
	
	//$pdf->SetXY(10,$pdf->GetY()+6);
					
}

		
$pdf->SetFont('Times','',10);

//$pdf->Output('produits_sur_commande.pdf','D');
$pdf->Output('produits_sur_commande.pdf','D');
*/	
?>