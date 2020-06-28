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
      <li> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-banner-320.jpg" alt="img"> </li>
    </ul>
  </div>
  <!--------------[ Mobile Banner ]------------->
  
  <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-banner-01.jpg" alt="img">
    <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg">
      <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-banner-01.jpg" alt="img"> </div>
    </div>
  </div>
  <div class="rs-brandlogo  rs-brandlogo-verscase clearfix">
    <div class="container">
      <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/EH-logo.png" alt="img"> </div>
      <div class="rs-logotext-right">Essential Home is an innovative mid-century modern furniture brand that takes important historical and cinematographic references from the 1930s and 1960s and turn them into unique furnishing pieces. What started out in 2015 as 'Essentials', a furniture collection by the mid-century lighting brand DelightFULL, quickly grew to be one of the most elegant representations of mid-century modern design, thus creating a new name and a new brand, Essential Home.
touch of luxury and modernity.</div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-Slider-luxbanner">
    <div class="container">
      <div class="Versace-Slider-inner">
        <div class="owl-carousel Versace_Slider">
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-slider-01.jpg" alt="img">
            <div class="Versace-img-cption">ESSENTIAL HOME - AMBIENCE </div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-slider-02.jpg" alt="img">
            <div class="Versace-img-cption">ESSENTIAL HOME - AMBIENCE</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-slider-03.jpg" alt="img">
            <div class="Versace-img-cption">ESSENTIAL HOME - AMBIENCE</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-slider-04.jpg" alt="img">
            <div class="Versace-img-cption">ESSENTIAL HOME - AMBIENCE</div>
          </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Essential-slider-05.jpg" alt="img">
            <div class="Versace-img-cption">ESSENTIAL HOME - AMBIENCE</div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <p>Inspired by the golden age of Hollywood, we bring a glamorous touch into each and every one of your products..</p>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-imageGallery-section clearfix">
    <div class="container">
      <div  class="Versace-imageGallery">
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess570_01.jpg" alt="img">
              <!--<div class="v-gallimg-capt">ESSENTIAL HOME </div>-->
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess570_02.jpg" alt="img">
              <!--<div class="v-gallimg-capt">ESSENTIAL HOME</div>-->
            </div>
          </li>
        </ul>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess470_01.jpg" alt="img">
              <!--<div class="v-gallimg-capt">ESSENTIAL HOME </div>-->
            </div>
          </li>
          <li >
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess470_02.jpg" alt="img">
              <!--<div class="v-gallimg-capt">ESSENTIAL HOME</div>-->
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="Tableware-imageGallery-section clearfix">
    <div class="container">
      <div  class="Tableware-imageGallery">
        <h2> WE ARE DESIGN EXCELLENCE</h2>
        <h4>We combine the worlds of craftsmanship and design technology to keep on innovating and produce nothing but the highest quality furniture for you. </h4>
        <ul>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/UPHOLSTERY.jpg" alt="img">
                <div class="v-gallimg-capt">Wall plate</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/LIGHTING.jpg" alt="img">
                <div class="v-gallimg-capt">Gala Prestige</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/RUGS.jpg" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <div class="clearfix"></div>
          <li class="blue-prestige-gala">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/CASEGOODS.jpg" alt="img">
                <div class="v-gallimg-capt">Blue Prestige Gala</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/BEDS.jpg" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ACCESSORIES.jpg" alt="img">
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
        <h2>WE ARE INTEGRITY</h2>
        <h4>With Essential Home what you see is what you get, as we guarantee to be honest and upfront about everything we do.</h4>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess480_01.jpg" alt="img">
             <!-- <div class="v-gallimg-capt">ESSENTIAL HOME</div>-->
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess480_02.jpg" alt="img">
              <!--<div class="v-gallimg-capt">ESSENTIAL HOME </div>-->
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/Ess400.jpg" alt="img">
             <!-- <div class="v-gallimg-capt">ESSENTIAL HOME</div>-->
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
      <p class="headrs">ESSENTIAL HOME</p>
      
      <p>The unique design of each of our pieces allows you to let your imagination run free and be creative with your projcts: masculine and feminine, classic and contemporary, that Essential Home is able to create the finest solutions for intimate and cozy ambiances that express elegance and luxury. Using nothing other than the highest quality materials, Essential Home delivers the mid-century modern signature that makes it so irresistible
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
