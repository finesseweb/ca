<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Name']) . '"'.',"' . preg_replace('/"/','""',$head['Total Expenditure Previous']) . '"'.',"' . preg_replace('/"/','""',$head['Balance as on Date']) . '"'.',"' . preg_replace('/"/','""',$head['Balance Amount as on Date']) . '"'.',"' . preg_replace('/"/','""',$head['Expenditure Date']) . '"'.',"' . preg_replace('/"/','""',$head['Expenditure Details']) . '"'.',"' . preg_replace('/"/','""',$head['Expenditure Amount']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['vhsnc_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['total_expenditure']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['balance_check_date']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['balance_on_date']) .'"'.',"' . preg_replace('/"/','""',date('m-d-Y',strtotime($enquiry['VhsncUntiedfund']['expenditure_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['expenditure_details']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['expenditure_amount']). '","' .preg_replace('/"/','""',$enquiry['VhsncUntiedfund']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
