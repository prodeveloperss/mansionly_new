<?php
if(!empty($_GET['q'])){ $q = $_GET['q']; }else{  $q  = ''; }
?>

<input type='hidden' id="image_size" name="image_size" value="<?php echo $image_size; ?>">

    <div class="designer-profile-btm execution">
      <div class="container">
        <div class="row">
            <?php $Favoritestring = implode(',',$customerFavoriteExecutions);?>
            <input type="hidden" name="customerFavoriteExecutions" id="customerFavoriteExecutions" value="<?php echo $Favoritestring; ?>">
          <div class="Execution-tabs ">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" <?php if($execution_flag == "all") { ?> class="active" <?php } ?>><a href="#all" aria-controls="home" role="tab" data-toggle="tab" onclick="load_more('all')" id="all_nav">All</a></li>
            <li role="presentation" <?php if($execution_flag == "residential_interiors") { ?> class="active" <?php } ?>><a href="#pr" aria-controls="profile" role="tab" data-toggle="tab" onclick="load_more('pr')" id="residential_interiors_nav">Premium Residences</a></li>
            <li role="presentation" <?php if($execution_flag == "global_inspiration") { ?> class="active" <?php } ?>><a href="#gi" aria-controls="home" role="tab" data-toggle="tab"  onclick="load_more('gi');" id="global_inspiration_nav">Global Inspirations</a></li>
            <li role="presentation" <?php if($execution_flag == "luxury_hotels") { ?> class="active" <?php } ?>><a href="#lh" aria-controls="profile" role="tab" data-toggle="tab"  onclick="load_more('lh');" id="luxury_hotels_nav" >Luxury Hotels</a></li>
<!--            <li role="presentation" <?php if($execution_flag == "residential_interiors") { ?> class="active" <?php } ?>><a href="#CommercailDsg" aria-controls="home" role="tab" data-toggle="tab" onclick="load_more('cd');">Commercial Designs</a></li>-->
           <?php if(!empty($execution_retail_count[0]['count'])){?>
           <li role="presentation" <?php if($execution_flag == "retail") { ?> class="active" <?php } ?>><a href="#retail" aria-controls="home" role="tab" data-toggle="tab"  onclick="load_more('retail');" id="retail_nav">Retail</a></li>
           <?php } if(!empty($execution_office_space_count[0]['count'])){?>
           <li role="presentation" <?php if($execution_flag == "office_space") { ?> class="active" <?php } ?>><a href="#office_space" aria-controls="home" role="tab" data-toggle="tab" onclick="load_more('office_space');" id="office_space_nav">Office Space</a></li>
           <?php } if(!empty($execution_restaurant_count[0]['count'])){?>
           <li role="presentation" <?php if($execution_flag == "restaurant") { ?> class="active" <?php } ?>><a href="#restaurant" aria-controls="home" role="tab" data-toggle="tab" onclick="load_more('restaurant');" id="restaurant_nav">Restaurant</a></li>
           <?php } if(!empty($execution_spas_count[0]['count'])){?>
           <li role="presentation" <?php if($execution_flag == "spas") { ?> class="active" <?php } ?>><a href="#spas" aria-controls="home" role="tab" data-toggle="tab" onclick="load_more('spas');" id="spas_nav">Spas & Clubs</a></li>
            <?php } ?>

          </ul>
          </div>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='all'){ echo ' in active';}?>" id="all">
            <input type="hidden" name="offset_all" id="offset_all" value="<?php echo $offset_all; ?>">
            <input type="hidden" name="limit_all" id="limit_all" value="<?php echo $execution_all_count[0]['count'];?>">
            <div id="append_all">
             <?php   foreach ($execution_all_list as $row)    {    ?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd">
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                            <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" >
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                               <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" >
                            </a>
                        </div>
                       <?php  } } ?>

                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt">
                    <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designer</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
             </div>
             <div class="clearfix"></div>

             <div class="col-sm-12">
                 <div class="loader" style="display:none;"></div>
                <div class="loadMore-btn clearfix loadmore_common" id="loadMore_all" <?php if( $execution_all_count[0]['count']<= $offset_all) { ?> style="display:none;" <?php } ?> > <a href="javascript:void(0);" data-flag="all">Load More</a> </div>
             </div>

            </div>
            <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='residential_interiors'){ echo ' in active';}?>" id="pr">
                <input type="hidden" name="offset_pr" id="offset_pr" value="<?php echo $offset_pr; ?>">
                <input type="hidden" name="limit_pr" id="limit_pr" value="<?php echo $execution_PR_count[0]['count'];?>">
               <div id="append_pr">
                <?php   foreach ($execution_PR_list as $row)    {    ?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                            <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                          </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                   <div class="Dzr-profiletxt">
                       <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designer</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
             </div>
              <div class="clearfix"></div>
             <div class="col-sm-12">
                  <div class="loader" style="display:none;"></div>
                 <div class="loadMore-btn clearfix loadmore_common" <?php if( $execution_PR_count[0]['count']<= $offset_pr) { ?> style="display:none;" <?php } ?> id="loadMore_pr"> <a href="javascript:void(0);" data-flag="pr">Load More</a> </div>
             </div>

            </div>

            <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='global_inspiration'){ echo ' in active';}?>" id="gi">

                <input type="hidden" name="offset_gi" id="offset_gi" value="<?php echo $offset_gi; ?>">
                <input type="hidden" name="limit_gi" id="limit_gi" value="<?php echo $execution_GI_count[0]['count'];?>">
               <div id="append_gi">
               <?php   foreach ($execution_GI_list as $row)    {    ?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                          </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                   <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
             </div>
              <div class="clearfix"></div>
              <div class="col-sm-12">
                   <div class="loader" style="display:none;"></div>
                  <div class="loadMore-btn clearfix loadmore_common" <?php if( $execution_GI_count[0]['count']<= $offset_gi) { ?> style="display:none;" <?php } ?> id="loadMore_gi" > <a href="javascript:void(0);" data-flag="gi">Load More</a> </div>
             </div>

            </div>


            <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='luxury_hotels'){ echo ' in active';}?>" id="lh">
                <input type="hidden" name="offset_lh" id="offset_lh" value="<?php echo $offset_lh; ?>">
                <input type="hidden" name="limit_lh" id="limit_lh" value="<?php echo $execution_LH_count[0]['count'];?>">
               <div id="append_lh">
               <?php   foreach ($execution_LH_list as $row)    {
                  // print_r($row);?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                           </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
              </div>

              <div class="clearfix"></div>
              <div class="col-sm-12">
                   <div class="loader" style="display:none;"></div>
                  <div class="loadMore-btn clearfix loadmore_common" <?php if( $execution_LH_count[0]['count']<= $offset_lh) { ?> style="display:none;" <?php } ?> id="loadMore_lh"> <a href="javascript:void(0);" data-flag="lh">Load More</a> </div>
             </div>
            </div>


         <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='retail'){ echo ' in active';}?>" id="retail">
             <input type="hidden" name="offset_retail" id="offset_retail" value="<?php echo $offset_retail; ?>">
                <input type="hidden" name="limit_retail" id="limit_retail" value="<?php echo $execution_retail_count[0]['count'];?>">
               <div id="append_retail">
               <?php   foreach ($execution_retail_list as $row)    {
                  // print_r($row);?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                           <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                           </a>
                         </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
            </div>

              <div class="clearfix"></div>
              <div class="col-sm-12">
               <div class="loader" style="display:none;"></div>
               <div class="loadMore-btn clearfix loadmore_common" <?php if( $execution_retail_count[0]['count']<= $offset_retail) { ?> style="display:none;" <?php } ?> id="loadMore_retail"> <a href="javascript:void(0);" data-flag="retail">Load More</a> </div>
             </div>
            </div>
         <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='office_space'){ echo ' in active';}?>" id="office_space">
             <input type="hidden" name="offset_office_space" id="offset_office_space" value="<?php echo $offset_office_space; ?>">
                <input type="hidden" name="limit_office_space" id="limit_office_space" value="<?php echo $execution_office_space_count[0]['count'];?>">
               <div id="append_office_space">
               <?php   foreach ($execution_office_space_list as $row)    {
                  // print_r($row);?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                        </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                   <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
            </div>

              <div class="clearfix"></div>
              <div class="col-sm-12">
                   <div class="loader" style="display:none;"></div>
                 <div class="loadMore-btn clearfix loadmore_common" <?php if( $execution_office_space_count[0]['count']<= $offset_office_space) { ?> style="display:none;" <?php } ?> id="loadMore_office_space" > <a href="javascript:void(0);" data-flag="office_space">Load More</a> </div>
             </div>
            </div>

 <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='restaurant'){ echo ' in active';}?>" id="restaurant">
     <input type="hidden" name="offset_restaurant" id="offset_restaurant" value="<?php echo $offset_restaurant; ?>">
                <input type="hidden" name="limit_restaurant" id="limit_restaurant" value="<?php echo $execution_restaurant_count[0]['count'];?>">
               <div id="append_restaurant">
               <?php   foreach ($execution_restaurant_list as $row)    {
                  // print_r($row);?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
            </div>

              <div class="clearfix"></div>
              <div class="col-sm-12">
                   <div class="loader" style="display:none;"></div>
                        <div class="loadMore-btn clearfix loadmore_common" <?php if($execution_restaurant_count[0]['count']<= $offset_restaurant){ ?> style="display: none;" <?php } ?> id="loadMore_restaurant"> <a href="javascript:void(0);" data-flag="restaurant">Load More</a> </div>
             </div>
            </div>
     <div role="tabpanel" class="tab-pane fade <?php if($execution_flag=='spas'){ echo ' in active';}?>" id="spas">
         <input type="hidden" name="offset_spas" id="offset_spas" value="<?php echo $offset_spas; ?>">
                <input type="hidden" name="limit_spas" id="limit_spas" value="<?php echo $execution_spas_count[0]['count'];?>">
               <div id="append_spas">
               <?php   foreach ($execution_spas_list as $row)    {
                  // print_r($row);?>
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                    <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a>
                  <?php  if(!empty($row['secondary_images'])){ ?>
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item">
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {
                        ?>
                        <div class="item">
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>">
                          </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                   <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designed By</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php }?>
             </div>

              <div class="clearfix"></div>
              <div class="col-sm-12">
                   <div class="loader" style="display:none;"></div>
                 <div class="loadMore-btn clearfix loadmore_common" <?php if($execution_spas_count[0]['count']<= $offset_spas){ ?> style="display: none;" <?php } ?> id="loadMore_spas" > <a href="javascript:void(0);" data-flag="spas">Load More</a> </div>
             </div>
            </div>
<!--            <div class="col-sm-12">
                <div class="loadMore-btn clearfix" id="loadMore"> <a href="javascript:void(0);">Load More</a> </div>
              </div>-->


            <div> </div>
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

<!--[start:: Load more for PR]-->
<script type="text/javascript">
$(document).ready(function(){
    //load_more('all');
    $( "#all_nav" ).trigger( "click" );
});
$('.loadmore_common').mouseenter(function(e){
    load_more(e.target.dataset.flag);
});

  function load_more(flag){
     $('#'+flag).addClass('active in');
     $("#loadMore_"+flag).hide();
    var offset = parseInt($('#offset_'+flag).val());
    var total_count = parseInt($('#limit_'+flag).val());
    var customerFavoriteExecutions = $('#customerFavoriteExecutions').val();
    var q = '<?php echo $q; ?>';
    var image_size = '<?php echo $image_size; ?>';
    var url='';
    if(flag=='all'){
        url = baseUrl+"Cn_execution/getAjaxAllExecutionPortfolio";
    }else{
        url = baseUrl+"Cn_execution/getAjaxExecutionPortfolio";
    }

    $.ajax({

        url:url,
        type:"post",
         datatype : "html",
        data:{'offset':offset,'flag':flag,'customerFavoriteExecutions':customerFavoriteExecutions,'q':q,'image_size':image_size},
        success: function(response){
            console.log(response);
            console.log('success');
 var data = response.split('|*|*|');

            $('#append_'+flag).append(data[1]);
            $('#offset_'+flag).val(offset+12);
            if(total_count<= parseInt(data[0])){
                $("#loadMore_"+flag).hide();
            }else{
                $("#loadMore_"+flag).show();
            }

       /*[start:: image loader]*/
        $('.owl-demo').owlCarousel({
        center: true,
        loop: false,
        margin: 0,
        autoplay: false,
        nav: true,
        mouseDrag: true,
        smartSpeed: 2500,
        autoplayTimeout:2000,
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
				autoplay: false,
				dots: false,
				nav: true

            },

           768: {
			items: 1,
				autoplay: false,
				dots: false,
				nav: true



            },
            1170: {
				items: 1,

            },
            1920: {
                items: 1,

            }
        }

       //  onTranslated:callBackExecutionSlider

    })
//    function callBackExecutionSlider(){
//          if($('.owl-demo .owl-item').last().hasClass('active')){
//                $('.owl-demo .owl-next').hide();
//                $('.owl-demo .owl-prev').show();
//                console.log('true');
//             }else if($('.owl-demo .owl-item').first().hasClass('active')){
//                $('.owl-demo .owl-prev').hide();
//                $('.owl-demo .owl-next').show();
//                console.log('false');
//             }
//        }
//        $('.owl-demo .owl-prev').hide();
        /*[End:: image loader]*/

        },
        error: function(response){
             console.log(response);
            console.log('error');
        }

    });
    }

  /*[start:Add offset to url]*/
$(document).ready(function(){
 $(document).on('click','#append_all  a',function(){
  this.href = this.href + '&execution_gallery_offset='+$('#offset_all').val()+'&execution_flag=all'
});
 $(document).on('click','#append_pr  a',function(){
  this.href = this.href + '&execution_gallery_offset='+$('#offset_pr').val()+'&execution_flag=residential_interiors'
});
 $(document).on('click','#append_gi  a',function(){
  this.href = this.href + '&execution_gallery_offset='+$('#offset_gi').val()+'&execution_flag=global_inspiration'
});
 $(document).on('click','#append_lh  a',function(){
  this.href = this.href + '&execution_gallery_offset='+$('#offset_lh').val()+'&execution_flag=luxury_hotels'
});
 $(document).on('click','#append_retail  a',function(){
  this.href = this.href + '&execution_gallery_offset='+$('#offset_retail').val()+'&execution_flag=retail'
});
});
 /*[End:Add offset to url]*/

</script>
<!--[End:: Load more for all]-->


<!--[start:: Load Execution gallery for back activity]-->
<?php
$session_execution_flag = $this->session->userdata('execution_flag');
 if(!empty($session_execution_flag)){ ?>
<script type="text/javascript">
function getBackActivityExecutionGallery()
{
    var flag = <?php echo $session_execution_flag;?>;
    $('#'+flag).addClass('active in');

     $("#loadMore_"+flag).hide();
    var offset = 0;
    var limit = parseInt($('#offset_'+flag).val());
    var total_count = parseInt($('#limit_'+flag).val());
    var customerFavoriteExecutions = $('#customerFavoriteExecutions').val();
    var q = '<?php echo $q; ?>';
    var url='';
    if(flag=='all'){
        url = baseUrl+"Cn_execution/getAjaxAllExecutionPortfolio";
    }else{
        url = baseUrl+"Cn_execution/getAjaxExecutionPortfolio";
    }

    $.ajax({

        url:url,
        type:"post",
        data:{'offset':offset,'limit':limit,'flag':flag,'customerFavoriteExecutions':customerFavoriteExecutions,'q':q},
        success: function(response){
            console.log(response);
            console.log('success');
 var data = response.split('|*|*|');

            $('#append_'+flag).append(data[1]);
          //  $('#offset_'+flag).val(offset+12);
            if(total_count<= parseInt(data[0])){
                $("#loadMore_"+flag).hide();
            }else{
                $("#loadMore_"+flag).show();
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
        autoplayTimeout:2000,
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
				autoplay: false,
				dots: false,
				nav: true,

            },

           768: {
			items: 1,
				autoplay: false,
				dots: false,
				nav: true


            },
//            320: {
//				items: 1,
//
//            },
//
//            600: {
//				items: 1,
//
//            },
            1170: {
				items: 1,

            },
            1920: {
                items: 1,

            }
        }
       // onTranslated:callBackExecutionSlider

    })

//    function callBackExecutionSlider(){
//          if($('.owl-demo .owl-item').last().hasClass('active')){
//                $('.owl-demo .owl-next').hide();
//                $('.owl-demo .owl-prev').show();
//                console.log('true');
//             }else if($('.owl-demo .owl-item').first().hasClass('active')){
//                $('.owl-demo .owl-prev').hide();
//                $('.owl-demo .owl-next').show();
//                console.log('false');
//             }
//        }
//        $('.owl-demo .owl-prev').hide();
        /*[End:: image loader]*/

        },
        error: function(response){
             console.log(response);
            console.log('error');
        }

    });
}
getBackActivityExecutionGallery();
</script>
<?php } ?>
<!--[End:: Load Design Concept for back activity]-->
<!--[Start:: BREADCRUMB HANDLING]-->
<script type="text/javascript">


 $('#residential_interiors_nav').click(function(){
 $('.residential_interiors').css('display','block');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','none');

 });

 $('#global_inspiration_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','block');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','none');
 });

 $('#luxury_hotels_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','block');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','none');
 });

 $('#office_space_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','block');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','none');
 });

 $('#restaurant_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','block');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','none');
 });

 $('#spas_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','block');
 $('.retail').css('display','none');
 $('.all').css('display','none');
 });

 $('#retail_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','block');
 $('.all').css('display','none');
 });

 $('#all_nav').click(function(){
 $('.residential_interiors').css('display','none');
 $('.global_inspiration').css('display','none');
 $('.luxury_hotels').css('display','none');
 $('.office_space').css('display','none');
 $('.restaurant').css('display','none');
 $('.spas').css('display','none');
 $('.retail').css('display','none');
 $('.all').css('display','block');
 });


</script>
<!--[End:: BREADCRUMB HANDLING]-->

