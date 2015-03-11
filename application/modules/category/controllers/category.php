<?php

class Category extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		} else {
		$this->load->model('thread_model');
		$this->load->model('category_model');
		$this->load->model('library_model');
		$this->load->model('role_model');
		$this->load->model('erpeel_model');
		$this->role_model->check_role();
		$this->data['navigations'] = $this->category_model->category_get_parent();
		}
	}

	# function for pagination
	public function set_pagination()
	{
		$this->page_config['first_link']         = '&lsaquo; First';
        $this->page_config['first_tag_open']     = '<li>';
        $this->page_config['first_tag_close']    = '</li>';
        $this->page_config['last_link']          = 'Last &raquo;';
        $this->page_config['last_tag_open']      = '<li>';
        $this->page_config['last_tag_close']     = '</li>';
        $this->page_config['next_link']          = 'Next &rsaquo;';
        $this->page_config['next_tag_open']      = '<li>';
        $this->page_config['next_tag_close']     = '</li>';
        $this->page_config['prev_link']          = '&lsaquo; Prev';
        $this->page_config['prev_tag_open']      = '<li>';
        $this->page_config['prev_tag_close']     = '</li>';
        $this->page_config['cur_tag_open']       = '<li class="active"><a href="javascript://">';
        $this->page_config['cur_tag_close']      = '</a></li>';
        $this->page_config['num_tag_open']       = '<li>';
        $this->page_config['num_tag_close']      = '</li>';
	}

	# function index category forum
	public function index($category,$start = 0)
	{
		// session login check
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		}

		// cek categori jika tidak ada akan di direct
		$category_name = $this->db->get_where('rpl_category',array('url'=>$category));
		if($category_name->num_rows == 0){
			redirect('forum/error404');
		}

		// stage layout
		if($category=='learn'){
		$this->data['stages']	= $this->category_model->category_get_parent_thread($parent=3);
		$this->data['title']	= ' Learning - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/learn');
		$this->load->view('layout/footer');
		}
		// category library
		/*
		else if($category=='library'){
		// set pagination
		$this->load->library('pagination');
		$this->page_config['base_url']		= site_url('forum/category/'.$category.'/');
		$this->page_config['uri_segment'] 	= 4;
		$this->page_config['total_rows']	= $this->library_model->library_get_total();
		$this->page_config['per_page']		= 8;
		$this->set_pagination();
		$this->pagination->initialize($this->page_config);
		//notification
		$notification['library_create'] = $this->session->userdata('library_create');
		if($notification['library_create'] != NULL){
			$this->session->unset_userdata('library_create');
			$this->data['library_create'] = 1;
		}
		// load view
		$this->data['page']			= $this->pagination->create_links();
		$this->data['libraries'] 	= $this->library_model->library_get_limit($start,$this->page_config['per_page']);
		$this->data['categories']	= $this->category_model->category_get_parent_thread($parent=5);
		$this->data['title']		= ' Perpustakaan - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/library_view');
		$this->load->view('layout/footer');
		}
		*/
		// studio layout
		else if($category=='moment'){
		$this->data['title']	= ' Moment - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/moment');
		$this->load->view('layout/footer');
		}
		else {
		// set pagination
		$this->load->library('pagination');
		$this->page_config['base_url']		= site_url('forum/category/'.$category.'/');
		$this->page_config['uri_segment'] 	= 4;
		$this->page_config['total_rows']	= $this->thread_model->get_thread_total($category);
		$this->page_config['per_page']		= 10;
		$this->set_pagination();
		$this->pagination->initialize($this->page_config);
		// load layout
		$this->data['page']		= $this->pagination->create_links();
		$this->data['title']	= ucfirst($this->uri->segment(3)).' - ErpeelDev';
		$this->data['category'] = $category; 
		$this->data['threads']	= $this->thread_model->get_thread($category,$start,$this->page_config['per_page']);

		$thread_create = $this->session->userdata('thread_create');
		if($thread_create != NULL){
			$this->session->unset_userdata('thread_create');
			$this->data['thread_create'] = 1;
		}
		
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/thread_list');
		$this->load->view('layout/footer');
		}
		
	}

	public function category_view()
	{
		if($this->session->userdata('admin_area') == 0){
			redirect('forum/category/lounge');
		}	else {
			
		$tmp_success_update = $this->session->userdata('tmp_success_update');
		if($tmp_success_update != NULL){
			// new category created
			$this->session->unset_userdata('tmp_success_update');
			$this->data['tmp_success_update'] =1 ;
		}
		
		$this->data['categories'] = $this->category_model->category_get_all();
		$this->data['title'] = 'View Category - ErpeelDev ';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/category_view_admin');
		$this->load->view('layout/footer');
		}
	}

	public function category_create()
	{
		if($this->session->userdata('category_create') == 0){
			redirect('forum/category/lounge');
		} else {
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$this->category_model->category_create();
			if($this->category_model->error_count != 0){
				$this->data['error'] = $this->category_model->error;
			} else {
				$this->session->set_userdata('tmp_success',1);
				redirect('admin/category_create');
			}
		}

		$tmp_success = $this->session->userdata('tmp_success');
		if($tmp_success != NULL){
			$this->session->unset_userdata('tmp_success');
			$this->data['tmp_success'] = 1;
		}
		
		$this->data['status_active'] = $this->erpeel_model->get_all_data('*','rpl_status_active');
		$this->data['categories'] = $this->category_model->category_get_all();
		$this->data['title'] = 'Add Category - ErpeelDev ';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/category_create_admin');
		$this->load->view('layout/footer');
	}
	}

	public function category_edit($category_id)
	{
		if($this->session->userdata('category_edit') == 0){
			redirect('forum/category/lounge');
		} else {
		$category_id = decode_url($category_id);
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->category_model->category_edit();
			if($this->category_model->error_count != 0){
				$this->data['error'] = $this->category_model->error;
			} else {
				$this->session->set_userdata('tmp_success_update',1);
				redirect('admin/category_view');
			}
		}
		
		$this->data['category'] = $this->db->get_where('rpl_category',array('id_category' => $category_id))->row();
		$this->data['categories'] = $this->category_model->category_get_all();
		$this->data['status_active'] = $this->erpeel_model->get_all_data('*','rpl_status_active');
		$this->data['title'] = 'Edit Category - ErpeelDev ';
		$this->load->view('layout/header',$this->data);
		$this->load->view('category/category_edit_admin');
		$this->load->view('layout/footer');
		}
	}

	public function category_delete($category_id)
	{
		if($this->session->userdata('category_delete') == 0){
			redirect('forum/category/lounge');
		} else {
		$category_id = decode_url($category_id);
		$this->db->delete('rpl_category', array('id_category' => $category_id));
		$this->session->set_userdata('tmp_success_del',1);
		redirect('admin/category_view');
		}
	}

}