<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
    
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Investigation']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Investigator']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Health Facility']) . '"'.',"' . preg_replace('/"/','""',$head['Type of Health Facility']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Responder One']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile Number']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Responder Two']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile Number']) . '"'.',"' . preg_replace('/"/','""',$head['Start time of assessement']) . '"'.',"' . preg_replace('/"/','""',$head['End time of assessement']) . '"'.',"' . preg_replace('/"/','""',$head['Question']) . '"'.',"' . preg_replace('/"/','""',$head['Answer']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):

$cell .= '"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['FacilityAssessment']['invsetigation_date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['investigator_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Facility']['health_facility_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Facility']['facility_type']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['name_of_responder_one']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['mobile_responder_one']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['name_of_responder_two']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['mobile_responder_two']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['start_time_assessment']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityAssessment']['end_time_assessment']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Subfeedback']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['FacilityAssessment']['response']). '","' .preg_replace('/"/','""',$enquiry['FacilityAssessment']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
