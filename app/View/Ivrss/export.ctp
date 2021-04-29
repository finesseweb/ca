<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Visit Date']) . '"'.',"' . preg_replace('/"/','""',$head['Name of M-Shakti User']) . '"'.',"' . preg_replace('/"/','""',$head['Age']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Type of M-Shakti User']) . '"'.',"' . preg_replace('/"/','""',$head['Registration held today']) . '"'.',"' . preg_replace('/"/','""',$head['Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Survey Participated']) . '"'.',"' . preg_replace('/"/','""',$head['Voice Feedback Recorded']) . '"'.',"' . preg_replace('/"/','""',$head['Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Information Pack Listen']) . '"'.',"' . preg_replace('/"/','""',$head['Reason']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Ivrs']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ivrs']['date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['ivrs_user_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['age']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['gender']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['ivrs_user_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['ivrs_user_type']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['registration_status']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['registration_reason']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['survey_participated']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['voice_feedback_recorded']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['voice_reason']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ivrs']['information_pack_listen']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Ivrs']['info_pack_reason']). '","' .preg_replace('/"/','""',$enquiry['Ivrs']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
