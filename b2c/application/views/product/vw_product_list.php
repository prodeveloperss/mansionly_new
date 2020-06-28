<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }

/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
?>


<!--------------[ Middle Section ]------------->
  <section class="lifestyle-brandsect clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
          <?php echo $breadCrumb; ?>
      </ol>
    </div>
    <?php if($page_name !='category'){?>      
    <div class="col-sm-12">
     <div class="Headind-style lifebrand-head">
       <!--<h3><?php echo $page_heading; ?></h3>-->
       <h1 style="font-size: 24px;"><?php echo $page_heading; ?></h1>
     </div>
   </div>
    <?php } ?>
   <div class="clearfix"></div>
   
   <div class="designer-profile-btm execution">
    <div class="brand-shop-explore categorylisting clearfix">
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
            <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>">
            <input type="hidden" name="page_name" id="page_name" value="<?php echo $page_name; ?>">
            <?php $Favoritestring = implode(',',$customerFavoriteProduct);?>
            <input type="hidden" name="customerFavoriteProduct" id="customerFavoriteProduct" value="<?php echo $Favoritestring; ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $cat_id; ?>">
            <input type="hidden" name="page" id="page" value="<?php echo $page_name; ?>">
            <div id='append'>
            <?php  foreach ($product_list as $key => $row) {     ?>             
         
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more" >
              <div class="brandBox clearfix">
                <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                <div class="brand-wrap">
                  <div class="BrandImg-explore brandBox"> 
                      <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['product_name'])))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['product_name'];?>"> 
                      </a>
                  </div>
                  <div class="BrandName"> <?php echo $row['product_name'];?> </div>
                </div>
              </div>
            </div>
            <?php    
         if(($key+1) % 3 =='0'){ ?>
            <div class="clearfix "></div>
            <div class="col-sm-12">
                <div class="gradiant-otr clearfix">
                    <div class="dividerGradiant clearfix"></div>
                </div>
            </div>
            <?php }
            } ?>  
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12">
              <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=24) { ?> style="display:none;" <?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
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

 function addURL()
{
//    $(this).attr('href', function() {
//   
//    });
}

</script>

<!--[start:: Load more for Functionality]-->
<script type="text/javascript">
$(document).ready(function(){
  $('#loadMore').mouseenter(function(){
   $('#loadMore').hide();
    var offset = parseInt($('#offset').val());
    var totalCount = $('#totalCount').val();
    var cat_id = $('#cat_id').val();
    var page_name = $('#page_name').val();
    var customerFavoriteProduct = $('#customerFavoriteProduct').val();
    var q = '<?php echo $q; ?>';
    var id = $('#id').val();
    var page = $('#page').val();
    var url="";
     if(page_name == 'category'){
        url = "Cn_product/ajaxGetProductByCategoryId";
        }else if(page_name == 'section'){
           url = "Cn_product/ajaxGetProductBySectionId";   
        } else if(page_name == 'featured'){
           url = "Cn_product/ajaxGetProductByFeaturedId";   
        }
    $.ajax({
        url:baseUrl+url,
        type:"post",
        data:{'offset':offset,'cat_id':cat_id,'customerFavoriteProduct':customerFavoriteProduct,'q':q,'id':id,'page':page},
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


<?php
/* If scroll position is set in session ]*/
$this->load->view('vw_scroll_page_action');
$this->load->view('section/vw_footer');
?>
