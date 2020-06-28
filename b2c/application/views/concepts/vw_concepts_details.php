<?php
$this->load->view('section/vw_header_1');
?>
<!--<style>
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
    
</style>-->
<style>
   /* #design-gallery .img-responsive {
        width: 50%;
        object-fit: contain;
        margin: 0 auto;
    }*/
</style>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/css/component.css" />
<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/modernizr.custom.js"></script>-->
<?php
$this->load->view('section/vw_header_2');
//print_r($brand_details);

?>
<!--------------[ Middle Section ]------------->
<section class="profile-section">
<div class="breadcrumb-main">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="">Design Concept</a></li>
    <!--        <li>Profile</li>-->
  </ol>
</div>
<?php if(in_array($userType,array('agent'))==1){?>
<div class="profile-nav">
  <div class="container">
    <ul>
      <li class="active"> <a href="">Design Concept</a> </li>
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
  <div class="myoredrTable" style="width:100%"> 
  
  <!--<a href="<?php echo base_url().'newBoqBuilderDetails/'.$orderId.'/'.$userType.'/'.$userAccountId;?>" class="btn 	btn-default btn-sm mb-3"> <span class="fa fa-plus"></span> Create New BOQ</a>--> 
   
    <?php if($this->session->userdata('MSG')){ 
           echo $this->session->userdata('MSG');
           $this->session->unset_userdata('MSG');
       } ?>
  </div>
		
  <div class="row">
      <div class="col-md-12">
          <!--<a class="btn btn-primary btn-sm pull-left "  id="btnPreviousItem"> Previous</a>-->
          <div class="topbtnsC clearfix" >
              <a href="javascript:void(0);" id="commentTag" class="fa fa-comment-o fa-lg" title="Comment" onclick="$('#commentBox').toggle();"></a>
              <span id="commentBox" style="display: none">
              <input type="text" class="form-control" name="comment" id="comment" style="display: inline-block;"/>
              <input class="btn cmtbtn" type="button" value="Add" id="addComment" onclick="updateGalleryCustomerAction();$('#commentBox').hide();" />
              </span>
              <a href="javascript:void(0);" id="likeDislike" class="fa fa-heart-o fa-lg" title="Like" onclick="$(this).toggleClass('fa-heart fa-heart-o'); updateGalleryCustomerAction()"></a>
          <!--<a class="fa fa-heart fa-lg"></a>-->
          <a href="<?= base_url()."concepts/$orderId/$userType/$userAccountId/$clientType/$clientAccountId/all/0"?>" class="fa fa-image fa-lg"></a>
          </div>
          <!--<a class="btn btn-primary btn-sm pull-right " id="btnNextItem"> Next</a>-->
      </div> 
      
      </div> 
  <div class="row">
      
      <div id="design-gallery">
      
       <a class="btn  btncmnd bprve"  id="btnPreviousItem"><i class="fa fa-angle-left"></i></a>
          <a class="btn btncmnd bnxt  " id="btnNextItem"> <i class="fa fa-angle-right"></i></a>
          <?php foreach ($rsDsgnGalleryList as $key=>$item) {?>
      
          <div class="col-md-12 item" id="item<?=$key?>">
          <img src="<?=image_url.'media/images/gallery/1500THUMB/'.$item['imgFilename']?>" class="img-responsive" style="">
          <input type="hidden" class="gallery_id" value="<?=$item['galleryimg_id']?>"/>
          <input type="hidden" class="flag_like_or_dislike" value="<?=$item['flag_like_or_dislike']?>"/>
          <input type="hidden" class="customer_comment" value="<?=$item['customer_comment']?>"/>
          </div> 
          <?php } ?>
      </div>
      
  </div>
  
    <div style="display:none; text-align:center; text-align: center;position: absolute;margin: -75px auto;width: 100px;left: 0;right: 0;" id="divLoaderId">
    <img src="<?php echo base_url().SitePath ; ?>assets/img/infinity-loader-200px.gif" 
    alt="loading" width="85" />
    </div>
</div>
</section>  

<script type="text/javascript">
    var loading=true;
    var currentOffset = <?=$currentOffset?>;
    var lastRecordOffset = <?=$totalCount-1?>;
    var concptParam = <?=$concptParam?>;
    $(document).ready(function(){
         $('a#btnPreviousItem').click(function(){
             $('#commentBox').hide();
        currentOffset--;
        
        if(currentOffset<0){
            currentOffset =0;
        }
        showCurrentItem(currentOffset,'previous');
    });
    $('a#btnNextItem').click(function(){
        $('#commentBox').hide();
        currentOffset++;
        showCurrentItem(currentOffset,'next');
    });
    });
   
    
    function showCurrentItem(currentOffset,btnPress){
        if(currentOffset<=0){
            $('a#btnPreviousItem').hide();
        }else{
            $('a#btnPreviousItem').show(); 
        }
        if(currentOffset>=lastRecordOffset){
            $('a#btnNextItem').hide();
        }else{
            $('a#btnNextItem').show(); 
        }
        
        
        $('#design-gallery .item').hide();
        
        if($('#design-gallery #item'+currentOffset).length){
             $('#design-gallery #item'+currentOffset).show();
             $('#likeDislike').removeClass('fa-heart fa-heart-o'); 
             var likeClass = $('#design-gallery #item'+currentOffset+' .flag_like_or_dislike').val()=="like"?' fa-heart ':' fa-heart-o ';
            $('#likeDislike').addClass(likeClass); 
            $('#comment').val($('#design-gallery #item'+currentOffset+' .customer_comment').val()); 
             console.log(likeClass);
        }else{
            if(loading){
                ajaxLoadDesign(currentOffset,btnPress);
            }
        }
       
    }
    
    function ajaxLoadDesign(currentOffset,btnPress){
        loading = false;
	 
       $.ajax({
	cache:true,
        url:baseUrl+"conceptDesignAjax",
        type:"POST",
        data:{'concptParam':concptParam,'currentOffset':currentOffset,btnPress:btnPress},
        success: function(response){
            
            if(btnPress=='previous'){
                $('#design-gallery').prepend(response);
            }else{
                $('#design-gallery').append(response);
            }
             showCurrentItem(currentOffset,btnPress);
            loading = true;
			
        },
        error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
			loading = true;
			$('#divLoaderId').css('display','none');
		 }
    }); 
    }
    
    showCurrentItem(currentOffset);
    
   function updateGalleryCustomerAction(){
       
       var galleryimg_id = $('#design-gallery #item'+currentOffset+' .gallery_id').val();
       var flag_like_or_dislike = $('#likeDislike').hasClass('fa-heart')?'like':'dislike';
       var comment = $('#comment').val();
       
      
       $.ajax({
	cache:true,
        url:baseUrl+"ajaxUpdateGalleryCustomerAction",
        type:"POST",
        data:{sessionCustomerId:<?=$clientAccountId?>,galleryimg_id:galleryimg_id,flag_like_or_dislike:flag_like_or_dislike,comment:comment},
        success: function(response){
            
            if(response=='success'){
                $('#design-gallery #item'+currentOffset+' .flag_like_or_dislike').val(flag_like_or_dislike);
                $('#design-gallery #item'+currentOffset+' .customer_comment').val(comment);	
            }
	
        },
        error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
			
			$('#divLoaderId').css('display','none');
		 }
    });
   } 
    
</script>
<?php
$this->load->view('section/vw_footer');
?>
