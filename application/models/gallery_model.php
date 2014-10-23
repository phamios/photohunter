<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function _listgallery() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('tbl_gallery');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    public function list_random(){
        $this->db->order_by('id','random');
        $this->db->limit(25);
        $query = $this->db->get('tbl_gallery');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return null;
        }
    }

    public function list_by_cate($cate_id = null) {
        $this->db->order_by('id', 'asc');
        $this->db->where('cate_id', $cate_id);
        $query = $this->db->get('tbl_gallery');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function get_details($id = null) {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_gallery');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _list_gallery($num, $offset) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_gallery', $num, $offset);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _ajax_list($position,$items_per_group) { 
        $query = $this->db->query("SELECT * FROM tbl_gallery ORDER BY id ASC LIMIT $position, $items_per_group ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    public function _ajax_list_bycate($position,$items_per_group,$cate_id) { 
        $query = $this->db->query("SELECT * FROM tbl_gallery WHERE cate_id = $cate_id ORDER BY id ASC LIMIT $position, $items_per_group ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _list_gallery_cate($cate_id, $num, $offset) {
        $this->db->where('cate_id', $cate_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_gallery', $num, $offset);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function add_image($cate_root, $cate_id, $cate_name, $gallery_name, $gallery_link, $gallery_description) {
        $data = array(
            'cate_root' => $cate_root,
            'cate_id' => $cate_id,
            'cate_name' => $cate_name,
            'gallery_name' => $gallery_name,
            'gallery_link' => $gallery_link,
            'gallery_description' => $gallery_description,
            'gallery_date' => date("d-m-Y"),
        );
        $this->db->insert('tbl_gallery', $data);
    }

    function _del($id) {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('tbl_gallery');
    }

    function _total() {
        $this->load->database();
        return $this->db->count_all('tbl_gallery');
    }

    function total_by_cate($cate_id = null) {
        $this->load->database();
        $this->db->where('cate_id', $cate_id);
        return $this->db->count_all('tbl_gallery');
    }

}
