<?php
$this->load->view('section/vw_header_1');
$this->load->view('section/vw_header_2');

?>

<!--------------[ Middle Section ]-------------> 


<section class="contactus-section">
<div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li class="active">Contact Us</li>
      </ol>
    </div>

	<div class="container">
    	<div class="row">
        	<div class="col-sm-12 ">
            <div class="Headind-style lifebrand-head">
              <h1> Contact Us</h1>
            </div>
            
            <div class="contcttoptext clearfix">
           <p> Get in touch with us via phone or email.<br>
You can also drop in your contact information and our executive will get in touch with you as soon as possible.</p>
            </div>
                    <form id="contactForm">
            <div class="topCntRadio">
            	<ul>
                	<li> 
                    <div class="radio-inline">
                        <label> <input type="radio" checked="checked" id="radioGeneralEnq" value="General Enquiry" name="custom_type"> General Enquiry </label>
                     </div>
                    </li>
                    
                    <li> 
                    <div class="radio-inline">
                        <label> <input type="radio" id="radioCustomerSprt" value="Customer Support Request" name="custom_type">  Customer Support </label>
                     </div>
                    </li>
                    
                    
                    <li> 
                    <div class="radio-inline">
                        <label> <input type="radio" id="radioRqtPro" value="Request Proposal" name="custom_type">  Request Proposal</label>
                     </div>
                    </li>
                    
                    
                    <li> 
                    <div class="radio-inline">
                        <label> <input type="radio" id="radioIDesigner" value="Designer Partner" name="custom_type"> 	I am a Designer </label>
                     </div>
                    </li>
                </ul>
            </div>
              <div class="clearfix"></div>
             <?php if($this->session->userdata('customer_info')['customer_email']){
            $customer_email = $this->session->userdata('customer_info')['customer_email'];
            }else{$customer_email=""; }
            if($this->session->userdata('customer_info')['customer_phone']){
                $customer_phone = $this->session->userdata('customer_info')['customer_phone'];
            }else{$customer_phone=""; }
            if($this->session->userdata('customer_info')['customer_name']){
                $customer_name = $this->session->userdata('customer_info')['customer_name'];
            }else{$customer_name=""; }
           ?>
            <div class="ContactForm clearfix">
           
            <div class="col-sm-6 col-md-6 col-xs-12">
            	<div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Name" class="form-control" <?php if($customer_name){?> readonly="" <?php } ?>  placeholder="Name" value="<?php echo $customer_name;?>">
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" <?php if($customer_email){?> readonly="" <?php } ?>  placeholder="Email" value="<?php echo $customer_email;?>">
                </div>
                <div class="form-group">
                    <input type="text" name="mobile" id="mobile" placeholder="Phone" class="form-control" <?php if($customer_phone){?> readonly="" <?php } ?> maxlength="15"  minlength="10" placeholder="Mobile" value="<?php echo $customer_phone;?>">
                </div>
            
            </div>
            
              <div class="col-sm-6 col-md-6 col-xs-12">
               <div class="form-group">
               <label>Message</label>
               <textarea placeholder="Message" id="message_text" name="message_text" class="form-control"></textarea>
                </div>
              
              </div>
              
              <div class="col-sm-12 col-md-12 col-xs-12">
              	<div class="form-group">
                    <button  class="btn ContactBtn btn-block" type="submit">Submit</button>
                </div>
              </div>
         
            
            
            </div>
               <div class="clearfix"></div>
               </form>
               
             <div class="coantact-btm">
             	<p>Or</p>
<p>Write to us on</p>
<div class="clearfix"></div>

<div class="contcatLast">
	<ul> 
    	<li>
            <h4>Customer Support</h4>
            <span> <a href="mailto:care@mansionly.com"> care@mansionly.com  </a></span>
        </li>
        
        <li>
            <h4>Are You a Designer?</h4>
            <span> <a href="mailto:designers@mansionly.com"> designers@mansionly.com </a></span>
        </li>
        
        
        <li>
            <h4>Media Queries</h4>
            <span> <a href="mailto:press@mansionly.com"> press@mansionly.com  </a></span>
        </li>
    
    </ul>

</div>

<div class="customer_suprt">

<!--<h4>Customer Support  +91-70428-65645</h4>
<h4>Customer Support  +91-70730-17599</h4>
<h4>Customer Support  +91-91480-16022</h4>-->
<p>Monday to Friday (9AM to 6PM)</p><br>
<p>Head office address</p>
<!--<p>Studio 108, IHDP Business Park, Sector 127, Noida, Uttar Pradesh</p>-->
<p>Awfis 7th Floor Ambience Mall, Gurugram, Haryana 122002</p>

</div>
             
             
             </div>  
               
            </div>
        </div>
    </div>
</section>

</div>

<!--------------[ Middle Section ]-------------> 


<script>
$(document).ready(function(){
    $('#contactForm').submit(function(e){
      e.preventDefault();
 

     if($('#contactForm').valid()){
         
         var custom_type =  $("[name=custom_type]:checked").val();
         var message_text =$('#message_text').val();
         var message_string ="";
         if(message_text== ""){
           message_string = custom_type;
         }else{
           message_string = custom_type+':: '+message_text;
         }
        var event_category = $('#event_category').val();
        var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
        var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
        var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
        var user_landing_page = $('#user_landing_page').val();
        var utm = $('#utm').val();
        var scheme = $('#scheme').val();
        var eventLabel =  'Contact Us | URL='+leadGenFromSliderPageURL;
        var split_url = leadGenFromSliderPageURL.split('/');
        var flag_for_production = 'www.mansionly.com';
        var chk_flag_for_production = split_url[2]; 
        var data = $.param({
                name: $('#name').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val(),
                //designerDesc: $scope.contactUsModel.Comment,
                marketplace_comments: message_string,
                remote_address: '<?php echo $_SERVER['REMOTE_ADDR'];?>',
                formtitle: 'Mansionly - Contact',
                special_request: message_string,
                leadGenFromSliderPageType: leadGenFromSliderPageType,
                leadGenFromSliderPageUniqueId:leadGenFromSliderPageUniqueId,
                leadGenFromSliderPageURL:leadGenFromSliderPageURL,
                user_landing_page:user_landing_page,
                utm:utm,
                scheme:scheme
            });
      $.ajax({
          type:"post",
          url:baseUrl+"Cn_customer/checkUserExistOrNot",
          data:data,
          success:function(data){
                   
            toastr.success('your order saved successfully');
             if(chk_flag_for_production == flag_for_production){
                        var result = data.split('|*|*|');
                         /*Goole analytics script*/
                        //  alert(event_category+result[0]+eventLabel+result[1]);
                            ga('send', 'event', 
                                { eventCategory: event_category,
                                  eventAction: result[0],
                                  eventLabel: eventLabel, 
                                  eventValue: result[1]
                                });
                        }
               
                
          },
          error:function(data){
              toastr.error ('Error !!!');
          }
      });
  }
  });
});
</script>


<script src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {		
		$("#contactForm").validate({
                    rules: {
                           
                                name: {
					required: true,
                                       
				},
				email: {
					required: true,
                                        email:true
				},
                                mobile:{
                                    required:true
                                    //digits:true
                                },
                                message_text:{
                                    required:true,
                                }
			},
			messages: {                           
                               name: {
					required: '',
                                       
				},
				email: {
					required: '',
                                        email:''
				},
                                mobile:{
                                    required:''
                                   // digits:''
                                },
                                message_text:{
                                    required:'',
                                }
			}
		});
		});
</script>
<?php
$this->load->view('section/vw_footer');
?>