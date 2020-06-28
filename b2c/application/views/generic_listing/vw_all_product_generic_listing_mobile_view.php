<?php 
/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
?>

<!--------------[ Mobile PLP Section Start ]------------->

  <section class="mobilePLP-Section visible-xs">
    <div class="Plp_listCategory clearfix">
      <div class="mobilePLP-listing-secttion">
        <div class="catogory-navHeading">
          <h2><?php echo $cat_name; ?></h2>
          <span><?php echo $totalCount[0]['totalCount']; ?> PRODUCTS </span> </div>
        <?php if (!empty($product_list)) { ?>
        <ul id="append_mobile">
         <?php 
         foreach ($product_list as $key => $row) {
             ?>

           <li>
                <div class="plp-listimg">
                    <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller' . $row['product_id']; ?>" class="fa fa-heart <?php
                        if (in_array($row['product_id'], $customerFavoriteProduct)) {
                            echo ' heartRed';
                        }
                        ?>" aria-hidden="true" onclick="saveFavorite('Product', 'marketseller',<?php echo $row['product_id']; ?>);"></i></a>
                    <!--<a class="add_url" href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']); ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>">--> 
                    <a class="add_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>"> 
                        <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                    </a>    
                </div>
                <div class="plp-list-name">
                    <?php echo $row['product_name']; ?>
                </div>
            </li>

         
         <?php } ?>
        </ul>
        <?php  } else { ?>
           
                <div class="alert alert-gray">
                    <strong>Sorry, No records found.</strong>
                </div>
            
        <?php } ?>
        <div class="clearfix"></div>
       <div class="plp-loadmore">
           <div class="loader" style="display:none;"></div>
           <div class="loadMore-btn clearfix" id="loadMoreMobile" <?php if ($totalCount[0]['totalCount'] <= 24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
       </div>
      </div>
        
      <div class="fillterBtnM stickFT" > <a href="javascript:void(0)"  class="FilterBtn">Filters</a> </div>
    </div>
   <form id="mobile_form" name="mobile_form" method="post" action="<?php echo base_url(); ?>allProduct-generic-listing-action">
    <div class="Plp_listFilters clearfix" >
      <div class="flierHeading">
        <h2>FILTERS</h2>
        <a  class="FilterCloseBtn" href="javascript:void(0)"><img src="<?php echo base_url().SitePath; ?>assets/img/cls-fltr.png"></a> </div>
      
       <div class="Mobile-filterSect clearfix"> 
        
        <!-- Nav tabs -->
        <div class="mobileFiltr-left">
          <ul class="nav nav-tabs" role="tablist">
            <li  role="presentation" class="active"><a id="mobile_category_tab" href="#mBrandFilter01" aria-controls="home" role="tab" data-toggle="tab">CATEGORIES</a></li>
            <?php if(!empty($brand_list)) { ?>
            <li <?php if($pageType == "BLP"){ ?>  style="display:none;"  <?php } ?>  id="mobile_brand_tab" role="presentation"><a onclick="ajaxGetFilterDetailsMobile();"href="#mBrandFilter02" aria-controls="profile" role="tab" data-toggle="tab">BRANDS</a></li>
            <?php } if(!empty($section_list)) { ?>
            <li id="mobile_soh_tab" role="presentation"><a onclick="ajaxGetFilterDetailsMobile();" href="#mBrandFilter03" aria-controls="messages" role="tab" data-toggle="tab">SECTION OF HOUSE</a></li>
            <?php } if(!empty($country_list)) { ?> 
            <li <?php if($pageType == "BLP"){ ?>  style="display:none;"  <?php } ?> id="mobile_cor_tab" role="presentation"><a onclick="ajaxGetFilterDetailsMobile();"href="#mBrandFilter04" aria-controls="settings" role="tab" data-toggle="tab">COUNTRY OF ORIGIN</a></li>
             <?php }  ?>
          </ul>
        </div>
        <div class="mobileFiltr-right"> 
          <!-- Tab panes -->
          <div class="tab-content">
              <input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat_id; ?>">
              <input type="hidden" id="pageType" name="pageType" value="<?php echo $pageType; ?>">
                 <?php if($pageType =='BLP'){ ?>
                <input type="hidden" id="brand_id" name="brand_id[]" value="<?php echo $_GET['brandID']; ?>">
                <?php } ?>
                <?php
                $brand_string = implode(',', $selected_brand);
                $soh_string = implode(',', $selected_soh);
                $cor_string = implode(',', $selected_cor);
                $subCatIds_string = implode(',', $arrSubCatIds);
                ?>
                <script>
                var brand_string      = '<?php echo $brand_string; ?>';
                var soh_string        = '<?php echo $soh_string; ?>';
                var cor_string        = '<?php echo $cor_string; ?>';
                var subCatIds_string  = '<?php echo $subCatIds_string; ?>';
                var pageType          = '<?php echo $pageType; ?>';
                </script>
                <input type="hidden" id="selected_brand" name="selected_brand_id" value="<?php echo $brand_string; ?>">
                <input type="hidden" id="selected_soh" name="selected_soh_id" value="<?php echo $soh_string; ?>">
                <input type="hidden" id="selected_cor" name="selected_cor" value="<?php echo $cor_string; ?>">
                <input type="hidden" id="cat_name" name="cat_name" value="<?php echo $cat_name; ?>">
            <div role="tabpanel" class="tab-pane active" id="mBrandFilter01">
              <div class="listMobile-Cat">
                <ul>
               <?php if(($pageType=="PLP") && (empty($cat_id) && !empty($selected_soh))){ 
               $soh_details = $this->Md_generic_listing->get_soh_details($selected_soh);
               ?>
                <li class="active"> 
                    <a  href="<?php echo base_url().'allproducts/'.strtolower($soh_details[0]['title']).'?sohID='.$soh_details[0]['id'].'&pageType=PLP';?>" > 
                        <span> View All <?php echo  $soh_details[0]['title']; ?> </span> 
                    </a> 
                </li>
               <?php } else if(($pageType=="PLP") && (!empty($cat_id))){  
                   ?>
                <li class="<?php if($parent_cat_details[0]['cat_id'] == $cat_id ) { ?>active<?php } ?>"> 
                    <a <?php if(!empty($parent_cat_details)) { ?> href="<?php echo base_url().strtolower($parent_cat_details[0]['cat_name']).'?catID='.$parent_cat_details[0]['cat_id'].'&pageType='.$pageType;?>" <?php } else { ?> href="javascript:void(0);" <?php } ?>> 
                        <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $parent_cat_details[0]['cat_image'];?>" alt="<?php echo $parent_cat_details[0]['cat_name']; ?>">
                          <span> View All <?php echo $parent_cat_details[0]['cat_name']; ?> </span> 
                       </a>
                  </li>

               <?php }else{ ?>
                <li class="active"> 
                    <a  href="<?php echo base_url().'allproducts?pageType=PLP';?>" > 
                        <span> View All Products  </span> 
                    </a> 
                </li>
               <?php }
                  foreach ($cat_list as $key => $row) { 
                  if($cat_id == $row['cat_id']){
                   ?>
                  <li class="active"> 
                      <a href="<?php echo base_url().'allproducts/'.urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?catID='.$row['cat_id'].'&pageType=PLP';?>">
                          <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $row['cat_image'];?>" alt="<?php echo $row['cat_name']; ?>">
                          <span> <?php echo $row['cat_name']; ?> </span> 
                       </a>
                  </li>
                  <?php } } ?>
                 <?php foreach ($cat_list as $key => $row) { 
                     if($cat_id != $row['cat_id']) { ?>
                  <li> 
                      <a href="<?php echo base_url().'allproducts/'.urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?catID='.$row['cat_id'].'&pageType=PLP';?>">
                          <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $row['cat_image'];?>" alt="<?php echo $row['cat_name']; ?>">
                          <span> <?php echo $row['cat_name']; ?> </span> 
                       </a>
                  </li>
                 <?php } } ?>
                </ul>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mBrandFilter02">
             
            </div>
                
            <div role="tabpanel" class="tab-pane" id="mBrandFilter03">
              	
                
            </div>
            <div role="tabpanel" class="tab-pane" id="mBrandFilter04">
                
               
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
 