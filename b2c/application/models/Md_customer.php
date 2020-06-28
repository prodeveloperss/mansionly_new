<?php
/*
 ** Customer.php
 ** Purpose: Customer management model
 */

class Md_customer extends CI_Model {

	/* Check if customer already exist */
	public function checkIfAlreadyExist($requestData)
	{
		

        /***********************  check user existence and fetch only customer id *****************************/

		$queryStr = "select distinct customer_id from `jb080_customer_details`";
		$whereStr = "where customer_username like '" . $requestData['customer_username'] . "'";

		$query = $this->db->query($queryStr . " " . $whereStr);

		if ($query->num_rows() > 0)
			return $query->result();
		
		if($requestData['customer_email']){
			$queryStr = "select distinct customer_id from `jb080_customer_email`";
			$whereStr = "where customer_email like '" . $requestData['customer_email'] . "'";
		}
		$query = $this->db->query($queryStr . " " . $whereStr);

		if ($query->num_rows() > 0)
			return $query->result();

		$queryStr = "Select distinct customer_id from `jb080_customer_phone`";
		$whereStr = "where customer_phone like '" . $requestData['customer_phone'] . "' or customer_phone like '" . $requestData['customer_mobile'] . "'";

		$query = $this->db->query($queryStr . " " . $whereStr);

		if ($query->num_rows() > 0)
			return $query->result();




		return false;
	}

	public function registerCustomer($requestData)
	{
		$requestInfo = $requestData;

		unset($requestData['customer_email']);
		unset($requestData['customer_phone']);
		unset($requestData['customer_mobile']);
        unset($requestData['isexternal_users']);
        unset($requestData['remote_address']);


		$this->db->insert("jb080_customer_details", $requestData);

		if ($this->db->affected_rows() > 0)
		{
			$customerId = $this->db->insert_id();
			if (!empty($requestInfo['customer_email']))
			{
				$registerEmail['customer_id'] = $customerId;
				$registerEmail['customer_email'] = $requestInfo['customer_email'];
				$this->db->insert("jb080_customer_email", $registerEmail);
			}
			if (!empty($requestInfo['customer_phone']))
			{
				$registerPhone['customer_id'] = $customerId;
				$registerPhone['customer_phone'] = $requestInfo['customer_phone'];
				$this->db->insert("jb080_customer_phone", $registerPhone);
			}
			if (!empty($requestInfo['customer_mobile']))
			{
				$registerPhone['customer_id'] = $customerId;
				$registerPhone['customer_phone'] = $requestInfo['customer_mobile'];
				$this->db->insert("jb080_customer_phone", $registerPhone);
			}

			return $customerId;
		}
		else
		{
			return false;
		}
	}

	public function customerValidate($requestData)
	{
		$queryStr = "select * from `jb080_customer_details`";
		$whereStr = "where customer_username like '" . $requestData['customer_username'] . "' and status = '1'";

		$query = $this->db->query($queryStr . " " . $whereStr);
		
		if ($query->num_rows > 0)
		return true;
		
		$data = $query->result_array();
                
		if ($data[0]['customer_password'] == md5($requestData['customer_password']))//sha1
			return $data[0]['customer_id'];
		else
			return false;
	}

	public function getCustomerDetails($fields, $where = '')
	{
		$this->db->select($fields,false);
		if (!empty($where)) {
			$this->db->where($where);
		}
        $query = $this->db->get('jb080_customer_details');

        return $query->row_array();
	}
	
        
        

    public function getUniqueOrderID()
    {
		/********************************  Old Logic *****************************/
 
		
		/*************************************** New Logic ****************************/
		$rsNumOfTodaysOrderCount = 0;
		$unique_order_id = "MN".date('mdy'); 
		$sql_string = 'SELECT count(o_id) AS num_of_todays_order FROM jb080_order_dtl AS OD WHERE CAST(OD.on_date AS DATE)="'.date('Y-m-d').'"';
		$query = $this->db->query($sql_string);
		$row = $query->row_array();
		$rsNumOfTodaysOrderCount = $row['num_of_todays_order'];
		$rsNumOfTodaysOrderCount +=1; 
		$unique_order_id = $unique_order_id.'O'. $rsNumOfTodaysOrderCount ; 
		return $unique_order_id;
    }

    public function getOrderDetails($fields, $where = '')
    {
        $this->db->select($fields,false);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get('jb080_order_dtl');

        return $query->row_array();
    }

    public function createCustomerOrder($requestData)
    {
        
        $this->db->insert("jb080_pipeline_details", $requestData);
        if ($this->db->affected_rows() > 0)
        {
            $orderId = $this->db->insert_id();
            
            if(!empty($requestData['scheme'])){

                /*get scheme details in fb campaign table*/
                  $this->db->select('id,scheme');
                  $this->db->from('jb080_fb_campaign_name');
                  $this->db->where('scheme',$requestData['scheme']);
                  $query = $this->db->get();
                  $result=$query->result_array();

                if(empty($result)){
                /*Insert scheme in fb campaign table*/
                $data = array('scheme'=> (!empty($requestData['scheme']))? $requestData['scheme']:null);
                $this->db->insert("jb080_fb_campaign_name",$data);
                }
            }
            return $orderId;
        }
        else
        {
            return false;
        }
    }
    
    public function SaveCustomerComment($MarketCommentData)
    {
        $this->db->insert("jb080_order_dtl_mapp_lead_kyc", $MarketCommentData);
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    

    public function getCustomerEmailNotificationType($requestData)
    {
		$queryStr = 'select  t1.id_notification_type,t1.notification_title, t2.notification_type_id from
		jb080_customer_email_notification_type t1
		left join
		(
		select t2.notification_type_id from jb080_customer_details t1 join jb080_customer_setting_newsletter_preferences t2
		on t1.customer_id = t2.customer_id
		where t1.customer_id = '.$requestData['customer_id'].'	) t2
		on t1.id_notification_type = t2.notification_type_id';
		//echo $queryStr;
        $query = $this->db->query($queryStr);
		return $query->result();
	}

    public function getCustomerAllAddress($requestData)
    {
        $queryStr = 'select t1.customer_id, t1.customer_name,
	t5.address_type,t5.full_name, t5.id Address_id,t5.address_line1,t5.address_line2,t5.postal_code,t5.extension_code,t5.phone_number,
	t5.flag_default_shipping_adrs,t5.flag_default_billing_adrs,t2.id city_id, t2.state_id, t3.country_id, t2.city, t3.state_title, t4.countryCode, t4.countryName, t4.currency from jb080_customer_details t1
	left outer join jb080_customer_address_details t5 on t5.customer_id = t1.customer_id
	left outer join jb080_master_city t2 on t2.id = t5.city_id
	left outer join jb080_state t3 on  t3.state_id = t2.state_id
	left outer join jb080_countries t4 on t4.idCountry = t3.country_id';
        $whereStr = " where t1.status = '1' ";
        //echo $queryStr;
        if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " and " . " t1.customer_id = '" . $requestData['customer_id'] . "'";
            }
            if (!empty($requestData['customer_name']))
            {
                $whereStr = $whereStr . " and " . " t1.customer_name = '" . $requestData['customer_name'] . "'";
            }
            if (!empty($requestData['Address_id']))
            {
                $whereStr = $whereStr . " and " . " t5.id = '" . $requestData['Address_id'] . "'";
            }
        }

		$query = $this->db->query($queryStr . " " . $whereStr);

		return $query->result();
	}

	public function getCustomerAddress($customer_id)
    {
        $queryStr = 'select t1.customer_id, t1.customer_name,
	t5.address_type,t5.full_name, t5.id Address_id,t5.address_line1,t5.address_line2,t5.postal_code,t5.extension_code,t5.phone_number,
	t5.flag_default_shipping_adrs,t5.flag_default_billing_adrs,t2.id city_id, t2.state_id, t3.country_id, t2.city, t3.state_title, t4.countryCode, t4.countryName, t4.currency from jb080_customer_details t1
	left outer join jb080_customer_address_details t5 on t5.customer_id = t1.customer_id
	left outer join jb080_master_city t2 on t2.id = t5.city_id
	left outer join jb080_state t3 on  t3.state_id = t2.state_id
	left outer join jb080_countries t4 on t4.idCountry = t3.country_id';
        $whereStr = " where t1.status = '1' ";



        if (!empty($customer_id))
		{
			$whereStr = $whereStr . " and  t1.customer_id = '" . $customer_id . "'";
		}


		$query = $this->db->query($queryStr . " " . $whereStr);

		return $query->result();
	}

	public function getCustomerDetailsFull($requestData)
	{
          

 $queryStr = 'SELECT t1.*, t2.id city_id, t2.state_id, t3.country_id,t2.city, 
              t3.state_title,t4.countryCode, t4.countryName,t4.currency
              FROM jb080_customer_details AS  t1	 
              left  join jb080_master_city t2 on t2.id = t1.customer_city_id  
              left  join jb080_state t3 on  t3.state_id = t2.state_id  
              left  join jb080_countries t4 on t4.idCountry = t3.country_id   ';
	      $whereStr = " where t1.status = '1' ";
        //echo $queryStr;
        if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " and " . " t1.customer_id = '" . $requestData['customer_id'] . "'";
            }
//            if (!empty($requestData['customer_name']))
//            {
//                $whereStr = $whereStr . " and " . " t1.customer_name = '" . $requestData['customer_name'] . "'";
//            }
        }
//echo $queryStr . " " . $whereStr;die;
		$query = $this->db->query($queryStr . " " . $whereStr);

		return $query->result();
	}

	/**************************** KP ***********************************/

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

	public function getCustomerMobileFull($requestData)
	{

        $queryStr = 'SELECT id, customer_id , customer_phone  FROM jb080_customer_phone';
        $whereStr = " where ";
        //echo $queryStr;
		if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " customer_id = '" . $requestData['customer_id'] . "'";
            }
//            if (!empty($requestData['customer_name']))
//            {
//                $whereStr = $whereStr . " and " . " customer_name = '" . $requestData['customer_name'] . "'";
//            }
        }
        //echo  $queryStr . " " . $whereStr;
        $query = $this->db->query($queryStr . " " . $whereStr);

       // return $query->result();
        return $query->result_array();
	}

	public function getCustomerCreditCardDetails($requestData)
	{

        $queryStr = 'SELECT *  FROM jb080_customer_card_details';
        $whereStr = " where ";
        //echo $queryStr;
		if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " customer_id = '" . $requestData['customer_id'] . "'";
            }
            if (!empty($requestData['customer_name']))
            {
                $whereStr = $whereStr . " and " . " customer_name = '" . $requestData['customer_name'] . "'";
            }
        }
        //echo  $queryStr . " " . $whereStr;
        $query = $this->db->query($queryStr . " " . $whereStr);

        return $query->result();
	}

	public function getCustomerEmailFull($requestData)
	{
		$queryStr = 'SELECT id, customer_id , customer_email  FROM jb080_customer_email';

        $whereStr = " where ";
        //echo $queryStr;
		if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr =  $whereStr . " customer_id = '" . $requestData['customer_id'] . "'";
            }
//            if (!empty($requestData['customer_name']))
//            {
//                $whereStr = $whereStr . " and " . " customer_name = '" . $requestData['customer_name'] . "'";
//            }
        }
        //echo  $queryStr . " " . $whereStr;
        $query = $this->db->query($queryStr . " " . $whereStr);

        return $query->result_array();
	}

	public function updateUserProfile($requestData,$customerId)
    {

		$this->db->set($requestData);
		$this->db->where("customer_id", $customerId);
		$this->db->update("jb080_customer_details", $requestData);
    }
    
    public function updateUserPassword($requestData,$customerId)
    {

		$this->db->set($requestData);
		$this->db->where("customer_id", $customerId);
		$this->db->update("jb080_customer_details", $requestData);
    }
	public function updateCustomerEmail($requestData,$customerId)
    {
		$this->db->set($requestData);
		$this->db->where("customer_id",$customerId);
		$this->db->update("jb080_customer_email", $requestData);
    }

	public function updateCustomerPhone($requestData, $customerId)
    {
		$this->db->set($requestData);
		$this->db->where("customer_id",$customerId);
		$this->db->update("jb080_customer_phone", $requestData);
    }

	public function updatCustomerShippingDetail($requestData,$customerId, $addressId)
    {
        // insert and update logic to be implemented
        if($addressId == 0)
        {
            $this->db->insert("jb080_customer_address_details", $requestData);
        }
        else
        {
            $this->db->set($requestData);
            $this->db->where("id", $addressId);
            $this->db->update("jb080_customer_address_details", $requestData);
        }



    }


	public function updatCustomerCreaditCardDetail($requestData,$customerId, $CCId)
    {
        // insert and update logic to be implemented
        if($CCId == 0)
        {
            $this->db->insert("jb080_customer_card_details", $requestData);
        }
        else
        {
            $this->db->set($requestData);
            $this->db->where("id", $CCId);
            $this->db->update("jb080_customer_card_details", $requestData);
        }



    }

	public function SaveCustomerFavorite($requestData)
	{

		$queryStr = "select * from `jb080_customer_favorites_list`";
		$whereStr = "where customer_id = " . $requestData['customer_id'] . " and favorites_type = '".$requestData['favorites_type']."' and favorites_record_id = ".$requestData['favorites_record_id'];
		//echo $queryStr . " " . $whereStr."------------->";
		$query = $this->db->query($queryStr . " " . $whereStr);
		$result = $query->result();
		if ($query->num_rows() > 0)
		{     

            $CurrRecordId='';
            foreach($result as $temp)
            { 
                $CurrRecordId=$temp->id; 
            } 

            //$this->db->where("id", $requestData['id']); 
            $this->db->where("id",  $CurrRecordId);
			$this->db->delete("jb080_customer_favorites_list");
		}
		else
		{  
			$this->db->insert("jb080_customer_favorites_list", $requestData);
		}

		$query = $this->db->query($queryStr . " " . $whereStr);
		return $query->result();
	}

	public function getCustomerFavorite($requestData)
	{

		$queryStr = "select * from jb080_customer_details t1 left outer join jb080_customer_favorites_list t2 on t1.customer_id = t2.customer_id";
		$whereStr = "where 1 = 1 " ;
        if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " and " . " t1.customer_id = '" . $requestData['customer_id'] . "'";
            }
            if (!empty($requestData['customer_name']))
            {
                $whereStr = $whereStr . " and " . " favorites_type = '" . $requestData['favorites_type'] . "'";
            }
        }
		//echo  $queryStr . " " . $whereStr."------------------>";
		$query = $this->db->query($queryStr . " " . $whereStr);
		return $query->result();
	}

	public function getFavoriteTypewiseCount($requestData)
	{
		$queryStr = 'select count(1) itemcount, favorites_type from jb080_customer_favorites_list ';
		$whereStr = " where 1 = 1 ";
		if (!empty($requestData))
		{
			if (!empty($requestData['favorites_type']))
			{
				$whereStr = $whereStr . " and " . " favorites_type = '" . $requestData['favorites_type'] . "'";
			}
		}

		$groupbyStr =" group by favorites_type ";
		//echo  $queryStr . " " . $whereStr. " " . $groupbyStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $groupbyStr);
		return $query->result();
    }

	public function getCustomerFavoriteDesigner($requestData)
	{
		/* This is for fetching the favorite designer */

		
		$customerid=0;
		if(isset($_SESSION["customerId"]))
			$customerid = $_SESSION["customerId"];
        
		$queryStr = " select t3.id,designer_name,designer_email_id,designer_mobile_no,introduction,designer_description, 
		design_philosophy,design_awards,designer_logo,designer_logo2,website,expereince,ranking , IFNULL(t11.itemcount, 0) itemcount, 
		t12.favorites_record_id selectedId 
		from jb080_customer_details t1 
		left outer join jb080_customer_favorites_list t2 on t1.customer_id = t2.customer_id 
		left outer join jb080_master_designer t3 on t3.id = t2.favorites_record_id 
		left outer join	
		(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list 
		WHERE favorites_type = 'designer' group by favorites_type,favorites_record_id ) t11 
		on t2.favorites_record_id = t11.favorites_record_id 
		left outer join (Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'designer' and customer_id = ".$customerid.") t12
		on t2.favorites_record_id = t12.favorites_record_id";

		$whereStr = "where t1.customer_id = '".$requestData['customer_id']."'  and t2.favorites_type='designer'";

		$OrderStr = " Order By t2.on_date desc";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();

	}

	public function getCustomerFavoriteDesign($requestData)
	{
		/* This is for fetching the favorite design */

		
		$customerid=0;
		if(isset($_SESSION["customerId"]))
                $customerid = $_SESSION["customerId"];
        
		$queryStr = " Select dd.design_id,dd.design_name,dd.design_display_name,dd.design_price,dd.design_type,dd.design_des,
		dd.design_specf,dd.design_img,dd.design_ranking,dd.design_designer,dd.`status`,dd.on_date,dd.remote_id,md.designer_name,
		md.tmp_designer_name,md.designer_email_id,md.tmp_designer_email_id,md.designer_mobile_no,md.tmp_designer_mobile_no,
		md.designer_logo,md.website,IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId , GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images
		from jb080_customer_favorites_list t1 
		left outer join jb080_master_design_details dd on t1.favorites_record_id = dd.design_id
		left outer join   jb080_master_designer md on dd.design_designer=md.id
		left join jb080_master_design_details_images t4 on dd.design_id = t4.design_id
		left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'designtheme'
		group by favorites_type,favorites_record_id )
		t11 on dd.design_id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'designtheme' and customer_id = ".$customerid.") t12
		on dd.design_id = t12.favorites_record_id";

		$whereStr = "where t1.customer_id = '".$requestData['customer_id']."' and t1.favorites_type='designtheme' group by dd.design_id";

		$OrderStr = " Order By t1.on_date desc";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();

	}

	public function getCustomerFavoriteContractor($requestData)
	{
		/* This is for fetching the favorite Contractor */

		$queryStr = " SELECT t2.seller_name,t2.seller_email,t2.seller_mbl,t2.seller_logo_image,t2.introduction,t2.seller_description,
		t2.philosophy,t2.awards,t2.website,t2.ranking from
		jb080_customer_favorites_list AS t1
		INNER JOIN jb080_seller_details AS t2 ON t2.seller_id = t1.favorites_record_id";

		$whereStr = "where t1.customer_id = '".$requestData['customer_id']."' and t1.favorites_type='contractor'";

		$OrderStr = " Order By t1.on_date desc";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();

	}

	public function getCustomerFavoriteDesignerPortfolio($requestData)
	{
		/* This is for fetching the favorite design */


		$customerid=0;
		if(isset($_SESSION["customerId"]))
	        $customerid = $_SESSION["customerId"];
        
		$queryStr = " SELECT t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,
		t1.on_date,t1.remote_address,t2.designer_name,t2.designer_email_id,t2.designer_mobile_no,t2.introduction,
		t2.designer_description,t2.design_philosophy,t2.design_awards,t2.designer_logo,t2.website,
		t2.expereince,t2.ranking,IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId, GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images
		from jb080_customer_favorites_list c 
		left outer join jb080_execution_portfo t1 on c.favorites_record_id = t1.id
		left outer join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
		left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'executionportfolio' group by favorites_type,favorites_record_id )
		t11 on t1.id = t11.favorites_record_id
		join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'executionportfolio' and customer_id = ".$requestData['customer_id'].") t12
		on t1.id = t12.favorites_record_id";

		$whereStr = "where c.customer_id = '".$requestData['customer_id']."' and c.favorites_type='executionportfolio' group by t1.id";

		$OrderStr = " Order By t1.on_date desc";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();

	}

	public function getCustomerOrderList($requestData)
	{

		//for call common function
                $this->getRecordsPerPage($requestData['pageNo']);

		$queryStr = " select t1.*, t2.description, t3.customer_id, t3.customer_name, t3.customer_photo, t4.product_id,
		t4.product_sku_id, t4.product_name,t4.short_description, t4.product_details, t4.product_image,
		t5.market_seller_id, t5.market_seller_name, t5.market_seller_email, t5.market_seller_mbl,
		t5.market_seller_logo_image, t6.full_name, t6.address_line1, t6.address_line2, t6.postal_code,
		t6.extension_code, t6.phone_number, t7.city
		from jb080_ecom_orders t1 inner join
		jb080_field_ecom_customer_status t2 on t1.customer_status_id = t2.id
		inner join jb080_customer_details t3 on t1.customer_id = t3.customer_id
		inner join jb080_ecom_products t4 on t1.product_id = t4.product_id
		inner join jb080_market_seller_details t5 on t1.seller_id = t5.market_seller_id
		Left outer join jb080_ecom_orders_shipping_address t6 on t1.order_id = t6.order_id
		left outer join jb080_master_city t7 on t6.city_id = t7.id";
		$whereStr = " where 1 = '1' " ;
		if (!empty($requestData))
		{
			if (!empty($requestData['customer_id']))
			{
				$whereStr = $whereStr . " and " . "t1.customer_id = '" . $requestData['customer_id'] . "'";
			}
			if (!empty($requestData['cart_id']))
			{
				$whereStr = $whereStr . " and " . "t1.cart_id = '" . $requestData['cart_id'] . "'";
			}

		}
		$OrderStr = " Order By t1.order_id Desc LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();
	}

	public function getCustomerInteriorOrderList($requestData)
	{

		//for call common function
         $this->getRecordsPerPage($requestData['pageNo']); 

		$queryStr = " select O_id, t1.customer_id, t2.customer_name,t3.package_name, t4.designer_name, t5.seller_name,
		unique_oid, order_type, Apartment, scheme, flat, apartment_address, t1.city, special_request,
		master_design_name, execution_portfolio_id, t6.internal_status_title
		from jb080_order_dtl t1
		inner join jb080_customer_details t2 on t1.customer_id = t2.customer_id
		left outer join jb080_master_package t3 on t1.package_id = t3.id
		left outer join jb080_master_designer t4 on t1.designer_id = t4.id
		left outer join jb080_seller_details t5 on t1.executioner_id = t5.seller_id
		left outer join jb080_filed_internal_status t6 on t1.status = t6.id";
		$whereStr = " where 1 = '1' " ;
		if (!empty($requestData))
		{
			if (!empty($requestData['customer_id']))
			{
				$whereStr = $whereStr . " and " . "t1.customer_id = '" . $requestData['customer_id'] . "'";
			}
			if (!empty($requestData['unique_oid']))
			{
				$whereStr = $whereStr . " and " . "t1.unique_oid = '" . $requestData['unique_oid'] . "'";
			}

		}
		$OrderStr = " Order By t1.o_id DESC LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();
	}

	function generatePassword($length=9, $strength=0) 
	{
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

	public function ForgotPassword($requestData)
	{
        $userArray=array();

		$queryStr = "select * from `jb080_customer_details`";
		$whereStr = "where customer_username = '" . $requestData['username'] . "'";
		//echo $queryStr . " " . $whereStr."------------->";
		$query = $this->db->query($queryStr . " " . $whereStr);
		$result = $query->result();
		//if ($query->num_rows() > 0)
        //var_dump($result);
        //echo 'result '.$result;
        if($result)     // if (isset($result))
		{
			$new_password = $this->generatePassword();
            $new_password1 = $new_password;
			$updatepwd['customer_password']=md5($new_password);

            $userArray['customer_password']=$new_password1;
            //$userArray['username']=$requestData['username'];
            //$userArray['customer_name']=$requestData['customer_name'];

			$this->db->where("customer_username", $requestData['username']);
			$this->db->update("jb080_customer_details",$updatepwd);
			//echo "$new_password - ". $new_password;


			//return "Password sent";
            return $userArray;
		}
		else
		{
			//echo "Invalid User";
			return "Invalid User";
		}


	}

        

	public function saveEmailNotification($requestData)
	{
		
		
		$data = array();
		$data["customer_id"] = $requestData['customer_id'] ;
		$data["notification_type_id"] = $requestData['notification_type_id'] ;
		$data["update_on"] =  date('Y-m-d H:i:s');
        

		$this->db->insert("jb080_customer_setting_newsletter_preferences", $data);
        
		
		
		return $this->db->insert_id();
		
	}

	public function removeEmailNotification($customerId)
	{
		$queryStr = "select * from `jb080_customer_setting_newsletter_preferences`";
		$whereStr = " where customer_id = '" . $customerId . "'";		
		$query = $this->db->query($queryStr . " " . $whereStr);
		$result = $query->result();
		if ($query->num_rows() > 0)
		{	
			$this->db->where("customer_id", $customerId );
			$this->db->delete("jb080_customer_setting_newsletter_preferences");
			
		}
	}


		public function updatCustomerShippingAddressFlag($requestData,$customerId, $addressId)
    {
		//flag_default_shipping_adrs
		//flag_default_billing_adrs
        // insert and update logic to be implemented
        if($addressId > 0)
        {
            $this->db->set($requestData);
            $this->db->where("customer_id", $customerId);
            $this->db->update("jb080_customer_address_details", $requestData);
        }
        
    }

	// delete customer address

		public function deleteCustomerAddress($addressId)
	  {
			$queryStr = "select * from `jb080_customer_address_details`";
			$whereStr = " where id = '" . $addressId . "'";		
			$query = $this->db->query($queryStr . " " . $whereStr);
			$result = $query->result();
			if ($query->num_rows() > 0)
			{	
				$this->db->where("id", $addressId);
				$this->db->delete("jb080_customer_address_details");
			
			}
	}

	
		public function getCityFiltered($search_keyword)
	  {

	  /*sql:get city details $search_keyword id:*/
       $sql_string_c = '';
       $sql_string_c = ' SELECT CT.id, CT.city, ST.state_id, ST.state_title, CN.idCountry, CN.countryName 
       FROM  jb080_master_city AS CT
       INNER JOIN  jb080_state AS ST
       INNER JOIN jb080_countries AS CN
       ON CT.state_id = ST.state_id AND ST.country_id = CN.idCountry         
       WHERE CT.city like "'.$search_keyword.'%" ORDER BY city LIMIT 0,10 ';
      // $query_c = $this->db->prepare($sql_string_c);
	    $query_c = $this->db->query($sql_string_c);

        return  $query_c->result();
       //$execute_c = $query_c->execute();
       //$arrCityList = $query_c->fetchAll();
	   //return  $arrCityList;
      
	}

	public function getFavourite_Product_List($requestData)
	{
		/* This is for fetching the favorite Product */
		
		if(isset($_SESSION["customerId"]))
			$customerid = $_SESSION["customerId"];
			
			
			   $queryStr = "select t1.* , t3.market_seller_id, market_seller_name, market_seller_email, market_seller_mbl,
		  market_seller_logo_image, introduction, market_seller_description, website, ranking, flag_agree_t_c  ,
		  inventory, currency_code, market_seller_price, market_seller_margin, market_seller_offer ,
		        round(market_seller_price*(1-(market_seller_offer/100)),2) 'Selling_price',
		  cat_id, cat_name, cat_lname, cat_desc, cat_image, brand_name, brand_image,
		  IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId
		   from  jb080_ecom_products t1
		  left outer join jb080_ecom_product_mapp_seller_inventory t4 on t1.product_id = t4.product_id
		  left outer join jb080_market_seller_details t3 on t3.market_seller_id = t4.market_seller_id
		  left outer join jb080_ecom_product_mapp_category t5 on t1.product_id = t5.product_id
		  left outer join jb080_ecom_category t6 on t5.category_id = t6.cat_id
		  left outer join jb080_ecom_brand t7 on t1.product_brand_id = t7.brand_id
		  left outer join (select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		  WHERE favorites_type = 'marketseller' group by favorites_type,favorites_record_id )
		  t11 on t1.product_id = t11.favorites_record_id
		  left outer join
		  (Select favorites_record_id from jb080_customer_favorites_list
		  where favorites_type = 'marketseller' and customer_id = ".$customerid.") t12
		  on t1.product_id = t12.favorites_record_id where t1.product_id = t12.favorites_record_id";
		  $whereStr = "and  t1.status = '1' " ;
		  $OrderStr = " Order By t1.product_id desc";
        
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();
		

	}
	
	public function createCustomerPhone($requestInfo)
	{
			if (!empty($requestInfo['customer_phone']))
			{
				$registerPhone['customer_id'] = $requestInfo['customer_id'];
				$registerPhone['customer_phone'] = $requestInfo['customer_phone'];
				$this->db->insert("jb080_customer_phone", $registerPhone);
			}
	}
	
	public function createCustomerEmail($requestInfo)
	{
			if (!empty($requestInfo['customer_email']))
			{
				$registerEmail['customer_id']     = $requestInfo['customer_id'];
				$registerEmail['customer_email']  = $requestInfo['customer_email'];
				$this->db->insert("jb080_customer_email", $registerEmail);
			}
	}
	
	public function getCustomerMobileAll($requestData)
	{

        $queryStr = 'SELECT id, customer_id , customer_phone  FROM jb080_customer_phone';
        $whereStr = " where ";
        //echo $queryStr;
		if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr = $whereStr . " customer_id = '" . $requestData['customer_id'] . "'";
            }
            if (!empty($requestData['customer_name']))
            {
                $whereStr = $whereStr . " and " . " customer_phone = '" . $requestData['customer_phone'] . "'";
            }
        }
        //echo  $queryStr . " " . $whereStr;
        $query = $this->db->query($queryStr . " " . $whereStr);

        return $query->result();
	}
	
	
	public function getCustomerEmailAll($requestData)
	{
		$queryStr = 'SELECT id, customer_id , customer_email  FROM jb080_customer_email';

        $whereStr = " where ";
        //echo $queryStr;
		if (!empty($requestData))
        {
            if (!empty($requestData['customer_id']))
            {
                $whereStr =  $whereStr . " customer_id = '" . $requestData['customer_id'] . "'";
            }
            if (!empty($requestData['customer_email']))
            {
                $whereStr = $whereStr . " and " . " customer_email = '" . $requestData['customer_email'] . "'";
            }
        }
        //echo  $queryStr . " " . $whereStr;
        $query = $this->db->query($queryStr . " " . $whereStr);

        return $query->result();
	}
	
	 public function getRecordsPerPage($pageNo,$recordsPerPage=10)
    {
		if(isset($pageNo))
		{
            if($pageNo==0 || $pageNo==1)
            {
                $pageNo = 1;
                $recordFrom = 0;
            }
            else
            {
                // $recordFrom = (($recordsPerPage * $pageNo) - ($recordsPerPage)-1 ) ;
                $recordFrom = (($recordsPerPage * $pageNo) - ($recordsPerPage) ) ; 
            }

			$recordTo = $recordsPerPage;
		}
		else
		{
			$pageNo = 1;
			$recordFrom = 0 ;
			$recordTo = $recordsPerPage;
		}
        $_SESSION["recordFrom"] = $recordFrom;
        $_SESSION["recordTo"] = $recordTo;
	}
	
	
	public function getstartedRequest($requestData)
    {
        $this->db->insert("jb080_customer_getstarted_details", $requestData);
        if ($this->db->affected_rows() > 0)
        {
            $orderId = $this->db->insert_id();
            return $orderId;
        }
        else
        {
            return false;
        }
    }
	
	public function getpriceRequest($requestData)
    {
        $this->db->insert("jb080_customer_getprice_enquiry", $requestData);
        if ($this->db->affected_rows() > 0)
        {
            $orderId = $this->db->insert_id();
            return $orderId;
        }
        else
        {
            return false;
        }
    }
    
    
  /*[start:: Code is written by Us ]*/
    
    
    public function  get_status_summary($order_id,$projectPlanActivityPhase){

       $this->db->select('t2.id,t2.title,t3.activity,GROUP_CONCAT(t3.milestone_plan_id SEPARATOR ",") as milestone_plan_id,t3.start_date,t3.completed_date,MIN(t3.plan_start_date)AS minDate, MAX(COALESCE(t3.plan_revised_date,t3.plan_completion_date)) AS maxDate');
       $this->db->from('order_work_order_milestoneplan_details as t3');
//       $this->db->join('order_work_order_milestoneplan_details as t3','t1.order_id = t3.order_id');     
       $this->db->join('order_dtl as t4','t3.order_id = t4.o_id');     
       $this->db->join('field_section_of_house as t2','t3.section_of_house = t2.id'); 
       $this->db->where('t3.order_id',$order_id);
       $this->db->where('t3.projectPlanActivityPhase',$projectPlanActivityPhase);    
//       $this->db->where('t3.flag_milestone_customer_viewable','1');     
       $this->db->where('t4.milestonePlan_customerViewableFlag','1');     
       $this->db->where("t3.flag_internal_workpart != '1'");
       $this->db->group_by('t2.id'); 
       $this->db->order_by('t3.milestone_plan_id','ASC');
       //$this->db->group_by('t1.workorder_id');     
       $query = $this->db->get();
       return $query->result_array();
   }
   public function  get_detailed_nav_list($order_id){
       
       $this->db->select('t2.id,t2.title,t3.order_id');
       $this->db->from('order_work_order_milestoneplan_details as t3');
//       $this->db->from('order_work_order_map_details as t1');
//       $this->db->join('order_work_order_milestoneplan_details as t3','t1.order_id = t3.order_id'); 
        $this->db->join('order_dtl as t4','t3.order_id = t4.o_id');
       $this->db->join('field_section_of_house as t2','t3.section_of_house = t2.id');      
       $this->db->where('t3.order_id',$order_id);
//       $this->db->where('t3.flag_milestone_customer_viewable','1');   
       $this->db->where('t4.milestonePlan_customerViewableFlag','1'); 
       $this->db->where("t3.flag_internal_workpart != '1'");     
       $this->db->group_by('t2.id');     
       $query = $this->db->get();
       return $query->result_array();
   }
      public function  get_detailed_status($order_id,$section_id,$projectPlanActivityPhase){

       $this->db->select('t2.id,t2.title,t3.activity,t3.milestone_plan_id,t3.start_date,t3.plan_start_date,t3.plan_completion_date,t3.plan_completion_date,t3.actual_completion_date,t3.plan_revised_date,t3.completed_date,t3.responsibility,t3.comment');
       $this->db->from('order_work_order_milestoneplan_details as t3');
     //  $this->db->from('order_work_order_map_details as t1');
     //  $this->db->join('order_work_order_milestoneplan_details as t3','t1.order_id = t3.order_id');    
       $this->db->join('order_dtl as t4','t3.order_id = t4.o_id');
       $this->db->join('field_section_of_house as t2','t3.section_of_house = t2.id');     
       $this->db->where('t3.order_id',$order_id);  
       $this->db->where('t3.projectPlanActivityPhase',$projectPlanActivityPhase);  
       if($section_id){
       $this->db->where('t2.id',$section_id);   
       }
//       $this->db->where('t3.flag_milestone_customer_viewable','1');   
        
       $this->db->where('t4.milestonePlan_customerViewableFlag','1');
       $this->db->where("t3.flag_internal_workpart != '1'");
	   //$this->db->order_by("t2.title ASC,  t3.plan_start_date ASC, t3.plan_revised_date DESC, t3.plan_completion_date ASC");    
       $query = $this->db->get();
       return $query->result_array();
   }
   
    public function  get_milestone_details($order_id,$projectPlanActivityPhase){

       $this->db->select('t2.id,t2.title,t3.activity,t3.milestone_plan_id,t3.start_date,t3.plan_start_date,t3.plan_completion_date,t3.plan_completion_date,t3.actual_completion_date,t3.plan_revised_date,t3.completed_date');
       $this->db->from('order_work_order_milestoneplan_details as t3');
//       $this->db->from('order_work_order_map_details as t1');
//       $this->db->join('order_work_order_milestoneplan_details as t3','t1.order_id = t3.order_id'); 
       $this->db->join('order_dtl as t4','t3.order_id = t4.o_id');
       $this->db->join('field_section_of_house as t2','t3.section_of_house = t2.id');
       
       $this->db->where('t3.order_id',$order_id);        
      // $this->db->where('t3.flag_milestone_customer_viewable','1');   
       $this->db->where('t4.milestonePlan_customerViewableFlag','1');
       $this->db->where("t3.flag_internal_workpart != '1'");  
       $this->db->where('t3.projectPlanActivityPhase',$projectPlanActivityPhase);     
       $query = $this->db->get();
       return $query->result_array();
   }

   

   
//       public function  get_timeline($order_id){
//
//       $this->db->select('CAST(`t2`.`ondatetime` AS DATE) as file_date,t1.start_date');
//       $this->db->from('order_work_order_milestoneplan_details as t1');
//       $this->db->join('order_work_order_milestoneplan_mapp_logs_files as t2','t1.milestone_plan_id = t2.milestone_plan_id');     
//      // $this->db->where('t1.workorder_id',$workorder_id);     
//       $this->db->where('t1.order_id',$order_id);     
//      // $this->db->where('t2.flag_customer_viewable','1');     
//       $this->db->order_by('t2.ondatetime DESC');     
//       $this->db->group_by('CAST(`t2`.`ondatetime` AS DATE)');     
//       $query = $this->db->get();
//       return $query->result_array();
//   }
   
       public function  get_timeline($order_id){

       $this->db->select('t1.start_date');
       $this->db->from('order_work_order_milestoneplan_details as t1');
       $this->db->where('t1.order_id',$order_id);     
       $this->db->group_by('t1.start_date');     
       $query = $this->db->get();
       return $query->result_array();
   }
     public function  get_all_work_order_files($order_id){
     //$workorder_id = 1;
       $this->db->select('t2.id,t2.ondatetime,t2.file_name');
       $this->db->from('order_work_order_milestoneplan_details AS t1');  
       $this->db->join('order_work_order_milestoneplan_mapp_logs_files AS t2','t1.milestone_plan_id = t2.milestone_plan_id');     
       $this->db->where('t2.flag_customer_viewable','1');     
       $this->db->where('t1.order_id',$order_id);     
       $query = $this->db->get();
       return $query->result_array();
   }
    public function  get_files($milestone_plan_id){
    // $milestone_plan_id = 63;
       $this->db->select('t1.id,t1.ondatetime,t1.file_name,t2.title');
       $this->db->from('order_work_order_milestoneplan_mapp_logs_files AS t1');  
       $this->db->join('field_section_of_house AS t2','t1.section_of_house = t2.id');     
       $this->db->where('t1.flag_customer_viewable','1');     
       $this->db->where('t1.milestone_plan_id',$milestone_plan_id);     
      // $this->db->where_in('t1.milestone_plan_id',$milestone_plan_id);     
       $query = $this->db->get();
       return $query->result_array();
   }
    public function  get_status_summery_files($section_id,$milestone_plan_id){
    // $milestone_plan_id = 63;
       $this->db->select('t1.id,t1.ondatetime,t1.file_name,t2.title');
       $this->db->from('order_work_order_milestoneplan_mapp_logs_files AS t1');  
       $this->db->join('field_section_of_house AS t2','t1.section_of_house = t2.id');     
       $this->db->where('t1.flag_customer_viewable','1');     
       $this->db->where_in('t1.milestone_plan_id',$milestone_plan_id);     
      // $this->db->where_in('t1.milestone_plan_id',$milestone_plan_id);     
       $query = $this->db->get();
       return $query->result_array();
   }
   
     public function  get_timeline_files($file_date,$order_id){
       
       $this->db->select('t2.`file_name`,CAST(t2.ondatetime AS DATE) AS file_date,t3.`title`');
       $this->db->from('order_work_order_milestoneplan_details as t1');
       $this->db->join('order_work_order_milestoneplan_mapp_logs_files as t2','t1.milestone_plan_id = t2.milestone_plan_id');     
       $this->db->join('field_section_of_house AS t3','t1.section_of_house = t3.id');  
       //$this->db->where('t1.workorder_id',$workorder_id);     
       $this->db->where('t1.order_id',$order_id);     
       $this->db->where('t2.flag_customer_viewable','1'); 
       //$this->db->where('t2.ondatetime',$file_date); 
       $this->db->where('CAST(`t2`.`ondatetime` AS DATE) = ',$file_date); 
       $this->db->order_by('t2.ondatetime DESC');     
       //$this->db->group_by('CAST(t2.ondatetime AS DATE)');   
       $query = $this->db->get();
       return $query->result_array();
   }
     public function  get_timeline_files_dates($order_id){
      
       $this->db->select('CAST(t2.ondatetime AS DATE) AS file_date');
       $this->db->from('order_work_order_milestoneplan_details as t1');
       $this->db->join('order_work_order_milestoneplan_mapp_logs_files as t2','t1.milestone_plan_id = t2.milestone_plan_id');     
       $this->db->where('t1.order_id',$order_id);     
       $this->db->where('t2.flag_customer_viewable','1'); 
       $this->db->order_by('t2.ondatetime DESC');     
       $this->db->group_by('CAST(t2.ondatetime AS DATE)');   
       $query = $this->db->get();
       return $query->result_array();
   }
     public function  get_side_gallery_files($file_date,$order_id){
       
       $this->db->select('t1.`file_name`,CAST(t1.ondatetime AS DATE) AS file_date');
       $this->db->from('order_dtl_mapp_projects_site_images as t1');
       $this->db->where('t1.order_id',$order_id);     
       $this->db->where('t1.flag_customer_viewable','1');
       if(!empty($file_date)){
       $this->db->where('CAST(`t1`.`ondatetime` AS DATE) = ',$file_date); 
       }
       if(empty($file_date)){
       $this->db->group_by('CAST(t1.ondatetime AS DATE)');  
       }
       $this->db->order_by('t1.ondatetime DESC');     
       $query = $this->db->get();
       return $query->result_array();
   }

   
   public function getCustomerinfo($id)
	{
      
            $this->db->select('t1.customer_name,t2.customer_email,t3.customer_phone');
            $this->db->from('customer_details AS t1');  
            $this->db->join('customer_email AS t2','t1.customer_id = t2.customer_id','LEFT');     
            $this->db->join('customer_phone AS t3','t1.customer_id = t3.customer_id','LEFT');     
            $this->db->where('t1.customer_id',$id);     
            $query = $this->db->get();
            return $query->result_array();
	}
        
        public function get_city_list($search_keyword)
	{

        $queryStr = 'SELECT `CT`.`id`, `CT`.`city`, `ST`.`state_id`, `ST`.`state_title`, `CN`.`idCountry`, `CN`.`countryName` 
                    FROM `jb080_master_city` AS `CT`
                    INNER JOIN `jb080_state` AS `ST`
                    INNER JOIN `jb080_countries` AS `CN`
                    ON `CT`.`state_id` = `ST`.`state_id` AND `ST`.`country_id` = `CN`.`idCountry`  				   
                    WHERE `CT`.`city` like "'.$search_keyword.'%" ORDER BY city LIMIT 0,5';
        $query = $this->db->query($queryStr);
        return $query->result_array();
	}
        
         public function getCustomerDetailsByemail($email)
	{
         //echo $email;die;
	$this->db->select('customer_id,customer_email');
        $this->db->from('customer_email');
        $this->db->where('customer_email',$email);
        $query = $this->db->get();
        return $query->result_array();  
	}
        
         public function getCustomerDetailsByPhone($customer_phone)
	{
         //echo $email;die;
	$this->db->select('customer_id,customer_phone');
        $this->db->from('customer_phone');
        $this->db->where('customer_phone',$customer_phone);
        $query = $this->db->get();
        return $query->result_array();  
	}
        
         public function getSchemeDetails($scheme)
	{
        $this->db->select('id,scheme,campaign_name');
        $this->db->from('fb_campaign_name');
        $this->db->where('scheme',$scheme);
        $query = $this->db->get();
        return $query->result_array();         
	}
        
        
  
}
