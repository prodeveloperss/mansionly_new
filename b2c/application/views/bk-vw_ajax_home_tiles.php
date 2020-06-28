<?php
/*Arrray for the replacement in url*/
$url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
?>
<div class="RanDom_Blocks clearfix">
  <div class="container">
  	<div class="row">
           
            
            <?php foreach ($blogData as $blog){ ?>   
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="BlockRepeat  BlogC clearfix">
                    <a href="<?php echo $blog['blogUrl']?$blog['blogUrl']:''; ?>"> 
                <div class="BlogCIMg"> 
                <img src="<?php echo $blog['imageUrl']; ?>"  alt=""></div>
                <div class="BlockRepeat_Text clearfix">
                    <div class="blogDate"><?php echo date('M d Y',  strtotime($blog['post_date']) ); ?></div>
                        <h4><?php echo $blog['post_title']; ?></h4>
                  <!-- <h4><?php echo $blog['post_name']; ?></h4>-->
                 <div class="names"><?php echo substr( strip_tags($blog['post_content']),0 , 100); ?></div>

                    </div>
                    </a>
                    
                </div>
            </div>
            <?php } ?>
            
            
            <?php foreach ($finalArray as $tile){ ?>
        
            <?php if($tile['tileType']=='executionPortfolio'){ ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="BlockRepeat clearfix">
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($tile['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($tile['portfolio_name'])))).'/ep/'.$tile['id'].'?q=e';?>"> 
                        <div class="BlockRepeat_Img clearfix"> 
                            <img src="<?php echo image_url ; ?>media/images/master-execution-images/370X270/<?php echo $tile['master_image']; ?>"  alt=""></div>
                        <div class="BlockRepeat_Text clearfix">
                        <span class="hearts"> 
                            <img src="<?php echo base_url().SitePath ; ?>assets/img/hearts.png"  alt="">
                        </span>
                        <!--<h4>OFFICE SPACE</h4>-->
                        <div class="names-orng"><?php echo $tile['portfolio_name']; ?></div>
                        <div class="names">Designer - <?php echo $tile['designer_name']; ?></div>
                        <div class="descriptiontext"></div>
                        </div>
                        </a>
                            <a class="likeico" href="javascript:void(0);" >
                        <i class="fa fa-heart <?php if(in_array($tile['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio',<?php echo $tile['id'];?> );"> </i>
                    </a>
                    </div>
                </div>
            <?php }//end if ?>
        
        
        <?php if($tile['tileType']=='brand'){ ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<div class="BlockRepeat clearfix">
            	<?php  if(!empty($tile['brandPageDesignType'])){
                            ?>
                         <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$tile['brand_name']))).'/b/'.$tile['brand_id'].'?q=l';?>">
                         <?php  }else{ ?>      
                        <a href="<?php echo base_url(); ?><?php echo urlencode( $tile['brand_url_name']) ;?>?brandID=<?php echo $tile['brand_id']; ?>&pageType=BLP&q=l"> 
                          <?php } ?> 
                <div class="BlockRepeat_Img clearfix"> 
                     <div class="DBrandImg">
                         <img src="<?php echo image_url ; ?>media/images/ecom/brand/200X110/<?php echo $tile['brand_image']; ?>" alt="" class="brandImgs" >
                     </div> 
                 <!--<img src="<?php echo base_url().SitePath ; ?>media/images/ecom/brand/brandBnrImgs/<?php echo $tile['brandBnrImg']; ?>"  alt="">-->
                    <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $tile['brandTopProductImg']; ?>"  alt="" onerror="$(this).hide();">
                </div>
                <div class="BlockRepeat_Text clearfix">
                <span class="hearts"> <img src="<?php echo base_url().SitePath ; ?>assets/img/hearts.png"  alt=""></span>
                <!--<h4>Brands</h4>-->
                <div class="names-orng"><?php echo $tile['brand_name']; ?></div>
                <div class="names"><?php echo substr( strip_tags($tile['brand_description']),0 , 50); ?></div>
                <div class="descriptiontext"></div>
                </div>
                </a>
            </div>
        </div>
        <?php }//end if ?>
        
         <?php if($tile['tileType']=='product'){ ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<div class="BlockRepeat clearfix">
            	<a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($tile['product_name'])))).'/pdp/'.$tile['product_id']; ?>?q=l&id=<?php echo $tile['category_id']; ?>&page=PLP"> 
                <div class="BlockRepeat_Img clearfix"> <img src="<?php echo image_url ; ?>media/images/ecom/product/<?php echo $tile['product_image']; ?>"  alt=""></div>
                <div class="BlockRepeat_Text clearfix">
                <span class="hearts"> <img src="<?php echo base_url().SitePath ; ?>assets/img/hearts.png"  alt=""></span>
                <!--<h4>PRODUCT</h4>-->
                <div class="names-orng"><?php echo $tile['product_name']; ?></div>
                
                </div>
                </a>
                    <a class="likeico" href="javascript:void(0);" >
                        <i class="fa fa-heart <?php if(in_array($tile['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $tile['product_id'];?> );"> </i>
                    </a>
            </div>
        </div>
         <?php }//end if ?>
            
          <?php if($tile['tileType']=='designer'){ ?>   
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<div class="BlockRepeat clearfix">
            	<a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',$tile['designer_name']))).'/designer/'.$tile['id'].'?q=d';?>"> 
                <div class="BlockRepeat_Img clearfix"> 
                     <div class="DesignerSqImg">
                        
                    	 <!--<img src="<?php echo base_url().SitePath ; ?>assets/img/gt_federica.jpg" alt="">-->
                 <img src="<?php echo image_url ; ?>media/images/designer-images/150X150/<?php echo $tile['designer_logo']; ?>"  alt="">
                     </div> 
                     <?php if (! empty($tile['portfolioImg'])) {?>
                        <img src="<?php echo image_url; ?>media/images/master-execution-images/370X270/<?php echo $tile['portfolioImg']; ?>">
                        <?php  } else if (! empty($tile['designThemeImg'])) {?>
                            <img src="<?php echo image_url; ?>media/images/masterdsg-img/388x300/<?php echo $tile['designThemeImg']; ?>" >
                         <?php  } else {?>  
                            <!--<img src="<?php echo base_url().SitePath ; ?>assets/img/placeholderNew.png" >-->
                         <?php } ?>
                </div>
                <div class="BlockRepeat_Text clearfix">
                <span class="hearts"> <img src="<?php echo base_url().SitePath ; ?>assets/img/hearts.png"  alt=""></span>
                <!--<h4>DESIGNER</h4>-->
                <div class="names-orng"><?php echo $tile['designer_name']; ?></div>
                <div class="names"><?php echo $tile['countryName']; ?></div>
                <div class="descriptiontext"></div>
                </div>
                </a>
                    <a class="likeico" href="javascript:void(0);" >
                        <i class="fa fa-heart <?php if(in_array($tile['id'], $customerFavoriteDesigner)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Designer','designer',<?php echo $tile['id'];?> );"> </i>
                    </a>
            </div>
        </div>
         <?php }//end if ?>
           
             <?php if($tile['tileType']=='designConcept'){ ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<div class="BlockRepeat clearfix">
            	<a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($tile['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($tile['design_display_name'])))).'/dc/'.$tile['design_id'].'?q=l';?>"> 
                <div class="BlockRepeat_Img clearfix"> <img src="<?php echo image_url ; ?>media/images/masterdsg-img/370X270/<?php echo $tile['design_img']; ?>"  alt=""></div>
                <div class="BlockRepeat_Text clearfix">
                <span class="hearts"> <img src="<?php echo base_url().SitePath ; ?>assets/img/hearts.png"  alt=""></span>
                <!--<h4>DESIGN CONCEPT</h4>-->
                 <div class="names"><?php echo $tile['design_display_name']; ?></div>
                <div class="names-orng"><?php echo $tile['designer_name']; ?></div>
                
                </div>
                </a>
                    <a class="likeico" href="javascript:void(0);" >
                        <i class="fa fa-heart <?php if(in_array($tile['design_id'], $customerFavoriteThemes)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Theme','designtheme',<?php echo $tile['design_id'];?> );"> </i>
                    </a>
            </div>
        </div>
         <?php }//end if ?>
            <?php }//end foreach ?>
		     
    </div>
  </div>
 <div class="container">
    	<div class="GetCall_usSect clearfix">
                <div class="CntUS-form clearfix ">
                    <form id="get_started<?php echo $getStartedIndex; ?>" name="get_started<?php echo $getStartedIndex; ?>">
             <input name="userinformation<?php echo $getStartedIndex; ?>" id="userinformation<?php echo $getStartedIndex; ?>"  type="text" class="form-control " placeholder="Share your number for a free design consultation!"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
            <button class="exploreBtn">Contact Me</button>
        </form>
                    
                    <script>
                       $(document).ready(function (){
                            $("#get_started<?php echo $getStartedIndex; ?>").validate({
                    rules: {
                           
                               
                                 userinformation<?php echo $getStartedIndex; ?>: {
					required: true,
                                        maxlength:15,
                                        minlength:10
                                       
				}
			},
			messages: {                           
                              
                                userinformation<?php echo $getStartedIndex; ?>: {
					required: '',
                                        maxlength:'',
                                        minlength:''
				}
			}
		});
                       })
                        </script>
        </div>
        </div>
    </div>
 </div> 

<?php exit(); ?>