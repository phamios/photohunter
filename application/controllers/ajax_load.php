<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_load extends CI_Controller {

    public $cate_id = 0;
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
         
         //$this->cate_id = (int) end(explode("-", $this->uri->segment(2)));
         
    }

    public function index($cate_id = 0) {
      
        if ($_POST) {
            $group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

            //throw HTTP error if group number is not valid
            if (!is_numeric($group_number)) {
                header('HTTP/1.1 500 Invalid number!');
                exit();
            }
            $position = 10;
            //get current starting point of records
            $position = ($group_number * 10);

            //Limit our results within a specified range. 
            //$results = $mysqli->query("SELECT id,name,message FROM paginate ORDER BY id ASC LIMIT $position, $items_per_group");
            $this->load->model('gallery_model');
            if ($cate_id <> 0) {
                $data = $this->gallery_model->_ajax_list_bycate($position, 10, $cate_id);
                
            } else {
                $data = $this->gallery_model->_ajax_list($position, 10);
            }
            echo '    <script>';
            echo '        $(function () {';
            echo '            $(".tiles_2").tilesGallery({';
            echo '                 tileMinHeight: 200';
            echo '            });';
            echo '        });';
            echo '    </script>';
            
            if ($data) {
                foreach ($data as $img) {
                    echo '<a class="swipebox" href="'.base_url('src/photo/' . $img->gallery_name).'">';
                    echo "    <p class='caption'><span>Lorem ipsum dolor sit amet.</span></p>'";
                    echo '<img src="'.base_url('src/photo/' . $img->gallery_name).'" alt="image" />';
                    echo '</a>';                            
                }
            }
            unset($data);
        }
    }
    
    public function update_order($id=0,$value=0){
         $this->load->model('cateimage_model');
         $this->cateimage_model->update_order($id,$value); 
    }

    public function load_header() {
        $this->load->model('site_model');
        $data = $this->site_model->_list(1); //default mac dinh
        foreach ($data as $value) {
            echo '<span>' . $value->site_name . '<span class = "bp-icon bp-icon-about" data-content = "' . $value->site_des . '"></span></span>';
            echo '<h1>' . $value->site_title . '</h1>';
            echo '<nav>';
            echo '<a href = "#" class = "bp-icon bp-icon-prev" data-info = "F"><span>#</span></a>';
            echo '<a href = "#" class = "bp-icon bp-icon-drop" data-info = "#"><span>#</span></a>';
            echo '<a href = "#" class = "bp-icon bp-icon-archive" data-info = "#"><span>#</span></a>';
            echo '</nav>';

            echo "<script>";
            echo "    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ ";
            echo "    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
            echo "    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
            echo "    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
            echo "    ga('create', '" . $value->ga_tracking . "', 'auto');";
            echo "    ga('send', 'pageview');";
            echo "  </script>";
        }
    }

}
