<?php
$this->load->view('section/vw_header_1');

?>
<link href="<?php echo base_url().SitePath; ?>assets/css/jquery.jqzoom.css?v=1.1" rel="stylesheet">

<?php
$this->load->view('section/vw_header_2');

if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
$id="";
$page = '';
if(!empty($_GET['page'])){ 
    
$page = $_GET['page'];
$id = $_GET['id'];
//
//if($page=="category"){
//$cat_id = $id;
//$nav_cat_details = $this->Md_product->getCatDetails($cat_id); 
//}
//
//if($page=="section"){
//$section_id = $id;
//$section_details = $this->Md_product->getSectionDetails($section_id); 
//}
//if(($page=="PLP")&&(!isset($_GET['catID'])&&(isset($_GET['sohID'])))){
//$section_id = $_GET['sohID'];
//$section_details = $this->Md_product->getSectionDetails($section_id); 
//}
if($page=="featured"){
$featured_id = $id;
if($featured_id=="1"){
    $featured_details = "Decorative Art";
}else{
    $featured_details = "Collectibles";
}
}

//
if($page=="bespoke_portfolio"){
$seller_id = $id;
$seller_details = $this->Md_product->getSellerDetails($seller_id); 
}

}else{  $page = ''; }


/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

?>


  <!--------------[ Middle Section ]------------->
  <section class="Product-Details-V2 clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="#">Lifestyle Products</a></li>
       <?php  if(($page=="BLP") || ($page=="brand") && (!empty($brand_details))){ ?>
         <li><a href="<?php echo base_url(); ?>all-brands">All Brands</a></li>
         <li>
            <?php  
           if(!empty($brand_details[0]['brandPageDesignType'])){                       
           ?>   
           <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($brand_details[0]['brand_name'])))).'/b/'.$brand_details[0]['brand_id'].'?q=l';?>"> 
           <?php } else { ?>
           <a href="<?php echo base_url(); ?><?php echo urlencode( $brand_details[0]['brand_url_name']) ;?>?brandID=<?php echo $brand_details[0]['brand_id']; ?>&pageType=BLP&q=l"> 
           <?php } ?>
           <?php echo $brand_details[0]['brand_name'];?>
           </a>
         </li>
        <!--<li><a href="<?php echo base_url(); ?>brand/<?php echo $brand_details[0]['brand_id']; ?>/<?php echo urlencode($brand_details[0]['brand_name']) ;?>?q=<?php echo $q; ?>"><?php echo $brand_details[0]['brand_name']; ?></a></li>-->
       <?php }if($page=="PLP"){ ?>
        <li><a href="<?php echo base_url(); ?>all-categories">Category</a></li>
        <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($cat_details[0]['cat_name'])))) ;?>?catID=<?php echo $cat_details[0]['cat_id'];?>&pageType=PLP&q=l"><?php echo $cat_details[0]['cat_name']; ?></a></li>
       <?php }if($page=="section"){ ?>
         <li><a href="<?php echo base_url(); ?>all-sections">Section</a></li>
        <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($section_details[0]['title'])))) ;?>?sohID=<?php echo $section_details[0]['id'];?>&pageType=PLP&q=l"><?php echo $section_details[0]['title']; ?></a></li>
        <!--<li><a href="<?php echo base_url(); ?>sectionlist/<?php echo $section_details[0]['id']; ?>/<?php echo urlencode($section_details[0]['title']) ;?>?q=<?php echo $q; ?>"><?php echo $section_details[0]['title']; ?></a></li>-->
       <?php }if($page=="featured"){ ?>
        <li><a href="<?php echo base_url(); ?><?php echo strtolower(urlencode(str_replace($url_replace_char_array, '-', $featured_details))) ;?>/fl/<?php echo $featured_id;?>?q=l"><?php echo $featured_details; ?></a></li>
       <?php }if($page=="bespoke_portfolio"){ ?>
        <li><a href="<?php echo base_url(); ?>bespoke?q=<?php echo $q ;?>">Bespoke</a></li>
        <li><a href="<?php echo base_url(); ?>bespoke-portfolio/<?php echo $seller_details[0]['market_seller_id']; ?>/<?php echo urlencode($seller_details[0]['market_seller_name']) ;?>?q=<?php echo $q; ?>"><?php echo $seller_details[0]['market_seller_name']; ?></a></li>
       <?php } ?>
       <li class="active"><?php echo $product_details[0]['product_name'];?></li>
     </ol>
    </div>
    <div class="clearfix"></div>
    <div class="container">
      <div class="row">
        <div class="pdpleft sidebar">
            <div class="productDtl-gallry clearfix">
                <div class="clearfix" id="content"> 
                    <a  onclick="return disabled_click_event();" href="<?php echo image_url; ?>media/images/ecom/product-org/<?php echo $product_details[0]['product_image'];?>" class="jqzoom" rel='gal1'  title="triumph" > 
                        <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>"  title="triumph" alt="<?php echo $product_details[0]['product_name'];?>" > 
                    </a> 
                </div>
          
                 <!--[Start:: For Mobile view]-->
                  <div id="thumblist" class="clearfix" >
                    <div id="productDetail-Thumb" class="owl-carousel">
                        
                      <li class="item"> 
                          <a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>',largeimage: '<?php echo image_url; ?>media/images/ecom/product-org/<?php echo $product_details[0]['product_image'];?>'}"> 
                              <img src='<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>' alt="<?php echo $product_details[0]['product_name'];?>">
                          </a> 
                      </li>
                    <?php foreach($product_images as $row){ ?>  
                      <li class="item">
                          <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_sec_image'];?>',largeimage: '<?php echo image_url; ?>media/images/ecom/product-org/<?php echo $row['product_sec_image'];?>'}">
                              <img src='<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_sec_image'];?>' alt="<?php echo $product_details[0]['product_name'];?>">
                          </a> 
                      </li>
                    <?php } ?>  
                    </div>
                  </div>
                <!--[End:: For Mobile view]-->
               
            </div>
        </div>
        <div class="pdpright"  itemscope itemtype="http://schema.org/Product">
          <div class="productDtl-des  productDtl-des-new clearfix">
          <div class="stick">
          <div class="DtlTOpSect  clearfix">
          <h1 class="stickyHeaderDtl "  itemprop="name"><?php echo $product_details[0]['product_name'];?></h1>
            <?php 
              if(!empty ($brand_details[0]['brand_name'])){ ?>  
               <h3 class="brndnme"  itemprop="brand"><?php echo $brand_details[0]['brand_name'];?> </h3>
              <?php } ?>
                <div class="get-pricebtn"> 
                    <a href="javascript:void(0);" id="get_price" >Interested? Request Callback</a>
                    <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$product_details[0]['product_id'];?>" class="fa fa-heart <?php if(in_array($product_details[0]['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $product_details[0]['product_id'];?> );"></i></a>
                </div>
            <div class="clearfix"></div>
            <form id="formGetPrice" name="formGetPrice">
              <div class="pricerequest-form pricerequest-form-new" id="get_price_form" style="display: none;">
                 <?php if($this->session->userdata('customer_info')['customer_email']){
                    $customer_email = $this->session->userdata('customer_info')['customer_email'];
                    }else{$customer_email=""; }
                    if($this->session->userdata('customer_info')['customer_phone']){
                        $customer_phone = $this->session->userdata('customer_info')['customer_phone'];
                    }else{$customer_phone=""; }
                    if($this->session->userdata('customer_info')['customer_name']){
                        $customer_name = $this->session->userdata('customer_info')['customer_name'];
                    }else{$customer_name=""; }
                ?>
                 <div class="form-group frmgwidth">
                  <input placeholder="Name" name="user_name_pdp" id="user_name_pdp"   value="<?php echo $customer_name;?>" class="form-control" type="text">
                  </div>
                  <div class="form-group frmgwidth">
                    <input placeholder=" Email" name="email_pdp" id="email_pdp"  value="<?php echo $customer_email;?>" class="form-control" type="text">
                  </div>
                   <div class="form-group frmgwidth">
                     <input placeholder="Mobile" name="mobile_pdp" id="mobile_pdp"  value="<?php echo $customer_phone;?>" maxlength="15" class="form-control" type="text">
                  </div>
                  <div class="form-group text-left frmgwidth">
                    <button id="submit_button" type="submit" class="btn conectBtn ">Send Request</button>
                  </div>
               
                  <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_details[0]['product_id'];?>">
                  <input value="1" class="quantity-field " name="quantity" id="quantity" type="hidden">

              </div>
            </form>
            </div>
         </div>
              <?php  if(!empty ($product_details[0]['short_description'])){ ?>
              <p><?php echo $product_details[0]['short_description'];?></p>
              <?php } ?>
              <div class="product-Detail-List">
              <ul>
             <?php if(!empty ($product_material)){ ?>
                <li> 
                    <span> Material : </span> 
                    <span> <?php echo $product_material; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['length_width']) && $arrProductProperty['length_width']>0){ ?>
                <li> 
                    <span> Width : </span> 
                    <span> <?php echo $arrProductProperty['length_width'].' '.$arrProductProperty['length_width_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['breadth_depth']) && $arrProductProperty['breadth_depth']>0){ ?>
                <li> 
                    <span> Depth : </span> 
                    <span> <?php echo $arrProductProperty['breadth_depth'].' '.$arrProductProperty['breadth_depth_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['height'])&& $arrProductProperty['height']>0){ ?>
                <li> 
                    <span> Height : </span> 
                    <span> <?php echo $arrProductProperty['height'].' '.$arrProductProperty['height_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['volume'])&& $arrProductProperty['volume']>0){ ?>
                <li> 
                    <span> Volume : </span> 
                    <span> <?php echo $arrProductProperty['volume'].' '.$arrProductProperty['volume_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['weight'])&& $arrProductProperty['weight']>0){ ?>
                <li> 
                    <span> Weight : </span> 
                    <span> <?php echo $arrProductProperty['weight'].' '.$arrProductProperty['weight_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['diameter'])&& $arrProductProperty['diameter']>0){ ?>
                <li> 
                    <span> Diameter : </span> 
                    <span> <?php echo $arrProductProperty['diameter'].' '.$arrProductProperty['diameter_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['pkg_length'])&& $arrProductProperty['pkg_length']>0){ ?>
                <li> 
                    <span> Pkg. Length : </span> 
                    <span> <?php echo $arrProductProperty['pkg_length'].' '.$arrProductProperty['pkg_length_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['pkg_breadth'])&& $arrProductProperty['pkg_breadth']>0){ ?>
                <li> 
                    <span> Pkg. Breadth : </span> 
                    <span> <?php echo $arrProductProperty['pkg_breadth'].' '.$arrProductProperty['pkg_breadth_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['pkg_height'])&& $arrProductProperty['pkg_height']>0){ ?>
                <li> 
                    <span> Pkg. Height : </span> 
                    <span> <?php echo $arrProductProperty['pkg_height'].' '.$arrProductProperty['pkg_height_unit']; ?></span> 
                </li>
             <?php } ?>
             <?php if(!empty ($arrProductProperty['pkg_weight'])&& $arrProductProperty['pkg_weight']>0){ ?>
                <li> 
                    <span> Pkg. Weight : </span> 
                    <span> <?php echo $arrProductProperty['pkg_weight'].' '.$arrProductProperty['pkg_weight_unit']; ?></span> 
                </li>
             <?php } ?>
                
              <?php// if(!empty ($product_details[0]['brand_name'])){ ?>  
              <!--<li> <span> Brand  : </span> <span> <?php echo $product_details[0]['brand_name'];?> </span> </li>-->
              <?php// } ?>
            
            </ul>
            </div>

            <div class="description-Table" itemprop="description">
              <ul>
                <?php if(!empty($product_details[0]['product_details'])){ ?>
                <li>
                  <label> Description :</label>
                  <p><?php echo $product_details[0]['product_details'];?></p>
                </li>
                <?php } ?>
                <?php if(!empty($product_details[0]['properties'])){ ?>
                <li>
                  <label> Properties :</label>
                  <p><?php echo  $product_details[0]['properties']; ?> </p>
                </li>
                <li>
                <?php } if(!empty($product_details[0]['features'])){ ?>
                  <label> Features :</label>
                  <p><?php echo  $product_details[0]['features']; ?> </p>
                </li>
                <?php } if(!empty($product_details[0]['instructions'])){ ?>
                <li>
                  <label> Care Instructions :</label>
                  <p><?php echo  $product_details[0]['instructions']; ?> </p>
                </li>
                 <?php } if(!empty($product_details[0]['warranty'])){ ?>
                <li>
                  <label> Warranty :</label>
                  <p><?php echo  $product_details[0]['warranty']; ?> </p>
                </li>
                <?php } if(!empty($product_details[0]['returns'])){ ?>
                <li>
                  <label> Returns :</label>
                  <p><?php echo  $product_details[0]['returns']; ?> </p>
                </li>
                <?php } if(!empty($product_details[0]['quality_promise'])){ ?>
                <li>
                  <label> Quality Promise :</label>
                  <p><?php echo $product_details[0]['quality_promise']; ?></p>
                </li>
                <?php } if(!empty ($brand_details[0]['brand_name'])){ ?>  
                <li>
                  <label> About the brand :</label>
                  <p>
                      <?php if(!empty($brand_details[0]['brand_image'])){ ?>
                      <img class="pdp_brand_logo" src="<?php echo image_url; ?>media/images/ecom/brand/200X110/<?php echo $brand_details[0]['brand_image']; ?>" alt="<?php echo $brand_details[0]['brand_name'];?> " > 
                      <?php } ?>
                      <?php echo $brand_details[0]['brand_name'];?> <br> 
                      <?php if($brand_details[0]['brand_description']) {
                         echo $brand_details[0]['brand_description'];
                       } 
                       ?>
                  </p>
                </li>
                <?php } ?>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
    <div class="product-dtl-descriptions">
      <div class="container">
        <?php if((!empty($section_details[0]['title'])) || (!empty($cat_details[0]['cat_name']))){ ?>
        <ul class="nav nav-tabs" role="">  
          <?php if(!empty($section_details[0]['title'])){ ?>
<!--          <li>
              <a target="_blank" href="<?php echo base_url(); ?>sectionlist/<?php echo $section_details[0]['id'];?>/<?php echo urlencode( $section_details[0]['title']) ;?>?q=l">
                  View more <?php echo $section_details[0]['title']; ?>
              </a>
          </li>-->
          <?php } ?>
           <?php 
          if(!empty($cat_details)){
          foreach($cat_details as $row){ ?>
          <li>
              <!--<a target="_blank" href="<?php echo base_url(); ?>productlist/<?php echo $row['cat_id'];?>/<?php echo urlencode($row['cat_name']) ;?>?q=l">-->
              <a target="_blank" href="<?php echo base_url().urlencode(str_replace($url_replace_char_array, '-', strtolower($row['cat_name']))).'?catID='.$row['cat_id'].'&pageType=PLP&q=l'; ?>">
                  View more <?php echo $row['cat_name'];?>
              </a>
          </li>
          <?php } } ?>
          <?php 
//          if(!empty($sub_cat_details)){
//          foreach($sub_cat_details as $row){ ?>
<!--          <li>
              <a target="_blank" href="<?php echo base_url(); ?>productlist/<?php echo $row['cat_id'];?>/<?php echo urlencode($row['cat_name']) ;?>?q=l">
                  View more <?php echo $row['cat_name'];?>
              </a>
          </li>-->
          <?php// } } ?>
        </ul>
        <?php } ?>
       <?php if(!empty($brand_details)){ ?>
        <div class="tab-content">
          <div> 
          <h3>More Products From <?php echo $brand_details[0]['brand_name'];?></h3>
          	<div  id="ViewMoreSilder" class="owl-carousel ViewMoreSilder">
                  <?php  foreach ($product_list_by_brand as $row) { ?>
                        <div class="item">
                         <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                         <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']) ;?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page;?>">-->
                         <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>">
                             <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['product_name'];?>">  
                         </a>
                         
                         <div class="productName"> 
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page;?>"> 
                              <?php echo $row['product_name'];?>
                          </a>
                         </div>
                        </div> 
                        
                  <?php } ?>
                    <div class="item">
                        <a target="_blank" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$brand_details[0]['brand_name']))); ?>/b/<?php echo $brand_details[0]['brand_id']; ?>?q=<?php echo $q; ?>" class="viewMorePr"> 
                            View All Products
                        </a> 
                    </div> 
                
                 </div>
          </div>
      
        </div>
       <?php } ?>
      </div>
    </div>
    <div class="Prdduct_Details_Related_Product clearfix">
   
        <div class="container">
          <div class="row">
          <div class="col-sm-12">
           <h3>  Related Products </h3>
          </div>
            <ul>
            <?php foreach($related_product as $row){ ?>     
            <li>
                <div class="productDtlImgBox clearfix"> 
                  <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                  <div class="productDtlImgBox-wrap ">
                    <div class="productDtlImgBox-explore"> 
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['product_name'])))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>"> 
                            <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['product_name'];?>">
                        </a> 
                    </div>
                    <div class="productName"> 
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>"> 
                            <?php echo $row['product_name'];?>
                        </a>
                    </div>
                  </div>
                </div>
            </li>
            <?php } ?>  
            </ul>
          </div>
        </div>
    
    </div>
  </section>
</div>
<!--------------[ Middle Section ]-------------> 

<script>
$(document).ajaxStart(function () {
    $(".loader").show();
});

$(document).ajaxComplete(function () {
    $(".loader").hide();
});
</script>
<script>
        $(document).ready(function() {	
        
        
//    $("#mobile").keypress(function (e) {
//     //if the letter is not digit then display error and don't type anything
//     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//
//               return false;
//    }
//   });
        });
/*
	Load more content with jQuery 
*/   



$(function () {
    $(".load_more").slice(0, 24).show();
    $("#loadMore").on('click', function (e) {
        
        
        e.preventDefault();
        $(".load_more:hidden").slice(0, 24).slideDown();
        if ($(".load_more:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }

    });
});


    $("#get_price").click(function () {
            $("#get_price").hide();
            $("#get_price_form").toggle();

    });

</script>

<script>
 $('#formGetPrice').submit(function(e){
    e.preventDefault();
    var contentinfotext = "";
    contentinfotext = "Email-started";
   
   var username =   $('#user_name_pdp').val();
   var userinformation =   $('#email_pdp').val();
   var mobile =   $('#mobile_pdp').val();
   var product_id =   $('#product_id').val();
   var quantity =   $('#quantity').val();
   var event_category = $('#event_category').val();
   var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
   var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
   var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
   var user_landing_page = $('#user_landing_page').val();
   var utm = $('#utm').val();
   var scheme = $('#scheme').val();
   var eventLabel =  'Product Details Page | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
   var split_url = leadGenFromSliderPageURL.split('/');
   var flag_for_production = 'www.mansionly.com';
   var chk_flag_for_production = split_url[2]; 
   
   var data = $.param({
             name : username,
             mobile : mobile,
             contactinfo: userinformation,
             contentinfo: contentinfotext,
             productid: product_id,
             quantity: quantity,
             remote_address: <?php echo '"'.$_SERVER['REMOTE_ADDR'].'"'; ?>,
             leadGenFromSliderPageType: leadGenFromSliderPageType,
             leadGenFromSliderPageUniqueId:leadGenFromSliderPageUniqueId,
             leadGenFromSliderPageURL:leadGenFromSliderPageURL,
             user_landing_page:user_landing_page,
             utm:utm,
             scheme:scheme
            // formtitle: 'Mansionly - Contact',
     });
 //   $("#submit_button").attr('disabled','disabled');
   // alert(data);
   if($('#formGetPrice').valid()){
    
    $("#submit_button").attr('disabled','disabled');

    $.ajax({
        url:baseUrl+"Cn_customer/getpriceRequest",
        type:"post",
        data:data,
        success: function(response){
         toastr.success('Your order saved succefully.');
         $("#submit_button").removeAttr('disabled');
         $("#get_price_form").hide();
         $("#get_price").show();
        if(chk_flag_for_production == flag_for_production){
            var result = response.split('|*|*|');
            /*Goole analytics script*/
           //  alert(event_category+result[0]+eventLabel+result[1]);
               ga('send', 'event', 
                   { eventCategory: event_category,
                     eventAction: result[0],
                     eventLabel: eventLabel, 
                     eventValue: result[1]
                   });
            }
        },
        error: function(e){
          $("#submit_button").removeAttr('disabled');  
          toastr.error('! Error ');
        }
        
    });
    //$("#submit_button").removeAttr('disabled');  
    }

    }); 

</script>
<!-- Start::form validation script -->
<script src="<?php echo base_url().SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
        
  $("#mobile_pdp").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
   
   jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
   }, " "); 
		$("#formGetPrice").validate({
                    rules: {
                           
                                user_name_pdp: {
					required: true,
                                        lettersonly:true
				},
                                 mobile_pdp: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				},
				email_pdp: {
					required: true,
                                        email:true
				}
			},
			messages: {                           
                               user_name_pdp: {
					required: '',
                                        lettersonly:''
				},
                                mobile_pdp: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				},                                
                                
				email_pdp: {
					required: '',
                                        email:''
				}
			}
		});
    });
    </script>
<!-- End::form validation script -->
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery.jqzoom-core.js?v=0.4"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/polyfill.position-sticky.js?v=0.1"></script>
<script>
$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	
});

 disabled_click_event = function() {
         // Your code here
         return false;
    }
</script>
<?php
/* If scroll position is set in session ]*/
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>
