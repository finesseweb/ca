<?php
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
?>
<?php /*?><?

foreach ($data as $row):
	foreach ($row['Enquiry'] as &$cell):
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['Enquiry']) . "\n";
endforeach;

?><?php */?>