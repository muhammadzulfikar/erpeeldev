<?php

class Category_Model extends CI_Model{

	public $error 		= array();
	public $error_count = 0;
	public $data 		= array();
	public $fields		= array();

	public function __construct()
	{
		parent::__construct();
	}

	public function category_create()
	{
		$row = $this->input->post('row');
		$this->fields = $row;
		/* check name
		
		$check_category = $this->db->get_where('rpl_category',array('name'=>$row['name']))->num_rows();
		if($check_category > 0){
			$this->error['name'] = 'Category "'.$row['name'].'" already used';
		}
		*/

		if(count($this->error) == 0)
		{
			$this->load->helper('inflector');
			$row['url'] = underscore($row['name']);
			$this->db->insert('rpl_category',$row);
		} else {
			$this->error_count = count($this->error);
		}
	}
	
	public function category_edit()
	{
		$row = $this->input->post('row');

		// check url
		if($row['url'] != $row['url_category']){
			$check_url = $this->db->get_where('rpl_category',array('url' => $row['url']));
			if($check_url->num_rows() > 0){
				$this->error['url'] = 'Url "'.$row['url'].'" sudah digunakan';
			}
		}

		if(count($this->error) == 0)
		{
			unset($row['name_category']);
			unset($row['url_category']);
			$this->load->helper('inflector');
			$row['url'] = underscore($row['name']);
			$this->db->where('id_category',$row['id_category']);
			$this->db->update('rpl_category',$row);
		} else {
			$this->error_count = count($this->error);
		}

	}

	public function category_get_all($category_id = 0)
	{
		$this->data = array();
		$this->db->order_by('name','asc');
		$query = $this->db->get_where('rpl_category',array('parent_id' => $category_id));
		$counter = 0;
		foreach($query->result() as $row){
			$this->data[$counter]['id_category'] = $row->id_category;
			$this->data[$counter]['parent_id'] = $row->parent_id;
			$this->data[$counter]['name'] = $row->name;
			$this->data[$counter]['url'] = $row->url;
			$this->data[$counter]['real_name'] = $row->name;
			$children = $this->category_get_children($row->id_category,' - ',$counter);
			$counter = $counter + $children;
			$counter++;
		}
		return $this->data;
	}

	public function category_get_children($id,$separator,$counter)
	{
		$this->db->order_by('name','asc');
		$query = $this->db->get_where('rpl_category',array('parent_id' => $id));
		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			foreach($query->result() as $row)
			{
				$counter++;
				$this->data[$counter]['id_category'] = $row->id_category;
				$this->data[$counter]['parent_id'] = $row->parent_id;
				$this->data[$counter]['name'] = $separator.$row->name;
				$this->data[$counter]['url'] = $row->url;
				$this->data[$counter]['real_name'] = $row->name;
				$children = $this->category_get_children($row->id_category,$separator.' - ',$counter);
				if($children != FALSE)
				{
					$counter = $counter + $children;
				}
			}
			return $counter;
		}
	}

	public function category_get_all_parent($id,$counter)
	{
		$row = $this->db->get_where('rpl_category', array('id_category'=>$id))->row_array();
		$this->data[$counter] = $row;
		if($row['parent_id'] != 0){
			$counter++;
			$this->category_get_all_parent($row['parent_id'],$counter);
		}
		return array_reverse($this->data);
 	}

 	public function category_get_parent()
 	{
 		$sql = "SELECT * FROM rpl_category 
		WHERE parent_id = 0 AND status_active_id = 1
		ORDER BY id_category";
		return $this->db->query($sql)->result();
 	}

 	public function category_get_parent_thread($parent)
	{
		$sql = "SELECT * FROM rpl_category 
		WHERE parent_id = ".$parent."
		ORDER BY name";
		return $this->db->query($sql)->result();
	}
}