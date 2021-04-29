<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
 
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['Date']) . '","' . preg_replace('/"/','""',$head['User']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
 
$cell .= '"' . preg_replace('/"/','""',$enquiry['Commonreport']['id']) . '"'.',"' .preg_replace('/"/','""',date('Y-m-d',strtotime($enquiry['Commonreport']['date']))). '","' .preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
