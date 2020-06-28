<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');                        
?>

<!--------------[ Middle Section ]------------->
  
  <section class="profile-section">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="#">My Account</a></li>
        <!--<li>Profile</li>-->
      </ol>
    </div>
   <div class="profile-nav">
   		 <div class="container">
         	<ul>
                    <li class="active"> <a href="<?php echo base_url();?>profile">Profile </a> </li>	<!-- <span class="countnum">5</span>-->
                    <li> <a href="<?php echo base_url();?>my-orders">My Orders </a> </li>	
                    <li> <a href="<?php echo base_url();?>my-favourites">My favourites </a> </li>	<!-- <span class="countnum">5</span>-->
                    <li> <a href="<?php echo base_url();?>signout">Sign Out</a> </li>	
                </ul>
         </div>
   </div> 
    
    <div class="container">
      <div class="row">
        <div class="col-sm-12  col-xs-12  col-md-12">
          <div class="profile-form ">
            <div class="floginheading">
              <h3 class=""> Account Information <a href="javascript:void(0)"> <i class="fa fa-pencil"></i> </a> </h3>
            </div>
              <form class="profleform" name="frmAccountInfo" id="frmAccountInfo">
                  
            <ul>
                 <li>
                 <div class="input-effect">
                     <input class="label-effect" type="text" placeholder="" autocomplete='off' name="fullName" id="fullName" value="<?php echo $customer_details_full->customer_name; ?>"/>
                <label>Full name</label>
              </div>
                </li>
                
            	<li>
               <div class="input-effect">
                    <?php 
                  $email_array=array();
                  foreach($customer_email_full as $row){
                      $email_array[]= $row['customer_email'];
                  }
                  $email_string = implode(',', $email_array);
                  ?>
                   <input class="label-effect" type="email" placeholder="" autocomplete='off' name="userEmail" id="userEmail" value="<?php echo $email_string; ?>" />
<!--                     <input class="label-effect" type="email" placeholder="" autocomplete='off' name="userEmail" id="userEmail" value="<?php// echo $customer_email_full->customer_email; ?>" />-->
                <label>Email</label>
              </div>
                </li>
                <li>
              <div class="input-effect">
                  <?php 
                  $mobile_array=array();
                  if(!empty($customer_mobile_full)){
                  foreach($customer_mobile_full as $row){
                      $mobile_array[]= $row['customer_phone'];
                  }
                  }
                  $mobile_string = implode(',', $mobile_array);
                  ?>
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="mobile" id="mobile" value="<?php echo $mobile_string; ?>"/>
                <label>Mobile Number</label>
              </div>
              </li>
              
             
<!--              <li>
              <div class="input-effect">
                  <input class="label-effect" type="password" placeholder="" autocomplete='off' name="userPassword" id="userPassword" />
                <label>Password</label>
              </div>
              </li>-->
              
             <li>
              <div class="input-effect">
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="customer_dob" id="customer_dob" value="<?php echo ($customer_details_full->customer_dob!='0000-00-00')?$customer_details_full->customer_dob:''; ?>"/>
                  <label>DOB (YYYY-MM-DD)</label>
              </div>
              </li>
            
             
              
              
              
              <li>
              <div class="input-effect">
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="address" id="address" value="<?php echo $customer_details_full->customer_address; ?>" />
                <label>Address</label>
              </div>
              </li>
              
              
              <li>
              <div class="input-effect">
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="profileCity" id="profileCity" value="<?php echo $customer_details_full->city; ?>"onkeyup="return keyup(this.value);" onblur="funonblur(this.value);" />
                <label>City</label>
                <div id="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                <input type="hidden" name="profileCityID" readonly="" id="profileCityID" value="<?php echo $customer_details_full->city_id; ?>" />
              </div>
              </li>
              
<!--              <li>
              <div class="input-effect">
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="profileCityRegion"  id="profileCityRegion" value="<?php echo $customer_details_full->state_title; ?>"/>
                <label>State</label>
                <input type="hidden" name="profileStateID" readonly="" id="profileStateID" value="<?php echo $customer_details_full->state_id; ?>" />
              </div>
              </li>-->
              
              
<!--              <li>
              <div class="input-effect">
                  <input class="label-effect" type="text" placeholder="" autocomplete='off' name="profileCityCountry" id="profileCityCountry" value="<?php echo $customer_details_full->countryName; ?>"/>
                <label>Country</label>
                <input type="hidden" name="profileCountryID" readonly="" id="profileCountryID" value="<?php echo $customer_details_full->country_id; ?>" />
              </div>
              </li>-->
              
              <div class="button-container">
                  <button  class="signBtn" type="submit" id="btnSaveAccountInfo">Save</button>
              </div>
              
              </ul>
            </form>
               <div class="clearfix"></div>
            <div class="changePassword clearfix">
             <div class="floginheading">
              <h3 class=""> Change Password <a href="javascript:void(0)"> <i class="fa fa-pencil"></i> </a> </h3>
            </div>
                
                <form class=" profleform " id="frmChangePassword">
            <ul>
             <li>
              <div class="input-effect">
                  <input class="label-effect" type="password" placeholder="" autocomplete='off' name="currentPassword" id="currentPassword" />
                <label>Current password</label>
              </div>
              </li>
              
              <li>
              <div class="input-effect">
                  <input class="label-effect" type="password" placeholder="" autocomplete='off' name="newPassword" id="newPassword"/>
                <label>New password</label>
              </div>
              </li>
              
              
              <li>
              <div class="input-effect">
                  <input class="label-effect" type="password" placeholder="" autocomplete='off' name="confirmPassword" id="confirmPassword"/>
                <label>Confirm new password</label>
              </div>
              </li>
            </ul>
            <div class="clearfix"></div>
              <div class="button-container">
                <button  class="signBtn" type="submit">Save</button>
              </div>
            </form>
              </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

<script src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<!--------------[ Middle Section ]------------->
<script> 

$(document).ready(function() {

  $(".input-effect .label-effect").focusout(function() {
    if ($(this).val() != "") {
      $(this).addClass("not-empty");
    } else {
      $(this).removeClass("not-empty");
    }
  });
  
  $(".input-effect .label-effect").each(function(){
       if ($(this).val() != "") {
      $(this).addClass("not-empty");
    } else {
      $(this).removeClass("not-empty");
    }
  });
});
</script>



<!-- Profile update -->
<script>
$(document).ready(function(){
      $('#frmAccountInfo').submit(function(e){
        e.preventDefault();
        if($('#frmAccountInfo').valid()){
          $.ajax({
              type:"post",
              //url: baseUrl+"Cn_customer/saveProfileDetail",
              url: baseUrl+"Cn_customer/saveProfileDetail",
              data:$("#frmAccountInfo").serialize(),
              success:function(response){
                  toastr.success('Your profile has been updated successfully.');
              },
              error:function(response){
                   toastr.error('Something goes wrong.');
                  console.log(response);
              }
          });
        }
  });
      $('#frmChangePassword').submit(function(e){
      e.preventDefault();
    if($('#frmChangePassword').valid()){  
        $.ajax({
            type:"post",
            url: baseUrl+"Cn_customer/changePassword",
            data:$("#frmChangePassword").serialize(),
            success:function(response){
                console.log(response);
                if(response.type== "success")
                {
                    toastr.success('Your password has been changed successfully.');
                }else if(response.msg== "Password mismatch"){
                   toastr.error('Password mismatch');
                }else if(response.msg== "Invalid user"){
                   toastr.error('Invalid user');
                }else {
                   toastr.error('Error');
                }
            },
            error:function(response){
                console.log(response);
            }
        });
    }
  });
});
</script>

<style type="text/css">
#country-list{float:left;list-style:none;margin:0;padding:0;width:740px; z-index:1010; position:absolute;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
</style>
<script type="text/javascript">
function keyup(keyword){
		$.ajax({
		type: "POST",
		url: baseUrl+"ajax-city-list",
		data:'keyword='+keyword,
		beforeSend: function(){
			//$("#search-box").css("background","#FFF url("+baseUrl+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
			$("#profileCityID").val('');
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
}
function funonblur(keyword){
	var b = ($("#profileCityID").val())?'':$("#profileCity").val('');
}
function selectCity(cityId,cityName){
	$("#profileCity").val(cityName);
	$("#profileCityID").val(cityId);
	$("#suggesstion-box").hide();
}
</script>

<script>
$(document).ready(function(){
        
  $("#mobile").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
   jQuery.validator.addMethod("dateFormat",function(value, element) {
        //return value.match(/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/);
      return this.optional(element) || /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/i.test(value);
    }," ");

   jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
   }, " "); 
   
		$("#frmAccountInfo").validate({
                    rules: {
                           
                                fullName: {
					required: true,
                                        lettersonly:true
				},
                                 mobile: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				},
				userEmail: {
					required: true,
                                        email:true
				},
                                customer_dob : {
                                 required: false,
                                 dateFormat: true
                                }
			},
			messages: {                           
                               fullName: {
					required: '',
                                        lettersonly:''
				},
                                mobile: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				},                                
                                
				userEmail: {
					required: '',
                                        email:''
				},
                                customer_dob : {
                                 dateFormat: ''
                                }
			}
		});
        
        $("#frmChangePassword").validate({
                    rules: {
                           
                                currentPassword: {
					required: true
				},
                                newPassword: {
					required: true
				},
                                 confirmPassword: {
					equalTo: "#newPassword"
                                       
				}
			},
			messages: {                           
                               currentPassword: {
					required: ''
                                       
				},
                               newPassword: {
					required: ''
                                       
				},
                                confirmPassword: {
					required: '',
                                        equalTo:''
				}
                                
			}
		});
         
         
        
    });
 
 
    </script>
<!-- End::form validation script -->

<?php
$this->load->view('section/vw_footer');
?>
