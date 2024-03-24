<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class TreatMessage {

		 public function encrypt($message)
		 {
		 	$message = trim($message);
		 	
		 	$message = addslashes($message);
		 
		 	//invert letters
		 	$string_reverse = strrev($message);
	
			$string_array = explode(' ', $string_reverse);
	
			//Invert words
			ksort($string_array);
	
			$string_mixed = implode(' ', $string_array);
		
			//encrypt			
			for($i=1; $i <= 5; $i++){
				$string_mixed = base64_encode($string_mixed);
			}
	
			return $string_mixed;
		 }
		 
		 public function decrypt($message)
		 {
		 	//decrypt			
			for($i=1; $i <= 5; $i++){
				$message = base64_decode($message);
			}
	
			$string_array = explode(' ', $message);
	
			//invert words
			ksort($string_array);
	
			$string_mixed = implode(' ', $string_array);
		
			//invert letters
			$string_normal = strrev($string_mixed);
			
			$string_normal = stripslashes($string_normal);
	
			return $string_normal;
		 }
	}

?>
