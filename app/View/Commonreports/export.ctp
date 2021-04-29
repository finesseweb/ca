<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
 
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Date']) . '"'.',"' . preg_replace('/"/','""',$head['Activity']) . '"'.',"' . preg_replace('/"/','""',$head['User']) . '"'.',"' . preg_replace('/"/','""',$head['Remarks']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
 
$cell .= '"' . preg_replace('/"/','""',$enquiry['Commonreport']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Commonreport']['date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Commonreport']['activity']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Commonreport']['remarks']). '","' .preg_replace('/"/','""',$enquiry['Commonreport']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
