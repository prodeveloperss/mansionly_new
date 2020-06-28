<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');


?>
<!--------------[ Middle Section ]------------->
  
  <section class="profile-section">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="#">My Account</a></li>
<!--        <li>Profile</li>-->
      </ol>
    </div>
   <div class="profile-nav">
   		 <div class="container">
         	<ul>
                    <li> <a href="<?php echo base_url();?>profile">Profile </a> </li>	<!-- <span class="countnum">5</span>-->
                    <li> <a href="<?php echo base_url();?>my-orders">My Orders </a> </li>						
                    <li class="active"> <a href="<?php echo base_url();?>my-favourites">My favourites </a> </li>	<!-- <span class="countnum">5</span>-->					
                    <li> <a href="<?php echo base_url();?>signout">Sign Out</a> </li>	
                </ul>
         </div>
   </div> 
    
    <div class="container">
      <div class="row">
        <div class="col-sm-12  col-xs-12  col-md-12">
            <?php if((empty($designer_list))&& (empty($execution_portfolio_list)) && (empty($design_list)) && (empty($product_list)) ) { ?>
            <div style="margin-top: 10px;" class="alert alert-danger">
                <strong>Sorry !</strong> No records found.
            </div>
         <?php } else { ?>
          <div class="myfavorite-sect">
           <?php if(!empty($designer_list)){ ?>
             <div class="floginheading">
              <h3 class="">Favorite Designer</h3>
            </div>
            <div class="favorite-dv">
            <div class="row">
                <?php foreach ($designer_list as $row) { 
                 $profile_pic_theme = $this->Md_favorites->getDesignerTopRatedTheme($row['id']);
	         $profile_pic_port = $this->Md_favorites->getDesignerTopRatedPortfolio($row['id']);   
                    ?>
            	<div class="col-md-4 col-sm-4 col-xs-12">
                	<a class="likeico" href="javascript:void(0);" >
               <i id="<?php echo "designer".$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavorites)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Designer','designer',<?php echo $row['id'];?> );"> </i>
           </a>
             <a href="<?php echo base_url(); ?>designer-profile/<?php echo $row['id'];?>/<?php echo urlencode($row['designer_name']) ;?>">
                <div class="Dzimg clearfix">
                    <?php if (! empty($profile_pic_port)) {?>
                        <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $profile_pic_port[0]['master_image']; ?>" >
                    <?php  } else if (! empty($profile_pic_theme)) {?>
                        <img src="<?php echo image_url; ?>media/images/masterdsg-img/<?php echo $profile_pic_theme[0]['design_img']; ?>" >
                     <?php  } else {?>  
                        <img src="<?php echo base_url().SitePath ; ?>assets/img/placeholderNew.png" >
                     <?php } ?>
                </div>
                 </a>
                <a href="<?php echo base_url(); ?>designer-profile/<?php echo $row['id'];?>/<?php echo urlencode($row['designer_name']) ;?>">
                    <div class="Dzr-profileimg"><img src="<?php echo image_url; ?>media/images/designer-images/<?php echo $row['designer_logo']; ?>" > </div>
                    <div class="Dzr-profiletxt"><?php echo $row['designer_name']; ?></div>
                </a>
                </div>
                <?php } ?>
              </div>  
            </div>
           <?php } ?>
           <?php if(!empty($execution_portfolio_list)){ ?>
            <div class="floginheading">
              <h3 class="">Favorite Execution Portfolio</h3>
            </div>
            <div class="favorite-dv">
            <div class="row">
                <?php foreach ($execution_portfolio_list as $row) {   ?>
            	<div class="col-sm-4 col-md-4 col-xs-12  extraPd" >
                <div class="design-profile-box">
                  <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a> 
                  <?php  if(!empty($row['secondary_images'])){ ?>                    
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item"> 
                            <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio">
                              <img src="<?php echo image_url;?>media/images/master-execution-images/388x300/<?php echo $row['master_image']; ?>" > 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                            <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/388x300/<?php echo $row_image; ?>" > 
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                     <div class="Dzr-profiletxt"><?php echo $row['portfolio_name']; ?></div>
                   </div>
                  </div>
                <?php } ?>
              </div>  
            </div>
           <?php } ?>
           <?php if(!empty($design_list)){ ?>
            <div class="floginheading">
              <h3 class="">Favorite Designs </h3>
            </div>
            <div class="favorite-dv">
            <div class="row">
                <?php foreach ($design_list as $row) {   ?>
            	<div class="col-sm-4 col-md-4 col-xs-12  extraPd" >
                <div class="design-profile-box">
                  <a class="likeico" href="javascript:void(0);">
                      <i id="<?php echo 'designtheme'.$row['design_id']; ?>" class="fa fa-heart <?php if(in_array($row['design_id'], $customerFavoriteThemes)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Theme','designtheme',<?php echo $row['design_id']?> )">
                      </i>
                  </a>      
               <?php  if(!empty($row['secondary_images'])){ ?>                    
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                            <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['design_id'] ; ?>/<?php echo urlencode($row['design_display_name']) ; ?>/designconcept">
                            <img src="<?php echo image_url;?>media/images/masterdsg-img/388x300/<?php echo $row['design_img']; ?>" > 
                            </a>
                       </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                            <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['design_id'] ; ?>/<?php echo urlencode($row['design_display_name']) ; ?>/designconcept">
                             <img src="<?php echo image_url;?>media/images/masterdsg-img/388x300/<?php echo $row_image; ?>" > 
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt"><?php echo $row['design_display_name']; ?></div>
                </div>
              </div>
                <?php } ?>
              </div>  
            </div>
           <?php } ?> 
          <?php if(!empty($product_list)){ ?>
            <div class="floginheading">
              <h3 class="">Favorite Product </h3>
            </div>
            <div class="favorite-dv">
            <div class="row">
                <?php foreach ($product_list as $row) {   ?>
            	  <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand " >
                    <div class="brandBox clearfix">
                    <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                      <div class="brand-wrap">
                        <div class="BrandImg-explore"> <a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']) ;?>"> <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" > </a> </div>
                        <div class="BrandName"> <?php echo $row['product_name'];?> </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>  
            </div>
           <?php } ?>  
        </div>
         <?php } ?>
        </div>
      </div>
    </div>
  </section>
</div>

<!--------------[ Middle Section ]-------------> 
<?php
$this->load->view('section/vw_footer');
?>