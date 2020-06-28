<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');

if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
//      echo "<pre>";
//      print_r($portfolio_details);die;
?>


  <!--------------[ Middle Section ]------------->
  <section class="designer-profile-sect clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url(); ?>execution-gallery/all">
                Projects
            </a>
        </li>
        <li class="active"><?php echo $portfolio_details[0]['portfolio_name']; ?></li> 
      </ol>
    </div>
    
    
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="Headind-style headstyledtl">
              <h3>Other projects by <?php echo $portfolio_details[0]['designer_name']; ?></h3>
            </div>
          </div>
        </div>
      </div>
    <div class="designer-profile-dtltop">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12">
           <div class="profileDtl-slider clearfix">
                <?php  if(!empty($portfolio_details[0]['secondary_images'])){ ?>   
           	<div class="owl-controls" id="profileDtl-slide">
                <?php } ?>
            	<div class="item"> 
                    <a class="likeico" href="javascript:void()"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <img src="<?php echo image_url; ?>media/images/master-execution-images/1180x813/<?php echo $portfolio_details[0]['master_image'];?>" >
                </div>
                <?php
                    if(!empty($portfolio_details[0]['secondary_images'])){ 
                    $array = explode(',', $portfolio_details[0]['secondary_images']);

                    foreach ($array as $row_image) {                        
                 ?>
                <div class="item"> <a class="likeico" href="javascript:void()">
                    <i class="fa fa-heart" aria-hidden="true"></i></a>
                    <img src="<?php echo image_url; ?>media/images/master-execution-images/1180x813/<?php echo $row_image;?>" > 
                </div>
                <?php } } ?>
                
              <?php  if(!empty($portfolio_details[0]['secondary_images'])){ ?>   
           	</div>
              <?php } ?>
           </div> 
          </div>
          
          <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="profDtl-right">
             <div class="d-profile-Img"> <img src="<?php echo image_url; ?>media/images/designer-images/<?php echo $portfolio_details[0]['designer_logo'];?>"  class="img-responsive"> </div>
            <div  class="d-profile-text clearfix">
              <h4>Designed By <?php echo $portfolio_details[0]['designer_name'];?></h4>
              <p>Interested in knowing more? Please fill in the form below and we will get back to you soon!</p>
              
              <form>
              	<div class="form-group">
                	<input type="text" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                	<input type="text" placeholder=" Email or Phone" class="form-control">
                </div>
                
                <div class="form-group text-center">
                	<button type="submit" class="btn conectBtn ">Submit</button> 
                </div>
              </form>
             
              </div>
           </div>
          </div >
        </div>
      </div>
    </div>
    
    
    
    
    
    
    <div class="designer-profile-btm">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="Headind-style">
              <h3>Other projects by <?php echo $portfolio_details[0]['designer_name'];?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row"> 
          
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Execution portfolio</a></li>
<!--            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Design concepts</a></li>-->
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
               <?php   foreach ($portfolio_list as $row)    {    ?> 
                <div class="col-sm-4 col-md-4 col-xs-12  extraPd load_more" >
                <div class="design-profile-box">
                  <?php  if(!empty($row['secondary_images'])){ ?>                    
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item"> 
                            <a class="likeico" href="javascript:void()"><i class="fa fa-heart" aria-hidden="true"></i></a> 
                            <a href="<?php echo base_url(); ?>portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/388x300/<?php echo $row['master_image']; ?>" > 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                             <a class="likeico" href="javascript:void()"><i class="fa fa-heart" aria-hidden="true"></i></a> 
                             <img src="<?php echo image_url;?>media/images/master-execution-images/388x300/<?php echo $row_image; ?>" > 
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt"><?php echo $row['portfolio_name']; ?></div>
                </div>
              </div>
             <?php }?> 
             
              <div class="clearfix"></div>
              
                <div class="col-sm-12">
                   <div class="loadMore-btn clearfix" id="loadMore"> <a href="javascript:void()">Load More</a> </div>
                </div>
              <div class="clearfix"></div>
            </div>            
            <div> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--------------[ Middle Section ]-------------> 
<script>
    
/*
	Load more content with jQuery 
*/   




$(function () {
    $(".load_more").slice(0, 6).show();
    
    $("#loadMore").on('click', function (e) {
        
        
        e.preventDefault();
        $(".load_more:hidden").slice(0, 6).slideDown();
        if ($(".load_more:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }

    });
});


</script>

<?php
$this->load->view('section/vw_footer');
?>
