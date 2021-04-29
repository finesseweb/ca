<?php 
App::import('Vendor','xtcpdf');
$pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false); 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Amuk Saxena');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice Receipt');
$pdf->SetKeywords('Invoice');
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();
// create some HTML content

function numberTowords($num)
{

$ones = array(
0 =>"Zero",
1 => "One",
2 => "Two",
3 => "Three",
4 => "Four",
5 => "Five",
6 => "Six",
7 => "Seven",
8 => "Eight",
9 => "Nine",
10 => "Ten",
11 => "Eleven",
12 => "Twelve",
13 => "Thirteen",
14 => "Fourteen",
15 => "Fifteen",
16 => "Sixteen",
17 => "Seventeen",
18 => "Eighteen",
19 => "Nineteen",
"014" => "Fourteen"
);
$tens = array( 
0 => "Zero",
1 => "Ten",
2 => "Twenty",
3 => "Thirty", 
4 => "Forty", 
5 => "Fifty", 
6 => "Sixty", 
7 => "Seventy", 
8 => "Eighteen", 
9 => "Ninety" 
); 
$hundreds = array( 
"Hundred", 
"Thousand", 
"Million", 
"Billion", 
"Trillion", 
"Quardrillion" 
); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt = ""; 
$i = "";
foreach($whole_arr as $key => $i){
	
while(substr($i,0,1)=="0")
$i=substr($i,1,5);
if($i < 20){ 
/* echo "getting:".$i; */
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
}
} 
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}
$subtable = '<div class="col-sm-12 invoice">
    <h3 class="center">Invoice</h3>
    </div>
                <div class="col-sm-12" style="margin-top:10px">
   
    <h5>'.$invoicedetails['0']['ClientDetail']['name_of_client'].'</h5> 
    <h5>'.$invoicedetails['0']['ClientDetail']['district_c'].''.$invoicedetails['0']['ClientDetail']['state_c'].'</h5> 
    
    </div>
               <div class="col-sm-12" style="margin-top:15px">
   
     <h4 class="center">Income Tax PAN : '.$invoicedetails['0']['CompanyDetail']['pan_number'].'</h4>
    
    </div>
                 <div class="col-sm-12"><div class="col-sm-6"><h5 style="margin-left: -25px;">Invoice Number : '.$invoicedetails['0']['Finance']['invoice_number'].'</h5></div>
        <div class="col-sm-6">  <h5 style="float:right; margin-right:-24px;">Date : '.date('m-d-Y',strtotime($invoicedetails['0']['Finance']['invoice_date'])).'></h5></div></div>';
$newtable='<div class="col-sm-12"> 
 <div class="row table-bordered">
<table class="table table-hover table-condensed  table-bordered inventory" style="margin-bottom:0px!important;display:block;"> 
        <thead>
        <th style="width:87%;">Description</th><th style="width:13%;">Amount (Rs.)</th></thead>
        <tbody>';
		
		foreach($invoicedetails as $invoice) {
            $newtable.= '<tr>
              <td>'.$invoice['Finance']['description_details'].'</td><td style="text-align:right;">'.number_format($invoice['Finance']['amount']).'00 </td>
          
         </tr>';
               
                 
                  
                }  
          
          
        '</table>
    
          
</div>
</div>';
'<div class="col-sm-6" style="margin-top: 10px; margin-bottom: 12px">
             <h5>'.numberTowords($invoice['Finance']['current_total_amount']-$invoice['Finance']['advance_amount']).' Only </h5>
            </div> 
<table class="balance">
				<tr>
					<th><span contenteditable>Total Amount</span></th>
					<td><span>'.number_format($invoice['Finance']['current_total_amount']).'00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Less- Advance</span></th>
					<td><span contenteditable>'.number_format($invoice['Finance']['advance_amount']).'00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Balance Payable</span></th>
					<td><span>'.number_format($invoice['Finance']['current_total_amount']-$invoice['Finance']['advance_amount']).'00</span></td>
				</tr>
			</table>';
$html = '<div class="col-sm-12">
                 <p> Cheque/NEFT/RTGS to be in favour of :'.$invoicedetails['0']['CompanyDetail']['name_of_company'].' </p>
                 <p>Account No. '.$invoicedetails['0']['CompanyDetail']['company_bank_ac_no'].'</p>
                 <p>IFSC : '.$invoicedetails['0']['CompanyDetail']['ifsc'].' </p>
                 <p>Bank : '.$invoicedetails['0']['CompanyDetail']['name_of_bank']?> <?=$invoicedetails['0']['CompanyDetail']['branch'].' </p>

             </div>
             <div class="col-sm-12">
<div class="col-sm-9"></div>
                <div class="col-sm-3 sign">
                 <p style="text-align: center";><img src="<?=SITE_PATH?>images/'.$invoicedetails['0']['CompanyDetail']['signature'].'"></p>
                 <p> '.invoicedetails['0']['CompanyDetail']['digital_signature'].' </p>
                 </div> 
                 
             </div>';
$pdf->writeHTML($html, true, false, true, false, '');
 
$pdf->lastPage();
 
$pdf->Output(APP . 'webroot/files/pdf' . DS . 'amuk.pdf', 'F');

?>