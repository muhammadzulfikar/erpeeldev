<?php

class Post_model extends CI_Model{
	public $data			= array();
	public $error			= array();
	public $error_count	= 0;

	public function __construct()
	{
		parent::__construct();
	}	

	public function get_post_by_user($user_id)
	{
		$sql = "SELECT a.*,b.url_title,title
				FROM rpl_post a, rpl_thread b
				WHERE a.user_id = $user_id AND a.thread_id = b.id_thread
				ORDER BY a.date_add desc";
		return $this->db->query($sql)->result();
	}

	public function get_post($thread_id,$start,$limit)
	{
		$sql = "SELECT a.*, b.username, b.id_user as user_id,b.image as image_user
				FROM rpl_post a,rpl_user b
				WHERE a.thread_id = ".$thread_id." AND a.user_id = b.id_user
				ORDER BY a.date_add ASC LIMIT ".$start.",".$limit;
		return $this->db->query($sql);
	}

	public function comment()
	{
		$row = $this->input->post('row');
		if(strlen($row['post']) == 0)
		{
			$this->error['post'] ='Komentar tidak boleh kosong';
		}

		if(count($this->error) == 0){
			$this->db->insert('rpl_post',$row);
		} else {
			$this->error_count = count($this->error);
		}
	}

	public function edit_comment()
	{
		$row = $this->input->post('row');
		if(strlen($row['post']) == 0)
		{
			$this->error['post'] = 'Komentar tidak boleh kosong';
		} 

		if(count($this->error) == 0){
			$this->db->where('id_post',$row['id_post']);
			$this->db->update('rpl_post',$row);
		} else {
			$this->error_count = count($this->error);
		}
	}
}