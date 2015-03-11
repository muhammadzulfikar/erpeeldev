<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller{
	public $data			= array();
	public $page_config		= array();
	public $notification	= array();
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		// $this->user_model->check_rule();
	}

	# fungsi untuk login forum
	public function login()
	{	
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->user_model->check_login();
			if($this->user_model->error_count != 0){
			$this->data['error'] = $this->user_model->error;
			} else {
			redirect('forum/category/lounge');
			}
		}
		$user_register = $this->session->userdata('user_register',1);
		if($user_register != NULL){
			$this->session->unset_userdata('user_register');
			$this->data['user_register'] = 1;
		}
		$this->data['title']	= 'Login - ErpeelDev';
		$this->load->view('forum/login',$this->data);
	}

	public function registration()
	{
		if($this->input->post('btnRegister'))
		{
			$this->user_model->user_create();
			if($this->user_model->error_count != 0){
				$this->data['error'] = $this->user_model->error;
			} else {
				$this->session->set_userdata('user_register',1);
				redirect('forum/login');
			}
		}
		

		$this->data['title'] = 'User Register - ErpeelDev';
		$this->load->view('forum/user_register',$this->data);
	}


	# function untuk logout dari forum
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('forum/login');
	}

	# function for redirect if not found view
	public function error404()
	{
		$this->load->view('forum/404error');
	}

}