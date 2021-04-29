<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsnc['MembersTraining']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Village']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Members type'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['members_type'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Member Name'); ?></td>
<td>
    <?php if($vhsnc['MembersTraining']['members_type']=='AFC') {
       $mem= explode(',',$vhsnc['MembersTraining']['member_name']) ;
       foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"vhsncAfcs","action"=>"getmems",$m)); 
                 //print_r($questionlist);
                  echo ucwords($questionlist['VhsncAfc']['member_name'].' ');
}

    }
    else {
         $mem= explode(',',$vhsnc['MembersTraining']['member_name']) ;
       foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"vhsncMembers","action"=>"getmems",$m)); 
                 //print_r($questionlist);
                  echo ucwords($questionlist['VhsncMember']['member_name'].' ');
}

    }
?>
<?php //echo h(ucfirst($vhsnc['MembersTraining']['member_name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Induction Training Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['MembersTraining']['induction_training_date']))); ?>
&nbsp;
</td>
</tr>
<!--<tr>
<td><?php echo __('Refresher Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['MembersTraining']['refresher_date']))); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['status'])); ?>
&nbsp;
</td>
</tr>


<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
