<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_designer extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_designer');
        $this->session_management_lib->index();

    }
   
    public function designer_profile_old_to_new_url($designer_id,$designer_name) {
        $url_replace_char_array = array('!', '@','#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($designer_name)))).'/designer/'.$designer_id.'?q=d','location',301);
        exit();
    }
    public function designer_profile($designer_name,$designer_id) {
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        $data['designer_details'] = $this->Md_designer->getDesignerDetail($designer_id);
       // $data['page_title'] = "Designer Profile";
        $data['page_title'] = 'Designer ' .$data['designer_details'][0]['designer_name']. ' - Book Interior & Design Consultation';
        $data['leadGenFromSliderPageType'] = 'designer-profile'; 
        $data['leadGenFromSliderPageUniqueId'] = $designer_id; 
        $data['page_name'] = 'designer_profile';   
        $data['meta_description'] = 'Explore the profile of our expert designer ' .$data['designer_details'][0]['designer_name']. '. Check portfolio and book design consultation for your home or office.';
        $data['meta_keywords'] = '';
       // $data['meta_title'] = 'Designer ' .$data['designer_details'][0]['designer_name']. ' - Book Interior & Design Consultation';   
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($designer_name)))).'/designer/'.$designer_id.'" />';
        //print_r($data['canonicalLink']);die;
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
        
        $offset = 0;
        $flag = "";
       /*[start::Assign limit in session for back activity]*/
       $session_exe_limit = $this->session_management_lib->session_exe_limit;
       if($session_exe_limit){
           $flag = "executionportfolio";
           $exe_limit = $session_exe_limit;          
       }
       /*[End::Assign limit in session for back activity]*/
       else{
       $exe_limit = 6;
       }
       
       $data['execution_portfolio'] = $this->Md_designer->getdesignerPortfolio_profile($designer_id,$offset,$exe_limit);

        /*[start::Assign limit in session for back activity]*/
       $session_design_limit = $this->session_management_lib->session_design_limit;
       if($session_design_limit){
           $flag = "designconcept";
           $design_limit = $session_design_limit;          
       }
       /*[End::Assign limit in session for back activity]*/
       else{
        if(empty($data['execution_portfolio'])){
             $design_limit = 6;
             }else{
               $design_limit = 0;
             }
       }
       
      //echo $design_limit; die;
        $data['flag'] = $flag;
        $data['exe_limit'] = $exe_limit;
        $data['design_limit'] = $design_limit;
//        $data['execution_portfolio'] = $this->Md_designer->getdesignerPortfolio_profile($designer_id,$offset,$exe_limit);
        $data['totalCountExc'] = $this->Md_designer->getTotalDesignerExecutionCount($designer_id);
        $data['design_concept'] = $this->Md_designer->getThemeWiseDesignList_profile($designer_id,$offset,$design_limit);
        $data['totalCountDesignConcept'] = $this->Md_designer->getTotalDesignConceptCount($portfolio_id='',$designer_id);
        
//        $designerName = '';
//        $designerNameURL='';
//        if(!empty($data['designer_details'])){
//            $designerName = $data['designer_details'][0]['designer_name'];
//            $designerNameURL = str_replace('+', '_', urlencode($designerName));
//        }
//        $data['meta_description'] = "Explore the profile of our expert designer $designerName. Check portfolio and book design consultation for your home or office.";
//           
//        $data['meta_title'] = "Designer $designerName - Book Interior & Design Consultation"; 
//        $data['canonicalLink'] = '<link rel="canonical" href="https://www.mansionly.com/designer/'.$designerNameURL.'/'.$designer_id.'" />';
        
            //echo "<pre>"; print_r($data['design_concept']);die;
        $this->load->view('designer/vw_designer_profile', $data);
    } 
    
 
    public function designer_portfolio_old_to_new_url($portfolio_id,$portfolio_name,$flag) {
      
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
      $q="";
       if(isset($_GET['q'])){
         $q = $_GET['q'];
       }
      if($flag == 'executionportfolio'){
      $portfolio_details = $this->Md_designer->getdesignerPortfolio($portfolio_id);
      redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['portfolio_name'])))).'/ep/'.$portfolio_id.'?q='.$q,'location',301);
      }
      else if($flag == 'designconcept'){
      $portfolio_details = $this->Md_designer->getdesignerDesignConcept($portfolio_id);
      redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['design_name'])))).'/dc/'.$portfolio_id.'?q='.$q,'location',301);
      }
      exit();
    }
    public function designer_portfolio($portfolio_name,$flag,$portfolio_id) {
        
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
        $data['portfolio_details'] = $this->Md_designer->getdesignerPortfolio($portfolio_id);
//        $data['page_title'] = "Designer Portfolio";
        $data['page_title'] = $data['portfolio_details'][0]['portfolio_name'].' by Designer '.$data['portfolio_details'][0]['designer_name'].' @Mansionly.com';
        $data['leadGenFromSliderPageType'] = 'execution-project'; 
        $data['leadGenFromSliderPageUniqueId'] = $portfolio_id;   
        $data['page_name'] = 'designer_portfolio';   
        $data['meta_description'] = $data['portfolio_details'][0]['portfolio_name'].' by '.$data['portfolio_details'][0]['designer_name'].' Explore the impressive interior design by top designers across the world. #Book Your Design Consultation today!';
        $data['meta_keywords'] = '';   
       // $data['meta_title'] = $data['portfolio_details'][0]['portfolio_name'].' by Designer '.$data['portfolio_details'][0]['designer_name'].' @Mansionly.com';   
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($data['portfolio_details'][0]['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($data['portfolio_details'][0]['portfolio_name'])))).'/ep/'.$portfolio_id.'" />';
        /*[start::Set designer profile exe limit in session for back activity]*/
        if(isset($_GET['exe_offset'])){
            $this->session->set_userdata('exe_limit',$_GET['exe_offset']);
        }
        /*[End::Set designer profile exe limit in session for back activity]*/
        
         /*[start::Set designer profile exe limit in session for back activity]*/
        if(isset($_GET['design_offset'])){
            $this->session->set_userdata('design_limit',$_GET['design_offset']);
        }
        /*[End::Set designer profile exe limit in session for back activity]*/
        
        /*[start::Set All execution gallary limit in session for back activity]*/
        if(isset($_GET['execution_gallery_offset'])){
            $this->session->set_userdata('execution_gallery_limit',$_GET['execution_gallery_offset']);
        }
         if(isset($_GET['execution_flag'])){
            $this->session->set_userdata('execution_flag',$_GET['execution_flag']);
        }
        /*[End::Set All execution gallary limit in session for back activity]*/
        $flag = "executionportfolio";
        $offset = 0;
        $limit = 6;
        $data['limit'] = $limit;

        //$data['portfolio_details'] = $this->Md_designer->getdesignerPortfolio($portfolio_id);
        $designerId = $data['portfolio_details'][0]['designer_id'];
        $data['totalCountExc'] = $this->Md_designer->getTotalPortfolioCount($portfolio_id,$designerId);
       // $data['totalCountExc'] = '';
        $data['totalCountDsgnConcept'] = $this->Md_designer->getTotalDesignConceptCount($portfolio_id,$designerId);
         
         /*executionPortfolio listing:*/
         $data['exe_offset']='6';
         $data['execution_portfolio'] = $this->Md_designer->getOtherPortfolio($portfolio_id,$data['portfolio_details'][0]['designer_id'],$offset,$limit);    
        // $data['execution_portfolio'] = '';    
         
         /*designConcept listing:*/
         $data['dsg_offset']='0';
        // $data['design_concept'] = $this->Md_designer->getThemeWiseDesignList_profile($data['portfolio_details'][0]['designer_id'],$offset="0",$limit="6");
         $data['design_concept'] = array();
      
       
      /*Start:: get favorite list of customer*/
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
	   
	   $data['designer_details'] = $this->Md_designer->getDesignerDetail($data['portfolio_details'][0]['designer_id']);
	   
	   
       /*End:: get favorite list of customer*/
       // print_r($data['portfolio_details']);die;
        $data['flag'] = $flag;
        $this->load->view('designer/vw_designer_portfolio_details', $data);
    } 
    public function designer_design_concept($portfolio_name,$flag,$portfolio_id) {
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        $portfolio_details = $this->Md_designer->getdesignerDesignConcept($portfolio_id);
        $data['page_title'] = $portfolio_details[0]['design_display_name'].' by Designer '.$portfolio_details[0]['designer_name'].' @Mansionly.com';
        $data['leadGenFromSliderPageType'] = 'design-concept';   
        $data['leadGenFromSliderPageUniqueId'] = $portfolio_id;   
        $data['page_name'] = 'designer_portfolio';   
        $data['meta_description'] = $portfolio_details[0]['design_display_name'].' by '.$portfolio_details[0]['designer_name'].' Explore the impressive interior design by top designers across the world. #Book Your Design Consultation today!';
        $data['meta_keywords'] = '';   
       // $data['meta_title'] = $portfolio_details[0]['design_display_name'].' by Designer '.$portfolio_details[0]['designer_name'].' @Mansionly.com';   
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($portfolio_details[0]['design_name'])))).'/dc/'.$portfolio_id.'" />';
  

        
        /*[start::Set designer profile exe limit in session for back activity]*/
        if(isset($_GET['exe_offset'])){
            $this->session->set_userdata('exe_limit',$_GET['exe_offset']);
        }
        /*[End::Set designer profile exe limit in session for back activity]*/
        
         /*[start::Set designer profile exe limit in session for back activity]*/
        if(isset($_GET['design_offset'])){
            $this->session->set_userdata('design_limit',$_GET['design_offset']);
        }
        /*[End::Set designer profile exe limit in session for back activity]*/
        
        /*[start::Set All execution gallary limit in session for back activity]*/
        if(isset($_GET['execution_gallery_offset'])){
            $this->session->set_userdata('execution_gallery_limit',$_GET['execution_gallery_offset']);
        }
         if(isset($_GET['execution_flag'])){
            $this->session->set_userdata('execution_flag',$_GET['execution_flag']);
        }
        /*[End::Set All execution gallary limit in session for back activity]*/
        $flag = "designconcept";
        $offset = 0;
        $limit = 6;
        $data['limit'] = $limit;
          
            $rsArrPortfoliDtls = $this->Md_designer->getdesignerDesignConcept($portfolio_id);

            $rsData ='';
            $rsData[0]['id']=$rsArrPortfoliDtls[0]['design_id'];
            $rsData[0]['designer_id']=$rsArrPortfoliDtls[0]['design_designer'];
            $rsData[0]['designer_name']=$rsArrPortfoliDtls[0]['designer_name'];
            $rsData[0]['portfolio_name']=$rsArrPortfoliDtls[0]['design_display_name'];
            $rsData[0]['master_image']=$rsArrPortfoliDtls[0]['design_img'];
            $rsData[0]['secondary_images']=$rsArrPortfoliDtls[0]['secondary_images'];
            $rsData[0]['designer_logo']=$rsArrPortfoliDtls[0]['designer_logo'];
            //$rsData['']=$rsArrPortfoliDtls[0][''];
            $data['portfolio_details'] = $rsData;
            $designerId = $data['portfolio_details'][0]['designer_id'];
            $data['totalCountExc'] = $this->Md_designer->getTotalPortfolioCount($portfolio_id,$designerId);
            $data['totalCountDsgnConcept'] = $this->Md_designer->getTotalDesignConceptCount($portfolio_id,$designerId);
         
         /*executionPortfolio listing:*/
        $data['exe_offset']='0';
        $data['execution_portfolio'] = $this->Md_designer->getdesignerPortfolio_profile($designerId,$offset,$limit);
         // $data['execution_portfolio'] = array();

         
         /*designConcept listing:*/
          $data['dsg_offset']='6';
          $data['design_concept'] = $this->Md_designer->getOtherDesignConcept($portfolio_id,$designerId,$offset,$limit);    
       
      /*Start:: get favorite list of customer*/
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
       /*End:: get favorite list of customer*/
        
        $data['flag'] = $flag;
        $this->load->view('designer/vw_designer_portfolio_details', $data);
    } 
      
    
    public function ajaxOtherExecutionPortfolio() {
         
      
      /*Arrray for the replacement in url*/
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
    
      $offset = $_POST['offset'];
      $portfolio_id = $_POST['portfolio_id'];
      $designer_id = $_POST['designer_id'];
      $flagPortfolioSelect = $_POST['flagPortfolioSelect'];
      $limit = 6;
      $incremented_offset = ($offset + $limit);
      $Favoritestring = $_POST['customerFavoriteExecutions'];
      $customerFavoriteExecutions = explode(',',$Favoritestring);
      $q = $_POST['q'];
      $image_size = $_POST['image_size'];
      //print_r($customerFavoriteExecutions);die;
      if($flagPortfolioSelect== "executionportfolio"){
      $execution_portfolio = $this->Md_designer->getOtherPortfolio($portfolio_id,$designer_id,$offset,$limit);  
      }else{
       $execution_portfolio = $this->Md_designer->getdesignerPortfolio_profile($designer_id,$offset,$limit);
      }
      
      echo $incremented_offset.'|*|*|';      
        foreach ($execution_portfolio as $row)    {    ?>   

             <div class="col-sm-12 col-md-6 col-xs-12   " >
                <div class="design-profile-box-new">
                <a class="likeico" href="javascript:void(0);">
                     <i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i>
                 </a>
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
                            <a  href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name']; ?>" > 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item">
                            <a  href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name']; ?>" > 
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt-new"><?php echo $row['portfolio_name']; ?></div>
                </div>
              </div>
             
              <?php }               
              die;
    }
    public function ajax_execution_portfolio() {
      
      /*Arrray for the replacement in url*/
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
      
      $offset = $_POST['offset'];
      $limit = 6;
      $designer_id = $_POST['designer_id'];
      $incremented_offset = ($offset + $limit);
      $Favoritestring = $_POST['customerFavoriteExecutions'];
      $customerFavoriteExecutions = explode(',',$Favoritestring);
      $q = $_POST['q'];
      $image_size = $_POST['image_size'];
       echo $incremented_offset.'|*|*|';
     
      
      $execution_portfolio = $this->Md_designer->getdesignerPortfolio_profile($designer_id,$offset,$limit);
      
      
      $incremented_offset = $offset + 6;
      $remaining_portfolio_count = $this->Md_designer->getdesignerPortfolio_profile($designer_id,$incremented_offset,$limit);
      //print_r($remaining_portfolio_count);
      if(empty($remaining_portfolio_count)) { ?>
      <script>$('#loadMore_exe').hide();</script>
      
     <?php }       
        foreach ($execution_portfolio as $row)    {    ?>   

             <div class="col-sm-12 col-md-6 col-xs-12   " >
                <div class="design-profile-box-new">
                    <a class="likeico" href="javascript:void(0);">
                     <i id="<?php echo 'executionportfolio'.$row['id']; ?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavoriteExecutions)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Portfolio','executionportfolio', <?php echo $row['id'];?> );"></i>
                 </a>
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
                            <!--<a class="add_exe_url" href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['id'] ; ?>/<?php echo urlencode($row['portfolio_name']) ; ?>/executionportfolio?q=<?php echo $q; ?>">-->
                            <a class="add_exe_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row['master_image']; ?>" alt="<?php echo $row['portfolio_name']; ?>" > 
                            </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item">
                            <a class="add_exe_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['portfolio_name'])))).'/ep/'.$row['id'].'?q='.$q;?>">
                                <img src="<?php echo image_url;?>media/images/master-execution-images/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['portfolio_name']; ?>"> 
                            </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt-new"><?php echo $row['portfolio_name']; ?></div>
                </div>
              </div>
             
              <?php }
              die;
     
    }
    
    public function ajaxGetOtherDesignConcept(){
         
      /*Arrray for the replacement in url*/
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
      
      $offset = $_POST['offset'];
      $limit = 6;
      $portfolio_id = $_POST['portfolio_id'];
      $designer_id = $_POST['designer_id'];
      $flagPortfolioSelect = $_POST['flagPortfolioSelect'];
      $limit = '6';
      $incremented_offset = $offset + 6;
      $Favoritestring = $_POST['customerFavoriteThemes'];
      $customerFavoriteThemes = explode(',',$Favoritestring);
      $q = $_POST['q'];
      $image_size = $_POST['image_size'];
      if($flagPortfolioSelect== "designconcept"){
      $design_concept = $this->Md_designer->getOtherDesignConcept($portfolio_id,$designer_id,$offset,$limit);  
      }else{
       $design_concept = $this->Md_designer->getThemeWiseDesignList_profile($designer_id,$offset,$limit);
      }
      
      echo $incremented_offset.'|*|*|';
             
        foreach ($design_concept as $row)    {    ?>   

             <div class="col-sm-12 col-md-6 col-xs-12   load_more" >
                <div class="design-profile-box-new">
                    <a class="likeico" href="javascript:void(0);">
                      <i id="<?php echo 'designtheme'.$row['design_id']; ?>" class="fa fa-heart <?php if(in_array($row['design_id'], $customerFavoriteThemes)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Theme','designtheme',<?php echo $row['design_id'];?> )">
                      </i>
                  </a> 
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
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['design_display_name'])))).'/dc/'.$row['design_id'].'?q='.$q;?>">
                              <img src="<?php echo image_url;?>media/images/masterdsg-img/<?php echo $image_size.$row['design_img']; ?>" alt="<?php echo $row['design_display_name']; ?>" > 
                          </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                          <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['design_display_name'])))).'/dc/'.$row['design_id'].'?q='.$q;?>">
                              <img src="<?php echo image_url;?>media/images/masterdsg-img/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['design_display_name']; ?>" > 
                           </a>
                        </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt-new"><?php echo $row['design_display_name']; ?></div>
                </div>
              </div>
             
              <?php }               
             die;
    }
    public function all_designer_old_to_new_url() {
        redirect(base_url().'all-designers?q=d','location',301);
        exit();
    }
    public function all_designers() {
        
        //$data['page_title'] = "Designer Listing";
        //$data['page_title'] = "Interior Designers, Top Interior Designer and Home Decorators - Book an Appointment Today!";
        $data['page_title'] = "Meet The Top Interior Designer, Home Decorators | Book an Appointment";
        $data['leadGenFromSliderPageType'] = 'all-designers'; 
        $data['leadGenFromSliderPageUniqueId'] = ''; 
        $data['page_name'] = 'designer_listing';   
        $data['meta_description'] = 'Browse through the list of best interior designer and home decorators across India and world. Book an appointment today with our top interior designers.';
        //$data['meta_title'] = 'Interior Designers, Top Interior Designer and Home Decorators - Book an Appointment Today!';   
        $data['meta_keywords'] = '';   
        $data['canonicalLink'] = '<link rel="canonical" href="https://www.mansionly.com/all-designers" />';
        $data['totalCount'] = $this->Md_designer->getDesignerListAllCount();
        $offset = 0;
        $limit = 24;
        $data['limit']=$limit;
    
        $arrDesignerList = $this->Md_designer->getDesignerList($offset,$limit);
       
       $data['featured_designer_list'] = array();
       $data['designer_list'] = array();
      
       foreach($arrDesignerList as $key => $row ){
        if($key <='2'){
            $data['featured_designer_list'][] = $row;
        }else{
         $data['designer_list'][] = $row;
        }
       }
       
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
       
       /*End:: get favorite designer list of customer*/
        $this->load->view('designer/vw_all_designer', $data);
    }  
    
    public function ajax_all_designer() {
        
         /*Arrray for the replacement in url*/
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
         
        $offset = $_POST['offset'];
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavorites'];
        $customerFavorites = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $image_size = $_POST['image_size'];

        $designer_list = $this->Md_designer->getDesignerList($offset,$limit);
       echo $incremented_offset.'|*|*|';  
      foreach ($designer_list as $row) {
          $profile_pic_theme = $this->Md_designer->getDesignerTopRatedTheme($row['id']);
	  $profile_Pic_port = $this->Md_designer->getDesignerTopRatedPortfolio($row['id']);
           

         ?>
        <div class="col-md-4 col-sm-6 col-xs-12 extraPd">
           <div class="design-box clearfix">
               
               <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'designer'.$row['id'];?>" class="fa fa-heart <?php if(in_array($row['id'], $customerFavorites)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Designer','designer',<?php echo $row['id'];?> );"></i></a>     
               <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'].'?q=d';?>">
               <div class="Dzimg clearfix">
                    <?php if (! empty($profile_Pic_port)) {?>
                        <img src="<?php echo image_url; ?>media/images/master-execution-images/<?php echo $image_size.$profile_Pic_port[0]['master_image']; ?>" alt="<?php echo $row['designer_name']; ?>">
                    <?php  } else if (! empty($profile_pic_theme)) {?>
                        <img src="<?php echo image_url; ?>media/images/masterdsg-img/388x300/<?php echo $profile_pic_theme[0]['design_img']; ?>" alt="<?php echo $row['designer_name']; ?>">
                     <?php  } else {?>  
                        <img src="<?php echo base_url().SitePath ; ?>assets/img/placeholderNew.png" alt="<?php echo $row['designer_name']; ?>">
                     <?php } ?>
                </div>
                </a>
               <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/designer/'.$row['id'].'?q=d';?>">
                    <?php if($row['designer_logo']){?> 
                          <div class="Dzr-profileimg"><img src="<?php echo image_url; ?>media/images/designer-images/150X150/<?php echo $row['designer_logo']; ?>" alt="<?php echo $row['designer_name']; ?>"> </div>
                        <?php }?>
                    <div class="Dzr-profiletxt"><?php echo $row['designer_name']; ?></div>
                </a>
            </div> 
        </div>
     <?php    }              
     die;
    }
    public function ajax_design_concept()
	 {
      /*Arrray for the replacement in url*/
      $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',');
      
      $offset = $_POST['offset'];
      if(!empty($_POST['limit'])){
       $limit = $_POST['limit']; 
      }else{
      $limit = 6;
      }
      $designer_id = $_POST['designer_id'];
      $Favoritestring = $_POST['customerFavoriteThemes'];
      $customerFavoriteThemes = explode(',',$Favoritestring);
      $q = $_POST['q'];
      $image_size = $_POST['image_size'];
      $incremented_offset = $offset + 6;
      $design_concept = $this->Md_designer->getThemeWiseDesignList_profile($designer_id,$offset,$limit);
      
      
       echo $incremented_offset.'|*|*|';
     
        foreach ($design_concept as $row)    {    ?>   

             <div class="col-sm-12 col-md-6 col-xs-12  extraPd" >
                <div class="design-profile-box-new">
                     <a class="likeico" href="javascript:void(0);">
                      <i id="<?php echo 'designtheme'.$row['design_id']; ?>" class="fa fa-heart <?php if(in_array($row['design_id'], $customerFavoriteThemes)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Theme','designtheme',<?php echo $row['design_id']?> )">
                      </i>
                  </a>
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
                           <!--<a class="add_design_url" href="<?php echo base_url(); ?>designer-portfolio/<?php echo $row['design_id'] ; ?>/<?php echo urlencode($row['design_display_name']) ; ?>/designconcept?q=<?php echo $q; ?>">-->
                          <a class="add_design_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['design_display_name'])))).'/dc/'.$row['design_id'].'?q='.$q;?>">
                              <img src="<?php echo image_url;?>media/images/masterdsg-img/<?php echo $image_size.$row['design_img']; ?>" alt="<?php echo $row['design_display_name']; ?>"> 
                          </a>
                        </div>
                        <?php
                        if(!empty($row['secondary_images'])){ 
                        $array = explode(',', $row['secondary_images']);

                       foreach ($array as $row_image) {                        
                        ?>
                        <div class="item"> 
                          <a class="add_design_url" href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['designer_name'])))).'/'.strtolower(urlencode(str_replace($url_replace_char_array, '-',trim($row['design_display_name'])))).'/dc/'.$row['design_id'].'?q='.$q;?>">
                              <img src="<?php echo image_url;?>media/images/masterdsg-img/<?php echo $image_size.$row_image; ?>" alt="<?php echo $row['design_display_name']; ?>"> 
                           </a>
                         </div>
                       <?php  } } ?>
                  <?php   if(!empty($row['secondary_images'])){ ?>
                  </div>
                   <?php } ?>
                  <div class="Dzr-profiletxt-new"><?php echo $row['design_display_name']; ?></div>
                </div>
              </div>
             
              <?php }               
     die;
    }
    public function favorites_designer_list() { 
        
        $data['page_title'] = "Favorites Designer Listing";
        $data['leadGenFromSliderPageType'] = ''; 
        $data['leadGenFromSliderPageUniqueId'] = ''; 
        $data['page_name'] = 'favorites_designer_listing';   
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';   
    
        $data['designer_list'] = $this->Md_designer->getFavoritesDesignerList(); 
  
       /*End:: get favorite designer list of customer*/
        $this->load->view('dashboard/vw_favorites_designer_list',$data);
    }  
   
    
}
