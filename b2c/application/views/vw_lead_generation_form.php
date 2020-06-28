<?php
$this->load->view('section/vw_header_1');
?>
<script src="<?php echo base_url().SitePath ; ?>assets/js/modernizr.custom.53451.js" type="text/javascript"></script>
<?php
$this->load->view('section/vw_header_2');
?>

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
 <input type="hidden" name="leadGenFromSliderPageType_mbl" id="leadGenFromSliderPageType_mbl"  value="<?php echo $leadGenFromSliderPageType; ?>" />
 <input type="hidden" name="leadGenFromSliderPageUniqueId_mbl" id="leadGenFromSliderPageUniqueId_mbl"  value="<?php echo $leadGenFromSliderPageUniqueId; ?>" />
 <input type="hidden" name="leadGenFromSliderPageURL_mbl" id="leadGenFromSliderPageURL_mbl"  value="<?php echo $leadGenFromSliderPageURL; ?>" />

<!-- --------------------[Connenct-slider]--------------------------->
<div class="MobileSlideForm">
<form id="lead_generation_form_mbl" name="lead_generation_form_mbl">
<div class="SlideForm-mob">
<div id="sending_message_mbl" style="display:none;" class="sld-overly">
	<div class="sld-success">
    	<img src="<?php echo base_url().SitePath; ?>assets/img/bx_loader.gif"> Sending  message
     </div>		
</div>
<div id="response_message_mbl" style="display:none;" class="sld-overly">
	<div id="text_message_mbl" class="sld-success">
    	
        </div>		
</div>
<!--<a class="conntectUs-Close" href="#">X</a>-->
<h1>Connect With Us</h1>
<p>Share your details and our executive will get in touch with you.</p>
    	<div class="form-group">
               <input type="text"  name="name_mbl" id="name_mbl" class="form-control" placeholder="Name*" value="<?php echo $customer_name; ?>" >
        </div>
        <div class="form-group">
                <input type="email" name="email_mbl" id="email_mbl" class="form-control" placeholder="Email Address*" value="<?php echo $customer_email; ?>">
        </div>
        <div class="form-group">
                <input type="text" name="mobile_mbl" id="mobile_mbl" maxlength="15" class="form-control" placeholder="Phone Number*" value="<?php echo $customer_phone; ?>">
        </div>
        
        <div class="form-group">
        	<div class="selct-stle">
                    <select name="city_mbl" id="city_mbl" class="form-control">
                        <option value="">Select City</option>
                        <?php foreach ($city_list as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['city']; ?></option>
                        <?php } ?> 
                        <option value="other">Other</option>
                    </select>
            </div>
        </div>
            
        <div style="display:none;" class="form-group">
                <input type="text" name="other_city_mbl" id="other_city_mbl"  class="form-control" placeholder="City" >
        </div>
        
        <div class="form-group">
        	<label>What are you looking for?</label>
        	<textarea name="comment_mbl" id="comment_mbl" class="form-control" ></textarea>
        </div>
        
        <div class="formgroup">
   <button type="submit" class="ConnectBtnsend2 btn-block" > Send Request </button>
  </div>
</div>
</form>
</div>
  
<!-- --------------------[Connenct-slider]--------------------------->  
 
<script type="text/javascript">
$(document).ready(function () {
    
    $('.MobileconntectUs').hide();

                $("#city_mbl").change(function (e) {
                //alert();
                if($("#city_mbl").val() == 'other'){
                   $("#other_city_mbl").parent().show(); 
                }else{
                   $("#other_city_mbl").parent().hide();
                   $("#other_city_mbl").val('');
                }
                });

                $("#mobile_mbl").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        return false;
                    }
                });

                jQuery.validator.addMethod("lettersonly", function (value, element) {
                    return this.optional(element) || /^[a-z\s]+$/i.test(value);
                }, " ");
                $("#lead_generation_form_mbl").validate({
                    rules: {
                        name_mbl: {
                            required: true,
                            lettersonly: true
                        },
                        mobile_mbl: {
                            required: true,
                            maxlength: 15,
                            minlength: 10

                        },
                        email_mbl: {
                            required: true,
                            email: true
                        },
                        other_city_mbl: {
                            required: true                           
                        }
                        
                    },
                    messages: {
                        name_mbl: {
                            required: '',
                            lettersonly: ''
                        },
                        mobile_mbl: {
                            required: '',
                            maxlength: '',
                            minlength: ''
                        },
                        email_mbl: {
                            required: '',
                            email: ''
                        },
                        other_city_mbl: {
                            required: ''                           
                        }
                    }
                });
                
            });
            
            
            
            $(document).ready(function () {

                $('#lead_generation_form_mbl').submit(function (e) {

                  
                if($('#lead_generation_form_mbl').valid()){  


                  e.preventDefault();

                   
                    var name = $('#name_mbl').val();
                    var email = $('#email_mbl').val();
                    var mobile = $('#mobile_mbl').val();
                    var other_city = $('#other_city_mbl').val();
                   // alert(other_city);
                    var comment = '';
                    if(other_city !=""){
                        comment = 'Selected City : '+other_city+'#'+$('#comment_mbl').val();
                        var city = '';
                    }else{
                        comment = $('#comment_mbl').val();
                        var city = $('#city_mbl').val();
                    }
                    
//                    alert(city);
//                    alert(comment);
                    var leadGenFromSliderPageType = $('#leadGenFromSliderPageType_mbl').val();
                    var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId_mbl').val();
                    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL_mbl').val();
                    var user_landing_page = $('#user_landing_page').val();
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
                    if ($('#lead_generation_form_mbl').valid()) {
                        if (name != '' && mobile != '' && email != '') {
                            $("#sending_message_mbl").show();
                            
                            $.ajax({
                                method: "POST",
                                url: baseUrl+'ajax-lead-generation-form-submit-action',
                                data: {'name': name,'email': email, 'mobile': mobile, 'city': city, 'comment': comment,'leadGenFromSliderPageType': leadGenFromSliderPageType,'leadGenFromSliderPageUniqueId':leadGenFromSliderPageUniqueId,'leadGenFromSliderPageURL':leadGenFromSliderPageURL,'user_landing_page':user_landing_page,'utm':utm},
                                success: function (response) {
                                    $('#lead_generation_form_mbl').trigger("reset");
                                    $("#sending_message_mbl").hide();
                                    $("#response_message_mbl").show();
                                    $("#text_message_mbl").text('Thanks ! We will get in touch with you soon.');
                                    setTimeout('$(".sld-overly").hide()',3000);
                                if(chk_flag_for_production == flag_for_production){
                                   /*Goole analytics script*/
                                  var result = response.split('|*|*|');
                                 // alert(event_category+result[0]+$('#leadGenFromSliderPageURL').val()+result[1]);
                                    ga('send', 'event', 
                                      { eventCategory: event_category,
                                        eventAction: result[0],
                                        eventLabel: 'Home Page | url='+leadGenFromSliderPageURL, 
                                        eventValue: result[1]
                                      });
                                   // toastr.success('Your request received successfully!');
                               }
                                },
                                error: function (response) {
                                  $("#sending_message_mbl").hide();
                                  //toastr.error('Something goes wrong.'); 
                                  $("#response_message_mbl").show();
                                  $("#text_message_mbl").text('Something goes wrong.');
                                  setTimeout('$(".sld-overly").hide()',3000);

                                }
                            });



                       }
                  }

                }

                });
                
               
            });
          











</script>


<?php

$this->load->view('section/vw_footer');
?>