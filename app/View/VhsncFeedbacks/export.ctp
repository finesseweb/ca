<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
    
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Meeting']) . '"'.',"' . preg_replace('/"/','""',$head['Name']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Question']) . '"'.',"' . preg_replace('/"/','""',$head['Answer']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):

$cell .= '"' . preg_replace('/"/','""',$enquiry['VhsncFeedback']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',date('m-d-Y',strtotime($enquiry['VhsncFeedback']['meeting_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncFeedback']['name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['VhsncFeedback']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Subfeedback']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['VhsncFeedback']['response']). '","' .preg_replace('/"/','""',$enquiry['VhsncFeedback']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
