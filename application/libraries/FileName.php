<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class FileName {
	
		public function generateName($ext)
		{
			$CI =& get_instance();
			
			$CI->load->database();
			
			$file_name  = '';
			
			$file_name  = (rand(0, 1))? 'i' : '1';	
			
			$file_name .= (rand(0, 1))? 'k' : 'K';
			
			$file_name .= (rand(0, 1))? 'o' : '0';
			
			$file_name .= (rand(0, 1))? 'f' : 'F';
			
			$file_name .= (rand(0, 1))? 'r' : 'R';
			
			$file_name .= (rand(0, 1))? '-' : '_';
			
			$possibleChars  = 'abcdefghijklmnopqrstuvwxyz';
			$possibleChars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$possibleChars .= '0123456789';

			for($i = 0; $i < 15; $i++) {
				$rand = rand(0, strlen($possibleChars) - 1);
				$file_name .= substr($possibleChars, $rand, 1);
			}
			
			$file_name .= '.'.$ext;
			
			$file_name_b64 = $file_name;
			
			//Encrypt			
			for($i=1; $i <= 5; $i++){
				$file_name_b64 = base64_encode($file_name_b64);
			}
			
			$sql = "SELECT * FROM tbl_msg WHERE attachment = '$file_name_b64'";
			$query = $CI->db->query($sql);
	
			if($query->row()){
				return $this->generateName($ext);
			}else{
				$file_names = array('name_pure' => $file_name, 'name_b64' => $file_name_b64);
				
				return $file_names;
			}
		}
		
		public function decryptName($file_name)
		{
			//Decrypt
			for($i=1; $i <= 5; $i++){
				$file_name = base64_decode($file_name);
			}
			
			return $file_name;

		}
	
	}
?>
