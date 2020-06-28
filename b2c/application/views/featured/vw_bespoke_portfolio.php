<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');

if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
//print_r($brand_details);
/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
?>


<!--------------[ Middle Section ]------------->
  <section class="lifestyle-brandsect clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="#">Lifestyle Products</a></li>
        <li><a href="<?php echo base_url(); ?>bespoke?q=<?php echo $q; ?>">Bespoke</a></li>
        <li class="active">Bespoke Portfolio</li>
      </ol>
    </div>
     <div class="container"> 
        <div class="col-sm-12">
          <div class="Headind-style lifebrand-head">
            <h1><?php echo $page_heading." Portfolio"; ?></h1>
          </div>
        </div>
     </div>
         
      
      <div class="clearfix"></div>

      <div class="brand_explores clearfix">
        <div class="container">
         <?php if(!empty($seller_details[0]['market_seller_logo_image'])) {?>
          <div class="brand-ex-img"> 
              <img  src="<?php echo image_url; ?>media/images/marketseller-images/200X110/<?php echo $seller_details[0]['market_seller_logo_image']; ?>" alt="<?php echo$page_heading; ?>"> 
          </div>
         <?php } if(!empty($seller_details[0]['market_seller_description'])) {?>
          <div class="brand-ex-description">
           
             <span class="less"><?php echo substr(strip_tags($seller_details[0]['market_seller_description']),0,250); ?>...<br> <a style="cursor:pointer;" class="read_more">[read more..]</a></span> 
             <span class="more" style="display:none;"><?php echo $seller_details[0]['market_seller_description']; ?><br> <a style="cursor:pointer;" class="read_less">[read less]</a></span>
            
          </div>
           <?php } ?>
             <hr>
        </div>
      </div>
    
       <div class="clearfix"></div>

    <div class="designer-profile-btm execution">
      
    <div class="brand-shop-explore  lifestyle-section  categorylisting clearfix">
        <div class="container">
           <?php if(empty($product_list)){ ?>
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> Record not found.
                  </div>
            </div> 
         <?php   } else { ?>
            
          <div class="row">
            <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
            <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
            <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller_id;?>">
           <?php $Favoritestring = implode(',',$customerFavoriteProduct);?>
             <input type="hidden" name="customerFavoriteProduct" id="customerFavoriteProduct" value="<?php echo $Favoritestring; ?>">
             <input type="hidden" name="id" id="id" value="<?php echo $seller_id; ?>">
             <input type="hidden" name="page" id="page" value="<?php echo $page_name; ?>">
           <div id='append'>
            <?php  foreach ($product_list as $row) {                 
               
                ?>             
         
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand " >
              <div class="brandBox clearfix">
              <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>                <div class="brand-wrap">
                  <div class="BrandImg-explore brandBox"> 
                      <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $seller_id; ?>&page=<?php echo $page_name; ?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>"style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['product_name'];?>"> 
                      </a> 
                  </div>
                  <div class="BrandName"> 
                      <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $seller_id; ?>&page=<?php echo $page_name; ?>"> 
                      <?php echo $row['product_name'];?> 
                      </a>
                  </div>
                </div>
              </div>
            </div>
          <?php if(($key+1) % 3 =='0'){ ?>
            <div class="clearfix "></div>
            <div class="col-sm-12">
                <div class="gradiant-otr clearfix">
                    <div class="dividerGradiant clearfix"></div>
                </div>
            </div>
            <?php } /*end:if;*/
                }
                ?>
            
          </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">                
           <div class="loader" style="display:none;"></div>
          <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=$limit) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
        </div>
         <?php } ?>
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

<!--[start:: Load more for Functionality]-->
<script type="text/javascript">
$(document).ready(function(){
  $('#loadMore').mouseenter(function(){
      
      $('#loadMore').hide();
    var offset = parseInt($('#offset').val());
    var totalCount = $('#totalCount').val();
    var seller_id = $('#seller_id').val();
    var customerFavoriteProduct = $('#customerFavoriteProduct').val();
    var q = '<?php echo $q; ?>';
    var id = $('#id').val();
    var page = $('#page').val();

    $.ajax({
        url:baseUrl+"Cn_featured/ajax_bespoke_portfolio",
        type:"post",
        data:{'offset':offset,'seller_id':seller_id,'customerFavoriteProduct':customerFavoriteProduct,'q':q,'id':id,'page':page},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append').append(data[1]);
            $('#offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                 $('#loadMore').show();
            }
        },
        error: function(e){
            alert('Please relode the page.');
        }
        
    });
});

 /*[start:Add offset to url]*/
 $(document).on('click','.brandBox.clearfix  a',function(){
  this.href = this.href + '&offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/

});


</script>
<!--[End:: Load more Functionality ]-->

<!--Read more functionaly-->
<script>


$(document).ready(function() {
    
    $(".read_more").click(function(){
       
            $(this).parent().hide();
            $(this).parent().next().show();
      
    });
     $(".read_less").click(function(){
       
            $(this).parent().hide();
            $(this).parent().prev().show();
      
    });
});

</script>


<!--/Read more functionaly-->

<?php
/* If scroll position is set in session ]*/
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>
