<?php
 
/*Arrray for the replacement in url*/
 $url_replace_char_array = array('!', '@', '#', '$', '%', '^', '&', '*', '(',')',' ','  ',"'",'+',',','/');

if(!empty($_GET['catID'])){
    $arrCatID = explode(',', $_GET['catID']);
    $catCount = count($arrCatID);
    
    if($catCount==1){
    $catNameList = array();
    $catNameList = $this->Md_category->getParentCategoryNameFromChildCatId($arrCatID[0],$catNameList);
    
   }
}else{
    $catCount = 0;
}

if(!empty($_GET['brandID'])){
    $arrBrandID = explode(',', $_GET['brandID']);
    $brandCount = count($arrBrandID);
}else{
    $brandCount = 0;
}

if(!empty($_GET['pageType'])){
   
    $pageType = $_GET['pageType'];
}else{
    $pageType = 'PLP';
}

if($catCount==1 && $brandCount==0){
    //case:1
    $bredCumsHtml ='';
    foreach ($catNameList as $key=>$catItem){
        if($key==0){
           $bredCumsHtml = "<li><a class='active'>".$catItem['cat_name']."</a></li>".$bredCumsHtml; 
        }else{
             $breadCrumbURL = base_url().$catItem['cat_lname'].'?catID='.$catItem['cat_id'].'&pageType=PLP';
           $bredCumsHtml = "<li><a href='$breadCrumbURL'>".$catItem['cat_name']."</a></li>".$bredCumsHtml; 
        }
        
    }
     echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            $bredCumsHtml
        </ol>";
     
}else if(($catCount>1 && $brandCount==0)||($catCount==0 && $brandCount>1)||($catCount==1 && $brandCount>1)||($catCount>1 && $brandCount>1)){
    //case:2 or case:4 or case:7 or case:8
    
    echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."allproducts?pageType=PLP'>Mansionly Lifestyle Products</a></li>
        </ol>";
}else if($catCount==0 && $brandCount==1){
    //case:3
    $brandName='';
    if(!empty($arrBrandID)){
        $table = 'ecom_brand';
        $condition = array('brand_id'=>$arrBrandID[0]);
        $result = $this->Md_database->getData($table,'brand_name,brand_id',$condition,'','');
       if(!empty($result)){
           $brandName = $result[0]['brand_name'];
           $brandNameURL = urlencode(str_replace($url_replace_char_array, '-', strtolower($result[0]['brand_name'])));
           $brandID = $result[0]['brand_id'];
       }
    }
    echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."all-brands?q=l'>All Brands</a></li>
            <li><a href='".base_url()."$brandNameURL?brandID=$brandID&pageType=BLP'>$brandName</a></li>
        </ol>";
}else  if($catCount==1 && $brandCount==1){
    //case:5
     $brandName='';
    if(!empty($arrBrandID)){
        $table = 'ecom_brand';
        $condition = array('brand_id'=>$arrBrandID[0]);
        $result = $this->Md_database->getData($table,'brand_name,brand_id',$condition,'','');
       if(!empty($result)){
           $brandName = $result[0]['brand_name'];
           $brandNameURL = urlencode(str_replace($url_replace_char_array, '-', strtolower($result[0]['brand_name'])));
           $brandID = $result[0]['brand_id'];
       }
    }
     $bredCumsHtml ='';
    foreach ($catNameList as $key=>$catItem){
            $breadCrumbURL = base_url().$catItem['cat_lname'].'?catID='.$catItem['cat_id'].'&pageType=PLP';
            $bredCumsHtml = "<li><a href='$breadCrumbURL'>".$catItem['cat_name']."</a></li>".$bredCumsHtml; 
             
    }
    
    if($pageType = 'BLP'){
        echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."all-brands?q=l'>All Brands</a></li>
            <li><a href='".base_url()."$brandNameURL?brandID=$brandID&pageType=BLP'>$brandName</a></li>
            $bredCumsHtml
        </ol>";
    }else{
        
     echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            $bredCumsHtml
            <li><a class='active'>$brandName</a></li>
        </ol>";
    }
     
     
}else if($catCount>1 && $brandCount==1){
    //case:6
   $brandName='';
    if(!empty($arrBrandID)){
        $table = 'ecom_brand';
        $condition = array('brand_id'=>$arrBrandID[0]);
        $result = $this->Md_database->getData($table,'brand_name,brand_id',$condition,'','');
       if(!empty($result)){
           $brandName = $result[0]['brand_name'];
           $brandNameURL = urlencode(str_replace($url_replace_char_array, '-', strtolower($result[0]['brand_name'])));
           $brandID = $result[0]['brand_id'];
       }
    }
    
    if($pageType = 'BLP'){
        echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."all-brands?q=l'>All Brands</a></li>
            <li><a href='".base_url()."$brandNameURL?brandID=$brandID&pageType=BLP'>$brandName</a></li>
            </ol>";
    }else{
    echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."allproducts?pageType=PLP'>Mansionly Lifestyle Products</a></li>
            <li><a href=''>$brandName</a></li>
        </ol>";
    }
}else{
    echo "<ol class='breadcrumb'>
            <li><a href='".base_url()."'>Home</a></li>
            <li><a href='".base_url()."allproducts?pageType=PLP'>Mansionly Lifestyle Products</a></li>
        </ol>";
}


?>

