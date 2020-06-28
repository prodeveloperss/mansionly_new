<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_execution extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_execution');
        $this->session_management_lib->index();

    }
   

     
    public function execution_gallery($execution_flag)
	{
           // $data['page_title'] = "Project | Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";
            $data['page_title'] = "Best Interior Design, Bedroom Designs, Home Designs, and Home Decor ";
            $data['leadGenFromSliderPageType'] = 'execution-gallery'; 
            $data['leadGenFromSliderPageUniqueId'] = '';
            $data['page_name'] = 'section';   
            $data['page_heading'] = 'Section';   
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';  
            $data['execution_all_list']= array();
            $data['execution_PR_list'] = array();
            $data['execution_GI_list'] = array();
            $data['execution_LH_list'] = array();
            $data['execution_CD_list'] = array();
            $data['execution_office_space_list'] = array();
            $data['execution_restaurant_list'] = array();
            $data['execution_spas_list'] = array();
            $data['execution_retail_list'] = array();
            $data['offset_all']=0;
            $data['offset_pr']=0;
            $data['offset_gi']=0; 
            $data['offset_lh']=0;
            $data['offset_cd']=0;
            $data['offset_office_space']=0;
            $data['offset_restaurant']=0;
            $data['offset_spas']=0;
            $data['offset_retail']=0;
            
            //for seo content change old url "_" with "-" so replace here "-" with "_" for no need to change futher code
            $execution_flag = str_replace('-', '_', $execution_flag);
             /*[start::Assign execution flag in session for back activity]*/
          
            $session_execution_flag = $this->session_management_lib->session_execution_flag;
            if($session_execution_flag){
                $execution_flag = $session_execution_flag;          
            }
             /*[End::Assign execution flag in session for back activity]*/
            $offset = 0;
           /*[start::Assign limit in session for back activity]*/
           $session_execution_gallery_limit = $this->session_management_lib->session_execution_gallery_limit;
           if($session_execution_gallery_limit){
               $limit = $session_execution_gallery_limit;          
           }
            /*[End::Assign limit in session for back activity]*/
           else{
            $limit = 12;
           }
            /* All */ 
            if($execution_flag=='all'){
            $data['meta_description'] = 'Some of the sample of Industry Sectors where we operate that include, premium residence, global inspirations, luxury hotels, retails, etc.';
            $data['offset_all']= $limit;    
            $data['execution_all_list'] = $this->Md_execution->getAllExecutionPortfolio($offset,$limit);
            }
            
            $data['execution_all_count'] = $this->Md_execution->getAllExecutionPortfolioCount();
            
            /* Residential Interiors*/
           if($execution_flag=='residential_interiors'){
//               $data['page_title'] ="Premium Residences | The Best Residential Interior Designer In Bangalore";
               $data['page_title'] ="Premium Residences | Best Residential Interior Designer In Delhi and Bangalore";
               $data['meta_description'] = 'See some of our sample of Premium Residence work, and try to stop yourself from loving it.';
            $data['offset_pr']=$limit;
            $data['execution_PR_list'] = $this->Md_execution->getExecutionSamplePortfolio('residential_interiors',$offset,$limit);
           }
           
            $data['execution_PR_count'] = $this->Md_execution->getExecutionPortfolioCount('residential_interiors');
           
            /* Global_Inspiration*/
            if($execution_flag=='global_inspiration'){
                $data['page_title'] ="Global Inspirations | Mansionly Best Interior Designer In Bangalore";
                $data['meta_description'] = 'Mansionly global inspirations, sample of Edgefield Plains Apartment | Simei Apartment | Penthouse | Private Residences | Luxury Bedroom';
                $data['offset_gi']=$limit;
                $data['execution_GI_list'] = $this->Md_execution->getExecutionSamplePortfolio('global_inspiration',$offset,$limit);
            }
            
            $data['execution_GI_count'] = $this->Md_execution->getExecutionPortfolioCount('global_inspiration');

            /* Luxury Hotels */
            if($execution_flag=='luxury_hotels'){
//                $data['page_title'] ="Luxury Hotel Interior Designs by Mansionly | Concepts, Plans, Interior Etc.";
                $data['page_title'] ="Luxury Hotel Interior Designs by Mansionly | Concepts, Plans, Design";
                $data['meta_description'] = 'The Best Interior designer for Hotels, See some of the sample how wo did it';
                $data['offset_lh']=$limit;
                $data['execution_LH_list'] = $this->Md_execution->getExecutionSamplePortfolio('luxury_hotels',$offset,$limit);
            }
            
            $data['execution_LH_count'] = $this->Md_execution->getExecutionPortfolioCount('luxury_hotels');
            
            /* Commercial Designs */
             if($execution_flag=='commercial_designs'){
                 $data['meta_description'] = '';
                 $data['offset_cd']=$limit;
                $data['execution_CD_list'] = $this->Md_execution->getExecutionSamplePortfolio('commercial_designs',$offset,$limit);
            }
            
            $data['execution_CD_count'] = $this->Md_execution->getExecutionPortfolioCount('commercial_designs');
            
            /* Office Space */
            if($execution_flag=='office_space'){
                $data['page_title'] ="Office Interior Design Ideas | Office Decorating | Mansionly";
                $data['meta_description'] = 'Let our designs make your brand look international while broadening your business avenues. Give your office a global outlook in a cost efficient manner.';
                $data['offset_office_space']=$limit;
                $data['execution_office_space_list'] = $this->Md_execution->getExecutionSamplePortfolio('office_space',$offset,$limit);
            }
            
            $data['execution_office_space_count'] = $this->Md_execution->getExecutionPortfolioCount('office_space');
            
            /* Restaurant */
            if($execution_flag=='restaurant'){
                $data['page_title'] ="Restaurant Interiors | Architecture, Design And Sample | Mansionly ";
                $data['meta_description'] = "Restaurant interior design isn't just about a gorgeous space. It needs to clearly convey the restaurant's narrative and ensure operations are smooth.";
                $data['offset_restaurant']=$limit;
            $data['execution_restaurant_list'] = $this->Md_execution->getExecutionSamplePortfolio('restaurant',$offset,$limit);
            }
            
            $data['execution_restaurant_count'] = $this->Md_execution->getExecutionPortfolioCount('restaurant');
            
            /* Spas */
            if($execution_flag=='spas'){
                $data['page_title'] ="Beauty Salon, Spa And Club Interior Design Concept In Bangalore";
                $data['meta_description'] = 'We offer superior quality spa interior designs to our customers. Our innovative design aesthetics is what makes us different.';
                $data['offset_spas']=$limit;
            $data['execution_spas_list'] = $this->Md_execution->getExecutionSamplePortfolio('spas',$offset,$limit);
            }
            
            $data['execution_spas_count'] = $this->Md_execution->getExecutionPortfolioCount('spas');
            
            
            /* Retail */
            if($execution_flag=='retail'){
                $data['page_title'] ="Commercial & Retail Interior Design | Mansionly";
                $data['meta_description'] = 'retail interiors surveys a host of branding and product display projects from around the globe completed with wide array of materials and finishes.';
              $data['offset_retail']=$limit;
              $data['execution_retail_list'] = $this->Md_execution->getExecutionSamplePortfolio('retail',$offset,$limit);
            }
            
            $data['execution_retail_count'] = $this->Md_execution->getExecutionPortfolioCount('retail');
            
            $data['execution_flag'] = $execution_flag;
             /*Start:: get favorite list of customer*/
                $data['customerFavoriteExecutions']=array();
                 if(!empty($_SESSION['customer_id'])){
                     $table = 'customer_favorites_list';
                     $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'executionportfolio');
                     $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
                     foreach ($result as $row){
                         $data['customerFavoriteExecutions'][]=$row['favorites_record_id'];
                     }
                } 
            /*End:: get favorite list of customer*/
//                echo "<pre>";
//      print_r($data['execution_all_list']);die;
        $data['execution_flag']= $execution_flag;
        $this->load->view('execution/vw_execution', $data);
	}
   
        
//            public function portfolio($portfolio_id,$portfolio_name)
//	{
//            $data['page_title'] = "Portfolio";
//            $data['page_name'] = 'portfolio';   
//            $data['page_heading'] = '';   
//            $data['meta_description'] = '';
//            $data['meta_keywords'] = '';   
//
//            $data['portfolio_details'] = $this->Md_execution->getdesignerPortfolio($portfolio_id);
//            $data['portfolio_list'] = $this->Md_execution->getOtherPortfolio($portfolio_id);
//         
////      echo "<pre>";
////      print_r($data['execution_all_list']);die;
//        $this->load->view('execution/vw_portfolio_details', $data);
//	}
        public function getAjaxExecutionPortfolio()
	{
          /*Arrray for the replacement in url*/
          $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
           // PRINT_R($_GET);
           $offset = $_POST['offset'];
           if(!empty($_POST['limit'])){
             $limit = $_POST['limit']; 
           }else{
           $limit = 12;
           }  
           $get_flag   = $_POST['flag'] ;  
           if($get_flag == "pr"){
               $flag = "residential_interiors";
           }
            else if($get_flag == "gi"){
               $flag = "global_inspiration";
           }
            else if($get_flag == "lh"){
               $flag = "luxury_hotels";
           }
            else if($get_flag == "cd"){
               $flag = "commercial_designs";
           }
            else if($get_flag == "retail"){
               $flag = "retail";
           }
           else if($get_flag == "office_space"){
               $flag = "office_space";
           }
            else if($get_flag == "restaurant"){
               $flag = "restaurant";
           }
            else if($get_flag == "spas"){
               $flag = "spas";
           }
           $incremented_offset = $offset + 12;
           $Favoritestring = $_POST['customerFavoriteExecutions'];
           $customerFavoriteExecutions = explode(',',$Favoritestring);
           $q = $_POST['q'];
           $image_size = $_POST['image_size'];
           echo $incremented_offset.'|*|*|';  
            $execution_list = $this->Md_execution->getExecutionSamplePortfolio($flag,$offset,$limit);
            
             foreach ($execution_list as $row)    {    ?> 
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                  <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a> 
                  <?php  if(!empty($row['secondary_images'])){ ?>                    
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item"> 
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){ 
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" > 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                           <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>"> 
                           </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designer</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php } 
        die;
	}
        public function getAjaxAllExecutionPortfolio()
	{
           /*Arrray for the replacement in url*/
           $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
		   $q  = '';
		   $q = $_POST['q']; 		   
		   $image_size = $_POST['image_size']; 		   
           $offset   = $_POST['offset'] ;  
           $Favoritestring = $_POST['customerFavoriteExecutions'];
           $customerFavoriteExecutions = explode(',',$Favoritestring);
           $incremented_offset = $offset + 12;
           $limit =12;
           echo $incremented_offset.'|*|*|';  
            $execution_all_list = $this->Md_execution->getAllExecutionPortfolio($offset,$limit);
             foreach ($execution_all_list as $row)    {    ?> 
                <div class="col-sm-6 col-md-4 col-xs-12  extraPd " >
                <div class="design-profile-box">
                  <a class="likeico" href="javascript:void(0);"><i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i></a> 
                  <?php  if(!empty($row['secondary_images'])){ ?>                    
                  <div class="owl-carousel owl-demo">
                   <?php }  ?>
                        <div class="item"> 
                             <?php
                             $counter = 1;
                             if(!empty($row['secondary_images'])){ 
                             $array = explode(',', $row['secondary_images']);
                             $counter= (1 + count($array));
                             }
                            ?>
                            <div class="counter">1/<?php echo $counter; ?></div>
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                            <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>"> 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                            <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                             <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name'].'-'.$row['designer_name']; ?>" > 
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                   <div class="Dzr-profiletxt">
                     <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                      <?php echo $row['portfolio_name']; ?>
                     </a>
                  </div>
                  <?php if(!empty($row['designer_name'])){ ?>
                  <div class="exe-title"><strong>Designer</strong> - <?php echo $row['designer_name']; ?></div>
                  <?php } ?>
                </div>
              </div>
             <?php } 
        
	}

}
