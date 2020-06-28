<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');

if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }

//print_r($brand_details);
?>


<!--------------[ Middle Section ]------------->
  <section class="lifestyle-brandsect clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="#">Lifestyle Products</a></li>
            <li class="active">Bespoke</li>
      </ol>
    </div>
      <div class="col-sm-12">
        <div class="Headind-style lifebrand-head">
          <h1><?php echo $page_heading; ?></h1>
        </div>
      </div>
      <div class="clearfix"></div>
    <div class="designer-profile-btm execution">
      
    <div class="brand-shop-explore  lifestyle-section  categorylisting clearfix">
        <div class="container">
           <?php if(empty($seller_list)){ ?>
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> Record not found.
                  </div>
            </div> 
         <?php   } else { ?>
            
          <div class="row">
            <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
            <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
           <?php $Favoritestring = implode(',',$customerFavoriteProduct);?>
             <input type="hidden" name="customerFavoriteProduct" id="customerFavoriteProduct" value="<?php echo $Favoritestring; ?>">
           <div id='append'>
            <?php  foreach ($seller_list as $key => $row) {  
                
               $product_details = $this->Md_featured->getSellertopproduct($row['market_seller_id']); 
             //  print_r($product_details);
            if(!empty($product_details)){
                ?>             
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more" >
              <div class="brandBox clearfix">
                  <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$product_details[0]['product_id'];?>" class="fa fa-heart <?php if(in_array($product_details[0]['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $product_details[0]['product_id'];?> );"></i></a>    
                  <div class="BrandImg-explore brandBox">
                      <a href="<?php echo base_url(); ?>bespoke-portfolio/<?php echo $row['market_seller_id']; ?>/<?php echo urlencode($row['market_seller_name']); ?>?q=<?php echo $q; ?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['market_seller_name'];?>">
                      </a> 
                  </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>bespoke-portfolio/<?php echo $row['market_seller_id']; ?>/<?php echo urlencode($row['market_seller_name']); ?>?q=<?php echo $q; ?>"> <?php echo $row['market_seller_name'];?> </a></div>
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
            } /*end:if;*/
                }/*end:foreach;*/
            ?>
            </div>
            <div class="clearfix"></div>
              <div class="col-sm-12">                
               <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<= $limit) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
            </div>
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
    var customerFavoriteProduct = $('#customerFavoriteProduct').val();
    var q = '<?php echo $q; ?>';


    $.ajax({
        url:baseUrl+"Cn_featured/ajax_bespoke",
        type:"post",
        data:{'offset':offset,'customerFavoriteProduct':customerFavoriteProduct,'q':q},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append').append(data[1]);
            $('#offset').val(data[0]);
            if(totalCount <= parseInt(data[0])){
                $("#loadMore").hide();
            }else{
                  $('#loadMore').hide();
            }
        },
        error: function(e){
            alert('Please relode the page.');
        }
        
    });
});

/*[start:Add offset to url]*/
 $(document).on('click','.brandBox.clearfix  a',function(){
  this.href = this.href + '&bespoke_offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/
});


</script>
<!--[End:: Load more Functionality ]-->



<?php
/* If scroll position is set in session ]*/
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>
