<?php
 header('Access-Control-Allow-Origin: *');  
 header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT');
 header('Accept','application/json');

	if (isset($_REQUEST['tag']) && $_REQUEST['tag'] != '') 
	{
		  // $start = $_GET['start'];
          // $end = $_GET['end'];
           
				// get tag
				$tag = $_REQUEST['tag'];
				// include db handler
				require_once 'DB_Functions.php';
				$db = new DB_Functions();
				// response Array
				$response = array("tag" => $tag, "error" => FALSE);

				// check for tag type -------------------------------------------------------------------------------------------------------------
				if ($tag == 'getProducts') 
				{				
					 $db->getProduct();
					
				} 

				else if($tag == 'getProductsCategory')
				{
					$categary = $_REQUEST['categary'];
									
					 $db->getProductsCategory($categary);
					
				}

		
	

	} 
//-------------------------------------------------------------------------------------------------------------------------------------------
	else 
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Required parameter 'tag' is missing!";
			echo json_encode($response);
	    }
?>
