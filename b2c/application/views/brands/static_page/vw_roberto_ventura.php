<?php
$this->load->view('section/vw_header_1');
$this->load->view('brands/static_page/css_files.php');
$this->load->view('section/vw_header_2');
?>

<?php
    if ($this->session->userdata('customer_info')['customer_email']) {
        $customer_email = $this->session->userdata('customer_info')['customer_email'];
    } else {
        $customer_email = "";
    }
    if ($this->session->userdata('customer_info')['customer_phone']) {
        $customer_phone = $this->session->userdata('customer_info')['customer_phone'];
    } else {
        $customer_phone = "";
    }
    if ($this->session->userdata('customer_info')['customer_name']) {
        $customer_name = $this->session->userdata('customer_info')['customer_name'];
    } else {
        $customer_name = "";
    }
 ?>
    
  <!--------------[ Middle Section ]------------->
  
  <section class="rosenthal-brand">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
       <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url(); ?>all-brands">All Brands</a></li>
        <li class="active"><?php echo $brand_details[0]['brand_name']; ?></li>
      </ol>
    </div>
    
     <!--------------[ Mobile Banner ]------------->
        <div class="RosenthalMob-imgGallary visible-xs">
            <ul>
                <li>
                  
                        <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/roberto-mobile.jpg" alt="img">
                   
                </li>
            </ul>
        </div>
     <!--------------[ Mobile Banner ]-------------> 
    
    
    <div class="brand-v1-slider rosenthal-slider robertoslidr visible-sm visible-md visible-lg "> 
    <div class="Roberto-bannerLogo-caption">
    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/roberto-logo.png" alt="img"> 
    <p>Fine craftsmanship from Italy -</p>
    </div>
    <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/roberto-banner.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/roberto-banner.jpg" alt="img"> </div>
      </div>
    </div>
    
    
    <div class="rs-brandlogo  rs-brandlogo-verscase robertoventurslogos clearfix visible-xs">
      <div class="container">
        <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/roberto-logo.png" alt="img"> </div>
        <div class="rs-logotext-right">Fine craftsmanship from Italy -</div>
      </div>
      <div class="clearfix"></div>
    </div>
   <div class="clearfix"></div> 
    
    
    <div class="roberto-venture-imgGallary">
    	<div class="container">
        	<div class="robertoimgGallary">
            	<ul>
                	<li>
                    	<div class="robertoimgGallary-wrap">
                    	<div class="robertoimg"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt01.png" alt="img"> </div>
                        <div class="robertoimg-cpttion"> Sideboard with in relief gypsum finish with silver details   </div>                       
                         </div>                                            
                         </li>
                    
                    <li>
                    <div class="robertoimgGallary-wrap">
                    	<div class="robertoimg"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt02.png" alt="img"> </div>
                        <div class="robertoimg-cpttion">
                       Armchair with wood carving and gold 
leaf finishing
                        
                        </div>
                        </div>
                    </li>
                    
                    
                    <li>
                        <div class="robertoimgGallary-wrap">
                    	<div class="robertoimg">
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt03.png" alt="img"> 
                        </div>
                        <div class="robertoimg-cpttion">
                          Tavolino tondo in citronnier round table in citronnier
                        </div>
                        </div>
                    </li>
                    
                    <li>
                        <div class="robertoimgGallary-wrap">
                            <div class="robertoimg">
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt04.png" alt="img"> </div>
                            <div class="robertoimg-cpttion">
                            Sofa in rich metallic finish

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    

    <div class="robertoventure_Slider-wrapper">
    <div class="container">
    
      <div class="robertoventure_Slider owl-carousel  visible-sm visible-md visible-lg" >
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv01.jpg" alt="img">
         </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv02.jpg" alt="img">
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv03.jpg" alt="img">
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv04.jpg" alt="img">
        </div>
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv05.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv06.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv07.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv08.jpg" alt="img">
        </div>
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rv09.jpg" alt="img">
        </div>
        
      </div>
      
<!-----------------mobile slider------------------------------>      
      <div class="robertoventure_Slider-mobile owl-carousel visible-xs  " >
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm01.jpg" alt="img">
         </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm02.jpg" alt="img">
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm03.jpg" alt="img">
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm04.jpg" alt="img">
        </div>
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm05.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm06.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm07.jpg" alt="img">
        </div>
        
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm08.jpg" alt="img">
        </div>
         <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rvm09.jpg" alt="img">
        </div>
        
      </div>
<!------------------mobile slider----------------------------->       
      
    </div>
    </div>
        <div class="clearfix"></div>
    <div class="rv-descriptScetion">
    	    <div class="container">
            	<p>Customization solutions a company flagship that’s part of a full and distinctive service. All that because the soul of a fine craftsmanship can not ignore the aspect of rewarding personalization. There are no limits to our creative research, but also to your ideas.Contact us and we’ll give shape to your idea.</p>
            </div>
    	
    </div>
   
   
    <div class="clearfix"></div>
    
    
      <div class="roberto-venture-imgGallary2">
    	<div class="container">
        	<div class="robertoimgGallary2">
            	<ul>
                	<li>
                    <div class="robertoimgGallary-wrap">
                        	<div class="robertoimg">
                            	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt05.png" alt="img"> 
                            </div>
                            <div class="robertoimg-cpttion">  Chest of drawers in black lacquered finish 
with silver wood carvings </div>                      
                        </div>
                    </li>
                    <li>
                    <div class="robertoimgGallary-wrap">
                        	<div class="robertoimg">
                            	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt06.png" alt="img"> 
                            </div>
                            <div class="robertoimg-cpttion">  White Sofa in massif rosewood </div>                      
                        </div>
                    </li>
                    
                    <li>
                    <div class="robertoimgGallary-wrap">
                        	<div class="robertoimg">
                            	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt07.png" alt="img"> 
                            </div>
                            <div class="robertoimg-cpttion">  Divano Sofa </div>                      
                        </div>
                    </li>
                    <li>
                    <div class="robertoimgGallary-wrap">
                        	<div class="robertoimg">
                            	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt08.png" alt="img"> 
                            </div>
                            <div class="robertoimg-cpttion">  Dormeuse Sofa upholstered with velvet</div>                      
                        </div>
                    </li>
                    <li>
                    <div class="robertoimgGallary-wrap">
                        	<div class="robertoimg">
                            	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rbt09.png" alt="img"> 
                            </div>
                            <div class="robertoimg-cpttion">  Sideboard in old red lacquered</div>                      
                        </div>
                    </li>
				</ul>
             </div> 
         </div>      
         </div>	    
    
    <div class="clearfix"></div>
    
        <div class="interest-form robertoVentura-form">
        	<form id="formContact" name="formContact">
            	<div class="int-mainform clearfix">
                     <div class="container">
                  <p>Interested in buying or knowing more ? <br>
Share your contact details and our executive will get in touch with you.</p>
                	<ul>
                    	<li>
                        	<div class="form-group">
                        	<input type="text" name="name_b" id="name_b" class="form-control" placeholder="Name *" value="<?php echo $customer_name; ?>" >
                            </div>
                        </li>
                        
                        <li>
                        	<div class="form-group">
                        	<input type="email" name="email_b" id="email_b" class="form-control" placeholder="Email *" value="<?php echo $customer_email; ?>">
                            </div>
                        </li>
                        
                        <li>
                        	<div class="form-group">
                        	<input type="text" name="mobile_b" id="mobile_b" maxlength="15" class="form-control" placeholder="Mobile Number *" value="<?php echo $customer_phone; ?>">
                            </div>
                        </li>
                        
                         <li>
                        	<div class="form-group">
                            <div class="selct-stle">
                        	 <select name="city_b" id="city_b" class="form-control">
                                        <option value="">CITY</option>
                                        <?php foreach ($city_list as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['city']; ?></option>
                                        <?php } ?> 
                                    </select> 
                             </select>
                            </div> 
                            </div>
                        </li>
                        
                    </ul>
                    
                 </div>
                </div>
               <div class="loader" id="loader" style="display:none;" ></div>
               <button class="btn btn-block requestBtnsend" type="submit">Send Request</button>
                
            </form>
         
        </div>
       <div class="clearfix"></div> 
       	<div class="container"> 
        <div class="Rs-about-sect robertoventuraAbt clearfix">
        
            
            	<p class="headrs">About Roberto Ventura</p>

                <p>
                    Tagliabue Ambrogio began the business of cabinet-maker in Cantù, during 1948 assisted by his brother.
                </p>
                <p>
                    These were the years of postwar reconstruction and the traditonal Crafts of Cantù began its ascent, conferming the artistic and creative validity that would projected the small town on top of the world’s commercial successes, during the years to come.
                </p>
                <p>
                 TAGLIABUE’s has build their success during this period profitable for the furniture industry, with constant effort to improve their work skills increasingly and with pride to see their accomplishments appreciated everywhere.                
                </p>
                <p>
                  The company was led by the descendants, becoming the current TAGLIABUE A & A. Alberto e Alessandro Tagliabue. From 1972 the company developed its productive capacity enormously, building also the present factory with 20 workers.
                </p>
                <p>
                    Other artisans near Cantù collaborate with Tagliabue A&A, guaranteeing, at the same time, high product quality, extreme versatility of realization and delivery on time.
                </p>
                <p>
                    A technical office with modern equipement and an efficient commercial office, are available to solve all the requirements for the design, delivery and post-sales.
                </p>
                <p>
                  A&A Tagliabue, thanks to the experience gained during years, is able to create fornitures modules: from ‘700’s french to Decò and contemporary; stays, dining rooms, bed sets and wardrobes. Furthermore, the skills of our workers allow us to realize custom furnitures, different by our collections, boiseries, lambris, shelves, doors and cover radiators.  
                </p>
                <p>
                  All this things are possibile with different woods and finishes polished or lacquered to the sample. Our know-how has enabled us to penetrate the italian market and also the foreign market collaborating with the best professionals in the furniture industry.  
                </p>
                
        </div>	
    </div>
  </section>
</div>

<!--------------[ Middle Section ]-------------> 
     

<?php
$this->load->view('brands/static_page/js_files.php');
$this->load->view('section/vw_footer');
die;
?>
