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
  
  <section class="rosenthal-brand  sambonet-brand rair-exterior ">
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
        <li>  <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-exterior-banner-mob.jpg" alt="img">  </li>
      </ul>
    </div>
    <!--------------[ Mobile Banner ]------------->
    
    <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-exterior-banner.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-exterior-banner.jpg" alt="img"> </div>
        </div>
    </div>
    <div class="rs-brandlogo  rs-brandlogo-sambonet clearfix">
      <div class="container">
        <div class="rs-logo-left sm-logo-left rairlog-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-logo.png" alt="img"> </div>
        <div class="rs-logotext-right">Rair is one of those few and occasional companies that prides itself for the creation of impeccable and satisfying luxury furniture. Our very fine attention to detail is the core obligation of the design and artisan team. we aspire to bring top-of-the-line applicable accessories in the industry and tastefully integrate these components into our designs and products. </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="smb-twoImg-sect rair-twoImg-sect">
      <div class="container">
        <ul>
          <li>
          	<!--<h3 class="mobileheadinh3">ESTELLE customized Glasses</h3>-->
            <div class="smbt-img"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair01.jpg" alt="img"></div>
           <!-- <h3 class="deksheadinh3">ESTELLE customized Glasses</h3>-->
          </li>
          <li>
          	<!--<h3 class="mobileheadinh3">CONTOUR customized Holloware</h3>-->
            <div class="smbt-img"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair02.jpg" alt="img"></div>
            <!--<h3 class="deksheadinh3">CONTOUR customized Holloware</h3>-->
          </li>
        </ul>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="smb-luxbanner">
      <div class="container">
        <div class=" rair-exteinner">
          <h1>THE BARON CHAISE LOUNGE</h1>
          <div class="rair-exte">
          	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/boram-chase.jpg" alt="img">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="smb-luxbanner2">
      <div class="container">
        <div class="rair-luxbanner2-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-exterior-banner2.jpg" alt="img"> </div>
        <p class="rairtextP">" We design things that exploit the raw and rudimentary outline of the object. A chair should look like a chair and
          nothing else. We don't create, invent or conceive. We discover new ways to present an already perfect profile."</p>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="tableware-smbonet tableware-rairexte clearfix">
      <div class="container">
        <ul>
          <li>
            <div class="tblewre-text">
              <h2>TASTEFUL DESIGN</h2>
              <p>As designers, we are predisposed to produce only products we can be sincerely be
                proud to boast and brag about.</p>
            </div>
          </li>
          <li>
            <div class="smbt-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rairtable01.jpg" alt="img"></div>
          </li>
          <li class="ForDesktopHeading">
            <div class="tblewre-text">
              <h2>DELIGHTFUL PERFORMANCE</h2>
              <p>We are committed to bringing you the finest pieces of outdoor furniture design for the most luxurious exterior design projects</p>
            </div>
          </li>
          <li class="ForMobileHeading">
            <div class="tblewre-text">
              <h2>DELIGHTFUL PERFORMANCE</h2>
              <p>We are committed to bringing you the finest pieces of outdoor furniture design for the most luxurious exterior design projects</p>
            </div>
          </li>
          <li>
            <div class="smbt-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rairtable02.jpg" alt="img"></div>
          </li>
        </ul>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="smbnet-form-section rairexterior-form clearfix">
      <div class="container">
        <div class="tbr-smb2form-right">
          <div class="tbr-smb2form-right-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rair-exterior-from-img.jpg" alt="img"> </div>
        </div>
        <div class="tbr-smb2form-left">
            <p>Interested in buying or knowing more ? <br>
             Share your contact details and our executive will get in touch with you</p>
         
         <form id="formContact" name="formContact">
            <div class="smb2form">
              <div class="form-group">
                  <input type="text" name="name_b" id="name_b" class="form-control" placeholder="Name *" value="<?php echo $customer_name; ?>" >
              </div>
              <div class="form-group">
                  <input type="email" name="email_b" id="email_b" class="form-control" placeholder="Email *" value="<?php echo $customer_email; ?>">
              </div>
              <div class="form-group">
                  <input type="text" name="mobile_b" id="mobile_b" maxlength="15" class="form-control" placeholder="Mobile Number *" value="<?php echo $customer_phone; ?>">
              </div>
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
            </div>
            <div class="btnRswrper">
              <div class="loader" id="loader" style="display:none;" ></div>
              <button class="btn btn-block requestBtnsend" type="submit">Send Request</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="container">
      <div class="Rs-about-sect sambonetaboutus clearfix">
        <h3>RAIR EXTERIOR - THE BARON CHAISE LOUNGE</h3>
        <p>The RAIR outdoor lounge daybed series was developed by the BLAKK design group from Singapore, presented and launched, primarily at NHOW Hotel Milan in 2017. The Baron chaise longue was designed to be the centerpiece and flagship attraction for almost every outdoor environment and space. Simple geometrical silhouette with breath-taking depth and a monolithic structure, the daybed design embodies both simplicity and magnitude.
 Developed meticulously from the finest cane material (Indonesia), Baron is a monolithic construct fitting for outdoors settings, patios or poolside locales.</p>
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
