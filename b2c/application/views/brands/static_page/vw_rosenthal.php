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
                    <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/res320.jpg" alt="img">
            </li>
        </ul>
    </div>
     <!--------------[ /Mobile Banner ]-------------> 
    
    <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg"> <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/re-banner.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/re-banner.jpg" alt="img"> </div>
      </div>
    </div>
    <div class="rs-brandlogo clearfix">
      <div class="container">
        <div class="rs-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rs-logo.png" alt="img"> </div>
        <div class="rs-logotext-right"> Rosenthal today stands for international lifestyle. With its fascinating brands it is seen as one of the world's leading producers of up-to-date, innovative design for the well-laid table, for furniture and for giftware available in 97 countries around the globe. </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="reCommon-header clearfix">
      <h1>EXQUISITE TABLEWARE</h1>
    </div>
    <div class="rosenthal-partialslider">
      <div class="loop-center owl-carousel " >
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rs01.jpg" alt="img">
          <div class="res-img-cption">Fire Food </div>
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rs02.jpg" alt="img">
          <div class="res-img-cption">Martha tc skn pl large</div>
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rs03.jpg" alt="img">
          <div class="res-img-cption">Green Food center</div>
        </div>
        <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/rs04.jpg" alt="img">
          <div class="res-img-cption">Rosenthal Junto elbmadame Auswahl</div>
        </div>
      </div>
    </div>
    <div class="reCommon-header clearfix">
      <h1>DINNERWARE FOR YOU</h1>
    </div>
    <div class="container">
      <div class="dinnerware-section clearfix">
        <!--------------[ Mobile ]------------->
      	<div class="ForMobileHeading">
      		<div class="dnr-imgbxheder">
                <div class="dnr-imgbxheder-grybox"></div>
                <h2>Dinnerware</h2>
              </div>
       </div>
        <!--------------[ /Mobile ]------------->
        <div class="dner-left">
          <ul>
            <li>
              <div class="dnr-firstbx">Shaped by a sophisticated tradition of design, an expression of a sovereign lifestyle.</div>
            </li>
            <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d01.png" alt="img"> </div>
            </li>
            <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d02.png" alt="img"> </div>
            </li>
            <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d03.png" alt="img"> </div>
            </li>
          </ul>
        </div>
        <div class="dner-right">
          <ul>
            <li>
              <div class="dnr-imgbxheder ForDesktopHeading">
                <div class="dnr-imgbxheder-grybox"></div>
                <h2>Dinnerware</h2>
              </div>
            </li>
            <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d04.png" alt="img"> </div>
            </li>
            <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d05.png" alt="img"> </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
     <div class="clearfix"></div>
    <div class="reCommon-header clearfix">
      <h1>FINEST PORCELAIN & <br>
        SENSUOUS STONEWARE</h1>
    </div>
    <div class="container">
      <div class="dinnerware-section-two clearfix">
        <div class="dner-left-s2">
          <ul>
            <li> 
            <div class="dnr-imgbxheder">
                <div class="dnr-imgbxheder-grybox"></div>
                <h2>Porcelain</h2>
             
              <div class="leftDescrp-res">
             Rosenthal’s new tableware collection boasts a handmade look, quite naturally uniting sensual ceramic in matt earthy tones and fine porcelain with asymmetrical forms.
              </div>
               </div> 
             </li>
             
              <li>
              <div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d06.png" alt="img"> </div>
            </li>
             
          </ul>
        </div>
        <div class="dner-right-s2">
          <ul>
            <li><div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d07.png" alt="img"> </div></li>
             <li><div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d08.png" alt="img"> </div></li>
              <li><div class="dnr-imgbx"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/d09.png" alt="img"> </div></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="reCommon-header  pdinbtm clearfix">
      <h1>EXPLORE THE PRODUCT RANGE</h1>
    </div>
  	<div class="container">
        <div class="Rs-explore-product clearfix">
         <div class="dnr-imgbxheder">
                <div class="dnr-imgbxheder-grybox"></div>
                <h2>The product range</h2>
              </div>
        </div> 
        <div class="clearfix"></div>
        
        <div class="Rs-explore-product-slider clearfix visible-sm visible-md visible-lg">
                 <div class="owl-carousel" id="Rs-explore-product-slider">
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/exlporimg-banner.png" alt="img"> 
                        </div>
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/exlporimg-banner01.jpg" alt="img"> 
                        </div>
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/exlporimg-banner02.jpg" alt="img"> 
                        </div>
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/exlporimg-banner03.jpg" alt="img"> 
                        </div>
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/exlporimg-banner04.jpg" alt="img"> 
                        </div>
                   </div> 
               </div>
           <!--------------[ Mobile Banner ]------------->       
               <div class="Rs-explore-product-slider clearfix visible-xs">
                 <div class="owl-carousel" id="Rs-explore-product-slider-mobile">
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob01.jpg" alt="img"> 
                        </div>
                        
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob02.jpg" alt="img"> 
                        </div>
                        
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob03.jpg" alt="img"> 
                        </div>
                        
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob04.jpg" alt="img"> 
                        </div>
                        
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob05.jpg" alt="img"> 
                        </div>
                        
                        <div class="item"> 
                        	<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/ex-mob06.jpg" alt="img"> 
                        </div>
                        
                </div> 
               </div>
         <!--------------[ Mobile Banner ]-------------> 
    </div>
         <div class="clearfix"></div>
         <div class="reCommon-header  pdinbtm clearfix">
            <h1>LUXURIOUS FURNITURE</h1>
         </div>
    <div class="container">
	    <div class="luxsurios-furniture-section clearfix">
        	<ul> 
                    <li> 
                        <div class="luxsurios-furniture-img"> 
                        <div class="lux-img-cpt">Up and Down</div>
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/lx01.png" alt="img">
                        </div> 
                    </li>  
                    <li> 

                        <div class="luxsurios-furniture-img"> 
                             <div class="lux-img-cpt">scoop</div>
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/lx02.png" alt="img">
                        </div> 
                    </li>
                     <li> 
                        <div class="luxsurios-furniture-img"> 
                        <div class="lux-img-cpt">interieur_fin-shell-riff-mellow</div>
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/lx03.png" alt="img">
                        </div> 
                    </li>
                    <li> 
                        <div class="luxsurios-furniture-img"> 
                        <div class="lux-img-cpt">nephele</div>
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/lx04.png" alt="img">
                        </div> 
                    </li>
                    <li> 
                        <div class="luxsurios-furniture-img"> 
                        <div class="lux-img-cpt">modular</div>
                            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/lx05.png" alt="img">
                        </div> 
                    </li>
                </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    
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
            </form>
            </div>
        </div>
       <div class="clearfix"></div> 
       	<div class="container"> 
            <div class="Rs-about-sect clearfix">
               <p class="headrs">About Rosenthal</p>
                <p>
                    Rosenthal is one of the most traditional and at the same time most modern brands in Germany. Today, as it was founded more than 135 years ago, Rosenthal develops products that impress with their form, function, quality and craftsmanship, which are a piece of cultural heritage made in Germany and convince through constant innovation and creativity.
                    Established greats of architecture, design and art as well as the hippest newcomers and talents design avant-garde collections for the laid table, the joy of giving and the upscale decor.
                    The collections are made in the Rosenthal plants on Rothbühl in Selb and Thomas am Kulm in Speicherersdorf, which are among the world's most modern production facilities in the porcelain industry and, thanks to promising investments, produce sustainably and resource-conserving.
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
