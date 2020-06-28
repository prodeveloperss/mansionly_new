<?php

class Md_favorites extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   

  
  
    public function getFavoritesDesignerList()
    {
        /* This is fetching the design details list based on the selected Type/section */

        $queryStr = "SELECT `d`.`id`,`d`.`designer_name`,`d`.`designer_email_id`,`d`.`designer_mobile_no`,`d`.`introduction`,
                     `d`.`designer_logo`, `d`.`designer_logo2`,`d`.`ranking`,`d`.`status` FROM `jb080_master_designer` AS `d` 
                     INNER JOIN `jb080_customer_favorites_list` AS `C` ON `C`.`favorites_record_id`= `d`.`id` ";
        $whereStr = "WHERE `d`.`status`='3' AND `d`.`tmp_status`='0' AND `C`.`favorites_type`='designer' AND `C`.`customer_id`=".$_SESSION['customer_id'];
        $OrderStr = " GROUP BY d.`id`  Order By d.ranking Desc ";
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

        return $query->result_array();
    }
    
    
    
     public function getDesignerTopRatedTheme($designerId)
	{
		$queryStr = "select  design_id, design_name, design_display_name, design_img, design_designer 
		from jb080_master_design_details ";
		$whereStr = " where design_designer = '" . $designerId . "' and status = '1' ";
		$OrderStr = " order by design_ranking desc limit 1";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		return $query->result_array();
	}

	public function getDesignerTopRatedPortfolio($designerId)
	{
		$queryStr = "select id portfolio_id,  portfolio_name, master_image, designer_id from jb080_execution_portfo ";
		$whereStr = " where status = 'Active' AND designer_id = '"  . $designerId . "'";
		$OrderStr = " order by ranking desc limit 1";
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		return $query->result_array();
	}
   
   
     public function getFavoritesExecutionPortfolio($offset,$limit){
          

     $queryStr = "SELECT t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,		
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images from jb080_execution_portfo t1
                INNER JOIN jb080_master_designer t2 on t1.designer_id = t2.id
                INNER JOIN `jb080_customer_favorites_list` AS `C` ON `C`.`favorites_record_id`= `t1`.`id`
                left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id ";
		$whereStr = "WHERE t1.`status` = 'active' AND `C`.`favorites_type`='executionportfolio' AND `C`.`customer_id`=".$_SESSION['customer_id'];
		$whereStr.= " group by t1.id";
		$OrderStr =  "Order by t1.ranking desc";
		//$OrderStr =  "Order by t1.ranking desc LIMIT ".$offset.",".$limit;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
   }
     public function getFavoritesDesignList($offset,$limit)
    {
               

        $queryStr = "Select distinct t1.design_id,t1.design_name,t1.design_display_name, t1.design_price,t1.design_img,
               t1.design_ranking, t1.design_designer,t1.`status`,t3.`status`,t1.on_date,t1.design_specf, t1.design_des,t1.design_type,
		 GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images
		  from jb080_master_design_details t1
		  Left outer join jb080_mapp_master_design_details_design_theme t2
		  ON t1.design_id = t2.master_design_id
		  Left outer JOIN jb080_field_design_theme_master t3
		  ON t2.field_design_theme_id = t3.id
		  left join jb080_master_design_details_images t4 on t1.design_id = t4.design_id
                  INNER JOIN `jb080_customer_favorites_list` AS `C` ON `C`.`favorites_record_id`= `t1`.`design_id`";
        $whereStr = "where `t1`.`status` = '1' AND `C`.`favorites_type`='designtheme' AND `C`.`customer_id`=".$_SESSION['customer_id'];            
        $whereStr = $whereStr . " group by t1.design_id";
        $OrderStr = " Order By t1.design_ranking desc";
        //$OrderStr = " Order By t1.design_ranking desc, t1.design_display_name LIMIT ".$offset.",".$limit;
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

        return $query->result_array();
    }
     public function getFavoritesProductList($offset,$limit)
{
         
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('jb080_customer_favorites_list AS `t3`','`t1`.`product_id` = `t3`.`favorites_record_id`');
        $this->db->where('`t1`.`status`','1');
        $this->db->where_in('`t3`.`customer_id`',$_SESSION['customer_id']);
        $this->db->where_in('`t3`.`favorites_type`','marketseller');
      //  $this->db->limit($limit,$offset);
        $this->db->order_by('product_ranking DESC');
        $query = $this->db->get();
        
        return $query->result_array();
	}
    
}

?>
