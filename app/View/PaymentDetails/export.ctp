<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['Organization']) . '"'.',"' . preg_replace('/"/','""',$head['Activity']) . '"'.',"' . preg_replace('/"/','""',$head['Unit Cost']) . '"'.',"' . preg_replace('/"/','""',$head['No of Unit']) . '"'.',"' . preg_replace('/"/','""',$head['Frequecy']) . '"'.',"' . preg_replace('/"/','""',$head['Amount']) . '"'.',"' . preg_replace('/"/','""',$head['Grant Period']) . '"'.',"' . preg_replace('/"/','""',$head['Reporting Period']) . '"'.',"' . preg_replace('/"/','""',$head['Previous Expenditure']) . '"'.',"' . preg_replace('/"/','""',$head['Current Expediture']) . '"'.',"' . preg_replace('/"/','""',$head['Cumulative Expenditure']) . '"'.',"' . preg_replace('/"/','""',$head['Variane']) . '"'.',"' . preg_replace('/"/','""',$head['Variance Percentage']) . '"'.',"' . preg_replace('/"/','""',$head['Reason for Variance']) . '"'.',"' . preg_replace('/"/','""',$head['Opening Balance']) . '"'.',"' . preg_replace('/"/','""',$head['Projection For Next Quater']) . '"'.',"' . preg_replace('/"/','""',$head['Grant Received From PFI']) . '"'.',"' . preg_replace('/"/','""',$head['Interest Earned']) . '"'.',"' . preg_replace('/"/','""',$head['Closing Fund Balance']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Finance']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Financialsubcategory']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['unit_cost']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['no_of_unit']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['frequecy']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['amount']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Period']['from_date'])).' To '.date('d-m-Y',strtotime($enquiry['Period']['to_date']))) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Report']['from_date'])).' To '.date('d-m-Y',strtotime($enquiry['Report']['to_date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['previous_expenditure']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['current_expediture']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['cumulative_expenditure']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['variane']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['variance_percentage']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['reason_variance']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['opening_balance']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['next_quater_projection']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['grant_received_from_pfi']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Finance']['interest_earned']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Finance']['closing_fund_balance']). '","' .preg_replace('/"/','""',$enquiry['Finance']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
