<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['NGO']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Staff Name']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Address']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Joining']) . '"'.',"' . preg_replace('/"/','""',$head['Contract End Date']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Bpc']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['designation']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['gender']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['email_id']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['address']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpc']['date_of_joining']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Bpc']['contract_end_date']). '","' .preg_replace('/"/','""',$enquiry['Bpc']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
