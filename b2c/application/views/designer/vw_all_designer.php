<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }

/*[start::Code to Handel portfolio images size.]*/
$device_type = '';
if(isset($_COOKIE['device_type'])){
$device_type =  $_COOKIE['device_type'];
}

 $image_size = '';
 if($device_type == 'desktop'){
     $image_size = '370X270/';
 }
 else if($device_type == 'tablet_landscap'){
     $image_size = '293X270/';
 }
 else if($device_type == 'tablet_potrait'){
     $image_size = '293X270/';
 }
 else if($device_type == 'mobile'){
     $image_size = '690X300/';
 }
 else if($device_type == 'small_mobile'){
     $image_size = '370X270/';
 }
/*[End::Code to Handel portfolio images size.]*/
?>
<input type='hidden' id="image_size" name="image_size" value="<?php echo $image_size; ?>">


<!--------------[ Middle Section ]-------------> 
<section class="designer-sect clearfix">
<div class="breadcrumb-main">
<ol class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="active">All Designers </li>     
</ol></div>
<div class="container">
<div class="row">
<div class="col-sm-12">
	<div class="Headind-style">
            <!--<h3>Designers</h3>--> 
            <h1 style="font-weight: 400;font-size: 24px">Best Interior Designers</h1>
        </div>
</div>
</div>
</div>
	<div class="container">
    <div class="row">
    <hr>
    <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
    <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
    <?php $Favoritestring = implode(',',$customerFavorites);?>
    <input type="hidden" name="customerFavorites" id="customerFavorites" value="<?php echo $Favoritestring; ?>">
    <div id='append'>
    <div class="featursThisweek clearfix">
    <div class="ftwk">Upcoming Designer Visits</div>
       
     <?php    foreach ($featured_designer_list as $row) {
         
          $profile_pic_theme = $this->Md_designer->getDesignerTopRatedTheme($row['id']);
	  $profile_pic_port = $this->Md_designer->getDesignerTopRatedPortfolio($row['id']);

         ?>
        <div class="col-md-4 col-sm-6 col-xs-12 extraPd">
           <div class="design-box clearfix">
           <a class="likeico" href="javascript:void(0);" >
               <i id="<?php echo "designer".$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavorites)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Designer','designer',<?php echo $row['id'];?> );"> </i>
           </a>
             <!--<a href="<?php echo base_url(); ?>designer-profile/<?php echo $row['id'];?>/<?php echo urlencode($row['designer_name']) ;?>?q=<?php echo $q; ?>">-->
              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$row['designer_name']))).'/designer/'.$row['id'].'?q=d';?>">
                <div class="Dzimg clearfix">
                    <?php if (! empty($profile_pic_port)) {?>
                        <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size.$profile_pic_port[0]['master_image']; ?>" alt="<?php echo $row['designer_name']; ?>">
                    <?php  } else if (! empty($profile_pic_theme)) {?>
                        <img src="<?php echo image_url; ?>media/images/masterdsg-img/388x300/<?php echo $profile_pic_theme[0]['design_img']; ?>"alt="<?php echo $row['designer_name']; ?>" >
                     <?php  } else {?>  
                        <img src="<?php echo base_url().SitePath ; ?>assets/img/placeholderNew.png" alt="<?php echo $row['designer_name']; ?>">
                     <?php } ?>
                </div>
               </a>
                <!--<a href="<?php echo base_url(); ?>designer-profile/<?php echo $row['id'];?>/<?php echo urlencode($row['designer_name']) ;?>?q=<?php echo $q; ?>">-->
                <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$row['designer_name']))).'/designer/'.$row['id'].'?q=d';?>">
                     <?php if($row['designer_logo']){?>
                    <div class="Dzr-profileimg"><img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo']; ?>" alt="<?php echo $row['designer_name']; ?>" > </div>
                    <?php }?>
                    <div class="Dzr-profiletxt"><?php echo $row['designer_name']; ?></div>
                </a>
            </div> 
        </div>
     <?php    } ?>
   </div>
    <hr>
   <div class="featursThisweek_1 clearfix">
<!--    <div class="ftwk">Featured this week</div>-->
        
     <?php    foreach ($designer_list as $row) {
         
          $profile_pic_theme = $this->Md_designer->getDesignerTopRatedTheme($row['id']);
	  $profile_Pic_port = $this->Md_designer->getDesignerTopRatedPortfolio($row['id']);
//          echo "<pre>";
//          print_r($profile_pic_theme);die;
         ?>
        <div class="col-md-4 col-sm-6 col-xs-12 extraPd">
           <div class="design-box clearfix">
               <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'designer'.$row['id'];?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavorites)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Designer','designer',<?php echo $row['id'];?> );"></i></a>        
               <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$row['designer_name']))).'/designer/'.$row['id'].'?q=d';?>">
                <div class="Dzimg clearfix">
                    <?php if (! empty($profile_Pic_port)) {?>
                        <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size.$profile_Pic_port[0]['master_image']; ?>" alt="<?php echo $row['designer_name']; ?>">
                    <?php  } else if (! empty($profile_pic_theme)) {?>
                        <img src="<?php echo image_url; ?>media/images/masterdsg-img/388x300/<?php echo $profile_pic_theme[0]['design_img']; ?>" alt="<?php echo $row['designer_name']; ?>">
                     <?php  } else {?>  
                        <img src="<?php echo base_url().SitePath ; ?>assets/img/placeholderNew.png" alt="<?php echo $row['designer_name']; ?>" >
                     <?php } ?>
                </div>
                </a>
               <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$row['designer_name']))).'/designer/'.$row['id'].'?q=d';?>">
                    <?php if($row['designer_logo']){?>
					<div class="Dzr-profileimg"><img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo']; ?>" alt="<?php echo $row['designer_name']; ?>"> </div>
					<?php }?>
                    <div class="Dzr-profiletxt"><?php echo $row['designer_name']; ?></div>
                </a>
            </div> 
        </div>
     <?php    } ?>
   </div>
      </div>  
    <div class="clearfix"></div>
    <div class="col-sm-12">                
       <div class="loader" style="display:none;"></div>
       <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=$limit) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
     </div>
    </div>  
    </div>
</section>
</div>
<!--------------[ Middle Section ]-------------> 


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="ConatctMe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<h4>Contact <?php echo $designer_details[0]['designer_name'];?></h4>
        <div class="col-sm-5">
        	<div class="design-modal-img clearfix">
                    <img src="<?php echo base_url(); ?>/media/images/designer-images/<?php echo $designer_details[0]['designer_logo'];?>" alt="<?php echo $designer_details[0]['designer_name'];?>" >
            </div>
            <div class="clearfix"></div>
            <div class="de-mdldes clearfix">
            	<h3><?php echo $designer_details[0]['designer_name'];?></h3>
                <p><?php echo $designer_details[0]['introduction'];?></p>
            </div>
            
        </div>
         <div class="col-sm-7">
         	<form class="dform">
            	<div class="form-group">
                	<input type="text" class="form-control" placeholder="Name">
                </div>
                
                	<div class="form-group">
                	<input type="text" class="form-control" placeholder="Email /Phone">
                </div>
                
                
                	<div class="form-group">
                	<button type="submit" class="btn  sbtbtn btn-block">Submit</button>
                </div>
            </form>
         
         </div>
     
     <div class="clearfix"></div>
     </div>
    </div>
  </div>
</div>


<script>
$(document).ajaxStart(function () {
    $(".loader").show();
});

$(document).ajaxComplete(function () {
    $(".loader").hide();
});
</script>

<!--[start:: Load more for Functionality]-->
<script type="text/javascript">
$(document).ready(function(){
  $('#loadMore').mouseenter(function(){
    $('#loadMore').hide();
    var offset = parseInt($('#offset').val());
    var totalCount = $('#totalCount').val();
    var customerFavorites = $('#customerFavorites').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';

   //alert(customerFavorites);
    $.ajax({
        url:baseUrl+"Cn_designer/ajax_all_designer",
        type:"post",
        data:{'offset':offset,'customerFavorites':customerFavorites,'q':q,'image_size':image_size},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append').append(data[1]);
            $('#offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                $('#loadMore').show();
            }
        },
        error: function(e){
            alert('Please relode the page.');
        }
        
    });
});
 // execution_portfolio();
});


</script>
<!--[End:: Load more Functionality ]-->
<?php
$this->load->view('section/vw_footer');
?>
