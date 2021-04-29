<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
 
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Date']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Monitor']) . '"'.',"' . preg_replace('/"/','""',$head['AWC Code']) . '"'.',"' . preg_replace('/"/','""',$head['Level']) . '"'.',"' . preg_replace('/"/','""',$head['Question']) . '"'.',"' . preg_replace('/"/','""',$head['Answer']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
 
$cell .= '"' . preg_replace('/"/','""',$enquiry['Checklist']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Checklist']['monitoring_date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Checklist']['name_of_monitor']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['awc_code']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Checklist']['level']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Subfeedback']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Checklist']['response']). '","' .preg_replace('/"/','""',$enquiry['Checklist']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
