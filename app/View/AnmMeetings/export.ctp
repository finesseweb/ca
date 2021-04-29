<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['Meeting chaired by']) . '"'.',"' . preg_replace('/"/','""',$head['Key Issues Discussed']) . '"'.',"' . preg_replace('/"/','""',$head['Issues Raised By']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Category']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Level']) . '"'.',"' . preg_replace('/"/','""',$head['Decisions Taken']) . '"'.',"' . preg_replace('/"/','""',$head['Decision Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Resolved']) . '"'.',"' . preg_replace('/"/','""',$head['Describe Resolved Issue']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['AnmMeeting']['meeting_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['meeting_chaired_by']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['key_issues_discussed']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['issues_raised_by_bpc']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuecategory']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuesubcat']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['decisions_taken']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['decision_details']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AnmMeeting']['issue_resolved']) .'"'.',"' .preg_replace('/"/','""',$enquiry['AnmMeeting']['details_of_issues_resolved']). '","' .preg_replace('/"/','""',$enquiry['AnmMeeting']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
