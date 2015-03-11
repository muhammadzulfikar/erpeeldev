<?php

Class User_model extends CI_Model{
	public $error		= array();
	public $error_count	= 0;
	public $notif		= array();

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user_by_id($user_id)
	{
		$sql = "SELECT a.*,b.id_status,b.status
				FROM rpl_user a,rpl_status b
				WHERE a.id_user =$user_id AND a.status_id = b.id_status
				ORDER BY a.name asc";
		return $this->db->query($sql)->row();
	}
	
	# model login check / authentication login
	public function check_login()
	{
        $row = $this->input->post('row');
        $key = $this->config->item('encryption_key');
        
        $data = array('username' => $row['username']);

        $query = $this->db->get_where('rpl_user', $data);
        
        $plain_password = '';
        if (($query->num_rows() == 1) ) {
            $user = $query->row();
            $plain_password = $this->encrypt->decode($user->password, $key);
        }
        
       
        if (($query->num_rows() == 0) && ($plain_password != $row['password'])) {
        	$this->error['login'] = 'Login gagal';
			$this->error_count = 1;
		} 

		else if ($plain_password != $row['password']){
			$this->error['password'] = 'Password tidak tepat';
			$this->error_count = 1;
		}
		
			 // if user found
		if(count($this->error) == 0){
			$row = $query->row();
			$this->session->set_userdata('rpl_logged_in',1);
			$this->session->set_userdata('rpl_user_id',$row->id_user);
			$this->session->set_userdata('rpl_username',$row->username);
			$this->session->set_userdata('rpl_user_img',$row->image);
			$this->session->set_userdata('rpl_user_role',$row->role_id);
		}
	}

	# insert user into rpl_user table
	public function user_create()
	{
		$row = $this->input->post('row');

		// check username
		$check_username = $this->db->get_where('rpl_user',array('username' => $row['username']))->num_rows();
		if($check_username > 0)
		{
			$this->error['username'] = 'Username "'.$row['username'].'" tidak bisa digunakan';
		}
		// check email
		$check_email = $this->db->get_where('rpl_user',array('email' => $row['email']))->num_rows();
		if($check_email > 0)
		{
			$this->error['email'] = 'email "'.$row['email'].'" tidak bisa digunakan';
		}

		
		

		# event when error not found
		if(count($this->error) == 0){
			$key = $this->config->item('encryption_key');
			$row['image']		= 'default.jpg';
			$row['status_id']	= 4;
			$row['password'] 	= $this->encrypt->encode($row['password'],$key);
			$this->db->insert('rpl_user',$row);
		} else {
			$this->error_count = count($this->error);
		}
	}

	# update user into rpl_user table
	public function user_edit()
	{
		$row = $this->input->post('row');
		# upload photo

		if($this->input->post('image') == '')
		{
			$config['upload_path']		= './assets/images/user/';
			$config['allowed_types']	= 'gif|jpg|png|JPEG';
			$config['max_size']			= '0';
			$config['file_name']		= $row['id_user'];
			$config['encrypt_name']		= TRUE;
			$config['overwrite']		= TRUE;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('image'))
			{
				$row['image']		= $row['image_user'];
			}
			else
			{
				$row['image']		= $this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['source_image']	= './assets/images/user/'.$row['image'];
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 300;
				$config['height']	= 300;
				$this->load->library('image_lib', $config); 
				$this->image_lib->resize();
			}
		}

		# event on update profil anda
		if($this->input->post('btnProfile'))
		{
			// upload image
			$config['upload_path'] = './assets/images/user/';
			$config['allowed_types'] = 'gif|jpg|png|JPEG';
			$config['max_size']			= '0';
			$config['file_name'] = $this->input->post('image');
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = TRUE;
			$this->upload->initialize($config);

		if($row['username'] != $row['username_user'])
		{
			$check_username = $this->db->get_where('rpl_user',array('username' => $row['username']));
			if($check_username->num_rows() > 0)
			{
				$this->error['username'] = 'Username "'.$row['username'].'" tidak bisa digunakan';
			}
		}

		// check email
		if($row['email'] != $row['email_user'])
		{
			$check_email = $this->db->get_where('rpl_user',array('email' => $row['email']));
			if($check_email->num_rows() > 0)
			{
				$this->error['email'] = 'email "'.$row['email'].'" tidak bisa digunakan';
			}
		}

		# event when error not found
		if(count($this->error) == 0){
			
				unset($row['username_user']);
				unset($row['email_user']);
				unset($row['image_user']);
				
				$this->db->where('id_user',$row['id_user']);
				$this->db->update('rpl_user',$row);
				# update session user
				$this->session->set_userdata('rpl_username',$row['username']);
				$this->session->set_userdata('rpl_user_img',$row['image']);
				$this->notif['update'] = 'Update data berhasil';
				} 
				else {
				$this->error_count = count($this->error);
			}
		}	

		# event untuk update password	
		if($this->input->post('btnPassword'))
		{
			$row = $this->input->post('row');
			$get = $this->db->get_where('rpl_user',array('id_user'=>$row['id_user']))->row();
			$password = $get->password;
			$key = $this->config->item('encryption_key');
			$old_password = $this->encrypt->decode($password,$key);
			if($old_password != $row['password_old'])
			{
				$this->error['password_old'] = 'Password yang anda masukan salah';
			}
			$key = $this->config->item('encryption_key');
			$row['password'] = $this->encrypt->encode($row['password'],$key);

			if(count($this->error) == 0){
				unset($row['image_user']);
				unset($row['password_old']);
				$this->db->where('id_user',$row['id_user']);
				$this->db->update('rpl_user',$row);
			}
		}			
				
	}


}