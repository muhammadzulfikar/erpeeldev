<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thread extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		} else {
		$this->load->model('thread_model');
		$this->load->model('category_model');
		$this->load->model('post_model');
		$this->load->model('role_model');
		$this->role_model->check_role();
		$this->data['navigations'] = $this->category_model->category_get_parent();
		}
	}

	# function create new thread
	public function thread_create()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->thread_model->thread_create();
			if($this->thread_model->error_count != 0){
				$this->data['error'] = $this->thread_model->error;
			} else {
				$this->session->set_userdata('thread_create',1);
				redirect('forum/category/'.$this->thread_model->fields['category']);
			}
		}
		$url = $this->uri->segment(3);
		$this->data['category'] = $this->db->get_where('rpl_category',array('url'=>$url))->row();
		$this->data['title'] = 'Tambah Thread Baru - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('thread/thread_create');
		$this->load->view('layout/footer');
	}

	# function edit thread
	public function thread_edit($url,$category_id)
	{
		$url = decode_url($url);
		$category_id = decode_url($category_id);
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->thread_model->thread_edit();
			if($this->thread_model->error_count != 0){
				$this->data['error'] = $this->thread_model->error();
			} else {
				$this->session->set_userdata('thread_update',1);
				redirect('forum/talk/'.encode_url($this->thread_model->fields['id_thread']));
			}
		}
		$this->data['thread'] = $this->db->get_where('rpl_thread',array('url_title'=>$url))->row();
		$this->data['categories'] = $this->category_model->category_get_all();
		$this->data['category'] = $this->db->get_where('rpl_category',array('id_category'=>$category_id))->row();
		$this->data['title'] = 'Edit Thread - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('thread/thread_edit');
		$this->load->view('layout/footer');
	}

	# function delete thread
	public function thread_delete($thread_id,$user_id)
	{
		// delete thread
		$this->db->delete('rpl_thread', array('id_thread' => decode_url($thread_id)));

		// delete all posts on this thread
		$this->db->delete('rpl_post', array('thread_id' => decode_url($thread_id)));
		redirect('forum/thread_user/'.$user_id);
	}

	# function thread user
	public function thread_user($user_id)
	{
		$user_id = decode_url($user_id);
		$this->data['threads'] = $this->thread_model->get_thread_by_user($user_id);
		$this->data['title']	= 'My Thread - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('thread/user_thread');
		$this->load->view('layout/footer');
	}

	# function admin view thread
	public function thread_admin_view()
	{
		if($this->session->userdata('admin_area') == 0){
			redirect('forum/category/lounge');
		}
		$tmp_success = $this->session->userdata('tmp_success');
		if($tmp_success != NULL){
			// thread updated
			$this->session->unset_userdata('tmp_success');
			$this->data['tmp_success'] = 1;
		}

		$tmp_success_del = $this->session->userdata('tmp_success_del');
		if($tmp_success_del != NULL){
			// thread deleted
			$this->session->unset_userdata('tmp_success_del');
			$this->data['tmp_success_del'] = 1;
		} 

		$this->data['threads']	= $this->thread_model->thread_get_all();
		$this->data['title']	= 'Admin Thread View - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('thread/thread_view_admin');
		$this->load->view('layout/footer');
	}

	
	# function admin edit thread
	public function thread_admin_edit($category_id,$thread_id)
	{
		if($this->session->userdata('thread_edit') == 0){
			redirect('forum/category/lounge');
		} else {
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->admin_model->thread_edit();
			if($this->admin_model->error_count != 0){
				$this->data['error']	= $this->admin_model->error;
			} else {
				$this->session->set_userdata('tmp_success',1);
				redirect('admin/thread_view');
			}
		}
		$this->data['title']		= 'Admin thread edit - ErpeelDev';
		$this->data['thread']		= $this->db->get_where('rpl_thread',array('id_thread' => $thread_id))->row();
		$this->data['categories']	= $this->category_model->category_get_all();
		$this->data['category'] 	= $this->db->get_where('rpl_category',array('id_category' => $category_id))->row();
		$this->load->view('layout/header',$this->data);
		$this->load->view('thread/thread_edit_admin');
		$this->load->view('layout/footer');
		}
	}

	# function admin delete thread
	public function thread_admin_delete($thread_id)
	{

		if($this->session->userdata('thread_delete') == 0){
			redirect('forum/category/lounge');
		} else {
		// delete thread
		$this->db->delete('rpl_thread', array('id_thread' => $thread_id));

		// delete all posts on this thread
		$this->db->delete('rpl_post', array('thread_id' => $thread_id));
		$this->session->set_userdata('tmp_success_del',1);
		redirect('admin/thread_view');
		}
	}
}