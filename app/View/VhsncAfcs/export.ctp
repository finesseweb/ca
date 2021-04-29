<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['Organization']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Member Type']) . '"'.',"' . preg_replace('/"/','""',$head['Member Name']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncAfc']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncAfc']['member_type']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncAfc']['member_name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncAfc']['mobile']). '","' .preg_replace('/"/','""',$enquiry['VhsncAfc']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
