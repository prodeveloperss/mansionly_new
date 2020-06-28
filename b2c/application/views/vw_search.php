<?php

$this->load->view('section/vw_header_1');
?>
<link href="<?php echo base_url() . SitePath; ?>assets/css/plp.css?v=1.8" rel="stylesheet">
<?php 
$this->load->view('section/vw_header_2');
                        
if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

 /*[start::Code to Handel portfolio images size.]*/
$device_type = '';
if(isset($_COOKIE['device_type'])){
$device_type =  $_COOKIE['device_type'];
}

 $image_size = '370X270/';
 if($device_type == 'desktop'){
     $image_size = '370X270/';
 }
 else if($device_type == 'tablet_landscap'){
     $image_size = '293X270/';
 }
 else if($device_type == 'tablet_potrait'){
     $image_size = '293X270/';
 }
 else if($device_type == 'mobile'){
     $image_size = '690X300/';
 }
 else if($device_type == 'small_mobile'){
     $image_size = '370X270/';
 }
/*[End::Code to Handel portfolio images size.]*/
 


/*[start::Code to Handel character limit for Product description.]*/
     $char_limit = '60';
    if($device_type == 'desktop'){
        $char_limit = '60';
    }
    else if($device_type == 'tablet_landscap'){
       $char_limit = '60';
    }
    else if($device_type == 'tablet_potrait'){
       $char_limit = '60';
    }
    else if($device_type == 'mobile'){
        $char_limit = '60';
    }
    else if($device_type == 'small_mobile'){
        $char_limit = '60';
    }

/*[End::Code to Handel character limit for Product description.]*/
                      
  ?>
<input type="hidden" name="char_limit" id="char_limit" value="<?php echo $char_limit;?>">
<input type="hidden" name="image_size" id="image_size" value="<?php echo $image_size; ?>">
 <!--------------[ Middle Section ]------------->
  <div class="breadcrumb-main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li>Search</li>
    </ol>
  </div>
  <section class="search-result-section clearfix">
    <div class="sr-rlt-header">        
      <h2>Search Result for “<?php echo $search_keyword; ?>” <span>( <?php echo $total_count; ?> result )</span> </h2>
    </div>
    <div class="search-result-tabs">
      <div> 
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
        <?php $totalProductCount =  count($product_all_count); 
              $totalDesignerCount =  $designer_all_count[0]['totalCount'];
              $totalPortfolioCount =  $portfolio_all_count[0]['totalCount'];
        ?>
          <?php  if(!empty($product_list )) { ?>
          <li role="presentation" <?php if(!empty($product_list )){ ?> class="active" <?php }?>><a   href="#searchTb01" aria-controls="home" role="tab" data-toggle="tab">Products ( <?php echo $totalProductCount; ?> )</a></li>
          <?php } if(!empty($disigner_list )) { ?>
          <li role="presentation" <?php if((empty($product_list )&&(empty($portfolio_list )))){ ?> class="active" <?php }?>><a href="#searchTb02" aria-controls="profile" role="tab" data-toggle="tab">Designers ( <?php echo $totalDesignerCount; ?> )</a></li>
          <?php } if(!empty($portfolio_list )) { ?>
          <li id="nav_execution_portfolio" role="presentation" <?php if((empty($product_list )&&(empty($disigner_list )))){ ?> class="active" <?php }?>><a href="#searchTb03" aria-controls="messages" role="tab" data-toggle="tab">Execution Portfolio ( <?php echo $totalPortfolioCount; ?> )</a></li>
          <?php }  ?>
        </ul>
        <div class="container"> 
        <?php if((empty($product_list))&&(empty($disigner_list))&&(empty($portfolio_list))) { ?>
            
        <div style="margin-top: 10px;" class="alert alert-gray">
          <strong>Sorry !</strong> No Records found.
        </div>
        <?php } else {?>
            
          <!-- Tab panes -->
        <div class="tab-content">


      <!--------------- [searchTb01]------------->
               <div role="tabpanel" class="tab-pane <?php if(!empty($product_list )){ ?> active <?php } ?>" id="searchTb01">
               <div class="container">
               <form id="form" name="form" method="post" action="<?php echo base_url(); ?>search-product-listing-action">

                   <?php
                   $brand_string = implode(',', $selected_brand);
                   $soh_string = implode(',', $selected_soh);
                   $cor_string = implode(',', $selected_cor);
                   ?>
                  <script>
                   var brand_string      = '<?php echo $brand_string; ?>';
                   var soh_string        = '<?php echo $soh_string; ?>';
                   var cor_string        = '<?php echo $cor_string; ?>';
                  </script>

                   <input type="hidden" id="selected_brand" name="selected_brand_id" value="<?php echo $brand_string; ?>">
                   <input type="hidden" id="selected_soh" name="selected_soh_id" value="<?php echo $soh_string; ?>">
                   <input type="hidden" id="selected_cor" name="selected_cor" value="<?php echo $cor_string; ?>">
                   <input type="hidden" id="search_keyword" name="search_keyword" value="<?php echo $search_keyword; ?>">
                   <?php //$product_id_string = implode(",",$product_id); ?>
                   <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
                   <div class="row">
                    <div class="search-result-filter-tabs clearfix">

           <span class="ftlr-spn">Filter by: </span>
           <?php if(!empty($brand_list)){ ?>
           <div class="fitrDrop">
               <a onmouseover="ajaxGetFilterDetails();" href="javascript:void(0);">Brands<i class="fa fa-caret-right" aria-hidden="true"></i> </a>
               <div class="filtr-Drop-div clearfix">
               <div id="brands" class="container">

               </div>

               </div>
           </div>
           <?php } ?>
           <?php if(!empty($section_list)){ ?>
           <div class="fitrDrop">
           <a onmouseover="ajaxGetFilterDetails();" href="javascript:void(0);">Section of house<i class="fa fa-caret-right" aria-hidden="true"></i></a>
           <div class="filtr-Drop-div clearfix">
               <div id="SOH" class="container">

               </div>        
           </div>
           </div>
          <?php } ?>
          <?php if(!empty($country_list)){ ?>
           <div class="fitrDrop">
           <a onmouseover="ajaxGetFilterDetails();" href="javascript:void(0);">Country of origin<i class="fa fa-caret-right" aria-hidden="true"></i></a>
           <div class="filtr-Drop-div clearfix">
               <div id="COR" class="container">

               </div>

           </div>
           </div>                    
           <?php } ?>

            <div class="applied-filter">
                       <ul> 

                           <li id="brand_list"> 
                               <?php

                               foreach ($brand_list as $row) {
                                   if (in_array($row['brand_id'], $selected_brand)) {
                                       ?>
                                       <p class="remove_all" id="brand_fliter_option<?php echo $row['brand_id']; ?>"><a href="javascript:void(0);" onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="filtered-brand"><?php echo $row['brand_name']; ?></a>  <a onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="remove-icon"> X </a> </p>
                                       <!--<p class="remove_all" id="brand_fliter_option<?php echo $row['brand_id']; ?>"><a href="javascript:void(0);" onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="filtered-brand"><?php //echo $row['brand_name'].' ('.$product_count_by_brand[0]['ProductCount'].')'; ?></a>  <a onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="remove-icon"> X </a> </p>-->
                                       <?php
                                   }
                                }

                               ?>
                           </li>

                           <li id="soh_list"> 
                               <?php
                               foreach ($section_list as $row) {
                                   if (in_array($row['id'], $selected_soh)) {
                                       ?>
                                       <p class="remove_all" id="soh_fliter_option<?php echo $row['id']; ?>">
                                           <a href="javascript:void(0);" onclick="remove_soh_filter(<?php echo $row['id']; ?>);" class="filtered-brand"><?php echo $row['title']; ?></a> 
                                           <a onclick="remove_soh_filter(<?php echo $row['id']; ?>);" class="remove-icon"> X </a> 
                                       </p>
                                       <?php
                                   }
                               }
                               ?>
                           </li>

                           <li id="cor_list"> 
                               <?php
                               foreach ($country_list as $row) {
                                   if (in_array($row['countryName'], $selected_cor)) {
                                       ?>
                                       <p class="remove_all" id="cor_fliter_option<?php echo $row['countryName']; ?>"><a href="javascript:void(0);" onclick="remove_cor_filter('<?php echo $row['countryName']; ?>');" class="filtered-brand"><?php echo $row['countryName']; ?></a>  <a onclick="remove_cor_filter('<?php echo $row['countryName']; ?>');" class="remove-icon"> X </a> </p>
                                       <?php
                                   }
                               }
                               ?>
                           </li>

                           <li><a class="clear-all" onclick="clear_all_filter();" href="javascript:void(0);">Clear All</a> </li>
                       </ul>
                   </div>


               </div>
              </div>

                   </form>
               </div>    

                 <div class="container">
                   <input type="hidden" name="product_offset" id="product_offset" value="<?php echo $limit; ?>">
                   <input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo $totalProductCount;?>">
                   <?php $Favoritestring = implode(',', $customerFavoriteProduct); ?>
                   <input type="hidden" name="customerFavoriteProduct" id="customerFavoriteProduct" value="<?php echo $Favoritestring; ?>">
                   <input type="hidden" name="highlighted_keyword" id="highlighted_keyword" value="<?php echo $highlighted_keyword;?>">
                   <div class="row">
                     <div class="search-result-Row">
                       <ul id="append_product">                        
                       <?php   foreach ($product_list as $key=> $row) {                        


                           $string = $row['short_description'];
                           $long_desc = $row['product_details'];;
                           $pre_sub_string = substr($string,0,$char_limit);
                         //$description='';
                           $description=$pre_sub_string;
                           $product_material = $this->Md_search->get_product_material($row['product_id']);
                           $product_color = $this->Md_search->get_product_color($row['product_id']);
                           $material='';
                           if(!empty($product_material)){
                               $material = $product_material[0]['material'];
                           }
                           $color='';
                           if(!empty($product_color)){
                               $color = $product_color[0]['color'];
                           }
                           /*[start::Code to Handel character limit if word is break.]*/
                           $string_pos = stripos($string, $search_keyword)+1;
                           $string_length = strlen($search_keyword);
                           if(($char_limit+$string_length)< $string_pos){
                               $char_limit = $char_limit+$string_length;
                           }
                           /*[End::Code to Handel character limit if word is break.]*/

                           /*[start:: Check if search keyword available short description]*/
                           if (stripos($string, $search_keyword) !== false){

                           if (stripos($pre_sub_string, $search_keyword) !== false){

                               $description = $pre_sub_string;
                           }else{
                                $next_sub_string = substr($string,$char_limit);
                               if (stripos($next_sub_string,$search_keyword) !== false){
                                   $leading_word = '';
                                   $trailing_word= '';
                                   $words = explode($search_keyword, $next_sub_string);
                                   foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }

                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }

                                   }

                                   $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

                               }
                           }
                           }
                           /*[End:: Check if search keyword available in short description]*/

                           /*[start:: Check if search keyword available long description]*/

                           else if (stripos($long_desc, $search_keyword) !== false){  

                                   $leading_word = '';
                                   $trailing_word= '';
                                   $words = explode($search_keyword, $long_desc);
                                  foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }

                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }

                                   }
                             $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
                           }
                           /*[End:: Check if search keyword available in long description]*/

                           /*[start:: Check if search keyword available material]*/

                           else if (stripos($material, $search_keyword) !== false){  


                             $description = $pre_sub_string.".. Material : ".$material;
                           }
                           /*[End:: Check if search keyword available in material]*/

                           /*[start:: Check if search keyword available color]*/

                           else if (stripos($color, $search_keyword) !== false){  


                             $description = $pre_sub_string.".. Color : ".$color;
                           }
                           /*[End:: Check if search keyword available in color]*/

                       ?>
                         <li>
                           <div class="searchMain-probox clearfix"> 
                               <a class="likeico" href="javascript:void(0);" onclick="saveFavorite('Product', 'marketseller',<?php echo $row['product_id']; ?>);"><i  class="fa fa-heart <?php
                                       if (in_array($row['product_id'], $customerFavoriteProduct)) {
                                           echo ' heartRed';
                                       }
                                       ?>" aria-hidden="true" ></i></a> 
                               <a class="" target="_blank" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>">
                                 <div class="searchMain-proboxImg"> 
                                     <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"> 
                                 </div>
                               </a>
                             <div class="searchMain-probox-titl"> 
                                 <a class="" href="javascript:void(0);">                                  
                                 <?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['product_name']); ?>
                                 </a> 
                             </div>                                                         
                             <div class="searchMain-probox-subtxt"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$description);?></div>
                           </div>
                         </li>
                       <?php } ?>  
                       </ul>
                       <div class="clearfix"></div>
                     </div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="col-sm-12" style="margin-bottom: 10px;">
                       <div id="product_loader" class="loader" style="display:none;"></div>
                       <div class="loadMore-btn clearfix" id="loadMoreProduct" <?php if( $totalProductCount<=24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
                   </div>
                 </div>

                 <div class="row fillterBtnM stickFT  visible-xs">
                   <div class=" "> <a href="javascript:void(0);" class="FilterBtn">Filters</a> </div>
                 </div>

               </div>
      <!--------------- [searchTb01] --------------->

    <!--------------- [searchTb02]------------- -->
               <div role="tabpanel" class="tab-pane <?php if((empty($product_list )&&(empty($portfolio_list )))){ ?> active <?php }?>" id="searchTb02">
                 <input type="hidden" name="designer_offset" id="designer_offset" value="<?php echo $limit; ?>">
                 <input type="hidden" name="totalDesignerCount" id="totalDesignerCount" value="<?php echo $totalDesignerCount;?>">
                 <div class="searchRlt-desiger-Row ">
                   <ul id="append_designer">
                   <?php   foreach ($disigner_list as $row) { 

                           $string = strip_tags($row['introduction']);
                           $designer_description = strip_tags($row['designer_description']);
                           $design_philosophy = strip_tags($row['design_philosophy']);
                           $design_awards = strip_tags($row['design_awards']);
                           $pre_sub_string = substr($string,0,$char_limit);
                         //$description='';
                           $description=$pre_sub_string;

                           /*[start::Code to Handel character limit if word is break.]*/
                           $string_pos = stripos($string, $search_keyword)+1;
                           $string_length = strlen($search_keyword);
                           if(($char_limit+$string_length)< $string_pos){
                               $char_limit = $char_limit+$string_length;
                           }
                           /*[End::Code to Handel character limit if word is break.]*/

                            /*[start:: Check if search keyword available introduction]*/
                           if (stripos($string, $search_keyword) !== false){

                           if (stripos($pre_sub_string, $search_keyword) !== false){

                               $description = $pre_sub_string;
                           }else{

                                $next_sub_string = substr($string,$char_limit);
                               if (stripos($next_sub_string,$search_keyword) !== false){
                                  $leading_word = '';
                                  $trailing_word= '';
                                  $words = explode($search_keyword, $next_sub_string);

                                  foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }
                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }

                                   }

                                   $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

                               }
                           }
                           }
                           /*[End:: Check if search keyword available in introduction]*/

                           /*[start:: Check if search keyword available designer_description]*/

                           else if (stripos($designer_description, $search_keyword) !== false){  

                                  $leading_word = '';
                                  $trailing_word= '';                              
                                  $words = explode($search_keyword,$designer_description);

                                  foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }

                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }

                                   }

                              $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

                           }
                           /*[End:: Check if search keyword available in designer_description]*/

                            /*[start:: Check if search keyword available in design_philosophy]*/

                           else if (stripos($design_philosophy, $search_keyword) !== false){  

                                  $leading_word = '';
                                  $trailing_word= '';
                                  $words = explode($search_keyword, $design_philosophy);
                                  foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }

                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }
                                   }
                             $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
                           }
                           /*[End:: Check if search keyword available in design_philosophy]*/

                            /*[start:: Check if search keyword available in design_awards]*/

                           else if (stripos($design_awards, $search_keyword) !== false){  

                                  $leading_word = '';
                                  $trailing_word= '';
                                  $words = explode($search_keyword, $design_awards);
                                  foreach($words as $key => $word_row){
                                       $split_word = explode(' ',$word_row);
                                       $split_word = array_filter($split_word);
                                       if($key==0){                                       
                                       $leading_word =" ".array_pop($split_word);
                                       $leading_word =array_pop($split_word)." ".$leading_word;                                        
                                       }

                                       if($key==1){
                                       $trailing_word.=" ".array_shift($split_word);
                                       $trailing_word.=" ".array_shift($split_word);
                                       }
                                   }
                             $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
                           }
                           /*[End:: Check if search keyword available in design_awards]*/


                       ?>
                     <li>
                       <div class="searchRlt-desigerbox clearfix">
                       <a target="_blank" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'].'?q=d';?>">
                         <div class="searchRlt-desiger-img"> 
                             <?php if(!empty($row['designer_logo'])){ ?>
                             <img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo'];?>" alt="<?php echo $row['designer_name']; ?>"> 
                             <?php } ?>
                         </div>
                             <div class="searchRlt-desiger-name"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['designer_name']); ?></div>
                             <div class="searchRlt-desiger-loction"><i class="fa fa-map-marker"></i> <?php echo $row['countryName'];?></div>
                             <div class="searchRlt-desiger-des"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$description); ?></div>
                       </a>
                       </div>
                     </li>
                   <?php }  ?>                    
                   </ul>
                   <div class="clearfix"></div>
                 </div>
                 <div class="clearfix"></div>
                   <div class="col-sm-12" style="margin-bottom: 10px;">
                      <div id="designer_loader" class="loader" style="display:none;"></div>
                      <div class="loadMore-btn clearfix" id="loadMoreDesigner" <?php if( $totalDesignerCount<=24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
                  </div>
               </div>
     <!--------------- [searchTb02] --------------->

     <!--------------- [searchTb03] --------------->
               <div role="tabpanel" class="tab-pane <?php if((empty($product_list )&&(empty($disigner_list )))){ ?>active<?php }?>" id="searchTb03">
                <input type="hidden" name="portfolio_offset" id="portfolio_offset" value="<?php echo $limit; ?>">
                <input type="hidden" name="totalPortfolioCount" id="totalPortfolioCount" value="<?php echo $totalPortfolioCount;?>">
                 <div class="row">
                   <div class="search-result-Row search-execution-Row">
                     <ul id="append_portfolio">

                     </ul>
                   <div class="clearfix"></div>
                   <div class="col-sm-12" style="margin-bottom: 10px;">
                       <div id="portfolio_loader" class="loader" style="display:none;"></div>
                       <div  class="loadMore-btn clearfix" id="loadMorePortfolio" <?php if( $totalPortfolioCount<=24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
                   </div>
                   </div>
                 </div>
               </div>
     <!--------------- [searchTb03] --------------->

             </div>
         <?php } ?>
        </div>
      </div>
    </div>
      
      
      
  </section>
  <?php include('vw_search_mobile_view.php');?>
</div>

<!--------------[ Middle Section ]-------------> 

<script src="<?php echo base_url().SitePath; ?>assets/js/jquery-listnav.js?v=0.3"></script>
<script src="<?php echo base_url().SitePath; ?>assets/js/search.js?v=0.2"></script>

<?php if((empty($product_list)) && (empty($designer_list))) { ?>
<script>
 load_portfolio_first_time();

</script>
<?php  } ?>
<?php
$this->load->view('section/vw_footer');
?>

 
    
    
