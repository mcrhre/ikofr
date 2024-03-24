<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
		
	}

	function selectMessage($password){
	
		$sql = "SELECT * FROM tbl_msg WHERE password = '$password'";
		$result = $this->db->query($sql);
		
		return $result;
	}
	
	function increaseMessageOpen($password){
	
		$sql = "UPDATE tbl_msg SET amount_open = (amount_open+1) WHERE password = '$password'";
		$this->db->query($sql);
		
	}
	
	function insertMessage($message, $password, $file_name){
		
		$today = date('d F Y');
		$hour = date('h:i:s a');
		
		//amount of message created (history)
		$sql = "UPDATE tbl_amount_msg SET amount = (amount+1), last_hour = '$hour' WHERE date = '$today'";
		$this->db->query($sql);
		
		if(!$this->db->affected_rows()){
			$sql = "INSERT tbl_amount_msg (amount, date, last_hour) VALUE (1, '$today', '$hour')";
			$this->db->query($sql);
		}
		
		//expiration message after 3 days
		$expiration = date('d F Y', strtotime("+3 days", strtotime($today)));
		
		//get ip user
		$ip = $this->input->ip_address();
		
		$sql  = 'INSERT INTO tbl_msg ';
		$sql .= '(message, attachment, date, hour, expiration_date, password, ip, amount_open)';
		$sql .= ' VALUES ';
		$sql .= "('$message', '$file_name', '$today', '$hour', '$expiration', '$password', '$ip', 0)";
		
		$result = $this->db->query($sql);
		
		return $result;
	}
	
	function deleteMessage($password){
	
		$sql = "DELETE FROM tbl_msg WHERE password = '$password'";
		$result = $this->db->query($sql);
		
		return $result;
	}
	
	function selectAmountMessage(){
		
		$today = date('d F Y');
		
		$sql = "SELECT amount, date, last_hour FROM tbl_amount_msg WHERE date = '$today'";
		$result = $this->db->query($sql);
		
		return $result;
	}
}
?>
