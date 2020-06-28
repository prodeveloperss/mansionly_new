<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');

?>
  <!--------------[ Middle Section ]------------->
  
  <section class="login-section">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12  col-xs-12  col-md-12">
          <div class="loginform">
            <div class="floginheading">
              <h1 class=""> Sign in to Mansionly</h1>
            </div>
              <form id="loginForm" method="post" action="customer-login" class="login-form">
              <div class="input-effect">
                  <input class="label-effect" autocomplete="off"  type="email" placeholder="" name="username" id="username" autocomplete='new-email' value="<?php echo $email;?>"/>
                <label>Email</label>
              </div>
              <input type="password" style="display: none;">
              <div class="input-effect">
                  <input class="label-effect" autocomplete="off" type="password" placeholder="" name="password" id="password" autocomplete='new-password' />
                <label>Password</label>
              </div>
              <div class="button-container">
                <button  class="signBtn" type="submit">Sign in</button>
              </div>
              </form>   
                  
              <div class="clearfix"></div>
              <form id="forgotPasswordForm">
              <div class="forgotPass"> <a href="javascript:void(0);" class="frtpass"> Forgot password?</a> 
                  <div class="forgotPassdiv forgotPasspanel" style="display: none;">
               <div class="input-effect">
                   <input class="label-effect" type="text" name="forgotPassUsername" id="forgotPassUsername" placeholder="" autocomplete='off' />
                <label>Enter email</label>
              </div>
              
              <div class="button-container">
                <button  class="signBtn" type="submit">Send now</button>
              </div>
              
              </div>
              </div>
            </form>
            <div class="register_section clearfix">
            
                <form id="signUpForm" method="post">
              
              <div class="register-top">
              		<h4 class="donthav">Don't have an account yet?</h4>
                    <h4>Create account at Mansionly!</h4>	
              </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <div class="rgister-left clearfix">
                      <div class="input-effect">
                          <input name="fullName" id="fullName" class="label-effect" type="ext" placeholder="" autocomplete='off' />
                        <label>Full name</label>
                      </div>
                      <div class="input-effect">
                          <input name="email" id="email" class="label-effect" type="email" placeholder="" autocomplete='off' />
                        <label>Email</label>
                      </div>
                      <div class="input-effect">
                          <input name="mobile"  id="mobile"class="label-effect" type="text" placeholder="" maxlength="15" autocomplete='off' />
                        <label>Mobile number</label>
                      </div>
                      <div class="input-effect">
                          <input name="password" id="signupPassword" class="label-effect" type="password" placeholder="" autocomplete='off' />
                        <label>Create password</label>
                      </div>
                      <div class="input-effect">
                          <input name="confPassword" id="confPassword" class="label-effect" type="password" placeholder="" autocomplete='off' />
                        <label>Confirm your password</label>
                      </div>
                      <div class="button-container">
                        <button class="signBtn btn-block" type="submit">Sign up</button>
                      </div>
                    </div>
                  </div>
                  <div class=" vertibroder"> </div>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <div class="loginright clearfix">
                        <div class="form-group"> <a href="<?php echo base_url().'Hauth/login/Google'; ?>">
                              <div class="input-group"> <span class="input-group-addon" ><img src="<?php echo base_url().SitePath.'assets/img/google_logo.png'; ?>" alt="google"></span>
                          <div class="form-control"> Continue with Google </div>
                        </div>
                        </a> </div>
                      <div class="form-group"> <a href="<?php echo base_url().'Hauth/login/Facebook'; ?>">
                        <div class="input-group"> <span class="input-group-addon" ><img src="<?php echo base_url().SitePath.'assets/img/fb-art.png';?>" alt="google"></span>
                          <div class="form-control"> Continue  with Facebook </div>
                        </div>
                        </a> </div>
                      <div class="form-group wewil ">
                        <p>We will never share your email!</p>
                      </div>
                    
                      
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group termsuese ">
                        <p> By signing in, I acknowledge and agree to Mansionly’s <a href="<?php echo base_url(); ?>terms"> Terms of use </a> and <a href="<?php echo base_url(); ?>privacy">Privacy Policy </a> </p>
                      </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

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
  
  $(".input-effect .label-effect").each(function() {
    if ($(this).val() != "") {
      $(this).addClass("not-empty");
    } else {
      $(this).removeClass("not-empty");
    }
  });
  
  $('#loginForm').submit(function(e){
 ///ValidateIt();
      e.preventDefault();
      if($('#loginForm').valid()){
      $.ajax({
          type:"post",
          url:"customer-login",
          data:$("#loginForm").serialize(),
          success:function(response){
              if(response=="Login successfully")
              {
                  toastr.success('Login successfully');
                  window.location = "users";
              }else{
                toastr.error('Username or password mismatch');
                 // alert("Username or password mismatch.");
              }
          },
          error:function(response){
             // toastr.error('Username or password mismatch2');
              console.log(response);
          }
      });
  }
   
  });
  
  $('#signUpForm').submit(function(e){
      e.preventDefault();
     
     if($('#signUpForm').valid()){
      $.ajax({
          type:"post",
          url:baseUrl+"Cn_customer/customerRegister",
          data:$("#signUpForm").serialize(),
          success:function(response){
                toastr.success("User created successfully.");
                  window.location.reload();
          },
          error:function(response){
              toastr.error ('Error !!!');
          }
      });
  }
  });
  $('#forgotPasswordForm').submit(function(e){
      e.preventDefault();
       if($('#forgotPasswordForm').valid()){
           var data = $.param({
                username: $('#forgotPassUsername').val(),
            });
      $.ajax({
          type:"post",
          url:baseUrl+"Cn_customer/ForgotPassword",
          data:data,
          success:function(data){
                if(data.data.customer_password == "Invalid_User")
		   {
				toastr.error('This email id does not exist');
				//$('#forgotPassword').waitMe('hide');
		   }
		   else
		   {
				toastr.success('your password has been changed successfully, please check your registered email id');
				//$('#forgotPassword').waitMe('hide');
				document.location = baseUrl + 'signin?currEmailID=' + $('#forgotPassUsername').val();
		   }
          },
          error:function(response){
              toastr.error ('Error !!!');
          }
      });
  }
  });
});

</script>

<?php
$this->load->view('section/vw_footer');
?>
<script src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {		
		$("#loginForm").validate({
                    rules: {
                           
                                username: {
					required: true,
                                        email :true
				},
				password: {
					required: true
				}
			},
			messages: {                           
                               username: {
					required: '',
                                        email:''
				},
                                
				password: {
					required: ''
				}
			}
		});
		$("#forgotPasswordForm").validate({
                    rules: {
                           
                                forgotPassUsername: {
					required: true,
                                        email:true
				}
			},
			messages: {                           
                               forgotPassUsername: {
					required: '',
                                        email:''
				}
			}
		});
		$("#signUpForm").validate({
                    rules: {
                           
                                fullName: {
					required: true,
                                       
				},
                                 email: {
					required: true,
                                        email:true,
                                        remote:baseUrl+'Cn_customer/ajaxCheckUserMail'
				},
                                mobile: {
					required: true,
                                        number:true,
                                        maxlength:15,
                                        minlength:10,
                                        remote:baseUrl+'Cn_customer/ajaxCheckUserMobile'
				},
                                password: {
					required: true,
                                       
				},
                                confPassword: {
					required: true,
                                        equalTo : '#signupPassword'
				}
			},
			messages: {                           
                               fullName: {
					required: '',
                                       
				},
                                email: {
					required: '',
                                        email:'',
                                        remote:'Email is already registered.'

				},
                                mobile: {
					required: '',
                                        number:'',
                                        maxlength:'',
                                        minlength:'',
                                        remote:'Mobile number is already registered.'

				},
                                password: {
					required: '',
                                       
				},
                                confPassword: {
					required: '',
                                        equalTo : ''
				}
			}
		});
	});
</script>