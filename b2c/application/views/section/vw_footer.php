﻿<?php 

$table = "social";
$condition = array('status' => '1');
$social_media_list = $this->Md_database->getData($table,'social_id,social_name,statusck,social_value,status',$condition, 'social_id');


$header_product_cat_list = $this->Md_header->getHeaderProductCatList();
/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
?>

<a class="MobileconntectUs" href="<?php echo base_url().'lead-generation-form';?>"> <i class="icon-envelope"></i> </a>

 <?php
 
    $city_list = $this->Md_header->getCityDetails();
    
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
 <input type="hidden" name="leadGenFromSliderPageType" id="leadGenFromSliderPageType"  value="<?php echo $leadGenFromSliderPageType; ?>" />
 <input type="hidden" name="leadGenFromSliderPageUniqueId" id="leadGenFromSliderPageUniqueId"  value="<?php echo $leadGenFromSliderPageUniqueId; ?>" />
 <input type="hidden" name="leadGenFromSliderPageURL" id="leadGenFromSliderPageURL"  value="<?php echo $leadGenFromSliderPageURL; ?>" />

 
 
 
 
 
<!--------------[ footer Section ]-------------> 

<!--<footer id="footer">
	<div class="container">
    	<div class="row">
        	<div class="col-md-6 col-sm-6 col-xs-12">
            	<ul class="footermenu">
                  <li > <a href="<?php echo base_url(); ?>privacy"> <i class="fa fa-lock"></i> <span>Privacy</span> </a> </li>
                  <li > <a href="<?php echo base_url(); ?>terms"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Terms &amp; Conditions</span> </a>  </li>
                  <li > <a href="<?php echo base_url(); ?>contact-us"> <i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Contact Us</span> </a> </li>
               </ul>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="socials clearfix" >
                <ul class="footermenu clearfix">
                    <?php  foreach ($social_media_list as $row) { 
                        
                        if($row['social_name']== "youtube"){$row['social_name']= "youtube-play";}
                        if($row['social_name']== "googleplus"){$row['social_name']= "google-plus";}
                        ?>
                      <li> <a href="<?php echo $row['social_value'];?>" target="_blank"> <i class="fa fa-<?php echo $row['social_name'];?>"></i> </a> </li>
                    <?php   } ?>
                    </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="copyright  clearfix">All contents &copy; copyright 2017 Mansionly.</div>
            <div class="stmap"> <a href="<?php echo base_url();?>sitemap.xml"> Sitemap  </a> </div>
        </div>
    </div>
</footer>-->

<!--------------[ footer Section ]------------->

<footer class="NewHomepageFooter"> 
  <div class="container-fluid"> 
    <div class="row"> 
      <div class="col-md-12 col-sm-12 col-xs-12"> 
        <ul class="footermenu"> 
        	<li class="active"> <a href="<?php echo base_url(); ?>about-us"> ABOUT US </a> </li>
            <li> <a href="<?php echo base_url(); ?>all-designers?q=d"> DESIGNER </a> </li>
            <li> <a href="<?php echo base_url(); ?>execution-gallery/all?q=e"> PROJECTS </a> </li>
            <li> <a href="<?php echo base_url(); ?>all-categories?q=l"> FURNITURE & DECOR </a> </li>
            <li> <a href="https://mansionly.com/magazine/"> INSIGHTS </a> </li>
            <!--<li> <a href="#"> MOBILE APPS </a> </li>-->
            <li> <a href="<?php echo base_url(); ?>contact-us"> CONTACT US </a> </li>
          	<li class="pull-right">  </li>
        </ul>
        <div class="Ft-first-social ftSC clearfix" >
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
        <a  href="javascript:void(0)" class="Ft-Panel"> <span class="icon-up-arrow"></span> </a>
      </div> 
      
    </div> 
  </div> 
  
  <!-- --------------------[Connenct-slider]---------------------------> 
  
 
  
  <!-- --------------------[Connenct-slider]---------------------------> 
  
</footer>


<div class="footerEnd clearfix " id="collapseExample">
<a  href="javascript:void(0)" class="Ft-Panel-close"> <span class="icon-cross"></span> </a>
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<div class="Ft-first">
                	<div class="ft-logo"><a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url().SitePath ; ?>assets/img/ft-logo.png" alt="hw01"></a></div>
                    <a href="<?php echo base_url(); ?>how-it-works">HOW WE WORK </a>
                    <a href="<?php echo base_url(); ?>terms">TERMS & CONDITIONS</a>
                    <a href="<?php echo base_url(); ?>privacy">PRIVACY POLICY</a>
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
        <div class="copyright-ft">All contents © copyright 2019 Mansionly.</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="Ft-second">
            <ul class=" clearfix">
            <li>About Mansionly</li>
            <li> <a href="<?php echo base_url(); ?>about-us"> ABOUT US </a> </li>
            <li> <a href="<?php echo base_url(); ?>all-designers?q=d"> DESIGNER </a> </li>
            <li> <a href="<?php echo base_url(); ?>execution-gallery/all?q=e"> PROJECTS </a> </li>
            <li> <a href="<?php echo base_url(); ?>all-categories?q=l"> FURNITURE & DECOR </a> </li>
            <li> <a href="https://mansionly.com/magazine/"> INSIGHTS </a> </li>
            <li> <a href="<?php echo base_url(); ?>contact-us"> CONTACT US </a> </li>
          </ul>
            
            </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="Ft-second">
            <ul class=" clearfix">
            <li>Product Category</li>
            <?php  foreach ($header_product_cat_list as $row) { ?>
            <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['cat_name'])))) ;?>?catID=<?php echo $row['cat_id'];?>&pageType=PLP&q=l"><?php echo strtoupper($row['cat_name']) ;?> </a></li>
                        <?php } ?>
<!--            <li> <a href="javascript:void(0)"> FURNITURE </a> </li>
            <li> <a href="javascript:void(0)"> LIGHTING </a> </li>-->
            <li> <a href="<?php echo base_url(); ?>bespoke?q=l"> BESPOKE </a> </li>
<!--            <li> <a href="javascript:void(0)"> FURNISHING </a> </li>
            <li> <a href="javascript:void(0)"> LUXE DECOR </a> </li>-->
            <li> <a href="<?php echo base_url(),'collectibles/fl/2?q=l'; ?>"> COLLECTIBALS </a> </li>
          </ul>
            
            </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">  
            <div class="Ft-third Ft-second">
            <ul>
                 <li>Mobile Apps</li>
                 <li><p>As an interior design company, we at Mansionly, have been very focused 
on creating spaces that don’t just appeal to the eyes...</p></li>
            <li> <a href="https://play.google.com/store/apps/details?id=com.mansionly.customerapp&hl=en"> <img src="<?php echo base_url().SitePath ; ?>assets/img/google-store-icon.png" alt="app"> </a> </li>
            <li> <a href="https://itunes.apple.com/us/app/mansionly/id1389752415?ls=1&mt=8"> <img src="<?php echo base_url().SitePath ; ?>assets/img/app-store-icon.png" alt="app"> </a> </li>
            </ul>
            </div>
            </div>
        </div>
    </div>



</div>
  
  <div class="footerFromNew">
  
    <form id="lead_generation_form" name="lead_generation_form">

      <!-- --------------------[Connenct-slider]--------------------------->
  
<a class="conntectUs" href="#">Connect With Us</a>
<div class="SlideForm">
<div id="sending_message" style="display:none;" class="sld-overly">
	<div class="sld-success">
    	<img src="<?php echo base_url().SitePath; ?>assets/img/bx_loader.gif"> Sending  message
     </div>		
</div>
<div id="response_message" style="display:none;" class="sld-overly">
	<div id="text_message" class="sld-success">
    	
        </div>		
</div>
<a class="conntectUs-Close" href="#">X</a>
<h4>Connect With Us</h4>
<p>Share your details and our executive will get in touch with you.</p>
    	<div class="form-group">
               <input type="text"  name="name" id="name" class="form-control" placeholder="Name*" value="<?php echo $customer_name; ?>" >
        </div>
        <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address*" value="<?php echo $customer_email; ?>">
        </div>
        <div class="form-group">
                <input type="text" name="mobile" id="mobile" maxlength="15" class="form-control" placeholder="Phone Number*" value="<?php echo $customer_phone; ?>">
        </div>
        
        <div class="form-group">
        	<div class="selct-stle">
                    <select name="city" id="city" class="form-control">
                        <option value="">Select City</option>
                        <?php foreach ($city_list as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['city']; ?></option>
                        <?php } ?> 
                        <option value="other">Other</option>
                    </select>
            </div>
        </div>
            
        <div style="display:none;" class="form-group">
                <input type="text" name="other_city" id="other_city"  class="form-control" placeholder="City" >
        </div>
        
        <div class="form-group">
        	<label>What are you looking for?</label>
        	<textarea name="comment" id="comment" class="form-control" ></textarea>
        </div>
        
        <div class="formgroup">
   <button type="submit" class="ConnectBtnsend2 btn-block" > Send Request </button>
  </div>
</div>
  
<!-- --------------------[Connenct-slider]--------------------------->  
  
</form>

</div>
<!--------------[ footer Section ]-------------> 

 <input type="hidden" name="event_category" id="event_category"  value="Pipeline Generation" />


<?php
/*[start::user_landing_page_url_session ]*/
if(!(isset($_SESSION["user_landing_page_url"]))){
    $user_landing_page_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $_SESSION["user_landing_page_url"] = $user_landing_page_url;
    //echo $user_landing_page_url;die;
}
/*[End::user_landing_page_url_session ]*/

?>
 <input type="hidden" name="user_landing_page" id="user_landing_page" value="<?php echo $_SESSION["user_landing_page_url"]; ?>">


<!--------------[ Utm parameter ]-------------> 
<?php     
if(isset($_GET["utm_source"]))
	{
        unset($_SESSION["utm"]);
		unset($_SESSION["utm_scheme"]);
    }
	
	$utm = "";
    $utm_scheme = "";
	
    if((!(isset($_SESSION["utm"]))))
	{
		if (!empty($_GET['utm_source'])) {
			$utm .= "utm_source=" . $_GET['utm_source'] . '|';
			$utm_scheme .= "utm_source=" . $_GET['utm_source'] . '|';
		} 
		if (!empty($_GET['utm_medium'])) {
			$utm .= "utm_medium=" . $_GET['utm_medium'] . '|';
			$utm_scheme .= "utm_medium=" . $_GET['utm_medium'] . '|';
		} 
		if (!empty($_GET['utm_campaign'])) {
			$utm .= "utm_campaign=" . $_GET['utm_campaign'] . '|';
			$utm_scheme .= "utm_campaign=" . $_GET['utm_campaign'] . '|';
		} 
		if (!empty($_GET['utm_term'])) {
			$utm .= "utm_term=" . $_GET['utm_term'] . '|';
		} 
		if (!empty($_GET['utm_content'])) {
			$utm .= "utm_content=" . $_GET['utm_content'];
		} 
		
		$_SESSION["utm"] = $utm;
		$_SESSION["utm_scheme"] = $utm_scheme;
	}
    ?>
 <input type="hidden" name="utm" id="utm" value="<?php echo $_SESSION["utm"]; ?>">
 <input type="hidden" name="scheme" id="scheme" value="<?php echo isset($_SESSION["utm_scheme"])? $_SESSION["utm_scheme"]:''; ?>">
 
<!--------------[ /Utm parameter ]-------------> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script defer src="<?php echo base_url().SitePath; ?>assets/js/bootstrap.min.js?v=1.0"></script> 
<script defer src="<?php echo base_url().SitePath; ?>assets/js/owl.carousel.min.js?v=1.0"></script> 
<script defer src="<?php echo base_url().SitePath; ?>assets/js/jquery.bxslider.js?v=1.0"></script> 
<script src="<?php echo base_url().SitePath; ?>assets/js/custom.js?v=4.2" defer="defer" ></script>
<script defer src="<?php echo base_url().SitePath; ?>assets/js/jquery.gallery.js?v=1.0" defer="defer" ></script>
<!--[start:: Toastr msg]-->
<link href="<?php echo base_url().SitePath; ?>assets/js/toastr/toastr.min.css?v=1.0" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url().SitePath; ?>assets/js/toastr/toastr.min.js?v=1.0" type="text/javascript"  ></script>
<!--[start::Facebook Pixel Code]-->
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1499448236744785&ev=PageView&noscript=1"
/></noscript>
<!--[end::Facebook Pixel Code]-->
<style>
    .toast-top-right {
    right: 12px;
    top: 51px;
}
</style>
<!--[End:: Toastr msg]-->

<!--[start:: Loader image]-->
<script>

</script>
<script>

</script>

<!--[End:: Loader image]-->

<!-- Start::Google analytic script -->
<script defer type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/js-analytics.js?v=1.0" ></script>
<!-- Start::form validation script -->
<script defer src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>

<script>
$(document).ready(function(){

$('form[name^="get_started"]').submit(function(e){
    
    e.preventDefault();
//    console.log(indexID);
    var validateFlag = false;
    var str;var inputarea;
    
    
//    str = $('#userinformation'+indexID).val();
//     validateFlag=$('#get_started'+indexID).valid();
 /*   if(e.target.id=='get_started'+indexID){
        str = $('#userinformation'+indexID).val();
        inputarea = $('#userinformation'+indexID);
        validateFlag=$('#get_started'+indexID).valid();
        if(validateFlag){
        $('#main_form').show();
        }
    }*/
    
   str =  $('#'+e.target.id+' input[name^="userinformation"]').val();
   validateFlag = $('#'+e.target.id).valid();
    
    
    var contentinfotext='';
    var user_mail = '';
    var user_phone = '';
    var orderType = 7;
    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
    var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
    var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
    var user_landing_page = $('#user_landing_page').val();
    var utm = $('#utm').val();
    var scheme = $('#scheme').val();
    var split_url = leadGenFromSliderPageURL.split('/');
    var flag_for_production = 'www.mansionly.com';
    var chk_flag_for_production = split_url[2];
 
    var event_category = $('#event_category').val();
                
                var data = $.param({
		   
			contactinfo: str,
			contentinfo: contentinfotext,
                        remote_address: <?php echo "'".$_SERVER['REMOTE_ADDR']."'"?>,
			//formtitle: 'Mansionly - Contact',
                        leadGenFromSliderPageType: leadGenFromSliderPageType,
                        leadGenFromSliderPageUniqueId:leadGenFromSliderPageUniqueId,
                        leadGenFromSliderPageURL:leadGenFromSliderPageURL,
                        user_landing_page:user_landing_page,
                        utm:utm,
                        scheme:scheme
		});
             if(validateFlag){
                 
                 $.ajax({
                        type:"post",
                        url:baseUrl+"Cn_customer/getstartedRequest",
                        data:data,
                        success:function(response){
                           var result = response.split('|*|*|');
                           toastr.success('Your order saved successfully.');
                           $('#'+e.target.id+' input[name^="userinformation"]').val('');
                           //$('#main_form').hide();
                           
                           if(chk_flag_for_production == flag_for_production){
                          // alert(event_category+result[0]+$('#leadGenFromSliderPageURL').val()+result[1]);
                           /*Goole analytics script*/
                            ga('send', 'event', 
                                { eventCategory: event_category,
                                  eventAction: result[0],
                                  eventLabel: 'Home Page | url='+leadGenFromSliderPageURL, 
                                  eventValue: result[1]
                                });
                           }
                        },
                        error:function(response){
                            console.log(response);
                            toastr.error('Something goes wrong.');
                            //$('#main_form').hide();
                        }
                    });
                    
                }
        // alert(contentinfotext);  
        
        
		
                
                
});

});




$(document).ready(function () {

                $("#city").change(function (e) {
                //alert();
                if($("#city").val() == 'other'){
                   $("#other_city").parent().show(); 
                }else{
                   $("#other_city").parent().hide();
                   $("#other_city").val('');
                }
                });

                $("#mobile").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        return false;
                    }
                });

                jQuery.validator.addMethod("lettersonly", function (value, element) {
                    return this.optional(element) || /^[a-z\s]+$/i.test(value);
                }, " ");
                $("#lead_generation_form").validate({
                    rules: {
                        name: {
                            required: true,
                            lettersonly: true
                        },
                        mobile: {
                            required: true,
                            maxlength: 15,
                            minlength: 10

                        },
                        email: {
                            required: true,
                            email: true
                        },
                        other_city: {
                            required: true                           
                        }
                        
                    },
                    messages: {
                        name: {
                            required: '',
                            lettersonly: ''
                        },
                        mobile: {
                            required: '',
                            maxlength: '',
                            minlength: ''
                        },
                        email: {
                            required: '',
                            email: ''
                        },
                        other_city: {
                            required: ''                           
                        }
                    }
                });
                
            });
            
            
            
            $(document).ready(function () {

                $('#lead_generation_form').submit(function (e) {

                  
                if($('#lead_generation_form').valid()){  


                  e.preventDefault();

                   
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var mobile = $('#mobile').val();
                    var other_city = $('#other_city').val();
                   // alert(other_city);
                    var comment = '';
                    if(other_city !=""){
                        comment = 'Selected City : '+other_city+'#'+$('#comment').val();
                        var city = '';
                    }else{
                        comment = $('#comment').val();
                        var city = $('#city').val();
                    }
                    
//                    alert(city);
//                    alert(comment);
                    var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
                    var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
                    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
                    var user_landing_page = $('#user_landing_page').val();
                    var scheme = $('#scheme').val();
                    var utm = $('#utm').val();
                    if(leadGenFromSliderPageUniqueId !=''){
                    var eventLabel = leadGenFromSliderPageType +' | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
                    }else{
                    var eventLabel = leadGenFromSliderPageType +' | URL='+leadGenFromSliderPageURL;
                    }
                    var event_category = $('#event_category').val();
                    var split_url = leadGenFromSliderPageURL.split('/');
                    var flag_for_production = 'www.mansionly.com';
                    var chk_flag_for_production = split_url[2];
                    
                    if ($('#lead_generation_form').valid()) {
                        if (name != '' && mobile != '' && email != '') {
                            $("#sending_message").show();
                            
                            $.ajax({
                                method: "POST",
                                url: baseUrl+'ajax-lead-generation-form-submit-action',
                                data: {'name': name,'email': email, 'mobile': mobile, 'city': city, 'comment': comment,'leadGenFromSliderPageType': leadGenFromSliderPageType,'leadGenFromSliderPageUniqueId':leadGenFromSliderPageUniqueId,'leadGenFromSliderPageURL':leadGenFromSliderPageURL,'user_landing_page':user_landing_page,'scheme':scheme,'utm':utm},
                                success: function (response) {
                                    $('#lead_generation_form').trigger("reset");
                                    $("#sending_message").hide();
                                    $("#response_message").show();
                                    $("#text_message").text('Thanks ! We will get in touch with you soon.');
                                    setTimeout('$(".sld-overly").hide()',3000);
                                    
                                    if(chk_flag_for_production == flag_for_production){
                                      /*Goole analytics script*/
                                    var result = response.split('|*|*|');
                                  // alert(event_category+result[0]+eventLabel+result[1]);
                                    ga('send', 'event', 
                                        { eventCategory: event_category,
                                          eventAction: result[0],
                                          eventLabel: eventLabel, 
                                          eventValue: result[1]
                                        });
                                   // toastr.success('Your request received successfully!');
                                   }
                                },
                                error: function (response) {
                                  $("#sending_message").hide();
                                  //toastr.error('Something goes wrong.'); 
                                  $("#response_message").show();
                                  $("#text_message").text('Something goes wrong.');
                                  setTimeout('$(".sld-overly").hide()',3000);

                                }
                            });



                       }
                  }

                }

                });
                
               
            });
          











</script>

<script>
$(document).ready(function() {
        $("#get_started1").validate({
                    rules: {
                           
                               
                                 userinformation1: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				}
			},
			messages: {                           
                              
                                userinformation1: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				}
			}
		});
                
                $("#get_started2").validate({
                    rules: {
                           
                               
                                 userinformation2: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				}
			},
			messages: {                           
                              
                                userinformation2: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				}
			}
		});
 
            
    });
</script>
<!-- End::form validation script -->
<script>
$(function() {
	$('#dg-container').gallery();
}); 
//start:: Toastr msg Customize option
toastr.options.closeButton = true;

//$(document).click(function(evt) {
//if(evt.target.id == "mc_embed_signup"){}else{
//    $("body").removeClass('ContctPanel');
//    }
//});
</script>

<script>
$(document).ready(function(e) {
    
    $(".conntectUs").click(function(e) {
       $("body").toggleClass("SlideOpen");
	   $("this").toggleClass("Slideclose")
    });
	
	
    $(".conntectUs-Close ").click(function(e) {
       $("body").removeClass("SlideOpen");
	  
    });
	$(".Ft-Panel").click(function(e) {
       $("body").toggleClass("Ft-Panel-Open");
	   
    });
	
	$(".Ft-Panel-close").click(function(e) {
       $("body").removeClass("Ft-Panel-Open");
    });
	

	
});
</script>
<?php

/*[start::Display toaster message ]*/
if(isset($_SESSION["toaster_msg"])){
    echo $_SESSION["toaster_msg"];
    $_SESSION["toaster_msg"]="";
}
/*[End::Display toaster message  ]*/


?>
<div id="toTop" class="btn"> <span class="scr-txt">Scroll to top</span><span class="icon-up-arrow"></span></div>

<!--Start of Zendesk Chat Script

<script type="text/javascript">
$(document).ready(function(){
    window.$zopim||(function(d,s){var z=$zopim=function(c){

z._.push(c)},$=z.s=

d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.

_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');

$.src='https://v2.zopim.com/?5aZlkg6Hhl3JxutgPA78tqRHmdUQD2eU';z.t=+new Date;$.

type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');

});

</script>-->

<!--End of Zendesk Chat Script-->
</body>
<!--<html lang="en" ng-app="MansionlyApp">-->
</html>