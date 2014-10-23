<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_details($id = null) {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_news');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function _list_news($num, $offset) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_news', $num, $offset);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function add_news($news_title, $news_content, $news_image, $news_type, $news_status) {
        $data = array(
            'news_title' => $news_title,
            'news_content' => $news_content,
            'news_image' => $news_image,
            'news_type' => $news_type,
            'news_status' => $news_status,
            'news_date' => date("d-m-Y"),
        );
        $this->db->insert('tbl_news', $data);
    }

    function update_news($id, $news_title, $news_content, $news_image, $news_type, $news_status) {
         
        if ($news_image != null) {
            $data = array(
                'news_title' => $news_title,
                'news_content' => $news_content,
                'news_image' => $news_image,
                'news_type' => $news_type,
                'news_status' => $news_status,
                'news_date' => date("d-m-Y"),
            );
        } else {
            $data = array(
                'news_title' => $news_title,
                'news_content' => $news_content,
                'news_type' => $news_type,
                'news_status' => $news_status,
                'news_date' => date("d-m-Y"),
            );
        }

        $this->db->where('id', $id);
        $this->db->update('tbl_news', $data);
    }

    function update_status($id, $status) {
        if ($status == 1) {
            $new_status = 0;
        } else {
            $new_status = 1;
        }
        $data = array(
            'news_status' => $new_status,
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_news', $data);
    }

    function _del($id) {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->delete('tbl_news');
    }

    function _total() {
        $this->load->database();
        return $this->db->count_all('tbl_news');
    }
 

}
