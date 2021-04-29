<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Visit Date']) . '"'.',"' . preg_replace('/"/','""',$head['Is ASHA Accompanied']) . '"'.',"' . preg_replace('/"/','""',$head['ASHA Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Is AWW Accompanied']) . '"'.',"' . preg_replace('/"/','""',$head['AWW Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Is PRI Accompanied']) . '"'.',"' . preg_replace('/"/','""',$head['PRI Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Is SHG Accompanied']) . '"'.',"' . preg_replace('/"/','""',$head['SHG Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Name']) . '"'.',"' . preg_replace('/"/','""',$head['Age']) . '"'.',"' . preg_replace('/"/','""',$head['Gender']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['No of child']) . '"'.',"' . preg_replace('/"/','""',$head['Age of younger child']) . '"'.',"' . preg_replace('/"/','""',$head['Currently using Contraceptives']) . '"'.',"' . preg_replace('/"/','""',$head['If spacing methods Commodities regular supplied']) . '"'.',"' . preg_replace('/"/','""',$head['Commodities Reason']) . '"'.',"' . preg_replace('/"/','""',$head['Counselled by AFC to beneficiary']) . '"'.',"' . preg_replace('/"/','""',$head['Convinced to Opt']) . '"'.',"' . preg_replace('/"/','""',$head['Date for delivery of contraceptives']) . '"'.',"' . preg_replace('/"/','""',$head['Month of Sterilisation']) . '"'.',"' . preg_replace('/"/','""',$head['Follow Visit Date']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
//print_($data);
//die();
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['visit_date']) . '"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['asha_accompanied']) .'"'.',"' . preg_replace('/"/','""',$enquiry['r1']['name1']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['aww_accompanied']) .'"'.',"' . preg_replace('/"/','""',$enquiry['r2']['name2']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['pri_accompanied']) .'"'.',"' . preg_replace('/"/','""',$enquiry['r3']['name3']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['shg_accompanied']) .'"'.',"' . preg_replace('/"/','""',$enquiry['r4']['name4']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['couple_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['age']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['gender']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['no_of_child']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['yonger_child_age']) .'"'.',"' . preg_replace('/"/','""',$enquiry['c1']['name5']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['commodities_regular_supply']) .'"'.',"' . preg_replace('/"/','""',$enquiry['r5']['name8']) .'"'.',"' . preg_replace('/"/','""',$enquiry['c2']['name6']) .'"'.',"' . preg_replace('/"/','""',$enquiry['c3']['name7']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['contraceptives_delivery_date']) .'"'.',"' . preg_replace('/"/','""',$enquiry['AfcHomeVisit']['sterilisation_of_month']) .'"'.',"' .preg_replace('/"/','""',$enquiry['AfcHomeVisit']['follow_visit_date']). '","' .preg_replace('/"/','""',$enquiry['AfcHomeVisit']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
