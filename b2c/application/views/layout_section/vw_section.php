<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
?>


<!--------------[ Middle Section ]------------->
  <section class="lifestyle-brandsect clearfix">
    <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url(); ?>all-sections">Section</a></li>
        <li class="active"><?php echo $page_heading; ?></li>
      </ol>
    </div>
    <div class="col-sm-12">
      <div class="Headind-style lifebrand-head">
        <h3><?php echo $page_heading." At Mansionly"; ?></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="designer-profile-btm execution">
      
    <div class="brand-shop-explore  lifestyle-section categorylisting clearfix">
        <div class="container">
           <?php if(empty($product_list)){ ?>
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> Record not found.
                  </div>
            </div> 
         <?php   } else { ?>
            
          <div class="row">
            <?php  foreach ($product_list as $key => $row) {     ?>             
         
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand ">
              <div class="brandBox clearfix">
              <a class="likeico" href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
                <div class="brand-wrap">
                  <div class="BrandImg-explore"> <a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>"> <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" alt="brandimg"> </a> </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>"> <?php echo $row['product_name'];?> </a></div>
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
            
            <div class="clearfix"></div>
            <div class="col-sm-12">     
              <div class="loader" style="display:none;"></div>
              <div class="loadMore-btn clearfix" id="loadMore"> <a href="javascript:void(0);">Load More</a> </div>
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
  $('#loadMore').click(function(){
    var offset = parseInt($('#offset').val());
    var totalCount = $('#totalCount').val();
    var section_id = $('#section_id').val();
    $.ajax({
        url:baseUrl+"Cn_section/ajaxGetProductBySectionId",
        type:"post",
        data:{'offset':offset,'section_id':section_id},
        success: function(response){
            var data = response.split('|*|*|');        
            $('#append').append(data[1]);
            $('#offset').val(data[0]);
            if(total_count <= parseInt(data[0])){
                $("#loadMore").hide();
            }
        },
        error: function(e){
            alert('Please relode the page.');
        }
        
    });
});
 // execution_portfolio();
});


</script>
<!--[End:: Load more Functionality ]-->
<?php
$this->load->view('section/vw_footer');
?>
