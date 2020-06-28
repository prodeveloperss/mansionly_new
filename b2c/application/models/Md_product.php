<?php

class Md_product extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function productTotalCountByCategoryIds($arrSubCatIds,$brand_id="")
	{
            $this->db->select('COUNT(`t1`.`product_id`) AS `totalCount`');
            $this->db->from('ecom_products AS `t1`');
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where('`t1`.`status`','1');
            if(!empty($brand_id)){
            $this->db->where('`t1`.`product_brand_id`',$brand_id);
            }
            $this->db->where_in('`t2`.`category_id`',$arrSubCatIds);
            $this->db->order_by('product_ranking DESC');
            $query = $this->db->get();
            return $query->result_array();
	}
        
 public function productListByCategory($arrSubCatIds,$offset,$limit,$brand_id="")
	{
         
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->where('`t1`.`status`','1');
        if(!empty($brand_id)){
        $this->db->where('`t1`.`product_brand_id`',$brand_id);
        }
        $this->db->where_in('`t2`.`category_id`',$arrSubCatIds);
        $this->db->limit($limit,$offset);
        $this->db->order_by('product_ranking DESC');
        $query = $this->db->get();
        
        return $query->result_array();
	}
   public function productListBySection($section_id,$offset,$limit,$brand_id="")
	{
            /*get::Product list by $subCatIdList */
//                $offset = 0;
//                $limit = 24;
                $data['limit'] = $limit;
           
		$queryStr = " SELECT t1.*, brand_name, brand_image, brand_id from  jb080_ecom_products AS t1
		inner join jb080_ecom_product_mapp_design_type t8 on t8.product_id = t1.product_id
		left outer join jb080_ecom_brand t7 on t1.product_brand_id = t7.brand_id";
		$whereStr = " where t1.status = '1'" ;
		if (!empty($section_id)) 
		{
			if (!empty($section_id))
			{
				$whereStr = $whereStr . " and " . " t8.field_design_type_id = '" . $section_id . "'";
			}
			
			
		}
                if(!empty($brand_id)){
                $whereStr = $whereStr . " AND " . " t1.product_brand_id = '" . $brand_id . "'";
                
                }
		//$OrderStr = " Order By t1.product_ranking desc ";
		$OrderStr = " Order By t1.product_ranking desc LIMIT ".$offset.",".$limit;
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
        
          public function productTotalCountBySectionId($section_id,$brand_id="")
	{
            $this->db->select('COUNT(`t1`.`product_id`) AS `totalCount`');
            $this->db->from('ecom_products AS `t1`');
            $this->db->join('jb080_ecom_product_mapp_design_type AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where('`t1`.`status`','1');
            if(!empty($brand_id)){
            $this->db->where('`t1`.`product_brand_id`',$brand_id);
            }
            $this->db->where('`t2`.`field_design_type_id`',$section_id);
            $this->db->order_by('product_ranking DESC');
            $query = $this->db->get();
            return $query->result_array();
        }
    public function productListByFeatured($featured_id,$offset,$limit)
	{


		$queryStr = " select t1.*, brand_name, brand_image, brand_id
		from  jb080_ecom_products t1
		inner join jb080_ecom_product_mapp_product_tags t8 on t8.product_id = t1.product_id
		left outer join jb080_ecom_brand t7 on t1.product_brand_id = t7.brand_id";
		$whereStr = " where t1.status = '1'" ;
		if (!empty($featured_id)) 
		{
			
                $whereStr = $whereStr . " and " . " t8.field_ecom_product_tags_id = '" . $featured_id . "'";
			
			
		}
		$OrderStr = " Order By t1.product_ranking desc LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
        public function productTotalCountByFeaturedId($featured_id)
	{
            $this->db->select('COUNT(`t1`.`product_id`) AS `totalCount`');
            $this->db->from('ecom_products AS `t1`');
            $this->db->join('jb080_ecom_product_mapp_product_tags AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where('`t1`.`status`','1');
            $this->db->where('`t2`.`field_ecom_product_tags_id`',$featured_id);
            $this->db->order_by('product_ranking DESC');
            $query = $this->db->get();
            return $query->result_array();
        }
       
	    public function getProductDetailsWithoutStatusCase($product_id)
	   {
		$queryStr = "SELECT `t1`.*,`t2`.`brand_name`,`t2`.`brand_url_name`, `t3`.`category_id`  FROM  `jb080_ecom_products` AS `t1` 
                           LEFT JOIN `jb080_ecom_brand` AS `t2` ON `t1`.`product_brand_id` = `t2`.`brand_id`
                           INNER JOIN `jb080_ecom_product_mapp_category` AS `t3` ON `t1`.`product_id` = `t3`.`product_id`
                           WHERE `t1`.`product_id` = '" .$product_id."'";
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
	   
	    public function getProductDetails($product_id)
	{
		$queryStr = "SELECT `t1`.*,`t2`.`brand_name`,`t3`.`category_id`  FROM  `jb080_ecom_products` AS `t1` 
                           LEFT JOIN `jb080_ecom_brand` AS `t2` ON `t1`.`product_brand_id` = `t2`.`brand_id`
                           INNER JOIN `jb080_ecom_product_mapp_category` AS `t3` ON `t1`.`product_id` = `t3`.`product_id`
                           WHERE `t1`.`status` = '1' AND `t1`.`product_id` = '" .$product_id."'";
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
        public function getProductImages($product_id)
	{
		$queryStr = " select t1.product_id, product_name,product_sec_image, is_primary  from  jb080_ecom_products t1 inner join jb080_ecom_product_images t2 on t1.product_id = t2.product_id ";
		$whereStr = " where t1.status = '1' and t1.product_id =" . $product_id ;
		$OrderStr = " Order By is_primary desc";
        //echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	}
        
        public function getProductMaterial($product_id)
	{
		//echo '---------------->'. $productid . '<----------------';
		$queryStr = " select primary_material  from  jb080_ecom_products t1
		inner join jb080_ecom_product_mapp_material t2 on t1.product_id = t2.product_id ";
		$whereStr = " where t1.status = '1' and t1.product_id =" . $product_id ;
		$OrderStr = " Order By product_name";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
        public function getProductPropery($product_id)
	{
		$queryStr = "SELECT *  FROM  `jb080_ecom_product_mapp_item_property`  WHERE `product_id` = '" .$product_id."'";
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
        public function getRelatedProducts($product_id,$cat_id)
	{


		$queryStr = "SELECT `t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`,`t2`.`category_id` FROM  `jb080_ecom_products` AS `t1`
                            INNER JOIN `jb080_ecom_product_mapp_category` AS `t2` On `t1`.`product_id` = `t2`.`product_id` WHERE `t1`.`status` = '1' AND `t1`.`product_id` NOT IN ('" . $product_id . "') 
                            AND `t2`.`category_id` =".$cat_id." ORDER BY `t1`.`product_ranking` DESC limit 6";  
		//echo $queryStr;die;
		$query = $this->db->query($queryStr);

		return $query->result_array();
	}
        
      public function getCatDetails($cat_id){
        $this->db->select('cat_id, cat_name');
        $this->db->from('ecom_category'); 
        $this->db->where('cat_status','1');  
        //$this->db->where('parent','0');  
        $this->db->where('cat_id',$cat_id);  
        $query = $this->db->get();
        return $query->result_array();       
   }
   
    public function getSectionDetails($section_id){
        $this->db->select('id,title');
        $this->db->from('field_design_section_of_house'); 
        $this->db->where('status','1');  
        $this->db->where('id',$section_id);  
        $query = $this->db->get();
        return $query->result_array();       
   }
   
   public function getSellerDetails($seller_id)
	{
		
		
		$queryStr = "SELECT `market_seller_name`,`market_seller_id`
                            FROM `jb080_market_seller_details` 
                            WHERE `market_seller_id` = ".$seller_id." AND status = '3' AND `flag_agree_t_c` = '1' ";
                           	
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
    public function getProductList_filterByBrand($brand_id,$offset,$limit,$product_id)
	{

		$queryStr = " SELECT * FROM  `jb080_ecom_products` ";
		//$whereStr = "";
		$whereStr = " WHERE `status` = '1'  AND `product_brand_id`= '".$brand_id."' AND `product_id` != ".$product_id;
		$OrderStr = " ORDER BY `product_ranking` DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
        
         public function getProductCatDetails($product_id)
	{
		$queryStr = "SELECT `t1`.`cat_id`,`t1`.`cat_name` from `jb080_ecom_category` AS `t1` 
                             INNER JOIN `jb080_ecom_product_mapp_category` AS `t2` 
                             ON `t1`.`cat_id` = `t2`.`category_id`
                             INNER JOIN `jb080_ecom_products` AS `t3` 
                             ON `t3`.`product_id` = `t2`.`product_id`
                             WHERE `t3`.`status` = '1' AND `t3`.`product_id` =".$product_id;		
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
          public function getProductSubCatDetails($cat_id)
	{
		$queryStr = "SELECT `t1`.`cat_id`,`t1`.`cat_name` from `jb080_ecom_category` AS `t1`                                                         
                             WHERE  `t1`.`parent` =".$cat_id;		
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
        
            public function getProductSectionDetails($product_id)
	{
        
		$queryStr = "select `t1`.`id`,`t1`.`title` from `jb080_field_design_section_of_house` AS `t1` 
                             INNER JOIN `jb080_ecom_product_mapp_design_type` AS `t2` 
                             ON `t1`.`id` = `t2`.`field_design_type_id`
                             INNER JOIN `jb080_ecom_products` AS `t3` 
                             ON `t3`.`product_id` = `t2`.`product_id`
                             WHERE `t3`.`status` = '1' AND `t3`.`product_id` =".$product_id;		
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}

}

?>
