<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_test extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_product');
        $this->load->model('Md_category');
        $this->load->model('Md_database');
        $this->session_management_lib->index();
        
    }
   
    public function test() {

       $table = "ecom_brand"; 
       $brand_details  = $this->Md_database->getData($table,'brand_id,brand_name','', '');
//       echo "<pre>";
//       print_r($brand_details);die;
     foreach($brand_details as $row){
        // print_r($row);
         //echo $row['brand_name']."=>".urlencode($row['brand_name'])."<br>";
          $lower_brand_name = strtolower($row['brand_name']);
          $replace_sp_char = str_replace(array('@','#','$','%','^','&','*','(',')','/',"'"),'',$lower_brand_name);
          $replace_space = str_replace(array('    ','   ','  ',' '),'-',$replace_sp_char);
          //echo $replace_space.'<br>';
          
          $brand_url_name = $replace_space;
          $data = array('brand_url_name'=> $brand_url_name);
          $condition = array('brand_id'=> $row['brand_id']);
          $result  = $this->Md_database->updateData($table, $data, $condition) ;
         
     }
     echo 'brand_url_name changed successfully';die;
    }  
 
    public function section_test() {

       $table = "field_design_section_of_house"; 
       $section_details  = $this->Md_database->getData($table,'id,title','', '');
//       echo "<pre>";
//       print_r($brand_details);die;
     foreach($section_details as $row){
        // print_r($row);
         //echo $row['brand_name']."=>".urlencode($row['brand_name'])."<br>";
          $lower_name = strtolower($row['title']);
          $replace_sp_char = str_replace(array('@','#','$','%','^','&','*','(',')','/',"'"),'',$lower_name);
          $replace_space = str_replace(array('    ','   ','  ',' '),'-',$replace_sp_char);
          echo $replace_space.'<br>';
          
          $url_name = $replace_space;
          $data = array('title_url_name'=> $url_name);
          $condition = array('id'=> $row['id']);
          $result  = $this->Md_database->updateData($table, $data, $condition) ;
         
     }
     echo 'title_url_name changed successfully';die;
    }  
  
   
    
}
