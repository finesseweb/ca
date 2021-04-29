<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['BPMC Registered Member Participated']) . '"'.',"' . preg_replace('/"/','""',$head['Other Participated']) . '"'.',"' . preg_replace('/"/','""',$head['Type of Registered Member Participated']) . '"'.',"' . preg_replace('/"/','""',$head['Meeting chaired by']) . '"'.',"' . preg_replace('/"/','""',$head['Issues Shared in BPMC']) . '"'.',"' . preg_replace('/"/','""',$head['Details of Issues']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Category']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Level']) . '"'.',"' . preg_replace('/"/','""',$head['Decisions Taken']) . '"'.',"' . preg_replace('/"/','""',$head['Decision Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Resolved']) . '"'.',"' . preg_replace('/"/','""',$head['Describe Resolved Issue']) . '"'.',"' . preg_replace('/"/','""',$head['No. of issues forwarded to higher authority']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Bpmc']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Bpmc']['meeting_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['register_member']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['other_participated']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Resitermember']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Meetingfacilitated']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['issue_shared_bpmc']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['details_of_issues']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuecategory']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuesubcat']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['decisions_taken']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['decision_details']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['issue_resolved']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Bpmc']['details_of_issues_resolved']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Bpmc']['letter_to_higher_authority']). '","' .preg_replace('/"/','""',$enquiry['Bpmc']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
