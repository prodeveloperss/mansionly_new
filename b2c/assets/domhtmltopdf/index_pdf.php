<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml('<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<center>
  <table style="border:1px solid #000;">
    <tr>
      <td colspan="8" style="text-align:right;"><img src="./invoice-mansionly-logo.png" alt="Mansionly Logo"/></td>
    </tr>
    <tr>
      <td colspan="3">Date</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Customer Name</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Address</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Email</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Contact Number</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Order Number</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Tentative Commencement Date</td>
      <td colspan="5">-N/A-</td>
    </tr>
    <tr>
      <td colspan="3">Tentative Delivery Date</td>
      <td colspan="5">-N/A-</td>
    </tr>
	<tr>
		<td colspan="8"></td>
	</tr>
  </table>
</center>
</body>
</html>');

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('test.pdf');

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));

// You can now write $pdf to disk, store it in a database or stream it
// to the client.
//$pdf = $dompdf->output();
//file_put_contents("saved_pdf.pdf", $pdf);
?>