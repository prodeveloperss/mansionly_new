<?php

class Md_category extends CI_Model {

    function __construct() {
        parent::__construct();
        
    }

 

        
        public function getProductCatgListParentwise($parentid)
	{
		
		$queryStr = " SELECT * FROM `jb080_ecom_category` WHERE `parent` = '" . $parentid."' AND `cat_status`= '1'" ; 
		$OrderStr = " Order By cat_name ";
		//echo $queryStr . " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $OrderStr);
		return $query->result();
	}
        

        
        public function getCategoryList($parent_id){
            // echo "test"; die;
        $this->db->select('cat_id, cat_name, parent,position');
        $this->db->from('ecom_category');
        $this->db->where('parent',$parent_id);
        $query = $this->db->get();
        $array_cat_list_result = $query->result_array();
        $finalarray = array();
        foreach ($array_cat_list_result as $datarow ){
         $finalarray[$datarow['cat_id']]=$datarow;
        if($this->child_exist($datarow['cat_id'])){
           $finalarray[$datarow['cat_id']]['children']= $this->getCategoryList($datarow['cat_id']);
        }
    }
    return $finalarray;
            
        }
        
        public function child_exist($parent_id){
             $this->db->select('cat_id, cat_name, parent,position');
        $this->db->from('ecom_category');
        $this->db->where('parent',$parent_id);
        $query = $this->db->get();
        $result = $query->result_array();
            
            if(!empty($result)){  return true; } return false;
        }
       
        public function getProduct_topcategories($offset,$limit)
	{
		$queryStr = "SELECT `cat_id`,`cat_name` FROM `jb080_ecom_category` "
                        . "WHERE `cat_status` = '1' AND `parent` = 0  ORDER BY cat_ranking DESC  LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr);
                
	return	$result = $query->result_array();
               // print_r($query->result_array());
	}
        public function getProduct_topcategoriesCount() {
              $queryStr = " SELECT COUNT(`cat_id`) AS `totalCount` FROM `jb080_ecom_category` 
                WHERE `cat_status` = '1' AND `parent` = 0";
		$query = $this->db->query($queryStr);
		return $query->result_array();
        }
        
        public function getviewallSubcategories($cat_id)
	{
		$queryStr = "select cat_id, cat_name from jb080_ecom_category"; 
		$whereStr = "where cat_status = '1' ";
		if (!empty($cat_id))
                {
		$whereStr = $whereStr . " and " . " parent = '" . $cat_id . "'";
                }
		//echo $queryStr . " " . $whereStr;
		$query = $this->db->query($queryStr . " " . $whereStr);
	    return $query->result_array();
	}
        public function gettoprankedcategoryProduct($sub_cat_id)
	{
		$queryStr = "select t1.product_name, t1.product_id, t1.product_image from  jb080_ecom_products  AS t1 
		inner join jb080_ecom_product_mapp_category AS t5 on t1.product_id = t5.product_id";
		$whereStr = " where t1.status = '1' " ;
		
			if (!empty($sub_cat_id))
			{
				$whereStr = $whereStr . " and " . "t5.category_id = '" . $sub_cat_id . "'";
			}
	
		$OrderStr = " Order By t1.product_ranking desc limit 1";  
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	}

        
//        public function gettoprankedcategoryProduct($sub_cat_id)
//	{
//            
//             
//                
//                $string= implode(',', $sub_cat_id);
//          //echo $string;die;
//		$queryStr = "select t1.product_name, t1.product_id, t1.product_image,t2.cat_id,t2.cat_name from  jb080_ecom_products t1 
//		inner join jb080_ecom_product_mapp_category t5 on t1.product_id = t5.product_id
//                inner join jb080_ecom_category t2 on t5.category_id = t2.cat_id";
//		$whereStr = " where t1.status = '1' and  t5.category_id IN('".$string."')" ;
//		
////                if (!empty($sub_cat_id))
////                {
////                        $whereStr = $whereStr . " and " . "t5.category_id = '" . $sub_cat_id . "'";
////                }
//		
//		$OrderStr = " group by t2.cat_id Order By t1.product_ranking desc,t1.product_id limit 1";  
//		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
//		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
//		return $query->result_array();
//	}
        
      public function getProductList_full($cat_id)
	{

            $customerid=0;
            if(isset($_SESSION["customerId"]))
            $customerid = $_SESSION["customerId"];

        

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
		if (!empty($cat_id))
		{
			
			
				$whereStr = $whereStr . " and " . "t6.cat_id = '" . $cat_id . "'";
			
			
		}
		//$OrderStr = " Order By t1.product_name LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		$OrderStr = " Order By t1.product_name ";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

		return $query->result_array();
	}
        
       public function getTotalProductCountByCatId($cat_id) {
            $queryStr = " SELECT COUNT(`product_id`) AS `totalCount` FROM `jb080_ecom_products` 
                WHERE `status` = '1' AND `product_brand_id` =".$cat_id;
		$query = $this->db->query($queryStr);
		return $query->result_array();
        }
        
        public function getParentCategoryNameFromChildCatId($catID,&$finalArray){
            $this->db->select('cat_id, cat_name, parent,cat_lname');
            $this->db->from('ecom_category');
            $this->db->where('cat_id',$catID);
            $query = $this->db->get();
            $array_cat_list_result = $query->result_array();
            if(!empty($array_cat_list_result)){
                $finalArray[]=$array_cat_list_result[0];
            }
           // echo '<br>'.$array_cat_list_result[0]['cat_name'];
            if($array_cat_list_result[0]['parent']!=0){
                $this->getParentCategoryNameFromChildCatId($array_cat_list_result[0]['parent'],$finalArray);
            }else{
                return $finalArray;
            }
           return $finalArray;
        }
        
       
   

}

?>
