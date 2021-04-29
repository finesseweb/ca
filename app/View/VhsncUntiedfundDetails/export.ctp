<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Name']) . '"'.',"' . preg_replace('/"/','""',$head['Bank Account Number']) . '"'.',"' . preg_replace('/"/','""',$head['IFS CODE']) . '"'.',"' . preg_replace('/"/','""',$head['Opening Balance']) . '"'.',"' . preg_replace('/"/','""',$head['Financial Years']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Funds Recieved']) . '"'.',"' . preg_replace('/"/','""',$head['Amount Recieved From Other Source']) . '"'.',"' . preg_replace('/"/','""',$head['Amount Received From']) . '"'.',"' . preg_replace('/"/','""',$head['Payment Mode']) . '"'.',"' . preg_replace('/"/','""',$head['Payment Received Date']) . '"'.',"' . preg_replace('/"/','""',$head['Interest Credited by Bank']) . '"'.',"' . preg_replace('/"/','""',$head['Charge Deducted by Bank']) . '"'.',"' . preg_replace('/"/','""',$head['Date']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['vhsnc_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['bank_account_number']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['ifsc']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['opening_balance']) .'"'.',"' . preg_replace('/"/','""',date('m-d-Y',strtotime($enquiry['Period']['from_date'])).' To '.date('d-m-Y',strtotime($enquiry['Period']['to_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['vhsnc_funds_recieved']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['amount_recieved_from_other_source']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['amount_received_from']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['payment_mode']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['payment_received_date']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['bank_interest_credit']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['bank_charge_deduct']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['create_date']). '","' .preg_replace('/"/','""',$enquiry['VhsncUntiedfundDetail']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
