<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Staff Name']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Address']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Dpo']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Dpo']['designation']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Dpo']['gender']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Dpo']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Dpo']['email_id']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Dpo']['address']). '","' .preg_replace('/"/','""',$enquiry['Dpo']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
