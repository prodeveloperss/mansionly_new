<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_featured extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_featured');
        $this->session_management_lib->index();

    }
   
    

 
    public function bespoke() {
        
        $data['page_title'] = "Find Out All the Best Luxury Interior Design Brands at Mansionly";
        $data['leadGenFromSliderPageType'] ='bespoke';
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'featured';   
        $data['page_heading'] = 'Bespoke at Mansionly';   
        //$data['meta_description'] = '';
        $data['meta_description'] = 'Bespoke at Mansionly | Choose from 100+ brands and make you home more luxurious';
        $data['meta_keywords'] = '';   
        $data['totalCount'] = $this->Md_featured->getSellersCount();
        $offset = 0;
       /*[start::Bespoke limit in session for back activity]*/
        $session_bespoke_limit = $this->session_management_lib->session_bespoke_limit;
        if($session_bespoke_limit){
            $limit = $session_bespoke_limit;          
        }        
        /*[End::Bespoke limit in session for back activity]*/
        else{
        $limit = 24;
        }
        $data['limit']=$limit; 
        $data['seller_list'] = $this->Md_featured->getSellers($offset,$limit);

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
//       echo "<pre>";
//      print_r($data['seller_list']);die;
        $this->load->view('featured/vw_bespoke', $data);
    } 
    
     public function ajax_bespoke() {
        
        $offset = $_POST['offset'];
        
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $seller_list = $this->Md_featured->getSellers($offset,$limit);
     // print_r($seller_list);die;
       echo $incremented_offset.'|*|*|';  
       
          foreach ($seller_list as $key => $row) {  
               $product_details = $this->Md_featured->getSellertopproduct($row['market_seller_id']); 
           
                ?>             
                    <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand" >
              <div class="brandBox clearfix">
                 <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$product_details[0]['product_id'];?>" class="fa fa-heart <?php if(in_array($product_details[0]['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $product_details[0]['product_id'];?> );"></i></a>    
                  <div class="BrandImg-explore brandBox">
                      <a href="<?php echo base_url(); ?>bespoke-portfolio/<?php echo $row['market_seller_id']; ?>/<?php echo urlencode($row['market_seller_name']); ?>?q=<?php echo $q; ?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['market_seller_name'];?>">
                      </a> 
                  </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>bespoke-portfolio/<?php echo $row['market_seller_id']; ?>/<?php echo urlencode($row['market_seller_name']); ?>"> <?php echo $row['market_seller_name'];?> </a></div>
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
         <?php } 

                    }/*end:foreach;*/
          die;
       
    }
     public function bespoke_portfolio($seller_id,$seller_name) {
       // echo $seller_id; die;
        $data['page_title'] = "Featured";
        $data['leadGenFromSliderPageType'] ='bespoke-portfolio'; 
        $data['leadGenFromSliderPageUniqueId'] = $seller_id;
        $data['page_name'] = 'bespoke_portfolio';   
        $data['page_heading'] = urldecode($seller_name);   
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';   
        $data['seller_id'] = $seller_id;
        $data['totalCount'] = $this->Md_featured->getSellertopproductsCount($seller_id);
        $offset = 0;
        
        /*[start::Set bespoke limit in session for back activity]*/
        if(isset($_GET['bespoke_offset'])){
            $this->session->set_userdata('bespoke_limit',$_GET['bespoke_offset']);
        }
       /*[End::Set bespoke limit in session for back activity]*/
        
        /*[start::Assign limit in session for back activity]*/
        $session_limit = $this->session_management_lib->session_limit;
        if($session_limit){
            $limit = $session_limit;          
        }
        /*[End::Assign limit in session for back activity]*/
        else{
        $limit = 24;
        }
        $data['limit']=$limit;
        $data['seller_details'] = $this->Md_featured->getSellerDetails($seller_id);

        $data['product_list'] = $this->Md_featured->getSellertopproducts($seller_id,$offset,$limit);
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
//      echo "<pre>";
//      print_r($data['seller_details']);die;
        $this->load->view('featured/vw_bespoke_portfolio', $data);
    } 
    
     public function ajax_bespoke_portfolio() {
        
        /*Arrray for the replacement in url*/
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
        
        $offset = $_POST['offset'];
        
        $seller_id = $_POST['seller_id'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $id = $_POST['id'];
        $page = $_POST['page'];
        $product_list = $this->Md_featured->getSellertopproducts($seller_id,$offset,$limit);
     // print_r($seller_list);die;
       echo $incremented_offset.'|*|*|';  
       
          foreach ($product_list as $key => $row) {   ?>
               <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more">
              <div class="brandBox clearfix">
              <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>       
                  <div class="BrandImg-explore brandBox">
                      <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page;?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo$row['product_name']; ?>"> 
                      </a>
                  </div>
                  <div class="BrandName"> <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page;?>"> <?php echo $row['product_name'];?> </a></div>
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
         
       die;
    }

}
