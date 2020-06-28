<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
if(!empty($_GET['q'])){
$q = $_GET['q']; 

}else{
   $q  = ''; 
}

$brand_id = $brand_details[0]['brand_id'];

/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');


?>


<!--------------[ Middle Section ]-------------> 


<section class="brand-v1">
<?php include('vw_brand_breadcrumb.php'); ?>
<?php if(!empty($brand_details[0]['brandBnrImg'])){ ?>
<div class="brand-v1-slider ">
    <?php if((empty($brand_details[0]['brandBgColor'])) && (empty($brand_details[0]['brandTileImg']))){ ?>
    <img class="imgBlur visible-sm visible-md visible-lg" src="<?php echo image_url; ?>media/images/ecom/brand/brandBnrImgs/<?php echo $brand_details[0]['brandBnrImg']; ?>">
    <?php }?>
    <div id="Brand-v1-slider" class="owl-carousel visible-sm visible-md visible-lg">
       <a  <?php if(!empty($brand_details[0]['brandBnrImgURL'])){ ?> target="_blank" href="<?php echo $brand_details[0]['brandBnrImgURL'];?>" <?php } else { ?> href="javascript:void(0);" class="cursor-default" <?php } ?>>
            <div class="item" style=" background:<?php echo $brand_details[0]['brandBgColor']; ?> url(<?php echo image_url; ?>media/images/ecom/brand/brandBnrImgs/<?php echo $brand_details[0]['brandTileImg']; ?>) repeat;"> 
                <img src="<?php echo image_url; ?>media/images/ecom/brand/brandBnrImgs/<?php echo $brand_details[0]['brandBnrImg']; ?>"> 
            </div>       
        </a>  
    </div>
<!-- --------------Mobile img Show-------------------> 
<?php if(!empty($brand_details[0]['brandBnrImg'])){ ?>
  <div  class="BrandV-imgGallary visible-xs">
    	<ul>
            <li>
                <a <?php if(!empty($brand_details[0]['brandBnrImgURL'])){ ?> href="<?php echo $brand_details[0]['brandBnrImgURL'];?>" <?php } else { ?> href="javascrpit:void(0);" class="cursor-default"  <?php } ?>>
                    <img src="<?php echo image_url; ?>media/images/ecom/brand/brandBnrImgs/<?php echo $brand_details[0]['brandBnrImg']; ?>">
                </a>
            </li>
        </ul>
    </div>
<?php } ?>
<!-- --------------Mobile img Show-------------------> 
</div>
<?php } ?>
<div class="clearfix"></div>

<div class="Brand-heading-logo clearfix">
<div class="container">
    <div class="row">
        <?php if(!empty($brand_details[0]['brand_image'])){ ?>
    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="Brand-V1-logo">
            	<img src="<?php echo image_url; ?>media/images/ecom/brand/200X110/<?php echo $brand_details[0]['brand_image']; ?>" >
            </div>
        </div>
        <?php } ?>
        
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
           <div class="BrandV1-des">
               <?php if($brand_details[0]['brand_description']) {?>
                <p><?php echo $brand_details[0]['brand_description']; ?></p>
               <?php } ?>
<!--                <a class="brandv1-btn" href="<?php echo base_url().urlencode(strtolower($brand_details[0]['brand_name'])).'?brandID='.$brand_details[0]['brand_id'].'&pageType=BLP&q='.$q;?>">View All Products</a>-->
                <a class="brandv1-btn" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($brand_details[0]['brand_name'])))).'?brandID='.$brand_details[0]['brand_id'].'&pageType=BLP&q='.$q;?>">View All Products</a>
            </div>
        </div>    
    </div>
</div>
</div>
<?php
$i=0;
$section_name ="";
$offset=0;
foreach ($tmp_section_details as $row) { 
  
    
    if(!empty($row['mood_vertical_img'])){
         $limit = 4;
    }else{
         $limit = 6;
    }
    $arr_product_id = array();
    if(!empty($row['product_ids'])) {
    $arr_product_id = explode(',',$row['product_ids']);
    }
    $exit_product_list =array();
    /*if existing product id  available*/
    if(!empty($arr_product_id)){
    $exit_product_list = $this->Md_brand->productList($arr_product_id,$offset=0,$limit,$brand_id);
    }
    //echo "<pre>"; print_r($exit_product_list);die;
    $product_list=array();
    $view_all_url = "";
    if($row['type']=="CAT"){  
        $cat_details = $this->Md_brand->getCatDetails($row['type_id']); 
        //$view_all_url = base_url().'productlist/'.$cat_details[0]['cat_id'].'/'.urlencode($cat_details[0]['cat_name']).'?q='.$q;
        $view_all_url = base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($cat_details[0]['cat_name'])))).'?catID='.$cat_details[0]['cat_id'].'&brandID='.$brand_details[0]['brand_id'].'&pageType=BLP&q='.$q;
        $cat_id =$row['type_id'];
        $count_existing_product = count($exit_product_list);
        $new_limit = $limit - $count_existing_product;  
        $cat_product_list= array();
        if($new_limit > 0){
        $cat_product_list = $this->Md_brand->productListByCategory($arr_product_id,$cat_id,$offset,$new_limit,$brand_id);
        }

        $product_list = array_merge($exit_product_list,$cat_product_list);
         
        $section_name = $cat_details[0]['cat_name'];
    }else  if($row['type']=="SOH"){
        $section_details = $this->Md_brand->getSectionDetails($row['type_id']);
        $view_all_url = base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($section_details[0]['title'])))).'?sohID='.$section_details[0]['id'].'&brandID='.$brand_details[0]['brand_id'].'&pageType=BLP&q='.$q;
        $section_id =$row['type_id'];
        $count_existing_product = count($exit_product_list);
        $new_limit = $limit - $count_existing_product;  
        $section_product_list= array();
        if($new_limit > 0){
        $section_product_list = $this->Md_brand->productListBySection($arr_product_id,$section_id,$offset,$new_limit,$brand_id);
        }
        $product_list = array_merge($exit_product_list,$section_product_list);
        $section_name = $section_details[0]['title'];
    }
    if($i%2==0){
    ?>
    <?php if(!empty($row['mood_horizontal_img'])){ ?>
<!--    <div class="BraddV-lisfStyle-Banner">
        <div class="container">
            <div class="Brand-lisfStyle-Banner" class="owl-carousel">
            <div class="item"> <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['mood_horizontal_img']; ?>"> </div>        
        </div>
        </div>
    </div>-->
    <?php } ?>
    <div class="BrandV1-product-list">
        <div class="container">
            <div class="col-md-12 "> 
                <div class="row">
                    <ul>
                      <?php if(!empty($row['mood_vertical_img'])){ ?>
                        <li> 
                            <a <?php if(!empty($row['mood_vertical_img_url'])){ ?>  target="_blank" href="<?php echo $row['mood_vertical_img_url'];?>" <?php } else { ?> href="javascript:void(0);" class="cursor-default" <?php } ?>>
                                <div class="BrandV1-product-list-box">
                                    <div class="firstBigImage">
                                    <div class="Vprduct-Hd">
                                        <?php echo $section_name; ?>
                                    </div>
                                        <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['mood_vertical_img']; ?>">
                                    </div>

                                </div>
                            </a>
                        </li>
                      <?php } ?>  
                      <?php foreach ($product_list as $row) { ?>
                       <li> 
                        <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                        <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['product_name'])))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&page=brand&id=<?php echo $brand_id;?>">
                         <div class="BrandV1-product-list-box ">

                             <div class="BrandV1-img">
                                 <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>">

                             </div>
                             <div class="Bv1product-name clearfix"><?php echo $row['product_name'] ;?></div>
                         </div>
                         </a>
                       </li>                      
                      <?php } ?>    
                    </ul>
                    <div class="clearfix"></div>
                    <div class="Btn-BrandV">
                         <a class="brandv1-btn" href="<?php echo $view_all_url;?>">View All <?php echo $section_name.' From '.$brand_details[0]['brand_name'];?> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else { ?>

<?php if(!empty($row['mood_horizontal_img'])){ ?>
<!--<div class="BraddV-lisfStyle-Banner">
    <div class="container">
       	<div class="Brand-lisfStyle-Banner" class="owl-carousel">
        <div class="item"> <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['mood_horizontal_img']; ?>"> </div>        
    </div>
    </div>
</div>-->
<?php } ?>
<div class="BrandV1-product-list BrandV1-product-list-second">
    <div class="container">
        <div class="col-md-12 "> 
            <div class="row">
                <ul>
                    <?php if(!empty($row['mood_vertical_img'])) { ?>
                       <li> 
                        <a <?php if(!empty($row['mood_vertical_img_url'])){ ?>  target="_blank" href="<?php echo $row['mood_vertical_img_url'];?>" <?php } else { ?> href="javascript:void(0);" class="cursor-default" <?php } ?>>
                            <div class="BrandV1-product-list-box">
                                <div class="firstBigImage">
                                <div class="Vprduct-Hd">
                                <?php echo $section_name; ?>
                                </div>
                                    <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['mood_vertical_img']; ?>">
                                </div>
                            </div>
                        </a>
                       </li>
                    <?php } ?>   
                    <?php foreach ($product_list as $row) { ?>   
                        <li> 
                            <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                            <a class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&page=brand&id=<?php echo $brand_id;?>">
                             <div class="BrandV1-product-list-box ">
                                 <div class="BrandV1-img">
                                     <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>">

                                 </div>
                                 <div class="Bv1product-name clearfix"><?php echo $row['product_name'] ;?></div>
                             </div>
                             </a>
                        </li> 
                    <?php } ?>  

                    </ul>
                <div class="clearfix"></div>
                <div class="Btn-BrandV">
                     <a class="brandv1-btn" href="<?php echo $view_all_url;?>"><?php echo $section_name.' From '.$brand_details[0]['brand_name'];?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }//else

 $i++; } ?>

<?php if(!empty($brand_details[0]['brandVdoUrl'])){ ?>
<div class="videoBg clearfix">
           <iframe autoplay="on" width="560" height="315" src="<?php echo $brand_details[0]['brandVdoUrl']; ?>" frameborder="0" allowfullscreen></iframe>
	<!--<a class="video-play" href="#"> <img src="img/vplay.png"></a>-->
</div>
<?php } ?>

<?php
if(!empty($horizontal_page_mood_images)){    ?>
  <div class="container">
      <div class="brand-v1-slider ">
          <div id="Brand-v1-slider_1" class="owl-carousel">
          <?php foreach($horizontal_page_mood_images as $row) { ?>
          <a  <?php if(!empty($row['imgURL'])){ ?> target="_blank" href="<?php echo $row['imgURL'];?>" <?php } else { ?> href="javascript:void(0);" class="cursor-default"  <?php } ?>>
              <div class="item" > 
                  <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['image_name']; ?>"> 
              </div>       
          </a> 
          <?php } ?>
          </div>
      </div>
  </div>
  <?php } ?>

<?php if(!empty($vertical_page_mood_images)) { ?>  
   
<div class="Brand-threeImgs clearfix">
<!--    <div class="BrndV-img-capt">
    “Imagine chairs, tables and lamps in their basic, elegant forms, reduced to the purity of thought.<br>
    Yielding to the caress of sunlight and wind, they take on the dignified color of passing years.”
    </div>-->
<?php foreach($vertical_page_mood_images as $row){ ?>
    <div class="BrandV3img">
            <a <?php if(!empty($row['imgURL'])){ ?>  target="_blank" href="<?php echo $row['imgURL'];?>" <?php } else { ?> href="javascript:void(0);" class="cursor-default" <?php } ?>>
                <img src="<?php echo image_url; ?>media/images/ecom/brand/brandMoodImgs/<?php echo $row['image_name']; ?>">
          </a>
    </div>
<?php } ?>

</div>
<?php } ?>


</section>

</div>

<!--------------[ Middle Section ]-------------> 
<?php
/* If scroll position is set in session ]*/
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>
