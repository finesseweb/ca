<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<style>
    .col-sm-2{
        width:16%!important;
        
        }
    .form-control{
            margin-bottom: 0px!important;
    }
    .tform{
        margin-bottom: 15px!important;
    }
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Daily Reports'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Commonreport'); ?>
<fieldset>
<legend><?php echo __('Daily Report'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo $this->Form->input('user_id',array('class' => 'form-control','type'=>'hidden','value'=>$this->Session->read('User.id')));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'--Select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class' => 'form-control tform','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('date',array('type'=>'text','class'=>'calbsp tform form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('activity',array('class' => 'form-control tform','name'=>'data[Commonreport][activity][]','options'=>array(''=>'Select','field work'=>'Field Work','office work'=>'Office Work','meeting'=>'Meeting','training'=>'Training','others'=>'Others','leave'=>'Leave')))."</div>";
echo "<div class='col-sm-8'>".$this->Form->input('remarks',array('class' => 'form-control tform','type'=>'text','label'=>'Details of Work','name'=>'data[Commonreport][remarks][]'))."</div>";

echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left: 95%;'>+</a></div></div>";


?>
    
<!--    <table class="table table-striped"> 
        <thead>
        <th>Title/Question</th><th>Response</th><th>Remarks</th>
        <tbody>
             <?php foreach($feedbacks as $feedback) {?>
          <tr>
              <td colspan="3"style="background-color: #C0BFBA;"><?=ucwords($feedback['Feedback']['name'])?>
                  <input type="hidden" class="feed" name="data[Commonreport][hidden][]" id="CommonreportHidden" value="<?=$feedback['Feedback']['id']?>">
              </td>
              
              
              <?php  $count=0;
                  
                   $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"getquestion",$feedback['Feedback']['id'])); 
                  
                 foreach($questionlist as $key=>$value) { $count++;  
                 
                 ?>
          <tr class="<?=$value['Subfeedback']['level']?>"><td style="background-color: aliceblue" class="question" id="feedId<?=ucfirst($value['Subfeedback']['id'])?>">
                  <?=$value['Subfeedback']['name']?>
              <input type="hidden" name="data[Commonreport][question_id][]" readonly="readonly" value="<?=ucfirst($value['Subfeedback']['id'])?>">
              
              </td>
              <td style="width: 14%"> <select class="form-control question" name="data[Commonreport][response][]" id="responce<?=ucfirst($value['Subfeedback']['id'])?>">
                   <option value="">p;u djs</option> 
                  <option value="<?=$value['Subfeedback']['responce_one'];?>"> <?=$value['Subfeedback']['responce_one'];?></option> 
                  <option value="<?=$value['Subfeedback']['responce_two'];?>"> <?=$value['Subfeedback']['responce_two'];?> </option>
                  <?php if($value['Subfeedback']['responce_three']!=''){?>
                  <option value="<?=$value['Subfeedback']['responce_three'];?>"> <?=$value['Subfeedback']['responce_three'];?> </option>
                  <?php } ?>
              </select>
          </td>
          <td><input class="form-control question" type="text" name="data[Commonreport][feedback_remarks][]"></td>
          </tr>
          
        <script>
            
            $(document).ready(function(){
               $("#responce<?=ucfirst($value['Subfeedback']['id'])?>").change(function(){
                   var c=$(this).val();
                   if(c=='gkWa'){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","lightgreen");
                        }
                        
                       else if(c=='ugha'){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","#ff7575");
                        }
                        
                        else if(c==''){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","aliceblue");
                        }
                        
                        
                       else {
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","orange");
                        }
                   
               }); 
                
            });
            </script>
                 <?php }?>
            </tr>
    
             <?php } ?>
           
        </tbody>
        </thead> 
        </table>-->
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">



$(document).ready(function(){
    //$('#append').hide(); 
//var c=$(".feed").val();
// 
//$.ajax({url:"<?=SITE_PATH?>subfeedbacks/fetchcat/"+c,success:function(result){$("#getquestons").html(result);}});
 <?php if($sessionval!='regular') { ?>
$("#CommonreportDistrict").change(function(){
var c=$(this).val();
$('#CommonreportBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#CommonreportBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#CommonreportBlock").change(function(){
var c=$(this).val();
$('#CommonreportPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#CommonreportPanchayat").html(result);}});

});
<?php } ?>
$("#CommonreportPanchayat").change(function(){
var c=$(this).val();
//$('#CommonreportVillage').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#CommonreportVillage").html(result);}});
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getname/"+c,success:function(result){$("#CommonreportVhsncName").val(result);}});

});

$("#CommonreportVillage").change(function(){
var c=$(this).val();
$('#CommonreportHealthFacilityName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwc/"+c,success:function(result){$("#CommonreportvhsncAwcCode").html(result);}});

});

$("#CommonreportvhsncHealthFacilityName").change(function(){
var c=$(this).val();
$('#CommonreportvhsncHealthFacilityType').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>facilityDetails/gettype/"+c,success:function(result){$("#CommonreportvhsncHealthFacilityType").html(result);}});

});

//$("#CommonreportvhsncVillage").change(function(){
//var c=$(this).val();
//$('#CommonreportvhsncWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#CommonreportvhsncWard").html(result);}});
//
//});



});
</script>

<script>
jQuery(document).ready( function () {
     var dt=1;
     var n=2
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                 <div class="col-sm-3"><label>Activity <span style="color:red">*</span></label><select name="data[Commonreport][activity][]" class="form-control tform" id="CommonreportActivity'+dt+'" required="required"><option value="">Select</option><option value="field work">Field Work</option><option value="office work">Office Work</option><option value="meeting">Meeting</option><option value="training">Training</option><option value="others">Others</option><option value="leave">Leave</option></select></div>\
                 <div class="col-sm-8"><label>Details of Work</label><input class="calbsp form-control" type="text" id="remarks'+dt+'" name="data[Commonreport][remarks][]"></div>\
                <a href="#" class="remove_this btn btn-danger" id="'+n+'" style="margin-top:18px;">X</a>\
</div>');
    dt++;
    n++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() { 
            jQuery(this).parent().remove();
          
        return false;
        });


  });
     
    

</script>

