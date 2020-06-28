$(document).ready(function(e) {
	fullSize();
	
$(window).resize(function() {
	fullSize();
    applyOrientation();
})	
	
	
	
	
$("a.liactive ").hover(function(){
	$("a.liactive ").removeClass("active");
	$(this).addClass("active");
	
})


$(".fitrDrop  ").hover(function(){
		$(".fitrDrop  ").removeClass("active");
		$(this).addClass("active");
	})




$(".profile-nav ul li ").click(function(){
	$(".profile-nav ul li ").removeClass("active");
	$(this).addClass("active");
	
})



$(".howit-top ul li ").click(function(){
	$(".howit-top ul li ").removeClass("active");
	$(this).addClass("active");
	
})	

$("#flip").click(function(){
   $("#panel").slideToggle(500);
});

$(".frtpass").click(function(){
   $(".forgotPasspanel").slideToggle(250);
});


$(".menuBtn").click(function(e) {
    $("body").toggleClass("menuOpen");
	$(this).toggleClass("iconchnage")
});


$(".catogory-nav-slider .item ").click(function(){
	$(".catogory-nav-slider .item ").removeClass("active");
	$(this).addClass("active");
	
})

$("ul.introExcut-gall li  ").hover(function(){
	$("ul.introExcut-gall li  ").removeClass("active");
	$(this).addClass("active");
	
})



$(".ContctBtn").click(function(e) {
	$("body").toggleClass("ContctPanel");
   // $(this).toggleClass("iconchnage");
	 $('#mc_embed_signup').toggleClass('cls_mc_embed_signup_open');
});



$(".menuBtn").click(function(){
   $("#panel").hide(200);
});


  /*$('body').append('<div id="toTop" class="btn"><span class="fa fa-angle-up"></span></div>');
    	$(window).scroll(function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		}); */
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1200);
        return false;
    });

var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   var stopSetTimeout;
   if (st > lastScrollTop || st<=0){
       // downscroll code 
	  // console.log('down');
	  $('#toTop').hide();
   } else {
      // upscroll code
	  // console.log('up');
	  clearTimeout(stopSetTimeout);
	 $('#toTop').show();
      stopSetTimeout = setTimeout(function(){$('#toTop').hide()},5000);
	  
   }
  
   lastScrollTop = st;
});


/*-------------------------------Home Banner----------------------------------------*/

$('#MatchSlide').owlCarousel({
        /*center: true,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: false,
        mouseDrag: true,
         smartSpeed: 3500,
        autoplayTimeout:5000,
        //animateIn:'fadeIn ',
        animateOut:'fadeOut',
        dots: false,*/
		
		loop:true,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn',
				items:1,
				nav:true,
				margin:0,
				dots:false,
				mouseDrag:false,
				autoplay:true,
				autoplayTimeout:5000,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })
	
	
	$('#SectorsSlider').owlCarousel({
        center: false,
        loop: true,
        margin:0,
        autoplay: true,
        nav: true,
        mouseDrag: true,
         smartSpeed: 2500,
        autoplayTimeout:5000,
        //animateIn:'fadeIn ',
        //animateOut:'fadeOut',
        dots: false,
        navText: [
          "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            }
           
        }
    })
	
	$('#designerboard, #designerboard01, #newsFeedSlider').owlCarousel({
        center: false,
        loop: true,
        margin:15,
        autoplay: true,
        nav: false,
        mouseDrag: true,
        smartSpeed: 500,
        autoplayTimeout:3000,
        //animateIn:'fadeIn ',
        //animateOut:'fadeOut',
        dots: false,
        navText: [
            "<i class='fa fa-long-arrow-left'></i>",
            "<i class='fa fa-long-arrow-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				 nav: false,
			
					
            },
          
            575: {
				items: 2,
			
			
            },
			1024: {
				items: 3,
            },
            1170: {
				items: 1,
				
            }
           
        }
    })
	
	$('#Projects-Brands').owlCarousel({
        center: false,
        loop: true,
        margin:0,
        autoplay: true,
        nav: false,
        mouseDrag: true,
         smartSpeed: 3000,
        autoplayTimeout:5500,
        //animateIn:'fadeIn ',
        //animateOut:'fadeOut',
        dots: false,
        navText: [
            "<i class='fa fa-long-arrow-left'></i>",
            "<i class='fa fa-long-arrow-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				 nav: false,
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            }
           
        }
    })
	
	
	
	$('.owl-demo').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: false,
        nav: true,
        mouseDrag: true,
        /*smartSpeed: 2500,
        autoplayTimeout:2000,
         animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				autoplay: false,
				dots: false,
				nav: true
					
            },
          
           768: {
				items: 1,
				autoplay: false,
				dots: false,
				nav: true					
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
	//onTranslated:callBackExecutionSlider	

    })
    
//      function callBackExecutionSlider(){
//          if($('.owl-demo .owl-item').last().hasClass('active')){
//                $('.owl-demo .owl-next').hide();
//                $('.owl-demo .owl-prev').show(); 
//                console.log('true');
//             }else if($('.owl-demo .owl-item').first().hasClass('active')){
//                $('.owl-demo .owl-prev').hide(); 
//                $('.owl-demo .owl-next').show();
//                console.log('false');
//             }
//        }
//       $('.owl-demo .owl-prev').hide();
		
	
	
	$('#owl-demo01').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: true,
        mouseDrag: true,
        smartSpeed: 2500,
        autoplayTimeout:2000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				/*autoplay: true,
				dots: true,
				nav: true,*/
				
					
            },
          
           768: {
				items: 1,
				/*autoplay: false,
				dots: false,
				nav: true,*/
				
					
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
		
    })
	
	
$('#profileDtl-slide').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: true,
        mouseDrag: true,
        smartSpeed: 2500,
        autoplayTimeout:2000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
					
            },
          
            600: {
				items: 1,
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
		
    })	
  
	
	$('#brandss').owlCarousel({
        center: false,
        loop: false,
        margin: 60,
        autoplay: false,
        nav: false,
        mouseDrag: false,
        smartSpeed: 2500,
        autoplayTimeout:3000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				autoplay: true,
				dots: true,
				margin: 10,
					
            },
          
            600: {
				items: 3,
				autoplay: true,
				dots: true,
				margin: 10,
			
            },
            1170: {
				items: 4,
				
            },
            1920: {
                items: 4,
				
            }
        }
		
    })	





	$('#MageZineMobile').owlCarousel({
        center: false,
        loop: false,
        margin: 10,
        autoplay: false,
        nav: false,
        mouseDrag: false,
        smartSpeed: 250,
        autoplayTimeout:5000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				autoplay: true,
				dots: true,
				animateIn:false,
				animateOut:false,
					
            },
          
            600: {
				items: 1,
				autoplay: true,
				dots: true,
				animateIn:false,
				animateOut:false,
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
		
    })	



$('#WorkOrder').owlCarousel({
        center: false,
        loop: false,
        margin: 0,
        autoplay: false,
        nav: true,
        mouseDrag: false,
        smartSpeed: 250,
        autoplayTimeout:5000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				autoplay: true,
				dots: false,
				margin: 10,
				
					
            },
          
            600: {
				items: 3,
				autoplay: true,
				dots: false,
				margin: 10,
							
            },
            1170: {
				items: 5,
				
            },
            1920: {
                items: 5,
				
            }
        }
		
    })	
	
	
	
	
$('#Brand-v1-slider').owlCarousel({
        center: true,
        loop: false,
        margin: 0,
        autoplay: false,
        nav: false,
        mouseDrag: false,
         smartSpeed:1000,
        autoplayTimeout:2000,
        //animateIn:'fadeIn ',
        animateOut:'fadeOut',
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })
	
$('#Brand-v1-slider_1').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay:true,
        nav: true,
        mouseDrag: false,
         smartSpeed: 1000,
        autoplayTimeout:1500,
        //animateIn:'fadeIn ',
        animateOut:'fadeOut',
        dots: false,
        navText: [
            "<span class='flaticon-back'></span>",
            "<span class='flaticon-next'></span>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        },
      onTranslated:callBackBrandSlider

    });
    
    function callBackBrandSlider(){
          if($('#Brand-v1-slider_1 .owl-item').last().hasClass('active')){             
                $('#Brand-v1-slider_1 .owl-next').hide();
                $('#Brand-v1-slider_1 .owl-prev').show(); 
                console.log('true');
             }else if($('#Brand-v1-slider_1 .owl-item').first().hasClass('active')){
                $('#Brand-v1-slider_1 .owl-prev').hide(); 
                $('#Brand-v1-slider_1 .owl-next').show();
                console.log('false');
             }
             if($('#Brand-v1-slider_1 .owl-item').length<=1){
                 $('#Brand-v1-slider_1 .owl-prev').hide(); 
                 $('#Brand-v1-slider_1 .owl-next').hide();
             }
             console.log($('#Brand-v1-slider_1 .owl-item').length);
        }
       // $('#Brand-v1-slider_1 .owl-prev').hide();
	callBackBrandSlider();
$('.Brand-lisfStyle-Banner').owlCarousel({
        center: true,
        loop: false,
        margin: 0,
        autoplay: true,
        nav: false,
        mouseDrag: false,
         smartSpeed: 2500,
        autoplayTimeout:5000,

        //animateIn:'fadeIn ',
        animateOut:'fadeOut',
        dots: false,
        navText: [
             "<span class='flaticon-back'></span>",
            "<span class='flaticon-next'></span>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 1,
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })	
		
		
		
$('#productDetail-Thumb').owlCarousel({
        center: false,
        loop: false,
        margin: 28,
        autoplay: false,
        nav: true,
        mouseDrag: false,
        //smartSpeed: 2000,
        //autoplayTimeout:2000,
         /*animateIn:'fadeIn',
         animateOut:'fadeOut',*/
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 3,
				autoplay: true,
				dots: false,
				margin: 5,
				nav: false,
				margin: 10
					
            },
          
            600: {
				items: 4,
				autoplay: true,
				dots: true,
				margin: 5,
				nav: false
			
            },
            1170: {
				items: 6,
				
            },
            1920: {
                items: 6,
				
            }
        },     
	onTranslated:callBack
		
    });
    
    
    function callBack(){
          if($('#productDetail-Thumb .owl-item').last().hasClass('active')){
                $('#productDetail-Thumb .owl-next').hide();
                $('#productDetail-Thumb .owl-prev').show(); 
                console.log('true');
             }else if($('#productDetail-Thumb .owl-item').first().hasClass('active')){
                $('#productDetail-Thumb .owl-prev').hide(); 
                $('#productDetail-Thumb .owl-next').show();
                console.log('false');
             }
        }
        $('#productDetail-Thumb .owl-prev').hide();
    
      /*[start::Code to hide next and pre button in image slider]*/ 
        var viewport = jQuery(window).width();
        var itemCount = jQuery("#productDetail-Thumb li").length;

        if(
            (viewport >= 900 && itemCount > 6) //desktop
            || ((viewport >= 600 && viewport < 900) && itemCount > 3) //desktopsmall
            || ((viewport >= 479 && viewport < 600) && itemCount > 3) //tablet
           // || (viewport < 479 && itemCount > 3) //mobile
        )
        {
            $('#productDetail-Thumb .owl-next').show();
			//$('.ViewMoreSilder .owl-next').show();
        } 
        else
        {
            
            $('#productDetail-Thumb .owl-next,#productDetail-Thumb .owl-prev').hide();
			//$('.ViewMoreSilder .owl-next,#productDetail-Thumb .owl-prev').hide();

        }
       /*[End::Code to hide next and pre button in image slider]*/ 
	
	
	$('#ViewMoreSilder').owlCarousel({
        center: false,
        loop: false,
        margin: 30,
        autoplay: false,
        nav: true,
        mouseDrag: false,
         smartSpeed: 2500,
        autoplayTimeout:2000,
        //animateIn:'fadeIn ',
        //animateOut:'fadeOut',
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 3,
			
			
            },
            1170: {
				items: 3,
				
            },
            1920: {
                items: 3,
				
            }
        },
       onTranslated:callBackForProductSlider
    });
    
   function callBackForProductSlider(){
          if($('#ViewMoreSilder .owl-item').last().hasClass('active')){
                $('#ViewMoreSilder .owl-next').hide();
                $('#ViewMoreSilder .owl-prev').show(); 
                console.log('true');
             }else if($('#ViewMoreSilder .owl-item').first().hasClass('active')){
                $('#ViewMoreSilder .owl-prev').hide(); 
                $('#ViewMoreSilder .owl-next').show();
                console.log('false');
             }
        }
        $('#ViewMoreSilder .owl-prev').hide();
		
		
		
$('#Catogory-navSlider').owlCarousel({
        center: false,
        loop: false,
        margin: 20,
        autoplay: false,
        nav: true,
        mouseDrag: false,
         smartSpeed: 500,
       // autoplayTimeout:2500,
        //animateIn:'fadeIn ',
        //animateOut:'fadeOut',
        dots: false,
        navText: [
            "<span class='flaticon-back'></span>",
            "<span class='flaticon-next'></span>"
        ],
        responsive: {
            320: {
				items: 1,
			
					
            },
          
            600: {
				items: 3,
			
			
            },
            1170: {
				items: 6,
				
            },
            1920: {
                items: 6,
				
            }
        },
       onTranslated:callBackForProductListingSlider
    });
    
   function callBackForProductListingSlider(){
          if($('#Catogory-navSlider .owl-item').last().hasClass('active')){
                $('#Catogory-navSlider .owl-next').hide();
                $('#Catogory-navSlider .owl-prev').show(); 
                console.log('true');
             }else if($('#Catogory-navSlider .owl-item').first().hasClass('active')){
                $('#Catogory-navSlider .owl-prev').hide(); 
                $('#Catogory-navSlider .owl-next').show();
                console.log('false');
             }
        }
        $('#Catogory-navSlider .owl-prev').hide();		


/*[start::Code to hide next and pre button in image slider]*/ 
       
        var cat_itemCount = jQuery("#Catogory-navSlider .count").length;
        
        if(
            (viewport >= 900 && cat_itemCount > 6) //desktop
            || ((viewport >= 600 && viewport < 900) && cat_itemCount > 3) //desktopsmall
            || ((viewport >= 479 && viewport < 600) && cat_itemCount > 3) //tablet
           // || (viewport < 479 && itemCount > 3) //mobile
        )
        {
          
            $('#Catogory-navSlider .owl-next').show();
        } 
        else
        {
            
            $('#Catogory-navSlider .owl-next,#Catogory-navSlider .owl-prev').hide();

        }
       /*[End::Code to hide next and pre button in image slider]*/ 
		
	
	
	

	
/*-------------------------------Home Banner----------------------------------------*/


/*-------------------------------MegaMenu----------------------------------------*/

	$('.megamenu').width($(window).width() * 80 / 100);
	$(document).bind('contextmenu', function (e) {
		// e.preventDefault();
	});
	$('.megamenu').hover(function () {
		$($('.megamenu').parent()).children().removeClass('dropFocus');
		$($(this).parent()).children().addClass('dropFocus');
		$('.megamenu').removeClass('dropFocus');
	});
	$(".megamenu").mouseleave(function () {
		$($('.megamenu').parent()).children().removeClass('dropFocus');
		$('.megamenu').parent().removeClass('active');
		$('.megamenu').parent().removeClass('focus');
		$('.megamenu').parent().removeClass('open');
	});
     
/*-------------------------------MegaMenu----------------------------------------*/

 /*-------------------------------Dropdown Hover--------------------------------------*/
 $(" .header-right-menu .dropdown").hover(
		function () {
			$('.dropdown-menu', this).stop().fadeIn("fast");
		},
		function () {
			$('.dropdown-menu', this).stop().fadeOut("fast");
		});

	$('.side-panel-drop-menu').hover(
		function () {
			$('.dropdown-menu', this).stop().fadeIn("fast");
		},
		function () {
			$('.dropdown-menu', this).stop().fadeOut("fast");
		});
		
 /*$(" .header-right-menu .dropdown").click(
		function () {
			$('.dropdown-menu', this).stop().fadeIn("fast");
		},
		function () {
			$('.dropdown-menu', this).stop().fadeOut("fast");
		});

	$('.side-panel-drop-menu').click(
		function () {
			$('.dropdown-menu', this).stop().fadeIn("fast");
		},
		function () {
			$('.dropdown-menu', this).stop().fadeOut("fast");
		});	*/	
		
  
 /*-------------------------------Dropdown Hover-----------------------------------------*/ 
 
 /*-------------------------------Div Hide-----------------------------------------*/ 
 /* $("#execution_gallary").hover(function(){
  $(".projectexecution").text("Premium residences executed by our partners");
  $("#project0").css('display','block');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
  $("#project4").css('display','none');
  $("#project5").css('display','none');
  $("#project6").css('display','none');
  $("#project7").css('display','none');
 });*/ 
    
 
 
  
  $("#projectlink0").hover(function(){
  $(".projectexecution").text("Premium residences executed by our partners");
  $("#project0").css('display','block');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
  $("#project4").css('display','none');
  $("#project5").css('display','none');
  $("#project6").css('display','none');
  $("#project7").css('display','none');
  $("#project8").css('display','none');
 });
 
 $("#projectlink1").hover(function(){
  $(".projectexecution").text("Global inspirations executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','block');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
                $("#project4").css('display','none');
                $("#project5").css('display','none');
                $("#project6").css('display','none');
                $("#project7").css('display','none');
                $("#project8").css('display','none');

 });
 
 $("#projectlink2").hover(function(){
  $(".projectexecution").text("Luxury hotels executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','block');
  $("#project3").css('display','none');
                $("#project4").css('display','none');
                $("#project5").css('display','none');
                $("#project6").css('display','none');
                $("#project7").css('display','none');
                $("#project8").css('display','none');
 });
 
 $("#projectlink3").hover(function(){
  $(".projectexecution").text("Commercial designs executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','block');
                $("#project4").css('display','none');
                $("#project5").css('display','none');
                $("#project6").css('display','none');
                $("#project7").css('display','none');
                $("#project8").css('display','none');
 });
        
        $("#projectlink4").hover(function(){
  $(".projectexecution").text("Retail executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
                $("#project4").css('display','block');
                $("#project5").css('display','none');
                $("#project6").css('display','none');
                $("#project7").css('display','none');
                $("#project8").css('display','none');
 });
           $("#projectlink5").hover(function(){
  $(".projectexecution").text("Office Space executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
                $("#project4").css('display','none');
                $("#project5").css('display','block');
                $("#project6").css('display','none');
                $("#project7").css('display','none');
                $("#project8").css('display','none');
 });

$("#projectlink6").hover(function(){
  $(".projectexecution").text("Restaurant executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
                $("#project4").css('display','none');
                $("#project5").css('display','none');
                $("#project6").css('display','block');
                $("#project7").css('display','none');
                $("#project8").css('display','none');
 });
           $("#projectlink7").hover(function(){
  $(".projectexecution").text("Spas & Clubs executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
                $("#project4").css('display','none');
                $("#project5").css('display','none');
                $("#project6").css('display','none');
                $("#project7").css('display','block');
                $("#project8").css('display','none');
 });
 
  $("#projectlink8").hover(function(){
  $(".projectexecution").text("Projects executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
  $("#project4").css('display','none');
  $("#project5").css('display','none');
  $("#project6").css('display','none');
  $("#project7").css('display','none');
  $("#project8").css('display','block');
 });
  $("#execution_gallary").hover(function(){
  $(".projectexecution").text("Projects executed by our partners");
  $("#project0").css('display','none');
  $("#project1").css('display','none');
  $("#project2").css('display','none');
  $("#project3").css('display','none');
  $("#project4").css('display','none');
  $("#project5").css('display','none');
  $("#project6").css('display','none');
  $("#project7").css('display','none');
  $("#project8").css('display','block');
  $("#projectlink0").parent().removeClass('active');
  $("#projectlink1").parent().removeClass('active');
  $("#projectlink2").parent().removeClass('active');
  $("#projectlink3").parent().removeClass('active');
  $("#projectlink4").parent().removeClass('active');
  $("#projectlink5").parent().removeClass('active');
  $("#projectlink6").parent().removeClass('active');
  $("#projectlink7").parent().removeClass('active');
  $("#projectlink8").parent().addClass('active');

 });
  
/*--------------------------------Div Hide-----------------------------------------*/

/* --------------------------------sticky-header-----------------------------------------*/ 
jQuery(window).scroll(function(){
	  var sticky = $('body'),
		  scroll = $(window).scrollTop();
	
	  if (scroll >= 250) sticky.addClass('sticky-header');
	  else sticky.removeClass('sticky-header');
});



	
/*--------------------------------sticky-header-----------------------------------------*/ 


/*--------------------------------sticky-Footer-----------------------------------------*/ 	
$(window).bind("load", function () {
    var footer = $("#footer");
    var pos = footer.position();
    var height = $(window).height();
    height = height - pos.top;
    height = height - footer.height();
    if (height > 0) {
        footer.css({
            'margin-top': height + 'px'
        });
    }
});	

$(window).scroll(function(event) {
	function footer()
    {
        var scroll = $(window).scrollTop(); 
        if(scroll > 50)
        { 
            $(".NewHomepageFooter").fadeIn("slow").addClass("showft");
			
        }
        else
        {
            $(".NewHomepageFooter").fadeOut("slow").removeClass("showft");
			
        }
        
        clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function() {
            if ($('.NewHomepageFooter').is(':hover')) {
	        	footer();
    		}
            else
            {
            	$(".NewHomepageFooter").fadeOut("slow");
		
            }
		}, 3000));
    }
    footer();
});
	
/* --------------------------------sticky-Footer-----------------------------------------*/


$('#designer').hover(function () {
     $('#designer_block').show();
     $('#execution_block').hide();
     $('#lifestyle_block').hide();
	 $('body').removeClass('menuOpen');

  });
  $('#execution_gallary').hover(function () {
     $('#designer_block').hide();
     $('#execution_block').show();
     $('#lifestyle_block').hide();
	 $('body').removeClass('menuOpen');
  }); 
  
   $('#lifestyle').hover(function () {
     $('#designer_block').hide();
     $('#execution_block').hide();
     $('#lifestyle_block').show();
	 $('body').removeClass('menuOpen');
  }); 
  
  
$(document).click(function(e){
    var myTarget = "header-right-menu-mobileNew";
 var myTarget2="icon-lnr-menu";
  var myTarget3="dropdown-backdrop";
    var clicked = e.target.className;
    if($.trim(myTarget) != '') {
 
        if( myTarget == clicked || myTarget2 == clicked || myTarget3 == clicked) {

        }else{
 $("body").removeClass("menuOpen"); 
 }
   }
});




	jQuery(function(){
         jQuery('#showall').click(function(){
             jQuery('.targetDiv').show();
     });
        jQuery('.showSingle').click(function(){
		  	jQuery('.targetDiv').hide();	
			jQuery('.targetDiv').removeClass('active');
		   	jQuery('#div'+$(this).attr('target')).show();
				jQuery('#div'+$(this).attr('target')).addClass('active');
			//jQuery('#div'+$(this).attr('target')).addClass('active');
			//jQuery(this).toggleClass('CrossIcon');
        });
});


	
});


/* --------------------------------Responsive-Orientation----------------------------------------*/
	function applyOrientation() {
		$( window).resize(function(e) {
		if (window.innerHeight > window.innerWidth) {
			$("body").addClass("potrait");
			$("body").removeClass("landscape");
		} else {
			$("body").addClass("landscape");
			$("body").removeClass("potrait");
		}
		 });
	}

/* --------------------------------Responsive-Orientation-----------------------------------------*/

function fullSize() {
    var heights = window.innerHeight;
    jQuery(".fullHt").css('min-height', (heights + 0) + "px");
}	




/*$(function(){
	$('.singlediv-show').click(function(e) {
		 $('.target-div').removeClass('active'); 
		 $('#divpanel'+(this).attr('target')).addClass('active');  
    });	
});*/

/*jQuery('.bxslider').bxSlider({
  pagerCustom: '#bx-pager'
});*/  

/*jQuery('#bxsliderVerti').bxSlider({
	mode: 'vertical',
	slideMargin: 5,
	minSlides:3,
	maxSlides:3,
	pager:false
	
});*/


/* start:: save/delete Favorite */
function saveFavorite(pageName,favoritesType,id){
    
    if (currLoginUserId == "" || currLoginUserId == null || currLoginUserId == undefined) {
            toastr.error('Please login first to save your favorite '+pageName+'.');
            document.location = baseUrl + 'signin';
        } else {
            var data = $.param({
            customer_id: currLoginUserId,
            favorites_type: favoritesType,
            favorites_record_id: id,
        });
          $.ajax({
          type:"post",
          url:baseUrl+"Cn_customer/SaveCustomerFavorite",
          data:data,
          success:function(data){
                if(data=="saved")
		   {
				toastr.success('Your favorite '+pageName+' saved successfully');
				//$('#forgotPassword').waitMe('hide');
                                $('#'+favoritesType+id).addClass('heartRed');
                                console.log($(this));
		   }
		   else if(data=='removed')
		   {
				toastr.success('Your favorite '+pageName+' removed successfully');
                                  $('#'+favoritesType+id).removeClass('heartRed');
				//$('#forgotPassword').waitMe('hide');
				//document.location = baseUrl + 'signin?currEmailID=' + $('#forgotPassUsername').val();
		   }else{
                       toastr.error('Error !!!');
                   }
          },
          error:function(response){
              toastr.error ('Error !!!');
          }
      });
        }
}
/* end:: save/delete Favorite */






//$(document).ready(function(){
//    $('.ln-letters').hide();
// /*Start :: Script for case-insensitive contains match*/  
//// New selector
//jQuery.expr[':'].Contains = function(a, i, m) {
// return jQuery(a).text().toUpperCase()
//     .indexOf(m[3].toUpperCase()) >= 0;
//};
//
//// Overwrites old selecor
//jQuery.expr[':'].contains = function(a, i, m) {
// return jQuery(a).text().toUpperCase()
//     .indexOf(m[3].toUpperCase()) >= 0;
//};
///*End :: Script for case-insensitive contains match*/ 
//
//var list = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
//  
//        /*Start::Search operation*/
//        $('.search').keyup(function(){
//        var keyword = $(this).val();
//        $("#demoOne a.name").parent('li').css('display','block');
//        $("#demoOne a.name:not(:contains('"+keyword+"'))").parent('li').css('display','none');
//       for(var i=0;i<list.length;i++){
//         if($('#demoOne li.ln-'+list[i]+' a:visible').length<1){
//             $('#demoOne li.ln-'+list[i]+' strong').parent().css('display','none');
//             $('.alphabets a.'+list[i]).addClass('disabled');
//         }else{
//             $('#demoOne li.ln-'+list[i]+' strong').parent().css('display','block');
//            $('.alphabets a.'+list[i]).removeClass('disabled');
//         }
//        // console.log(list[i]+' '+$('li.ln-'+list[i]+':visible').length);
//       }
//        getPositions();
//    });
//    /*End :: Search operation*/
//    
//    $(".alphabets a").click(function(){
//        
//        var position = $(this).attr('data-position');
//        var classTag = $(this).attr('data-index');
//      // console.log(position);
//       
//       if($('#demoOne li.ln-'+classTag+':visible').length>=1){
////        $('#demoOne').scrollLeft(position);
//        $('#demoOne').animate({ scrollLeft: position }, 500);
//        
//       }
//       
//       if(classTag==='All'){
//           $('.search').val('');
//           $('#demoOne').scrollLeft('0');
//         $('.search').keyup();
//          
//       }
//        
//    });
//    
//	 $('#brand_tab').one('click',function(){
//  
//   setTimeout(function() {$('#demoOne').scrollLeft('0'); $('.search').keyup(); }, 300);
//  
// });
////    $('.search').keyup();
////    getPositions();
//    
// /*Start:: mobile*/
//        $('.mobile_search').keyup(function(){
//        var keyword = $(this).val();
//       // alert(keyword);
//        $("#demoTwo a.name").parent('li').css('display','block');
//        $("#demoTwo a.name:not(:contains('"+keyword+"'))").parent('li').css('display','none');
//       for(var i=0;i<list.length;i++){
//         if($('#demoTwo li.ln-'+list[i]+' a:visible').length<1){
//             $('#demoTwo li.ln-'+list[i]).css('display','none');
//             $('.Mbrand-verticle-alphabet a.'+list[i]).addClass('disabled');
//         }else{
//             $('#demoTwo li.ln-'+list[i]).css('display','block');
//            $('.Mbrand-verticle-alphabet a.'+list[i]).removeClass('disabled');
//         }
//        // console.log(list[i]+' '+$('li.ln-'+list[i]+':visible').length);
//       }
//        mbl_getPositions();
//    });
//    
//    $(".Mbrand-verticle-alphabet a").click(function(){
//        
//        var position = $(this).attr('data-position');
//        var classTag = $(this).attr('data-index');
//      // console.log(position);
//       
//       if($('#demoTwo li.ln-'+classTag+':visible').length>=1){
////        $('#demoOne').scrollLeft(position);
//        $('#demoTwo').animate({ scrollTop: position }, 500);
//        
//       }
//       
//       if(classTag==='All'){
//           $('.mobile_search').val('');
//           $('#demoTwo').scrollTop('0');
//         $('.mobile_search').keyup();
//          
//       }
//        
//    });
//     $('#mobile_brand_tab').one('click',function(){
//  
//   setTimeout(function() {$('#demoTwo').scrollTop('0'); $('.mobile_search').keyup(); }, 300);
//  
// });
//    
//    /*End :: mobile*/   
// 
//    
//});
//
//function getPositions(){
//    $(".alphabets a").each(function(){
//        
//        var position=0;
//        var classTag = $(this).attr('data-index');
//       
//        if(classTag!='All' && $('li.ln-'+classTag).length>0){
//            
//        position = $('li.ln-'+classTag).first().position();
//        $(this).attr('data-position',position.left);
//        
//        }else{
//          $(this).attr('data-position','0');  
//        }
//         console.log(classTag+"=>"+position.left);
//    });
//}
//function mbl_getPositions(){
//    $(".Mbrand-verticle-alphabet a").each(function(){
//        var position=0;
//        var classTag = $(this).attr('data-index');
//        
//        if(classTag!='All' && $('#demoTwo li.ln-'+classTag).length>0){
//            
//        position = $('#demoTwo li.ln-'+classTag).first().position();
//        $(this).attr('data-position',position.top);
//        
//        }else{
//          $(this).attr('data-position','0');  
//        }
//        console.log(classTag+"=>"+position.top);
//        
//    });
//}




