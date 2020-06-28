<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_users extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
                $this->load->model('Md_customer');
                $this->load->model('Md_database');
                $this->load->model('Md_favorites');
                $this->session_management_lib->index();


	}


	public function index()
	{
           $customer_id = $_SESSION["customerId"];
            if(empty($customer_id)){
                redirect(base_url().'signin');
            } 

            
           /*[start:: If CurrentVisitedUrl session is set then redirect*/
            if(!empty($this->session->userdata('CurrentVisitedUrl'))){
                $session_url = $this->session->userdata('CurrentVisitedUrl');
                $this->session->unset_userdata('CurrentVisitedUrl');
                redirect($session_url);
            }
           /*[End:: If CurrentVisitedUrl session is set then redirect*/
           
           $requestData['customer_name']= $_SESSION["customerName"] ;
           $requestData['customer_id']= $_SESSION["customerId"];
           $customer_details_full = $this->Md_customer->getCustomerDetailsFull($requestData);
           $requestData['customer_name']= '';
           $customer_email_full = $this->Md_customer->getCustomerEmailFull($requestData);
           $customer_mobile_full = $this->Md_customer->getCustomerMobileFull($requestData);
	
            $data['page_title'] = "Profile";
            $data['leadGenFromSliderPageType'] ='user-profile'; 
            $data['leadGenFromSliderPageUniqueId'] = '';
            $data['page_name'] = 'profile';   
            $data['meta_description'] = "";
            $data['meta_keywords'] =  ""; 
           // $data['title']='Users';
            $data['customer_details_full']=$customer_details_full?$customer_details_full[0]:'';
           // $data['customer_email_full']=$customer_email_full?$customer_email_full[0]:'';
            $data['customer_email_full']=$customer_email_full?$customer_email_full:'';
           // $data['customer_mobile_full']=$customer_mobile_full?$customer_mobile_full[0]:'';
            $data['customer_mobile_full']=$customer_mobile_full?$customer_mobile_full:'';
            $this->load->view('dashboard/vw_profile',$data);
	}

  
    public function my_favourites() {
         
       $customer_id = $_SESSION["customerId"];
       if(empty($customer_id)){
           redirect(base_url().'signin');
       }
        
        $data['page_title'] = "My favourites";
        $data['leadGenFromSliderPageType'] ='my-favourites'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'my_favourites';   
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
                
        $this->load->view('dashboard/vw_my_favourites',$data);
    }
    public function my_orders()
    {
       $customer_id = $_SESSION["customerId"];
       if(empty($customer_id)){
           redirect(base_url().'signin');
       }
        $data['page_title'] = "My Orders";
        $data['page_name'] = 'my_orders';  
        $data['leadGenFromSliderPageType'] ='my-orders'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "";
        $data['meta_keywords'] =  ""; 
        /*Get order list*/
        $table = "order_dtl"; 
        $condition = array('customer_id' => $customer_id,'crm_status' => '7');
        $data['order_details'] = $this->Md_database->getData($table,'customer_id,o_id,unique_oid,apartment,scheme,flat,apartment_address,city',$condition,'o_id DESC');   
        $this->load->view('dashboard/vw_my_orders',$data);
        
    }

    public function work_order_details($order_id)
    {
        
      if(empty($order_id)){
            $msg = '';
            $msg = '<div class = "alert alert-info" id = "msg">
                     <button data-dismiss = "alert" class = "close" type = "button">x</button>
                       Your order comming soon.
                     </div>';
            $this->session->set_userdata('MSG', $msg);
            redirect(base_url().'my-orders');
            exit();
      }
    $customer_id = $_SESSION["customerId"];
       if(empty($customer_id)){
           redirect(base_url().'signin');
       }
        $data['page_title'] = "Order Details";
        $data['leadGenFromSliderPageType'] ='order-details'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['page_name'] = 'work_orders';   
        $data['meta_description'] = "";
        $data['meta_keywords'] =  ""; 
        $data['active_flag'] =  ""; 
        $section_id = "";
        if(isset($_GET['filtid'])){
        $section_id = $_GET['filtid'];
        }
        /*Get order list*/
        $table = "order_dtl"; 
        $condition = array('o_id'=>$order_id);
        $data['order_details'] = $this->Md_database->getData($table,'customer_id,o_id,unique_oid,last_action_date',$condition,'o_id DESC');   
       
        
        $data['status_summary'] = $this->Md_customer->get_status_summary($order_id);   
        $data['detailed_nav_list'] = $this->Md_customer->get_detailed_nav_list($order_id);   
        $data['detailed_status'] = $this->Md_customer->get_detailed_status($order_id,$section_id);   
        $data['milestone_details'] = $this->Md_customer->get_milestone_details($order_id);   
        $data['timeline_details'] = $this->Md_customer->get_timeline($order_id); 
        $data['all_work_order_files'] = $this->Md_customer->get_all_work_order_files($order_id); 
        $data['side_galler_files'] = $this->Md_customer->get_side_gallery_files($file_date='',$order_id);
        $data['workorder_id'] = "";
        $data['order_id'] = $order_id;
       //    echo '<pre>'; print_r($data['status_summary']);die;
        $this->load->view('dashboard/vw_work_orders',$data);
        
    }
    public function public_work_order_details($customer_id,$order_id)
    {
      
        $data['page_title'] = "Order Details";
        $data['page_name'] = 'work_orders'; 
        $data['leadGenFromSliderPageType'] ='order-details'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "";
        $data['meta_keywords'] =  ""; 
        $data['active_flag'] =  ""; 
        $section_id = "";
        if(isset($_GET['filtid'])){
        $section_id = $_GET['filtid'];
        }
        /*Get order list*/
        $table = "order_dtl"; 
        $condition = array('o_id'=>$order_id,'customer_id'=>$customer_id);
        $data['order_details'] = $this->Md_database->getData($table,'customer_id,o_id,unique_oid,last_action_date',$condition,'o_id DESC');   
      
        if(empty($data['order_details'])){
            redirect(base_url().'404.php');
            exit();
        }
        /*Get work order list*/
        $table = "order_work_order_details"; 
        $condition = array('order_id' => $order_id,'status'=>'Active','client_viewable'=> '1');
        $data['work_order_list'] = $this->Md_database->getData($table,'order_id,workorder_id,unique_workorder_id',$condition,'workorder_id DESC');   
        $data['count_work_order_list'] = count($data['work_order_list']);

         
        
        $data['status_summary'] = $this->Md_customer->get_status_summary($order_id);   
        $data['detailed_nav_list'] = $this->Md_customer->get_detailed_nav_list($order_id);   
        $data['detailed_status'] = $this->Md_customer->get_detailed_status($order_id,$section_id);   
        $data['milestone_details'] = $this->Md_customer->get_milestone_details($order_id);   
        $data['timeline_details'] = $this->Md_customer->get_timeline($order_id);   
        $data['all_work_order_files'] = $this->Md_customer->get_all_work_order_files($order_id); 
        $data['side_galler_files'] = $this->Md_customer->get_side_gallery_files($file_date='',$order_id);

        $data['customer_id'] = $customer_id;
        $data['workorder_id'] = '';
        $data['order_id'] = $order_id;
        
    
        $this->load->view('dashboard/vw_public_work_order_details',$data);
        
    }
    
 public function ajax_city_list() {
        
        /*PostData:*/
    $search_keyword = $_POST["keyword"];
    $arrCityList = $this->Md_customer->get_city_list($search_keyword);   
    if(!empty($arrCityList)) {
    ?>
    <ul id="country-list">
    <?php
    foreach($arrCityList as $rowData) {
    ?>
    <li onClick="selectCity('<?php echo $rowData["id"]; ?>','<?php echo str_replace("'",'`',$rowData["city"]).', '.str_replace("'",'`',$rowData["state_title"]).', '.str_replace("'",'`',$rowData["countryName"]); ?>');"><?php echo str_replace("'",'`',$rowData["city"]).', '.str_replace("'",'`',$rowData["state_title"]).', '.str_replace("'",'`',$rowData["countryName"]); ?></li>
    <?php } ?>
    </ul>
    <?php }
    exit();
        }

    }

 ?>