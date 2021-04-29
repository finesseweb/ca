<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['NGO']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Staff Name']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Address']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Joining']) . '"'.',"' . preg_replace('/"/','""',$head['Contract End Date']) . '"'.',"' . preg_replace('/"/','""',$head['No of APHC']) . '"'.',"' . preg_replace('/"/','""',$head['No of HSC']) . '"'.',"' . preg_replace('/"/','""',$head['No of AWC']) . '"'.',"' . preg_replace('/"/','""',$head['No of AWW']) . '"'.',"' . preg_replace('/"/','""',$head['No of VHSND']) . '"'.',"' . preg_replace('/"/','""',$head['No of ANM']) . '"'.',"' . preg_replace('/"/','""',$head['No of ASHA Facilitators']) . '"'.',"' . preg_replace('/"/','""',$head['No of ASHA']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Bpccc']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['designation']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['gender']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['email_id']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['address']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['date_of_joining']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['contract_end_date']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['aphc_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['hsc_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['awc_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['aww_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['vhsnd_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['anm_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpccc']['asha_facilitators_no']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Bpccc']['asha_no']). '","' .preg_replace('/"/','""',$enquiry['Bpccc']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
