<?php
print_r(App);
die();
  App::import('Vendor', 'Mpdf/Mpdf');  

$html = "Hello World";
     $mpdf = new mPDF();
     $mpdf->WriteHTML($html);
     $mpdf->Output("phpflow.pdf", 'F');
     $mpdf->Output();