<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_header extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
       // $this->load->model('Md_database');
        $this->session_management_lib->index();

    }
   
    
    public function index() {
        
        $data['page_title'] = "Home";
        $data['page_name'] = 'home';   
        $this->load->view('section/vw_header_2', $data);
    }  
    
       
}
