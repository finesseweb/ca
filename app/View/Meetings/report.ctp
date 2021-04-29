    <h2><?php echo __('DAILY MEETING REPORT');  ?></h2> 
	<table cellpadding="0" cellspacing="0">
<thead>
<tr><td colspan="11">Daily Report As On <?=$displaydata?></td></tr>
<tr><td colspan="4">TOTAL</td><td colspan="7"><?=count($data)?></td></tr>
<tr><td colspan="11"><? //echo $this->requestAction(array('controller'=>'meetings','action'=>'meetingStatusCounter',$yesterday));?></td></tr>
<tr>
<td>Executive</td>
<td>Project Name</td>
<td>Timings</td>
<td>Client</td>
<td>Meeting Place</td>
<td>Representative	</td>
<td>Status	</td>
<td> Response </td>
<td> First Response </td>
<td> Form Received</td>
<td> Lead Repeat </td>
</tr>
</thead>
<tbody>
<? if(!empty($data)) { foreach($data as $value) { ?>
<tr>
<td><?=$value['User']['username']?></td>
<td><?=$value['Project']['name']?></td>
<td><?=$value['Meeting']['timing']?></td>
<td><?=$value['Meeting']['client_name']?></td>
<td><?=$value['Meeting']['meeting_place']?></td>
<td><?=$value['Meeting']['representative']?></td>
<td><?=$value['Meeting']['status']?></td>
<td><?=$value['Meeting']['response']?></td>
<td><?=$value['Meeting']['first_response']?></td>
<td><?=$value['Meeting']['form_received']?></td>
<td><?=$value['Meeting']['form_repeat']?></td>
</tr>
<?  } ?>
<tr><td colspan="11">No more records found.</td></tr>
<? }  ?>
</tbody>
</table>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('date'));	
</script>