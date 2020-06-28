//<!--[start:: Load more product for Functionality]-->
$(document).ready(function(){
  $('#loadMoreProduct').mouseenter(function(){
   $('#loadMoreProduct').hide();
   $('#product_loader').show();
   
    var offset = parseInt($('#product_offset').val());
    var totalCount = $('#totalProductCount').val();
    var customerFavoriteProduct = $('#customerFavoriteProduct').val();
    var search_keyword = $('#search_keyword').val();
    var brand_id = $('#selected_brand').val();
    var soh_id = $('#selected_soh').val();
    var cor = $('#selected_cor').val();
    var product_id = $('#product_id').val();
    var highlighted_keyword = $('#highlighted_keyword').val();
    var char_limit = $('#char_limit').val();
    
    url = "Cn_search/ajaxProductList";   
       
    $.ajax({
        url:baseUrl+url,
        type:"post",
        data:{'offset':offset,'search_keyword':search_keyword,'brand_id':brand_id,'soh_id':soh_id,'cor':cor,'highlighted_keyword':highlighted_keyword,'customerFavoriteProduct':customerFavoriteProduct,'product_id':product_id,'char_limit':char_limit},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append_product').append(data[1]);
            $('#product_offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMoreProduct").hide();
            }else{
                 $('#loadMoreProduct').show();
            }
            $('#product_loader').hide();

        },
        error: function(e){
            $('#product_loader').hide();
            alert('Please relode the page.');
        }
        
    });
});
 // execution_portfolio();
});

//<!--[End:: Load product more Functionality ]-->

//<!--[start:: Load more Designer for Functionality]-->
$(document).ready(function(){
  $('#loadMoreDesigner').mouseenter(function(){
   $('#loadMoreDesigner').hide();
   $('#designer_loader').show();

    var offset = parseInt($('#designer_offset').val());
    var totalCount = $('#totalDesignerCount').val();
    //var customerFavoriteProduct = $('#customerFavoriteProduct').val();
   // var q = '<?php echo $q; ?>';
    var search_keyword = $('#search_keyword').val();
    var highlighted_keyword = $('#highlighted_keyword').val();
    var char_limit = $('#char_limit').val();

    url = "Cn_search/ajaxDesignerList";   
       
    $.ajax({
        url:baseUrl+url,
        type:"post",
        data:{'offset':offset,'search_keyword':search_keyword,'highlighted_keyword':highlighted_keyword,'char_limit':char_limit},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append_designer').append(data[1]);
            $('#designer_offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMoreDesigner").hide();
            }else{
                 $('#loadMoreDesigner').show();
            }
               $('#designer_loader').hide();

        },
        error: function(e){
            $('#designer_loader').hide();
            alert('Please relode the page.');
        }
        
    });
});
 // execution_portfolio();
});
//<!--[End:: Load more Designer for Functionality]-->

//<!--[start:: Load more Protfolio for Functionality]-->
$(document).ready(function(){
  $('#loadMorePortfolio').mouseenter(function(){
   $('#loadMorePortfolio').hide();
   $('#portfolio_loader').show();

    var offset = parseInt($('#portfolio_offset').val());
    var totalCount = $('#totalPortfolioCount').val();
    //var customerFavoriteProduct = $('#customerFavoriteProduct').val();
  //  var q = '<?php echo $q; ?>';
    var search_keyword = $('#search_keyword').val();
    var image_size = $('#image_size').val();
    var highlighted_keyword = $('#highlighted_keyword').val();

    url = "Cn_search/ajaxPortfolioList";   
       
    $.ajax({
        url:baseUrl+url,
        type:"post",
        data:{'offset':offset,'search_keyword':search_keyword,'image_size':image_size,'highlighted_keyword':highlighted_keyword},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append_portfolio').append(data[1]);
            $('#portfolio_offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMorePortfolio").hide();
            }else{
                 $('#loadMorePortfolio').show();
            }
               $('#portfolio_loader').hide();
               
                /*[start:: image loader]*/     
                $('.owl-demo').owlCarousel({
                center: true,
                loop: true,
                margin: 0,
                autoplay: false,
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

            });
                /*[End:: image loader]*/  

        },
        error: function(e){
            $('#portfolio_loader').hide();
            alert('Please relode the page.');
        }
        
    });
});
 // execution_portfolio();
});
//<!--[End:: Load more Designer for Functionality]-->

//<!--[start:: Onclick of tab Load more Protfolio for Functionality]-->
function load_portfolio_first_time(){
   $('#append_portfolio').html('');
   $('#loadMorePortfolio').hide();
   $('#portfolio_loader').show();

    var offset = 0;
    var totalCount = $('#totalPortfolioCount').val();
    //var customerFavoriteProduct = $('#customerFavoriteProduct').val();
    var search_keyword = $('#search_keyword').val();
    var image_size = $('#image_size').val();
    var highlighted_keyword = $('#highlighted_keyword').val();
    
    url = "Cn_search/ajaxPortfolioList";   
       
    $.ajax({
        url:baseUrl+url,
        type:"post",
        data:{'offset':offset,'search_keyword':search_keyword,'image_size':image_size,'highlighted_keyword':highlighted_keyword},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append_portfolio').append(data[1]);
            $('#portfolio_offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMorePortfolio").hide();
            }else{
                 $('#loadMorePortfolio').show();
            }
               $('#portfolio_loader').hide();
               
                /*[start:: image loader]*/     
                $('.owl-demo').owlCarousel({
                center: true,
                loop: true,
                margin: 0,
                autoplay: false,
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

            });
                /*[End:: image loader]*/  

        },
        error: function(e){
            $('#portfolio_loader').hide();
            alert('Please relode the page.');
        }
        
    });

}

    $('#nav_execution_portfolio').click(function(){
     load_portfolio_first_time();
    });
  //<!--[end:: Onclick of tab Load more Protfolio for Functionality]-->


//<!--[Start:: Get filter details]-->

function ajaxGetFilterDetails(){
    
    var search_keyword = $('#search_keyword').val();
    var product_id = $('#product_id').val();
    $('#brands').html('<div class="loader" style="margin-top:40px;"></div>');   
    $('#SOH').html('<div class="loader" style="margin-top:40px;"></div>');   
    $('#COR').html('<div class="loader" style="margin-top:40px;"></div>');
 $.ajax({
            type:'POST',
            url:baseUrl+'ajaxGetFilterDetailsForSearch',
            data: {cor_string:cor_string,brand_string:brand_string, soh_string:soh_string,search_keyword:search_keyword,product_id:product_id},
                success: function (response) {
                    var data  = response.split('||*||');
                         $('#brands').html(data[1]);   
                         $('#SOH').html(data[2]);   
                         $('#COR').html(data[3]);   
                         $('.ln-letters').hide();
                         
                },
                error: function (e) {
                    
                }
        });
        
}

//<!--[End:: Get filter details]-->
//<!--[Start:: Handle filter details]-->
   
function show_brand_filter_list(brand_id) {

        if (($("#chek_" + brand_id).is(":checked"))) {
            $("#chek_" + brand_id).parent().parent().addClass('BrandSectChek');
            var brand_name = $("#label_brand_id_" + brand_id).text();
            var html = '<p id="brand_fliter_option' + brand_id + '"><a href="javascript:void(0);" onclick="remove_brand_filter(' + brand_id + ');" class="filtered-brand">' + brand_name + '</a>  <a onclick="remove_brand_filter(' + brand_id + ');" class="remove-icon"> X </a> </p>';
        } else {
            $("#chek_" + brand_id).parent().parent().removeClass('BrandSectChek');
            $("#chek_" + brand_id).attr('checked', false);
        }
    }
    


    function show_soh_filter_list(id) {
        if ($("#chek1_" + id).is(":checked")) {
            $("#chek1_" + id).parent().parent().addClass('BrandSectChek');
            var title = $("#label_soh_id_" + id).text();
            var html = '<p id="soh_fliter_option' + id + '"><a href="javascript:void(0);" onclick="remove_soh_filter(' + id + ');" class="filtered-brand">' + title + '</a>  <a onclick="remove_soh_filter(' + id + ');" class="remove-icon"> X </a> </p>';
        } else {
            $("#chek1_" + id).parent().parent().removeClass('BrandSectChek');
            $("#chek1_" + id).attr('checked', false);
        }
    }

    function show_cor_filter_list(cor_id) {
        if ($("#chek2_" + cor_id).is(":checked")) {
            $("#chek2_" + cor_id).parent().parent().addClass('BrandSectChek');
            var country_name = $("#label_cor_id_" + cor_id).text();
            var html = '<p id="cor_fliter_option' + cor_id + '"><a href="javascript:void(0);" onclick="remove_cor_filter(\'' + cor_id + '\');" class="filtered-brand">' + country_name + '</a>  <a onclick="remove_cor_filter(\'' + cor_id + '\');" class="remove-icon"> X </a> </p>';
        } else {
            $("#chek2_" + cor_id).parent().parent().removeClass('BrandSectChek');
            $("#chek2_" + cor_id).attr('checked', false);
        }
    
    }
    
    function uncheckBarnds() {
    var brandCheckedNum = $('input[name="brand_id[]"]:checked').length;
    if (!brandCheckedNum) {
        // User didn't check any checkboxes
    }else{
        $("li[class^='ln-']").removeClass('BrandSectChek');
        $("li[class^='ln-']").removeClass('BrnadMainSelct');
      /* for mobile view*/
        $("#mBrandFilter02 li").removeClass('Mbrand-chebox-Selected');
        $('input[name="brand_id[]"]').prop('checked', false);
    }
    }

    function uncheckSOH() {
    var SohCheckedNum = $('input[name="soh_id[]"]:checked').length;
    if (!SohCheckedNum) {
        // User didn't check any checkboxes
    }else{
        $('.SOH:checked').prop('checked', false);
        $('#SOH .brand-chebox ul li').removeClass('BrandSectChek');
        /* for mobile view*/
        $("#mBrandFilter03 li").removeClass('Mbrand-chebox-Selected');
    }
    }

    function uncheckCOR() {
    var CorCheckedNum = $('input[name="cor[]"]:checked').length;
    if (!CorCheckedNum) {
        // User didn't check any checkboxes
    }else{
        $('.COR:checked').prop('checked', false);
        $('#COR .brand-chebox ul li').removeClass('BrandSectChek');
        /* for mobile view*/
        $("#mBrandFilter04 li").removeClass('Mbrand-chebox-Selected');
    }
    }
    
    function remove_brand_filter(brand_id) {
        $("#brand_fliter_option" + brand_id).remove();
        $("#chek_" + brand_id).attr('checked', false);
        $("#chek_" + brand_id).parent().parent().removeClass('BrandSectChek');
        form_submit();
    }
    function remove_soh_filter(id) {

        $("#soh_fliter_option" + id).remove();
        $("#chek1_" + id).attr('checked', false);
        form_submit();
    }

    function remove_cor_filter(cor_id) {
        $("#cor_fliter_option" + cor_id).remove();
        $("#chek2_" + cor_id).attr('checked', false);
        form_submit();
    }
       function clear_all_filter() {

        $('.brand:checked').prop('checked', false);
        $('.SOH:checked').prop('checked', false);
        $('.COR:checked').prop('checked', false);
        $('.remove_all').remove();
        $(".clear-all").hide();
        form_submit();
    }
    
    function form_submit() {
        $("#form").submit();
    }
       function hide_show_clear_all(){
        var brand_list = $("#brand_list").html();
        var strip_brand_list = brand_list.replace(/\s/g, ''); 

        var soh_list = $("#soh_list").html();
        var strip_soh_list = soh_list.replace(/\s/g, '');

        var cor_list = $("#cor_list").html();
        var strip_cor_list = cor_list.replace(/\s/g, '');

        if((strip_brand_list=='')&&(strip_soh_list=='')&&(strip_cor_list=='')){
            
            $(".clear-all").hide();
        }else{
             $(".clear-all").show();
        }
    }
    hide_show_clear_all();
   
    $(".search-result-filter-tabs").mouseleave(function(){
      $(".fitrDrop").removeClass("active"); 
    });
    
//<!--[End:: Handle filter details]-->

$(document).ready(function() { 
 $('.ln-letters').hide();
    
    $(document).on('click','#brands .SearchBrndWrap  span i.fa-close',function(){
            $('.search').val('');
            $('.search').keyup();
        });
 /*Start :: Script for case-insensitive contains match*/  
// New selector
jQuery.expr[':'].Contains = function(a, i, m) {
 return jQuery(a).text().toUpperCase()
     .indexOf(m[3].toUpperCase()) >= 0;
};

// Overwrites old selecor
jQuery.expr[':'].contains = function(a, i, m) {
 return jQuery(a).text().toUpperCase()
     .indexOf(m[3].toUpperCase()) >= 0;
};
/*End :: Script for case-insensitive contains match*/ 
   /*Start:: script for prevent form submition on press enter*/
      $('input.search.serchbrnd,input.mobile_search.form-control').keydown(
              function(event){if(event.keyCode == 13) {event.preventDefault();return false;}}
              );
 /*End:: script for prevent form submition on press enter*/ 
});


jQuery(function(){
	$('#demoOne').listnav({
		includeAll: true,
		includeNums: false
		});
});


 /*STrat::MOBILE SCRIPT*/


 function show_mobile_brand_filter_list(brand_id) {

        if (($("#chek_mobile_" + brand_id).is(":checked"))) {
            $("#chek_mobile_" + brand_id).parent().parent().addClass('Mbrand-chebox-Selected');
//            var brand_name = $("#label_mobile_brand_id_" + brand_id).text();
//            var selected_mobile_brand_html = '<li id="selected_mobile_brand_'+ brand_id +'"><div class="checkstyle"><input id="chek_mobile_selected_brand_'+ brand_id +'" onclick="remove_mobile_selected_brand_filter(' + brand_id + ');" type="checkbox" checked="checked" ><label for="chek_mobile_selected_brand_'+ brand_id +'">' + brand_name + '</label></div></li>';
//           $("#append_mobile_selected_brand").append(selected_mobile_brand_html);
        } else {
            $("#chek_mobile_" + brand_id).parent().parent().removeClass('Mbrand-chebox-Selected');
            //$("#selected_mobile_brand_" + brand_id).remove();
            $("#chek_mobile_" + brand_id).attr('checked', false);
        }

    }   
    
 function show_mobile_soh_filter_list(id) {

        if (($("#chek_soh_mobile_" + id).is(":checked"))) {
            $("#chek_soh_mobile_" + id).parent().parent().addClass('Mbrand-chebox-Selected');
        } else {
            $("#chek_soh_mobile_" + id).parent().parent().removeClass('Mbrand-chebox-Selected');
            $("#chek_soh_mobile_" + id).attr('checked', false);
        }

    }  
  function show_mobile_cor_filter_list(id) {

        if (($("#chek_cor_mobile_" + id).is(":checked"))) {
            $("#chek_cor_mobile_" + id).parent().parent().addClass('Mbrand-chebox-Selected');
        } else {
            $("#chek_cor_mobile_" + id).parent().parent().removeClass('Mbrand-chebox-Selected');
            $("#chek_cor_mobile_" + id).attr('checked', false);
        }

    } 
   function remove_mobile_selected_brand_filter(brand_id) {

        $("#chek_mobile_" + brand_id).attr('checked', false);
       // $("#selected_mobile_brand_" + brand_id).remove();
        $("#chek_mobile_" + brand_id).parent().parent().removeClass('Mbrand-chebox-Selected');
    }  
 
 
 $('#mobile_category_tab,.FilterCloseBtn').click(function(){
 $('#button_block').hide();  
});

$('#mobile_brand_tab').click(function(){
    
 $('#button_block').show(); 
 $('#brand_clear_button').show();  
 $('#soh_clear_button').hide(); 
 $('#cor_clear_button').hide(); 
});

$('#mobile_soh_tab').click(function(){
    
 $('#button_block').show(); 
 $('#brand_clear_button').hide();  
 $('#soh_clear_button').show(); 
 $('#cor_clear_button').hide();  
});

$('#mobile_cor_tab').click(function(){
    
 $('#button_block').show(); 
 $('#brand_clear_button').hide();  
 $('#soh_clear_button').hide(); 
 $('#cor_clear_button').show();  
});



$(".mgdrop").hover(function(){
 $(".mgdrop").removeClass("active");
 $(this).addClass("active");
 
});
 
$(".ThreeTab-section-wrap").mouseleave(function(){
 $(".mgdrop").removeClass("active"); 
});
 
 /*END::MOBILE SCRIPT*/