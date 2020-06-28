<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_favorites extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_favorites');
        $this->session_management_lib->index();

    }
   
    

 
   
     public function favorites_list() {
        
        $data['page_title'] = "Favorites  Listing";
        $data['page_name'] = 'favorites_listing';   
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';   
        
        $offset ='0';
        $limit = '24';
        $data['designer_list'] = $this->Md_favorites->getFavoritesDesignerList(); 
        $data['execution_portfolio_list'] = $this->Md_favorites->getFavoritesExecutionPortfolio($offset,$limit); 
        $data['design_list'] = $this->Md_favorites->getFavoritesDesignList($offset,$limit); 
        $data['product_list'] = $this->Md_favorites->getFavoritesProductList($offset,$limit); 
        /*Start:: get favorite designer list of customer*/
       $data['customerFavorites']=array();
       if(!empty($_SESSION['customer_id'])){
            $table = 'customer_favorites_list';
            $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'designer');
            $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
            foreach ($result as $row){
            $data['customerFavorites'][]=$row['favorites_record_id'];
            }
       } 
      //print_r($data);die;
       /*End:: get favorite designer list of customer*/
       
       /*Start:: get favorite designer list of customer*/
       
       $data['customerFavoriteExecutions']=array();
       $data['customerFavoriteThemes']=array();
        if(!empty($_SESSION['customer_id'])){
            $table = 'customer_favorites_list';
            $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'executionportfolio');
            $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
            foreach ($result as $row){
                
            $data['customerFavoriteExecutions'][]=$row['favorites_record_id'];
              
           
                
            }
            
            $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'designtheme');
            $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
            foreach ($result as $row){
            $data['customerFavoriteThemes'][]=$row['favorites_record_id'];
                
            }
       } 
       /*End:: get favorite designer list of customer*/
       
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
                
        $this->load->view('dashboard/vw_favorites_list',$data);
    }  
    
    
      
    
}
