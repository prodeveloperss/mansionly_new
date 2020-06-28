<?php
$this->load->view('section/vw_header_1');
?>
<!--<script src="<?php echo base_url().SitePath ; ?>assets/js/angular_js/home_controller.js" type="text/javascript"></script>-->
<script src="<?php echo base_url().SitePath ; ?>assets/js/modernizr.custom.53451.js" type="text/javascript"></script>
<?php
$this->load->view('section/vw_header_2');

$this->load->view('section/vw_banner');
?>


<!--------------[ Middle Section ]------------->
  <section class="contact-section clearfix">
    <div class="container">
      <div class="loader" id="main_form" style="display:none;"></div>
      <div class="contctFrom">
        <form id="get_started" name="get_started">
              <input type="text" class=" form-control" name="userinformation" id="userinformation" placeholder="Share your mobile to get connected with us." maxlength="10">
          <button class="sendbtns">Contact Me</button>
        </form>
      </div>
      <div class="welComeTxt">We are a platform for Global Home Interiors and Lifestyle Solutions connecting home owners to the world‘s best interior designers, furniture, decor and lifestyle brands; creating a unique community that Welcomes Fine Living. </div>
    </div>
  </section>
  <section  class="howItWork-Section clearfix">
    <div class="container">
      <h3>How it works </h3>
      <div class="how-it-div">
        <ul>
          <li>
            <div class="howitImg"> <img src="<?php echo base_url().SitePath ; ?>assets/img/getEngaged.png" ></div>
            <h4>Get Engaged</h4>
            <div class="howittext">Contact us for personalized design consultancy at your convenience.</div>
          </li>
          <li>
            <div class="howitImg"> <img src="<?php echo base_url().SitePath ; ?>assets/img/getInspired.png" ></div>
            <h4>Get Inspired</h4>
            <div class="howittext">International designers World class furniture, decor, art and handicrafts." </div>
          </li>
          <li>
            <div class="howitImg"><img src="<?php echo base_url().SitePath ; ?>assets/img/getItDone.png" ></div>
            <h4>Get it Done</h4>
            <div class="howittext">Hassle free execution,<br>
              transparency and Quality. </div>
          </li>
          <li>
            <div class="howitImg"><img src="<?php echo base_url().SitePath ; ?>assets/img/welcomeFineLiving.png" ></div>
            <h4>Welcome Fine Living</h4>
            <div class="howittext"> Extraordinary Home, <br>
              Extraordinary Value. </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
<!--  <section class="contact-form-sect clearfix">
    <div class="container">
      
    </div>
  </section>-->
  <section class="featured-sect clearfix">
    <div class="container">
      <div class="row">
        <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $top_rated_portfolio[0]['portfolio_id'] ; ?>/<?php echo urlencode($top_rated_portfolio[0]['portfolio_name']) ; ?>/executionportfolio?q=e">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-left">
            <div class="fetutr-left-img"> <img src="<?php echo image_url ; ?>media/images/master-execution-images/<?php echo $top_rated_portfolio[0]['master_image']; ?>" ></div>
            
              <div class="fetutr-left-img-text">
                      <?php echo $top_rated_portfolio[0]['portfolio_name']; ?>
              </div>
          </div>
        </div>
       </a>    
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-right">
            <h4>Featured Designer</h4>
            <div class="ft-userimg">
                <a href="<?php echo base_url(); ?>designer-profile/<?php echo $featured_designer[0]['id'];?>/<?php echo urlencode($featured_designer[0]['designer_name']) ;?>?q=d">
                   <img src="<?php echo image_url ; ?>media/images/designer-images/<?php echo $featured_designer[0]['designer_logo']; ?>" >
                </a>
            </div>
            <div class="clearfix"></div>
            <a href="<?php echo base_url(); ?>designer-profile/<?php echo $featured_designer[0]['id'];?>/<?php echo urlencode($featured_designer[0]['designer_name']) ;?>?q=d" class="seeprof"><?php echo $featured_designer[0]['designer_name']; ?>
             <i class="fa fa-caret-right"></i>
            </a>
            <div class="clearfix"></div>
            <p><?php echo $featured_designer[0]['design_philosophy']; ?> </p>
            <div class="clearfix"></div>
            <a href="<?php echo base_url(); ?>all-designer?q=d" class="viewallBtn">View all Designers <i class="fa fa-caret-right"></i></a> </div>
        </div>
      </div>
    </div>
  </section>
  <section class="featured-sect  featured-execution clearfix">
    <div class="container">
      <div class="row">
        <h4>Featured Execution By Our Partners</h4>
        <?php  foreach ($sample_exe_portfolio as $row) { ?>
       <a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio?q=e">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-left">
            <div class="fetutr-left-img">
               <img src="<?php echo image_url ; ?>media/images/master-execution-images/388x300/<?php echo $row['master_image']; ?>" >
            </div>
              <div class="fetutr-left-img-text">
                    <?php echo $row['portfolio_name']; ?>                   
              </div>
          </div>
        </div>
        </a> 
        <?php }  ?>
<!--        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-left">
            <div class="fetutr-left-img"> <img src="<?php echo base_url().SitePath ; ?>assets/img/prodtl.jpg" ></div>
            <div class="fetutr-left-img-text">Edgefield  Plains Apartments</div>
          </div>
        </div>-->
        <div class="clearfix"></div>
        <div class="viewall-proj"> <a href="<?php echo base_url(); ?>execution-gallery/all?q=e" class="viewallBtn">View all Projects <i class="fa fa-caret-right"></i></a> </div>
      </div>
    </div>
  </section>
  <section class="featured-explore clearfix">
    <ul>
      <li>
        <div class="container">
          <div class="featuerExplore-div">
            <div class="Explo-img"> 
              <a href="<?php echo base_url(); ?>product-details/<?php echo $art_product[0]['product_id']; ?>/<?php echo urlencode($art_product[0]['product_name']); ?>?q=l">  
                <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $art_product[0]['product_image']; ?>" class="eximg"> 
              </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Art</h4>
              <h4> 
                 <a href="<?php echo base_url(); ?>product-details/<?php echo $art_product[0]['product_id']; ?>/<?php echo urlencode($art_product[0]['product_name']); ?>?q=l">  
                  <?php echo $art_product[0]['product_name']; ?>
                 </a>
              </h4>
              <p><?php echo $art_product[0]['short_description']; ?> </p>
              <a href="<?php echo base_url(); ?>featuredlist/1/<?php echo urlencode("Decorative Art") ;?>?q=l" class="viewallBtn">Explore our Art collection <i class="fa fa-caret-right"></i></a> </div>
            </div>
        </div>
      </li>
      
      <li>
        <div class="container">
          <div class="featuerExplore-div">
            <div class="Explo-img">
               <a href="<?php echo base_url(); ?>product-details/<?php echo $furniture_product[0]['product_id']; ?>/<?php echo urlencode($furniture_product[0]['product_name']); ?>?q=l">  
                 <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $furniture_product[0]['product_image']; ?>" class="eximg"> 
               </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Furniture</h4>
              <h4>
                  <a href="<?php echo base_url(); ?>product-details/<?php echo $furniture_product[0]['product_id']; ?>/<?php echo urlencode($furniture_product[0]['product_name']); ?>?q=l">  
                  <?php echo $furniture_product[0]['product_name']; ?>
                  </a>
              </h4>
              <p> <?php echo $furniture_product[0]['short_description']; ?></p>
              <a href="<?php echo base_url(); ?>productlist/2/<?php echo str_replace(" ", "+",'Furniture') ;?>?q=l" class="viewallBtn">Explore our Furniture collection <i class="fa fa-caret-right"></i></a> </div>
          </div>
        </div>
      </li>
      
      
      
      
      <li>
        <div class="container">
          <div class="featuerExplore-div">
            <div class="Explo-img">
                <a href="<?php echo base_url(); ?>product-details/<?php echo $decor_product[0]['product_id']; ?>/<?php echo urlencode($decor_product[0]['product_name']); ?>?q=l">  
                  <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $decor_product[0]['product_image']; ?>" class="eximg"> 
                </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Decor</h4>
              <h4>
                  <a href="<?php echo base_url(); ?>product-details/<?php echo $decor_product[0]['product_id']; ?>/<?php echo urlencode($decor_product[0]['product_name']); ?>?q=l">  
                    <?php echo $decor_product[0]['product_name']; ?>
                  </a>
              </h4>
              <p> <?php echo $decor_product[0]['short_description']; ?></p>
              <a href="<?php echo base_url(); ?>productlist/3/<?php echo str_replace(" ", "+",'Decor') ;?>?q=l" class="viewallBtn">Explore our Decor collection <i class="fa fa-caret-right"></i></a> </div>
          </div>
        </div>
      </li>
    </ul>
  </section>
  
  
  <section class="brand-sections">
  	<div class="container">
    	<div class="brands-main">
         <h4>Brands</h4>
        	<div class="owl-carousel" id="brandss">
                <?php   foreach ($brand_list as $row) { ?>

            	<div class="item">
                    <a href="<?php echo base_url(); ?>brand/<?php echo $row['brand_id']; ?>/<?php echo urlencode($row['brand_name']) ;?>?q=l">
                	<img  src="<?php echo image_url ; ?>media/images/ecom/brand/<?php echo $row['brand_image']; ?>" >
                    </a>
                 </div>           
                <?php  }  ?> 
               
            </div>
             <a href="<?php echo base_url(); ?>all-brands?q=l" class="viewallBtn">View all Brands <i class="fa fa-caret-right"></i></a>
        </div>
    </div>
  </section>
  
   <?php if(!empty($magazine_list)) { ?>  
   <section id="dg-container" class="dg-container magezine-section">
      <div class="container">
      <h4>Magazine</h4>
    <!--------------------ForMobile------------------------->
      <div class="magezine-mainmobile">
        <div class="owl-carousel magezine-sections-mobile " id="MageZineMobile">
            <?php foreach($magazine_list as $key=>$row) { ?>
            <div class="item">
              <a target="_blank" href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank"><img src="<?php echo str_replace(array('http://'),'https://',$row['guid']);?>"  width="480" height="160">
              <div class="text-center"><h5><?php echo $row['post_title'];?></h5></div>
              <!--<p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p></div>--></a>
            </div>  
                        <?php }?> 
        </div>
      </div>
     <!--------------------ForMobile------------------------->  
      
      
      
      
      
      
      
      
      <!--------------------ForDesktop------------------------->
      
      	<div class="Magazine-main ">
		<div class="dg-wrapper ">
                    
                    <?php foreach($magazine_list as $key=>$row) { ?>
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank"><img src="<?php echo str_replace(array('http://'),'https://',$row['guid']);?>"  width="480" height="260">
                        <div><h3><?php echo $row['post_title'];?></h3><p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p></div></a>
                    <?php }?>
                

				</div>
				<nav>	
					<span class="dg-prev"> <i class="fa fa-angle-left"></i> </span>
					<span class="dg-next"><i class="fa fa-angle-right"></i></span>
				</nav>
               
                </div>

 <!--------------------ForDesktop------------------------->                
 </div>
</section>
 <?php } ?>
            
  
    	
     
            
            
            
            
            
  
  
  
</div>

<!--------------[ Middle Section ]-------------> 
<script src="<?php echo base_url().SitePath ; ?>assets/js/jquery.gallery.js"></script>

<script>
$(document).ready(function(){
   $(function() {
	$('#dg-container').gallery();
});  
});  


</script>


<?php
$this->load->view('section/vw_footer');
?>