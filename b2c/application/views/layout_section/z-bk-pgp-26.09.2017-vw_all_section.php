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
        <li><a href="<?php echo base_url(); ?>all-sections">Section</a></li>
        <li class="active">View all</li>
      </ol>
    </div>
      <div class="col-sm-12">
        <div class="Headind-style lifebrand-head">
          <h3><?php echo $page_heading; ?></h3>
        </div>
      </div>
      <div class="clearfix"></div>
    <div class="designer-profile-btm execution">
      
    <div class="brand-shop-explore  lifestyle-section  categorylisting clearfix">
        <div class="container">
           <?php if(empty($section_list)){ ?>
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> Record not found.
                  </div>
            </div> 
         <?php   } else { ?>
            
          <div class="row"> 
            <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
            <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
            <div id='append'>
            <?php  foreach ($section_list as $key => $row) {  
               $product_details = $this->Md_section->getSectiontopproduct($row['id']); 
                ?>             
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more">
              <div class="brandBox clearfix">
<!--              <a class="likeico" href=""><i class="fa fa-heart" aria-hidden="true"></i></a>-->
                <div class="brand-wrap">
                  <div class="BrandImg-explore"> <a href="<?php echo base_url(); ?>sectionlist/<?php echo $row['id']; ?>/<?php echo urlencode($row['title']); ?>?q=<?php echo $q; ?>"> <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>" > </a> </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>sectionlist/<?php echo $row['id']; ?>/<?php echo urlencode($row['title']); ?>?q=<?php echo $q; ?>"> <?php echo $row['title'];?> </a></div>
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
                }/*end:foreach;*/
            ?>
            </div>

            
            <div class="clearfix"></div>
            <div class="col-sm-12">                
               <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=$limit) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
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
    var q = '<?php echo $q; ?>';
    $.ajax({
        url:baseUrl+"Cn_section/ajaxGetProductByBrandId",
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
 $(document).on('click','.BrandImg-explore > a',function(){
  this.href = this.href + '&all_section_offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/
});


</script>
<!--[End:: Load more Functionality ]-->
<?php
$this->load->view('section/vw_footer');
?>
