<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Admincp extends CI_Controller {

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

    public function index() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login', 'refesh');
        } else {
            $this->load->view('backend/index');
        }
    }

    //-------------------------Category ------------------
    public function listcate_img() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
//            $title = "What's wrong with CSS?";
//            $url_title = url_title($title);

            $this->load->model('cateimage_model');
            $config['base_url'] = site_url('admincp/listcate_img');
            $config['total_rows'] = $this->cateimage_model->_total();
            $config['per_page'] = 20;
            $config['prev_link'] = 'First';
            $config['next_link'] = 'Next';
            $this->pagination->initialize($config);
            $data["list_cate_image"] = $this->cateimage_model->_list_cate($config['per_page'], $this->uri->segment(3));
            $data['pages_logs'] = $this->pagination->create_links();
            $data['cateroot'] = $this->cateimage_model->_categories();
            $this->load->view('backend/index', $data);
        }
    }

    public function addcate_img() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('cateimage_model');
            if (isset($_REQUEST['cate_submit'])) {
                $cate_name = $this->input->post('cate_name', true);
                $cate_status = $this->input->post('cate_status', true);
                $cate_root = $this->input->post('cate_root', true);
                $this->cateimage_model->add_cate($cate_name, $cate_root, $cate_status);
                redirect('admincp/listcate_img');
            }
            $data['cateroot'] = $this->cateimage_model->_categories();
            $this->load->view('backend/index', $data);
        }
    }

    public function edit_cateimg($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('cateimage_model');
            if (isset($_REQUEST['cate_submit'])) {
                $cate_name = $this->input->post('cate_name', true);
                $cate_status = $this->input->post('cate_status', true);
                $cate_root = $this->input->post('cate_root', true);
                $this->cateimage_model->update_cate($id, $cate_name, $cate_root, $cate_status);
                redirect('admincp/listcate_img');
            }
            $data['category'] = $this->cateimage_model->get_details($id);
            $data['cateroot'] = $this->cateimage_model->_categories();
            $this->load->view('backend/index', $data);
        }
    }

    public function del_cateimg($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('cateimage_model');
            $this->cateimage_model->_del($id);
            redirect('admincp/listcate_img');
        }
    }

    public function cate_status($id = null, $status = 0) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('cateimage_model');
            $this->cateimage_model->update_status($id, $status);
            redirect('admincp/listcate_img');
        }
    }

    //-------------------LOGIN -----------------------
    public function login() {
        if ($this->session->userdata('admin_id') != null) {
            redirect('admincp/index');
        } else {
            if (isset($_REQUEST ['submit_login'])) {
                $username = $this->input->post('adminname', true);
                $pass1 = $this->input->post('adminpass', true);
                $this->load->model('admin_model');

                $result = $this->admin_model->authen($username, $pass1);

                if ($result == 0) {
                    redirect('admincp/login/', 'refresh');
                } else {
                    $newdata = array(
                        'admin_id' => $result
                    );
                    $this->session->set_userdata($newdata);
                    redirect('admincp/index/', 'refresh');
                }
            }

            $this->load->view('backend/login');
        }
    }

    //------------------------------Gallery ----------------------------
    public function list_gallery() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('gallery_model');
            $this->load->model('cateimage_model');
            $config['base_url'] = site_url('admincp/list_gallery');
            $config['total_rows'] = $this->gallery_model->_total();
            $config['per_page'] = 20;
            $config['prev_link'] = 'First';
            $config['next_link'] = 'Next';
            $this->pagination->initialize($config);
            $data["list_image"] = $this->gallery_model->_list_gallery($config['per_page'], $this->uri->segment(3));
            $data['pages'] = $this->pagination->create_links();
            $data['categories'] = $this->cateimage_model->_categories();
            $this->load->view('backend/index', $data);
        }
    }

    public function gallery() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('gallery_model');
            $userid = 'photo'; //$this->session->userdata('admin_id');
            if (!file_exists('./src/' . $userid)) {
                mkdir('./src/' . $userid, 0777, true);
            }

            if (isset($_FILES['upload']['name'])) {
                $count = count($_FILES['upload']['name']);
                $gallery_description = $this->input->post('gallery_description', true);
                $cate = explode("-", $this->input->post('cate_albums', true));
                $cate_id = $cate[0];
                $cate_name = $cate[1];
                $cate_root = $cate[2];
                // all uploads //
                $uploads = $_FILES['upload'];
                for ($i = 0; $i < $count; $i++) {
                    if ($uploads['error'][$i] == 0) {
                        $name = str_replace('.jpg', '', $uploads['name'][$i]);
                        $name = $name . '_' . time() . '.jpg';
                        $gallery_link = site_url('/src/' . $userid . '/' . $name);
                        move_uploaded_file($uploads['tmp_name'][$i], './src/' . $userid . '/' . $name);
                        //$this->gallery_model->add_image_for_item($userid, $itemid, $name, $select_type);
                        $this->gallery_model->add_image($cate_root, $cate_id, $cate_name, $name, $gallery_link, $gallery_description);
                    }
                }
                redirect('admincp/list_gallery');
            }

            $this->load->model('cateimage_model');

            $data['categories'] = $this->cateimage_model->_categories();

            $this->load->view('backend/index', $data);
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
            echo "Chưa có ảnh cho album này.";
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

    public function del_image_gallery($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('gallery_model');
            $this->gallery_model->_del($id);
            redirect('admincp/list_gallery');
        }
    }

    public function resize_image($dir, $new_name, $image) {
        $img_cfg_thumb['image_library'] = 'gd2';
        $img_cfg_thumb['source_image'] = "./" . $dir . "/" . $image;
        $img_cfg_thumb['maintain_ratio'] = TRUE;
        $img_cfg_thumb['new_image'] = $new_name;
        $img_cfg_thumb['width'] = 300;
        $img_cfg_thumb['height'] = 200;
        $this->load->library('image_lib');
        $this->image_lib->initialize($img_cfg_thumb);
        $this->image_lib->resize();
    }

    function do_upload_image($mypath, $filename) {
        $config['upload_path'] = $mypath;
        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['max_size'] = '80000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (isset($filename)) {
            if (!$this->upload->do_upload($filename)) {
                $error = array('error' => $this->upload->display_errors());
                return NULL;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $imagename = $this->upload->file_name;
                $this->resize_image($mypath, 'thumb_' . $imagename, $imagename);
                return $imagename;
            }
        } else {
            echo $this->upload->display_errors();
        }
    }

    //----------------------TYPE ----------------------
    public function list_type() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('type_model');
            $config['base_url'] = site_url('admincp/list_type');
            $config['total_rows'] = $this->type_model->_total();
            $config['per_page'] = 20;
            $config['prev_link'] = 'First';
            $config['next_link'] = 'Next';
            $this->pagination->initialize($config);
            $data["list_type"] = $this->type_model->_list($config['per_page'], $this->uri->segment(3));
            $data['pages'] = $this->pagination->create_links();
            $this->load->view('backend/index', $data);
        }
    }

    public function add_type() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            if (isset($_REQUEST['type_submit'])) {
                $type_name = $this->input->post('type_name');
                $this->load->model('type_model');
                $this->type_model->_add($type_name);
                redirect('admincp/list_type');
            }
            $this->load->view('backend/index');
        }
    }

    public function update_type($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('type_model');
            if (isset($_REQUEST['type_submit'])) {
                $type_name = $this->input->post('type_name');
                $this->type_model->_update($id, $type_name);
                redirect('admincp/list_type');
            }
            $data['detail_type'] = $this->type_model->get_details($id);
            $this->load->view('backend/index', $data);
        }
    }

    public function del_type($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('type_model');
            $this->type_model->_del($id);
            redirect('admincp/list_type');
        }
    }

    //------------------------ADMIN------------------------
    public function user(){
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('admin_model');
            $data['list_users'] = $this->admin_model->list_user();
            $this->load->view('backend/index', $data);
        }
    }
    
    public function add_user(){
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('admin_model');
            if (isset($_REQUEST['btt_submit'])) {
                $username = $this->input->post('admin_name', true);
                $pass = $this->input->post('admin_pass',true);
                $type = $this->input->post('admin_type');
                $this->admin_model->add_user($username,$pass,$type);
                redirect('admincp/user');
            }
            $data['list_users'] = $this->admin_model->list_user();
            $this->load->view('backend/index', $data);
        }
    }
    
    public function edit_user($id=null){
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('admin_model');
            if (isset($_REQUEST['btt_submit'])) { 
                $pass = $this->input->post('admin_pass',true);
                $type = $this->input->post('admin_type');
                $this->admin_model->edit_user($id,$pass,$type);
                redirect('admincp/user');
            }
            $data['details_user'] = $this->admin_model->details_user($id);
            $this->load->view('backend/index', $data);
        }
    }
    
    public function del_user($id=null){
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('admin_model');
            $this->admin_model->del_user($id);
            redirect('admincp/user');
        }
    }
    //------------------------NEWS ------------------------
    public function news() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('news_model');
            $config['base_url'] = site_url('admincp/news');
            $config['total_rows'] = $this->news_model->_total();
            $config['per_page'] = 20;
            $config['prev_link'] = 'First';
            $config['next_link'] = 'Next';
            $this->pagination->initialize($config);
            $data["list_news"] = $this->news_model->_list_news($config['per_page'], $this->uri->segment(3));
            $data['pages'] = $this->pagination->create_links();
            $this->load->model('type_model');
            $data['list_type'] = $this->type_model->show_all();
            $this->load->view('backend/index', $data);
        }
    }

    public function add_news() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            if (isset($_REQUEST['news_submit'])) {
                $news_type = $this->input->post('type_news', true);
                $news_title = $this->input->post('news_title', true);
                $news_content = $this->input->post('news_des');
                $news_image = $this->do_upload_image('./src/post/', 'news_image');
                $news_status = $this->input->post('news_status', true);
                $this->load->model('news_model');
                $this->news_model->add_news($news_title, $news_content, $news_image, $news_type, $news_status);
                redirect('admincp/news');
            }
            $this->load->model('type_model');
            $data['list_type'] = $this->type_model->show_all();
            $this->load->view('backend/index', $data);
        }
    }

    public function update_news($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('news_model');
            if (isset($_REQUEST['news_submit'])) {
                $news_type = $this->input->post('type_news', true);
                $news_title = $this->input->post('news_title', true);
                $news_content = $this->input->post('news_des');
                $news_image = $this->do_upload_image('./src/post/', 'news_image');
                $news_status = $this->input->post('news_status', true);

                $this->news_model->update_news($id, $news_title, $news_content, $news_image, $news_type, $news_status);
                redirect('admincp/news');
            }
            $this->load->model('type_model');
            $data['detail_news'] = $this->news_model->get_details($id);
            $data['list_type'] = $this->type_model->show_all();
            $this->load->view('backend/index', $data);
        }
    }

    public function del_news($id = null) {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('news_model');
            $this->news_model->_del($id);
            redirect('admincp/news');
        }
    }

    //--------------------------Site ------------------

    public function siteconfig() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('site_model');
            $data['list_site'] = $this->site_model->_list(1);
            if (isset($_REQUEST['submit_site'])) {
                $site_name = $this->input->post('site_name');
                $site_title = $this->input->post('site_title');
                $site_footer = $this->input->post('site_footer');
                $site_image_count = $this->input->post('site_image_count');
                $facebook_link = $this->input->post('facebook_link');
                $skype_link = $this->input->post('skype_link');
                $twitter_link = $this->input->post('twitter_link');
                $download_link = $this->input->post('download_link');
                $object = array(
                    'site_name' => $site_name,
                    'site_title' =>$site_title,
                    'site_footer' => $site_footer,
                    'site_image_count' => $site_image_count,
                    'facebook_link' => $facebook_link,
                    'skype_link' => $skype_link,
                    'twitter_link' => $twitter_link,
                    'download_link' => $download_link,
                );
                $this->site_model->update_site(1, $object);
                redirect('admincp/siteconfig');
            }
            $this->load->view('backend/index', $data);
        }
    }

    public function seo_config() {
        if ($this->session->userdata('admin_id') == null) {
            redirect('admincp/login');
        } else {
            $this->load->model('site_model');
            $data['list_site'] = $this->site_model->_list(1);
            if (isset($_REQUEST['submit_seo'])) {
                $site_des = $this->input->post('site_des');
                $site_keyword = $this->input->post('site_keyword');
                $ga_tracking = $this->input->post('ga_tracking');
                $object = array(
                    'site_des' => $site_des,
                    'site_keyword' => $site_keyword,
                    'ga_tracking' =>$ga_tracking,
                );
                $this->site_model->update_site(1, $object);
                redirect('admincp/seo_config');
            }
            $this->load->view('backend/index', $data);
        }
    }

    //------------------------LOGOUT -------------------
    public function logout() {
        $this->session->unset_userdata('admin_id');
        redirect('admincp/login');
    }

}

?>
