<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cateimage_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    
    public function _categories(){
        $this->db->order_by('id','asc');
        $query = $this->db->get('tbl_cateimage');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return null;
        }     
    }
    
    public function _list_menu(){
        $this->db->where(array('cate_status'=>1,'cate_root'=>0));
        $this->db->order_by('menu_order','asc');
        $query = $this->db->get('tbl_cateimage');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return null;
        }   
    }
    
    public function get_details($id=null){
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_cateimage');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    public function _list_cate($num, $offset) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('tbl_cateimage', $num, $offset);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function add_cate($name,$root, $status) {
        $data = array(
            'cate_name' => $name,
            'cate_status' => $status, 
            'cate_root' =>$root
        );
        $this->db->insert('tbl_cateimage', $data);
    }
    
    public function update_cate($id,$name,$root, $status){
        $data = array(
            'cate_name' => $name,
            'cate_status' => $status, 
            'cate_root' =>$root
        );
        $this->db->where('id',$id);
        $this->db->update('tbl_cateimage', $data);
    }
    
    public function update_order($id,$order){
        $data = array(
            'menu_order' => $order, 
        );
        $this->db->where('id',$id);
        $this->db->update('tbl_cateimage', $data);
    }

    function _del($id) {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('tbl_cateimage');
    }
    
    function update_status($id,$status){
        if($status == 1){
            $new_status = 0;
        }else{
            $new_status = 1;
        }
        $data = array( 
            'cate_status' => $new_status,  
        );
        $this->db->where('id',$id);
        $this->db->update('tbl_cateimage', $data);
    }

    function _total() {
        $this->load->database();
        return $this->db->count_all('tbl_cateimage');
    }

}
