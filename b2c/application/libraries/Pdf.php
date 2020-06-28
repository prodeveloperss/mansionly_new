<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**


* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library



*/

require_once APPPATH.'../assets/domhtmltopdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
class Pdf extends DOMPDF
{
/**
 * Get an instance of CodeIgniter
 *
 * @access  protected
 * @return  void
 */
protected function ci()
{
    return get_instance();
}

/**
 * Load a CodeIgniter view into domPDF
 *
 * @access  public
 * @param   string  $view The view to load
 * @param   array   $data The view data
 * @return  void
 */
public function load_view($data = array())
{
		$dompdf = new Dompdf();
	   // $html = $this->ci()->load->view($view, $data, TRUE);
	
		//define: 
		$globalData = $data['globalData'];
		$rsBoqBuildDetails = $globalData['rsBoqBuildDetails'];
//		echo "<pre>"; print_r($globalData); echo "</pre>";die;
		
                if($rsBoqBuildDetails['status']=='7'){
                    $boq_generated_txt ='<h3>BOQ generated at '.date('d/m/Y H:i:s',strtotime($globalData['rsBoqBuildDetails']['onDateTime'])).'</h3>';
                    $starting_from_txt = '<h4>'.number_format($globalData['rsBoqBuildDetails']['finalTotal'],2).' (INR) </h4>';
                }else{
                    $boq_generated_txt ='<h3>Tentative BOQ generated at '.date('d/m/Y H:i:s',strtotime($globalData['rsBoqBuildDetails']['onDateTime'])).'</h3>';
                    $starting_from_txt = '<h4>Starting from: '.number_format($globalData['rsBoqBuildDetails']['finalTotal'],2).' (INR) </h4>';
                }
		
		/*[Start::SectionHeaderListing:]*/
		$sectionListing = '';
		$n = 0;
		foreach($globalData['arrBOQBuildDtlsSectionHeaderWiseListing'] as $key=>$sectionHeaderRecd)
		{
			//var:
			$n = $key+1;
			$varTotalSectionPriceCost = 0;
			$sectionListing.= '<br><br><table>
								<tr><td><h2>'.$sectionHeaderRecd['section_name'].'&nbsp;&nbsp;&nbsp;</h2></td><td> <strong >Length (ft.):&nbsp;'.$sectionHeaderRecd['section_length'].'
							   &nbsp;&nbsp;&nbsp;</strong></td><td><strong  >Breadth (ft.):&nbsp;'.$sectionHeaderRecd['section_breadth'].'</strong></td></tr></table>';
			
			$sectionListing.= '<table id="customers" class="table table-bordered table-striped">
								<tbody id="tableListOfSectionServiceScopeTbodyId'.$n.'">';
				
			if(!empty($sectionHeaderRecd['arrSectionServiceList']))
			{
				foreach($sectionHeaderRecd['arrSectionServiceList'] as $i=>$serviceRecd)
				{	//var:
					$varTotalSectionPriceCost+=$serviceRecd['price'];  
				 
					$sectionListing.= '<tr id="tableTrTdSectionServiceScopeRowId'.$n.$serviceRecd['id'].'">
											<td style="width:145px" >'.$serviceRecd['scopeTxt'].'</td>
											<td style="width:215px">';
										if($serviceRecd['descriptionTxt']){	
											$sectionListing.= '	Description:&nbsp;'.$serviceRecd['descriptionTxt'].'<br /><br />';
										}
										if($serviceRecd['specificationTxt']){
										$sectionListing.= '	Specification:&nbsp;'.$serviceRecd['specificationTxt'].'<br /><br />';
										}
										if($serviceRecd['brandTxt']){
										$sectionListing.= 'Brand:&nbsp;'.$serviceRecd['brandTxt']; 
										}	
					$sectionListing.= '</td>
											<td>'.$serviceRecd['cost_profileTxt'].'</td>
											<td style="text-align:right;">'.$serviceRecd['reqNumber'].'<br /> &nbsp; <small>'.$serviceRecd['reqNumberUnitTxt'].'</small>
											</td>
											<td style="text-align: right;" >'.number_format($serviceRecd['price'],2).'&nbsp;(INR)</td>
									   </tr>';
				}//endSubforeach;
				 
			}//end~~empty($sectionHeaderRecd['arrSectionList']);
				$sectionListing.= '</tbody>
			</table>';
			 $sectionListing.= '<br><h3 style="text-align:right">Section Cost:&nbsp;'.number_format($varTotalSectionPriceCost,2).'</h3>';
		}
		/*[End::SectionHeaderListing:]*/ 	 	
		$milestoneList ='';
                if(!empty($globalData['milestoneList'])){
                    $milestoneList ="<br><br><h2><b><u>Milestone</u></b></h2><table id='customers'><thead><tr><td>Milestone Stage</td><td>Milestone Description</td><td>Percentage Payment</td></tr></thead><tbody>";
                    foreach ($globalData['milestoneList'] as $milestone){
                        $milestoneList.="<tr> <td>".$milestone['milestone_stage']."</td> <td>".$milestone['milestone_desc']."</td> <td>".$milestone['milestone_percent']."</td> </tr>";
                    }
                    $milestoneList.="</tbody></table>";
                }
                $tnc = '';
                if(!empty($globalData['noteTnC'])){
                    $tnc = "<br><br><h2><b><u>Terms and Conditions</u></b></h2>";
                    $tnc .= "<table id='customers'><tbody><tr><td>".$globalData['noteTnC']."</td></tr></tbody></table>";
                }
                
                $changeRequestList ='';
                if(!empty($globalData['changeRequestList'])){
                    $changeRequestList ="<br><br><h2><b><u>Change Requests</u></b></h2><table id='customers'><thead><tr><td>Description</td><td>Amount</td></tr></thead><tbody>";
                    foreach ($globalData['changeRequestList'] as $changeRequest){
                        $changeRequestList.="<tr> <td>".$changeRequest['description']."</td> <td>".$changeRequest['amount']."</td></tr>";
                    }
                    $changeRequestList.="</tbody></table>";
                }

                $additionalPricing ='';
                if($rsBoqBuildDetails['totalPrice']!=$rsBoqBuildDetails['finalTotal']){
                    $additionalPricing='<h2><b><u>Additional Pricing</u></b></h2>';
                    $additionalPricing.='<table class="table">';
                    $additionalPricing.='<tr><td>Total Apply Price: '.number_format($rsBoqBuildDetails['totalApplyPrice'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Total Supply Price: '.number_format($rsBoqBuildDetails['totalSupplyPrice'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Total Cost: '.number_format($rsBoqBuildDetails['totalPrice'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Material Handling: '.number_format($rsBoqBuildDetails['materialHandling'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Packaging Charges: '.number_format($rsBoqBuildDetails['packagingCharges'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Cartage/Transportation Charges: '.number_format($rsBoqBuildDetails['cartageCharges'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Octroi/Municipal Charges: '.number_format($rsBoqBuildDetails['octroiCharges'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Labour/Union Charges: '.number_format($rsBoqBuildDetails['labourCharges'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Sub Total: '.number_format($rsBoqBuildDetails['sumTotal'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>GST: '.number_format($rsBoqBuildDetails['gst'],2).'</td></tr>';
                    $additionalPricing.='<tr><td>Total BOQ Cost: '.number_format($rsBoqBuildDetails['finalTotal'],2).'</td></tr>';
                    $additionalPricing.='</tbody></table>';
                }
                
                
	/**[start::PDF creation operation:]**/
	$html_to_pdf = '';
	$html_to_pdf = '
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
	<title>BOQ</title>
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
	#customers {
	  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	  font-size:12px;
	}
	
	#customers td, #customers th {
	  border: 1px solid #ddd;
	  padding: 8px;
	  vertical-align:top;
	}
	
	#customers tr:nth-child(even){background-color: #f2f2f2;}
	
	#customers tr:hover {background-color: #ddd;}
	
	#customers th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #4CAF50;
	  color: white;
	}
	</style>
	</head>
	<body>';
	
	 
	 $html_to_pdf.= '<div style="margin:0px auto; width:700px; font-family: \'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:10px; color:#333;" >
	  
	  
	  <div style="width:100%; margin-top:5px;">
		<table style="border-collapse:collapse; width:100%; ">
		  <tbody>
			<tr>
			  <td style="text-align:center;width:100%; vertical-align:top;">
			   <img src="'.APPPATH.'/../assets/img/logoinvioce.png" alt="logo" width="100">
			   <br><br><span style="font-size:18px;border-bottom:1px solid #000;"></span></td>
				<tr>
				</tbody>
				</table>
				
				<table style="border-collapse:collapse; width:100%;font-size:12px; ">
					<tbody>
						<tr><td><h2><u>BOQ Details</u></h2></td></tr>
						<tr><td>'.$globalData['rsBoqBuildDetails']['boqName'].($rsBoqBuildDetails['executionPartnerName']?'<br>Partner Name -'.$rsBoqBuildDetails['executionPartnerName']:'').'</td><td style="text-align:right">'.$starting_from_txt.'</td></tr>
					</tbody>
				</table>
				'.$sectionListing.$additionalPricing.$milestoneList.$tnc.$changeRequestList.'
				<br /> 
				'.$boq_generated_txt.'
				</div>
			';
	$html_to_pdf.= ' 
	</body>
	</html>';
	//echo $html_to_pdf;  die;
	
	$var_download_pdf_file_name = $globalData['download_Pdf_Filename'];
	$var_download_pdf_file_name_with_ext = $globalData['download_Pdf_Filename'].".pdf";
	
	
	
	
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->set_option('enable_html5_parser', TRUE);

	$dompdf->loadHtml($html_to_pdf);
	// (Optional) Setup the paper size and orientation
	//$dompdf->setPaper('A4', 'landscape');
	$dompdf->setPaper('A4', 'portrait');
	
	// Render the HTML as PDF
	$dompdf->render();
	
	// You can now write $pdf to disk, store it in a database or stream it
	// to the client.
	$pdf = $dompdf->output();

     /*Local::Store PDF File::Methode:
	file_put_contents(dirname(__FILE__) . '/../../../../JB080Selfserve/selfserve/media/order-docs/'.$var_download_pdf_file_name_with_ext,$pdf);*/
	
	/*Staging::Store PDF File::Methode:*/
	file_put_contents(dirname(__FILE__) . '/../../../../selfserve/media/order-docs/'.$var_download_pdf_file_name_with_ext,$pdf);
	
	/*Production::Store PDF File::Methode:
	file_put_contents(dirname(__FILE__) . '/../../../selfserve/media/order-docs/'.$var_download_pdf_file_name_with_ext,$pdf);*/
	
    /**[end::PDF creation operation;]**/

    // Output the generated PDF to Browser
    $dompdf->stream($var_download_pdf_file_name);

    // Output the generated PDF (1 = download and 0 = preview)
    $dompdf->stream("codex",array("Attachment"=>1));

	//download pdf
	//file_put_contents(APPPATH . '/../adminoffice/admin-media/invoices/'.$var_download_pdf_file_name_with_ext,$pdf);
	/**[end::PDF creation operation;]**/
	return $var_download_pdf_file_name_with_ext;
}//endFunction;

}//endClass;