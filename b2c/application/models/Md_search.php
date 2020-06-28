<?php

class Md_search extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   
   

    public function getDesignerDetailSearch($search_keyword,$offset,$limit)
	{
        
          
		$queryStr = "SELECT t1.*,t5.countryName FROM jb080_master_designer AS t1 
                INNER JOIN jb080_master_designer_city_details AS t2 ON t1.id = t2.designer_id
                INNER JOIN jb080_master_city AS t3 ON t2.city_id = t3.id
                INNER JOIN jb080_state AS t4 ON t3.state_id = t4.state_id
                INNER JOIN jb080_countries AS t5 ON t4.country_id = t5.idCountry
                ";
		$whereStr = " WHERE t1.status = '3' ";
                $whereStr = $whereStr  . " and (  t1.designer_name like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or t1.introduction like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or t1.designer_description like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or t1.design_philosophy like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or t1.design_awards like '%" . $search_keyword . "%' )  ";
                $OrderStr ="Order By ranking desc LIMIT ".$offset.",".$limit;
	        //echo $queryStr . " " . $whereStr. " " . $OrderStr;
	       $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
	       return $query->result_array();  

	}
        
         public function getPorfolioList($search_keyword,$offset,$limit)
	{
//		$queryStr = "SELECT `t1`.`id`,`t1`.`portfolio_name`,`t1`.`master_image`, GROUP_CONCAT(`t2`.`img` SEPARATOR ',') AS `secondary_images`,`t2`.`executioner_id` from `jb080_execution_portfo` AS `t1`
//                             LEFT JOIN `jb080_execution_portfolio_images` AS `t2` ON `t1`.`id` = `t2`.`executioner_id`
//                            ";
		$queryStr = "SELECT `t1`.`id`,`t1`.`portfolio_name`,`t1`.`master_image`, GROUP_CONCAT(`t2`.`img` SEPARATOR ',') AS `secondary_images`,`t2`.`executioner_id`,`t3`.`designer_name`from `jb080_execution_portfo` AS `t1`
                             LEFT JOIN `jb080_execution_portfolio_images` AS `t2` ON `t1`.`id` = `t2`.`executioner_id`
                             INNER JOIN jb080_master_designer t3 on t1.designer_id = t3.id
                            ";
		$whereStr = " where `t1`.`status` = 'Active' ";		
                $whereStr = $whereStr  . " and (`t1`.`portfolio_name` like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or `t1`.`portfolio_description` like '%" . $search_keyword . "%'";                
                $whereStr = $whereStr  . " or `t1`.`portfolio_specification` like '%" . $search_keyword . "%' )  ";		
		$OrderStr = "GROUP BY `t1`.`id` Order By `t1`.`ranking` desc LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	}
         public function getPorfolioTotalCount($search_keyword)
	{
		$queryStr = "SELECT COUNT(`id`) AS `totalCount` from jb080_execution_portfo";
		$whereStr = " where status = 'Active' ";		
                $whereStr = $whereStr  . " and (portfolio_name like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or portfolio_description like '%" . $search_keyword . "%'";                
                $whereStr = $whereStr  . " or portfolio_specification like '%" . $search_keyword . "%' )  ";		
		//$OrderStr = " Order By ranking desc LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr);
		return $query->result_array();
	}
        
       public function getDesignerTotalCount($search_keyword)
	{

		$queryStr = "SELECT COUNT(`id`) AS `totalCount` FROM jb080_master_designer";
		$whereStr = " WHERE status = '3' ";
		
                $whereStr = $whereStr  . " and (  designer_name like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or introduction like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or designer_description like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or design_philosophy like '%" . $search_keyword . "%'";
                $whereStr = $whereStr  . " or design_awards like '%" . $search_keyword . "%' )  ";
			
		$OrderStr ="";//	 " Order By designer_name";
              //$OrderStr ="Order By ranking desc LIMIT ".$offset.",".$limit;
	    //echo $queryStr . " " . $whereStr. " " . $OrderStr;
	       $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
	       return $query->result_array();  

	} 
      
          public function getProductListSearch($search_keyword,$offset,$limit,$brand_id="",$soh_id="",$cor="",$product_id)
	{
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`short_description`,`t1`.`product_image`,`t1`.`product_details`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_brand AS `t3`','`t1`.`product_brand_id` = `t3`.`brand_id`');
        if(!empty($soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`field_design_type_id`',$soh_id);
        }
        if(!empty($cor)){
        $this->db->where_in('`t1`.`origin_country`',$cor);
        }
        if(!empty($brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        }
        $this->db->where('`t1`.`status`','1');     
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t3`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);  
        $this->db->order_by('`t1`.product_ranking');
        $this->db->group_by('`t1`.product_id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
	}
      
     
       
          public function getProductTotalCount($search_keyword,$brand_id="",$soh_id="",$cor="",$product_id)
	{
        $this->db->select('`t1`.`product_id`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_brand AS `t3`','`t1`.`product_brand_id` = `t3`.`brand_id`');
        if(!empty($soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`field_design_type_id`',$soh_id);
        }
        if(!empty($cor)){
        $this->db->where_in('`t1`.`origin_country`',$cor);
        }
        if(!empty($brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        }  
        $this->db->where('`t1`.`status`','1');
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        }   
        
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t3`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);  
        $query = $this->db->get();
        return $query->result_array();
	}
        
         public function get_product_id_by_color_and_material($search_keyword)
	{
        $this->db->select('GROUP_CONCAT(distinct `t1`.`product_id` SEPARATOR ",") as product_id');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_color AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('ecom_product_mapp_material AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where('`t1`.`status`','1');   
        $this->db->where('`t1`.`product_id` is NOT NULL', NULL, FALSE);
        $where="(`t2`.`color` LIKE '%$search_keyword%' OR `t3`.`primary_material` LIKE '%$search_keyword%')";
        $this->db->where($where);       
        $query = $this->db->get();
        return $query->result_array();
	}
        
        
         public function get_product_color($product_id)
	{
        $this->db->select('GROUP_CONCAT(`color` SEPARATOR ",") as color');
        $this->db->from('ecom_product_mapp_color');
        $this->db->where('product_id',$product_id);           
        $query = $this->db->get();
        return $query->result_array();
	}
        
         public function get_product_material($product_id)
	{
        $this->db->select('GROUP_CONCAT(`primary_material` SEPARATOR ",") as material');
        $this->db->from('ecom_product_mapp_material');
        $this->db->where('product_id',$product_id);           
        $query = $this->db->get();
        return $query->result_array();
	}
        
        public function get_brand_list($array_soh_id="",$array_cor="",$search_keyword,$product_id=array())
	{
        $this->db->select('`t2`.`brand_id`,`t2`.`brand_name`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('jb080_ecom_brand AS `t2`','`t1`.`product_brand_id` = `t2`.`brand_id`');
        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where_in('`t3`.`field_design_type_id`',$array_soh_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
        
        $this->db->where('`t1`.`status`','1');        
        $this->db->where('`t2`.`status`','1'); 
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t2`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);  
        $this->db->order_by('`t2`.brand_name');
        $this->db->group_by('`t2`.brand_id');
        $query = $this->db->get();
        return $query->result_array();
	}
        public function get_brand_product_count($brand_id,$array_soh_id="",$array_cor="",$search_keyword,$product_id=array())
	{
           
        
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('jb080_ecom_brand AS `t2`','`t1`.`product_brand_id` = `t2`.`brand_id`');
        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where_in('`t3`.`field_design_type_id`',$array_soh_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
        
        $this->db->where('`t1`.`status`','1');   
        $this->db->where('`t1`.`product_brand_id`',$brand_id);
        
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%'  OR `t2`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);  
        $query = $this->db->get();
        return $query->result_array();
	}
        
        
       public function get_section_list($array_brand_id="",$array_cor="",$search_keyword,$product_id=array()){
            
        $this->db->select('`t3`.`id`,`t3`.`title`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_design_type AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('field_design_section_of_house AS `t3`','`t2`.`field_design_type_id` = `t3`.`id`');
        $this->db->join('jb080_ecom_brand AS `t4`','`t1`.`product_brand_id` = `t4`.`brand_id`');
        
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
        
        $this->db->where('`t1`.`status`','1'); 
        
        $this->db->where('`t3`.`status`','1');   
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t4`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);
        $this->db->order_by('`t3`.`title`');
        $this->db->group_by('`t3`.`id`');
        $query = $this->db->get();
        return $query->result_array();      
   }
   
   public function get_section_product_count($soh_id,$array_brand_id="",$array_cor="",$search_keyword,$product_id=array()){
            
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_design_type AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('field_design_section_of_house AS `t3`','`t2`.`field_design_type_id` = `t3`.`id`');
        $this->db->join('jb080_ecom_brand AS `t4`','`t1`.`product_brand_id` = `t4`.`brand_id`');
        
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
        
        $this->db->where('`t1`.`status`','1');   
        $this->db->where('`t3`.`status`','1');   
        $this->db->where('`t3`.`id`',$soh_id);   
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        }        
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%'  OR `t4`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();      
   }

       public function get_country_list($array_brand_id="",$array_soh_id="",$search_keyword,$product_id=array()){
        
        $this->db->select('`t2`.`idCountry`,`t2`.`countryName`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('countries AS `t2`','`t1`.`origin_country` = `t2`.`countryName`');
        $this->db->join('jb080_ecom_brand AS `t3`','`t1`.`product_brand_id` = `t3`.`brand_id`');
        
        
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`field_design_type_id`',$array_soh_id);
        }
        
        $this->db->where('`t1`.`status`','1');   
        
        //$this->db->where('`t2`.`status`','1');   
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t3`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);
        $this->db->group_by('`t2`.`idCountry`');
        $query = $this->db->get();
        return $query->result_array();  
        
   }
   
       public function get_country_product_count($country_id,$array_brand_id="",$array_soh_id="",$search_keyword,$product_id=array()){
      
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('countries AS `t2`','`t1`.`origin_country` = `t2`.`countryName`');
        $this->db->join('jb080_ecom_brand AS `t3`','`t1`.`product_brand_id` = `t3`.`brand_id`');
        
        
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`field_design_type_id`',$array_soh_id);
        }
        
        $this->db->where('`t1`.`status`','1');         
        
        //$this->db->where('`t2`.`status`','1');   
        $this->db->where('`t2`.`idCountry`',$country_id); 
        $product_ids_condition ="";
        /*[Product id by material and color]*/
        if(!empty($product_id)){            
        $product_ids_condition= " OR `t1`.`product_id` IN('$product_id')";
        } 
        $where="(`t1`.`product_name` LIKE '%$search_keyword%' OR `t1`.`short_description` LIKE '%$search_keyword%' OR `t1`.`product_details` LIKE '%$search_keyword%' OR `t3`.`brand_name` LIKE '%$search_keyword%' $product_ids_condition)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();  
        
   }

     
      
        
    
        
   
}

?>
