<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Quorum Completed']) . '"'.',"' . preg_replace('/"/','""',$head['Types of Reg. Member Participated']) . '"'.',"' . preg_replace('/"/','""',$head['Meeting Facilitated by']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Category']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Level']) . '"'.',"' . preg_replace('/"/','""',$head['Decisions Taken']) . '"'.',"' . preg_replace('/"/','""',$head['Decision Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Resolved']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Resolved Issued']) . '"'.',"' . preg_replace('/"/','""',$head['Remarks of Issued']) . '"'.',"' . preg_replace('/"/','""',$head['Letter Issued to Higher Authority']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['meeting_date']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['vhsnc_quorum_ompleted']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Registermember']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Meetingfacilitated']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['issue_details']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Issuecategory']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuesubcat']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['decisions_taken']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['decision_details']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['issue_resolved']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['issue_resolved_date']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncMeeting']['issue_remarks']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncMeeting']['letter_issued_bpmc']). '","' .preg_replace('/"/','""',$enquiry['VhsncMeeting']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
