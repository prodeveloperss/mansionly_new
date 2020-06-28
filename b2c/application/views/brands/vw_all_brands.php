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
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <!--<li><a href="#">Lifestyle Products</a></li>-->
        <li class="active"><a href="#">All Brands</a></li>
      </ol>
    </div>
    <div class="designer-profile-btm execution">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="Headind-style lifebrand-head">
              <h1>Brands at Mansionly</h1>
            </div>
          </div>
        </div>
      </div>
      
      <div class="brand-shop clearfix">
        <div class="container">
            <div class="row">
            <input type="hidden" name="offset" id="offset" value="<?php echo $limit; ?>">
            <input type="hidden" name="totalCount" id="totalCount" value="<?php echo $totalCount[0]['totalCount'];?>">
            <div id='append'>
                    <?php  foreach ($brand_list as $row) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand" >
                         <?php  if(!empty($row['brandPageDesignType'])){
                            ?>
                            <!--<a href="<?php echo base_url(); ?>brand/<?php echo $row['brand_id']; ?>/<?php echo urlencode($row['brand_name']); ?>?q=l">-->
                         <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$row['brand_name']))).'/b/'.$row['brand_id'].'?q=l';?>">
                         <?php  }else{ ?>      
                        <a href="<?php echo base_url(); ?><?php echo urlencode( $row['brand_url_name']) ;?>?brandID=<?php echo $row['brand_id']; ?>&pageType=BLP&q=l"> 
                          <?php } ?> 
                            <div class="brandBox clearfix">

                                  <div class="brand-wrap">
                                    <?php  if(!empty($row['brandPageDesignType'])){
                                      ?>
                                      <!--<a href="<?php echo base_url(); ?>brand/<?php echo $row['brand_id']; ?>/<?php echo urlencode($row['brand_name']); ?>?q=l" class="Expl-btn">Explore</a>-->
                                    <?php  }else{ ?>  
                                      <!--<a href="<?php echo base_url(); ?><?php echo urlencode( $row['brand_url_name']) ;?>?brandID=<?php echo $row['brand_id']; ?>&pageType=BLP&q=l" class="Expl-btn">Explore</a>-->
                                    <?php } ?> 

                                     <?php if(!empty($row['brand_image'])){ ?>
                                      <div class="BrandImg">

                                          <img src="<?php echo image_url; ?>media/images/ecom/brand/200X110/<?php echo $row['brand_image']; ?>" alt="<?php echo $row['brand_name']; ?>" >
                                      </div>
                                     <?php } ?>
                                      <div class="BrandName">  <?php echo $row['brand_name']; ?></div>
                                  </div>
                             </div> 
                        </a>    
                    </div>
                    <?php } ?>
            </div>
                 <div class="clearfix"></div>
                <div class="col-sm-12">                
                   <div class="loader" style="display:none;"></div>
                   <div class="loadMore-btn clearfix" id="loadMore" <?php if( $totalCount[0]['totalCount']<=$limit) { ?> style="display:none;" <?php } ?>><a href="javascript:void(0);">Load More</a> </div>
                 </div>
                
                
            </div>
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
        url:baseUrl+"Cn_brand/ajax_all_brands",
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
            //alert('Please relode the page.');
        }
        
    });
});
 
 /*[start:Add offset to url]*/
 $(document).on('click','.brandBox.clearfix  a',function(){
  this.href = this.href + '&all_brand_offset='+$('#offset').val();
});
 /*[End:Add offset to url]*/

 
});


</script>
<!--[End:: Load more Functionality ]-->
<?php
$this->load->view('section/vw_footer');
?>
