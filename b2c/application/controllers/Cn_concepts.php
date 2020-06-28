<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_concepts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                //$this->load->model('Md_customer');
                $this->load->model('Md_database');
                //$this->load->model('Md_boqbuilder');
                $this->load->model('Md_concepts');
                $this->session_management_lib->index();
	}

	public function index($orderId,$userType,$userAccountId,$clientType,$clientAccountId,$concptSohTitle='all',$concptSohId='0')
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('client','agent'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
		    //if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}

		/*PageSEO-ContentData:*/  
        $data['page_title'] = "Design Concepts - Top International Interior Design for Home & Office in Delhi and Bangalore";
        $data['page_name'] = 'Design Concepts';  
        $data['leadGenFromSliderPageType'] ='concepts'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "Design Concepts";
        $data['meta_keywords'] =  "Design Concepts"; 
		
		//varDefine:
		$data['orderId'] = $orderId;
		$data['userType'] = $userType;
		$data['userAccountId'] = $userAccountId;
		$data['clientType'] = $clientType;
		$data['clientAccountId'] = $clientAccountId;
		$data['concptSohTitle'] = urldecode($concptSohTitle);
		$data['concptSohId'] = $concptSohId;
 		$data['concptParam'] = json_encode(array('orderId'=>$orderId,'userType'=>$userType,'userAccountId'=>$userAccountId,'clientType'=>$clientType,'clientAccountId'=>$clientAccountId,'concptSohTitle'=>$data['concptSohTitle'],'concptSohId'=>$data['concptSohId']));
		
		//echo "<pre>"; print_r($data); echo "</pre>"; die;
		
		/*sql::get order details:
		$rsLeadProjectDtls = ''; 
		$queryStr = '';
		$queryStr = "SELECT `o_id`, `flag_lob` FROM  `jb080_order_dtl` WHERE `o_id`='".$orderId."' ";
		$rsLeadProjectDtls = $this->Md_concepts->selectData($queryStr);*/	
		
		//sql::get design section of house nav.bar list:
		$data['rsArrDsgnSohNavBarList'] = $this->Md_concepts->getDesignSohNavBarList();	 
		
		//sql::get design gallery list:
		$postSOHId = 'All';
		$searchKeyword = '';
		$data['offset'] = 0;
		$data['limit'] = 30; 
		//
		$queryStr = '';
		$queryStr = 'SELECT  `T1`.`galleryimg_id`, `T1`.`imgFilename`,`T3`.`flag_like_or_dislike`, `T3`.`comment` AS `customer_comment`
				   FROM `jb080_galleryimgs_details` AS `T1`
				   LEFT JOIN `jb080_galleryimgs_details_mapp_design_soh` AS `T2` 
				   ON `T1`.`galleryimg_id` = `T2`.`galleryimg_id` 
				   LEFT JOIN `jb080_customer_design_wall` AS `T3` 
				   ON `T1`.`galleryimg_id` = `T3`.`galleryimg_id` AND `T3`.`customer_id`="'.$data['clientAccountId'].'"
				   WHERE `T1`.`status`="active" AND `T1`.`imgTagToDesign`="true"';
				   if($data['concptSohTitle']!='all'){ $queryStr.= ' AND `T2`.`soh_id`='.$data['concptSohId'].' '; }
				   if($searchKeyword){
				   $queryStr.=' AND (`T1`.`galleryimg_id` IN ("'.  implode('","', $searchFinalArray).'") OR `T1`.`gallery_description` LIKE "%'.$searchKeyword.'%")';
				   }
		$queryStr.= ' GROUP BY `T1`.`galleryimg_id` ORDER BY `T1`.`gallery_rank` DESC, `T1`.`popularity_score` DESC, `T1`.`galleryimg_id` DESC
					  LIMIT '.$data['offset'].','.$data['limit'].'';
		$data['rsArrDsgnGalleryList'] = $this->Md_concepts->selectData($queryStr); 
		
		//echo "<pre>--"; print_r($rsArrDsgnGalleryList); "</pre>"; die;
		
		$this->load->view('concepts/vw_concepts_list',$data);
			 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	}
	
	public function conceptsAjaxList()
	{
		 //var:define:
		 //echo "<pre>"; print_r($_POST); echo "</pre>"; 
	 	 $concptParam  = $_POST['concptParam'];
	 	 $concptOffset = $_POST['concptOffset'];
		 
		 //if:
		 if($concptParam){
			$concptParam   = json_decode($concptParam,True); 
			//echo "<pre>"; print_r($concptParam); echo "</pre>"; die;
			$orderId 	   = $concptParam['orderId']; //=> 13
			$userType      = $concptParam['userType']; //=> agent
			$userAccountId = $concptParam['userAccountId']; //=> 1
			$clientType    = $concptParam['clientType']; //=> client
			$clientAccountId = $concptParam['clientAccountId']; //=> 142
			$concptSohTitle  = $concptParam['concptSohTitle']; //=> all
			$concptSohId     = $concptParam['concptSohId']; //=> all
		 }
			
		//sql::get design gallery list:
		$postSOHId = 'All';
		$searchKeyword = '';
		$offset = $concptOffset;
		$limit  = 10; 
		//
		$queryStr = '';
		$queryStr = 'SELECT  `T1`.`galleryimg_id`, `T1`.`imgFilename`,`T3`.`flag_like_or_dislike`, `T3`.`comment` AS `customer_comment`
				   FROM `jb080_galleryimgs_details` AS `T1`
				   LEFT JOIN `jb080_galleryimgs_details_mapp_design_soh` AS `T2` 
				   ON `T1`.`galleryimg_id` = `T2`.`galleryimg_id` 
				   LEFT JOIN `jb080_customer_design_wall` AS `T3` 
				   ON `T1`.`galleryimg_id` = `T3`.`galleryimg_id` AND `T3`.`customer_id`="'.$clientAccountId.'"
				   WHERE `T1`.`status`="active" AND `T1`.`imgTagToDesign`="true"';
				   if($concptSohTitle!='all'){ $queryStr.= ' AND `T2`.`soh_id`='.$concptSohId.' '; }
				   if($searchKeyword){
				   $queryStr.=' AND (`T1`.`galleryimg_id` IN ("'.  implode('","', $searchFinalArray).'") OR `T1`.`gallery_description` LIKE "%'.$searchKeyword.'%")';
				   }
		$queryStr.= ' GROUP BY `T1`.`galleryimg_id` ORDER BY `T1`.`gallery_rank` DESC, `T1`.`popularity_score` DESC, `T1`.`galleryimg_id` DESC
					  LIMIT '.$offset.','.$limit.'';
		$rsArrDsgnGalleryList = $this->Md_concepts->selectData($queryStr); 
		//echo "<pre>"; print_r($rsArrDsgnGalleryList); echo "</pre>"; 
		  
		  $galleryList = '';	
		  foreach($rsArrDsgnGalleryList as $key=>$galleryData){ 
                      $url = base_url().'conceptDesign/'.$orderId.'/'.$userType.'/'.$userAccountId.'/'.$clientType.'/'.$clientAccountId.'/'.urlencode($concptSohTitle).'/'.$concptSohId.'/offset/'.($key+$offset);
				$galleryList.='<li><a href="'.$url.'"><img src="'.image_url.'media/images/gallery/1500THUMB/'.$galleryData['imgFilename'].'"></a></li>';
		  }
		 echo $galleryList;
		 echo '|*|*|';
		 echo $offset+$limit;
		 die;
	}//end:fun:class;
	
	
	public function conceptDesign($orderId,$userType,$userAccountId,$clientType,$clientAccountId,$concptSohTitle,$concptSohId,$offset,$currentOffset)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('client','agent'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
		    //if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}

		/*PageSEO-ContentData:*/  
        $data['page_title'] = "Design Concepts - Top International Interior Design for Home & Office in Delhi and Bangalore";
        $data['page_name'] = 'Design Concepts';  
        $data['leadGenFromSliderPageType'] ='concepts'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "Design Concepts";
        $data['meta_keywords'] =  "Design Concepts"; 
//		echo $currentOffset;die;
		//varDefine:
		$data['orderId'] = $orderId;
		$data['userType'] = $userType;
		$data['userAccountId'] = $userAccountId;
		$data['clientType'] = $clientType;
		$data['clientAccountId'] = $clientAccountId;
		$data['concptSohTitle'] = urldecode($concptSohTitle);
		$data['concptSohId'] = $concptSohId;
//		$data['concptTyp'] = $concptTyp;
//		$data['concptDesignId'] = $concptDesignId;
 		$data['concptParam'] = json_encode(array('orderId'=>$orderId,'userType'=>$userType,'userAccountId'=>$userAccountId,'clientType'=>$clientType,'clientAccountId'=>$clientAccountId,'concptSohTitle'=>$data['concptSohTitle'],'concptSohId'=>$data['concptSohId']));
		
//                $previousOffset = $currentOffset - 1;
//                $nextOffset = $currentOffset + 1;
		//echo "<pre>"; print_r($data['concptParam']); echo "</pre>"; die;
		
		/*sql::get order details:
		$rsLeadProjectDtls = ''; 
		$queryStr = '';
		$queryStr = "SELECT `o_id`, `flag_lob` FROM  `jb080_order_dtl` WHERE `o_id`='".$orderId."' ";
		$rsLeadProjectDtls = $this->Md_concepts->selectData($queryStr);*/	
		
		//sql::get design gallery list:
		$searchKeyword = '';
		$data['currentOffset'] = $currentOffset;
		$data['limit'] = 10; 
		//
		$queryStr = '';
		$queryStr = 'SELECT SQL_CALC_FOUND_ROWS `T1`.`galleryimg_id`, `T1`.`imgFilename`,`T3`.`flag_like_or_dislike`, `T3`.`comment` AS `customer_comment`
				   FROM `jb080_galleryimgs_details` AS `T1`
				   LEFT JOIN `jb080_galleryimgs_details_mapp_design_soh` AS `T2` 
				   ON `T1`.`galleryimg_id` = `T2`.`galleryimg_id` 
				   LEFT JOIN `jb080_customer_design_wall` AS `T3` 
				   ON `T1`.`galleryimg_id` = `T3`.`galleryimg_id` AND `T3`.`customer_id`="'.$data['clientAccountId'].'"
				   WHERE  `T1`.`status`="active" AND `T1`.`imgTagToDesign`="true"';
				   if($data['concptSohTitle']!='all'){ $queryStr.= ' AND `T2`.`soh_id`='.$data['concptSohId'].' '; }
				   if($searchKeyword){
				   $queryStr.=' AND (`T1`.`galleryimg_id` IN ("'.  implode('","', $searchFinalArray).'") OR `T1`.`gallery_description` LIKE "%'.$searchKeyword.'%")';
				   }
		$queryStr.= ' GROUP BY `T1`.`galleryimg_id` ORDER BY `T1`.`gallery_rank` DESC, `T1`.`popularity_score` DESC, `T1`.`galleryimg_id` DESC
					  LIMIT '.$currentOffset.','.$data['limit'].'';
                $rsDsgnGalleryList = array();
                foreach ($this->Md_concepts->selectData($queryStr) as $row){
                    $rsDsgnGalleryList[$currentOffset++] = $row;
                }
		$data['rsDsgnGalleryList'] = $rsDsgnGalleryList; 
		 
                $sQuery = "";
                $sQuery  = "SELECT FOUND_ROWS() as totalCount";
                $totalRecords = $this->Md_concepts->selectData($sQuery);
                $data['totalCount'] = $totalRecords?$totalRecords[0]['totalCount']:0;
              
		$this->load->view('concepts/vw_concepts_details',$data);
			 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	}
        public function ajaxConceptDesign(){
            
           $concptParam = $_POST['concptParam'];
          
		//varDefine:
		$data['orderId'] = $concptParam['orderId'];
		$data['userType'] = $concptParam['userType'];
		$data['userAccountId'] = $concptParam['userAccountId'];
		$data['clientType'] = $concptParam['clientType'];
		$data['clientAccountId'] = $concptParam['clientAccountId'];
		$data['concptSohTitle'] = urldecode($concptParam['concptSohTitle']);
		$data['concptSohId'] = $concptParam['concptSohId'];
//		$data['concptTyp'] = $concptParam['concptTyp'];
//		$data['concptDesignId'] = $concptParam['concptDesignId'];
 		//$data['concptParam'] = json_encode(array('orderId'=>$orderId,'userType'=>$userType,'userAccountId'=>$userAccountId,'clientType'=>$clientType,'clientAccountId'=>$clientAccountId,'concptSohTitle'=>$data['concptSohTitle'],'concptSohId'=>$data['concptSohId'],'concptTyp'=>$data['concptTyp'],'concptDesignId'=>$data['concptDesignId']));
		
//                $previousOffset = $currentOffset - 1;
//                $nextOffset = $currentOffset + 1;
		//echo "<pre>"; print_r($data['concptParam']); echo "</pre>"; die;
		
		/*sql::get order details:
		$rsLeadProjectDtls = ''; 
		$queryStr = '';
		$queryStr = "SELECT `o_id`, `flag_lob` FROM  `jb080_order_dtl` WHERE `o_id`='".$orderId."' ";
		$rsLeadProjectDtls = $this->Md_concepts->selectData($queryStr);*/	
		
		//sql::get design gallery list:
		$searchKeyword = '';
		$currentOffset = $_POST['currentOffset'];
                $offset = $_POST['currentOffset'];
                $data['limit'] = 10; 
                if($_POST['btnPress']=='previous'){
                    $data['limit'] = 1; 
                }
		
		//
		$queryStr = '';
		$queryStr = 'SELECT  `T1`.`galleryimg_id`, `T1`.`imgFilename`,`T3`.`flag_like_or_dislike`, `T3`.`comment` AS `customer_comment`
				   FROM `jb080_galleryimgs_details` AS `T1`
				   LEFT JOIN `jb080_galleryimgs_details_mapp_design_soh` AS `T2` 
				   ON `T1`.`galleryimg_id` = `T2`.`galleryimg_id` 
				   LEFT JOIN `jb080_customer_design_wall` AS `T3` 
				   ON `T1`.`galleryimg_id` = `T3`.`galleryimg_id` AND `T3`.`customer_id`="'.$data['clientAccountId'].'"
				   WHERE  `T1`.`status`="active" AND `T1`.`imgTagToDesign`="true"';
				   if($data['concptSohTitle']!='all'){ $queryStr.= ' AND `T2`.`soh_id`='.$data['concptSohId'].' '; }
				   if($searchKeyword){
				   $queryStr.=' AND (`T1`.`galleryimg_id` IN ("'.  implode('","', $searchFinalArray).'") OR `T1`.`gallery_description` LIKE "%'.$searchKeyword.'%")';
				   }
		$queryStr.= ' GROUP BY `T1`.`galleryimg_id` ORDER BY `T1`.`gallery_rank` DESC, `T1`.`popularity_score` DESC, `T1`.`galleryimg_id` DESC
					  LIMIT '.$offset.','.$data['limit'].'';
                $rsDsgnGalleryList = array();
                foreach ($this->Md_concepts->selectData($queryStr) as $row){
                    $rsDsgnGalleryList[$offset++] = $row;
                }
		
                 foreach ($rsDsgnGalleryList as $key=>$item){?>
                    <div class="col-md-12 item" id="item<?=$key?>"  style="<?= $currentOffset==$key?'':'display:none'?>" >
                    <img src="<?=image_url.'media/images/gallery/1500THUMB/'.$item['imgFilename']?>" class="img-responsive" style="">
                    <input type="hidden" class="gallery_id" value="<?=$item['galleryimg_id']?>"/>
                    <input type="hidden" class="flag_like_or_dislike" value="<?=$item['flag_like_or_dislike']?>"/>
                    <input type="hidden" class="customer_comment" value="<?=$item['customer_comment']?>"/>
                    </div> 
          <?php } 
          die;
        }
        
        function ajaxUpdateGalleryCustomerAction(){
            $sessionCustomerId = $_POST['sessionCustomerId'];
            $galleryImageId = $_POST['galleryimg_id'];
            $flag_like_or_dislike = $_POST['flag_like_or_dislike'];
            $comment = $_POST['comment'];
            $on_datetime = date('Y-m-d H:i:s');
            $remote_address = $_SERVER['REMOTE_ADDR'];
            $affected_row_count_1 ='';
            $affected_row_count_2 ='';
            if(!empty($sessionCustomerId) && !empty($galleryImageId) && !empty($flag_like_or_dislike)){
                
                  /*Sql::[Start] Get image details*/
            $sql_string = '';
            $sql_string = "SELECT `galleryimg_id`,`no_of_likes`,`no_of_dislikes`  FROM `jb080_galleryimgs_details` WHERE `galleryimg_id`=$galleryImageId";
            $scoreDetails = $this->Md_concepts->selectData($sql_string);
            $totalLikes='';
            $totalDislikes='';
            if(!empty($scoreDetails)){
                $totalLikes = $scoreDetails[0]['no_of_likes'];
                $totalDislikes = $scoreDetails[0]['no_of_dislikes'];
            }
   
    /*Sql::[End] Get image details*/
    
    
                $sql_string = '';
                $sql_string = "SELECT `id`  FROM `jb080_customer_design_wall` WHERE `customer_id`=$sessionCustomerId AND `galleryimg_id`=$galleryImageId";
                $result = $this->Md_concepts->selectData($sql_string);
                
                 if(!empty($result)){
                    /*Sql::[Start] Update record in design wall table*/
                    $sql_string = '';
                    $sql_string = "UPDATE `jb080_customer_design_wall` 
                            SET `flag_like_or_dislike`='$flag_like_or_dislike',`comment`='$comment',
                            `remote_address`='$remote_address',`on_datetime`='$on_datetime'
                            WHERE `customer_id`=$sessionCustomerId AND `galleryimg_id`=$galleryImageId";
                   $affected_row_count_1 = $this->Md_concepts->updateData($sql_string);
                    /*Sql::[End] Update record in design wall table*/
                }else{
                    /*Sql::[Start] insert record in design wall table*/
                   
                    $insertData = [
                        'customer_id'=>$sessionCustomerId,
                        'galleryimg_id'=>$galleryImageId,
                        'flag_like_or_dislike'=>$flag_like_or_dislike,
                        'comment'=>$comment,
                        'remote_address'=>$remote_address,
                        'on_datetime'=>$on_datetime,
                    ];
                   $affected_row_count_2 = $this->Md_concepts->insertData('jb080_customer_design_wall',$insertData);
                    /*Sql::[End] insert record in design wall table*/
                }
                
                if($affected_row_count_1 || $affected_row_count_2){
        
                        if($flag_like_or_dislike=='like'){
                            $totalLikes  = $totalLikes + 1;
                        }
                        if($flag_like_or_dislike=='dislike'){
                            $totalDislikes  = $totalDislikes + 1;
                        }
                        $popularity_score  = ($totalLikes / ($totalLikes + $totalDislikes)); 

                        /*Sql::[Start] Update populatity score*/
                        $sql_string = '';
                        $sql_string = "UPDATE `jb080_galleryimgs_details` 
                                SET `no_of_likes`=$totalLikes,`no_of_dislikes`=$totalDislikes,
                                `popularity_score`=$popularity_score 
                                WHERE  `galleryimg_id`=$galleryImageId";
                        $this->Md_concepts->updateData($sql_string);
                        
                        /*Sql::[End] Update populatity score*/
                        echo 'success';
                    }
    
            }
           die;
        }
	
	
}//end::Class;
?>