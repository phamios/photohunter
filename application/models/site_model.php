<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->config->load('config');
        $this->load->database();
    }

    public function _list($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_setting');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function update_site($id, $object) {
        //$data = array("site_name", "site_des", "site_keyword", "site_image_count", "site_footer", "site_title", "site_title", "ga_tracking", "facebook_link", "skype_link", "twitter_link", "video_link");
        $this->db->where('id', $id);
        $this->db->update('tbl_setting', $object);
    }

}
