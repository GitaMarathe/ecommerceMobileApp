<?php
 header('Access-Control-Allow-Origin: *');  
 header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT');
 header('Accept','application/json');

class DB_Functions 
	{
			private $db;
			function __construct() 
				{
					require_once 'DB_Connect.php';
					// connecting to database
					$this->db = new DB_Connect();
					$this->db->connect();
				}

			// destructor
			function __destruct() 
				{			

				}
			//--------------------- check login function pass email and password   ---------------------
			
			public function getUserByEmailAndPassword($mobileno, $password) 
				{
					$result = mysql_query("SELECT * FROM userregistration_db WHERE mobileno = '$mobileno' and password='$password' ") or die(mysql_error());
					// check for result 
					$no_of_rows = mysql_num_rows($result); //return no of rows
					if ($no_of_rows > 0) 
					{
						$result = mysql_fetch_assoc($result);
						return $result;
					} 
					else 
					{
						return false; // indicates No matching records.
					}
				}
			//---------------------------------------------------------------------------------------------------	


				 //------------- add new  user--------------------------
			 	public function storeUser($username,$email,$mobileno,$address,$pincode,$password,$role) 
				{

					$result = mysql_query("INSERT INTO `userregistration_db`  (`userid`,`username`, `email`, `mobileno`, `address`, `pincode`,`password`,`role`) VALUES (NULL, '$username',
        '$email', '$mobileno', '$address', '$pincode','$password','$role');") or die(mysql_error());
					// check for result 
				//$insrtresult = mysql_num_rows($result); //return no of rows
			
						return $result;
				
				}

				      //--------------------user present or not---------------------
		 		public function isUserExisted($mobileno) 
				{
					
					$result = mysql_query("SELECT * FROM userregistration_db WHERE mobileno = '$mobileno'") or die(mysql_error());
					// check for result 
					$no_of_rows = mysql_num_rows($result); //return no of rows
					if ($no_of_rows > 0) 
					{
						//echo json_encode($no_of_rows);
						$result = mysql_fetch_assoc($result);
						//echo json_encode($result);
						return true;
					} 
					else 
					{
						return false; // indicates No matching records.
					}
				}


			//---------------------Update User Details------------------------------------------------------------------
			   public function UpdateUserDetails($username, $email, $mobileno, $address,$pincode,$userid) 
				{
					
					$result = mysql_query("UPDATE userregistration_db SET `username` = '$username', `email` = '$email',`mobileno` = '$mobileno', `address` = '$address', `pincode` = '$pincode', `address` = '$address' WHERE userid = '$userid';") or die(mysql_error());
			    
                      return $result;		
	
				}	

	     //------------------change password------------------------
	         public function changepassword($password,$userid) 
				{ 
					
					$result = mysql_query("UPDATE userregistration_db SET `password` = '$password' WHERE userid = '$userid';") or die(mysql_error());
                  
					return $result;
					
				}			

       //--------------get ditributor data--------------------
				    
		 		public function getDistributordata() 
				{

					$query = mysql_query("SELECT * FROM userregistration_db WHERE role = 'distributor'") or die(mysql_error());
					$json=array();
      				while($row = mysql_fetch_assoc($query))
					{
					     $json[] = $row;
					}
                   echo json_encode($json);
				}


		 //------------- store order--------------------------
			 	public function placeorder($orderID, $distributorID,$distributorAddress, $customerID, $customerName,$customerNo,$shippingAddress,$productID,
							$categary,$productName, $quantityInLiters, $specification, $productQuantity,$totalPrice,$savedPrice,$shippingDate,$expectedDate,$paymnetby) 
				{

					$result = mysql_query("INSERT INTO `order_tbl`  (`SrNo`,`orderID`, `distributorID`,`distributorAddress`,  `customerID`, `customerName`, `customerNo`, `shippingAddress`, `productID`, `categary`,`productName`, `quantityInLiters`, `specification`, `productQuantity`, `totalPrice`, `savedPrice`, `shippingDate`, `expectedDate`,`paymnetby`)
					 VALUES (NULL,'$orderID','$distributorID','$distributorAddress', '$customerID', '$customerName', '$customerNo','$shippingAddress','$productID','$categary',
					 	'$productName','$quantityInLiters', '$specification', '$productQuantity', '$totalPrice','$savedPrice','$shippingDate','$expectedDate','$paymnetby');") or die(mysql_error());
					// check for result 
				//$insrtresult = mysql_num_rows($result); //return no of rows
			
						return $result;
				
				}
          //----store points after order-------------

				public function storepoints($Point,$userid) 
				{

					$result = mysql_query("UPDATE userregistration_db SET `Point` = '$Point' WHERE userid = '$userid';") or die(mysql_error());
                  
					return $result;	
				}
	     //------------view orders-----------------
	     public function viewOrder($customerID) 
				{
					
					$query = mysql_query("SELECT * FROM order_tbl WHERE customerID = '$customerID'") or die(mysql_error());
					// check for result 
					//$no_of_rows = mysql_num_rows($result); //return no of rows

					$json=array();
      				while($row = mysql_fetch_assoc($query))
					{
					     $json[] = $row;
					}
					//echo("sdfds");
                   echo json_encode($json);
					
				}			

				
	}


?>
