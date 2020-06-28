<?php
$this->load->view('section/vw_header_1');
?>
<style>
.mb-3{ margin-bottom:30px;}
.myoredrTable .table.table-bordered th, .myoredrTable .table.table-bordered td {
    padding: 10px 10px;}
    
 .breadcrumb {
	background-color: #cacaca;
	}

.profile-nav {
	display: table;
	 width: 100%; 
}    

@media only screen and (max-width :767px) {
 .tr-rows input { width:100px;}    
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
    <li><a href="">BOQs</a></li>
    <!--        <li>Profile</li>-->
  </ol>
</div>
<?php if(in_array($userType,array('Agent'))==1){?>
<div class="profile-nav">
  <div class="container">
    <ul>
      <li class="active"> <a href="<?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">BOQs</a> </li>
    </ul>
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
<div class="container">
  <!--<div class="row">
        <div class="col-xs-12" style="margin-top:20px;">
            	
        </div>
      </div>-->
  <div class="myoredrTable" style="width:100%"> <a href="<?php echo base_url().'newBoqBuilderDetails/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" class="btn 	btn-default btn-sm mb-3"> <span class="fa fa-plus"></span> Create New BOQ</a> 
   
    <?php if($this->session->userdata('MSG')){ 
           echo $this->session->userdata('MSG');
           $this->session->unset_userdata('MSG');
       } ?>
    <div class="table-responsive">
      <!-- < ?php if(empty($boqBuildList)) { ?>
            <div class="alert alert-danger">
                <strong>Sorry !</strong> No records found.
            </div>
         < ?php } else { ?>-->
      <table class="table table-bordered">
        <colgroup>
        <col class="col-xs-1">
        <col class="col-xs-4">
        <col class="col-xs-2">
        <col class="col-xs-2">
        <col class="col-xs-3">
        </colgroup>
        <thead>
          <tr>
            <th>Sr.No.</th>
            <th style="text-align:left;">BOQ Name</th>
            <th>Tentative Cost <small>(INR)</small></th>
            <th>Last Saved</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php  $i = 1 ;foreach ($boqBuildList as $row) { 
                 
                ?>
          <tr>
            <td style="vertical-align:top;"><?php echo $i; ?></td>
            <td style="text-align:left; vertical-align:top;"><?php echo ($row['boqName'])?$row['boqName']:'- -'; ?></td>
            <td style="vertical-align:top;"><?php echo number_format($row['finalTotal'],2); ?></td>
            <td style="vertical-align:top;"><?php echo date('d/m/Y H:i:s',strtotime($row['onDateTime'])); ?></td>
            <td style="vertical-align:top;">
                
                <?php if(empty($row['executionPartnerActorId']) && $row['status']=='1'){ ?>
                <a href="<?php echo base_url().'buildBOQDetails/'.$row['order_id'].'/'.$row['actorBy'].'/'.$row['actorId'].'/BOQ/'.$row['idBoqBuild']; ?>" 
                class="btn btn-default btn-sm" style="font-size:12px; line-height: 1.5;">View / Edit</a>
                <?php }else{?>
                <a href="<?php echo base_url().'view-buildBOQDetails/'.$row['order_id'].'/'.$row['actorBy'].'/'.$row['actorId'].'/BOQ/'.$row['idBoqBuild']; ?>" 
                class="btn btn-default btn-sm" style="font-size:12px; line-height: 1.5;">View</a>
                <?php }?>
                &nbsp;
                <a href="<?php echo base_url().'downloadBoqBuilder/'.$row['order_id'].'/'.$row['actorBy'].'/'.$row['actorId'].'/BOQ/'.$row['idBoqBuild']; ?>" 
                class="btn btn-default btn-sm">Download BOQ</a>
            </td>
          </tr>
          <?php $i++;  } ?>
          <?php if(empty($boqBuildList)) { ?>
          <tr>
            <td colspan="5" style="text-align:left;"><strong>No Records Found.</strong></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--< ?php } ?>-->
    </div>
  </div>
</div>
</section>
<!--[*start::boostrapPopup*]
<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm mb-3"><span class="fa fa-plus"></span> Create New BOQ</a>
<div id="myModal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.3);">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="myModalClose" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#000000">Update Project Type:</h4>
      </div>
      <div class="modal-body">
        <form name="changeRequestFrm" id="changeRequestFrm" class="form-horizontal ng-pristine ng-valid" onsubmit="funSaveChangeRequest(); return false;">
          <div id="messageDiv"> </div>
          <input type="hidden" name="order_id" id="order_id" value="13">
          <input type="hidden" name="bom_id" id="bom_id" value="13">
          <input type="hidden" name="change_req_id" id="change_req_id" value="">
          <div class="form-group">
            <label class="control-label col-sm-12" for="changeReqDesc">BOQ Builder not available for the Project Type, please update</label>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="amount">update Project Type*:</label>
            <div class="col-sm-10">
              <select id="orderLOB" name="orderLOB" class="form-control" required>
                <option value="">--Select Project Type--</option>
                <option value="id">title</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div id="formButtons" class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-success" name="frmChangeReqSubmitBttn" id="frmChangeReqSubmitBttn" value="Submit">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            <div id="loader" class="col-sm-offset-2 col-sm-10" style="display: none;"> <img src="http://localhost/JB080Selfserve/selfserve/media/images/ajax-loader.gif" style="width:50px;"> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>-->
<!--[*end::boostrapPopup*]-->
<?php
$this->load->view('section/vw_footer');
?>
