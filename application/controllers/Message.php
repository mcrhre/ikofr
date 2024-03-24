<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('password');
		$this->load->library('FileName');
		
	}
	
	public function index()
	{		
		$this->session->sess_destroy();
		$this->load->view('home');
	}
	
	public function search()
	{
		if($this->input->post()){
			
			$password = addslashes($this->input->post('password'));
			
			$password_md5 = $this->password->encryptPassword($password);
		
			$result = $this->Message_model->selectMessage($password_md5);
		
			if($result->row()){
				
				$this->session->set_userdata('password', $password);
				
				echo '{"error": "0", "result": "Message found!"}';
				
			}else{
				echo '{"error": "1", "result": "Message not found!"}';
			}
		}
	}
	
	public function open()
	{
		if($this->session->has_userdata('password')){
			
			$password = $this->session->userdata('password');
				
			$password_md5 = $this->password->encryptPassword($password);
		
			$result = $this->Message_model->selectMessage($password_md5);
		
			if($result->row()){
			
				$this->load->library('encrypt');
				$this->load->library('TreatMessage');
				
				$data = $result->row_array(); 
				
				$mensagem_desc =  $this->encrypt->decode($data['message']);
				$mensagem_desc =  $this->treatmessage->decrypt($mensagem_desc);
				
				$data['message'] = $mensagem_desc;
				
				if($data['attachment'] != ''){
					
					$data['attachment'] = $this->filename->decryptName($data['attachment']);
				}
				
				$password_md5 = $data['password'];
				
				if($data['amount_open'] >= 2){
					//if message already has been opened 3 times, delete
					$this->Message_model->deleteMessage($password_md5);
				}else{
					//add + 1 to amount_open
					$this->Message_model->increaseMessageOpen($password_md5);
				}
				
				$this->load->view('read_message', $data);
				
			}else{
				//redirect home
				redirect('/message/', 'refresh');
			}
			
		}else{
			
			//redirect home
			redirect('/message/', 'refresh');	
		}
	}
	
	public function new_message()
	{
		$this->session->sess_destroy();
		$this->load->view('new_message');
	}
	
	public function save()
	{
		if($this->input->post()){
			
			$recaptcha_response = $this->captcha($this->input->post('recaptcha'));
			
			if($recaptcha_response){
				
				if(isset($_FILES['file'])){
					$file_name_64 = $this->attach($_FILES['file']);
				}else{
					$file_name_64 = '';
				}
				
				$mensagem = $this->input->post('message');
				
				if(strlen($mensagem) <= 90000){
				
					$this->load->library('encrypt');
					$this->load->library('TreatMessage'); 
					
					$mensagem_crip =  $this->treatmessage->encrypt($mensagem);
					$mensagem_crip =  $this->encrypt->encode($mensagem_crip);
				
					$passwords = $this->password->generatePassword();
					
					$password_pure = $passwords['password_pure'];
					$password_md5 = $passwords['password_md5'];
					
					//insert message
					$result = $this->Message_model->insertMessage($mensagem_crip, $password_md5, $file_name_64);
				
					if($result){
					
						echo '{"error": "0", "result": "'.$password_pure.'"}';
					
					}else{
						echo '{"error": "1", "result": "Error. Message could not be sent!"}';
					}
					
				}else{
					echo '{"error": "1", "result": "Error. Message limit reached!"}';
				}
			}else{
				echo '{"error": "1", "result": "Error. You have to solve the captcha!"}';
			}
		}
	}
	
	private function attach($file)
	{
		$directory = FCPATH.'attached/'.date('d F Y');
		
		//Verify if the folder with the month exists
		if(!is_dir($directory)){
			
			mkdir($directory);
			chmod($directory, 0777);
			
			//Creates index file thus preventing someone from accessing the folder directly.
			$fp = fopen($directory.'/index.html','w');
			$content  = '<!DOCTYPE html>';
			$content .= '<html>';
			$content .= '<head><title>403 Forbidden</title></head>';
			$content .= '<body><p>Directory access is forbidden.</p></body>';
			$content .= '</html>';
			fwrite($fp, $content);
			fclose($fp);
			
		}
		
		if($file['error'] == 0){
			
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			
			$extensions = array("jpg", "png", "jpeg", "xls", "doc", "docx", "ppt", "pptx", "txt", "pdf", "csv", "zip", "rar");
			
			//Check file extension
			if(in_array($ext, $extensions)){
				
				//Check file size (limit 5 MB)
				if($file['size'] < 5242880){
					
					$file_name = $this->filename->generateName($ext);

					//Upload file
					if(move_uploaded_file($file["tmp_name"], $directory.'/'.$file_name['name_pure'])){
						
						return $file_name['name_b64'];
						
					}else{
						
						echo '{"error": "1", "result": "Error. File not uploaded!"}';
						die();
					}
				}else{
					
					echo '{"error": "1", "result": "Error. File too large!"}';
					die();
				}
			}else{
				
				echo '{"error": "1", "result": "Error. Invalid file extension!"}';
				die();
			}
		}else{
			
			echo '{"error": "1", "result": "Error. File not uploaded!"}';
			die();
		}
	}	
	
	public function check_attachment($folder, $file_name)
	{
		if($this->session->has_userdata('password')){
			
			$fullPath = FCPATH.'attached/'.urldecode($folder.'/'.$file_name);
			
			// File Exists?
			if(file_exists($fullPath)){
				echo '{"error": "0", "result": "File found!"}'; 
			}else{
				echo '{"error": "1", "result": "Error. File not found!"}';
			}
			
		}else{
			
			//redirect home
			redirect('/message/', 'refresh');	
		}
	}
	
	public function download_attachment($folder, $file_name)
	{
		if($this->session->has_userdata('password')){
		
			$fullPath = FCPATH.'attached/'.urldecode($folder.'/'.$file_name);
			
			//echo $fullPath; exit;
			// Must be fresh start
			if(headers_sent())
			die('Headers Sent');

			// Required for some browsers
			if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');

			// File Exists?
			if(file_exists($fullPath)){

				// Parse Info / Get Extension
				$fsize = filesize($fullPath);
				$path_parts = pathinfo($fullPath);
				$ext = strtolower($path_parts["extension"]);

				// Determine Content Type
				switch ($ext) {
					case "pdf": $ctype="application/pdf"; break;
					case "zip": $ctype="application/zip"; break;
					case "rar": $ctype="application/x-rar-compressed"; break;
					case "docx":
					case "doc": $ctype="application/msword"; break;
					case "xlsx":
					case "xls": $ctype="application/vnd.ms-excel"; break;
					case "pptx":
					case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
					case "txt": $ctype="text/plain"; break;
					case "png": $ctype="image/png"; break;
					case "jpeg":
					case "jpg": $ctype="image/jpg"; break;
					default: $ctype="application/force-download";
				}

				header("Pragma: public"); // required
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false); // required for certain browsers
				header("Content-Type: $ctype");
				header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".$fsize);
				
				ob_clean();
				flush();
				readfile($fullPath);

			}else{
				die();
			}
		}else{
			
			//redirect home
			redirect('/message/', 'refresh');	
		}	
	}
	
	private function delete_attachment($folder, $file_name)
	{
		$fullPath = FCPATH.'attached/'.$folder.'/'.$file_name;
		
		if(file_exists($fullPath)){
			unlink($fullPath);
		}
	}
	
	public function delete()
	{
		if($this->session->has_userdata('password')){
		
			if($this->input->post()){
			
				$password = $this->session->userdata('password');
				
				$password_md5 = $this->password->encryptPassword($password);
				
				$result = $this->Message_model->selectMessage($password_md5);
				
				if($result->row()){
					
					$data = $result->row_array();
					
					if($data['attachment'] != ''){
						
						$file_name = $this->filename->decryptName($data['attachment']);
						
						$folder = $data['date'];
						
						$this->delete_attachment($folder, $file_name);
					}
				}
				
				$result = $this->Message_model->deleteMessage($password_md5);
				
				if ($result){
					echo '{"error": "0",  "result": "Message successfully deleted!"}';
				}else{
					echo '{"error": "1",  "result": "Erro. Message could not be deleted!"}';
				}
				
			}
		}else{
			
			//redirect home
			redirect('/message/', 'refresh');	
		}
	}
	
	public function adm($psw)
	{	
		if($psw == 's4muc1r'){
			
			$result = $this->Message_model->selectAmountMessage();
			
			echo '<pre>';
			print_r($result->row_array());
			exit;
			
		}else{
			//redirect home
			redirect('/message/', 'refresh');
		}
	}
	
	private function captcha($recaptcha_response)
	{
		
		//your secret key
		$secret[] = "6LemySITAAAAAKgbdQH-yw29iWu65l3lBO8E4Avz";
		
		$this->load->library('ReCaptcha', $secret);
		
		$response = null;
		
		$response = $this->recaptcha->verifyResponse($this->input->ip_address(), $recaptcha_response);
		
		if($response != null && $response->success) {
			return true;
		}else{
			return false;
		}
	}
	
	/*private function captcha()
	{
		$this->load->helper('captcha');
		$this->load->helper('string');
		
		$opc = array(
						 'img_path' => './assets/imgs/captchas',
						 'img_url' => base_url().'assets/imgs/captchas',
						 'word' => random_string('alnum', 5),
						 'img_width' => '150',
    					 'img_height' => '50',
    					 'expiration' => '7200',
    					 'font_path' => './system/fonts/texb.ttf'
						 );

		$captcha = create_captcha($opc);
		
		//write to the session string of CAPTCHA
		$this->session->set_userdata('word_captcha', $captcha['word']);
		
		print_r($captcha);
		
		echo '<br>';
		
		echo $this->session->userdata('word_captcha');
		
	}*/

}
