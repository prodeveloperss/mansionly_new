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

    <section class="Sectors_Slider designer-board clearfix"> 
    <div class="container">
    
    <a class="seeAll" href="<?php echo base_url(); ?>all-designers?q=d">See All</a>
    <h2>Designers of the month</h2>
    <p>Bringing International designers for the design connoisseurs</p>
    <div class="Desinger_sect-B clearfix  hidden-xs">
    <div class="row">
    
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="DB-Wrap">
            <a href="https://www.mansionly.com/theresa-obermoser/designer/179?q=d">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/des-01.jpg?v=1.2"  alt="banner"> 
           </a>     
            </div> 
          </div>
          
          
          
          <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="DB-Wrap">
                   <a href="https://www.mansionly.com/wafer-studio/designer/178?q=d">
                     <img src="<?php echo base_url().SitePath ; ?>assets/img/des-02.jpg?v=1.2"  alt="banner"> 
                   </a>    
                </div> 
            </div>
          
          
          <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="DB-Wrap">
                <a href="https://www.mansionly.com/atelier-cosmas-gozali/designer/1?q=d">
                     <img src="<?php echo base_url().SitePath ; ?>assets/img/des-03.jpg?v=1.2"  alt="banner"> 
                </a>     
             </div>
            </div>
            
            
           <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="DB-Wrap">
                   <a href="https://www.mansionly.com/wafer-studio/designer/178?q=d">
                    <img src="<?php echo base_url().SitePath ; ?>assets/img/des-04.jpg?v=1.2"  alt="banner"> 
                   </a>   
                </div>
            </div>
            
            </div>
    </div>  
        
     
    
     
    <!-------------Mobile Slider-------------->
           <div  class="owl-carousel hidden-lg hidden-md visible-xs" id="designerboard01">
           
            <div class="item">
                    <a href="https://www.mansionly.com/theresa-obermoser/designer/179?q=d">
                     <img src="<?php echo base_url().SitePath ; ?>assets/img/des-01.jpg?v=1.2"  alt="banner"> 
                    </a>    
               </div>
           
           
            <div class="item"> 
                <a href="https://www.mansionly.com/atelier-cosmas-gozali/designer/1?q=d">
                <img src="<?php echo base_url().SitePath ; ?>assets/img/des-03.jpg?v=1.2"  alt="banner"> 
               </a>   
            </div> 
               
                <div class="item">   
                  <a href="https://www.mansionly.com/wafer-studio/designer/178?q=d">
                 <img src="<?php echo base_url().SitePath ; ?>assets/img/des-02.jpg?v=1.2"  alt="banner"> 
          		</a> 
               </div>  
                
                 <div class="item">
                     <a href="https://www.mansionly.com/wafer-studio/designer/178?q=d">
                     <img src="<?php echo base_url().SitePath ; ?>assets/img/des-04.jpg?v=1.2"  alt="banner"> 
                    </a>    
                </div>
              
         </div> 
    <!-------------Mobile Slider---end-----------> 
    </div>
    </section> 

<?php if(!empty($magazine_list)) { ?>  
   <!--<section class="magezine-section magezine-section-new">-->
       
 <section class="dg-container magezine-section">
      <div class="container">
      <h4>Mansionly in action</h4>
    <!--------------------ForMobile------------------------->
    <div class="visible-xs">
        <div class="magezine-mainmobile">
        <div class="owl-carousel magezine-sections-mobile " id="MageZineMobile">
            <?php foreach($magazine_list as $key=>$row) { ?>
            <div class="item">
              <a target="_blank" href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank"><img src="<?php echo str_replace(array('http://'),'https://',$row['guid']);?>"  width="480" height="160">
              <div class="text-center">
                  <h5><?php echo $row['post_title'];?></h5>
              </div>
              <p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p>
            </a></div>
           <?php }?> 
            </div>  
        </div>
    </div>
      
<!--      </div>-->



<!-- <div class="magazine-Div-sctMobile clearfix visible-xs">
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
           </div>-->
     
     <!--------------------ForMobile------------------------->  
      
      
      
      
      
      
      
      
      <!--------------------ForDesktop------------------------->
      
      	<div id="dg-container"  class="Magazine-main ">
		<div class="dg-wrapper ">
                    
                    <?php foreach($magazine_list as $key=>$row) { ?>
                        <a href="<?php echo image_url;?>magazine/<?php echo date('Y/m/d',strtotime($row['post_date']));?>/<?php echo $row['post_name'];?>" target="_blank">
                            <img src="<?php echo str_replace(array('http://'),'http://',$row['guid']);?>"  width="480" height="260">
                        <div><h3><?php echo $row['post_title'];?></h3><p><?php echo substr(strip_tags($row['post_content']),0,50);?>...</p></div></a>
                    <?php }?>
                

                </div>
                <nav>	
                        <span class="dg-prev"> <i class="fa fa-angle-left"></i> </span>
                        <span class="dg-next"><i class="fa fa-angle-right"></i></span>
                </nav>
               
                </div>
        <!--------------------ForDesktop-------------------------> 

       <!--------------------ForDesktop------------------------->
<!--      <div class="magazine-Div-sct clearfix  visible-sm visible-md visible-lg">
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
      </div>-->
      

 <!--------------------ForDesktop------------------------->                
 </div>
</section>
 <?php } ?>
    
<!--<div class="Projects-Brands-Sect clearfix">
    <div class="container">
        <a href="<?php echo base_url(); ?>all-brands?q=l">
            <img  class="hidden-xs" src="<?php echo base_url().SitePath ; ?>assets/img/brand-banner.jpg"  alt="banner">
            <img class="hidden-lg hidden-md visible-xs" src="<?php echo base_url().SitePath ; ?>assets/img/brand-banner-mobile.jpg"  alt="banner">
        </a>
    </div> 
</div>-->
<section class="BrandLogo_section clearfix">
    	<div class="container">
        	<div class="BrandLogo_div clearfix">
            	<ul>
                	<li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>fisher-west-ny?brandID=7&pageType=BLP&q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-01.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>/assets/img/Layer2.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                    <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>marioni/b/120?q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-02.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>/assets/img/Layer3.png"  alt="brand">
                        </div>
                    </li>
                    
                    <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>flokk/b/146?q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-03.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer4.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                    
                     <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>pardo?brandID=125&pageType=BLP&q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-04.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer11.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                     <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>moya/b/109?q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-05.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer5.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                      <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>all-brands?q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-06.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer6.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                    
                      <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>royal-stranger?brandID=85&pageType=BLP&q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-07.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer7.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                      <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>muranti?brandID=151&pageType=BLP&q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-08.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer8.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                      <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>forme/b/95?q=l" target="_blank"><img src="<?php echo base_url().SitePath ; ?>assets/img/logo-09.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath ; ?>assets/img/Layer9.png"  alt="brand">
                        </div>
                    </li>
                    
                    
                      <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>fara?brandID=128&pageType=BLP&q=l" target="_blank">
                            <img src="<?php echo base_url().SitePath ; ?>assets/img/logo-10.png"  alt="brand"></a></span>
                        </div>
                    </li>
                    <li> 
                        <div class="BrandLogoImg">
                        	<img src="<?php echo base_url().SitePath; ?>assets/img/Layer10.png"  alt="brand">
                        </div>
                    </li>
                    
                     <li> 
                        <div class="BrandLogoImg">
                        	<span><a href="<?php echo base_url(); ?>name-design-studio?brandID=46&pageType=BLP&q=l" target="_blank">
                            <img src="<?php echo base_url().SitePath;?>assets/img/logo-11.png"  alt="brand"></a></span>
                        </div>
                    </li>
				</ul>
            </div>			
        </div>
    </section>
    
    
    <section class="Sectors_Slider clearfix hidden-xs">
    <div class="container">
    <a class="seeAll" href="<?php echo base_url(); ?>execution-gallery/all?q=e">See All</a>
    <h2>Sectors we  work in</h2>
    <p>Providing fine designs across spectrum of needs</p>
     <div  class="owl-carousel" id="SectorsSlider">
        <div class="item" > 
        <div class="SctImg">
        <a href="<?php echo base_url(); ?>execution-gallery/residential_interiors?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-01-pre-res.jpg"  alt="banner"> 
              <h4>Residences</h4> 
        </a>     
        </div>
          <div class="SctImg">
          <a href="<?php echo base_url(); ?>execution-gallery/office_space?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-02-office.jpg"  alt="banner">
            <h4>Offices</h4>  
          </a>   
        </div>
          <div class="SctImg">
          <a href="<?php echo base_url(); ?>execution-gallery/retail?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-03-retail.jpg"  alt="banner"> 
            <h4>Retail</h4> 
          </a>   
        </div>
          <div class="SctImg">
          <a href="<?php echo base_url(); ?>execution-gallery/luxury_hotels?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-04-luxury-hotel.jpg"  alt="banner">
            <h4>Luxury Hotels</h4> 
           </a>   
        </div>
        </div>
          <div class="item" > 
        <div class="SctImg">
        <a href="<?php echo base_url(); ?>execution-gallery/spas?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-05-spas& clubs.jpg"  alt="banner"> 
              <h4>Spas & Clubs</h4> 
        </a>     
        </div>
          <div class="SctImg">
          <a  href="<?php echo base_url(); ?>execution-gallery/restaurant?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-06-restaurants.jpg"  alt="banner">
            <h4>Restaurants</h4>  
          </a>   
        </div>
<!--          <div class="SctImg">
          <a href="<?php echo base_url(); ?>execution-gallery/global_inspiration?q=e">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-07-global-inspi.jpg"  alt="banner"> 
            <h4>Global Inspiration</h4> 
          </a>   
        </div>-->
          <div class="SctImg">
          <a  href="<?php echo base_url(); ?>execution-gallery/all?q=e" >
            <img src="<?php echo base_url().SitePath ; ?>assets/img/sector-08-view all.jpg"  alt="banner">
            <h4>View all </h4> 
           </a>   
        </div>
        </div>
        
          
     </div>
    </div>
    </section>
    



    <section class="howSeeWork-Section clearfix">
    <div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="howSeeWork_Left clearfix">
            <img src="<?php echo base_url().SitePath ; ?>assets/img/img_howitworks.jpg" alt="GuestBedroomView">
            <div class="fineLiv-text">WELCOME FINE LIVING</div>
        </div>    
        </div>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="howSeeWork_Right clearfix">
            
            <div class="home-VideoSect">
            <iframe width="652" height="315" src="https://www.youtube.com/embed/HM_eXBhYDKM?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
           
                <div class="CntUS-form clearfix ">
                    <form id="get_started2" name="get_started2">
                                        <input type="text" class="form-control "  name="userinformation2" id="userinformation2" placeholder="Share your number for a free design consultation!"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    <button class="exploreBtn">Contact Me</button>
                </form>
            </div>
            
            <h4>Bringing a global interior revolution to your home</h4>
            <p>Mansionly brings to you a platform for <br>
    Home Interiors and Lifestyle Solutions connecting you to the world‘s best <br>
    interior designers, furniture, decor and lifestyle brands.
    </p>
    <ul>
    <li><span><img src="<?php echo base_url().SitePath ; ?>assets/img/hw01.png" alt="hw01"></span><p>INTERNATIONAL BRANDS</p></li>
    <li><span><img src="<?php echo base_url().SitePath ; ?>assets/img/hw02.png" alt="hw02"></span><p>BEST DESIGNERS</p></li>
    <li><span><img src="<?php echo base_url().SitePath ; ?>assets/img/hw03.png" alt="hw03"></span><p>BEST IN CLASS EXECUTION</p></li>
    </ul>
    <a class="seewhowBtn" href="<?php echo base_url(); ?>how-it-works">SEE HOW WE WORK</a>
            </div>
        </div>
        
        
    
    </div>
    </div>
    
    
    
    
    </section>  
 
 <div class="Projects-Brands-Sect pd-50 clearfix">
        <div class="container">
        <a href="<?php echo base_url(); ?>execution-gallery/all?q=e">
        <img  class="hidden-xs" src="<?php echo base_url().SitePath ; ?>assets/img/projects-banner.jpg"  alt="banner">
        <img  class="hidden-lg hidden-md visible-xs" src="<?php echo base_url().SitePath ; ?>assets/img/projects-banner-720.jpg"  alt="banner">
        </a>
        </div> 
   </div>
 
<section id="randomBlockId" class="RandomBlock_repeat_Sect clearfix">  </section> 
 
 <section id="containLoader-bg" class="RandomBlock_repeat_Sect clearfix">
   <!--[AnimateBG]-->        
<div class="container">
  	<div class="row">
    
<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlockRepeat clearfix">      
        <div class="mloader_card" style="display: block;">
<div class="mloadercard_image  Animated_bg"></div>
<div class="mloadercontent mb-10">
<div class="mloaderbar Animated_bg width85 mb-10"></div>
<div class="mloaderbar Animated_bg width77 mb-10"></div>

</div>



</div>
    </div>
</div>


        
    </div>
    <div class="container">
    	<div class="GetCall_usSect clearfix">
        		<div class="mloadercard_image">
                	<div class="form-control Animated_bg "></div>
                </div>
                
        </div>
    </div>
  </div>
 <!--[AnimateBG]-->  
 </section>
<!--<div style="display:none; text-align:center;margin-bottom: 40px;" id="divLoaderId"><img src="<?php echo image_url; ?>media/images/ajax-loader.gif" alt="loading" width="50" /></div>-->
  
  
  
     
  
            
  
    	
     
            
            
            
            
            
  
  
  
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


<script src="<?php echo base_url().SitePath ; ?>assets/js/jquery.gallery.js" defer="defer" ></script>

<script>
/*Javascript*/
$(document).ready(function(){
   $(function() {
	$('#dg-container').gallery();
});  
});
</script>
<script type="text/javascript">
/*Javascript*/
 var offsetDesigner=0;   
 var offsetBrand=0;   
 var offsetProduct=0;   
 var offsetEP=0;   
 var offsetDC=0;   
 var offsetBlog=0; 
 var getStartedIndex=2;
 var loading=true;
 
 $(document).ready(function (){
      ajaxHomePage();
      
         
   $(window).scroll(function() {
	var end = $(document).height(); var viewEnd = $(window).scrollTop() + $(window).height(); var distance = end - viewEnd; 
	if (distance < 500 && loading){
            loading = false;
            ajaxHomePage();
	}
});

 });
 
 function ajaxHomePage(){
     loading = false;
	 $('#containLoader-bg').show();
    // $('#divLoaderId').show();
     $.ajax({
        url:baseUrl+"ajaxHomePage",
        type:"post",
        data:{'offsetDesigner':offsetDesigner,'offsetBrand':offsetBrand,'offsetProduct':offsetProduct,'offsetEP':offsetEP,'offsetDC':offsetDC,'offsetBlog':offsetBlog,getStartedIndex:getStartedIndex},
        success: function(response){
            var data = response.split('|*|*|');
            var offset = JSON.parse(data[0]);
            offsetDesigner = offset.offsetDesigner;
            offsetBrand = offset.offsetBrand;
            offsetProduct = offset.offsetProduct;
            offsetEP = offset.offsetEP;
            offsetDC = offset.offsetDC;
            offsetBlog = offset.offsetBlog;
            getStartedIndex = offset.getStartedIndex;
            
            $('#randomBlockId').append(data[1]);
            $('#containLoader-bg').hide();
           // $('#divLoaderId').hide();
            loading = true;
        },
        error: function(e){
            //alert('Please relode the page.');
             loading = true;
			 $('#containLoader-bg').hide();
             //$('#divLoaderId').hide();
        }
        
    });
     
 }

</script>


<?php
$this->load->view('section/vw_footer');
?>