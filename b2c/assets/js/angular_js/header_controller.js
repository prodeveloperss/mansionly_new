MansionlyApp.controller('header_controller', function ($scope, $http, waitMe, $timeout, $mdToast, $mdDialog) {
    $scope.TotalProduct = 0;
    $scope.isCartEmpty = true;
    $scope.hoverCartShow = false;
    $scope.ProductListInCart = [];
	$scope.sampleexecutionportfolioformenu = [];
	$scope.productSections = [];
    $scope.comingSoonService = false;
    $scope.searchOption = true;
	$scope.user_phone = '';
	$scope.user_mail = '';
	$scope.orderType = 7;
    $scope.showMenuOption = true;
    $scope.showMenuArrow1 = true;
    $scope.showMenuArrow2 = true;
    $scope.contactUsModelm ='';
    $scope.featuresThisWeek = [{
        "id": "",
        "title": "Bar",
        "imgUrl": "bar.jpg"
    }, {
        "id": "",
        "title": "Bed Room",
        "imgUrl": "bed.jpg"
    }, {
        "id": "",
        "title": "Kids Room",
        "imgUrl": "kids-room.jpg"
    }, {
        "id": "",
        "title": "Kitchen",
        "imgUrl": "kitchen.jpg"
    }, {
        "id": "",
        "title": "Wardrobes",
        "imgUrl": "wardrobe.jpg"
    }, {
        "id": "",
        "title": "Civil Work",
        "imgUrl": "civil-work.jpg"
    }, {
        "id": "",
        "title": "Living Room",
        "imgUrl": "living-room.jpg"
    }, {
        "id": "",
        "title": "Outside Garden",
        "imgUrl": "outside-garden.jpg"
    }, {
        "id": "",
        "title": "Bathroom",
        "imgUrl": "bathroom.jpg"
    }, {
        "id": "",
        "title": "Decor",
        "imgUrl": "Decor.jpg"
    }, {
        "id": "",
        "title": "Electric",
        "imgUrl": "electric.jpg"
    }, {
        "id": "",
        "title": "False Celing",
        "imgUrl": "false-celing.jpg"
    }, {
        "id": "",
        "title": "Paint",
        "imgUrl": "paint.jpg"
    }];
    (function(cr) {
        var logoutModel = function() {
            var self = this;
            self.FirstName = '';
            self.LastName = '';
            self.Email = '';
            self.MobileNo = '';
            self.Password = '';
            self.ConfirmPassword = '';
        };
        cr.logoutModel = logoutModel;
    }(window.MansionlyApp));
    $scope.logoutModel = new window.MansionlyApp.logoutModel();
    $(".designTab").click(function() {
        if (window.screen.width >= 1024) {
            $('#executionPnl, #shoppingPnl, #servicesPnl').css('display', 'none');
            $('#designPnlSmallScreen ,#executionPnlSmallScreen, #shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
            //$('#designPnl').toggle();
        } else {
            $('#executionPnlSmallScreen ,#shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
            $('#designPnl ,#executionPnl ,#shoppingPnl ,#servicesPnl').css('display', 'none');
            $('#designPnlSmallScreen').toggle();
        }
    });
    $(".executionTab").click(function() {
        if (window.screen.width >= 1024) {
            $('#executionPnl').toggle();
            $('#designPnl, #shoppingPnl, #servicesPnl').css('display', 'none');
            $('#designPnlSmallScreen ,#executionPnlSmallScreen, #shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
        } else {
            $('#executionPnlSmallScreen').toggle();
            $('#designPnlSmallScreen ,#shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
            $('#designPnl ,#executionPnl ,#shoppingPnl ,#servicesPnl').css('display', 'none');
        }
    });
    $(".shoppingTab").click(function() {
        if (window.screen.width >= 1024) {
            $('#shoppingPnl').toggle();
            $('#designPnl,  #servicesPnl').css('display', 'none');  //#executionPnl,
            $('#designPnlSmallScreen ,#executionPnlSmallScreen, #shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
        } else {
            $('#shoppingPnlSmallScreen').toggle();
            $('#designPnlSmallScreen ,#executionPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
            $('#designPnl ,#executionPnl ,#shoppingPnl ,#servicesPnl').css('display', 'none');
        }
    });
    $(".servicesTab").click(function() {
        if (window.screen.width >= 1024) {
            $('#servicesPnl').toggle();
            $('#designPnl, #executionPnl, #shoppingPnl').css('display', 'none');
            $('#designPnlSmallScreen ,#executionPnlSmallScreen, #shoppingPnlSmallScreen ,#servicesPnlSmallScreen').css('display', 'none');
        } else {
            $('#servicesPnlSmallScreen').toggle();
            $('#designPnlSmallScreen ,#executionPnlSmallScreen ,#shoppingPnlSmallScreen').css('display', 'none');
            $('#designPnl ,#executionPnl ,#shoppingPnl ,#servicesPnl').css('display', 'none');
        }
    });
    $scope.childMenu = function(event) {
        if (event == "Furniture") {
            angular.forEach($scope.shoppingProdTop, function(value, index) {
                if (value.cat_name == "Furniture" && event == "Furniture") {
                    $('#subChildMenuHome').css("display", "none");
                    $('#subChildMenuFurniture').toggle();
                }
            });
        } else if (event == "Home Improvement") {
            angular.forEach($scope.shoppingProdTop, function(value, index) {
                if (value.cat_name == "Home Improvement" && event == "Home Improvement") {
                    $('#subChildMenuFurniture').css("display", "none");
                    $('#subChildMenuHome').toggle();
                }
            });
        }
    };
    var setValue = getCookie("signInOutList");
    if (setValue == 'true') {
        $scope.signOutModel = true;
    } else {
        $scope.signOutModel = false;
    }
	
	$scope.init = function () {
        //api for Theme List menu options
        waitMe.run_waitMe($('.megamenu  li ul'), 1);
        $http({
            method: 'GET',
            url: baseUrl + 'Controllerdesigner/getThemeList'
        }).then(function successCallback(response) {
            $scope.designThemesTop = response.data.data.designs;
            $('.megamenu  li:first-child ul').waitMe('hide');
            $('.megamenu  li .brand_list ul').waitMe('hide');
        }, function errorCallback(response) {
            $('.megamenu  li:first-child ul').waitMe('hide');
            $('.megamenu  li .brand_list ul').waitMe('hide');
        });

		//api for designer list in main menu under design tab
		$http({
            method: 'GET',
            url: baseUrl + 'Controllerdesigner/designerlistInmenu'
        }).then(function successCallback(response) {
			$('.featuresLodingImg').waitMe('hide');
            $scope.designFeatureProducts = response.data.data.Designer;
        }, function errorCallback(response) {
        });
		
		
        

        $http({
            method: 'GET',
            url: baseUrl + 'Controllerdesigner/getSocialMediaList'
        }).then(function successCallback(response) {
            var tmp = response.data.data.socialmedia;
            for (var i = 0; i < tmp.length; i++) {
                if (tmp[i].social_name == "googleplus") {
                    tmp[i].social_name = tmp[i].social_name.replace("googleplus", "google-plus");
                }
                if (tmp[i].social_name == "youtube") {
                    tmp[i].social_name = tmp[i].social_name.replace("youtube", "youtube-play");
                }
            }
            $scope.socialMediaList = tmp;
        }, function errorCallback(response) {
            console.log(response);
        });

        //api for exection menu

        $http({
            method: 'GET',
            url: baseUrl + 'Controllerexecution/getExecutionMenu'
        }).then(function successCallback(response) {
            $scope.PackageMenuListTop = response.data.data.Package;
            $scope.SpecialitiesMenuListTop = response.data.data.Specialities;

        }, function errorCallback(response) {
            console.log(response);
        });
		
		
		$http({
            method: 'GET',
            url: baseUrl + 'Controllerproducts/getProductSectionList'
        }).then(function successCallback(response) {
            $scope.productSections = response.data.data.products;
            $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
            stop_waitMe();
        }, function errorCallback(response) {
            $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
        });
    };
	
	// New combine function commented for design menu
    /*$scope.init = function() {
        waitMe.run_waitMe($('.megamenu  li ul'), 1);
        $http({
            method: 'GET',
            url: baseUrl + 'Controllercommon/getcombineList'
        }).then(function successCallback(response) {
            $scope.designThemesTop = response.data.data.designs;
            $scope.designIdeasTop = response.data.data.sectionlist;
            $scope.designFeatureProducts = response.data.data.DesignFeature;
            $('.megamenu  li:first-child ul').waitMe('hide');
            $('.megamenu  li .brand_list ul').waitMe('hide');
            $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
            $('.featuresLodingImg').waitMe('hide');
            stop_waitMe();
        }, function errorCallback(response) {
            $('.megamenu  li:first-child ul').waitMe('hide');
            $('.megamenu  li .brand_list ul').waitMe('hide');
            $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
            $('.featuresLodingImg').waitMe('hide');
        });
        $('.megamenu  li:nth-child(' + 3 + ') ul').waitMe('hide');
        $http({
            method: 'GET',
            url: baseUrl + 'Controllerdesigner/getSocialMediaList'
        }).then(function successCallback(response) {
            var tmp = response.data.data.socialmedia;
            for (var i = 0; i < tmp.length; i++) {
                if (tmp[i].social_name == "googleplus") {
                    tmp[i].social_name = tmp[i].social_name.replace("googleplus", "google-plus");
                }
                if (tmp[i].social_name == "youtube") {
                    tmp[i].social_name = tmp[i].social_name.replace("youtube", "youtube-play");
                }
            }
            $scope.socialMediaList = tmp;
        }, function errorCallback(response) {
            console.log(response);
        });
        $http({
            method: 'GET',
            url: baseUrl + 'Controllerexecution/getExecutionMenu'
        }).then(function successCallback(response) {
            $scope.PackageMenuListTop = response.data.data.Package;
            $scope.SpecialitiesMenuListTop = response.data.data.Specialities;
        }, function errorCallback(response) {
            console.log(response);
        });
    };*/
    $scope.init();
    $scope.searchClkFunc = function() {
        $("#inputSearch").toggle();
        if($scope.searchOption == true){
			$scope.searchOption = false;
		} else {
			$scope.searchOption = true;
		}
    };
    $scope.showMenuBar = function () {
		if($scope.showMenuOption == true){
			$scope.showMenuOption = false;
		} else {
			$scope.showMenuOption = true;
		}
	}
    $scope.CategoryMenu = [{
        title: 'Furniture'
    }, {
        title: 'Décor'
    }, {
        title: 'Lamps'
    }, {
        title: 'Bed & Bath'
    }];
    $scope.designCatInit = function(cat, menu) {
        if (cat == "Theme") {
            var json_str = JSON.stringify($scope.designThemesTop);
            $.cookie('designTheme', JSON.stringify([{
                "Category": cat,
                "Menu": menu,
                "arrVal": json_str
            }]));            
        } else if (cat == "Rooms") {
            var json_strN = JSON.stringify($scope.designIdeasTop);
            $.cookie('designRoom', JSON.stringify([{
                "Category": cat,
                "Menu": menu,
                "arrVal": json_strN
            }]));
        }
    };

    //$scope.GetActiveLi = function (setActiveMenuLi) {
    //    //var someVarName = $('#designPnlLi').attr('id')
    //    localStorage.setItem("setActiveMenuLi", setActiveMenuLi);
    //}

    $scope.shopCatInit = function(cat, menu) {
        if (cat == "Category") {} else if (cat == "Rooms") {} else if (cat == "brands") {}
    };

    function ValidateIt() {
        $('#signUpForm').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                fname: {
                    validators: {
                        notEmpty: {}
                    }
                },
                lname: {
                    validators: {
                        notEmpty: {}
                    }
                },
                email: {
                    validators: {
                        notEmpty: {}
                    }
                },
                telNo: {
                    validators: {
                        notEmpty: {}
                    }
                },
                password: {
                    validators: {
                        identical: {
                            field: 'confirmPassword'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password'
                        }
                    }
                }
            }
        });
		
	}

    function ValidateIt_Footer()
	{	
		
		$('#contactUsFooter').bootstrapValidator({
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
                /* Email: {
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
                }, */
                Comment: {
                    validators: {
                        notEmpty: {
                        }
                    }
                }
            }
        });
	
	}

    function ValidateIt_Getstarted() {	
		
		$('#contactUsFormEnq').bootstrapValidator({
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
	
	
	
	
	$scope.isValidEmail_Footer = function() {
	 if (!ValidateEmail($scope.contactUsFooter.useremail)) {
            $('#ContentEmailtxt').parent().removeClass('has-success');
            $('#ContentEmailtxt').parent().addClass('has-error');
        }
        else {
            $('#ContentEmailtxt').parent().removeClass('has-error');
            $('#ContentEmailtxt').parent().addClass('has-success');
        }
	}
	
	$scope.isValidEmail_Getstarted = function() {
		if (!ValidateEmail($scope.contactUsModelEnq.useremail)) {
            $('#ContentEmailtxtenq').parent().removeClass('has-success');
            $('#ContentEmailtxtenq').parent().addClass('has-error');
        }
        else {
            $('#ContentEmailtxtenq').parent().removeClass('has-error');
            $('#ContentEmailtxtenq').parent().addClass('has-success');
        }
	}
	
    $scope.signupSubmit = function() {
		waitMe.run_waitMe($('.loginbubble'), 1);
        ValidateIt();
        if ($('#signUpForm').bootstrapValidator('validate').has('.has-error').length) {
			$('.loginbubble').waitMe('hide');
            return;
        } else {
            var data = $.param({
                name: $scope.logoutModel.FirstName + ' ' + $scope.logoutModel.LastName,
                email: $scope.logoutModel.Email,
                mobile: $scope.logoutModel.MobileNo,
                password: $scope.logoutModel.Password,
                isexternal_users: 0
            });
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };
            $http.post(baseUrl + 'Controllercustomer/customerRegister', data, config)
			.success(function(data, status, headers, config) {
				$('.loginbubble').waitMe('hide');
                $('#SignINSignUPModel').modal('toggle');
                $scope.logoutModel = '';
                var result = data.data;
                window.location.reload();
            }).error(function(data, status, header, config) {
                var err = '';
				$('.loginbubble').waitMe('hide');
				 $scope.showToast(data.msg);
            });
        }
    };
    $scope.$on('currentCartItemCount', function() {
        $scope.productInCart();
    });
    $scope.productInCart = function() {
        waitMe.run_waitMe($('.popover'), 1);
        $http({
            method: 'GET',
            url: baseUrl + 'Controllerproducts/TotalProductInCart'
        }).then(function successCallback(response) {
            if (parseInt(response.data.data) > 0) {
                $scope.isCartEmpty = false;
                $scope.TotalProduct = parseInt(response.data.data);
                if ($scope.TotalProduct > 0) {
                    $scope.fetchCart();
                } else {
                    $('.popover').waitMe('hide');
                    $scope.isCartEmpty = true;
                    $scope.TotalProduct = 0;
                    $scope.ProductListInCart = [];
                }
            } else {
                $('.popover').waitMe('hide');
                $scope.isCartEmpty = true;
                $scope.TotalProduct = 0;
                $scope.ProductListInCart = [];
            }
        }, function errorCallback(response) {
            $('.popover').waitMe('hide');
            console.log(response);
        });
    };
    $scope.productInCart();
    $scope.signOutFun = function() {
        setCookie("signInOutList", false, 30);
        var data = $.param({
            username: ''
        });
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(baseUrl + 'Controllercommon/clearSession', data, config).success(function(data, status, headers, config) {
            document.location = baseUrl + 'signin';
        }).error(function(data, status, header, config) {
            var err = '';
        });
    };
    $scope.Search = "";
    if (getCookie("searchTxt") != undefined && getCookie("searchTxt") != '' && getCookie("searchTxt") != null) {
        $scope.Search = getCookie("searchTxt");
    }
    $scope.totalRecords = '';
    $scope.$watch("Search", function() {
        if ($scope.Search != "") {
            setCookie("searchTxt", $scope.Search);
        } else {}
    });
    $('.uniSearch').keypress(function(e) {
        var key = e.which;
        if (key == 13) {
            if ($scope.Search != "") {
                setCookie("searchTxt", $scope.Search);
                //document.location = $(".uniSearchClk").attr('href');
				document.location = baseUrl + 'users/universalSearch';
            } else {
                return false;
            }
        }
    });
    $('.uniSearchClk').click(function() {
        if ($scope.Search != "") {
            setCookie("searchTxt", $scope.Search);
        } else {
            return false;
        }
        return false;
    });
	 $('.uniSearchClkbutton').click(function() {
        if ($scope.Search != "") {
            setCookie("searchTxt", $scope.Search);
		    document.location = baseUrl + 'users/universalSearch';
        } else {
            return false;
        }
    });
    /* $http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getProductCatgList?cat_id=0'
    }).then(function successCallback(response) {
        $scope.shoppingProdTop = response.data.data.ProductCatg;
        $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
        stop_waitMe();
    }, function errorCallback(response) {}); */
    $scope.closeModel = function() {
        $scope.logoutModel = '';
    };
    $scope.getLimits = function(array) {
        return [Math.floor(array.length / 2) + 1, -Math.floor(array.length / 2)];
    };
    $http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getBrandList'
    }).then(function successCallback(response) {
        $scope.shopByBrandsListTop = response.data.data.brands;
        $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
        stop_waitMe();
        $('.waitMe_content').css('display', 'none');
    }, function errorCallback(response) {});
    $http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getProductRoomIdea'
    }).then(function successCallback(response) {
        $scope.shopProductRoomIdeaTop = response.data.data.ProductRoomIdea;
        $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
        stop_waitMe();
    }, function errorCallback(response) {});
	$http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/gettopCategorylist'
    }).then(function successCallback(response) {
        $scope.shopProductTopcat = response.data.data.Product;
        $('.megamenu  li:nth-child(' + 2 + ') ul').waitMe('hide');
        stop_waitMe();
    }, function errorCallback(response) {});
    $scope.fetchCart = function() {
        $http({
            method: 'GET',
            url: baseUrl + 'Controllerproducts/getCartItemsList'
        }).then(function successCallback(response) {
            $scope.ProductListInCart = response.data.data;
            $scope.TotalCost = 0;
            $('.popover').waitMe('hide');
            angular.forEach($scope.ProductListInCart, function(value, key) {
                value.productCost = parseInt(value.quantity) * parseFloat(value.cost);
                $scope.TotalCost = $scope.TotalCost + parseFloat(value.productCost);
            });
        }, function errorCallback(response) {
            $('.popover').waitMe('hide');
            console.log("error " + response);
        });
    };
    $scope.fetchCart();
    $scope.showToast = function(msg) {
        var toast = $mdToast.simple().textContent(msg).action('OK').highlightAction(false).highlightClass('md-accent').hideDelay(5000).position('top right');
        $mdToast.show(toast).then(function(response) {
            if (response == 'ok') {
                $mdToast.hide();
            }
        });
    };
    var confirm;
    $scope.showConfirm = function(ev) {
        confirm = $mdDialog.confirm().title(ev).ariaLabel('Lucky day').cancel('No').ok('Yes');
    };
    waitMe.run_waitMe($('.featuresLodingImg'), 1);
    $http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getShopFeaturesPro'
    }).then(function successCallback(response) {
        $scope.shopFeatureProducts = response.data.data.ShopFeature;
        $('.featuresLodingImg').waitMe('hide');
    }, function errorCallback(response) {
        $('.featuresLodingImg').waitMe('hide');
    });
	
	// Api for design features this week under design menu
    /*$http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getDesignFeaturesWeek' //for same execution api
    }).then(function successCallback(response) {
        $scope.designFeatureProducts = response.data.data.DesignFeature;
        $('.featuresLodingImg').waitMe('hide');
    }, function errorCallback(response) {
        $('.featuresLodingImg').waitMe('hide');
    });*/
	
    $http({
        method: 'GET',
        url: baseUrl + 'Controllerproducts/getDesignFeaturesWeek'
    }).then(function successCallback(response) {
        $scope.executionFeatureProducts = response.data.data.DesignFeature;
        $('.featuresLodingImg').waitMe('hide');
    }, function errorCallback(response) {
        $('.featuresLodingImg').waitMe('hide');
    });
	
	
	(function (cr) {
        var contactUsModel = function () {
            var self = this;
            self.userName = '';
            self.useremail = '';
            self.MobileNo = '';
            self.Comment = '';

        };
        cr.contactUsModel = contactUsModel;
    }(window.MansionlyApp));
	
	
    $scope.isLoggedinUserInfo = false;

    $scope.contactUsModel = new window.MansionlyApp.contactUsModel();

    $scope.setModelIndex = function () {

        $http({
            method: 'GET',
            url: baseUrl + 'Controllercustomer/getCurrentUserDetails'
        }).then(function successCallback(response) {

            if (response.data.data.isLogin) {
                $scope.contactUsModel.userName = response.data.data.customerName;
                $scope.contactUsModel.useremail = response.data.data.customerEmailid;
                $scope.contactUsModel.MobileNo = response.data.data.customer_phone;
                $scope.isLoggedinUserInfo = true;
            }
        }, function errorCallback(response) {
            console.log(response);
            $scope.isLoggedinUserInfo = false;
        });
    };
	
	$scope.contactUsSaveFooter = function () {
        waitMe.run_waitMe($('.contactUsLoaderfooter'), 1);
        ValidateIt_Footer();
		if ($('#contactUsFooter').bootstrapValidator('validate').has('.has-error').length) {
            //alert("error");
            //$('.contactUsLoaderfooter').waitMe('hide');
            //return;
        }
		/////////////////////////////////////////////////////////////////////////////////////////
		var str = $scope.contactUsModel.useremail;
		var inputarea = angular.element( document.querySelector( '#ContentEmailtxt' ) );
		
		if(str)
		{
			if(str.length == 0)
			{
				inputarea.addClass('get_started_error');
				$('.contactUsLoaderfooter').waitMe('hide');
				return false;
			}
			var n = str.indexOf("@");
			if(n == -1)
			{
				
				var spcpPosition = str.search(/[^a-z0-9]+|\s+/gmi);
				if(spcpPosition != -1) {
					inputarea.addClass('get_started_error');
					$('.contactUsLoaderfooter').waitMe('hide');
					return false;
				}
				if(str.length < 10 || str.length > 10)
				{
					inputarea.addClass('get_started_error');
					$('.contactUsLoaderfooter').waitMe('hide');
					return false;
				}
				if(phonenumber(str))
				{}
				else
				{
					inputarea.addClass('get_started_error');
					$('.contactUsLoaderfooter').waitMe('hide');
					return false;
				}
				/* var albcPosition = str.search(/[0-9 -()+]+$/);
				if(albcPosition == -1)
				{
					inputarea.addClass('get_started_error');
					$('.contactUsLoaderfooter').waitMe('hide');
					return false;
				} */
				
				$scope.contentinfotext = "Phone-started";
			}
			else
			{
				if(!validateEmails(str))
				{
					inputarea.addClass('get_started_error');
					$('.contactUsLoaderfooter').waitMe('hide');
					return false;
				}
				$scope.contentinfotext = "Email-started";
			}
		}
		else
		{
			inputarea.addClass('get_started_error');
			$('.contactUsLoaderfooter').waitMe('hide');
			return false;
		}
		/////////////////////////////////////////////////////////////////////////////////////////
        if ($('#contactUsFooter').bootstrapValidator('validate').has('.has-error').length) {
            //alert("error");
            $('.contactUsLoaderfooter').waitMe('hide');
            return;
        } else {
            //alert("success");
			if($scope.contentinfotext == "Phone-started")
			{   
			  $scope.user_phone = $scope.contactUsModel.useremail;
			  $scope.user_mail = '';
			}
			else
			{
				$scope.user_mail = $scope.contactUsModel.useremail;
			    $scope.user_phone = '';
			}
            var data = $.param({
                name: $scope.contactUsModel.userName,
                email: $scope.user_mail,
                mobile: $scope.user_phone,
                //designerDesc: $scope.contactUsModel.Comment,
				order_type:$scope.orderType,
                marketplace_comments: $scope.contactUsModel.Comment,
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
              $('.contactUsLoaderfooter').waitMe('hide');
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
                  $scope.showToast('Your request have been sent successfully');
                  //$scope.pop('success', '', 'your order save successfully.');
                  $scope.contactUsModel = '';
              }

			$('.contactUsLoaderfooter').waitMe('hide');
          })
          .error(function (data, status, header, config) {
              var err = '';
              $('.contactUsLoaderfooter').waitMe('hide');
          });

        }
    };
	
	function validateEmails(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
	}
	
	function phonenumber(inputtxt) {
		return inputtxt.match(/\d/g).length===10;
	}
	
    /*
     * Enquiry Form Controller Function
     *
     */

   $scope.contactUsSaveEnq = function () {
        waitMe.run_waitMe($('#contactUsLoaderenquiry_1'), 1);
        ValidateIt_Getstarted();

        if ($('#contactUsFormEnq').bootstrapValidator('validate').has('.has-error').length) {
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
	
	/*
	 * Under projects tab in main navigation fecth data from sample execution portfolio and bind.
	 */
	 
	$scope.sampleprojects = function(){
		$http({
			method: 'GET',
			url: baseUrl + 'Controllerexecution/getsampleExecutionPortfolioformainnavigation'
		}).then(function successCallback(response) {
		$scope.sampleexecutionportfolioformenu = response.data.data.SamplePortfolio;
		}, 
		function errorCallback(response){
			console.log(response);
		});
	};
    $scope.sampleprojects();
	
	$scope.furnituremenu = function(cat_id){
		$http({
			method: 'GET',
			url: baseUrl + 'Controllerproducts/getProductCatgList?cat_id='+cat_id
		}).then(function successCallback(response) {
			$scope.shoppingProdTop = response.data.data.ProductCatg;
			$('.megamenu  li:nth-child(' + 3 + ') ul').waitMe('hide');
			stop_waitMe();
		}, function errorCallback(response) {
			console.log(response)
		});
	};
	$scope.furnituremenu(2);
	
	$scope.decormenu = function(cat_id){
		$http({
			method: 'GET',
			url: baseUrl + 'Controllerproducts/getProductCatgList?cat_id=0'//+cat_id
		}).then(function successCallback(response) {
			$scope.shoppingProdDecor = response.data.data.ProductCatg;
			$('.megamenu  li:nth-child(' + 4 + ') ul').waitMe('hide');
			stop_waitMe();
		}, function errorCallback(response) {
			console.log(response)
		});
	};
	$scope.decormenu(3);
	
	$scope.showArrowMenu = function (selVal) {
		if(selVal == 1){
			if($scope.showMenuArrow1){
				$scope.showMenuArrow1 = false;
			} else {
				$scope.showMenuArrow1 = true;
			}
		} else if (selVal == 2){
			if($scope.showMenuArrow2){
				$scope.showMenuArrow2 = false;
			} else {
				$scope.showMenuArrow2 = true;
			}
		}
	}
	$scope.showHumbergerIcon = true;
	$scope.humburOrCloseIcon = function (selVal) {
		if(selVal == '2'){
			$scope.showHumbergerIcon = true;
		} else {
			$scope.showHumbergerIcon = false;
		}
	}
        
        
        $scope.contactUsSaveEnq = function () {
        waitMe.run_waitMe($('#contactUsLoaderenquiry_1'), 1);
		var error = false;
		var str = $scope.contactUsModelm.mailnphonem;
	//	var str_name = $scope.contactUsModelm.fname;
		var str_name = '';
		var inputarea = angular.element( document.querySelector( '#userinformation_1' ) );
		//var inputarea_name = angular.element( document.querySelector( '#username' ) );
		var inputarea_name = '';
//		if(!str_name)
//		{
//			inputarea_name.addClass('get_started_error');
//			error = true;
//		}
		if(str)
		{
			if(str.length == 0)
			{
                            cosole.log(str);
				inputarea.addClass('get_started_error');
				$('#contactUsLoaderenquiry').waitMe('hide');
				return false;
			}
			var n = str.indexOf("@");
			if(n == -1)
			{
				
				var spcpPosition = str.search(/[^a-z0-9]+|\s+/gmi);
				if(spcpPosition != -1) {
					inputarea.addClass('get_started_error');
					$('#contactUsLoaderenquiry_1').waitMe('hide');
					return false;
				}
				if(str.length < 10 || str.length > 10)
				{
					inputarea.addClass('get_started_error');
					$('#contactUsLoaderenquiry_1').waitMe('hide');
					return false;
				}
				if(phonenumber(str))
				{}
				else
				{
					inputarea.addClass('get_started_error');
					$('#contactUsLoaderenquiry_1').waitMe('hide');
					return false;
				}
				/* var albcPosition = str.search(/[0-9 -()+]+$/);
				if(albcPosition == -1)
				{
					inputarea.addClass('get_started_error');
					$('#contactUsLoaderenquiry_1').waitMe('hide');
					return false;
				} */
				
				$scope.contentinfotext = "Phone-started";
			}
			else
			{
				if(!validateEmail(str))
				{
					inputarea.addClass('get_started_error');
					$('#contactUsLoaderenquiry_1').waitMe('hide');
					return false;
				}
				$scope.contentinfotext = "Email-started";
			}
		}
		else
		{
			inputarea.addClass('get_started_error');
			$('#contactUsLoaderenquiry_1').waitMe('hide');
			return false;
		}
		
		if(error == true)
		{
			return false;
		}
            

		var data = $.param({
		   
			contactinfo: $scope.contactUsModelm.mailnphonem,
			contentinfo: $scope.contentinfotext,
			remote_address: $scope.ipAddressVal,
			formtitle: 'Mansionly - Contact',
		});
		var config = {
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		}

		$http.post(baseUrl + 'Controllercustomer/getstartedRequest', data, config)
	    .success(function(response) {
		/////////////////////////////////////////// save to order detail table /////////////////////////////////////
			if($scope.contentinfotext == "Phone-started")
			{   
			  $scope.user_phone = $scope.contactUsModelm.mailnphonem;
			  $scope.user_mail = '';
			}
			else
			{
				$scope.user_mail = $scope.contactUsModelm.mailnphonem;
			    $scope.user_phone = '';
			}
			var data = $.param({
				name: $scope.contactUsModelm.fname,
                email: $scope.user_mail,
				phone: $scope.user_phone,
				order_type:$scope.orderType,
				form_type: 'home_request',
				marketplace_comments: $scope.contactUsModelm.comment,
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
            //$('.designerContactLoader').waitMe('hide');
            //$('#designdesignerContactModel').modal('toggle');
            //if user already registered but not login
            //if (data.trimLeft() == "User is already registered" && (currLoginUserId == null || currLoginUserId == "")) {
            if (data.msg == "User is already registered" && (currLoginUserId == null || currLoginUserId == "")) {
					$scope.showToast('Please login first to save your orders');
					//setCookie("redirectToSameScreen", 'design/select/' + $scope.designId + '/'+ $scope.design_display_name + '', 30);
					document.location = baseUrl + 'signin?currEmailID=' + data.data.customer_username;
            } 
			else 
			{
					var result = data;
					$scope.showToast('your order saved successfully');
					$scope.contactUsModelm.mailnphonem = '';
			        $scope.contactUsModelm.fname = '';
					$scope.contactUsModelm.comment = '';

					/*$scope.designerContModel.fname = '';
					$scope.designerContModel.lname = '';
					$scope.designerContModel.email = '';
					$scope.designerContModel.telNo = '';
					$scope.designerContModel.designerDesc = '';
					$scope.designerContModel.timings = ''; */
					//var formcontainerclass = angular.element( document.querySelector( '.get_started_form' ) );
					//var msgcontainerclass  = angular.element( document.querySelector( '.get_started_form_Msg' ) );
					//formcontainerclass.addClass('hideform');
					//msgcontainerclass.addClass('showmsg');
					//msgcontainerclass.fadeOut(5000);
            }
			 $('#contactUsLoaderenquiry_1').waitMe('hide');
            })
            .error(function (data, status, header, config) {
              var err = '';
              $('#contactUsLoaderenquiry_1').waitMe('hide');
            });
			
		//////////////////////////////////////////////////////////////////////////////////////////////////////	
		/* var formcontainerclass = angular.element( document.querySelector( '.get_started_form' ) );
		var msgcontainerclass  = angular.element( document.querySelector( '.get_started_form_Msg' ) );
		formcontainerclass.addClass('hideform');
		msgcontainerclass.addClass('showmsg');
		msgcontainerclass.fadeOut(5000); */
		 
		 
	    })
	    .error(function (response,x,v) {
		  $('#contactUsLoaderenquiry_1').waitMe('hide');
	    });
        
    };

	
});


$(function() {
    $("#example-popover-2").mouseover(function() {
        angular.element($("#layoutCntr")).scope().productInCart();
    });
});
$(document).ready(function() {
    $('.navbar a.dropdown-toggle').on('click', function(e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');
        if (!$parent.parent().hasClass('nav')) {
            $el.next().css({
                "top": $el[0].offsetTop,
                "left": $parent.outerWidth() - 4
            });
        }
        $('.nav li.open').not($(this).parents("li")).removeClass("open");
        return false;
    });
    $('.navbar-toggle').on('click', function(e) {
        if ($("#myNavbar")[0].classList.value == "navbar-collapse collapse in") {
            $("#designPnlSmallScreen").hide();
            $("#executionPnlSmallScreen").hide();
            $("#shoppingPnlSmallScreen").hide();
            $("#servicesPnlSmallScreen").hide();
        }
    });
	setTimeout(function () {
		if ($(window).width() > 767) {
			check_ActiveLi();
		}
	 }, 1000);
});

function check_ActiveLi() {
    var setActiveMenuLi = localStorage.getItem("setActiveMenuLi");
    //if (breadCrumbVal[1].pageName == "" || breadCrumbVal.length == 1)
    if (location.pathname == "/") {
        setActiveMenuLi = ""
    }

    if (setActiveMenuLi) {

        if (setActiveMenuLi == 'designPnlLi') {
            $('#designPnlLi a').addClass('active');
            $('#projectsPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#userNamePnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');
        }
        else if (setActiveMenuLi == 'projectsPnlLi') {
            $('#projectsPnlLi a').addClass('active');
            $('#designPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#userNamePnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');
        }
        else if (setActiveMenuLi == 'executionPnl') {
            //$('#shoppingPnlLi a').addClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#designPnlLi a').removeClass('active');
            $('#projectsPnlLi a').removeClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#userNamePnlLi a').removeClass('active');
            $('#executionPnl a').addClass('active');

        }
        else if (setActiveMenuLi == 'shoppingPnl') {
            $('#shoppingPnl a').addClass('active');
            $('#designPnlLi a').removeClass('active');
            $('#projectsPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#userNamePnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');
        }

        else if (setActiveMenuLi == 'aboutPnlLi') {
            $('#aboutPnlLi a').addClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#designPnlLi a').removeClass('active');
            $('#projectsPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#userNamePnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');
           
        }

        else if (setActiveMenuLi == 'userNamePnlLi') {
            $('#userNamePnlLi a').addClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#designPnlLi a').removeClass('active');
            $('#projectsPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');

        }
        else {
            $('#userNamePnlLi a').removeClass('active');
            $('#aboutPnlLi a').removeClass('active');
            $('#shoppingPnl a').removeClass('active');
            $('#designPnlLi a').removeClass('active');
            $('#projectsPnlLi a').removeClass('active');
            //$('#shoppingPnlLi a').removeClass('active');
            $('#executionPnl a').removeClass('active');
        }

    }
};


