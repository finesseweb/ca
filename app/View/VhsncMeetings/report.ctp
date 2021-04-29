<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group"><?php echo $this->Html->link(__('New Booking'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?></div>

<div class="panel panel-default">
<div class="panel-body">
<?php //echo $this->Form->create('Booking',array("enctype"=>"multipart/form-data")); ?>
<fieldset>
<legend><?php echo __('Report Section'); ?></legend>
<div class="row">
<div class="col-sm-3">
<form action="<?=SITE_PATH?>bookings/detailedReport/" method="get" name="detail" enctype="multipart/form-data">
<table class="table table-striped">
<tr><td colspan="2"> <b>Detailed Report </b></td></tr>
<tr>
<td class="forty">Select Type</td>
<td>
<select name="type" id="type" class="form-control"  onchange="changetype(this.options[this.selectedIndex].value,this.form,'category');">
<option value="-1">Select Type</option>
<option value="all">All</option>
<option value="bulider">Bulider</option>
<option value="executive">Executive</option>
<option value="location">Location</option>
<option value="cheque">Cheque Status</option>
<option value="bookingstatus">Booking Status</option>
</select></td>
</tr>

<tr>
<td>Select Category</td>
<td>
<select name="category" class="form-control" onChange="rrr(this.options[this.selectedIndex].value,this.form,'subcategory');">
<option value="0">Select category</option>
</select></td>
</tr>

<tr>
<td>Select Project</td>
<td id="rricha"><select name="subcategory" class="form-control">
<option value="0">Select</option>
</select></td>
</tr>
<tr><td colspan="2">Select The Duration</td></tr>
<tr><td>From</td>
<td><input name="fdate" type="text" class="form-control" id="fdate" value="" size="20" /></td></tr>
<tr><td>To </td> 
<td><input name="ldate" type="text" class="form-control" id="ldate"  size="20" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="View Report" class="btn btn-success" onClick="return validationdetail()"  /></td>
</tr>
</table>
</form>
</div>
<div class="col-sm-3">
<form action="<?=SITE_PATH?>bookings/builderReport/" method="get" name="detail" enctype="multipart/form-data">
<table class="table table-striped">
<tr><td colspan="2"> <b>Builder Summary Report </b></td></tr>
<tr>
<td class="forty">Select Type</td>
<td><select name="type" class="form-control"  onchange="changetype(this.options[this.selectedIndex].value,this.form,'category');">
<option value="-1">Select Type</option>
<option value="all">All</option>
<option value="bulider">Bulider</option>
<option value="executive">Executive</option>
<option value="location">Location</option>
<option value="cheque">Cheque Status</option>
<option value="bookingstatus">Booking Status</option>
</select></td>
</tr>
<tr>
<td>Select Category</td>
<td><select name="category" class="form-control" onChange="rrr(this.options[this.selectedIndex].value,this.form,'subcategory');">
<option>Select category</option>
</select></td>
</tr>

<tr style="display:none;" id="rricha">
<td>Select Project</td>
<td>
<select name="subcategory" class="form-control">
<option>Select</option>
</select>
</td>
</tr>

<tr>
<td>From</td>
<td> <input name="hfdate" type="text" id="hfdate" class="form-control" value="" /></td>
</tr>

<tr>
<td>To</td>
<td><input name="hldate" type="text" id="hldate" class="form-control" value="" /></td>
</tr>

<tr>
<td colspan="2">
<input type="submit" name="submit" value="View Report" class="btn btn-success" onClick="return validationdetail()"  />
</td>

</tr>
</table>
</form>
</div>
<div class="col-sm-3">
<form action="<?=SITE_PATH?>bookings/summaryReport/" method="get" name="detail" enctype="multipart/form-data">
<table class="table table-striped">
<tr><td colspan="2"> <b> Lead Summary Report </b></td></tr>
<?php /*?><tr>
<td height="40px">Select The Duration</td><td></td>
</tr><?php */?>
<tr>
<td class="forty">From</td>
<td> <input name="sfdate" type="text" id="sfdate" class="form-control" value="" /></td>
</tr>

<tr>
<td>To</td>
<td><input name="sldate" type="text" id="sldate" class="form-control" value="" /></td>
</tr>

<tr>
<td colspan="2">
<input type="submit" name="summary" class="btn btn-success" value="Show Summary"/>
</td>

</tr>
</table>
</form>
</div>
<div class="col-sm-3">
<form action="<?=SITE_PATH?>bookings/applicantdetail/" method="get" name="detail" enctype="multipart/form-data">
<table class="table table-striped">
<tr><td colspan="2"> <b> Booking Applicant Personal Details </b></td></tr>
<?php /*?><tr>
<td height="40px">Select The Duration</td><td></td>
</tr><?php */?>
<tr>
<td class="forty">From</td>
<td> <input name="afdate" type="text" id="afdate" class="form-control" value="" /></td>
</tr>

<tr>
<td>To</td>
<td><input name="aldate" type="text" id="aldate" class="form-control" value="" /></td>
</tr>
<tr>
<td class="forty">Select Category </td>
<td>
<select name="type" id="type2" class="form-control"  onchange="changetype(this.options[this.selectedIndex].value,this.form,'category');">
<option value="-1">Select Type</option>
<option value="bulider">Bulider</option>

</select></td>
</tr>
<tr>
<td>Select Builder</td>
<td>
<select name="category" class="form-control" onChange="rrrrr(this.options[this.selectedIndex].value,this.form,'subcategory');">
<option value="0">Select category</option>
</select></td>
</tr>
<tr>
<td>Select Project</td>
<td id=""><select name="subcategory" class="form-control">
<option value="0">Select</option>
</select></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="summary" class="btn btn-success" value="View Details"/>
</td>

</tr>
</table>
</form>
</div>
</div>
</fieldset>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
new Epoch('epoch_popup','popup',document.getElementById('fdate'));	
new Epoch('epoch_popup','popup',document.getElementById('ldate'));	

new Epoch('epoch_popup','popup',document.getElementById('hfdate'));	
new Epoch('epoch_popup','popup',document.getElementById('hldate'));

new Epoch('epoch_popup','popup',document.getElementById('sfdate'));	
new Epoch('epoch_popup','popup',document.getElementById('sldate'));

new Epoch('epoch_popup','popup',document.getElementById('afdate'));	
new Epoch('epoch_popup','popup',document.getElementById('aldate'));
</script><script type="text/javascript">

function showHideStatus(sId,anchorImgId,sImagePath)
{
oObj = eval(document.getElementById(sId));
if(oObj.style.display == 'block')
{
oObj.style.display = 'none';
eval(document.getElementById(anchorImgId)).src =  'themes/images/inactivate.gif';
eval(document.getElementById(anchorImgId)).alt = 'Display';
eval(document.getElementById(anchorImgId)).title = 'Display';
}
else
{
oObj.style.display = 'block';
eval(document.getElementById(anchorImgId)).src = 'themes/images/activate.gif';
eval(document.getElementById(anchorImgId)).alt = 'Hide';
eval(document.getElementById(anchorImgId)).title = 'Hide';
}
}

function sendfile_email()
{
filename = $('dldfilename').value;
document.DetailView.submit();
OpenCompose(filename,'Documents');
}

</script>


<script language="javascript" type="text/javascript">
function changetype(val,frm,opt)
{
if(val==-1)
{
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
frm[opt][frm[opt].length]=new Option("-- Select Menu --", "0", "", false);
return false;
}		
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
var xmlHttpReq = false;

// Mozilla/Safari
if (window.XMLHttpRequest)
{
xmlHttpReq = new XMLHttpRequest();
}
// IE
else if (window.ActiveXObject)
{
xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlHttpReq.onreadystatechange = function()
{
if (xmlHttpReq.readyState == 4)
{
//alert(xmlHttpReq.responseText);
var text1=xmlHttpReq.responseText;
var optdata=text1.split("+");
frm[opt][frm[opt].length]=new Option("- - Select Menu - -", "0", "", false);
for(var i=0;i<optdata.length;i++)
{
var option=optdata[i].split("#");
frm[opt][frm[opt].length]=new Option(option[1],option[0],"",false);

}

}	 
}
xmlHttpReq.open('GET','<?=SITE_PATH?>bookings/reportOptions/?catid='+val, true);

xmlHttpReq.send(null); 
}
</script>

<script language="javascript" type="text/javascript">


function rrr(val,frm,opt)
{
if (document.getElementById('type').value=='bulider')
{	
// alert(val);

if(val==-1)
{
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
frm[opt][frm[opt].length]=new Option("-- Select Project --", "-1", "", false);
return false;
}		
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
var xmlHttpReq = false;

// Mozilla/Safari
if (window.XMLHttpRequest)
{
xmlHttpReq = new XMLHttpRequest();
}
// IE
else if (window.ActiveXObject)
{
xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlHttpReq.onreadystatechange = function()
{
if (xmlHttpReq.readyState == 4)
{
//alert(xmlHttpReq.responseText);
var text1=xmlHttpReq.responseText;
var optdata=text1.split("+");
frm[opt][frm[opt].length]=new Option("- - Select Project - -", "-1", "", false);
for(var i=0;i<optdata.length;i++)
{
var option=optdata[i].split("#");
frm[opt][frm[opt].length]=new Option(option[1],option[0],"",false);

}

}	 
}	
xmlHttpReq.open('GET','<?=SITE_PATH?>bookings/getProject/?val='+val, true);
document.getElementById('rricha').style.display="block";

xmlHttpReq.send(null); 

}
else
{
}
}

function validation()
{
if (document.summary.sfdate.value=='')
{
alert('Please select FROM Date');
return false;
}
if (document.summary.sldate.value=='')
{
alert('Please select TO Date');
return false;
}


return true;
}
function validationdetail()
{
if (document.detail.fdate.value=='')
{
alert('Please select FROM Date');
return false;
}
if (document.detail.ldate.value=='')
{
alert('Please select TO Date');
return false;
}
return true;
}


function rrrrr(val,frm,opt)
{
if (document.getElementById('type2').value=='bulider')
{	
// alert(val);

if(val==-1)
{
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
frm[opt][frm[opt].length]=new Option("-- Select Project --", "-1", "", false);
return false;
}		
for(x=frm[opt].length; x>=0; x =x - 1)
{
frm[opt][x]=null;
}
var xmlHttpReq = false;

// Mozilla/Safari
if (window.XMLHttpRequest)
{
xmlHttpReq = new XMLHttpRequest();
}
// IE
else if (window.ActiveXObject)
{
xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlHttpReq.onreadystatechange = function()
{
if (xmlHttpReq.readyState == 4)
{
//alert(xmlHttpReq.responseText);
var text1=xmlHttpReq.responseText;
var optdata=text1.split("+");
frm[opt][frm[opt].length]=new Option("- - Select Project - -", "-1", "", false);
for(var i=0;i<optdata.length;i++)
{
var option=optdata[i].split("#");
frm[opt][frm[opt].length]=new Option(option[1],option[0],"",false);

}

}	 
}	
xmlHttpReq.open('GET','<?=SITE_PATH?>bookings/getProject/?val='+val, true);


xmlHttpReq.send(null); 

}
else
{
}
}
</script>