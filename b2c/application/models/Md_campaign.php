<?php

/*[
Date:: 07-09-2017
Purpose of this Model ::
- Conatining the database queries to filter the product listing by brandwise, categorywise or sectionwise.
]*/

class Md_campaign extends CI_Model {

    function __construct() {
        parent::__construct();
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
