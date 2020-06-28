<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }

?>


<!--------------[ Middle Section ]------------->
  <section class="lifestyle-brandsect  brand-category clearfix">
  <div class="breadcrumb-main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li><a href="#">Lifestyle Products</a></li>
      <li><a href="<?php echo base_url(); ?>all-categories">Category</a></li>
      <li class="active">View All</li>
    </ol>
  </div>

  <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="Headind-style lifebrand-head">
                  <h1>Category</h1>
                </div>
            </div>
            <div class="clearfix"></div>
<!--           <div class="col-sm-12">
            <div class="SubHeadind-style ">
              <h3>Furniture</h3>
            </div>
          </div>-->
           <div class="clearfix"></div>
          <?php if(empty($category_list)){ ?>
          
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <strong>Sorry!</strong> Record not found.
                  </div>
            
         <?php   } else { ?>

        <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
        <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
           
        <div id='append'> 
        <?php  foreach ($category_list as $row) { ?>
            <div class="col-sm-12">
                  <div class="SubHeadind-style lifebrand-head">
                    <h3><?php echo $row['cat_name']; ?></h3>
                  </div>
                </div>
                <div class="clearfix"></div>
           <?php  
               $sub_cat_list = $this->Md_category->getviewallSubcategories($row['cat_id']);
               
               if(!empty($sub_cat_list))
               {
                   foreach ($sub_cat_list as $row_sub_cat)
                   {  
                    $product_list = $this->Md_category->gettoprankedcategoryProduct($row_sub_cat['cat_id']);  
                    if(!empty($product_list)){
                ?>  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="CatThumb-otr">
                      <div class="CatThumb">
                              <div class="cat-thubmimg">
                          <a href="<?php echo base_url();?><?php echo urlencode($row_sub_cat['cat_name']);?>?catID=<?php echo $row_sub_cat['cat_id'];?>&pageType=PLP">
                              <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_list[0]['product_image'];?>" alt="<?php echo $row_sub_cat['cat_name']; ?> " >	
                          </a>  
                          <div class="cattitle"> 
                              <?php echo $row_sub_cat['cat_name']; ?>                      
                          </div>    
                          </div>
                      </div>
                     </div> 
                   </div>
                   <?php    }
                   }/*end:foreach;*/
        
               }else{
                   $product_list = $this->Md_category->gettoprankedcategoryProduct($row['cat_id']);   
                    if(!empty($product_list)){
                ?>  
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="CatThumb-otr">
                      <div class="CatThumb">
                          <div class="cat-thubmimg">
                          <a href="<?php echo base_url(); ?><?php echo urlencode($row_sub_cat['cat_name']);?>?catID=<?php echo $row_sub_cat['cat_id'];?>&pageType=PLP">
                              <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_list[0]['product_image'];?>" alt="<?php echo $row['cat_name']; ?> " >	
                          </a>  
                          <div class="cattitle"> 
                              <?php echo $row['cat_name']; ?>                      
                          </div>    
                          </div>
                      </div>
                     </div> 
                   </div>
                   
                   
               <?php } }/*end:elseIf;*/
        
            }/*end:1stForeach;*/ ?>
        </div>  
        <div class="clearfix"></div>
        <div class="col-sm-12">                
           <div class="loader" style="display:none;"></div>
          <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=24) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
        </div>
         <?php }   ?>  

          <div class="clearfix"></div>
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
   var q = '<?php echo $q; ?>';

    $.ajax({
        url:baseUrl+"Cn_category/ajaxAllCategories",
        type:"post",
        data:{'offset':offset,'q':q},
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
 $(document).on('click','.cat-thubmimg > a',function(){
  this.href = this.href + '&all_cat_offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/

});


</script>
<!--[End:: Load more Functionality ]-->
<?php
$this->load->view('section/vw_footer');
?>
