$(document).ready(function(e) {
	fullSize();
	


$('.loop-center').owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:100,
	autoplay: true,
	autoplayTimeout: 1000,
		autoplaySpeed: 2500,
	nav: true,
	//smartSpeed: 1000,
	dots:false,
    responsive:{
        1170:{
            items:2
        },
		
		 320:{
            items:1,
			 center: false,
			 dots:true
        },
		
		 991:{
            items:2,
			dots:true
        }
		
	    }
});


$('#Rs-explore-product-slider, #Rs-explore-product-slider-mobile ').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
		autoplayTimeout: 1000,
		autoplaySpeed: 2500,
        nav: true,
        mouseDrag: true,
        smartSpeed:500,
               dots: true,
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
	
	
	
	$('#sambonet-luxslider').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
		autoplayTimeout: 1000,
		autoplaySpeed: 2500,
        nav: true,
        mouseDrag: true,
        //smartSpeed:100,
       	dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				dots: true,
				nav: false
			
					
            },
          
            600: {
				items: 1,
				dots: true,
				nav: false
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })
	
	
	
	$('.Versace_Slider').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: true,
        mouseDrag: true,
       autoplayTimeout: 1000,
		autoplaySpeed: 2500,
       	dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				dots: true,
				nav: false
			
					
            },
          
            600: {
				items: 1,
				dots: true,
				nav: false
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })
	
	
	
	
	$('.robertoventure_Slider, .robertoventure_Slider-mobile ').owlCarousel({
        center: true,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: false,
        mouseDrag: true,
       autoplayTimeout: 1000,
		autoplaySpeed: 2500,
       	dots: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            320: {
				items: 1,
				dots: true,
				nav: false
			
					
            },
          
            600: {
				items: 1,
				dots: true,
				nav: false
			
			
            },
            1170: {
				items: 1,
				
            },
            1920: {
                items: 1,
				
            }
        }
    })













});



