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
  
  <section class="rosenthal-brand sambonet-brand">
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
                        <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/639-320smb.jpg" alt="img">
                </li>
            </ul>
        </div>
     <!--------------[ Mobile Banner ]-------------> 
    
    
    <div class="brand-v1-slider rosenthal-slider visible-sm visible-md visible-lg "> 
    <img class="imgBlur-Rs visible-sm visible-md visible-lg" src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-banner.jpg" alt="img">
      <div id="Rosenthalslider" class="owl-carousel visible-sm visible-md visible-lg"> 
        <div class="item rosenthalBannerImg"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-banner.jpg" alt="img"> </div>
        </div>
    </div>

    
    
    <div class="rs-brandlogo  rs-brandlogo-sambonet clearfix">
      <div class="container">
        <div class="rs-logo-left sm-logo-left"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sm-logo.png" alt="img"> </div>
        <div class="rs-logotext-right">Sambonet flatware is the perfect match for Rosenthal's dinnerware. Sambonet today finds  representation in some of the best hotels & restaurants all over the world. Dedicated to upholding quality of it’s products and artisanal care for details, and maintaining a constant relationship between tradition and innovation - it is a smart mix between craftsmanship and technology that makes Sambonet a reality. </div>
      </div>
      <div class="clearfix"></div>
    </div>
    
    
    <div class="smb-twoImg-sect">
    	<div class="container">
        	<ul>
            	<li>
                    <h3 class="mobileheadinh3"><span>ESTELLE</span> customized Glasses</h3>	
                	<div class="smbt-img"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sm01.png" alt="img"></div>
                    <h3 class="deksheadinh3"><span>ESTELLE</span> customized Glasses</h3>	
                </li>
                
                <li>
                    <h3 class="mobileheadinh3"> <span>CONTOUR</span> customized Holloware</h3>	
                	<div class="smbt-img"><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sm02.png" alt="img"></div>
                      <h3 class="deksheadinh3"><span>CONTOUR</span> customized Holloware</h3>		
                </li>
            </ul>
        
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="smb-luxbanner">
    <div class="container">
    <div class="smb-luxbanner-inner">
    <h1>S</span>ambonet</h1>
    	<div class="owl-carousel" id="sambonet-luxslider">
        	<div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider01.png" alt="img"></div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider02.png" alt="img"></div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider03.png" alt="img"></div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider04.png" alt="img"></div>
            <div class="item"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider05.png" alt="img"></div>
        </div>
      </div>  
    </div>
    
    </div>
    
     <div class="clearfix"></div>
     
      <div class="smb-luxbanner2">
    	<div class="container">
        	<div class="smb-luxbanner2-img">
            <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider06.png" alt="img">
            </div>
            <h2>"<span>L</span>uxury is a necessity that begins when necessity ends"</h2>
    	</div>
    </div>
       <div class="clearfix"></div>
       
       <div class="tableware-smbonet clearfix">
       		<div class="container">
            	<ul>
                     <li>
                    <div class="tblewre-text">
                        <h2>TABLEWARE</h2> 
                        <p>Quality, style and experience for your table.</p>
                    </div>
                    </li>
                <li> <div class="smbt-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/tblware.png" alt="img"></div></li>
                   
                    <li class="ForDesktopHeading">
                    <div class="tblewre-text">
                        <h2>CUTLERY</h2> 
                        <p>Culinary delights for all your senses.</p>
                    </div> 
                    </li>
                        <li  class="ForMobileHeading">
                    <div class="tblewre-text">
                        <h2>CUTLERY</h2> 
                        <p>Culinary delights for all your senses.</p>
                    </div> 
                    </li>
                    
                    <li> <div class="smbt-img"> <img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/curty.png" alt="img"></div></li>
                  
                </ul>
            </div>
       </div>
       <div class="clearfix"></div>
       
      <div class="tableware-smbonet2 clearfix">
       		<div class="container">
             <div class="tbr-smb2-right">
                	<p>Italian excellence since 1856. Quality, style and experience for your table, kitchen and living. Trends and design, many ideas and proposals for all your needs. Be inspired by Sambonet!</p>
                </div>
            	<div class="tbr-smb2-left">
                	<div class="tbr-smb2-left-img">
                		<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider07.png" alt="img">
                    </div>
                </div>
               
            
            </div>
      </div>       
       
        <div class="smbnet-form-section clearfix">
       		<div class="container">
            
		
                
               <div class="tbr-smb2form-right">
                	<div class="tbr-smb2form-right-img">
                		<img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/smb-slider08.png" alt="img">
                    </div>
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
            	
             <h3><img src="<?php echo base_url().SitePath ; ?>assets/brand-static-pages/img/sm-logo.png" alt="img"></h3>   
                
<p>In 1856, Giuseppe Sambonet, a Fine Arts graduate and the son of a nobleman from Vercelli, obtained his warrant as Master Goldsmith and established the company, Giuseppe Sambonet, depositing his seal bearing the initials “GS” at the Turin mint. At the beginning of the twentieth century his company was the Official Purveyor to many noble families, including the Duchess of Genoa and the Count of Turin.</p>

<p>In 1932, Sambonet was the first company in Italy to build an industrial production plant capable of manufacturing both sterling silver and galvanic silverware. In 1938, it developed an innovative process for the production of stainless steel fl atware and developed a silver-plated steel manufacturing technique. In 1947, it started producing stainless steel knives and blades using its own technology.</p>

<p>In 1956, Sambonet conquered the international market by being chosen, from 53 competitors, to supply the Cairo Hilton Hotel with a hollowware line that is still in its collection today. This marked the beginning of the company’s great tradition of supplying world-class hotels and restaurants.</p>

<p>Starting from the Sixties, great designers created collections that consolidated and popularised the company’s focus on design. Roberto Sambonet, in particular, created collections of primary importance, such as the “Pesciera”, “Center line” and “Linea 50” trays that can be admired at the MoMA in New York. Anna Castelli Ferrieri also designed a line of fl atware for Sambonet. Her Hannah collection won the Compasso d’Oro award in 1994. Special mention, lastly, must be made of the Gio Ponti fl atware line which has been produced since 1932.</p>

<p>Sambonet in 1997 entered the Paderno group and in 2009 acquired Rosenthal, the prestigious brand of German porcelain. The acquisitions of the Bavarian Arzberg in 2013 and, in 2015, of Ercuis & Raynaud, icon of the elegance and tradition of "made in France" porcelain, have seen further growth of the range of products offered. Headquartered in Orfengo, between Novara and Vercelli, the group Sambonet Paderno Industrie S.p.A. is now a leader in the production of high quality design tabletop and kitchen, destined for both the retail and the Ho.Re.Ca. sector.</p>
            
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
