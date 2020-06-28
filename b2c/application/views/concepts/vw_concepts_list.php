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
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/css/component.css" />
<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/modernizr.custom.js"></script>
<?php
$this->load->view('section/vw_header_2');
//print_r($brand_details);

?>
<!--------------[ Middle Section ]------------->
<section class="profile-section">
<div class="breadcrumb-main">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="">Concepts</a></li>
    <!--        <li>Profile</li>-->
  </ol>
</div>
<?php if(in_array($userType,array('agent'))==1){?>
<div class="profile-nav">
  <div class="container">
    <ul>
      <li class="active"> <a href="<?php echo base_url().'boqbuilder/'.$orderId.'/'.$userType.'/'.$userAccountId;?>">Concepts</a> </li>
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
	   
	   <div class="Execution-tabs concepts ">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" <?php if($concptSohId==0){?> class="active" <?php }?> >
			<a href="<?php echo base_url().'concepts/'.$orderId.'/'.$userType.'/'.$userAccountId.'/'.$clientType.'/'.$clientAccountId.'/all/0';?>">All</a></li>
			<?php foreach($rsArrDsgnSohNavBarList as $key=>$rowData){?>
				<li role="presentation" <?php if($concptSohId==$rowData['soh_id']){?> class="active" <?php }?> >
				<a href="<?php echo base_url().'concepts/'.$orderId.'/'.$userType.'/'.$userAccountId.'/'.$clientType.'/'.$clientAccountId.'/'.urlencode($rowData['soh_title']).'/'.$rowData['soh_id'];?>"   >
				<?=$rowData['soh_title']?></a>
				</li>	
			<?php }?>	
          </ul>
          </div>
  </div>
			<input type="hidden" name="concptOffset" id="concptOffset" value="<?=$limit;?>" />
			<input type="hidden" name="concptParam" id="concptParam" value='<?=$concptParam;?>' /> 
  			<ul class="grid effect-2" id="grid">
			<?php foreach($rsArrDsgnGalleryList as $key=>$galleryData){?>
				<li><a href="<?php echo base_url().'conceptDesign/'.$orderId.'/'.$userType.'/'.$userAccountId.'/'.$clientType.'/'.$clientAccountId.'/'.urlencode($concptSohTitle).'/'.$concptSohId.'/offset/'.$key?>"><img src="<?=image_url; ?>media/images/gallery/1500THUMB/<?=$galleryData['imgFilename']?>"></a></li>
			<?php }?> 
			</ul>
			<div style="display:none; text-align:center; text-align: center;position: absolute;margin: -75px auto;width: 100px;left: 0;right: 0;" id="divLoaderId">
			<img src="<?php echo base_url().SitePath ; ?>assets/img/infinity-loader-200px.gif" 
			alt="loading" width="85" /></div>
</div>
</section>  
<!--[start:ajax call load more windowscroll.touch]-->
<script type="text/javascript">
/*Javascript*/
var loading=true;
$(document).ready(function (){
   //$('#divLoaderId').css('display','block');	
   $(window).scroll(function() {
	var end = $(document).height(); var viewEnd = $(window).scrollTop() + $(window).height(); var distance = end - viewEnd; 
	if (distance < 500 && loading){
            loading = false;
			$('#divLoaderId').css('display','block');	
            ajaxHomePage();
	}
});
});
function ajaxHomePage(){
	  //def:
	  loading = false;
	  $('#divLoaderId').css('display','block');
	  var concptParam = $('#concptParam').val();
	  var concptOffset= $('#concptOffset').val();
       $.ajax({
	    cache:true,
        url:baseUrl+"conceptsAjaxList",
        type:"post",
        data:{'concptParam':concptParam,'concptOffset':concptOffset},
        success: function(response){
            var data = response.split('|*|*|');
			//alert(data[0]);
			//alert(data[1]);
			$('#grid').append(data[0]);
			$('#concptOffset').val(data[1]);
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			});
            loading = true;
			if(data[0]==''){
				$('#divLoaderId').css('display','none');
			}
        },
        error:function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
			loading = true;
			$('#divLoaderId').css('display','none');
		 }
    }); 
 }
</script>
<!--[end:ajax call load more windowscroll.touch]-->
<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/masonry.pkgd.min.js"></script>
		<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/imagesloaded.js"></script>
		<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/classie.js"></script>
		<script src="<?php echo base_url();?>b2c/application/views/concepts/gridloadingeffect/js/AnimOnScroll.js"></script> 
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>
<?php
$this->load->view('section/vw_footer');
?>


