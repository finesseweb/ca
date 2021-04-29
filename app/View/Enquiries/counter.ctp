<h2><?php echo __('TODAY COUNTER');  ?></h2> 
<div class="table-responsive"><table class="table table-hover table-condensed" id="resultTable">
<tr>
<th>Executive</td>
<th>No Of Queries</td>
</tr> 
<? $count=0; if(!empty($data)) { foreach ($data as $dta): 
$count+=$dta[0]['total'];
?>
<tr>
<td><a href="javascript:void(0);" class="more" data-id="<?=$dta['User']['id']?>"><?php echo h($dta['User']['name']." ".$dta['User']['last_name']); ?></a></td>
<td><?php echo h($dta[0]['total']); ?></td>
</tr>
<? endforeach;  ?> 
<?  } if((CakeSession::read('User.type')=='regular') and CakeSession::read('User.parent')==0) 
{ $getUserOnParentCommaSeprated=$this->requestAction(array('controller'=>'users','action'=>'getCommaSeprated',CakeSession::read('User.id'))); 

if(!empty($getUserOnParentCommaSeprated)) { 
foreach($getUserOnParentCommaSeprated as $key=>$user)
{
$data2=$this->requestAction(array('controller'=>'enquiries','action'=>'counterOnparent',$user['User']['id']));


if(!empty($data2)) { foreach ($data2 as $dta2){ 
$count+=$dta2[0]['total'];
?>

<tr>
<td><a href="javascript:void(0);" class="more" data-id="<?=$dta2['User']['id']?>"><?php echo h($dta2['User']['name']." ".$dta2['User']['last_name']); ?></a></td>
<td><?php echo h($dta2[0]['total']); ?></td>
</tr>

<?
}
}
}

}
?> 



<? }else { ?> 



<? } ?>
<tr><th>TOTAL</th><th colspan="2"><? echo $count; ?></th></tr> 

</table></div>
<div id="showmore"></div>
<script type="text/javascript">
$(document).ready(function(){
$(".more").click(function(){

$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");


$("#showmore").html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
var c=$(this).attr('data-id');
$.ajax({url:"<?=SITE_PATH?>enquiries/counterDetails/"+c,success:function(result){$("#showmore").html(result);}});

});
});
</script>