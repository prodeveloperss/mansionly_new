<?php
class Cn_customer extends CI_Controller
{
	private $_code = 200;
	public $_content_type = "application/json";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Md_customer');
		$this->load->model('Md_database');
		$this->load->library('upload');
                $this->session_management_lib->index();

        //$this->load->library('layout', 'layout');
        $this->load->helper('url');
	}
	
	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}

	public function response($type,$data,$status,$resData=array()){
		$this->_code = ($status)?$status:200;
		$this->set_headers();
		$msg['status']=$status;
		$msg['type']=$type;
		$msg['msg']=$data;
		$msg['data']=$resData;
		echo json_encode($msg);
		exit;
	}

	private function set_headers(){
		header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
		header("Content-Type:".$this->_content_type);
	}

	private function get_status_message(){
		$status = array(
					200 => 'OK',
					201 => 'Created',
					202 => 'Accepted',
					203 => 'Non-Authoritative Information',
					204 => 'No Content',
					302 => 'Found',
					303 => 'See Other',
					304 => 'Not Modified',
					305 => 'Use Proxy',
					306 => '(Unused)',
					307 => 'Temporary Redirect',
					400 => 'Bad Request',
					401 => 'Unauthorized',
					404 => 'Not Found',
					405 => 'Method Not Allowed',
					406 => 'Not Acceptable',
					408 => 'Request Timeout',
					500 => 'Internal Server Error',
					501 => 'Not Implemented',
					502 => 'Bad Gateway',
					503 => 'Service Unavailable',
					504 => 'Gateway Timeout',
					505 => 'HTTP Version Not Supported');
		return ($status[$this->_code])?$status[$this->_code]:$status[500];
	}

	public function customerVarification()
	{
		$requestData = array();
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_email'] = $this->input->get('emailid');

		}
		else
		{
			$requestData['customer_email'] = $this->input->post('emailid');
		}

		$requestData['customer_username'] = '';
		$requestData['customer_phone'] = '';
		$requestData['customer_mobile'] = '';
		$result = $this->Md_customer->checkIfAlreadyExist($requestData);

		$this->response('success','Cart Products', 200, $result);


	}
	
	function customerRegister()
	{
            
        $requestData = array();
        $ret= 0;
        $userPassword= '';

        if($this->get_request_method() != "POST")
        {
            $this->response('error', 'method not supported', 405, $requestData);
            return;
        }

		$requestData['customer_name'] = $this->input->post('fullName');
		$requestData['customer_dob'] = $this->input->post('dob');
		$requestData['customer_address'] = $this->input->post('address');
		$requestData['customer_city_id'] = $this->input->post('city');

        // echo 'cname'.$requestData['customer_name'];

		if (($this->input->post('username')))
			$requestData['customer_username'] = $this->input->post('username');
		else
			$requestData['customer_username'] = $this->input->post('email');

		if ($this->input->post('password')){  
			$requestData['customer_password'] = md5($this->input->post('password'));
			$userPassword=$this->input->post('password');
			}
		else{
			$requestData['customer_password'] = md5($this->input->post('mobile'));
			$userPassword=$this->input->post('mobile');
		}
			


		//$requestData['customer_password'] = sha1($this->createRandomPassword());

		$requestData['customer_occupation'] = $this->input->post('occupation');
		$requestData['customer_about_me'] = $this->input->post('aboute_me');
		$requestData['customer_favourite_style'] = $this->input->post('favourite_style');
		$requestData['remote_address'] = $this->input->post('remote_address');
		$requestData['status'] = '1'; // default status pending
		$requestData['on_date'] = date('Y-m-d H:i:s'); //'now()';
		$requestData['customer_email'] = $this->input->post('email');
		$requestData['customer_phone'] = $this->input->post('phone');
		$requestData['customer_mobile'] = $this->input->post('mobile');
                $requestData['isexternal_users'] = $this->input->post('isexternal_users');

		// Need to validate what all is required at minimum

		$check = $this->Md_customer->checkIfAlreadyExist($requestData);

        //we have use 'isexternal_users'= 0 here at the place of false because false don't match the value
        if ($check == true && $requestData['isexternal_users'] == 0)
		{
            //manual user already exist
			$this->response('error', 'Username and/or Email and/or phone number already registered', 400, $requestData);
			return;
		}
		else if($check == false && $requestData['isexternal_users'] == 0)
        {
              //manual user not exist, then register as new user
            $ret = $this->Md_customer->registerCustomer($requestData);
            $customer_id = $ret;
            /*[start::Insert data into customer action log}*/        
            if(!empty($this->input->post('fullName'))){
                $comment ="Added Full Name - ".$this->input->post('fullName');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('email'))){
                $comment ="Added Email - ".$this->input->post('email');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('mobile'))){
                $comment ="Added Mobile - ".$this->input->post('mobile');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('phone'))){
                $comment ="Added Phone - ".$this->input->post('phone');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('address'))){
                $comment ="Added Address - ".$this->input->post('address');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('dob'))){
                $comment ="Added DOB - ".$this->input->post('dob');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
             
            
            
            /*[End::Insert data into customer action log}*/       

                    
                    
         
		}
        else if($check == true && $requestData['isexternal_users'] == 1)
        {
            //social user already exist
            //$requestData = $this->Md_customer->getCustomerDetails('customer_id, customer_name', array('customer_username'=>$requestData['customer_email']));

            $requestData = $this->Md_customer->getCustomerDetails('*', array('customer_username'=>$requestData['customer_email']));
            $this->response('success', 'User found', 200, $requestData);
            return;
        }
        else{
            //social user not exist, then register as new user
            $ret = $this->Md_customer->registerCustomer($requestData);
            $customer_id = $ret;
            /*[start::Insert data into customer action log}*/        
            if(!empty($this->input->post('fullName'))){
                $comment ="Added Full Name - ".$this->input->post('fullName');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('email'))){
                $comment ="Added Email - ".$this->input->post('email');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('mobile'))){
                $comment ="Added Mobile - ".$this->input->post('mobile');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('phone'))){
                $comment ="Added Phone - ".$this->input->post('phone');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('address'))){
                $comment ="Added Address - ".$this->input->post('address');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('dob'))){
                $comment ="Added DOB - ".$this->input->post('dob');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
             
            
            
            /*[End::Insert data into customer action log}*/       

            $this->response('success', 'User Created', 200,  $ret );
            return;
        }

		if ($ret == 0)
		{
			$this->response('error', 'User could not be registered. Please contact system administrator', 400, $requestData);
			return;
		}
		else
		{
            //send user registration email
            $signUpEmailResult = $this->signUpEmail($requestData,$userPassword);

			$requestData['customerId'] = $ret;
			$this->response('success', 'User registered', 200, $requestData);
			return;
		}
	}
	
	function checkUserExistOrNot()
	{
            
		$requestData  = array();
		$userPassword = '';

        if($this->get_request_method() != "POST")
        {
            $this->response('error', 'method not supported', 405, $requestData);
            return;
        }

        $requestData['customer_name'] = $this->input->post('name');
        if (($this->input->post('username')))
            $requestData['customer_username'] = $this->input->post('username');
        else
		{
			if($this->input->post('email')){
				$requestData['customer_username'] = $this->input->post('email');
			}else if($this->input->post('phone')){
				$requestData['customer_username'] = $this->input->post('phone');
			}else if($this->input->post('mobile')){
				$requestData['customer_username'] = $this->input->post('mobile');
			}
		}
        if ($this->input->post('password')){  
            $requestData['customer_password'] = md5($this->input->post('password'));
            $userPassword=$this->input->post('password');
            }
        else{
			 $requestData['customer_password'] = md5($this->input->post('mobile'));
			 $userPassword=$this->input->post('mobile');
		}
           
        if($this->input->post('email'))
		{
			$requestData['customer_email'] = $this->input->post('email');
		} 
		else 
		{
			$requestData['customer_email'] = '';
		}
        
		$requestData['on_date'] = 'now()';
		
		if($this->input->post('phone'))
		{
			$requestData['customer_phone'] = $this->input->post('phone');
		} 
		else 
		{
			$requestData['customer_phone'] = '';
		}
		
		if($this->input->post('mobile'))
		{
			$requestData['customer_mobile'] = $this->input->post('mobile');
		}
		else 
		{
			$requestData['customer_mobile'] = '';
		}		
		
		//print_r($requestData);
		//return;
		
		$check = $this->Md_customer->checkIfAlreadyExist($requestData);
		$OrderData = array();
        if($check){
            

            //for get existing customerId
           //$requestData = $this->Md_customer->getCustomerDetails('*', array('customer_username'=>$requestData['customer_email']));
            $requestData = $this->Md_customer->getCustomerDetails('*', array('customer_id'=>$check[0]->customer_id));
            $customerId=json_encode($requestData);
            $customerId=json_decode($customerId);
	
	
						
			//Update user new details if any
			//echo "val=>".var_dump($requestData);
			//return;
            //echo "Welcome " . $customerId -> customer_id;

            //for save order details
            $OrderData["customer_id"]=$customerId -> customer_id;

            if (($this->input->post('order_type')))
                $OrderData['order_type'] = $this->input->post('order_type');//post('4');
            else
                $OrderData['order_type'] ='';

            if (($this->input->post('package_id')))
                $OrderData['package_id'] = $this->input->post('package_id');
            else
                $OrderData['package_id'] ='';
//
//            if (($this->input->post('scheme')))
//                $OrderData['scheme'] = $this->input->post('scheme');
//            else
//                $OrderData['scheme'] ='';
//
//            if (($this->input->post('apartment')))
//                $OrderData['apartment'] = $this->input->post('apartment');
//            else
//                $OrderData['apartment'] ='';
//
//            if (($this->input->post('flat')))
//                $OrderData['flat'] = $this->input->post('flat');
//            else
//                $OrderData['flat'] ='';

            if (($this->input->post('special_request')))
                $OrderData['special_request'] = $this->input->post('special_request');
            else
                $OrderData['special_request'] ='';

            if (($this->input->post('master_design_name')))
                $OrderData['master_design_name'] = $this->input->post('master_design_name');
            else
                $OrderData['master_design_name'] ='';

            if (($this->input->post('master_execution_portfolio')))
                $OrderData['master_execution_portfolio'] = $this->input->post('master_execution_portfolio');
            else
                $OrderData['master_execution_portfolio'] ='';

//            if (($this->input->post('advertised_price')))
//                $OrderData['advertised_price'] = $this->input->post('advertised_price');
//            else
//                $OrderData['advertised_price'] ='';

            $OrderData['pipeline_load_date'] = date('Y-m-d H:i:s');
            $OrderData['remote_address'] = $this->input->post('remote_address');//$this->input->ip_address();

            if (($this->input->post('designer_id')))
                $OrderData['designer_id'] = $this->input->post('designer_id');
            else
                $OrderData['designer_id'] ='';

            if (($this->input->post('design_id')))
                $OrderData['design_id'] = $this->input->post('design_id');
            else
                $OrderData['design_id'] ='';

            if (($this->input->post('design_name')))
                $OrderData['design_name'] = $this->input->post('design_name');
            else
                $OrderData['design_name'] ='';

            if (($this->input->post('executioner_id')))
                $OrderData['executioner_id'] = $this->input->post('executioner_id');
            else
                $OrderData['executioner_id'] ='';

            $OrderData['status'] = '1';

            if (($this->input->post('marketplace_comments')))
                $OrderData['marketplace_comments'] = $this->input->post('marketplace_comments');
            else
                $OrderData['marketplace_comments'] ='';

            $OrderData['order_channel_type'] = 'Web';
            //$OrderData['crm_status'] = '2';

           // $OrderData['unique_oid'] = $this->Md_customer->getUniqueOrderID();

            if (($this->input->post('city')))
                $OrderData['city_id'] = $this->input->post('city');
            else
                $OrderData['city_id'] ='';

//            if (($this->input->post('apartment_address')))
//                $OrderData['apartment_address'] = $this->input->post('apartment_address');
//            else
//                $OrderData['apartment_address'] ='';
			
//			if ($this->input->post('form_type'))
//				$OrderData['form_type'] = $this->input->post('form_type');
//            else
//                $OrderData['form_type'] ='';

            //$flatId = $this->input->post('flat_id');
            //$apartmentId = $this->input->post('apartment_id');
            //$customerId = $this->input->post('customer_id');
            //$customerData = $this->Md_customer->getCustomerDetails('*', array('customer_id'=>$customerId));

            // $login = $this->customerLogin($requestData);

            //for login user
            //$_SESSION["customerName"] =null;
            //$_SESSION["customerId"]=null;
            //$_SESSION["customerName"] = $customerId ->customer_name;
            //$_SESSION["customerId"]=$customerId ->customer_id;

            //save order details
            $customerIdVal = isset($_SESSION["customerId"])?$_SESSION["customerId"]:"" ;
			
			 if (($this->input->post('portfolioId')))
                $OrderData['execution_portfolio_id'] = $this->input->post('portfolioId');

//			 if (($this->input->post('formtitle')))
//                $OrderData['formtitle'] = $this->input->post('formtitle');
			  
            //echo "User is already registered for testing";
            //var_dump($customerIdVal);
			
                    $OrderData['leadGenFromSliderPageType'] = $_POST['leadGenFromSliderPageType'];
                    if(!empty($_POST['leadGenFromSliderPageUniqueId'])){
                    $OrderData['leadGenFromSliderPageUniqueId'] = $_POST['leadGenFromSliderPageUniqueId'];
                    }
                    $OrderData['leadGenFromSliderPageURL'] = $_POST['leadGenFromSliderPageURL'];
                    $OrderData['user_landing_page'] = $_POST['user_landing_page'];
                    $OrderData['campaign_utm_param'] = $_POST['utm'];
                    $OrderData['scheme'] = $_POST['scheme'];
		
			$cusomerphoneDetail['customer_id'] = $check[0]->customer_id;
			
			if($this->input->post('phone'))
			{
				$cusomerphoneDetail['customer_phone'] = $this->input->post('phone');
			}
			else{
				$cusomerphoneDetail['customer_phone'] = '';
			}
			if($this->input->post('mobile')){
			$cusomerphoneDetail['customer_mobile'] = $this->input->post('mobile');	
			} else {
				$cusomerphoneDetail['customer_mobile'] = '';
			}
			if($this->input->post('email')){
			$cusomerphoneDetail['customer_email'] = $this->input->post('email');
			}
			else{
				$cusomerphoneDetail['customer_email'] = '';
			}
			
         //   if($customerIdVal !="" && $customerIdVal !=null){
                
               
                //if user is already login

                //order data saved
                $orderSaveResult = $this->customerOrderSave_Quick($OrderData);
				if ($this->input->post('form_type') == 'home_request')
				{
					$_SESSION['get_started_form'] = "Request Sent";
				}
				
				// Check user's new phone mumber exist or not , if not exist then update number
				$customerMobilephone = $this->Md_customer->getCustomerMobileFull($cusomerphoneDetail);
                               
                                $mobile_array=array();
                                foreach($customerMobilephone as $array){
                                    $mobile_array[] = $array['customer_phone'];
                                }     
                                
				if ( (! in_array( $cusomerphoneDetail['customer_mobile'], $mobile_array)) )
				{
                                     
                                   if (!empty($cusomerphoneDetail['customer_mobile'])){	
                                    $newPhone['customer_id']    =  $cusomerphoneDetail['customer_id'];
                                    $newPhone['customer_phone'] =  $cusomerphoneDetail['customer_mobile'];	
                                    $results = $this->Md_customer->createCustomerPhone($newPhone);	
                                   }
                                    
                                }
                                
                              
				if ( (! in_array( $cusomerphoneDetail['customer_phone'], $mobile_array)) )
				{					
					if (!empty($cusomerphoneDetail['customer_phone'])){	
						     $newPhone['customer_id']    =  $cusomerphoneDetail['customer_id'];
						     $newPhone['customer_phone'] =  $cusomerphoneDetail['customer_phone'];
						     $results = $this->Md_customer->createCustomerPhone($newPhone);
				
                                        }
                                }
				
				
				// Check user's new email exist or not , if not exist then update email
				$customerEmails = $this->Md_customer->getCustomerEmailFull($cusomerphoneDetail);
                                
                                $email_array=array();
                                foreach($customerEmails as $array){
                                    $email_array[] = $array['customer_email'];
                                } 
                                //print_r($email_array);die;
				if(! in_array($cusomerphoneDetail['customer_email'], $email_array))
				{
				   if (!empty($cusomerphoneDetail['customer_email'])){	
                                    $newEmail['customer_id']    =  $cusomerphoneDetail['customer_id'];
                                    $newEmail['customer_email'] =  $cusomerphoneDetail['customer_email'];			 			 
                                    $results =  $this->Md_customer->createCustomerEmail($newEmail);
                                   }
                                }
				
				
				
                //send order save email
              //  if($orderSaveResult =='Order saved successfully'){
                    //send order placed email
//                    if($this->input->post('email')){
//                    if($this->session->userdata('session_enquiry_flag')){}
//                    else{
//                     $emailSendResult = $this->placeOrderEmail($requestData,$OrderData);
//                    }
                    //echo 'Email Send';
			//		}
            //    }
                
 //           }
//            else {
//                
//               
//				
//				if(($this->input->post('phone') || $this->input->post('mobile')) && ($this->input->post('email') == '' && $this->input->post('email') == null ))
//				{
//					$orderSaveResult = $this->customerOrderSave_Quick($OrderData);
//                                        
//					if ($this->input->post('form_type') == 'home_request')
//					{
//						$_SESSION['get_started_form'] = "Request Sent";
//					}
//					$_SESSION["RequestData"]=$requestData;
//					//return;
//				}
//				else
//				{
//					
//					//if user not login
//					$_SESSION["OrderData"]=$OrderData;
//					$_SESSION["ExistUserNewinfo"] = $cusomerphoneDetail;
//					//var_dump($OrderData);
//					
//				}
//				
//            }
        
        //    $_SESSION["RequestData"]=$requestData;
            
           /*[start:: Check user already logged in or not]*/
//            if(!empty($_SESSION["customerId"])){
//            $this->response('success','User already logged in',200,$requestData);
//            return;
//            }
            /*[End:: Check user already logged in or not]*/
//            else{
//            $this->response('success','User is already registered',200,$requestData);
//            return;
//            }
            //echo "User is already registered";
           
           //$this->response('success','order saved successfully. ',200,$requestData);
            echo 'Existing User'.'|*|*|';
            echo $orderSaveResult.'|*|*|';
            echo "order saved succesfully";die;
//            return;
        } else {
            //not exist (new user)
//echo "else";die;
            //register customer as new customer
            $requestData['remote_address'] = $this->input->post('remote_address');
            $requestData['status'] = '1'; // default status pending
            $requestData['on_date'] = date('Y-m-d H:i:s'); //'now()';
            $ret = $this->Md_customer->registerCustomer($requestData);
            
            $customer_id = $ret;
            /*[start::Insert data into customer action log]*/        
            if(!empty($this->input->post('fullName'))){
                $comment ="Added Full Name - ".$this->input->post('fullName');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('email'))){
                $comment ="Added Email - ".$this->input->post('email');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('mobile'))){
                $comment ="Added Mobile - ".$this->input->post('mobile');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('phone'))){
                $comment ="Added Phone - ".$this->input->post('phone');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('address'))){
                $comment ="Added Address - ".$this->input->post('address');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
            if(!empty($this->input->post('dob'))){
                $comment ="Added DOB - ".$this->input->post('dob');
                $table = "customer_details_map_action_logs"; 
                $data=array('customer_id'=>$customer_id,
                            'actor_type'=>'Customer',
                            'actor_id'=>$customer_id,
                            'comment'=>$comment,
                            'ondatetime'=> date('Y-m-d H:i:s')
                            );
                $this->Md_database->insertData($table, $data); 

            }        
             
            
            
            /*[End::Insert data into customer action log]*/       

            // $this->response('success', 'User Created', 200,  $ret );

            //send user registration email
			if($this->input->post('email')){
				$orderResult = $this->signUpEmail($requestData,$userPassword);
			}
            //save order details
            $OrderData["customer_id"]=$ret;

            if (($this->input->post('order_type')))
                $OrderData['order_type'] = $this->input->post('order_type');//post('4');
            else
                $OrderData['order_type'] ='';

            if (($this->input->post('package_id')))
                $OrderData['package_id'] = $this->input->post('package_id');
            else
                $OrderData['package_id'] ='';

            if (($this->input->post('scheme')))
                $OrderData['scheme'] = $this->input->post('scheme');
            else
                $OrderData['scheme'] ='';

            if (($this->input->post('apartment')))
                $OrderData['apartment'] = $this->input->post('apartment');
            else
                $OrderData['apartment'] ='';

            if (($this->input->post('flat')))
                $OrderData['flat'] = $this->input->post('flat');
            else
                $OrderData['flat'] ='';

            if (($this->input->post('special_request')))
                $OrderData['special_request'] = $this->input->post('special_request');
            else
                $OrderData['special_request'] ='';

            if (($this->input->post('master_design_name')))
                $OrderData['master_design_name'] = $this->input->post('master_design_name');
            else
                $OrderData['master_design_name'] ='';

            if (($this->input->post('master_execution_portfolio')))
                $OrderData['master_execution_portfolio'] = $this->input->post('master_execution_portfolio');
            else
                $OrderData['master_execution_portfolio'] ='';

            if (($this->input->post('advertised_price')))
                $OrderData['advertised_price'] = $this->input->post('advertised_price');
            else
                $OrderData['advertised_price'] ='';

            $OrderData['on_date'] = date('Y-m-d H:i:s');
            //$OrderData['remote_address'] = $this->input->ip_address();
            $OrderData['remote_address'] = $this->input->post('remote_address');

            if (($this->input->post('designer_id')))
                $OrderData['designer_id'] = $this->input->post('designer_id');
            else
                $OrderData['designer_id'] ='';

            if (($this->input->post('design_id')))
                $OrderData['design_id'] = $this->input->post('design_id');
            else
                $OrderData['design_id'] ='';

            if (($this->input->post('design_name')))
                $OrderData['design_name'] = $this->input->post('design_name');
            else
                $OrderData['design_name'] ='';

            if (($this->input->post('designer_name')))
                $OrderData['designer_name'] = $this->input->post('designer_name');
            else
                $OrderData['designer_name'] ='';

            if (($this->input->post('executioner_id')))
                $OrderData['executioner_id'] = $this->input->post('executioner_id');
            else
                $OrderData['executioner_id'] ='';

            $OrderData['status'] = '1';

            if (($this->input->post('marketplace_comments')))
                $OrderData['marketplace_comments'] = $this->input->post('marketplace_comments');
            else
                $OrderData['marketplace_comments'] ='';

            $OrderData['order_channel_type'] = 'Web';
            $OrderData['crm_status'] = '2';

            //$OrderData['unique_oid'] = $this->Md_customer->getUniqueOrderID();

            if (($this->input->post('city')))
                $OrderData['city'] = $this->input->post('city');
            else
                $OrderData['city'] ='';

            if (($this->input->post('apartment_address')))
                $OrderData['apartment_address'] = $this->input->post('apartment_address');
            else
                $OrderData['apartment_address'] ='';

            //$flatId = $this->input->post('flat_id');
            //$apartmentId = $this->input->post('apartment_id');
            //$customerId = $this->input->post('customer_id');
            //$customerData = $this->Md_customer->getCustomerDetails('*', array('customer_id'=>$customerId));

			 if (($this->input->post('portfolioId')))
                $OrderData['execution_portfolio_id'] = $this->input->post('portfolioId');

//			if (($this->input->post('formtitle')))
//                $OrderData['formtitle'] = $this->input->post('formtitle');
              $OrderData['leadGenFromSliderPageType'] = $_POST['leadGenFromSliderPageType'];
              $OrderData['leadGenFromSliderPageUniqueId'] = $_POST['leadGenFromSliderPageUniqueId'];
              $OrderData['leadGenFromSliderPageURL'] = $_POST['leadGenFromSliderPageURL'];
              $OrderData['user_landing_page'] = $_POST['user_landing_page'];
              $OrderData['campaign_utm_param'] = $_POST['utm'];
              $OrderData['scheme'] = $_POST['scheme'];
              $orderInfo=$OrderData;
            //echo 'val=>'.var_dump($orderInfo);
            //save order details
            $orderSaveResult = $this->customerOrderSave_Quick($OrderData);
			if ($this->input->post('form_type') == 'home_request')
			{
				$_SESSION['get_started_form'] = "Request Sent";
			}
			
            //send order placed email
//			if($this->input->post('email')){
//                        if($this->session->userdata('session_enquiry_flag')){}
//                        else{
//                        $orderResult = $this->placeOrderEmail($requestData,$orderInfo);
//                        }
//			}
 //           return;
            echo 'New User'.'|*|*|';
            echo $orderSaveResult.'|*|*|';
            echo "order saved succesfully";die;
        }
	}
	
	function customerOrderSave_Quick($OrderData)
	{
		$requestData = array();

       

		$requestData['customer_id'] = $OrderData['customer_id'];
		//$requestData['order_type'] = $OrderData['order_type'];
                
		$requestData['package_id'] = $OrderData['package_id'];

//		$requestData['scheme'] = $OrderData['scheme'];
//		$requestData['apartment'] = $OrderData['apartment'];
//		$requestData['flat'] = $OrderData['flat'];
		$requestData['special_request'] = $OrderData['special_request'];
		$requestData['master_design_name'] = $OrderData['master_design_name'];
		
		if(false)
			$requestData['master_execution_portfolio'] = $OrderData['master_execution_portfolio'];
		
		
		if(isset($OrderData["execution_portfolio_id"]))
			$requestData["execution_portfolio_id"] = $OrderData["execution_portfolio_id"];
		
		
		//$requestData['advertised_price'] = $OrderData['master_execution_portfolio'];
		$requestData['pipeline_load_date'] = date('Y-m-d H:i:s');
		$requestData['remote_address'] = $OrderData['remote_address'];//$this->input->ip_address();
		$requestData['designer_id'] = $OrderData['designer_id'];
               //$requestData['design_name'] = $OrderData['design_name'];
//		$requestData['executioner_id'] = $OrderData['executioner_id'];
		$requestData['status'] = '1';
		//$requestData['marketplace_comments'] = $OrderData['marketplace_comments'];
		$requestData['order_channel_type'] = 'Web';
		
		$customerId = $OrderData['customer_id'];

		$customerData = $this->Md_customer->getCustomerDetails('*', array('customer_id'=>$customerId));
		
		$requestData['leadGenFromSliderPageURL'] = $OrderData['leadGenFromSliderPageURL'];
		$requestData['leadGenFromSliderPageType'] = $OrderData['leadGenFromSliderPageType'];
                if(!empty($OrderData['leadGenFromSliderPageUniqueId'])){
		$requestData['leadGenFromSliderPageUniqueId'] = $OrderData['leadGenFromSliderPageUniqueId'];
                }
		$requestData['user_landing_page'] = $OrderData['user_landing_page'];
		$requestData['campaign_utm_param'] = $OrderData['campaign_utm_param'];
		$requestData['scheme'] = $OrderData['scheme'];
		
		/*[start:check scheme record already available or not]*/
        $resultFbCampaignDtls = $this->Md_customer->getSchemeDetails($requestData['scheme']);
        if(!empty($resultFbCampaignDtls)){
			$requestData['apartment_name'] = $resultFbCampaignDtls[0]['campaign_name'];
		}		
		/*[end:check scheme record already available or not]*/
		
		
		$orderId = $this->Md_customer->createCustomerOrder($requestData);
                
                
		
		//print_r($orderId);die;
		 
		$orderData = array();
		if (!empty($orderId))
		{
//                    $MarketCommentData['order_id'] = $orderId;
//                    $MarketCommentData['comment'] = $OrderData['marketplace_comments'];
//                    $MarketCommentData['actor_by'] = '1';
//                    $MarketCommentData['ondatetime'] = date('Y-m-d H:i:s');
//                    $comment_id = $this->Md_customer->SaveCustomerComment($MarketCommentData);
//                    
//			$orderDetails = $this->Md_customer->getOrderDetails('*', array('o_id'=>$orderId));
//                        
//			$orderData['order_uid'] = $orderDetails['unique_oid'];
//                        $_SESSION["OrderData"] =null;
//                        
//                        
//                       
//
//		        
//                      /*[start:Send email to the sales team]*/
//			$UserDetails = $this->Md_customer->getCustomerinfo($orderDetails['customer_id']);
//                        
//                        $table = 'settings';
//                        $condition = array('flag_id'=>'1','setting_name'=>'site_sales_email');
//                        $setting = $this->Md_database->getData($table,'setting_value',$condition,'','');
//             
//                        
//                        $to =  $setting[0]['setting_value'];    
//                        $message = "";
//                        $subject = 'New Lead '.$orderDetails['unique_oid'].' Created';
//                        $message .= '<html><body>
//                                    <p>Please note that a new lead has been created in the system.</p> 
//                                    <p><b>Lead ID - </b>'.$orderDetails['unique_oid'].'</p>
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
                         
                      /*[End:Send email to the sales team]*/

          //  return "Order saved successfully";
            return $orderId;
            
		}
		else
		{
            echo "Order could not be saved";
			//$this->response('error','Order could not be saved',200,$orderData);
		}
	}
	
//	public function placeOrderEmail($requestData,$OrderData)
//    {
//       // print_r($requestData);
//        $result=json_encode($requestData);
//        $result=json_decode($result);
//
//        $resultDesign=json_encode($OrderData); 
//        $resultDesign=json_decode($resultDesign);
//        
//        $subject = "Thank you for connecting with us on Mansionly.com!";
//
//        /*[start:: Check mail is once already send or not]*/
//       if($this->session->userdata('session_enquiry_flag')){
//          // echo "if session set";
//       }
//       else{
//       //    echo "else";
//               $name = $result->customer_name;
//               $to_email = $result->customer_username;
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

	
	public function sendEmailNew($to,$subject,$message,$parameter="")
	{    
           
            
                $message_header="";
                if($parameter != 'sales'){
                $message_header ='<html lang="en">
                <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <title>Email</title>
                </head>
                <body>
                <div class="wrpper" style="width:90% margin:0px auto; font-family:Arial, Helvetica, sans-serif">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                  <header style="text-align: center;">
                <div style="float:left; width:100%; background:#f7f5f5; padding-bottom:10px; margin-bottom:20px;"> 
                <div style="text-align: center; width:100%;"> 
                <a class="logo" href="'.base_url().'" target="_blank" style="display:block; padding:10px 0px 3px 0px;"> <img src="'.base_url().SitePath.'assets/img/logo.png" width="175"></a> 
                </div>

                <a href="'.base_url().'all-designer?q=d&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px; border-right: 1px solid #666; margin:5px 0px;"> DESIGNERS</a> 
                <a href="'.base_url().'execution-gallery/all?q=e&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> EXECUTION GALLERY </a> 
                <a href="'.base_url().'all-categories?q=l&ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> LIFESTYLE PRODUCTS</a>
                <a href="https://mansionly.com/magazine/" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 10px;border-right: 1px solid #666; margin:5px 0px;"> MAGAZINE</a>
                <a href="'.base_url().'signin?ref2='.$parameter.'" target="_blank" style="display:inline-block; font-size:12px; color:#000; text-decoration:none; padding:0px 4px; margin:5px 2px;"> MY ACCOUNT</a>
                </div>
                </header>';
                }
                $message_content = $message;
                $message_footer="";
                if($parameter != 'sales'){
                $message_footer ='<div style="width:100%; float:left; padding:15px 10px; min-height:100px; margin:50px 0px 0px 0px; box-sizing:border-box; border-top: solid 1px #ccc; text-align:center;">
                        <p>';
                        $table = "social";
                        $condition = array('status' => '1');
                        $social_media_list = $this->Md_database->getData($table,'social_id,social_name,statusck,social_value,status',$condition, 'social_id');
                
                    foreach ($social_media_list as $row) {
                        if($row['social_name']== "facebook"){
                        $message_footer .= '<a href="'.$row['social_value'].'" target="_blank"  style=" text-decoration:none;">
                                            <img src="'.base_url().SitePath.'assets/img/fb.png" style="display:inline-block; vertical-align:middle; margin:0px 15px 0px 0px; width="20px;" "> 
                                            </a> ';
                        }
                         if($row['social_name']== "twitter"){
                        $message_footer .= '<a href="'.$row['social_value'].'"  target="_blank" style=" text-decoration:none;">
                                <img src="'.base_url().SitePath.'assets/img/twt.png" style="display:inline-block; margin:0px 15px 0px 0px; vertical-align:middle; width="20px"> 
                               </a>'; 
                         }
                        if($row['social_name']== "pinterest"){
                        $message_footer .='<a href="'.$row['social_value'].'" target="_blank" style=" text-decoration:none;">
                                <img src="'.base_url().SitePath.'assets/img/pint.png" style="display:inline-block; margin:0px 15px 0px 0px; vertical-align:middle; width="20px"> 
                               </a>';
                        }
                        if($row['social_name']== "youtube"){
                        $message_footer .='<a href="'.$row['social_value'].'" target="_blank" style=" text-decoration:none;"> 
                                <img src="'.base_url().SitePath.'assets/img/yt.png" style="display:inline-block; vertical-align:middle; width="20px">
                               </a>';
                        }
                    }
                   $message_footer .='</p>
                        <p style="font-size:12px; margin:10px 0px;">care@mansionly.com | Studio 108 IHDP Business Park Sector 127 Noida, 
                          Uttar Pradesh<br>
                          All contents copyright2017 Mansionly</p>
                      </div>
                    </div>
                    <style>
                    @media only screen and (max-width : 780px) {
                    .wrpper	{ width:100% !important; padding:0px 10px;}
                    a.logo {float:none !important; display:block!important; width:100% }
                    header a {  margin: 0px !important;  padding: 3px  5px !important;  float:none;  width: 100%; font-size:12px}
                    footer{ padding:10px !important;}
                    p{ font-size:14px;}
                    body{ margin:0px; padding:0px;}
                    *{ box-sizing:border-box;}
                    }

                    </style>
                    </body>
                    </html>';  
                }
                $message_string ="";
                $message_string .=$message_header;
                $message_string .=$message_content;
                $message_string .=$message_footer;
               
		$config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'mail.agilistgroup.com',
		'smtp_port' => '25',
		'smtp_user' => 'dev@agilistgroup.com',
		'smtp_pass' => 'A@agilist2000',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'validate'  => false,
		);
                
                $table = 'settings';
                $condition = array('flag_id'=>'1','setting_name'=>'site_email');
                $setting = $this->Md_database->getData($table,'setting_value',$condition,'','');
                
                $bcc_email = $setting[0]['setting_value'];
		//$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from('noreply@mansionly.com', 'Mansionly');
		//$this->email->to('testing1@yopmail.com');//$to
		//$this->email->to('admin@mansionly.com');//$to
		$this->email->to($to);//$to
		$this->email->bcc($bcc_email);
		//$this->email->to('sachinkumar@agilistgroup.com');
        //$this->email->bcc('amanrajvanshi@hotmail.com');

		$this->email->subject($subject);
		//$this->email->subject($subject -> unique_oid . ' - ' . $subject -> formtitle);
		$this->email->message($message_string);

		$result = $this->email->send();

		if ($result == true)
            return "Email Sent";//"Email Sent";
		else
            echo $this->email->print_debugger();
	}
	
	
	
	public function signUpEmail($requestData,$userPassword='')
    {                            
        $result=json_encode($requestData);
        $result=json_decode($result); 

        $MessageStr = "";
        $MessageStr = '<div style="width:100%; float:left;">
                    <p style="color:#000;">Hello '. $result -> customer_name .' ,</p>
                    <p style="color:#000;">Thank you for registering yourself on Mansionly - India\'s premier platform for premier design and global decore.</p>
                    <p style="color:#000;">We are delighted to have you onboard in our journey to Welcome Fine Living.</p>
                    
                    <p style="margin:50px 0px 0px 0px; color:#000;">Your Login Details - </p>
                    <p  style="margin:5px 0px 0px 0px; v">User Name : <a href="#" style="color:#39F; text-decoration:none;">'. $result -> customer_email.'</a> </p>';
                    if($userPassword != '')
                     {
                       $MessageStr .= '<p  style="margin:5px 0px 30px 0px; color:#000;"> Password  : <strong>'.$userPassword.'</strong> </p>';
                     }else{
                        $MessageStr .= '<p  style="margin:5px 0px 30px 0px; color:#000;"> Password  : <strong>'.$result ->customer_password.'</strong> </p>';
                     }
                 $MessageStr .=   '<p style="margin:50px 0px 0px 0px; color:#000;">We are delighted to serve you</p>
                    <p style="color:#000;" >Team Mansionly</p>
                  </div>';        
        $parameter = "signup";
        $orderResult = $this->sendEmailNew($result -> customer_email,'Thank you for registering on Mansionly!',$MessageStr,$parameter);
    }

	
	function customerLogin()
	{
            
        $_SESSION["toaster_msg"] = "";
        $requestData = array();

		if($this->get_request_method() != "POST"){
			$this->response('error','method not supported', 405, $requestData);
			return;
		}

		$requestData = array();
		$requestData['customer_username'] = $this->input->post('username');
		$requestData['customer_password'] = $this->input->post('password');
                $orderSaveResult='';
		$authData = array();
		//$id = $this->Md_customer->customerValidate($requestData)
        //echo "val=>".var_dump($id);
		//return;
//                print_r($this->Md_customer->customerValidate($requestData));die;
		if($id = $this->Md_customer->customerValidate($requestData))
		{
			$this->CI =& get_instance();

			$authData = $this->Md_customer->getCustomerDetails('customer_id, customer_name, customer_photo', array('customer_id'=>$id));
                        //print_r($authData);die;
			$this->session->set_userdata($authData);
			

			$authData['session_id'] =  $this->session->__get('session_id');;
			$authData['cookie'] = $this->CI->config->item('sess_cookie_name');
                        
            //for bind session value
            $sessionVal=json_encode($authData);
            $sessionVal=json_decode($sessionVal);
            //echo "Welcome " . $sessionVal -> customer_name;

            $_SESSION["customerName"] = $sessionVal->customer_name;
            $_SESSION["customerId"]=$sessionVal->customer_id;
			$_SESSION["customer_id"]=$sessionVal->customer_id;
			$_SESSION["customer_photo"]=$sessionVal->customer_photo;
			
			//check if user entered new detail then save it.
			if( isset($_SESSION["ExistUserNewinfo"]) && $_SESSION["ExistUserNewinfo"] !=null && $_SESSION["ExistUserNewinfo"] !=""){
				$CustomerNewDetail = $_SESSION["ExistUserNewinfo"];
				$results = $this->customerNewDetail($CustomerNewDetail);
				//echo "val=>".var_dump($results);
				//return;
			}
			
            //check if orderdata session is not empty (means we are redirect from order submission screen)
//         if( isset($_SESSION["OrderData"]) && $_SESSION["OrderData"] !=null && $_SESSION["OrderData"] !=""){
//
//                $OrderData=array();
//                $OrderData=$_SESSION["OrderData"];               
//				if(!isset($OrderData["customer_id"]))
//					$OrderData["customer_id"] = $_SESSION["customerId"];				
//                $orderSaveResult = $this->customerOrderSave_Quick($OrderData);
//                
//                
//                if($orderSaveResult =='Order saved successfully'){
//                
//                   $msg ="<script>toastr.success('Your order saved successfully.')< /script>";
//                   $_SESSION["toaster_msg"] = $msg;
//                    //send order placed email
//                 
//                     
//                   $customer_info = $this->Md_customer->getCustomerinfo($_SESSION["customerId"]);
//                   $requestData['customer_name']  = $customer_info[0]['customer_name'];
//                   $requestData['customer_username']  = $customer_info[0]['customer_email'];
//                   if($this->session->userdata('session_enquiry_flag')){}
//                   else{
//                  // $emailSendResult = $this->placeOrderEmail($requestData,$OrderData);
//                   }
//                    $_SESSION["OrderData"] =null;
//                    $_SESSION["RequestData"]=null;
//                }
//                $_SESSION["OrderData"] =null;
//                $_SESSION["RequestData"]=null;
//            }
			
			if(isset($_SESSION["MarketOrderData"]) && isset($_SESSION["MarketOrderShippingData"]) && isset($_SESSION["ProductlistMarketOrderData"]) && 
			 isset($_SESSION["PaymentMethodMarketOrderData"]) && $_SESSION["MarketOrderData"] !=null && $_SESSION["MarketOrderShippingData"] !=null 
			 && $_SESSION["ProductlistMarketOrderData"] !=null && $_SESSION["PaymentMethodMarketOrderData"] !=null && $_SESSION["MarketOrderData"] !=""
			 && $_SESSION["MarketOrderShippingData"] !="" && $_SESSION["ProductlistMarketOrderData"] !="" && $_SESSION["PaymentMethodMarketOrderData"] !="")
			 {
				$orderSaveResult = $this->MarketSaveOrderQuick();
			 }
			
			
			if($orderSaveResult == 'Email Send' || $orderSaveResult == 'Order saved successfully')
			{
				echo "Email Send";
			}
//			$this->load->view('dashboard/vw_profile');
                        $customer_info = $this->Md_customer->getCustomerinfo($id);
                      
			$this->session->set_userdata('customer_info',$customer_info[0]);
                        
                        /*[start:if customer favorite data session is available then strore it]*/
                        if(!empty($this->session->userdata('favorite_data'))){
                            
                            $favorites_record_id = $this->session->userdata('favorite_data')['favorite_id'];
                            $favorites_type = $this->session->userdata('favorite_data')['favorite_type'];
                            $favorite_array = array('customer_id'=>$id,'favorites_type'=>$favorites_type,'favorites_record_id'=>$favorites_record_id,
                                                   'on_date'=> date('Y-m-d H:i:s'));
                            $table = 'customer_favorites_list';
                            $condition = array('customer_id'=>$id,'favorites_type'=>$favorites_type,'favorites_record_id'=>$favorites_record_id);;
                            $result = $this->Md_database->getData($table,'id',$condition,'','');
                            if(empty($result)){
                                /* insert*/
                               
                                $table = 'customer_favorites_list';
                                $result = $this->Md_database->insertData($table,$favorite_array);
                               // echo 'saved';die;
                            }else{
                                /* delete
                                $table = 'customer_favorites_list';
                                $condition = $favorite_array;
                                $result = $this->Md_database->deleteData($table,$condition);
                                 * */
                                
                            }
                           $this->session->unset_userdata('favorite_data') ;
                           
                           
                        }
                        
                        /*[End:if customer favorite session is available then strore it]*/
                        echo "Login successfully";die;
			
			//$this->response('success','Login successfully',200,$authData);
		}else{
			//$this->response('error','Username or password mismatch', 401, $authData);
			echo 'Username or password mismatch';die;
		}
	}
	
	public function customerNewDetail($requestData)
	{
		$requestData['customer_id'] = $_SESSION["customerId"];
		$customerMobilephone = $this->Md_customer->getCustomerMobileAll($requestData);
		//return $requestData;
		if($customerMobilephone)
		{					
			if((isset($requestData['customer_mobile']) && $customerMobilephone[0]->customer_phone != $requestData['customer_mobile']) || (isset($requestData['customer_phone']) && $customerMobilephone[0]->customer_phone != $requestData['customer_phone']) ) 
			{
				
				 if(isset($requestData['customer_phone']))
				 {						 	
				     $newPhone['customer_id']    =  $_SESSION["customerId"];
				     $newPhone['customer_phone'] =  $requestData['customer_phone'];
					 $results = $this->Md_customer->createCustomerPhone($newPhone);
				 }
			     if(isset($requestData['customer_mobile']))
				 {						 
				     $newPhone['customer_id']    =  $_SESSION["customerId"];
				     $newPhone['customer_phone'] =  $requestData['customer_mobile'];	
					 $results = $this->Md_customer->createCustomerPhone($newPhone);	
				 }					 			 						
			}
		}
		else{
				 if(isset($requestData['customer_phone']))
				 {						 	
				     $newPhone['customer_id']    =  $_SESSION["customerId"];
				     $newPhone['customer_phone'] =  $requestData['customer_phone'];
					 $results = $this->Md_customer->createCustomerPhone($newPhone);
				 }
			     if(isset($requestData['customer_mobile']))
				 {						 
				     $newPhone['customer_id']    =  $_SESSION["customerId"];
				     $newPhone['customer_phone'] =  $requestData['customer_mobile'];	
					 $results = $this->Md_customer->createCustomerPhone($newPhone);	
				 }	
			
		}
				
		// Check user's new email exist or not , if not exist then update email
		$customerEmails = $this->Md_customer->getCustomerEmailAll($requestData);
		if($customerEmails)
		{
			if(isset($requestData['customer_email']) && $customerEmails[0]->customer_email != $requestData['customer_email']) 
			{
				$newEmail['customer_id']    =  $_SESSION["customerId"];
				$newEmail['customer_email'] =  $requestData['customer_email'];			 			 
				$results =  $this->Md_customer->createCustomerEmail($newEmail);
			}
		}
		else{
				$newEmail['customer_id']    =  $_SESSION["customerId"];
				$newEmail['customer_email'] =  $requestData['customer_email'];			 			 
				$results =  $this->Md_customer->createCustomerEmail($newEmail);
		}
	}
	
	function MarketSaveOrderQuick()
	{
		if($this->get_request_method() == "POST")
		{
			$jsonFinalData = array();
			$shippingData = array();
			$paymentData = array();
			$productsList = array();
			
			$jsonFinalData = $_SESSION["MarketOrderData"];
			$shippingData = $_SESSION["MarketOrderShippingData"];
			$productsList = $_SESSION["ProductlistMarketOrderData"];
			$paymentData = $_SESSION["PaymentMethodMarketOrderData"];

			if(!isset($_SESSION["customerId"]))
				return $this->response('error','Cart Products', 400, "Please login first! ");



			$jsonFinalData["cart_id"] = "MEC".date("dm")."C".$_SESSION["customerId"]."X".rand( 100 ,999);
			$jsonFinalData["customer_id"] = $_SESSION["customerId"];
			if(count($productsList) == 0)
				return $this->response('error','Cart Products', 400, "Please add any product into cart! ");
			$paymentData["cart_id"] = $jsonFinalData["cart_id"];
			$data =  $this->order->SaveOrder($jsonFinalData,$shippingData,$productsList,$paymentData);
			$this->RemoveCart();
			$resultData = array();
			$resultData["OrderId"] = $jsonFinalData["cart_id"];
			$orderDetails = $this->order->OrderDetails($jsonFinalData["cart_id"]);
			$resultData["OrderDetail"] = $orderDetails;
			$resultData["ShippingDetail"] = $this->order->ShippingDetailsOfOrder($jsonFinalData["cart_id"]);
			$resultData["ProductList"] = $this->order->ProductListInOrder($jsonFinalData["cart_id"]);

			$_SESSION["MarketOrderData"] =null;
            $_SESSION["MarketOrderShippingData"]=null;
			$_SESSION["ProductlistMarketOrderData"] =null;
            $_SESSION["PaymentMethodMarketOrderData"]=null;
			
			return "Email Send";
			//$this->response('success','Cart Products', 200, $resultData);
		}
		else
		{
			$this->response('error','Cart Products', 200,"Invalid action");
		}

	}
	
	public function SavedAllDataForExistingUserForDesigner()
	{
               
		$OrderData = array();
		
//
//            if (($this->input->post('order_type')))
//                $OrderData['order_type'] = $this->input->post('order_type');//post('4');
//            else
//                $OrderData['order_type'] ='';

            if (($this->input->post('package_id')))
                $OrderData['package_id'] = $this->input->post('package_id');
            else
                $OrderData['package_id'] ='';

//            if (($this->input->post('scheme')))
//                $OrderData['scheme'] = $this->input->post('scheme');
//            else
//                $OrderData['scheme'] ='';

//            if (($this->input->post('apartment')))
//                $OrderData['apartment'] = $this->input->post('apartment');
//            else
//                $OrderData['apartment'] ='';

//            if (($this->input->post('flat')))
//                $OrderData['flat'] = $this->input->post('flat');
//            else
//                $OrderData['flat'] ='';

            if (($this->input->post('special_request')))
                $OrderData['special_request'] = $this->input->post('special_request');
            else
                $OrderData['special_request'] ='';

            if (($this->input->post('master_design_name')))
                $OrderData['master_design_name'] = $this->input->post('master_design_name');
            else
                $OrderData['master_design_name'] ='';

            if (($this->input->post('master_execution_portfolio')))
                $OrderData['master_execution_portfolio'] = $this->input->post('master_execution_portfolio');
            else
                $OrderData['master_execution_portfolio'] ='';

//            if (($this->input->post('advertised_price')))
//                $OrderData['advertised_price'] = $this->input->post('advertised_price');
//            else
//                $OrderData['advertised_price'] ='';

            $OrderData['pipeline_load_date'] = date('Y-m-d H:i:s');
            $OrderData['remote_address'] = $_SERVER['REMOTE_ADDR'];//$this->input->ip_address();

            if (($this->input->post('designer_id')))
                $OrderData['designer_id'] = $this->input->post('designer_id');
            else
                $OrderData['designer_id'] ='';

            if (($this->input->post('design_id')))
                $OrderData['design_id'] = $this->input->post('design_id');
            else
                $OrderData['design_id'] ='';

            if (($this->input->post('design_name')))
                $OrderData['design_name'] = $this->input->post('design_name');
            else
                $OrderData['design_name'] ='';

//            if (($this->input->post('executioner_id')))
//                $OrderData['executioner_id'] = $this->input->post('executioner_id');
//            else
//                $OrderData['executioner_id'] ='';

           // $OrderData['status'] = '1';

//            if (($this->input->post('marketplace_comments')))
//                $OrderData['marketplace_comments'] = $this->input->post('marketplace_comments');
//            else
//                $OrderData['marketplace_comments'] ='';

            $OrderData['order_channel_type'] = 'Web';
            //$OrderData['crm_status'] = '2';

            //$OrderData['unique_oid'] = $this->Md_customer->getUniqueOrderID();

            if (($this->input->post('city')))
                $OrderData['city_id'] = $this->input->post('city');
            else
                $OrderData['city_id'] ='';

            if (($this->input->post('apartment_address')))
                $OrderData['apartment_address'] = $this->input->post('apartment_address');
            else
                $OrderData['apartment_address'] ='';


            if (!empty($this->input->post('portfolioId')))
            $OrderData['execution_portfolio_id'] = $this->input->post('portfolioId');
            else 
                $OrderData['execution_portfolio_id']='';
            if (!empty($this->input->post('design_id')))
            $OrderData['master_design_name'] = $this->input->post('design_id');
            else
               $OrderData['master_design_name']='';
            
//            if (!empty($this->input->post('campaign_utm_param')))
//            $OrderData['campaign_utm_param'] = $this->input->post('campaign_utm_param');
//            else
//               $OrderData['campaign_utm_param']='';
            
           $_SESSION["OrderData"] = $OrderData;
          //echo "test";die;  
           
           /*[start::IF user already logged in then order saved succesfully]*/            
                     
            if(isset($_SESSION["customerId"])){
               
                   $OrderData["customer_id"] = $_SESSION["customerId"];				
                   $orderSaveResult = $this->customerOrderSave_Quick($OrderData);
                   $customer_info = $this->Md_customer->getCustomerinfo($_SESSION["customerId"]);
                   $requestData['customer_name']  = $customer_info[0]['customer_name'];
                   $requestData['customer_username']  = $customer_info[0]['customer_email'];
//                   if($this->session->userdata('session_enquiry_flag')){}
//                   else{
//                   $this->placeOrderEmail($requestData,$OrderData);
//                   }
            }
           $this->response('success','Design Features Product', 200, "Saved Data");

	}
	
	public function getCustomerEmailNotificationType()
	{
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_id'] = $this->input->get('customer_id');
		}
		else
		{
			$requestData['customer_id'] = $this->input->post('customer_id');
		}

		error_log(print_r($requestData, true));

		$result = $this->Md_customer->getCustomerEmailNotificationType($requestData);
		//echo var_dump($result->notification_title);
		$jsonData = array();
		foreach ($result as $EmailNotification)
		{
			$Notification['id_notification_type'] = $EmailNotification->id_notification_type;
			$Notification['notification_title'] = $EmailNotification->notification_title;
			$Notification['notification_type_id'] = $EmailNotification->notification_type_id;
			$jsonData[] = $Notification;
		}

		$jsonFinalData['EmailNotification'] = $jsonData;

		$this->response('success','Email Notification list', 200, $jsonFinalData);
	}
	
	
	public function getCustomerAllAddress()
	{
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_id'] = $this->input->get('customer_id');
			$requestData['customer_name'] = $this->input->get('customer_name');
			$requestData['Address_id'] = $this->input->get('Address_id');
		}
		else
		{
			$requestData['customer_id'] = $this->input->post('customer_id');
			$requestData['customer_name'] = $this->input->post('customer_name');
			$requestData['Address_id'] = $this->input->post('Address_id');
		}

		error_log(print_r($requestData, true));

		$result = $this->Md_customer->getCustomerAllAddress($requestData);
		//echo var_dump($result->notification_title);
		$jsonData = array();
		foreach ($result as $customerAddress)
		{
			$Address['customer_id'] = $customerAddress->customer_id;
			$Address['customer_name'] = $customerAddress->customer_name;
			$Address['address_type'] = $customerAddress->address_type;
			$Address['full_name'] = $customerAddress->full_name;
			$Address['Address_id'] = $customerAddress->Address_id;
			$Address['address_line1'] = $customerAddress->address_line1;
			$Address['address_line2'] = $customerAddress->address_line2;
			$Address['postal_code'] = $customerAddress->postal_code;
			$Address['extension_code'] = $customerAddress->extension_code;
			$Address['phone_number'] = $customerAddress->phone_number;
			$Address['flag_default_shipping_adrs'] = $customerAddress->flag_default_shipping_adrs;
			$Address['flag_default_billing_adrs'] = $customerAddress->flag_default_billing_adrs;
			$Address['city_id'] = $customerAddress->city_id;
			$Address['city'] = $customerAddress->city;
			$Address['latitude'] =0;// $customerAddress->latitude;
			$Address['longitude'] = 0;//$customerAddress->longitude;
			$Address['state_id'] = $customerAddress->state_id;
			$Address['state_title'] = $customerAddress->state_title;
			$Address['countryCode'] = $customerAddress->countryCode;
			$Address['country_id'] = $customerAddress->country_id;
			$Address['countryName'] = $customerAddress->countryName;
			$Address['currencyCode'] = $customerAddress->currency;

			$jsonData[] = $Address;
		}

		$jsonFinalData['CustomerAddress'] = $jsonData;

		$this->response('success','Customer Address List', 200, $jsonFinalData);
	}
	
	
	public function getCustomerDetailsFull()
	{
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_id'] = $this->input->get('customer_id');
			$requestData['customer_name'] = $this->input->get('customer_name');
		}
		else
		{
			$requestData['customer_id'] = $this->input->post('customer_id');
			$requestData['customer_name'] = $this->input->post('customer_name');
		}

		error_log(print_r($requestData, true));
		$result = $this->Md_customer->getCustomerDetailsFull($requestData);

		$jsonData = array();
		foreach ($result as $customerDet)
		{
			$customer['customer_id'] = $customerDet->customer_id;
			$customer['customer_name'] = $customerDet->customer_name;
			$customer['customer_dob'] = $customerDet->customer_dob;
			$customer['customer_address'] = $customerDet->customer_address;
			$customer['customer_photo'] = $customerDet->customer_photo;
			$customer['customer_city_id'] = $customerDet->customer_city_id;
			$customer['customer_username'] = $customerDet->customer_username;
			$customer['customer_password'] = $customerDet->customer_password;
			$customer['customer_occupation'] = $customerDet->customer_occupation;
			$customer['customer_about_me'] = $customerDet->customer_about_me;
			$customer['customer_favourite_style'] = $customerDet->customer_favourite_style;
			$customer['customer_next_project'] = $customerDet->customer_next_project;
			$customer['remote_address'] = $customerDet->remote_address;
			$customer['outh_provider'] = $customerDet->outh_provider;
			$customer['outh_uid'] = $customerDet->outh_uid;
			$customer_id = $customerDet->customer_id;
			$customer['CustDetailsData']=$customerDet;
			$customer['Address'] = $this->Md_customer->getCustomerAddress($customer_id);
			$_SESSION["customer_photo"]=$customer['customer_photo'];
			$jsonData[] = $customer;
		}

		$jsonFinalData['CustomerDetail'] = $jsonData;

		$this->response('success','Customer Details', 200, $jsonFinalData);
	}
	
	public function isCustomerLogin()
	{
		return isset($_SESSION["customerId"]);
	}

	public function CurrentCustomerId()
	{
		if(isset($_SESSION["customerId"]))
			return $_SESSION["customerId"];
		else
			return -1;

	}
	
	public function getCustomerMobileFull()
	{
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_id'] = $this->input->get('customer_id');
			$requestData['customer_name'] = $this->input->get('customer_name');
		}
		else
		{
			$requestData['customer_id'] = $this->input->post('customer_id');
			$requestData['customer_name'] = $this->input->post('customer_name');
		}

		error_log(print_r($requestData, true));
		$result = $this->Md_customer->getCustomerMobileFull($requestData);

		$jsonData = array();
		foreach ($result as $customerMDet)
		{
			$customer['customer_id'] = $customerMDet->customer_id;
			$customer['id'] = $customerMDet->id;
			$customer['customer_phone'] = $customerMDet->customer_phone;
			$jsonData[] = $customer;
		}

		$jsonFinalData['CustomerMobile'] = $jsonData;

		$this->response('success','Customer Mobile', 200, $jsonFinalData);
	}
	
	public function getCurrentUserDetails()
	{
		
		if(isset($_SESSION["customerId"]))
		{
			$authData = $this->Md_customer->getCustomerDetails('customer_id, customer_name, customer_username', array('customer_id'=>$_SESSION["customerId"]));

			
            //for bind session value
            $sessionVal=json_encode($authData);
            $sessionVal=json_decode($sessionVal);
            //echo "Welcome " . $sessionVal -> customer_name;
			$jsonFinalData = array();
			//$jsonFinalData = $authData;
			$jsonFinalData["isLogin"] = true;
            $jsonFinalData["customerName"] = $sessionVal->customer_name;
            $jsonFinalData["customerId"]=$sessionVal->customer_id;
			$jsonFinalData["customerEmailid"] = $sessionVal->customer_username;
			$customer = array();
			$customer["customer_id"] = $_SESSION["customerId"];
			$cusPhone = $this->Md_customer->getCustomerMobileFull($customer);
			$jsonFinalData['customer_phone'] = "";
			foreach ($cusPhone as $customerMDet)
			{
			
					$jsonFinalData['customer_phone'] = $customerMDet->customer_phone;
					break;
			
			}
		
		
			
			$this->response('success','Design Features Product',200, $jsonFinalData);
		}
		else
		{
			$jsonFinalData = array();
			
			$jsonFinalData["isLogin"] = false;
			$this->response('success','Design Features Product', 200, $jsonFinalData);
		}
		
	}
	
//	public function getCustomerCreditCardDetails()
//	{
//		if($this->get_request_method() != "POST")
//		{
//			$requestData['customer_id'] = $this->input->get('customer_id');
//			$requestData['customer_name'] = $this->input->get('customer_name');
//		}
//		else
//		{
//			$requestData['customer_id'] = $this->input->post('customer_id');
//			$requestData['customer_name'] = $this->input->post('customer_name');
//		}
//
//		error_log(print_r($requestData, true));
//		$result = $this->Md_customer->getCustomerCreditCardDetails($requestData);
//
//		$jsonData = array();
//		foreach ($result as $customerCCDet)
//		{
//			$customer['customer_id'] = $customerCCDet->customer_id;
//			$customer['id'] = $customerCCDet->id;
//			$customer['card_number'] = $customerCCDet->card_number;
//			$customer['name_on_card'] = $customerCCDet->name_on_card;
//			$customer['expiry_month'] = $customerCCDet->expiry_month;
//			$customer['expiry_year'] = $customerCCDet->expiry_year;
//			$customer['card_label'] = $customerCCDet->card_label;
//			$customer['flag_primary_card'] = $customerCCDet->flag_primary_card;
//
//			$jsonData[] = $customer;
//		}
//
//		$jsonFinalData['CustomerCC'] = $jsonData;
//
//		$this->response('success','Customer Credit Card Detail', 200, $jsonFinalData);
//	}
	
	public function getCustomerEmailFull()
	{
		if($this->get_request_method() != "POST")
		{
			$requestData['customer_id'] = $this->input->get('customer_id');
			$requestData['customer_name'] = $this->input->get('customer_name');
		}
		else
		{
			$requestData['customer_id'] = $this->input->post('customer_id');
			$requestData['customer_name'] = $this->input->post('customer_name');
		}

		error_log(print_r($requestData, true));
		$result = $this->Md_customer->getCustomerEmailFull($requestData);

		$jsonData = array();
		foreach ($result as $customerEmailDet)
		{
			$customer['customer_id'] = $customerEmailDet->customer_id;
			$customer['id'] = $customerEmailDet->id;
			$customer['customer_email'] = $customerEmailDet->customer_email;
			$jsonData[] = $customer;
		}

		$jsonFinalData['CustomerEmail'] = $jsonData;

		$this->response('success','Customer Email', 200, $jsonFinalData);
	}
	
	
	function saveProfileDetail()
	{
//            print_r($_POST);die;
		if($this->get_request_method() == "POST")
		{
                       
                        
                      // print_r($_POST);die;
			$jsonFinalData = array();

			$requestData['customer_name'] = $this->input->post('fullName');
//			$requestData['customer_about_me'] =$this->input->post('customer_about_me');
//			$requestData['customer_favourite_style'] = $this->input->post('customer_favourite_style');
//			$requestData['customer_next_project'] =$this->input->post('customer_next_project');
			$requestData['customer_address'] = $this->input->post('address');
			$requestData['customer_dob'] = $this->input->post('customer_dob');
			$requestData['last_update_date'] = date('Y-m-d H:i:s');
			$requestDataEmail['customer_email'] = $this->input->post('userEmail');
			$requestDataPhone['customer_phone'] = $this->input->post('mobile');

                        $requestDataCity['customer_city'] = $this->input->post('profileCity');
			$requestDataProvince['customer_province'] = $this->input->post('profileCityRegion');
			$requestDataCountry['customer_country'] = $this->input->post('profileCityCountry');
                        
                        /*[Update action log for customer details changed]*/
                        $table = "customer_details"; 
                        $condition=array('customer_id'=>$_SESSION["customerId"],'status'=>'1');
                        $customer_details  = $this->Md_database->getData($table,'*',$condition, ''); 
                        
                        if($customer_details[0]['customer_name'] != $this->input->post('fullName')){
                            $comment ="Changed Full Name - ".$this->input->post('fullName');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
                        if($customer_details[0]['customer_address'] != $this->input->post('address')){
                            $comment ="Changed Address - ".$this->input->post('address');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
                        if($customer_details[0]['customer_dob'] != $this->input->post('customer_dob')){
                            $comment ="Changed DOB - ".$this->input->post('customer_dob');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
                        if($customer_details[0]['customer_city_id'] != $this->input->post('profileCityID')){
                            $comment ="Changed City - ".$this->input->post('profileCity');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
                        /*[Update action log for email changed]*/
                        $table = "customer_email"; 
                        $condition=array('customer_id'=>$_SESSION["customerId"]);
                        $customer_email_list  = $this->Md_database->getData($table,'customer_email',$condition, ''); 
                        $customer_email_array= array();
                        foreach($customer_email_list as $row){
                            $customer_email_array[] = $row['customer_email'];
                        }
                        if (!(in_array($this->input->post('userEmail'), $customer_email_array )) ){
                            $comment ="Changed Email - ".$this->input->post('userEmail');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
                       /*[Update action log for phone changed]*/
                        $table = "customer_phone"; 
                        $condition=array('customer_id'=>$_SESSION["customerId"]);
                        $customer_phone_list  = $this->Md_database->getData($table,'customer_phone',$condition, ''); 
                        $customer_phone_array= array();
                        foreach($customer_phone_list as $row){
                            $customer_phone_array[] = $row['customer_phone'];
                        }
                        if (!(in_array($this->input->post('mobile'), $customer_phone_array )) ){
                            $comment ="Changed Phone - ".$this->input->post('mobile');
                            $table = "customer_details_map_action_logs"; 
                            $data=array('customer_id'=>$_SESSION["customerId"],
                                        'actor_type'=>'Customer',
                                        'actor_id'=>$_SESSION["customerId"],
                                        'comment'=>$comment,
                                        'ondatetime'=> date('Y-m-d H:i:s')
                                        );
                            $this->Md_database->insertData($table, $data); 
                            
                        }
            // $countryid=$this->apartment->getCountryId($requestDataCountry['customer_country']);// Comment By AgiList

            // $stateid=$this->apartment->getStateId($requestDataProvince['customer_province']);// Comment By AgiList

            // $cityid=$this->apartment->getCityId($requestDataCity['customer_city'],$countryid,$stateid); // Comment By AgiList
            $cityid=$this->input->post('profileCityID');
            $requestData['customer_city_id'] = $cityid;

			$customerId= $_SESSION["customerId"];
			$jsonFinalData = '';
			$userProfile = $this->Md_customer->updateUserProfile($requestData,$customerId);
			$userEmail = $this->Md_customer->updateCustomerEmail($requestDataEmail,$customerId);
			$userPhone = $this->Md_customer->updateCustomerPhone($requestDataPhone,$customerId);

			$this->response('success','update user profile', 200, $jsonFinalData);
		}
		else{
			$this->response('error','update user profile', 200,"Invalid action");
		}

	}
        
	function changePassword()
	{
           // print_r($_POST);die;
		if($this->get_request_method() == "POST")
		{
			$jsonFinalData = array();
                        
                        $requestData['customer_name']= $_SESSION["customerName"] ;
                        $requestData['customer_id']= $_SESSION["customerId"];
			$customer_details_full = $this->Md_customer->getCustomerDetailsFull($requestData);
                        $requestData='';
			$requestData['customer_password'] = md5($this->input->post('currentPassword'));
                        $requestData['last_update_date'] = date('Y-m-d H:i:s');
                        $newPassword = $this->input->post('newPassword');
                        $confirmPassword = $this->input->post('confirmPassword');
                       
                        if(!empty($customer_details_full)){
                            if($requestData['customer_password'] == $customer_details_full[0]->customer_password && $newPassword==$confirmPassword){
                        $customerId= $_SESSION["customerId"];
			$jsonFinalData = '';
                        $requestDataPassword['customer_password'] = md5($this->input->post('newPassword'));
			$userProfile = $this->Md_customer->updateUserPassword($requestDataPassword,$customerId);
                        //echo $userProfile;die;
			$this->response('success','update user profile', 200, $jsonFinalData);
                            }else{
                            $this->response('error','update user profile', 200,"Password mismatch");
                        }
                        }else{
                            $this->response('error','update user profile', 200,"Invalid user");
                        }
		}
		else{
			$this->response('error','update user profile', 200,"Invalid action");
		}

	}
	
	
//	function saveProfileImage($imagePath)
//	{
//
//        $jsonFinalData = array();
//
//        $requestData['customer_photo'] = $imagePath['file_name'];
//
//        $jsonFinalData = '';
//        $orderId = $this->Md_customer->updateUserProfile($requestData,$_SESSION["customerId"]);
//		$_SESSION["customer_photo"]=$imagePath['file_name'];
//        $this->response('success','update user profile', 200, $jsonFinalData);
//
//	}
	
	
	function saveProfileSocialtype_Identifier($data)
	{

        $jsonFinalData = array();

        $requestData['outh_provider'] = $data['outh_provider'];
        $requestData['outh_uid'] = $data['outh_uid'];

        $jsonFinalData = '';
        $orderId = $this->Md_customer->updateUserProfile($requestData);
        $this->response('success','update user profile', 200, $jsonFinalData);

	}
	
//	
//	function updatCustomerShippingDetail()
//	{
//        if($this->get_request_method() == "POST")
//		{
//			$jsonFinalData = array();
//			if($this->input->post('id') == 0)
//			{
//                $requestData['id'] = $this->input->post('id');
//			}
//
//			$requestData['address_type'] = $this->input->post('address_type');
//			$requestData['customer_id'] =$this->input->post('customer_id');
//			$requestData['full_name'] = $this->input->post('full_name');
//			$requestData['address_line1'] =$this->input->post('address_line1');
//			$requestData['address_line2'] = $this->input->post('address_line2');
//			$requestData['postal_code'] = $this->input->post('postal_code');
//			$requestData['extension_code'] = $this->input->post('extension_code');
//			$requestData['phone_number'] = $this->input->post('phone_number');
//		    $requestData['flag_default_shipping_adrs'] = $this->input->post('flag_default_shipping_adrs');
//			$requestData['flag_default_billing_adrs'] = $this->input->post('flag_default_billing_adrs');
//
//			//start get city id
//
//
//            // $requestDataCity['customer_city'] = $this->input->post('customer_city');
//			//$requestDataProvince['customer_province'] = $this->input->post('customer_province');
//			//$requestDataCountry['customer_country'] = $this->input->post('customer_country');
//
//            //$countryid=$this->apartment->getCountryId($requestDataCountry['customer_country']);
//
//            // $stateid=$this->apartment->getStateId($requestDataProvince['customer_province']);
//
//            // $cityid=$this->apartment->getCityId($requestDataCity['customer_city'],$countryid,$stateid);
//            $cityid=$this->input->post('customer_city_id');
//            $requestData['city_id'] = $cityid;
//
//			// end get city id
//
//			////$requestData['city_id'] = $this->input->post('city_id');
//			$addressId=$this->input->post('id');
//			// CC detail below
//			$requestDataCC['customer_id'] =$this->input->post('customer_id');
//			if($this->input->post('CCId') == 0)
//			{
//                $requestDataCC['id'] = $this->input->post('CCId');
//			}
//			$requestDataCC['card_number']=$this->input->post('card_number');
//			$requestDataCC['name_on_card']=$this->input->post('name_on_card');
//			$requestDataCC['expiry_month']=$this->input->post('expiry_month');
//			$requestDataCC['expiry_year']=$this->input->post('expiry_year');
//			$requestDataCC['card_label']=$this->input->post('card_label');
//			$requestDataCC['flag_primary_card']=$this->input->post('flag_primary_card');
//			$requestDataCC['customer_id'] =$this->input->post('customer_id');
//
//			$customerId=$this->input->post('customer_id');
//
//			$CCId=$this->input->post('CCId');
//
//			$jsonFinalData = '';
//
//			if($customerId > 0)
//			{
//                //flag_default_shipping_adrs
//                //flag_default_billing_adrs
//
//                if($requestData['flag_default_shipping_adrs'] == 1)
//                {
//                    $requestDataFlag['flag_default_shipping_adrs']=0;
//                    $this->Md_customer->updatCustomerShippingAddressFlag($requestDataFlag,$customerId,$addressId);
//                }
//
//                if($requestData['flag_default_billing_adrs'] == 1 )
//                {
//                    $requestDataFlag['flag_default_billing_adrs']=0;
//                    $this->Md_customer->updatCustomerShippingAddressFlag($requestDataFlag,$customerId,$addressId);
//                }
//
//			}
//
//			$userProfile = $this->Md_customer->updatCustomerShippingDetail($requestData,$customerId,$addressId);
//			$userProfileCreditCard = $this->Md_customer->updatCustomerCreaditCardDetail($requestDataCC,$customerId,$CCId);
//
//			$this->response('success','update user profile', 200, $jsonFinalData);
//		}
//		else{
//			$this->response('error','update user profile', 200,"Invalid action");
//		}
//    }
	
	
	public function SaveCustomerFavorite()
	{
		if($this->get_request_method() != "POST")
		{
			//$requestData['id'] = $this->input->get('id');
			$requestData['customer_id'] = $this->input->get('customer_id');
			$requestData['favorites_type'] = $this->input->get('favorites_type');
			$requestData['favorites_record_id'] = $this->input->get('favorites_record_id');
		}
		else
		{
			//$requestData['id'] = $this->input->post('id');
			$requestData['customer_id'] = $this->input->post('customer_id');
			$requestData['favorites_type'] = $this->input->post('favorites_type');
			$requestData['favorites_record_id'] = $this->input->post('favorites_record_id');
		}
		

		
                $table = 'customer_favorites_list';
                $condition = $requestData;
                $result = $this->Md_database->getData($table,'id',$condition,'','');
                if(empty($result)){
                    /* insert*/
                    $requestData['on_date'] = date('Y-m-d H:i:s');
                    $table = 'customer_favorites_list';
                    $result = $this->Md_database->insertData($table,$requestData);
                    echo 'saved';die;
                }else{
                    /* delete*/
                    $table = 'customer_favorites_list';
                    $condition = $requestData;
                    $result = $this->Md_database->deleteData($table,$condition);
                    echo 'removed';die;
                }

	}
	
	
//		public function getCustomerFavorite()
//	{
//		if($this->get_request_method() != "POST")
//		{
//			$requestData['id'] = $this->input->get('id');
//			$requestData['customer_id'] = $this->input->get('customer_id');
//			$requestData['favorites_type'] = $this->input->get('favorites_type');
//			$requestData['favorites_record_id'] = $this->input->get('customer_id');
//		}
//		else
//		{
//			$requestData['id'] = $this->input->post('id');
//			$requestData['customer_id'] = $this->input->post('customer_id');
//			$requestData['favorites_type'] = $this->input->post('favorites_type');
//			$requestData['favorites_record_id'] = $this->input->post('favorites_record_id');
//		}
//		$requestData['on_date'] = date('Y-m-d H:i:s');
//
//		error_log(print_r($requestData, true));
//		//var_dump($requestData);
//		$result = $this->Md_customer->getCustomerFavorite($requestData);
//
//		$jsonData = array();
//		foreach ($result as $CustomerFavorite)
//		{
//			$customer['customer_id'] = $CustomerFavorite->customer_id;
//			$customer['favorites_type'] = $CustomerFavorite->favorites_type;
//			$customer['favorites_record_id'] = $CustomerFavorite->favorites_record_id;
//			/*if($customer['favorites_record_id']=='designer')
//			{
//            $customer['favorites_type_detail'] =
//			}
//			elseif($customer['favorites_record_id']=='designer')
//			{
//
//			}
//			elseif($customer['favorites_record_id']=='designer')
//			{
//
//			}
//			elseif($customer['favorites_record_id']=='designer')
//			{
//
//			}*/
//			$jsonData[] = $customer;
//		}
//
//		$jsonFinalData['CustomerFavorite'] = $jsonData;
//
//		$this->response('success','Customer Favorite Details', 200, $jsonFinalData);
//	}
	
//	
//	public function getFavoriteTypewiseCount()
//	{
//		if($this->get_request_method() != "POST")
//		{
//			$requestData['favorites_type'] = $this->input->get('favorites_type');
//		}
//		else
//		{
//			$requestData['favorites_type'] = $this->input->post('favorites_type');
//		}
//
//		error_log(print_r($requestData, true));
//		//var_dump($requestData);
//		$result = $this->Md_customer->getFavoriteTypewiseCount($requestData);
//
//		$jsonData = array();
//		foreach ($result as $Favoritecount)
//		{
//			$customerFav['itemcount'] = $Favoritecount->itemcount;
//			$customerFav['favorites_type'] = $Favoritecount->favorites_type;
//			//$customer['favorites_record_id'] = $Favoritecount->favorites_record_id;
//
//			$jsonData[] = $customerFav;
//		}
//
//		$jsonFinalData['FavoriteType'] = $jsonData;
//
//		$this->response('success','Favorite Type Count', 200, $jsonFinalData);
//	}
	
	
//	public function getCustomerFavoriteDesigner()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//            $requestData['customer_id'] = $this->input->get('customer_id');
//		}
//		else
//		{
//            $requestData['customer_id'] = $this->input->post('customer_id');
//		}
//
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerFavoriteDesigner($requestData);
//		$jsonData = array();
//		foreach ($result as $designer)
//		{
//			$designs['id'] = $designer->id;
//			$designs['designer_name'] = $designer->designer_name;
//			$designs['designer_email_id'] = $designer->designer_email_id;
//			$designs['designer_mobile_no'] = $designer->designer_mobile_no;
//			$designs['introduction'] = $designer->introduction;
//			$designs['designer_description'] = $designer->designer_description;
//			$designs['design_philosophy'] = $designer->design_philosophy;
//			$designs['design_awards'] = $designer->design_awards;
//			$designs['designer_logo'] =$this->config->item('base_image_url') . "/images/designer-images/" . $designer->designer_logo;
//			$designs['website'] = $designer->website;
//			$designs['expereince'] = $designer->expereince;
//			$designs['designer_logo2'] =$this->config->item('base_image_url') . "/images/designer-images/" . $designer->designer_logo2;
//			$designs['itemcount'] = $designer->itemcount;
//			$designs['selectedId'] = $designer->selectedId;
//			$designs['Profile_Pic_theme'] = $this->getDesignerTopRatedTheme($designer->id);
//			$designs['Profile_Pic_port'] = $this->getDesignerTopRatedPortfolio($designer->id);
//			$jsonData[] = $designs;
//		}
//
//
//		$jsonFinalData['Designer'] = $jsonData;
//
//		$this->response('success','Customer Designer Favorite list', 200, $jsonFinalData);
//	}
	
	
//	public function getCustomerFavoriteDesign()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//            $requestData['customer_id'] = $this->input->get('customer_id');
//		}
//		else
//		{
//            $requestData['customer_id'] = $this->input->post('customer_id');
//		}
//
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerFavoriteDesign($requestData);
//		$jsonData = array();
//
//		foreach ($result as $designDetails)
//		{
//			$designs['design_id'] = $designDetails->design_id;
//			$designs['design_name'] = $designDetails->design_name;
//			$designs['design_display_name'] = $designDetails->design_display_name;
//
//			$designs['design_price'] = $designDetails->design_price;
//			$designs['design_type'] = $designDetails->design_type;
//			$designs['design_des'] = $designDetails->design_des;
//			$designs['design_specf'] = $designDetails->design_specf;
//
//			$designs['design_img'] = $this->config->item('base_image_url') . "/images/masterdsg-img/" . $designDetails->design_img;
//			$designs['design_ranking'] = $designDetails->design_ranking;
//			$designs['design_designer'] = $designDetails->design_designer;
//			$designs['on_date'] = $designDetails->on_date;
//
//			$designs['designer_name'] = $designDetails->designer_name;
//			$designs['tmp_designer_name'] = $designDetails->tmp_designer_name;
//			$designs['designer_email_id'] = $designDetails->designer_email_id;
//			$designs['tmp_designer_email_id'] = $designDetails->tmp_designer_email_id;
//
//			$designs['designer_mobile_no'] = $designDetails->designer_mobile_no;
//			$designs['tmp_designer_mobile_no'] = $designDetails->tmp_designer_mobile_no;
//			$designs['designer_logo'] =$this->config->item('base_image_url') . "/images/designer-images/". $designDetails->designer_logo;
//			$designs['website'] = $designDetails->website;
//			$designs['itemcount'] = $designDetails->itemcount;
//			$designs['selectedId'] = $designDetails->selectedId;
//			if($designDetails->secondary_images)
//			{
//				$designsSecondaryImages = array();
//				$designsSecondaryImages[] = $this->config->item('base_image_url') . "/images/masterdsg-img/1180x813/" . $designDetails->design_img;
//				$designs['secondary_images'] = $designsSecondaryImages;
//			} else { $designs['secondary_images'] = "";}
//			$jsonData[] = $designs;
//		}
//
//
//		$jsonFinalData['Design'] = $jsonData;
//
//		$this->response('success','Customer Design Favorite list', 200, $jsonFinalData);
//	}
	
	
//	public function getCustomerFavoriteContractor()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//            $requestData['customer_id'] = $this->input->get('customer_id');
//		}
//		else
//		{
//            $requestData['customer_id'] = $this->input->post('customer_id');
//		}
//
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerFavoriteContractor($requestData);
//		$jsonData = array();
//
//		foreach ($result as $contractordet)
//		{
//			$contractor['seller_name'] = $contractordet->seller_name;
//			$contractor['seller_email'] = $contractordet->seller_email;
//			$contractor['seller_mbl'] = $contractordet->seller_mbl;
//			$contractor['introduction'] = $contractordet->introduction;
//			$contractor['seller_description'] = $contractordet->seller_description;
//			$contractor['philosophy'] = $contractordet->philosophy;
//			$contractor['awards'] = $contractordet->awards;
//			$contractor['seller_logo_image'] =$this->config->item('base_image_url') . "/seller-img/" . $contractordet->seller_logo_image;
//			$contractor['website'] = $contractordet->website;
//			$contractor['ranking'] = $contractordet->ranking;
//			$jsonData[] = $contractor;
//		}
//
//
//		$jsonFinalData['contractor'] = $jsonData;
//
//		$this->response('success','Customer contractor Favorite list', 200, $jsonFinalData);
//	}
	
	
//	public function getCustomerFavoriteDesignerPortfolio()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//            $requestData['customer_id'] = $this->input->get('customer_id');
//		}
//		else
//		{
//            $requestData['customer_id'] = $this->input->post('customer_id');
//		}
//
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerFavoriteDesignerPortfolio($requestData);
//		$jsonData = array();
//
//        foreach ($result as $portfolioDetails)
//		{
//			$portfolio['id'] = $portfolioDetails->id;
//			$portfolio['portfolio_name'] = $portfolioDetails->portfolio_name;
//			$portfolio['executioner'] = $portfolioDetails->executioner;
//			$portfolio['id'] = $portfolioDetails->id;
//			$portfolio['designer_id'] = $portfolioDetails->designer_id;
//			$portfolio['master_image_thum'] = $this->config->item('base_image_url') . "/images/master-execution-images/388x300/" . $portfolioDetails->master_image;
//			$portfolio['master_image'] = $this->config->item('base_image_url') . "/images/master-execution-images/" . $portfolioDetails->master_image;
//			$portfolio['ranking'] = $portfolioDetails->ranking;
//			$portfolio['designer_name'] = $portfolioDetails->designer_name;
//			$portfolio['designer_email_id'] = $portfolioDetails->designer_email_id;
//			$portfolio['designer_mobile_no'] = $portfolioDetails->designer_mobile_no;
//			$portfolio['introduction'] = $portfolioDetails->introduction;
//			$portfolio['designer_description'] = $portfolioDetails->designer_description;
//			$portfolio['design_philosophy'] = $portfolioDetails->design_philosophy;
//			$portfolio['design_awards'] = $portfolioDetails->design_awards;
//			$portfolio['designer_logo'] = $this->config->item('base_image_url') . "/images/designer-images/" .$portfolioDetails->designer_logo;
//			$portfolio['website'] = $portfolioDetails->website;
//			$portfolio['expereince'] = $portfolioDetails->expereince;
//			$portfolio['ranking'] = $portfolioDetails->ranking;
//			$portfolio['itemcount'] = $portfolioDetails->itemcount;
//			$portfolio['selectedId'] = $portfolioDetails->selectedId;
//			$portfolio['Profile_Pic_theme'] = $this->getDesignerTopRatedTheme($portfolioDetails->id);
//			$portfolio['Profile_Pic_port'] = $this->getDesignerTopRatedPortfolio($portfolioDetails->id);
//			if($portfolioDetails->secondary_images)
//			{
//				$portfolioSecondaryImages = array();
//				$portfolioSecondaryImages[] = $this->config->item('base_image_url') . "/images/master-execution-images/388x300/" .$portfolioDetails->master_image;
//				$portfolio['secondary_images'] = $portfolioSecondaryImages;
//			}
//			else{ $portfolio['secondary_images'] = '';}
//			$jsonData[] = $portfolio;
//		}
//
//		$jsonFinalData['designs'] = $jsonData;
//
//		$this->response('success','Designer Portfolio list', 200, $jsonFinalData);
//
//    }
	
	
//	public function getCustomerOrderList()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//			$requestData['customer_id'] = $this->input->get('customer_id');
//			$requestData['cart_id'] = $this->input->get('cart_id');
//			$requestData['pageNo'] = $this->input->get('pageNo');
//		}
//		else
//		{
//			$requestData['customer_id'] = $this->input->post('customer_id');
//			$requestData['cart_id'] = $this->input->post('cart_id');
//			$requestData['pageNo'] = $this->input->post('pageNo');
//		}
//
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerOrderList($requestData);
//		
//		//echo "val=>".var_dump($result);
//		//return;
//		
//		$jsonData = array();
//		//$order = array();
//		foreach ($result as $orderDetails)
//		{
//
//			$order['order_id'] = $orderDetails->order_id;
//            $order['order_date'] = date('Y-m-d H:i:s');
//			$order['unique_order_id'] = $orderDetails->unique_order_id;
//			$order['cart_id'] =  $orderDetails->cart_id;
//			$order['flag_interior_order'] = $orderDetails->flag_interior_order;
//			$order['customer_id'] = $orderDetails->customer_id;
//			$order['product_id'] = $orderDetails->product_id;
//			$order['seller_id'] =  $orderDetails->seller_id;
//			$order['product_qty'] = $orderDetails->product_qty;
//			$order['currency_code'] = $orderDetails->currency_code;
//			$order['product_price'] = $orderDetails->product_price;
//
//			$order['product_selling_price'] = $orderDetails->product_selling_price;
//			$order['seller_discount'] = $orderDetails->seller_discount;
//			$order['ecom_discount'] = $orderDetails->ecom_discount;
//			$order['taxes'] = $orderDetails->taxes;
//			$order['shippment_type_id'] =  $orderDetails->shippment_type_id;
//			$order['internal_status_id'] = $orderDetails->internal_status_id;
//			$order['description'] = $orderDetails->description;
//			$order['customer_name'] = $orderDetails->customer_name;
//			$order['customer_photo'] = $this->config->item('base_image_url') . "/images/ecom/product/" .$orderDetails->customer_photo;
//			$order['product_id'] = $orderDetails->product_id;
//
//			$order['product_sku_id'] = $orderDetails->product_sku_id;
//			$order['product_name'] = $orderDetails->product_name;
//			$order['short_description'] = $orderDetails->short_description;
//			$order['product_details'] = $orderDetails->product_details;
//			$order['product_Image'] = $this->config->item('base_image_url') . "/images/ecom/product/" .$orderDetails->product_image;
//			$order['market_seller_id'] =  $orderDetails->market_seller_id;
//			$order['market_seller_name'] =  $orderDetails->market_seller_name;
//			$order['market_seller_email'] = $orderDetails->market_seller_email;
//			$order['market_seller_mbl'] =  $orderDetails->market_seller_mbl;
//			$order['market_seller_logo_image'] =  $this->config->item('base_image_url') . "/images/ecom/product/" .$orderDetails->market_seller_logo_image;
//			$order['full_name'] =$orderDetails->full_name;
//			$order['address_line1'] =$orderDetails->address_line1;
//			$order['address_line2'] =$orderDetails->address_line2;
//			$order['postal_code'] =$orderDetails->postal_code;
//			$order['extension_code'] =$orderDetails->extension_code;
//			$order['phone_number'] =$orderDetails->phone_number;
//			$order['city'] =$orderDetails->phone_number;
//			$jsonData[] = $order;
//		}
//
//		//echo "val".var_dump($order);
//		//return;
//		$jsonFinalData['orders'] = $jsonData;
//        //var_dump($jsonData);
//		$this->response('success','Customer Order List', 200, $jsonFinalData);
//	}
//	
//	
//	public function getCustomerInteriorOrderList()
//	{
//		$requestData = array();
//
//		if($this->get_request_method() != "POST")
//		{
//			$requestData['customer_id'] = $this->input->get('customer_id');
//			$requestData['unique_oid'] = $this->input->get('unique_oid');
//			$requestData['pageNo'] = $this->input->get('pageNo');
//		}
//		else
//		{
//			$requestData['customer_id'] = $this->input->post('customer_id');
//			$requestData['unique_oid'] = $this->input->post('unique_oid');
//			$requestData['pageNo'] = $this->input->post('pageNo');
//		}
//		//echo "val=>".var_dump($requestData);
//		//return;
//		error_log(print_r($requestData, true));
//
//		$result = $this->Md_customer->getCustomerInteriorOrderList($requestData);
//		//echo "val=>".var_dump($result);
//		//return;
//		$jsonData = array();
//		$DesignerData['Type'] = 'InteriorOrder';
//		$DesignerData['Count'] = count($result);
//		foreach ($result as $internalOrder) 
//		{
//			$Order['Order_id'] = $internalOrder->O_id;
//			$Order['customer_id'] = $internalOrder->customer_id ;
//			$Order['customer_name'] = $internalOrder->customer_name;
//            $Order['package_name'] = $internalOrder->package_name;
//            $Order['designer_name'] = $internalOrder->designer_name;
//            $Order['seller_name'] = $internalOrder->seller_name;
//            $Order['unique_oid'] = $internalOrder->unique_oid;
//            $Order['order_type'] = $internalOrder->order_type;
//			$Order['Apartment'] = $internalOrder->Apartment;
//			$Order['scheme'] = $internalOrder->scheme;
//			$Order['flat'] = $internalOrder->flat;
//			$Order['apartment_address'] = $internalOrder->apartment_address;
//			$Order['city'] = $internalOrder->city;
//			$Order['special_request'] = $internalOrder->special_request;
//			$Order['master_design_name'] = $internalOrder->master_design_name;
//			$Order['execution_portfolio_id'] = $internalOrder->execution_portfolio_id;
//			$Order['internal_status_title'] = $internalOrder->internal_status_title;
//			$jsonData[] = $Order;
//		}
//		$jsonFinalData['Interiororders'] = $jsonData;
//		
//		//echo "val".var_dump($Order);
//        //return; 
//
//		$this->response('success','Customer Interior Order List', 200, $jsonFinalData);
//	}
	
	
	public function ForgotPassword()
	{
		$requestData = array();

		if($this->get_request_method() != "POST")
		{
            $requestData['username'] = $this->input->get('username');
		}
		else
		{
            $requestData['username'] = $this->input->post('username');
		}

        $requestDataNew = $this->Md_customer->getCustomerDetails('*', array('customer_username'=>$requestData['username']));

        error_log(print_r($requestData, true));

        //echo 'valid_email1=>'.var_dump($requestDataNew);
        //return;
		
		if($requestDataNew)
		{
			$result = $this->Md_customer->ForgotPassword($requestData);
			//var_dump($result);
			$emailSendResult = $this->forgotPasswordEmail($requestDataNew,$result);
			//$jsonFinalData['Forgot_Password '] = $result;
			$this->response('success','Forgot Password result', 200, $result);
		}
		else
		{
			$updatepwd['customer_password'] = "Invalid_User";
			$this->response('success','Forgot Password result', 200, $updatepwd);
		}
	}
	
	
	public function forgotPasswordEmail($requestDataNew,$result)
    {

        $resultUserDetail=json_encode($requestDataNew);
        $resultUserDetail=json_decode($resultUserDetail);

        $resultDesign=json_encode($result);
        $resultDesign=json_decode($resultDesign);
       
        $MessageStr ='';
       
        $MessageStr = '<div style="width:100%; float:left;">
                    <p style="color:#000;">Hello '. $resultUserDetail -> customer_name .' ,</p>
                    <p style="color:#000;">Your password has been reset as requested. Please use the new login details shared below to access your account.</p>
                    <p style="margin:50px 0px 0px 0px; color:#000;">Your Login Details - </p>
                    <p  style="margin:5px 0px 0px 0px; v">User Name : <a href="#" style="color:#39F; text-decoration:none;">'. $resultUserDetail -> customer_username.'</a> </p>
                    <p  style="margin:5px 0px 30px 0px; color:#000;"> Password  : <strong>'.$resultDesign ->customer_password.'</strong> </p>
                    <p style="margin:50px 0px 0px 0px; color:#000;">Best Regards,</p>
                    <p style="color:#000;" >Team Mansionly</p>
                  </div>';  
       
        $parameter = "fpassword";
        $forgotPasswordResult = $this->sendEmailNew($resultUserDetail -> customer_username,'Your Mansionly.com Account - Password Recovery',$MessageStr,$parameter);
    }
//	public function forgotPasswordEmail($requestDataNew,$result)
//    {
//
//        $resultUserDetail=json_encode($requestDataNew);
//        $resultUserDetail=json_decode($resultUserDetail);
//
//        $resultDesign=json_encode($result);
//        $resultDesign=json_decode($resultDesign);
//       
//        $MessageStr ='';
//        $MessageStr = '<!DOCTYPE html>';
//        $MessageStr .= '<html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8" /><title>Forgot Password</title></head>';
//        $MessageStr .= '<body style="width:100% !important; min-width 239px !important; color:#525252; font-family Helvetica,sans-serif; font-size:14px; line-height:140%; margin:0; padding:0; bgcolor="#ffffff">';
//        $MessageStr .= '<h3> Hello ' . $resultUserDetail -> customer_name . "," . '</h3>';
//        $MessageStr .= '<p>Please find the below Details of new password <br /><br /></p>';
//        $MessageStr .= '<table width="100%"><tr height="30">';
//        $MessageStr .= '<td width="100%" valign="top" style="" font-size 27px; color #ffffff; text-align left; font-weight bold; font-family Helvetica, Arial, sans-serif; line-height 37px;""><span style="padding-right: 35px;">User Name</span><strong>:</strong>&nbsp;' . $resultUserDetail -> customer_username .'</td>';
//        $MessageStr .= '</tr><tr height="30">';
//        $MessageStr .= '<td width="100%" valign="top" style="" font-size 27px; color #ffffff; text-align left; font-weight bold; font-family Helvetica, Arial, sans-serif; line-height 37px;""><span style="padding-right: 43px;">Password</span> <strong>:</strong>&nbsp;' . $resultDesign -> customer_password .'</td>';
//        $MessageStr .= '</tr></table><p style="" margin-top 50px"">Thanks!</p><p>Mansionly Team</p>';
//        $MessageStr .= '<div style="position: fixed !important; background: #f3f3f4; border-top: 1px solid #e7eaec; left: 0 !important; right: 0 !important; bottom: 0 !important; padding: 10px 20px; text-align: right;">Powered by Mansionly</div>';
//        $MessageStr .= '</body></html>';
//
//        $forgotPasswordResult = $this->sendEmailNew($resultUserDetail -> customer_username,'Mansionly - Password Recovery',$MessageStr);
//    }
	
	
	public function saveCustomerEmailNotification()
	{
		$requestData = array();

		if($this->get_request_method() != "POST")
		{
			$requestData['data'] = $this->input->get('EmailNotification');
		} 
        else
        {
			$requestData['data'] = $this->input->post('EmailNotification');
		}

		error_log(print_r($requestData, true));

		$index = 0;

		$totalItem = count($requestData['data']);

		if(!isset($_SESSION["customerId"]))
		{
			$this->response('fali','Login error', 200, "Please login first");
			return;
		}


		$this->Md_customer->removeEmailNotification($_SESSION["customerId"]);

		foreach($requestData['data'] as $customerData)
		{

			if($customerData['notification_type_id'] > 0){
                $tempData['id_notification_type'] = $customerData['id_notification_type'];
                $tempData['notification_title'] = $customerData['notification_title'];
                $tempData['notification_type_id'] = $customerData['notification_type_id'];
                $tempData['customer_id'] = $_SESSION["customerId"];

                $id = $this->Md_customer->saveEmailNotification($tempData);

                if($id > 0)
                    $index++;
			}

		}

		if($index == $totalItem)
			$this->response('success','Customer Email Notification Success', 200, $totalItem);
		else
			$this->response('fail','Customer Email Notification', 200, $totalItem);
	}
	
	
	public function deleteCustomerAddress()
	{
		if($this->get_request_method() != "POST")
		{
            $requestData['id'] = $this->input->get('id');
		}
		else
		{
            $requestData['id'] = $this->input->post('id');
		}

		error_log(print_r($requestData, true));
		$result =  $this->Md_customer->deleteCustomerAddress( $this->input->get('id'));

		$jsonData = array();

		$jsonFinalData['CustomerAddDelete'] =$result;

		$this->response('success','delete customer address.', 200, $jsonFinalData);
	}
	
	
	function getCityFiltered()
	{		

		if($this->get_request_method() != "POST")
		{
			$search_keyword = $this->input->get('search_keyword');
		}
		else
		{
            $search_keyword = $this->input->get('search_keyword');
		}
		$result = $this->Md_customer->getCityFiltered($search_keyword);
		//error_log(print_r($requestData, true));
       	//$result = $this->Md_customer->getCustomerDetailsFull($search_keyword);
		$jsonData = array();

		foreach ($result as $country)
		{
        $countries['id'] = $country->id;
        $countries['city'] = $country->city;
        $countries['state_id'] = $country->state_id;
        $countries['state_title'] = $country->state_title;
        $countries['idCountry'] = $country->idCountry;
        $countries['countryName'] = $country->countryName;
        $jsonData[] = $countries;
		}
		//SELECT `CT`.`id`, `CT`.`city`, `ST`.`state_id`, `ST`.`state_title`, `CN`.`idCountry`, `CN`.`countryName` 
		$jsonFinalData['cities'] =$result;// $jsonData;

		$this->response('success','cityList', 200, $jsonFinalData);
		//$this->response($jsonFinalData);
	}
	
	
	public function getFavourite_Product_List()
	{
		
		$requestData = array();

		if($this->get_request_method() != "POST")
		{
            $requestData['customer_id'] = $this->input->get('customer_id');
		}
		else
		{
            $requestData['customer_id'] = $this->input->post('customer_id');
		}

		error_log(print_r($requestData, true));

		$result = $this->Md_customer->getFavourite_Product_List($requestData);
		$jsonData = array();
		foreach ($result as $productDetails)
		{

			$product['product_id'] = $productDetails->product_id;
			$product['product_name'] = $productDetails->product_name;
			$product['product_image'] = $this->config->item('base_image_url') . "/images/ecom/product/" . $productDetails->product_image;
			$product['short_description'] = $productDetails->short_description;
			$product['product_details'] = $productDetails->product_details;
			$product['features'] = $productDetails->features;
			$product['properties'] =  $productDetails->properties;
			$product['instructions'] = $productDetails->instructions;
			$product['warranty'] = $productDetails->warranty;
			$product['returns'] = $productDetails->returns;

			$product['seller_id'] = $productDetails->market_seller_id;
			$product['seller_name'] = $productDetails->market_seller_name;
			$product['seller_email'] = $productDetails->market_seller_email;
			$product['seller_mbl'] = $productDetails->market_seller_mbl;
			$product['seller_logo_image'] = $this->config->item('base_image_url') . "/seller-img/" . $productDetails->market_seller_logo_image;
			$product['introduction'] = $productDetails->introduction;
			$product['seller_description'] = $productDetails->market_seller_description;
			$product['website'] = $productDetails->website;
			$product['ranking'] = $productDetails->ranking;
			$product['flag_agree_t_c'] = $productDetails->flag_agree_t_c;
            //$product['product_images'] = $this->products->getProductImages($product['product_id']);
			$product['inventory'] = $productDetails->inventory;
			$product['currency_code'] = $productDetails->currency_code;
			$product['market_seller_price'] = $productDetails->market_seller_price;
			$product['market_seller_margin'] = $productDetails->market_seller_margin;
			$product['market_seller_offer'] = $productDetails->market_seller_offer;
			//$product['RoomIdea'] =  $productDetails->RoomIdea;
			//$product['RoomIdea_id'] =  $productDetails->RoomIdea_id;
            $product['Selling_price'] =  $productDetails->Selling_price;
			$product['itemcount'] = $productDetails->itemcount;
			$product['selectedId'] = $productDetails->selectedId;
			$jsonData[] = $product;
		}


		$jsonFinalData['Product'] = $jsonData;

		$this->response('success','Favourite Product List', 200, $jsonFinalData);
	}
	
	function getDesignerTopRatedTheme($designerId)
	{
		$result = $this->designers->getDesignerTopRatedTheme($designerId);
		$jsonData = array();
		//var_dump($result);
		foreach ($result as $designDetails)
		{
			$designs['design_id'] = $designDetails->design_id;
			$designs['design_name'] = $designDetails->design_name;
			$designs['design_display_name'] = $designDetails->design_display_name;
			$designs['img'] =$this->config->item('base_image_url') . "/images/masterdsg-img/" . $designDetails->design_img;
            $designs['thumb_img'] =$this->config->item('base_image_url') . "/images/masterdsg-img/388x300/" . $designDetails->design_img;

			$jsonData[] = $designs;
		}

		$jsonFinalData['designsImage'] = $jsonData;

		return $jsonFinalData;
	}
	
	
	function getDesignerTopRatedPortfolio($designerId)
	{
		$result = $this->designers->getDesignerTopRatedPortfolio($designerId);
		$jsonData = array();
		//var_dump($result);
		foreach ($result as $designDetails)
		{
			$designs['portfolio_id'] = $designDetails->portfolio_id;
			$designs['portfolio_name'] = $designDetails->portfolio_name;
			$designs['img'] =$this->config->item('base_image_url') . "/images/master-execution-images/" . $designDetails->master_image;
            $designs['thumb_img'] =$this->config->item('base_image_url') . "/images/master-execution-images/388x300/" . $designDetails->master_image;

			$jsonData[] = $designs;
		}

		$jsonFinalData['portfolioImage'] = $jsonData;

		return $jsonFinalData;
	}
	
	
	function RemoveCart()
	{
		$shopingCart = new shopingCart();
		$shopingCart->ClearCart();
	}
	
	public function alreadyRegisterEmail()
	{
		$userEmailId = "";
		if($this->get_request_method() != "POST")
		{
			$userEmailId = $this->input->get('emailId');
		}
		else
		{
            $userEmailId = $this->input->post('emailId');
		}
		
		if(isset($userEmailId ))
		{
			
			$authData = $this->Md_customer->getCustomerDetails('customer_id', array('customer_username'=> $userEmailId ));
			if(isset($authData))
			{	
				if(isset($_SESSION["customerId"]))
					$this->response('success','Design Features Product', 200, true);
                                
				else
					$this->response('success','Design Features Product', 200, false);
			}
			else
				$this->response('success','Design Features Product', 200, false);
		}
		
	}
	
	
	function getSortingMenus()
	{

		$requestData = array();

		if($this->get_request_method() != "POST")
		{
			$requestData['menu'] = $this->input->get('menu');
		}
		else
		{
			$requestData['menu'] = $this->input->post('menu');
		}
		$jsonData = array();

		if (!empty($requestData['menu']))
        {
            if ($requestData['menu']=='design')
            {
                $sortmenu['title'] = 'Theme';
                $jsonData[] = $sortmenu;
                $sortmenu['title'] = 'Rooms';
                $jsonData[] = $sortmenu;
            }
            else if ($requestData['menu']=='designerpf')
            {
                $sortmenu['title'] = 'Portfolio';
                $jsonData[] = $sortmenu;
                $sortmenu['title'] = 'Theme';
                $jsonData[] = $sortmenu;
                $sortmenu['title'] = 'Rooms';
                $jsonData[] = $sortmenu;

            }
            else
            {
                $sortmenu['title'] = 'Work';
                $jsonData[] = $sortmenu;
                $sortmenu['title'] = 'Look For';
                $jsonData[] = $sortmenu;
            }
        }

		$jsonFinalData['sortmenu'] = $jsonData;

		$this->response('success','menu list', 200, $jsonFinalData);

	}
	
	public function profilePicUpload()
	{

	    $json = array();

	    $config['upload_path']          = 'media/images/user-profile';
	    $config['allowed_types']        = 'jpg';
	    $config['encrypt_name']         = FALSE;
		$config['file_name'] = $_SESSION["customerId"];

	    $this->upload->initialize($config);

	    if ( ! $this->upload->do_upload('file') )
	    {
	        $json = array('error' => true, 'message' => $this->upload->display_errors());
	        $this->response('error','File Uploaded', 400, $json);
	        return;
	    }
	    else
	    {
	        $upload_details = $this->upload->data();
			$this->saveProfileImage($upload_details);
	        $json = array('success' => true, 'message' => 'File transfer completed', 'newfilename' => $upload_details['file_name']);
	    }

	    $this->response('success','File Uploaded', 200, $json);
	}
	
	public function getPicUploaded()
	{

	    $json = array();
        $json = array('success' => true, 'message' => 'File transfer completed', 'newfilename' => $_SESSION["customer_photo"]);
	    $this->response('success','File Uploaded', 200, $json);
	}
	
	

        
//        public function getstartedRequest()
//	{
//		$requestData = array();
//		$requestData['phone_no'] = $this->input->post('contactinfo');
//	        $requestData['remote_address'] = $_SERVER['REMOTE_ADDR'];
//		$requestData['ondatetime'] = date('Y-m-d H:i:s');
//		
//		$orderId = $this->Md_customer->getstartedRequest($requestData);
//
//		if($orderId)
//		{ 
//	        $_SESSION['get_started_form'] = "Request Sent";
//	        $this->response('success','Request Sent', 200, "hi");
//		}
//	}
  
        
         public function getstartedRequest() {

       
        
        $requestData = array();
        $requestData['phone_no'] = $_POST['contactinfo'];
        $requestData['remote_address'] = $_SERVER['REMOTE_ADDR'];
        $requestData['comment'] = 'Connect with us';
        
        //$data_order['unique_oid'] = $this->Md_customer->getUniqueOrderID();
        $data_order['special_request'] = $requestData['comment'];
        //$data_order['marketplace_comments'] = $requestData['comment'];
        $data_order['pipeline_load_date'] = date('Y-m-d H:i:s');
        $data_order['remote_address'] = $requestData['remote_address'];
        $data_order['order_channel_type'] = 'Web';
        $data_order['status'] = '1';
        $data_order['leadGenFromSliderPageType'] = $_POST['leadGenFromSliderPageType'];
        if(!empty($_POST['leadGenFromSliderPageUniqueId'])){
        $data_order['leadGenFromSliderPageUniqueId'] = $_POST['leadGenFromSliderPageUniqueId'];        
        }
        $data_order['leadGenFromSliderPageURL'] = $_POST['leadGenFromSliderPageURL'];
        $data_order['user_landing_page'] = $_POST['user_landing_page'];
        $data_order['campaign_utm_param'] = $_POST['utm'];
        $data_order['scheme'] = $_POST['scheme'];
		
		/*[start:check scheme record already available or not]*/
        $resultFbCampaignDtls = $this->Md_customer->getSchemeDetails($data_order['scheme']);
        if(!empty($resultFbCampaignDtls)){
			$data_order['apartment_name'] = $resultFbCampaignDtls[0]['campaign_name'];
		}		
		/*[end:check scheme record already available or not]*/
		
        $data['customer_details'] = $this->Md_customer->getCustomerDetailsByPhone($requestData['phone_no']);

        if (empty($data['customer_details'])) {
          
            /* If user not exist Insert new customer data in customer details table and Create lead */
            $table = 'customer_details';
            $data = array(
                'customer_username' => $requestData['phone_no'],
                'customer_password' => md5($requestData['phone_no']),
                'remote_address' => $requestData['remote_address'],
                'status' => '1',
                'on_date' => date('Y-m-d H:i:s'),
                'last_update_date' => date('Y-m-d H:i:s')
            );
            $this->Md_database->insertData($table, $data);
            $last_insert_id = $this->db->insert_id();

            if ($last_insert_id) {
              

                /* insert Customer Mobile or phone */
                $table = 'customer_phone';
                $data = array(
                    'customer_id' => $last_insert_id,
                    'customer_phone' => $requestData['phone_no']
                );
                $this->Md_database->insertData($table, $data);


                $table = 'customer_details';
                $condition = array('customer_id' => $last_insert_id);
                $customer_details = $this->Md_database->getData($table, 'customer_id,customer_name', $condition, '', '');
                
                $data_order['customer_id'] = $customer_details[0]['customer_id'];
               
                $result = $this->Md_customer->createCustomerOrder($data_order);
                echo 'New User'.'|*|*|';
                echo $result.'|*|*|';
                echo "order saved succesfully";die;
            }
        }else{
            //echo "exist";die;
            $data_order['customer_id'] = $data['customer_details'][0]['customer_id'];
           
            $result = $this->Md_customer->createCustomerOrder($data_order);
            
//            if(!empty($result)){
//               
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
	
	public function getpriceRequest()
	{
		$requestData = array();
		if($this->get_request_method() != "POST")
		{
			if($this->input->get('contentinfo') == "Email-started")
			{
				$requestData['email_id'] = $this->input->get('contactinfo');
			}
			else
			{
				$requestData['phone_no'] = $this->input->get('contactinfo');
			}
                        if($this->input->get('mobile')){
                            $requestData['phone_no'] = $this->input->get('mobile');
                        }
			$requestData['name'] = $this->input->get('name');
			$requestData['product_id'] = $this->input->get('productid');
			$requestData['quantity'] = $this->input->get('quantity');
			$requestData['remote_address'] = $this->input->get('remote_address');

		}
		else
		{
			if($this->input->post('contentinfo') == "Email-started")
			{
				$requestData['email_id'] = $this->input->post('contactinfo');
			}
			else
			{
				$requestData['phone_no'] = $this->input->post('contactinfo');
			}
                        
                        if($this->input->post('mobile')){
                            $requestData['phone_no'] = $this->input->post('mobile');
                        }
			$requestData['name'] = $this->input->post('name');
			$requestData['product_id'] = $this->input->post('productid');
			$requestData['quantity'] = $this->input->post('quantity');
			$requestData['remote_address'] = $this->input->post('remote_address');
		}
		
		$requestData['ondatetime'] = date('Y-m-d H:i:s');
                
                $requestData['leadGenFromSliderPageType'] = $_POST['leadGenFromSliderPageType'];
                if(!empty($_POST['leadGenFromSliderPageUniqueId'])){
                $requestData['leadGenFromSliderPageUniqueId'] = $_POST['leadGenFromSliderPageUniqueId'];        
                }
                $requestData['leadGenFromSliderPageURL'] = $_POST['leadGenFromSliderPageURL'];
                $requestData['user_landing_page'] = $_POST['user_landing_page'];
                $requestData['campaign_utm_param'] = $_POST['utm'];
                $requestData['scheme'] = $_POST['scheme'];
                $requestData['campaign_name'] = '';
				
				/*[start:check scheme record already available or not]*/
				$resultFbCampaignDtls = $this->Md_customer->getSchemeDetails($requestData['scheme']);
				if(!empty($resultFbCampaignDtls)){
					$requestData['apartment_name'] = $resultFbCampaignDtls[0]['campaign_name'];
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
            echo 'New User'.'|*|*|';
            }
        else{
            echo 'Existing User'.'|*|*|';
        }
               
                $order_id = $this->cheUserExistorNotNew($requestData);
                
//                if(!empty($order_id)){
//                    
//                     $table ="customer_getprice_enquiry";
//                     $data = array('order_id'=>$order_id);
//                     $condition = array('id' => $getPriceOrderId);
//                     $this->Md_database->updateData($table, $data, $condition);
//                }
                
                
                
		//if($getPriceOrderId)
		if($order_id)
		{ 
			//$this->response('success','Request Sent', 200, "hi");
            
                echo $order_id.'|*|*|';
                echo "order saved succesfully";die;
		}
	}
        
     
        public function cheUserExistorNotNew($requestData=''){
//            $requestData['email_id']='test@nomail.com';
//            $requestData['phone_no']='4564564567';
//            $requestData['product_id']='1';
           // print_r($requestData);
            $customer_details = array();
            
            /* Check user already exist or not first priority on email as customer_username 
             * and second priority mobile or phone as customer_username 
             */
//            $table = "customer_details";
//            $condition = "";
//            if(!empty($requestData['email_id'])){
//               $condition = " customer_username = '". $requestData['email_id']."'"; 
//                $customer_details = $this->Md_database->getData($table, 'customer_id,customer_name', $condition, '', ''); 
//            }
//           
//            if(!empty($requestData['phone_no']) && empty($customer_details)){
//               $condition = " customer_username = '". $requestData['phone_no']."'"; 
//               $customer_details = $this->Md_database->getData($table, 'customer_id,customer_name', $condition, '', ''); 
//            }
             if(!empty($requestData['phone_no'])){
                $customer_details = $this->Md_customer->getCustomerDetailsByPhone($requestData['phone_no']);
             }
             if(empty($customer_details)){
             $customer_details = $this->Md_customer->getCustomerDetailsByemail($requestData['email_id']);
             }
          //  print_r($customer_details);die;
            /* Get product details */
            $productDetails= array();
            $flag_lob = "";
            if(!empty($requestData['product_id'])){
                $table = "ecom_products";
                $condition = array('product_id'=>$requestData['product_id']);
                $productDetails = $this->Md_database->getData($table, 'product_id,product_sku_id,product_name', $condition, '', ''); 
                $flag_lob = 2;
            }
            
            if(empty($customer_details)){
                /* If user not exist Insert new customer data in customer details table and Create lead*/
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
            $requestData['customer_id']=$last_insert_id;  
            if($last_insert_id){
                /* insert Customer email*/
                 $table = 'customer_email';
                $data = array(
                        'customer_id' => $last_insert_id,
                        'customer_email' => $requestData['email_id']
                        );
                        $this->Md_database->insertData($table, $data);
                        
                /* insert Customer Mobile or phone*/
                 $table = 'customer_phone';
                $data = array(
                        'customer_id' => $last_insert_id,
                        'customer_phone' => $requestData['phone_no']
                        );
                        $this->Md_database->insertData($table, $data);
                
                
                
                $mailData['customer_name']=$requestData['name'];
                $mailData['customer_email']=$requestData['email_id'];
                $mailData['customer_password']=$requestData['phone_no'];
                
              //  $orderResult = $this->signUpEmail($mailData,$requestData['phone_no']);
		
                $table= 'customer_details';
                $condition = array('customer_id'=>$last_insert_id); 
                $customer_details = $this->Md_database->getData($table, 'customer_id,customer_name', $condition, '', ''); 
          
            }
                
            }
            
            else if(!empty($customer_details)){
            $requestData['customer_id']=$customer_details[0]['customer_id'];
            
            $customerMobilephone = $this->Md_customer->getCustomerMobileFull($requestData);
                               
            $mobile_array=array();
            foreach($customerMobilephone as $array){
                $mobile_array[] = $array['customer_phone'];
            }     
//echo "<pre>"; print_r($mobile_array);
            if ( (! in_array( $requestData['phone_no'], $mobile_array)) )
            {

               if (!empty($requestData['phone_no'])){	
                //   echo "<pre>"; print_r($requestData['phone_no']);die;
                $newPhone['customer_id']    =  $requestData['customer_id'];
                $newPhone['customer_phone'] =  $requestData['phone_no'];	
                $results = $this->Md_customer->createCustomerPhone($newPhone);	
               }

            }




            // Check user's new email exist or not , if not exist then update email
            $customerEmails = $this->Md_customer->getCustomerEmailFull($requestData);

            $email_array=array();
            foreach($customerEmails as $array){
                $email_array[] = $array['customer_email'];
            } 
            //print_r($email_array);die;
            if(! in_array($requestData['email_id'], $email_array))
            {
               if (!empty($requestData['email_id'])){	
                $newEmail['customer_id']    =  $requestData['customer_id'];
                $newEmail['customer_email'] =  $requestData['email_id'];			 			 
                $results =  $this->Md_customer->createCustomerEmail($newEmail);
               }
            }
            
            }
                 $OrderData['leadGenFromSliderPageType'] = $_POST['leadGenFromSliderPageType'];
                    if(!empty($_POST['leadGenFromSliderPageUniqueId'])){
                    $OrderData['leadGenFromSliderPageUniqueId'] = $_POST['leadGenFromSliderPageUniqueId'];
                    }
                    $OrderData['leadGenFromSliderPageURL'] = $_POST['leadGenFromSliderPageURL'];
                $table = 'jb080_pipeline_details';
                $data = array(
                'customer_id' => $customer_details[0]['customer_id'],
                'order_channel_type' => 'Web',
                'special_request' => 'Customer looking for Product ID: #'.$productDetails[0]['product_id'].' Product SKU ID : '.$productDetails[0]['product_sku_id'].' Product Name: '.$productDetails[0]['product_name'],
                'status' => '1',
                'remote_address' => $requestData['remote_address'],
                'pipeline_load_date' => date('Y-m-d H:i:s'),
                'flag_lob' => $flag_lob,
                'product_id'=> (!empty($requestData['product_id']))? $requestData['product_id']:null,
                'leadGenFromSliderPageType'=> (!empty($requestData['leadGenFromSliderPageType']))? $requestData['leadGenFromSliderPageType']:null,
                'leadGenFromSliderPageUniqueId'=> (!empty($requestData['leadGenFromSliderPageUniqueId']))? $requestData['leadGenFromSliderPageUniqueId']:null,
                'leadGenFromSliderPageURL'=> (!empty($requestData['leadGenFromSliderPageURL']))? $requestData['leadGenFromSliderPageURL']:null,
                'user_landing_page'=> (!empty($requestData['user_landing_page']))? $requestData['user_landing_page']:null,
                'campaign_utm_param'=> (!empty($requestData['campaign_utm_param']))? $requestData['campaign_utm_param']:null,
                'scheme'=> (!empty($requestData['scheme']))? $requestData['scheme']:null,
				'apartment_name'=> (!empty($requestData['apartment_name']))? $requestData['apartment_name']:null
            );
            $this->Md_database->insertData($table, $data);
            $order_id = $this->db->insert_id();
            
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
            return $order_id;
            }
           
         
       
        
        public function ajaxCheckUserMail(){
        $email = $_GET['email'];
        if(!empty($email)){
            $table = 'customer_email';
            $condition = array('customer_email'=>$email);
            $result = $this->Md_database->getData($table,'id',$condition,'','');
               if(!empty($result)){
                 echo 'false';  die;
               } else{
                   echo 'true';die;
               }
        }
        
    }
    public function ajaxCheckUserMobile(){
        $mobile = $_GET['mobile'];
        if(!empty($mobile)){
            $table = 'customer_phone';
            $condition = array('customer_phone'=>$mobile);
            $result = $this->Md_database->getData($table,'id',$condition,'','');
               if(!empty($result)){
                 echo 'false';  die;
               } else{
                   echo 'true';die;
               }
        }
    }
    
    public function SaveCurrentVisitedUrl(){
    $CurrentVisitedUrl = $_POST['CurrentVisitedUrl'];
        if(!empty($CurrentVisitedUrl)){
          echo $this->session->set_userdata('CurrentVisitedUrl',$CurrentVisitedUrl);
          die;
        }
    }
    
  
    
}