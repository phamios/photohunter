<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    public function show_all(){ 
         $this->db->order_by('id', 'asc');
        $query = $this->db->get('tbl_type');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function get_details($id = null) {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_type');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _list($num, $offset) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('tbl_type', $num, $offset);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _add($type_name) {
        $data = array(
            'type_name' => $type_name, 
        );
        $this->db->insert('tbl_type', $data);
    }

    function _update($id,$type_name) {
        $data = array(
            'id'=>$id,
            'type_name' => $type_name, 
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_type', $data);
    }

      
    function _del($id) {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('tbl_type');
    }

    function _total() {
        $this->load->database();
        return $this->db->count_all('tbl_type');
    }
 

}
