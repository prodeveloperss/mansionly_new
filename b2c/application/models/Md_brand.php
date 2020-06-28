<?php

class Md_brand extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
   
   public function getBrandListAll($offset,$limit)
	{
        
//		$queryStr = " select brand_id, brand_name, brand_image from jb080_ecom_brand WHERE `status` = '1' AND `brand_id` in(
//		select product_brand_id from jb080_ecom_products where status = '1')";
		 $queryStr = " SELECT `brand_id`, `brand_name`, `brand_image`,`brand_url_name`,`brandPageDesignType` FROM jb080_ecom_brand WHERE `status` = '1' AND `public_status`='1' AND `brand_image` !='' AND `brand_image` IS NOT NULL ";
		  $OrderStr = " ORDER BY `brand_ranking` desc LIMIT ".$offset.",".$limit;
		 $query = $this->db->query($queryStr . " " . $OrderStr);
                	
                return $query->result_array();
                
                
	}
     public function getBrandListAllCount()
	{
        
//		$queryStr = " SELECT COUNT(`brand_id`) AS `totalCount` FROM `jb080_ecom_brand` WHERE status = '1' AND `brand_id` in(
//		SELECT `product_brand_id` FROM `jb080_ecom_products` WHERE status = '1')";
		$queryStr = " SELECT COUNT(`brand_id`) AS `totalCount` FROM `jb080_ecom_brand` WHERE status = '1' AND `public_status`='1'  AND `brand_image` !='' AND `brand_image` IS NOT NULL ";
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}

        public function getTotalProductCountByBrandId($brand_id) {
            $queryStr = "SELECT COUNT(`product_id`) AS `totalCount` FROM `jb080_ecom_products` 
                WHERE `status` = '1' AND `product_brand_id` =".$brand_id;
		$query = $this->db->query($queryStr);
		return $query->result_array();
        }
        
   public function getProductList_filterByBrand($brand_id,$offset,$limit)
	{

		$queryStr = " SELECT `product_id`,`product_name`,`product_image` FROM  `jb080_ecom_products` ";
		$whereStr = " WHERE `status` = '1'  AND `product_brand_id`= ".$brand_id;
		$OrderStr = " ORDER BY `product_ranking` DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
	
 public function getProductList_full($requestData)
	{

		$customerid=0;
		if(isset($_SESSION["customerId"]))
			$customerid = $_SESSION["customerId"];


        // for pagging on scroll
        $this->getRecordsPerPage($requestData['pageNo'],24);

		$queryStr = "  select t1.* , t3.market_seller_id, market_seller_name, market_seller_email, market_seller_mbl,
		market_seller_logo_image, introduction, market_seller_description, website, ranking, flag_agree_t_c		,
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
		left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'marketseller' group by favorites_type,favorites_record_id )
		t11 on t1.product_id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'marketseller' and customer_id = ".$customerid.") t12
		on t1.product_id = t12.favorites_record_id";
		$whereStr = " where t1.status = '1' " ;
		if (!empty($requestData))
		{
			if (!empty($requestData['product_id']))
			{
				$whereStr = $whereStr . " and " . "t1.product_id = '" . $requestData['product_id'] . "'";
			}
			if (!empty($requestData['product_name']))
			{
				$whereStr = $whereStr . " and " . "t1.product_name = '" . $requestData['product_name'] . "'";
			}
			if (!empty($requestData['seller_id']))
			{
				$whereStr = $whereStr . " and " . "t3.market_seller_id = '" . $requestData['seller_id'] . "'";
			}
			if (!empty($requestData['seller_name']))
			{
				$whereStr = $whereStr . " and " . "t3.seller_name = '" . $requestData['seller_name'] . "'";
			}
			if (!empty($requestData['category_id']))
			{
				$whereStr = $whereStr . " and " . "t6.cat_id = '" . $requestData['category_id'] . "'";
			}
			if (!empty($requestData['category_name']))
			{
				$whereStr = $whereStr . " and " . "t6.cat_name = '" . $requestData['category_name'] . "'";
			}
			if (!empty($requestData['product_brand_id']))
			{
				$whereStr = $whereStr . " and " . "t1.product_brand_id = '" . $requestData['brand_id'] . "'";
			}
			if (!empty($requestData['brand_name']))
			{
				$whereStr = $whereStr . " and " . "t7.brand_name = '" . $requestData['brand_name'] . "'";
			}
		}
		$OrderStr = " Order By t1.product_name LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result();
	}
        
        public function getCatDetails($cat_id)
	{
        
		$queryStr = "select cat_id,cat_name from jb080_ecom_category WHERE `cat_status` = '1' AND `cat_id` =".$cat_id;		
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
         public function getSectionDetails($section_id)
	{
        
		$queryStr = "select id,title from jb080_field_design_section_of_house WHERE `status` = '1' AND `id` =".$section_id;		
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
         public function productListByCategory($arr_product_id,$cat_id,$offset,$limit,$brand_id)
	{
         
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t1`.`product_brand_id`',$brand_id);
        $this->db->where('`t2`.`category_id`',$cat_id);
        if(!empty($arr_product_id)){
        $this->db->where_not_in('`t1`.`product_id`',$arr_product_id);
        }
        $this->db->limit($limit,$offset);
        $this->db->order_by('`t1`.product_ranking DESC');
        $query = $this->db->get();
        return $query->result_array();
	}
        
          public function productListBySection($arr_product_id,$section_id,$offset,$limit,$brand_id)
	{
               
                $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
                $this->db->from('ecom_products AS `t1`');
                $this->db->join('jb080_ecom_product_mapp_design_type AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
                $this->db->where('`t1`.`status`','1');
                $this->db->where('`t1`.`product_brand_id`',$brand_id);
                $this->db->where('`t2`.`field_design_type_id`',$section_id);
                if(!empty($arr_product_id)){
                $this->db->where_not_in('`t1`.`product_id`',$arr_product_id);
                }
                $this->db->limit($limit,$offset);
                $this->db->order_by('`t1`.product_ranking DESC');
                $query = $this->db->get();
                return $query->result_array();
		
	}
        
         public function productList($arr_product_id,$offset,$limit,$brand_id)
	{
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t1`.`product_brand_id`',$brand_id);
        $this->db->limit($limit,$offset);
        if(!empty($arr_product_id)){
        $this->db->where_in('`t1`.`product_id`',$arr_product_id);
        $order = sprintf('FIELD(`t1`.`product_id`, %s)', implode(',', $arr_product_id));        
        $this->db->order_by($order);
        }else{
        $this->db->order_by('`t1`.`product_ranking` DESC');
        }
        $query = $this->db->get();
        return $query->result_array();
	}
        
        
         public function getCustomerDetails($email)
	{
         //echo $email;die;
	$this->db->select('customer_id,customer_email');
        $this->db->from('customer_email');
        $this->db->where('customer_email',$email);
        $query = $this->db->get();
        return $query->result_array();  
	}
        
         public function getCityDetails()
	{
        $queryStr = 'SELECT `CT`.`id`, `CT`.`city`
                    FROM `jb080_master_city` AS `CT`
                    INNER JOIN `jb080_state` AS `ST`
                    INNER JOIN `jb080_countries` AS `CN`
                    ON `CT`.`state_id` = `ST`.`state_id` AND `ST`.`country_id` = `CN`.`idCountry` 
                    WHERE `CN`.`idCountry`="101" AND `CT`.`status`="1" ORDER BY `CT`.`city` ';
        $query = $this->db->query($queryStr);
        return $query->result_array();
	}

}

?>
