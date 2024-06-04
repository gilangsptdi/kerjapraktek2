<?php
require_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;
$pdf = new Dompdf();
$html = file_get_contents('tes.html');
$pdf ->loadHtml($html);
$pdf->setPaper('B5', 'potrait');
$pdf->render();
$pdf->stream("test.pdf", array("attachments"=> 0));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>