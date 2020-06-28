<?php 
/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
?>
<?php
$array_brand_id = $selected_brand;
$array_soh_id = $selected_soh;
$array_cor = $selected_cor;
?>
<!--------------[ Mobile PLP Section Start ]------------->

  <section class="mobilePLP-Section visible-xs search_mobile">
      
   <form id="mobile_form" name="mobile_form" method="post" action="<?php echo base_url(); ?>search-product-listing-action">
    <div class="Plp_listFilters clearfix" >
      <div class="flierHeading">
        <h2>FILTERS</h2>
        <a  class="FilterCloseBtn" href="javascript:void(0)"><img src="<?php echo base_url().SitePath; ?>assets/img/cls-fltr.png"></a> </div>
      
       <div class="Mobile-filterSect clearfix"> 
        
        <!-- Nav tabs -->
        <div class="mobileFiltr-left">
          <ul class="nav nav-tabs" role="tablist">
            <?php if(!empty($brand_list)) { ?>
            <li id="mobile_brand_tab" class="active" role="presentation"><a href="#mBrandFilter02" aria-controls="profile" role="tab" data-toggle="tab" >BRANDS</a></li>
            <?php } if(!empty($section_list)) { ?>
            <li id="mobile_soh_tab" role="presentation"><a href="#mBrandFilter03" aria-controls="messages" role="tab" data-toggle="tab">SECTION OF HOUSE</a></li>
             <?php } if(!empty($country_list)) { ?> 
            <li  id="mobile_cor_tab" role="presentation"><a href="#mBrandFilter04" aria-controls="settings" role="tab" data-toggle="tab">COUNTRY OF ORIGIN</a></li>
            <?php }  ?>
          </ul>
        </div>
        <div class="mobileFiltr-right"> 
          <!-- Tab panes -->
          <div class="tab-content">
               <?php if(isset($_GET['brandID'])){ ?>
                <input type="hidden" id="brand_id" name="brand_id[]" value="<?php echo $_GET['brandID']; ?>">
               <?php } ?>
                <?php
                $brand_string = implode(',', $selected_brand);
                $soh_string = implode(',', $selected_soh);
                $cor_string = implode(',', $selected_cor);
                ?>
                <input type="hidden" id="selected_brand" name="selected_brand_id" value="<?php echo $brand_string; ?>">
                <input type="hidden" id="selected_soh" name="selected_soh_id" value="<?php echo $soh_string; ?>">
                <input type="hidden" id="selected_cor" name="selected_cor" value="<?php echo $cor_string; ?>">
                <input type="hidden" id="search_keyword" name="search_keyword" value="<?php echo $search_keyword; ?>">
           
            <div role="tabpanel" class="tab-pane active" id="mBrandFilter02">
              <div class="brandtab-Filter">
                <div class="Mbrand-verticle-alphabet">
                  <a class="all active" data-index="All" href="javascript:void(0);">All</a>
                    <a class="a " data-index="a" href="javascript:void(0);">A</a>
                    <!--<a class="a activeSelect" data-index="a" href="javascript:void(0);">A</a>-->
                    <a class="b" data-index="b" href="javascript:void(0);">B</a>
                    <a class="c"  data-index="c" href="javascript:void(0);">C</a>
                    <a class="d"  data-index="d" href="javascript:void(0);">D</a>
                    <a class="e"  data-index="e" href="javascript:void(0);">E</a>
                    <a class="f"  data-index="f" href="javascript:void(0);">F</a>
                    <a class="g" data-index="g"  href="javascript:void(0);">G</a>
                    <a class="h"  data-index="h" href="javascript:void(0);">H</a>
                    <a class="i"  data-index="i"  href="javascript:void(0);">I</a>
                    <a class="j"  data-index="j" href="javascript:void(0);">J</a>
                    <a class="k"  data-index="k" href="javascript:void(0);">K</a>
                    <a class="l"  data-index="l"  href="javascript:void(0);">L</a>
                    <a class="m"  data-index="m" href="javascript:void(0);">M</a>
                    <a class="n"  data-index="n"  href="javascript:void(0);">N</a>
                    <a class="o" data-index="o"  href="javascript:void(0);">O</a>
                    <a class="p"  data-index="p"  href="javascript:void(0);">P</a>
                    <a class="q"  data-index="q"  href="javascript:void(0);">Q</a>
                    <a class="r" data-index="r" href="javascript:void(0);">R</a>
                    <a class="s" data-index="s" href="javascript:void(0);">S</a>
                    <a class="t" data-index="t" href="javascript:void(0);">T</a>
                    <a class="u" data-index="u" href="javascript:void(0);">U</a>
                    <a class="v" data-index="v" href="javascript:void(0);">V</a>
                    <a class="w" data-index="w" href="javascript:void(0);">W</a>
                    <a class="x" data-index="x" href="javascript:void(0);">X</a>
                    <a class="y" data-index="y" href="javascript:void(0);">Y</a>
                    <a class="z" data-index="z" href="javascript:void(0);">Z</a>
                </div>
                <div class="Mbrand_search">
                  
                    <input class="mobile_search form-control" type="text" placeholder="Search">
                    <span class="cleaBtns" style="position: absolute;right:20px;top:10px;cursor: pointer;font-size: 16px;padding: 5px;"> <i class="fa fa-search"></i> </span>
                    <!--<button class="mbt-seacrh" type="button"><i class="fa fa-search"></i></button>-->
                  
                </div>
                <div class="Mbrand-chebox">
                    <ul id="demoTwo" style="height: 642px;overflow-y: auto;position: relative;">
                        <?php    
                       
                        $A_flag = 0;
                        $B_flag = 0;
                        $C_flag = 0;
                        $D_flag = 0;
                        $E_flag = 0;
                        $F_flag = 0;
                        $G_flag = 0;
                        $H_flag = 0;
                        $I_flag = 0;
                        $J_flag = 0;
                        $K_flag = 0;
                        $L_flag = 0;
                        $M_flag = 0;
                        $N_flag = 0;
                        $O_flag = 0;
                        $P_flag = 0;
                        $Q_flag = 0;
                        $R_flag = 0;
                        $S_flag = 0;
                        $T_flag = 0;
                        $U_flag = 0;
                        $V_flag = 0;
                        $W_flag = 0;
                        $X_flag = 0;
                        $Y_flag = 0;
                        $Z_flag = 0;
                        foreach ($brand_list as $key => $row) {
                            if (((substr($row['brand_name'], 0, 1) == 'A') || (substr($row['brand_name'], 0, 1) == 'a')) && ($A_flag != 1)) {
                                $A_flag = 1;
                                ?>
                                <li class="Brand_tile">A</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'B') || (substr($row['brand_name'], 0, 1) == 'b')) && ($B_flag != 1)) {
                                $B_flag = 1;
                                ?>
                                <li class="Brand_tile">B</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'C') || (substr($row['brand_name'], 0, 1) == 'c')) && ($C_flag != 1)) {
                                $C_flag = 1;
                                ?>
                                <li class="Brand_tile">C</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'D') || (substr($row['brand_name'], 0, 1) == 'd')) && ($D_flag != 1)) {
                                $D_flag = 1;
                                ?>
                                <li class="Brand_tile">D</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'E') || (substr($row['brand_name'], 0, 1) == 'e')) && ($E_flag != 1)) {
                                $E_flag = 1;
                                ?>
                                <li class="Brand_tile">E</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'F') || (substr($row['brand_name'], 0, 1) == 'f')) && ($F_flag != 1)) {
                                $F_flag = 1;
                                ?>
                                <li class="Brand_tile">F</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'G') || (substr($row['brand_name'], 0, 1) == 'g')) && ($G_flag != 1)) {
                                $G_flag = 1;
                                ?>
                                <li class="Brand_tile">G</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'H') || (substr($row['brand_name'], 0, 1) == 'h')) && ($H_flag != 1)) {
                                $H_flag = 1;
                                ?>
                                <li class="Brand_tile">H</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'I') || (substr($row['brand_name'], 0, 1) == 'i')) && ($I_flag != 1)) {
                                $I_flag = 1;
                                ?>
                                <li class="Brand_tile">I</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'J') || (substr($row['brand_name'], 0, 1) == 'j')) && ($J_flag != 1)) {
                                $J_flag = 1;
                                ?>
                                <li class="Brand_tile">J</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'K') || (substr($row['brand_name'], 0, 1) == 'k')) && ($K_flag != 1)) {
                                $K_flag = 1;
                                ?>
                                <li class="Brand_tile">K</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'L') || (substr($row['brand_name'], 0, 1) == 'l')) && ($L_flag != 1)) {
                                $L_flag = 1;
                                ?>
                                <li class="Brand_tile">L</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'M') || (substr($row['brand_name'], 0, 1) == 'm')) && ($M_flag != 1)) {
                                $M_flag = 1;
                                ?>
                                <li class="Brand_tile">M</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'N') || (substr($row['brand_name'], 0, 1) == 'n')) && ($N_flag != 1)) {
                                $N_flag = 1;
                                ?>
                                <li class="Brand_tile">N</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'O') || (substr($row['brand_name'], 0, 1) == 'o')) && ($O_flag != 1)) {
                                $O_flag = 1;
                                ?>
                                <li class="Brand_tile">O</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'P') || (substr($row['brand_name'], 0, 1) == 'p')) && ($P_flag != 1)) {
                                $P_flag = 1;
                                ?>
                                <li class="Brand_tile">P</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'Q') || (substr($row['brand_name'], 0, 1) == 'q')) && ($Q_flag != 1)) {
                                $Q_flag = 1;
                                ?>
                                <li class="Brand_tile">Q</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'R') || (substr($row['brand_name'], 0, 1) == 'r')) && ($R_flag != 1)) {
                                $R_flag = 1;
                                ?>
                                <li class="Brand_tile">R</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'S') || (substr($row['brand_name'], 0, 1) == 's')) && ($S_flag != 1)) {
                                $S_flag = 1;
                                ?>
                                <li class="Brand_tile">S</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'T') || (substr($row['brand_name'], 0, 1) == 't')) && ($T_flag != 1)) {
                                $T_flag = 1;
                                ?>
                                <li class="Brand_tile">T</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'U') || (substr($row['brand_name'], 0, 1) == 'u')) && ($U_flag != 1)) {
                                $U_flag = 1;
                                ?>
                                <li class="Brand_tile">U</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'V') || (substr($row['brand_name'], 0, 1) == 'v')) && ($V_flag != 1)) {
                                $V_flag = 1;
                                ?>
                                <li class="Brand_tile">V</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'W') || (substr($row['brand_name'], 0, 1) == 'w')) && ($W_flag != 1)) {
                                $W_flag = 1;
                                ?>
                                <li class="Brand_tile">W</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'X') || (substr($row['brand_name'], 0, 1) == 'x')) && ($X_flag != 1)) {
                                $X_flag = 1;
                                ?>
                                <li class="Brand_tile">X</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'Y') || (substr($row['brand_name'], 0, 1) == 'y')) && ($Y_flag != 1)) {
                                $Y_flag = 1;
                                ?>
                                <li class="Brand_tile">Y</li>
                            <?php } ?>
                            <?php                                            
                                if (((substr($row['brand_name'], 0, 1) == 'Z') || (substr($row['brand_name'], 0, 1) == 'z')) && ($Z_flag != 1)) {
                                $Z_flag = 1;
                                ?>
                                <li class="Brand_tile">Z</li>
                            <?php } ?>
                            <?php 
                                // $product_count_by_brand = $this->Md_generic_listing->productCountByBrand($row['brand_id'],$arrSubCatIds);       
                       $product_count = $this->Md_search->get_brand_product_count($row['brand_id'],$array_soh_id="",$array_cor="",$search_keyword,$product_id);
                 
                       $row['ProductCount'] = $product_count[0]['ProductCount'];  
                              if ($row['ProductCount']!=0) {
                                 ?>
                                
                            <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['brand_id'], $selected_brand)) { ?> Mbrand-chebox-Selected <?php } ?>">

                                <div class="checkstyle"> 
                                    <input <?php if (($row['ProductCount']==0)) { ?> disabled="" <?php } ?>  onclick="show_mobile_brand_filter_list(<?php echo $row['brand_id']; ?>);" <?php if (in_array($row['brand_id'], $selected_brand)) { ?> checked="" <?php } ?> name="brand_id[]" type="checkbox" id="chek_mobile_<?php echo $row['brand_id']; ?>" value="<?php echo $row['brand_id']; ?>"> 
                                    <label for="chek_mobile_<?php echo $row['brand_id']; ?>" ></label> 
                                </div> 
                                <a href="javascript:void(0);"  onclick="$(<?php echo '\'#chek_mobile_'.$row['brand_id'].'\''; ?>).click();" id="label_mobile_brand_id_<?php echo $row['brand_id']; ?>" class="name"><?php echo $row['brand_name'].' ('.$row['ProductCount'].')'; ?></a>

                            </li>
                        <?php } } ?>                
                     </ul>


                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mBrandFilter03">
              	<div class="Mbrand-chebox">
                <ul class="">
                 <?php
                    foreach ($section_list as $row) {                  
                 ?> 
                 <?php 
                   // $product_count_by_soh = $this->Md_generic_listing->productCountBySoh($row['id'],$arrSubCatIds);       
                  $product_count = $this->Md_search->get_section_product_count($row['id'],$array_brand_id="",$array_cor="",$search_keyword,$product_id);
                  $product_count_by_soh[0]['ProductCount'] = $product_count[0]['ProductCount'];
                 if ($product_count_by_soh[0]['ProductCount']!=0) {
                    ?>
                  <li class="<?php if ($product_count_by_soh[0]['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['id'], $selected_soh)) { ?> Mbrand-chebox-Selected <?php } ?>">
                    <div class="checkstyle">
                      <input <?php if ($product_count_by_soh[0]['ProductCount']==0) { ?> disabled="" <?php } ?> class="SOH" onclick="show_mobile_soh_filter_list(<?php echo $row['id']; ?>);" id="chek_soh_mobile_<?php echo $row['id']; ?>" <?php if (in_array($row['id'], $selected_soh)) { ?> checked="" <?php } ?> type="checkbox" value="<?php echo $row['id']; ?>" name="soh_id[]">
                      <label for="chek_soh_mobile_<?php echo $row['id']; ?>"><?php echo $row['title'].' ('.$product_count_by_soh[0]['ProductCount'].')'; ?></label>
                    </div>
                  </li>
                   <?php  } } ?> 
                </ul>
              </div>
                
            </div>
            <div role="tabpanel" class="tab-pane" id="mBrandFilter04">
                <div class="Mbrand-chebox">
                    <ul class="">
                     <?php foreach ($country_list as $key => $row) { ?> 
                     <?php 
                      //  $product_count_by_cor = $this->Md_generic_listing->productCountByCor(strtolower($row['countryName']),$arrSubCatIds);       
                        $product_count = $this->Md_search->get_country_product_count($row['idCountry'],$array_brand_id="",$array_soh_id="",$search_keyword,$product_id);
                        $product_count_by_cor[0]['ProductCount'] = $product_count[0]['ProductCount'];
                     if ($product_count_by_cor[0]['ProductCount']!=0) {
                        ?>
                      <li class="<?php if ($product_count_by_cor[0]['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['countryName'], $selected_cor)) { ?> Mbrand-chebox-Selected <?php } ?>">
                        <div class="checkstyle">
                          <input <?php if ($product_count_by_cor[0]['ProductCount']==0) { ?> disabled="" <?php } ?> class="COR" onclick="show_mobile_cor_filter_list('<?php echo $row['countryName']; ?>');" id="chek_cor_mobile_<?php echo $row['countryName']; ?>" <?php if (in_array($row['countryName'], $selected_cor)) { ?> checked="" <?php } ?> name="cor[]" type="checkbox" value="<?php echo $row['countryName']; ?>">
                          <label for="chek_cor_mobile_<?php echo $row['countryName']; ?>"><?php echo $row['countryName'].' ('.$product_count_by_cor[0]['ProductCount'].')'; ?></label>
                        </div>
                      </li>
                     <?php } }?>
                    </ul>
                  </div>
               
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div id="button_block"  style="display:none;" class="fillterBtnM  fillterBtnM50 stickFT"> 
                <button type="submit" class="mobile_apply_button">APPLY</button>
                <a style="display:none;" id="brand_clear_button" href="javascript:void(0);" onclick="uncheckBarnds();">CLEAR</a>
                <a style="display:none;" id="soh_clear_button" href="javascript:void(0);" onclick="uncheckSOH();">CLEAR</a>
                <a style="display:none;" id="cor_clear_button" href="javascript:void(0);" onclick="uncheckCOR();">CLEAR</a>
    </div>
       
   </form>
   <div class=" clearfix"></div>
  </section>
  
  <!--------------[  Mobile PLP Section End ]-------------> 
  <script type="text/javascript">
$(document).ready(function(){      
$(".FilterBtn").click(function(e) {
  
    $(".search-result-section").hide();
    $("body").toggleClass("FilterOpen");
    $(this).toggleClass("iconchnage");
    $("#mBrandFilter02").addClass("active");
    $("#mBrandFilter03").removeClass("active");
    $("#mBrandFilter04").removeClass("active");
    $("#mobile_brand_tab").addClass("active");
    $("#mobile_soh_tab").removeClass("active");
    $("#mobile_cor_tab").removeClass("active");
    $('#button_block').show(); 
    $('#brand_clear_button').show();  
    $('#soh_clear_button').hide(); 
    $('#cor_clear_button').hide(); 
//    $('.mobile_search').val('');
//    $('.mobile_search').keyup();
    $(window).scrollTop(0); 
});

$(".FilterCloseBtn").click(function(e) {
    $(".search-result-section").show();
    $("body").removeClass("FilterOpen");
	$(this).toggleClass("iconchnage");
});


      
 
 });

  </script>
  
  
  <script type="text/javascript">
$(document).ready(function(){
    jQuery(function(){
	$('#demoTwo').listnav({
		includeAll: true,
		includeNums: false,
                noMatchText:''
		});
   });
$('.ln-letters').hide();
        /*Start:: script for prevent form submition on press enter*/
      $('input.mobile_search.form-control').keydown(
              function(event){if(event.keyCode == 13) {event.preventDefault();return false;}}
              );
 /*End:: script for prevent form submition on press enter*/
      
       $('#demoTwo li div').parent('li').click(function(){
          var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
           var alphabet = String(selectedClass).split("-");
          if($('#demoTwo .'+selectedClass+'.Mbrand-chebox-Selected').length>0){
              $('#demoTwo .'+selectedClass+'.Brand_tile').addClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).addClass('BrnadMainSelct');
          }else{
              $('#demoTwo .'+selectedClass+'.Brand_tile').removeClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).removeClass('BrnadMainSelct');
          }
      });
      
      /*Start:: mobile*/
//       $(document).on('click','#mBrandFilter02 .Mbrand_search  span i.fa-close',function(){
//           alert();
//           $('.mobile_search').val('');
//            $('.mobile_search').keyup();
//        });
        
         $(document).on('click','#mBrandFilter02,.FilterBtn',function(){
       
           $('.mobile_search').val('');
            $('.mobile_search').keyup();
        });
        
        $('.mobile_search').keyup(function(){
        var keyword = $(this).val();
         if(keyword!=''){
            
            $('#mBrandFilter02 .Mbrand_search span i').removeClass('fa-search');
            $('#mBrandFilter02 .Mbrand_search span i').addClass('fa-close');
        }else{
            $('#mBrandFilter02 .Mbrand_search span i').addClass('fa-search');
            $('#mBrandFilter02 .Mbrand_search span i').removeClass('fa-close');  
        }
       var list = ['hash','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $("#demoTwo a.name").parent('li').css('display','block');
        $("#demoTwo a.name:not(:contains('"+keyword+"'))").parent('li').css('display','none');
       for(var i=0;i<list.length;i++){
         if($('#demoTwo li.ln-'+list[i]+' a:visible').length<1){
             $('#demoTwo li.ln-'+list[i]).css('display','none');
             $('.Mbrand-verticle-alphabet a.'+list[i]).addClass('disabled');
         }else{
             $('#demoTwo li.ln-'+list[i]).css('display','block');
            $('.Mbrand-verticle-alphabet a.'+list[i]).removeClass('disabled');
         }
        
       }
        mbl_getPositions();
    });
    
    $(".Mbrand-verticle-alphabet a").click(function(){
        
        var position = $(this).attr('data-position');
        var classTag = $(this).attr('data-index');
      // console.log(position);
       
       if(!$(this).hasClass('disabled')){
       $('.Mbrand-verticle-alphabet a').removeClass('active');
        $(this).addClass('active');
       if($('#demoTwo li.ln-'+classTag+':visible').length>=1){
//        $('#demoOne').scrollLeft(position);
        $('#demoTwo').animate({ scrollTop: position }, 500);
        
       }
   }
       
       if(classTag==='All'){
           
           $('.Mbrand-verticle-alphabet a').removeClass('active');
           $(this).addClass('active');
           
           $('.mobile_search').val('');
           $('#demoTwo').scrollTop('0');
         $('.mobile_search').keyup();
          
       }
        
    });
     $('#mobile_brand_tab').one('click',function(){
  
   setTimeout(function() {
        
        $('#demoTwo').scrollTop('0'); 
        $('.mobile_search').keyup();
            $('#demoTwo li.Mbrand-chebox-Selected').each(function(){
          var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
          var alphabet = String(selectedClass).split("-");
           if($('#demoTwo .'+selectedClass+'.Mbrand-chebox-Selected').length>0){
              $('#demoTwo .'+selectedClass+'.Brand_tile').addClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).addClass('BrnadMainSelct');
              
          }else{
              $('#demoTwo .'+selectedClass+'.Brand_tile').removeClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).removeClass('BrnadMainSelct');
          }
      });
    }, 300);
  
 });
    
    /*End :: mobile*/ 
   
   });
   function mbl_getPositions(){
    $(".Mbrand-verticle-alphabet a").each(function(){
        var position=0;
        var classTag = $(this).attr('data-index');
        
        if(classTag!='All' && $('#demoTwo li.ln-'+classTag).length>0){
            
        position = $('#demoTwo li.ln-'+classTag).first().position();
        $(this).attr('data-position',position.top);
        
        }else{
          $(this).attr('data-position','0');  
        }
        console.log(classTag+"=>"+position.top);
        
    });
}
  </script>

<?php ?>