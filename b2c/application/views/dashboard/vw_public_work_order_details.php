<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
include_once 'vw_percentage_calculation.php';

?>
<!--------------[ Middle Section ]------------->

<section class="profile-section">
  <div class="breadcrumb-main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li><a href="#">My Account</a></li>
    </ol>
  </div>
<!--  <div class="profile-nav">
    <div class="container">
      <ul>
        <li> <a href="<?php echo base_url();?>profile">Profile </a> </li>	  
        <li class="active"> <a href="<?php echo base_url();?>my-orders">My Orders </a> </li>
        <li> <a href="<?php echo base_url();?>my-favourites">My favourites </a> </li>
        <li> <a href="<?php echo base_url();?>signout">Sign Out</a> </li>
      </ul>
    </div>
  </div>-->
  <div class="order-sect">
<!--    <div class="container">
      <div class="top-ordertext clearfix"> <span class="ornum"> <a href="<?php echo base_url(); ?>my-orders"> <i class="fa fa-angle-left" aria-hidden="true"></i> Back to Order List</a> </span> <span class="rdate"> Order Number: <?php echo $order_details[0]['unique_oid'];?></span> </div>
    </div> -->

	  <div class="container">
        <div class="top-ordertext  lastupat clearfix"> <span>Last Update: <?php echo date("d, M Y",strtotime($order_details[0]['last_action_date']));?></span> </div>
        <div class="col-md-4 col-sm-4 col-xs-12 ">
		<div class="progressbar position text-center" data-percent="<?php echo $varOveralPercntVal_design;?>" data-duration="1000" data-color="#c1c1c1, #766352"><small> Design Phase <br> Overall progress </small></div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 ">
		<div class="progressbar position text-center" data-percent="<?php echo $varOveralPercntVal;?>" data-color="#c1c1c1, #766352"><small>Execution Phase<br> Overall progress </small></div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 ">
		<div class="progressbar position text-center" data-percent="<?php echo $varOveralPercntVal_procurement;?>" data-color="#c1c1c1, #766352" data-label="lop"><small> Procurement Phase <br> Overall progress</small></div>
        </div>
      </div>
      
    
  </div>

  <span id="scroll_page"></span>
  <div class="workorder-tab-scetion clearfix">
    <div class="container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li  role="presentation" <?php if(isset($_GET['pgsecn'])){ } else { ?> class="active" <?php }?>><a href="#home" aria-controls="home" role="tab" data-toggle="tab"> Status Summary </a></li>
        <li role="presentation" <?php if(isset($_GET['pgsecn'])){?> class="active" <?php } ?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Detailed Status</a></li>
        <?php if((!empty($all_work_order_files))|| (!empty($side_galler_files))){?>
        <li  role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Timeline</a></li>
        <?php }?>
      </ul>
      <!-- Tab panes -->
      <?php if(!empty($status_summary_design)||!empty($status_summary_execution)||!empty($status_summary_procurement)){ 
    
          ?>
      <div class="tab-content">

        <!--[start::status summery]-->
        <div role="tabpanel" class="tab-pane <?php if(isset($_GET['pgsecn'])){ } else { ?>active <?php } ?>" id="home">
            <?php if(!empty($status_summary_design)){?>
          <div class="summary-Box">
              <h3>Design Phase</h3>
            <ul>
              <?php $i=1;
                 $ss_percentage="";
                 foreach ($status_summary_design as $key_ss => $row) {
                    ?>
              <li class="activeComplete">
                <div class="smBox open_model">
                  <div class="Sfill"><?php echo $StatusSummeryPercntVal_design[$row['id']];?> <span>%</span> </div>
                  <div class="smBoxtext">
                  
                  <a class="smTitle"   href="javascript:void(0)" > <?php echo $row['title'];?>
                  <?php 

                            $milestone_plan_id = $row['milestone_plan_id'];
                            $milestone_plan_id_array = explode(',', $milestone_plan_id);
                            $section_id = $row['id'];
                            $files = $this->Md_customer->get_status_summery_files($section_id,$milestone_plan_id_array); 
                            $count = count($files);
                            if(!empty($files)){
                            ?>
                  <span class="viewPict thumbnail"  id="image-<?php echo $i; ?>" data-index="0"> <i class="fa fa-picture-o" aria-hidden="true"></i> </span>
                  <?php } ?>
                  </a> 
                </div>
                </div>
                  <div class="maxmindate"> <?php echo ($row['minDate']!='0000-00-00' && !empty($row['minDate']))? date('d/m/Y',  strtotime($row['minDate'])):'';   ?> - <?php echo ($row['maxDate']!='0000-00-00' && !empty($row['maxDate']))? date('d/m/Y',  strtotime($row['maxDate'])):'';   ?>  
                  </div>
              </li>
              <div class="hidden" id="img-repo">
                <?php 
                  $k = 1;
                  foreach ($files as $key => $file) { ?>
                <div class="item" id="image-<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                <?php $k++; } ?>
              </div>
              <?php $i++; } ?>
            </ul>
          </div>
            <?php } ?>
           <?php if(!empty($status_summary_execution)){?> 
          <div class="summary-Box">
              <h3>Execution Phase</h3>
            <ul>
              <?php $i=1;
                 $ss_percentage="";
                 foreach ($status_summary_execution as $key_ss => $row) {
                    ?>
              <li class="activeComplete">
                <div class="smBox open_model">
                  <div class="Sfill"><?php echo $StatusSummeryPercntVal[$row['id']];?> <span>%</span> </div>
                  <div class="smBoxtext">
                  
                  <a class="smTitle"   href="javascript:void(0)" > <?php echo $row['title'];?>
                  <?php 

                            $milestone_plan_id = $row['milestone_plan_id'];
                            $milestone_plan_id_array = explode(',', $milestone_plan_id);
                            $section_id = $row['id'];
                            $files = $this->Md_customer->get_status_summery_files($section_id,$milestone_plan_id_array); 
                            $count = count($files);
                            if(!empty($files)){
                            ?>
                  <span class="viewPict thumbnail"  id="image-<?php echo $i; ?>" data-index="0"> <i class="fa fa-picture-o" aria-hidden="true"></i> </span>
                  <?php } ?>
                  </a> 
                </div>
                </div>
                  <div class="maxmindate"> <?php echo ($row['minDate']!='0000-00-00' && !empty($row['minDate']))? date('d/m/Y',  strtotime($row['minDate'])):'';   ?> - <?php echo ($row['maxDate']!='0000-00-00' && !empty($row['maxDate']))? date('d/m/Y',  strtotime($row['maxDate'])):'';   ?>  
                  </div>
              </li>
              <div class="hidden" id="img-repo">
                <?php 
                  $k = 1;
                  foreach ($files as $key => $file) { ?>
                <div class="item" id="image-<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                <?php $k++; } ?>
              </div>
              <?php $i++; } ?>
            </ul>
          </div>
          <?php } ?>
            
           <?php if(!empty($status_summary_procurement)){?>
            <div class="summary-Box">
              <h3>Procurement Phase</h3>
            <ul>
              <?php $i=1;
                 $ss_percentage="";
                 foreach ($status_summary_procurement as $key_ss => $row) {
                    ?>
              <li class="activeComplete">
                <div class="smBox open_model">
                  <div class="Sfill"><?php echo $StatusSummeryPercntVal_procurement[$row['id']];?> <span>%</span> </div>
                  <div class="smBoxtext">
                  
                  <a class="smTitle"   href="javascript:void(0)" > <?php echo $row['title'];?>
                  <?php 

                            $milestone_plan_id = $row['milestone_plan_id'];
                            $milestone_plan_id_array = explode(',', $milestone_plan_id);
                            $section_id = $row['id'];
                            $files = $this->Md_customer->get_status_summery_files($section_id,$milestone_plan_id_array); 
                            $count = count($files);
                            if(!empty($files)){
                            ?>
                  <span class="viewPict thumbnail"  id="image-<?php echo $i; ?>" data-index="0"> <i class="fa fa-picture-o" aria-hidden="true"></i> </span>
                  <?php } ?>
                  </a> 
                </div>
                </div>
                  <div class="maxmindate"> <?php echo ($row['minDate']!='0000-00-00' && !empty($row['minDate']))? date('d/m/Y',  strtotime($row['minDate'])):'';   ?> - <?php echo ($row['maxDate']!='0000-00-00' && !empty($row['maxDate']))? date('d/m/Y',  strtotime($row['maxDate'])):'';   ?>  
                  </div>
              </li>
              <div class="hidden" id="img-repo">
                <?php 
                  $k = 1;
                  foreach ($files as $key => $file) { ?>
                <div class="item" id="image-<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                <?php $k++; } ?>
              </div>
              <?php $i++; } ?>
            </ul>
          </div>
            <?php } ?>
        </div>
        <!--[end::status summery]-->

        <!--[start::detailed status]-->
        <div role="tabpanel" class="tab-pane <?php if(isset($_GET['pgsecn'])){?>active<?php } ?>" id="profile">
          <div class="stausDtl-table-nav clearfix">
            <ul>
              <?php foreach ($detailed_nav_list as $key => $row) { ?>
              <?php if($key=='0'){ ?>
              <li > <a <?php if(isset($_GET['filtid'])){ } else{ ?> class="active" <?php } ?> href="<?php echo base_url(); ?>publicworkorderdetails/<?php echo $customer_id;?>/<?php echo $row['order_id'];?>/order-status?pgsecn='ds'#scroll_page">All</a></li>
              <?php } ?>
              <li> <a <?php if(isset($_GET['filtid'])&& ($_GET['filtid']== $row['id'])) { ?> class="active" <?php } ?> href="<?php echo base_url(); ?>publicworkorderdetails/<?php echo $customer_id;?>/<?php echo $row['order_id'];?>/order-status?pgsecn='ds'&filtid=<?php echo $row['id'];?>&filttext=<?php echo urlencode($row['title']); ?>#scroll_page"><?php echo $row['title']; ?></a> </li>
              <?php } ?>
            </ul>
          </div>
             <?php if(!empty($detailed_status_design)){?>
          <div class=" myoredrTable stausDtl-table visible-sm visible-md visible-lg">
              <h3>Design Phase</h3>
            <div class="table-responsive">
              <table class="table table-bordered">
                <colgroup>
                    <col width="5%" >
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="12%">
                    <col width="12%">
                    <col width="16%">
                    <col width="5%">
                </colgroup>
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Section</th>
                    <th>Activity</th>
                    <th>Responsibility</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Comment</th>
                    <th>Complete Percentage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ;foreach ($detailed_status_design as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['activity']; ?></td>
                    <td><?php echo $row['responsibility']; ?></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($completion_date));?></span></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td class="open_model"><span class="spdate" > <?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?> %</span>
                      <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>
                      <a class="viewPict thumbnail" id="image_detailed_status<?php echo $i; ?>" href="javascript:void(0);" data-index="0" > <i class="fa fa-search" aria-hidden="true"></i> </a>
                      <?php } ?>
                    </td>
                    <div class="hidden" id="img-repo">
                      <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                      <div class="item" id="image_detailed_status<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                      <?php $k++; } ?>
                    </div>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
            <?php } ?>
            
           <?php if(!empty($detailed_status_execution)){?> 
            <div class=" myoredrTable stausDtl-table visible-sm visible-md visible-lg">
              <h3>Execution Phase</h3>
            <div class="table-responsive">
              <table class="table table-bordered">
                <colgroup>
                    <col width="5%" >
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="12%">
                    <col width="12%">
                    <col width="16%">
                    <col width="5%">
                </colgroup>
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Section</th>
                    <th>Activity</th>
                    <th>Responsibility</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Comment</th>
                    <th>Complete Percentage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ;foreach ($detailed_status_execution as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['activity']; ?></td>
                    <td><?php echo $row['responsibility']; ?></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($completion_date));?></span></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td class="open_model"><span class="spdate" > <?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?> %</span>
                      <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>
                      <a class="viewPict thumbnail" id="image_detailed_status<?php echo $i; ?>" href="javascript:void(0);" data-index="0" > <i class="fa fa-search" aria-hidden="true"></i> </a>
                      <?php } ?>
                    </td>
                    <div class="hidden" id="img-repo">
                      <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                      <div class="item" id="image_detailed_status<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                      <?php $k++; } ?>
                    </div>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
            <?php } ?>
            
           <?php if(!empty($detailed_status_procurement)){?>
            <div class=" myoredrTable stausDtl-table visible-sm visible-md visible-lg">
              <h3>Procurement Phase</h3>
            <div class="table-responsive">
              <table class="table table-bordered">
                <colgroup>
                    <col width="5%" >
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="12%">
                    <col width="12%">
                    <col width="16%">
                    <col width="5%">
                </colgroup>
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Section</th>
                    <th>Activity</th>
                    <th>Responsibility</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Comment</th>
                    <th>Complete Percentage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ;foreach ($detailed_status_procurement as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['activity']; ?></td>
                    <td><?php echo $row['responsibility']; ?></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span></td>
                    <td><span class="spdate"> <?php echo date("d, M Y",strtotime($completion_date));?></span></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td class="open_model"><span class="spdate" > <?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?> %</span>
                      <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>
                      <a class="viewPict thumbnail" id="image_detailed_status<?php echo $i; ?>" href="javascript:void(0);" data-index="0" > <i class="fa fa-search" aria-hidden="true"></i> </a>
                      <?php } ?>
                    </td>
                    <div class="hidden" id="img-repo">
                      <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                      <div class="item" id="image_detailed_status<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                      <?php $k++; } ?>
                    </div>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
            <?php } ?>
           <!----------------[Mobile View table]----------------->
           <?php if(!empty($detailed_status_design)){?>
            <div class="mobile-view-statusDtl visible-xs open_model">
                    <h3>Design Phase</h3>
                    <ul>
                      <?php $i = 1 ;foreach ($detailed_status_design as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                    	<li> 
                           <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>  
                            <a class="thumbnail" href="javascript:void(0);" data-index="0" id="image_detailed_status_mobile_<?php echo $i; ?>" >
                              <?php } ?>     
                            <div class="hidden" id="img-repo">
                                <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                                <div class="item" id="image_detailed_status_mobile_<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                                <?php $k++; } ?>
                            </div>
                             <div class="compte-percnt clearfix"><?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?>%</div>
                               <div class="compte-statusDtl clearfix">
                                   <h4><?php echo $row['title']; ?></h4>
                                   <p><?php echo $row['activity']; ?></p>
                                   <?php echo $row['responsibility']?'<p>Responsibility: '.$row['responsibility'].'</p>':''; ?>
                                   <?php echo $row['comment']?'<p>Comment: '.$row['comment'].'</p>':''; ?>
                               </div>
                                     <div class=" clearfix"> </div>
                              <div class="dte-cmpt ">
                                   <span> Start Date: <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span> /
                                   <span> End Date: <?php echo date("d, M Y",strtotime($completion_date));?></span>
                              </div> 
                           <?php if(!empty($files)){  ?>           
                            </a> 
                           <?php  } ?>   
                        </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
           <?php } ?>
            
           <?php if(!empty($detailed_status_execution)){?> 
           <div class="mobile-view-statusDtl visible-xs open_model">
                    <h3>Execution Phase</h3>
                    <ul>
                      <?php $i = 1 ;foreach ($detailed_status_execution as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                    	<li> 
                           <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>  
                            <a class="thumbnail" href="javascript:void(0);" data-index="0" id="image_detailed_status_mobile_<?php echo $i; ?>" >
                              <?php } ?>     
                            <div class="hidden" id="img-repo">
                                <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                                <div class="item" id="image_detailed_status_mobile_<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                                <?php $k++; } ?>
                            </div>
                             <div class="compte-percnt clearfix"><?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?>%</div>
                               <div class="compte-statusDtl clearfix">
                                   <h4><?php echo $row['title']; ?></h4>
                                   <p><?php echo $row['activity']; ?></p>
                                   <?php echo $row['responsibility']?'<p>Responsibility: '.$row['responsibility'].'</p>':''; ?>
                                   <?php echo $row['comment']?'<p>Comment: '.$row['comment'].'</p>':''; ?>
                               </div>
                                     <div class=" clearfix"> </div>
                              <div class="dte-cmpt ">
                                   <span> Start Date: <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span> /
                                   <span> End Date: <?php echo date("d, M Y",strtotime($completion_date));?></span>
                              </div> 
                           <?php if(!empty($files)){  ?>           
                            </a> 
                           <?php  } ?>   
                        </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
           <?php } ?>
            
           <?php if(!empty($detailed_status_procurement)){?>
           <div class="mobile-view-statusDtl visible-xs open_model">
                    <h3>Procurement Phase</h3>
                    <ul>
                      <?php $i = 1 ;foreach ($detailed_status_procurement as $key_value=>$row) { 
                        if(empty($row['plan_revised_date'])){
                        $completion_date = $row['plan_completion_date'];
                        }else{
                        $completion_date = $row['plan_revised_date'];
                        }   
                       ?>
                    	<li> 
                           <?php
                            $milestone_plan_id = $row['milestone_plan_id'];
                            $files = $this->Md_customer->get_files($milestone_plan_id); 
                            $count = count($files); 
                            if(!empty($files)){
                            ?>  
                            <a class="thumbnail" href="javascript:void(0);" data-index="0" id="image_detailed_status_mobile_<?php echo $i; ?>" >
                              <?php } ?>     
                            <div class="hidden" id="img-repo">
                                <?php  $k = 1;  foreach ($files as $key => $file) {   ?>
                                <div class="item" id="image_detailed_status_mobile_<?php echo $i; ?>"> <img class="thumbnail img-responsive" title="<?php echo $file['title'];?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['ondatetime']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> </div>
                                <?php $k++; } ?>
                            </div>
                             <div class="compte-percnt clearfix"><?php echo number_format(($arr_percentage[$row['milestone_plan_id']]));?>%</div>
                               <div class="compte-statusDtl clearfix">
                                   <h4><?php echo $row['title']; ?></h4>
                                   <p><?php echo $row['activity']; ?></p>
                                   <?php echo $row['responsibility']?'<p>Responsibility: '.$row['responsibility'].'</p>':''; ?>
                                   <?php echo $row['comment']?'<p>Comment: '.$row['comment'].'</p>':''; ?>
                               </div>
                                     <div class=" clearfix"> </div>
                              <div class="dte-cmpt ">
                                   <span> Start Date: <?php echo date("d, M Y",strtotime($row['plan_start_date']));?></span> /
                                   <span> End Date: <?php echo date("d, M Y",strtotime($completion_date));?></span>
                              </div> 
                           <?php if(!empty($files)){  ?>           
                            </a> 
                           <?php  } ?>   
                        </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
           <?php } ?>
            <!----------------[Mobile View table]----------------->  
            
        </div>
        <!--[end::detailed status]-->
		
		<!--[start::detailed status]-->
		<div role="tabpanel" class="tab-pane" id="messages">
          <?php
             
             // if(empty($all_work_order_files)){  ?>
          <!--<div style="margin-top:10px;" class="alert alert-danger"> <strong>Sorry!</strong> No records found. </div>-->
          <?php //} else 
             // if(!empty($timeline_details)){
              ?>
<!--          <div class="timelinedate"><?php echo date("d, M Y",strtotime($timeline_details[0]['start_date']));?></div>-->
          <div class="workorder-Timeline">
            <ul>
              <?php 
                            
                $file_dates = $this->Md_customer->get_timeline_files_dates($order_id); 
                $side_gallery_files = $this->Md_customer->get_side_gallery_files($file_date='',$order_id); 
                $existing_date_array = array();                    
                foreach ($file_dates as $row) {
                    $existing_date_array[$row['file_date']] = '';
                }
              
              $i = 1 ; 
              foreach ($side_gallery_files as $key=> $row) {   
                     
               $existing_date_array[$row['file_date']]='';
              } 
              krsort($existing_date_array);

               foreach ($existing_date_array as $key=> $row) {   

                       $file_date = $key;
                       
                       $Date_wise_files = $this->Md_customer->get_timeline_files($file_date,$order_id); 
                       
                       $side_gallery_files = $this->Md_customer->get_side_gallery_files($file_date,$order_id); 
                       
                       $files = array_merge($Date_wise_files,$side_gallery_files);

                        if(!empty($files)){
                        ?>
              <li>
                <div class="wTtiner open_model">
                  <p><?php echo date("d, M Y",strtotime($key));?></p>
                  <?php                               
                                $count = count($files);
                                $k = 1;
                             foreach ($files as $key2 => $file) { 
                             if($key2<=2){  
                    if(isset($file['title'])) { ?>
                  <a class="wtViewIMg  thumbnail" id="image_timeline<?php echo $i; ?>" href="javascript:void(0);" data-index="<?php echo $key2; ?>" > <span> <img src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>" width="100" height="100"></span> </a>
                    <?php } else { ?>
                  <a class="wtViewIMg  thumbnail" id="image_timeline<?php echo $i; ?>" href="javascript:void(0);" data-index="<?php echo $key2; ?>" > <span> <img src="<?php echo image_url; ?>selfserve/media/order-project-site-imgs/<?php echo $file['file_name'];?>" width="100" height="100"></span> </a>
                    <?php  } } ?>
                  <div class="hidden" id="img-repo">
                    <div class="item " id="image_timeline<?php echo $i; ?>"> 
                        <?php if(isset($file['title'])) { ?>
                        <img class="thumbnail img-responsive" title="<?php echo isset($file['title'])? $file['title']:'Side Gallery';?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['file_date']));?>" src="<?php echo image_url; ?>selfserve/media/order-qa-imgs/<?php echo $file['file_name'];?>"> 
                         <?php } else{ ?>
                        <img class="thumbnail img-responsive" title="<?php echo isset($file['title'])? $file['title']:'Side Gallery';?>" data-pageno="<?php echo $k.' of '.$count;?>" data-field="<?php echo date("d, M Y",strtotime($file['file_date']));?>" src="<?php echo image_url; ?>selfserve/media/order-project-site-imgs/<?php echo $file['file_name'];?>"> 
                        <?php  } ?>
                    </div>
                  </div>
                  <?php $k++; } ?>
                </div>
              </li>
              <?php } $i++; } ?>
            </ul>
          </div>
        <div class="timelinedate"><?php echo $timeline_details[0]['start_date']? date("d, M Y",strtotime($timeline_details[0]['start_date'])):'';?></div>
          <?php// } else { ?>
          <!--<div style="margin-top:10px;" class="alert alert-danger"> <strong>Sorry!</strong> No records found. </div>-->
          <?php// } ?>
        </div>
		<!--[end::detailed status]-->
				
        <div class="modal" id="modal-gallery" role="dialog">
          <button class="close" type="button" data-dismiss="modal">X</button>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-DATE"> </h3>
                <h3 class="modal-title"></h3>
              </div>
              <div class="modal-body">
                <div id="modal-carousel" class="carousel">
                  <div class="carousel-inner"> </div>
                  <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a> <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> </div>
              </div>
              <div class="modal-footer">
                <h3 class="modal-pageno"> </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div style="margin-top:10px;" class="alert alert-danger"> <strong>Sorry!</strong> No records found. </div>
      <?php } ?>
    </div>
    <style>
 .modal-backdrop { background-color:transparent; display:none;}
 body.modal-open  { margin-right:0px !important;}
 body.modal-open { padding-right: 0px !important; overflow:auto; }
</style>
  </div>
</section>
</div>
<!--------------[ Middle Section ]------------->

<!--[start:Modal Css and Script]-->
<style>
.thumbnail { margin-bottom:6px; }

.carousel-control.left,.carousel-control.right{
  background-image:none;
  margin-top:10%;
  width:5%;
}
</style>
<script>
$(document).ready(function() {
        
   /* activate the carousel */
   $("#modal-carousel").carousel({ interval:false });

   /* change modal title when slide changes */
   $("#modal-carousel").on("slid.bs.carousel",       function () {
        $(".modal-title")
        .html($(this)
        .find(".active img")
        .attr("title"));
	$(".modal-DATE")
        .html($(this)
        .find(".active img")
        .attr("data-field"));
	$(".modal-pageno")
        .html($(this)
        .find(".active img")
        .attr("data-pageno"));	
   });

   /* when clicking a thumbnail */
   $(".open_model .thumbnail").click(function(){
    var content = $(".carousel-inner");
    var title = $(".modal-title");
    var date = $(".modal-DATE");
    var pageno = $(".modal-pageno");
  
    content.empty();  
    title.empty();
    date.empty();
    pageno.empty();
	  
     var id = this.id;  
     var repo = $("#img-repo .item");
     console.log(repo);
     var repoCopy = repo.filter("#" + id).clone();
     var active =repoCopy.eq($(this).attr('data-index'));// $(this).next();//repoCopy.first();
   //  var active = repoCopy.first();
//     console.log(active);
//     console.log($(this));
    active.addClass("active");
    title.html(active.find("img").attr("title"));
	date.html(active.find("img").attr("data-field"));
	pageno.html(active.find("img").attr("data-pageno"));
    content.append(repoCopy);

    // show the modal
  	$("#modal-gallery").modal("show");
  });

});
</script>
<!--[End:Modal Css and Script]-->
<!--[Start::ProgressBarJs]-->
<link href="<?php echo base_url().SitePath; ?>assets/js/jsProgressBar/css/jQuery-plugin-progressbar.css" rel="stylesheet">
<script src="<?php echo base_url().SitePath; ?>assets/js/jsProgressBar/js/jQuerypluginprogressbar.js"></script>
<script type="text/javascript">
		$(".progressbar").loading();
</script>
<style type="text/css">
.progressbar div span{ color:#766352;}
</style>
<!--[End::ProgressBarJs]-->

<?php
$this->load->view('section/vw_footer');
?>
