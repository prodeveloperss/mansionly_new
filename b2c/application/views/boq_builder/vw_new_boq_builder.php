<?php
$this->load->view('section/vw_header_1');
?>

<style>
.serbody { display: table; width:100%}
.add_services {
display: inline-block;
width: 24%;
vertical-align: top;
padding-bottom: 15px;
}
.add_services ul { padding:0px; margin:0px; list-style-type:none;}
.add_services ul li { }
.add_services ul li a:hover{ color:#6F40F0; }
.mb-3{ margin-bottom:30px;}
.mt-3{ margin-top:30px;}
.tr-rows input {
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	padding: 4px;
	display: inline-block;
	vertical-align: top;
	margin-right: 10px; 
 width:100px;
 
}
.tr-rows  input.sectionTitleLable {
	display: inline-block;
	margin-bottom: 10px;
	font-weight: bold;
	margin-right: 10px;
	width:250px;
}


.btn-mansi{ background:#6f5e4d; border-color:#6f5e4d; color:#fff;}
.btn-mansi:hover { color:#fff;}

 .btn-mansi:focus { color:#fff;}
 
 .breadcrumb {
	background-color: #cacaca;
	}

.profile-nav {
	display: table;
	 width: 100%; 
}

@media only screen and (max-width :767px) {
 .select_tabs span { display:inline-block; margin-bottom:5px;white-space: inherit;}   
 .add_services { width:49%;}  
 
  .tr-rows input { width:100px;} 
  .sectionTitleLable { display:block;}
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
       <li><a href="">BOQ Questionnaire</a></li>
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
    <div class="container mt-3"> 
	<form method="post" name="generateBoqFrm" id="generateBoqFrm" class="form-horizontal" 
	action="<?php echo base_url().'newBoqBuilderDetailsAction/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">
	<input type="hidden" name="stringSectionArrList" id="stringSectionArrList" value="<?=$stringSectionArrList;?>" /> 
       <!--.row/-->
	   <div class="row_">
	  
	    <?php if($this->session->userdata('MSG')){ 
           echo $this->session->userdata('MSG');
           $this->session->unset_userdata('MSG');
       } ?>
        <div class="col-xs-12" style="margin-top:20px;">
            <h4><strong>BOQ Questionnaire</strong></h4>
			<small>Please update relevant information to Generate Tentative BOQ. You can also revisit later to update BOQ info if you wish</small>
        </div>
		</div>
		
		<div class="col-xs-12" style="margin-top:20px;">
	 	<p>Please tell us the interior services you want</p> 
         
        <div class='form_input'>
          <select class="selectify" id="boqBuilderInteriorServices" multiple="multiple" name="boqBuilderInteriorServices[]">
            <option value="paint">Paint</option>
            <option value="floor_tiles">Floor Tiles</option>
            <option value="wardrobes">Wardrobes</option>
            <option value="furniture">Furniture</option>
            <option value="false_ceiling">False Ceiling</option>
			<option value="wall_punning">Wall Punning</option>
            <option value="kitchen_cabinets">Kitchen Cabinets</option>
          </select>
        </div>
         </div>
		
		<div  class="col-xs-12 tr-rows"  style="margin-top:20px;">
		<p>Please tell us about the areas (sections) to do interior</p> 
		<div class="row"  id="tableAddNewSectionTbodyId">
		
		<?php 
		$n = 0;
		/*[Start::SectionHeaderListing:]*/
		foreach($defaultBoqSectionList as $key=>$sectionHeaderRecd)
		{
			//var:
			$n = $key+1;
 		?>
		<div class="col-xs-12 col-md-6" style="margin-top:20px;" id="divIdSectionRow<?=$n;?>">
		<!--<span class="sectionTitleLable"></?=$sectionHeaderRecd['section'];?></span>-->
		<input class="sectionTitleLable" type="text" name="sectionList[<?=$n;?>][name]" id="sectionListName<?=$n;?>" value="<?=$sectionHeaderRecd['section'];?>" />
		<input type="hidden" name="sectionList[<?=$n;?>][id]" id="sectionListId<?=$n;?>" value="<?=$sectionHeaderRecd['id'];?>" />
		<input type="text" name="sectionList[<?=$n;?>][length]" id="sectionListLength<?=$n;?>" value="" placeholder="Length (ft.)"/>
		<input type="text" name="sectionList[<?=$n;?>][breadth]" id="sectionListBreadth<?=$n;?>" value="" placeholder="Breadth (ft.)"/>
		<a href="javascript:void(0);" class="btn btn-default btn-sm"   
		onclick="funMinusSectionRow(<?=$n;?>,<?=$sectionHeaderRecd['id'];?>)"><span class="fa fa-minus"></span></a>
		</div>
		<?php }?>
		</div>
		</div>
		<input type="hidden" name="numOfNewSectionRow" id="numOfNewSectionRow" value="<?=$n;?>" />
		
		<div class="col-xs-12" style="margin-top:10px;">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"  class="btn btn-mansi btn-sm"
			>
			 Add New Section <span class="fa fa-plus"></span></a>	
        </div>
		
		
		
		<div class="col-xs-12 mt-3">
        
			 
			 <input  type="submit" class="btn btn-mansi btn-sm" name="frmGenerateBoqSubmitBttn" id="frmGenerateBoqSubmitBttn" value="Generate BOQ" />
					  <a href=" <?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" 
					  class="btn btn-default btn-sm">Cancel</a>	
					 
        </div>
		
      </div>
	  <!--/row.-->
	  </form>
    </div>
	<!--/container.-->
  </section>

<!--[*start::boostrapPopup*]-->
<div id="myModal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.3);">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" id="myModalClose" class="close" data-dismiss="modal">&times;</button>
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
<script type="text/javascript">
//let arrSection = [];
//var stringSectionArrList = $('#stringSectionArrList').val();
//stringSectionArrList = stringSectionArrList.split(',');
//for(var i=0; i<stringSectionArrList.length;i++){ arrSection.push(parseInt(stringSectionArrList[i])); }
//function:
 	var funAddMoreSectionRow = function(sectionId,sectionName){
    var numOfNewSectionRow = parseInt($('#numOfNewSectionRow').val()) + 1;
	 //if($.inArray( sectionId, arrSection )=='-1')
	// {	
	//arrSection.push(sectionId);
	 var appendHtmlData = '<div class="col-xs-12 col-md-6" style="margin-top:20px;" id="divIdSectionRow'+numOfNewSectionRow+'"><input  class="sectionTitleLable"  type="text" name="sectionList['+numOfNewSectionRow+'][name]" id="sectionListName'+numOfNewSectionRow+'" value="'+sectionName+'" />&nbsp;<input type="hidden" name="sectionList['+numOfNewSectionRow+'][id]" id="sectionListId'+numOfNewSectionRow+'" value="'+sectionId+'" /><input type="text" name="sectionList['+numOfNewSectionRow+'][length]" id="sectionListLength'+numOfNewSectionRow+'" value="" placeholder="Length (ft.)"/>&nbsp;<input type="text" name="sectionList['+numOfNewSectionRow+'][breadth]" id="sectionListBreadth'+numOfNewSectionRow+'" value="" placeholder="Breadth (ft.)"/>&nbsp;<a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="funMinusSectionRow('+numOfNewSectionRow+','+sectionId+')"><span class="fa fa-minus"></span></a></div>'; 
	$('#numOfNewSectionRow').val(numOfNewSectionRow);
    $('#tableAddNewSectionTbodyId').append(appendHtmlData);
	$('#myModalClose').click();
	 //}else{
	 	//$('#myModalClose').click();
	 //}
}
var funMinusSectionRow = function(numOfNewSectionRow,sectionId){ 
	//var index = arrSection.indexOf(parseInt(sectionId));
	//if(index > -1){ arrSection.splice(index, 1); }
	$('#divIdSectionRow'+numOfNewSectionRow).remove();
}
</script>
<!--[start::jquery multiple selectifly]-->
<style type="text/css">
.select_tabs span{
  padding: 5px 8px;
  border-radius: 4px;
  margin-right: 5px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: pointer;
  white-space: nowrap;
  font-size: 13px;
  padding-left: 23px;
  border: 1px solid #e7e7e7;
  background: transparent url('images/unchecked.png') no-repeat 6px 6px;
}
.select_tabs span.active{
  border: 1px solid #d5e4ed;
  background: #d5e4ed url('images/checked.png') no-repeat 6px 6px;
}
</style>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery.selectify.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
        $(".selectify").selectify();
      });
</script>
<!--[end::jquery multiple selectifly]-->
<?php
$this->load->view('section/vw_footer');
?>