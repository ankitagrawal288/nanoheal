<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common_model extends CI_Model {
	function __construct()
	{
		$this->load->database();
	}
	public function insert($table_name,$data)
	{
		$response=$this->db->insert($table_name,$data);
		return $response;
	}
	public function read_data($table_name)
	{
		$response=$this->db->get($table_name);
		return $response->result();
	}
	public function read_data_where($table_name,$where)
	{
		$this->db->where($where);
		$response=$this->db->get($table_name);
		return $response->result();
	} 
	public function update_data_where($table_name,$where,$data)
	{
		$this->db->where($where);
		$response=$this->db->update($table_name,$data);
		return $response;
    }

	public function image_data($data)
	{
		$this->db->select("im.id as image_id, im.file_name as image_name, im.file_type as image_type, im.file_size as image_size,im.date_added as image_added,
		ti.file_name as thumbnail_name, ti.file_type as thumbnail_type, ti.file_size as thumbnail_size,ti.date_added as thumbnail_added,
		users.first_name, users.last_name,users.user_role");
		$this->db->from("images as im");
		$this->db->join("thumbnail_images as ti", 'ti.image_id = im.id','inner');
		$this->db->join('users',"users.id = im.user_id",'left');
		if(isset($data['user_role']) && $data['user_role'] !='1')
		{
			$this->db->where("im.user_id", $data['id']);
		} 

		$this->db->where("im.is_deleted",'0');

		$response=$this->db->get();
		return $response->result();

	}
}