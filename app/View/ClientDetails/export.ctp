<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['NGO']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['Village']) . '"'.',"' . preg_replace('/"/','""',$head['Ward']) . '"'.',"' . preg_replace('/"/','""',$head['Household']) . '"'.',"' . preg_replace('/"/','""',$head['Population']) . '"'.',"' . preg_replace('/"/','""',$head['Ward Member Name']) . '"'.',"' . preg_replace('/"/','""',$head['Ward Member Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['AWC Code']) . '"'.',"' . preg_replace('/"/','""',$head['AWW Name']) . '"'.',"' . preg_replace('/"/','""',$head['AWW Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['ASHA Name']) . '"'.',"' . preg_replace('/"/','""',$head['ASHA Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['PHC Name']) . '"'.',"' . preg_replace('/"/','""',$head['APHC Name']) . '"'.',"' . preg_replace('/"/','""',$head['HSC Name']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Geographical']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Village']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ward']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['no_of_house']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['population']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['ward_member_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['ward_member_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['awc_code']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['aww_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['aww_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['asha_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['asha_mobile']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['phc_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Geographical']['aphc_name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Geographical']['hsc_name']). '","' .preg_replace('/"/','""',$enquiry['Geographical']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}


/*
//For Last Remark Export 	
$cell='';$remark='';
//print_r($headers);

foreach ($headers as $head):

$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['Posted On']) . '"'.',"' . preg_replace('/"/','""',$head['Name']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Contact']) . '"'.',"' . preg_replace('/"/','""',$head['Project']) . '"'.',"' . preg_replace('/"/','""',$head['Country']) . '"'.',"' . preg_replace('/"/','""',$head['Status']) . '","' . preg_replace('/"/','""',$head['Lead Source']) . '","' . preg_replace('/"/','""',$head['Remark 3']). '","' . preg_replace('/"/','""',$head['Remark 2']). '","' . preg_replace('/"/','""',$head['Remark 1']). '"';
$cell .="\n";

//'","' . preg_replace('/"/','""',$head['Remark'])
endforeach;	

foreach ($data as $enquiry):
$remark=$this->requestAction(array('controller'=>'remarks','action'=>'lastRemarks',$enquiry['Enquiry']['id']));

$cell .= '"' . preg_replace('/"/','""',$enquiry['Enquiry']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Enquiry']['posted_date']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Enquiry']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Enquiry']['email']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Enquiry']['contact']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Project']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Country']['name']) . '"'.',"' .preg_replace('/"/','""',$enquiry['Enquiry']['status']). '","' .preg_replace('/"/','""',$enquiry['LeadSource']['name']).$remark. '"';
$cell .="\n";

// '","' .$remark.
endforeach;	

echo $cell;		
*/	
?>
