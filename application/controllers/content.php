<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		# error_reporting(E_ALL);
	}
	
	function index()
	{
		$data = array(
					'title' => 'Property Marketing Solutions',
					'desc' => 'Melbourne-based Director, Susie Maskell, brings over 15 years of property 
							   experience to Property Marketing Solutions to provide expert marketing 
							   solutions for your property business.',
					'keywords' => 'property marketing'
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('home');
		$this->load->view('common/footer');
	}
	
	function about_us()
	{
		$data = array(
					'title' => 'About Us',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('about_us');
		$this->load->view('common/footer');	
	}
	
	function services()
	{
		$data = array(
					'title' => 'Services',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('services');
		$this->load->view('common/footer');	
	}
	
	function projects($slug = 'mandalay-at-beveridge')
	{
		$data = array(
					'title' => ucwords(str_replace('-',' ',$slug)),
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('projects/'.str_replace('-','_',$slug));
		$this->load->view('common/footer');	
	}
	
	function testimonials()
	{
		$data = array(
					'title' => 'Testimonials',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('testimonials');
		$this->load->view('common/footer');	
	}
	
	function privacy_policy()
	{
		$data = array(
					'title' => 'Privacy Policy',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('privacy_policy');
		$this->load->view('common/footer');	
	}
	
	function disclaimer()
	{
		$data = array(
					'title' => 'Disclaimer',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('disclaimer');
		$this->load->view('common/footer');	
	}
	
	function contact_us()
	{
		$data = array(
					'title' => 'Contact Us',
					'desc' => '',
					'keywords' => ''
					);
		
		$this->load->view('common/header',$data);
		$this->load->view('contact_us');
		$this->load->view('common/footer');	
	}
	
	function sendcontact()
	{
		$name = $this->input->post('name',true);
		$email = $this->input->post('email',true);
		$msg = $this->input->post('message');
		

		$rules = array(
			array('field' => 'email', 'label' => 'Email', 'rules' => 'required|email'),
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
			array('field' => 'message', 'label' => 'Message', 'rules' => 'required')
		);
		
		
		$errors =  $this->_validate_input($this->input->post(), $rules);
		
		if (count($errors) > 0) {
			# User input error
			echo json_encode(array(
				'ok' => false,
				'errors' => $errors
			));
			return;
		}else{
			# proceed with sending email
			$data_email['message'] = $this->input->post();
			$message = $this->load->view('email/contact_us',$data_email,true);
			# $to = 'kaushtuv@propagate.com.au';
			$to = 'team@propagate.com.au';
			
			$email_data = array(
					'to' => $to ? $to : INFO_EMAIL,
					'from' => 'webmaster@propertyms.com.au',
					'from_text' => 'Contact Form Inquiry - PropertyMS',
					'subject' => 'Message Received From Contact Form - '.date('d F,Y'),
					'message' => $message
					);
			if($this->_send_email($email_data)){
				  echo json_encode(array(
					  'ok' => true,
					  'errors' => ''
				  ));
				  return;
			}else{
				echo json_encode(array(
					  'ok' => false,
					  'errors' => 'contact failed'
				));
			   return;
			}
		}
	
	}
	
	
	/**
	*	@name: send_email
	*	@desc: A central function to send email
	*	@access: public
	*	@param: (array) email data
	*/
	function _send_email($data)
	{
		if(LIVE_SERVER){
			return $this->_send_email_live($data);
		}else{
			return $this->_send_email_localhost($data);
		}
	}

	/**
	*	@name: send_email_live
	*	@desc: A central function to send all email in live server
	*	@access: public
	*	@param: (array) email data
	*/
	function _send_email_live($data)
	{
		$to = '';
		$from = '';
		$cc = '';
		$bcc = '';
		$from_text = '';
		$subject = ''; 
		$message = ''; 
		$attachment = ''; 
		if($data){
			foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		
			$email_signature = $this->load->view('email/signature', isset($data) ? $data : NULL,true);
		
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($from,$from_text);		
			$this->email->to($to);
			$this->email->cc($cc);
			$this->email->bcc($bcc);
			$this->email->subject($subject);
			$this->email->message($message .'<br />' . $email_signature);
			if($attachment){
				$this->email->attach($attachment);
			}
			if($this->email->send()){
				$this->email->clear(true);	
				return true;
			}else{
				return false;	
			}
					
		} else {
			return false;	
		}
		

	}
	
	/**
	*	@desc Test function to send email from localhost
	*
	*   @name send_email
	*	@access public
	*	
	*/
	function _send_email_localhost($data)
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'propagate.au@gmail.com', // change it to yours
		  'smtp_pass' => 'morem0n3y', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
		$to = '';
		$from = '';
		$cc = '';
		$bcc = '';
		$from_text = '';
		$subject = ''; 
		$message = ''; 
		$attachment = ''; 
		
		if($data){
		foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		}
		
		$email_signature = $this->load->view('email/signature', isset($data) ? $data : NULL,true);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('propagate.au@gmail.com',$from_text); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message .'<br />' . $email_signature);
				
		if($attachment){
			$this->email->attach($attachment);
		}
		if($this->email->send()){
		  	return true;
		}else{
			#show_error($this->email->print_debugger());
			return false;
		} 
	}
	
	function _validate_input($input, $rules)
	{
		$errors = array();
		foreach($rules as $rule) {
			$conditions = explode('|', $rule['rules']);
			foreach($conditions as $condition) {
				switch($condition) {
					case 'required':
							if (!isset($input[$rule['field']]) || $input[$rule['field']] == '') {
								$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' is required');
							}
						break;
					case 'email':
						if (!filter_var($input[$rule['field']],FILTER_VALIDATE_EMAIL)){
							$errors[] = array('field' => $rule['field'], 'msg' => $rule['label'] . ' is invalid');	
						}
						break;
				}
			}
		}
		return $errors;
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */