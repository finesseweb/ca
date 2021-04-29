<div class="bookings form">
<?php echo $this->Form->create('Booking',array("enctype"=>"multipart/form-data")); ?>
	<fieldset>
		<legend><?php echo __('Upload Booking Form'); ?></legend>
        <div class="edit_author">
        
	<?php
	echo "<table>";
	echo "<tr><td width='30%'>".$this->Form->input('booking_pdf_new',array('type'=>'file','required')).$this->Form->input('booking_pdf',array('type'=>'hidden'))."</td></tr></table>";
	?>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<? if($this->request->data['Booking']['booking_pdf']) { ?><div class="actions">
<iframe src="<?=SITE_PATH?>bookingform/<?=$this->request->data['Booking']['booking_pdf']?>" width="1024" height="700"></iframe>
</div><? } ?>
