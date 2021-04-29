<style>
body{font-size:12px;}
.table>thead>tr>th{vertical-align:middle;}
.heading{font-size:18px; text-align:center;}
.full_word{word-break:keep-all;}
@media print {
#printingdiv{overflow:visible; font-size:8px; margin-top:50px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding:1px;}
.text-nowrap{white-space:nowrap !important;}
}
</style>
<script type="text/javascript">
function printing()
{
var content = document.getElementById("printingdiv");
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>
<div id="box">
<div id="printingdiv">
<div class="table-responsive"><table class="table table-bordered table-responsive" id="headerTable">
<thead>
<tr>
<td colspan="20" class="heading">Booking Applicant Personal Details <?=date("d- M-y",strtotime($startdate));?> to <?=date("d- M-y",strtotime($enddate));?></td>
</tr>

<tr>
<th>SL</th>
<th>Applicant Name</th>
<th>Country</th>
<th>Profession</th>
<th>Designation</th>
<th>Company Name</th>
<th>Applicant email Id</th>
<th>Mobile</th>
<th>Both Street Address</th>
<th>Applicant Office Address</th>
<th>Builder Name</th>
<th>Project Name</th>
<th>Project location</th>
<th>Cost Of Unit</th>
</tr>
</thead>
<?
$i=1;
foreach ($applicantdetail as $data){
	//print_r($data);
	 ?>
<tr>
<td><?=$i?></td>
<td class="full_word">
<?=$data['bookings']['applicant_name1']?>, <?=$data['bookings']['join_applicant']?>

<td class="full_word"><? if($data['bookings']['country']){
   $country = $this->requestAction(array('controller'=>'bookings','action'=>'fetchcountry',$data['bookings']['country']));
    echo $country['0']['countries']['name'];
	}  
?></td>
<td class="full_word"><?=$data['bookings']['profession']?> <?=$data['bookings']['joint_profession']?></td>
<td class="full_word"><?=$data['bookings']['designation']?> <?=$data['bookings']['joint_designation']?></td>
<td class="full_word">
<? echo $data['bookings']['company_name']; ?></td>
<td class="full_word"><?=$data['bookings']['applicant_email']?>  <?=$data['bookings']['joint_email']?> </td>
<td class="full_word"><? echo $data['bookings']['mobile']?> , <? echo $data['bookings']['joint_mobile']?> </td>
<td width="20%" class="full_word"><? echo $data['bookings']['street_address']?> <br> <? echo $data['bookings']['joint_street_address']?> </td>
<td width="20%" class="full_word"> <? echo $data['bookings']['office_street_address']?>  <br> <? echo $data['bookings']['joint_office_street_address']?></td>

<td class="full_word"><? if($data['bookings']['commission_from_type']=='company'){?>
<? $builder=$this->requestAction(array('controller'=>'builders','action'=>'getBuilder',$data['bookings']['bulider_name'])); 
echo $builder['Builder']['name']?>
<? } else{ }?> </td>
<td class="full_word"><? if($data['bookings']['project_name']!=''){
$project=$this->requestAction(array('controller'=>'projects','action'=>'getprojectNameOnID',$data['bookings']['project_name']));
echo $project['Project']['name']; 
}
?></td>
<td class="full_word">
<? if($data['bookings']['project_location']) {
     $location = $this->requestAction(array('controller'=>'bookings','action'=>'fetchlocation',$data['bookings']['project_location']));
    echo $location['0']['locations']['name'];
	
	}

?>	 </td>

<td class="full_word"><?=($data['bookings']['plc']*$data['bookings']['area'])+$data['bookings']['carparking']+$data['bookings']['bsp']?>  </td>

</tr>
<? $i++; }?>
</table></div>
</div>
<? if(CakeSession::read('User.type')==='admin'){?>
<button onclick="fnExcelReport()" class="btn btn-info"> Export</button>
<? } ?>
<br />
<br />
<?php /*?><table class="table table-bordered">
<thead>
<tr><td colspan="18" class="dvInnerHeader"><a href="javascript:printing()">Print this Page</a></td></tr>
<tr>
<th colspan="18" class="dvInnerHeader"><a href="Javascript:history.go(-1);">Close window</a></td>
</tr>
</thead>
</table><?php */?>
<?php /*?><iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe><?php */?>
</div>
<script>
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>