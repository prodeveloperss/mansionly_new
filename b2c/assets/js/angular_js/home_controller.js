
MansionlyApp.controller('home_controller', function ($scope, $http, waitMe, $timeout, $mdToast, $mdDialog) {
//MansionlyApp.controller('home_controller', function ($scope, $http) {
   alert();
    $scope.user_phone = '';
    $scope.user_mail = '';
    $scope.contactUsModelm ='';
    
 
 
  

 
   
	
	
	
  


   

    
alert();

	

    function ValidateIt_Getstarted() {	
		
		$('#contactUsFormEnq_1').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                Name: {
                    validators: {
                        notEmpty: {
                            message: 'please enter user name.'
                        }
                    }
                },
                Email: {
                    validators: {
                        notEmpty: {
                        }
                    }
                },
                MobileNo: {
                    validators: {
                        notEmpty: {
                        }
                    }
                },
                Comment: {
                    validators: {
                        notEmpty: {
                        }
                    }
                }
            }
        }); 
    }

    function ValidateEmail(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
    };
    $scope.isValidEmail = function() {
        if (!ValidateEmail($scope.logoutModel.Email)) {
            $('#signupEmailtxt').parent().removeClass('has-success');
            $('#signupEmailtxt').parent().addClass('has-error');
        } else {
            $('#signupEmailtxt').parent().removeClass('has-error');
            $('#signupEmailtxt').parent().addClass('has-success');
        }
		
    };
	
	
	

   

	
  
	
	
	
	
   

//    $scope.contactUsModel = new window.MansionlyApp.contactUsModel();
//
//    $scope.setModelIndex = function () {
//
//        $http({
//            method: 'GET',
//            url: baseUrl + 'Controllercustomer/getCurrentUserDetails'
//        }).then(function successCallback(response) {
//
//            if (response.data.data.isLogin) {
//                $scope.contactUsModel.userName = response.data.data.customerName;
//                $scope.contactUsModel.useremail = response.data.data.customerEmailid;
//                $scope.contactUsModel.MobileNo = response.data.data.customer_phone;
//                $scope.isLoggedinUserInfo = true;
//            }
//        }, function errorCallback(response) {
//            console.log(response);
//            $scope.isLoggedinUserInfo = false;
//        });
//    };
	
	
	
	
   

   $scope.contactUsSaveEnq = function () {
        waitMe.run_waitMe($('#contactUsLoaderenquiry_1'), 1);
        ValidateIt_Getstarted();

        if ($('#contactUsFormEnq_1').bootstrapValidator('validate').has('.has-error').length) {
            //alert("error");
            $('#contactUsLoaderenquiry_1').waitMe('hide');
            return;
        } else {
            //alert("success");

            var data = $.param({
                name: $scope.contactUsModelEnq.userName,
                email: $scope.contactUsModelEnq.useremail,
                mobile: $scope.contactUsModelEnq.MobileNo,
                //designerDesc: $scope.contactUsModelEnq.Comment,
                marketplace_comments: $scope.contactUsModelEnq.Comment,
                remote_address: $scope.ipAddressVal,
                formtitle: 'Mansionly - Contact',
            });
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }

            $http.post(baseUrl + 'Controllercustomer/checkUserExistOrNot', data, config)
          .success(function (data, status, headers, config) {
              var vv = '';
              $('#contactUsLoaderenquiry_1').waitMe('hide');
              //if user already registered but not login
              //if (data.trimLeft() == "User is already registered" && (currLoginUserId == null || currLoginUserId == "")) {
              if (data.msg == "User is already registered" && (currLoginUserId == null || currLoginUserId == "")) {
                  //alert("Please login first to save your orders.");
                  //$scope.pop('info', '', 'Please login first to save your orders.');
                  $scope.showToast('Please login first to save your orders');
                  setCookie("redirectToSameScreen", 'corporate/contact', 30);
                  document.location = baseUrl + 'signin?currEmailID=' + data.data.customer_username;

              } else {
                  var result = data;
                  //alert('your order save successfully.');
                  $scope.showToast('your order saved successfully');
                  //$scope.pop('success', '', 'your order save successfully.');
                  $scope.contactUsModelEnq = '';
				  $("#enquiryformsection").css('display','none');
              }


          })
          .error(function (data, status, header, config) {
              var err = '';
              $('#contactUsLoaderenquiry_1').waitMe('hide');
          });

        }
    };
	
   
        
        
	
});






   



