<style>
    .center {
        text-align: center;
    }
    th {
        text-align: center;
    }
    table tr td {
        word-break: unset;
    }
    
    .table-bordered tr td{
        border: 1px solid #000;
    }
.footer {
font-family:"Calibri (Body)";
text-align: center;

}
.content {
margin-top:214px;
margin-bottom:50px;
}
.companytitle{
   color:#0070c0;
   font-family:nyala;
 } 
.companytitle>h3{
   
   font-size:45px;
 } 
.companytitle>h4{
   
   font-size:30px;
 }  
 hr.new4 {
  border: 1px solid #747474;
}
hr.new3 {
  border: 0.5px solid #747474;
}
hr{
margin-bottom:10px !important;
}
  * 
 {
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 100%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }
body {margin-left:20% !important;height:auto; }
/* header */

header { margin: 0 0 0 0; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%;margin-top: 21px }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 40%; margin-bottom:40px;  }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; min-height:400px; max-height:max-content;}
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }



}


</style>
<style>
@media print {
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
  }
  .col-sm-12 {
    width: 100%;
  }
  .col-sm-11 {
    width: 91.66666667%;
  }
  .col-sm-10 {
    width: 83.33333333%;
  }
  .col-sm-9 {
    width: 75%;
  }
  .col-sm-8 {
    width: 66.66666667%;
  }
  .col-sm-7 {
    width: 58.33333333%;
  }
  .col-sm-6 {
    width: 50%;
  }
  .col-sm-5 {
    width: 41.66666667%;
  }
  .col-sm-4 {
    width: 33.33333333%;
  }
  .col-sm-3 {
    width: 25%;
  }
  .col-sm-2 {
    width: 16.66666667%;
  }
  .col-sm-1 {
    width: 8.33333333%;
  }
  .col-sm-pull-12 {
    right: 100%;
  }
  .col-sm-pull-11 {
    right: 91.66666667%;
  }
  .col-sm-pull-10 {
    right: 83.33333333%;
  }
  .col-sm-pull-9 {
    right: 75%;
  }
  .col-sm-pull-8 {
    right: 66.66666667%;
  }
  .col-sm-pull-7 {
    right: 58.33333333%;
  }
  .col-sm-pull-6 {
    right: 50%;
  }
  .col-sm-pull-5 {
    right: 41.66666667%;
  }
  .col-sm-pull-4 {
    right: 33.33333333%;
  }
  .col-sm-pull-3 {
    right: 25%;
  }
  .col-sm-pull-2 {
    right: 16.66666667%;
  }
  .col-sm-pull-1 {
    right: 8.33333333%;
  }
  .col-sm-pull-0 {
    right: auto;
  }
  .col-sm-push-12 {
    left: 100%;
  }
  .col-sm-push-11 {
    left: 91.66666667%;
  }
  .col-sm-push-10 {
    left: 83.33333333%;
  }
  .col-sm-push-9 {
    left: 75%;
  }
  .col-sm-push-8 {
    left: 66.66666667%;
  }
  .col-sm-push-7 {
    left: 58.33333333%;
  }
  .col-sm-push-6 {
    left: 50%;
  }
  .col-sm-push-5 {
    left: 41.66666667%;
  }
  .col-sm-push-4 {
    left: 33.33333333%;
  }
  .col-sm-push-3 {
    left: 25%;
  }
  .col-sm-push-2 {
    left: 16.66666667%;
  }
  .col-sm-push-1 {
    left: 8.33333333%;
  }
  .col-sm-push-0 {
    left: auto;
  }
  .col-sm-offset-12 {
    margin-left: 100%;
  }
  .col-sm-offset-11 {
    margin-left: 91.66666667%;
  }
  .col-sm-offset-10 {
    margin-left: 83.33333333%;
  }
  .col-sm-offset-9 {
    margin-left: 75%;
  }
  .col-sm-offset-8 {
    margin-left: 66.66666667%;
  }
  .col-sm-offset-7 {
    margin-left: 58.33333333%;
  }
  .col-sm-offset-6 {
    margin-left: 50%;
  }
  .col-sm-offset-5 {
    margin-left: 41.66666667%;
  }
  .col-sm-offset-4 {
    margin-left: 33.33333333%;
  }
  .col-sm-offset-3 {
    margin-left: 25%;
  }
  .col-sm-offset-2 {
    margin-left: 16.66666667%;
  }
  .col-sm-offset-1 {
    margin-left: 8.33333333%;
  }
  .col-sm-offset-0 {
    margin-left: 0%;
  }
  .visible-xs {
    display: none !important;
  }
  .hidden-xs {
    display: block !important;
  }
  table.hidden-xs {
    display: table;
  }
  tr.hidden-xs {
    display: table-row !important;
  }
  th.hidden-xs,
  td.hidden-xs {
    display: table-cell !important;
  }
  .hidden-xs.hidden-print {
    display: none !important;
  }
  .hidden-sm {
    display: none !important;
  }
  .visible-sm {
    display: block !important;
  }
  table.visible-sm {
    display: table;
  }
  tr.visible-sm {
    display: table-row !important;
  }
  th.visible-sm,
  td.visible-sm {
    display: table-cell !important;
  }
       #non-printable { display: none; }
        #printable { display: block; } 
        
  .printdiv:last-child {
     page-break-inside: avoid;
}
body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
  
 body {
  font-size: 14pt !important;
  margin: 0 !important; 
  padding: 0 !important;
  overflow: hidden;

}

table.inventory{
min-height: 400px!important;
max-height:max-content;
margin-bottom: 0px!important;
border:1px; solid !important;
}

header {
width:100% !important;
position: fixed;
top: 0;
}

.footer {
font-family:"Calibri (Body)";
font-size:17px;
text-align:center;
margin-top:auto;
position: fixed !important;
bottom: 0;
}

.invoice{
margin-top:150px;
}
.sign {
margin-top:10px;
 
}
.content {
margin-top:214px;
margin-bottom:50px;
page-break-before: always; 
}
h5{
font-size: 14pt!important
}
.companytitle{
   color:#0070c0!important;
   font-family:nyala;
 }  
}
 @page 
    {
        size:  A4;   /* auto is the initial value */
        margin: 1mm;  /* this affects the margin in the printer settings */
    }


   
    #custom_data_records{
        width:100%;
        text-align: right;
        font-size:1.5em;

    }
    
    .load-box{
        display:none;
        position:absolute;
        width:100%;
        height:100%;
        background:rgba(146,40,46,.5);
        z-index: 999;
    }
    
    .load-box>img{
        position:absolute;
        top:50%;
        left:50%;
        width:40em;
        transform: translate(-50%,-50%);
        
        
    }
 @page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}   
 @import url(//db.onlinewebfonts.com/c/9f895be44fd462d400a25832ec1095a1?family=Nyala);
@font-face {font-family: "Nyala"; src: url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.eot"); src: url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.woff") format("woff"), url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/9f895be44fd462d400a25832ec1095a1.svg#Nyala") format("svg"); }
   
</style>
<link href="//db.onlinewebfonts.com/c/9f895be44fd462d400a25832ec1095a1?family=Nyala" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
error_reporting(0);
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




if(!empty($invoicedetails)) 
//print_r($invoicedetails['0']['ClientDetail']); die();
{?>
  <div class="row">
<div class="col-sm-12" id="section-to-print"><div class="left_resale">
<div class="table-responsive">
 <header>
  <div class="col-sm-12">
 <div class="col-sm-8 companytitle"> <h3><?=$invoicedetails['0']['CompanyDetail']['name_of_company']?></h3>
<h4>Chartered Accountants</h4>
 </div>
<div class="col-sm-4 logo"><img src="<?=SITE_PATH?>images/<?=$invoicedetails['0']['CompanyDetail']['company_logo']?>"></div>

</div>
<hr class="new3">
 </header>
    <div class="col-sm-12 invoice">
    <h3 class="center">Invoice</h3>
    </div>
<div class="col-sm-12" style="margin-top:10px">
   
    <h5> <?=$invoicedetails['0']['ClientDetail']['name_of_client']?></h5> 
    <h5> <?=$invoicedetails['0']['ClientDetail']['district_c']?>,<?=$invoicedetails['0']['ClientDetail']['state_c']?></h5> 
    
    </div>
<div class="col-sm-12" style="margin-top:15px">
   
     <h4 class="center">Income Tax PAN : <?=$invoicedetails['0']['CompanyDetail']['pan_number']?></h4>
    
    </div>
    <div class="col-sm-12"><div class="col-sm-6"><h5 style="margin-left: -25px;">Invoice Number : <?=$invoicedetails['0']['Finance']['invoice_number']?></h5></div>
        <div class="col-sm-6">  <h5 style="float:right; margin-right:-24px;">Date : <?=date('m-d-Y',strtotime($invoicedetails['0']['Finance']['invoice_date']))?></h5></div></div>
<div class="row content"> 
 <div class="col-sm-12"> 
 <div class="row table-bordered">
<table class="table table-hover table-condensed  table-bordered inventory" style="margin-bottom:0px!important;display:block;"> 
        <thead>
        <th style="width:87%;">Description</th><th style="width:13%;">Amount (Rs.)</th></thead>
        <tbody>
             <?php 
  
             foreach($invoicedetails as $invoice) {
                
                 // print_r($invoice['Finance']); die();
                 ?>
            
          <tr>
              <td><?=$invoice['Finance']['description_details']?></td><td style="text-align:right;"><?=number_format($invoice['Finance']['amount'])?>.00 </td>
          
         </tr>

          
        
            
                 <?php 
                  
                }  ?>
          
          
        </table>
    
          
</div>
</div>
<div class="col-sm-6" style="margin-top: 10px; margin-bottom: 12px">
             <h5><?=numberTowords($invoice['Finance']['current_total_amount']-$invoice['Finance']['advance_amount'])?> Only </h5>
            </div> 
<table class="balance">
				<tr>
					<th><span contenteditable>Total Amount</span></th>
					<td><span><?=number_format($invoice['Finance']['current_total_amount'])?>.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Less- Advance</span></th>
					<td><span contenteditable><?=number_format($invoice['Finance']['advance_amount'])?>.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Balance Payable</span></th>
					<td><span><?=number_format($invoice['Finance']['current_total_amount']-$invoice['Finance']['advance_amount'])?>.00</span></td>
				</tr>
			</table>
 
<div class="col-sm-12">
                 <p> Cheque/NEFT/RTGS to be in favour of :<?=$invoicedetails['0']['CompanyDetail']['name_of_company']?> </p>
                 <p>Account No. <?=$invoicedetails['0']['CompanyDetail']['company_bank_ac_no']?> </p>
                 <p>IFSC : <?=$invoicedetails['0']['CompanyDetail']['ifsc']?> </p>
                 <p>Bank :  <?=$invoicedetails['0']['CompanyDetail']['name_of_bank']?> <?=$invoicedetails['0']['CompanyDetail']['branch']?> </p>

             </div>
             <div class="col-sm-12">
<div class="col-sm-9"></div>
                <div class="col-sm-3 sign">
                 <p style="text-align: center";><img src="<?=SITE_PATH?>images/<?=$invoicedetails['0']['CompanyDetail']['signature']?>"></p>
                 <p> <?=$invoicedetails['0']['CompanyDetail']['digital_signature']?> </p>
                 </div> 
                 
             </div>
</div>
<div class="col-sm-12 footer">
<hr class="new4">  
   <p style="text-align:center">Mobile No.: <?=$invoicedetails['0']['CompanyDetail']['company_phone']?> Email: <?=$invoicedetails['0']['CompanyDetail']['company_email']?> </p>
<p>Address: <?=$invoicedetails['0']['CompanyDetail']['permanent_address']?>, <?=$invoicedetails['0']['CompanyDetail']['post_office_p']?>, <?=$invoicedetails['0']['CompanyDetail']['district_p']?>-<?=$invoicedetails['0']['CompanyDetail']['permanent_pincode']?>.</p>
			
		</div>
             
 
             
</div></div>
    
</div>
   
  <div class="col-sm-12" style="margin-left: 43%;"><a href="#" onclick="window.print()" class="btn btn-success">Print</a> </div>  
</div>
<?php } ?>

<script>
function addCommas(nStr){
 nStr += '';
 var x = nStr.split('.');
 var x1 = x[0];
 var x2 = x.length > 1 ? '.' + x[1] : '';
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(x1)) {
  x1 = x1.replace(rgx, '$1' + ',' + '$2');
 }
 return x1 + x2;
}
</script>





