<?php
class Md_order extends CI_Model {
	
	public function SaveOrder($requestData,$shippingData,$productsList,$paymentData)
	{
		try {
		$data= $requestData;
		
		$unique_order_id = "none";
		$countyId = $shippingData["country"];
		$ordernotes["actor_email"]	= $shippingData["emailid"];	
		unset($shippingData["emailid"]);
		unset($shippingData["country"]);
		$customerAddresId = $shippingData["Address_id"];
		unset($shippingData["Address_id"]);
    
        $ordercomment = $requestData["Notes"];
        unset($requestData["Notes"]);
		
		$index = 0;
		
		$isSaved = false;
		
		foreach($productsList as $product)		
		{
			$queryStr = "select market_seller_offer,market_seller_price from jb080_ecom_product_mapp_seller_inventory where product_id = '".$product["id"]."' LIMIT 1 ";//and market_seller_id = '1'";
			
			
			$query = $this->db->query($queryStr);
			$resultQueryProductdata = $query->result();
			
			
			$product_price = 0;
			$sellerDiscount = 0;
			$ecommerceDiscount = 0;
			$taxAmount = 0;
			
			
			
			
			if(isset($resultQueryProductdata))
			{
				
				
				$product_price = ($resultQueryProductdata[0]->market_seller_price)*$product["quantity"];
				
				$sellerDiscount = $product_price * ($resultQueryProductdata[0]->market_seller_offer/100);				
			}
					
			
			$requestData["product_qty"]= $product["quantity"];
			$requestData["product_id"]= $product["id"];
			//$requestData["product_unit_price"]= $product["cost"];
			$requestData["product_price"]= $product_price;
			$productSellingPrice =  $product_price - $sellerDiscount - $ecommerceDiscount;
			$requestData["product_selling_price"]=$productSellingPrice;
			//$requestData["Product_Selling_Price"] = $product["cost"];
			$requestData["seller_discount"] = $sellerDiscount;
			
			
			//$queryStr = "select a.tax from jb080_country_tax_details a inner join jb080_countries b where b.countryName = '".$countyId."' and NOW() between a.valid_from and a.valid_to";
			
			$queryStr = "select a.tax from jb080_country_tax_details a inner join jb080_countries b on a.country_id = b.idCountry where b.countryName = '".$countyId."' and a.mansionly_services_tax_type = 'EcomProduct' and NOW() between a.valid_from and a.valid_to";
			
			
			$allTax = 0;
			$query = $this->db->query($queryStr);
			$dataTax = $query->result();
			
			if(isset($dataTax))
			{
        foreach($dataTax as $pertax)
        {
          $allTax = $allTax + $pertax->tax;
        }
				//$taxAmount = 	$dataTax[0]->tax*($productSellingPrice);
        $taxAmount = 	$allTax*($productSellingPrice);
			}
			
			$requestData["net_selling_price"] = $productSellingPrice + $taxAmount;
			
			$requestData["taxes"] = $taxAmount;
			$requestData["ecom_discount"] = $ecommerceDiscount;
			$requestData["seller_id"] = 1;
			
			
			$this->db->insert("jb080_ecom_orders", $requestData);
			
			$insert_id = $this->db->insert_id();
			
			if ($this->db->affected_rows() > 0) 
			{
				$unique_order_id =  "MNE".date("dm")."O".$insert_id."C".$_SESSION["customerId"];
				$data = array();
				$data["unique_order_id"] = $unique_order_id;
			
				
				$this->db->update("jb080_ecom_orders", $data , array("order_id"=>$insert_id));
				
				
				$paymentData["order_id"] = $insert_id;
				$paymentData["payment_amount"] =  $productSellingPrice + $taxAmount;
				$this->db->insert("jb080_ecom_orders_payment", $paymentData);
				
				$shippingData["order_id"] = $insert_id;
				
				$this->db->insert("jb080_ecom_orders_shipping_address", $shippingData);
				$index++;
				
				if(!$isSaved)
				{
					unset($shippingData["order_id"]);
					$shippingData["customer_id"] = $_SESSION["customerId"];
					$shippingData["address_type"] = 'Shipping';
					$shippingData["update_date"] = date('Y-m-d H:i:s');
					if($customerAddresId < 0)
					{
						$shippingData["flag_default_billing_adrs"] = 1;
						$shippingData["flag_default_shipping_adrs"] = 1;
						$this->db->insert("jb080_customer_address_details", $shippingData);
						
					}
					else
					{
						$this->db->update("jb080_customer_address_details", $shippingData , array("id"=>$customerAddresId));
						
					}
					
					$isSaved = true;
					unset($shippingData["customer_id"]);
					unset($shippingData["address_type"]);
					unset($shippingData["update_date"]);
				}
				
				
				$this->db->select("inventory,id",false);		
				$this->db->where(array('product_id'=>$product["id"]));	
				$resultQuery = $this->db->get('jb080_ecom_product_mapp_seller_inventory');
				
				$resultData = $resultQuery->row_array();
				if(intval($resultData["inventory"]) >= intval($product["quantity"]))
				{
					
					$resultInventory = intval($resultData["inventory"]) - intval($product["quantity"]);
					
					$this->db->update("jb080_ecom_product_mapp_seller_inventory", array("inventory"=>$resultInventory) , array("id"=>$resultData["id"]));
					
				}
				 
				$ordernotes["order_id"] = $insert_id;				
				$ordernotes["customer_status"] = $requestData["customer_status_id"] ;
				$ordernotes["crm_status"] = $requestData["crm_status_id"];
				$ordernotes["actor_name"] = $shippingData["full_name"];
				$ordernotes["comment"] = $ordercomment;	
				$ordernotes["action_datetime"] = date('Y-m-d H:i:s');
				$this->db->insert("jb080_ecom_orders_action_logs", $ordernotes); 
								
				
				
				
			}
		}
		
		return $unique_order_id;
		
		}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		} 
		
	}

	
	public function OrderDetails($cart_id)
	{
		
		$this->db->select("Order_Id,Customer_id,Product_id,product_qty,Product_Price,on_date",false);		
		$this->db->where(array('cart_id'=>$cart_id));	
		$resultQuery = $this->db->get('jb080_ecom_orders');
			
		$resultData = $resultQuery->row_array();
		
		return $resultData;
	}
	
	public function ShippingDetailsOfOrder($cart_id)
	{
		$query = 'SELECT b.Full_name,b.address_line1,b.address_line2,c.city,d.state_title,e.countryName FROM `jb080_ecom_orders` a inner join `jb080_ecom_orders_shipping_address` b on a.order_id = b.order_id inner join `jb080_master_city` c on b.city_id=c.id inner join `jb080_state` d on c.state_id = d.state_id inner join `jb080_countries` e on d.country_id=e.idCountry where a.Cart_id = ? limit 1';
		
		
		
		$resultData = $this->db->query($query, array($cart_id));
		$rows = $resultData->result_array();
		
		
		return count($rows) > 0 ?$rows[0]:""; 
	}
	
	
	
	
	public function ProductListInOrder($cart_id)
	{
		//$query = "SELECT DISTINCT a.Product_id,c.product_name as name,CONCAT('http://www.mansionly.com/media/images/ecom/product/',b.product_sec_image) as imageURL,a.product_qty as quantity,a.Product_Price AS cost,(a.product_qty * a.Product_Price) as productCost FROM `jb080_ecom_orders` a left join `jb080_ecom_product_images` b on a.product_id = b.product_id inner join `jb080_ecom_products` c on a.product_id = c.product_id where b.is_primary=1 and a.Cart_id=?";
    $query = "SELECT DISTINCT a.Product_id,c.product_name as name,CONCAT('".$this->config->item('base_image_url')."/images/ecom/product/',b.product_sec_image) as imageURL,a.product_qty as quantity,a.Product_Price AS cost,(a.product_qty * a.Product_Price) as productCost FROM `jb080_ecom_orders` a left join `jb080_ecom_product_images` b on a.product_id = b.product_id inner join `jb080_ecom_products` c on a.product_id = c.product_id where b.is_primary=1 and a.Cart_id=?";
		$resultData = $this->db->query($query, array($cart_id));
		$rows = $resultData->result_array();
		
		return $rows; 
	}
  
  
  public function getTaxviaCountry($countyId)
  {
      $allTax = 0;
      //$queryStr = "select a.tax from jb080_country_tax_details a inner join jb080_countries b where b.countryName = '".$countyId."' and NOW() between a.valid_from and a.valid_to";
      $queryStr = "select a.tax from jb080_country_tax_details a inner join jb080_countries b on a.country_id = b.idCountry where b.countryName = '".$countyId."' and  a.mansionly_services_tax_type = 'EcomProduct' and NOW() between a.valid_from and a.valid_to";
			$query = $this->db->query($queryStr);
			$dataTax = $query->result();
      foreach($dataTax as $pertax)
      {
        $allTax = $allTax + $pertax->tax;
      }
      return $allTax;
     
  }
  
}
?>