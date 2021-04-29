<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
<style>
    .checkbox{
        height: auto !important;
    }
    .dataTables_wrapper{
        margin-left: 15px;
        margin-bottom: 25px;
    }
    .dataTables_filter{
        float:left !important;
    }
    .dt-buttons{
         float: right !important;
    }
</style>
<?php echo $this->Html->meta('icon');echo $this->Html->css('bootstrap'); echo $this->Html->css('cake.generic');echo $this->Html->css('dropdown');echo $this->Html->css('admin_crm');echo $this->fetch('meta');echo $this->fetch('css');echo $this->fetch('script');?>

<?php echo $this->Session->flash(); ?><?php echo $this->fetch('content'); ?>
 
 
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable({
         dom: 'Bfrtip',
        buttons: [
            {
             extend: 'excel',
             title: 'Report_'+$("#gettitle").val(),
                  
            },
        //'copy', 'pdf'
    ],
        scrollY:        600,
       scrollCollapse: true,   
    deferRender:    true,
    scroller:       true
    });
} );
    </script>
    
    
    <script type="text/javascript">

$(document).ready(function(){
$("#organization").change(function(){
var c=$(this).val();
$('#block').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?nid="+c,success:function(result){$("#block").html(result);}});

});    
$("#block").change(function(){
var c=$(this).val();
$('#panchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){
$("#panchayat").html(result);
$("#panchayat").empty();
 $("#panchayat").html(result);
$("#panchayat").multiselect('destroy');
$('#panchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'150px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});

        
        }});

});
$("#panchayat").change(function(){
var c=$(this).val();
$('#village').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#village").html(result);}});

});


$('#panchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'150px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});



});

</script>