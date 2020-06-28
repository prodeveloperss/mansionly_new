<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');

if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

/*[start::Code to Handel portfolio images size.]*/
$device_type = '';
if(isset($_COOKIE['device_type'])){
$device_type =  $_COOKIE['device_type'];
}

 $image_size = '370X270/';
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

<section class="designer-profile-sect-new dzprsc_1254 clearfix">
<div class="containerfluid clearfix">
  <div class="breadcrumb-main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li><a href="<?php echo base_url(); ?>all-designers">All Designers</a></li>
      <li class="active"><?php echo $designer_details[0]['designer_name']; ?></li>
    </ol>
  </div>
     <div class="clearfix"></div>
  <div class="desinerLogo clearfix">
    	<h2><?php echo $designer_details[0]['designer_name']; ?></h2>
        	<?php if(!empty ($designer_details[0]['designer_logo2'])) { ?>
        <div class="DzlogoImg">
            <div class="profile-logo"> <img src="<?php echo image_url; ?>/media/images/designer-images/<?php echo $designer_details[0]['designer_logo2'];?>" alt="<?php echo $designer_details[0]['designer_name']; ?>"  class="img-responsive"> 
          </div>
        
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
       <div class="profileSect clearfix ">
    <div class="row">
        
        
  <!--<div class="designer-profile-top">
    <div class="container">
      <div class="row">-->
      
      
        <div class="col-md-3 col-sm-5 col-xs-12 leftSc  stick-left">
        
        <div class="profileSect_left">
          <?php if($designer_details[0]['designer_logo']){?>
            <div class="left-progfileImg"> <img src="<?php echo image_url; ?>/media/images/designer-images/150X150/<?php echo $designer_details[0]['designer_logo'];?>" alt="<?php echo $designer_details[0]['designer_name']; ?>"> </div>
		  <?php }?>
          <div class="dprofile_text clearfix">
            <!--<h4><?php echo $designer_details[0]['designer_name']; ?></h4>-->
            <h1 style="font-size: 18px;"><?php echo $designer_details[0]['designer_name']; ?></h1>
            <p><?php echo $designer_details[0]['introduction']; ?></p>
            <a class="conectBtn" href="javascript:void()" data-toggle="modal" data-target="#ConatctMe"> Contact</a> 
            </div>
             <div class="profile-des clearfix">
        <ul>
          <?php if(!empty($designer_details[0]['designer_description'])) { 
              $char_limit = 100;
          ?>
          <li>  <strong> Profile</strong> <span class="less"><?php echo substr(preg_replace('#<[^>]+>#', ' ', $designer_details[0]['designer_description']),0,$char_limit); ?>            <a style="cursor:pointer; <?php if(strlen(strip_tags($designer_details[0]['designer_description']))<= $char_limit){?> display:none; <?php } ?>" 
            class="read_more">...Read More</a></span> <div class="more" style="display:none;"><?php echo $designer_details[0]['designer_description']; ?><br>
            <a style="cursor:pointer;" class="read_less">Read Less</a></div> </li>
          <?php } if(!empty($designer_details[0]['design_philosophy'])) { ?>
          <li>  <strong> Design Philosophy</strong> <div class="less"><?php echo substr(preg_replace('#<[^>]+>#', ' ', $designer_details[0]['design_philosophy']),0,$char_limit); ?>
          <a style="cursor:pointer; <?php if(strlen(strip_tags($designer_details[0]['design_philosophy']))<= $char_limit){?> display:none; <?php } ?>" class="read_more"  style="display:none;" > ...Read More</a></div> <div class="more" style="display:none;"><?php echo $designer_details[0]['design_philosophy']; ?>
            <a style="cursor:pointer;" class="read_less">Read Less</a></div> </li>
          <?php } if(!empty($designer_details[0]['design_awards'])) { ?>            
          <li> <strong> Awards</strong> <div class="less"><?php echo substr(preg_replace('#<[^>]+>#', ' ', $designer_details[0]['design_awards']),0,$char_limit); ?>
            <a style="cursor:pointer; <?php if(strlen(strip_tags($designer_details[0]['design_awards']))<= $char_limit){?> display:none; <?php } ?>" class="read_more"> ...Read More</a></div> <div class="more" style="display:none;"><?php echo $designer_details[0]['design_awards']; ?>
            <a style="cursor:pointer;" class="read_less">Read Less</a></div> </li>
          <?php } ?>
        </ul>
      </div>
            
            <!--<div class="upcomeVisit clearfix">
                   <h4>Upcoming Designer Visits</h4>
                   <ul>
                		<li><img src="<?php echo base_url().SitePath ; ?>assets/img/des-01.jpg"> </li>
                        <li><img src="<?php echo base_url().SitePath ; ?>assets/img/des-02.jpg"> </li>
                        <li><img src="<?php echo base_url().SitePath ; ?>assets/img/des-03.jpg"> </li>
                        <li><img src="<?php echo base_url().SitePath ; ?>assets/img/des-04.jpg"> </li>
               		 </ul>
                  </div>-->
        </div>
        
        
        
       </div> 
        
  <!--    </div>
    </div>
  </div>-->
  <!--<div class="profileDtl clearfix">
    <div class="container">
     
    </div>
  </div>-->
  <?php if(!(empty($execution_portfolio)) || !(empty($design_concept))){ ?>
 <!-- <div class="designer-profile-btm">-->
    <!--<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="Headind-style">
            <h3>My Work</h3>
          </div>
        </div>
      </div>
    </div>-->
     <div class="col-md-9 col-sm-7 col-xs-12">
            <div class="profileSect_right">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <?php if(!empty($execution_portfolio)) { ?>
          <li role="presentation" <?php if(($flag=="executionportfolio") || ($flag=="")) { ?> class="active" <?php } ?>><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Execution portfolio</a></li>
          <?php } if(!empty($totalCountDesignConcept[0]['totalCount'])) { ?>
          <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Design concepts</a></li>-->
          <li role="presentation"  <?php if($flag=="designconcept") { ?> class="active" <?php } ?> <?php if((empty($execution_portfolio)) && (!empty($design_concept))){ ?> class="active" <?php } ?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" <?php if((empty($execution_portfolio)) && (!empty($design_concept))){ } else { ?> onclick="$('#loadMore').mouseenter();" <?php } ?>>Design concepts</a></li>
          <?php }  ?>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <?php if(!empty($execution_portfolio)) { ?>
          <input type="hidden" name="offset" id="offset" value="<?php echo $exe_limit;?>" autocomplete="off">
          <input type="hidden" name="limit_exe" id="limit_exe" value="<?php echo $totalCountExc[0]['totalCount'];?>" autocomplete="off">
          <?php $Favoritestring = implode(',',$customerFavoriteExecutions);?>
          <input type="hidden" name="customerFavoriteExecutions" id="customerFavoriteExecutions" value="<?php echo $Favoritestring; ?>" autocomplete="off">
          <div role="tabpanel" class="tab-pane fade <?php if(($flag=="executionportfolio") || ($flag=="")) { ?>in active<?php } ?>" id="home">
            <div id="append_portfolio">
              <?php  foreach ($execution_portfolio as $row)    {    ?>
              <div class="col-sm-12 col-md-6 col-xs-12  " >
                <div class="design-profile-box-new"> <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                    <?php }  ?>
                    <div class="item">
                       <?php
                         $counter = 1;
                         if(!empty($row['secondary_images'])){ 
                         $array = explode(',', $row['secondary_images']);
                         $counter= (1 + count($array));
                         }
                        ?>
                        <div class="counter">1/<?php echo $counter; ?></div>
                        <a class="add_exe_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name']; ?>" >
                        </a> 
                    </div>
                    <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                    <div class="item"> 
                        <a class="add_exe_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name']; ?>" >
                        </a>
                    </div>
                    <?php  } } ?>
                    <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                  <?php } ?>
                  <div class="Dzr-profiletxt-new"><?php echo $row['portfolio_name']; ?></div>
                </div>
              </div>
              <?php }?>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12">
              <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore_exe"  <?php if($totalCountExc[0]['totalCount'] <= 6) { ?>style="display:none;"<?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
            </div>
          </div>
          <?php } ?>
          <?php if(!empty($totalCountDesignConcept[0]['totalCount'])) { ?>
          <input type="hidden" name="offset_design_concept" id="offset_design_concept" value="<?php echo $design_limit; ?>" autocomplete="off">
          <input type="hidden" name="limit_design_concept" id="limit_design_concept" value="<?php echo $totalCountDesignConcept[0]['totalCount'];?>" autocomplete="off">
          <?php $FavoriteDesignstring = implode(',',$customerFavoriteThemes);?>
          <input type="hidden" name="customerFavoriteThemes" id="customerFavoriteThemes" value="<?php echo $FavoriteDesignstring; ?>" autocomplete="off">
          <div role="tabpanel" class="tab-pane fade <?php if(((empty($execution_portfolio)) && (!empty($design_concept))) || ($flag=="designconcept")){ ?> active in <?php } ?>" id="profile">
            <div id="append_design_concept"> </div>
            <div class="clearfix"></div>
            <div class="col-sm-12">
              <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore"  <?php if($totalCountDesignConcept[0]['totalCount'] <= 6) { ?>style="display:none;"<?php } ?>
               > <a href="javascript:void(0);">Load More</a> </div>
            </div>
          </div>
          <?php } ?>
          <div> </div>
        </div>
      </div>
    </div>
  <!--</div>-->
  <?php } ?>
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
            <div class="design-modal-img clearfix"> <img src="<?php echo image_url; ?>/media/images/designer-images/150X150/<?php echo $designer_details[0]['designer_logo'];?>" alt="<?php echo $designer_details[0]['designer_name'];?>" > </div>
          <div class="clearfix"></div>
          <div class="de-mdldes clearfix">
            <h3><?php echo $designer_details[0]['designer_name'];?></h3>
            <p><?php echo $designer_details[0]['introduction'];?></p>
          </div>
        </div>
        <?php if($this->session->userdata('customer_info')['customer_email']){
            $customer_email = $this->session->userdata('customer_info')['customer_email'];
            }else{$customer_email=""; }
            if($this->session->userdata('customer_info')['customer_phone']){
                $customer_phone = $this->session->userdata('customer_info')['customer_phone'];
            }else{$customer_phone=""; }
            if($this->session->userdata('customer_info')['customer_name']){
                $customer_name = $this->session->userdata('customer_info')['customer_name'];
            }else{$customer_name=""; }
        ?>
        <div class="col-sm-7">
          <div class="loader" id="main_form" style="display:none;"></div>
          <form id="formContactDesigner">
            <input type="hidden" name="designer_id" id="designer_id" value="<?php echo $designer_details[0]['id']; ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="name_d" id="name_d" <?php if($customer_name){?> readonly="" <?php } ?>  placeholder="Name" value="<?php echo $customer_name;?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="email_d" id="email_d" <?php if($customer_email){?> readonly="" <?php } ?>  placeholder="Email" value="<?php echo $customer_email;?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="mobile_d" id="mobile_d" <?php if($customer_phone){?> readonly="" <?php } ?>  maxlength="15" placeholder="Mobile" value="<?php echo $customer_phone;?>">
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
<!--Read more functionaly-->
<script>


$(document).ready(function() { 
    $(".read_more").click(function(){
            $(this).parent().hide();
            $(this).parent().next().show();
    });
     $(".read_less").click(function(){
            $(this).parent().hide();
            $(this).parent().prev().show();
    });
});

</script>
<!--/Read more functionaly-->
<!--[start:: Loader image]-->
<script>
$(document).ajaxStart(function () {
    $(".loader").show();
});

$(document).ajaxComplete(function () {
    $(".loader").hide();
});
</script>
<!--[End:: Loader image]-->
<!--[start:: Load more for execution Portfolio]-->
<script type="text/javascript">
$(document).ready(function(){
  $('#loadMore_exe').mouseenter(function(){
      
     $('#home').addClass('active in');
     $('#loadMore_exe').hide();
    var offset = parseInt($('#offset').val());
    var total_count = $('#limit_exe').val();

    var designer_id = <?php echo $designer_details[0]['id']; ?>;
    var customerFavoriteExecutions = $('#customerFavoriteExecutions').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';
    
    $.ajax({
        
        url:baseUrl+"Cn_designer/ajax_execution_portfolio",
        type:"post",
        data:{'offset':offset,'designer_id':designer_id,'customerFavoriteExecutions':customerFavoriteExecutions,'q':q,'image_size':image_size},
        success: function(response){
 var data = response.split('|*|*|');        
            $('#append_portfolio').append(data[1]);
            $('#offset').val(offset+6);
            if(total_count<= parseInt(data[0])){
                $("#loadMore_exe").hide();
            }else{
                    $('#loadMore_exe').show();
            }

       /*[start:: image loader]*/     
        $('.owl-demo').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: false,
        nav: true,
        mouseDrag: true,
        smartSpeed: 2500,
        autoplayTimeout:2000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
					
            },
          
            600: {
				items: 1,
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
		
    })
        /*[End:: image loader]*/     

        },
        error: function(e){
            
        }
        
    });
});
 /*[start:Add offset to url]*/
 $(document).on('click','.add_design_url',function(){
  this.href = this.href + '&design_offset='+$('#offset_design_concept').val();
});
 /*[End:Add offset to url]*/
});


</script>
<!--[End:: Load more for execution Portfolio]-->

<?php if(((empty($execution_portfolio)) && (!empty($design_concept)))){ ?>
<script type="text/javascript">
function getDefaultDesignerProfileGallery()
{
   $('#profile').addClass('active in');
   $('#loadMore').hide();
    var offset = 0;// parseInt($('#offset_design_concept').val());//0;
    var limit =  parseInt($('#offset_design_concept').val());//0;
    var total_count = parseInt($('#limit_design_concept').val()) ;
    var designer_id = <?php echo $designer_details[0]['id']; ?>;
    var customerFavoriteThemes = $('#customerFavoriteThemes').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';
	//alert(designer_id + customerFavoriteThemes + q);
      //  alert(offset);
    $.ajax({
        url:baseUrl+"Cn_designer/ajax_design_concept",
        type:"post",
        data:{'offset':offset,'limit':limit, 'designer_id':designer_id,'customerFavoriteThemes':customerFavoriteThemes,'q':q,'image_size':image_size},
        success: function(response){
 var data = response.split('|*|*|');        
            $('#append_design_concept').append(data[1]);
           
            //$('#offset_design_concept').val(offset+6);
           // $('#offset_design_concept').val(data[0]);
        
            if(total_count<= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                    $('#loadMore').show();
            }
			//alert('I m here =>'+response);
        	/*[start:: image loader]*/     
			$('.owl-demo').owlCarousel({
				center: true,
				loop: true,
				margin: 0,
				autoplay: false,
				nav: true,
				mouseDrag: true,
				smartSpeed: 2500,
				autoplayTimeout:2000,
				 /*animateIn:'fadeIn',
				 animateOut:'fadeOut',*/
				dots: false,
				navText: [
					"<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>"
				],
				responsive: {
					320: {
						items: 1
					},
					600: {
						items: 1
					},
					1170: {
						items: 1
					},
					1920: {
						items: 1
					}
				}
			});
        	/*[End:: image loader]*/     
        },
        error: function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
        }
    });
}
getDefaultDesignerProfileGallery();	
</script>
<?php } ?>
<!--[start:: Load Design Concept for back activity]-->
<?php if($flag=="designconcept"){ ?>
<script type="text/javascript">
function getBackActivityDesignerProfileGallery()
{
   // alert();
   $('#profile').addClass('active in');
   $('#loadMore').hide();
    var offset =  0;//parseInt($('#offset_design_concept').val());//0;
    var limit =  parseInt($('#offset_design_concept').val());//0;
    var total_count = parseInt($('#limit_design_concept').val());
    var designer_id = <?php echo $designer_details[0]['id']; ?>;
    var customerFavoriteThemes = $('#customerFavoriteThemes').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';


    $.ajax({
        url:baseUrl+"Cn_designer/ajax_design_concept",
        type:"post",
        data:{'offset':offset,'limit':limit,'designer_id':designer_id,'customerFavoriteThemes':customerFavoriteThemes,'q':q,'image_size':image_size},
        success: function(response){
 var data = response.split('|*|*|');        
            $('#append_design_concept').append(data[1]);
           
          //  $('#offset_design_concept').val(offset+6);
           // $('#offset_design_concept').val(data[0]);
        
            if(total_count<= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                    $('#loadMore').show();
            }
			//alert('I m here =>'+response);
        	/*[start:: image loader]*/     
			$('.owl-demo').owlCarousel({
				center: true,
				loop: true,
				margin: 0,
				autoplay: false,
				nav: true,
				mouseDrag: true,
				smartSpeed: 2500,
				autoplayTimeout:2000,
				 /*animateIn:'fadeIn',
				 animateOut:'fadeOut',*/
				dots: false,
				navText: [
					"<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>"
				],
				responsive: {
					320: {
						items: 1
					},
					600: {
						items: 1
					},
					1170: {
						items: 1
					},
					1920: {
						items: 1
					}
				}
			});
        	/*[End:: image loader]*/     
        },
        error: function(e){
			alert('Please reload this page to resolved your request issues '+console.log(e.message));
        }
    });
}
getBackActivityDesignerProfileGallery();	
</script>
<?php } ?>
<!--[End:: Load Design Concept for back activity]-->
<!--[start:: Load more for Design Concept]-->
<script type="text/javascript">
$(document).ready(function(){
  $('#loadMore').mouseenter(function(){
   $('#profile').addClass('active in');
   $('#loadMore').hide();
    
    var offset = parseInt($('#offset_design_concept').val());
    var total_count = parseInt($('#limit_design_concept').val()) ;
    var designer_id = <?php echo $designer_details[0]['id']; ?>;
    var customerFavoriteThemes = $('#customerFavoriteThemes').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';
    
    $.ajax({
        
        url:baseUrl+"Cn_designer/ajax_design_concept",
        type:"post",
        data:{'offset':offset,'designer_id':designer_id,'customerFavoriteThemes':customerFavoriteThemes,'q':q,'image_size':image_size},
        success: function(response){
 var data = response.split('|*|*|');        
            $('#append_design_concept').append(data[1]);
            $('#offset_design_concept').val(data[0]);
            //$('#offset_design_concept').val(offset+6);
            if(total_count<= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                    $('#loadMore').show();
            }

       /*[start:: image loader]*/     
        $('.owl-demo').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: false,
        nav: true,
        mouseDrag: true,
        smartSpeed: 2500,
        autoplayTimeout:2000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
					
            },
          
            600: {
				items: 1,
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
		
    });
        /*[End:: image loader]*/     

        },
        error: function(e){
            
        }
        
    });
});

 /*[start:Add offset to url]*/
$(document).on('click','.add_exe_url',function(){
  this.href = this.href + '&exe_offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/
});


</script>
<!--[End:: Load more for  Design Concept]-->
<script>
$(document).ajaxStart(function () {
    $(".loader").show();
});

$(document).ajaxComplete(function () {
    $(".loader").hide();
});
</script>
<script>
$(document).ready(function(){
 
$('#formContactDesigner').submit(function(e){

    e.preventDefault();
    //console.log(e.target.id);
   
    var email = $('#email_d').val();
    var mobile = $('#mobile_d').val();
    var name = $('#name_d').val();
    var designer_id = $('#designer_id').val();
    var order_type = 4;
    var event_category = $('#event_category').val();
    var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
    var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
    var user_landing_page = $('#user_landing_page').val();
    var utm = $('#utm').val();
    var scheme = $('#scheme').val();
    var eventLabel =  'Designer Profile | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
    var split_url = leadGenFromSliderPageURL.split('/');
    var flag_for_production = 'www.mansionly.com';
    var chk_flag_for_production = split_url[2]; 
    if($('#formContactDesigner').valid()){
                     if(name!='' && mobile!='' && email!=''){
                         
                    var data = $.param({
                                        name: name,
                                        email: email,
                                        mobile: mobile,                                       
                                        designer_id: designer_id,
                                        remote_address: <?php echo "'".$_SERVER['REMOTE_ADDR']."'"; ?>,
                                        leadGenFromSliderPageType: leadGenFromSliderPageType,
                                        leadGenFromSliderPageUniqueId:leadGenFromSliderPageUniqueId,
                                        leadGenFromSliderPageURL:leadGenFromSliderPageURL,
                                        user_landing_page:user_landing_page,
                                        utm:utm,
                                        scheme:scheme
                                });
                         
                          $.ajax({
                            type:"post",
                            url:baseUrl+"Cn_customer/checkUserExistOrNot",
                            data:data,
                            success:function(data){
                               // var result = data;
                                $('#ConatctMe').modal('toggle');
                                toastr.success('your order saved successfully');
                            if(chk_flag_for_production == flag_for_production){
                                var result = data.split('|*|*|');
                                 /*Goole analytics script*/
                                //  alert(event_category+result[0]+eventLabel+result[1]);
                                    ga('send', 'event', 
                                        { eventCategory: event_category,
                                          eventAction: result[0],
                                          eventLabel: eventLabel, 
                                          eventValue: result[1]
                                        });
                                }
                            },
                            error:function(data){
                                $('#ConatctMe').modal('toggle');
                                toastr.error ('Error !!!');
                            }
                        });
                        }
                        }
                 
});

});



</script>
<!-- Start::form validation script -->
<script src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
        
  $("#mobile_d").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
   
   jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
   }, " "); 
		$("#formContactDesigner").validate({
                    rules: {
                           
                                name_d: {
					required: true,
                                        lettersonly:true
				},
                                 mobile_d: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				},
				email_d: {
					required: true,
                                        email:true
				}
			},
			messages: {                           
                               name_d: {
					required: '',
                                        lettersonly:''
				},
                                mobile_d: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				},                                
                                
				email_d: {
					required: '',
                                        email:''
				}
			}
		});
    });
    </script>
<!-- End::form validation script -->
<?php
$this->load->view('section/vw_footer');
?>
