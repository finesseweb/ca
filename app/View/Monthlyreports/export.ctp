<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
 
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Month']) . '"'.',"' . preg_replace('/"/','""',$head['User']) . '"'.',"' . preg_replace('/"/','""',$head['Level']) . '"'.',"' . preg_replace('/"/','""',$head['Question']) . '"'.',"' . preg_replace('/"/','""',$head['Answer']) . '"'.',"' . preg_replace('/"/','""',$head['Remarks']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
 
$cell .= '"' . preg_replace('/"/','""',$enquiry['Monthlyreport']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',date('M-Y',strtotime($enquiry['Monthlyreport']['month']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Level']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Subfeedback']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Monthlyreport']['response']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Monthlyreport']['remarks']). '","' .preg_replace('/"/','""',$enquiry['Monthlyreport']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
