<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

 $route['default_controller'] = 'Cn_home'; 
 $route['search'] = 'Cn_search';   
 $route['search-bar'] = 'Cn_search/search_bar';   
 $route['about-us'] = 'Cn_cms/about_us';   
 $route['how-it-works'] = 'Cn_cms/how_it_works';   
 $route['contact-us'] = 'Cn_cms/contact_us';   
 $route['designer-profile/(:any)/(:any)'] = 'Cn_designer/designer_profile/$1/$2';   
 $route['all-designer'] = 'Cn_designer/all_designer';   
 $route['designer-portfolio/(:any)/(:any)/(:any)'] = 'Cn_designer/designer_portfolio/$1/$2/$3';   
 $route['product-details/(:any)'] = 'Cn_product/product_details/$1';   
 $route['product-details/(:any)/(:any)'] = 'Cn_product/product_details/$1/$2';   
 $route['brand/(:any)/(:any)'] = 'Cn_brand/brand/$1/$2';   
 $route['all-brands'] = 'Cn_brand/all_brands';   
 $route['category/(:any)/(:any)'] = 'Cn_category/category/$1/$2';   
 $route['all-categories'] = 'Cn_category/all_categories';   
 $route['productlist/(:any)/(:any)'] = 'Cn_product/productListByCategory/$1/$2'; 
 $route['sectionlist/(:any)/(:any)'] = 'Cn_product/productListBySection/$1/$2';   
 $route['featuredlist/(:any)/(:any)'] = 'Cn_product/productListByFeatured/$1/$2';   
 $route['all-sections'] = 'Cn_section/all_sections';   
 $route['featured/(:any)/(:any)'] = 'Cn_featured/featured/$1/$2';   
 $route['bespoke'] = 'Cn_featured/bespoke';   
 $route['bespoke-portfolio/(:any)/(:any)'] = 'Cn_featured/bespoke_portfolio/$1/$2';   
 $route['execution-gallery/(:any)'] = 'Cn_execution/execution_gallery/$1';   
 $route['privacy'] = 'Cn_cms/privacy';   
 $route['terms'] = 'Cn_cms/terms';   
 $route['signin'] = 'Cn_signin/index';
 $route['signout'] = 'Cn_signin/signout';
 $route['customer-login'] = 'Cn_customer/customerLogin';
 $route['Cn_customer/customerRegister'] = 'Cn_customer/customerRegister';
 $route['Cn_customer/ForgotPassword'] = 'Cn_customer/ForgotPassword';
 $route['users'] = 'Cn_users';
 $route['profile'] = 'Cn_users';
 $route['ajax-city-list'] = 'Cn_users/ajax_city_list';
 $route['my-favourites'] = 'Cn_users/my_favourites';
 $route['my-orders'] = 'Cn_users/my_orders';
 //$route['work-order-details/(:any)/(:any)'] = 'Cn_users/work_order_details/$1/$2';
 $route['work-order-details/(:any)'] = 'Cn_users/work_order_details/$1';
 $route['publicworkorderdetails/(:any)/(:any)/(:any)'] = 'Cn_users/public_work_order_details/$1/$2/$3';
 $route['generic-listing-action'] = 'Cn_generic_listing/generic_listing_action';
 $route['allProduct-generic-listing-action'] = 'Cn_generic_listing/allProductGenericListingAction';
 $route['interior-design'] = 'Cn_campaign';
 $route['ajax-interior-design-form-submit-action'] = 'Cn_campaign/ajax_form_submit_action';
 
 $route['Cn_product/ajaxGetProductByCategoryId'] = 'Cn_product/ajaxGetProductByCategoryId';   
 $route['Cn_product/ajaxGetProductBySectionId'] = 'Cn_product/ajaxGetProductBySectionId';   
 $route['Cn_product/ajaxGetProductByFeaturedId'] = 'Cn_product/ajaxGetProductByFeaturedId';   
 $route['Cn_customer/getpriceRequest'] = 'Cn_customer/getpriceRequest';   
 $route['Cn_execution/getAjaxAllExecutionPortfolio'] = 'Cn_execution/getAjaxAllExecutionPortfolio';   
 $route['Cn_execution/getAjaxExecutionPortfolio'] = 'Cn_execution/getAjaxExecutionPortfolio';   
 $route['Cn_designer/ajaxOtherExecutionPortfolio'] = 'Cn_designer/ajaxOtherExecutionPortfolio';   
 $route['Cn_designer/ajaxGetOtherDesignConcept'] = 'Cn_designer/ajaxGetOtherDesignConcept';   
 $route['Cn_customer/alreadyRegisterEmail'] = 'Cn_customer/alreadyRegisterEmail';   
 $route['Cn_customer/SavedAllDataForExistingUserForDesigner'] = 'Cn_customer/SavedAllDataForExistingUserForDesigner';   
 $route['Cn_designer/ajax_execution_portfolio'] = 'Cn_designer/ajax_execution_portfolio';   
 $route['Cn_designer/ajax_design_concept'] = 'Cn_designer/ajax_design_concept';   
 $route['Cn_customer/getstartedRequest'] = 'Cn_customer/getstartedRequest';   
 $route['Cn_customer/checkUserExistOrNot'] = 'Cn_customer/checkUserExistOrNot';   
 $route['Cn_generic_listing/ajaxGetProductByGenericListing'] = 'Cn_generic_listing/ajaxGetProductByGenericListing';   
 $route['Cn_generic_listing/ajaxGetAllProductByGenericListing'] = 'Cn_generic_listing/ajaxGetAllProductByGenericListing';   
 $route['Cn_brand/ajaxGetProductByBrandId'] = 'Cn_brand/ajaxGetProductByBrandId';   
 $route['Cn_brand/ajax_all_brands'] = 'Cn_brand/ajax_all_brands';   
 $route['Cn_category/ajaxAllCategories'] = 'Cn_category/ajaxAllCategories';   
 $route['Cn_featured/ajax_bespoke'] = 'Cn_featured/ajax_bespoke';   
 $route['Cn_featured/ajax_bespoke_portfolio'] = 'Cn_featured/ajax_bespoke_portfolioe';   
 $route['Cn_section/ajaxGetProductByBrandId'] = 'Cn_section/ajaxGetProductByBrandId';   
 $route['Cn_section/ajaxGetProductBySectionId'] = 'Cn_section/ajaxGetProductBySectionId';  
 $route['Cn_customer/saveProfileDetail'] = 'Cn_customer/saveProfileDetail';
 $route['Cn_customer/changePassword'] = 'Cn_customer/changePassword';
 $route['Cn_designer/ajax_all_designer'] = 'Cn_designer/ajax_all_designer';
 $route['Cn_customer/SaveCustomerFavorite'] = 'Cn_customer/SaveCustomerFavorite';
 $route['brand-test'] = 'Cn_test/test';
 $route['section-test'] = 'Cn_test/section_test';
 
 $route['ajaxGetSOHFilter'] = 'Cn_generic_listing/ajaxGetSOHFilter';
 $route['ajaxGetFilterDetails'] = 'Cn_generic_listing/ajaxGetFilterDetails';
 $route['ajaxGetFilterDetailsMobile'] = 'Cn_generic_listing/ajaxGetFilterDetailsMobile';
 
 $route['allproducts'] = 'Cn_generic_listing/allProductsGenericListing';
 $route['allproducts/(:any)'] = 'Cn_generic_listing/allProductsGenericListing/$1';
 $route['allproducts/(:any)/(:any)'] = 'Cn_generic_listing/allProductsGenericListing/$1/$2';
 $route['allproducts/(:any)/(:any)/(:any)'] = 'Cn_generic_listing/allProductsGenericListing/$1/$2/$3';
 $route['allproducts/(:any)/(:any)/(:any)/(:any)'] = 'Cn_generic_listing/allProductsGenericListing/$1/$2/$3/$4';
 
 $route['(:any)'] = 'Cn_generic_listing/generic_listing/$1';
 $route['(:any)/(:any)'] = 'Cn_generic_listing/generic_listing/$1/$2';
 $route['(:any)/(:any)/(:any)'] = 'Cn_generic_listing/generic_listing/$1/$2/$3';
 $route['(:any)/(:any)/(:any)/(:any)'] = 'Cn_generic_listing/generic_listing/$1/$2/$3/$4';
 $route['404_override'] = '';
 $route['translate_uri_dashes'] = FALSE; 
