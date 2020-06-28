<?php $this->load->view('section/vw_header_1'); ?>
<link href="<?php echo base_url() . SitePath; ?>assets/css/plp.css?v=1.7" rel="stylesheet">

<?php
$this->load->view('section/vw_header_2');
if (!empty($_GET['q'])) {
    $q = $_GET['q'];
} else {
    $q = '';
}

if (!empty($_GET['pageType'])) {
    $pageType = $_GET['pageType'];
} else {
    $pageType = '';
}

/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

?>

<!--------------[ Middle Section ]------------->
<div class=" visible-sm visible-md visible-lg">
<section class="plp-section stickDiv">
    <div class="breadcrumb-main"> 

        <?php $this->load->view('generic_listing/vw_generic_listing_bread_crumbs'); ?>
        
    </div>
    <div class="clearfix"></div>
    <div class="catogory-nav-slider ">
        <div class="container">
            <div class="catogory-navHeading"> 
                
                <!--<h2><?php echo $page_heading; ?></h2>-->          
                <h1 style="font-size: 26px;display: inline-block;"><?php echo $page_heading; ?></h1>          
                <span><?php  echo $totalCount[0]['totalCount']; ?> PRODUCTS </span>
				</div>
              <?php if(!empty($brand_details) ){ ?>
              <div class="Blp-TopSect clearfix">
                <?php if(!empty($brand_details[0]['brand_image'])){ ?>
                <div class="blptop-left">
                 <div class="BlpImg">
                     <img src="<?php echo image_url; ?>media/images/ecom/brand/200X110/<?php echo $brand_details[0]['brand_image']; ?>" alt="<?php echo $page_heading; ?>">
                 </div>    
                 </div>
                <?php } ?>
                <?php if(!empty($brand_details[0]['brand_description'])) {
                 if(strlen(strip_tags($brand_details[0]['brand_description'])) > 300){
                    ?>
                 <div class="blptop-right less ">
                 <div class="overfolw-hidden">
                  <?php   // echo substr(strip_tags($brand_details[0]['brand_description']),0,200);?>
                 <p><?php echo substr(strip_tags($brand_details[0]['brand_description']),0,300); ?>...<a style="cursor:pointer;" class="read_more">[read more]</a></p>
                 </div>
                 </div>
                 <?php } ?>
                 <div class="blptop-right more overfolw-hidden" <?php if(strlen(strip_tags($brand_details[0]['brand_description'])) > 300){
                 ?> style="display:none;" <?php } ?>>
                 <p><?php echo (($brand_details[0]['brand_description'])); ?></p>
                  <?php if(strlen(strip_tags($brand_details[0]['brand_description'])) > 300){
                    ?>
                 <a style="cursor:pointer;"  class="read_less">[read less]</a>
                  <?php } ?>
                 </div>
                <?php } ?>
                 <div class="clearfix"></div>
               </div>
            <?php } ?>
            <div id="Catogory-navSlider" class="owl-carousel">
               <?php if(($pageType=="PLP") && (empty($cat_id))){ 
               $soh_details = $this->Md_generic_listing->get_soh_details($selected_soh);
               ?>
                <div class="count item  active"> 
                    <a  href="<?php echo base_url().strtolower($soh_details[0]['title']).'?sohID='.$soh_details[0]['id'].'&pageType=PLP&q=l';?>" > <span> View All 
                            <br><?php echo  $soh_details[0]['title']; ?>       </span> 
                    </a> 
                </div>
               <?php } else if(($pageType=="PLP") && (!empty($cat_id))){  
                    // $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);
                   ?>

                
                 <div class="count item <?php if($parent_cat_details[0]['cat_id'] == $cat_id ) { ?> active<?php } ?>"> 
                    <a <?php if(!empty($parent_cat_details)) { ?> href="<?php echo base_url().strtolower($parent_cat_details[0]['cat_name']).'?catID='.$parent_cat_details[0]['cat_id'].'&pageType=PLP&q=l';?>" <?php } else { ?> href="javascript:void(0);" <?php } ?>>  
                        <span> <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $parent_cat_details[0]['cat_image'];?>" alt="<?php echo !empty($parent_cat_details)? $parent_cat_details[0]['cat_name']: ""; ?>"> </span>
                            <div class="prd-ttle">View All  <?php echo !empty($parent_cat_details)? $parent_cat_details[0]['cat_name']: ""; ?></div>
                        </a>
                    </div> 

<!--                <div class="count item  active"> 
                    <a  href="<?php echo base_url().strtolower($cat_details[0]['cat_name']).'?catID='.$cat_details[0]['id'].'&pageType=PLP&q=l';?>" > <span> View All 
                            <br><?php echo  $cat_details[0]['title']; ?>       </span> 
                    </a> 
                </div>-->
               <?php }
                   if($pageType=="BLP"){
                       /* If child categories exist + If there were multiple top level categories*/
                       $show_flag =0;
                       if((!empty($cat_id))){
                        $child_cat_list = $this->Md_generic_listing->get_child_cat($cat_id);
                        if((count($parent_array)> 1) && (!empty($child_cat_list))){
                        $show_flag =1;  
                        }
                       }
                       if((!empty($selected_brand) && (empty($cat_id))) || ($show_flag == 1)){
                          //if(($pageType=="BLP")){
                            $brand_details = $this->Md_generic_listing->get_brand_details($selected_brand);
                            ?>
                           <div class="count item <?php if(empty($cat_id)) { ?> active <?php } ?>"> 
                             <a  href="<?php echo base_url().strtolower($brand_details[0]['brand_name']).'?brandID='.$brand_details[0]['brand_id'].'&pageType='.$pageType.'&q=l';?>" > <span> View All 
                                     <br><?php echo  $brand_details[0]['brand_name']; ?>       </span> 
                             </a> 
                         </div>
                      <?php  }
                        if((!empty($cat_id))){
                        $brand_details = $this->Md_generic_listing->get_brand_details($selected_brand);
                        $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);
                        //print_r($cat_details);die;
                        ?>

                       <div class="count item"> 
                         <a  href="<?php echo base_url().urlencode(strtolower($brand_details[0]['brand_name'])).'/'.urlencode(strtolower($brand_details[0]['brand_name'])).'?brandID='.$brand_details[0]['brand_id'].'&catID='.$cat_details[0]['cat_id'].'&pageType='.$pageType.'&q=l';?>" > 
                             <span> <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $cat_details[0]['cat_image'];?>" alt="<?php echo $cat_details[0]['cat_name']; ?>"> </span>
                             <div class="prd-ttle">View All  <?php  echo  $brand_details[0]['brand_name'].' '.$cat_details[0]['cat_name']; ?></div>
                         </a> 
                         </div>
                         <!--<div class="count item <?php if($parent_cat_details[0]['cat_id'] == $cat_id ) { ?> active<?php } ?>">--> 
                         <?php if($parent_cat_details[0]['cat_id']) { ?>
                         <?php //if($parent_cat_details[0]['cat_id'] != $cat_id) { ?>
                         <div class="count item <?php if($parent_cat_details[0]['cat_id'] == $cat_id) { ?> active <?php } ?>"> 
                             <a  href="<?php echo base_url().urlencode(strtolower($brand_details[0]['brand_name'])).'/'.urlencode(strtolower($brand_details[0]['brand_name'])).'?brandID='.$brand_details[0]['brand_id'].'&catID='.$parent_cat_details[0]['cat_id'].'&pageType='.$pageType.'&q=l';?>" > 
                             <!--<a <?php if(!empty($parent_cat_details)) { ?> href="<?php echo base_url().strtolower($parent_cat_details[0]['cat_name']).'?catID='.$parent_cat_details[0]['cat_id'].'&pageType=BLP&q=l';?>" <?php } else { ?> href="javascript:void(0);" <?php } ?>>-->  
                                 <span> <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $parent_cat_details[0]['cat_image'];?>" alt="<?php echo !empty($parent_cat_details)? $parent_cat_details[0]['cat_name']: ""; ?>"> </span>
                                     <div class="prd-ttle"><?php echo !empty($parent_cat_details)? $parent_cat_details[0]['cat_name']: ""; ?></div>
                                 </a>
                         </div> 
                        <?php } }
                        
                   }/*end if pagetype BLP*/
                foreach ($cat_list as $key => $row) { 
                    if($cat_id == $row['cat_id']){
                    //if($cat_id == $row['cat_id']&& ($pageType!="BLP")){
                        ?>
                      
                     <div class="count item active"> 
                        <?php if(($pageType=="BLP")) { ?>
                        <a href="<?php echo base_url().urlencode(str_replace(' ', '-', strtolower($brand_details[0]['brand_name']))).'/'.urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?brandID='.$brand_details[0]['brand_id'].'&catID='.$row['cat_id'].'&pageType=BLP&q=l';?>">                            
                        <?php } else { ?>
                        <a href="<?php echo base_url().urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?catID='.$row['cat_id'].'&pageType=PLP&q=l';?>">                            
                        <?php } ?>
                            <span> <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $row['cat_image'];?>" alt="<?php echo $row['cat_name']; ?>"> </span>
                            <div class="prd-ttle"><?php echo $row['cat_name']; ?></div>
                        </a>
                    </div>  
                    <?php }  } 
               
                  foreach ($cat_list as $key => $row) { 
                   if($cat_id != $row['cat_id']){
                    ?>
                    <div class="count item"> 
                        <?php if(($pageType=="BLP")) { ?>
                        <a href="<?php echo base_url().urlencode(str_replace(' ', '-', strtolower($brand_details[0]['brand_name']))).'/'.urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?brandID='.$brand_details[0]['brand_id'].'&catID='.$row['cat_id'].'&pageType=BLP&q=l';?>">                            
                        <?php } else { ?>
                        <a href="<?php echo base_url().urlencode(str_replace(' ', '-', strtolower($row['cat_name']))).'?catID='.$row['cat_id'].'&pageType=PLP&q=l';?>">                            
                        <?php } ?>
                            <span> <img onerror="$(this).hide();" src="<?php echo image_url; ?>media/images/ecom/category/<?php echo $row['cat_image'];?>" alt="<?php echo $row['cat_name']; ?>"> </span>
                            <div class="prd-ttle"><?php echo $row['cat_name']; ?></div>
                        </a>
                    </div>            
                  <?php } } ?>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
  <form id="form" name="form" method="post" action="<?php echo base_url(); ?>generic-listing-action">  
   
    <input type="hidden" id="q" name="q" value="<?php echo $q; ?>">
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
    var q = '<?php echo $q; ?>';

    </script>

    <input type="hidden" id="selected_brand" name="selected_brand_id" value="<?php echo $brand_string; ?>">
    <input type="hidden" id="selected_soh" name="selected_soh_id" value="<?php echo $soh_string; ?>">
    <input type="hidden" id="selected_cor" name="selected_cor" value="<?php echo $cor_string; ?>">
    <input type="hidden" id="cat_name" name="cat_name" value="<?php echo $cat_name; ?>">

      
      <div class="nav-tabss ThreeTab-section-wrap">
    	  <?php if(!empty($brand_list)) { ?>
            <div <?php if($pageType == "BLP"){ ?>  style="display:none;"  <?php } ?> class="mgdrop">
                <a href="#" class="mgtabs" onmouseover="ajaxGetFilterDetails();">BRANDS <span class="caret"></span></a>
                <div class="meag-drop">
                    <div id="brands" class="container">
                        
                    </div>
                </div>
            </div>
            <?php } if(!empty($section_list)) { ?>
             <div class="mgdrop">
                <a href="#" class="mgtabs" onmouseover="ajaxGetFilterDetails();">SECTION OF HOUSE <span class="caret"></span></a>
            	<div class="meag-drop">
                    <div id="SOH" class="container">
                       
                    </div>
                </div>
            </div>
          
           <?php } if(!empty($country_list)) { ?> 
             <div <?php if($pageType == "BLP"){ ?>  style="display:none;"  <?php } ?> class="mgdrop">
                <a href="#" class="mgtabs" onmouseover="ajaxGetFilterDetails();">COUNTRY OF ORIGIN <span class="caret"></span></a>
                <div class="meag-drop">
                    <div id="COR" class="container">

                    </div>
                </div>
            </div>
          <?php }  ?>
    </div>
  </form>


    <div class=" apliedfillter-wrap clearfix"> 
        <div class="container">
            <div class="col-md-12">
                <div class="applied-filter">
                    <ul> 

                        <li id="brand_list"> 
                            <?php
                            if($pageType != "BLP"){ 
                            foreach ($brand_list as $row) {
                                if (in_array($row['brand_id'], $selected_brand)) {
                                    ?>
                                    <p class="remove_all" id="brand_fliter_option<?php echo $row['brand_id']; ?>"><a href="javascript:void(0);" onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="filtered-brand"><?php echo $row['brand_name']; ?></a>  <a onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="remove-icon"> X </a> </p>
                                    <!--<p class="remove_all" id="brand_fliter_option<?php echo $row['brand_id']; ?>"><a href="javascript:void(0);" onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="filtered-brand"><?php //echo $row['brand_name'].' ('.$product_count_by_brand[0]['ProductCount'].')'; ?></a>  <a onclick="remove_brand_filter(<?php echo $row['brand_id']; ?>);" class="remove-icon"> X </a> </p>-->
                                    <?php
                                }
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
                                        <!--<a href="javascript:void(0);" onclick="remove_soh_filter(<?php echo $row['id']; ?>);" class="filtered-brand"><?php //echo $row['title'].' ('.$product_count_by_soh[0]['ProductCount'].')'; ?></a>--> 
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
                                    <!--<p class="remove_all" id="cor_fliter_option<?php echo $row['countryName']; ?>"><a href="javascript:void(0);" onclick="remove_cor_filter('<?php echo $row['countryName']; ?>');" class="filtered-brand"><?php //echo $row['countryName'].' ('.$product_count_by_cor[0]['ProductCount'].')'; ?></a>  <a onclick="remove_cor_filter('<?php echo $row['countryName']; ?>');" class="remove-icon"> X </a> </p>-->
                                    <?php
                                }
                            }
                            ?>
                        </li>

                        <!--<li><a class="clear-all"  href="<?php echo base_url().'allproducts';?>">Clear All</a> </li>-->
                        <li><a class="clear-all" onclick="clear_all_filter();" href="javascript:void(0);">Clear All</a> </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
</div>
<div class="clearfix"></div>

<?php include('vw_generic_listing_mobile_view.php');?>

<div class=" visible-sm visible-md visible-lg">
<section class="plp-porduct-listing-secttion">
<div class="sect-wrap clearfix"></div> 
    <div class="container">
        <?php if (!empty($product_list)) { ?>
            <ul>
                <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
                <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount']; ?>">
                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>">
                <?php $Favoritestring = implode(',', $customerFavoriteProduct); ?>
                <input type="hidden" name="customerFavoriteProduct" id="customerFavoriteProduct" value="<?php echo $Favoritestring; ?>">
                <input type="hidden" name="id" id="id" value="<?php echo $cat_id; ?>">
                <?php if(($page_name=="PLP")&&(!isset($_GET['catID'])&&(isset($_GET['sohID'])))){ ?>
                <input type="hidden" name="page" id="page" value="section">
                <?php } else { ?>
                <input type="hidden" name="page" id="page" value="<?php echo $page_name; ?>">
                <?php } ?>
                <div id='append'>            
                    <?php foreach ($product_list as $key => $row) { ?>   
                        <li>
                            <div class="plp-listimg">
                                <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller' . $row['product_id']; ?>" class="fa fa-heart <?php
                                    if (in_array($row['product_id'], $customerFavoriteProduct)) {
                                        echo ' heartRed';
                                    }
                                    ?>" aria-hidden="true" onclick="saveFavorite('Product', 'marketseller',<?php echo $row['product_id']; ?>);"></i></a>
                               <?php if(($page_name=="PLP")&&(!isset($_GET['catID'])&&(isset($_GET['sohID'])))){ ?>
                                <a class="add_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=section"> 
                               <?php } else {?>
                               <a class="add_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>"> 
                                <?php } ?>  
                                   <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                                </a>    
                            </div>
                            <div class="plp-list-name">
                                <?php echo $row['product_name']; ?>
                            </div>

                        </li>
                    <?php } ?>  
                </div> 
            </ul> 
        <?php } else { ?>
            <div class="alert alert-gray">
                <strong>Sorry, No products found</strong> 
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <div class="plp-loadmore">
        <div class="loader" style="display:none;"></div>
        <div class="loadMore-btn clearfix" id="loadMore" <?php if ($totalCount[0]['totalCount'] <= 24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
    </div>
    
</section>
<?php if(!empty($seo_content)){ ?>
 <section class="seo-text-section clearfix">
  <div class="container">
    <div class="seo-text clearfix">
      <?php echo $seo_content; ?>
   </div>
  </div>
</section>
<?php } ?> 
    
</div>
</div>

<!--------------[ Middle Section ]-------------> 
<script src="<?php echo base_url().SitePath; ?>assets/js/jquery-listnav.js?v=0.3"></script>
<script src="<?php echo base_url().SitePath; ?>assets/js/generic_listing/generic_listing.js?v=1.2" type="text/javascript"></script>
<?php
/* If scroll position is set in session ] */
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>