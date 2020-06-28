<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_section extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_section'); 
        $this->session_management_lib->index();

        
    }
   
    

     
    public function all_sections()
	{
            $data['page_title'] = "Home Decor Online - Buy Home Decoration Products  at Mansionly";
            $data['leadGenFromSliderPageType'] = 'all-sections-page'; 
            $data['leadGenFromSliderPageUniqueId'] = '';
            $data['page_name'] = 'section';   
            $data['page_heading'] = 'Section';   
            //$data['meta_description'] = '';
            $data['meta_description'] = 'Life Style product with section wise, now customize you kitchen, Living Room, Bed room, Bar, Garden and outdoor, Dining and Bath';
            $data['meta_keywords'] = '';   
            $data['totalCount'] = $this->Md_section->all_sections_count();
            $offset = 0;
            /*[start::Assign limit in session for back activity]*/
            $session_all_section_limit = $this->session_management_lib->session_all_section_limit;
            if($session_all_section_limit){
                $limit = $session_all_section_limit;          
            }
            /*[End::Assign limit in session for back activity]*/
            else{
            $limit = 24;
            }
            
            $data['limit']=$limit;
            $data['section_list'] = $this->Md_section->all_sections($offset,$limit);
            $this->load->view('layout_section/vw_all_section', $data);
	}
        
      public function ajax_all_sections() {
        
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $section_list = $this->Md_section->all_sections($offset,$limit);
        $q = $_POST['q'];

       echo $incremented_offset.'|*|*|';  
       
     foreach ($section_list as $key => $row) {  
               $product_details = $this->Md_section->getSectiontopproduct($row['id']); 
                ?>             
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand load_more">
              <div class="brandBox clearfix">
              <!--<a class="likeico" href="<?php echo base_url(); ?>product-details/<?php echo $row['id']; ?>"><i class="fa fa-heart" aria-hidden="true"></i></a>-->
                <div class="brand-wrap">
                  <div class="BrandImg-explore"> <a href="<?php echo base_url(); ?>section/<?php echo $row['id']; ?>/<?php echo urlencode($row['title']); ?>?q=<?php echo $q; ?>"> <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $product_details[0]['product_image'];?>" alt="<?php echo $row['title'];?>"> </a> </div>
                  <div class="BrandName"> <a href="<?php echo base_url(); ?>section/<?php echo $row['id']; ?>/<?php echo urlencode($row['title']); ?>?q=<?php echo $q; ?>"> <?php echo $row['title'];?> </a></div>
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
   

}
