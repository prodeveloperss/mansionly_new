<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*[
Date:: 07-09-2017
Purpose of this controller ::
- To filter the product listing by brandwise, categorywise or sectionwise.
]*/
class Cn_generic_listing extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
       $this->load->model('Md_generic_listing');
       $this->load->model('Md_database');
       $this->load->model('Md_category');
       $this->session_management_lib->index();

    }
   
    
 
    
    public function generic_listing() {
        
     
        $cat_id = "";
        $cat_name ="";
        $metaTitle       = "";
        $metaKeyword     = "";        
        $metaDescription =  "";  
        /*Initialize*/
        $data['leadGenFromSliderPageType'] = ''; 
        $data['leadGenFromSliderPageUniqueId'] = '';
         /*/Initialize*/
         $data['page_heading'] = "All Products";
        $data['cat_list'] = array();
        $parent_cat_details_by_sub_cat = array();
        $data['parent_cat_details'] = array();
        $data['parent_array'] =array();
        if (!empty($_GET['pageType'])) {
            $pageType = $_GET['pageType'];
        } else {
            $pageType = '';
            redirect(base_url());
            exit();
        }
        
        
        if(isset($_GET['q'])){
            $q = $_GET['q'];
        }
        
        $data['seo_content']='';
        /*[If pagetype is blp and brand id is empty]*/
        if(($pageType=="BLP") && (!(isset($_GET['brandID'])))){
            redirect(base_url());
            exit();
        }
        
        /*[Start:: check url is changed by user forcefully or not]*/
        
        if((isset($_GET['catID']))&& (isset($_GET['brandID']))&&(isset($_GET['sohID']))&&(isset($_GET['origin']))){
            
            $cat_id = $_GET['catID'];
            $brand_id = explode(",",$_GET['brandID']);          
            $soh_id= explode(",",$_GET['sohID']);
            $cor= explode(",",$_GET['origin']);
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(2)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);                   
            $brand_name_array = explode("_",$this->uri->segment(1)); 
            foreach($brand_details as $row){               
            if(!in_array($row['brand_url_name'],$brand_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
            }
            }
                
            $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);                   
            $soh_name_array = explode("_",$this->uri->segment(3)); 
             
            foreach($soh_details as $row){               
            if(!in_array($row['title_url_name'],$soh_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
            $cor_details = $this->Md_generic_listing->get_cor_details($cor);                   
            $cor_name_array = explode("_",$this->uri->segment(4)); 
            foreach($cor_details as $row){               
            if(!in_array(strtolower($row['countryName']),$cor_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
            
        }
                                   
        else if((isset($_GET['catID']))&& (isset($_GET['origin']))&&(isset($_GET['sohID']))){
            
            $cat_id = $_GET['catID'];
            $brand_id = array();          
            $soh_id= explode(",",$_GET['sohID']);
            $cor= explode(",",$_GET['origin']);
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(1)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            
            $cor_details = $this->Md_generic_listing->get_cor_details($cor);                   
            $cor_name_array = explode("_",$this->uri->segment(3)); 
            foreach($cor_details as $row){               
            if(!in_array(strtolower($row['countryName']),$cor_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
                
            $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);                   
            $soh_name_array = explode("_",$this->uri->segment(2)); 
             
            foreach($soh_details as $row){               
            if(!in_array($row['title_url_name'],$soh_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
            
        }
        
        else if((isset($_GET['catID']))&& (isset($_GET['brandID']))&&(isset($_GET['sohID']))){
            
            $cat_id = $_GET['catID'];
            $brand_id = explode(",",$_GET['brandID']);          
            $soh_id= explode(",",$_GET['sohID']);
            $cor=array();
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(2)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);                   
            $brand_name_array = explode("_",$this->uri->segment(1)); 
            foreach($brand_details as $row){               
            if(!in_array($row['brand_url_name'],$brand_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
            }
            }
                
            $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);                   
            $soh_name_array = explode("_",$this->uri->segment(3)); 
             
            foreach($soh_details as $row){               
            if(!in_array($row['title_url_name'],$soh_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
            
        }
        else if((isset($_GET['catID']))&&(isset($_GET['sohID']))){
            
            $cat_id = $_GET['catID'];
            $brand_id = array();          
            $soh_id= explode(",",$_GET['sohID']);
            $cor=array();
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(1)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
           
                
            $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);                   
            $soh_name_array = explode("_",$this->uri->segment(2)); 
             
            foreach($soh_details as $row){               
            if(!in_array($row['title_url_name'],$soh_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
            
        }
       
        else if((isset($_GET['catID']))&& (isset($_GET['brandID']))){
		
            $cat_id = $_GET['catID'];
            $brand_id = explode(",",$_GET['brandID']);          
            $soh_id=array();
            $cor=array();
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(2)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);                   
            $brand_name_array = explode("_",$this->uri->segment(1)); 
            foreach($brand_details as $row){               
            if(!in_array($row['brand_url_name'],$brand_name_array)){
              // echo "test";
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
            }
        }
        else if((isset($_GET['brandID']))){
            $cat_id = '';
            $brand_id = explode(",",$_GET['brandID']);          
            $soh_id=array();
            $cor=array();
           
            $brand_details = $this->Md_generic_listing->get_brand_details($brand_id); 
            
            $brand_name_array = explode("_",$this->uri->segment(1)); 
           // print_r($brand_name_array);die;
            foreach($brand_details as $row){               
            if(!in_array($row['brand_url_name'],$brand_name_array)){
              $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
            }
            }
           // print_r($brand_details);die;
        }

        else if(isset($_GET['catID'])){
            $cat_id = $_GET['catID'];
            $brand_id =array();
            $soh_id=array();
            $cor=array();
            $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
            $cat_name = $cat_details[0]['cat_lname'];   
            if($cat_name != $this->uri->segment(1)){
               
               $this->generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q);
                
            }
        }
        
        /*[End:: check url is changed by user forcefully or not]*/
    
      if(!empty($_GET['catID'])){
            
        $cat_id = $_GET['catID'];
        $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);
        $cat_name    = $cat_details[0]['cat_name'];
        $data['seo_content'] = $cat_details[0]['seo_content'];
        $cat_image    = $cat_details[0]['cat_image'];
        if(($pageType=="PLP") && (!empty($cat_id))){
        $data['page_heading'] = $cat_name;
        }
        $metaTitle       = $cat_details[0]['metaTitle'];
        $metaKeyword     = $cat_details[0]['metaKeyword'];        
        $metaDescription = $cat_details[0]['metaDescription'];    
        
        }

       
        
        if((!empty($metaTitle) || !empty($metaKeyword) || !empty($metaDescription)) & (!empty($cat_id)) ){
            $data['page_title'] = $cat_details[0]['metaTitle'];
            $data['meta_description'] = $cat_details[0]['metaDescription'];
            $data['meta_keywords'] = $cat_details[0]['metaKeyword'];   
        }else{
            //$data['page_title'] = $cat_name." | Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";     
            $data['page_title'] = " Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";     
            $data['meta_description'] = '';
            $data['meta_keywords'] = ''; 
        }
        /*[end::get meta details;]*/       
        
        $data['page_name']  = $pageType;
        $data['cat_name'] = $cat_name;
        $offset = 0;
       
       /*[start::Set all category limit in session for back activity]*/
//        if(isset($_GET['all_cat_offset'])){
//            $this->session->set_userdata('all_cat_limit',$_GET['all_cat_offset']);
//        }
       /*[start::Set all category limit in session for back activity]*/
        
       /*[start::Assign limit in session for back activity]*/
       $session_limit = $this->session_management_lib->session_limit;
       
       if($session_limit){
           $limit = $session_limit;          
       }else{
         $limit = 24;
       }
       /*[End::Assign limit in session for back activity]*/
       
       $data['limit'] = $limit;
       $data['cat_id'] = $cat_id;
      
             
       $array_brand_id = array();
       $array_soh_id = array();
       $array_cor = array();
       $arrSubCatIds = array();
       
       if($pageType=="PLP"){
      
       $data['leadGenFromSliderPageType'] = 'product-listing-page'; 
       $data['leadGenFromSliderPageUniqueId'] = $cat_id;
           
       if(!empty($cat_id)){
       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       $parent_cat_details_by_sub_cat = $this->Md_generic_listing->getParentCatDetailsBySubCat($cat_id);
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($parent_cat_details_by_sub_cat[0]['parent']);
       if(empty($data['parent_cat_details'])){
           $data['parent_cat_details'][0] = array('cat_name'=>$cat_name,'cat_id'=>$cat_id,'cat_image'=>$cat_image);
       }
       if(empty($data['cat_list'])){
        $parent_cat_id = $parent_cat_details_by_sub_cat[0]['parent'];
        $data['cat_list'] = $this->Md_generic_listing->getSiblingCatList($parent_cat_id,$cat_id);
        }
       }
       
      
       if(!empty($_GET['brandID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $sub_cat_array = array(); 
       $brand_id = $_GET['brandID'];
       $array_brand_id = explode(',',$brand_id);
       
       /*If cat id is available then category is priority*/
       if((!empty($cat_id))){ 
//       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
//       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       /*else  brand  is priority*/
       }else{
       
       $cat_list_by_brand = $this->Md_generic_listing->cat_list_by_brand($array_brand_id);
       foreach($cat_list_by_brand as $key => $row){
           $parent_cat =  $this->Md_generic_listing->check_parent_cat_or_not($row['cat_id']);
           if(!empty($parent_cat)){
           $array_parent_cat_id[] = $row['cat_id']; 
           $parent_cat_array[$key]['cat_id']= $row['cat_id'];
           $parent_cat_array[$key]['cat_name']= $row['cat_name'];
           $parent_cat_array[$key]['cat_image']= $row['cat_image'];
           }else{
              $array_cat_id[] = $row['cat_id']; 
           }
       }
       
       $arrSubCatIds = array_merge($array_cat_id,$array_parent_cat_id);
       if(!empty($array_cat_id)){
        $sub_cat_parent = $this->Md_generic_listing->parent_cat_list_1($array_cat_id);
        foreach ($sub_cat_parent as $key => $row) {
            $sub_cat_parent_array[$key]['cat_id']= $row['cat_id'];
            $sub_cat_parent_array[$key]['cat_name']= $row['cat_name'];
            $sub_cat_parent_array[$key]['cat_image']= $row['cat_image'];
        }
       }
       

       $data['cat_list'] =  array_merge($parent_cat_array,$sub_cat_parent_array);
       }
       if(count($data['cat_list'])==1){
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($data['cat_list'][0]['cat_id']);
       }
       
       }

       if(!empty($_GET['sohID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $sub_cat_array = array(); 
       $cat_list_by_soh = array(); 
       $soh_id = $_GET['sohID'];
       $array_soh_id = explode(',',$soh_id);
       if(($pageType=="PLP") && (empty($cat_id))){
           $soh_deatils = $this->Md_generic_listing->getSohDetails($array_soh_id[0]);
           $data['page_heading'] = $soh_deatils[0]['title'];
       }
       
       /*If cat id is available then category is priority*/
       if((!empty($cat_id))){ 
//       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
//       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       /*else  section  is priority*/
       }else{
           
        /*Get cat list by soh*/
       $cat_list_by_soh = $this->Md_generic_listing->cat_list_by_soh($array_soh_id);   
       
       foreach($cat_list_by_soh as $key => $row){
           
           $parent_cat =  $this->Md_generic_listing->check_parent_cat_or_not($row['cat_id']);
           
           if(!empty($parent_cat)){
           $array_parent_cat_id[] = $row['cat_id']; 
           $parent_cat_array[$key]['cat_id']= $row['cat_id'];
           $parent_cat_array[$key]['cat_name']= $row['cat_name'];
           $parent_cat_array[$key]['cat_image']= $row['cat_image'];
           }else{
              $array_cat_id[] = $row['cat_id']; 
           }
       }   
           
      $arrSubCatIds = array_merge($array_cat_id,$array_parent_cat_id);
      if(!empty($array_cat_id)){
      $sub_cat_parent = $this->Md_generic_listing->parent_cat_list_1($array_cat_id);
       foreach ($sub_cat_parent as $key => $row) {
           $sub_cat_parent_array[$key]['cat_id']= $row['cat_id'];
           $sub_cat_parent_array[$key]['cat_name']= $row['cat_name'];
           $sub_cat_parent_array[$key]['cat_image']= $row['cat_image'];
       }
      }

       $data['cat_list'] =  array_merge($parent_cat_array,$sub_cat_parent_array);
       
       }
      
       if(count($data['cat_list'])==1){
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($data['cat_list'][0]['cat_id']);
       }
       }
       
       
       if(!empty($_GET['origin'])){
       $cor = $_GET['origin'];
       $array_cor = explode(',',$cor);
       }
       
       }
       
       
      else if($pageType=="BLP"){
          
          
       $data['leadGenFromSliderPageType'] = 'brand-listing-page';
       $data['leadGenFromSliderPageUniqueId'] = $_GET['brandID'];
      
       if(!empty($_GET['brandID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $sub_cat_parent_id = array(); 
       $sub_cat_array = array(); 
       $brand_id = $_GET['brandID'];
       $array_brand_id = explode(',',$brand_id);
       
       
      if(!empty($cat_id)){
       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
       $data['cat_list'] = $this->Md_generic_listing->getCatListBybrand($arrSubCatIds,$array_brand_id);
       $parent_cat_details_by_sub_cat = $this->Md_generic_listing->getParentCatDetailsBySubCat($cat_id);
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($parent_cat_details_by_sub_cat[0]['parent']);
       if(empty($data['parent_cat_details'])){
           $data['parent_cat_details'][0] = array('cat_name'=>$cat_name,'cat_id'=>$cat_id,'cat_image'=>$cat_image);
       }
       if(empty($data['cat_list'])){
        $parent_cat_id = $parent_cat_details_by_sub_cat[0]['parent'];
        $data['cat_list'] = $this->Md_generic_listing->getSiblingCatListBybrand($parent_cat_id,$array_brand_id);
        }
       }
       
       if(empty($cat_id)){
       
            $cat_list_by_brand = $this->Md_generic_listing->cat_list_by_brand($array_brand_id);
            foreach($cat_list_by_brand as $key => $row){
                $parent_cat =  $this->Md_generic_listing->check_parent_cat_or_not($row['cat_id']);
                if(!empty($parent_cat)){
                $array_parent_cat_id[] = $row['cat_id']; 
                $parent_cat_array[$key]['cat_id']= $row['cat_id'];
                $parent_cat_array[$key]['cat_name']= $row['cat_name'];
                $parent_cat_array[$key]['cat_image']= $row['cat_image'];
                }else{
                   $array_cat_id[] = $row['cat_id']; 
                   $sub_cat_array[$key]['cat_id']= $row['cat_id'];
                   $sub_cat_array[$key]['cat_name']= $row['cat_name'];
                   $sub_cat_array[$key]['cat_image']= $row['cat_image'];
                }
            }
   

            if(!empty($array_cat_id)){
             $sub_cat_parent = $this->Md_generic_listing->parent_cat_list_1($array_cat_id);
             foreach ($sub_cat_parent as $key => $row) {
                 $sub_cat_parent_id[]= $row['cat_id'];
                 $sub_cat_parent_array[$key]['cat_id']= $row['cat_id'];
                 $sub_cat_parent_array[$key]['cat_name']= $row['cat_name'];
                 $sub_cat_parent_array[$key]['cat_image']= $row['cat_image'];
             }
            }
            
         //  $arrSubCatIds = array_merge($array_cat_id,$array_parent_cat_id,$sub_cat_parent_id);
           $arrSubCatIds = array();

           $data['parent_array']= array_merge($parent_cat_array,$sub_cat_parent_array);
          /*[If parent are not more than one]*/
           if(count($data['parent_array'])<='1'){		  
           $data['cat_list'] =  array_merge($parent_cat_array,$sub_cat_parent_array,$sub_cat_array);
            } /*[else]*/
           else {		  
           $data['cat_list'] =   array_merge($parent_cat_array,$sub_cat_parent_array);
           }
           if(count($data['cat_list'])==1){
            $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($data['cat_list'][0]['cat_id']);
            }
       }/*enf if(empty($cat_id))*/
      
       }

       if(!empty($_GET['sohID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $sub_cat_array = array(); 
       $cat_list_by_soh = array(); 
       $soh_id = $_GET['sohID'];
       $array_soh_id = explode(',',$soh_id);
      

       }
       
       
       if(!empty($_GET['origin'])){
       $cor = $_GET['origin'];
       $array_cor = explode(',',$cor);
       }
       
       }
       
        $data['brand_list'] = array();
        $data['section_list'] = array();
        $data['country_list'] = array();
       
       if($pageType=="BLP"){
       $data['brand_list'] = array();
       $data['section_list'] = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $data['country_list'] = array();
       } else {
       $data['brand_list'] = $this->Md_generic_listing->get_brand_list($arrSubCatIds,$array_soh_id);
       $data['section_list'] = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $data['country_list'] = $this->Md_generic_listing->get_country_list($arrSubCatIds,$array_brand_id,$array_soh_id);
       }
      // print_r($data['country_list']);die;
      
       /*get::Product list by $subCatIdList */
       $data['product_list'] = $this->Md_generic_listing->productList($arrSubCatIds,$offset,$limit,$array_brand_id,$array_soh_id,$array_cor);
       $arr_num_of_product_list   = $this->Md_generic_listing->productTotalCount($arrSubCatIds,$array_brand_id,$array_soh_id,$array_cor);       
	   $data['totalCount'][0]['totalCount'] = count($arr_num_of_product_list);        
 	   
       $data['brand_details'] = array();
       if($pageType =="BLP"){ 
        $table = "ecom_brand"; 
        $condition=array('brand_id'=>$brand_id,'status'=>'1');
        $data['brand_details']  = $this->Md_database->getData($table,'*',$condition, ''); 
        $data['page_heading'] = $data['brand_details'][0]['brand_name'];
       }
     // print_r($data['brand_details']);die;
       $data['selected_brand'] = $array_brand_id;
       $data['selected_soh'] = $array_soh_id;
       $data['selected_cor'] = $array_cor;
       $data['selected_brand_details'] = array();
       $data['arrSubCatIds'] = $arrSubCatIds;
       if(!empty($array_brand_id)){
       $data['selected_brand_details'] = $this->Md_generic_listing->get_brand_details($array_brand_id);
       }
       
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
      
       if(($pageType =='PLP')&&(!empty($cat_details))){
           
          $data['page_title']= $cat_details[0]['cat_name'].' Online - Shop for Exclusive '.$cat_details[0]['cat_name'].' Online!'; 
          $data['meta_description']= 'Exclusive '.$cat_details[0]['cat_name'].' online. We bring to you the best of '.$cat_details[0]['cat_name'].' from exclusive brands across the world. #Book today!'; 
       }  else if($pageType =='BLP'){
           
          $data['page_title']= $brand_details[0]['brand_name'].' Products Online, Buy '.$brand_details[0]['brand_name'].' Products'; 
          $data['meta_description']= 'Exclusive '.$brand_details[0]['brand_name'].' products online. Decorate your home or office with graceful and elegant products available at Mansionly.com.'; 
       }
  //echo "<pre>";  print_r($data);die;
       $this->load->view('generic_listing/vw_generic_listing', $data);
    }  
    
    public function generate_url_for_generic_listing($brand_id,$cat_id,$soh_id,$cor,$pageType,$q="") {
        
       $redirect_url= array();
       $redirect_url1 = base_url();

       $brand_url="";
       if(!empty($brand_id)){
      
         $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);
         
         foreach($brand_details as $key => $row){
            if($key== 0){
          //  $brand_url .= str_replace(' ', '-', strtolower($row['brand_name']));
            $brand_url .= $row['brand_url_name'];
            }else{
          //  $brand_url .= "_".str_replace(' ', '-', strtolower($row['brand_name']));
            $brand_url .= "_".$row['brand_url_name'];
            }

         }
         $redirect_url[] = urlencode($brand_url);
           
       }
      
     if(!empty($cat_id)){
       $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);                   
       $redirect_url[] = $cat_details[0]['cat_lname'];
       
     }
     
      $soh_url="";
       if(!empty($soh_id)){
      
         $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);
         
         foreach($soh_details as $key => $row){
            if($key== 0){
            $soh_url .= $row['title_url_name'];
           // $soh_url .= str_replace(' ', '-', strtolower($row['title']));
            }else{
           // $soh_url .= "_".str_replace(' ', '-', strtolower($row['title']));
            $soh_url .= "_".$row['title_url_name'];
            }
         }
        $redirect_url[] = urlencode($soh_url);
       }       
     
         $cor_url="";
         if(!empty($cor)){
         $cor_details = $this->Md_generic_listing->get_cor_details($cor);
       
         foreach($cor_details as $key => $row){
            if($key== 0){
            $cor_url .= str_replace(' ', '-', strtolower($row['countryName']));
            }else{
            $cor_url .= "_".str_replace(' ', '-', strtolower($row['countryName']));
            }
         }
        
         $redirect_url[] = urlencode($cor_url);
       }
        
       $redirect_url = $redirect_url1.implode('/', $redirect_url);
       
       
       
       
       $redirect_url2 = '?';
       if(!empty($brand_id)){
       sort($brand_id);
       $arrlength = count($brand_id);
        for($x = 0; $x < $arrlength; $x++) {
           $brand_id[$x];           
       }
       $brand_id_string = implode(',',$brand_id);
       $redirect_url3[]= 'brandID='.$brand_id_string;
       }
      
       if(!empty($cat_id)){
       $redirect_url3[]= 'catID='.$cat_id;
       }
       
       if(!empty($soh_id)){
       sort($soh_id);
       $arrlength = count($soh_id);
        for($x = 0; $x < $arrlength; $x++) {
           $soh_id[$x];           
        }
       $soh_id_string = implode(',',$soh_id);
       $redirect_url3[]= 'sohID='.$soh_id_string;
       }
       if(!empty($cor)){
       sort($cor);
       $arrlength = count($cor);
        for($x = 0; $x < $arrlength; $x++) {
           $cor[$x];           
        }
       $cor_string = implode(',',$cor);
       $redirect_url3[]= 'origin='.$cor_string;
       }
     
       $redirect_url .= $redirect_url2.implode('&', $redirect_url3);
       $redirect_url .= "&pageType=".$pageType."&q=".$q;
//echo $redirect_url;die;
     redirect($redirect_url);
     
    }
    public function generic_listing_action() {
       
       $brand_id =array();
       $soh_id =array();
       $cor =array();
  
       $cat_id = $_POST['cat_id'];
       $cat_name = $_POST['cat_name'];
       $brand_id = $_POST['brand_id'];
       $soh_id = $_POST['soh_id'];
       $cor = $_POST['cor'];
       $q= $_POST['q'];

       
       
       $pageType = $_POST['pageType'];
       if(($pageType == 'PLP') && ((empty($brand_id) || (empty($cat_id))) || (empty($soh_id)))){
           
           redirect(base_url().'allproducts');
       }
       $redirect_url= array();
       $redirect_url1 = base_url();

       $brand_url="";
       if(!empty($brand_id)){
      
         $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);
         
         foreach($brand_details as $key => $row){
            if($key== 0){
          //  $brand_url .= str_replace(' ', '-', strtolower($row['brand_name']));
            $brand_url .= $row['brand_url_name'];
            }else{
           // $brand_url .= "_".str_replace(' ', '-', strtolower($row['brand_name']));
            $brand_url .= "_".$row['brand_url_name'];
            }

         }
         $redirect_url[] = urlencode($brand_url);
           
       }
      
     if(!empty($cat_id)){

       $redirect_url[] = strtolower($cat_name);
       
     }
     
      $soh_url="";
       if(!empty($soh_id)){
      
         $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);
         
         foreach($soh_details as $key => $row){
            if($key== 0){
            $soh_url .= $row['title_url_name'];
           // $soh_url .= str_replace(' ', '-', strtolower($row['title']));
            }else{
          //  $soh_url .= "_".str_replace(' ', '-', strtolower($row['title']));
            $soh_url .= "_".$row['title_url_name'];
            }
         }
        $redirect_url[] = urlencode($soh_url);
       }       
     
         $cor_url="";
         if(!empty($cor)){
         $cor_details = $this->Md_generic_listing->get_cor_details($cor);
       
         foreach($cor_details as $key => $row){
            if($key== 0){
            $cor_url .= str_replace(' ', '-', strtolower($row['countryName']));
            }else{
            $cor_url .= "_".str_replace(' ', '-', strtolower($row['countryName']));
            }
         }
        
         $redirect_url[] = urlencode($cor_url);
       }
        
       $redirect_url = $redirect_url1.implode('/', $redirect_url);
       
       
       
       
       $redirect_url2 = '?';
       if(!empty($brand_id)){
       sort($brand_id);
       $arrlength = count($brand_id);
        for($x = 0; $x < $arrlength; $x++) {
           $brand_id[$x];           
       }
       $brand_id_string = implode(',',$brand_id);
       $redirect_url3[]= 'brandID='.$brand_id_string;
       }
      
       if(!empty($cat_id)){
       $redirect_url3[]= 'catID='.$cat_id;
       }
       
       if(!empty($soh_id)){
       sort($soh_id);
       $arrlength = count($soh_id);
        for($x = 0; $x < $arrlength; $x++) {
           $soh_id[$x];           
        }
       $soh_id_string = implode(',',$soh_id);
       $redirect_url3[]= 'sohID='.$soh_id_string;
       }
       if(!empty($cor)){
       sort($cor);
       $arrlength = count($cor);
        for($x = 0; $x < $arrlength; $x++) {
           $cor[$x];           
        }
       $cor_string = implode(',',$cor);
       $redirect_url3[]= 'origin='.$cor_string;
       }
     
       $redirect_url .= $redirect_url2.implode('&', $redirect_url3);
       $redirect_url .= "&pageType=".$pageType."&q=".$q;

     redirect($redirect_url);
    
    }  
 
    public function getSubCatgList($cat_id)
	{
		

		
		if($cat_id != null && $cat_id != "") {
			$ProductCatg='';
			$result = $this->getCatgchildRecordForProduct($cat_id,$ProductCatg);

			$jsonData = array();
			$jsonData = explode(",",$result);
			foreach($jsonData as $link)
			{
			    if($link == ' ')
			    {
			        unset($link);
			    }
			}
			$jsonData = array_filter( $jsonData );
			$jsonData = array_slice( $jsonData, 0 ) ;
                        $jsonFinalData = implode(',', $jsonData );
           
			return $jsonFinalData;
		} 
	}
        
    public function getCatgchildRecordForProduct($parentcatg_id,$ProductCatg)
	{
		$requestData = array();
		$result = $this->Md_generic_listing->getProductCatgListParentwise($parentcatg_id);
		if (count($result)>0)
		{
			$jsonData = array();
			foreach ($result as $ProductCatgList)
			{
				$ProductCatg = $ProductCatg.",". $ProductCatgList->cat_id;
				$childData = array();
				$childData = $this->getCatgchildRecordForProduct($ProductCatgList->cat_id,$ProductCatg);
				if(!empty($childData))
				{
					$ProductCatg = $ProductCatg.",". $childData;
				}
			}
			$childcatids = array();
			$childcatids = array_unique(explode(",",$ProductCatg));
			$ProductCatg = implode(",",$childcatids);
			return $ProductCatg;
		}
	}
        
       
    public function ajaxGetProductByGenericListing() {
       
      /*Arrray for the replacement in url*/
       $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
     
        $arrSubCatIds = array();
        $cat_id = $_POST['cat_id']; 
        
        $brand_id= array();
        if(!empty($_POST['brand_id'])){
        $brand_id = explode(',',$_POST['brand_id']);
        
        $cat_list_by_brand = $this->Md_generic_listing->cat_list_by_brand($brand_id);
       
        $array_cat_id = array();
//        foreach($cat_list_by_brand as $row){
//            $array_cat_id[] = $row['cat_id'];
//        }
        $arrSubCatIds = $array_cat_id;
        }
        
    
        
        $soh_id= array();
        if(!empty($_POST['soh_id'])){
        $soh_id = explode(',',$_POST['soh_id']);
        $cat_list_by_soh = $this->Md_generic_listing->cat_list_by_soh($soh_id);
        $array_cat_id = array();
        foreach($cat_list_by_soh as $row){
           $array_cat_id[] = $row['cat_id'];
        }
       
        $arrSubCatIds = $array_cat_id;
        
        }
        
        $cor= array();
        if(!empty($_POST['cor'])){
        $cor = explode(',',$_POST['cor']);
        }
        $offset = $_POST['offset'];        
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $id = $_POST['id'];
        $page_name = $_POST['page'];
        
        if(!empty($cat_id)){
            
             /*get::subcat id list*/
       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);
        }

       
       /*get::Product list by $subCatIdList */
        $product_list = $this->Md_generic_listing->productList($arrSubCatIds,$offset,$limit,$brand_id,$soh_id,$cor);
     
        echo $incremented_offset.'|*|*|';  
     
      foreach ($product_list as $key => $row) { ?>  

            <li>
                <div class="plp-listimg">
                 <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                    <a class="add_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>"> 
                        <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>">
                    </a>    
                </div>
                <div class="plp-list-name">
                <?php echo $row['product_name'];?>
                </div>
                 
             </li>
            
           <?php     }/*end:foreach;*/
         die;
    }
    
    
public function allProductsGenericListing() {
                                    
   
      //Segment details
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);
        $cat_id = "";
        $cat_name ="";
        $metaTitle       = "";
        $metaKeyword     = "";        
        $metaDescription =  "";  
        $data['leadGenFromSliderPageType'] = 'all-products'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_heading'] = "All Products";
        $data['cat_list'] = array();
        $parent_cat_details_by_sub_cat = array();
        $data['parent_cat_details'] = array();
        
        if (!empty($_GET['pageType'])) {
            $pageType = $_GET['pageType'];
        } else {
            $pageType = 'PLP';
        }
        
        
        if(!empty($_GET['catID'])){
            
        $cat_id = $_GET['catID'];
        $cat_details = $this->Md_generic_listing->getCatDetails($cat_id);
        $cat_name    = $cat_details[0]['cat_name'];
        $cat_image    = $cat_details[0]['cat_image'];
        if(($pageType=="PLP") && (!empty($cat_id))){
        $data['page_heading'] = $cat_name;
        }
        $metaTitle       = $cat_details[0]['metaTitle'];
        $metaKeyword     = $cat_details[0]['metaKeyword'];        
        $metaDescription = $cat_details[0]['metaDescription'];    
        
        }

       
        
        if((!empty($metaTitle) || !empty($metaKeyword) || !empty($metaDescription)) & (!empty($cat_id)) ){
            $data['page_title'] = $cat_details[0]['metaTitle'];
            $data['meta_description'] = $cat_details[0]['metaDescription'];
            $data['meta_keywords'] = $cat_details[0]['metaKeyword'];   
        }else{
            $data['page_title'] = " Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";     
            $data['meta_description'] = '';
            $data['meta_keywords'] = ''; 
        }
        /*[end::get meta details;]*/       
        
        $data['page_name']  = $pageType;
        $data['cat_name'] = $cat_name;
        $offset = 0;
       
       /*[start::Set all category limit in session for back activity]*/
//        if(isset($_GET['all_cat_offset'])){
//            $this->session->set_userdata('all_cat_limit',$_GET['all_cat_offset']);
//        }
       /*[start::Set all category limit in session for back activity]*/
        
       /*[start::Assign limit in session for back activity]*/
       $session_limit = $this->session_management_lib->session_limit;
       
       if($session_limit){
           $limit = $session_limit;          
       }else{
         $limit = 24;
       }
       /*[End::Assign limit in session for back activity]*/
       
       $data['limit'] = $limit;
       $data['cat_id'] = $cat_id;
      
             
       $array_brand_id = array();
       $array_soh_id = array();
       $array_cor = array();
       $arrSubCatIds = array();

       
       if(!empty($cat_id)){
       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       $parent_cat_details_by_sub_cat = $this->Md_generic_listing->getParentCatDetailsBySubCat($cat_id);
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($parent_cat_details_by_sub_cat[0]['parent']);
       if(empty($data['parent_cat_details'])){
           $data['parent_cat_details'][0] = array('cat_name'=>$cat_name,'cat_id'=>$cat_id,'cat_image'=>$cat_image);
       }
       if(empty($data['cat_list'])){
        $parent_cat_id = $parent_cat_details_by_sub_cat[0]['parent'];
        $data['cat_list'] = $this->Md_generic_listing->getSiblingCatList($parent_cat_id,$cat_id);
        }
       }else if($segment1=='allproducts')
            {
                $data['page_name']  = 'All Products';
                $data['cat_name']         = 'All Products';
                $data['page_heading'] = 'All Products';
                /*get active level one category list.*/
                $data['cat_list'] = $this->Md_generic_listing->getLevelOneCategoriesName();
                // get all active category id string. getAllActiveCategoriesId();
                $arrAllCategoryActiveID = $this->Md_generic_listing->getAllActiveCategoriesId();
                $tempArrAllCategoryActiveID=array();
                foreach ($arrAllCategoryActiveID as $item){
                    $tempArrAllCategoryActiveID[]= $item['cat_id'];
                }
                $arrAllCategoryActiveID = $tempArrAllCategoryActiveID;
                $arrSubCatIds = $arrAllCategoryActiveID;
            }
       
      
       if(!empty($_GET['brandID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $brand_id = $_GET['brandID'];
       $array_brand_id = explode(',',$brand_id);
       
       /*If cat id is available then category is priority*/
       if(($pageType=="PLP") && (!empty($cat_id))){ 
//       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
//       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       /*else  brand  is priority*/
       }else{
       
       $cat_list_by_brand = $this->Md_generic_listing->cat_list_by_brand($array_brand_id);
       foreach($cat_list_by_brand as $key => $row){
           $parent_cat =  $this->Md_generic_listing->check_parent_cat_or_not($row['cat_id']);
           if(!empty($parent_cat)){
           $array_parent_cat_id[] = $row['cat_id']; 
           $parent_cat_array[$key]['cat_id']= $row['cat_id'];
           $parent_cat_array[$key]['cat_name']= $row['cat_name'];
           $parent_cat_array[$key]['cat_image']= $row['cat_image'];
           }else{
              $array_cat_id[] = $row['cat_id']; 
           }
       }
       
       $arrSubCatIds = array_merge($array_cat_id,$array_parent_cat_id);
       if(!empty($array_cat_id)){
        $sub_cat_parent = $this->Md_generic_listing->parent_cat_list_1($array_cat_id);
        foreach ($sub_cat_parent as $key => $row) {
            $sub_cat_parent_array[$key]['cat_id']= $row['cat_id'];
            $sub_cat_parent_array[$key]['cat_name']= $row['cat_name'];
            $sub_cat_parent_array[$key]['cat_image']= $row['cat_image'];
        }
       }
       $data['cat_list'] =  array_merge($parent_cat_array,$sub_cat_parent_array);
       }
       if(count($data['cat_list'])==1){
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($data['cat_list'][0]['cat_id']);
       }
       
       }

       if(!empty($_GET['sohID'])){
       $parent_cat_array = array();
       $sub_cat_parent_array = array();
       $array_parent_cat_id =array();
       $array_cat_id = array(); 
       $soh_id = $_GET['sohID'];
       $array_soh_id = explode(',',$soh_id);
       if(($pageType=="PLP") && (empty($cat_id))){
           $soh_deatils = $this->Md_generic_listing->getSohDetails($array_soh_id[0]);
           $data['page_heading'] = $soh_deatils[0]['title'];
       }
       
       /*If cat id is available then category is priority*/
       if(($pageType=="PLP") && (!empty($cat_id))){ 
//       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);       
//       $data['cat_list'] = $this->Md_generic_listing->getCatList($cat_id);
       /*else  section  is priority*/
       }else{
           
        /*Get cat list by soh*/
       $cat_list_by_soh = $this->Md_generic_listing->cat_list_by_soh($array_soh_id);      
       foreach($cat_list_by_soh as $key => $row){
           
           $parent_cat =  $this->Md_generic_listing->check_parent_cat_or_not($row['cat_id']);
           
           if(!empty($parent_cat)){
           $array_parent_cat_id[] = $row['cat_id']; 
           $parent_cat_array[$key]['cat_id']= $row['cat_id'];
           $parent_cat_array[$key]['cat_name']= $row['cat_name'];
           $parent_cat_array[$key]['cat_image']= $row['cat_image'];
           }else{
              $array_cat_id[] = $row['cat_id']; 
           }
       }   
           
      $arrSubCatIds = array_merge($array_cat_id,$array_parent_cat_id);
      if(!empty($array_cat_id)){
      $sub_cat_parent = $this->Md_generic_listing->parent_cat_list_1($array_cat_id);
       foreach ($sub_cat_parent as $key => $row) {
           $sub_cat_parent_array[$key]['cat_id']= $row['cat_id'];
           $sub_cat_parent_array[$key]['cat_name']= $row['cat_name'];
           $sub_cat_parent_array[$key]['cat_image']= $row['cat_image'];
       }
      }
       $data['cat_list'] =  array_merge($parent_cat_array,$sub_cat_parent_array);
       
       }
      
       if(count($data['cat_list'])==1){
       $data['parent_cat_details'] = $this->Md_generic_listing->getParentCatDetails($data['cat_list'][0]['cat_id']);
       }
       }
       
       
       if(!empty($_GET['origin'])){
       $cor = $_GET['origin'];
       $array_cor = explode(',',$cor);
       }
       
        $data['brand_list'] = array();
        $data['section_list'] = array();
        $data['country_list'] = array();
       
       if($pageType=="BLP"){
       $data['brand_list'] = array();
       $data['section_list'] = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $data['country_list'] = array();
       } else {
       $data['brand_list'] = $this->Md_generic_listing->get_brand_list($arrSubCatIds,$array_soh_id);
       $data['section_list'] = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $data['country_list'] = $this->Md_generic_listing->get_country_list($arrSubCatIds,$array_brand_id,$array_soh_id);
       }
      
       /*get::Product list by $subCatIdList */
       $data['product_list'] = $this->Md_generic_listing->productList($arrSubCatIds,$offset,$limit,$array_brand_id,$array_soh_id,$array_cor);
       $data['totalCount']   = $this->Md_generic_listing->productTotalCount($arrSubCatIds,$array_brand_id,$array_soh_id,$array_cor);       
     
       $data['brand_details'] = array();
       if($pageType =="BLP"){ 
        $table = "ecom_brand"; 
        $condition=array('brand_id'=>$brand_id,'status'=>'1');
        $data['brand_details']  = $this->Md_database->getData($table,'*',$condition, ''); 
        $data['page_heading'] = $data['brand_details'][0]['brand_name'];
       }
       
       $data['selected_brand'] = $array_brand_id;
       $data['selected_soh'] = $array_soh_id;
       $data['selected_cor'] = $array_cor;
       $data['selected_brand_details'] = array();
       $data['arrSubCatIds'] = $arrSubCatIds;
       if(!empty($array_brand_id)){
       $data['selected_brand_details'] = $this->Md_generic_listing->get_brand_details($array_brand_id);
       }
       
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
       
       $this->load->view('generic_listing/vw_all_product_generic_listing', $data);
    }
    
    
public function allProductGenericListingAction() {
    
    // echo "<pre>"; print_r($_POST);die;
       $brand_id =array();
       $soh_id =array();
       $cor =array();
       
       $cat_id = $_POST['cat_id']?$_POST['cat_id']:'';
       
       $cat_name = $_POST['cat_name']?$_POST['cat_name']:'';
       
       if(!empty($_POST['brand_id'])){
        $brand_id = $_POST['brand_id'];
       }
       if(!empty($_POST['soh_id'])){
         $soh_id = $_POST['soh_id'];
       }
       if(!empty($_POST['cor'])){
         $cor = $_POST['cor'];
       }
       if(!empty($_POST['pageType'])){
         $pageType = $_POST['pageType'];
       }else{
           $pageType='PLP';
       }
       
      
      
       
     $redirect_url1 = base_url();
     $redirect_url[]= 'allproducts';
     $cat_url='';
     if(!empty($cat_id)){

       $redirect_url[] = strtolower(strtolower($cat_name));
       
     }
         $brand_url="";
       if(!empty($brand_id)){
      
         $brand_details = $this->Md_generic_listing->get_brand_details($brand_id);
         
         foreach($brand_details as $key => $row){
            if($key== 0){
            $brand_url .= $row['brand_url_name'];
            }else{
            $brand_url .= "_".$row['brand_url_name'];
            }

         }
         $redirect_url[] = urlencode($brand_url);
           
       }
        
         $soh_url="";
       if(!empty($soh_id)){
      
         $soh_details = $this->Md_generic_listing->get_soh_details($soh_id);
         
         foreach($soh_details as $key => $row){
            if($key== 0){
           // $soh_url .= str_replace(' ', '-', $row['title']);
            $soh_url .= $row['title_url_name'];
            }else{
          //  $soh_url .= "_".str_replace(' ', '-', $row['title']);
            $soh_url .= "_".$row['title_url_name'];
            }
         }
        $redirect_url[] = urlencode($soh_url);
       }       
     
         $cor_url="";
         if(!empty($cor)){
         $cor_details = $this->Md_generic_listing->get_cor_details($cor);
       
         foreach($cor_details as $key => $row){
            if($key== 0){
            $cor_url .= str_replace(' ', '-', $row['countryName']);
            }else{
            $cor_url .= "_".str_replace(' ', '-', $row['countryName']);
            }
         }
        
         $redirect_url[] = urlencode($cor_url);
       }
        
       $redirect_url = $redirect_url1.implode('/', $redirect_url);
       
       
       
       
       $redirect_url2 = '?';
       if(!empty($cat_id)){
       $redirect_url3[]= 'catID='.$cat_id;
       }
       if(!empty($brand_id)){
       sort($brand_id);
       $arrlength = count($brand_id);
        for($x = 0; $x < $arrlength; $x++) {
           $brand_id[$x];           
       }
       $brand_id_string = implode(',',$brand_id);
       $redirect_url3[]= 'brandID='.$brand_id_string;
       }
       if(!empty($soh_id)){
       sort($soh_id);
       $arrlength = count($soh_id);
        for($x = 0; $x < $arrlength; $x++) {
           $soh_id[$x];           
        }
       $soh_id_string = implode(',',$soh_id);
       $redirect_url3[]= 'sohID='.$soh_id_string;
       }
       if(!empty($cor)){
       sort($cor);
       $arrlength = count($cor);
        for($x = 0; $x < $arrlength; $x++) {
           $cor[$x];           
        }
       $cor_string = implode(',',$cor);
       $redirect_url3[]= 'origin='.$cor_string;
       }
       $redirect_url3[]= 'pageType='.$pageType;
     
       if(!empty($redirect_url3)){
       $redirect_url .= $redirect_url2.implode('&', $redirect_url3);
       }
       
     redirect($redirect_url);
    
    }
    
    public function ajaxGetAllProductByGenericListing() {
        
         /*Arrray for the replacement in url*/
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        
        $cat_id = $_POST['cat_id']; 
        
        $brand_id= array();
        if(!empty($_POST['brand_id'])){
        $brand_id = explode(',',$_POST['brand_id']);
        }
        $soh_id= array();
        if(!empty($_POST['soh_id'])){
        $soh_id = explode(',',$_POST['soh_id']);
        }
        $cor= array();
        if(!empty($_POST['cor'])){
        $cor = explode(',',$_POST['cor']);
        }
        $offset = $_POST['offset'];        
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $id = $_POST['id'];
        $page_name = $_POST['page'];
        
        if(!empty($cat_id)){
            
             /*get::subcat id list*/
       $arrSubCatIds = explode(',',$this->getSubCatgList($cat_id).','.$cat_id);
       
        }else{
            $cat_id='';
              /*get active level one category list.*/
                $data['cat_list'] = $this->Md_generic_listing->getLevelOneCategoriesName();
                // get all active category id string. getAllActiveCategoriesId();
                $arrAllCategoryActiveID = $this->Md_generic_listing->getAllActiveCategoriesId();
                $tempArrAllCategoryActiveID=array();
                foreach ($arrAllCategoryActiveID as $item){
                    $tempArrAllCategoryActiveID[]= $item['cat_id'];
                }
                $arrAllCategoryActiveID = $tempArrAllCategoryActiveID;
                $arrSubCatIds = $arrAllCategoryActiveID;
        }
       
       /*get::Product list by $subCatIdList */
        $product_list = $this->Md_generic_listing->productList($arrSubCatIds,$offset,$limit,$brand_id,$soh_id,$cor);
     
        echo $incremented_offset.'|*|*|';  
     
      foreach ($product_list as $key => $row) { ?>  

            <li>
                <div class="plp-listimg">
                 <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>
                    <!--<a class="add_url" href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']) ;?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>">--> 
                    <a class="add_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', $row['product_name']))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $cat_id; ?>&page=<?php echo $page_name; ?>"> 
                        <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>">
                    </a>    
                </div>
                <div class="plp-list-name">
                <?php echo $row['product_name'];?>
                </div>
                 
             </li>
            
           <?php     }/*end:foreach;*/
         die;
    }
    
       /* Code by someshwar ji*/
    public  function ajaxGetSOHFilter(){
        $arrSubCatIds =array();
        if(!empty($_POST['brand_id'])){
          $arrBrand = $_POST['brand_id']; 
          
          /* GET coma seprated product ids by brand id */
          
          $productList = $this->Md_generic_listing->getProductsByBrandid($arrBrand);
          
        }else{
           $productList = $this->Md_generic_listing->getAllProducts(); 
        }
        
        $str_productListarr='';
          foreach ($productList as $row){
              $str_productListarr[] = $row['product_id'];
          }
          $str_productList = implode(',', $str_productListarr);
          /*Get section of house details from productId string*/
          $sohDetailList = $this->Md_generic_listing->getSOHdetailsByProductIDstr($str_productListarr);
         $sohIDArr = array();
          foreach ($sohDetailList as $row){
              $sohIDArr[]= $row['soh_id'];
          }
           $sohIDArr = array();
          foreach ($sohDetailList as $row){
              $sohIDArr[]= $row['soh_id'];
          }
          
          
          
          
          /*Get the final SOH id*/
          $arrFinalSohFilterList = array();
         $section_list =$this->Md_generic_listing->get_section_list();
         foreach ($section_list as $row){
             $data = '';
             $data['soh_id']=$row['id'];
             $data['soh_title']=$row['title'];
             if(in_array($row['id'], $sohIDArr)){
                
                 /* Get product count from section of house id*/
                  $rs_soh_id_product_count =$this->Md_generic_listing->getProductCountFromSOHId($row['id']);
                 
                  $data['soh_product_cnt']=$rs_soh_id_product_count[0]['soh_product_cnt'];
                  
             }else{
                  $data['soh_product_cnt']=0;
             }
             
             $arrFinalSohFilterList[] = $data;
         }
        
        
        
        
        ?>
        <div class="brand-chebox">
                        <ul>

                            <?php foreach ($arrFinalSohFilterList as $key => $row) { ?>
                               
                                <li class="<?php if ($row['soh_product_cnt']==0) { ?> BrandSectChek-Disable <?php }?>">
                                    <div class="checkstyle">
                                        <input <?php if ($row['soh_product_cnt']==0) { ?> disabled="" <?php } ?> class="SOH" onclick="show_soh_filter_list(<?php echo $row['soh_id']; ?>);" name="soh_id[]" type="checkbox" id="chek1_<?php echo $row['soh_id']; ?>" value="<?php echo $row['soh_id']; ?>">
                                        <label  id="label_soh_id_<?php echo $row['soh_id']; ?>" for="chek1_<?php echo $row['soh_id']; ?>"><?php echo $row['soh_title']; ?></label>
                                        <?php echo ' ('.$row['soh_product_cnt'].')'; ?>

                                    </div>
                                </li> 
                            <?php } ?>

                        </ul>   
                    </div> 
                        <div class="threeBtns">
                        <button type="submit" class="apply_button">APPLY</button>
                        <!--<a href="javascript:void(0);" onclick="hide_SOH_tab();">CANCEL</a>-->
                        <a href="javascript:void(0);" onclick="uncheckSOH();">CLEAR FILTERS</a>
                    </div>
                        <?php
                    die;
    }
    
public function ajaxGetFilterDetails(){
       $pageType = $_POST['pageType'];
       $brand_string = $_POST['brand_string'];
       $soh_string = $_POST['soh_string'];
       $cor_string = $_POST['cor_string'];
       $subCatIds_string = $_POST['subCatIds_string'];
       
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
        
        if($pageType=="BLP"){
       $brand_list = array();
       $section_list = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $country_list = array();
       } else {
       $brand_list = $this->Md_generic_listing->get_brand_list($arrSubCatIds,$array_soh_id,$array_cor);
       $section_list = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id,$array_cor);
       $country_list = $this->Md_generic_listing->get_country_list($arrSubCatIds,$array_brand_id,$array_soh_id);
       }
       
       ?>
       ||*||
               
    <div class="brandTopSearchRow">
        <div class="alphabets">
            <a class="all active" data-index="All" href="javascript:void(0);">All</a>
            <a class="hash " data-index="hash" href="javascript:void(0);">#</a>
            <a class="a " data-index="a" href="javascript:void(0);">A</a>
            <!--<a class="a activeSelect" data-index="a" href="javascript:void(0);">A</a>-->
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
            <!--<button class="cleaBtns" type="button"> <i class="fa fa-search"></i> </button>-->
            <span style="position: absolute;right:10px;top:3px;cursor: pointer;" class="cleaBtns" > <i class="fa fa-search"></i> </span>
            <input class="search serchbrnd" placeholder="Search" />
        </div>
    </div>

    <div class="clearfix"></div>



    <div <?php if($pageType == "BLP"){ ?>  style="display:none;"  <?php } ?> class="Brand_select-right-filter">
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
                                <input <?php if (($row['ProductCount']==0)|| ($pageType == "BLP")) { ?> disabled="" <?php } ?> class="brand" onclick="show_brand_filter_list(<?php echo $row['brand_id']; ?>);" <?php if (in_array($row['brand_id'], $selected_brand)) { ?> checked="" <?php } ?> name="brand_id[]" type="checkbox" id="chek_<?php echo $row['brand_id']; ?>" value="<?php echo $row['brand_id']; ?>"> 
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
        <!--<a href="javascript:void(0);" onclick="hide_brand_tab();">CANCEL</a>-->
        <!--<a href="javascript:void(0);" <?php if(!empty($selected_brand)){ ?> onclick="uncheckBarnds();" <?php } ?>>CLEAR FILTERS</a>-->
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

            <?php foreach ($section_list as $key => $row) { ?>
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
            <?php foreach ($country_list as $key => $row) { ?>
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
    
  
 public function ajaxGetFilterDetailsMobile(){
       $pageType = $_POST['pageType'];
       $brand_string = $_POST['brand_string'];
       $soh_string = $_POST['soh_string'];
       $cor_string = $_POST['cor_string'];
       $subCatIds_string = $_POST['subCatIds_string'];
       
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
        
        if($pageType=="BLP"){
       $brand_list = array();
       $section_list = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id);
       $country_list = array();
       } else {
       $brand_list = $this->Md_generic_listing->get_brand_list($arrSubCatIds,$array_soh_id,$array_cor);
       $section_list = $this->Md_generic_listing->get_section_list($arrSubCatIds,$array_brand_id,$array_cor);
       $country_list = $this->Md_generic_listing->get_country_list($arrSubCatIds,$array_brand_id,$array_soh_id);
       }
       
       ?>||*||
        <div class="brandtab-Filter">
                <div class="Mbrand-verticle-alphabet">
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
                <div class="Mbrand_search">
                  
                    <input class="mobile_search form-control" type="text" placeholder="Search">
                    <span class="cleaBtns" style="position: absolute;right:20px;top:10px;cursor: pointer;font-size: 16px;padding: 5px;"> <i class="fa fa-search"></i> </span>
                  
                </div>
                <div class="Mbrand-chebox">
                    <ul id="demoTwo" style="height: 642px;overflow-y: auto;position: relative;">
                        <?php                                   
                        $hash_flag = 0;
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
                                // $product_count_by_brand = $this->Md_generic_listing->productCountByBrand($row['brand_id'],$arrSubCatIds);       
                                 if ($row['ProductCount']!=0) {
                                 ?>
                                
                            <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['brand_id'], $selected_brand)) { ?> Mbrand-chebox-Selected <?php } ?>">

                                <div class="checkstyle"> 
                                    <input <?php if (($row['ProductCount']==0) || ($pageType == "BLP")) { ?> disabled="" <?php } ?>  onclick="show_mobile_brand_filter_list(<?php echo $row['brand_id']; ?>);" <?php if (in_array($row['brand_id'], $selected_brand)) { ?> checked="" <?php } ?> name="brand_id[]" type="checkbox" id="chek_mobile_<?php echo $row['brand_id']; ?>" value="<?php echo $row['brand_id']; ?>"> 
                                    <label for="chek_mobile_<?php echo $row['brand_id']; ?>" ></label> 
                                </div> 
                                <a href="javascript:void(0);"  onclick="$(<?php echo '\'#chek_mobile_'.$row['brand_id'].'\''; ?>).click();" id="label_mobile_brand_id_<?php echo $row['brand_id']; ?>" class="name"><?php echo $row['brand_name'].' ('.$row['ProductCount'].')'; ?></a>

                            </li>
                        <?php } } ?>                
                     </ul>
                </div>
              </div>
       <script type="text/javascript">
$(document).ready(function(){
    jQuery(function(){
	$('#demoTwo').listnav({
		includeAll: true,
		includeNums: false,
                noMatchText:''
		});
   });
$('.ln-letters').hide();
        /*Start:: script for prevent form submition on press enter*/
      $('input.mobile_search.form-control').keydown(
              function(event){if(event.keyCode == 13) {event.preventDefault();return false;}}
              );
 /*End:: script for prevent form submition on press enter*/
      
       $('#demoTwo li div').parent('li').click(function(){
          var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
           var alphabet = String(selectedClass).split("-");
          if($('#demoTwo .'+selectedClass+'.Mbrand-chebox-Selected').length>0){
              $('#demoTwo .'+selectedClass+'.Brand_tile').addClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).addClass('BrnadMainSelct');
          }else{
              $('#demoTwo .'+selectedClass+'.Brand_tile').removeClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).removeClass('BrnadMainSelct');
          }
      });
      
      /*Start:: mobile*/
       $(document).on('click','#mBrandFilter02 .Mbrand_search  span i.fa-close',function(){
           $('.mobile_search').val('');
            $('.mobile_search').keyup();
        });
        
        $('.mobile_search').keyup(function(){
        var keyword = $(this).val();
         if(keyword!=''){
            
            $('#mBrandFilter02 .Mbrand_search span i').removeClass('fa-search');
            $('#mBrandFilter02 .Mbrand_search span i').addClass('fa-close');
        }else{
            $('#mBrandFilter02 .Mbrand_search span i').addClass('fa-search');
            $('#mBrandFilter02 .Mbrand_search span i').removeClass('fa-close');  
        }
       var list = ['hash','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $("#demoTwo a.name").parent('li').css('display','block');
        $("#demoTwo a.name:not(:contains('"+keyword+"'))").parent('li').css('display','none');
       for(var i=0;i<list.length;i++){
         if($('#demoTwo li.ln-'+list[i]+' a:visible').length<1){
             $('#demoTwo li.ln-'+list[i]).css('display','none');
             $('.Mbrand-verticle-alphabet a.'+list[i]).addClass('disabled');
         }else{
             $('#demoTwo li.ln-'+list[i]).css('display','block');
            $('.Mbrand-verticle-alphabet a.'+list[i]).removeClass('disabled');
         }
        
       }
        mbl_getPositions();
    });
    
    $(".Mbrand-verticle-alphabet a").click(function(){
        
        var position = $(this).attr('data-position');
        var classTag = $(this).attr('data-index');
      // console.log(position);
       
       if(!$(this).hasClass('disabled')){
       $('.Mbrand-verticle-alphabet a').removeClass('active');
        $(this).addClass('active');
       if($('#demoTwo li.ln-'+classTag+':visible').length>=1){
//        $('#demoOne').scrollLeft(position);
        $('#demoTwo').animate({ scrollTop: position }, 500);
        
       }
   }
       
       if(classTag==='All'){
           
           $('.Mbrand-verticle-alphabet a').removeClass('active');
           $(this).addClass('active');
           
           $('.mobile_search').val('');
           $('#demoTwo').scrollTop('0');
         $('.mobile_search').keyup();
          
       }
        
    });
     $('#mobile_brand_tab').one('click',function(){
  
   setTimeout(function() {
        
        $('#demoTwo').scrollTop('0'); 
        $('.mobile_search').keyup();
            $('#demoTwo li.Mbrand-chebox-Selected').each(function(){
          var selectedClass = $(this).attr("class").match(/ln-[\w-]*\b/);
          var alphabet = String(selectedClass).split("-");
           if($('#demoTwo .'+selectedClass+'.Mbrand-chebox-Selected').length>0){
              $('#demoTwo .'+selectedClass+'.Brand_tile').addClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).addClass('BrnadMainSelct');
              
          }else{
              $('#demoTwo .'+selectedClass+'.Brand_tile').removeClass('BrnadMainSelct');
              $('.Mbrand-verticle-alphabet a.'+alphabet[1]).removeClass('BrnadMainSelct');
          }
      });
    }, 300);
  
 });
    
    /*End :: mobile*/ 
   
   });
   function mbl_getPositions(){
    $(".Mbrand-verticle-alphabet a").each(function(){
        var position=0;
        var classTag = $(this).attr('data-index');
        
        if(classTag!='All' && $('#demoTwo li.ln-'+classTag).length>0){
            
        position = $('#demoTwo li.ln-'+classTag).first().position();
        $(this).attr('data-position',position.top);
        
        }else{
          $(this).attr('data-position','0');  
        }
        console.log(classTag+"=>"+position.top);
        
    });
}
  </script>
       ||*||
       <div class="Mbrand-chebox">
                <ul class="">
                 <?php
                    foreach ($section_list as $row) {                  
                 ?> 
                 <?php 
                   if ($row['ProductCount']!=0) {
                    ?>
                  <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['id'], $selected_soh)) { ?> Mbrand-chebox-Selected <?php } ?>">
                    <div class="checkstyle">
                      <input <?php if ($row['ProductCount']==0) { ?> disabled="" <?php } ?> class="SOH" onclick="show_mobile_soh_filter_list(<?php echo $row['id']; ?>);" id="chek_soh_mobile_<?php echo $row['id']; ?>" <?php if (in_array($row['id'], $selected_soh)) { ?> checked="" <?php } ?> type="checkbox" value="<?php echo $row['id']; ?>" name="soh_id[]">
                      <label for="chek_soh_mobile_<?php echo $row['id']; ?>"><?php echo $row['title'].' ('.$row['ProductCount'].')'; ?></label>
                    </div>
                  </li>
                   <?php  } } ?> 
                </ul>
              </div>
       ||*||
       <div class="Mbrand-chebox">
                    <ul class="">
                     <?php foreach ($country_list as $key => $row) { ?> 
                     <?php 
                        if ($row['ProductCount']!=0) {
                        ?>
                      <li class="<?php if ($row['ProductCount']==0) { ?> BrandSectChek-Disable <?php } if (in_array($row['countryName'], $selected_cor)) { ?> Mbrand-chebox-Selected <?php } ?>">
                        <div class="checkstyle">
                          <input <?php if ($row['ProductCount']==0) { ?> disabled="" <?php } ?> class="COR" onclick="show_mobile_cor_filter_list('<?php echo $row['countryName']; ?>');" id="chek_cor_mobile_<?php echo $row['countryName']; ?>" <?php if (in_array($row['countryName'], $selected_cor)) { ?> checked="" <?php } ?> name="cor[]" type="checkbox" value="<?php echo $row['countryName']; ?>">
                          <label for="chek_cor_mobile_<?php echo $row['countryName']; ?>"><?php echo $row['countryName'].' ('.$row['ProductCount'].')'; ?></label>
                        </div>
                      </li>
                     <?php } }?>
                    </ul>
                  </div>
       <?php
    }


   
    
}
