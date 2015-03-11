<?php

class Thread_model extends CI_Model {
	public $error		= array();
	public $error_count	= 0;
	public $data		= array();
	public $fields		= array();

	public function __construct()
	{
		parent::__construct();
	}

	public function thread_get_all()
    {
        $sql = "SELECT a.*, b.name as category_name FROM rpl_thread a, rpl_category b 
                WHERE a. category_id = b.id_category ORDER BY a.date_add DESC";
        return $this->db->query($sql)->result();
    }

	public function get_all($start,$limit)
	{
		$sql = "SELECT a.*, b.name as category_name, b.url as category_url, c.date_add 
				FROM rpl_thread a, rpl_category b, rpl_post c 
				WHERE a.category_id = b.id_category AND a.id_thread = c.thread_id AND c.date_add = (SELECT MAX(date_add) FROM rpl_post WHERE thread_id = a.id_thread LIMIT 1)
				ORDER BY c.date_add DESC LIMIT ".$start.",".$limit;
		return $this->db->query($sql)->result();
	}

	public function get_thread($category,$start,$limit)
	{
		$sql = "SELECT a.*, b.name as category_name, b.url as category_url,c.name as name_user,c.image as image_user  
				FROM rpl_thread a,rpl_category b,rpl_user c
				WHERE a.category_id = b.id_category AND b.url = '".$category."' AND a.user_id = c.id_user
				ORDER BY date_last_post 
				DESC LIMIT ".$start.",".$limit;
		return $this->db->query($sql)->result();	
	}

	public function get_thread_total($category)
	{
		$sql = "SELECT a.id_thread,a.category_id,b.id_category,b.url
				FROM rpl_thread a,rpl_category b
				WHERE a.category_id = b.id_category AND b.url = '".$category."'";
		return $this->db->query($sql)->num_rows();
	}


	public function get_thread_talk($url)
	{
		$sql = "SELECT a.*, b.name as username,b.id_user as id_user,b.image as image_user,c.name
				FROM rpl_thread a,rpl_user b,rpl_category c
				WHERE a.id_thread = '".$url."' AND b.id_user = a.user_id AND a.category_id = c.id_category"; 
		return $this->db->query($sql)->result();
	}

	public function get_thread_by_user($user_id)
	{
		$sql = "SELECT a.*,b.name as category_name
				FROM rpl_thread a, rpl_category b
				WHERE a.user_id = $user_id AND a.category_id = b.id_category
				ORDER BY a.date_add desc";
		return $this->db->query($sql)->result();
	}

	public function get_counter_thread($url)
	{
		$row = $this->db->get_where('rpl_thread',array('id_thread'=>$url))->row();
		$counter = $row->counter;
		$counter_insert = $counter+1;
		$this->db->where('id_thread',$url);
		$this->db->update('rpl_thread',array('counter'=>$counter_insert));
	}

	public function thread_create()
	{
		$thread = $this->input->post('row');
		$this->fields['category'] = $this->input->post('category');
		$title_check = $this->db->get_where('rpl_thread',array('title' => $thread['title']));
		if($title_check->num_rows() > 0){
			$this->error['title'] = 'Title "'.$thread['title'].'" tidak bisa digunakan';
		}

		if(strlen($thread['content']) == 0){
			$this->error['content'] = 'Konten harus diisi';
		}

		if($this->input->post('image') == ''){
			$config['upload_path'] 	 = './assets/images/thread/';
			$config['allowed_types'] = 'jpg|png|JPEG|gif|PNG';
			$config['max_size']			= '0';
			$config['file_name']	 = $this->input->post('image');
			$config['overwrite']	 = TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image'))
			{
				$thread['image']		= 'default.jpg';
			}
			else
			{
				$thread['image']		= $this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['source_image']	= './assets/images/thread/'.$thread['image'];
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 180;
				$config['height']	= 155;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
		}

		if(count($this->error) == 0){
			// insert into rpl_thread;
			
			$thread['url_title'] = underscore($thread['title']);
			$thread['date_add'] = date("Y-m-d H:i:s");
			$thread['date_last_post'] = date("Y-m-d H:i:s");
			$thread['user_id'] = $this->session->userdata('rpl_user_id');
			$this->db->insert('rpl_thread',$thread);
		} else {
			$this->error_count = count($this->error);
		}
	}

	public function thread_edit()
	{
		$row = $this->input->post('row');
		$this->fields = $row;

		if(strlen($row['content']) == 0){
			$this->error['content'] = 'Konten tidak boleh kosong';
		}

		if($this->input->post('image') == ''){
			$config['upload_path'] 	 = './assets/images/thread/';
			$config['allowed_types'] = 'jpg|png|JPEG|gif|PNG';
			$config['max_size']			= '0';
			$config['file_name']	 = $this->input->post('image');
			$config['overwrite']	 = TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image'))
			{
				$row['image']		= $row['image_library'];
			}
			else
			{
				$row['image']		= $this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['source_image']	= './assets/images/thread/'.$row['image'];
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 180;
				$config['height']	= 155;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
		}

		if(count($this->error) == 0){
			$row['url_title'] = underscore($row['title']);
			$row['date_edit'] = date("Y-m-d H:i:s");
			$this->db->where('id_thread',$row['id_thread']);
			$this->db->update('rpl_thread',$row);
		} else {
			$this->error_count = count($this->error);
		}

	}
}