<?php
foreach ($data as $row):
	foreach ($row['User'] as &$cell):
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['User']) . "\n";
endforeach;	
?>