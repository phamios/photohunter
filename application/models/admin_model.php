<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->config->load('config');
        $this->load->database();
    }

    function authen($username, $password) {
        $string_key = $this->config->item('key');
        $this->db->where(array(
            'admin_name' => $username,
            'admin_pass' => md5($string_key . '-' . $password),
        ));
        $query = $this->db->get('tbl_admin');
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function list_user() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_admin');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function details_user($id=null){
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_admin');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function add_user($name, $pass, $type) {
        $data = array(
            'admin_name' => $name,
            'admin_pass' => md5($string_key . '-' . $pass),
            'admin_type' => $type,
        );
        $this->db->insert('tbl_admin', $data);
    }

    function edit_user($id, $pass, $type) {
         
        $data = array( 
            'admin_pass' => md5($string_key . '-' . $pass),
            'admin_type' => $type,
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_admin', $data);
    }
    
    
    function del_user($id=null){
         $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('tbl_admin');
    }
    
}
