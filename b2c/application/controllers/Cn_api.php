<?php
class Cn_api extends CI_Controller
{
	private $_code = 200;
	public $_content_type = "application/json";

	public function __construct()
	{
		parent::__construct();
//		$this->load->model('apartment');
//		$this->load->model('designers');
//		$this->load->model('execution');
		$this->load->model('Md_customer');
//		$this->load->model('products');
//		$this->load->library('session');
//		$this->load->library('shopingcart');
//		$this->load->library('upload');
//		$this->load->model('order');
       // $this->load->library('layout', 'layout');
       // $this->load->helper('url');
	}
        
        public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
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
       	//$result = $this->customer->getCustomerDetailsFull($search_keyword);
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
}

