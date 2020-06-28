<?php
$this->load->view('section/vw_header_1');
?>
<style>
header {
z-index: 1111;
}
.modal {
z-index: 1111;
}
.lb-data .lb-number{display:none !important;}
.lb-nav { display: none !important; }
.lb-nav a.lb-prev {display: none !important;}
.lb-nav a.lb-next {display: none !important;}
.serbody { display: table; width:100%}
.add_services {
	display: inline-block;
	width: 24%;
	vertical-align: top;
	padding-bottom: 15px;
}
.add_services ul {  padding:0px; margin:0px; list-style-type:none;}
.add_services ul li { }
.add_services ul li a:hover{ color:#6F40F0; }
.mb-3{ margin-bottom:30px;}
.mt-3{ margin-top:30px;}
#tableAddNewSectionTbodyId input {
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	padding: 4px;
	display: inline-block;
	vertical-align: top;
	margin-right: 10px;
     display: inline-block;
    vertical-align: middle;
    width:100px; text-align:right;
}
#tableAddNewSectionTbodyId input.sectionHeaderRecd{
	width: 250px;
	text-align: left;
}
.btn-mansi{ background:#6f5e4d; border-color:#6f5e4d; color:#fff;}
.btn-mansi:hover { color:#fff;}
.sectionHeaderRecd { min-width:100px; font-weight:bold; display:inline-block; margin-bottom:15px; margin-top:15px;}
.divId_SectionRow {
	/* border-bottom: solid 1px #e3e3e3; */
	padding: 15px 30px;
	background: #f0f0f0;
	margin-bottom: 15px;
}
 .btn-mansi:focus { color:#fff;}
 
  .breadcrumb {
	background-color: #cacaca;
	}

.profile-nav {
	display: table;
	 width: 100%; 
}
.table-responsive {
	min-height: .01%;
	overflow-x: visible;
}
.tblClsToolTip td{ vertical-align:top; text-align:left; padding:8px;}
.tblClsToolTip{ width:500px}
.popover-content {
	min-width: 100px;
	max-width: 100%;
}

#pricingSection div span{
    padding: 0 5px;
}
@media only screen and (max-width :767px) {
 .select_tabs span { display:inline-block; margin-bottom:5px;white-space: inherit;}   
 .add_services { width:49%;}  
 .sectionHeaderRecd { display:block;}
 .divId_SectionRow { padding:15px;}
 strong.s-cost { display:block;}
 .tblClsToolTip{ width:300px}
 .popover-content {
		padding: 9px 14px;
		max-height: 300px;
		overflow: auto;
	}
	.tooltip-inner {
		padding: 9px 14px;
		max-height: 300px;
		overflow: auto;
	}
}

input[readonly]{
    background-color: transparent;
    border: none !important;
}
</style>
<?php
$this->load->view('section/vw_header_2');
//print_r($brand_details);
 if($rsBoqBuildDetails['status']=='7'){
        $boq_generated_txt ='BOQ generated at ';
        $starting_from_txt = '';
    }else{
        $boq_generated_txt ='Tentative BOQ generated at ';
        $starting_from_txt = 'Starting from:';
    }
?>
<!--------------[ Middle Section ]------------->

<section class="profile-section">
     <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">BOQ Builder</a></li>
       <li><a href="">BOQ Details</a></li>
      </ol>
    </div>
	<?php if(in_array($userType,array('Agent'))==1){?>
	 <div class="profile-nav">
   		<div class="container">
         	 <!--<ul>
            	<li class="active"> <a href="< ?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">List BOQs</a> </li>	 
            </ul>-->
         </div>
   </div>  
	<?php }else{?>
   <div class="profile-nav">
   		 <div class="container">
         	<ul>
            	<li> <a href="<?php echo base_url();?>profile">Profile </a> </li>	 
                <li class="active"> <a href="<?php echo base_url();?>my-orders">My Orders </a> </li>	
                <li> <a href="<?php echo base_url();?>my-favourites">My favourites </a> </li>	 
            	<li> <a href="<?php echo base_url();?>signout">Sign Out</a> </li>	
            </ul>
         </div>
   </div> 
   <?php }?>
    
		<!--.container/-->
    <div class="container">   
	<form method="post" name="generateBoqFrm" id="generateBoqFrm" class="form-horizontal" 
	action="<?php echo base_url().'newBoqBuilderDetailsAction/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">
		<input type="hidden" name="idBoqBuild" id="idBoqBuild" value="<?=$idBoqBuild?>" /> 
		<input type="hidden" name="orderId" id="orderId" value="<?=$orderId?>" /> 
		<input type="hidden" name="userType" id="userType" value="<?=$userType?>" /> 
		<input type="hidden" name="userAccountId" id="userAccountId" value="<?=$userAccountId?>" /> 
		<input type="hidden" name="base_url" id="base_url" value="<?=base_url();?>" />
		<input type="hidden" name="stringSectionArrList" id="stringSectionArrList" value="<?=$stringSectionArrList;?>" /> 
		 
       <!--.row/-->
	  <div class="row clearfix" >
	  
	    <?php if($this->session->userdata('MSG')){ 
           echo $this->session->userdata('MSG');
           $this->session->unset_userdata('MSG');
       } ?>
        <div class="col-md-10 col-xs-6  mt-3" >
            <h4 style="margin-bottom:0px;"> <strong>BOQ Details</strong></h4>
		 </div>
		  <div class="col-md-2 col-xs-6 mt-3">
           <a href="<?=base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" class="btn btn-default btn-sm">Go back to BOQ Listing</a>
		 </div>
		</div>
		
		<div class="row clearfix" >
        <div class="col-md-6  col-xs-12 mt-3">
            <lable class="sectionHeaderRecd"><?=$rsBoqBuildDetails['boqName']?$rsBoqBuildDetails['boqName']:'- -';?></lable> 
            <?=$rsBoqBuildDetails['executionPartnerName']?'<br>Partner Name - '.$rsBoqBuildDetails['executionPartnerName']:''?>
        </div>
		<div class="col-md-6 col-xs-12 text-right mt-3 ">
            <h4><span><strong><?=$starting_from_txt?>&nbsp;</strong><lable id="buildBoqTotalPrice"><?php echo number_format($rsBoqBuildDetails['finalTotal'],2);?></lable> (INR)</span>
            </h4>
        </div>
	
		
		<div class="col-xs-12 mt-3">
<!--             <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"  class="btn btn-mansi btn-sm">
			 Add New Section <span class="fa fa-plus"></span></a>	-->
			 <a href="<?=base_url().'downloadBoqBuilder/'.$orderId.'/'.$userType.'/'.$userAccountId.'/BOQ/'.$idBoqBuild;?>" 
			 class="btn btn-default btn-sm pull-right">Download BOQ</a>
        </div>

			</div>
		<div class=" clearfix" id="tableAddNewSectionTbodyId" >
		<p>&nbsp;</p> 
<!--                <pre><?php print_r($arrBOQBuildDtlsSectionHeaderWiseListing)?></pre>-->
		<?php  
		$n = 0;
		/*[Start::SectionHeaderListing:]*/
		foreach($arrBOQBuildDtlsSectionHeaderWiseListing as $key=>$sectionHeaderRecd)
		{
			//var:
			$n = $key+1;
			$varTotalSectionPriceCost = 0;
		?>
		<div class="divId_SectionRow clearfix" id="divIdSectionRow<?php echo $n;?>">
        <div class="row">
			<div class="col-md-11 col-xs-10"> 
                            <input class="sectionHeaderRecd" type="text" readonly="" value="<?=$sectionHeaderRecd['section_name']?$sectionHeaderRecd['section_name']:'- -';?>" />
			<!--<span class="sectionHeaderRecd">< ?php echo $sectionHeaderRecd['section_name'];?> </span>-->
			 <input type="hidden" name="sectionList[<?=$n;?>][id]" id="sectionListId" value="<?php echo $sectionHeaderRecd['section_id'];?>" />
			 <input type="text" readonly="" value="<?=$sectionHeaderRecd['section_length']?$sectionHeaderRecd['section_length']:'- -';?>" />
			 <input type="text" readonly="" value="<?=$sectionHeaderRecd['section_breadth']?$sectionHeaderRecd['section_breadth']:'- -';?>"/>
			</div>
			
				
			<div class="col-xs-12 table-responsive" style="margin-top:10px;">
			<div style="display:none; text-align:center; text-align: center;position: absolute;margin: 0 auto;width: 100px;left: 0;right: 0;" id="divLoaderId<?php echo $n;?>"><img src="<?php echo base_url().SitePath ; ?>assets/img/infinity-loader-200px.gif" 
			alt="loading" width="85" /></div>
            <table class="table table-bordered table-striped">
				<tbody id="tableListOfSectionServiceScopeTbodyId<?php echo $n;?>">
				<?php 
			if(!empty($sectionHeaderRecd['arrSectionServiceList']))
			{
			?>
				<?php 
				foreach($sectionHeaderRecd['arrSectionServiceList'] as $i=>$serviceRecd)
				{	//var:
					$varTotalSectionPriceCost+=$serviceRecd['price'];  
				?>
					<tr id="tableTrTdSectionServiceScopeRowId<?php echo $n;?><?=$serviceRecd['id'];?>">
						<td style="width:250px;" ><a href="javascript:void(0);" title="<?php echo $serviceRecd['scopeTxt'];?>">
							<?php echo $serviceRecd['scopeTxt'];?></a>
							
						</td>
						<td style="width:400px;"><a href="javascript:void(0);" data-toggle="tooltip" data-trigger="hover" data-html="true" data-placement="right"  
						title='<em><table class="tblClsToolTip"><tr><td>Description:</td><td><?=str_replace(array('"',"'"),'&Prime;',$serviceRecd['descriptionTxt']);?></td></tr><?php if($serviceRecd['specificationTxt']){?><tr><td>Specification:</td><td><?=str_replace('"','&Prime;',$serviceRecd['specificationTxt']);?></td></tr><?php }if($serviceRecd['brandTxt']){?><tr><td>Brand:</td><td><?=str_replace('"','&Prime;',$serviceRecd['brandTxt']);?></td></tr><?php }?></table></em>'> 
							<?php echo $serviceRecd['descriptionTxt'];?></a>  
						</td>
						<td><a href="javascript:void(0);" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo $serviceRecd['cost_profileTxt'];?>">
							<?php echo substr($serviceRecd['cost_profileTxt'],0,16);echo ((strlen($serviceRecd['cost_profileTxt'])>16)?'...':'');?></a>
						</td>
						<td style="text-align:right;">
                                                    <input type="text" readonly="" value="<?=$serviceRecd['reqNumber']?$serviceRecd['reqNumber']:'- -';?>" maxlength="3" style="text-align: right;" />
						<br /> &nbsp; <small><?php echo $serviceRecd['reqNumberUnitTxt'];?></small>
						</td>
						<td style="text-align: right;" ><?php echo number_format($serviceRecd['price'],2);?>&nbsp;(INR)</td>
					</tr>
				<?php 
				}//endSubforeach;
				?>	
				<?php 
			}//end~~empty($sectionHeaderRecd['arrSectionList']);
			?>
				</tbody>
			</table>
			</div>
			
			<div class="col-md-8 col-xs-6" style="margin-top:10px;">
            	
        	</div>
			<div class="col-md-4 col-xs-6" style="margin-top:10px; text-align:right">
			  <strong class="s-cost"> Section Cost:&nbsp;</strong><lable id="sectionTotalCost<?=$n;?>"><?php echo number_format($varTotalSectionPriceCost,2);?></lable>&nbsp;(INR)
        	</div>
			</div>
        </div>
		
		<?php 
		}
		/*[End::SectionHeaderListing:]*/
		?>
		</div>
		<input type="hidden" name="numOfNewSectionRow" id="numOfNewSectionRow" value="<?=$n;?>" />
		<div class=" mt-3 clearfix" >
            	
             <br /><br /> 
             
            
             <div class="clearfix " id="pricingSection" >
                 <?=$additionalPricingSection?$additionalPricingSection:''?>
            </div>
             
             <?php if(!empty($milestoneList)){?>
              <div class="clearfix ">
                  <h4> <strong>Milestone</strong></h4>
                  <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Milestone Stage</th>
                              <th>Milestone Description</th>
                              <th>Percentage Payment</th>
                          </tr>
                      </thead>
                      <tbody>
                <?php foreach ($milestoneList as $milestone){?>
                          <tr>
                              <td><?=$milestone['milestone_stage']?></td>
                              <td><?=$milestone['milestone_desc']?></td>
                              <td><?=$milestone['milestone_percent']?></td>
                          </tr>
                <?php }?>
                        </tbody>
                  </table>
                  </div>
             <?php }?>
             
             
             <?php if(!empty($noteTnC)){?>
              <div class="clearfix ">
                  <h4> <strong>Terms and Conditions</strong></h4>
                  <?=$noteTnC?>
                  </div>
             <?php }?>
            
             <?php if(!empty($changeRequestList)){?>
              <div class="clearfix ">
                  <h4> <strong>Change Requests</strong></h4>
                  <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Description</th>
                              <th>Amount</th>
                          </tr>
                      </thead>
                      <tbody>
                <?php foreach ($changeRequestList as $changeRequest){?>
                          <tr>
                              <td><?=$changeRequest['description']?></td>
                              <td><?=$changeRequest['amount']?></td>
                          </tr>
                <?php }?>
                        </tbody>
                  </table>
                  </div>
             <?php }?>
             
             
             
			<strong><?=$boq_generated_txt?> <?=date('d/m/Y H:i:s',strtotime($rsBoqBuildDetails['onDateTime']));?></strong>
					  <!--<a href=" < ?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" 
					  class="btn btn-default btn-sm">Cancel</a>	-->
        </div>
	  </form>
      </div>
	  <!--/row.-->
    </div>
	<!--/container.-->
  </section>

<link rel="stylesheet" type="text/css" href="<?php echo base_url().SitePath; ?>assets/css/lightbox.min.css" />
<script src="<?php echo base_url().SitePath; ?>assets/js/lightbox-plus-jquery.min.js"></script> 
<style type="text/css">
.tooltip-inner {
	min-width: 100px;
	max-width: 100%;
	z-index: 100; 
}

@media (max-width: 320px) {
	.tooltip-inner {
		min-width: initial;
		max-width: 320px;
	}
}
</style>
<script>
    lightbox.option({
      'alwaysShowNavOnTouchDevices': false
    })
</script>
<script type="text/javascript">
$(document).on('mouseover','[data-toggle="tooltip"]',function(e){
   var targetDiv = $(this).tooltip();
//var targetDiv = $(this).popover();
	
    //console.log(targetDiv);
});
</script>
<?php
$this->load->view('section/vw_footer');
?>