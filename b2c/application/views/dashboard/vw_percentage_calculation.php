<?php 
$arr_percentage = array();


/*[start::Execution Phase]:*/
$varOveralPercntVal = 0;
$varOveralPercntNumeratorVal = 0;
$varOveralPercntDenometerVal = 0;
$StatusSummeryPercntNumeratorVal = array();
$StatusSummeryPercntDenometerVal = array();
if(!empty($milestone_details)){

foreach($milestone_details as $row){
    
    $on_date =  date('Y-m-d');
    $plan_start_date = $row['plan_start_date'];
    $plan_end_date = ($row['plan_revised_date'])?$row['plan_revised_date']:$row['plan_completion_date'];
    $percentage  = 0;
    $varPlanDays = 0;
	//
	$newVarStartDate = new DateTime($plan_start_date);
	$newVarEndDate   = new DateTime($plan_end_date);
	$diff = $newVarStartDate->diff($newVarEndDate)->format("%r%a");
	$varPlanDays = ($diff + 1);
	//
    /**echo $row['milestone_plan_id']."=varPlanDays=>".$varPlanDays = (strtotime($plan_end_date) - strtotime($plan_start_date)) / (60 * 60 * 24);
	echo "<br>";**/
	
    if(empty($StatusSummeryPercntNumeratorVal[$row['id']]))
    $StatusSummeryPercntNumeratorVal[$row['id']]='';
    if(empty($StatusSummeryPercntDenometerVal[$row['id']]))
    $StatusSummeryPercntDenometerVal[$row['id']]='';
    //ifcase;
    if(empty($row['plan_revised_date'])){        
        $completion_date = date('Y-m-d',strtotime($row['plan_completion_date']));
    }else{
        $completion_date = date('Y-m-d',strtotime($row['plan_revised_date']));
    } 

    //Ifcase:
	if(empty($row['actual_completion_date']))
	{		
			/*
			* Previously we were showing the 0% till the time system not get the `actual_completion_date`.
			* Once system have `actual_completion_date` then we were shows the 100% completion.
			* //$percentage = number_format(0);          
			*/
			
			/*
			* Now shows the percentage as per days getting completed. 
			*/
			
			if(strtotime(date('Y-m-d')) <= strtotime($plan_start_date))
			{
				$percentage = number_format(0);          
			}
			else if((strtotime($plan_start_date)< strtotime(date('Y-m-d'))) && strtotime(date('Y-m-d')) < strtotime($plan_end_date))
			{
				//var:
				$tmpVarStartDate        = '';
				$tmpVarCurrentDate      = '';
				$daysDiffStartCurntDate = '';
				
				//cal:
				$tmpVarStartDate = new DateTime($plan_start_date);
				$tmpVarCurrentDate   = new DateTime(date('Y-m-d'));
				$daysDiffStartCurntDate = $tmpVarStartDate->diff($tmpVarCurrentDate)->format("%r%a");
					
				$percentage = (($daysDiffStartCurntDate / $varPlanDays) * 100);      
				
			}else{
								
				$percentage = ((($varPlanDays - 1) / $varPlanDays) * 100);
			}				
            
        
        }else  if(!empty($row['actual_completion_date'])){
            /*Case::ELSE If [Completed Date is NOT NULL]  Milestone % Completion = 100%*/        
            $percentage = 100;
            
    }//end::Ifelse;
    
    /*[start::calculate overal progress percentage % value]:*/
        $varOveralPercntNumeratorVal = ($varOveralPercntNumeratorVal + ($percentage*$varPlanDays));
        $varOveralPercntDenometerVal = ($varOveralPercntDenometerVal + $varPlanDays);
    /*[end::calculate overal progress percentage % value];*/
   
     /*[start::calculate status summery percentage % value]:*/
       $StatusSummeryPercntNumeratorVal[$row['id']] = ($StatusSummeryPercntNumeratorVal[$row['id']] + ($percentage * $varPlanDays));
       $StatusSummeryPercntDenometerVal[$row['id']] = ($StatusSummeryPercntDenometerVal[$row['id']] + $varPlanDays);

		/*if($percentage == 100){
        $StatusSummeryPercntNumeratorVal[$row['id']] =  ($StatusSummeryPercntNumeratorVal[$row['id']] + 1);
        }else{
        $StatusSummeryPercntNumeratorVal[$row['id']] =  $StatusSummeryPercntNumeratorVal[$row['id']];
        }
        $StatusSummeryPercntDenometerVal[$row['id']] = ($StatusSummeryPercntDenometerVal[$row['id']] + 1); 
        //$StatusSummeryPercntVal[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal[$row['id']] / $StatusSummeryPercntDenometerVal[$row['id']]));
		$StatusSummeryPercntVal[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal[$row['id']] / $StatusSummeryPercntDenometerVal[$row['id']])*100); 
		*/    
        $StatusSummeryPercntVal[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal[$row['id']] / $StatusSummeryPercntDenometerVal[$row['id']])); 
		
     /*[end::calculate overal status summery percentage % value];*/
    $arr_percentage[$row['milestone_plan_id']] = $percentage; 
}
/*[end::primaryForeach]:*/
$varOveralPercntNumeratorVal;
$varOveralPercntDenometerVal;
 $varOveralPercntVal = number_format(($varOveralPercntNumeratorVal / $varOveralPercntDenometerVal));    
}


/*[start::Procurement Phase]:*/
$varOveralPercntVal_procurement = 0;
$varOveralPercntNumeratorVal = 0;
$varOveralPercntDenometerVal = 0;
$StatusSummeryPercntNumeratorVal_procurement = array();
$StatusSummeryPercntDenometerVal_procurement = array();
if(!empty($milestone_details_procurement)){
foreach($milestone_details_procurement as $row){
    
    $on_date =  date('Y-m-d');
    $plan_start_date = $row['plan_start_date'];
    $plan_end_date = ($row['plan_revised_date'])?$row['plan_revised_date']:$row['plan_completion_date'];
    $percentage  = 0;
    $varPlanDays = 0;
	//
	$newVarStartDate = new DateTime($plan_start_date);
	$newVarEndDate   = new DateTime($plan_end_date);
	$diff = $newVarStartDate->diff($newVarEndDate)->format("%r%a");
	$varPlanDays = ($diff + 1);
	
	//
    /**echo $row['milestone_plan_id']."=varPlanDays=>".$varPlanDays = (strtotime($plan_end_date) - strtotime($plan_start_date)) / (60 * 60 * 24);
	echo "<br>";**/
	
    if(empty($StatusSummeryPercntNumeratorVal_procurement[$row['id']]))
    $StatusSummeryPercntNumeratorVal_procurement[$row['id']]='';
    if(empty($StatusSummeryPercntDenometerVal_procurement[$row['id']]))
    $StatusSummeryPercntDenometerVal_procurement[$row['id']]='';
    //ifcase;
    if(empty($row['plan_revised_date'])){        
        $completion_date = date('Y-m-d',strtotime($row['plan_completion_date']));
    }else{
        $completion_date = date('Y-m-d',strtotime($row['plan_revised_date']));;
    } 

    //Ifcase:
	if(empty($row['actual_completion_date']))
	{
            
           /*
			* Previously we were showing the 0% till the time system not get the `actual_completion_date`.
			* Once system have `actual_completion_date` then we were shows the 100% completion.
			* //$percentage = number_format(0);          
			*/
			
			/*
			* Now shows the percentage as per days getting completed. 
			*/
			
			if(strtotime(date('Y-m-d')) <= strtotime($plan_start_date))
			{
				$percentage = number_format(0);     
				    
			}
			else if((strtotime($plan_start_date)< strtotime(date('Y-m-d'))) && strtotime(date('Y-m-d')) < strtotime($plan_end_date))
			{
				//var:
				$tmpVarStartDate        = '';
				$tmpVarCurrentDate      = '';
				$daysDiffStartCurntDate = '';
				
				//cal:
				$tmpVarStartDate = new DateTime($plan_start_date);
				$tmpVarCurrentDate   = new DateTime(date('Y-m-d'));
				$daysDiffStartCurntDate = $tmpVarStartDate->diff($tmpVarCurrentDate)->format("%r%a");
				$percentage = (($daysDiffStartCurntDate / $varPlanDays) * 100);      
					
			}else{
								
				$percentage = ((($varPlanDays - 1) / $varPlanDays) * 100);
				    
			}				
              
      
        }else  if(!empty($row['actual_completion_date'])){
            /*Case::ELSE If [Completed Date is NOT NULL]  Milestone % Completion = 100%*/        
            $percentage = 100;
            
    }//end::Ifelse;
    
    /*[start::calculate overal progress percentage % value]:*/
   
        $varOveralPercntNumeratorVal = ($varOveralPercntNumeratorVal + ($percentage*$varPlanDays));
        $varOveralPercntDenometerVal = ($varOveralPercntDenometerVal + $varPlanDays);

    /*[end::calculate overal progress percentage % value];*/
   
     /*[start::calculate status summery percentage % value]:*/
     
        $StatusSummeryPercntNumeratorVal_procurement[$row['id']] = ($StatusSummeryPercntNumeratorVal_procurement[$row['id']] + ($percentage*$varPlanDays));
        $StatusSummeryPercntDenometerVal_procurement[$row['id']] = ($StatusSummeryPercntDenometerVal_procurement[$row['id']] + $varPlanDays);

		/*if($percentage == 100){
        $StatusSummeryPercntNumeratorVal_procurement[$row['id']] =  ($StatusSummeryPercntNumeratorVal_procurement[$row['id']] + 1);
        }else{
        $StatusSummeryPercntNumeratorVal_procurement[$row['id']] =  $StatusSummeryPercntNumeratorVal_procurement[$row['id']];
        }
        $StatusSummeryPercntDenometerVal_procurement[$row['id']] = ($StatusSummeryPercntDenometerVal_procurement[$row['id']] + 1); 
        //$StatusSummeryPercntVal_procurement[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_procurement[$row['id']] / $StatusSummeryPercntDenometerVal_procurement[$row['id']]));    
        $StatusSummeryPercntVal_procurement[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_procurement[$row['id']] / $StatusSummeryPercntDenometerVal_procurement[$row['id']])*100);*/
		$StatusSummeryPercntVal_procurement[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_procurement[$row['id']] / $StatusSummeryPercntDenometerVal_procurement[$row['id']]));    
  		
     /*[end::calculate overal status summery percentage % value];*/
    $arr_percentage[$row['milestone_plan_id']] = $percentage;
}
/*[end::primaryForeach]:*/
 $varOveralPercntVal_procurement = number_format(($varOveralPercntNumeratorVal / $varOveralPercntDenometerVal));    
}





/*[start::Design Phase]:*/
$varOveralPercntVal_design = 0;
$varOveralPercntNumeratorVal = 0;
$varOveralPercntDenometerVal = 0;
$StatusSummeryPercntNumeratorVal_design = array();
$StatusSummeryPercntDenometerVal_design = array();
if(!empty($milestone_details_design)){
foreach($milestone_details_design as $row){
    
    $on_date =  date('Y-m-d');
    $plan_start_date = $row['plan_start_date'];
    $plan_end_date = ($row['plan_revised_date'])?$row['plan_revised_date']:$row['plan_completion_date'];
    $percentage  = 0;
    $varPlanDays = 0;
	//
	$newVarStartDate = new DateTime($plan_start_date);
	$newVarEndDate   = new DateTime($plan_end_date);
	$diff = $newVarStartDate->diff($newVarEndDate)->format("%r%a");
	$varPlanDays = ($diff + 1);
	//
    /**echo $row['milestone_plan_id']."=varPlanDays=>".$varPlanDays = (strtotime($plan_end_date) - strtotime($plan_start_date)) / (60 * 60 * 24);
	echo "<br>";**/
	
    if(empty($StatusSummeryPercntNumeratorVal_design[$row['id']]))
    $StatusSummeryPercntNumeratorVal_design[$row['id']]='';
    
    if(empty($StatusSummeryPercntDenometerVal_design[$row['id']]))
    $StatusSummeryPercntDenometerVal_design[$row['id']]='';
    //ifcase;
    if(empty($row['plan_revised_date'])){        
        $completion_date = date('Y-m-d',strtotime($row['plan_completion_date']));
    }else{
        $completion_date = date('Y-m-d',strtotime($row['plan_revised_date']));;
    } 

    //Ifcase:
	if(empty($row['actual_completion_date']))
	{
            
              /*
			* Previously we were showing the 0% till the time system not get the `actual_completion_date`.
			* Once system have `actual_completion_date` then we were shows the 100% completion.
			* //$percentage = number_format(0);          
			*/
			
			/*
			* Now shows the percentage as per days getting completed. 
			*/
			
			if(strtotime(date('Y-m-d')) <= strtotime($plan_start_date))
			{
				$percentage = number_format(0);          
			}
			else if((strtotime($plan_start_date)< strtotime(date('Y-m-d'))) && strtotime(date('Y-m-d')) < strtotime($plan_end_date))
			{
				//var:
				$tmpVarStartDate        = '';
				$tmpVarCurrentDate      = '';
				$daysDiffStartCurntDate = '';
				
				//cal:
				$tmpVarStartDate = new DateTime($plan_start_date);
				$tmpVarCurrentDate   = new DateTime(date('Y-m-d'));
				$daysDiffStartCurntDate = $tmpVarStartDate->diff($tmpVarCurrentDate)->format("%r%a");
					
				$percentage = (($daysDiffStartCurntDate / $varPlanDays) * 100);      
				
			}else{
								
				$percentage = ((($varPlanDays - 1) / $varPlanDays) * 100);
			}				
            
        
        }else  if(!empty($row['actual_completion_date'])){
            /*Case::ELSE If [Completed Date is NOT NULL]  Milestone % Completion = 100%*/        
            $percentage = 100;
            
    }//end::Ifelse;
    
    /*[start::calculate overal progress percentage % value]:*/
   
        $varOveralPercntNumeratorVal = ($varOveralPercntNumeratorVal + ($percentage*$varPlanDays));
        $varOveralPercntDenometerVal = ($varOveralPercntDenometerVal + $varPlanDays);

    /*[end::calculate overal progress percentage % value];*/
   
     /*[start::calculate status summery percentage % value]:*/
     
        $StatusSummeryPercntNumeratorVal_design[$row['id']] = ($StatusSummeryPercntNumeratorVal_design[$row['id']] + ($percentage*$varPlanDays));
        $StatusSummeryPercntDenometerVal_design[$row['id']] = ($StatusSummeryPercntDenometerVal_design[$row['id']] + $varPlanDays);

        /*if($percentage == 100){
        $StatusSummeryPercntNumeratorVal_design[$row['id']] =  ($StatusSummeryPercntNumeratorVal_design[$row['id']] + 1);
        }else{
        $StatusSummeryPercntNumeratorVal_design[$row['id']] =  $StatusSummeryPercntNumeratorVal_design[$row['id']];
        }
        $StatusSummeryPercntDenometerVal_design[$row['id']] = ($StatusSummeryPercntDenometerVal_design[$row['id']] + 1); 
        //$StatusSummeryPercntVal_design[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_design[$row['id']] / $StatusSummeryPercntDenometerVal_design[$row['id']]));
        $StatusSummeryPercntVal_design[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_design[$row['id']] / $StatusSummeryPercntDenometerVal_design[$row['id']])*100);*/  
		$StatusSummeryPercntVal_design[$row['id']] = number_format(($StatusSummeryPercntNumeratorVal_design[$row['id']] / $StatusSummeryPercntDenometerVal_design[$row['id']]));     /*[end::calculate overal status summery percentage % value];*/
    $arr_percentage[$row['milestone_plan_id']] = $percentage;
}
/*[end::primaryForeach]:*/
 $varOveralPercntVal_design = number_format(($varOveralPercntNumeratorVal / $varOveralPercntDenometerVal));    
}





?>