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

</style>
<?php
$this->load->view('section/vw_header_2');
//print_r($brand_details);

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
	<?php if(in_array($userType,array('Agent','Executioner'))==1){?>
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
            <input type="text" class="form-control" name="boqName" id="boqName" value="<?=$rsBoqBuildDetails['boqName'];?>" placeholder="BOQ Name..." 
			onblur="ajaxAutoSaveBOQ('boqNameUpdt','boqName',$(this).val());">
        </div>
		<div class="col-md-6 col-xs-12 text-right mt-3 ">
            <h4><span><strong>Starting from:&nbsp;</strong><lable id="buildBoqTotalPrice"><?php echo number_format($rsBoqBuildDetails['finalTotal'],2);?></lable> (INR)</span>
            </h4>
        </div>
	
		
		<div class="col-xs-12 mt-3">
             <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"  class="btn btn-mansi btn-sm">
			 Add New Section <span class="fa fa-plus"></span></a>	
			 <a href="<?=base_url().'downloadBoqBuilder/'.$orderId.'/'.$userType.'/'.$userAccountId.'/BOQ/'.$idBoqBuild;?>" 
			 class="btn btn-default btn-sm pull-right">Download BOQ</a>
        </div>

			</div>
		<div class=" clearfix" id="tableAddNewSectionTbodyId" >
		<p>&nbsp;</p> 
		
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
			<input class="sectionHeaderRecd" type="text" name="sectionList[<?=$n;?>][name]" id="sectionListName" value="<?php echo $sectionHeaderRecd['section_name'];?>" 
			onblur="ajaxAutoSaveBOQ('boqSectionNameUpdt','section_title',$(this).val(),<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>);"/>
			<!--<span class="sectionHeaderRecd">< ?php echo $sectionHeaderRecd['section_name'];?> </span>-->
			 <input type="hidden" name="sectionList[<?=$n;?>][id]" id="sectionListId" value="<?php echo $sectionHeaderRecd['section_id'];?>" />
			 <input type="text" name="sectionList[<?=$n;?>][length]" id="sectionListLength" value="<?php echo $sectionHeaderRecd['section_length'];?>" placeholder="Length (ft.)"
			 onblur="ajaxAutoSaveBOQ('boqLengthUpdt','length',$(this).val(),<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>);"
			 oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
			 <input type="text" name="sectionList[<?=$n;?>][breadth]" id="sectionListBreadth" value="<?php echo $sectionHeaderRecd['section_breadth'];?>" 
			 placeholder="Breadth (ft.)"
			 onblur="ajaxAutoSaveBOQ('boqBreadthUpdt','breadth',$(this).val(),<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>);"
			 oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
			</div>
			<div class="col-md-1  col-xs-2 text-right" > 	
			 <a href="javascript:void(0);" class="btn btn-default btn-sm" title="Remove Section" onclick="funMinusSectionRow('<?=$n;?>','<?=$sectionHeaderRecd['section_mapp_id'];?>','<?=$sectionHeaderRecd['section_id'];?>')" 
				><span class="fa fa-minus"></span></a>
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
							<br />
				<a href="javascript:void(0);" data-toggle="modal" data-target="#myModalUpdateSpecsFromServiceScopeJobId" class="btn btn-mansi btn-sm"
				 style="font-size:8px; line-height: 0.5;" alt="Update Specs" onClick="funUpdateSpecs(<?=$serviceRecd['id'];?>,<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>,'<?=str_replace("'","&lsquo;",$sectionHeaderRecd['section_name']);?>',<?=$serviceRecd['job_id'];?>,'<?=str_replace("'","&lsquo;",$serviceRecd['scopeTxt']);?>');"
				>Update Specs</a>
						</td>
						<td style="width:400px;"><a href="javascript:void(0);" data-toggle="tooltip" data-trigger="hover" data-html="true" data-placement="right"  
						title='<em><table class="tblClsToolTip"><tr><td>Description:</td><td><?=str_replace(array('"',"'"),'&Prime;',$serviceRecd['descriptionTxt']);?></td></tr><?php if($serviceRecd['specificationTxt']){?><tr><td>Specification:</td><td><?=str_replace('"','&Prime;',$serviceRecd['specificationTxt']);?></td></tr><?php }if($serviceRecd['brandTxt']){?><tr><td>Brand:</td><td><?=str_replace('"','&Prime;',$serviceRecd['brandTxt']);?></td></tr><?php }?></table></em>'> 
							<?php echo $serviceRecd['descriptionTxt'];?></a>  
						</td>
						<td><a href="javascript:void(0);" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo $serviceRecd['cost_profileTxt'];?>">
							<?php echo substr($serviceRecd['cost_profileTxt'],0,16);echo ((strlen($serviceRecd['cost_profileTxt'])>16)?'...':'');?></a>
						</td>
						<td style="text-align:right;">
						<input type="text" name="reqNumber" id="reqNumber" value="<?php echo $serviceRecd['reqNumber'];?>" placeholder="000" maxlength="3" 
						style="text-align: right;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
						onblur="ajaxAutoSaveBOQ('boqSectionServiceUI','reqNumber',$(this).val(),<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>,<?=$serviceRecd['id'];?>,<?=$n.$serviceRecd['id'];?>);" />
						<br /> &nbsp; <small><?php echo $serviceRecd['reqNumberUnitTxt'];?></small>
						</td>
						<td style="text-align: right;" ><?php echo number_format($serviceRecd['price'],2);?>&nbsp;(INR)</td>
						<td class="text-right"> <a href="javascript:void(0);" class="btn btn-info btn-sm" title="Remove Service" 
						onclick="funMinusSectionServiceRow(<?=$serviceRecd['id'];?>,<?php echo $sectionHeaderRecd['section_mapp_id'];?>,<?php echo $sectionHeaderRecd['section_id'];?>,<?php echo $n;?>);" 
						style="background-color:#FFF;border-color:#243f71; color:#000000"><span class="fa fa-trash"></span></a></td>
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
            <a href="javascript:void(0);" onclick="funAddMoreServiceRow(<?=$sectionHeaderRecd['section_mapp_id'];?>,<?=$sectionHeaderRecd['section_id'];?>,<?=$n;?>,'<?=str_replace("'","&lsquo;",$sectionHeaderRecd['section_name']);?>');" data-toggle="modal" data-target="#myModalAddNewService"  class="btn btn-default btn-sm">
			 Add New Service <span class="fa fa-plus"></span></a>	
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
            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"  class="btn btn-mansi btn-sm"
			>
			 Add New Section <span class="fa fa-plus"></span></a>	
             <br /><br /> 
             
<!--             <div class="row">
            <div class="col-md-12">
                <h4>
                    <strong>Additional Pricing</strong>
                </h4>
            </div>
            </div>-->
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
             
			<strong>Tentative BOQ generated at <?=date('d/m/Y H:i:s',strtotime($rsBoqBuildDetails['onDateTime']));?></strong>
					  <!--<a href=" < ?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" 
					  class="btn btn-default btn-sm">Cancel</a>	-->
        </div>
	  </form>
      </div>
	  <!--/row.-->
    </div>
	<!--/container.-->
  </section>

<!--[*start::boostrapPopup*]-->
<div id="myModal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.3);" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" id="myModalClose" class="close" data-dismiss="modal" onclick="$('#serviceRecdId').val('');">&times;</button>
        <h4 class="modal-title" style="color:#000000">Add New Section:</h4>
      </div>
      <div class="modal-body serbody">
              <!--.sectionListing/-->
			<?php foreach($arrListBOQSectionHeader as $key=>$arrData){?>
            <div class="add_services">
			
			  
			  <ul class="w3-ul">
			  <li><strong><?php echo $arrData['section_header'];?></strong></li>
				<?php foreach($arrData['arrSectionList'] as $key=>$subArrData){?>
				<li><a href="javascript:void(0);" onClick="funAddMoreSectionRow(<?php echo $subArrData['section_id'];?>,'<?php echo str_replace("'","&lsquo;",$subArrData['section']);?>');" id="add_more_row" alt="<?php echo $subArrData['section'];?>"><?php echo $subArrData['section'];?></a> </li>
				<?php }?>
			  </ul>
			</div>
			<?php }?>
			 <!--/sectionListing.-->
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<!--[*end::boostrapPopup*]-->

<!--[*start::boostrapPopup::AddNewService*]-->
<div id="myModalAddNewService" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.3);" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" id="myModalCloseAddNewService" class="close" data-dismiss="modal" onclick="$('#serviceRecdId').val('');">&times;</button>
        <h4 class="modal-title" style="color:#000000">Add New Service :: <span id="lableSectionTitleServicePopup"></span></h4>
      </div>
      <div class="modal-body serbody">
              <!--.sectionServiceListing/-->
			<?php foreach($arrListBOQSectionServiceScopeHeader as $key=>$arrData){?>
             <div class="add_services">
			  <ul class="w3-ul">
			  <li><strong><?php echo $arrData['job'];?></strong></li>
				<?php foreach($arrData['arrSectionServieScopeList'] as $key=>$subArrData){?>
				<li> <a href="javascript:void(0);" data-toggle="modal" data-target="#myModalUpdateSpecsFromServiceScopeJobId"  
				id="add_more_row" alt="<?php echo $subArrData['scope'];?>"
				onClick="updateScopeSpecs(<?php echo $subArrData['job_id'];?>,'<?php echo str_replace("'","&lsquo;",$subArrData['scope']);?>');"
				><?php echo $subArrData['scope'];?></a> </li> <!--<a href="javascript:void(0);" -->
				<?php }?>
			  </ul>  
			</div>
			<?php }?>
			<input type="hidden" name="boqSectionItemMappId" id="boqSectionItemMappId" value="" />
			<input type="hidden" name="boqSectionItemId" id="boqSectionItemId" value="" />
			<input type="hidden" name="boqSectionItemName" id="boqSectionItemName" value="" />
			<input type="hidden" name="boqSectionItemIndex" id="boqSectionItemIndex"  value="" />
			<input type="hidden" name="serviceRecdId" id="serviceRecdId"  value="" />

			 <!--/sectionServiceListing.-->
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<!--[*end::boostrapPopup::AddNewService*]-->

<!--[*start::boostrapPopup::UpdateSpecsFromServiceScope<job_id>*]-->
<div id="myModalUpdateSpecsFromServiceScopeJobId" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.3);" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="myModalCloseUpdateSpecsFromServiceScopeJobId" class="close" data-dismiss="modal" onclick="$('#serviceRecdId').val('');">&times;</button>
        <h4 class="modal-title" style="color:#000000"><span id="lableSectionTitleServiceDtlsPopup"></span> :: <span id="lableSectionTitleServiceScopeSpecsPopup"></span></h4>
      </div>
	  
      <div class="modal-body" id="updateTableListOfJobIdScopeList" style="padding: 15px 20px;overflow-y: auto;max-height: 450px;">
              <!--.serviceScopeListingSpecs/-->
            <div class="col-xs-12 table-responsive" >
            <table class="table table-bordered table-striped">	
			<div style="display:block; text-align:center;">
			<img src="<?php echo base_url().SitePath ; ?>assets/img/infinity-loader-200px.gif" alt="loading" width="150" /></div>	
			</table>
			</div>
			 <!--/serviceScopeListingSepecs.-->
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<!--[*end::boostrapPopup::UpdateSpecFromServiceScope<job_id>*]-->

<script type="text/javascript">
/*//let arrSection = [];
//var stringSectionArrList = $('#stringSectionArrList').val();
//stringSectionArrList = stringSectionArrList.split(',');
//for(var i=0; i<stringSectionArrList.length;i++){ arrSection.push(parseInt(stringSectionArrList[i])); }*/
    	
/*[start::addSection]*/	
var funAddMoreSectionRow = function(sectionId,sectionName)
{
	 var numOfNewSectionRow = parseInt($('#numOfNewSectionRow').val()) + 1;
	 //ifcase:
	 //if($.inArray( sectionId, arrSection )=='-1')
	 //{	
		//arrSection.push(sectionId);
		
		//var:define:
		var idBoqBuild = $('#idBoqBuild').val();
		var orderId = $('#orderId').val();
		var userType = $('#userType').val();
		var userAccountId = $('#userAccountId').val();
		
		 //[start::ajax call]://
		 $.ajax({
		 url:$("#base_url").val()+'ajaxBuildBOQAddNewSection',
		 type:"POST",
		 data:{ actionType:'addNewSection',sectionId:sectionId,sectionName:sectionName,idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,numOfNewSectionRow:numOfNewSectionRow },
		 success:function(response)
		 {
			 //alert(response);
			 $('#numOfNewSectionRow').val(numOfNewSectionRow+1);
			 $('#tableAddNewSectionTbodyId').append(response);
			 $('#myModalClose').click();
			 return false;
		 },
		 error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
		 }
		});
		//[end::ajax call];// 
	 //}else{
		//$('#myModalClose').click();
	 //}
}
/*[end::addSection]*/

/*[end::removeSection]*/
var funMinusSectionRow = function(numOfNewSectionRow,sectionMappId,sectionId)
{  
	if(confirm('Are you sure you want to remove this section?'))
	{ 
		//var:define:
		var idBoqBuild = $('#idBoqBuild').val();
		var orderId = $('#orderId').val();
		var userType = $('#userType').val();
		var userAccountId = $('#userAccountId').val();
		 //loaderHideShow:
	     $('#divLoaderId'+numOfNewSectionRow).css('display','block');
	     //
		//[start::ajax call]://
		 $.ajax({
		 url:$("#base_url").val()+'ajaxBuildBOQRemoveSection',
		 type:"POST",
		 data:{ actionType:'removeSection',sectionMappId:sectionMappId,sectionId:sectionId,idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId},
		 success:function(response)
		 { 
			 data = response.split('|*|'); 
			 if(data[0]=='success'){
			 	//var index = arrSection.indexOf(parseInt(sectionId));
				//if(index > -1){ arrSection.splice(index, 1); }
				$('#divIdSectionRow'+numOfNewSectionRow).remove();
				$('#buildBoqTotalPrice').html(data[1]);
				$('#pricingSection').html(data[2]);
                               
				return true;
			 }
		 },
		 error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
		 }
		});
		//[end::ajax call];// 
		
	}
}
/*[end::removeSection]*/

/**[Start::auto save operation:]**/
function ajaxAutoSaveBOQ(actionType,key,value,boqSectionItemMappId='',boqSectionItemId='',boqSectionItemIndex='',boqServiceItemId='',boqServiceIndex='')
{
	//var:define:
    var idBoqBuild = $('#idBoqBuild').val();
    var orderId = $('#orderId').val();
	var userType = $('#userType').val();
    var userAccountId = $('#userAccountId').val();
   // alert(boqSectionItemId + ''+boqSectionItemIndex );return false;
     //[start::ajax call]://
	 $.ajax({
	 url:$("#base_url").val()+'buildBOQAjaxAutoSaveDetails',
	 type:"POST",
	 data:{ actionType:actionType,key:key,value:value,idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,boqSectionItemMappId:boqSectionItemMappId,boqSectionItemId:boqSectionItemId,boqSectionItemIndex:boqSectionItemIndex,boqServiceItemId:boqServiceItemId,boqServiceIndex:boqServiceIndex},
	 success:function(response)
	 {	  
	 	if(actionType=='boqSectionServiceUI')
		{
			funAjaxSectionServiceList(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex);
		}
		 return true;
	 },
	 error:function(e){
		alert('Please reload this page to resolved your request issues '+console.log(e.message));
	 }
	});
	//[end::ajax call];// 
}
/**[End::auto save operation;]**/	


/*[start::addService]*/	
var funAddMoreServiceRow = function(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex,sectionName)
{
	 //var numOfNewSectionRow = parseInt($('#numOfNewSectionRow').val()) + 1;
	 var sectionMappId = boqSectionItemMappId; 
	 var sectionId = boqSectionItemId; 
	 var sectionName = sectionName; 
	 boqSectionItemIndex;
	 //
	 $('#boqSectionItemMappId').val(sectionMappId); 	 
	 $('#boqSectionItemId').val(sectionId); 
	 $('#boqSectionItemName').val(sectionName);
	 $('#boqSectionItemIndex').val(boqSectionItemIndex); 
	 $('#lableSectionTitleServicePopup').html(sectionName); 
}
/*[end::addService]*/

/*[start::updateScopeSpecs]*/	
var updateScopeSpecs = function(jobId,scope,serviceRecdId)
{
	 //var:define:
     var idBoqBuild = $('#idBoqBuild').val();
     var orderId = $('#orderId').val();
	 var userType = $('#userType').val();
     var userAccountId = $('#userAccountId').val();	
	 //var:define:
	 var boqSectionItemMappId = $('#boqSectionItemMappId').val();
	 var boqSectionItemId = $('#boqSectionItemId').val(); var boqSectionItemIndex = $('#boqSectionItemIndex').val();
	 var boqSectionItemName = $('#boqSectionItemName').val();
	 var jobId = jobId; 
	 // 
	 $('#myModalCloseAddNewService').click();$('#serviceRecdId').val(serviceRecdId);
	 // 
 	 $('#lableSectionTitleServiceDtlsPopup').html(boqSectionItemName);
	 $('#lableSectionTitleServiceScopeSpecsPopup').html(scope);
	 
	 //[start::loader]:
	 $('#updateTableListOfJobIdScopeList').html('<div style="display:block; text-align:center;"><img src="'+$("#base_url").val()+'/b2c/assets/img/infinity-loader-200px.gif" alt="loading" width="150" /></div>'); 
	 //[end::loader];
	 
	 //[start::ajax call]://
	 $.ajax({
	 url:$("#base_url").val()+'getSectionServiceScopeSpecsDetailsListFromJobId',
	 type:"POST",
	 data:{ actionType:'specsList',idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,boqSectionItemMappId:boqSectionItemMappId,boqSectionItemId:boqSectionItemId,boqSectionItemIndex:boqSectionItemIndex,jobId:jobId},
	 success:function(response)
	 {	 
	 	 //[start::loader]:
	 	   $('#updateTableListOfJobIdScopeList').html('<div style="display:block; text-align:center;"><img src="'+$("#base_url").val()+'/b2c/assets/img/infinity-loader-200px.gif" alt="loading" width="150" /></div>'); 
	 	 //[end::loader];
		 
		 $('#updateTableListOfJobIdScopeList').html(response);
		 return true;
	 },
	 error:function(e){
		alert('Please reload this page to resolved your request issues '+console.log(e.message));
	 }
	});
	//[end::ajax call];// 	 
}
/*[end::updateScopeSpecs]*/

/*[start::addServiceScopeSpecDtlsRow]*/	
var funAddNewServiceScopeSpecRow = function(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex,rateCardId)
{
	 //var:define:
     var idBoqBuild = $('#idBoqBuild').val();
     var orderId = $('#orderId').val();
	 var userType = $('#userType').val();
     var userAccountId = $('#userAccountId').val();	
	 var serviceRecdId = $('#serviceRecdId').val();
	 //[start::ajax call::add new specs row service row in service list]://
	 $.ajax({
	 url:$("#base_url").val()+'ajaxAddNewScopeSpecInServiceList',
	 type:"POST",
	 data:{ actionType:'specsRowAdd',idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,boqSectionItemMappId:boqSectionItemMappId,boqSectionItemId:boqSectionItemId,boqSectionItemIndex:boqSectionItemIndex,rateCardId:rateCardId,serviceRecdId:serviceRecdId},
	 success:function(response)
	 {	  
		 if(response=='success'){ 
		 	funAjaxSectionServiceList(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex);	
			$('#serviceRecdId').val(''); $('#updateTableListOfJobIdScopeList').html();  
			return true;
		 }
	 },
	 error:function(e){
		alert('Please reload this page to resolved your request issues '+console.log(e.message));
	 }
	});
	//[end::ajax call::add new specs row service row in service list];//
}
/*[end::addServiceScopeSpecDtlsRow]*/

/*[start::funAjaxSectionServiceList]*/	
var funAjaxSectionServiceList = function(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex)
{
 	 //var:define:
     var idBoqBuild = $('#idBoqBuild').val();
     var orderId = $('#orderId').val();
	 var userType = $('#userType').val();
     var userAccountId = $('#userAccountId').val();	
	 
	 //loaderHideShow:
	 $('#divLoaderId'+boqSectionItemIndex).css('display','block');
	 //
 
 	 //[start::ajax call section ~ service list]://
	 $.ajax({
	 url:$("#base_url").val()+'ajaxSectionServiceList',
	 type:"POST",
	 data:{ actionType:'serviceList',idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,boqSectionItemMappId:boqSectionItemMappId,boqSectionItemId:boqSectionItemId,boqSectionItemIndex:boqSectionItemIndex},
	 success:function(response)
	 {
	 	 data = response.split('|*|'); 
		 $('#serviceRecdId').val('');
		 if(data[0]=='success'){ 
		 	//loaderHideShow:
			$('#divLoaderId'+boqSectionItemIndex).css('display','none');
			//
		 	$('#tableListOfSectionServiceScopeTbodyId'+boqSectionItemIndex).html(data[1]);
			$('#sectionTotalCost'+boqSectionItemIndex).html(data[2]);
			$('#buildBoqTotalPrice').html(data[3]);
			$('#pricingSection').html(data[4]);
			$('#myModalCloseUpdateSpecsFromServiceScopeJobId').click();
                        
			return true;
		 }
	 },
	 error:function(e){
		alert('Please reload this page to resolved your request issues '+console.log(e.message));
	 }
	});
	//[end::ajax call section ~ service list];//
}
/*[end::funAjaxSectionServiceList]*/

/*[start::removeSectionService]*/
var funMinusSectionServiceRow = function(serviceId,boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex)
{ 
	if(confirm('Are you sure you want to remove this service?'))
	{
		//var:define:
		var idBoqBuild = $('#idBoqBuild').val();
		var orderId = $('#orderId').val();
		var userType = $('#userType').val();
		var userAccountId = $('#userAccountId').val();
		 //loaderHideShow:
		 $('#divLoaderId'+boqSectionItemIndex).css('display','block');
		 //
		//[start::ajax call]://
		 $.ajax({
		 url:$("#base_url").val()+'ajaxBuildBOQRemoveSectionService',
		 type:"POST",
		 data:{ actionType:'removeSectionService',serviceId:serviceId,idBoqBuild:idBoqBuild,orderId:orderId,userType:userType,userAccountId:userAccountId,boqSectionItemMappId:boqSectionItemMappId,boqSectionItemId:boqSectionItemId,boqSectionItemIndex:boqSectionItemIndex},
		 success:function(response)
		 {   data = response.split('|*|');
			 if(data[0]=='success'){ 
			 	funAjaxSectionServiceList(boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex);
				return true;
			 }
		 },
		 error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
		 }
		});
		//[end::ajax call];// 
		
	}
}
/*[end::removeSectionService]*/

/*[start::updateSpecs:]*/
var funUpdateSpecs = function(serviceRecdId,boqSectionItemMappId,boqSectionItemId,boqSectionItemIndex,boqSectionItemName,jobId,jobName)
{  	    
	//var:define:
	$('#updateTableListOfJobIdScopeList').html(''); 
	$('#boqSectionItemMappId').val(boqSectionItemMappId); 
	$('#boqSectionItemId').val(boqSectionItemId); 
	$('#boqSectionItemName').val(boqSectionItemName);
	$('#boqSectionItemIndex').val(boqSectionItemIndex); 
	$('#serviceRecdId').val(serviceRecdId); 		
	$('#lableSectionTitleServicePopup').html(boqSectionItemName); 
	//
	updateScopeSpecs(jobId,jobName,serviceRecdId);
}
/*[end::updateSpecs]*/

//var funUpdateAdditionalPricingSection = function(){
//    var totalApplyPrice = parseFloat($('#totalApplyPrice').text().replace(/,/g, '')) || 0;
//    var totalSupplyPrice = parseFloat($('#buildBoqTotalPrice').text().replace(/,/g, '')) || 0;
//    var totalCost = totalApplyPrice + totalSupplyPrice;
//    var materialHandling = parseFloat($('#materialHandling').text().replace(/,/g, '')) || 0;
//    var packagingCharges = parseFloat($('#packagingCharges').text().replace(/,/g, '')) || 0;
//    var transportCharges = parseFloat($('#transportCharges').text().replace(/,/g, '')) || 0;
//    var municipalCharges = parseFloat($('#municipalCharges').text().replace(/,/g, '')) || 0;
//    var unionCharges = parseFloat($('#unionCharges').text().replace(/,/g, '')) || 0;
//    var subTotal = totalCost+materialHandling+packagingCharges+transportCharges+municipalCharges+unionCharges;
//    var gst = parseFloat($('#gst').text().replace(/,/g, '')) || 0;
//    var totalBoqCost = subTotal+gst;
//    
//    $('#totalCost').text(totalCost.toLocaleString());
//    $('#totalSupplyPrice').text(totalSupplyPrice.toLocaleString());
//    $('#subTotal').text(subTotal.toLocaleString());
//    $('#totalBoqCost').text(totalBoqCost.toLocaleString());
//    
//}
</script>
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