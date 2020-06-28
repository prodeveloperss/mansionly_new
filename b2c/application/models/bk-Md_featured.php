<?php

class Md_featured extends CI_Model {

    function __construct() {
        parent::__construct();
    }

 

        
       
        
//        public function getSellers($offset,$limit)
//	{
//		
//		
//		$queryStr = "SELECT `t1`.`market_seller_id`,`t2`.`market_seller_name`
//		FROM `jb080_market_seller_details_mapp_bespoke` AS `t1`  
//	        INNER JOIN `jb080_market_seller_details` AS t2 ON `t1`.`market_seller_id` = `t2`.`market_seller_id`
//		WHERE `t1`.`field_seller_bespoke_id`  != '1' AND t2.status = '3'  AND  `t2`.`flag_agree_t_c` = '1'";
//		$OrderStr = "Order By t1.market_seller_id  LIMIT ".$offset.",".$limit;	
//		$query = $this->db->query($queryStr." ".$OrderStr);
//		return $query->result_array();
//	}
    
    public function getSellerDetails($seller_id)
	{
		
		
		$queryStr = "SELECT `market_seller_name`,`market_seller_logo_image`,`introduction`,`market_seller_description`
                            FROM `jb080_market_seller_details` 
                            WHERE `market_seller_id` = ".$seller_id." AND status = '3' AND `flag_agree_t_c` = '1' ";
                           	
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        public function getSellers($offset,$limit)
	{
		
		
		$queryStr = "SELECT `t2`.`market_seller_id`,`t2`.`market_seller_name`
                            FROM `jb080_market_seller_details_mapp_bespoke` AS `t1` 
                            INNER JOIN `jb080_market_seller_details` AS `t2` ON `t1`.`market_seller_id` = `t2`.`market_seller_id` 
                            INNER JOIN `jb080_ecom_product_mapp_seller_inventory` AS `t4` ON `t1`.`market_seller_id` = `t4`.`market_seller_id` 
                            INNER JOIN `jb080_ecom_products` AS `t3` ON `t3`.`product_id` = `t4`.`product_id` 
                            WHERE `t1`.`field_seller_bespoke_id` != '1' AND t2.status = '3' AND `t2`.`flag_agree_t_c` = '1' 
                            GROUP BY `t1`.`market_seller_id` ORDER BY `t2`.`market_seller_name` ASC LIMIT ".$offset.",".$limit;	
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
         
        
            public function getSellersCount()
	{
		
		
		$queryStr = "SELECT COUNT(`t1`.`market_seller_id`) AS totalCount,`t2`.`market_seller_name`
		FROM `jb080_market_seller_details_mapp_bespoke` AS `t1`  
		INNER JOIN `jb080_market_seller_details` AS t2 ON `t1`.`market_seller_id` = `t2`.`market_seller_id`
		WHERE `t1`.`field_seller_bespoke_id`  != '1' AND t2.status = '3'  AND  `t2`.`flag_agree_t_c` = '1'";
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
        public function getSellertopproduct($market_seller_id)
	{
		$queryStr = "SELECT t1.product_id, t1.product_name, t1.product_image 
		from  jb080_ecom_products t1
		inner join  jb080_ecom_product_mapp_seller_inventory t2 on t1.product_id = t2.product_id
		where t2.market_seller_id  = ".$market_seller_id;
		$OrderStr = " Order By t1.product_ranking desc,t1.product_id limit 1";  
		$query = $this->db->query($queryStr. " " . $OrderStr);
		return $query->result_array();
	}
        

        
        	public function getSellertopproducts($seller_id,$offset,$limit)
	{
		$queryStr = "select t1.product_id, t1.product_name, t1.product_image
		from  jb080_ecom_products t1
		inner join  jb080_ecom_product_mapp_seller_inventory t2 on t1.product_id = t2.product_id";
		$whereStr = "where t2.market_seller_id  = ".$seller_id;
		$OrderStr = "Order By t1.product_ranking desc,t1.product_id LIMIT ".$offset.",".$limit;			
		$query = $this->db->query($queryStr. " ". $whereStr ." ".$OrderStr);
		return $query->result_array();
	}
        
         	public function getSellertopproductsCount($seller_id)
	{
		$queryStr = "select COUNT(t1.product_id) AS totalCount
		from  jb080_ecom_products t1
		inner join  jb080_ecom_product_mapp_seller_inventory t2 on t1.product_id = t2.product_id";
		$whereStr = "where t2.market_seller_id  = ".$seller_id;
		$query = $this->db->query($queryStr. " ". $whereStr);
		return $query->result_array();
	}

}

?>
