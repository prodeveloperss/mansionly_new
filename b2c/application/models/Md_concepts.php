<?php
class Md_concepts extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
	//function for inserting data into database
    public function insertData($table, $data) {
        $this->db->insert($table, $data);
		return $this->db->insert_id();
    }
	
	//function for update data into database
    public function updateData($queryStr) {
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
    }
	
	//function for select data into database
    public function selectData($queryStr) {
        $query = $this->db->query($queryStr);
        return $query->result_array();
    }
	
	//sql::get SOH section header list:
	public function getDesignSohNavBarList()
    {
		$queryStr = "SELECT `T1`.`soh_id`, `T2`.`title` AS `soh_title`, count(`T1`.`id`) AS `numOfImages` 
				  FROM `jb080_galleryimgs_details_mapp_design_soh` AS `T1`
                  INNER JOIN `jb080_field_design_section_of_house` AS `T2`
                  ON   `T1`.`soh_id` =  `T2`.`id`
                  LEFT JOIN `jb080_field_design_section_of_house_mapp_ranking` AS `T3`
                  ON   `T2`.`id` =  `T3`.`soh_id` 
               	  GROUP BY `T1`.`soh_id` ORDER BY `T3`.`soh_id` DESC, `numOfImages` DESC"; 
        $query = $this->db->query($queryStr);
        return $query->result_array(); 
	}
	

	
}//end::Class;


?>
