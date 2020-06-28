<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_home extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor 
       //$this->load->model('Md_designer');
       $this->load->model('Md_home');
	   $this->load->library('HybridAuthLib');
	   $this->load->model('Md_customer');
       $this->session_management_lib->index();
    }
   
    
    public function index()
	{
		/****[Start::Social Login Process:]****/	
			$data['socialtype']='';
			$data['providers'] = $this->hybridauthlib->getProviders();
			$data['userprofiles']='';
			foreach($data['providers'] as $provider=>$d) {
				if ($d['connected'] == 1) { 
					$data['socialtype']=$provider;
					$data['userprofiles'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
				}
			}
			//Post data
			/*if(empty($data['userprofiles']))
			{		$_SESSION["customerId"]=null;
					$_SESSION["customerName"] =null;
					$_SESSION["socialtype"] =null;
					$_SESSION["customer_photo"] = null;
			}*/
		/****[End::Social Login Process;]****/			
		
        //$data['page_title'] = "Home interior design, office interior design,Interior designers in Bengaluru, Delhi";
        //$data['page_title'] = "Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office";
        $data['page_title'] = "Top International Interior Design for Home & Office in Delhi and Bangalore";
        $data['page_name'] = 'home';   
        $data['leadGenFromSliderPageType'] = 'home-page'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
       // $data['meta_title'] = 'Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office'; 
        $data['meta_keywords'] = 'Home interior design ,office interior design, interior designers in Bengaluru, interior designers in Delhi'; 
        $data['meta_description'] = 'Contact best of interior designers to exclusively design your home or office. Our world class designers change the outlook of your abode.';   
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().'" />';
        $data['featured_designer'] = $this->Md_home->getfeaturedDesigner();
        $data['top_rated_portfolio'] = $this->Md_home->getDesignerTopRatedPortfolio($data['featured_designer'][0]['id']);
        $data['sample_exe_portfolio'] = $this->Md_home->getfeatured_sample_execution_portfolio();
        $data['art_product'] = $this->Md_home->getProduct_filterByfeatured(1);
        $data['furniture_product'] = $this->Md_home->getProduct_filterByfeatured(2);
        $data['decor_product'] = $this->Md_home->getProduct_filterByfeatured(3);
        $data['brand_list'] = $this->Md_home->getBrandList();
//        $data['magazine_list'] = $this->Md_home->getMagazineList();
        $data['magazine_list'] = $this->Md_home->getMagazineListNewsFeed();
//        echo "<pre>";
//        print_r($data['canonicalLink']);die;
        
        $this->load->view('vw_home', $data);
    } 
    
    public function ajaxHomePage(){
        
        $offset= array();
        $offset['offsetDesigner'] = $_POST['offsetDesigner'] ;
        $offset['offsetBrand'] = $_POST['offsetBrand'] ;
        $offset['offsetProduct'] = $_POST['offsetProduct'] ;
        $offset['offsetEP'] = $_POST['offsetEP'] ;
       $offset['offsetDC'] = $_POST['offsetDC'] ;
       $offset['offsetBlog'] = $_POST['offsetBlog']?$_POST['offsetBlog'] :0 ;
       $offset['getStartedIndex'] = $_POST['getStartedIndex']+1;
       $data['getStartedIndex'] = $offset['getStartedIndex'];
       $customerFavoriteThemes = array();
       $customerFavoriteDesigner = array();
       $customerFavoriteExecutions = array();
       $customerFavoriteProduct = array();
       if(!empty($_SESSION['customer_id'])){
            $customerFavoriteThemes = $this->Md_home->getCustomerFavoriteThemes($_SESSION['customer_id']);
            $customerFavoriteDesigner =  $this->Md_home->getCustomerFavoriteDesigner($_SESSION['customer_id']);
            $customerFavoriteExecutions =  $this->Md_home->getCustomerFavoriteExecutions($_SESSION['customer_id']);
            $customerFavoriteProduct =  $this->Md_home->getCustomerFavoriteProduct($_SESSION['customer_id']);
       }
      
       $data['customerFavoriteThemes'] = $customerFavoriteThemes;
       $data['customerFavoriteDesigner'] = $customerFavoriteDesigner;
       $data['customerFavoriteExecutions'] = $customerFavoriteExecutions;
       $data['customerFavoriteProduct'] = $customerFavoriteProduct;
        //var
        $countBlog=1;
        //var
        $countDesigner=2;
        $countBrand=1;
        $countProduct=2;
        $countEP=3;
        $countDC=1;
        $finalArray = array();
        $tempData = array();
        $blogData = array();
        /*Start::get blog*/
        while($countBlog>0){
            
            $tempData = $this->Md_home->getMagazineBlog($offset['offsetBlog'],'1');
            if($offset['offsetBlog']==0 && empty($tempData)){
                break;
            }
            
            
            if(!empty($tempData)){
                
                $tempData['tileType'] = 'blog';
                
                $blogData[] = $tempData;
                $offset['offsetBlog']++; 
                $countBlog--;
            }else{
                $offset['offsetBlog']=0;
            }
            
        }
        /*End::get blog*/
        
        $data['blogData'] = $blogData;
        
      
        /*Start::get designers*/
        while($countDesigner>0){
            
            $tempData = $this->Md_home->getDesigner($offset['offsetDesigner'],'1');
            $designerImg =array();
            if(!empty($tempData)){
                $portfolioImg=$this->Md_home->getDesignerTopRatedPortfolio2($tempData['id']);
                $designThemeImg=$this->Md_home->getDesignerTopRatedTheme2($tempData['id']);
                $tempData['portfolioImg'] = $portfolioImg['master_image']?$portfolioImg['master_image']:'';
                $tempData['designThemeImg'] = $designThemeImg['design_img']?$designThemeImg['design_img']:'';
                $tempData['tileType'] = 'designer';
                
                $finalArray[] = $tempData;
                $offset['offsetDesigner']++; 
              $countDesigner--;
            }else{
                $offset['offsetDesigner']=0;
            }
            
        }
        /*End::get designers*/
        
        /*Start::get brand*/
        
        while($countBrand>0){
            
            $tempData = $this->Md_home->getBrand($offset['offsetBrand'],'1');
            
            if(!empty($tempData)){
                 $tempData['tileType'] = 'brand';
                 $brandTopProduct = $this->Md_home->getBrandTopProduct($tempData['brand_id']);
                 $tempData['brandTopProductImg'] = $brandTopProduct['product_image'];
                $finalArray[] = $tempData;
               $offset['offsetBrand']++; 
              $countBrand--;
            }else{
                $offset['offsetBrand']=0;
            }
            
        }
        /*End::get brand*/
        
        
        /*Start::get Execution protfolio*/
        while($countEP>0){
            
            $tempData = $this->Md_home->getExecutionPortfolio($offset['offsetEP'],'1');
            
            if(!empty($tempData)){
                $tempData['tileType'] = 'executionPortfolio';
                $finalArray[] = $tempData;
               $offset['offsetEP']++; 
              $countEP--;
            }else{
                $offset['offsetEP']=0;
            }
            
        }
        /*End::get Execution protfolio*/
        
        
        /*Start::get Design concept*/
        while($countDC>0){
            
            $tempData = $this->Md_home->getDesignConcept($offset['offsetDC'],'1');
            
            if(!empty($tempData)){
                $tempData['tileType'] = 'designConcept';
                $finalArray[] = $tempData;
               $offset['offsetDC']++; 
              $countDC--;
            }else{
                $offset['offsetDC']=0;
            }
            
        }
        /*End::get Design concept*/
        
        
        /*Start::get product*/
        while($countProduct>0){
            
            $tempData = $this->Md_home->getProduct($offset['offsetProduct'],'1');
            
            if(!empty($tempData)){
                $tempData['tileType'] = 'product';
                $finalArray[] = $tempData;
               $offset['offsetProduct']++; 
              $countProduct--;
            }else{
                $offset['offsetProduct']=0;
            }
            
        }
        /*End::get product*/
        
       
        shuffle($finalArray);
        
        //echo die;
        $data['finalArray']=$finalArray;
        
        echo json_encode($offset);
        echo '|*|*|';
        $this->load->view('vw_ajax_home_tiles', $data);
        
    }
    
    public function demo() {
        
        $data['page_title'] = "Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com  ";
        $data['page_name'] = 'home';   
        $data['meta_description'] = 'Get the best design, inspirations on projects, furnitures, and decorations. Interior Design, Bedroom Designs, Home Designs, and Home Decor at Mansionly.com';   
        $data['meta_keywords'] = 'Interior Design, Bedroom Designs, Home Designs, Home Decor';         
        $this->load->view('vw_demo', $data);
    } 
   
    
}
