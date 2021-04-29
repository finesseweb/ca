<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['First Name']) . '"'.',"' . preg_replace('/"/','""',$head['Last Name']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Age']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Education']) . '"'.',"' . preg_replace('/"/','""',$head['Address']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Joining']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Youthleader']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['first_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['designation']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['gender']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['age']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['email']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['qualification']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['address']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Youthleader']['date_of_joining']). '","' .preg_replace('/"/','""',$enquiry['Youthleader']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
