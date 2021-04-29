<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['Organization']) . '"'.',"' . preg_replace('/"/','""',$head['Category']) . '"'.',"' . preg_replace('/"/','""',$head['Subcategory']) . '"'.',"' . preg_replace('/"/','""',$head['Grant Period']) . '"'.',"' . preg_replace('/"/','""',$head['Unit Cost']) . '"'.',"' . preg_replace('/"/','""',$head['No of Unit']) . '"'.',"' . preg_replace('/"/','""',$head['Frequecy']) . '"'.',"' . preg_replace('/"/','""',$head['Amount']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['FinancialDetail']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Financialcategory']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Financialsubcategory']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Period']['from_date'])).' To '.date('d-m-Y',strtotime($enquiry['Period']['to_date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['FinancialDetail']['unit_cost']) . '"'.',"' . preg_replace('/"/','""',$enquiry['FinancialDetail']['no_of_unit']) . '"'.',"' . preg_replace('/"/','""',$enquiry['FinancialDetail']['frequecy']) .'"'.',"' .preg_replace('/"/','""',$enquiry['FinancialDetail']['amount']). '","' .preg_replace('/"/','""',$enquiry['FinancialDetail']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
