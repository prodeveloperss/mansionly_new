


$("#ConnectBtn1").click(function(e) {
 // e.preventDefault();
    $('#ConnectBtn1').text(            
      $('.Campa-connectUSfix').hasClass('ConnectFormOpen') ? "Connect With Us"  : "Request Call Back"
      );
    
//     if ($('#formContact_2').valid()) {
//         alert('if');
//          $(".Campa-connectUSfix").removeClass("ConnectFormOpen");
//     }else {
//         alert('else');
//          $(".Campa-connectUSfix").addClass("ConnectFormOpen");
//     }

    $(".Campa-connectUSfix").toggleClass("ConnectFormOpen");
    
});

$("#ConnectBtnhide").click(function(e) {
    $(".Campa-connectUSfix").removeClass("ConnectFormOpen");
    $("#ConnectBtn1").text('Connect With Us')

	//$(this).toggleClass("iconchnage1")
});

/*$("#ConnectBtnhide").click(function(e) {
    $(".ConnectUsBtn").removeClass("iconchnage");
});
*/


$(window).scroll(function() {    
    var scroll = $(document).scrollTop();
    var formPosition = parseInt($('#formContact').offset().top);
    var windowHeight = $( window ).height();
    
    // console.log('form:'+formPosition+' scroll:'+scroll+' window:'+$( window ).height());
    if (scroll >= formPosition-windowHeight-100) {
      
        $(".Campa-connectUSfix ").removeClass("ConnectFormOpen", 2500);
        $(".Campa-connectUSfix ").addClass("Conn", 2500);
        $('#ConnectBtn1').text('Connect With Us');
		
    }else {
        $(".Campa-connectUSfix ").removeClass("Conn", 2500);
    }
   
    
    
});



$(window).on("load resize", function() {
  if ($(this).width() < 640) {
   $("#ConnectBtn1").click(function (){
       
  $('html, body').animate({
   scrollTop: $("#top").offset().top
  }, 500);
   return false;
 });
  } 
});

//$(window).scroll(function() {
//    if ($(this).scrollTop() <= 4800) {
//        $("#ConnectBtn11").stop().animate({
//            opacity: 1
//        }, 300);
//    } else {
//        $("#ConnectBtn11").stop().animate({
//            opacity: 0
//        }, 300);
//    }
//});

 /*$(document).ready(function (){
            $("#ConnectBtn1").click(function (){
                $('html, body').animate({
                    scrollTop: $("#top").offset().top
                }, 2000);
            });
        });
*/








$(document).ready(function () {

                $("#mobile,#mobile_2").keypress(function (e) {
                    //if the letter is not digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        return false;
                    }
                });

                jQuery.validator.addMethod("lettersonly", function (value, element) {
                    return this.optional(element) || /^[a-z\s]+$/i.test(value);
                }, " ");
                $("#formContact").validate({
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
                        }
                    }
                });
                $("#formContact_2").validate({
                    rules: {
                        name_2: {
                            required: true,
                            lettersonly: true
                        },
                        mobile_2: {
                            required: true,
                            maxlength: 15,
                            minlength: 10

                        },
                        email_2: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        name_2: {
                            required: '',
                            lettersonly: ''
                        },
                        mobile_2: {
                            required: '',
                            maxlength: '',
                            minlength: ''
                        },
                        email_2: {
                            required: '',
                            email: ''
                        }
                    }
                });
            });
            
            
            
            $(document).ready(function () {

                $('#formContact').submit(function (e) {

                  e.preventDefault();

                   
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var mobile = $('#mobile').val();
                    var city = $('#city').val();
                    var comment = $('#comment').val();
                    var campaign_utm_param = $('#utm').val();
                    var scheme = $('#scheme').val();
                    var event_category = $('#event_category').val();
                    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
                    var eventLabel =  ' Campaign Page | URL='+leadGenFromSliderPageURL;
                    var split_url = leadGenFromSliderPageURL.split('/');
                    var flag_for_production = 'www.mansionly.com';
                    var chk_flag_for_production = split_url[2]; 
                    if ($('#formContact').valid()) {
                        if (name != '' && mobile != '' && email != '') {
                            $("#campaign_loader").show();
                            

                            // $("#submit").attr('disabled','disabled');

                        

                            $.ajax({
                                method: "POST",
                                url: baseUrl+'ajax-interior-design-form-submit-action',
                                data: {'name': name,'email': email, 'mobile': mobile, 'city': city, 'comment': comment,'campaign_utm_param': campaign_utm_param,'scheme':scheme},
                                success: function (response) {
                                    $('#formContact').trigger("reset");
                                    $("#campaign_loader").hide();
                                    toastr.success('Your order saved successfully.');
                                   if(chk_flag_for_production == flag_for_production){
                                     var result = response.split('|*|*|');
                                       /*Goole analytics script*/
                                     // alert(event_category+result[0]+eventLabel+result[1]);
                                          ga('send', 'event', 
                                              { eventCategory: event_category,
                                                eventAction: result[0],
                                                eventLabel: eventLabel, 
                                                eventValue: result[1]
                                              });
                                        }
                                },
                                error: function (response) {
                                    $("#campaign_loader").hide();
                                    toastr.error('Something goes wrong.');                                    
                                }
                            });



                       }
                  }



                });
                
               $('#formContact_2').submit(function (e) {
                   
                  e.preventDefault();

                    var name = $('#name_2').val();
                    var email = $('#email_2').val();
                    var mobile = $('#mobile_2').val();
                    var city = $('#city_2').val();
                    var comment = $('#comment_2').val();
                    var campaign_utm_param = $('#utm_2').val();
                    var scheme = $('#scheme').val();
                    var event_category = $('#event_category').val();
                    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
                    var eventLabel =  ' Campaign Page | URL='+leadGenFromSliderPageURL;
                    var split_url = leadGenFromSliderPageURL.split('/');
                    var flag_for_production = 'www.mansionly.com';
                    var chk_flag_for_production = split_url[2]; 
 

                    if ($('#formContact_2').valid()) {
                        if (name != '' && mobile != '' && email != '') {
                            $("#campaign_loader_2").show();
                            $('#formContact_2').trigger("reset");

                            // $("#submit").attr('disabled','disabled');
                           
                        

                            $.ajax({
                                method: "POST",
                                url: baseUrl+'ajax-interior-design-form-submit-action',
                                data: {'name': name,'email': email, 'mobile': mobile, 'city': city, 'comment': comment,'campaign_utm_param': campaign_utm_param,'scheme':scheme},
                                success: function (response) {
                                    $("#campaign_loader_2").hide();
                                    toastr.success('Your order saved successfully.');
                                     if(chk_flag_for_production == flag_for_production){
                                     var result = response.split('|*|*|');
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
                                error: function (response) {
                                    $("#campaign_loader_2").hide();
                                    toastr.error('Something goes wrong.');                                    
                                }
                            });



                       }
                  }



                });
            });
          


         