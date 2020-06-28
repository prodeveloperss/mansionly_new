<?php

class Md_header extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   
     public function getHeaderDesignerList(){
        $this->db->select('d.id,d.designer_name,d.designer_logo,t5.countryName');
        $this->db->from('master_designer as d');
        $this->db->join('master_designer_city_details as t2', 'd.id = t2.designer_id','LEFT');
        $this->db->join('master_city as t3', 't2.city_id = t3.id','LEFT');
        $this->db->join('state as t4', 't3.state_id = t4.state_id','LEFT');
        $this->db->join('countries as t5', 't4.country_id = t5.idCountry','LEFT');
        $this->db->where('d.status','3');  
        $this->db->where('d.tmp_status','0');  
        $this->db->group_by('d.id');
        $this->db->order_by('d.ranking','DESC');
        $this->db->order_by('d.id','DESC');
        $this->db->limit('9');
        $query = $this->db->get();
        return $query->result_array();       
   }

   
     public function getExecutionSamplePortfolio($flag){
        $this->db->select('t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.status,t2.designer_name');
        $this->db->from('execution_portfo AS t1'); 
        $this->db->join('master_designer AS t2','t1.designer_id = t2.id'); 
        $this->db->where('t1.status','active');  
        if($flag !='all'){
        $this->db->where('t1.'.$flag,'1');  
        }
        $this->db->order_by('t1.ranking','DESC');
        $this->db->limit('3');
        $query = $this->db->get();
        return $query->result_array();       
   }

   



     public function getHeaderBrandList(){
        $queryStr = " select brand_id, brand_name, brand_image, brand_description,brand_url_name,brandPageDesignType,published_date from jb080_ecom_brand where status = '1' AND `public_status`='1' "
                . "   AND brand_image IS NOT NULL AND brand_image != ''";
        $OrderStr = " Order By brand_ranking desc  LIMIT 6 ";
        $query = $this->db->query($queryStr . " " . $OrderStr);
        return $query->result_array();       
   }
     public function getHeaderProductCatList(){
        $this->db->select('cat_id, cat_name,cat_image');
        $this->db->from('ecom_category'); 
        $this->db->where('cat_status','1');  
        $this->db->where('parent','0');  
        $this->db->order_by('cat_ranking','DESC');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result_array();       
   }
     public function getHeaderSectionList(){
        $this->db->select('*');
        $this->db->from('field_design_section_of_house'); 
        $this->db->where('status','1');  
        $this->db->order_by('rank','DESC');
        $this->db->limit('5');
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
  public function getSellers($offset,$limit)
	{
		
		
		$queryStr = "SELECT `t2`.`market_seller_id`,`t2`.`market_seller_name`,`t2`.`market_seller_logo_image`
                            FROM `jb080_market_seller_details_mapp_bespoke` AS `t1` 
                            INNER JOIN `jb080_market_seller_details` AS `t2` ON `t1`.`market_seller_id` = `t2`.`market_seller_id` 
                            INNER JOIN `jb080_ecom_product_mapp_seller_inventory` AS `t4` ON `t1`.`market_seller_id` = `t4`.`market_seller_id` 
                            INNER JOIN `jb080_ecom_products` AS `t3` ON `t3`.`product_id` = `t4`.`product_id` 
                            WHERE `t1`.`field_seller_bespoke_id` != '1' AND t2.status = '3' AND `t2`.`flag_agree_t_c` = '1' 
                            GROUP BY `t1`.`market_seller_id` ORDER BY `t2`.`market_seller_id` DESC LIMIT ".$offset.",".$limit;	
		$query = $this->db->query($queryStr);
		return $query->result_array();
	}
 
}

?>
