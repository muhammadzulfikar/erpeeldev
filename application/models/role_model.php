<?php

class Role_model extends CI_Model{
	public $data 		= array();
	public $error_count = 0;
	public $error 		= array();

	public function __construct()
	{
		parent::__construct();
	}

	public function check_role()
	{
		$user_id = $this->session->userdata('rpl_user_id');
		if($user_id){
			$row = $this->db->get_where('rpl_user',array('id_user' => $user_id))->row();
			$roles = $this->db->get_where('rpl_role',array('id_role' => $row->role_id))->row_array();
			foreach($roles as $key => $value){
				$this->session->set_userdata($key,$value);
			}
		}
	}

	public function role_create()
	{
		// roles function
		$row = $this->input->post('row');

		//check role
		$role_check = $this->db->get_where('rpl_role',array('role'=>$row['role']));
		if($role_check->num_rows() > 0)
		{
			$this->error['role'] = 'role name "'.$row['role'].'" alredy in use';
		}

		if(!isset($row['roles'])){
			$this->error['roles'] = 'Pilih minimal satu role';
		}

		if(count($this->error) == 0){
			$data = array();
			$data['role'] = $row['role'];
			foreach($row['roles'] as $key => $value)
				{
					$data[$key] = 1;
				}
			$this->db->insert('rpl_role',$data);
		} else {
			$this->error_count = count($this->error);
		}
	}

	public function role_edit()
	{
		$row = $this->input->post('row');

		// check role name
		if($row['role'] != $row['role_check']){
			$role_check = $this->db->get_where('rpl_role',array('role' => $row['role']));
			if($role_check->num_rows() > 0){
				$this->error['role'] = 'role dengan nama "'.$row['role'].'" tidak bisa digunakan';
			}
		}

		if(!isset($row['roles'])){
			$this->error['roles'] = 'Pilih minimal 1 role'; 
		}

		if(count($this->error) == 0){
			unset($row['role_check']);

			$row_reset = $row['roles'];
			foreach($row_reset as $key => $value){
				$row_reset[$key] = 0;
			}

			$this->db->where('id_role',$row['id_role']);
			$this->db->update('rpl_role',$row_reset);

			// update role
			$data = array();
			$data['role']  = $row['role'];
			foreach ($row['roles'] as $key => $value){
				$data[$key] = 1;
			}
			$this->db->where('id_role',$row['id_role']);
			$this->db->update('rpl_role',$data);
		} else {
			$this->error_count = count($this->error);
		}
	}

	public function role_get_all()
	{
		$this->db->order_by('role','asc');
		$data = $this->db->get('rpl_role')->result_array();
		$data_return = array();
		$loop = 0;
		foreach($data as $role)
		{
			foreach($role as $key => $value)
			{
				$data_return[$loop][$key] = $value;
			}
			$loop++;
		}
		return $data_return;
	}

	public function get_role_all()
	{
		$sql = "SELECT * FROM rpl_role order by id_role asc";
		return $this->db->query($sql)->result();
	}



}