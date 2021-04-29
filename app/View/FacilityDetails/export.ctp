<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Health Facility Name']) . '"'.',"' . preg_replace('/"/','""',$head['Facility Type']) . '"'.',"' . preg_replace('/"/','""',$head['Health Facility Place']) . '"'.',"' . preg_replace('/"/','""',$head['Functionality']) . '"'.',"' . preg_replace('/"/','""',$head['Doctor Name']) . '"'.',"' . preg_replace('/"/','""',$head['Doctor Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['ANM Name']) . '"'.',"' . preg_replace('/"/','""',$head['ANM Mobile']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['health_facility_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['facility_type']) . '"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['health_facility_place']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['functionality']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['doctor_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['doctor_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['FacilityDetail']['anm_name']) . '"'.',"' .preg_replace('/"/','""',$enquiry['FacilityDetail']['anm_mobile']). '","' .preg_replace('/"/','""',$enquiry['FacilityDetail']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
