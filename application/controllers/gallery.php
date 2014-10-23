<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Gallery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->library('parser');
        $this->load->helper('cookie');
        $this->load->helper('text');
        $this->load->helper(array(
            'form',
            'url'
        ));
        @session_start();
    }

    public function gallery() {
        if ($this->session->userdata('userid') == null) {
            redirect('user/login');
        } else {
            $userid = $this->session->userdata('userid');
            if (!file_exists('./src/' . $userid)) {
                mkdir('./src/' . $userid, 0777, true);
            }
            $data['username'] = $this->session->userdata('username');
            $this->load->model('app_model');
            if (isset($_FILES['upload']['name'])) {
                $select_type = $this->input->post('select_type', true);
                // total files //
                $count = count($_FILES['upload']['name']);
                // all uploads //
                $uploads = $_FILES['upload'];
                $itemid = $this->input->post('itemid', true);

                for ($i = 0; $i < $count; $i++) {
                    if ($uploads['error'][$i] == 0) {
                        $name = str_replace('.jpg', '', $uploads['name'][$i]);
                        $name = $name . '_' . time() . '.jpg';
                        //echo LINK_URL.'/src/'.$userid.'/'.$name;die;
                        move_uploaded_file($uploads['tmp_name'][$i], './src/' . $userid . '/' . $name);
                        $this->app_model->add_image_for_item($userid, $itemid, $name, $select_type);
                    }
                }
            }

            if (isset($_REQUEST['submit_gallery'])) {
                $imagelink = $this->input->post('imagelink', true);
                $select_type = $this->input->post('select_type', true);
                $this->app_model->add_image_for_item($userid, null, $imagelink, $select_type);
                redirect('user/gallery');
            }
            $data['allgallery'] = $this->app_model->show_allgallery($userid);
            $data['allcontents'] = $this->app_model->list_app_user($userid);

            $config['base_url'] = site_url('user/gallery');
            $config['total_rows'] = $this->app_model->count_image_by_id($userid);
            $config['per_page'] = 12;
            $config['prev_link'] = 'Last';
            $config['next_link'] = 'Next';
            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['images'] = $this->app_model->show_image_by_appid($userid, $config['per_page'], $this->uri->segment(3));
            $this->load->view('user/dashboard', $data);
        }
    }

    public function ajaximagegallery($id) {
        $this->load->model('app_model');
        $userid = $this->session->userdata('userid');
        $config['base_url'] = site_url('user/ajaximagegallery');
        $config['total_rows'] = $this->app_model->count_image_by_id($id);
        $config['per_page'] = 10;
        $config['prev_link'] = 'Last';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $result = $this->app_model->show_image_by_appid($id, $config['per_page'], $this->uri->segment(3));
        if (!$result) {
            echo "Hiện tại app này chưa có ảnh đính kèm.";
        } else {
            echo '<ul class="ace-thumbnails">';
            foreach ($result as $img) {
                echo '<li style="display:inline-block;">';
                echo '<a href="' . $img->imageslink . '" > ';
                echo '<img alt="150x150" width="150" height="150" src="' . $img->imageslink . '" />';
                echo '</a>';
                echo '<div class="tools tools-bottom">';
                echo '<a href="' . site_url('user/del_image_gallery/' . $img->id) . '"> <i class="icon-remove red"></i> Xóa </a>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            echo $data['pages'];
        }
    }

    public function del_image_gallery($id) {
        if ($this->session->userdata('userid') == null) {
            redirect('user/login');
        } else {
            $data['username'] = $this->session->userdata('username');
            $userid = $this->session->userdata('userid');
            $this->load->model('app_model');
            $this->app_model->del_image_gallery($id, $userid);
            redirect('user/gallery');
        }
    }

}
