<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Photo extends CI_Controller {

    private $cate_id = null;
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper("text");
         $this->load->helper("slug");
        $this->cate_id = (int) end(explode("-", $this->uri->segment(2)));
    }

    public function _remap() { 
        
        $this->load->model('gallery_model');
        $data['total_records'] = $this->gallery_model->_total(); 
        $this->load->model('cateimage_model');
        $data['list_menu'] = $this->cateimage_model->_list_menu();
        $data['sub_menu'] = $this->cateimage_model->_categories();
        $data['list_images'] = $this->gallery_model->list_by_cate($this->cate_id);
        $this->load->model('site_model');
        foreach($this->site_model->_list(1) as $config){
            $data['site_name'] = $config->site_name;
            $data['site_des'] = $config->site_des;
            $data['site_keyword'] = $config->site_keyword;
            $data['site_image_count'] = $config->site_image_count;
            $data['site_footer'] = $config->site_footer;
            $data['site_title'] = $config->site_title;
            $data['ga_tracking'] = $config->ga_tracking;
            $data['facebook_link'] = $config->facebook_link;
            $data['skype_link'] = $config->skype_link;
            $data['twitter_link'] = $config->twitter_link;
            $data['download_link'] = $config->download_link; 
        }
        
        $this->load->view('user2/index', $data);
    }
    
    
     

}
