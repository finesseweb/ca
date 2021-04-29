<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Visit Date']) . '"'.',"' . preg_replace('/"/','""',$head['Group Name']) . '"'.',"' . preg_replace('/"/','""',$head['Total Member']) . '"'.',"' . preg_replace('/"/','""',$head['No. of Participants']) . '"'.',"' . preg_replace('/"/','""',$head['Meeting Facilitated By']) . '"'.',"' . preg_replace('/"/','""',$head['Topic Discussed']) . '"'.',"' . preg_replace('/"/','""',$head['Material Used']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['AdolescentMeeting']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['AdolescentMeeting']['date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Youthleader']['group_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AdolescentMeeting']['total_member']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AdolescentMeeting']['no_of_participants']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Meetingfacilitated']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Discussion']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Usematerial']['name']). '","' .preg_replace('/"/','""',$enquiry['AdolescentMeeting']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
