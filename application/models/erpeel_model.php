<?php
// global model class
class Erpeel_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_data($data,$table)
	{
		$sql = "SELECT ".$data." FROM ".$table;
		return $this->db->query($sql)->result();
	}

	public function get_data_by_id($data,$table,$primary,$id)
	{
		$sql = "SELECT ".$data." FROM ".$table." WHERE ".$primary." = ".$id;
		return $this->db->query($sql)->row();
	}
}
?>