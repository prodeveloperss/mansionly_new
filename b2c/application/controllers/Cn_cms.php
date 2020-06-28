<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_cms extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
       // $this->load->model('Md_database');
       $this->session_management_lib->index();

    }
   
    
    public function about_us() {
        
        $data['page_title'] = "We are a platform for Global Home Interiors and Lifestyle Solutions";
        $data['page_name'] = 'about_us'; 
        $data['leadGenFromSliderPageType'] ='about-us'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        //$data['meta_description'] = "";
        $data['meta_description'] = "We are a platform that connects the best global designers and the most exquisite global furniture and decor on one hand and handpicked local execution partners on the other - to discerning home-owners like you";
        $data['meta_keywords'] =  "";      
        $this->load->view('cms/vw_about_us', $data);
    } 
    
    public function how_it_works() {
        
        $data['page_title'] = "From Beginning To End See How We Work | Mansionly";
        $data['page_name'] = 'how_it_works'; 
        $data['leadGenFromSliderPageType'] ='how-it-works'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        //$data['meta_description'] = "";
        $data['meta_description'] = "From Find you dream to welcome fine living in just 8 steps get your dream home, open it and watch the video";
        $data['meta_keywords'] = '';         
        $this->load->view('cms/vw_how_it_works', $data);
    } 
    
    public function contact_us() {
        
        $data['page_title'] = "Contact Us for Interior Designing Services in Bangalore and Delhi";
        $data['page_name'] = 'contact'; 
        $data['leadGenFromSliderPageType'] ='contact'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        //$data['meta_description'] = "";
        $data['meta_description'] = "Get in touch with us via phone or email.You can also drop in your contact information and our executive will get in touch with you as soon as possible.";
        $data['meta_keywords'] =  "";      
        $this->load->view('cms/vw_contact_us', $data);
    } 
    public function privacy() {
        
        $data['page_title'] = "Interior Design Products and Services in Bangalore  | Privacy policy";
        $data['page_name'] = 'privacy';
        $data['leadGenFromSliderPageType'] ='privacy'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        //$data['meta_description'] = "";
        $data['meta_description'] = "This website (“Mansionly”) is owned and operated by ENLIVE GLOBAL SOLUTIONS PTE. LTD. (“We” or “we” or “Mansionly”). We, takes privacy protection very seriously. We value the trust you place in us. Please read this document carefully regarding our privacy policy.";
        $data['meta_keywords'] =  "";      
        $this->load->view('cms/vw_privacy', $data);
    } 
    
    public function terms() {
        
        $data['page_title'] = "Our Terms and Condition | Mansionly";
        $data['page_name'] = 'terms';  
        $data['leadGenFromSliderPageType'] ='terms'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        //$data['meta_description'] = "";
        $data['meta_description'] = "Use of the Website is available only to persons who can form legally binding contracts under Indian Contract Act, 1872. Persons who are “incompetent to contract” within the meaning of the Indian Contract Act, 1872 including minors, un-discharged insolvents etc. are not eligible to use the Website.";
        $data['meta_keywords'] =  "";      
        $this->load->view('cms/vw_terms', $data);
    } 
   
    
}
