<?php
$cell='';$remark='';

if(!empty($resales)) {
//foreach ($headers as $head):

$cell .= '"' . preg_replace('/"/','""','Id') . '"'.',"' . preg_replace('/"/','""','Name') . '"'.',"' . preg_replace('/"/','""','Email') . '"'.',"' . preg_replace('/"/','""','Email2') . '"'.',"' . preg_replace('/"/','""','contact') . '"'.',"' . preg_replace('/"/','""','Builder') . '"'.',"' . preg_replace('/"/','""','Project') . '"'.',"' . preg_replace('/"/','""','Executive') . '"'.',"' . preg_replace('/"/','""','Refer Executive Name') . '","' . preg_replace('/"/','""','Second Name'). '","' . preg_replace('/"/','""','Unit Type'). '","' . preg_replace('/"/','""','Unit No'). '","' . preg_replace('/"/','""','Tower'). '","' . preg_replace('/"/','""','Area'). '","' . preg_replace('/"/','""','Floor'). '","' . preg_replace('/"/','""','Booking'). '","' . preg_replace('/"/','""','Demand'). '","' . preg_replace('/"/','""','Plc'). '","' . preg_replace('/"/','""','Paid'). '","' . preg_replace('/"/','""','Budget'). '","' . preg_replace('/"/','""','Property Type'). '","' . preg_replace('/"/','""','Sub Type'). '","' . preg_replace('/"/','""','Country'). '","' . preg_replace('/"/','""','Status'). '","' . preg_replace('/"/','""','Close Reason'). '","' . preg_replace('/"/','""','Lead Source'). '","' . preg_replace('/"/','""','Sector'). '","' . preg_replace('/"/','""','Sector Other'). '","' . preg_replace('/"/','""','Query'). '"';
$cell .="\n";

//endforeach;	
foreach ($resales as $enquiry):

$cell .= '"' . preg_replace('/"/','""',$enquiry['Resale']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Resale']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Resale']['email']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Resale']['email2']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Resale']['contact']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Builder']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Project']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['User']['name']) . '"'.',"' .preg_replace('/"/','""',$enquiry['Resale']['refer_to']). '","' .preg_replace('/"/','""',$enquiry['Resale']['second_name']). '","' .preg_replace('/"/','""',$enquiry['Resale']['unit_type']). '","' .preg_replace('/"/','""',$enquiry['Resale']['unit_no']). '","' .preg_replace('/"/','""',$enquiry['Resale']['tower']). '","' .preg_replace('/"/','""',$enquiry['Resale']['area']). '","' .preg_replace('/"/','""',$enquiry['Resale']['floor']). '","' .preg_replace('/"/','""',$enquiry['Resale']['booking']). '","' .preg_replace('/"/','""',$enquiry['Resale']['demand']). '","' .preg_replace('/"/','""',$enquiry['Resale']['plc']). '","' .preg_replace('/"/','""',$enquiry['Resale']['paid']). '","' .preg_replace('/"/','""',$enquiry['Resale']['budget']). '","' .preg_replace('/"/','""',$enquiry['PropertyType']['name']). '","' .preg_replace('/"/','""',$enquiry['Resale']['sub_type']). '","' .preg_replace('/"/','""',$enquiry['Country']['name']). '","' .preg_replace('/"/','""',$enquiry['Resale']['status']). '","' .preg_replace('/"/','""',$enquiry['CloseReason']['name']). '","' .preg_replace('/"/','""',$enquiry['LeadSource']['name']). '","' .preg_replace('/"/','""',$enquiry['Sector']['name']). '","' .preg_replace('/"/','""',$enquiry['Resale']['sector_other']). '","' .preg_replace('/"/','""',$enquiry['Resale']['query']). '"';
$cell .="\n";

// '","' .$remark.
endforeach;	

echo $cell;	
}
else
{
	echo "NO MORE DATA FOUND";
	}
?>
