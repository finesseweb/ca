<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Details']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Category']) . '"'.',"' . preg_replace('/"/','""',$head['Issue Level']) . '"'.',"' . preg_replace('/"/','""',$head['Decisions Taken']) . '"'.',"' . preg_replace('/"/','""',$head['Decision Details']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Resolved Issued']) . '"'.',"' . preg_replace('/"/','""',$head['Describe Resolved Issued']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Issue']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Issue']['meeting_date']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issue']['new_issues_identified']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuecategory']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issuesubcat']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issue']['decision_taken']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Issue']['decision_details']) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Issue']['issue_resolved_date']))) .'"'.',"' .preg_replace('/"/','""',$enquiry['Issue']['described_resolved_issue']). '","' .preg_replace('/"/','""',$enquiry['Issue']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
