<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		} else {
		$this->load->model('thread_model');	
		$this->load->model('post_model');
		$this->load->model('category_model');
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

	# function interactive thread forum
	public function talk($url, $start = 0)
	{	
		$url = decode_url($url);
		// session login check
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		}

		// direct url if thread not found
		$talk_name = $this->db->get_where('rpl_thread',array('id_thread'=>$url));
		if($talk_name->num_rows == 0){
			redirect('forum/error404');
		}

		// load thread for pagination
		$this->load->library('pagination');
		$this->page_config['base_url'] = site_url('thread/talk/'.$url.'/');
		$this->page_config['uri_segment'] = 4;
		$this->page_config['total_rows'] = $this->db->get_where('rpl_post',array('thread_id' => $url))->num_rows();
		$this->page_config['per_page'] = 5;
		$this->set_pagination();
		$this->pagination->initialize($this->page_config);

		// load data layout
		$title = $this->db->get_where('rpl_thread',array('id_thread'=>$url))->row();
		$this->data['thread_title'] = $title->title;
		$this->data['title'] = $title->title.' - ErpeelDev';
		$this->data['page'] = $this->pagination->create_links();
		$this->data['threads'] = $this->thread_model->get_thread_talk($url);
		$this->data['posts'] = $this->post_model->get_post($url,$start,$this->page_config['per_page'])->result();
		$this->data['total_post'] = $this->post_model->get_post($url,$start,$this->page_config['per_page'])->num_rows();
		$this->thread_model->get_counter_thread($url);

		// notifikasi
		$notification['thread_update'] = $this->session->userdata('thread_update');
		if($notification['thread_update'] != NULL){
			$this->session->unset_userdata('thread_update');
			$this->data['thread_update'] = 1;
		}

		$notification['post_update'] = $this->session->userdata('post_update');
		if($notification['post_update'] != NULL){
			$this->session->unset_userdata('post_update');
			$this->data['post_update'] = 1;
		}
		$notification['post_create'] = $this->session->userdata('post_create');
		if($notification['post_create'] != NULL){
			$this->session->unset_userdata('post_create');
			$this->data['post_create'] = 1;
		}

		// load layout
		$this->load->view('layout/header',$this->data);
		$this->load->view('post/thread_view');
		$this->load->view('layout/footer');
	}

	# function comment / reply thread
	public function reply($url)
	{
		$url = decode_url($url);
			if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->post_model->comment();
			if($this->post_model->error_count != 0){
				$this->data['error'] = $this->post_model->error;
			} else {
				$this->session->set_userdata('post_create',1);
				redirect('forum/talk/'.encode_url($url).'/');
			}
			}
			$thread = $this->db->get_where('rpl_thread',array('id_thread'=>$url))->row();
			$this->data['thread'] = $thread;
			$this->data['title']  = 'Tambah Komentar - ErpeelDev';
			$this->load->view('layout/header',$this->data);
			$this->load->view('post/thread_reply');
			$this->load->view('layout/footer');
	}

	# function edit comment / reply thread
	public function reply_edit($post,$url)
	{
		$post = decode_url($post);
		$url = decode_url($url);
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->post_model->edit_comment();
			if($this->post_model->error_count != 0){
				$this->data['error'] = $this->post_model->error;
			} else {
				$this->session->set_userdata('post_update',1);
				redirect('forum/talk/'.encode_url($url).'/');
			}
			}
			$post = $this->db->get_where('rpl_post',array('id_post'=>$post))->row();
			$this->data['post'] = $post;
			$this->data['title'] = "Edit Komentar - ErpeelDev";
			$this->load->view('layout/header',$this->data);
			$this->load->view('post/thread_reply_edit');
			$this->load->view('layout/footer');
	}

	# function delete comment / reply thread
	public function reply_delete($post_id,$user_id)
	{
		$this->db->delete('rpl_post', array('id_post' => decode_url($post_id)));
		redirect('forum/talk/'.encode_url($url).'/');
	}

	# function view user post
	public function post_user($user_id)
	{
		$user_id = decode_url($user_id);
		$this->data['posts'] = $this->post_model->get_post_by_user($user_id);
		$this->data['title'] = 'My Post - ErpeelDev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('post/user_post');
		$this->load->view('layout/footer');
	}
}