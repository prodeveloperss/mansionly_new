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
      <li> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Banners-StaticBrand-sofa320.jpg" alt="img"> </li>
    </ul>
  </div>
  <!--------------[ Mobile Banner ]------------->
  
  <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Banners-StaticBrand-sofa.jpg" alt="img">
    <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg">
      <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Banners-StaticBrand-sofa.jpg" alt="img"> </div>
    </div>
  </div>
  <div class="rs-brandlogo  rs-brandlogo-verscase clearfix">
    <div class="container">
      <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/logo-sofa.jpg" alt="img"> </div>
      <div class="rs-logotext-right">At Sofas & Stuﬀ, we pride ourselves on our 70 years in the furniture industry.
All of our handcrafted sofas, beds and chairs are made to order right here in Britain and crafted with traditional techniques.
 
We have a comprehensive selection of classic and contemporary sofas, beds and chairs to choose from. Many of these can be made to order to your precise specification.
We work closely with you and your client to design a tailored piece of furniture that’s perfect for your project.
 
From start to ﬁnish our furniture is built and ﬁnished to the highest standard. We ﬁrmly stand by our craftsmanship and oﬀer a lifetime construction guarantee on all of our British made pieces.</div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-Slider-luxbanner">
    <div class="container">
      <div class="Versace-Slider-inner">
        <div class="owl-carousel Versace_Slider">
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/slider-banner-01.jpg" alt="img">
            <div class="Versace-img-cption">Handmade Chairs</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/slider-banner-02.jpg" alt="img">
            <div class="Versace-img-cption">Handmade Corners</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/slider-banner-03.jpg" alt="img">
            <div class="Versace-img-cption">Design your bespoke sofa or beds</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/slider-banner-04.jpg" alt="img">
            <div class="Versace-img-cption">The 'in-store' experience</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/slider-banner-05.jpg" alt="img">
            <div class="Versace-img-cption">Handmade Beds & Mattresses</div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <p>Unleash your inner designer with our easy-to-use software. Choose different fabric combinations, from patterns to plains, and pair with the upholstered bed, sofa or chair that’s just right for you.</p>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-imageGallery-section clearfix">
    <div class="container">
      <div  class="Versace-imageGallery">
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_570_01.jpg" alt="img">
              <div class="v-gallimg-capt">Blackdown Chair </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_570_02.jpg" alt="img">
              <div class="v-gallimg-capt">Boxgrove Chair</div>
            </div>
          </li>
        </ul>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_470_01.jpg" alt="img">
              <div class="v-gallimg-capt">Bigsoftie corner-unit footstool </div>
            </div>
          </li>
          <li >
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_470_02.jpg" alt="img">
              <div class="v-gallimg-capt">Wadenhoe corner-unit footstool</div>
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
        <h4>Luxurious and exclusive </h4>
        <ul>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_01.png" alt="img">
                <div class="v-gallimg-capt">Wall plate</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_02.png" alt="img">
                <div class="v-gallimg-capt">Gala Prestige</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_03.png" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <div class="clearfix"></div>
          <li class="blue-prestige-gala">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_04.png" alt="img">
                <div class="v-gallimg-capt">Blue Prestige Gala</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_05.png" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_06.png" alt="img">
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
        <h2>COLLECTIONS</h2>
        <h4>Our handmade British furniture can be upholstered in any sofa fabric in the world.</h4>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_480_01.jpg" alt="img">
              <div class="v-gallimg-capt">Port Isaac Arm Chair Tango Velvet Lunar</div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa_480_02.jpg" alt="img">
              <div class="v-gallimg-capt">Kentwell 3 hump in Varese Grass</div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sofa-400.png" alt="img">
              <div class="v-gallimg-capt">Sofas and Stuff Haresfield snuggler Portland Brass</div>
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
            <p>Interested in buying or knowing more ?<br>
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
      <p class="headrs">Sofas & Stuff </p>
      
      <p>Sofas and Stuff have been designing and building high quality sofas and beds for over 10 years. It is perhaps no surprise that we have an abundance of happy customers willing to tell their stories and experiences. We make luxury sofas made to order, which can be upholstered in any sofa fabric in the world. So if you are looking for a sofas and stuff review, have a browse below at some of our Trustpilot reviews and rest assured you are buying a top quality british made sofa or bed.

Want to have a look at some of our latest customer sofas we have helped design? The why not check out our customer photo gallery and see for yourself the luxury sofa you could be enjoying in your own home.
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
