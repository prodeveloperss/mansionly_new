<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_signin extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
       // $this->load->model('Md_database');
        $this->session_management_lib->index();

    }
   
    
    public function index() {
        
        $data['page_title'] = "Consult Top Interior Designer | Home Interiors by Mansionly";
        $data['leadGenFromSliderPageType'] ='signin'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'signin';   
        //$data['meta_description'] = "";
        $data['meta_description'] = "Sign in to Mansionly and explore the new interior designer world | Create a account in just a few clicks";
        $data['meta_keywords'] =  "";    
        $favorite_data = array();
        if(isset($_GET['favorite_id'])){
            $favorite_id = $_GET['favorite_id'];           
            $favorite_type = $_GET['favorite_type'];
            $favorite_data = array('favorite_id' => $favorite_id,'favorite_type' => $favorite_type);
            $this->session->set_userdata('favorite_data',$favorite_data);
        }
        if(isset($_GET['offset'])){
            $offset= $_GET['offset'];           
            $this->session->set_userdata('limit',$offset);
        }
        if(isset($_GET['scroll_pos'])){
            $scroll_pos= $_GET['scroll_pos'];           
            $this->session->set_userdata('scroll_pos',$scroll_pos);
        }
        $data['email'] = "";
        if(!empty($_GET['email'])){
            $data['email'] = $_GET['email'];
        } 
        $this->load->view('signin/vw_signin', $data);
    } 
    
    public function signout() {
        unset($_SESSION['customer_id']);
        unset($_SESSION["customerId"]);  
       $this->session->unset_userdata('customer_info');
       $this->session->unset_userdata('session_enquiry_flag');
        redirect(base_url().'signin');
        exit();
    } 
    
}
