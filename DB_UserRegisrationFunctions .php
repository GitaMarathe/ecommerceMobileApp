<?php

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
			
			public function addUser($email, $password) 
				{
					$result = mysql_query("SELECT * FROM userregistration_db WHERE email = '$email' and password='$password' ") or die(mysql_error());
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

				
	}


?>
