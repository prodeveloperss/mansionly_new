<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
if (!empty($_GET['q'])) {
    $q = $_GET['q'];
} else {
    $q = '';
}
/* Arrray for the replacement in url */

$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', ' ', '  ', "'", '+', ',', '/');

/*[start::Code to Handel portfolio images size.]*/
$device_type = '';
if(isset($_COOKIE['device_type'])){
$device_type =  $_COOKIE['device_type'];
}

 $image_size = '370X270/';
 $image_size_big = '892X490/';
 
 if($device_type == 'desktop'){
     $image_size = '370X270/';
     $image_size_big = '892X490/';     
 }
 else if($device_type == 'tablet_landscap'){
     $image_size = '293X270/';
     $image_size_big = '892X490/';     
 }
 else if($device_type == 'tablet_potrait'){
     $image_size = '293X270/';
     $image_size_big = '690X300/';     
 }
 else if($device_type == 'mobile'){
     $image_size = '690X300/';
     $image_size_big = '690X300/';
 }
 else if($device_type == 'small_mobile'){
     $image_size = '370X270/';
     $image_size_big = '370X270/';
 }
/*[End::Code to Handel portfolio images size.]*/
?>
<input type='hidden' id="image_size" name="image_size" value="<?php echo $image_size; ?>">


<!--------------[ Middle Section ]------------->
<section class="designer-profile-sect-new clearfix">
<div class="containerfluid clearfix">
    <div class="breadcrumb-main">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>all-designers">All Designers</a></li>
            <li>
               <!--<a href="<?php echo base_url(); ?>designer-profile/<?php echo $portfolio_details[0]['designer_id']; ?>/<?php echo urlencode($portfolio_details[0]['designer_name']); ?>">-->
                <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($portfolio_details[0]['designer_name'])))) . '/designer/' . $portfolio_details[0]['designer_id'] . '?q=d'; ?>">
                 <?php echo $portfolio_details[0]['designer_name']; ?>
                </a>
            </li>
            <li class="active"><?php echo $portfolio_details[0]['portfolio_name']; ?></li> 
        </ol>
    </div>

 <div class="clearfix"></div>
 <div class="desinerLogo clearfix">
    	<h2><?php echo $portfolio_details[0]['designer_name']; ?></h2>
        
        	<?php if(!empty ($designer_details[0]['designer_logo2'])) { ?>
        <div class="DzlogoImg">
            <div class="profile-logo"> <img src="<?php echo image_url; ?>/media/images/designer-images/<?php echo $designer_details[0]['designer_logo2'];?>" alt="<?php echo $portfolio_details[0]['designer_name']; ?>"  class="img-responsive"> </div>
        </div>
        <?php } ?>
        
    </div>

    <!--<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="Headind-style headstyledtl">
                    <h1 style="font-size: 24px;"><?php echo $portfolio_details[0]['portfolio_name']; ?></h1>
                </div>
            </div>
        </div>
    </div>-->
   <!-- <div class="designer-profile-dtltop">-->
        <div class="profileSect">
            <div class="row">
            <div class="col-md-3 col-sm-5 col-xs-12 leftSc  stick-left">
        	<div class="profileSect_left">
<?php if ($portfolio_details[0]['designer_logo']) { ?>
                            <div class="left-progfileImg">
                                <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($portfolio_details[0]['designer_name'])))) . '/designer/' . $portfolio_details[0]['designer_id'] . '?q=d'; ?>">
                                    <img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $portfolio_details[0]['designer_logo']; ?>" class="img-responsive" alt="<?php echo $portfolio_details[0]['designer_name']; ?>"> 
                                </a>
                            </div>
                            <?php } ?>
                        <div  class="d-profile-text clearfix">
                            <h4>Designed By 
                                <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($portfolio_details[0]['designer_name'])))) . '/designer/' . $portfolio_details[0]['designer_id'] . '?q=d'; ?>">
                            <?php echo $portfolio_details[0]['designer_name']; ?> 
                                </a>
                            </h4>
                            <p>Interested in knowing more? Please fill in the form below and we will get back to you soon!</p>

                            <?php
                            if ($this->session->userdata('customer_info')['customer_email']) {
                                $customer_email = $this->session->userdata('customer_info')['customer_email'];
                            } else {
                                $customer_email = "";
                            }
                            if ($this->session->userdata('customer_info')['customer_phone']) {
                                $customer_phone = $this->session->userdata('customer_info')['customer_phone'];
                            } else {
                                $customer_phone = "";
                            }
                            if ($this->session->userdata('customer_info')['customer_name']) {
                                $customer_name = $this->session->userdata('customer_info')['customer_name'];
                            } else {
                                $customer_name = "";
                            }
                            ?>
                            <div id="form_loader" class="loader" style="top:47%; display:none;" ></div>
                            <form id="portfolioContactForm">
                                <input type="hidden" name="flag" id="flag" value="<?php echo $flag; ?>">
                                <input type="hidden" name="designer_id" id="designer_id" value="<?php echo $portfolio_details[0]['designer_id']; ?>">
                                <input type="hidden" name="designer_name" id="designer_name" value="<?php echo $portfolio_details[0]['designer_name']; ?>">
                                <input type="hidden" name="portfolio_name" id="portfolio_name" value="<?php echo $portfolio_details[0]['portfolio_name']; ?>">
<?php if ($flag == "executionportfolio") { ?>
                                    <input type="hidden" name="portfolioId" id="portfolioId" value="<?php echo $portfolio_details[0]['id']; ?>">
                                    <input type="hidden" name="design_id" id="design_id" value="">
<?php } else if ($flag == "designconcept") { ?>
                                    <input type="hidden" name="portfolioId" id="portfolioId" value="">
                                    <input type="hidden" name="design_id" id="design_id" value="<?php echo $portfolio_details[0]['id']; ?>">
<?php } ?>
                                <div class="form-group">
                                    <input type="text" placeholder="Name" name="name_ep" id="name_ep" class="form-control" <?php if ($customer_name) { ?> readonly="" <?php } ?> value="<?php echo $customer_name; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email_ep" id="email_ep" placeholder=" Email" class="form-control" <?php if ($customer_email) { ?> readonly="" <?php } ?> value="<?php echo $customer_email; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile_ep" id="mobile_ep" placeholder="mobile" maxlength="15" class="form-control" <?php if ($customer_phone) { ?> readonly="" <?php } ?> value="<?php echo $customer_phone; ?>">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn conectBtn ">Submit</button> 
                                </div>
                            </form>

                        </div>
                    </div>
                </div >
                 <div class="col-md-9 col-sm-7 col-xs-12">
            <div class="profileSect_rightDtail">
                
                    <div class="profileDtl-slider clearfix">
                        <?php if ($flag == "executionportfolio") { ?>
                            <a class="likeico" href="javascript:void(0);">
                                <i id="<?php echo 'executionportfolio' . $portfolio_details[0]['id']; ?>" class="fa fa-heart <?php if (in_array($portfolio_details[0]['id'], $customerFavoriteExecutions)) {
                                echo ' heartRed';
                            } ?>" aria-hidden="true" onclick="saveFavorite('Portfolio', 'executionportfolio', <?php echo $portfolio_details[0]['id']; ?>);"></i>
                            </a> 
                        <?php } else if ($flag == "designconcept") { ?>
                            <a class="likeico" href="javascript:void(0);">
                                <i id="<?php echo 'designtheme' . $portfolio_details[0]['id']; ?>" class="fa fa-heart <?php if (in_array($portfolio_details[0]['id'], $customerFavoriteThemes)) {
                            echo ' heartRed';
                        } ?>" aria-hidden="true" onclick="saveFavorite('Theme', 'designtheme',<?php echo $portfolio_details[0]['id']; ?>)">
                                </i>
                            </a> 
                                <?php } ?>
                                <?php if (!empty($portfolio_details[0]['secondary_images'])) { ?>   
                            <div class="owl-controls" id="profileDtl-slide">
                            <?php } ?>
                            <div class="item"> 
                            <?php
                            $counter = 1;
                            if(!empty($portfolio_details[0]['secondary_images'])){ 
                            $array = explode(',',$portfolio_details[0]['secondary_images']);
                            $counter= (1 + count($array));
                            }
                           ?>
                         <div class="counter">1/<?php echo $counter; ?></div>
                            <?php if ($flag == "executionportfolio") { ?>
                         <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size_big.$portfolio_details[0]['master_image']; ?>" alt="<?php echo $portfolio_details[0]['portfolio_name']; ?>" >
                            <?php } else if ($flag == "designconcept") { ?>
                         <img src="<?php echo image_url; ?>media/images/masterdsg-img/<?php echo $image_size_big.$portfolio_details[0]['master_image']; ?>" alt="<?php echo $portfolio_details[0]['portfolio_name']; ?>" >
                            <?php } ?>
                            </div>
                                <?php
                                if (!empty($portfolio_details[0]['secondary_images'])) {
                                    $array = explode(',', $portfolio_details[0]['secondary_images']);

                                    foreach ($array as $row_image) {
                                        ?>
                                    <div class="item"> 
                                    <?php if ($flag == "executionportfolio") { ?>
                                        <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size_big.$row_image; ?>" alt="<?php echo $portfolio_details[0]['portfolio_name']; ?>" >
                                    <?php } else if ($flag == "designconcept") { ?>
                                        <img src="<?php echo image_url; ?>media/images/masterdsg-img/<?php echo $image_size_big.$row_image; ?>" alt="<?php echo $portfolio_details[0]['portfolio_name']; ?>" >
                                <?php } ?>
                                    </div>
    <?php }
} ?>

                        <?php if (!empty($portfolio_details[0]['secondary_images'])) { ?>   
                            </div>
<?php } ?>
                    </div> 
                
                
  <!--  </div>-->




<?php
if (!(empty($execution_portfolio)) || !(empty($design_concept))) {
    ?>

        
            <!--<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Headind-style">
                            
                        </div>
                    </div>
                </div>
            </div>-->
       
             
<div class="otherProjectTtl clearfix">
<h2>Other projects by <?php echo $portfolio_details[0]['designer_name']; ?></h2>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if (!empty($totalCountExc[0]['totalCount'])) { ?>
                            <li role="presentation" <?php if ($flag == "executionportfolio") { ?> class="active" <?php } ?> ><a href="#home" aria-controls="home" role="tab" data-toggle="tab" onclick="$('#loadMore_exe').mouseenter();">Execution portfolio</a></li>
    <?php } if (!empty($totalCountDsgnConcept[0]['totalCount'])) { ?>
                            <li role="presentation" <?php if ($flag == "designconcept") { ?> class="active" <?php } ?> ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" onclick="$('#loadMore').mouseenter();">Design concepts</a></li>
    <?php } ?>
                    </ul>
                    </div>

                    <!-- Tab panes -->

                    <input type="hidden" name="designer_id" id="designer_id" value="<?php echo $portfolio_details[0]['designer_id']; ?>">
                    <input type="hidden" name="flagPortfolioSelect" id="flagPortfolioSelect" value="<?php echo $flag; ?>">
                    <input type="hidden" name="portfolio_id" id="portfolio_id" value="<?php echo $portfolio_details[0]['id']; ?>">
                                        <?php $Favoritestring = implode(',', $customerFavoriteExecutions); ?>
                    <input type="hidden" name="customerFavoriteExecutions" id="customerFavoriteExecutions" value="<?php echo $Favoritestring; ?>">

                    <div class="tab-content">
    <?php if (!empty($totalCountExc[0]['totalCount'])) { ?>
                            <input type="hidden" name="offset" id="offset" value="<?php echo $exe_offset; ?>">
                            <input type="hidden" name="limit_exe" id="limit_exe" value="<?php echo $totalCountExc[0]['totalCount']; ?>">
                            <div role="tabpanel" class="tab-pane fade <?php if ($flag == "executionportfolio") { ?> in active <?php } ?>" id="home">
                            <div class="row">
                                <div id="append_portfolio">
                                                <?php foreach ($execution_portfolio as $row) { ?>

                                        <div class="col-sm-12 col-md-6 col-xs-12   load_more"  >
                                            <div class="design-profile-box-new">
                                                <a class="likeico" href="javascript:void(0);">
                                                    <i id="<?php echo 'executionportfolio' . $row['id']; ?>" class="fa fa-heart <?php if (in_array($row['id'], $customerFavoriteExecutions)) {
                                            echo ' heartRed';
                                        } ?>" aria-hidden="true" onclick="saveFavorite('Portfolio', 'executionportfolio', <?php echo $row['id']; ?>);"></i>
                                                </a> 
            <?php if (!empty($row['secondary_images'])) { ?>                    
                                                    <div class="owl-carousel owl-demo">
                                                    <?php } ?>
                                                    <div class="item"> 
                                                        <?php
                                                        $counter = 1;
                                                        if(!empty($row['secondary_images'])){ 
                                                        $array = explode(',', $row['secondary_images']);
                                                        $counter= (1 + count($array));
                                                        }
                                                       ?>
                                                       <div class="counter">1/<?php echo $counter; ?></div>
                                                        <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['designer_name'])))) . '/' . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['portfolio_name'])))) . '/ep/' . $row['id'] . '?q=' . $q; ?>">
                                                            <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name']; ?>" > 
                                                        </a>
                                                    </div>
            <?php
            if (!empty($row['secondary_images'])) {
                $array = explode(',', $row['secondary_images']);

                foreach ($array as $row_image) {
                    ?>
                                                            <div class="item"> 
                                                                <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['designer_name'])))) . '/' . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['portfolio_name'])))) . '/ep/' . $row['id'] . '?q=' . $q; ?>">
                                                                    <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name']; ?>" > 
                                                                </a>
                                                            </div>
                                    <?php }
                                } ?>
            <?php if (!empty($row['secondary_images'])) { ?>
                                                    </div>
                                    <?php } ?>
                                                <div class="Dzr-profiletxt-new"><?php echo $row['portfolio_name']; ?></div>
                                            </div>
                                        </div>
        <?php } ?>
                                </div>
                              
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <div  class="loader" style="display:none;"></div>
                                    <div class="loadMore-btn clearfix" id="loadMore_exe"  <?php if ($totalCountExc[0]['totalCount'] <= 6) { ?>style="display:none;"<?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
                                </div>
</div>  
                            </div>
                                            <?php } ?>
    <?php if (!empty($totalCountDsgnConcept[0]['totalCount'])) { ?>
                            <div role="tabpanel" class="tab-pane fade <?php if ($flag == "designconcept") { ?> in active <?php } ?>" id="profile">
                             <div class="row">
                                <input type="hidden" name="offset_design_concept" id="offset_design_concept" value="<?php echo $dsg_offset; ?>">
                                <input type="hidden" name="limit_design_concept" id="limit_design_concept" value="<?php echo $totalCountDsgnConcept[0]['totalCount']; ?>">
        <?php $FavoriteDesignstring = implode(',', $customerFavoriteThemes); ?>
                                <input type="hidden" name="customerFavoriteThemes" id="customerFavoriteThemes" value="<?php echo $FavoriteDesignstring; ?>">
                                <div id="append_design_concept"> 
                                                <?php foreach ($design_concept as $row) { ?>    
                                        <div class="col-sm-12 col-md-6 col-xs-12   load_more" >
                                            <div class="design-profile-box-new">

                                                <a class="likeico" href="javascript:void(0);">
                                                    <i id="<?php echo 'designtheme' . $row['design_id']; ?>" class="fa fa-heart <?php if (in_array($row['design_id'], $customerFavoriteThemes)) {
                                            echo ' heartRed';
                                        } ?>" aria-hidden="true" onclick="saveFavorite('Theme', 'designtheme',<?php echo $row['design_id']; ?>)">
                                                    </i>
                                                </a> 
                                                    <?php if (!empty($row['secondary_images'])) { ?>                    
                                                    <div class="owl-carousel owl-demo">
                                                <?php } ?>
                                                    <div class="item"> 
                                                        <?php
                                                            $counter = 1;
                                                            if(!empty($row['secondary_images'])){ 
                                                            $array = explode(',', $row['secondary_images']);
                                                            $counter= (1 + count($array));
                                                            }
                                                           ?>
                                                        <div class="counter">1/<?php echo $counter; ?></div>
                                                        <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['designer_name'])))) . '/' . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['design_display_name'])))) . '/dc/' . $row['design_id'] . '?q=' . $q; ?>">
                                                            <img src="<?php echo image_url; ?>media/images/masterdsg-img/<?php echo $image_size.$row['design_img']; ?>" alt="<?php echo $row['design_display_name']; ?>" > 
                                                        </a>
                                                    </div>
            <?php
            if (!empty($row['secondary_images'])) {
                $array = explode(',', $row['secondary_images']);

                foreach ($array as $row_image) {
                    ?>
                                                            <div class="item"> 
                                                                <a href="<?php echo base_url() . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['designer_name'])))) . '/' . strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['design_display_name'])))) . '/dc/' . $row['design_id'] . '?q=' . $q; ?>">
                                                                    <img src="<?php echo image_url; ?>media/images/masterdsg-img/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['design_display_name']; ?>" > 
                                                                </a>
                                                            </div>
                <?php }
            } ?>
                <?php if (!empty($row['secondary_images'])) { ?>
                                                    </div>
            <?php } ?>
                                                <div class="Dzr-profiletxt-new"><?php echo $row['design_display_name']; ?></div>
                                            </div>
                                        </div>
        <?php } ?>
                                </div>
                              
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <div class="loader" style="display:none;"></div>
                                    <div class="loadMore-btn clearfix" id="loadMore" <?php if ($totalCountDsgnConcept[0]['totalCount'] <= 6) { ?>style="display:none;"<?php } ?>> <a href="javascript:void(0);">Load More</a> </div>
                                </div>
 								 </div>
                            </div>
    <?php } ?>
                        <div> </div>
                    </div>
                
          
       
        </div>
        </div>

                
            </div>
        </div>

<?php } ?>
</div>
</section>
</div>
<!--------------[ Middle Section ]-------------> 

<!--[start:: Loader image]-->
<script>
    $(document).ajaxStart(function () {
        $(".loader").show();
    });

    $(document).ajaxComplete(function () {
        $(".loader").hide();
    });
</script>
<!--[End:: Loader image]-->

<!--[start:: Load more for execution Portfolio]-->

<script type="text/javascript">
    $(document).ready(function () {
        $('#loadMore_exe').mouseenter(function () {
            $('#home').addClass('active in');
            $('#loadMore_exe').hide();
            var offset = parseInt($('#offset').val());
            var total_count = parseInt($('#limit_exe').val());
            var designer_id = $('#designer_id').val();
            var portfolio_id = $('#portfolio_id').val();
            var flagPortfolioSelect = $('#flagPortfolioSelect').val();
            var customerFavoriteExecutions = $('#customerFavoriteExecutions').val();
            var q = '<?php echo $q; ?>';
            var image_size = '<?php echo $image_size; ?>';

            // alert(q);
            $.ajax({
                url: baseUrl + "Cn_designer/ajaxOtherExecutionPortfolio",
                type: "post",
                data: {'offset': offset, 'designer_id': designer_id, 'portfolio_id': portfolio_id, 'flagPortfolioSelect': flagPortfolioSelect, 'customerFavoriteExecutions': customerFavoriteExecutions, 'q': q,'image_size':image_size},
                success: function (response) {
                    var data = response.split('|*|*|');
                    $('#append_portfolio').append(data[1]);
                    $('#offset').val(offset + 6);
                    if (total_count <= parseInt(data[0])) {
                        $("#loadMore_exe").hide();
                    } else {
                        $('#loadMore_exe').show();
                    }
                    /*[start:: image loader]*/
                    $('.owl-demo').owlCarousel({
                        center: true,
                        loop: true,
                        margin: 0,
                        autoplay: false,
                        nav: true,
                        mouseDrag: true,
                        smartSpeed: 2500,
                        autoplayTimeout: 2000,
                        /*animateIn:'fadeIn',
                         animateOut:'fadeOut',*/
                        dots: false,
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ],
                        responsive: {
                            320: {
                                items: 1,
                            },
                            600: {
                                items: 1,
                            },
                            1170: {
                                items: 1,
                            },
                            1920: {
                                items: 1,
                            }
                        }

                    })
                    /*[End:: image loader]*/

                },
                error: function (e) {

                }

            });
        });
        // execution_portfolio();
    });


</script>
<!--[End:: Load more for execution Portfolio]-->
<!--[start:: Load more for Design Concept]-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#loadMore').mouseenter(function () {
            $('#profile').addClass('active in');
            $('#loadMore').hide();
            var offset = parseInt($('#offset_design_concept').val());
            var total_count = parseInt($('#limit_design_concept').val());
            var designer_id = $('#designer_id').val();
            var portfolio_id = $('#portfolio_id').val();
            var flagPortfolioSelect = $('#flagPortfolioSelect').val();
            var customerFavoriteThemes = $('#customerFavoriteThemes').val();
            var q = '<?php echo $q; ?>';
            var image_size = '<?php echo $image_size; ?>';


            // alert(q);
            $.ajax({
                url: baseUrl + "Cn_designer/ajaxGetOtherDesignConcept",
                type: "post",
                data: {'offset': offset, 'designer_id': designer_id, 'portfolio_id': portfolio_id, 'flagPortfolioSelect': flagPortfolioSelect, 'customerFavoriteThemes': customerFavoriteThemes, 'q': q,'image_size':image_size},
                success: function (response) {
                    var data = response.split('|*|*|');
                    $('#append_design_concept').append(data[1]);
                    $('#offset_design_concept').val(offset + 6);
                    if (total_count <= parseInt(data[0])) {
                        $("#loadMore").hide();
                    } else {
                        $('#loadMore').show();
                    }
                    /*[start:: image loader]*/
                    $('.owl-demo').owlCarousel({
                        center: true,
                        loop: true,
                        margin: 0,
                        autoplay: false,
                        nav: true,
                        mouseDrag: true,
                        smartSpeed: 2500,
                        autoplayTimeout: 2000,
                        /*animateIn:'fadeIn',
                         animateOut:'fadeOut',*/
                        dots: false,
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ],
                        responsive: {
                            320: {
                                items: 1,
                            },
                            600: {
                                items: 1,
                            },
                            1170: {
                                items: 1,
                            },
                            1920: {
                                items: 1,
                            }
                        }

                    })
                    /*[End:: image loader]*/

                },
                error: function (e) {

                }

            });
        });
        // execution_portfolio();
    });


</script>
<!--[End:: Load more for execution Portfolio]-->




<script>
    $('#portfolioContactForm').submit(function (e) {

        e.preventDefault();
        var email = $('#email_ep').val();
        //var inputarea = $('#email');
        var name = $('#name_ep').val();
        var mobile = $('#mobile_ep').val();
        var designer_id = $('#designer_id').val();
        var designer_name = $('#designer_name').val();
        var portfolio_name = $('#portfolio_name').val();
        var portfolioId = $('#portfolioId').val();
        var design_id = $('#design_id').val();

        var orderType = '';//3

        if (design_id != '') {
            orderType = 2;
        } else {
            orderType = 3;
        }
        var flag = $('#flag').val();
        
        var event_category = $('#event_category').val();
        var leadGenFromSliderPageURL = $('#leadGenFromSliderPageURL').val();
        var leadGenFromSliderPageUniqueId = $('#leadGenFromSliderPageUniqueId').val();
        var leadGenFromSliderPageType = $('#leadGenFromSliderPageType').val();
        var user_landing_page = $('#user_landing_page').val();
        var utm = $('#utm').val();
        var scheme = $('#scheme').val();
        if(leadGenFromSliderPageType == 'execution-project'){
              var eventLabel =  'Execution Project | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
           }else{
              var eventLabel =  'Design Concept | '+leadGenFromSliderPageUniqueId+' | URL='+leadGenFromSliderPageURL;
           }
        var split_url = leadGenFromSliderPageURL.split('/');
        var flag_for_production = 'www.mansionly.com';
        var chk_flag_for_production = split_url[2];
        if ($('#portfolioContactForm').valid()) {
            if (name != '' && mobile != '' && email != '') {
                $("#form_loader").show();
                var data = $.param({
                                     name: name,
                                     email: email,
                                     mobile: mobile,                                    
                                     designer_id: designer_id,
                                     designer_name: designer_name,
                                     design_name: portfolio_name,
                                     remote_address: <?php echo "'".$_SERVER['REMOTE_ADDR']."'"?>,
                                     portfolioId : portfolioId,
                                     design_id : design_id,
                                     leadGenFromSliderPageType: leadGenFromSliderPageType,
                                     leadGenFromSliderPageUniqueId:leadGenFromSliderPageUniqueId,
                                     leadGenFromSliderPageURL:leadGenFromSliderPageURL,
                                     user_landing_page:user_landing_page,
                                     utm:utm,
                                     scheme:scheme
                             });
                 $.ajax({
                            type:"post",
                            url:baseUrl+"Cn_customer/checkUserExistOrNot",
                            data:data,
                            success:function(data){                                  
                                      
                                      $("#form_loader").hide();
                                      toastr.success('your order saved successfully');
                               if(chk_flag_for_production == flag_for_production){
                                      var result = data.split('|*|*|');
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
                            error:function(data){
                                $("#form_loader").hide();
                                toastr.error ('Error !!!');
                            }
                        });



              


            }
        }
    });



</script>




<!-- Start::form validation script -->
<script src="<?php echo base_url() . SitePath; ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        $("#mobile_ep").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, " ");
        $("#portfolioContactForm").validate({
            rules: {
                name_ep: {
                    required: true,
                    lettersonly: true
                },
                mobile_ep: {
                    required: true,
                    maxlength: 15,
                    minlength: 10

                },
                email_ep: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name_ep: {
                    required: '',
                    lettersonly: ''
                },
                mobile_ep: {
                    required: '',
                    maxlength: '',
                    minlength: ''
                },
                email_ep: {
                    required: '',
                    email: ''
                }
            }
        });
    });
</script>
<!-- End::form validation script -->
<?php
$this->load->view('section/vw_footer');
?>
