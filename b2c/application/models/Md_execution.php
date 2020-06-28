<?php

class Md_execution extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  	public function getsampleExecutionPortfolio($execution_flag)
	{
	    $customerid=0;
            if(isset($_SESSION["customerId"]))
            $customerid = $_SESSION["customerId"];   

		$queryStr = "SELECT t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t2.designer_name,t1.master_image,t1.ranking,t1.`status`,
	
		IFNULL(t11.itemcount, 0) itemcount, t12.favorites_record_id selectedId,
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
        left outer join	(select count(1) itemcount, favorites_record_id from jb080_customer_favorites_list
		WHERE favorites_type = 'executionportfolio' group by favorites_type,favorites_record_id )
		t11 on t1.id = t11.favorites_record_id
		left outer join
		(Select favorites_record_id from jb080_customer_favorites_list
		where favorites_type = 'executionportfolio' and customer_id = ".$customerid.") t12
		on t1.id = t12.favorites_record_id ";
		$whereStr = "WHERE t1.`status` = 'active'";
               
		//$whereStr.= " group by t1.id";
		
		if($execution_flag == "all")
		{
			$whereStr.= " group by t1.id";
		}
		else
		{
			$whereStr.= " and t1.".$execution_flag." = '1'  group by t1.id";
		}
		//$whereStr.= 
		$OrderStr =  " Order by t1.ranking ";
		//$OrderStr =  "Order by t1.ranking desc LIMIT ".$_SESSION['recordFrom'].",".$_SESSION['recordTo'];
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
	
	
	} 
        
     public function getExecutionSamplePortfolio($flag,$offset,$limit){

         //echo $flag;die;
	$queryStr = "SELECT t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t2.designer_name,t1.master_image,t1.ranking,t1.`status`,
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id
        ";
        
        $whereStr = "WHERE t1.`status` = 'active'";
          
	$whereStr.= " and t1.".$flag." = '1'  group by t1.id";
		
		
		$OrderStr =  "Order by t1.ranking desc LIMIT ".$offset.",".$limit;
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();      
   }
        
        
   
   
    public function getAllExecutionPortfolio($offset,$limit){
          

$queryStr = "SELECT t1.id,t1.portfolio_name,t1.executioner,t1.designer_id,t2.designer_name,t1.master_image,t1.ranking,t1.`status`,		
		GROUP_CONCAT(t3.img SEPARATOR ',') secondary_images
        from jb080_execution_portfo t1
        inner join jb080_master_designer t2 on t1.designer_id = t2.id
		left join jb080_seller_details t4 on t1.executioner = t4.seller_id
        left join jb080_execution_portfolio_images t3 on t1.id = t3.executioner_id ";
		$whereStr = "WHERE t1.`status` = 'active'";
		
		
		$whereStr.= " group by t1.id";
		
		//$whereStr.= 
		$OrderStr =  "Order by t1.ranking desc LIMIT ".$offset.",".$limit;
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
         
             
   }
   
   
   public function getAllExecutionPortfolioCount(){
          

    $queryStr = "SELECT count(t1.id) as count   from jb080_execution_portfo t1";
		$whereStr = "WHERE t1.`status` = 'active'";		
		$OrderStr =  "Order by t1.ranking desc ";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
		return $query->result_array();
             
   }
   
    public function getExecutionPortfolioCount($flag){
          

    $queryStr = "SELECT count(t1.id) as count   from jb080_execution_portfo t1";
		$whereStr = "WHERE t1.`status` = 'active'";		
		$OrderStr =  "AND t1.".$flag." = '1'";
		//echo $queryStr . " " . $whereStr. " " . $OrderStr;
		$query = $this->db->query($queryStr . " " . $whereStr. " " . $OrderStr);
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
   public function getOtherPortfolio($portfolio_id)
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
                        $whereStr = $whereStr . " and " . " t1.id != '" . $portfolio_id . "'";
		}
		$whereStr = $whereStr . " group by t1.id ";
		$OrderStr = " ";
		//$OrderStr = " LIMIT ".$_SESSION["recordFrom"].",".$_SESSION["recordTo"];
		
        //echo "designer portfolio----->   		".$queryStr . " " . $whereStr." ".$OrderStr;

		$query = $this->db->query($queryStr . " " . $whereStr." ".$OrderStr);

		return $query->result_array();
	}

}

?>
