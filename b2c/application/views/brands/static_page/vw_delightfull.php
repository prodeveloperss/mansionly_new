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
      <li> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image320.jpg" alt="img"> </li>
    </ul>
  </div>
  <!--------------[ Mobile Banner ]------------->
  
  <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image.jpg" alt="img">
    <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg">
      <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image.jpg" alt="img"> </div>
    </div>
  </div>
  <div class="rs-brandlogo  rs-brandlogo-verscase clearfix">
    <div class="container">
      <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del-logo.jpg" alt="img"> </div>
      <div class="rs-logotext-right">Passion for classics, sculptured forms,
reduced shapes, clear lines and strong colors: this
is the way DelightFULL Studio leaves its mark in the
design world. DelightFULL’s lighting designs have the
most incredible mid-century free spirit, filled with a
touch of luxury and modernity.</div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-Slider-luxbanner">
    <div class="container">
      <div class="Versace-Slider-inner">
        <div class="owl-carousel Versace_Slider">
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image-1.jpg" alt="img">
            <div class="Versace-img-cption">JACKSON  SUSPENSION LAMP</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image-2.jpg" alt="img">
            <div class="Versace-img-cption">TABLE LAMP</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image-3.jpg" alt="img">
            <div class="Versace-img-cption">KRAVITZ  PENDANT LAMP</div>
          </div>
          <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/delight_Slider-image-4.jpg" alt="img">
            <div class="Versace-img-cption">SUSPENSION LAMP</div>
          </div>
          <!--<div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/maison_Slider-image-5.jpg" alt="img">
            <div class="Versace-img-cption">Newton bathtub</div>
          </div>-->
        </div>
      </div>
      <div class="clearfix"></div>
      <p>Delightfull’s Lighting Embodies A Sincere
Passion For Innovation And A True Dedication
To The Revival Of Local Artisan Craftsmanship
Through Long Lasting Masterpieces.</p>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="Versace-imageGallery-section clearfix">
    <div class="container">
      <div  class="Versace-imageGallery">
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del570-1.jpg" alt="img">
              <div class="v-gallimg-capt">ATOMIC ROUND SUSPENSION LAMP </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del570-2.jpg" alt="img">
              <div class="v-gallimg-capt">BASIE SUSPENSION LAMP</div>
            </div>
          </li>
        </ul>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del470-1.jpg" alt="img">
              <div class="v-gallimg-capt">BOTTI SUSPENSION LAMP </div>
            </div>
          </li>
          <li >
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del470-2.jpg" alt="img">
              <div class="v-gallimg-capt">BOTTI PENDANT LAMP</div>
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
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del01.png" alt="img">
                <div class="v-gallimg-capt">Wall plate</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del02.png" alt="img">
                <div class="v-gallimg-capt">Gala Prestige</div>
              </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del03.png" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <div class="clearfix"></div>
          <li class="blue-prestige-gala">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del04.png" alt="img">
                <div class="v-gallimg-capt">Blue Prestige Gala</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del05.png" alt="img">
                <div class="v-gallimg-capt">Red wine - Arabesque Amber</div>
              </div>
            </div>
          </li>
          <li class="">
            <div class="v-gallimg">
              <div class="v-gallimgwrap"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del06.png" alt="img">
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
        <h4>Heritage and Graphic Collection
are the two collections that will conquer you.</h4>
        <ul>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del480-1.jpg" alt="img">
              <div class="v-gallimg-capt">HENDRIX WALL LAMP</div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/del480-2.jpg" alt="img">
              <div class="v-gallimg-capt">MILES WALL LAMP </div>
            </div>
          </li>
          <li>
            <div class="v-gallimg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ETTA-ROUND.png" alt="img">
              <div class="v-gallimg-capt">ETTA-ROUND</div>
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
      <p class="headrs">DelightFULL</p>
      
      <p>WHY SHOULD YOU LOVE DELIGHTFULL?
In short, we are what we do. Vintage music &
mid-century modern design lovers with a peculiar
affection to 50’s recreations with our modern
senses. It’s all about restoring the post-war era
with our eyes and hands set in the future.
We can gaze at the Etta Wall Sconce, or the
Amy Floor Lamp, or the Billy Table Lamp, and
instinctively respond, with a smile, "Yeah, I get
that.” This is how 50’s would look like in the
future! – That’s Delightfull.
Art deco iconography inspired the line of
contemporary lighting tailored for the floor, table,
ceiling and wall.
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
