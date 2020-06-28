<?php

/*[
Date:: 07-09-2017
Purpose of this Model ::
- Conatining the database queries to filter the product listing by brandwise, categorywise or sectionwise.
]*/

class Md_generic_listing extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
     public function productList($arrSubCatIds="",$offset,$limit,$brand_id="",$soh_id="",$cor="")
	{
         
        $this->db->select('`t1`.`product_id`,`t1`.`product_name`,`t1`.`product_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        if(!empty($arrSubCatIds)){
        $this->db->where_in('`t2`.`category_id`',$arrSubCatIds);
        }
        if(!empty($soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where_in('`t3`.`field_design_type_id`',$soh_id);
        }
        
        if(!empty($brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        }
        if(!empty($cor)){
        $this->db->where_in('`t1`.`origin_country`',$cor);
        }
        $this->db->where('`t1`.`status`','1');
        $this->db->limit($limit,$offset);
        $this->db->group_by('`t1`.`product_id`');
        $this->db->order_by('product_ranking DESC');
        $query = $this->db->get();
        
        return $query->result_array();
	}
        
         public function productTotalCount($arrSubCatIds="",$brand_id="",$soh_id="",$cor="")
	{
            $this->db->select('COUNT(`t1`.`product_id`) AS `totalCount`');
            $this->db->from('ecom_products AS `t1`');
            if(!empty($arrSubCatIds)){
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where_in('`t2`.`category_id`',$arrSubCatIds);
            }
            if(!empty($soh_id)){
            $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
            $this->db->where_in('`t3`.`field_design_type_id`',$soh_id);
            }
            if(!empty($brand_id)){
            $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
            }
            if(!empty($cor)){
            $this->db->where_in('`t1`.`origin_country`',$cor);
            }
            $this->db->where('`t1`.`status`','1');
			$this->db->group_by('`t1`.`product_id`');
            $this->db->order_by('product_ranking DESC');
            $query = $this->db->get();
            return $query->result_array();
	}
        
         public function productCountByBrand($brand_id,$cat_id)
	{
             
           
            
            $array_cor = array();
            if(!empty($_GET['origin'])){
            $cor = $_GET['origin'];
            $array_cor = explode(',',$cor);
            }
             
            $array_soh_id = array();
            if(!empty($_GET['sohID'])){
            $soh_id = $_GET['sohID'];
            $array_soh_id = explode(',',$soh_id);
            }
            
            
            $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
            $this->db->from('ecom_products AS `t1`');
            
            if(!empty($cat_id)){
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where_in('`t2`.`category_id`',$cat_id);
            }
            
            if(!empty($array_soh_id)){
            $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
            $this->db->where_in('`t3`.`field_design_type_id`',$array_soh_id);
            }
            
            if(!empty($array_cor)){
            $this->db->where_in('`t1`.`origin_country`',$array_cor);
            }
        
            $this->db->where('`t1`.`product_brand_id`',$brand_id);
            $this->db->where('`t1`.`status`','1');
            $this->db->order_by('product_ranking DESC');
            $query = $this->db->get();
            return $query->result_array();
	}
        
        public function productCountBySoh($soh_id,$cat_id)
	{ 
            $array_brand_id =array();
            if(!empty($_GET['brandID'])){               
            $brand_id = $_GET['brandID'];
            $array_brand_id = explode(',',$brand_id);
            }
            
            $array_cor = array();
            if(!empty($_GET['origin'])){
            $cor = $_GET['origin'];
            $array_cor = explode(',',$cor);
            }
             
           
            
            $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
            $this->db->from('ecom_products AS `t1`');
            if(!empty($cat_id)){
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where_in('`t2`.`category_id`',$cat_id);
            }
            $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
            
            if(!empty($array_brand_id)){
            $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
            }
            if(!empty($array_cor)){
            $this->db->where_in('`t1`.`origin_country`',$array_cor);
            }
            
            $this->db->where('`t3`.`field_design_type_id`',$soh_id);
            $this->db->where('`t1`.`status`','1');
            $query = $this->db->get();
            return $query->result_array();
	}
        
        public function productCountByCor($cor,$cat_id)
	{
           
             
            $array_soh_id = array();
            if(!empty($_GET['sohID'])){
            $soh_id = $_GET['sohID'];
            $array_soh_id = explode(',',$soh_id);
            }
            $array_brand_id =array();
            if(!empty($_GET['brandID'])){
            $brand_id = $_GET['brandID'];
            $array_brand_id = explode(',',$brand_id);
            }
            
            $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
            $this->db->from('ecom_products AS `t1`');
            if(!empty($cat_id)){
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where_in('`t2`.`category_id`',$cat_id);
            }
            if(!empty($array_brand_id)){
            $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
            }
            if(!empty($array_soh_id)){
            $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
            $this->db->where_in('`t3`.`field_design_type_id`',$array_soh_id);
            }
            $this->db->where('`t1`.`origin_country`',$cor);
            $this->db->where('`t1`.`status`','1');
            $query = $this->db->get();
            return $query->result_array();
	}
         public function getProductCatgListParentwise($parentid)
	{
                $queryStr = " SELECT * FROM `jb080_ecom_category` WHERE `parent` IN (" . $parentid.") AND `cat_status`= '1'" ; 
                $OrderStr = " Order By cat_name ";
		$query = $this->db->query($queryStr . " " . $OrderStr);
		return $query->result();
	}

        
   
        public function getCatDetails($cat_id)
	{
                //print_r($cat_id);die;
              
                $queryStr = " SELECT * FROM `jb080_ecom_category` WHERE `cat_id` IN (" .$cat_id.") AND `cat_status`= '1'" ; 
                $OrderStr = " Order By `cat_name` ASC";		
		$query = $this->db->query($queryStr . " " . $OrderStr);
		return $query->result_array();
	}
//        public function getCatDetails_1($cat_id)
//	{
//                //print_r($cat_id);die;
//              
//                $queryStr = " SELECT * FROM `jb080_ecom_category` WHERE `cat_id` =" .$cat_id." AND `cat_status`= '1'" ; 
//                $OrderStr = " Order By `cat_name` ASC";		
//		$query = $this->db->query($queryStr . " " . $OrderStr);
//		return $query->result_array();
//	}
        public function getSohDetails($soh_id)
	{
        $this->db->select('*');
        $this->db->from('field_design_section_of_house'); 
        $this->db->where('`id`',$soh_id);  
        $this->db->where('`status`','1');  
        $query = $this->db->get();
        return $query->result_array();       
   
	}

   
    public function getCatList($cat_id){
        $this->db->select('cat_id, cat_name,cat_image');
        $this->db->from('ecom_category'); 
        $this->db->where('`cat_status`','1');  
        $this->db->where('`parent`',$cat_id);  
        $this->db->order_by('`cat_ranking`','DESC');
        $query = $this->db->get();
        return $query->result_array();       
   }
    public function getCatListBybrand($cat_id,$brand_id){
        $this->db->select('`t3`.`cat_id`,`t3`.`cat_name`,`t3`.`cat_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('ecom_category AS `t3`','`t2`.`category_id` = `t3`.`cat_id`');
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        $this->db->where_in('`t3`.`cat_id`',$cat_id);
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t3`.`cat_status`','1');
        $this->db->group_by('`t3`.`cat_id`');
        $query = $this->db->get();
        return $query->result_array();       
   }
   
  
   
      public function getSiblingCatListBybrand($parent_cat_id,$brand_id){
        $this->db->select('`t3`.`cat_id`,`t3`.`cat_name`,`t3`.`cat_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('ecom_category AS `t3`','`t2`.`category_id` = `t3`.`cat_id`');
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        $this->db->where_in('`t3`.`parent`',$parent_cat_id);
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t3`.`cat_status`','1');
        $this->db->group_by('`t3`.`cat_id`');
        $this->db->order_by('`t3`.`cat_ranking`','DESC'); 
        $query = $this->db->get();
        return $query->result_array();       
   }
    
    public function getParentCatDetailsBySubCat($cat_id){
        $this->db->select('`parent`,`cat_name`');
        $this->db->from('ecom_category'); 
        $this->db->where('`cat_status`','1');  
        $this->db->where('`cat_id`',$cat_id);  
        $this->db->order_by('`cat_ranking`','DESC');    
        $query = $this->db->get();
        return $query->result_array();       
   }
   
    public function getParentCatDetails($parent_id){
        $this->db->select('`cat_id`,`cat_name`,`cat_image`');
        $this->db->from('ecom_category'); 
        $this->db->where('`cat_status`','1');  
        $this->db->where('`cat_id`',$parent_id);  
        $this->db->order_by('`cat_ranking`','DESC');
        $query = $this->db->get();
        return $query->result_array();       
   }
    public function getSiblingCatList($parent_cat_id,$cat_id){
        $this->db->select('`cat_id`, `cat_name`,`cat_image`');
        $this->db->from('ecom_category'); 
        $this->db->where('`cat_status`','1');  
        $this->db->where('`parent`',$parent_cat_id);  
       // $this->db->where('cat_id !=',$cat_id);  
        $this->db->order_by('`cat_ranking`','DESC');    
        $query = $this->db->get();
        return $query->result_array();       
   }
   
//        public function get_brand_list()
//	{
//         
//        $this->db->select('`t2`.`brand_id`,`t2`.`brand_name`');
//        $this->db->from('ecom_products AS `t1`');
//        $this->db->join('jb080_ecom_brand AS `t2`','`t1`.`product_brand_id` = `t2`.`brand_id`');
//        $this->db->where('`t2`.`status`','1');   
//        $this->db->order_by('`t2`.brand_name');
//        $this->db->group_by('`t2`.brand_id');
//        $query = $this->db->get();
//        return $query->result_array();
//	}
        public function get_brand_list($cat_id="",$array_soh_id="",$array_cor="")
	{
         
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`,`t2`.`brand_id`,`t2`.`brand_name`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('jb080_ecom_brand AS `t2`','`t1`.`product_brand_id` = `t2`.`brand_id`');
        
        if(!empty($cat_id)){
        $this->db->join('ecom_product_mapp_category AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`category_id`',$cat_id);
        }

        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where_in('`t3`.`field_design_type_id`',$array_soh_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
            
        $this->db->where('`t1`.`status`','1');   
        $this->db->where('`t2`.`status`','1');   
        $this->db->order_by('`t2`.brand_name');
        $this->db->group_by('`t2`.brand_id');
        $query = $this->db->get();
        return $query->result_array();
	}
        
//        public function get_section_list(){
//        $this->db->select('`id`,`title`');
//        $this->db->from('field_design_section_of_house'); 
//        $this->db->where('`status`','1');  
//        $this->db->order_by('`rank`','DESC');
//        $query = $this->db->get();
//        return $query->result_array();       
//   }

        public function get_section_list($cat_id="",$array_brand_id="",$array_cor=""){
            
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`,`t3`.`id`,`t3`.`title`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_design_type AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('field_design_section_of_house AS `t3`','`t2`.`field_design_type_id` = `t3`.`id`');
        
        if(!empty($cat_id)){
        $this->db->join('ecom_product_mapp_category AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`category_id`',$cat_id);
        }
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_cor)){
        $this->db->where_in('`t1`.`origin_country`',$array_cor);
        }
        
        $this->db->where('`t1`.`status`','1');   
           
        $this->db->order_by('`t3`.`title`');
        $this->db->group_by('`t3`.`id`');
        $query = $this->db->get();
        return $query->result_array();      
   }
    
//    public function get_country_list(){
//        $this->db->select('`idCountry`,`countryName`');
//        $this->db->from('jb080_countries'); 
//        $this->db->where('`status`','1');  
//        $this->db->order_by('`countryName`');
//        $query = $this->db->get();
//        return $query->result_array();       
//   }
    public function get_country_list($cat_id="",$array_brand_id="",$array_soh_id=""){
        
        $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`,`t2`.`idCountry`,`t2`.`countryName`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('countries AS `t2`','`t1`.`origin_country` = `t2`.`countryName`');
        
        if(!empty($cat_id)){
        $this->db->join('ecom_product_mapp_category AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->where_in('`t3`.`category_id`',$cat_id);
        }
        
        if(!empty($array_brand_id)){
        $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
        }
        
        if(!empty($array_soh_id)){
        $this->db->join('ecom_product_mapp_design_type AS `t4`','`t1`.`product_id` = `t4`.`product_id`');
        $this->db->where_in('`t4`.`field_design_type_id`',$array_soh_id);
        }
        
       
        
//        $this->db->where('`t2`.`status`','1');   
        $this->db->where('`t1`.`status`','1');   
        $this->db->group_by('`t2`.`idCountry`');
        $query = $this->db->get();
        return $query->result_array();  
        
   }
   
        
      public function get_brand_details($brand_id)
	{
        
        $this->db->select('*');
        $this->db->from('ecom_brand');
        $this->db->where('`status`','1');   
        $this->db->where_in('brand_id`',$brand_id);   
       //$this->db->order_by('`brand_name`');
        $this->db->group_by('`brand_id`');
        $query = $this->db->get();
        return $query->result_array();
	}
        
      public function get_soh_details($soh_id){
        $this->db->select('*');
        $this->db->from('field_design_section_of_house'); 
        $this->db->where_in('id',$soh_id);  
        $this->db->where('`status`','1');  
      //  $this->db->order_by('`rank`','DESC');
        $query = $this->db->get();
        return $query->result_array();       
   }
   
   public function get_cor_details($cor_id){
        $this->db->select('`idCountry`,`countryName`');
        $this->db->from('jb080_countries'); 
        $this->db->where_in('`countryName`',$cor_id);  
        $this->db->where('`status`','1');  
       // $this->db->order_by('`countryName`');
        $query = $this->db->get();
        return $query->result_array();       
   }
   public function getLevelOneCategoriesName() {
       $queryStr = " SELECT * FROM `jb080_ecom_category` WHERE `parent` = '0'  AND `cat_status`= '1'" ; 
        $OrderStr = " Order By `cat_name` ";		
        $query = $this->db->query($queryStr . " " . $OrderStr);
        return $query->result_array();
       
   }
   
   public function getAllActiveCategoriesId() {
       $queryStr = " SELECT `cat_id` FROM `jb080_ecom_category` WHERE `cat_status`= '1'" ; 
        $OrderStr = " Order By `cat_name` ";		
        $query = $this->db->query($queryStr . " " . $OrderStr);
        return $query->result_array();
   }
   
   
    public function cat_list_by_soh($soh_id)
	{
         
        $this->db->select('`t4`.`cat_id`,`t4`.`cat_name`,`t4`.`cat_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
        $this->db->join('ecom_category AS `t4`','`t2`.`category_id` = `t4`.`cat_id`');
        $this->db->where_in('`t3`.`field_design_type_id`',$soh_id);       
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t4`.`cat_status`','1');
        $this->db->group_by('`t4`.`cat_id`');
        $query = $this->db->get();
        return $query->result_array();
	}
        
      
        
          public function parent_cat_list($cat_list)
	{
         
        $this->db->select('`t1`.`parent` AS `cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
       // $this->db->select('`t1`.`parent`,`t1`.`cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
        $this->db->from('ecom_category AS `t1`');
        $this->db->where_in('`t1`.`cat_id`',$cat_list);       
        $this->db->where('`t1`.`cat_status`','1');
        $this->db->group_by('`t1`.`parent`');
        $query = $this->db->get();
        return $query->result_array();
	}
        
        
         public function parent_cat_list_1($cat_list)
	{
         
        $this->db->select('`t2`.`cat_id`,`t2`.`cat_name`,`t2`.`cat_image`');
       // $this->db->select('`t1`.`parent`,`t1`.`cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
        $this->db->from('ecom_category AS `t1`');
        $this->db->join('ecom_category AS `t2`','`t1`.`parent`=`t2`.`cat_id`');
        $this->db->where_in('`t1`.`cat_id`',$cat_list);       
        $this->db->where('`t1`.`cat_status`','1');
        $this->db->group_by('`t1`.`parent`');
        $query = $this->db->get();
        return $query->result_array();
	}
        
        public function cat_list_by_brand($brand_id)
	{
         
        $this->db->select('`t3`.`cat_id`,`t3`.`cat_name`,`t3`.`cat_image`');
        $this->db->from('ecom_products AS `t1`');
        $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
        $this->db->join('ecom_category AS `t3`','`t2`.`category_id` = `t3`.`cat_id`');
        $this->db->where_in('`t1`.`product_brand_id`',$brand_id);
        $this->db->where('`t1`.`status`','1');
        $this->db->where('`t3`.`cat_status`','1');
        $this->db->group_by('`t3`.`cat_id`');
        $query = $this->db->get();
        return $query->result_array();
	}
        
         public function check_parent_cat_or_not($cat_id)
	{
         
        //$this->db->select('`t1`.`parent` AS `cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
        $this->db->select('`t1`.`cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
        $this->db->from('ecom_category AS `t1`');
        $this->db->where('`t1`.`cat_id`',$cat_id);       
        $this->db->where('`t1`.`parent`','0');       
        $this->db->where('`t1`.`cat_status`','1');      
        $query = $this->db->get();
        return $query->result_array();
	}
         public function get_child_cat($cat_id)
	{
         
        $this->db->select('`t1`.`cat_id`,`t1`.`cat_name`,`t1`.`cat_image`');
        $this->db->from('ecom_category AS `t1`');
        $this->db->where('`t1`.`parent`',$cat_id);       
        $this->db->where('`t1`.`cat_status`','1');      
        $query = $this->db->get();
        return $query->result_array();
	}
        
        /* Code by someshwar ji*/
        
          public function productCountBySohFilterCatBrandCor($soh_id,$cat_id,$brand_id,$origin)
	{ 
            $array_brand_id =array();
            if(!empty($brand_id)){
           
            // $array_brand_id = explode(',',$brand_id);
            }
            
            $array_cor = array();
            if(!empty($origin)){
            //    $array_cor = explode(',',$origin);
            }
             
                      
            $this->db->select('COUNT(`t1`.`product_id`) AS `ProductCount`');
            $this->db->from('ecom_products AS `t1`');
            if(!empty($cat_id)){
                
            $this->db->join('ecom_product_mapp_category AS `t2`','`t1`.`product_id` = `t2`.`product_id`');
            $this->db->where_in('`t2`.`category_id`',$cat_id);
            }
            $this->db->join('ecom_product_mapp_design_type AS `t3`','`t1`.`product_id` = `t3`.`product_id`');
            
            if(!empty($array_brand_id)){
            $this->db->where_in('`t1`.`product_brand_id`',$array_brand_id);
            }
            if(!empty($array_cor)){
            $this->db->where_in('`t1`.`origin_country`',$array_cor);
            }
            
            $this->db->where('`t3`.`field_design_type_id`',$soh_id);
            $this->db->where('`t1`.`status`','1');
            $query = $this->db->get();
            return $query->result_array();
	}
         public function getProductsByBrandid($brandID){
             $this->db->select('`t1`.`product_id`');
            $this->db->from('ecom_products AS `t1`');
            
            $this->db->where_in('`t1`.`product_brand_id`',$brandID);
              $query = $this->db->get();
            return $query->result_array();
         }
         public function getSOHdetailsByProductIDstr($productIDstr){
             $this->db->select('`t2`.`id` AS `soh_id`,`t2`.`title` AS `soh_title`');
            $this->db->from('ecom_product_mapp_design_type AS `t1`');
            $this->db->join('field_design_section_of_house AS `t2`','`t1`.`field_design_type_id` = `t2`.`id`');
           
            $this->db->where_in('`t1`.`product_id`',$productIDstr);
            $this->db->where('`t2`.`status`','1');
            $this->db->group_by('`t2`.`id`');
            
              $query = $this->db->get();
            return $query->result_array();
         }
         public function getProductCountFromSOHId($soh_id){
             $this->db->select('COUNT(`t1`.`product_id`) AS `soh_product_cnt`');
            $this->db->from('ecom_product_mapp_design_type AS `t1`');
           
            $this->db->where('`t1`.`field_design_type_id`',$soh_id);
            
              $query = $this->db->get();
            return $query->result_array();
         }
         
         public function getAllProducts() {
              $this->db->select('`t1`.`product_id`');
            $this->db->from('ecom_products AS `t1`');
            
              $query = $this->db->get();
            return $query->result_array();
         }
         
         
        
        
}

?>
