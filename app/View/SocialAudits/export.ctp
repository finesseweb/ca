<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['Participants']) . '"'.',"' . preg_replace('/"/','""',$head['Panellist']) . '"'.',"' . preg_replace('/"/','""',$head['Case Study Shared']) . '"'.',"' . preg_replace('/"/','""',$head['Testimonials Shared']) . '"'.',"' . preg_replace('/"/','""',$head['Issues Shared in Jan Samwaad']) . '"'.',"' . preg_replace('/"/','""',$head['Details of Issues']) . '"'.',"' . preg_replace('/"/','""',$head['Issues Shared by']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Category']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Level']) . '"'.',"' . preg_replace('/"/','""',$head['Decisions Taken']) . '"'.',"' . preg_replace('/"/','""',$head['Decision Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Resolved']) . '"'.',"' . preg_replace('/"/','""',$head['Describe Resolved Issue']) . '"'.',"' . preg_replace('/"/','""',$head['Action Taken']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['SocialAudit']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['SocialAudit']['meeting_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['participants']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['panellist']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['case_study_shared']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['testimonial_shared']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['issue_shared_jansamwad']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['details_of_issues']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['issue_shared_pri']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuecategory']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuesubcat']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['decisions_taken']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['decisions_details']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['issue_resolved']) .'"'.',"' . preg_replace('/"/','""',$enquiry['SocialAudit']['details_of_issues_resolved']) .'"'.',"' .preg_replace('/"/','""',$enquiry['SocialAudit']['action_taken']). '","' .preg_replace('/"/','""',$enquiry['SocialAudit']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
