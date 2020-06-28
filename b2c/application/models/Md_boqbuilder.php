<?php

class Md_boqbuilder extends CI_Model {

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
	
    //sql::get boq section header list:
    public function getBOQSectionHeaderList($project_type_control)
    {
        $queryStr = "SELECT `section_header`, `project_type_control` FROM `jb080_order_boq_builder_section_master` ";
        $whereStr = "WHERE  `project_type_control`='".$project_type_control."'  ";
        $OrderStr = " GROUP BY `section_header` ORDER BY `section_header` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq section service header list:
    public function getBOQSectionServiceScopeHeaderList($project_type_control)
    {
        $queryStr = "SELECT `job`, `project_type_control` FROM `jb080_order_boq_builder_job_scope_master` ";
        $whereStr = "WHERE `project_type_control`='".$project_type_control."' ";
        $OrderStr = " GROUP BY `job` ORDER BY `job` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq section details from $section_id:
    public function getBOQSectionDetailsFromSectionId($section_id)
    {
        $queryStr = "SELECT * FROM `jb080_order_boq_builder_section_master` ";
        $whereStr = "WHERE `id`='".$section_id."' ";
        $OrderStr = " ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
    
	//sql::get boq section list from section header name:
	 public function getBOQSectionListFromSectionHeader($sectionHeaderName,$project_type_control)
    {
    	$queryStr = "SELECT `id` AS `section_id`, `section`, `section_header`, `project_type_control` FROM `jb080_order_boq_builder_section_master` ";
        $whereStr = "WHERE `section_header`='".$sectionHeaderName."' AND `project_type_control`='".$project_type_control."' ";
        $OrderStr = " ORDER BY `section` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq section service scope list from section service scope header name:
	 public function getBOQSectionServiceScopeListFromHeaderName($sectionServiceScopeHeaderName,$project_type_control)
    {
    	$queryStr = "SELECT `job_id`, `job`, `scope`, `project_type_control` FROM `jb080_order_boq_builder_job_scope_master` ";
        $whereStr = "WHERE `job`='".$sectionServiceScopeHeaderName."' AND `project_type_control`='".$project_type_control."'  ";
        $OrderStr = " ORDER BY `scope` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq rate card details of rate card ids:
	 public function getBOQRateCardDtlsFromRateCaesIds($strRateCardIds)
    {
    	$queryStr = "SELECT `T1`.*, `T2`.`calc_logic_description`,`T3`.`job` as `typologyTxt`,`T3`.`scope` as `scopeTxt`, `T3`.`default_measurement`, `T4`.`default_measurement_description`,
                    `T5`.`description` AS `descriptionTxt`, `T5`.`specification` AS `specificationTxt`, `T5`.`brand` AS `brandTxt`, `T5`.`measurement_unit` AS `reqNumberUnitTxt`,`T6`.`cost_profile` AS `cost_profileTxt` FROM `jb080_order_boq_builder_rates` AS `T1` 
					 LEFT JOIN `jb080_order_boq_builder_calc_logic` AS `T2` ON `T1`.`calc_logic` = `T2`.`calc_logic` 
					 LEFT JOIN `jb080_order_boq_builder_job_scope_master` AS `T3` ON `T1`.`job_id` = `T3`.`job_id` 
					 LEFT JOIN `jb080_order_boq_builder_default_measurement` AS `T4` ON `T3`.`default_measurement` = `T4`.`default_measurement` 
					 LEFT JOIN `jb080_order_boq_builder_specification_master` AS `T5` ON `T1`.`specification_id` = `T5`.`specification_id` 
					 LEFT JOIN `jb080_order_boq_builder_cost_profile` AS `T6` ON `T1`.`cost_profile_id` = `T6`.`cost_profile_id` 
					 ";
        $whereStr = "WHERE `T1`.`rate_id` IN ('".$strRateCardIds."') AND `status`='Active' ";
        $OrderStr = " ORDER BY `T1`.`rate_id` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	
	//sql::Gget section wise~low cost(Price) Record Id details;:
	public function getBOQMappSectionLowestCostingRecordIdDtlsFromSectionId($section_mapp_id,$section_id,$idBoqBuild)
    {
    	$queryStr = "SELECT * FROM `jb080_order_boq_builder_details_mapp_section_service_list`
					WHERE (`price`) IN (SELECT  min(`price`) FROM `jb080_order_boq_builder_details_mapp_section_service_list` 
					WHERE `section_mapp_id`='".$section_mapp_id."' AND `section_id`='".$section_id."' AND `idBoqBuild`='".$idBoqBuild."' GROUP BY `job_id`) 
					AND `idBoqBuild`='".$idBoqBuild."' ";
        $query = $this->db->query($queryStr);
        return $query->result_array();
    }

    //sql::Delete Section Wise~High Cost(Price) Record;:
	public function deleteBOQMappSectionHighCostingRecordIdDtlsFromSectionIdAndLowCostId($section_mapp_id,$section_id,$strLowestCostingRecdIds)
    {
    	$queryStr = "DELETE FROM `jb080_order_boq_builder_details_mapp_section_service_list`  
					 WHERE `section_mapp_id`='".$section_mapp_id."' AND `section_id`='".$section_id."' AND `id` NOT IN (".$strLowestCostingRecdIds.") ";
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
    }

	//sql::get BOQ Total Price:
	public function getBoqBuildTotalPriceFromMappSectionPriceList($idBoqBuild)
	{
		$queryStr = "SELECT SUM(`price`) AS `total_price` FROM `jb080_order_boq_builder_details_mapp_section_service_list` WHERE `idBoqBuild` = '".$idBoqBuild."' ";
        $query = $this->db->query($queryStr);
        return $query->result_array();
	}
    
	//sql::Update BOQ Total Price:
	public function updateBoqBuildTotalPriceByIdBoqBuild($idBoqBuild,$totalPriceBOQBuild)
	{
		$queryStr = "UPDATE `jb080_order_boq_builder_details` SET `totalPrice`= '".$totalPriceBOQBuild."', `onDateTime`='".date('Y-m-d H:i:s')."' 
					 WHERE `idBoqBuild`='".$idBoqBuild."' ";
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
	}
	
	//sql::get boq build details:
	public function getBOQBuildDetails($idBoqBuild)
    {
    	$queryStr = "SELECT * FROM `jb080_order_boq_builder_details` ";
        $whereStr = "WHERE `idBoqBuild`='".$idBoqBuild."' ";
        $OrderStr = " ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq build Mapp Section Header List:
	public function getBOQBuildDetailsMappSectionHeaderList($idBoqBuild)
    {
    	$queryStr = "SELECT `T1`.`id` as `section_mapp_id`, `T1`.`section_id`, `T1`.`section_title` as `section_name`, `T1`.`length` AS `section_length`,
					 `T1`.`breadth` AS `section_breadth`
					 FROM `jb080_order_boq_builder_details_mapp_section_list` AS `T1` 
					 LEFT JOIN  `jb080_order_boq_builder_section_master` AS `T2`
					 ON `T1`.`section_id` = `T2`.`id` ";
        $whereStr = " WHERE `T1`.`idBoqBuild`='".$idBoqBuild."' ";
        $OrderStr = " ORDER BY `T1`.`id` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
    }
	
	//sql::get boq build Mapp Section Header List:
	public function getBuildBOQSectionListBYSectionIdAndIdBoqBuild($section_mapp_id,$section_id,$idBoqBuild)
    {
		$queryStr = "SELECT `T1`.*, `T2`.`section` as `section_name`, `T3`.`scope` as `job_name`, `T5`.`description` as `specification_descp`,
				    `T5`.`specification`, `T5`.`brand`, `T5`.`measurement_unit`, `T6`.`cost_profile`   
					 
					 FROM `jb080_order_boq_builder_details_mapp_section_service_list` AS `T1` 
					 
					 LEFT JOIN  `jb080_order_boq_builder_section_master` AS `T2` ON `T1`.`section_id` = `T2`.`id`
					 
					 LEFT JOIN `jb080_order_boq_builder_job_scope_master` AS `T3` ON `T1`.`job_id` = `T3`.`job_id` 
					 
					 LEFT JOIN `jb080_order_boq_builder_default_measurement` AS `T4` ON `T3`.`default_measurement` = `T4`.`default_measurement` 
					 
					 LEFT JOIN `jb080_order_boq_builder_specification_master` AS `T5` ON `T1`.`specification_id` = `T5`.`specification_id` 
					 
					 LEFT JOIN `jb080_order_boq_builder_cost_profile` AS `T6` ON `T1`.`cost_profile_id` = `T6`.`cost_profile_id` 
					 
					 ";
        $whereStr = " WHERE `T1`.`idBoqBuild`='".$idBoqBuild."' AND `T1`.`section_mapp_id`='".$section_mapp_id."' AND `T1`.`section_id`='".$section_id."' ";
        $OrderStr = " ORDER BY `T1`.`id` ASC ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
        return $query->result_array();
	}
	
	public function updateBuildBoqDetails($queryStr)
	{
		/*$queryStr = "UPDATE `jb080_order_boq_builder_details` SET `".$key."`= '".$value."', `onDateTime`='".date('Y-m-d H:i:s')."' 
					 WHERE `idBoqBuild`='".$idBoqBuild."' ";*/
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
	}	
	
	public function deleteBuildBOQSectionById($section_mapp_id,$section_id,$idBoqBuild)
    {
    	$queryStr = "DELETE FROM `jb080_order_boq_builder_details_mapp_section_list`  
					 WHERE `id`='".$section_mapp_id."' AND `section_id`='".$section_id."' AND `idBoqBuild` = ".$idBoqBuild." ";
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
    }
	
	public function deleteBuildBOQSectionServicesById($section_mapp_id,$section_id,$idBoqBuild)
    {
    	$queryStr = "DELETE FROM `jb080_order_boq_builder_details_mapp_section_service_list`  
					 WHERE `section_mapp_id`='".$section_mapp_id."' AND `section_id`='".$section_id."' AND `idBoqBuild` = ".$idBoqBuild." ";
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
    }
	
	public function deleteBuildBOQSectionServiceById($serviceId,$idBoqBuild)
    {
    	$queryStr = "DELETE FROM `jb080_order_boq_builder_details_mapp_section_service_list`  
					 WHERE `id`='".$serviceId."' AND `idBoqBuild` = ".$idBoqBuild." ";
        $query = $this->db->query($queryStr);
        return $this->db->affected_rows();
    }
	
}//end::Class;


?>
