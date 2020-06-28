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
        <li>  <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Banner-image320.jpg" alt="img"> </li>
      </ul>
    </div>
    <!--------------[ Mobile Banner ]------------->
    
    <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Banner_image.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Banner_image.jpg" alt="img"> </div>
        </div>
    </div>
    <div class="rs-brandlogo  rs-brandlogo-verscase clearfix">
      <div class="container">
        <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/verscase-logo.png" alt="img"> </div>
        <div class="rs-logotext-right">Versace - Luxurious and glamorous, those are the attributes that describe Versace dinnerware, giftware and stemware best. The combination of Versace's opulent decorations with Rosenthal's sense for simple shapes and forms creates plates, cups, bowls and other porcelain items that stand the test of time. Versace meets Rosenthal - timeless elegance.</div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="Versace-Slider-luxbanner">
      <div class="container">
  
        <div class="Versace-Slider-inner">
          <div class="owl-carousel Versace_Slider">
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Slider-image-1.jpg" alt="img">
              <div class="Versace-img-cption">Dining tables beyond time and space</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Slider-image-2.jpg" alt="img">
              <div class="Versace-img-cption">Dining tables beyond time and space</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Slider-image-3.jpg" alt="img">
              <div class="Versace-img-cption">Dining tables beyond time and space</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Slider-image-4.jpg" alt="img">
              <div class="Versace-img-cption">Dining tables beyond time and space</div>
            </div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace_Slider-image-5.jpg" alt="img">
              <div class="Versace-img-cption">Dining tables beyond time and space</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
              <p>Representing luxurious & glamorous design Versace meets Rosenthal dinnerware is the perfect symbiosis between 
          solid German craftsmanship and breathtaking Italian design.</p>
      </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="Versace-imageGallery-section clearfix">
    	<div class="container">
        <div  class="Versace-imageGallery">
        	<ul>
            	<li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace01.jpg" alt="img">
                    <div class="v-gallimg-capt">SET OF PLATES - MEDUSA</div>
                    </div>
                </li>
            	  <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace03.jpg" alt="img">
                    <div class="v-gallimg-capt">Gala Prestige</div>
                    </div>
                </li>
                </ul>
            
              <ul>
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace02.jpg" alt="img">
                    <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
                    </div>
                </li>
                <li >
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Versace04.jpg" alt="img">
                    <div class="v-gallimg-capt">Blue Prestige Gala</div>
                    </div>
                </li>
            
            </ul>
        </div>
        </div>
    </div>
    
    <div class="Tableware-imageGallery-section clearfix">
    	<div class="container">
        <div  class="Tableware-imageGallery">
        <h2>tableware</h2>
        <h4>Luxurious accessories for exclusive taste</h4>
        	<ul>
            
            
            	<li>
                	<div class="v-gallimg">
                        <div class="v-gallimgwrap">
                        <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv01.jpg" alt="img">
                        <div class="v-gallimg-capt">Wall plate</div>
                        </div>
                    </div>
                </li>
            	  <li>
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv02.jpg" alt="img">
                    <div class="v-gallimg-capt">Gala Prestige</div>
                    </div>
                    </div>
                </li>
               
                <li>
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv03.jpg" alt="img">
                    <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
                    </div>
                    </div>
                </li>
                
          
                 <div class="clearfix"></div>    	
             
                <li class="blue-prestige-gala">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv04.jpg" alt="img">
                    <div class="v-gallimg-capt">Blue Prestige Gala</div>
                    </div>
                    </div>
                </li>
                
                 <li class="">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv05.jpg" alt="img">
                    <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
                    </div>
                    </div>
                </li>
            <li class="">
                	<div class="v-gallimg">
                    <div class="v-gallimgwrap">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tv06.jpg" alt="img">
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
            	<h2>stemware</h2>
                <h4>The sensual lust of drinking</h4>
                <ul>
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/stem01.jpg" alt="img">
                    <div class="v-gallimg-capt">Medusa Lumière Haze</div>
                    </div>
                </li>
                
                <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/stem02.jpg" alt="img">
                    <div class="v-gallimg-capt">Gala Prestige</div>
                    </div>
                </li>
                
                 <li>
                	<div class="v-gallimg">
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/stem03.png" alt="img">
                    <div class="v-gallimg-capt">Medusa d'or</div>
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
        
        <p class="headrs " >Rosenthal meets Versace </p>

<p>Versace and Rosenthal are both recognized as brands synonymous with excellence and high quality. Rosenthal has an international reputation for uniting tradition and innovation, while Versace has its own world famous, glamorous and luxurious style. Together they have developed elegant, refined and exciting tableware and gift collections. Inspiration for these is derived from different historical periods and cultures. Thus, there are pieces that explore the exotic jungle imagery that is found on famous Versace prints, and collections incorporating the baroque iconography that the fashion house has made its own. Diving for hidden treasure, strolling through delightful gardens or viewing the most illustrious artefacts of the court of the Tsar. </p>
<p>

Versace and Rosenthal conjure up diverse imaginary scenarios through their decorated tableware, laden with myth, symbolism and antique references.
To create these most luxurious dream worlds, Versace has used the highest quality porcelain, crystal and cutlery from Rosenthal. Precious materials are skilfully crafted into special pieces. Versace is well known for its ability to bring together the historical and the ultra-modern, to arrive at timeless yet totally contemporary designs. Itswork with Rosenthal perfectly illustrates this unique aesthetic.</p>
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
