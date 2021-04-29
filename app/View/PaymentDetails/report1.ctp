<style>
    .center {
        text-align: center;
    }
    th {
        text-align: center;
    }
    table tr td {
        word-break: unset;
    }
    .totalvalue td{
        background-color: #e08e0b !important;
    }
    .totalvalue tr td{
        border: 1px solid #e08e0b;
    }
    
     .totalmanange td {
        background-color: #7fbae4 !important;
    }
    .totalmanange tr td{
        border: 1px solid #7fbae4;
    }

     .totaloverhead td {
        background-color: #da91c0 !important;
    }
    .totaloverhead tr td{
        border: 1px solid #da91c0;
    }

  .totalmancost td {
        background-color: #1ee69c !important;
    }
   .totalmancost tr td{
        border: 1px solid #1ee69c;
    }

  .granttotal td {
        background-color: #909ee8 !important;
    }
   .granttotal tr td{
        border: 1px solid #909ee8;
    }
    
 @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
  
   
}
</style>

<?php if(!empty($invoicedetails)) 
//print_r($invoicedetails['0']['ClientDetail']); die();
{?>
<div class="row">
<div class="col-sm-12" id="section-to-print"><div class="left_resale">
<div class="table-responsive">
  <div class="col-sm-12">
 <div class="col-sm-8"> <h3><?=$invoicedetails['0']['CompanyDetail']['name_of_company']?></h3>
</div>
<div class="col-sm-4"><img src="<?=SITE_PATH?>images/ca.png"></div>
<hr>
</div>

    <div class="col-sm-12">
    <h3 class="center">Invoice</h3>
    <h4>Mr. <?=$invoicedetails['0']['ClientDetail']['name_of_client']?></h4> 
    <h4>Mr. <?=$invoicedetails['0']['ClientDetail']['district_c']?>,<?=$invoicedetails['0']['ClientDetail']['state_c']?></h4> 
    <h5 class="center">Income Tax PAN : <?=$invoicedetails['0']['ClientDetail']['pan_number']?></h5>
    </div>
    
    <table class="table table-striped"> 
        <thead>
        <th>Sr No</th> <th>Particulars</th>Amount</th></thead>
        <tbody>
             <?php 
            
             $totcat ='';
             $alpha = 'A';
             $i = 1;
//              $title=$this->requestAction(array("controller"=>"subcategorys","action"=>"getcatename",$cat['Finance']['subcat_id'])); 
//            
//            print_r($title);
//             
//             
//             die(); 
              foreach($category as $cat) {
                
                  $title=$this->requestAction(array("controller"=>"financials","action"=>"getcatname",$cat['Finance']['cat_id'])); 
            
                 ?>
            
          <tr>
              <td style="background-color: #C0BFBA;"><?=$alpha?></td><td colspan="10" style="background-color: #C0BFBA;"><?=$title['name']?>
                   </td>
          
         </tr>
          
        
            
                 <?php 
                  
                $count++;  }  ?>
          
          
        </table>
</div></div></div>
    <div class="col-sm-12"><a href="#" onclick="window.print()" class="btn btn-success">Print</a> </div>  
</div>
<?php } ?>


<!--</div>-->
<?php /*?><div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?>
</ul>
</div><?php */?>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>finances/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});



$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});

var totalamount1 = $('.totalamount1').text();
var totalamount2 = $('.totalamount2').text();
var totalamount3 = $('.totalamount3').text();
 var totalamt   = +totalamount1 + +totalamount2 + +totalamount3;
 
 $('#totman').html(totalamt);
 
 
 
var totalprevious1 = $('.totalprevious1').text();
var totalprevious2 = $('.totalprevious2').text();
var totalprevious3 = $('.totalprevious3').text();
 var totalpre   = +totalprevious1 + +totalprevious2 + +totalprevious3;
 
 $('#totpre').html(totalpre);
 
 
 
var totalcurrent1 = $('.totalcurrent1').text();
var totalcurrent2 = $('.totalcurrent2').text();
var totalcurrent3 = $('.totalcurrent3').text();
 var totalcur   = +totalcurrent1 + +totalcurrent2 + +totalcurrent3;
 
 $('#totcur').html(totalcur);
 
 
var totalcumulative1 = $('.totalcumulative1').text();
var totalcumulative2 = $('.totalcumulative2').text();
var totalcumulative3 = $('.totalcumulative3').text();
var totalcum   = +totalcumulative1 + +totalcumulative2 + +totalcumulative3;
 
 $('#totcum').html(totalcum);
 
 
var totalvariance1 = $('.totalvariance1').text();
var totalvariance2 = $('.totalvariance2').text();
var totalvariance3 = $('.totalvariance3').text();
var totalvar   = +totalvariance1 + +totalvariance2 + +totalvariance3;
 
 $('#totvar').html(totalvar);
 
 
 
var totalvarianceperctange1 = $('.totalvarianceperctange1').text();
var totalvarianceperctange2 = $('.totalvarianceperctange2').text();
var totalvarianceperctange3 = $('.totalvarianceperctange3').text();
var totalvarper   = (+totalvarianceperctange1 + +totalvarianceperctange2 + +totalvarianceperctange3)/3;
 
 $('#totvarper').html(Math.round(totalvarper));
 


var totalprojection1 = $('.totalprojection1').text();
var totalprojection2 = $('.totalprojection2').text();
var totalprojection3 = $('.totalprojection3').text();
var totalproj   = (+totalprojection1 + +totalprojection2 + +totalprojection3);
 
 $('#totproj').html(Math.round(totalproj));


var totman = $('#totman').text();
var totpre = $('#totpre').text();
var totcur = $('#totcur').text();
var totcum = $('#totcum').text();
var totvar = $('#totvar').text();
var totvarper = $('#totvarper').text();
var totproj = $('#totproj').text();
var overheadpercentage = $('#overheadpercentage').val();
var totaloverheadcal = totman*overheadpercentage/100;
var totaloverheadpre = totpre*overheadpercentage/100;
var totaloverheadcur = totcur*overheadpercentage/100;
var totaloverheadcum = totcum*overheadpercentage/100;
var totaloverheadvar = totvar*overheadpercentage/100;
var totaloverheadvarper = totvarper*overheadpercentage/100;
var totaloverheadproj = totproj*overheadpercentage/100;
$('#totover').html(Math.round(totaloverheadcal));
$('#totoverpre').html(Math.round(totaloverheadpre));   
$('#totovercur').html(Math.round(totaloverheadcur));
$('#totovercum').html(Math.round(totaloverheadcum));  
$('#totovervar').html(Math.round(totaloverheadvar)); 
$('#totovervarper').html(Math.round(totaloverheadvarper)); 
$('#totoverproj').html(Math.round(totaloverheadproj)); 


var totman = $('#totman').text();
var totpre = $('#totpre').text();
var totcur = $('#totcur').text();
var totcum = $('#totcum').text();
var totvar = $('#totvar').text();
var totvarper = $('#totvarper').text();
var totproj = $('#totproj').text();


var totover = $('#totover').text();
var totoverpre = $('#totoverpre').text();
var totovercur = $('#totovercur').text();
var totovercum = $('#totovercum').text();
var totovervar = $('#totovervar').text();
var totoverproj = $('#totoverproj').text();

var totalmangecost = +totman + +totover;
var totalprevcost = +totpre + +totoverpre;
var totalcurrcost = +totcur + +totovercur;
var totalcumucost = +totcum + +totovercum;
var totalvariancecost = +totvar + +totovervar;
var totalprojeccost = +totproj + +totoverproj;


$('#totmanagementcost').html(Math.round(totalmangecost));
$('#totprecost').html(Math.round(totalprevcost));   
$('#totcurcost').html(Math.round(totalcurrcost));
$('#totcumcost').html(Math.round(totalcumucost));  
$('#totvarcost').html(Math.round(totalvariancecost)); 
$('#totvarpercost').html(Math.round(totaloverheadvarper)); 
$('#totprojcost').html(Math.round(totalprojeccost)); 


var totalamount4 = $('.totalamount4').text();
var totalprevious4 = $('.totalprevious4').text();
var totalcurrent4 = $('.totalcurrent4').text();
var totalcumulative4 = $('.totalcumulative4').text();
var totalvariance4 = $('.totalvariance4').text();
var totalvarianceperctange4 = $('.totalvarianceperctange4').text();
var totalprojection4 = $('.totalprojection4').text();

var granttotalmangecost = +totman + +totalamount4;
var granttotalprevcost = +totpre + +totalprevious4;
var granttotalcurrcost = +totcur + +totalcurrent4;
var granttotalcumucost = +totcum + +totalcumulative4;
var granttotalvariancecost = +totvar + +totalvariance4;
var granttotalvaripercost = +totvarper + +totalvarianceperctange4;
var granttotalprojeccost = +totproj + +totalprojection4;



$('#granttotmanage').html(Math.round(granttotalmangecost));
$('#granttotpre').html(Math.round(granttotalprevcost));   
$('#granttotcur').html(Math.round(granttotalcurrcost));
$('#granttotcum').html(Math.round(granttotalcumucost));  
$('#granttotvar').html(Math.round(granttotalvariancecost)); 
$('#granttotvarper').html(Math.round(granttotalvaripercost)); 
$('#granttotproj').html(Math.round(granttotalprojeccost));

});

</script>
