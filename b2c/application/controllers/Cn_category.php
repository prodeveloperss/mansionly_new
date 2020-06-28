<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_category extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_category');
        $this->session_management_lib->index();

    }
   



    
    
     
    public function all_categories() {
        
        
        //$data['page_title'] = "All Categories | Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";
        $data['page_title'] = "All Categories | Interior Design, Bedroom Designs, Home Designs";
        $data['leadGenFromSliderPageType'] = 'all-categories-page'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'category';   
        $data['meta_description'] = 'Get the best design, inspirations on projects, furnitures, and decorations. Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com';
        $data['meta_keywords'] = 'home decorations, interior decorations, design decorations';   
        $data['totalCount'] = $this->Md_category->getProduct_topcategoriesCount();
        $offset = 0;
        /*[start::Assign limit in session for back activity]*/
        $session_all_cat_limit = $this->session_management_lib->session_all_cat_limit;
        if($session_all_cat_limit){
            $limit = $session_all_cat_limit;          
        }
        /*[End::Assign limit in session for back activity]*/
        else{
        $limit = 24;
        }
        $data['limit']=$limit;

        $data['category_list'] = $this->Md_category->getProduct_topcategories($offset,$limit);

        $this->load->view('category/vw_all_categories', $data);
    }  
    
    
 public function ajaxAllCategories() {
        
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $product_list = $this->Md_category->getProduct_topcategories($offset,$limit);
        $q = $_POST['q'];

       echo $incremented_offset.'|*|*|';  
       
      foreach ($product_list as $key => $row) { ?>            
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more" >
              <div class="brandBox clearfix">
              <a class="likeico" href="javascript:void(0);"><i class="fa fa-heart" aria-hidden="true"></i></a>
                <div class="brand-wrap">
                  <div class="BrandImg-explore"> 
                      <a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']); ?>?q=<?php echo $q; ?>">
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_name']; ?>"> 
                      </a> 
                  </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']); ?>?q=<?php echo $q; ?>"> <?php echo $row['product_name']; ?> </a></div>
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
       
    }  
   

    
        
    public function category_product_list($product_id,$product_name) {
        
        $data['page_title'] = "Decorations | Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com ";
        $data['page_name'] = 'category_product_list';   
        $data['meta_description'] = 'Get the best design, inspirations on projects, furnitures, and decorations. Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com';
        $data['meta_keywords'] = 'home decorations, interior decorations, design decorations';   
       // $data['cat_name'] = $cat_name;
       
       $data['product_list'] = $this->Md_category->getProductList_full($product_id);
//       echo "<pre>";
//      print_r($data['product_list']);die;
        $this->load->view('category/vw_category_product', $data);
    } 
}
