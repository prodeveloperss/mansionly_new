<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_campaign extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_campaign');
        $this->load->model('Md_customer');
        $this->load->model('Md_database');
        $this->session_management_lib->index();
    }

    public function index() {
		
        $data['page_name'] = 'interior-design';
        $data['page_title'] = "Interior Design";
        $data['meta_description'] = "";
        $data['meta_keywords'] = "";

        $table = "social";
        $condition = array('status' => '1');
        $data['social_media_list'] = $this->Md_database->getData($table, 'social_id,social_name,statusck,social_value,status', $condition, 'social_id');
        
       
        $data['city_list'] = $this->Md_campaign->getCityDetails();

        $this->load->view('campaign/vw_landing_page_1', $data);
    }

    public function ajax_form_submit_action() {

        $requestData['name'] = $_POST['name'];
        $requestData['email_id'] = $_POST['email'];
        $requestData['phone_no'] = $_POST['mobile'];
        $requestData['city'] = $_POST['city'];
        $requestData['comment'] = $_POST['comment'];
        $requestData['remote_address'] = $_SERVER['REMOTE_ADDR'];
        
       // $data_order['unique_oid'] = $this->Md_customer->getUniqueOrderID();
        $data_order['city_id'] = $requestData['city'];
        $data_order['special_request'] = $requestData['comment'];
        //$data_order['marketplace_comments'] = $requestData['comment'];
        $data_order['pipeline_load_date'] = date('Y-m-d H:i:s');
        $data_order['remote_address'] = $requestData['remote_address'];
        $data_order['campaign_utm_param'] = $_POST['campaign_utm_param'];
        $data_order['scheme'] = $_POST['scheme'];
        $data_order['status'] = '1';
      //  $data_order['crm_status'] = '2';
      //  $data_order['order_type'] = 'Query';
        $data_order['order_channel_type'] = 'Web';
        
		/*[start:check scheme record already available or not]*/
        $resultFbCampaignDtls = $this->Md_customer->getSchemeDetails($data_order['scheme']);
        if(!empty($resultFbCampaignDtls)){
			$data_order['apartment_name'] = $resultFbCampaignDtls[0]['campaign_name'];
		}		
		/*[end:check scheme record already available or not]*/

	
        $data['customer_details']= array();
        if(!empty($requestData['phone_no'])){
           $data['customer_details'] = $this->Md_customer->getCustomerDetailsByPhone($requestData['phone_no']);
        }
        if(empty($data['customer_details'])){
        $data['customer_details'] = $this->Md_customer->getCustomerDetailsByemail($requestData['email_id']);
        }

        if (empty($data['customer_details'])) {
          
            /* If user not exist Insert new customer data in customer details table and Create lead */
            $table = 'customer_details';
            $data = array(
                'customer_name' => $requestData['name'],
                'customer_username' => $requestData['email_id'],
                'customer_password' => md5($requestData['phone_no']),
                'remote_address' => $requestData['remote_address'],
                'status' => '1',
                'on_date' => date('Y-m-d H:i:s'),
                'last_update_date' => date('Y-m-d H:i:s')
            );
            $this->Md_database->insertData($table, $data);
            $last_insert_id = $this->db->insert_id();

            if ($last_insert_id) {
                /* insert Customer email */
                $table = 'customer_email';
                $data = array(
                    'customer_id' => $last_insert_id,
                    'customer_email' => $requestData['email_id']
                );
                $this->Md_database->insertData($table, $data);

                /* insert Customer Mobile or phone */
                $table = 'customer_phone';
                $data = array(
                    'customer_id' => $last_insert_id,
                    'customer_phone' => $requestData['phone_no']
                );
                $this->Md_database->insertData($table, $data);



                $mailData['customer_name'] = $requestData['name'];
                $mailData['customer_email'] = $requestData['email_id'];
                $mailData['customer_password'] = $requestData['phone_no'];

             //   $orderResult = $this->signUpEmail($mailData, $requestData['phone_no']);

                $table = 'customer_details';
                $condition = array('customer_id' => $last_insert_id);
                $customer_details = $this->Md_database->getData($table, 'customer_id,customer_name', $condition, '', '');
                
                $data_order['customer_id'] = $customer_details[0]['customer_id'];
              
                $result = $this->createCustomerOrder($data_order);
                
//            if(!empty($result)){
//                
//                $MarketCommentData['order_id'] = $result;
//                $MarketCommentData['comment'] = $requestData['comment'];
//                $MarketCommentData['actor_by'] = '1';
//                $MarketCommentData['ondatetime'] = date('Y-m-d H:i:s');
//                $comment_id = $this->SaveCustomerComment($MarketCommentData);
//                
//                /*[start:Send email to the sales team]*/
//			$UserDetails = $this->Md_customer->getCustomerinfo($data_order['customer_id']);
//                     
//                        $table = 'settings';
//                        $condition = array('flag_id'=>'1','setting_name'=>'site_sales_email');
//                        $setting = $this->Md_database->getData($table,'setting_value',$condition,'','');
//             
//                        
//                        $to =  $setting[0]['setting_value'];    
//                        $message = "";
//                        $subject = 'New Lead '.$data_order['unique_oid'].' Created';
//                        $message .= '<html><body>
//                                    <p>Please note that a new lead has been created in the system.</p> 
//                                    <p><b>Lead ID - </b>'.$data_order['unique_oid'].'</p>
//                                    <p><b>Name - </b>'.$UserDetails[0]['customer_name'].'</p>';
//                                    if(!empty($UserDetails[0]['customer_email'])){ 
//                        $message .= '<p><b>Email - </b>'.$UserDetails[0]['customer_email'].'</p>';
//                                    }if(!empty($UserDetails[0]['customer_phone'])){ 
//                        $message .= '<p><b>Mobile No - </b>'.$UserDetails[0]['customer_phone'].'</p>';
//                                    }
//                        $message .='<br>    
//                                    (This is an auto-generated mail from the lead management system)                                   
//                                    </body></html>';
//                        $parameter="sales";
//                        $this->sendEmailNew($to,$subject,$message,$parameter);
//                         
//                      /*[End:Send email to the sales team]*/
//                
//            }
//                
//                if($this->session->userdata('session_enquiry_flag')){}
//                else{
//                $this->placeOrderEmail($requestData);
//                }
            echo 'New User'.'|*|*|';
            echo $result.'|*|*|';
            echo "order saved succesfully";die;
            }
        }else{
            //echo "exist";die;
            $data_order['customer_id'] = $data['customer_details'][0]['customer_id'];
           
            $customerMobilephone = $this->Md_customer->getCustomerMobileFull($data_order);
                               
            $mobile_array=array();
            foreach($customerMobilephone as $array){
                $mobile_array[] = $array['customer_phone'];
            }     

            if ( (! in_array( $requestData['phone_no'], $mobile_array)) )
            {

               if (!empty($requestData['phone_no'])){	
                $newPhone['customer_id']    =  $data_order['customer_id'];
                $newPhone['customer_phone'] =  $requestData['phone_no'];	
                $results = $this->Md_customer->createCustomerPhone($newPhone);	
               }

            }



            // Check user's new email exist or not , if not exist then update email
            $customerEmails = $this->Md_customer->getCustomerEmailFull($data_order);

            $email_array=array();
            foreach($customerEmails as $array){
                $email_array[] = $array['customer_email'];
            } 
            //print_r($email_array);die;
            if(! in_array($requestData['email_id'], $email_array))
            {
               if (!empty($requestData['email_id'])){	
                $newEmail['customer_id']    =  $data_order['customer_id'];
                $newEmail['customer_email'] =  $requestData['email_id'];			 			 
                $results =  $this->Md_customer->createCustomerEmail($newEmail);
               }
            }
             
            $result = $this->createCustomerOrder($data_order);
            
//            if(!empty($result)){
//               
//                $MarketCommentData['order_id'] = $result;
//                $MarketCommentData['comment'] = $requestData['comment'];
//                $MarketCommentData['actor_by'] = '1';
//                $MarketCommentData['ondatetime'] = date('Y-m-d H:i:s');
//                $comment_id = $this->SaveCustomerComment($MarketCommentData);
//                
//                /*[start:Send email to the sales team]*/
//			$UserDetails = $this->Md_customer->getCustomerinfo($data_order['customer_id']);
//                     
//                        $table = 'settings';
//                        $condition = array('flag_id'=>'1','setting_name'=>'site_sales_email');
//                        $setting = $this->Md_database->getData($table,'setting_value',$condition,'','');
//             
//                        
//                        $to =  $setting[0]['setting_value'];    
//                        $message = "";
//                        $subject = 'New Lead '.$data_order['unique_oid'].' Created';
//                        $message .= '<html><body>
//                                    <p>Please note that a new lead has been created in the system.</p> 
//                                    <p><b>Lead ID - </b>'.$data_order['unique_oid'].'</p>
//                                    <p><b>Name - </b>'.$UserDetails[0]['customer_name'].'</p>';
//                                    if(!empty($UserDetails[0]['customer_email'])){ 
//                        $message .= '<p><b>Email - </b>'.$UserDetails[0]['customer_email'].'</p>';
//                                    }if(!empty($UserDetails[0]['customer_phone'])){ 
//                        $message .= '<p><b>Mobile No - </b>'.$UserDetails[0]['customer_phone'].'</p>';
//                                    }
//                        $message .='<br>    
//                                    (This is an auto-generated mail from the lead management system)                                   
//                                    </body></html>';
//                        $parameter="sales";
//                        $this->sendEmailNew($to,$subject,$message,$parameter);
//                         
//                      /*[End:Send email to the sales team]*/
//                
//            }
//            if($this->session->userdata('session_enquiry_flag')){}
//            else{
//            $this->placeOrderEmail($requestData);
//            }
            echo 'Existing User'.'|*|*|';
            echo $result.'|*|*|';
            echo "order saved succesfully";die;

        }
    }

    public function createCustomerOrder($requestData) {
       
        $this->db->insert("jb080_pipeline_details", $requestData);
        if ($this->db->affected_rows() > 0) {
            $orderId = $this->db->insert_id();
            
            if(!empty($requestData['scheme'])){
                
                   /*get scheme details in fb campaign table*/
                  $result = $this->Md_customer->getSchemeDetails($requestData['scheme']);

                  if(empty($result)){
                 /*Insert scheme in fb campaign table*/
                   $table = 'jb080_fb_campaign_name';
                   $data = array('scheme'=> (!empty($requestData['scheme']))? $requestData['scheme']:null);
                   $this->Md_database->insertData($table, $data);
                  }
            }

            return $orderId;
        } else {
            return false;
        }
    }
//     public function SaveCustomerComment($MarketCommentData)
//    {
//        $this->db->insert("jb080_order_dtl_mapp_lead_kyc", $MarketCommentData);
//        if ($this->db->affected_rows() > 0)
//        {
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }
    
//    public function placeOrderEmail($requestData)
//    {
//        
////        $result=json_encode($requestData);
////        $result=json_decode($result);
//
//       
//        
//        $subject = "Thank you for connecting with us on Mansionly.com!";
//
//        /*[start:: Check mail is once already send or not]*/
//       if($this->session->userdata('session_enquiry_flag')){
//          // echo "if session set";
//       }
//       else{
//       //    echo "else";
//               $name = $requestData['name'];
//               $to_email = $requestData['email_id'];
//	       $MessageStr = "";
//	       $MessageStr = '<div style="width:100%; float:left;">
//                    <p style="color:#000;">Hello '.$name.' ,</p>
//                    <p style="color:#000;">Thank you for connecting with us!</p>
//                    <p style="color:#000;">We are delighted to have you on-board in our journey to Welcome Fine Living.</p>
//                    <p style="color:#000;">We have noted your request and will call you back / write to you shortly to discuss your requirements.</p>
//                    <p style="margin:50px 0px 0px 0px; color:#000;">Best Regards,</p>
//                    <p style="color:#000;" >Team Mansionly</p>
//                  </div>'; 
//	        /*[set session to Check mail is once already send or not]*/
//                $this->session->set_userdata('session_enquiry_flag','1');
//                $parameter = "enquiry";               
//	        $this->sendEmailNew($to_email, $subject, $MessageStr,$parameter);
//	    
//            }
//        /*[End:: Check mail is once already send or not]*/
//
//    }
    
//    public function signUpEmail($requestData,$userPassword='')
//    {                            
//     //  print_r($requestData);
//
//        $MessageStr = "";
//        $MessageStr = '<div style="width:100%; float:left;">
//                    <p style="color:#000;">Hello '. $requestData['customer_name'].' ,</p>
//                    <p style="color:#000;">Thank you for registering yourself on Mansionly - India\'s premier platform for premier design and global decore.</p>
//                    <p style="color:#000;">We are delighted to have you onboard in our journey to Welcome Fine Living.</p>
//                    
//                    <p style="margin:50px 0px 0px 0px; color:#000;">Your Login Details - </p>
//                    <p  style="margin:5px 0px 0px 0px; v">User Name : <a href="#" style="color:#39F; text-decoration:none;">'. $requestData['customer_email'].'</a> </p>';
//                    if($userPassword != '')
//                     {
//                       $MessageStr .= '<p  style="margin:5px 0px 30px 0px; color:#000;"> Password  : <strong>'.$userPassword.'</strong> </p>';
//                     }else{
//                        $MessageStr .= '<p  style="margin:5px 0px 30px 0px; color:#000;"> Password  : <strong>'.$requestData['customer_password'].'</strong> </p>';
//                     }
//                 $MessageStr .=   '<p style="margin:50px 0px 0px 0px; color:#000;">We are delighted to serve you</p>
//                    <p style="color:#000;" >Team Mansionly</p>
//                  </div>';        
//        $parameter = "signup";
//        $orderResult = $this->sendEmailNew($requestData['customer_email'],'Thank you for registering on Mansionly!',$MessageStr,$parameter);
//    }
    
//    public function sendEmailNew($to,$subject,$message,$parameter="")
//	{    
//           
//            
//                $message_header="";
//                if($parameter != 'sales'){
//                $message_header ='<html lang="en">
//                <head>
//                <meta charset="utf-8">
//                <meta http-equiv="X-UA-Compatible" content="IE=edge">
//
//                <title>Email</title>
//                </head>
//                <body>
//                <div class="wrpper" style="width:90% margin:0px auto; font-family:Arial, Helvetica, sans-serif">
//                <meta name="viewport" content="width=device-width, initial-scale=1">
//                  <header style="text-align: center;">
//                <div style="float:left; width:100%; background:#f7f5f5; padding-bottom:10px; margin-bottom:20px;"> 
//                <div style="text-align: center; width:100%;"> 
//                <a class="logo" href="'.base_url().'" target="_blank" style="display:block; padding:10px 0px 3px 0px;"> <img src="'.base_url().SitePath.'assets/img/logo.png" width="175"></a> 
//                </div>
//
//                <a href="'.base_url().'all-designer?q=d&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px; border-right: 1px solid #666; margin:5px 0px;"> DESIGNERS</a> 
//                <a href="'.base_url().'execution-gallery/all?q=e&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> EXECUTION GALLERY </a> 
//                <a href="'.base_url().'all-categories?q=l&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> LIFESTYLE PRODUCTS</a>
//                <a href="https://mansionly.com/magazine/" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> MAGAZINE</a>
//                <a href="'.base_url().'signin?ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 4px; margin:5px 2px;"> MY ACCOUNT</a>
//                </div>
//                </header>';
//                }
//                $message_content = $message;
//                $message_footer="";
//                if($parameter != 'sales'){
//                $message_footer ='<div style="width:100%; float:left; padding:15px 10px; min-height:100px; margin:50px 0px 0px 0px; box-sizing:border-box; border-top: solid 1px #ccc; text-align:center;">
//                        <p>';
//                        $table = "social";
//                        $condition = array('status' => '1');
//                        $social_media_list = $this->Md_database->getData($table,'social_id,social_name,statusck,social_value,status',$condition, 'social_id');
//                
//                    foreach ($social_media_list as $row) {
//                        if($row['social_name']== "facebook"){
//                        $message_footer .= '<a href="'.$row['social_value'].'" target="_blank"  style=" text-decoration:none;">
//                                            <img src="'.base_url().SitePath.'assets/img/fb.png" style="display:inline-block; vertical-align:middle; margin:0px 15px 0px 0px; width="20px;" "> 
//                                            </a> ';
//                        }
//                         if($row['social_name']== "twitter"){
//                        $message_footer .= '<a href="'.$row['social_value'].'"  target="_blank" style=" text-decoration:none;">
//                                <img src="'.base_url().SitePath.'assets/img/twt.png" style="display:inline-block; margin:0px 15px 0px 0px; vertical-align:middle; width="20px"> 
//                               </a>'; 
//                         }
//                        if($row['social_name']== "pinterest"){
//                        $message_footer .='<a href="'.$row['social_value'].'" target="_blank" style=" text-decoration:none;">
//                                <img src="'.base_url().SitePath.'assets/img/pint.png" style="display:inline-block; margin:0px 15px 0px 0px; vertical-align:middle; width="20px"> 
//                               </a>';
//                        }
//                        if($row['social_name']== "youtube"){
//                        $message_footer .='<a href="'.$row['social_value'].'" target="_blank" style=" text-decoration:none;"> 
//                                <img src="'.base_url().SitePath.'assets/img/yt.png" style="display:inline-block; vertical-align:middle; width="20px">
//                               </a>';
//                        }
//                    }
//                   $message_footer .='</p>
//                        <p style="font-size:12px; margin:10px 0px;">care@mansionly.com | Studio 108 IHDP Business Park Sector 127 Noida, 
//                          Uttar Pradesh<br>
//                          All contents copyright2017 Mansionly</p>
//                      </div>
//                    </div>
//                    <style>
//                    @media only screen and (max-width : 780px) {
//                    .wrpper	{ width:100% !important; padding:0px 10px;}
//                    a.logo {float:none !important; display:block!important; width:100% }
//                    header a {  margin: 0px !important;  padding: 3px  5px !important;  float:none;  width: 100%; font-size:12px}
//                    footer{ padding:10px !important;}
//                    p{ font-size:14px;}
//                    body{ margin:0px; padding:0px;}
//                    *{ box-sizing:border-box;}
//                    }
//
//                    </style>
//                    </body>
//                    </html>';  
//                }
//                $message_string ="";
//                $message_string .=$message_header;
//                $message_string .=$message_content;
//                $message_string .=$message_footer;
//               
//		$config = Array(
//		'protocol' => 'smtp',
//		'smtp_host' => 'mail.agilistgroup.com',
//		'smtp_port' => '25',
//		'smtp_user' => 'dev@agilistgroup.com',
//		'smtp_pass' => 'A@agilist2000',
//		'mailtype'  => 'html',
//		'charset'   => 'iso-8859-1',
//		'validate'  => false,
//		);
//                
//                $table = 'settings';
//                $condition = array('flag_id'=>'1','setting_name'=>'site_email');
//                $setting = $this->Md_database->getData($table,'setting_value',$condition,'','');
//                
//                $bcc_email = $setting[0]['setting_value'];
//		//$this->load->library('email');
//		$this->email->initialize($config);
//		$this->email->set_newline("\r\n");
//
//		$this->email->from('noreply@mansionly.com', 'Mansionly');
//		//$this->email->to('testing1@yopmail.com');//$to
//		//$this->email->to('admin@mansionly.com');//$to
//		$this->email->to($to);//$to
//		$this->email->bcc($bcc_email);
//		//$this->email->to('sachinkumar@agilistgroup.com');
//        //$this->email->bcc('amanrajvanshi@hotmail.com');
//
//		$this->email->subject($subject);
//		//$this->email->subject($subject -> unique_oid . ' - ' . $subject -> formtitle);
//		$this->email->message($message_string);
//
//		$result = $this->email->send();
//
//		if ($result == true)
//            return "Email Sent";//"Email Sent";
//		else
//            echo $this->email->print_debugger();
//	}

}
