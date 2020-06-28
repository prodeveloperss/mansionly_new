<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hauth extends CI_Controller {

	public function __construct()
	{
		//Constructor to auto-load HybridAuthLib 
		parent::__construct();
		$this->load->library('HybridAuthLib');
		$this->load->model('Md_customer');
	}

	public function login($provider)
	{
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);
				
				if ($service->isUserConnected())
				{
					//log_message('debug', 'controller.HAuth.login: user authenticated.');
					log_message('debug', 'controller.HAuth.login: user authenticated.');
                    $user_profile = $service->getUserProfile();
                    log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
                    $data['user_profile'] = $user_profile;
					/*
					echo "<pre>"; print_r($user_profile); echo "</pre>";				
					echo "<pre>"; print_r($_SESSION); echo "</pre>";				
					echo "<pre>"; print_r($provider); echo "</pre>";
					print_r($service); 
					echo "<hr>";*/
					
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
						if(!empty($data['userprofiles']))
						{
							$birthDate = $data['userprofiles']->birthYear."-".$data['userprofiles']->birthMonth."-".$data['userprofiles']->birthDay;
							$url = base_url().'Cn_customer/customerRegister';
							$fields = array(
								'fullName' => urlencode($data['userprofiles']->displayName),
								'dob' => (($birthDate!="0000-00-00"&&!empty($birthDate))?urlencode($birthDate):null),
								'address' => null,
								'city' => urlencode(0),
								'password' => urlencode($data['userprofiles']->identifier),
								'username' => urlencode($data['userprofiles']->email),
								'occupation' => null,
								'aboute_me' => null,
								'favourite_style' => null,
								'remote_address' => $_SERVER['REMOTE_ADDR'],
								'email' => urlencode($data['userprofiles']->email),
								'phone' => urlencode(null),
								'mobile' => urlencode(null),
								'isexternal_users'=>urlencode(1),
								'socialtype'=>urlencode($data['socialtype'])
							);
							//url-ify the data for the POST
							$fields_string='';
							foreach($fields as $key=>$value) { 
								$fields_string .= $key.'='.$value.'&'; 
							}
							rtrim($fields_string, '&');
				
							//open connection
							$ch = curl_init();
				
							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							//execute post
							$result=curl_exec($ch);
							
							if (curl_errno($ch)) {
								// this would be your first hint that something went wrong
								die('Couldn\'t send request: ' . curl_error($ch));
							} else {
								// check the HTTP status code of the request
								$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
								if ($resultStatus != 200) {
									die('Request failed: HTTP status code: ' . $resultStatus);
								} 
							}
				
							$json = $result;
							for ($i = 0; $i <= 31; ++$i) { 
								$json = str_replace(chr($i), "", $json); 
							}
							$json = str_replace(chr(127), "", $json);
							// This is the most common part
							// Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
							// here we detect it and we remove it, basically it's the first 3 characters 
							if (0 === strpos(bin2hex($json), 'efbbbf')) {
								$json = substr($json, 3);
							}
							$json = json_decode($json);
							//Ifcase:						   
							if($json->msg==='User Created'){
								$_SESSION["customerId"]=$json->data;
								$_SESSION["customer_id"]=$json->data;
							}else{
							 	$_SESSION["customerId"]=$json->data->customer_id;
								$_SESSION["customer_id"]=$json->data->customer_id;
							}
							$_SESSION["customerName"] = $data['userprofiles']->displayName;
							$_SESSION["socialtype"] = $data['socialtype'];
							$requestData['outh_provider'] = $data['socialtype'];
							$requestData['outh_uid'] = $data['userprofiles']->identifier;
							$_SESSION["customer_photo"] = "";
							//saveProfileSocialtype_Identifier
							$userProfile = $this->Md_customer->updateUserProfile($requestData,$_SESSION["customerId"]);
							//close connection
							curl_close($ch);	
						}else{
								$_SESSION["customerId"]=null;
								$_SESSION["customer_id"]=null;								
								$_SESSION["customerName"] =null;
								$_SESSION["socialtype"] =null;
								$_SESSION["customer_photo"] = null;
						}
					/****[End::Social Login Process;]****/	
					//print_r($_SESSION);die;
					/*$fileName = rand();
					$fp = fopen(dirname(__FILE__).'/'.$fileName.'.json', 'w');
					fwrite($fp, json_encode($service));
					fclose($fp);*/
					
					//Redirect back to the index to show the profile
					redirect('users/', 'refresh');
					//print_r($service);
				}
				else // Cannot authenticate user
					{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
				{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'HybridAuth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function logout($provider = "")
	{

		log_message('debug', "controllers.HAuth.logout($provider) called");

		try
		{
			if ($provider == "") {

				log_message('debug', "controllers.HAuth.logout() called, no provider specified. Logging out of all services.");
				$data['service'] = "all";
				$this->hybridauthlib->logoutAllProviders();
			} else {
				if ($this->hybridauthlib->providerEnabled($provider)) {
					log_message('debug', "controllers.HAuth.logout: service $provider enabled, trying to check if user is authenticated.");
					$service = $this->hybridauthlib->authenticate($provider);

					if ($service->isUserConnected()) {
						log_message('debug', 'controller.HAuth.logout: user is authenticated, logging out.');
						$service->logout();
						$data['service'] = $provider;
					} else { // Cannot authenticate user
						show_error('User not authenticated, success.');
						$data['service'] = $provider;
					}

				} else { // This service is not enabled.

					log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
					show_404($_SERVER['REQUEST_URI']);
				}
			}
            
            $_SESSION["customerId"]=null;
            $_SESSION["customerName"] =null;
            $_SESSION["socialtype"] =null;

			// Redirect back to the main page. We're done with logout
			redirect('home/', 'refresh');

		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'Hybriauth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	// Little json api and variable output testing function. Make it easy with JS to verify a session.  ;)
	public function status($provider = "")
	{
		try
		{
			if ($provider == "") {
				log_message('debug', "controllers.HAuth.status($provider) called, no provider specified. Providing details on all connected services.");
				$connected = $this->hybridauthlib->getConnectedProviders();

				if (count($connected) == 0) {
					$data['status'] = "User not authenticated.";
				} else {
					$connected = $this->hybridauthlib->getConnectedProviders();
					foreach($connected as $provider) {
						if ($this->hybridauthlib->providerEnabled($provider)) {
							log_message('debug', "controllers.HAuth.status: service $provider enabled, trying to check if user is authenticated.");
							$service = $this->hybridauthlib->authenticate($provider);
							if ($service->isUserConnected()) {
								log_message('debug', 'controller.HAuth.status: user is authenticated to $provider, providing profile.');
								$data['status'][$provider] = (array)$this->hybridauthlib->getAdapter($provider)->getUserProfile();
							} else { // Cannot authenticate user
								$data['status'][$provider] = "User not authenticated.";
							}
						} else { // This service is not enabled.
							log_message('error', 'controllers.HAuth.status: This provider is not enabled ('.$provider.')');
							$data['status'][$provider] = "provider not enabled.";
						}
					}
				}
			} else {
				if ($this->hybridauthlib->providerEnabled($provider)) {
					log_message('debug', "controllers.HAuth.status: service $provider enabled, trying to check if user is authenticated.");
					$service = $this->hybridauthlib->authenticate($provider);
					if ($service->isUserConnected()) {
						log_message('debug', 'controller.HAuth.status: user is authenticated to $provider, providing profile.');
						$data['status'][$provider] = (array)$this->hybridauthlib->getAdapter($provider)->getUserProfile();
					} else { // Cannot authenticate user
						$data['status'] = "User not authenticated.";
					}
				} else { // This service is not enabled.
					log_message('error', 'controllers.HAuth.status: This provider is not enabled ('.$provider.')');
					$data['status'] = "provider not enabled.";
				}
			}
			$this->load->view('hauth/status', $data);
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'Hybriauth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
