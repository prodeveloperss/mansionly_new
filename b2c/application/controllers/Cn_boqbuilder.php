<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_boqbuilder extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
                //$this->load->model('Md_customer');
                $this->load->model('Md_database');
                $this->load->model('Md_boqbuilder');
                $this->session_management_lib->index();
	}

	public function index($orderId,$userType,$userAccountId)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
		    //if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}

		/*PageSEO-ContentData:*/  
        $data['page_title'] = "BOQs - Top International Interior Design for Home & Office in Delhi and Bangalore";
        $data['page_name'] = 'boq-builder';  
        $data['leadGenFromSliderPageType'] ='boq-builder'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "BOQ Builder";
        $data['meta_keywords'] =  "BOQ Builder"; 
		
		//varDefine:
		$data['orderId'] = $orderId;
		$data['userType'] = $userType;
		$data['userAccountId'] = $userAccountId;
						
        /*Get boq build list:*/
        $table = "order_boq_builder_details"; 
        $condition = " `order_id` = '".$orderId."' AND `flagCustomerViewable`='Yes' ";
        $data['boqBuildList'] = $this->Md_database->getData($table,'*',$condition,'`onDateTime` DESC');  
		
		//echo "<pre>"; print_r($data['boqBuildList']); echo "</pre>"; die;
		
		//sql::get order details:
		$rsLeadProjectDtls = ''; 
		$queryStr = '';
		$queryStr = "SELECT `o_id`, `flag_lob` FROM  `jb080_order_dtl` WHERE `o_id`='".$orderId."' ";
		$rsLeadProjectDtls = $this->Md_boqbuilder->selectData($queryStr);	
		
        $this->load->view('boq_builder/vw_boq_builder_list',$data);
			 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	}
	
	public function newBoqBuilderDetails($orderId,$userType,$userAccountId)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
		    //if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}

		/*PageSEO-ContentData:*/  
        $data['page_title'] = "BOQ Questionnaire - Top International Interior Design for Home & Office in Delhi and Bangalore";
        $data['page_name'] = 'boq-builder';  
        $data['leadGenFromSliderPageType'] ='boq-builder'; 
        $data['leadGenFromSliderPageUniqueId'] = '';
        $data['meta_description'] = "BOQ Builder";
        $data['meta_keywords'] =  "BOQ Builder"; 
		
		//varDefine:
		$data['orderId'] = $orderId;
		$data['userType'] = $userType;
		$data['userAccountId'] = $userAccountId;
		
		//array:getBOQSectionHeaderList:
		$data['arrListBOQSectionHeader']  = array();
		$data['arrListBOQSectionHeader'] = $this->Md_boqbuilder->getBOQSectionHeaderList($project_type_control='Residential'); 
		
		$dataArr = '';
		foreach($data['arrListBOQSectionHeader']  as $key=>$dataArr)
		{	
			//var:
			//print_r($sectionHeaderName); die;  
			$sectionHeaderName = $dataArr['section_header']; 
			
			//array:getBOQSectionListFromHeaderName:
			$arrSectionList  = array();
			$arrSectionList = $this->Md_boqbuilder->getBOQSectionListFromSectionHeader($sectionHeaderName,$project_type_control='Residential'); 
			 
			$data['arrListBOQSectionHeader'][$key]['arrSectionList'] = $arrSectionList;
			 
		}
		//echo "<pre>"; print_r($data['arrListBOQSectionHeader']); echo "</pre>"; 
		
		//sql::get default section list:
		  $rsGetBoqSectionListingDefault = ''; 
		  $queryStr = '';
		  $queryStr = "SELECT `id`, `section_header`, `section`, `project_type_control` FROM  `jb080_order_boq_builder_section_master` 
						WHERE `id` IN ('23', '22', '20', '21', '19', '17', '1', '2', '4') AND `project_type_control`='Residential' 
						ORDER BY FIELD(`id`,23,22,20,21,19,17,1,2,4) ASC ";
		  $rsGetBoqSectionListingDefault = $this->Md_boqbuilder->selectData($queryStr);	
		  $stringSectionArrList = array();
			foreach($rsGetBoqSectionListingDefault as $key=>$dataArr)
			{	
				$section_id = $dataArr['id']; 
				$stringSectionArrList[] = $section_id; 
			}
		  $data['stringSectionArrList'] = implode(',',$stringSectionArrList);
 		  $data['defaultBoqSectionList'] = $rsGetBoqSectionListingDefault;
		  //view:	
          $this->load->view('boq_builder/vw_new_boq_builder',$data);
			 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	}//endFunction;
	
	public function newBoqBuilderDetailsAction($orderId,$userType,$userAccountId)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent'))==1)
		{
		//echo "<pre>"; print_r($_REQUEST); echo "</pre>"; die;
	  
		 //varDefine:
		$data['orderId'] = $orderId;
		$data['userType'] = $userType;
		$data['userAccountId'] = $userAccountId;
		
		 //PostData:
		 $arrSectionList = $_POST['sectionList']?$_POST['sectionList']:'';
		 $boqBuilderInteriorServices = $_POST['boqBuilderInteriorServices']?$_POST['boqBuilderInteriorServices']:'';
		 //echo "<pre>"; print_r($arrSectionList); echo "</pre>";//die;
		  
		 //sql::create new record for the `$idBoqBuild`;
 		 $table = "jb080_order_boq_builder_details"; 
		 $data=array('order_id'=>$orderId,
					'actorBy'=>$userType,
					'actorId'=>$userAccountId,
					'onDateTime'=> date('Y-m-d H:i:s')
					);
		 $idBoqBuild = $this->Md_boqbuilder->insertData($table, $data); 
		 
		 //foreach::Add Interior Services List:
		 foreach($boqBuilderInteriorServices as $key => $interiorServiceRecd)
		 {
			 //sql::insert;
			 $table = "jb080_order_boq_builder_details_mapp_interior_service_list"; 
			 $data=array('idBoqBuild'=>$idBoqBuild,
			 			'order_id'=>$orderId,
						'interiorServiceName'=>$interiorServiceRecd 
						);
 			 $lastInsertIdInteriorServiceBoqBuild = $this->Md_boqbuilder->insertData($table, $data); 
		 }
		  
		 //foreach::Add Section List:
		 /*foreach($arrSectionList as $key => $sectionData)
		 {
		 	 //varDefine;
			$section_id = $sectionData['id'];
			$section_name = $sectionData['name'];
			$section_length = $sectionData['length']?$sectionData['length']:'';
			$section_breadth = $sectionData['breadth']?$sectionData['breadth']:'';
			
			//ifCase:
			if($section_length || $section_breadth)
			{
				 //sql::insert;
				 $table = "jb080_order_boq_builder_details_mapp_section_list"; 
				 $data=array('idBoqBuild'=>$idBoqBuild,
							'order_id'=>$orderId,
							'section_id'=>$section_id,
							'section_title'=>$section_name,
							'length'=>$section_length,
							'breadth'=>$section_breadth 
							);
				 $lastInsertIdSectionBoqBuild = $this->Md_boqbuilder->insertData($table, $data); 
			 }//endIf;
		 }*/
		 
		 //echo "<pre>"; print_r($arrSectionList); echo "</pre>";
		 //echo "Here"; die;
		 
		 //foreach~AA:
		 foreach($arrSectionList as $key=>$sectionData)
		 {
		 	//varDefine;
			$section_id = $sectionData['id'];
			$section_name = $sectionData['name'];
			$section_length = $sectionData['length']?$sectionData['length']:0;
			$section_breadth = $sectionData['breadth']?$sectionData['breadth']:0;
			
			//ifCase:
			if($section_length || $section_breadth)
			{
				//sql::insert;section entry in 
				 $table = "jb080_order_boq_builder_details_mapp_section_list"; 
				 $data=array('idBoqBuild'=>$idBoqBuild,
							'order_id'=>$orderId,
							'section_id'=>$section_id,
							'section_title'=>$section_name,
							'length'=>$section_length,
							'breadth'=>$section_breadth 
							);
				 $section_mapp_id = '';
				 $section_mapp_id = $this->Md_boqbuilder->insertData($table, $data); 
			
			$rsSectionDetails = $this->Md_boqbuilder->getBOQSectionDetailsFromSectionId($section_id);  
			$rsSectionDetails = $rsSectionDetails[0];
			//echo "<pre>"; print_r($rsSectionDetails); echo "</pre>";

			//interiorServiceNeededForeach~BB:
			if($boqBuilderInteriorServices)
			{
			foreach($boqBuilderInteriorServices as $key => $interiorServiceRecd)
			{
				//echo $key.">".
				$interiorServiceRecd;
			
					//var:
					$strRateCardIds = '';
					//echo 
					$strRateCardIds = $rsSectionDetails[$interiorServiceRecd];
					//echo "->".$interiorServiceRecd."->".
					$strRateCardIds = str_replace(",","','",$strRateCardIds);
					//echo "<br>";
					//die;
					//ifCase$strRateCardIds:
					if(!empty($strRateCardIds))
					{
						 //sql::getRateIdDetails:
						 $arrRateList = '';
						 $arrRateList = $this->Md_boqbuilder->getBOQRateCardDtlsFromRateCaesIds($strRateCardIds);  
						 //echo "<pre>"; print_r($arrRateList); echo "</pre>"; //die;
						 //foreach~CC:
						 foreach($arrRateList as $key=>$rateData)
						 {
						 	//varDef:
							$job_id           = $rateData['job_id'];
							$typologyTxt      = $rateData['typologyTxt'];
							$scopeTxt         = $rateData['scopeTxt'];
							$specification_id = $rateData['specification_id'];
							$descriptionTxt   = $rateData['descriptionTxt'];
							$specificationTxt = $rateData['specificationTxt'];
							$brandTxt         = $rateData['brandTxt'];
							$reqNumberUnitTxt = $rateData['reqNumberUnitTxt'];
							$cost_profileTxt = $rateData['cost_profileTxt'];
							$cost_profile_id  = $rateData['cost_profile_id'];
							$apply_rate       = ($rateData['apply_rate'])?$rateData['apply_rate']:0;
							$supply_rate      = ($rateData['supply_rate'])?$rateData['supply_rate']:0;
							 
							//cal:defaultMeasurmentVal:
							$default_measurement_description = '';
							$default_measurement_description = str_replace('=','',$rateData['default_measurement_description']);
							$default_measurement_description = str_replace('L',$section_length,$default_measurement_description);
							 $default_measurement_description = str_replace('B',$section_breadth,$default_measurement_description);
							//echo "<br>";
							 $default_measurement_val = eval("return " . $default_measurement_description.";");
							 $default_measurement_val = ($default_measurement_val)?$default_measurement_val:0;
							//echo "<br>";
							//cal:calcLogicVal:
							$calc_logic_description = '';
							$calc_logic_description = str_replace('=','',$rateData['calc_logic_description']);
							$calc_logic_description = str_replace('UI',$default_measurement_val,$calc_logic_description);//this is user input;
							$calc_logic_description = str_replace('apply_rate',$apply_rate,$calc_logic_description);
							$calc_logic_description = str_replace('supply_rate',$supply_rate,$calc_logic_description);
							//echo "<br>";
							 $calc_logic_val = eval("return " . $calc_logic_description.";");
							//echo "<br>";
							$applyPrice =  ($apply_rate * $default_measurement_val);
							$supplyPrice = ($supply_rate * $default_measurement_val);
							
							//sql::insert section records;
							 $table = "jb080_order_boq_builder_details_mapp_section_service_list"; 
							 $data=array('idBoqBuild'=>$idBoqBuild,
							 			'order_id'=>$orderId,
										'section_mapp_id'=>$section_mapp_id,
										'section_id'=>$section_id,
										'sectionTxt'=>$section_name,
										'length'=>($section_length)?$section_length:0,
										'breadth'=> ($section_breadth)?$section_breadth:0,
										'job_id'=>$job_id,
										'typologyTxt'=>$typologyTxt,
										'scopeTxt'=>$scopeTxt,
										'specification_id'=>$specification_id,
										'descriptionTxt'=>$descriptionTxt,
										'specificationTxt'=>$specificationTxt,
										'brandTxt'=>$brandTxt,
										'cost_profile_id'=>$cost_profile_id,
										'cost_profileTxt'=>$cost_profileTxt,
										'reqNumber'=> $default_measurement_val,
										'reqNumberUnitTxt'=>$reqNumberUnitTxt,
										'applyRate'=>$apply_rate,
										'applyPrice'=>$applyPrice,
										'supplyRate'=>$supply_rate,
										'supplyPrice'=>$supplyPrice,
										'price'=> $calc_logic_val
										);
							$idMappSectionListBoqBuild = $this->Md_boqbuilder->insertData($table, $data); 
								
						 }//endForeach~CC;

					}//end:ifCase$strRateCardIds;
					
				 //echo "<pre>"; print_r($arrRateList); echo "</pre>";//die;
				
				}//endForeach~BB;*/
			}//endIf;
			
			//echo "<pre>"; print_r($sectionData); echo "</pre>";//die;
			
			//SQL::Get Section Wise~Low Cost(Price) Record Id details;
			$arrLowestCostingRecdIdList = ''; 
			$arrLowestCostingRecdIdList = $this->Md_boqbuilder->getBOQMappSectionLowestCostingRecordIdDtlsFromSectionId($section_mapp_id,$section_id,$idBoqBuild);  
			//foreach~:
			$arrLowestCostingRecdIds = array();
			 foreach($arrLowestCostingRecdIdList as $key=>$rowData)
			 {
				//varDefine;
				$arrLowestCostingRecdIds[] = $rowData['id'];
			 }	
			$strLowestCostingRecdIds = "'".implode("','",$arrLowestCostingRecdIds)."'";
			//echo "<pre>"; print_r($arrLowestCostingRecdIds); echo "</pre>";
			
			//SQL::Delete Section Wise~High Cost(Price) Record;
			$rsDelHighCostingRecdIdList = ''; 
			$rsDelHighCostingRecdIdList = $this->Md_boqbuilder->deleteBOQMappSectionHighCostingRecordIdDtlsFromSectionIdAndLowCostId($section_mapp_id,$section_id,$strLowestCostingRecdIds);  
			
			}//endIf;
			//echo "<hr>";
			//die;  
		 }//endForeach~AA;
		 
		 //sql::get BOQ Total Price:
		 $rsGetBOQBuildTotalPrice = ''; 
		 $rsGetBOQBuildTotalPrice = $this->Md_boqbuilder->getBoqBuildTotalPriceFromMappSectionPriceList($idBoqBuild);  
		 $totalPriceBOQBuild = $rsGetBOQBuildTotalPrice[0]['total_price'];		
		 
		 //sql::Update BOQ Total Price:
		 $rsUpdateBOQBuildTotalPrice = ''; 
		 $rsUpdateBOQBuildTotalPrice = $this->Md_boqbuilder->updateBoqBuildTotalPriceByIdBoqBuild($idBoqBuild,$totalPriceBOQBuild);  
		 
		 //methode::update::BOQ prices:
		 $finalTotal = $this->updateBOQPrices($idBoqBuild);
		 
		 //Redirect:
		 redirect(base_url()."buildBOQDetails/$orderId/$userType/$userAccountId/BOQ/".$idBoqBuild);exit();
			 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  

	}//endFunction;
	
	public function buildBOQDetails($orderId,$userType,$userAccountId,$type,$idBoqBuild)
	{
 		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent','Executioner'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
			//if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}
	
			/*PageSEO-ContentData:*/  
			$data['page_title'] = "BOQ Details - Top International Interior Design for Home & Office in Delhi and Bangalore";
			$data['page_name'] = 'boq-builder-details';  
			$data['leadGenFromSliderPageType'] ='boq-builder-details'; 
			$data['leadGenFromSliderPageUniqueId'] = '';
			$data['meta_description'] = "BOQ Builder Details";
			$data['meta_keywords'] =  "BOQ Builder Details"; 
			
			//varDefine:
			$data['orderId'] = $orderId;
			$data['userType'] = $userType;
			$data['userAccountId'] = $userAccountId;
			$data['type'] = $userAccountId;
			$data['idBoqBuild'] = $idBoqBuild;
			
			
			/*[start::field record:]*/
			//array:getBOQSectionHeaderList:
			$data['arrListBOQSectionHeader']  = array();
			$data['arrListBOQSectionHeader'] = $this->Md_boqbuilder->getBOQSectionHeaderList($project_type_control='Residential'); 
			$dataArr = '';
			foreach($data['arrListBOQSectionHeader']  as $key=>$dataArr)
			{	
				//var:
				//print_r($sectionHeaderName); die;  
				$sectionHeaderName = $dataArr['section_header']; 
				
				//array:getBOQSectionListFromHeaderName:
				$arrSectionList  = array();
				$arrSectionList = $this->Md_boqbuilder->getBOQSectionListFromSectionHeader($sectionHeaderName,$project_type_control='Residential'); 
				 
				$data['arrListBOQSectionHeader'][$key]['arrSectionList'] = $arrSectionList;
				 
			}
			//echo "<pre>"; print_r($data['arrListBOQSectionHeader']); echo "</pre>"; 
			//array:getBOQSectionServiceHeaderList:
			$data['arrListBOQSectionServiceScopeHeader']  = array();
			$data['arrListBOQSectionServiceScopeHeader'] = $this->Md_boqbuilder->getBOQSectionServiceScopeHeaderList($project_type_control='Residential'); 
			$dataArr = '';
			foreach($data['arrListBOQSectionServiceScopeHeader']  as $key=>$dataArr)
			{	
				//var:
				$sectionServiceScopeHeaderName = $dataArr['job']; 
				
				//array:getBOQSectionServiceScopeListFromHeaderName:
				$arrSectionServieScopeList  = array();
				$arrSectionServieScopeList = $this->Md_boqbuilder->getBOQSectionServiceScopeListFromHeaderName($sectionServiceScopeHeaderName,$project_type_control='Residential'); 
				 
				$data['arrListBOQSectionServiceScopeHeader'][$key]['arrSectionServieScopeList'] = $arrSectionServieScopeList;
				 
			}
			/*[end::field record;]*/			
			
			//sql:getBOQBuildDetails:
			$data['rsBoqBuildDetails']  = array();
			$data['rsBoqBuildDetails'] = $this->Md_boqbuilder->getBOQBuildDetails($idBoqBuild);
			$data['rsBoqBuildDetails'] = $data['rsBoqBuildDetails'][0];
                        $data['rsBoqBuildDetails']['executionPartnerName'] = $this->getExecutionerNameById($data['rsBoqBuildDetails']['executionPartnerActorId']);
//		echo '<pre>';
//                print_r($data['rsBoqBuildDetails']);
//		die;
                     if($data['rsBoqBuildDetails']['status']!='1' || !empty($data['rsBoqBuildDetails']['executionPartnerActorId']) ){
                         redirect(base_url("view-buildBOQDetails/$orderId/$userType/$userAccountId/BOQ/$idBoqBuild"));exit;
                     }
			//sql:get boq build section header list:
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = array();
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = $this->Md_boqbuilder->getBOQBuildDetailsMappSectionHeaderList($idBoqBuild);  
			$dataArr = '';
			$stringSectionArrList = array();
			foreach($data['arrBOQBuildDtlsSectionHeaderWiseListing'] as $key=>$dataArr)
			{	
				//var:
				//print_r($sectionHeaderName); die;  
				$section_mapp_id = $dataArr['section_mapp_id'];  
				$section_id = $dataArr['section_id']; 
				
				//array:getBuildBOQSectionListBYSectionIdAndIdBoqBuild:
				$arrSectionServiceList  = array();
				$arrSectionServiceList = $this->Md_boqbuilder->getBuildBOQSectionListBYSectionIdAndIdBoqBuild($section_mapp_id,$section_id,$idBoqBuild); 
				 
				$data['arrBOQBuildDtlsSectionHeaderWiseListing'][$key]['arrSectionServiceList'] = $arrSectionServiceList;
				$stringSectionArrList[] = $section_id; 
			}
			$data['stringSectionArrList'] = implode(',',$stringSectionArrList);
			//echo "<pre>"; print_r($data['arrBOQBuildDtlsSectionHeaderWiseListing']); echo "</pre>";//die;
                          $additionalPricingArr['totalApplyPrice']=$data['rsBoqBuildDetails']['totalApplyPrice'];
                         $additionalPricingArr['totalSupplyPrice']=$data['rsBoqBuildDetails']['totalSupplyPrice'];
                         $additionalPricingArr['totalPrice']=$data['rsBoqBuildDetails']['totalPrice'];
                         $additionalPricingArr['materialHandling']=$data['rsBoqBuildDetails']['materialHandling'];
                         $additionalPricingArr['packagingCharges']=$data['rsBoqBuildDetails']['packagingCharges'];
                         $additionalPricingArr['labourCharges']=$data['rsBoqBuildDetails']['labourCharges'];
                         $additionalPricingArr['cartageCharges']=$data['rsBoqBuildDetails']['cartageCharges'];
                         $additionalPricingArr['octroiCharges']=$data['rsBoqBuildDetails']['octroiCharges'];
                         $additionalPricingArr['sumTotal']=$data['rsBoqBuildDetails']['sumTotal'];
                         $additionalPricingArr['gst']=$data['rsBoqBuildDetails']['gst'];
                         $additionalPricingArr['finalTotal']=$data['rsBoqBuildDetails']['finalTotal'];
                        $data['additionalPricingSection']= $this->additionalPricingSection($additionalPricingArr);
                        $milestoneList = $this->getMilestoneListAndTnC($orderId,$idBoqBuild); 
                        $data['milestoneList'] = $milestoneList;
                        $data['noteTnC'] = $milestoneList?$milestoneList[0]['noteTnC']:'';
                        $changeRequestList = $this->getChangeRequestList($orderId,$idBoqBuild);  
                        $data['changeRequestList'] = $changeRequestList;
			$this->load->view('boq_builder/vw_build_boq_details',$data);
				 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	
	}//endFunction;
	
	public function viewBuildBOQDetails($orderId,$userType,$userAccountId,$type,$idBoqBuild)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent','Executioner'))==1)
		{
			//$customer_id = $_SESSION["customerId"]; 
			//if(empty($customer_id)&&$userType=='Customer'){redirect(base_url().'signin');}
	
			/*PageSEO-ContentData:*/  
			$data['page_title'] = "BOQ Details - Top International Interior Design for Home & Office in Delhi and Bangalore";
			$data['page_name'] = 'boq-builder-details';  
			$data['leadGenFromSliderPageType'] ='boq-builder-details'; 
			$data['leadGenFromSliderPageUniqueId'] = '';
			$data['meta_description'] = "BOQ Builder Details";
			$data['meta_keywords'] =  "BOQ Builder Details"; 
			
			//varDefine:
			$data['orderId'] = $orderId;
			$data['userType'] = $userType;
			$data['userAccountId'] = $userAccountId;
			$data['type'] = $userAccountId;
			$data['idBoqBuild'] = $idBoqBuild;
			
			
			/*[start::field record:]*/
			//array:getBOQSectionHeaderList:
			$data['arrListBOQSectionHeader']  = array();
			$data['arrListBOQSectionHeader'] = $this->Md_boqbuilder->getBOQSectionHeaderList($project_type_control='Residential'); 
			$dataArr = '';
			foreach($data['arrListBOQSectionHeader']  as $key=>$dataArr)
			{	
				//var:
				//print_r($sectionHeaderName); die;  
				$sectionHeaderName = $dataArr['section_header']; 
				
				//array:getBOQSectionListFromHeaderName:
				$arrSectionList  = array();
				$arrSectionList = $this->Md_boqbuilder->getBOQSectionListFromSectionHeader($sectionHeaderName,$project_type_control='Residential'); 
				 
				$data['arrListBOQSectionHeader'][$key]['arrSectionList'] = $arrSectionList;
				 
			}
			//echo "<pre>"; print_r($data['arrListBOQSectionHeader']); echo "</pre>"; 
			//array:getBOQSectionServiceHeaderList:
			$data['arrListBOQSectionServiceScopeHeader']  = array();
			$data['arrListBOQSectionServiceScopeHeader'] = $this->Md_boqbuilder->getBOQSectionServiceScopeHeaderList($project_type_control='Residential'); 
			$dataArr = '';
			foreach($data['arrListBOQSectionServiceScopeHeader']  as $key=>$dataArr)
			{	
				//var:
				$sectionServiceScopeHeaderName = $dataArr['job']; 
				
				//array:getBOQSectionServiceScopeListFromHeaderName:
				$arrSectionServieScopeList  = array();
				$arrSectionServieScopeList = $this->Md_boqbuilder->getBOQSectionServiceScopeListFromHeaderName($sectionServiceScopeHeaderName,$project_type_control='Residential'); 
				 
				$data['arrListBOQSectionServiceScopeHeader'][$key]['arrSectionServieScopeList'] = $arrSectionServieScopeList;
				 
			}
			/*[end::field record;]*/			
			
			//sql:getBOQBuildDetails:
			$data['rsBoqBuildDetails']  = array();
			$data['rsBoqBuildDetails'] = $this->Md_boqbuilder->getBOQBuildDetails($idBoqBuild);
			$data['rsBoqBuildDetails'] = $data['rsBoqBuildDetails'][0];
			$data['rsBoqBuildDetails']['executionPartnerName'] = $this->getExecutionerNameById($data['rsBoqBuildDetails']['executionPartnerActorId']);
			//sql:get boq build section header list:
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = array();
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = $this->Md_boqbuilder->getBOQBuildDetailsMappSectionHeaderList($idBoqBuild);  
			$dataArr = '';
			$stringSectionArrList = array();
			foreach($data['arrBOQBuildDtlsSectionHeaderWiseListing'] as $key=>$dataArr)
			{	
				//var:
				//print_r($sectionHeaderName); die;  
				$section_mapp_id = $dataArr['section_mapp_id'];  
				$section_id = $dataArr['section_id']; 
				
				//array:getBuildBOQSectionListBYSectionIdAndIdBoqBuild:
				$arrSectionServiceList  = array();
				$arrSectionServiceList = $this->Md_boqbuilder->getBuildBOQSectionListBYSectionIdAndIdBoqBuild($section_mapp_id,$section_id,$idBoqBuild); 
				 
				$data['arrBOQBuildDtlsSectionHeaderWiseListing'][$key]['arrSectionServiceList'] = $arrSectionServiceList;
				$stringSectionArrList[] = $section_id; 
			}
			$data['stringSectionArrList'] = implode(',',$stringSectionArrList);
			
                        
                         
                         
                          $additionalPricingArr['totalApplyPrice']=$data['rsBoqBuildDetails']['totalApplyPrice'];
                         $additionalPricingArr['totalSupplyPrice']=$data['rsBoqBuildDetails']['totalSupplyPrice'];
                         $additionalPricingArr['totalPrice']=$data['rsBoqBuildDetails']['totalPrice'];
                         $additionalPricingArr['materialHandling']=$data['rsBoqBuildDetails']['materialHandling'];
                         $additionalPricingArr['packagingCharges']=$data['rsBoqBuildDetails']['packagingCharges'];
                         $additionalPricingArr['labourCharges']=$data['rsBoqBuildDetails']['labourCharges'];
                         $additionalPricingArr['cartageCharges']=$data['rsBoqBuildDetails']['cartageCharges'];
                         $additionalPricingArr['octroiCharges']=$data['rsBoqBuildDetails']['octroiCharges'];
                         $additionalPricingArr['sumTotal']=$data['rsBoqBuildDetails']['sumTotal'];
                         $additionalPricingArr['gst']=$data['rsBoqBuildDetails']['gst'];
                         $additionalPricingArr['finalTotal']=$data['rsBoqBuildDetails']['finalTotal'];
                         
                         
                        $data['additionalPricingSection']= $this->additionalPricingSection($additionalPricingArr);
//                        echo "<pre>"; print_r($data); echo "</pre>";die;
                        $milestoneList = $this->getMilestoneListAndTnC($orderId,$idBoqBuild); 
                        $data['milestoneList'] = $milestoneList;
                        $data['noteTnC'] = $milestoneList?$milestoneList[0]['noteTnC']:'';
                        $changeRequestList = $this->getChangeRequestList($orderId,$idBoqBuild);  
                        $data['changeRequestList'] = $changeRequestList;
//                        echo '<pre>';
//                        print_r($data['arrBOQBuildDtlsSectionHeaderWiseListing']);
//                        echo '</pre>';
//                        die;
			$this->load->view('boq_builder/vw_view_build_boq_details',$data);
				 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	
	}//endFunction;
        
        
	
	public function buildBOQAjaxAutoSaveDetails()
	{    
			//varDefine:
			$actionType = $_POST['actionType'];
			$key  = $_POST['key'];
			$value = $_POST['value'];
			//
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			$boqSectionItemMappId     = $_POST['boqSectionItemMappId'];
			$boqSectionItemId     = $_POST['boqSectionItemId'];
			$boqSectionItemIndex  = $_POST['boqSectionItemIndex'];
			$boqServiceItemId     = $_POST['boqServiceItemId'];
			$boqServiceIndex  = $_POST['boqServiceIndex'];
			
			//Ifcase::Update BOQ Name
			if($actionType=='boqNameUpdt')
			{
				//sql::Update BOQ Total Price:
				 $rsUpdateBuildBoqName = ''; 
				 $queryStr = '';
				 $queryStr = "UPDATE `jb080_order_boq_builder_details` SET `".$key."`= '".$value."', `onDateTime`='".date('Y-m-d H:i:s')."' 
				 			  WHERE `idBoqBuild`='".$idBoqBuild."' ";
				 $rsUpdateBuildBoqName = $this->Md_boqbuilder->updateBuildBoqDetails($queryStr);  
			}
			//end::update::BOQ Name 
			
			//Ifcase::Update BOQ Length
			if($actionType=='boqLengthUpdt')
			{
				  //sql:
				  $rsUpdateData = ''; 
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_list` SET `".$key."`= '".$value."' 
				  WHERE `idBoqBuild`='".$idBoqBuild."' AND `id`='".$boqSectionItemMappId."' ";
				  $rsUpdateData = $this->Md_boqbuilder->updateData($queryStr);  
				  
				  //sql::Update BOQ Total Price:
				  $rsUpdateBuildBoqDate = ''; 
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details` SET `onDateTime`='".date('Y-m-d H:i:s')."' 
							  WHERE `idBoqBuild`='".$idBoqBuild."' ";
				  $rsUpdateBuildBoqDate = $this->Md_boqbuilder->updateBuildBoqDetails($queryStr);
			}
			//end::Update BOQ Length;
			
			//Ifcase::Update BOQ Breadth
			if($actionType=='boqBreadthUpdt')
			{
				  //sql:
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_list` SET `".$key."`= '".$value."'  
				  WHERE `idBoqBuild`='".$idBoqBuild."' AND `id`='".$boqSectionItemMappId."' ";
				  //fun:
				  $rsUpdateData = ''; 
				  $rsUpdateData = $this->Md_boqbuilder->updateData($queryStr);  
				  
				  //sql::Update BOQ Total Price:
				  $rsUpdateBuildBoqDate = ''; 
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details` SET `onDateTime`='".date('Y-m-d H:i:s')."' 
							  WHERE `idBoqBuild`='".$idBoqBuild."' ";
				  $rsUpdateBuildBoqDate = $this->Md_boqbuilder->updateBuildBoqDetails($queryStr);
			}
			//end::Update BOQ Breadth;
			
			//Ifcase::Update Section Service UserInput Val:
			if($actionType=='boqSectionServiceUI')
			{
				 //sql::get serviceRecdId details:
				  $rsGetBuildBoqServiceRecdDtls = ''; 
				  $queryStr = '';
				  $queryStr = "SELECT `job_id`, `specification_id`, `cost_profile_id` FROM  `jb080_order_boq_builder_details_mapp_section_service_list` 
				  				WHERE `id`='".$boqServiceItemId."' AND `idBoqBuild`='".$idBoqBuild."' AND `section_id`='".$boqSectionItemId."'  ";
				  $rsGetBuildBoqServiceRecdDtls = $this->Md_boqbuilder->selectData($queryStr);
				  $job_id = ''; $job_id = $rsGetBuildBoqServiceRecdDtls[0]['job_id'];
				  $specification_id = ''; $specification_id = $rsGetBuildBoqServiceRecdDtls[0]['specification_id'];
				  $cost_profile_id = ''; $cost_profile_id = $rsGetBuildBoqServiceRecdDtls[0]['cost_profile_id'];			  
				  	
				  //sql::get rateCardId from  job_id,specification_id,cost_profile_id:
				  $rsGetRateCardIdRecd = ''; 
				  $queryStr = '';
				  $queryStr = "SELECT `rate_id` FROM `jb080_order_boq_builder_rates` 
				  				WHERE `status`='Active' AND `job_id`='".$job_id."' AND `specification_id`='".$specification_id."' 
								AND `cost_profile_id`='".$cost_profile_id."'  ";
				  $rsGetRateCardIdRecd = $this->Md_boqbuilder->selectData($queryStr);	
				  $rateCardId = ''; $rateCardId = $rsGetRateCardIdRecd[0]['rate_id'];
				  
				  //sql::getRateIdDetails:
				  $arrRateList = '';
				  $arrRateList = $this->Md_boqbuilder->getBOQRateCardDtlsFromRateCaesIds($rateCardId);  
				  
				  //reqNumber:
				  $reqNumber = ($value)?$value:0;
				  
				  //foreach~update:
				  foreach($arrRateList as $key=>$rateData)
				  {
					//varDef:
					$job_id           = $rateData['job_id'];
					$specification_id = $rateData['specification_id'];
					$cost_profile_id  = $rateData['cost_profile_id'];
					$apply_rate       = ($rateData['apply_rate'])?$rateData['apply_rate']:0;
					$supply_rate      = ($rateData['supply_rate'])?$rateData['supply_rate']:0;
					 
					/*//cal:defaultMeasurmentVal:
					$default_measurement_description = '';
					$default_measurement_description = str_replace('=','',$rateData['default_measurement_description']);
					$default_measurement_description = str_replace('L',$section_length,$default_measurement_description);
					 $default_measurement_description = str_replace('B',$section_breadth,$default_measurement_description);*/
					//echo "<br>";
					/* $default_measurement_val = eval("return " . $default_measurement_description.";");
					 $default_measurement_val = ($default_measurement_val)?$default_measurement_val:0;*/
					//echo "<br>";
					$default_measurement_val = $reqNumber;
					//cal:calcLogicVal:
					$calc_logic_description = '';
					$calc_logic_description = str_replace('=','',$rateData['calc_logic_description']);
					$calc_logic_description = str_replace('UI',$default_measurement_val,$calc_logic_description);//this is user input;
					$calc_logic_description = str_replace('apply_rate',$apply_rate,$calc_logic_description);
					$calc_logic_description = str_replace('supply_rate',$supply_rate,$calc_logic_description);
					//echo "<br>";
					 $calc_logic_val = eval("return " . $calc_logic_description.";");
					//echo "<br>";
					$applyPrice =  ($apply_rate * $default_measurement_val);
					$supplyPrice = ($supply_rate * $default_measurement_val);
					
					//sql::update records;
					$queryStr = '';
				  	$queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_service_list` SET 
								`reqNumber`=".$default_measurement_val.", 
								`applyRate`=".$apply_rate.",
								`applyPrice`=".$applyPrice.",
								`supplyRate`=".$supply_rate.",
								`supplyPrice`=".$supplyPrice.", 
								`price`=".$calc_logic_val." 
				  				WHERE `id`='".$boqServiceItemId."' AND `idBoqBuild`='".$idBoqBuild."' ";			
					$updateaffectedRowCount = $this->Md_boqbuilder->updateData($queryStr); 
				 }//endForeach~update;
			}
			//end::Update Section Service UserInput Val.;
			
			//Ifcase::Update BOQ Section Title update:
			if($actionType=='boqSectionNameUpdt')
			{
				  //sql:
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_list` SET `".$key."`= '".$value."'  
				  WHERE `idBoqBuild`='".$idBoqBuild."' AND `id`='".$boqSectionItemMappId."' ";
				  //fun:
				  $rsUpdateData = ''; 
				  $rsUpdateData = $this->Md_boqbuilder->updateData($queryStr);  
                                  
				  //sql:
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_service_list` SET `sectionTxt`= '".$value."'  
				  WHERE `idBoqBuild`='".$idBoqBuild."' AND `section_mapp_id`='".$boqSectionItemMappId."' ";
				  //fun:
				  $rsUpdateData = ''; 
				  $rsUpdateData = $this->Md_boqbuilder->updateData($queryStr);  
				  
				  //sql::Update BOQ Total Price:
				  $rsUpdateBuildBoqDate = ''; 
				  $queryStr = '';
				  $queryStr = "UPDATE `jb080_order_boq_builder_details` SET `onDateTime`='".date('Y-m-d H:i:s')."' 
							  WHERE `idBoqBuild`='".$idBoqBuild."' ";
				  $rsUpdateBuildBoqDate = $this->Md_boqbuilder->updateBuildBoqDetails($queryStr);
			}
			//end::Update BOQ Section Title update;
			
			
			//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
	 
		return 'success';
	
	}//endFunction;
	
	public function ajaxBuildBOQAddNewSection()
	{
			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - addNewSection
			$section_id  = $_POST['sectionId'];
			$section_name = $_POST['sectionName'];
			$section_length = null;
			$section_breadth = null;
			//
			$numOfNewSectionRow = $_POST['numOfNewSectionRow'];	
			//$n = $numOfNewSectionRow;
			
			 //sql::insert;
			 $table = "jb080_order_boq_builder_details_mapp_section_list"; 
			 $data=array('idBoqBuild'=>$idBoqBuild,
			 			'order_id'=>$orderId,
						'section_id'=>$section_id,
						'section_title'=>$section_name,
						'length'=>$section_length,
						'breadth'=>$section_breadth 
						);
			$section_mapp_id = '';
			$section_mapp_id = $this->Md_boqbuilder->insertData($table, $data); 
			/*<span class="sectionHeaderRecd">'.$section_name.'</span>*/
			echo '<div class="divId_SectionRow clearfix" id="divIdSectionRow'.$numOfNewSectionRow.'">
			<div class="col-xs-11"><input class="sectionHeaderRecd" type="text" name="sectionList['.$numOfNewSectionRow.'][name]" id="sectionListName" value="'.$section_name.'"
			onblur="ajaxAutoSaveBOQ(\'boqSectionNameUpdt\',\'section_title\',$(this).val(),'.$section_mapp_id.','.$section_id.','.$numOfNewSectionRow.');" />
			 <input type="hidden" name="sectionList['.$numOfNewSectionRow.'][id]" id="sectionListId" value="'.$section_id.'" />
			 <input type="text" name="sectionList['.$numOfNewSectionRow.'][length]" id="sectionListLength" value="" placeholder="Length (ft.)"
			 onblur="ajaxAutoSaveBOQ(\'boqLengthUpdt\',\'length\',$(this).val(),'.$section_mapp_id.','.$section_id.','.$numOfNewSectionRow.');" />
			 <input type="text" name="sectionList['.$numOfNewSectionRow.'][breadth]" id="sectionListBreadth" value="" placeholder="Breadth (ft.)" 
			 onblur="ajaxAutoSaveBOQ(\'boqBreadthUpdt\',\'breadth\',$(this).val(),'.$section_mapp_id.','.$section_id.','.$numOfNewSectionRow.');" />
			</div>
			<div class="col-xs-1 text-right" > 	
			 <a href="javascript:void(0);" class="btn btn-default btn-sm" title="Remove Section" onclick="funMinusSectionRow('.$numOfNewSectionRow.','.$section_mapp_id.','.$section_id.')" 
				><span class="fa fa-minus"></span></a>
			</div>
			<div class="col-xs-12 table-responsive" style="margin-top:10px;">
            <table class="table table-bordered table-striped">
				<tbody id="tableListOfSectionServiceScopeTbodyId'.$numOfNewSectionRow.'">
				</tbody>
			</table>
			</div>
			<div class="col-xs-8" style="margin-top:10px;">
            <a href="javascript:void(0);" onclick="funAddMoreServiceRow('.$section_mapp_id.','.$section_id.','.$numOfNewSectionRow.',\''.str_replace("'","&lsquo;",$section_name).'\');" 
			data-toggle="modal" data-target="#myModalAddNewService"  class="btn btn-info btn-sm" style="background-color:#fff;border-color:#243f71;color: #000;">
			 Add New Service <span class="fa fa-plus"></span></a></div>
			<div class="col-xs-4" style="margin-top:10px; text-align:right"><strong> Section Cost:&nbsp;</strong>
			<lable id="sectionTotalCost'.$numOfNewSectionRow.'"> 0.00</lable>&nbsp;(INR)</div>
        </div>';
		//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
		die;
	}//endFunction;
	
	public function ajaxBuildBOQRemoveSection()
	{
			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - removeSection
			$section_mapp_id  = $_POST['sectionMappId'];
			$section_id  = $_POST['sectionId'];
			//sql::removeSection;
			$affectedRowCount = $this->Md_boqbuilder->deleteBuildBOQSectionById($section_mapp_id,$section_id,$idBoqBuild);
			//sql::removeSectionServices;
			$affectedRowCount = $this->Md_boqbuilder->deleteBuildBOQSectionServicesById($section_mapp_id,$section_id,$idBoqBuild); 
			 echo 'success';
			 echo '|*|';
			 //sql::get BOQ Total Price:
			 $rsGetBOQBuildTotalPrice = ''; 
			 $rsGetBOQBuildTotalPrice = $this->Md_boqbuilder->getBoqBuildTotalPriceFromMappSectionPriceList($idBoqBuild);  
			 $totalPriceBOQBuild = $rsGetBOQBuildTotalPrice[0]['total_price'];
			  
			 //sql::Update BOQ Total Price:
			 $rsUpdateBOQBuildTotalPrice = ''; 
			 $rsUpdateBOQBuildTotalPrice = $this->Md_boqbuilder->updateBoqBuildTotalPriceByIdBoqBuild($idBoqBuild,$totalPriceBOQBuild);
		 	  
			 //methode::update::BOQ prices:
		 	 $finalTotal = $this->updateBOQPrices($idBoqBuild);
			  	
			 echo number_format($totalPriceBOQBuild,2); 
                         echo '|*|';
                         $additionalPricingArr['totalApplyPrice']='';
                         $additionalPricingArr['totalSupplyPrice']=$totalPriceBOQBuild;
                         $additionalPricingArr['totalPrice']='';
                         $additionalPricingArr['materialHandling']='';
                         $additionalPricingArr['packagingCharges']='';
                         $additionalPricingArr['cartageCharges']='';
                         $additionalPricingArr['octroiCharges']='';
                         $additionalPricingArr['labourCharges']='';
                         $additionalPricingArr['sumTotal']='';
                         $additionalPricingArr['gst']='';
                         $additionalPricingArr['finalTotal']='';
                        echo $this->additionalPricingSection($additionalPricingArr);
			 die;
	}//endFunction;
	
	public function getSectionServiceScopeSpecsDetailsListFromJobId()
	{
 			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - specsList
			$section_mapp_id  = $_POST['boqSectionItemMappId'];
			$section_id  = $_POST['boqSectionItemId'];
			$job_id = $_POST['jobId'];  
			//
			$boqSectionItemIndex = $_POST['boqSectionItemIndex'];	
			$n = $boqSectionItemIndex;
			
			//Sql::get the `Active` rate card specification_id from the $job_id:
			  $arrGetBoqRateCardListFromJobIdOfSpecifList = ''; 
			  $queryStr = '';
			  $queryStr = "SELECT `T2`.* FROM  `jb080_order_boq_builder_rates` AS `T1`
			  			   LEFT JOIN `jb080_order_boq_builder_specification_master` AS `T2`
						   ON `T1`.`specification_id` = `T2`.`specification_id`	
						   WHERE `job_id`='".$job_id."'  AND `status`='Active' GROUP BY  `T1`.`specification_id` ORDER BY  `T2`.`description` ASC ";
			  $arrGetBoqRateCardListFromJobIdOfSpecifList = $this->Md_boqbuilder->selectData($queryStr);
 			//echo "<pre>"; print_r($arrGetBoqRateCardSpecifListFromJobId); echo "</pre>"; die;
			
			//Sql::get the `Active` rate card cost_profile_id from the $job_id:
			  $arrGetBoqRateCardListFromJobIdOfCostProfileList = ''; 
			  $queryStr = '';
			  $queryStr = "SELECT `T2`.* FROM  `jb080_order_boq_builder_rates` AS `T1`
			  			   LEFT JOIN `jb080_order_boq_builder_cost_profile` AS `T2`
						   ON `T1`.`cost_profile_id` = `T2`.`cost_profile_id`	
						   WHERE `job_id`='".$job_id."'  AND `status`='Active' GROUP BY  `T1`.`cost_profile_id` ORDER BY  `T2`.`cost_profile` ASC ";
			  $arrGetBoqRateCardListFromJobIdOfCostProfileList = $this->Md_boqbuilder->selectData($queryStr);
 			  //echo "<pre>"; print_r($arrGetBoqRateCardListFromJobIdOfCostProfileList); echo "</pre>"; die;
			
			//prepareTableList:
			$returnScopeSpecsTblList = '';
			$returnScopeSpecsTblList.= '<div class="col-xs-12 table-responsive" ><table class="table table-bordered table-striped">
										  <tbody>
											<tr>
											<th style="background-color:#454545; color:#FFFFFF; text-align:left; ">Description</th>
											<th style="background-color:#454545; color:#FFFFFF; text-align:left; ">Specification</th>
											<th style="background-color:#454545; color:#FFFFFF; text-align:left; ">Brand</th>';
			//foreach:								
			foreach($arrGetBoqRateCardListFromJobIdOfCostProfileList as $key=>$dataArr)
			{					
				$returnScopeSpecsTblList.= '<th style="background-color:#454545; color:#FFFFFF; text-align:left; ">'.$dataArr['cost_profile'].'</th>';			
			}//end;		
			$returnScopeSpecsTblList.= ' </tr>';
			
			foreach($arrGetBoqRateCardListFromJobIdOfSpecifList as $key=>$dataSpecificationArr)
			{
				$returnScopeSpecsTblList.= '<tr>
											<td>'.$dataSpecificationArr['description'].'</td>
											<td>'.$dataSpecificationArr['specification'].'</td>
											<td>'.$dataSpecificationArr['brand'].'</td>';
					//foreach:					
					foreach($arrGetBoqRateCardListFromJobIdOfCostProfileList as $key=>$dataArr)
					{	
						//Sql::get the `Active` $rate_card_id from the $job_id,$specification_id,$cost_profile_id:
						  $arrGetBoqRateCardDtls = ''; 
						  $queryStr = '';
						  $queryStr = "SELECT `T1`.* FROM  `jb080_order_boq_builder_rates` AS `T1` 
									   WHERE `job_id`='".$job_id."' AND `specification_id`='".$dataSpecificationArr['specification_id']."' 
									   AND `cost_profile_id`='".$dataArr['cost_profile_id']."' AND `status`='Active' LIMIT 1";
						  $arrGetBoqRateCardDtls = $this->Md_boqbuilder->selectData($queryStr);
						   
						  $returnScopeSpecsTblList.= '<td style="width:85px;">';
						  if(!empty($arrGetBoqRateCardDtls))
						  { 
							  //var:define:
							  $rateCardId = $arrGetBoqRateCardDtls[0]['rate_id'];
							  $picture = $arrGetBoqRateCardDtls[0]['picture'];
							 
							 if(!empty($picture))
							 { 
								$returnScopeSpecsTblList.= '<a href="'.base_url().SitePath.'assets/img/boqBuilder/'.$picture.'" title="NOTE - This is a reference image. Actual service/furniture will be as per selection."
								class="example-image-link" data-lightbox="example-'.$rateCardId.'"><i class="fa fa-image" aria-hidden="true"></i></a>';
							 }
							$returnScopeSpecsTblList.= ' 
							<a href="javascript:void(0);" style="padding:2px;display: inline-block;" title="Select" 
													onclick="funAddNewServiceScopeSpecRow('.$section_mapp_id.','.$section_id.','.$boqSectionItemIndex.','.$rateCardId.');">
													<span class="label label-default" style="background-color:#025bb1; color:#FFFFFF;">Select</span></a>
												';
						  }
						  $returnScopeSpecsTblList.= '</td>';				
					}//end;					
				$returnScopeSpecsTblList.= '</tr>';
			}//end;
			$returnScopeSpecsTblList.= '</tbody></table></div>';
			echo $returnScopeSpecsTblList; 
		//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
		die;
	}//endFunction;
	
	public function ajaxAddNewScopeSpecInServiceList()
	{
			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - specsRowAdd
			$section_mapp_id  = $_POST['boqSectionItemMappId'];
			$section_id  = $_POST['boqSectionItemId'];
			$boqSectionItemIndex = $_POST['boqSectionItemIndex'];	
			$rateCardId          = $_POST['rateCardId']; 
			$n = $boqSectionItemIndex;
			$serviceRecdId          = $_POST['serviceRecdId'];
			
			//Sql::get build boq section length & breadth from $idBoqBuild & $section_id:
			  $arrGetBuildBoqSectionDtls = ''; 
			  $queryStr = '';
			  $queryStr = "SELECT `T1`.`section_title`, `T1`.`length`, `T1`.`breadth` FROM  `jb080_order_boq_builder_details_mapp_section_list` AS `T1` 
						   WHERE `idBoqBuild`='".$idBoqBuild."' AND `section_id`='".$section_id."' AND `id`='".$section_mapp_id."'  ";
			  $arrGetBuildBoqSectionDtls = $this->Md_boqbuilder->selectData($queryStr);
			  //var:define:
			  $section_length  = $arrGetBuildBoqSectionDtls[0]['length']?$arrGetBuildBoqSectionDtls[0]['length']:0;
			  $section_breadth = $arrGetBuildBoqSectionDtls[0]['breadth']?$arrGetBuildBoqSectionDtls[0]['breadth']:0;
			  $section_name = $arrGetBuildBoqSectionDtls[0]['section_title']?$arrGetBuildBoqSectionDtls[0]['section_title']:'';
                          
 
			 //sql::getRateIdDetails:
			 $arrRateList = '';
			 $arrRateList = $this->Md_boqbuilder->getBOQRateCardDtlsFromRateCaesIds($rateCardId);  
			 
			 //Ifcase::Check this is empty ~ Add Service Request Call:
			 if(empty($serviceRecdId))
			 {
				 //foreach~CC:
				 foreach($arrRateList as $key=>$rateData)
				 {
						 	//varDef:
							$job_id           = $rateData['job_id'];
							$typologyTxt      = $rateData['typologyTxt'];
							$scopeTxt         = $rateData['scopeTxt'];
							$specification_id = $rateData['specification_id'];
							$descriptionTxt   = $rateData['descriptionTxt'];
							$specificationTxt = $rateData['specificationTxt'];
							$brandTxt         = $rateData['brandTxt'];
							$reqNumberUnitTxt = $rateData['reqNumberUnitTxt'];
							$cost_profileTxt = $rateData['cost_profileTxt'];
							$cost_profile_id  = $rateData['cost_profile_id'];
							$apply_rate       = ($rateData['apply_rate'])?$rateData['apply_rate']:0;
							$supply_rate      = ($rateData['supply_rate'])?$rateData['supply_rate']:0;
							 
							//cal:defaultMeasurmentVal:
							$default_measurement_description = '';
							$default_measurement_description = str_replace('=','',$rateData['default_measurement_description']);
							$default_measurement_description = str_replace('L',$section_length,$default_measurement_description);
							 $default_measurement_description = str_replace('B',$section_breadth,$default_measurement_description);
							//echo "<br>";
							 $default_measurement_val = eval("return " . $default_measurement_description.";");
							 $default_measurement_val = ($default_measurement_val)?$default_measurement_val:0;
							//echo "<br>";
							//cal:calcLogicVal:
							$calc_logic_description = '';
							$calc_logic_description = str_replace('=','',$rateData['calc_logic_description']);
							$calc_logic_description = str_replace('UI',$default_measurement_val,$calc_logic_description);//this is user input;
							$calc_logic_description = str_replace('apply_rate',$apply_rate,$calc_logic_description);
							$calc_logic_description = str_replace('supply_rate',$supply_rate,$calc_logic_description);
							//echo "<br>";
							 $calc_logic_val = eval("return " . $calc_logic_description.";");
							//echo "<br>";
							$applyPrice =  ($apply_rate * $default_measurement_val);
							$supplyPrice = ($supply_rate * $default_measurement_val);
							
							//sql::insert section records;
							 $table = "jb080_order_boq_builder_details_mapp_section_service_list"; 
							 $data=array('idBoqBuild'=>$idBoqBuild,
							 			'order_id'=>$orderId,
										'section_mapp_id'=>$section_mapp_id,
										'section_id'=>$section_id,
										'sectionTxt'=>$section_name,
										'length'=>($section_length)?$section_length:0,
										'breadth'=> ($section_breadth)?$section_breadth:0,
										'job_id'=>$job_id,
										'typologyTxt'=>$typologyTxt,
										'scopeTxt'=>$scopeTxt,
										'specification_id'=>$specification_id,
										'descriptionTxt'=>$descriptionTxt,
										'specificationTxt'=>$specificationTxt,
										'brandTxt'=>$brandTxt,
										'cost_profile_id'=>$cost_profile_id,
										'cost_profileTxt'=>$cost_profileTxt,
										'reqNumber'=> $default_measurement_val,
										'reqNumberUnitTxt'=>$reqNumberUnitTxt,
										'applyRate'=>$apply_rate,
										'applyPrice'=>$applyPrice,
										'supplyRate'=>$supply_rate,
										'supplyPrice'=>$supplyPrice,
										'price'=> $calc_logic_val
										);
							$idMappSectionListBoqBuild = $this->Md_boqbuilder->insertData($table, $data); 
				 }//endForeach~CC;
			 }
			 
			 //Ifcase::Check this is Add Service Or Edit Service Request Call:
			 if(!empty($serviceRecdId))
			 {
				  //sql::get serviceRecdId details:
				  $rsGetBuildBoqServiceRecdDtls = ''; 
				  $queryStr = '';
				  $queryStr = "SELECT `reqNumber` FROM  `jb080_order_boq_builder_details_mapp_section_service_list` 
				  				WHERE `id`='".$serviceRecdId."' AND `idBoqBuild`='".$idBoqBuild."' AND `section_id`='".$section_id."'  ";
				  $rsGetBuildBoqServiceRecdDtls = $this->Md_boqbuilder->selectData($queryStr);	
				  //
				  $reqNumber = '';
				  $reqNumber = $rsGetBuildBoqServiceRecdDtls[0]['reqNumber'];
				  
				  //foreach~update:
				  foreach($arrRateList as $key=>$rateData)
				  {
					//varDef:
					$job_id           = $rateData['job_id'];
					$specification_id = $rateData['specification_id'];
					$cost_profile_id  = $rateData['cost_profile_id'];
					$apply_rate       = ($rateData['apply_rate'])?$rateData['apply_rate']:0;
					$supply_rate      = ($rateData['supply_rate'])?$rateData['supply_rate']:0;
					 
					/*//cal:defaultMeasurmentVal:
					$default_measurement_description = '';
					$default_measurement_description = str_replace('=','',$rateData['default_measurement_description']);
					$default_measurement_description = str_replace('L',$section_length,$default_measurement_description);
					 $default_measurement_description = str_replace('B',$section_breadth,$default_measurement_description);*/
					//echo "<br>";
					/* $default_measurement_val = eval("return " . $default_measurement_description.";");
					 $default_measurement_val = ($default_measurement_val)?$default_measurement_val:0;*/
					//echo "<br>";
					$default_measurement_val = $reqNumber;
					//cal:calcLogicVal:
					$calc_logic_description = '';
					$calc_logic_description = str_replace('=','',$rateData['calc_logic_description']);
					$calc_logic_description = str_replace('UI',$default_measurement_val,$calc_logic_description);//this is user input;
					$calc_logic_description = str_replace('apply_rate',$apply_rate,$calc_logic_description);
					$calc_logic_description = str_replace('supply_rate',$supply_rate,$calc_logic_description);
					//echo "<br>";
					$calc_logic_val = eval("return " . $calc_logic_description.";");
					//echo "<br>";
					$applyPrice =  ($apply_rate * $default_measurement_val);
					$supplyPrice = ($supply_rate * $default_measurement_val);

					//sql::update records;
					$queryStr = '';
				  	$queryStr = "UPDATE `jb080_order_boq_builder_details_mapp_section_service_list` SET 
								`idBoqBuild`=".$idBoqBuild.",
								`order_id`=".$orderId.",
								`section_mapp_id`=".$section_mapp_id.", 
								`section_id`=".$section_id.",
								`length`=".(($section_length)?$section_length:0).",
								`breadth`=".(($section_breadth)?$section_breadth:0).",
								`job_id`=".$job_id.",
								`specification_id`=".$specification_id.",
								`cost_profile_id`=".$cost_profile_id.",
								`reqNumber`=".$default_measurement_val.",
								`applyRate`=>".$apply_rate.",
								`applyPrice`=>".$applyPrice.",
								`supplyRate`=>".$supply_rate.",
								`supplyPrice`=>".$supplyPrice.",
								`price`=".$calc_logic_val." 
				  				WHERE `id`='".$serviceRecdId."' AND `idBoqBuild`='".$idBoqBuild."' ";			
					$updateaffectedRowCount = $this->Md_boqbuilder->updateData($queryStr); 
				 }//endForeach~CC;
			 }
			 echo 'success';die;
			//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
	}//endFunction;
	
	public function ajaxSectionServiceList()
	{
			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - serviceList
			$section_mapp_id  = $_POST['boqSectionItemMappId'];
			$section_id  = $_POST['boqSectionItemId'];
			$boqSectionItemIndex = $_POST['boqSectionItemIndex'];	
			$n = $boqSectionItemIndex;
			 
			 //sql::get section details from the sectionId:
			 $rsSectionDetails = $this->Md_boqbuilder->getBOQSectionDetailsFromSectionId($section_id);  
			 $rsSectionDetails = $rsSectionDetails[0];
			 $section_name = str_replace("'","&lsquo;",$rsSectionDetails['section']);
			 	
			 //array:getBuildBOQSectionListBYSectionIdAndIdBoqBuild:
			 $arrSectionServiceList  = array();
			 $arrSectionServiceList = $this->Md_boqbuilder->getBuildBOQSectionListBYSectionIdAndIdBoqBuild($section_mapp_id,$section_id,$idBoqBuild); 
			 
			 //foreach: 
			 $secionServiceListing = '';
			 $varTotalSectionPriceCost = 0;
			 foreach($arrSectionServiceList as $i=>$serviceRecd)
			 {	   
			        //var:
					$varTotalSectionPriceCost+=$serviceRecd['price'];
					$job_name = str_replace("'","&lsquo;",$serviceRecd['job_name']);  
				 
				$secionServiceListing.= '<tr id="tableTrTdSectionServiceScopeRowId'.$n.$serviceRecd['id'].'">
						<td style="width:250px;"><a href="javascript:void(0);" title="'.$serviceRecd['job_name'].'">
							'.$serviceRecd['job_name'].'</a><br />
							<a href="javascript:void(0);" data-toggle="modal" data-target="#myModalUpdateSpecsFromServiceScopeJobId" class="btn btn-mansi btn-sm"
				 style="font-size:8px; line-height: 0.5;" alt="Update Specs" 
				 onClick="funUpdateSpecs('.$serviceRecd['id'].','.$section_mapp_id.','.$section_id.','.$n.',\''.$section_name.'\','.$serviceRecd['job_id'].',\''.$job_name.'\');">
				 Update Specs</a>
						</td>
						<td style="width:400px;"><a href="javascript:void(0);" 
						data-toggle="tooltip" data-trigger="hover" data-html="true" data-placement="right" 
						title="<em><table class=\'tblClsToolTip\'>';
						if($serviceRecd['specification_descp']){
						$secionServiceListing.= '<tr><td>Description:</td><td>'.str_replace('"','&Prime;',$serviceRecd['specification_descp']).'</td></tr>';}
						if($serviceRecd['specification']){
						$secionServiceListing.= '<tr><td>Specification:</td><td>'.str_replace('"','&Prime;',$serviceRecd['specification']).'</td></tr>';}
						if($serviceRecd['brand']){
						$secionServiceListing.= '<tr><td>Brand:</td><td>'.str_replace('"','&Prime;',$serviceRecd['brand']).'</td></tr>';}
						$secionServiceListing.= '</table></em>">'.$serviceRecd['specification_descp'].'</a>
						</td>
						<td><a href="javascript:void(0);" data-toggle="tooltip" data-html="true" data-placement="right"  title="'.$serviceRecd['cost_profile'].'">
							'.substr($serviceRecd['cost_profile'],0,16).((strlen($serviceRecd['cost_profile'])>16)?'...':'').'</a>
						</td>
						<td style="text-align:right;">
						<input type="text" name="reqNumber" id="reqNumber" value="'.$serviceRecd['reqNumber'].'" placeholder="000" maxlength="3" 
						style="text-align: right;" oninput="this.value = this.value.replace(/[^0-9.]/g,\'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');"
						onblur="ajaxAutoSaveBOQ(\'boqSectionServiceUI\',\'reqNumber\',$(this).val(),'.$section_mapp_id.','.$section_id.','.$n.','.$serviceRecd['id'].','.$n.$serviceRecd['id'].');"  />
						<br /> &nbsp; <small>'.$serviceRecd['measurement_unit'].'</small>
						</td>
						<td style="text-align: right;" >'.number_format($serviceRecd['price'],2).'&nbsp;(INR)</td>
						<td><a href="javascript:void(0);" class="btn btn-info btn-sm" title="Remove Service" 
						onclick="funMinusSectionServiceRow('.$serviceRecd['id'].','.$section_mapp_id.','.$section_id.','.$n.');"
				style="background-color:#FFF;border-color:#243f71; color:#000000"><span class="fa fa-trash"></span></a></td>
					</tr>';
				}//endSubforeach;
			 echo 'success';
			 echo '|*|';
			 echo $secionServiceListing;	
			 echo '|*|';
			 echo number_format($varTotalSectionPriceCost,2);
			 echo '|*|';
			 //sql::get BOQ Total Price:
			 $rsGetBOQBuildTotalPrice = ''; 
			 $rsGetBOQBuildTotalPrice = $this->Md_boqbuilder->getBoqBuildTotalPriceFromMappSectionPriceList($idBoqBuild);  
			 $totalPriceBOQBuild = $rsGetBOQBuildTotalPrice[0]['total_price'];
			  
			 //sql::Update BOQ Total Price:
			 $rsUpdateBOQBuildTotalPrice = ''; 
			 $rsUpdateBOQBuildTotalPrice = $this->Md_boqbuilder->updateBoqBuildTotalPriceByIdBoqBuild($idBoqBuild,$totalPriceBOQBuild);
		 	  
			 //methode::update::BOQ prices:
			 $finalTotal = $this->updateBOQPrices($idBoqBuild);
			  	
			 echo number_format($totalPriceBOQBuild,2);
                         echo '|*|';
                         $additionalPricingArr['totalApplyPrice']='';
                         $additionalPricingArr['totalSupplyPrice']=$totalPriceBOQBuild;
                         $additionalPricingArr['totalPrice']='';
                         $additionalPricingArr['materialHandling']='';
                         $additionalPricingArr['packagingCharges']='';
                         $additionalPricingArr['cartageCharges']='';
                         $additionalPricingArr['octroiCharges']='';
                         $additionalPricingArr['labourCharges']='';
                         $additionalPricingArr['sumTotal']='';
                         $additionalPricingArr['gst']='';
                         $additionalPricingArr['finalTotal']='';
                        echo $this->additionalPricingSection($additionalPricingArr);
			 die;
			//echo "<pre>"; print_r($_POST); echo "</pre>"; die;
	}//endFunction;
	
	public function ajaxBuildBOQRemoveSectionService()
	{
			//varDefine:
			$idBoqBuild    = $_POST['idBoqBuild'];
			$orderId       = $_POST['orderId'];
			$userType      = $_POST['userType'];
			$userAccountId = $_POST['userAccountId'];
			//
			$actionType = $_POST['actionType'];//val - removeSectionService
			$serviceId  = $_POST['serviceId'];
			$section_mapp_id  = $_POST['boqSectionItemMappId'];
			$section_id  = $_POST['boqSectionItemId'];
			$boqSectionItemIndex = $_POST['boqSectionItemIndex'];	
			
			//sql::removeSection;
			$affectedRowCount = $this->Md_boqbuilder->deleteBuildBOQSectionServiceById($serviceId,$idBoqBuild);
			
			 echo 'success';
			 echo '|*|';
			 
			 //sql::get BOQ Total Price:
			 $rsGetBOQBuildTotalPrice = ''; 
			 $rsGetBOQBuildTotalPrice = $this->Md_boqbuilder->getBoqBuildTotalPriceFromMappSectionPriceList($idBoqBuild);  
			 $totalPriceBOQBuild = $rsGetBOQBuildTotalPrice[0]['total_price'];
			  
			 //sql::Update BOQ Total Price:
			 $rsUpdateBOQBuildTotalPrice = ''; 
			 $rsUpdateBOQBuildTotalPrice = $this->Md_boqbuilder->updateBoqBuildTotalPriceByIdBoqBuild($idBoqBuild,$totalPriceBOQBuild);
		 	 
			 //methode::update::BOQ prices:
			 $finalTotal = $this->updateBOQPrices($idBoqBuild);
			  	
			 echo number_format($totalPriceBOQBuild,2); 
			 die;
	
	}//endFunction;
	
	public function downloadBoqBuilder($orderId,$userType,$userAccountId,$type,$idBoqBuild)
	{
		//Ifcase:Page Validation:	
        if(in_array($userType,array('Customer','Agent'))==1)
		{
			//varDefine:
			$data['orderId'] = $orderId;
			$data['userType'] = $userType;
			$data['userAccountId'] = $userAccountId;
			$data['type'] = $type;
			$data['idBoqBuild'] = $idBoqBuild;
			
			//sql::get order details:
			$rsLeadProjectDtls = ''; 
			$queryStr = '';
			$queryStr = "SELECT `o_id`, `unique_oid`, `flag_lob` FROM  `jb080_order_dtl` WHERE `o_id`='".$orderId."' ";
			$rsLeadProjectDtls = $this->Md_boqbuilder->selectData($queryStr);	
			$data['rsLeadProjectDtls'] = $rsLeadProjectDtls[0];
			
			//sql:getBOQBuildDetails:
			$data['rsBoqBuildDetails']  = array();
			$data['rsBoqBuildDetails'] = $this->Md_boqbuilder->getBOQBuildDetails($idBoqBuild);
			$data['rsBoqBuildDetails'] = $data['rsBoqBuildDetails'][0];
			$data['rsBoqBuildDetails']['executionPartnerName'] = $this->getExecutionerNameById($data['rsBoqBuildDetails']['executionPartnerActorId']);
                        
			//sql:get boq build section header list:
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = array();
			$data['arrBOQBuildDtlsSectionHeaderWiseListing'] = $this->Md_boqbuilder->getBOQBuildDetailsMappSectionHeaderList($idBoqBuild);  
			$dataArr = '';
			$stringSectionArrList = array();
			foreach($data['arrBOQBuildDtlsSectionHeaderWiseListing'] as $key=>$dataArr)
			{	
				//var:
				//print_r($sectionHeaderName); die;  
				$section_mapp_id = $dataArr['section_mapp_id']; 
				$section_id = $dataArr['section_id']; 
				
				//array:getBuildBOQSectionListBYSectionIdAndIdBoqBuild:
				$arrSectionServiceList  = array();
				$arrSectionServiceList = $this->Md_boqbuilder->getBuildBOQSectionListBYSectionIdAndIdBoqBuild($section_mapp_id,$section_id,$idBoqBuild); 
				 
				$data['arrBOQBuildDtlsSectionHeaderWiseListing'][$key]['arrSectionServiceList'] = $arrSectionServiceList;
				$stringSectionArrList[] = $section_id; 
			}
			$data['stringSectionArrList'] = implode(',',$stringSectionArrList);
			//echo "<pre>"; print_r($data['arrBOQBuildDtlsSectionHeaderWiseListing']); echo "</pre>";
			
                        //Start::get approved milestone list
                        $milestoneList = $this->getMilestoneListAndTnC($orderId,$idBoqBuild); 
//			$queryStr = '';
//			$queryStr = "SELECT * FROM  `jb080_order_dtl_mapp_projectboqmilestonedtl` WHERE `order_id`='".$orderId."' AND `bom_id`= $idBoqBuild AND `status`='Approved' ";
//			$milestoneList = $this->Md_boqbuilder->selectData($queryStr);
                        $data['milestoneList'] = $milestoneList;
                        $data['noteTnC'] = $milestoneList?$milestoneList[0]['noteTnC']:'';
                        
                        //Start::get approved milestone list
                        $changeRequestList = $this->getChangeRequestList($orderId,$idBoqBuild);  
//			$queryStr = '';
//			$queryStr = "SELECT * FROM  `jb080_order_dtl_mapp_projectboqchangerequestdtl` WHERE `order_id`='".$orderId."' AND `bom_id`= $idBoqBuild AND `status`='Approved'";
//			$changeRequestList = $this->Md_boqbuilder->selectData($queryStr);
                        $data['changeRequestList'] = $changeRequestList;

			/*[start::track pdf download information:]*/
			/*[start::inster order docs logs]:-*/
			$data['download_Pdf_Filename'] = $rsLeadProjectDtls[0]['unique_oid'].'-Tentative-BOQ-Generated'.'-'.date('Ymd').'-'.time();
			$comment = "Tentative BOQ generated Quote donwloaded for BOQ id #".$idBoqBuild.".";
			//sql::insert section records;
			 $table = "jb080_order_doc_attachment_details"; 
			 $insertData =array('order_id'=>$orderId,
						'user_id'=>$userAccountId,
						'type_id'=>1,
						'comment'=>$comment,
						'org_file_name'=> $data['download_Pdf_Filename'], 
						'path_file_name'=>$data['download_Pdf_Filename'].'.pdf',
						'on_date'=>date('Y-m-d H:i:s')
						);
			$lastInsertId = $this->Md_boqbuilder->insertData($table, $insertData);  
			/*[end::inster order docs logs];*/
			/*[end::track pdf download information;]*/
			
			$this->load->library('pdf');
			$filename = $this->pdf->load_view(array('globalData'=>$data));

			
				 
		}else{
			redirect(base_url());exit;
		}//endIfcase;		  
	
	}//endFunction;
	
	public function additionalPricingSection($additionalPricingArr)
	{
	   
	   if($additionalPricingArr['totalPrice']!=$additionalPricingArr['finalTotal']){
		   return  "<div class='row'>
		<div class='col-md-12'>
			<h4>
				<strong>Additional Pricing</strong>
			</h4>
		</div>
		</div><div class='divId_SectionRow row'>
			  
			<div class='col-md-12'>
				<label>Total Apply Price:</label><span id='totalApplyPrice'>".number_format($additionalPricingArr['totalApplyPrice'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Total Supply Price:</label><span id='totalSupplyPrice'>".number_format($additionalPricingArr['totalSupplyPrice'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Total Cost:</label><span id='totalCost'>".number_format($additionalPricingArr['totalPrice'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Material Handling:</label><span id='materialHandling'>".number_format($additionalPricingArr['materialHandling'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Packaging Charges:</label><span id='packagingCharges'>". number_format($additionalPricingArr['packagingCharges'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Cartage/Transportation Charges:</label><span id='transportCharges'>". number_format($additionalPricingArr['cartageCharges'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Octroi/Municipal Charges:</label><span id='municipalCharges'>". number_format($additionalPricingArr['octroiCharges'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Labour/Union Charges:</label><span id='unionCharges'>". number_format($additionalPricingArr['labourCharges'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Sub Total:</label><span id='subTotal'>". number_format($additionalPricingArr['sumTotal'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>GST:</label><span id='gst'>". number_format($additionalPricingArr['gst'],2)."</span>
			</div>
			<div class='col-md-12'>
				<label>Total BOQ Cost:</label><span id='totalBoqCost'>". number_format($additionalPricingArr['finalTotal'],2)."</span>
			</div>
		
		</div>";
	   }
	   
	   return ;
	}
		
	
	public function updateBOQPrices($idBoqBuild)
	{	
		  //Sql::get summary price details:
		  $queryStr = '';
		  $queryStr = 'SELECT
						(SELECT SUM(`price`) FROM `jb080_order_boq_builder_details_mapp_section_service_list` 
						 WHERE `idBoqBuild`="'.$idBoqBuild.'") AS `totalPrice`, 
						(SELECT SUM(`applyPrice`) FROM `jb080_order_boq_builder_details_mapp_section_service_list` 
						 WHERE `idBoqBuild`="'.$idBoqBuild.'") AS `totalApplyPrice`,
						(SELECT SUM(`supplyPrice`) FROM `jb080_order_boq_builder_details_mapp_section_service_list` 
						 WHERE `idBoqBuild`="'.$idBoqBuild.'") AS `totalSupplyPrice`,
						(SELECT SUM(`materialHandling` + `packagingCharges` + `cartageCharges` + `octroiCharges` + `labourCharges`) 
						 FROM `jb080_order_boq_builder_details` WHERE `idBoqBuild`="'.$idBoqBuild.'") AS `otherCharges`,
						(SELECT `gst`
						 FROM `jb080_order_boq_builder_details` WHERE `idBoqBuild`="'.$idBoqBuild.'") AS `GST` ';
		  $rsSummaryPriceDtl = $this->Md_boqbuilder->selectData($queryStr);
 		  $rsSummaryPriceDtl =  $rsSummaryPriceDtl[0];
		  //
		  $totalApplyPrice  = $rsSummaryPriceDtl['totalApplyPrice'];
		  $totalSupplyPrice = $rsSummaryPriceDtl['totalSupplyPrice'];
		  $totalPrice       = ($totalApplyPrice + $totalSupplyPrice); 
		  $sumTotal         = ($totalPrice + $rsSummaryPriceDtl['otherCharges']); 
		  $finalTotal       = ($sumTotal + $rsSummaryPriceDtl['GST']); 
		  
		  //Update::Boq:
		  $queryStr = '';
		  $queryStr = 'UPDATE `jb080_order_boq_builder_details` SET  
					  `totalApplyPrice`= "'.$totalApplyPrice.'",
					  `totalSupplyPrice`= "'.$totalSupplyPrice.'",
					  `totalPrice`= "'.$totalPrice.'",
					  `sumTotal`= "'.$sumTotal.'",
					  `finalTotal`= "'.$finalTotal.'", 
					  `onDateTime`="'.date('Y-m-d H:i:s').'"  
			   WHERE `idBoqBuild`="'.$idBoqBuild.'" '; 
		  $numOfRowAffect = $this->Md_boqbuilder->updateData($queryStr);
		  return $finalTotal; 
 	}	
       
        public function getMilestoneListAndTnC($orderId,$idBoqBuild){
            $milestoneList = array(); 
            $queryStr = '';
            $queryStr = "SELECT * FROM  `jb080_order_dtl_mapp_projectboqmilestonedtl` WHERE `order_id`='".$orderId."' AND `bom_id`= $idBoqBuild AND `status`='Approved' ";
            $milestoneList = $this->Md_boqbuilder->selectData($queryStr);
//            $data['milestoneList'] = $milestoneList;
//            $data['noteTnC'] = $milestoneList?$milestoneList[0]['noteTnC']:'';
                        
            return $milestoneList;        
                       
        }
        
        public function getChangeRequestList($orderId,$idBoqBuild){
            //Start::get approved milestone list
            $changeRequestList = array(); 
            $queryStr = '';
            $queryStr = "SELECT * FROM  `jb080_order_dtl_mapp_projectboqchangerequestdtl` WHERE `order_id`='".$orderId."' AND `bom_id`= $idBoqBuild AND `status`='Approved'";
            $changeRequestList = $this->Md_boqbuilder->selectData($queryStr);
            
            return $changeRequestList;
        }
        public function getExecutionerNameById($id){
            $queryStr = '';
            $queryStr = "SELECT * FROM  `jb080_selfserve_admin` WHERE `id`='".$id."' LIMIT 1";
            $result = $this->Md_boqbuilder->selectData($queryStr);
            
            if(!empty($result)){
                return $result[0]['name'];
            }
            return;
        }
}//end::Class;

?>