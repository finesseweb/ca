<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php /*?><li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Booking.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Booking.id'))); ?></li><?php */?>
<?php echo $this->Html->link(__('List Bookings'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Booking'); ?>
<fieldset>
<legend><?php echo __('Edit Applicant Details'); ?></legend>
<div class="row">

<?php
$res='';
$start=0.25;
$result='';
$result["0"]='Percentage';
for($start;$start<=15;$start=$start+0.25){ $result[]=$start; }
$result['4.73']='4.73';
//print_r($result);
$res = array_combine($result, $result);

$applicant_title = array("1"=>"None","2"=>"Mr.","3"=>"Ms.","4"=>"Mrs.","5"=>"Dr.","6"=>"Prof.","7"=>"M/s");
echo "<div class='col-sm-12'><div class='radio'>".$this->Form->input('customer_profile_given',array('type'=>'radio','options'=>array('Yes'=>'YES','NO'=>'NO')))."</div></div>";
//print_r($countries);
echo "<div class='col-sm-12'><div class='table-responsive'><table class='table table-hover table-condensed'>";
echo "<tr><td><div class='col-sm-3'>".$this->Form->input('id').$this->Form->input('applicant_title',array('class' => 'form-control','label'=>'','type'=>'select','options'=>array($applicant_title)))."</div><div class='col-sm-9'>".$this->Form->input('applicant_name1',array('class' => 'form-control'))."</td><td>".$this->Form->input('anniversary',array('class' => 'form-control','type'=>'text','onFocus'=>'showDate("BookingAnniversary")'))."</td><td>".$this->Form->input('profession',array('class' => 'form-control'),array('type'=>'text'))."</td></tr>";

echo "<tr><td>".$this->Form->input('country',array('class' => 'form-control','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td><td>".$this->Form->input('company_name',array('class' => 'form-control'))."</td><td>".$this->Form->input('state',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('designation',array('class' => 'form-control'))."</td><td>".$this->Form->input('city',array('class' => 'form-control'))."</td><td>".$this->Form->input('pancard',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('street_address',array('class' => 'form-control'))."</td><td>".$this->Form->input('applicant_email',array('class' => 'form-control'))."</td><td>".$this->Form->input('applicant_email2',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('mobile',array('class' => 'form-control'))."</td><td>".$this->Form->input('mobile2',array('class' => 'form-control'))."</td><td>".$this->Form->input('office_state',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('office_country',array('class' => 'form-control','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td><td>".$this->Form->input('office_street_address',array('class' => 'form-control'))."</td><td>".$this->Form->input('office_city',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('date_of_birth',array('class' => 'form-control','type'=>'text','onFocus'=>'showDate("BookingDateOfBirth")'))."</td><td>".$this->Form->input('budjet',array('class' => 'form-control'))."</td><td>".$this->Form->input('zip',array('class' => 'form-control'))."</td></tr>";

echo "<tr><td>".$this->Form->input('office_zip',array('class' => 'form-control'))."</td><td></td><td></td></tr>";

echo "</table></div></div>";

echo '<h3>Joint Applicant1 Details : <span style="cursor:pointer" class="showhide" data-id="applicant1" show-id="show">[+]</span> </h3>'; 

echo "<div class='col-sm-12'><div class='table-responsive'><table class='table table-hover table-condensed' style='display:none' id='applicant1'>";

echo "<tr><td><div class='col-sm-3'>".$this->Form->input('joint_title',array('class' => 'form-control','label'=>'','type'=>'select','options'=>array($applicant_title)))."</div><div class='col-sm-9'>".$this->Form->input('join_applicant',array('class' => 'form-control'))."</div></td><td>".$this->Form->input('joint_anniversary',array('class' => 'form-control','label'=>'Anniversary','type'=>'text','onFocus'=>'showDate("BookingJointAnniversary")'))."</td><td>".$this->Form->input('joint_app_profess_id',array('class' => 'form-control','type'=>'text','label'=>'Profession'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_country',array('class' => 'form-control','label'=>'Country','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td><td>".$this->Form->input('joint_company_name',array('class' => 'form-control'),array('label'=>'Company'))."</td><td>".$this->Form->input('joint_state',array('class' => 'form-control'),array('label'=>'State',array('class' => 'form-control')))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_designation',array('class' => 'form-control'),array('label'=>'Designation'))."</td><td>".$this->Form->input('joint_city',array('class' => 'form-control'),array('label'=>'City'))."</td><td>".$this->Form->input('joint_pancard',array('class' => 'form-control'),array('label'=>'Pancard'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_street_address',array('class' => 'form-control'),array('label'=>'Street Address'))."</td><td>".$this->Form->input('joint_email',array('class' => 'form-control'),array('label'=>'Email'))."</td><td>".$this->Form->input('joint_email2',array('class' => 'form-control'),array('label'=>'2nd Email'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_mobile',array('class' => 'form-control'),array('label'=>'Mobile'))."</td><td>".$this->Form->input('joint_mobile2',array('class' => 'form-control'),array('label'=>'Mobile 2'))."</td><td>".$this->Form->input('joint_office_state',array('class' => 'form-control'),array('label'=>'2nd address'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_office_country',array('class' => 'form-control','label'=>'2nd Country','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td><td>".$this->Form->input('joint_office_street_address',array('class' => 'form-control'),array('label'=>'2nd Address'))."</td><td>".$this->Form->input('joint_office_city',array('class' => 'form-control'),array('label'=>'2nd City'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint_date_of_birth',array('class' => 'form-control','label'=>'Date of birth','type'=>'text','onFocus'=>'showDate("BookingJointDateOfBirth")'))."</td><td>".$this->Form->input('joint_zip',array('class' => 'form-control'),array('label'=>'Zip'))."</td><td>".$this->Form->input('joint_office_zip',array('class' => 'form-control'),array('label'=>'2nd Zip'))."</td></tr>";

echo "</table></div></div>";

echo '<h3>Joint Applicant2 Details : <span style="cursor:pointer" class="showhide" data-id="applicant2" show-id="show">[+]</span> </h3>'; 

echo "<div class='col-sm-12'><div class='table-responsive'><table class='table table-hover table-condensed' style='display:none' id='applicant2'>";

echo "<tr><td>".$this->Form->input('join2_applicant',array('class' => 'form-control'))."</td><td>".$this->Form->input('joint2_country',array('class' => 'form-control','label'=>'Country','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td><td>".$this->Form->input('joint2_profession',array('class' => 'form-control'),array('type'=>'text','label'=>'Profession'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_state',array('class' => 'form-control'),array('label'=>'State'))."</td><td>".$this->Form->input('joint2_company_name',array('class' => 'form-control'),array('label'=>'Company'))."</td><td>".$this->Form->input('joint_city2',array('class' => 'form-control'),array('label'=>'City'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_designation',array('class' => 'form-control'),array('label'=>'Designation'))."</td><td>".$this->Form->input('joint_street2_address',array('class' => 'form-control'),array('label'=>'Street Address'))."</td><td>".$this->Form->input('joint2_pancard',array('class' => 'form-control'),array('label'=>'Pancard'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_zip',array('class' => 'form-control'),array('label'=>'Zip'))."</td><td>".$this->Form->input('joint_email2',array('class' => 'form-control'),array('label'=>'Email'))."</td><td>".$this->Form->input('joint2_office_country',array('class' => 'form-control','label'=>'2nd Country','type'=>'select','options'=>array(''=>'Select Country',$countries)))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_email2',array('class' => 'form-control'),array('label'=>'2nd Email'))."</td><td>".$this->Form->input('joint2_office_state',array('class' => 'form-control'),array('label'=>'2nd address'))."</td><td>".$this->Form->input('joint_mobile2',array('class' => 'form-control'),array('label'=>'Mobile'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_office_city',array('class' => 'form-control'),array('label'=>'2nd City'))."</td><td>".$this->Form->input('joint2_mobile2',array('class' => 'form-control'),array('label'=>'2nd Mobile'))."</td><td>".$this->Form->input('joint2_office_street_address',array('class' => 'form-control'),array('label'=>'2nd Address'))."</td></tr>";

echo "<tr><td>".$this->Form->input('joint2_date_of_birth',array('class' => 'form-control','label'=>'Date of birth','type'=>'text','onFocus'=>'showDate("BookingJoint2DateOfBirth")'))."</td><td>".$this->Form->input('joint2_office_zip',array('class' => 'form-control'),array('label'=>'2nd Zip'))."</td><td>".$this->Form->input('joint2_anniversary',array('class' => 'form-control','label'=>'Anniversary','type'=>'text','onFocus'=>'showDate("BookingJoint2Anniversary")'))."</td></tr>";

echo "</table></div></div>";

/*echo '<h3>Joint Applicant3 Details : <span style="cursor:pointer" class="showhide" data-id="applicant3" show-id="show">[+]</span> </h3>'; 
echo "<table style='display:none' id='applicant3'>";
echo "</table>";*/
?>
</div>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2; 
function showDate(id)
{ 
new Epoch('epoch_popup','popup',document.getElementById(id));	
}


$(".showhide").click(function()
{
var attr2=$(this).attr('data-id');
var attr=$(this).attr('show-id');
if(attr=="show"){
$('#'+attr2).show();
$(this).text("[-]");
$(this).attr('show-id','hide');
} 
else
{
$('#'+attr2).hide();
$(this).text("[+]");
$(this).attr('show-id','show');
}
})
</script>
