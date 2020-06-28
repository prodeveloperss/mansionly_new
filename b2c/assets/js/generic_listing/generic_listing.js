/*--Read more functionaly--*/



$(document).ready(function() { 

 
    $(".read_more").click(function(){
       
        
            $('.less').hide();
            $('.read_more').hide();
            $('.more').show();            
            $(this).parent().next().show();
            //previous code
            //$(this).parent().hide();
            // $(this).parent().next().show();
      
    });
     $(".read_less").click(function(){
       
        
            $(this).parent().hide();
            $('.less').show();
            $('.read_more').show();
            
           //previous code
           // $(this).parent().hide();
           //$(this).parent().prev().show();
      
    });
});


/*--/Read more functionaly--*/




/*[start:: Load more for Functionality]*/

$(document).ajaxStart(function () {
    $(".loader").show();
});

$(document).ajaxComplete(function () {
    $(".loader").hide();
});


    $(document).ready(function () {
       
        $('#loadMore').mouseenter(function () {
            $('#loadMore').hide();
            //$('.loader').show();
            
            var offset = parseInt($('#offset').val());
            var totalCount = $('#totalCount').val();
            var cat_id = $('#cat_id').val();
            var brand_id = $('#selected_brand').val();
            var soh_id = $('#selected_soh').val();
            var cor = $('#selected_cor').val();
            var customerFavoriteProduct = $('#customerFavoriteProduct').val();
            //var q = '<?php echo $q; ?>';
            var id = $('#id').val();
            var page = $('#page').val();
            var pageType = $('#pageType').val();
            var url = "";

            $.ajax({
                url: baseUrl + "Cn_generic_listing/ajaxGetProductByGenericListing",
                type: "post",
                data: {'offset': offset, 'cat_id': cat_id, 'customerFavoriteProduct': customerFavoriteProduct, 'q': q, 'id': id, 'page': page, 'brand_id': brand_id, 'soh_id': soh_id, 'cor': cor,'pageType':pageType},
                success: function (response) {
                    var data = response.split('|*|*|');
                    $('#append').append(data[1]);
                    $('#offset').val(data[0]);
                    if (totalCount <= parseInt(data[0])) {
                        $("#loadMore").hide();
                        
                    } else {
                        $('#loadMore').show();
                       
                    }
                },
                error: function (e) {
                    alert('Please relode the page.');
                }

            });
            //$('.loader').hide();
        });
        $('#loadMoreMobile').mouseenter(function () {
            $('#loadMoreMobile').hide();
            //$('.loader').show();
            
            var offset = parseInt($('#offset').val());
            var totalCount = $('#totalCount').val();
            var cat_id = $('#cat_id').val();
            var brand_id = $('#selected_brand').val();
            var soh_id = $('#selected_soh').val();
            var cor = $('#selected_cor').val();
            var customerFavoriteProduct = $('#customerFavoriteProduct').val();
            var q = '<?php echo $q; ?>';
            var id = $('#id').val();
            var page = $('#page').val();
            var pageType = $('#pageType').val();
            var url = "";

            $.ajax({
                url: baseUrl + "Cn_generic_listing/ajaxGetProductByGenericListing",
                type: "post",
                data: {'offset': offset, 'cat_id': cat_id, 'customerFavoriteProduct': customerFavoriteProduct, 'q': q, 'id': id, 'page': page, 'brand_id': brand_id, 'soh_id': soh_id, 'cor': cor,'pageType':pageType},
                success: function (response) {
                    var data = response.split('|*|*|');
                    $('#append_mobile').append(data[1]);
                    $('#offset').val(data[0]);
                    if (totalCount <= parseInt(data[0])) {
                        $("#loadMoreMobile").hide();
                        
                    } else {
                        $('#loadMoreMobile').show();
                       
                    }
                },
                error: function (e) {
                    alert('Please relode the page.');
                }

            });
            //$('.loader').hide();
        });

        /*[start:Add offset to url]*/
        $(document).on('click', '.add_url', function () {
            this.href = this.href + '&offset=' + $('#offset').val();
        });
        /*[End:Add offset to url]*/
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
ajaxGetFilterDetails();
ajaxGetFilterDetailsMobile();
    });



 /*[End:: Load more Functionality ]*/

   
function ajaxGetFilterDetails(){
    $('#brands').html('<div class="loader" style="margin-top:40px;"></div>');   
    $('#SOH').html('<div class="loader" style="margin-top:40px;"></div>');   
    $('#COR').html('<div class="loader" style="margin-top:40px;"></div>');
 $.ajax({
            type:'POST',
            url:baseUrl+'ajaxGetFilterDetails',
            data: {pageType:pageType,subCatIds_string:subCatIds_string,cor_string:cor_string,brand_string:brand_string, soh_string:soh_string },
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
function ajaxGetFilterDetailsMobile(){
    $('#mBrandFilter02').html('<div class="loader" style="position: relative;top:100px;"></div>');   
    $('#mBrandFilter03').html('<div class="loader" style="position: relative;top:100px;"></div>');   
    $('#mBrandFilter04').html('<div class="loader" style="position: relative;top:100px;"></div>');
 $.ajax({
            type:'POST',
            url:baseUrl+'ajaxGetFilterDetailsMobile',
            data: {pageType:pageType,subCatIds_string:subCatIds_string,cor_string:cor_string,brand_string:brand_string, soh_string:soh_string },
                success: function (response) {
                    var data  = response.split('||*||');
                         $('#mBrandFilter02').html(data[1]);   
                         $('#mBrandFilter03').html(data[2]);   
                         $('#mBrandFilter04').html(data[3]);   
                         $('.ln-letters').hide();
                         
                },
                error: function (e) {
                    
                }
        });
        
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
   
    function uncheckBarnds() {
    var brandCheckedNum = $('input[name="brand_id[]"]:checked').length;
    if (!brandCheckedNum) {
        // User didn't check any checkboxes
    }else{
      //  $('.brand:checked').prop('checked', false);
      //  $('.brand:checked').prop('checked', false);
        $("li[class^='ln-']").removeClass('BrandSectChek');
        $("li[class^='ln-']").removeClass('BrnadMainSelct');
      /* for mobile view*/
        $("#mBrandFilter02 li").removeClass('Mbrand-chebox-Selected');
        $('input[name="brand_id[]"]').prop('checked', false);
        // hide_show_clear_all();
       // form_submit();
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
      //   hide_show_clear_all();
        //form_submit();
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
       //  hide_show_clear_all();
       // form_submit();
    }
    }

    function hide_brand_tab() {
        $("#brands").removeClass('active');
        $("#brand_tab").removeClass('active');
        $("#brand_anchor").attr("aria-expanded", "false");
      
    }

    function hide_SOH_tab() {
        $("#SOH").removeClass('active');
        $("#SOH_tab").removeClass('active');
        $("#SOH_anchor").attr("aria-expanded", "false");
    }


    function hide_COR_tab() {
        $("#COR").removeClass('active');
        $("#COR_tab").removeClass('active');
        $("#COR_anchor").attr("aria-expanded", "false");
    }



    function show_brand_filter_list(brand_id) {

        if (($("#chek_" + brand_id).is(":checked"))) {
            $("#chek_" + brand_id).parent().parent().addClass('BrandSectChek');
            var brand_name = $("#label_brand_id_" + brand_id).text();
           
           // alert(brand_name);
            
            
            
            var html = '<p id="brand_fliter_option' + brand_id + '"><a href="javascript:void(0);" onclick="remove_brand_filter(' + brand_id + ');" class="filtered-brand">' + brand_name + '</a>  <a onclick="remove_brand_filter(' + brand_id + ');" class="remove-icon"> X </a> </p>';
           // var selected_brand_html = '<li id="selected_brand_'+ brand_id +'"><div class="checkstyle"><input id="chek_selected_brand_'+ brand_id +'" onclick="remove_selected_brand_filter(' + brand_id + ');" type="checkbox" checked="checked" ><label for="chek_selected_brand_'+ brand_id +'">' + brand_name + '</label></div></li>';
          // $("#append_selected_brand").append(selected_brand_html);
          // $("#brand_list").append(html);
        } else {
            $("#chek_" + brand_id).parent().parent().removeClass('BrandSectChek');
           // $("#brand_fliter_option" + brand_id).remove();
           // $("#selected_brand_" + brand_id).remove();
            $("#chek_" + brand_id).attr('checked', false);
        }
       //hide_show_clear_all(); 
    }
    


    function show_soh_filter_list(id) {
//alert();
        if ($("#chek1_" + id).is(":checked")) {
            $("#chek1_" + id).parent().parent().addClass('BrandSectChek');
            var title = $("#label_soh_id_" + id).text();
            var html = '<p id="soh_fliter_option' + id + '"><a href="javascript:void(0);" onclick="remove_soh_filter(' + id + ');" class="filtered-brand">' + title + '</a>  <a onclick="remove_soh_filter(' + id + ');" class="remove-icon"> X </a> </p>';
           // $("#soh_list").append(html);
        } else {
            $("#chek1_" + id).parent().parent().removeClass('BrandSectChek');
            //$("#soh_fliter_option" + id).remove();
            $("#chek1_" + id).attr('checked', false);
        }
    // hide_show_clear_all();
    }

    function show_cor_filter_list(cor_id) {
        if ($("#chek2_" + cor_id).is(":checked")) {
            $("#chek2_" + cor_id).parent().parent().addClass('BrandSectChek');
            var country_name = $("#label_cor_id_" + cor_id).text();
            var html = '<p id="cor_fliter_option' + cor_id + '"><a href="javascript:void(0);" onclick="remove_cor_filter(\'' + cor_id + '\');" class="filtered-brand">' + country_name + '</a>  <a onclick="remove_cor_filter(\'' + cor_id + '\');" class="remove-icon"> X </a> </p>';
           // $("#cor_list").append(html);
        } else {
            $("#chek2_" + cor_id).parent().parent().removeClass('BrandSectChek');
          //  $("#cor_fliter_option" + cor_id).remove();
            $("#chek2_" + cor_id).attr('checked', false);
        }
     //  hide_show_clear_all();
    }
    
    function remove_selected_brand_filter(brand_id) {

        $("#brand_fliter_option" + brand_id).remove();
        $("#chek_" + brand_id).attr('checked', false);
        $("#selected_brand_" + brand_id).remove();
        $("#chek_" + brand_id).parent().parent().removeClass('BrandSectChek');
        //   hide_show_clear_all();
       // form_submit();
    }
    function remove_brand_filter(brand_id) {
//alert();
        $("#brand_fliter_option" + brand_id).remove();
        $("#chek_" + brand_id).attr('checked', false);
       // $("#selected_brand_" + brand_id).remove();
        $("#chek_" + brand_id).parent().parent().removeClass('BrandSectChek');
      //  hide_show_clear_all();
        form_submit();
    }
    function remove_soh_filter(id) {

        $("#soh_fliter_option" + id).remove();
        $("#chek1_" + id).attr('checked', false);
       // hide_show_clear_all();
        form_submit();
    }

    function remove_cor_filter(cor_id) {
        $("#cor_fliter_option" + cor_id).remove();
        $("#chek2_" + cor_id).attr('checked', false);
       // hide_show_clear_all();
        form_submit();
    }

    function clear_all_filter() {

        $('.brand:checked').prop('checked', false);
        $('.SOH:checked').prop('checked', false);
        $('.COR:checked').prop('checked', false);
        $('.remove_all').remove();
      //  hide_show_clear_all();
        form_submit();
    }

    function form_submit() {
        $("#form").submit();
    }

    $(window).scroll(function () {

        if ($(this).scrollTop() > 300)
        {
            hide_COR_tab();
            hide_SOH_tab();
            hide_brand_tab();
        }

    });

jQuery(function(){
	$('#demoOne').listnav({
		includeAll: true,
		includeNums: false
		});
});




$(".FilterBtn").click(function(e) {
    $("body").toggleClass("FilterOpen");
	$(this).toggleClass("iconchnage")
});

$(".FilterCloseBtn").click(function(e) {
    $("body").removeClass("FilterOpen");
	$(this).toggleClass("iconchnage")
});

$('.FilterBtn').click(function(){
      $(window).scrollTop(0); 
  }); 
 
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
