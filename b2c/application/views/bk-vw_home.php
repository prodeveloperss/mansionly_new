<?php
$this->load->view('section/vw_header_1');
?>
<!--<script src="<?php echo base_url().SitePath ; ?>assets/js/angular_js/home_controller.js" type="text/javascript"></script>-->
<script defer src="<?php echo base_url().SitePath ; ?>assets/js/modernizr.custom.53451.js" type="text/javascript"></script>
<?php
$this->load->view('section/vw_header_2');

$this->load->view('section/vw_banner');
/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

/*[start::Code to Handel portfolio images size.]*/
$device_type = '';
if(isset($_COOKIE['device_type'])){
$device_type =  $_COOKIE['device_type'];
}

 $image_size = '585X520/';
 if($device_type == 'desktop'){
     $image_size = '585X520/';
 }
 else if($device_type == 'tablet_landscap'){
     $image_size = '455X520/';
 }
 else if($device_type == 'tablet_potrait'){
     $image_size = '690X300/';
 }
 else if($device_type == 'mobile'){
     $image_size = '690X300/';
 }
 else if($device_type == 'small_mobile'){
     $image_size = '345X300/';
 }
/*[start::Code to Handel portfolio images size.]*/
?>


<!--------------[ Middle Section ]------------->
  <section class="contact-section clearfix">
    <div class="container">
      <div class="loader" id="main_form" style="display:none;"></div>
      <div class="contctFrom">
        <form id="get_started" name="get_started">
         <div class="inptWrap">
             <button class="sendbtns ">Contact Me</button>
              <input type="text" class=" form-control" name="userinformation" id="userinformation" placeholder="Share your mobile number to get connected with us." maxlength="15" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
         </div>
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
       <a  href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($top_rated_portfolio[0]['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($top_rated_portfolio[0]['portfolio_name'])))).'/ep/'.$top_rated_portfolio[0]['id'].'?q=e';?>">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-left">
            <div class="fetutr-left-img"> 
                
                <img src="<?php echo image_url ; ?>media/images/master-execution-images/<?php echo $image_size;?><?php echo $top_rated_portfolio[0]['master_image']; ?>" >
            </div>
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
                <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$featured_designer[0]['designer_name']))).'/designer/'.$featured_designer[0]['id'].'?q=d';?>">
                   <img src="<?php echo image_url ; ?>media/images/designer-images/150X150/<?php echo $featured_designer[0]['designer_logo']; ?>" >
                </a>
            </div>
            <div class="clearfix"></div>
            <a class="seeprof" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$featured_designer[0]['designer_name']))).'/designer/'.$featured_designer[0]['id'].'?q=d';?>">
                <?php echo $featured_designer[0]['designer_name']; ?>
             <i class="fa fa-caret-right"></i>
            </a>
            <div class="clearfix"></div>
            <p><?php echo $featured_designer[0]['design_philosophy']; ?> </p>
            <div class="clearfix"></div>
            <a href="<?php echo base_url(); ?>all-designers" class="viewallBtn">View all Designers <i class="fa fa-caret-right"></i></a> </div>
        </div>
      </div>
    </div>
  </section>
  <section class="featured-sect  featured-execution clearfix">
    <div class="container">
      <div class="row">
        <h4>Featured Execution By Our Partners</h4>
        <?php  foreach ($sample_exe_portfolio as $row) { ?>
       <!--<a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio?q=e">-->
       <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="fetutr-left">
            <div class="fetutr-left-img">
               <img src="<?php echo image_url ; ?>media/images/master-execution-images/<?php echo $image_size;?><?php echo $row['master_image']; ?>" >
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
              <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($art_product[0]['product_name'])))).'/pdp/'.$art_product[0]['product_id']; ?>?q=l">
                <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $art_product[0]['product_image']; ?>" class="eximg"> 
              </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Art</h4>
              <h4> 
                 <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $art_product[0]['product_id']; ?>/<?php echo urlencode($art_product[0]['product_name']); ?>?q=l">-->  
                 <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($art_product[0]['product_name'])))).'/pdp/'.$art_product[0]['product_id']; ?>?q=l">
                  <?php echo $art_product[0]['product_name']; ?>
                 </a>
              </h4>
              <p><?php echo $art_product[0]['short_description']; ?> </p>
              <!--<a href="<?php echo base_url(); ?>featuredlist/1/<?php echo urlencode("Decorative Art") ;?>?q=l" class="viewallBtn">Explore our Art collection <i class="fa fa-caret-right"></i></a> </div>-->
              <a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))) ;?>/fl/1?q=l" class="viewallBtn">Explore our Art collection <i class="fa fa-caret-right"></i></a> </div>
            </div>
        </div>
      </li>
      
      <li>
        <div class="container">
          <div class="featuerExplore-div">
            <div class="Explo-img">
               <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $furniture_product[0]['product_id']; ?>/<?php echo urlencode($furniture_product[0]['product_name']); ?>?q=l">-->  
               <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($furniture_product[0]['product_name'])))).'/pdp/'.$furniture_product[0]['product_id']; ?>?q=l">
                 <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $furniture_product[0]['product_image']; ?>" class="eximg"> 
               </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Furniture</h4>
              <h4>
                  <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $furniture_product[0]['product_id']; ?>/<?php echo urlencode($furniture_product[0]['product_name']); ?>?q=l">-->  
                 <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($furniture_product[0]['product_name'])))).'/pdp/'.$furniture_product[0]['product_id']; ?>?q=l">
                  <?php echo $furniture_product[0]['product_name']; ?>
                  </a>
              </h4>
              <p> <?php echo $furniture_product[0]['short_description']; ?></p>
              <!--<a href="<?php echo base_url(); ?>productlist/2/<?php echo str_replace(" ", "+",'Furniture') ;?>?q=l" class="viewallBtn">Explore our Furniture collection <i class="fa fa-caret-right"></i></a> </div>-->
              <a href="<?php echo base_url(); ?><?php echo urlencode(strtolower(trim('Furniture'))) ;?>?catID=2&pageType=PLP&q=l" class="viewallBtn">Explore our Furniture collection <i class="fa fa-caret-right"></i></a> </div>
          </div>
        </div>
      </li>
      
      
      
      
      <li>
        <div class="container">
          <div class="featuerExplore-div">
            <div class="Explo-img">
                <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $decor_product[0]['product_id']; ?>/<?php echo urlencode($decor_product[0]['product_name']); ?>?q=l">-->  
               <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($decor_product[0]['product_name'])))).'/pdp/'.$decor_product[0]['product_id']; ?>?q=l">
                  <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $decor_product[0]['product_image']; ?>" class="eximg"> 
                </a>
            </div>
            <div class="Explo-text">
              <h4>Featured Decor</h4>
              <h4>
               <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($decor_product[0]['product_name'])))).'/pdp/'.$decor_product[0]['product_id']; ?>?q=l">
                    <?php echo $decor_product[0]['product_name']; ?>
                  </a>
              </h4>
              <p> <?php echo $decor_product[0]['short_description']; ?></p>
              <!--<a href="<?php echo base_url(); ?>productlist/3/<?php echo str_replace(" ", "+",'Decor') ;?>?q=l" class="viewallBtn">Explore our Decor collection <i class="fa fa-caret-right"></i></a> </div>-->
              <a href="<?php echo base_url(); ?><?php echo urlencode(strtolower(trim('Decor'))) ;?>?catID=3&pageType=PLP&q=l" class="viewallBtn">Explore our Decor collection <i class="fa fa-caret-right"></i></a> </div>
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
                    <?php  
                    if(!empty($row['brandPageDesignType'])){                       
                    ?>   
                    <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['brand_name'])))).'/b/'.$row['brand_id'].'?q=l';?>"> 
                    <?php } else { ?>
                    <a href="<?php echo base_url(); ?><?php echo urlencode( $row['brand_url_name']) ;?>?brandID=<?php echo $row['brand_id']; ?>&pageType=BLP&q=l"> 
                    <?php } ?>
<!--                    <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['brand_name'])))).'/b/'.$row['brand_id'].'?q=l';?>">-->
                	<img  src="<?php echo image_url ; ?>media/images/ecom/brand/200X110/<?php echo $row['brand_image']; ?>" >
                    </a>
                 </div>           
                <?php  }  ?> 
               
            </div>
             <a href="<?php echo base_url(); ?>all-brands?q=l" class="viewallBtn">View all Brands <i class="fa fa-caret-right"></i></a>
        </div>
    </div>
  </section>
  
   <?php if(!empty($magazine_list)) { ?>  
   <section  class="magezine-section magezine-section-new">
      <div class="container">
      <h4>Magazine</h4>
    <!--------------------ForMobile------------------------->
<!--      <div class="magezine-mainmobile">
        <div class="owl-carousel magezine-sections-mobile " id="MageZineMobile">
            <?php foreach($magazine_list as $key=>$row) { ?>
            <div class="item">
              <a target="_blank" href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank"><img src="<?php echo str_replace(array('http://'),'https://',$row['guid']);?>"  width="480" height="160">
              <div class="text-center"><h5><?php echo $row['post_title'];?></h5></div>
              <p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p></div></a>
            </div>  
                        <?php }?> 
        </div>
      </div>-->



 <div class="magazine-Div-sctMobile clearfix visible-xs">
           <div class="container">
           <div class="row">
                    <ul>
                        <?php foreach($magazine_list as $key=>$row) { ?>
                        <?php if($key==0){ ?>
                        <li>
                            <div class="magz-box-mbl clearfix">
                                <a href="<?php echo base_url(); ?>magazine/category/garden-decor">
                                    <div class="imgTitle clearfix">Garden decor</div>
                                    <div class="mazi-mbl-img">
                                       <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magz-mobi01.jpg" alt="">
                                    </div>
                                </a>
                                <div class="mazi-mbl-desc">
                                <h3> 
                                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                                    <?php echo $row['post_title'];?>
                                    </a>
                                </h3>
                                <p><?php echo substr(strip_tags($row['post_content']),0,400);?>...</p>
                                <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                                </div>
                            </div>
                        </li>
                        <?php } if($key==1){ ?>
                         <li>
                            <a href="<?php echo base_url(); ?>magazine/category/living-room-decor">
                                <div class="magz-box-mbl clearfix">
                                 <div class="mazi-mbl-img">
                                     <div class="imgTitle clearfix">Living room decor</div>
                                     <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi-bol04.jpg" alt="">
                                     </div>
                                </div>
                            </a>
                        </li> 
                        <?php } if($key==2){ ?>
                        <li>
                           <div class="magz-box-mbl clearfix">
                            <a href="<?php echo base_url(); ?>magazine/category/kitchen-decor">
                                <div class="mazi-mbl-img"> 
                                <div class="imgTitle clearfix">Kitchen Decor</div>
                                    <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi-mbl06.jpg" alt="">
                                </div>
                            </a>
                            <a href="<?php echo base_url(); ?>magazine/category/tips-tricks">
                             <div class="mazi-mbl-img"> 
                             <div class="imgTitle clearfix">Tips & Tricks</div>
                             	 <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi-mbl07.jpg" alt="">
                             </div>
                            </a>
                          </div>
                          </li>
                          <?php } if($key==3){ ?>
                          <li>
                            <div class="magz-box-mbl clearfix">
                              
                                <div class="mazi-mbl-desc">
                                <h3> 
                                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                                    <?php echo $row['post_title'];?>
                                    </a>
                                </h3>
                                    <p><?php echo substr(strip_tags($row['post_content']),0,300);?>...</p>
                                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                                </div>
                                
                                <div class="mazi-mbl-desc">
                                     <h3><?php echo $row['post_title'];?></h3>
                                     <p><?php echo substr(strip_tags($row['post_content']),0,300);?>...</p>
                                     <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                                </div>
                            </div>
                        </li>
                       <?php } ?>
                      <?php } ?>   	
                    </ul>
                </div>
                </div>
                <div class="magpViewall clearfix">
        	<a href="<?php echo base_url();?>magazine/" target="_blank"  class="viewallBtn">View Magazine<i class="fa fa-caret-right"></i></a>
        </div>
           </div>
     
     <!--------------------ForMobile------------------------->  
      
      
      
      
      
      
      
      
      <!--------------------ForDesktop------------------------->
      
<!--      	<div class="Magazine-main ">
		<div class="dg-wrapper ">
                    
                    <?php foreach($magazine_list as $key=>$row) { ?>
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                            <img src="<?php echo str_replace(array('http://'),'https://',$row['guid']);?>"  width="480" height="260">
                        <div><h3><?php echo $row['post_title'];?></h3><p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p></div></a>
                    <?php }?>
                

                </div>
                <nav>	
                        <span class="dg-prev"> <i class="fa fa-angle-left"></i> </span>
                        <span class="dg-next"><i class="fa fa-angle-right"></i></span>
                </nav>
               
                </div>-->
        <!--------------------ForDesktop-------------------------> 

       <!--------------------ForDesktop------------------------->
      <div class="magazine-Div-sct clearfix  visible-sm visible-md visible-lg">
      	<ul>
        <?php foreach($magazine_list as $key=>$row) { ?>
         <?php if($key==0){ ?>
          <li>
            <div class="magz-box clearfix">
                <a href="<?php echo base_url(); ?>magazine/category/garden-decor/">
            	<div class="mazi-img">
                    <div class="imgTitle clearfix">Garden decor</div>
                    <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi01.jpg" alt="">
                </div>
                </a>
                <div class="mazi-desc">
                    <h3> 
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                        <?php echo $row['post_title'];?>
                        </a>
                    </h3>
                    <p><?php echo substr(strip_tags($row['post_content']),0,400);?>...</p>
                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                </div>
                </a>
            </div>	
          </li>
         <?php } if($key==1){ ?>
 
            <li>
            <div class="magz-box clearfix">
               <a href="<?php echo base_url(); ?>magazine/category/bedroom-decor" target="_blank">
            	<div class="mazi-img clearfix">
                <div class="imgTitle clearfix">Bedroom decor</div>
                <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi02.jpg" alt="">
                </div>
               </a>
                <div class="inspiredv ">
                   <a href="<?php echo base_url(); ?>magazine/category/inspiration" target="_blank">
                    <div class="mazi-img-inspire">
                     <div class="imgTitle clearfix">Inspiration</div>
                     <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi03.jpg" alt="">
                    </div>
                   </a>
                 <div class="mazi-desc">
                     <h3> 
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                        <?php echo $row['post_title'];?>
                        </a>
                    </h3>
                    <p><?php echo substr(strip_tags($row['post_content']),0,70);?>...</p>
                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                </div>
                </div>
            </div>	
           </li>
           
         <?php } if($key==2){ ?>

           <li>
           <a href="<?php echo base_url(); ?>magazine/category/living-room-decor" target="_blank">
           <div class="magz-box clearfix">
                <div class="mazi-img">
                <div class="imgTitle clearfix">Living room decor</div>
                <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi04.jpg" alt="">
                </div>
            </div>	
            </a>
            </li>
          <?php } if($key==3){ ?> 
            <li>
                <div class="mazi-desc">
                    <h3> 
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                        <?php echo $row['post_title'];?>
                        </a>
                    </h3>
                    <p><?php echo substr(strip_tags($row['post_content']),0,300);?>...</p>
                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                </div>
            </li>
            <?php } if($key==4){ ?>
            <li>
                <div class="mazi-desc">
                    <h3> 
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                        <?php echo $row['post_title'];?>
                        </a>
                    </h3>
                    <p><?php echo substr(strip_tags($row['post_content']),0,300);?>...</p>
                    <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank" class="m_readmore">read more...</a>
                </div>
            </li>
             <?php } if($key==5){ ?>
            <li>
               <a href="<?php echo base_url(); ?>magazine/category/kitchen-decor" target="_blank">
                <div class="magz-box clearfix">
                    <div class="mazi-img">
                    <div class="imgTitle clearfix">Kitchen Decor</div>
                    <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi05.jpg" alt="">
                    </div>
                </div>	
               </a>
            </li>
             <?php } if($key==6){ ?>
            <li>
               <a href="<?php echo base_url(); ?>magazine/category/tips-tricks" target="_blank">
                <div class="magz-box clearfix">
                    <div class="mazi-img">
                    <div class="imgTitle clearfix">Tips & Tricks</div>
                    <img  src="<?php echo base_url().SitePath ; ?>assets/img/magazine-img/magzi06.jpg" alt="">
                    </div>
                </div>	
               </a>
            </li>
             <?php } ?>
        <?php } ?>
        </ul>
        <div class="clearfix"></div>
        <div class="magpViewall clearfix">
            <a target="_blank" href="<?php echo base_url();?>magazine/" class="viewallBtn">View Magazine<i class="fa fa-caret-right"></i></a>
        </div>
      </div>
      

 <!--------------------ForDesktop------------------------->                
 </div>
</section>
 <?php } ?>
            
  
    	
     
            
            
            
            
            
  
  
  
</div>

<!--------------[ Middle Section ]-------------> 

<!--------------[ SEO Section ]-------------> 
<script type="application/ld+json">
    
/*Site Search*/
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "https://www.mansionly.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.mansionly.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}    
    
    /*Site name*/
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "name": "Mansionly",
  "url": "https://www.mansionly.com/"
}

/*Site Logo*/

{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "https://www.mansionly.com/",
  "logo": "https://www.mansionly.com/b2c/assets/img/logo.png"
}

/*Social Profiles*/

{
  "@context": "http://schema.org",
  "@type": "Website",
  "name": "Mansionly",
  "url": "https://www.mansionly.com",
  "sameAs": [
"https://www.facebook.com/Mansionly-1158907510855927/",
"https://www.instagram.com/MansionlyGlobal",
"https://twitter.com/mansionly",
"https://plus.google.com/u/0/b/102168710703313121099/102168710703313121099",
"https://www.youtube.com/channel/UCdLg-7WB4mWQYEP7ZvTQvKQ",
"https://id.pinterest.com/mansionly/"
  ]
}




</script>

<!--------------[/SEO Section ]-------------> 


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