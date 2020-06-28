<?php

class Md_home extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  
  
        

        public function getfeaturedDesigner()
    {
        /* This is fetching the design details list based on the selected Type/section */

            $queryStr = "SELECT id,designer_name,introduction,design_philosophy,designer_logo, designer_logo2"
                    . "  FROM `jb080_master_designer` ";
            $whereStr = "WHERE `status`='3' AND `tmp_status`='0' ";
            $OrderStr = " GROUP BY `id` Order By ranking Desc LIMIT 0,1";
            //echo $queryStr . " " . $whereStr. " " . $OrderStr;
            $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
            return $query->result_array();
    }
    
     public function getDesignerTopRatedPortfolio($designerId)
	{
		$queryStr = "select t1.id,  t1.portfolio_name, t1.master_image, t1.designer_id ,t2.designer_name from jb080_execution_portfo AS t1
                              inner join jb080_master_designer AS t2 on t1.designer_id = t2.id
";
		$whereStr = " where t1.status = 'Active'  AND t1.designer_id = '"  . $designerId . "'";
		$OrderStr = " order by t1.ranking desc limit 1";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		return $query->result_array();
	}
     public function getDesignerTopRatedPortfolio2($designerId)
	{
		$queryStr = "select t1.master_image from jb080_execution_portfo AS t1
                              inner join jb080_master_designer AS t2 on t1.designer_id = t2.id
";
		$whereStr = " where t1.status = 'Active' AND t1.designer_id = '"  . $designerId . "'";
		$OrderStr = " order by t1.ranking desc limit 1";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		return $query->row_array();
	}
        
        public function getDesignerTopRatedTheme2($designerId)
	{
		$queryStr = "select   design_img from jb080_master_design_details ";
		$whereStr = " where design_designer = '" . $designerId . "' and status = '1' ";
		$OrderStr = " order by design_ranking desc limit 1";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		return $query->row_array();
	}
        
        
        public function getfeatured_sample_execution_portfolio()
	{
		$queryStr = "SELECT t2.designer_name,t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,
		t1.on_date,t1.remote_address,	
		t2.expereince,t2.ranking designer_ranking,		
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images
                from jb080_execution_portfo t1
                inner join jb080_master_designer t2 on t1.designer_id = t2.id
                left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id";
		
		$whereStr = "WHERE t1.`status` = 'active'";		
	        $whereStr.= " group by t1.id";
		$OrderStr =  "Order by t1.ranking desc LIMIT 0,2";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	
	}

              public function getProduct_filterByfeatured($featured_id)
	{
		$customerid=0;
		if(isset($_SESSION["customerId"]))
		$customerid = $_SESSION["customerId"];
                $queryStr = "";        
		$queryStr = " select `t1`.* from `jb080_ecom_products` AS `t1` ";
		$whereStr = "";
                
                if ($featured_id== '1')
                {
                    $whereStr = " where `t1`.`status` = '1' AND `t1`.`product_id` = '2465'  " ;
                }elseif($featured_id== '2'){
                    $whereStr = " where `t1`.`status` = '1' AND `t1`.`product_id` = '2465'  " ;
                   // $whereStr = " where `t1`.`status` = '1' AND `t1`.`product_id` = '4524'  " ;
                }elseif($featured_id== '3'){
                    $whereStr = " where `t1`.`status` = '1' AND `t1`.`product_id` = '2465'  " ;
                    //$whereStr = " where `t1`.`status` = '1' AND `t1`.`product_id` = '4437'  " ;
                }
                
//		if (!empty($requestData)) 
//		{
//			if (!empty($requestData['featured_id']))
//			{
//				$whereStr = $whereStr . " and " . " t8.field_ecom_product_tags_id = '" . $requestData['featured_id'] . "'";
//			}
//		}
		$OrderStr = "";
                //$OrderStr = " Order By t1.product_ranking desc LIMIT 0,1 ";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	} 
        
        public function getBrandList()
	{


               /* This is fetching the brand list based on product table */
//		$queryStr = " select brand_id, brand_name, brand_image, brand_description from `jb080_ecom_brand` where status = '1' and brand_id in(
//		select product_brand_id from jb080_ecom_products where status = '1')";
//		$OrderStr = " Order By brand_ranking desc LIMIT 4";
                $queryStr = " select brand_id, brand_name, brand_image, brand_description,brand_url_name,brandPageDesignType from jb080_ecom_brand where status = '1' AND `public_status`='1' ";
                $OrderStr = " Order By brand_ranking desc  LIMIT 4 ";
		$query = $this->db->query($queryStr . " " . $OrderStr);
		return $query->result_array();
	}
        
             public function getMagazineList(){
                $queryStr = "SELECT `t1`.`post_title`, `t1`.`post_content`, `t3`.`guid`,`t1`.`post_date`,`t1`.`post_name`
                FROM `wp_jb080_posts` AS `t1` INNER JOIN `wp_jb080_postmeta` `t2` ON `t1`.`id` = `t2`.`post_id` 
                INNER JOIN `wp_jb080_posts` AS `t3` ON `t3`.`id` = `t2`.`meta_value`  
                WHERE `t1`.`post_status` = 'publish' AND `t1`.`comment_status` = 'open' AND `t1`.`ping_status` = 'open' 
                AND `t2`.`meta_key` = '_thumbnail_id' LIMIT 0,7";
		//$OrderStr =  "Order by t1.ranking desc LIMIT 0,2";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr);
		return $query->result_array();
       }
       
         public function getMagazineListNewsFeed(){
           $queryStr = "SELECT `t1`.`post_title`, `t1`.`post_content`, `t3`.`guid`,`t1`.`post_date`,`t1`.`post_name`
                FROM `wp_jb080_posts` AS `t1` INNER JOIN `wp_jb080_postmeta` `t2` ON `t1`.`id` = `t2`.`post_id` 
                INNER JOIN `wp_jb080_posts` AS `t3` ON `t3`.`id` = `t2`.`meta_value`  
                INNER JOIN `wp_jb080_term_relationships` AS `t5` ON `t1`.`id` = `t5`.`object_id`  
                WHERE `t1`.`post_status` = 'publish' AND `t1`.`comment_status` = 'open' AND `t1`.`ping_status` = 'open' 
                AND `t5`.`term_taxonomy_id` = '156' AND `t2`.`meta_key` = '_thumbnail_id' GROUP BY `t5`.`object_id` ORDER BY `t1`.`ID` DESC LIMIT 0,7";
		//$OrderStr =  "Order by t1.ranking desc LIMIT 0,2";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr);
		return $query->result_array();
       }
       
       public function getDesigner($offset,$limit){
                  
            $this->db->select('d.id,d.designer_name,d.designer_email_id,d.designer_mobile_no, d.introduction,
                                d.designer_logo, d.website,d.expereince, d.designer_occupation_id,d.designer_logo2,
                                d.info_pan, d.info_tan,d.info_bank_name, d.ranking,d.`status`,d.created_by_user_id,d.flag_agree_t_c,t5.countryName');
            $this->db->from('master_designer as d');
            $this->db->join('master_designer_city_details as t2', 'd.id = t2.designer_id','LEFT');
            $this->db->join('master_city as t3', 't2.city_id = t3.id','LEFT');
            $this->db->join('state as t4', 't3.state_id = t4.state_id','LEFT');
            $this->db->join('countries as t5', 't4.country_id = t5.idCountry','LEFT');
            $this->db->where('d.status','3');
            $this->db->where(' (d.ranking >=0 OR d.ranking IS NULL) ');  
            $this->db->group_by('d.id');
            $this->db->order_by('d.ranking','DESC');
            $this->db->order_by('d.id','DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query->row_array();
          //  return $query->result_array();  
       }
       
       public function getBrand($offset,$limit){
            $this->db->select('brand_id, brand_name, brand_image,brandBnrImg, brand_description,brand_url_name,brandPageDesignType,published_date');
            $this->db->from('ecom_brand');
            $this->db->where(" status = '1' AND `public_status`='1' AND brand_image IS NOT NULL AND brand_image != '' AND (brand_ranking >= 0 OR brand_ranking IS NULL) ");  
            $this->db->order_by('brand_ranking','DESC');
            $this->db->order_by('brand_id','DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
//            return $query->result_array();  
            return $query->row_array();
       }
       
       
       public  function getBrandTopProduct($brandID){
           $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
            $this->db->from('ecom_products AS `t1`');
            $this->db->where('`t1`.`status`','1');  
            $this->db->where('`t1`.`product_brand_id`',$brandID);  
            $this->db->where('(`t1`.`product_ranking` >= 0 OR `t1`.`product_ranking` IS NULL )');  
            $this->db->order_by('`t1`.`product_ranking`','DESC');
            $this->db->order_by('`t1`.`product_id`','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();  
       }


       public function getExecutionPortfolio($offset,$limit){
                
            $this->db->select('t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t2.designer_name,t1.master_image,t1.ranking,t1.status,t1.global_inspiration, t1.luxury_hotels, t1.commercial_designs, t1.residential_interiors, t1.retail, t1.office_space, t1.restaurant, t1.spas,		
		GROUP_CONCAT(t3.img SEPARATOR ",") secondary_images');
            $this->db->from('execution_portfo AS t1'); 
            $this->db->join('master_designer AS t2','t1.designer_id = t2.id','inner'); 
            $this->db->join('execution_portfolio_images AS t3','t1.id = t3.executioner_id','left'); 
            $this->db->where('t1.status','active');  
            $this->db->where(' (t1.ranking >= 0 OR t1.ranking IS NULL) ');  
            $this->db->group_by('t1.id');
            $this->db->order_by('t1.ranking','DESC');
            $this->db->order_by('t1.id','DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query->row_array(); 
       }
       
       public function getDesignConcept($offset,$limit){
           
            $this->db->select("distinct (t1.design_id), t1.design_name,t1.design_display_name, t1.design_price,t1.design_img,
        t1.design_ranking, t1.design_designer,t1.`status`,t3.`status`,t1.on_date,t1.design_specf, t1.design_des,t1.design_type,
		   GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images,t5.designer_name");
            $this->db->from('master_design_details AS t1'); 
            $this->db->join('mapp_master_design_details_design_theme AS t2','t1.design_id = t2.master_design_id','left outer'); 
            $this->db->join('field_design_theme_master AS t3','t2.field_design_theme_id = t3.id','left outer'); 
            $this->db->join('master_design_details_images AS t4','t1.design_id = t4.design_id','left'); 
            $this->db->join('master_designer AS t5','t1.design_designer = t5.id','left'); 
            $this->db->where('t1.status','1');  
            $this->db->where(' (t1.design_ranking >= 0 OR t1.design_ranking IS NULL)');  
            $this->db->group_by('t1.design_id');
            $this->db->order_by('t1.design_ranking','DESC');
            $this->db->order_by('t1.design_id','DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query->row_array(); 
       }
       
       public function getProduct($offset,$limit){
            $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`,`t2`.`category_id`');
            $this->db->from('ecom_products AS `t1`');
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`','left');
            $this->db->where('`t1`.`status`','1');  
            $this->db->where(' (`t1`.`product_ranking` >= 0 OR `t1`.`product_ranking` IS NULL)');  
            $this->db->group_by('`t1`.`product_id`');
            $this->db->order_by('`t1`.`product_ranking`','DESC');
            $this->db->order_by('`t1`.`product_id`','DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query->row_array(); 
       }
       
       public function getMagazineBlog($offset,$limit){
                $queryStr = "SELECT `t1`.`post_title`, `t1`.`post_content`,`t1`.`guid` AS `blogUrl`, `t3`.`guid` AS `imageUrl`,`t1`.`post_date`,`t1`.`post_name`
                FROM `wp_jb080_posts` AS `t1` INNER JOIN `wp_jb080_postmeta` `t2` ON `t1`.`id` = `t2`.`post_id` 
                INNER JOIN `wp_jb080_posts` AS `t3` ON `t3`.`id` = `t2`.`meta_value` 
                INNER JOIN `wp_jb080_term_relationships` AS `t5` ON `t1`.`id` = `t5`.`object_id`   
                WHERE `t1`.`post_status` = 'publish' AND `t1`.`comment_status` = 'open' AND `t1`.`ping_status` = 'open' 
                AND `t5`.`term_taxonomy_id` != '156'  AND `t2`.`meta_key` = '_thumbnail_id' GROUP BY `t5`.`object_id` ORDER BY `t1`.`ID` DESC LIMIT $offset,$limit";
		//$OrderStr =  "Order by t1.ranking desc LIMIT 0,2";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr);
		return $query->row_array();
       }
       
       public function getCustomerFavoriteThemes($customerId){
            $this->db->select('favorites_record_id');
            $this->db->from('customer_favorites_list');
            $this->db->where('customer_id',$customerId);  
            $this->db->where('favorites_type','designtheme');  
            $query = $this->db->get();
            $result = $query->result_array(); 
            $arrayColumn = array_column($result,"favorites_record_id");
            return $arrayColumn;
       }
       public function getCustomerFavoriteExecutions($customerId){
            $this->db->select('favorites_record_id');
            $this->db->from('customer_favorites_list');
            $this->db->where('customer_id',$customerId);  
            $this->db->where('favorites_type','executionportfolio');  
            $query = $this->db->get();
            $result = $query->result_array(); 
            $arrayColumn = array_column($result,"favorites_record_id");
            return $arrayColumn;
       }
       public function getCustomerFavoriteDesigner($customerId){
            $this->db->select('favorites_record_id');
            $this->db->from('customer_favorites_list');
            $this->db->where('customer_id',$customerId);  
            $this->db->where('favorites_type','designer');  
            $query = $this->db->get();
            $result = $query->result_array(); 
            $arrayColumn = array_column($result,"favorites_record_id");
            return $arrayColumn;
       }
       public function getCustomerFavoriteProduct($customerId){
            $this->db->select('favorites_record_id');
            $this->db->from('customer_favorites_list');
            $this->db->where('customer_id',$customerId);  
            $this->db->where('favorites_type','marketseller');  
            $query = $this->db->get();
            $result = $query->result_array(); 
            $arrayColumn = array_column($result,"favorites_record_id");
            return $arrayColumn;
       }
        
}

?>
