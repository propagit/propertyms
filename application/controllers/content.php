<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL);
	}
	
	function index()
	{
		$this->load->view('common/header');
		$this->load->view('home');
		$this->load->view('common/footer');
	}
	
	function about_us()
	{
		$this->load->view('common/header');
		$this->load->view('about_us');
		$this->load->view('common/footer');	
	}
	
	function service()
	{
		$this->load->view('common/header');
		$this->load->view('service');
		$this->load->view('common/footer');	
	}
	
	function case_studies($slug = 'mandalay-at-beveridge')
	{
		$this->load->view('common/header');
		$this->load->view('case_studies/'.str_replace('-','_',$slug));
		$this->load->view('common/footer');	
	}
	
	function testimonials()
	{
		$this->load->view('common/header');
		$this->load->view('testimonials');
		$this->load->view('common/footer');	
	}
	
	function contact_us()
	{
		$this->load->view('common/header');
		$this->load->view('contact_us');
		$this->load->view('common/footer');	
	}
	
	function sendcontact()
	{
		$name = $this->input->post('name',true);
		$email = $this->input->post('email',true);
		$msg = $this->input->post('message');
		
		$valid = true;
		if(!$name || !$email || !$msg){
			$valid = false;	
		}else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$valid = false;	
			}	
		}
		
		if($valid){
			$data_email['message'] = $this->input->post();
			
			//send contact email to admin
			$message = $this->load->view('email/contact_us',$data_email,true);
			$to = 'kaushtuv@propagate.com.au';
			
			$email_data = array(
					'to' => $to ? $to : INFO_EMAIL,
					'from' => 'webmaster@propertyms.com.au',
					'from_text' => 'Contact Form Inquiry - PropertyMS',
					'subject' => 'Message Received From Contact Form - '.date('d F,Y'),
					'message' => $message
					);
	
			if($this->send_email($email_data)){
			 	$this->session->set_flashdata('send_msg',true);
			}else{
				$this->session->set_flashdata('send_msg',false);
			}
		}else{
			$this->session->set_flashdata('send_msg',false);
		}
		redirect('contact-us');
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
			return $this->_send_email_live($data);
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
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */