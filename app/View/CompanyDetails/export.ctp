<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['NGO']) . '"'.',"' . preg_replace('/"/','""',$head['Abbreviation']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Chief Functionary Name']) . '"'.',"' . preg_replace('/"/','""',$head['Designation']) . '"'.',"' . preg_replace('/"/','""',$head['Mobile']) . '"'.',"' . preg_replace('/"/','""',$head['Email']) . '"'.',"' . preg_replace('/"/','""',$head['Project Email ID']) . '"'.',"' . preg_replace('/"/','""',$head['House/Street']) . '"'.',"' . preg_replace('/"/','""',$head['Post Office']) . '"'.',"' . preg_replace('/"/','""',$head['City']) . '"'.',"' . preg_replace('/"/','""',$head['State']) . '"'.',"' . preg_replace('/"/','""',$head['Pincode']) . '"'.',"' . preg_replace('/"/','""',$head['House/Street(Correspondence)']) . '"'.',"' . preg_replace('/"/','""',$head['Post Office']) . '"'.',"' . preg_replace('/"/','""',$head['City']) . '"'.',"' . preg_replace('/"/','""',$head['State']) . '"'.',"' . preg_replace('/"/','""',$head['Pincode']) . '"'.',"' . preg_replace('/"/','""',$head['FCRA Number']) . '"'.',"' . preg_replace('/"/','""',$head['FCRA Registration Date']) . '"'.',"' . preg_replace('/"/','""',$head['FCRA Registration Valid Till']) . '"'.',"' . preg_replace('/"/','""',$head['Society Registration No']) . '"'.',"' . preg_replace('/"/','""',$head['Society Registration Date']) . '"'.',"' . preg_replace('/"/','""',$head['FCRA Bank Account No']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Bank']) . '"'.',"' . preg_replace('/"/','""',$head['IFSC']) . '"'.',"' . preg_replace('/"/','""',$head['Branch']) . '"'.',"' . preg_replace('/"/','""',$head['Project Name']) . '"'.',"' . preg_replace('/"/','""',$head['Agreement No']) . '"'.',"' . preg_replace('/"/','""',$head['Date of Signing the agreement']) . '"'.',"' . preg_replace('/"/','""',$head['Project Start Date']) . '"'.',"' . preg_replace('/"/','""',$head['Project End Date']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
$cell .= '"' . preg_replace('/"/','""',$enquiry['Ngo']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_ngo']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['abbreviation']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['b1']['name'].' '.$enquiry['b2']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name'].' '.$enquiry['User']['last_name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Designation']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['mobile_one'].' '.$enquiry['Ngo']['mobile_two']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['email_id']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['project_emailid']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['permanent_address']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['post_office_p']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['district_p']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['state_p']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['permanent_pincode']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['correspondence_address']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['post_office_c']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['district_c']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['state_c']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['correspondence_pincode']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['fcra_number']) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['fcra_registration_date']))) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['fcra_registration_valid_till']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['society_registration_no']) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['society_registration_date']))) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['fcra_bank_ac_no']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['name_of_bank']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['ifsc']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['branch']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['project_name']) .'"'.',"' . preg_replace('/"/','""',$enquiry['Ngo']['agreement_no']) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['agreement_sign_date']))) .'"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['project_start_date']))) .'"'.',"' .preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Ngo']['project_end_date']))). '","' .preg_replace('/"/','""',$enquiry['Ngo']['status']). '"';
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
