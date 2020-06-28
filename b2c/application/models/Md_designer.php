<?php

class Md_designer extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   
   public function getDesignerDetail($designer_id)
	{
		$queryStr = " SELECT d.id,d.designer_name,d.designer_email_id,d.designer_mobile_no,d.introduction,d.designer_description,d.design_philosophy, d.design_awards,d.designer_logo,
                d.website,d.expereince, d.designer_occupation_id,
		d.designer_logo2,d.info_pan,d.info_tan,d.info_bank_name,d.info_bank_account_number,d.info_bank_account_name,d.tmp_info_bank_account_name,
		d.ranking,d.`status`,d.created_by_user_id,d.flag_agree_t_c,d.on_date,d.remote_address,
		IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId
		FROM	jb080_master_designer AS d
		left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'designer' group by favorites_type,favorites_record_id )
		t11 on d.id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'designer') t12
		on d.id = t12.favorites_record_id";
		$whereStr = " WHERE d.status = '3'";
	        $whereStr = $whereStr . " and " . "d.id = '" . $designer_id . "' LIMIT 1";
		//$OrderStr ="  LIMIT ".$recordFrom.",".$recordTo;//	 " Order By designer_name";
		//echo $queryStr . " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr);
		return $query->result_array();


	}
        
      public function getTotalDesignerExecutionCount($designer_id)
    {
          
        $queryStr="SELECT COUNT(`t1`.`id`) AS `totalCount` from `jb080_execution_portfo` `t1` WHERE `t1`.`status` = 'active' and `t1`.`designer_id`=".$designer_id;
                  
        
        $query = $this->db->query($queryStr);

	return $query->result_array();
	}
      public function getTotalDesignConceptCount($portfolio_id="",$designer_id)
    {
          
        $queryStr="SELECT COUNT(`t1`.`design_id`) AS `totalCount` FROM `jb080_master_design_details` AS `t1` WHERE `t1`.`status` = '1' and `t1`.`design_designer`=".$designer_id;
        
        if(!empty($portfolio_id)){
          $queryStr.=' AND `t1`.`design_id`!='.$portfolio_id;  
        }
                  
        
        $query = $this->db->query($queryStr);

	return $query->result_array();
	}
        
        
     public function getdesignerPortfolio_profile($designer_id,$offset,$limit)
    {
        

        $queryStr = "SELECT t1.id,t1.portfolio_name,t1.portfolio_description,t1.portfolio_specification,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,
		t1.on_date,t1.remote_address,t2.designer_name,t2.designer_email_id,t2.designer_mobile_no,t2.introduction,
		t2.designer_description,t2.design_philosophy,t2.design_awards,t2.designer_logo,t2.website,
		t2.expereince,t2.ranking,IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId,
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images,
		t4.seller_id,t4.seller_name,t4.seller_email,t4.seller_mbl,t4.seller_logo_image,t4.introduction seller_introduction,
		t4.seller_description,t4.philosophy,t4.awards,t4.website seller_website,t4.ranking seller_ranking
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'executionportfolio' group by favorites_type,favorites_record_id )
		t11 on t1.id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'executionportfolio') t12
		on t1.id = t12.favorites_record_id";
     
        $whereStr = " WHERE t1.`status` = 'active'";
        $whereStr = $whereStr . " and " . "t1.designer_id= '" . $designer_id . "'";
	$whereStr = $whereStr . " group by t1.id ";
        // $OrderStr = "";
        $OrderStr = " LIMIT ".$offset.",".$limit;
        $query = $this->db->query($queryStr . " " . $whereStr." ".$OrderStr);

	return $query->result_array();
	}

   public function getThemeWiseDesignList_profile($designer_id,$offset,$limit)
    {
               

        $queryStr = "Select distinct t1.design_id,t1.design_name,t1.design_display_name, t1.design_price,t1.design_img,
        t1.design_ranking, t1.design_designer,t1.`status`,t3.`status`,t1.on_date,t1.design_specf, t1.design_des,t1.design_type,
		  IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId , GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images
		  ,t5.designer_name 
                  from jb080_master_design_details t1
		  Left outer join jb080_mapp_master_design_details_design_theme t2
		  ON t1.design_id = t2.master_design_id
		  Left outer JOIN jb080_field_design_theme_master t3
		  ON t2.field_design_theme_id = t3.id
		  left join jb080_master_design_details_images t4 on t1.design_id = t4.design_id
		  inner join jb080_master_designer t5 on t1.design_designer = t5.id
		  left outer join
		  (select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		  WHERE favorites_type = 'designtheme'
		  group by favorites_type,favorites_record_id )
		  t11 on t1.design_id = t11.favorites_record_id
		  left outer join
		  (Select favorites_record_id from jb080_customer_favorites_list
		  where favorites_type = 'designtheme') t12
		  on t1.design_id = t12.favorites_record_id";
        $whereStr = "where t1.status = '1'";
                       
        $whereStr = $whereStr . " and " . "t1.design_designer = '" . $designer_id . "'";
            
        $whereStr = $whereStr . "group by t1.design_id";
        $OrderStr = " Order By t1.design_ranking desc, t1.design_display_name LIMIT ".$offset.",".$limit;
        //$OrderStr = " Order By t1.design_ranking desc, t1.design_display_name  LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
        //echo $queryStr . " " . $whereStr. " " . $OrderStr;
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

        return $query->result_array();
    }
    

        
        public function  getDesignerList($offset,$limit)
    {
        /* This is fetching the design details list based on the selected Type/section */



        $queryStr = " SELECT d.id,d.designer_name,d.designer_email_id,d.designer_mobile_no, d.introduction,
                     d.designer_logo, 
		d.website,d.expereince, d.designer_occupation_id,d.designer_logo2,d.info_pan, d.info_tan,d.info_bank_name,
		d.ranking,d.`status`,d.created_by_user_id,d.flag_agree_t_c		
		FROM `jb080_master_designer` AS d 
		INNER JOIN `jb080_master_designer_city_details` AS `MDCD` 
		INNER JOIN `jb080_master_city` AS `CT` 
		INNER JOIN `jb080_state` AS `ST` 
		INNER JOIN `jb080_countries` AS `CN` 
		ON d.`id` = `MDCD`.`designer_id` AND `MDCD`.`city_id` = `CT`.`id` 
		AND `CT`.`state_id` = `ST`.`state_id` AND `ST`.`country_id` = `CN`.`idCountry`"; 
        $whereStr = "WHERE d.`status`='3' ";

        //$OrderStr = " GROUP BY d.`id`  Order By d.ranking Desc ";
        $OrderStr = " GROUP BY d.`id`  Order By d.ranking Desc, d.id Desc LIMIT ".$offset.",".$limit;
        //echo $queryStr . " " . $whereStr. " " . $OrderStr;
        
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

        return $query->result_array();
    }
        public function getDesignerListAllCount()
    {
        /* This is fetching the design details list based on the selected Type/section */

        $queryStr = " SELECT COUNT(`t1`.`id`) AS `totalCount` FROM `jb080_master_designer` AS `t1` 
                     WHERE `t1`.`status`='3' ";
        $query = $this->db->query($queryStr);

        return $query->result_array();
    }
    public function getFavoritesDesignerList()
    {
        /* This is fetching the design details list based on the selected Type/section */

        $queryStr = "SELECT d.id,d.designer_name,d.designer_email_id,d.designer_mobile_no, d.introduction,
                     d.designer_logo, d.designer_logo2,d.ranking,d.`status` FROM `jb080_master_designer` AS d 
                     INNER JOIN `jb080_customer_favorites_list` AS `C` ON `C`.`favorites_record_id`= `d`.`id` ";
        $whereStr = "WHERE `d`.`status`='3' AND `C`.`favorites_type`='designer' ";
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
        
           public function getdesignerPortfolio($portfolio_id)
    {
        $customerid=0;
        if(isset($_SESSION["customerId"]))
        $customerid = $_SESSION["customerId"];
         

        $queryStr = "SELECT t1.id,t1.portfolio_name,t1.portfolio_description,t1.portfolio_specification,t1.executioner,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,
	t2.designer_name,t2.designer_logo,t12.favorites_record_id selectedId,
        GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images			
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'executionportfolio' group by favorites_type,favorites_record_id )
		t11 on t1.id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'executionportfolio' and customer_id = ".$customerid.") t12
		on t1.id = t12.favorites_record_id";
       	//t2.id IN ((	Select design_designer from `jb080_master_design_details` where status = '1'  ))";
        $whereStr = " WHERE t1.`status` = 'active'";
		//$whereStr = " where t1.`status` = 'active'";
		if (!empty($portfolio_id))
		{
                        $whereStr = $whereStr . " and " . " t1.id = '" . $portfolio_id . "'";
		}
		$whereStr = $whereStr . " group by t1.id ";
		$OrderStr = " ";
		//$OrderStr = " LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		
        //echo "designer portfolio----->   		".$queryStr . " " . $whereStr." ".$OrderStr;

		$query = $this->db->query($queryStr . " " . $whereStr." ".$OrderStr);

		return $query->result_array();
	}

    
    public function getTotalPortfolioCount($portfolio_id="",$designer_id)
    {
        
        $queryStr = "SELECT COUNT(`t1`.`id`) AS `totalCount` FROM `jb080_execution_portfo` AS `t1`
                         WHERE  `t1`.`designer_id`= ".$designer_id."";
        
        if (!empty($portfolio_id))
		{
                        $queryStr.=  " AND `t1`.`id` != ".$portfolio_id;
		}
        $query = $this->db->query($queryStr);
        return $query->result_array();
    }    
    
    public function getOtherPortfolio($portfolio_id,$designer_id,$offset,$limit)
    {
        $customerid=0;
        if(isset($_SESSION["customerId"]))
        $customerid = $_SESSION["customerId"];
         

        $queryStr = "SELECT t1.id,t1.portfolio_name,t1.portfolio_description,t1.portfolio_specification,t1.designer_id,t1.master_image,t1.ranking,t1.`status`,
	t2.designer_name,t2.designer_logo,t12.favorites_record_id selectedId,
        GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images			
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'executionportfolio' group by favorites_type,favorites_record_id )
		t11 on t1.id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'executionportfolio' and customer_id = ".$customerid.") t12
		on t1.id = t12.favorites_record_id";
       	//t2.id IN ((	Select design_designer from `jb080_master_design_details` where status = '1'  ))";
        $whereStr = " WHERE t1.`status` = 'active'";
		//$whereStr = " where t1.`status` = 'active'";
		if (!empty($portfolio_id))
		{
                        $whereStr = $whereStr . " and " . " t1.id != '" . $portfolio_id . "' AND `t1`.`designer_id`=".$designer_id;
		}
		$whereStr = $whereStr . " group by t1.id ";
		$OrderStr = " ";
		$OrderStr = " LIMIT ".$offset.",".$limit;
//echo $queryStr . " " . $whereStr." ".$OrderStr;die;
		$query = $this->db->query($queryStr . " " . $whereStr." ".$OrderStr);

		return $query->result_array();
	}
    
           public function getdesignerDesignConcept($portfolio_id)
    {
        $customerid=0;
        if(isset($_SESSION["customerId"]))
        $customerid = $_SESSION["customerId"];
         

      $queryStr = "Select distinct t5.designer_name,t5.designer_logo,t1.design_id,t1.design_name,t1.design_display_name, t1.design_price,t1.design_img,
        t1.design_ranking, t1.design_designer,t1.`status`,t3.`status`,t1.on_date,t1.design_specf, t1.design_des,t1.design_type,
		  GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images
		  from jb080_master_design_details t1
		  Left outer join jb080_mapp_master_design_details_design_theme t2
		  ON t1.design_id = t2.master_design_id
		  Left outer JOIN jb080_field_design_theme_master t3
		  ON t2.field_design_theme_id = t3.id
		  left join jb080_master_design_details_images t4 on t1.design_id = t4.design_id
                  inner join jb080_master_designer t5 on t1.design_designer = t5.id

";
		  
		     $whereStr = "where t1.status = '1'";
		if (!empty($portfolio_id))
		{
                        $whereStr = $whereStr . " and " . " t1.design_id = '" . $portfolio_id . "'";
		}
		$whereStr = $whereStr . " group by t1.design_id ";
		$OrderStr = " ";
		//$OrderStr = " LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		
        //echo "designer portfolio----->   		".$queryStr . " " . $whereStr." ".$OrderStr;

		$query = $this->db->query($queryStr . " " . $whereStr." ".$OrderStr);

		return $query->result_array();
	}
          public function getOtherDesignConcept($portfolio_id,$designer_id,$offset,$limit)
    {
               

        $queryStr = "Select distinct t1.design_id,t1.design_name,t1.design_display_name, t1.design_price,t1.design_img,
        t1.design_ranking, t1.design_designer,t1.`status`,t3.`status`,t1.on_date,t1.design_specf, t1.design_des,t1.design_type,
		   GROUP_CONCAT(t4.img SEPARATOR ',') secondary_images ,t5.designer_name
		  from jb080_master_design_details t1
		  Left outer join jb080_mapp_master_design_details_design_theme t2
		  ON t1.design_id = t2.master_design_id
		  Left outer JOIN jb080_field_design_theme_master t3
		  ON t2.field_design_theme_id = t3.id
		  left join jb080_master_design_details_images t4 on t1.design_id = t4.design_id
                  inner join jb080_master_designer t5 on t1.design_designer = t5.id
		  ";
        $whereStr = "where t1.status = '1'";
                       
             
                $whereStr = $whereStr . " and " . " t1.design_id != '" . $portfolio_id . "' AND `t1`.`design_designer`=".$designer_id;

		$whereStr = $whereStr . " group by t1.design_id ";
		$OrderStr = " ";
		$OrderStr = " LIMIT ".$offset.",".$limit;
               // echo $queryStr . " " . $whereStr. " " . $OrderStr;die;
        $query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);

        return $query->result_array();
    }
 
     
}

?>
