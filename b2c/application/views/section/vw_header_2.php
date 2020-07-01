<?php
$header_designer_list = $this->Md_header->getHeaderDesignerList();
$header_premium_residences_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'residential_interiors');
$header_global_inspirations_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'global_inspiration');
$header_luxury_hotels_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'luxury_hotels');
$retail_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'retail');
$office_space_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'office_space');
$restaurant_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'restaurant');
$spas_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'spas');
$all_portfolio_list = $this->Md_header->getExecutionSamplePortfolio($flag = 'all');
$header_brand_list = $this->Md_header->getHeaderBrandList();
$header_product_cat_list = $this->Md_header->getHeaderProductCatList();
$header_section_list = $this->Md_header->getHeaderSectionList();
if(!empty($_GET['q'])){
$q  =   $_GET['q'];
}else{
   $q  = ''; 
}
if(!empty($_GET['q_search'])){
$q_search  =   $_GET['q_search'];
}else{
   $q_search  = ''; 
}

$CurrentVisitedUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
//echo "<pre>"; print_r($header_designer_list);die;

$table = "social";
$condition = array('status' => '1');
$social_media_list = $this->Md_database->getData($table,'social_id,social_name,statusck,social_value,status',$condition, 'social_id');

?>
<input type="hidden" name="CurrentVisitedUrl" id="CurrentVisitedUrl" value="<?php echo $CurrentVisitedUrl;?>">
<!--[start::right:click]-->
<script defer type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>media/js/js-rightclickoff.js"></script>
<!--onkeypress="return disableCtrlKeyCombination(event);" onkeydown="return disableCtrlKeyCombination(event);"-->
<!--[end::right:click]-->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(
{'gtm.start': new Date().getTime(),event:'gtm.js'}
);var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NGSHZ5G');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NGSHZ5G"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!--------------[ Header Section ]------------->

<div class="wrpper NewHomepage_wrapper">
<header class="clearfix">
  <nav class="header-menu">
  
    <div class="logo">
        <a alt="Best of Interior Design & Home Decoration - Mansionly.com"  href="<?php echo base_url(); ?>"> 
            <img alt="Best of Interior Design & Home Decoration - Mansionly.com"  src="<?php echo base_url().SitePath; ?>assets/img/newhomelogo.png"> 
        </a>
    </div>
    <a href="javascript:void(0);" class="menuBtn"><span class="icon-lnr-menu"></span> </a>
    
        <div class="header-right-menu-mobileNew">
         <a href="javascript:void(0);" class="menuBtnClose"><span class="icon-cross "></span> </a>
        <div class="logo_mobile">
                <a alt="Best of Interior Design & Home Decoration - Mansionly.com"  href="<?php echo base_url(); ?>"> 
                    <img alt="Best of Interior Design & Home Decoration - Mansionly.com"  src="<?php echo base_url().SitePath; ?>assets/img/newslogo.png"> 
                </a>
        </div>
        	<ul>
            	<!--<li><a href="<?php echo base_url(); ?>">Home</a></li>-->
            	<li><a href="<?php echo base_url(); ?>all-designers?q=d"><span class="icon-designers"></span>Designers</a></li>
                <li><a href="<?php echo base_url(); ?>execution-gallery/all?q=e" ><span class="icon-excution-gallery"></span>Projects<!--Execution Gallery--></a>                                   </li>
                <li class="dropdown" ><a href="<?php echo base_url(); ?>all-categories?q=l" class="dropdowntoggle " data-toggle="dropdown"><span class="icon-bed"></span>Furniture & Decor<!--Lifestyle Products-->  <span class="icon-lnr-chevron-down"></span></a>
                <ul class="dropdownmenu">
                    <li><a href="<?php echo base_url(); ?>all-brands?q=l">Brands</a></li>
                    <li><a href="<?php echo base_url(); ?>all-categories?q=l">Categories</a></li>
                    <li><a href="<?php echo base_url(); ?>all-sections?q=l">Sections</a></li>
                    <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Collectibles'))) ;?>/fl/2?q=l">Collectibles</a></li>
                    <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))) ;?>/fl/1?q=l">Decorative Art</a></li>
	            <li><a href="<?php echo base_url(); ?>bespoke?q=l">Bespoke</a></li>					
                    </ul>
               </li>
                <li><a href="https://www.mansionly.com/magazine/" target="_blank"><span class="icon-lnr-book"></span>Insights<!--Magazine--></a></li>
                <li><a href="<?php echo base_url(); ?>contact-us"><span class="icon-ipad-contact"></span>Contact Us</a></li>
                <li><a href="<?php echo base_url(); ?>about-us"><span class="icon-login"></span>About Us</a></li>
                <li><a href="<?php echo base_url(); ?>how-it-works"> <span class="icon-how-it-works"></span>How it Works</a></li>
                 <li><a href="<?php echo base_url(); ?>terms"> <span class="icon-menu"></span>Terms & Conditions</a></li>
                 <li><a href="<?php echo base_url(); ?>privacy"> <span class="icon-menu"></span>Privacy Policy</a></li>
            </ul>
            <div class="Ft-first-social clearfix" >
          <ul class=" clearfix">
<!--            <li> <a href="javascript:void(0)"> <i class="fa fa-facebook"></i> </a> </li>
            <li> <a href="javascript:void(0)"> <i class="fa fa-twitter"></i> </a> </li>
            <li> <a href="javascript:void(0)"> <i class="fa fa-pinterest"></i> </a> </li>
            <li> <a href="javascript:void(0)"> <i class="fa fa-youtube-play"></i> </a> </li>
            <li> <a href="javascript:void(0)"> <i class="fa fa-google-plus"></i> </a> </li>
            <li> <a href="javascript:void(0)"> <i class="fa fa-instagram"></i> </a> </li>-->
             <?php  foreach ($social_media_list as $row) { 
                        
                if($row['social_name']== "youtube"){$row['social_name']= "youtube-play";}
                if($row['social_name']== "googleplus"){$row['social_name']= "google-plus";}
                ?>
              <li> <a href="<?php echo $row['social_value'];?>" target="_blank"> <i class="fa fa-<?php echo $row['social_name'];?>"></i> </a> </li>
            <?php   } ?>
          </ul>
        </div>
        <div class="apIco clearfix">
          <a href="https://play.google.com/store/apps/details?id=com.mansionly.customerapp&hl=en"> <img src="<?php echo base_url().SitePath; ?>assets/img/google-store-icon.png" alt="app"> </a> </li>
           <a href="https://itunes.apple.com/us/app/mansionly/id1389752415?ls=1&mt=8"> <img src="<?php echo base_url().SitePath; ?>assets/img/app-store-icon.png" alt="app"> </a> </li>
         </div>  
             <div class="copyright-ft">All contents © copyright 2019 Mansionly.</div>
             
        </div>
        <div class="mobile-search ">
         <li > <a href="javascript:void()" id="flip"><span class="icon-lnr-magnifier"></span></a></li>
         <li class="active"> <a href="<?php if(!empty($_SESSION['customer_id'])){echo base_url().'users';}else{ echo base_url().'signin'; } ?>">
                 <span class="icon-login" title="<?php if(!empty($_SESSION['customer_id'])){echo 'Profile';}else{ echo 'Sign In'; } ?>">
                 </span>
             </a>
         </li>
        </div>
        <div id="panel" class="searchPanel">
            <form id="search_form_nav">
             <div class="input-group">
                 <input type="text" class="form-control" name="search_text_nav" placeholder="Search for..." id="search_text_nav" value="<?php echo $q_search; ?>">
              <span class="input-group-btn">
                  <button  class="btn btn-default" type="submit"> Go!</button>
              </span>
              </div>
            </form>	
        </div>
        
    
    <div class="header-right-menu">
      <ul>
        <li class="dropdown"  > 
        <a class="dropdown-toggle liactive <?php if($q == 'd') { ?>active<?php } ?>"  href="<?php echo base_url(); ?>all-designers?q=d" id="designer">DESIGNERS</a>
          <ul class="dropdown-menu megamenu row  megaDrop1 " id="designer_block" >
            <li class="Desinger-tb"> 
                <div class="clearfix"></div>
                <div class="col-md-9 col-sm-9 dszrStyle">
                 <div class="row">
                <h2>Featured Designers </h2>
                <?php  foreach ($header_designer_list as $key=> $row) { 
                    if($key<=2){
                    ?>
                    <div class="col-md-4 col-sm-4">
                        <!--<a href="<?php echo base_url(); ?>designer-profile/<?php echo $row['id'];?>/<?php echo urlencode( $row['designer_name']) ;?>?q=d">-->
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'].'?q=d';?>">
                                <div class="proImg"><img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo'];?>"  class="img-responsive"></div>
                                <div class="proImg-head"><?php echo $row['designer_name'];?></div>
                                <div class="dcity"><i class="fa fa-map-marker"></i><?php echo $row['countryName'];?> </div>
                        </a>   
                    </div>
                <?php  } } ?>
                </div>
                </div>
                 <div class="col-md-3 col-sm-3 last3" style="padding:0px;">
                  <div class="allDesigner" style=" background:#dadada; min-height:275px;">
                   <?php  foreach ($header_designer_list as $key=> $row) { 
                    if($key > 2){
                    ?>
                   <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'].'?q=d';?>">
                       <?php echo $row['designer_name'];?>
                   </a> 
                   <?php  } } ?>
                   <a href="<?php echo base_url(); ?>all-designers?q=d" class="valldes">View All Designers</a>
                  </div>
                </div>
               
                <!--<a href="<?php echo base_url(); ?>all-designers?q=d" class="ViewAll"> View All </a>--> 
            </li>
          </ul>
        </li>
        
        <li class="dropdown" > 
        <a class="dropdown-toggle liactive <?php if($q == 'e') { ?>active<?php } ?>" id="execution_gallary"  href="<?php echo base_url(); ?>execution-gallery/all?q=e" >PROJECTS<!--EXECUTION GALLERY--></a>
          <ul class="dropdown-menu megamenu row megaDrop2 " id="execution_block" >
            
              <li class="col-md-9 col-sm-9 exestyle">
              <div class="row">
              <ul>	
              	<li  class="dropdowheader projectexecution">Premium residences executed by our partners</li>
              </ul>
           
             
              <div class="col-md-12 col-sm-12 " id="project0" style="display:none">
                 <div class="row">  
                 <?php foreach ($header_premium_residences_portfolio_list as $row) { ?>
                    <div class="col-md-4 col-sm-4">
                         <div class="Exewithd" >
                              <!--<a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio?q=e">-->
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                   <div class="exeutxt"></div>
                                   <div class="proImg">
                                       <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                   </div>
                                   <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                               </a>

                       </div>	
                     </div>
                <?php } ?> 

              </div>
              </div>
              <div class="col-md-12 col-sm-12 " id="project1">
                <div class="row">
                    <?php foreach ($header_global_inspirations_portfolio_list as $row) { ?>
                         <div class="col-md-4 col-sm-4">
                              <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                        <div class="exeutxt"></div>
                                        <div class="proImg">
                                            <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                        </div>
                                        <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                     </a>
                               </div>	
                          </div>
                     <?php } ?> 
              
              </div>
              </div>
              
              <div class="col-md-12 col-sm-12 " id="project2" style="display:none">
                 <div class="row">
                    <?php foreach ($header_luxury_hotels_portfolio_list as $row) { ?>
                        <div class="col-md-4 col-sm-4">
                             <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                       <div class="exeutxt"></div>
                                       <div class="proImg">
                                           <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                       </div>
                                       <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                    </a>
                              </div>	
                         </div>
                    <?php } ?> 
                 </div>
               <!--<a href="#" class="ViewAll"> View all </a>--> 
              </div>

              <div class="col-md-12 col-sm-12 " id="project4" style="display:none">
                 <div class="row">                     
                    <?php foreach ($retail_portfolio_list as $row) { ?>
                        <div class="col-md-4 col-sm-4">
                             <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                       <div class="exeutxt"></div>
                                       <div class="proImg">
                                           <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                       </div>
                                       <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                    </a>
                              </div>	
                         </div>
                    <?php } ?>           
               </div>
              </div>
              <div class="col-md-12 col-sm-12 " id="project5" style="display:none">
                 <div class="row">                     
                    <?php foreach ($office_space_portfolio_list as $row) { ?>
                        <div class="col-md-4 col-sm-4">
                             <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                       <div class="exeutxt"></div>
                                       <div class="proImg">
                                           <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                       </div>
                                       <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                    </a>
                              </div>	
                         </div>
                    <?php } ?>           
              </div>
              </div>
              <div class="col-md-12 col-sm-12 " id="project6" style="display:none">
                 <div class="row">                     
                    <?php foreach ($restaurant_portfolio_list as $row) { ?>
                        <div class="col-md-4 col-sm-4">
                             <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                       <div class="exeutxt"></div>
                                       <div class="proImg">
                                           <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                       </div>
                                       <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                    </a>
                              </div>	
                         </div>
                    <?php } ?>           
              </div>
              </div>
              <div class="col-md-12 col-sm-12 " id="project7" style="display:none">
                 <div class="row">                     
                    <?php foreach ($spas_portfolio_list as $row) { ?>
                        <div class="col-md-4 col-sm-4">
                             <div class="Exewithd" >
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                       <div class="exeutxt"></div>
                                       <div class="proImg">
                                           <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                       </div>
                                       <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                                    </a>
                              </div>	
                         </div>
                    <?php } ?>           
              </div>
              </div>
               <div class="col-md-12 col-sm-12 " id="project8" style="display:none">
                 <div class="row">  
                 <?php foreach ($all_portfolio_list as $row) { ?>
                    <div class="col-md-4 col-sm-4">
                         <div class="Exewithd" >
                              <!--<a href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio?q=e">-->
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q=e';?>">
                                   <div class="exeutxt"></div>
                                   <div class="proImg">
                                       <img src="<?php echo image_url; ?>media/images/master-execution-images/150X150/<?php echo $row['master_image'];?>"  class="img-responsive">
                                   </div>
                                   <div class="proImg-head"><?php echo $row['portfolio_name']; ?></div>
                               </a>

                       </div>	
                     </div>
                <?php } ?> 

              </div>
              </div>
               <!--<a href="<?php echo base_url(); ?>execution-gallery/all?q=e" class="ViewAll"> View All </a>--> 
              </div>
            </li>
            <li class="col-md-3 col-sm-3 last3" > 
            <ul class="introExcut-gall allDesigner">
<!--            	   <li class="dropdown-header" >&nbsp;</li>-->
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/residential-interiors?q=e" id="projectlink0">Premium Residences</a> </li>
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/global-inspiration?q=e" id="projectlink1"> Global Inspirations</a> </li>
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/luxury-hotels?q=e" id="projectlink2">Luxury Hotels</a> </li>
                    <!--<li> <a href="<?php echo base_url(); ?>execution-gallery/commercial_designs?q=e" id="projectlink3">Commercial Designs</a> </li>-->
                   <?php if(!empty($retail_portfolio_list)){ ?> 
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/retail?q=e" id="projectlink4"> Retail</a> </li>
                   <?php }?>
                   <?php if(!empty($office_space_portfolio_list)){ ?> 
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/office-space?q=e" id="projectlink5"> Office Space </a> </li>
                   <?php }?>
                   <?php if(!empty($restaurant_portfolio_list)){ ?> 
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/restaurant?q=e" id="projectlink6"> Restaurant </a> </li>
                   <?php }?>
                  <?php if(!empty($spas_portfolio_list)){ ?>  
                    <li> <a href="<?php echo base_url(); ?>execution-gallery/spas?q=e" id="projectlink7"> Spas & Clubs</a> </li>
                   <?php }?>                 
                    <li class="active" > <a class="valldes " href="<?php echo base_url(); ?>execution-gallery/all?q=e" id="projectlink8">View All  Execution Projects</a> </li>
            </ul>
            </li>
          </ul>
        </li>
        
        
        
        <li class="dropdown"> 
        <a class="dropdown-toggle liactive <?php if($q == 'l') { ?>active<?php } ?> "  href="<?php echo base_url(); ?>all-categories?q=l" id="lifestyle">FURNITURE & DECOR<!--LIFESTYLE PRODUCTS--></a>
<!--          <ul class="dropdown-menu megamenu row   megaDrop3" id="lifestyle_block" >
            <li class="col-md-12 col-sm-12 col-xs-12 " > 
            <ul class="lifestle-product">
            <li class="brandsname"> Brands</li>
            <?php  foreach ($header_brand_list as $row) { 
                if(!empty($row['brandPageDesignType'])){
                ?>
                <li><a href="<?php echo base_url(); ?>brand/<?php echo $row['brand_id']; ?>/<?php echo urlencode( $row['brand_name']) ;?>?q=l"> <?php echo $row['brand_name'];?> </a></li>   
                <li><a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['brand_name'])))).'/b/'.$row['brand_id'].'?q=l';?>"> <?php echo $row['brand_name'];?> </a></li>   
            <?php  }else{ ?>
                <li><a href="<?php echo base_url(); ?><?php echo urlencode( $row['brand_url_name']) ;?>?brandID=<?php echo $row['brand_id']; ?>&pageType=BLP&q=l"> <?php echo $row['brand_name'];?> </a></li>   
            <?php  } /*end::ifElse;*/ } /*end::foreach;*/ ?>    
                <li><a href="<?php echo base_url(); ?>all-brands?q=l"> View All Brands </a></li>
            </ul>
            <ul class="lifestle-product">
            <li class="brandsname"> Category</li>
                <?php  foreach ($header_product_cat_list as $row) { ?>
                   <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['cat_name'])))) ;?>?catID=<?php echo $row['cat_id'];?>&pageType=PLP&q=l"> <?php echo $row['cat_name'];?> </a></li>   
                   <li><a href="<?php echo base_url(); ?>productlist/<?php echo $row['cat_id'];?>/<?php echo urlencode( $row['cat_name']) ;?>?q=l"> <?php echo $row['cat_name'];?> </a></li>   
                <?php  } ?> 
                <li><a href="<?php echo base_url(); ?>all-categories?q=l">View All Categories </a></li>
            </ul>
            <ul class="lifestle-product">
            <li class="brandsname"> Section</li>
                 <?php  foreach ($header_section_list as $row) { ?>
                   <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['title'])))) ;?>?sohID=<?php echo $row['id'];?>&pageType=PLP&q=l"> <?php echo $row['title'];?> </a></li>   
                   <li><a href="<?php echo base_url(); ?>sectionlist/<?php echo $row['id'];?>/<?php echo urlencode( $row['title']) ;?>?q=l"> <?php echo $row['title'];?></a></li>   
                <?php  } ?> 
                <li><a href="<?php echo base_url(); ?>all-sections?q=l"> View All Sections </a></li>
            </ul>
            <ul class="lifestle-product lastlfsty">
            <li class="brandsname"> Featured</li>
            <li><a href="<?php echo base_url(); ?>featuredlist/2/<?php echo urlencode( "Collectibles") ;?>?q=l">Collectibles</a></li>
                <li><a href="<?php echo base_url(); ?>featuredlist/1/<?php echo urlencode( "Decorative Art") ;?>?q=l">Decorative Art</a></li>
                
                <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Collectibles'))) ;?>/fl/2?q=l">Collectibles</a></li>
                <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))) ;?>/fl/1?q=l">Decorative Art</a></li>
                <li><a href="<?php echo base_url(); ?>bespoke?q=l">Bespoke</a></li>               
            </ul>
          </ul>-->
         <ul class="dropdown-menu megamenu row   megaDrop3"  >
              <li class="lit-one" >
                <h2  style="">Browse By Brands</h2>
                  <div class="brandlogs clearfix">
                  	<ul>
                        <?php  foreach ($header_brand_list as $row) { 
                                                       
                        $brand_publish_age=0;
                        if(!empty($row['published_date'])){ 
                        $on_date =  date('Y-m-d h:m:s');
                        $objDateA = new DateTime($row['published_date']);
			$objDateB = new DateTime($on_date);
			$diff = $objDateA->diff($objDateB)->format("%r%a");
			$brand_publish_age = $diff +1;
                        }
                        ?>
                    	<li>
                        <!--<p><?php echo $brand_publish_age; ?></p>-->
                        <?php  
                        if(!empty($row['brandPageDesignType'])){                       
                        ?>   
                   
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['brand_name'])))).'/b/'.$row['brand_id'].'?q=l';?>"> 
                        <?php } else { ?>
                        <a href="<?php echo base_url(); ?><?php echo urlencode( $row['brand_url_name']) ;?>?brandID=<?php echo $row['brand_id']; ?>&pageType=BLP&q=l"> 
                        <?php } ?>
                        <div class="brndlogoimgs">
                            <?php if(($brand_publish_age <= 30) && ($brand_publish_age > 0)){ ?>
                            <div class="newtag"></div>
                            <?php } ?>
                            <div class="brnddv"> <img src="<?php echo image_url ; ?>media/images/ecom/brand/200X110/<?php echo $row['brand_image']; ?>"></div>
                        </div>
                         </a>   
                        </li>
                        <?php }
                        ?>
                    </ul>
                    <a href="<?php echo base_url(); ?>all-brands?q=l" class="valldes">View All Brands</a>
                  </div>  
                    
               </li>
                <li class="lit-two" >
		    <div class="cat-lifestyle">
                    	<h2>By Category</h2>
                        <?php  foreach ($header_product_cat_list as $row) { ?>
                           <a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['cat_name'])))) ;?>?catID=<?php echo $row['cat_id'];?>&pageType=PLP&q=l"><?php echo $row['cat_name'];?> </a>
                        <?php } ?>
                           <a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Collectibles'))) ;?>/fl/2?q=l">Collectibles</a>
                           <a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))) ;?>/fl/1?q=l">Decorative Art</a>
                           <a href="<?php echo base_url(); ?>bespoke?q=l">Bespoke</a>
                           <a href="<?php echo base_url(); ?>all-categories?q=l" class="vll">View All</a>
                    </div>               
               </li>
               
                <li class="lit-three" >
                <div class="cat-lifestyle-secthouse">
                 <h2 style="padding-left:0px;">By Section of House</h2>
                    <?php  foreach ($header_section_list as $row) { ?>
                         <a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['title'])))) ;?>?sohID=<?php echo $row['id'];?>&pageType=PLP&q=l"><?php echo $row['title'];?> </a>
                    <?php } ?>
                         <a href="<?php echo base_url(); ?>all-sections?q=l" class="vll">View All</a>
                        </div>
               </li>
            </ul>
          </li>
              <li> <a target="_blank" href="https://www.mansionly.com/magazine/">INSIGHTS<!--MAGAZINE--> </a></li>
              <!--<li class="ABhide"> <a target="_blank" href="">ABOUT US </a></li>
              <li class="ABhide"> <a target="_blank" href="">CONTACT US </a></li>-->
        </ul>
        
      <ul class="rightnav new-nav">
      <li><a href="#">About Us</a></li>
        <li><a href="#">Customer Login</a></li>
        <li><a href="#">Join as Partner</a></li>
        <li class="hide"> 
          <div class="serch-home">
           <form id="search_form">
              <input type="text" class="searchct" name="search_text" id="search_text" value="<?php echo $q_search; ?>">
              <button  class="serchsbt" type="submit"> <i class="icon-lnr-magnifier"></i></button>
           </form>
          </div>
        </li>
        <li class="active hide"> 
            <a href="<?php if(!empty($_SESSION['customer_id'])){echo base_url().'users';}else{ echo base_url().'signin'; } ?>">
                <i title="<?php if(!empty($_SESSION['customer_id'])){echo 'Profile';}else{ echo 'Sign In'; } ?>"  class="icon-login">
                </i>
            </a>
        </li>
      
         <!--<li class="dropdown"> 
        <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:void()"><i class="fa fa-bars"></i></a>
          <ul class="dropdown-menu  " >
            <li> 
            <a  href="<?php echo base_url(); ?>about-us" class=""> ABOUT US</a> 
            </li>
             <li> 
            <a  href="<?php echo base_url(); ?>how-it-works" class=""> How it Works</a> 
            </li>
             <li> 
            <a  href="<?php echo base_url(); ?>contact-us" class=""> Contact US</a> 
            </li>
            
          </ul>
        </li>-->
      </ul>
    </div>
  </nav>
</header>
<!--------------[ Header Section ]-------------> 

<script type="text/javascript">


 $(document).ready(function(){
 $("#search_form").submit(function(e){
     e.preventDefault();
     search_keyword();
 });
  $("#search_form_nav").submit(function(e){
     e.preventDefault();
     search_keyword_nav();
 });
 });
 
 
 function search_keyword(){
  var  search_text =   $("#search_text").val()
  
    if (search_text == ""){
       
        $("#search_text").css("border-bottom", "solid 1px #d82424");
    }else{
        window.location.href = "<?php echo base_url();?>search?q_search="+search_text;

    }

 }

  function search_keyword_nav(){

  var  search_text =   $("#search_text_nav").val()
  //  alert(search_text);
    if (search_text == ""){
       
        $("#search_text_nav").css("border-bottom", "solid 1px #d82424");
    }else{
        window.location.href = "<?php echo base_url();?>search?q_search="+search_text;

    }

 }

</script>

<script type="text/javascript">
    
   /*[start::Code to Handel portfolio images size.]*/
   
        var device_type='';  
        var viewport = jQuery(window).width();
        
        document.cookie = "device_type = ''";

        if(viewport >= 1025) //desktop
        {
            document.cookie = "device_type = desktop";
        }
        else  if(viewport > 768 && viewport < 1025) //tablet_landscap
        {
            document.cookie = "device_type = tablet_landscap";
        }      
        
        else  if(viewport > 640 && viewport <= 768) //tablet_potrait
        {
            document.cookie = "device_type = tablet_potrait";
        }
        else  if(viewport > 375 && viewport <= 640) //mobile
        {
            document.cookie = "device_type = mobile";
        }
        else  if(viewport <= 375) //small mobile
        {
            document.cookie = "device_type = small_mobile";
        }
        else{
            alert('device size is not detected.');
        }
        
   /*[End::Code to Handel portfolio images size.]*/
 </script>

 