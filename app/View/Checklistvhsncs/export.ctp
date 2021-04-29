<?php

$cell='';$remark='';
if(!empty($data)) {
foreach ($headers as $head):
 
$cell .= '"' . preg_replace('/"/','""',$head['Id']) . '"'.',"' . preg_replace('/"/','""',$head['District']) . '"'.',"' . preg_replace('/"/','""',$head['Block']) . '"'.',"' . preg_replace('/"/','""',$head['Panchayat']) . '"'.',"' . preg_replace('/"/','""',$head['VHSNC Name']) . '"'.',"' . preg_replace('/"/','""',$head['Date']) . '"'.',"' . preg_replace('/"/','""',$head['Name of Monitor']) . '"'.',"' . preg_replace('/"/','""',$head['Question']) . '"'.',"' . preg_replace('/"/','""',$head['Answer']) . '","' . preg_replace('/"/','""',$head['Status']). '"';
$cell .="\n";
endforeach;	
foreach ($data as $enquiry):
 
$cell .= '"' . preg_replace('/"/','""',$enquiry['Checklistvhsnc']['id']) . '"'.',"' . preg_replace('/"/','""',$enquiry['City']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Block']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Panchayat']['name']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Checklistvhsnc']['vhsnc_name']) . '"'.',"' . preg_replace('/"/','""',date('d-m-Y',strtotime($enquiry['Checklistvhsnc']['meeting_date']))) . '"'.',"' . preg_replace('/"/','""',$enquiry['Checklistvhsnc']['name_of_monitor']) . '"'.',"' . preg_replace('/"/','""',$enquiry['Subfeedback']['name']) .'"'.',"' .preg_replace('/"/','""',$enquiry['Checklistvhsnc']['response']). '","' .preg_replace('/"/','""',$enquiry['Checklistvhsnc']['status']). '"';
$cell .="\n";

endforeach;	
echo $cell;	
}
else
{
echo "NO MORE DATA FOUND";
}



?>
