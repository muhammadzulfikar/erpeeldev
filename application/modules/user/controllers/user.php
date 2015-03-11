<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	public $data 			= array();
	public $notification 	= array();

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		} else {
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->model('thread_model');
		$this->load->model('post_model');
		$this->load->model('role_model');
		$this->load->model('erpeel_model');
		$this->data['navigations'] = $this->category_model->category_get_parent();
		}
	}	

	# function admin untuk melihat data user
	public function user_view()
	{
		if($this->session->userdata('admin_area') == 0){
			redirect('forum/category/lounge');
		} else {
		$tmp_success = $this->session->userdata('tmp_success');
		if($tmp_success != NULL){
			$this->session->unset_userdata('tmp_success');
			$this->data['tmp_success'] = 1;
		}

		$tmp_success_del = $this->session->userdata('tmp_success_del');
		if($tmp_success_del != NULL){
			$this->session->unset_userdata('tmp_success_del');
			$this->data['tmp_success_del'] = 1;
		}

		$this->db->order_by('username','asc');
		$this->data['users'] = $this->db->get('rpl_user')->result();
		$this->data['title'] = 'User View - ErpeelDev ';
		$this->load->view('layout/header',$this->data);
		$this->load->view('user/user_view');
		$this->load->view('layout/footer');
		}
	}

	# function admin untuk membuat user
	public function user_create()
	{
		if($this->session->userdata('user_create') == 0){
			redirect('forum/category/lounge');
		} else {
		if($this->input->post('btnCreate'))
		{
			$this->user_model->user_create();
			if($this->user_model->error_count != 0){
				$this->data['error'] = $this->user_model->error;
			} else {
				$this->session->set_userdata('tmp_success',1);
				redirect('admin/user_create');
			}
		}
		$tmp_success = $this->session->userdata('tmp_success',1);
		if($tmp_success != NULL){
			// new user created
			$this->session->unset_userdata('tmp_success');
			$this->data['tmp_success'] = 1;
		}

		$this->data['title'] = 'Add User - ErpeelDev ';
		$this->load->view('layout/header',$this->data);
		$this->load->view('user/user_create');
		$this->load->view('layout/footer');
		}
	}

	# function admin untuk hapus user
	public function user_delete($user_id)
	{
		if($this->session->userdata('user_delete') == 0){
			redirect('forum/category/lounge');
		} else {
		$user_id = decode_url($user_id);
		$this->db->delete('rpl_user',array('id_user' => $user_id));
		$this->session->set_userdata('tmp_success_del',1);
		redirect('admin/user_view');
		}
	}

	# function untuk edit user
	public function user_profile($user_id)
	{
		# event button profile
		$user_id = decode_url($user_id); 
		if($this->input->post('btnProfile') or ($this->input->post('btnPassword')))
		{
			$this->user_model->user_edit();
			if($this->user_model->error_count != 0){
				$this->data['error'] = $this->user_model->error;				
			} else {
				$this->session->set_userdata('user_update',1);
				redirect('forum/user_profile/'.encode_url($user_id));
			}
		}

		$user_update = $this->session->userdata('user_update',1);
		if($user_update != NULL){
			$this->session->unset_userdata('user_update');
			$this->data['user_update'] = 1;
		}
		
		$this->data['roles'] 	= $this->role_model->get_role_all();
		$this->data['status'] 	= $this->erpeel_model->get_all_data('*','rpl_status');
 		$this->data['user'] 	= $this->user_model->get_user_by_id($user_id);
		$this->data['title'] = 'Edit User - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('user/user_profile');
		$this->load->view('layout/footer');
	}

}
