<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<style>
    .col-sm-2{
        width:19%!important;
    }
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Adolescent Meeting'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List  VHSNC Constitution Details'), array('controller' => 'vhsncConstitutions','action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('AdolescentMeeting'); ?>
<fieldset>
<legend><?php echo __(' Adolescent Meeting'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('date1',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'  style='display:none'>".$this->Form->input('date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('Y-m-d'),'readonly'=>'readonly'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('group_name',array('class'=>'calbsp form-control','label'=>'Group Name','options'=>array(''=>'--select--',$group)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('total_member',array('class' => 'form-control','label'=>'Total Member','readonly'=>'readonly'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('no_of_participants',array('class'=>'calbsp form-control','label'=>'No. of Participants'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated_by',array('class' => 'form-control','label'=>'Meeting Facilitated By','options'=>array(''=>'Select Member',$facilitated)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('topic_discussed',array('class'=>'calbsp form-control','label'=>'Topic Discussed','options'=>array(''=>'Select Topic',$topic)))."</div>";
echo "<div class='col-sm-3' id='other'>".$this->Form->input('others_topic',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('material_used',array('class' => 'form-control','label'=>'Material Used','options'=>array(''=>'Select',$marerial)))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control','label'=>'Remarks'))."</div>";



?>
<?php 
//echo "<a href='#' class='btn btn-primary' id='ajaxsubmit'>Submit</a>";
echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
     <?php if($sessionval!='regular') { ?>
$("#AdolescentMeetingDistrict").change(function(){
var c=$(this).val();
$('#AdolescentMeetingBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#AdolescentMeetingBlock").html(result);}});

});
<?php } ?>
<?php if($sessionrole!='CC') { ?>
$("#AdolescentMeetingBlock").change(function(){
var c=$(this).val();
$('#AdolescentMeetingPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#AdolescentMeetingPanchayat").html(result);}});

});
 <?php } ?>
$("#AdolescentMeetingPanchayat").change(function(){
var c=$(this).val();
$('#AdolescentMeetingVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#AdolescentMeetingVillage").html(result);}});

});
    
$("#AdolescentMeetingVillage").change(function(){
var c=$(this).val();
//alert(c);
$('#AdolescentMeetingGroupName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>youthleaders/getgroup/"+c,success:function(result){$("#AdolescentMeetingGroupName").html(result);}});
$.ajax({url:"<?=SITE_PATH?>youthleaders/getcount/"+c,success:function(result){
       // alert(result);
            $("#AdolescentMeetingTotalMember").val(result);}});

});

//$("#AdolescentMeetingDate").click( function(e) {
// $('#AdolescentMeetingDate').attr('type', 'date');
//    });
// 
 
 $("#other").hide();
 
$("#AdolescentMeetingTopicDiscussed").change(function() {
   var c=$(this).val();
   if(c==25) {
$("#other").show();
   }
  else {
$("#other").hide();
   }
});  
    
});



</script>
<!--<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            var dt=1;
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-4"><label>Name</label><select class="form-control name" name="data[VhsncMember][member_name][]"></select></div>\
                <div class="col-sm-4"><label>Mobile</label><input class="form-control mobile" type="text" name="data[VhsncMember][mobile][]" readonly></div>\
               <a href="#" id="remove" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       
        jQuery(this).parent().remove();
        return false;
        });

 $("#append").click( function() {
$('.desig').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$(".desig").html(result);}});
});

$("#append").click( function() {
$('.name').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getvhsnc/",success:function(result){$(".name").html(result);}});
});

  });

 
    
 // $("#VhsncAfcRefresherDate").click( function(e) {
 //$('#VhsncAfcRefresherDate').attr('type', 'date');
 //   });  
        
    
$("#AfcHomeVisitAddForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               
                   setTimeout(function () {
                   $( "#contactform" ).load(window.location.href + " #contactform" );//will redirect to your blog page (an ex: blog.html)
                  }, 2000); //will call the function after 2 secs.

               
            
               //alert(data); // show response from the php script.
           }
         });


});
</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#VhsncMemberTotalMembers').val();
            num++ ;
                    $('#VhsncMemberTotalMembers').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#VhsncMemberTotalMembers').val();
            num-- ;
                    $('#VhsncMemberTotalMembers').val(num);
        });
        
    jQuery(document).on('change', '.name', function() {
         var c=$(this).val();
           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmobile/"+c,success:function(result){$(".mobile").val(result);}});
        });     

    });
    
    $("#VhsncMemberName").change( function() {
            var c=$(this).val();
           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmobile/"+c,success:function(result){$("#VhsncMemberMobile").val(result);}});
      
        });
 
    </script>-->