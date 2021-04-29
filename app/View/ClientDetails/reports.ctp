
<? $allparentids=@implode('##',$users);?>
<h2><?php echo __('Geography Details'); ?></h2>
<div class="btn-group">
<?php echo $this->Html->link(__('Back'), array('controller' => 'users','action' => 'welcome'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('NGO'), array('controller' => 'ngos','action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>geographicals/reports/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="BY Asha name,AWC_worker,Ward,AWC_CODE" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><select name="organization" id="organization" class="form-control">
<option value="">Select NGO</option>
<?php foreach ($ngos as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['organization']) && $this->params->query['organization']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="block" id="block" class="form-control">
<option value="">Select Block</option>
<?php foreach ($blocks as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['block']) && $this->params->query['block']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="panchayat[]" id="panchayat" class="form-control" multiple="multiple">
<option value="">Select Panchayat</option>
<?php foreach ($panchayats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="village" id="village" class="form-control">
<option value="">Select Village</option>
<?php if(!empty($villages)) { foreach ($villages as $key2=>$village){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['village']) && $this->params->query['village']==$key2) { ?> selected="selected"<? } ?>><? echo $village; ?></option>
<? } } ?>
</select></div>

<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>geographicals/reports'"/></div>
<?php //if(CakeSession::read('User.type')==='admin'){?>
<!--<div class="col-sm-1" style="float:right;"><input type="button" name="reset" value="export" class="btn btn-block" onclick="window.open('<?=SITE_PATH?>geographicals/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>-->
<?php //} ?>
<input type="hidden" value="Geography" id="gettitle">
</form>
</div>
</div>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Organization</th>
                <th>District</th>
                <th>Block</th>
                <th>Panchayat</th>
                <th>Village</th>
                <th>Ward</th>
                 <th>Household</th>
                <th>Population</th>
                <th>Ward Member Name</th>
                <th>Ward Member Mobile</th>
                <th>AWC Code</th>
                <th>AWW Name</th>
                <th>AWW Mobile No</th>
                 <th>ASHA Name</th>
                <th>ASHA Mobile No</th>
                <th>PHC Name</th>
                <th>APHC Name</th>
                <th>HSC Name</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($geographicals as $geographical): ?>
            <tr>
<td><?php echo h($geographical['Geographical']['id']); ?></td>
<td><?php echo h(ucfirst($geographical['Ngo']['name_of_ngo'])); ?></td>
<td><?php echo h(ucfirst($geographical['City']['name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Block']['name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Panchayat']['name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Village']['name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Ward']['name'])); ?></td>
<td><?php echo h($geographical['Geographical']['no_of_house']); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['population'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['ward_member_name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['ward_member_mobile'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['awc_code'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['aww_name'])); ?></td>
<td><?php echo h($geographical['Geographical']['aww_mobile']); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['asha_name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['asha_mobile'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['phc_name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['aphc_name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Geographical']['hsc_name'])); ?></td>
            </tr>
           <?php endforeach; ?>
           
           
            
        </tbody>
        
    </table>



<!--</div>-->
<?php /*?><div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?>
</ul>
</div><?php */?>





