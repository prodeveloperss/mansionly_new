<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Session_management_lib {
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();       
    }
   

      /*[start::Assign limit in session for back activity]*/
       public function index(){
            /*[start::Assign limit for product back activity]*/
            $this->session_limit = $this->CI->session->userdata('limit');
            $this->CI->session->unset_userdata('limit');
            
            /*[start::Assign limit for Category back activity]*/
            $this->session_all_cat_limit = $this->CI->session->userdata('all_cat_limit');
            $this->CI->session->unset_userdata('all_cat_limit');
            
            /*[start::Assign limit for Section back activity]*/
            $this->session_all_section_limit = $this->CI->session->userdata('all_section_limit');
            $this->CI->session->unset_userdata('all_section_limit');
            
             /*[start::Assign limit for bespoke  back activity]*/
            $this->session_bespoke_limit = $this->CI->session->userdata('bespoke_limit');
            $this->CI->session->unset_userdata('bespoke_limit');
            
            /*[start::Assign limit for Brand  back activity]*/
            $this->session_all_brand_limit = $this->CI->session->userdata('all_brand_limit');
            $this->CI->session->unset_userdata('all_brand_limit');
            
            /*[start::Assign limit for Execution Portfolio back activity]*/
            $this->session_exe_limit = $this->CI->session->userdata('exe_limit');
            $this->CI->session->unset_userdata('exe_limit');
            
            /*[start::Assign limit for Design concept back activity]*/
            $this->session_design_limit = $this->CI->session->userdata('design_limit');
            $this->CI->session->unset_userdata('design_limit');
            
            /*[start::Assign limit for Execution gallery portfolio back activity]*/
            $this->session_execution_gallery_limit = $this->CI->session->userdata('execution_gallery_limit');
            $this->CI->session->unset_userdata('execution_gallery_limit');
            
            /*[start::Assign Execution flag back activity]*/
            $this->session_execution_flag = $this->CI->session->userdata('execution_flag');
            $this->CI->session->unset_userdata('execution_flag');
       }
     /*[End::Assign limit in session for back activity]*/
}