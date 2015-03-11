<?php
class library extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('rpl_user_id')){
			redirect('forum/index');
		} else {
		$this->load->model('category_model');
		$this->load->model('library_model');
		$this->data['navigations'] = $this->category_model->category_get_parent();
		}
	}

	# function create thread on library
	public function library_create()
	{
		if($this->input->post('btnTambah')){
			$this->library_model->library_create();
			if($this->library_model->error_count != 0)
			{
				$this->data['error'] = $this->library_model->error;
			}
			else
			{
				$this->session->set_userdata('library_create',1);
				redirect('forum/category/library');
			}
		}
		$this->data['categories']	= $this->category_model->category_get_parent_thread($parent=5);
		$this->data['title'] 		= 'Tambah Perpustakaan - Erpeeldev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('library/library_create');
		$this->load->view('layout/footer');
	}

	public function library_user($user_id)
	{
		$user_id = decode_url($user_id);
		$this->data['libraries']	= $this->library_model->library_get_by_user($user_id);
		$this->data['title']		= 'Data Buku - Erpeeldev';
		
		/* notification */
		$library_update = $this->session->userdata('library_update');
		if($library_update != NULL){
			$this->session->unset_userdata('library_update');
			$this->data['library_update'] = 1; 
		}

		$library_delete = $this->session->userdata('library_delete');
		if($library_delete != NULL){
			$this->session->unset_userdata('library_delete');
			$this->data['library_delete'] =1 ;
		}

		/* end notification */
		
		$this->load->view('layout/header',$this->data);
		$this->load->view('library/user_library');
		$this->load->view('layout/footer');	
	}

	public function library_edit($id_library,$user_id)
	{
		$id_library = decode_url($id_library);
		if($this->input->post('btnEdit')){
			$this->library_model->library_edit();
			if($this->library_model->error_count != 0)
			{
				$this->data['error']	= $this->library_model->error;
			}
			else
			{
				$this->session->set_userdata('library_update',1);
				redirect('forum/library_user/'.$user_id);
			}
		}

		$this->data['categories']	= $this->category_model->category_get_parent_thread($parent=5);
		$this->data['library']		= $this->library_model->library_get_by_id($id_library);
		$this->data['title']		= 'Edit Buku - Erpeeldev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('library/library_edit');
		$this->load->view('layout/footer');		
	}

	public function library_delete($id_library,$user_id)
	{
		$id_library = decode_url($id_library);
		$this->db->delete('rpl_library',array('id_library'=>$id_library));
		
		$this->session->set_userdata('library_delete',1);
		redirect('forum/library_user/'.$user_id);
	}

	public function library_admin_view()
	{
		$this->data['libraries']	= $this->library_model->library_get_all()->result();
		$this->data['title']		= 'Data Perpustakaan - Erpeeldev';
		$this->load->view('layout/header',$this->data);
		$this->load->view('library/library_view_admin');
		$this->load->view('layout/footer');
	}
}