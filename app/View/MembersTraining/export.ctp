<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
    
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['From Date']) . '"'.',"' . preg_replace('/"/','""',$head['To Date']) . '"'.',"' . preg_replace('/"/','""',$head['Members Name']) . '"'.',"' . preg_replace('/"/','""',$head['Members Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Members Type']) . '"'.',"' . preg_replace('/"/','""',$head['Remarks']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):

$cell .= '"' . preg_replace('/"/','""',$enquiry['MembersTraining']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['MembersTraining']['from_date']))) . '"'.',"' . preg_replace('/"/','""',date('m-d-Y',strtotime($enquiry['MembersTraining']['to_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['MembersTraining']['member_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['MembersTraining']['member_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['MembersTraining']['members_type']) .'"'.',"' .preg_replace('/"/','""',$enquiry['MembersTraining']['remarks']). '","' .preg_replace('/"/','""',$enquiry['MembersTraining']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
