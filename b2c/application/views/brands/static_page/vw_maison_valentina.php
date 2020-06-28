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
    
    $leadGenFromSliderPageURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 ?>
    
  <!--------------[ Middle Section ]------------->
  
  <section class="rosenthal-brand  sambonet-brand">
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
        <li>  <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image320.jpg" alt="img"> </li>
      </ul>
    </div>
    <!--------------[ Mobile Banner ]------------->
    
    <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> 
    <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image.jpg" alt="img"> </div>
        </div>
    </div>
    <div class="rs-brandlogo  rs-brandlogo-verscase clearfix">
      <div class="container">
        <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/staticlogo-mansion.jpg" alt="img"> </div>
        <div class="rs-logotext-right">Maison Valentina was born in Porto, Portugal, aiming to deliver the most exquisite and sophisticated bathroom furniture. Offers high-end solutions made with the finest material selection, combined with rare handwork techniques, contemporary design and assuring supreme quality.

As a global brand, being present in design in the most important cities is inevitable. Establishing a close relation and working proximity with our clients is imperative. We take it to the next level by having a customer support team and a costumer centric posture. Through our costumer centric approach, Maison Valentina focus on the client requirements pursuing value maximization by guaranteeing excellence in design, production, commercialization and customer support.

As an outstanding brand, Maison Valentina will be recognized as the main reference in the worldwide luxury bathroom market, heightening luxury meaning and leading the market to new boundaries.</div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="Versace-Slider-luxbanner">
      <div class="container">
  
        <div class="Versace-Slider-inner">
          <div class="owl-carousel Versace_Slider">
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-1.jpg" alt="img">
              <div class="Versace-img-cption">luxury bathrooms</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-2.jpg" alt="img">
              <div class="Versace-img-cption">Newton white bathtub and Eden towel rack</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-3.jpg" alt="img">
              <div class="Versace-img-cption">Symphony bathtub and Black Paramount surface</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-4.jpg" alt="img">
              <div class="Versace-img-cption">Diamond bathtub</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-5.jpg" alt="img">
              <div class="Versace-img-cption">Newton bathtub</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
              <p>Maison Valentina’s main goal is to offer the same comfort and luxury that you are able to feel in any other division of the home, into the bathroom.</p>
      </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="Versace-imageGallery-section clearfix">
    	<div class="container">
        <div  class="Versace-imageGallery">
        	<ul>
            	<li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img570-1.jpg" alt="img">
                    <div class="v-gallimg-capt">Galliano wall lamp </div>
                    </div>
                </li>
            	  <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img570-2.jpg" alt="img">
                    <div class="v-gallimg-capt">Diamond Towel Rack and Black Agatha Surface </div>
                    </div>
                </li>
                </ul>
            
              <ul>
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img470-1.jpg" alt="img">
                    <div class="v-gallimg-capt">Living Room </div>
                    </div>
                </li>
                <li >
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img470-2.jpg" alt="img">
                    <div class="v-gallimg-capt">Charles wall lamp </div>
                    </div>
                </li>
            
            </ul>
        </div>
        </div>
    </div>
    
    <div class="Tableware-imageGallery-section clearfix">
    	<div class="container">
        <div  class="Tableware-imageGallery">
        <h2>BEST SELLERS</h2>
        <h4>Luxurious accessories for exclusive </h4>
        	<ul>
            
            
            	<li>
                	<div class="v-gallimg">
                        <div class="v-gallimgwrap">
                        <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-3.jpg" alt="img">
                        <div class="v-gallimg-capt">Wall plate</div>
                        </div>
                    </div>
                </li>
            	  <li>
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-2.jpg" alt="img">
                    <div class="v-gallimg-capt">Gala Prestige</div>
                    </div>
                    </div>
                </li>
               
                <li>
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-1.jpg" alt="img">
                    <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
                    </div>
                    </div>
                </li>
                
          
                 <div class="clearfix"></div>    	
             
                <li class="blue-prestige-gala">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-4.jpg" alt="img">
                    <div class="v-gallimg-capt">Blue Prestige Gala</div>
                    </div>
                    </div>
                </li>
                
                 <li class="">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-5.jpg" alt="img">
                    <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
                    </div>
                    </div>
                </li>
            <li class="">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img325-6.jpg" alt="img">
                    <div class="v-gallimg-capt">Blue Prestige Gala</div>
                    </div>
                    </div>
                </li>
            </ul>
        </div>
        </div>
    </div>
    
    
      <div class="Stemware-imageGallery-section clearfix">
    	<div class="container">
        	<div class="Stemware-imageGallery">
            	<h2>Luxury Bedroom and Bathroom</h2>
                <h4>Symphony of Residential Products</h4>
                <ul>
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img480-1.jpg" alt="img">
                    <div class="v-gallimg-capt">Bedroom & Bathroom</div>
                    </div>
                </li>
                
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img480-2.jpg" alt="img">
                    <div class="v-gallimg-capt">Tribeca loft </div>
                    </div>
                </li>
                
                 <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/img400-300.png" alt="img">
                    <div class="v-gallimg-capt">Symphony dressing table</div>
                    </div>
                </li>
                </ul>
                
            </div>
        </div>
     </div>
      <div class="clearfix"></div>
      <div class="Versace-SendRquest-form">
       <div class="interest-form">
        <div class="container">
        	<form id="formContact" name="formContact">
            	<div class="int-mainform clearfix">
                 <p>Interested in buying or knowing more ?<br>Share your contact details and our executive will get in touch with you.</p>
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
                                </div> 
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="loader" id="loader" style="display:none;" ></div>
                <button class="btn btn-block requestBtnsend" type="submit">Send Request</button>
                <input type="hidden" name="leadGenFromSliderPageType" id="leadGenFromSliderPageType"  value="<?php echo $leadGenFromSliderPageType; ?>" />
                <input type="hidden" name="leadGenFromSliderPageUniqueId" id="leadGenFromSliderPageUniqueId"  value="<?php echo $leadGenFromSliderPageUniqueId; ?>" />
                <input type="hidden" name="leadGenFromSliderPageURL" id="leadGenFromSliderPageURL"  value="<?php echo $leadGenFromSliderPageURL; ?>" />
            </form>
            </div>
        </div>
       </div> 
       <div class="clearfix"></div>
   
    <div class="clearfix"></div>
    <div class="container">
      <div class="Rs-about-sect sambonetaboutus clearfix">
        
        <p class="headrs" >Maison Valentina </p>

<p>Our main goal is to offer the same comfort and luxury that you are able to feel in any other division of the home, keeping at the same time the best exclusive design and bold pieces.

Gathering talented professionals from different fields, each piece is tailored and handmade having in mind the customer needs and desires. Exclusiveness is granted since our skilled craftsman focus all their effort in creating both aesthetic and functional perfection. Our hunt for new challenges allows the client to demand customized and tailored pieces in which we will surely exceed the customer expectations.

Our one-of-a-kind creations praise any bathroom environment whether you are building it from scratch or just remodelling. We believe any client should be able to have our items so we are able to deliver from one piece to a full collection or environment. If you are a single buyer, a Contractor, an Interior Designer or an Architect, either way, we will deliver!</p>
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
