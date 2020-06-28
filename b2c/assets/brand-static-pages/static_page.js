


$(document).ready(function () {

                $("#mobile_b").keypress(function (e) {
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
                        name_b: {
                            required: true,
                            lettersonly: true
                        },
                        mobile_b: {
                            required: true,
                            maxlength: 15,
                            minlength: 10

                        },
                        email_b: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        name_b: {
                            required: '',
                            lettersonly: ''
                        },
                        mobile_b: {
                            required: '',
                            maxlength: '',
                            minlength: ''
                        },
                        email_b: {
                            required: '',
                            email: ''
                        }
                    }
                });
                
            });
            
            
            
            $(document).ready(function () {

                $('#formContact').submit(function (e) {

                  e.preventDefault();

                   
                    var name = $('#name_b').val();
                    var email = $('#email_b').val();
                    var mobile = $('#mobile_b').val();
                    var city = $('#city_b').val();
                    var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
                    var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
                    var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
                    var user_landing_page = $('#user_landing_page').val();
                    var utm = $('#utm').val();
                    if(leadGenFromSliderPageUniqueId !=''){
                    var eventLabel = 'Custom Brand | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
                    }else{
                    var eventLabel = 'Custom Brand | URL='+leadGenFromSliderPageURL;
                    }
                   var event_category = $('#event_category').val();
                    var split_url = leadGenFromSliderPageURL.split('/');
                    var flag_for_production = 'www.mansionly.com';
                    var chk_flag_for_production = split_url[2];
                    if ($('#formContact').valid()) {
                        if (name != '' && mobile != '' && email != '') {
                            $("#loader").show();
                            

                            // $("#submit").attr('disabled','disabled');

                        

                            $.ajax({
                                method: "POST",
                                url: baseUrl+'ajax-brand-form-submit-action',
                                data: {'name': name,'email': email, 'mobile': mobile, 'city': city,
                                       'leadGenFromSliderPageType': leadGenFromSliderPageType,
                                       'leadGenFromSliderPageUniqueId':leadGenFromSliderPageUniqueId,
                                       'leadGenFromSliderPageURL':leadGenFromSliderPageURL,'user_landing_page':user_landing_page,'utm':utm},
                                success: function (response) {
                                    $('#formContact').trigger("reset");
                                    $("#loader").hide();
                                    toastr.success('Your request received successfully!');
                               if(chk_flag_for_production == flag_for_production){
                                     /*Goole analytics script*/
                                    var result = response.split('|*|*|');
                                //   alert(event_category+result[0]+eventLabel+result[1]);
                                    ga('send', 'event', 
                                        { eventCategory: event_category,
                                          eventAction: result[0],
                                          eventLabel: eventLabel, 
                                          eventValue: result[1]
                                        });
                                    }
                                },
                                error: function (response) {
                                    $("#loader").hide();
                                    toastr.error('Something goes wrong.');                                    
                                }
                            });



                       }
                  }



                });
                
               
            });
          


         