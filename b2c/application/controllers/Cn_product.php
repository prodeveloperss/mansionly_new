<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cn_product extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
        $this->load->model('Md_product');
        $this->load->model('Md_category');
        $this->load->model('Md_database');
        $this->session_management_lib->index();
        
    }
   
   
 
    public function getSubCatgList($cat_id)
	{
		

		
		if($cat_id != null && $cat_id != "") {
			$ProductCatg='';
			$result = $this->getCatgchildRecordForProduct($cat_id,$ProductCatg);

			//print_r( $result);
			$jsonData = array();
			$jsonData = explode(",",$result);
			foreach($jsonData as $link)
			{
			    if($link == ' ')
			    {
			        unset($link);
			    }
			}
			$jsonData = array_filter( $jsonData );
			$jsonData = array_slice( $jsonData, 0 ) ;
                        $jsonFinalData = implode(',', $jsonData );
           
			return $jsonFinalData;
		} 
	}
        
    public function getCatgchildRecordForProduct($parentcatg_id,$ProductCatg)
	{
		$requestData = array();
		$result = $this->Md_category->getProductCatgListParentwise($parentcatg_id);
		//var_dump($result);
		if (count($result)>0)
		{
			$jsonData = array();
			foreach ($result as $ProductCatgList)
			{
				$ProductCatg = $ProductCatg.",". $ProductCatgList->cat_id;
				$childData = array();
				$childData = $this->getCatgchildRecordForProduct($ProductCatgList->cat_id,$ProductCatg);
				//var_dump($childData);
				if(!empty($childData))
				{
					$ProductCatg = $ProductCatg.",". $childData;
				}
				//$jsonDataMain[] = $ProductCatg;
			}
			$childcatids = array();
			$childcatids = array_unique(explode(",",$ProductCatg));
			$ProductCatg = implode(",",$childcatids);
			return $ProductCatg;
		}
	}
    
    
    
    
    
    public function featured_old_to_new_url($featured_id) {
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
       
        if($featured_id == "1"){
        redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))).'/fl/1?q=l','location',301);
        }else{
        redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Collectibles'))).'/fl/2?q=l','location',301);
        }
       exit();
    }  
    public function productListByfeatured($featured_name="",$featured_id) {
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
//        $data['page_title'] = "Featured";
        $data['leadGenFromSliderPageType'] = 'featured-list-page'; 
        $data['leadGenFromSliderPageUniqueId'] = $featured_id;
        $data['page_name'] = 'featured';
        $data['meta_keywords'] = '';
       
        $data['canonicalLink'] = '';
        if($featured_id == "1"){
        $data['page_title'] = 'Shop for Decorative Art Products @Mansionly.com';
        $data['page_heading'] = 'Decorative Art'; 
        $data['breadCrumb']    = '<li><a href="'.base_url().'">Home</a>
                                  <li><a href="#">Lifestyle Products</a></li>
                                  </li><li class="active">Decorative Art</li>';
        //$data['meta_title'] = 'Shop for Decorative Art Products @Mansionly.com';
        $data['meta_description'] ='Exclusive Decorative Art products online. Shop for exclusive home decor products by global brands online @Mansionly.com.';
        }else{
          $data['page_title'] = 'Shop for Collectibles Products @Mansionly.com';
          $data['page_heading'] = 'Collectibles';  
          $data['breadCrumb']    = '<li><a href="'.base_url().'">Home</a></li>
                                    <li><a href="#">Lifestyle Products</a></li>
                                    <li class="active">Collectibles</li>';
        //$data['meta_title'] = 'Shop for Collectibles Products @Mansionly.com';
        $data['meta_description'] ='Exclusive Collectibles products online. Shop for exclusive home decor products by global brands online @Mansionly.com.';
        }
       
        if($featured_id == "1"){
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Decorative Art'))).'/fl/1" />';
        }else{
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', 'Collectibles'))).'/fl/2" />';
        }

        $offset = 0;
        /*[start::Assign limit in session for back activity]*/
        $session_limit = $this->session_management_lib->session_limit;
        if($session_limit){
            $limit = $session_limit;          
        }
        /*[End::Assign limit in session for back activity]*/
        else{
        $limit = 24;
        }
        $data['limit'] = $limit;
        $data['cat_id'] = $featured_id;
        
        $data['totalCount']   = $this->Md_product->productTotalCountByFeaturedId($featured_id);       
        $data['product_list'] = $this->Md_product->productListByfeatured($featured_id,$offset,$limit);
        
         /*Start:: get favorite list of customer*/
                $data['customerFavoriteProduct']=array();
                 if(!empty($_SESSION['customer_id'])){
                     $table = 'customer_favorites_list';
                     $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'marketseller');
                     $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
                     foreach ($result as $row){
                         $data['customerFavoriteProduct'][]=$row['favorites_record_id'];
                     }
                } 
            /*End:: get favorite list of customer*/

        $this->load->view('product/vw_product_list', $data);
    }  
    
    public function ajaxGetProductByFeaturedId() {
        
        /*Arrray for the replacement in url*/
       $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        $featured_id = $_POST['cat_id'];
        $offset = $_POST['offset'];
       
        $limit = 24;
        $incremented_offset = ($offset + $limit);
        $Favoritestring = $_POST['customerFavoriteProduct'];
        $customerFavoriteProduct = explode(',',$Favoritestring);
        $q = $_POST['q'];
        $id = $_POST['id'];
        $page = $_POST['page'];
         /*get::subcat id list*/
       
       
       /*get::Product list by $subCatIdList */
        $product_list = $this->Md_product->productListByFeatured($featured_id,$offset,$limit);

       echo $incremented_offset.'|*|*|';  
       
      foreach ($product_list as $key => $row) { ?>  
            
            <div class="col-md-4 col-sm-4 col-xs-12 extraPd-brand">
              <div class="brandBox clearfix">
              <a class="likeico" href="javascript:void(0);" ><i id="<?php echo 'marketseller'.$row['product_id'];?>" class="fa fa-heart <?php if(in_array($row['product_id'], $customerFavoriteProduct)){echo ' heartRed';}?>" aria-hidden="true" onclick="saveFavorite('Product','marketseller',<?php echo $row['product_id'];?> );"></i></a>    
                <div class="brand-wrap">
                  <div class="BrandImg-explore brandBox"> 
                      <!--<a href="<?php echo base_url(); ?>product-details/<?php echo $row['product_id']; ?>/<?php echo urlencode($row['product_name']) ;?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page;?>">--> 
                      <a href="<?php echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($row['product_name'])))).'/pdp/'.$row['product_id']; ?>?q=<?php echo $q; ?>&id=<?php echo $id; ?>&page=<?php echo $page; ?>"> 
                          <img src="<?php echo image_url; ?>media/images/ecom/product/<?php echo $row['product_image'];?>" alt="brandimg" style="background-color: #fff;display: none;" onload="$(this).fadeIn(1500);" alt="<?php echo $row['product_name'];?>"> 
                      </a>
                  </div>
                  <div class="BrandName"> <?php echo $row['product_name'];?> </div>
                </div>
              </div>
            </div>
            <?php if(($key+1) % 3 =='0'){ ?>
            <div class="clearfix "></div>
            <div class="col-sm-12">
                <div class="gradiant-otr clearfix">
                    <div class="dividerGradiant clearfix"></div>
                </div>
            </div>
            <?php } /*end:if;*/
                }/*end:foreach;*/
       
    }  
	
    public function product_old_to_new_url($product_id,$product_name) { 
    //echo "test".$product_id.$product_name;die;
	   $q=""; $id=""; $page=""; $offset=""; 
    
	   if(isset($_GET['q'])){
         $q = $_GET['q'];
       }
       if(isset($_GET['id'])){
         $id = $_GET['id'];
       }
       if(isset($_GET['page'])){
         $page = $_GET['page'];
       }
       if(isset($_GET['offset'])){
         $offset = $_GET['offset'];
       }
       
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        echo base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($product_name)))).'/pdp/'.$product_id.'?q='.$q.'&id='.$id.'&page='.$page.'&offset='.$offset;die;
        redirect(base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($product_name)))).'/pdp/'.$product_id.'?q='.$q.'&id='.$id.'&page='.$page.'&offset='.$offset,'location',301);
        exit();
    } 
	
	
    public function product_details($product_name,$product_id) 
	{
        $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');
        
		/*[start::sql::get product details without status flag check:]*/
		$productDtlsWithoutStatusFlagCheck = $this->Md_product->getProductDetailsWithoutStatusCase($product_id);
		if($productDtlsWithoutStatusFlagCheck[0]['status']==0){
			//redirectTheUser To Product Brand Landing Page; 
			redirect(base_url().$productDtlsWithoutStatusFlagCheck[0]['brand_url_name'].'?brandID='.$productDtlsWithoutStatusFlagCheck[0]['product_brand_id'].'&pageType=BLP&q=l');
			exit();
		}
		/*[end::sql::get product details without status flag check;]*/
				
		/*sql::getProduct Details with status flag:*/
        $data['product_details'] = $this->Md_product->getProductDetails($product_id);
		
        //$data['page_title'] = "Product Details";
        $data['page_title'] = 'Shop for '.$data['product_details'][0]['product_name'].' Online!';
        $data['leadGenFromSliderPageType'] = 'product-details-page';
        $data['leadGenFromSliderPageUniqueId'] = $product_id;
        $data['page_name'] = 'product_details';   
        //$data['meta_title'] = 'Shop for '.$data['product_details'][0]['product_name'].' Online!';
        $data['meta_description'] = $data['product_details'][0]['product_name'].' - Mansionly presents exclusive home decoration and lifestyle products online.';
        $data['meta_keywords'] = '';
        $data['canonicalLink'] = '<link rel="canonical" href="'.base_url().strtolower(urlencode(str_replace($url_replace_char_array, '-', trim($product_name)))).'/pdp/'.$product_id.'" />';

        /*[start::Set limit in session for back activity]*/
        if(isset($_GET['offset'])){
            $this->session->set_userdata('limit',$_GET['offset']);
        }
       /*[End::Set limit in session for back activity]*/

//        $data['product_details'] = $this->Md_product->getProductDetails($product_id);
        $cat_id = $data['product_details'][0]['category_id'];
        $data['product_images'] = $this->Md_product->getProductImages($product_id);
        
        /*product material dtls:*/
        $arrProductMaterial    = '';
        $tmpArrProductMaterial = array();
        $arrProductMaterial = $this->Md_product->getProductMaterial($product_id);
       
        foreach($arrProductMaterial as $key=>$value){
          $tmpArrProductMaterial[] =  $value['primary_material'];
        }
        
        $data['product_material'] = implode(', ',$tmpArrProductMaterial);
        
        /* Get product property*/
        $arrProductProperty = array();
        $arrProductProperty =  $this->Md_product->getProductPropery($product_id);
        if(!empty($arrProductProperty)){
         $arrProductProperty = $arrProductProperty[0];
        }
        $data['arrProductProperty']= $arrProductProperty;
        
        /*other relational product list:*/
        $data['related_product'] = $this->Md_product->getRelatedProducts($product_id,$cat_id);
        /*Brand details:*/
        $brand_id = $data['product_details'][0]['product_brand_id'];
        $table = "ecom_brand"; 
        $condition=array('brand_id'=>$brand_id,'status'=>'1');
        $data['brand_details']  = $this->Md_database->getData($table,'*',$condition, ''); 
       /*Brand relational product list:*/
        $data['product_list_by_brand'] = $this->Md_product->getProductList_filterByBrand($brand_id,$offset=0,$limit=9,$product_id);
       /*Category details relational product list:*/
        $data['cat_details'] = $this->Md_product->getProductCatDetails($product_id);
        $data['sub_cat_details']=array();
        if(!empty($data['cat_details'])){
        $data['sub_cat_details'] = $this->Md_product->getProductSubCatDetails($data['cat_details'][0]['cat_id']);
        }
        /*Section details relational product list:*/
        $data['section_details'] = $this->Md_product->getProductSectionDetails($product_id);
        
        /*Start:: get favorite list of customer*/
                $data['customerFavoriteProduct']=array();
                 if(!empty($_SESSION['customer_id'])){
                     $table = 'customer_favorites_list';
                     $condition = array('customer_id'=>$_SESSION['customer_id'],'favorites_type'=>'marketseller');
                     $result = $this->Md_database->getData($table,'favorites_record_id',$condition,'','');
                     foreach ($result as $row){
                         $data['customerFavoriteProduct'][]=$row['favorites_record_id'];
                     }
                } 
            /*End:: get favorite list of customer*/
        $this->load->view('product/vw_product_details', $data);
    }  
   
    
}
