<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Password {
		
		private $salt;
		
		public function __construct()
		{
			$this->salt = 'borborema';
		}

		public function generatePassword($length = 8)
		{
			$CI =& get_instance();
			
			$CI->load->database();
			
			$possibleChars  = 'abcdefghijklmnopqrstuvwxyz';
			$possibleChars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$possibleChars .= '0123456789';
			$possibleChars .= '$!&@?#';

			$password = '';

			for($i = 0; $i < $length; $i++) {
				$rand = rand(0, strlen($possibleChars) - 1);
				$password .= substr($possibleChars, $rand, 1);
			}
			
			$password_salt = $password.$this->salt;
			
			$password_md5 = md5($password_salt);
			
			$sql = "SELECT * FROM tbl_msg WHERE password = '$password_md5'";
			$query = $CI->db->query($sql);
	
			if ($query->row()){
				return $this->generatePassword();
			}else{
				
				$passwords = array('password_pure' => $password, 'password_md5' => $password_md5);
				
				return $passwords;
			}

		 }
		 
		public function encryptPassword($password)
		{
			
			$password_salt = $password.$this->salt;
			
			$password_md5 = md5($password_salt);
			
			return $password_md5;

		}
		
		/*function myUrlEncodePassword($password) 
		{
			$entities = array('%21', '%40', '%26', '%24', '%3F', '%23');
			$replacements = array('!', '@', "&", "$", "?", "#");
			return str_replace($entities, $replacements, $password);
		}*/
	
	}

?>
