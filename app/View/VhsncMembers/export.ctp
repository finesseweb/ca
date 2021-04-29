<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Name']) . '"'.',"' . preg_replace('/"/','""',$head['Member Name']) . '"'.',"' . preg_replace('/"/','""',$head['Member Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Type of VHSNC Member']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncMember']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncConstitution']['vhsnc_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMember']['member_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMember']['member_mobile']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMember']['designation']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Designation']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncMember']['members_type']). '","' .preg_replace('/"/','""',$enquiry['VhsncMember']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
