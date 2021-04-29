<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Constitution Date']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Constitution Level']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Name']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Bank Name']) . '"'.',"' . preg_replace('/"/','""',$head['Account Type']) . '"'.',"' . preg_replace('/"/','""',$head['Account No']) . '"'.',"' . preg_replace('/"/','""',$head['IFS CODE']) . '"'.',"' . preg_replace('/"/','""',$head['Branch Address']) . '"'.',"' . preg_replace('/"/','""',$head['Opening Balance']) . '"'.',"' . preg_replace('/"/','""',$head['Primary Signatory']) . '"'.',"' . preg_replace('/"/','""',$head['Secondary Signatory']) . '"'.',"' . preg_replace('/"/','""',$head['Total Member']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['constitution_date']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['vhsnc_constitution_level']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['vhsnc_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['vhsnc_bank_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['account_type']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['account_no']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['ifsc']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['branch_address']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['opening_balance']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['primary_signatory']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['secondary_signatory']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncConstitution']['total_members']). '","' .preg_replace('/"/','""',$enquiry['VhsncConstitution']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
