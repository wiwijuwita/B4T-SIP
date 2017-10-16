<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items_category_model extends CI_Model
{

    public $table = 'items_category';
    public $id = 'id_category';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_by_name($name)
    {
        $this->db->where('name_category', $name);
        return $this->db->get($this->table)->row();
    }

    function get_like($term,$item){
        if($item!=''){
            //return $this->db->query('select * from user_akun a, position b, division c where a.id_position = b.id_position and c.id_divison = a.id_division')->result();
            return $this->db->query("SELECT * FROM items_category a, items_detail b WHERE a.id_category = b.id_category and a.name_category LIKE '".$term."%' and b.name_items LIKE '".$item."%'")->result();
        }else{
            return $this->db->query("SELECT id_category,name_category FROM items_category WHERE name_category LIKE '".$term."%'")->result();
        }
    }

    function get_id_category_by_item_name($item){
        return $this->db->query("SELECT * FROM items_category a, items_detail b WHERE a.id_category = b.id_category and b.name_items LIKE '".$item."%'")->row();
    }

    // get data by id->result()
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_category', $q);
	$this->db->or_like('name_category', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_category', $q);
	$this->db->or_like('name_category', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Items_category_model.php */
/* Location: ./application/models/Items_category_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-17 10:09:26 */
/* http://harviacode.com */