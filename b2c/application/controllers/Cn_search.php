<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_search extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_search');
        $this->session_management_lib->index();

    }
   
    
    public function index() {
        
        $data['page_title'] = "Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";
        $data['leadGenFromSliderPageType'] ='search'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'search';   
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';   
        
        $search_keyword = $_GET['q_search'];
        $offset = 0;
        $limit = 24;
        $data['limit'] = $limit;
        
        $array_brand_id= array();
        $brand_id ="";
        if(!empty($_GET['brandID'])){
        $brand_id = $_GET['brandID'];
        $array_brand_id = explode(',',$brand_id);
        }
        $array_soh_id= array();
        $soh_id ="";
        if(!empty($_GET['sohID'])){
        $soh_id = $_GET['sohID'];
        $array_soh_id = explode(',',$soh_id);
        }
        $array_cor= array();
        $cor ="";
        if(!empty($_GET['origin'])){
        $cor = $_GET['origin'];
        $array_cor = explode(',',$cor);
        }
        $data['selected_brand'] = $array_brand_id;
        $data['selected_soh'] = $array_soh_id;
        $data['selected_cor'] = $array_cor;

       $data['disigner_list'] = $this->Md_search->getDesignerDetailSearch($search_keyword,$offset,$limit);
//       
       $data['designer_all_count'] = $this->Md_search->getDesignerTotalCount($search_keyword);
        /*[start::get_product_id_by_color_and_material]*/
        $product_id_array = $this->Md_search->get_product_id_by_color_and_material($search_keyword);        
              
        $product_id = "";
        if(!empty($product_id_array)){
         $product_id_array = explode(",",$product_id_array[0]['product_id']);
         $product_id = implode("','", $product_id_array);
        }  
        $data['product_id']=$product_id;
        $data['product_list'] =  $this->Md_search->getProductListSearch($search_keyword,$offset,$limit,$array_brand_id,$array_soh_id,$array_cor,$product_id);
        $data['product_all_count'] = $this->Md_search->getProductTotalCount($search_keyword,$array_brand_id,$array_soh_id,$array_cor,$product_id);
        $data['portfolio_list'] = $this->Md_search->getPorfolioList($search_keyword,$offset,$limit);
        $data['portfolio_all_count'] = $this->Md_search->getPorfolioTotalCount($search_keyword);

        $data['search_keyword'] = $search_keyword;
        $data['highlighted_keyword'] = '<u>'.$search_keyword.'</u>';
        
        $data['total_count'] = $data['designer_all_count'][0]['totalCount'] + count($data['product_all_count'])+ $data['portfolio_all_count'][0]['totalCount'];
       
        $data['brand_list'] = $this->Md_search->get_brand_list($array_soh_id,$array_cor,$search_keyword,$product_id);
        $data['section_list'] = $this->Md_search->get_section_list($array_brand_id,$array_cor,$search_keyword,$product_id);
        $data['country_list'] = $this->Md_search->get_country_list($array_brand_id,$array_soh_id,$search_keyword,$product_id);
                             
        /*Start:: get favorite list of customer*/
           $data['customerFavoriteProduct']=array();
            if(!empty($_SESSION['customer_id'])){
                $table = 'customer_favorites_list';
                $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'marketseller');
                $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
                foreach ($result as $row){
                    $data['customerFavoriteProduct'][]=$row['favorites_record_id'];
                }
           } 
           /*End:: get favorite list of customer*/
     // echo "<pre>";print_r($data['product_id']);die;
        $this->load->view('vw_search', $data);
    }  
   
     public function ajaxProductList() {
        
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $search_keyword = $_POST['search_keyword'];
        $brand_id = $_POST['brand_id'];
        $soh_id = $_POST['soh_id'];
        $cor = $_POST['cor'];   
        $product_id = $_POST['product_id'];      
        $highlighted_keyword = $_POST['highlighted_keyword'];
        $char_limit = $_POST['char_limit'];
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
       
        /*Arrray for the replacement in url*/
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
      
     
       /*get::Product list by $subCatIdList */
      $product_list = $this->Md_search->getProductListSearch($search_keyword,$offset,$limit,$brand_id,$soh_id,$cor,$product_id);
       echo $incremented_offset.'|*|*|';  
       
      foreach ($product_list as $key => $row) { 
        
            $string = $row['short_description'];
            $long_desc = $row['product_details'];;
            $pre_sub_string = substr($string,0,$char_limit);
          //$description='';
            $description=$pre_sub_string;
            $product_material = $this->Md_search->get_product_material($row['product_id']);
            $product_color = $this->Md_search->get_product_color($row['product_id']);
            $material='';
            if(!empty($product_material)){
                $material = $product_material[0]['material'];
            }
            $color='';
            if(!empty($product_color)){
                $color = $product_color[0]['color'];
            }
            /*[start::Code to Handel character limit if word is break.]*/
            $string_pos = stripos($string, $search_keyword)+1;
            $string_length = strlen($search_keyword);
            if(($char_limit+$string_length)< $string_pos){
                $char_limit = $char_limit+$string_length;
            }
            /*[End::Code to Handel character limit if word is break.]*/

            /*[start:: Check if search keyword available short description]*/
            if (stripos($string, $search_keyword) !== false){

            if (stripos($pre_sub_string, $search_keyword) !== false){

                $description = $pre_sub_string;
            }else{
                 $next_sub_string = substr($string,$char_limit);
                if (stripos($next_sub_string,$search_keyword) !== false){
                    $leading_word = '';
                    $trailing_word= '';
                    $words = explode($search_keyword, $next_sub_string);
                    foreach($words as $key => $word_row){
                        $split_word = explode(' ',$word_row);
                        $split_word = array_filter($split_word);
                        if($key==0){                                       
                        $leading_word =" ".array_pop($split_word);
                        $leading_word =array_pop($split_word)." ".$leading_word;                                        
                        }

                        if($key==1){
                        $trailing_word.=" ".array_shift($split_word);
                        $trailing_word.=" ".array_shift($split_word);
                        }

                    }

                    $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

                }
            }
            }
            /*[End:: Check if search keyword available in short description]*/

            /*[start:: Check if search keyword available long description]*/

            else if (stripos($long_desc, $search_keyword) !== false){  

                    $leading_word = '';
                    $trailing_word= '';
                    $words = explode($search_keyword, $long_desc);
                   foreach($words as $key => $word_row){
                        $split_word = explode(' ',$word_row);
                        $split_word = array_filter($split_word);
                        if($key==0){                                       
                        $leading_word =" ".array_pop($split_word);
                        $leading_word =array_pop($split_word)." ".$leading_word;                                        
                        }

                        if($key==1){
                        $trailing_word.=" ".array_shift($split_word);
                        $trailing_word.=" ".array_shift($split_word);
                        }

                    }
              $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
            }
            /*[End:: Check if search keyword available in long description]*/

            /*[start:: Check if search keyword available material]*/

            else if (stripos($material, $search_keyword) !== false){  


              $description = $pre_sub_string.".. Material : ".$material;
            }
            /*[End:: Check if search keyword available in material]*/

            /*[start:: Check if search keyword available color]*/

            else if (stripos($color, $search_keyword) !== false){  


              $description = $pre_sub_string.".. Color : ".$color;
            }
            /*[End:: Check if search keyword available in color]*/
       
          
          ?>  
            
       <li>
        <div class="searchMain-probox clearfix"> 
            <a class="likeico" href="javascript:void(0);"><i  class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a> 
            <a target="_blank" class="" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>">
              <div class="searchMain-proboxImg"> 
                  <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"> 
              </div>
            </a>
          <div class="searchMain-probox-titl"> 
              <a class="" href="javascript:void(0);">                                  
              <?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['product_name']);?>
              </a> 
          </div>                                                         

          <div class="searchMain-probox-subtxt"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$description);; ?></div>
        </div>
       </li>
            
            <?php 
                }/*end:foreach;*/
       die;
    } 

     public function ajaxDesignerList() {
        
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $search_keyword = $_POST['search_keyword'];
        $highlighted_keyword = $_POST['highlighted_keyword'];
        $char_limit = $_POST['char_limit'];

         /*get::subcat id list*/
       
        /*Arrray for the replacement in url*/
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
       /*get::Product list by $subCatIdList */
      $designer_list = $this->Md_search->getDesignerDetailSearch($search_keyword,$offset,$limit);

       echo $incremented_offset.'|*|*|';  
       
      foreach ($designer_list as $key => $row) { 
          
        $string = strip_tags($row['introduction']);
        $designer_description = strip_tags($row['designer_description']);
        $design_philosophy = strip_tags($row['design_philosophy']);
        $design_awards = strip_tags($row['design_awards']);
        $pre_sub_string = substr($string,0,$char_limit);
      //$description='';
        $description=$pre_sub_string;

        /*[start::Code to Handel character limit if word is break.]*/
        $string_pos = stripos($string, $search_keyword)+1;
        $string_length = strlen($search_keyword);
        if(($char_limit+$string_length)< $string_pos){
            $char_limit = $char_limit+$string_length;
        }
        /*[End::Code to Handel character limit if word is break.]*/

         /*[start:: Check if search keyword available introduction]*/
        if (stripos($string, $search_keyword) !== false){

        if (stripos($pre_sub_string, $search_keyword) !== false){

            $description = $pre_sub_string;
        }else{

             $next_sub_string = substr($string,$char_limit);
            if (stripos($next_sub_string,$search_keyword) !== false){
               $leading_word = '';
               $trailing_word= '';
               $words = explode($search_keyword, $next_sub_string);

               foreach($words as $key => $word_row){
                    $split_word = explode(' ',$word_row);
                    $split_word = array_filter($split_word);
                    if($key==0){                                       
                    $leading_word =" ".array_pop($split_word);
                    $leading_word =array_pop($split_word)." ".$leading_word;                                        
                    }
                    if($key==1){
                    $trailing_word.=" ".array_shift($split_word);
                    $trailing_word.=" ".array_shift($split_word);
                    }

                }

                $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

            }
        }
        }
        /*[End:: Check if search keyword available in introduction]*/

        /*[start:: Check if search keyword available designer_description]*/

        else if (stripos($designer_description, $search_keyword) !== false){  

               $leading_word = '';
               $trailing_word= '';                              
               $words = explode($search_keyword,$designer_description);

               foreach($words as $key => $word_row){
                    $split_word = explode(' ',$word_row);
                    $split_word = array_filter($split_word);
                    if($key==0){                                       
                    $leading_word =" ".array_pop($split_word);
                    $leading_word =array_pop($split_word)." ".$leading_word;                                        
                    }

                    if($key==1){
                    $trailing_word.=" ".array_shift($split_word);
                    $trailing_word.=" ".array_shift($split_word);
                    }

                }

           $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";

        }
        /*[End:: Check if search keyword available in designer_description]*/

         /*[start:: Check if search keyword available in design_philosophy]*/

        else if (stripos($design_philosophy, $search_keyword) !== false){  

               $leading_word = '';
               $trailing_word= '';
               $words = explode($search_keyword, $design_philosophy);
               foreach($words as $key => $word_row){
                    $split_word = explode(' ',$word_row);
                    $split_word = array_filter($split_word);
                    if($key==0){                                       
                    $leading_word =" ".array_pop($split_word);
                    $leading_word =array_pop($split_word)." ".$leading_word;                                        
                    }

                    if($key==1){
                    $trailing_word.=" ".array_shift($split_word);
                    $trailing_word.=" ".array_shift($split_word);
                    }
                }
          $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
        }
        /*[End:: Check if search keyword available in design_philosophy]*/

         /*[start:: Check if search keyword available in design_awards]*/

        else if (stripos($design_awards, $search_keyword) !== false){  

               $leading_word = '';
               $trailing_word= '';
               $words = explode($search_keyword, $design_awards);
               foreach($words as $key => $word_row){
                    $split_word = explode(' ',$word_row);
                    $split_word = array_filter($split_word);
                    if($key==0){                                       
                    $leading_word =" ".array_pop($split_word);
                    $leading_word =array_pop($split_word)." ".$leading_word;                                        
                    }

                    if($key==1){
                    $trailing_word.=" ".array_shift($split_word);
                    $trailing_word.=" ".array_shift($split_word);
                    }
                }
          $description = $pre_sub_string."..".$leading_word." ".$search_keyword." ".$trailing_word."..";
        }
        /*[End:: Check if search keyword available in design_awards]*/
          
          
          
          ?>  
            
            <li>
                <div class="searchRlt-desigerbox clearfix">
                <a target="_blank" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'];?>">
                    <div class="searchRlt-desiger-img"> <img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo'];?>" alt="<?php echo $row['designer_name']; ?>"> </div>
                  <div class="searchRlt-desiger-name"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['designer_name']); ?></div>
                      <div class="searchRlt-desiger-loction"><i class="fa fa-map-marker"></i> <?php echo $row['countryName'];?></div>
                  <div class="searchRlt-desiger-des"><?php echo str_ireplace($search_keyword,$highlighted_keyword,$description); ?></div>
                </a>
                </div>
            </li>  
            
            <?php 
                }/*end:foreach;*/
       die;
    }
    
    public function ajaxPortfolioList() {
        
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $search_keyword = $_POST['search_keyword'];
        $image_size = $_POST['image_size'];
        $highlighted_keyword = $_POST['highlighted_keyword'];

        /*Arrray for the replacement in url*/
         $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
       
       
       /*get::Product list by $subCatIdList */
      $portfolio_list = $this->Md_search->getPorfolioList($search_keyword,$offset,$limit);
       echo $incremented_offset.'|*|*|';  
      
      foreach ($portfolio_list as $key => $row) { ?>  
                <li>
                    <div class="design-profile-box">
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
                               <a target="_blank" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'];?>">
                                   <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" > 
                               </a>
                           </div>
                           <?php
                           if(!empty($row['secondary_images'])){ 
                           $array = explode(',', $row['secondary_images']);

                          foreach ($array as $row_image) {                        
                           ?>
                           <div class="item"> 
                              <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'];?>">
                                  <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" > 
                              </a>
                           </div>
                          <?php  } } ?>
                     <?php   if(!empty($row['secondary_images'])){ ?>
                     </div>
                      <?php } ?>
                     <div class="searchMain-probox-titl">
                        <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'];?>">
                        <?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['portfolio_name']); ?>
                        </a>
                     </div>
                     <?php if(!empty($row['designer_name'])){ ?>
                     <div class="searchMain-probox-subtxt">Designer - <?php echo str_ireplace($search_keyword,$highlighted_keyword,$row['designer_name']); ?>
                     </div>
                     <?php } ?>
                   </div>
                 </li>
            
            <?php 
                }/*end:foreach;*/
       die;
    }
    
    public function ajaxGetFilterDetailsForSearch(){
       $brand_string = $_POST['brand_string'];
       $soh_string = $_POST['soh_string'];
       $cor_string = $_POST['cor_string'];
       $search_keyword = $_POST['search_keyword'];
       $product_id = $_POST['product_id'];
       $array_brand_id  = array();
       $array_soh_id  = array();
       $array_cor  = array();
       $arrSubCatIds  = array();
      
       if(!empty($brand_string)){
           $array_brand_id   = explode(',', $brand_string);
       }
       if(!empty($soh_string)){
          $array_soh_id   = explode(',', $soh_string);
       }
       if(!empty($cor_string)){
          $array_cor = explode(',', $cor_string);
       }
        
       if(!empty($subCatIds_string)){
          $arrSubCatIds = explode(',', $subCatIds_string);
       }
        
        
        $selected_soh = $array_soh_id;
        $selected_brand = $array_brand_id;
        $selected_cor = $array_cor;
        
     
      
       $brand_list = $this->Md_search->get_brand_list($array_soh_id,$array_cor,$search_keyword,$product_id);
       $section_list = $this->Md_search->get_section_list($array_brand_id,$array_cor,$search_keyword,$product_id);
       $country_list = $this->Md_search->get_country_list($array_brand_id,$array_soh_id,$search_keyword,$product_id);
      
       
       ?>
       ||*||
               
    <div class="brandTopSearchRow">
        <div class="alphabets">
            <a class="all active" data-index="All" href="javascript:void(0);">All</a>
            <a class="hash " data-index="hash" href="javascript:void(0);">#</a>
            <a class="a " data-index="a" href="javascript:void(0);">A</a>
            <a class="b" data-index="b" href="javascript:void(0);">B</a>
            <a class="c"  data-index="c" href="javascript:void(0);">C</a>
            <a class="d"  data-index="d" href="javascript:void(0);">D</a>
            <a class="e"  data-index="e" href="javascript:void(0);">E</a>
            <a class="f"  data-index="f" href="javascript:void(0);">F</a>
            <a class="g" data-index="g"  href="javascript:void(0);">G</a>
            <a class="h"  data-index="h" href="javascript:void(0);">H</a>
            <a class="i"  data-index="i"  href="javascript:void(0);">I</a>
            <a class="j"  data-index="j" href="javascript:void(0);">J</a>
            <a class="k"  data-index="k" href="javascript:void(0);">K</a>
            <a class="l"  data-index="l"  href="javascript:void(0);">L</a>
            <a class="m"  data-index="m" href="javascript:void(0);">M</a>
            <a class="n"  data-index="n"  href="javascript:void(0);">N</a>
            <a class="o" data-index="o"  href="javascript:void(0);">O</a>
            <a class="p"  data-index="p"  href="javascript:void(0);">P</a>
            <a class="q"  data-index="q"  href="javascript:void(0);">Q</a>
            <a class="r" data-index="r" href="javascript:void(0);">R</a>
            <a class="s" data-index="s" href="javascript:void(0);">S</a>
            <a class="t" data-index="t" href="javascript:void(0);">T</a>
            <a class="u" data-index="u" href="javascript:void(0);">U</a>
            <a class="v" data-index="v" href="javascript:void(0);">V</a>
            <a class="w" data-index="w" href="javascript:void(0);">W</a>
            <a class="x" data-index="x" href="javascript:void(0);">X</a>
            <a class="y" data-index="y" href="javascript:void(0);">Y</a>
            <a class="z" data-index="z" href="javascript:void(0);">Z</a>
        </div>
        <div class="SearchBrndWrap clearfix">
            <span style="position: absolute;right:10px;top:3px;cursor: pointer;" class="cleaBtns" > <i class="fa fa-search"></i> </span>
            <input class="search serchbrnd" placeholder="Search" />
        </div>
    </div>

    <div class="clearfix"></div>



    <div  class="Brand_select-right-filter">
        <div id="main_content" class="inner">
            <div id="users" class="tabContainer">

                <ul id="demoOne" class="list" style="position: relative;">
                    <?php 
                    $hash_flag=0;
                    $A_flag = 0;
                    $B_flag = 0;
                    $C_flag = 0;
                    $D_flag = 0;
                    $E_flag = 0;
                    $F_flag = 0;
                    $G_flag = 0;
                    $H_flag = 0;
                    $I_flag = 0;
                    $J_flag = 0;
                    $K_flag = 0;
                    $L_flag = 0;
                    $M_flag = 0;
                    $N_flag = 0;
                    $O_flag = 0;
                    $P_flag = 0;
                    $Q_flag = 0;
                    $R_flag = 0;
                    $S_flag = 0;
                    $T_flag = 0;
                    $U_flag = 0;
                    $V_flag = 0;
                    $W_flag = 0;
                    $X_flag = 0;
                    $Y_flag = 0;
                    $Z_flag = 0;
                    foreach ($brand_list as $key => $row) {
                        
                       $product_count = $this->Md_search->get_brand_product_count($row['brand_id'],$array_soh_id="",$array_cor="",$search_keyword,$product_id);
                       $row['ProductCount'] = $product_count[0]['ProductCount'];

                        switch(strtolower(substr($row['brand_name'], 0, 1))) {
                                    case 'a':
                                        if($A_flag==0){
                                        $A_flag = 1;
                                        echo '<li class=""><strong>A</strong></li>';
                                         }
                                        break;
                                    case 'b':
                                        if($B_flag==0){
                                            $B_flag = 1;
                                            echo '<li class=""><strong>B</strong></li>';
                                        }
                                        break;
                                    case 'c':
                                        if($C_flag==0){
                                            
                                        $C_flag = 1;
                                        echo '<li class=""><strong>C</strong></li>';
                                        }
                                        break;
                                    case 'd':
                                        if($D_flag==0){
                                            
                                        $D_flag = 1;
                                        echo '<li class=""><strong>D</strong></li>';
                                        }
                                        break;
                                    case 'e':
                                        if($E_flag==0){
                                            
                                        $E_flag = 1;
                                        echo '<li class=""><strong>E</strong></li>';
                                        }

                                        break;
                                    case 'f':
                                        if($F_flag==0){
                                            
                                        $F_flag = 1;
                                        echo '<li class=""><strong>F</strong></li>';
                                        }

                                        break;
                                    case 'g':
                                        if($G_flag==0){
                                            
                                        $G_flag = 1;
                                        echo '<li class=""><strong>G</strong></li>';
                                        }
                                        break;
                                    case 'h':
                                        if($H_flag==0){
                                            
                                        $H_flag = 1;
                                        echo '<li class=""><strong>H</strong></li>';
                                        }

                                        break;
                                    case 'i':
                                        if($I_flag==0){
                                            
                                        $I_flag = 1;
                                        echo '<li class=""><strong>I</strong></li>';
                                        }

                                        break;
                                    case 'j':
                                        if($J_flag==0){
                                        $J_flag = 1;
                                        echo '<li class=""><strong>J</strong></li>';
                                        }
                                        break;
                                    case 'k':
                                        if($K_flag==0){
                                        $K_flag = 1;
                                        echo '<li class=""><strong>K</strong></li>';
                                        }
                                        break;
                                    case 'l':
                                        if($L_flag==0){
                                        $L_flag = 1;
                                        echo '<li class=""><strong>L</strong></li>';
                                        }
                                        break;
                                    case 'm':
                                        if($M_flag==0){
                                        $M_flag = 1;
                                        echo '<li class=""><strong>M</strong></li>';
                                        }
                                        break;
                                    case 'n':
                                        if($N_flag==0){
                                        $N_flag = 1;
                                        echo '<li class=""><strong>N</strong></li>';
                                        }
                                        break;
                                    case 'o':
                                        if($O_flag==0){
                                        $O_flag = 1;
                                        echo '<li class=""><strong>O</strong></li>';
                                        }
                                        break;
                                    case 'p':
                                        if($P_flag==0){
                                        $P_flag = 1;
                                        echo '<li class=""><strong>P</strong></li>';
                                        }
                                        break;
                                    case 'q':
                                        if($Q_flag==0){
                                        $Q_flag = 1;
                                        echo '<li class=""><strong>Q</strong></li>';
                                        }
                                        break;
                                    case 'r':
                                        if($R_flag==0){
                                        $R_flag = 1;
                                        echo '<li class=""><strong>R</strong></li>';
                                        }
                                        break;
                                    case 's':
                                        if($S_flag==0){
                                        $S_flag = 1;
                                        echo '<li class=""><strong>S</strong></li>';
                                        }
                                        break;
                                    case 't':
                                        if($T_flag==0){
                                        $T_flag = 1;
                                        echo '<li class=""><strong>T</strong></li>';
                                        }
                                        break;
                                    case 'u':
                                        if($U_flag==0){
                                        $U_flag = 1;
                                        echo '<li class=""><strong>U</strong></li>';
                                        }
                                        break;
                                    case 'v':
                                        if($V_flag==0){
                                        $V_flag = 1;
                                        echo '<li class=""><strong>V</strong></li>';
                                        }
                                        break;
                                    case 'w':
                                        if($W_flag==0){
                                        $W_flag = 1;
                                        echo '<li class=""><strong>W</strong></li>';
                                        }
                                        break;
                                    case 'x':
                                        if($X_flag==0){
                                        $X_flag = 1;
                                        echo '<li class=""><strong>X</strong></li>';
                                        }
                                        break;
                                    case 'y':
                                        if($Y_flag==0){
                                        $Y_flag = 1;
                                        echo '<li class=""><strong>Y</strong></li>';
                                        }
                                        break;
                                    case 'z':
                                        if($Z_flag==0){
                                        $Z_flag = 1;
                                        echo '<li class=""><strong>Z</strong></li>';
                                        }
                                        break;

                                    default:
                                        if($hash_flag==0){
                                        $hash_flag = 1;
                                        echo '<li class=""><strong>#</strong></li>';
                                        }
                                } 

                            if ($row['ProductCount']!=0) {
                        ?>
                        <li class=" <?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['brand_id'], $selected_brand)) { ?> BrandSectChek <?php } ?>">

                            <div class="checkstyle-brand"> 
                                <input <?php if (($row['ProductCount']==0)) { ?> disabled="" <?php } ?> class="brand" onclick="show_brand_filter_list(<?php echo $row['brand_id']; ?>);" <?php if (in_array($row['brand_id'], $selected_brand)) { ?> checked="" <?php } ?> name="brand_id[]" type="checkbox" id="chek_<?php echo $row['brand_id']; ?>" value="<?php echo $row['brand_id']; ?>"> 
                                <label for="chek_<?php echo $row['brand_id']; ?>"></label> 
                            </div> 
                            <a href="javascript:void(0);" onclick="$(<?php echo '\'#chek_'.$row['brand_id'].'\''; ?>).click();" id="label_brand_id_<?php echo $row['brand_id']; ?>" class="name"><?php echo $row['brand_name']; ?></a> 
                            <?php echo ' ('.$row['ProductCount'].')'; ?>

                        </li>
                    <?php } }?>                
                </ul>
            </div>
        </div>
    </div>

    <div class="threeBtns">
        <button type="submit" class="apply_button">APPLY</button>
        <a href="javascript:void(0);"  onclick="uncheckBarnds();" >CLEAR FILTERS</a>
    </div>
    <script>

        jQuery(function(){
        $('#demoOne').listnav({
                includeAll: true,
                includeNums: false
                });
            });
            $('.ln-letters').hide();

    var list = ['hash','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

            /*Start::Search operation*/
            $(document).on('keyup','.search',function(){
            var keyword = $(this).val();
            if(keyword!=''){

                $('#brands .SearchBrndWrap span i').removeClass('fa-search');
                $('#brands .SearchBrndWrap  span i').addClass('fa-close');
            }else{
              $('#brands .SearchBrndWrap span i').addClass('fa-search');
                $('#brands .SearchBrndWrap span i').removeClass('fa-close');  
            }
            $("#demoOne a.name").parent('li').css('display','block');

            $("#demoOne a.name:not(:contains('"+keyword+"'))").parent('li').css('display','none');
           for(var i=0;i<list.length;i++){
             if($('#demoOne li.ln-'+list[i]+' a:visible').length<1){
                 $('#demoOne li.ln-'+list[i]+' strong').parent().css('display','none');
                 $('.alphabets a.'+list[i]).addClass('disabled');
             }else{
                 $('#demoOne li.ln-'+list[i]+' strong').parent().css('display','block');
                $('.alphabets a.'+list[i]).removeClass('disabled');
             }
            // console.log(list[i]+' '+$('li.ln-'+list[i]+':visible').length);
           }
            getPositions();
        });
        /*End :: Search operation*/

        $(document).on('click',".alphabets a",function(){

            var position = $(this).attr('data-position');
            var classTag = $(this).attr('data-index');
          // console.log(position);

         if(!$(this).hasClass('disabled')){
           $('.alphabets a').removeClass('active');
            $(this).addClass('active');
           if($('#demoOne li.ln-'+classTag+':visible').length>=1){
    //        $('#demoOne').scrollLeft(position);
            $('#demoOne').animate({ scrollLeft: position }, 500);

           }  
          }

           if(classTag==='All'){

            $('.alphabets a').removeClass('active');
            $(this).addClass('active');

               $('.search').val('');
               $('#demoOne').scrollLeft('0');
             $('.search').keyup();

           }

        });

             $('#brand_tab').one('click',function(){

       setTimeout(function() {$('#demoOne').scrollLeft('0'); $('.search').keyup(); }, 300);

     });
            $('#demoOne li.BrandSectChek').each(function(){
                var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
                var alphabet = String(selectedClass).split("-");
                  if($('#demoOne .'+selectedClass+'.BrandSectChek').length>0){
                    $('#demoOne .'+selectedClass+' strong').parent('li').addClass('BrnadMainSelct');
                    $('.alphabets a.'+alphabet[1]).addClass('BrnadMainSelct');

                }else{
                    $('#demoOne .'+selectedClass+' strong').parent('li').removeClass('BrnadMainSelct');
                    $('.alphabets a.'+alphabet[1]).removeClass('BrnadMainSelct');
                   }
                });
                $('.search').keyup();
                function getPositions(){
                        $(".alphabets a").each(function(){

                            var position=0;
                            var classTag = $(this).attr('data-index');

                            if(classTag!='All' && $('li.ln-'+classTag).length>0){

                            position = $('li.ln-'+classTag).first().position();
                            $(this).attr('data-position',position.left);

                            }else{
                              $(this).attr('data-position','0');  
                            }
                             console.log(classTag+"=>"+position.left);
                        });
                    }

                    $(document).on('click','#brands .SearchBrndWrap  span i.fa-close',function(){
                        $('.search').val('');
                        $('.search').keyup();
                    });
                 /*start:: Script for brand lable color change to blue if any brand is selected*/
             $('#demoOne li div').parent('li').click(function(){
                    var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
                    var alphabet = String(selectedClass).split("-");
                    if($('#demoOne .'+selectedClass+'.BrandSectChek').length>0){
                        $('#demoOne .'+selectedClass+' strong').parent('li').addClass('BrnadMainSelct');
                        $('.alphabets a.'+alphabet[1]).addClass('BrnadMainSelct');
                    }else{
                        $('#demoOne .'+selectedClass+' strong').parent('li').removeClass('BrnadMainSelct');
                        $('.alphabets a.'+alphabet[1]).removeClass('BrnadMainSelct');
                    }
                });


                /*End::Script for brand lable color change to blue if any brand is selected*/
                </script>

  ||*||

    <div class="brand-chebox">
        <ul>

            <?php foreach ($section_list as $key => $row) { 
                $product_count = $this->Md_search->get_section_product_count($row['id'],$array_brand_id="",$array_cor="",$search_keyword,$product_id);
              // print_r($product_count);die;
                $row['ProductCount'] = $product_count[0]['ProductCount'];

                ?>
                <?php 
               // $product_count_by_soh = $this->Md_generic_listing->productCountBySoh($row['id'],$arrSubCatIds);       
                 if ($row['ProductCount']!=0) {
                ?>
                <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['id'], $selected_soh)) { ?> BrandSectChek<?php } ?>">
                    <div class="checkstyle">
                        <input <?php if ($row['ProductCount']==0) { ?> disabled="" <?php } ?> class="SOH" onclick="show_soh_filter_list(<?php echo $row['id']; ?>);" <?php if (in_array($row['id'], $selected_soh)) { ?> checked="" <?php } ?> name="soh_id[]" type="checkbox" id="chek1_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                        <label  id="label_soh_id_<?php echo $row['id']; ?>" for="chek1_<?php echo $row['id']; ?>"><?php echo $row['title']; ?></label>
                        <?php echo ' ('.$row['ProductCount'].')'; ?>

                    </div>
                </li> 
            <?php } }?>

        </ul>   
    </div> 

    <div class="threeBtns">
        <button type="submit" class="apply_button">APPLY</button>
        <!--<a href="javascript:void(0);" onclick="hide_SOH_tab();">CANCEL</a>-->
        <!--<a href="javascript:void(0);" <?php if(!empty($selected_soh)){ ?> onclick="uncheckSOH();" <?php } ?>>CLEAR FILTERS</a>-->
        <a href="javascript:void(0);"  onclick="uncheckSOH();" >CLEAR FILTERS</a>
    </div>

    ||*||

    <div class="brand-chebox">
        <ul>
            <?php foreach ($country_list as $key => $row) {
                
                $product_count = $this->Md_search->get_country_product_count($row['idCountry'],$array_brand_id="",$array_soh_id="",$search_keyword,$product_id);
                $row['ProductCount'] = $product_count[0]['ProductCount'];
                ?>
            <?php 
                if ($row['ProductCount']!=0) {
                ?>
                <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['countryName'], $selected_cor)) { ?>BrandSectChek<?php } ?>">
                    <div class="checkstyle">
                        <input  <?php if ($row['ProductCount']==0) { ?> disabled="" <?php } ?> class="COR" onclick="show_cor_filter_list('<?php echo $row['countryName']; ?>');" <?php if (in_array($row['countryName'], $selected_cor)) { ?> checked="" <?php } ?> name="cor[]" type="checkbox" id="chek2_<?php echo $row['countryName']; ?>" value="<?php echo $row['countryName']; ?>">
                        <label  id="label_cor_id_<?php echo $row['countryName']; ?>" for="chek2_<?php echo $row['countryName']; ?>"><?php echo $row['countryName']; ?></label>
                        <?php echo ' ('.$row['ProductCount'].')'; ?>

                    </div>
                </li> 

            <?php } } ?>
        </ul>   
    </div> 

    <div class="threeBtns">
        <button type="submit" class="apply_button">APPLY</button>
        <!--<a href="javascript:void(0);" onclick="hide_COR_tab();">CANCEL</a>-->
        <a href="javascript:void(0);"  onclick="uncheckCOR();">CLEAR FILTERS</a>
    </div>

<?php
   }
   
   
      public function search_product_listing_action() {
             // echo "<pre>"; print_r($_POST);die;

       $brand_id =array();
       $soh_id =array();
       $cor =array();
  
       $brand_id = $_POST['brand_id'];
       $soh_id = $_POST['soh_id'];
       $cor = $_POST['cor'];
       $search_keyword = $_POST['search_keyword'];
     
       $redirect_url='';
       $redirect_url1 = base_url().'search?q_search='.$search_keyword;    
       
       if(!empty($brand_id)){
       sort($brand_id);
       $arrlength = count($brand_id);
        for($x = 0; $x < $arrlength; $x++) {
           $brand_id[$x];           
       }
       $brand_id_string = implode(',',$brand_id);
       $redirect_url3[]= '&brandID='.$brand_id_string;
       }
      
      
       
       if(!empty($soh_id)){
       sort($soh_id);
       $arrlength = count($soh_id);
        for($x = 0; $x < $arrlength; $x++) {
           $soh_id[$x];           
        }
       $soh_id_string = implode(',',$soh_id);
       $redirect_url3[]= '&sohID='.$soh_id_string;
       }
       if(!empty($cor)){
       sort($cor);
       $arrlength = count($cor);
        for($x = 0; $x < $arrlength; $x++) {
           $cor[$x];           
        }
       $cor_string = implode(',',$cor);
       $redirect_url3[]= '&origin='.$cor_string;
       }
     
       $redirect_url .= $redirect_url1.implode('&', $redirect_url3);

     redirect($redirect_url);
    
    }  
    
    
        
     
}
