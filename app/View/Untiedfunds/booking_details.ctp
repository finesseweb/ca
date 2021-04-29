<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Detail</title>
<style type="text/css">
.pad8L	{ padding-left:8px; }
.pad15L	{ padding-left:15px; }
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
</style>
</head>
<body>
<span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; border-bottom:double; font-weight:bold;">Booking Detail of <?=ucfirst($booking['Booking']['applicant_name1'])?>
</span>
<div align="right" style="line-height:30px; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold;">Document ID - #000<?=$booking['Booking']['id']?>
  <br/>
  <span style="font-size:14px;">Date of Booking  <?=date("d-M-y",strtotime($booking['Booking']['date_of_booking']));?> &nbsp; 
    <? if($booking['Booking']['booking_canceled']=="uncancel") {?>  Confirmed<? } else {?>Cancelled<? }  ?>
  
  
  </span></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#333333; border:#CCCCCC 1px solid; border-collapse:collapse;">
  <tr>
    <td width="22%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>Customer Details</strong></td>
        </tr>
        <tr>
          <td>Name</td>
        </tr>
		<tr>
          <td>Pancard No.</td>
        </tr>
        <tr>
          <td>Mobile</td>
        </tr>
        <tr>
          <td>E-Mail</td>
        </tr>
        <tr>
          <td>Profession</td>
        </tr>
        <tr>
          <td>Company Name</td>
        </tr>
        <tr>
          <td>Designation</td>
        </tr>
      </table></td>
    <td width="70%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" width="<? if ($booking['Booking']['join3_applicant']==""){?>36<? }else{?>25<? }?>%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Ist Applicant</strong></td>
              </tr>
              <tr>
                <td style="text-transform:capitalize;"><?=$booking['Booking']['applicant_name1']?></td>
              </tr>
			  <tr>
                <td><? if($booking['Booking']['pancard']){ echo $booking['Booking']['pancard'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><? if ($booking['Booking']['country']=="India" && ($booking['Booking']['mobile']!="0" && $booking['Booking']['mobile']!="")){?>
                  +91
                  <? }?><? if($booking['Booking']['mobile']){ echo $booking['Booking']['mobile'];}else { echo "N/A" ;}?>
                  </td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['applicant_email']){ echo $booking['Booking']['applicant_email'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['profession']){ echo $booking['Booking']['profession'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['company_name']){ echo $booking['Booking']['company_name'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;"><? if($booking['Booking']['designation']){ echo $booking['Booking']['designation'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
            </table></td>
          <td align="left" width="<? if ($booking['Booking']['join3_applicant']==""){?>30<? }else{?>25<? }?>%"><? if ($booking['Booking']['join_applicant']!=""){?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>IInd Applicant</strong></td>
              </tr>
              <tr>
            <td><span style="text-transform:capitalize;"><? if($booking['Booking']['join_applicant']){ echo $booking['Booking']['join_applicant'];}else { echo "N/A" ;}?>
                  
                  </span></td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['joint_pancard']){ echo $booking['Booking']['joint_pancard'];}else { echo "N/A" ;}?></td>
              </tr>
			   <tr>
                <td>
                  <? if ($booking['Booking']['joint_mobile']=="0" || $booking['Booking']['joint_mobile']==""){ echo "N/A";}else{ 
				  
				  if ($booking['Booking']['joint_country']=="India"){?>  +91  <? }
				  
				  echo $booking['Booking']['joint_mobile'] ;}?></td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['joint_email']){ echo $booking['Booking']['joint_email'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                  <? if($booking['Booking']['joint_profession']){ echo $booking['Booking']['joint_profession'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                 <? if($booking['Booking']['joint_company_name']){ echo $booking['Booking']['joint_company_name'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                <? if($booking['Booking']['joint_designation']){ echo $booking['Booking']['joint_designation'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
            </table>
            <? }else{?>
            &nbsp;
            <? }?></td>
          <td align="left" width="<? if ($booking['Booking']['join3_applicant']==""){?>20<? }else{?>25<? }?>%"><? if ($booking['Booking']['join2_applicant']!=""){?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>IIIrd Applicant</strong></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                 <? if($booking['Booking']['join2_applicant']){ echo $booking['Booking']['join2_applicant'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><? if($booking['Booking']['joint2_pancard']){ echo $booking['Booking']['joint2_pancard'];}else { echo "N/A" ;}?>
                </td>
              </tr>
			 
			  <tr>
                <td><? if ($booking['Booking']['joint2_country']=="India" && $booking['Booking']['joint2_mobile']!="0"){?>
                  +91
                  <? }?>
                  <? if($booking['Booking']['joint2_mobile']){ echo $booking['Booking']['joint2_mobile'];}else { echo "N/A" ;}?>
                 </td>
              </tr>
			  
			  
			  
              <tr>
                <td><? if($booking['Booking']['joint2_email']){ echo $booking['Booking']['joint2_email'];}else { echo "N/A" ;}?></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                <? if($booking['Booking']['joint2_profession']){ echo $booking['Booking']['joint2_profession'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                <? if($booking['Booking']['joint2_company_name']){ echo $booking['Booking']['joint2_company_name'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                  <? if($booking['Booking']['joint2_designation']){ echo $booking['Booking']['joint2_designation'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
            </table>
            <? }else{?>
            &nbsp;
            <? }?></td>
          <? if ($booking['Booking']['join3_applicant']!=""){?>
          <td align="left" width="25%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>IVth Applicant</strong></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                <? if($booking['Booking']['join3_applicant']){ echo $booking['Booking']['join3_applicant'];}else { echo "N/A" ;}?>
                  </span></td>
              </tr>
              <tr>
                <td><? if ($booking['Booking']['joint3_country']=="India" && $booking['Booking']['joint3_mobile']!="0"){?>
                  +91
                  <? }?>
                  <? if ($booking['Booking']['joint3_mobile']=="0"){ echo "N/A";}else{ echo $booking['Booking']['joint3_mobile'] ;}?></td>
              </tr>
			  
			  <tr>
                <td><? if($booking['Booking']['joint3_pancard']){ echo $booking['Booking']['joint3_pancard'];}else { echo "N/A" ;}?></td>
              </tr>
			 
              <tr>
                <td><? if($booking['Booking']['joint3_email']){ echo $booking['Booking']['joint3_email'];}else { echo "N/A" ;}?> </td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                  <? if($booking['Booking']['joint3_profession']){ echo $booking['Booking']['joint3_profession'];}else { echo "N/A" ;}?> 
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                  <? if($booking['Booking']['joint3_company_name']){ echo $booking['Booking']['joint3_company_name'];}else { echo "N/A" ;}?> 
                  </span></td>
              </tr>
              <tr>
                <td><span style="text-transform:capitalize;">
                <? if($booking['Booking']['joint3_designation']){ echo $booking['Booking']['joint3_designation'];}else { echo "N/A" ;}?> 
                  </span></td>
              </tr>
            </table></td>
          <? }?>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%"><strong>Property Detail</strong></td>
          <td width="32%">&nbsp;</td>
          <td width="24%">&nbsp;</td>
          <td width="20%">&nbsp;</td>
        </tr>
        <tr>
          <td>Developer</td>
          <td style="text-transform:capitalize;"><?=$booking['Builder']['name']?></td>
          <td>Area</td>
          <td style="text-transform:capitalize;"><?=$booking['Booking']['area']?>
            <?=$booking['Booking']['area_type']?>&nbsp;<strong><? if($booking['Booking']['project_plan']!=""){ echo "(".$booking['Booking']['project_plan'].")" ;}?></strong></td>
        </tr>
        <tr>
          <td>Project</td>
          <td style="text-transform:capitalize;"><?=$booking['Project']['name']?></td>
          <td style="text-transform:capitalize;">Rate
            <? if ($booking['Booking']['rate']!=""){?>
            per
            <?=$booking['Booking']['area_type'] ;}?></td>
          <td><span style="text-transform:capitalize;">
            <? if ($booking['Booking']['rate']!=""){ echo $booking['Booking']['rate']; }else{ echo $booking['Booking']['bsp']; }?>
            /-</span></td>
        </tr>
        <tr>
          <td>Unit No.</td>
          <td><?=$booking['Booking']['unit_no']?></td>
          <td>PLC <span style="text-transform:capitalize;">
            <?=$booking['Booking']['area_type']?>
            </span></td>
          <td><? if ($booking['Booking']['plc']!=""){ echo $booking['Booking']['plc']." /-"; }else{ echo "N/A"; }?>
            </td>
        </tr>
        <tr>
          <td>Cost of Unit </td>
          <td><?=($booking['Booking']['plc']*$booking['Booking']['area'])+$booking['Booking']['carparking']+$booking['Booking']['bsp']?>
            /- (BSP
            <? if($booking['Booking']['plc']!="0"){?>
            + PLC
            <? } if($booking['Booking']['carparking']!="0"){?>
            + CP
            <? }?>
            )</td>
          <td>Car Parking </td>
          <td><? if ($booking['Booking']['carparking']!=""){ echo $booking['Booking']['carparking']." /-"; }else{ echo "N/A"; }?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td ><strong>Payment Details</strong></td>
          <td width="32%">&nbsp;</td>
          <td width="24%">&nbsp;</td>
          <td width="20%">&nbsp;</td>
        </tr>
        <tr>
          <td>Cheque No</td>
          <td><? if($booking['Booking']['check_no']=="0") { echo "N/A";}else{ echo $booking['Booking']['check_no'];}?></td>
          <td>Bank</td>
          <td><?=strtoupper($booking['Booking']['drawn_on'])?></td>
        </tr>
        <tr>
          <td>Cheque Date</td>
          <td><? if($booking['Booking']['check_date']=="0000-00-00 00:00:00" || $booking['Booking']['check_date']==""){ echo "N/A";}else{ echo date("d/m/y",strtotime($booking['Booking']['check_date']));}?></td>
          <td>Amount</td>
          <td><?=$booking['Booking']['check_amount']?>
            /-</td>
        </tr>
        <? if($booking['Booking']['check_no_2']!='') {?>
        <tr>
          <td>Cheque No</td>
          <td><? if($booking['Booking']['check_no_2']=="0") { echo "N/A";}else{ echo $booking['Booking']['check_no_2'];}?></td>
          <td>Bank</td>
          <td><?=strtoupper($booking['Booking']['drawn_on_2'])?></td>
        </tr>
        <tr>
          <td>Cheque Date</td>
          <td><? if($booking['Booking']['check_date_2']=="0000-00-00 00:00:00" || $booking['Booking']['check_date_2']==""){ echo "N/A";}else{ echo date("d/m/y",strtotime($booking['Booking']['check_date_2']));}?></td>
          <td>Amount</td>
          <td><?=$booking['Booking']['check_amount_2']?>
            /-</td>
        </tr>
        <? } ?>
        
        
        <? if($booking['Booking']['check_no_3']!='') {?>
        <tr>
          <td>Cheque No</td>
          <td><? if($booking['Booking']['check_no_3']=="0") { echo "N/A";}else{ echo $booking['Booking']['check_no_3'];}?></td>
          <td>Bank</td>
          <td><?=strtoupper($booking['Booking']['drawn_on_3'])?></td>
        </tr>
        <tr>
          <td>Cheque Date</td>
          <td><? if($booking['Booking']['check_date_3']=="0000-00-00 00:00:00" || $booking['Booking']['check_date_3']==""){ echo "N/A";}else{ echo date("d/m/y",strtotime($booking['Booking']['check_date_3']));}?></td>
          <td>Amount</td>
          <td><?=$booking['Booking']['check_amount_3']?>
            /-</td>
        </tr>
        <? } ?>
        
        <? if($booking['Booking']['check_no_4']!='') {?>
        <tr>
          <td>Cheque No</td>
          <td><? if($booking['Booking']['check_no_4']=="0") { echo "N/A";}else{ echo $booking['Booking']['check_no_4'];}?></td>
          <td>Bank</td>
          <td><?=strtoupper($booking['Booking']['drawn_on_4'])?></td>
        </tr>
        <tr>
          <td>Cheque Date</td>
          <td><? if($booking['Booking']['check_date_4']=="0000-00-00 00:00:00" || $booking['Booking']['check_date_4']==""){ echo "N/A";}else{ echo date("d/m/y",strtotime($booking['Booking']['check_date_4']));}?></td>
          <td>Amount</td>
          <td><?=$booking['Booking']['check_amount_4']?>
            /-</td>
        </tr>
        <? } ?>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="5"><strong>Commission Details Incoming </strong></td>
        </tr>
        <tr>
          <td width="5%">&nbsp;</td>
          <td width="35%" style="text-transform:capitalize;"><strong>Total Brokerage <br />
            (
            <? if($booking['Booking']['commission_from_type']=='company'){?>
            
			<?=$booking['Builder']['name']?>
			<? } else{?>
            <?=$booking['BrokerCompany']['name']?>
            <? }?>
            )</strong> </td>
          <td width="6%" valign="top"><strong>
            <?=$booking['Booking']['commission_percentage']?>
            %</strong>
			</td>
          <td align="left" valign="bottom"><strong> = <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <? if($booking['Booking']['commission_from_company']==""){ echo "0.00"; }else{ echo round($booking['Booking']['commission_from_company']);?>
            ( BSP
            <? if($booking['Booking']['include_plc_percentage']==1){?>
            + PLC
            <? } if($booking['Booking']['include_carparking_percentage']==1){?>
            + CP
            <? } if($booking['Booking']['include_other_percentage']==1){ ?>
            + Other
            <? }?>
            )
            <?   }?>
			<?  if($booking['Booking']['comment_total_commission_coming_new']!=""){ echo "(".$booking['Booking']['comment_total_commission_coming_new'].")";}?>
            </strong></td>
			<td width="26%" rowspan="4">Total <table width="97%" height="20" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
	        <tr>
			      <td align="center" valign="middle"><strong>Brokerage + Incentive</strong></td>
		    <td align="center" valign="middle"><strong>Total</strong></td>
		    <!--<td><strong></strong></td>-->
		        </tr>
			    <tr>
			      
			      <td align="center" valign="middle"><?=round($booking['Booking']['commission_from_company'])?>
			        + <? if ($booking['Booking']['insentive_from_comp']!=""){ echo round($booking['Booking']['insentive_from_comp']); }else{ echo "0";}?> 
			        </strong></td>
				    <td align="center" valign="middle"><strong><img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /> <?=round($booking['Booking']['commission_from_company']+$booking['Booking']['insentive_from_comp'])?></strong></td>
              </tr>
	          </table></td>
        </tr>
        <tr>
          <td width="5%">&nbsp;</td>
          <td width="35%"><strong>Incentive</strong> (other)</td>
          <td width="6%" style="text-transform:capitalize;"><strong><? if($booking['Booking']['insentive_percentage']!=""){ echo $booking['Booking']['insentive_percentage']; }else{ echo "0"; }?> %</strong></td>
		  <td><strong><? if($booking['Booking']['insentive_from_comp']!=""){?> = <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /><?=$booking['Booking']['insentive_from_comp']?> ( <?=$booking['Booking']['comment_total_insentive']?> )<? }?></strong></td>
        </tr>
		<tr>
          <td width="5%">&nbsp;</td>
          <td width="35%">Credit Note  </td>
          <td colspan="2" style="text-transform:capitalize;"><? if($booking['Booking']['credit_note_received']!=""){ echo $booking['Booking']['credit_note_received']; }else{ echo "N/A"; }?></td>
	    </tr>
        <!--<tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="28%">&nbsp;</td>
        </tr>-->
        
      </table></td>
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="74%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="5"><strong>Commission Details Outgoing-</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Customer</strong></td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>

        </tr>
		
		<!-- Commission to customer start-->
        <? if ($booking['Booking']['brokerage_adjust_percent']!="" && $booking['Booking']['brokerage_adjust_amount']!=""){?>
		<tr>
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage adjusted in Rate</td>
          <td valign="top"><? if ($booking['Booking']['brokerage_adjust_percent']!="0"){ echo $booking['Booking']['brokerage_adjust_percent']; }else{ echo "N/A";}?>
            <strong>%</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <? if($booking['Booking']['brokerage_adjust_amount']==""){ echo "0.00"; }else{ echo $booking['Booking']['brokerage_adjust_amount'];}?>			
			<? if($booking['Booking']['comment_brokerage_adjusted']!=""){ echo "(".$booking['Booking']['comment_brokerage_adjusted'].")";}?>			</td>
        </tr>
		<? }?>
		
		
		<? if ($booking['Booking']['brokerage_adjust_percent_in_plc']!="" && $booking['Booking']['brokerage_adjust_amount_in_plc']!=""){?>
		<tr>
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage adjusted in PLC</td>
          <td valign="top"><? if ($booking['Booking']['brokerage_adjust_percent_in_plc']!="0"){ echo $booking['Booking']['brokerage_adjust_percent_in_plc']; }else{ echo "N/A";}?>
		  <? //=$booking['Booking']['brokerage_adjust_percent_in_plc']?>
            <strong>%</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <? if($booking['Booking']['brokerage_adjust_amount_in_plc']==""){ echo "0.00"; }else{ echo $booking['Booking']['brokerage_adjust_amount_in_plc'];}?>			
			<? if($booking['Booking']['comment_brokerage_adjusted_in_plc']!=""){ echo "(".$booking['Booking']['comment_brokerage_adjusted_in_plc'].")";}?>			</td>
        </tr>
		<? }?>
		<? if ($booking['Booking']['brokerage_adjust_percent_in_carparking']!="" && $booking['Booking']['brokerage_adjust_amount_in_carparking']!=""){?>
		<tr>
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage adjusted in Car Parking</td>
          <td valign="top" nowrap="nowrap">
		  <? if ($booking['Booking']['brokerage_adjust_percent_in_carparking']!="0"){ echo $booking['Booking']['brokerage_adjust_percent_in_carparking']; }else{ echo "N/A";}?>
		  <? //=$booking['Booking']['brokerage_adjust_percent_in_carparking']?>
            <strong>%</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <? if($booking['Booking']['brokerage_adjust_amount_in_carparking']==""){ echo "0.00"; }else{ echo $booking['Booking']['brokerage_adjust_amount_in_carparking'];}?>			
			<? if($booking['Booking']['comment_brokerage_adjusted_in_cp']!=""){ echo "(".$booking['Booking']['comment_brokerage_adjusted_in_cp'].")";}?>			</td>
        </tr>
		<? }?>
		<? if ($booking['Booking']['commission_to_customer']-$booking['Booking']['brokerage_adjust_amount']!=""){?>
		
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage payable to Customer in BSP</td>
          <td valign="top" nowrap="nowrap"><? if($booking['Booking']['customer_commission_percent'] - $booking['Booking']['brokerage_adjust_percent']!="0"){
		  echo $booking['Booking']['customer_commission_percent'] - $booking['Booking']['brokerage_adjust_percent'] ;}else{echo "N/A";} ?>
            <strong>%</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['commission_to_customer']-$booking['Booking']['brokerage_adjust_amount']?>
			
			<? //if($booking['Booking']['comment_total_commission_customer']!=""){ echo "(".$booking['Booking']['comment_total_commission_customer'].")";}?>			</td>
        </tr>
		<? }?>
        <? if($booking['Booking']['customer_commission_plc_percentage']!="0"){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage payable to Customer in PLC</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['customer_commission_plc_percentage']!="0"){ echo $booking['Booking']['customer_commission_plc_percentage']; }else{ echo "N/A";}?>
		  <? //=$booking['Booking']['customer_commission_plc_percentage']?>
            %</td>
          <td align="left" style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <?=$booking['Booking']['customer_commission_plc_amount'];?>
            <? if($booking['Booking']['comment_total_commission_customer_plc']!=""){ echo "(".$booking['Booking']['comment_total_commission_customer_plc'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['customer_commission_carparking_percentage']!="0"){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Brokerage payable to Customer in Car Parking </td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['customer_commission_carparking_percentage']!="0"){ echo $booking['Booking']['customer_commission_carparking_percentage']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['customer_commission_carparking_percentage']?>
            %</td>
          <td style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <?=$booking['Booking']['customer_commission_carparking_amount'];?>
            <? if($booking['Booking']['comment_total_commission_customer_cp']!=""){ echo "(".$booking['Booking']['comment_total_commission_customer_cp'].")";}?></td>
        </tr>
        <? }?>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Total Brokerage to Customer</strong></td>
          <td valign="top"><strong>
            <? if ($booking['Booking']['customer_commission_percent']!="0"){ echo $booking['Booking']['customer_commission_percent']; }else{ echo "N/A";}?>
		  %</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <?=$totalbroeragefinal=$booking['Booking']['commission_to_customer']+$booking['Booking']['brokerage_adjust_amount_in_plc']+$booking['Booking']['brokerage_adjust_amount_in_carparking'];?>
            </strong>
			<? if($booking['Booking']['comment_total_commission_customer']!=""){ echo "(".$booking['Booking']['comment_total_commission_customer'].")";}?>
			</td>
        </tr>
       
	   <!-- Commission to customer end-->
	   <!-- Insentive to customer start-->
	   
	   <? if($booking['Booking']['insentive_to_customer_amt']!="" || $booking['Booking']['insentive_to_customer_on_plc_amt']!="" ||  $booking['Booking']['insentive_to_customer_on_car_amt']!=""){?>
	    <tr>
          <td>&nbsp;</td>
          <td><strong>Incentive to Customer</strong></td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
		<? if($booking['Booking']['insentive_to_customer_amt']!=""){?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Incentive payable to Customer in BSP</td>
          <td valign="top" nowrap="nowrap">
		  <? if ($booking['Booking']['insentive_to_customer_per']!="0"){ echo $booking['Booking']['insentive_to_customer_per']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_customer_per']?>
            <strong>%</strong></td>
          <td align="left"><strong>= &nbsp;<img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong><?=$booking['Booking']['insentive_to_customer_amt']?>
          <? if($booking['Booking']['comment_total_insentive_customer']!=""){ echo "(".$booking['Booking']['comment_total_insentive_customer'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['insentive_to_customer_on_plc_amt']!=""){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Incentive payable to Customer in PLC</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['insentive_to_customer_on_plc']!="0"){ echo $booking['Booking']['insentive_to_customer_on_plc']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_customer_on_plc']?>
            %</td>
          <td align="left" style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <?=$booking['Booking']['insentive_to_customer_on_plc_amt'];?>
            <? if($booking['Booking']['comment_insentive_to_customer_on_plc']!=""){ echo "(".$booking['Booking']['comment_insentive_to_customer_on_plc'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['insentive_to_customer_on_car_amt']!=""){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo; Incentive payable to Customer in Car Parking </td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['insentive_to_customer_on_car']!="0"){ echo $booking['Booking']['insentive_to_customer_on_car']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_customer_on_car']?>
            %</td>
          <td style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <?=$booking['Booking']['insentive_to_customer_on_car_amt'];?>
            <? if($booking['Booking']['comment_insentive_to_customer_on_car']!=""){ echo "(".$booking['Booking']['comment_insentive_to_customer_on_car'].")";}?></td>
        </tr>
        <? }}?>
        
       
	    <!-- Insentive to customer end-->
	   
	   
	    <!-- Commission to sub broker start-->
		
		
        <tr>
          <td>&nbsp;</td>
          <td><strong>Sub Broker <? if ($booking['Booking']['subbroker_name']!="") echo "(".$booking['Booking']['subbroker_name'].")";?></strong></td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <? if($booking['Booking']['broker_commission_plc_percentage']!="0"){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo;Brokerage payable to Sub Broker in PLC</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['broker_commission_plc_percentage']!="0"){ echo $booking['Booking']['broker_commission_plc_percentage']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['broker_commission_plc_percentage']?>
            %</td>
          <td style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['broker_commission_plc_amount'];?>
            <? if($booking['Booking']['comment_total_commission_subbroker_plc']!=""){ echo "(".$booking['Booking']['comment_total_commission_subbroker_plc'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['broker_commission_carparking_percentage']!="0"){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo;Brokerage payable to Sub Broker in Car Parking</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['broker_commission_carparking_percentage']!="0"){ echo $booking['Booking']['broker_commission_carparking_percentage']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['broker_commission_carparking_percentage']?>
            %</td>
          <td style="text-transform:capitalize;">=&nbsp; <strong><img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['broker_commission_carparking_amount'];?>
            <? if($booking['Booking']['comment_total_commission_subbroker_cp']!=""){ echo "(".$booking['Booking']['comment_total_commission_subbroker_cp'].")";}?></td>
        </tr>
        <? }?>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Total Brokerage to Sub Broker</strong></td>
          <td valign="top" nowrap="nowrap"><strong>
            <? if ($booking['Booking']['broker_commission_percentage']!="0"){ echo $booking['Booking']['broker_commission_percentage']; }else{ echo "N/A";}?>
		  			
			<? //=$booking['Booking']['broker_commission_percentage']?>
            %</strong></td>
          <td align="left"><strong>=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" />
            <? if($booking['Booking']['commission_to_subbroker']==""){ echo $brosubbro="0.00"; }else{ echo $brosubbro=$booking['Booking']['commission_to_subbroker'];}?>
            <span style="text-transform:capitalize;">
            <? if($booking['Booking']['comment_total_commission_subbroker']!=""){ echo "(".$booking['Booking']['comment_total_commission_subbroker'].")";}?>
            </span></strong></td>
        </tr>
		
		 <!-- Commission to sub broker end-->
		 
		 <!-- Insentive to sub broker start-->
		 <? if($booking['Booking']['insentive_to_subbroker_amt']!="" || $booking['Booking']['insentive_to_broker_on_plc_amt']!="" ||  $booking['Booking']['insentive_to_broker_on_car_amt']!=""){?>		 
		<tr>
          <td>&nbsp;</td>
          <td><strong> Incentive To Sub Broker <? if ($booking['Booking']['subbroker_name']!="") echo "(".$booking['Booking']['subbroker_name'].")";?></strong></td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <? if($booking['Booking']['insentive_to_subbroker_amt']!=""){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo;Incentive payable to Sub Broker in Bsp</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['insentive_to_subbroker_per']!="0"){ echo $booking['Booking']['insentive_to_subbroker_per']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_subbroker_per']?>
            %</td>
          <td style="text-transform:capitalize;">=&nbsp; <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['insentive_to_subbroker_amt'];?>
            <? if($booking['Booking']['comment_insentive_to_subbroker_per']!=""){ echo "(".$booking['Booking']['comment_insentive_to_subbroker_per'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['insentive_to_broker_on_plc_amt']!=""){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo;Incentive payable to Sub Broker in PLC</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['insentive_to_broker_on_plc']!="0"){ echo $booking['Booking']['insentive_to_broker_on_plc']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_broker_on_plc']?> %</td>
          <td style="text-transform:capitalize;">=&nbsp; <strong><img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['insentive_to_broker_on_plc_amt'];?>
            <? if($booking['Booking']['comment_insentive_to_broker_on_plc']!=""){ echo "(".$booking['Booking']['comment_insentive_to_broker_on_plc'].")";}?></td>
        </tr>
        <? }if($booking['Booking']['insentive_to_broker_on_car_amt']!=""){?>
        <tr>
          <td width="49">&nbsp;</td>
          <td>&nbsp;&nbsp;  &raquo;Incentive payable to Sub Broker in Car Parking</td>
          <td valign="top" nowrap="nowrap" style="text-transform:capitalize;">
		  <? if ($booking['Booking']['insentive_to_broker_on_car']!="0"){ echo $booking['Booking']['insentive_to_broker_on_car']; }else{ echo "N/A";}?>
		  
		  <? //=$booking['Booking']['insentive_to_broker_on_car']?> %</td>
          <td style="text-transform:capitalize;">=&nbsp; <strong><img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /></strong>
            <?=$booking['Booking']['insentive_to_broker_on_car_amt'];?>
            <? if($booking['Booking']['comment_insentive_to_broker_on_car']!=""){ echo "(".$booking['Booking']['comment_insentive_to_broker_on_car'].")";}?></td>
        </tr>
        <? }}?>
		<!-- Insentive to sub broker end-->
        
        <tr>
          <td width="49">&nbsp;</td>
          <td style="text-transform:capitalize;">Credit Note </td>
          <td colspan="3"><span style="text-transform:capitalize;">
            <? if($booking['Booking']['credit_note_given']!=""){ echo $booking['Booking']['credit_note_given']; }else{ echo "N/A"; }?>
            </span></td>
        </tr>
        <tr>
          <td width="49">&nbsp;</td>
          <td style="text-transform:capitalize;" valign="top">PDC </td>
          <td colspan="3"><? if($booking['Booking']['pdc_details']=='yes'){?>
            Cheque No. -
            <?=$booking['Booking']['pdc_check_no']?>
            &nbsp;of Rs.
            <?=$booking['Booking']['pdc_amount']?>
            <br/>
            Drawn on
            <?=strtoupper($booking['Booking']['pdc_bank'])?>
            &nbsp;Dt to <? echo date("d/m/y",strtotime($booking['Booking']['pdc_date']));?> to
            <?=strtoupper($booking['Booking']['pdc_name']);}else{ echo "N/A"; }?></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" style="text-transform:capitalize;">Balance Brokerage( Incoming- outgoing) </td>
         <?php /*?> <td colspan="2">=<?=$booking['Booking']['commission_from_company']?> - <?=$comm+$bro+$totalbroeragefinal+$brosubbro?>=<?=$bhat=$booking['Booking']['commission_from_company']-$comm-$bro-$totalbroeragefinal-$brosubbro?></td><?php */?>
		  <? $comm=$totalbroeragefinal+$booking['Booking']['customer_commission_plc_amount']+$booking['Booking']['customer_commission_carparking_amount'];?>
		  <? $bro=$booking['Booking']['commission_to_subbroker']+$booking['Booking']['broker_commission_plc_amount']+$booking['Booking']['broker_commission_carparking_amount'];?>
		  <td colspan="2">=
		  <?=round($booking['Booking']['commission_from_company'])?> - <?=round($comm+$bro)?>=<?=$bhat=round($booking['Booking']['commission_from_company']-$comm-$bro)?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-transform:capitalize;">Balance Incentive </td>
          <td>&nbsp;</td>
          <td colspan="2">=<?=$pqr=($booking['Booking']['insentive_from_comp']-($booking['Booking']['insentive_to_customer_amt']+$booking['Booking']['insentive_to_customer_on_plc_amt']+$booking['Booking']['insentive_to_customer_on_car_amt']+$booking['Booking']['insentive_to_subbroker_amt']+$booking['Booking']['insentive_to_broker_on_plc_amt']+$booking['Booking']['insentive_to_broker_on_car_amt']))?>
		  <? //if ($booking['Booking']['insentive_from']!=""){ echo $booking['Booking']['insentive_from']; }else{ echo "0";}?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-transform:capitalize;">HCO Projection </td>
          <td>&nbsp;</td>
          <td colspan="2"><strong>= <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /> <?=round($bhat+$pqr)?>
         </strong></td>
        </tr>
		<tr>
          <td>&nbsp;</td>
          <td colspan="4"><? if($booking['Booking']['final_remark']!=""){ echo "<strong>Remark:  </strong>".$booking['Booking']['final_remark'];}?></td>
        </tr>
      </table></td>
        <td width="26%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">Total</td>
              </tr>
              <tr>
                <td><table width="97%"  border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
                    <tr>
                      <td width="40%" align="center"><strong>Customer <br/>
                        <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /> <?=$comm;?></strong></td>
                      <td width="60%" align="center"><strong>Sub Broker <br/>
                        <img src="<?=SITE_PATH?>images/rupee.png" width="7" height="10" /> <?=$bro;?></strong></td>
                    </tr>
                  </table></td>
              </tr>
          </table></td>
      </tr>
    </table></td>
	 
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%">&nbsp;</td>
        </tr>
        <tr>
          <td style="width:24%"><strong>Customer Profile Given</strong></td>
          <td style="width:50% !important"><table width="39%" height="46" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td><?=$booking['Booking']['customer_profile_given']?></td>
				
              </tr>
            </table><br><br></td>
			
			</tr>
		<tr>
          <td width="24%"><strong>Account's Verification</strong></td>
          <td width="76%"><table width="39%" height="46" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
		
		<!--<tr>
          <td width="24%"><strong>Other</strong></td>
          <td width="76%">&nbsp;</td>
        </tr>-->
        <tr>
          <td>Cheque Clearance Status</td>
          <td><?   if($booking['Booking']['cheque_clearance_status']=="pending"){ echo $booking['Booking']['cheque_clearance_status'].'<table width="39%" height="46" border="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td>&nbsp;</td>
				
              </tr>
            </table>';}else{ if( $booking['Booking']['cheque_clearance_status_date']!=NULL ) {echo "Dated on ". date("d/m/y",strtotime($booking['Booking']['cheque_clearance_status_date']));}}?>          </td>
        </tr>
        <tr>
          <td>Messaging Clearance Status</td>
          <td><? if($booking['Booking']['message_clearance_status']=='pending'){ echo $booking['Booking']['message_clearance_status'].'<table width="39%" height="46" border="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td>&nbsp;</td>
				
              </tr>
            </table>'; }else { if($booking['Booking']['message_clearance_status_date']!='0000-00-00 00:00:00') {echo "Dated on ". date("d/m/y",strtotime($booking['Booking']['message_clearance_status_date'])); echo $booking['Booking']['message_clearance_comment'];}}?>          </td>
        </tr>

         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td width="24%">Prepared By</td>
          <td width="76%"><table width="39%" height="46" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td>&nbsp;<?=$booking['Booking']['prepared_by']?></td>
              </tr>
            </table></td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
   
        <tr>
          <td>Booked by</td>
          <td style="text-transform:uppercase;"><strong>
            <?=$booking['User']['name'].' '.$booking['User']['last_name']?>
            <? if($booking['Booking']['booked_by_2']!="-1"){ echo " / "?>
            <? echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$booking['Booking']['booked_by_2'])); ?>
            <? }?>
            <? if($booking['Booking']['booked_by_3']!="-1"){ echo " / "?>
            <? echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$booking['Booking']['booked_by_3'])); ?>
            <? }?>
            </strong></td>
        </tr>
        <tr>
          <td>Signature</td>
          <td><table width="39%" height="46" border="1" cellpadding="1" cellspacing="1" style="border-collapse:collapse; border:#999 1px solid;">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        
		<tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		
        <tr>
          <td>Source of booking</td>
          <td><strong>
            <?=strtoupper($booking['Booking']['booking_source'])?>
            </strong></td>
        </tr>
        <tr>
          <td>Booking Form</td>
          <td><table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="33%" align="left"><? if($booking['Booking']['stamp']!="false"){?>
                  <img src="<?=SITE_PATH?>images/activeuser.png" class="pad8L" />
                  <? }else{?>
                  <img src="<?=SITE_PATH?>images/inactive.png" width="18px" height="18px" />
                  <? }?></td>
                <td width="33%" align="left"><? if($booking['Booking']['signature']!="false"){?>
                  <img src="<?=SITE_PATH?>images/activeuser.png" class="pad15L" />
                  <? }else{?>
                  <img src="<?=SITE_PATH?>images/inactive.png" width="18px" height="18px" />
                  <? }?></td>
                <td width="34%" align="left"><? if($booking['Booking']['contact_no_checkbox']!="false"){?>
                  <img src="<?=SITE_PATH?>images/activeuser.png" class="pad15L"  />
                  <? }else{?>
                  <img src="<?=SITE_PATH?>images/inactive.png" width="18px" height="18px" />
                  <? }?></td>
				  <td width="34%" rowspan="2" nowrap="nowrap" valign="middle" align="center"><strong><? if($booking['Booking']['commission_from_type']=='broker'){ echo "( Through ".$booking['BrokerCompany']['name']." )";}?></strong></td>
              </tr>
              <tr>
                <td align="left">Stamp</td>
                <td align="left">Signature</td>
                <td align="left">Contact No.</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="44">Verified by</td>
          <td><? if($booking['Booking']['verify_by']!=""){?>
            <img src="<?=SITE_PATH?>images/activeuser.png" /> <strong> BY
            <?=$booking['Booking']['verify_by']?>
            </strong>
            <? }else{?>
            <img src="<?=SITE_PATH?>images/inactive.png" width="18px" height="18px" />
            <? }?></td>
        </tr>
        <tr>
          <td height="42">Authorized by</td>
          <td><? if($booking['Booking']['autthorized_by']!=""){?>
            <img src="<?=SITE_PATH?>images/activeuser.png"/> <strong> BY
            <?=$booking['Booking']['autthorized_by']?>
            </strong>
            <? }else{?>
            <img src="<?=SITE_PATH?>images/inactive.png" width="18px" height="18px" />
            <? }?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" style="border-style:double;"></td>
  </tr>
  <tr>
    <td colspan="2"><a href="javascript:window.print()">Print this Page</a></td>
  </tr>
</table>
</body>
</html>
