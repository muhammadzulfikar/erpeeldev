<?php

class Library_model extends CI_Model{
	public $error		= array();
	public $error_count = 0;
	public $data		= array();
	public $fields		= array();

	public function __construct()
	{
		parent::__construct();
	}

	public function library_get_limit($start,$limit)
	{
		$sql = "SELECT a.*, b.id_category as category, c.id_user,c.name as name
				FROM rpl_library a,rpl_category b,rpl_user c
				WHERE a.category_id = b.id_category AND a.user_id = c.id_user
				ORDER BY a.title 
				DESC LIMIT ".$start.",".$limit;
		return $this->db->query($sql)->result();
	}

	public function library_get_all()
	{
		$sql = "SELECT a.id_library,a.category_id,a.user_id,a.title,b.id_category,b.name as category_name ,c.id_user,c.name as user_name
				FROM rpl_library a,rpl_category b,rpl_user c
				WHERE a.category_id = b.id_category AND a.user_id = c.id_user
				ORDER BY a.title";
		return $this->db->query($sql);
	}

	public function library_get_by_user($user_id)
	{
		$sql = "SELECT a.id_library,a.category_id,a.user_id,a.title
				FROM rpl_library a
				WHERE a.user_id = ".$user_id."
				ORDER BY a.title";
		return $this->db->query($sql)->result();	
	}

	public function library_get_by_id($id_library)
	{
		$sql = "SELECT * FROM rpl_library where id_library =".$id_library."";
		return $this->db->query($sql)->row();
	}

	public function library_get_total()
	{
		$sql = "SELECT id_library from rpl_library";
		return $this->db->query($sql)->num_rows();
	}

	public function library_create()
	{
		$library = $this->input->post('row');
		$this->fields 	= $library;
		$title_check = $this->db->get_where('rpl_library', array('title' => $library['title']));
		if($title_check->num_rows() > 0){
			$this->error['title'] = 'Judul Buku "'.$library['title'].'" Tidak bisa digunakan';
		}

		if($this->input->post('book') == ''){
			$config['upload_path'] 		= './assets/library/files/';
			$config['allowed_types'] 	= 'pdf|doc|docx';
			$config['max_size']			= '0';
			$config['file_name'] 		= $library['title'];
			$config['overwrite'] 		= TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('book'))
			{
				$this->error['book']	= 'Silahkan pilih file untuk di upload';
			}
			else
			{
				$library['book']	= $this->upload->file_name;
			}
		}

		if($this->input->post('image') == ''){
			$config['upload_path'] 	 = './assets/library/images/';
			$config['allowed_types'] = 'jpg|png|JPEG|gif|PNG';
			$config['max_size']			= '0';
			$config['file_name']	 = $this->input->post('image');
			$config['overwrite']	 = TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image'))
			{
				$library['image']		= 'default.jpg';
			}
			else
			{
				$library['image']		= $this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['source_image']	= './assets/library/images/'.$library['image'];
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 180;
				$config['height']	= 155;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
		}

		if(count($this->error) == 0){
			
			$library['url_title'] 	= underscore($library['title']);
			$library['date_add']	= date("Y-m-d H:i:s");
			$library['user_id']		= $this->session->userdata('rpl_user_id');
			$this->db->insert('rpl_library',$library);
		} else {
			$this->error_count = count($this->error);
		}
	}

	public function library_edit()
	{
		$library = $this->input->post('row');


		if($library['title'] != $library['title_library'])
		{
			$check_title = $this->db->get_where('rpl_library',array('title' => $library['title']));
			if($check_title->num_rows() > 0)
			{
				$this->error['title'] = 'Buku "'.$library['title'].'" tidak bisa digunakan';
			}
		}

		if($this->input->post('book') == ''){
			$config['upload_path'] 		= './assets/library/files/';
			$config['allowed_types'] 	= 'pdf|doc|docx';
			$config['max_size']			= '0';
			$config['file_name'] 		= $library['title'];
			$config['overwrite'] 		= TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('book'))
			{
				$library['book']	= $library['book_library'];
			}
			else
			{
				$library['book']	= $this->upload->file_name;
			}
		}

		if($this->input->post('image') == ''){
			$config['upload_path'] 	 = './assets/library/images/';
			$config['allowed_types'] = 'jpg|png|JPEG|gif|PNG';
			$config['max_size']			= '0';
			$config['file_name']	 = $this->input->post('image');
			$config['overwrite']	 = TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image'))
			{
				$library['image']		= $library['image_library'];
			}
			else
			{
				$library['image']		= $this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['source_image']	= './assets/library/images/'.$library['image'];
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 180;
				$config['height']	= 155;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
		}

		if(count($this->error) == 0){
		unset($library['book_library']);
		unset($library['image_library']);
		unset($library['title_library']);

		$library['url_title']	= underscore($library['title']);
		$library['date_edit']	= date("Y-m-d H:i:s");
		$this->db->where('id_library',$library['id_library']);
		$this->db->update('rpl_library',$library);
		} else {
			$this->error_count = count($this->error);
		}
	}
}