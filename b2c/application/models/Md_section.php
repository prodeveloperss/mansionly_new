<?php

class Md_section extends CI_Model {

    function __construct() {
        parent::__construct();
    }

        
       
        
        public function all_sections($offset,$limit)
	{
		$queryStr = "select id, title from jb080_field_design_section_of_house where status = '1'";
		$OrderStr = "Order By rank desc LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr ." ".$OrderStr);
		return $query->result_array();
	}
        public function all_sections_count()
	{       $queryStr = " SELECT COUNT(`id`) AS `totalCount` FROM `jb080_field_design_section_of_house` 
                WHERE `status` = '1'";
		$query = $this->db->query($queryStr);
		return $query->result_array();
		
	}
        public function getSectiontopproduct($id)
	{
		$queryStr = "select t1.product_id, t1.product_name, t1.product_image 
		from  jb080_ecom_products t1
		inner join  jb080_ecom_product_mapp_design_type t2 on t1.product_id = t2.product_id
		where t2.field_design_type_id  = ".$id;
		$OrderStr = " Order By t1.product_ranking desc,t1.product_id limit 1";  
		$query = $this->db->query($queryStr. " " . $OrderStr);
		return $query->result_array();
	}

}

?>
