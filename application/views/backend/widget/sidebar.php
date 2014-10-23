<section class="sidebar">

    <!--                     <form action="#" method="get" class="sidebar-form"> -->
    <!--                         <div class="input-group"> -->
    <!--                             <input type="text" name="q" class="form-control" placeholder="Search..."/> -->
    <!--                             <span class="input-group-btn"> -->
    <!--                                 <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button> -->
    <!--                             </span> -->
    <!--                         </div> -->
    <!--                     </form> -->

    <ul class="sidebar-menu">
        <li class="active">
            <a href="<?php echo site_url('admincp'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="treeview" >
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Quản lý Nội dung</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: block;"> 
                <li><a href="<?php echo site_url('admincp/list_type'); ?>"><i class="fa fa-angle-double-right"></i>Danh sách loại tin</a></li> 
                <li><a href="<?php echo site_url('admincp/add_type'); ?>"><i class="fa fa-angle-double-right"></i>Thêm mới Loại tin</a></li> 
                <li><a href="<?php echo site_url('admincp/news'); ?>"><i class="fa fa-angle-double-right"></i>Danh sách Nội dung</a></li> 
                <li><a href="<?php echo site_url('admincp/add_news'); ?>"><i class="fa fa-angle-double-right"></i>Thêm mới Nội dung</a></li> 
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Quản lý Album Ảnh</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: block;"> 
                <li><a href="<?php echo site_url('admincp/listcate_img'); ?>"><i class="fa fa-angle-double-right"></i>Danh sách Album</a></li> 
                <li><a href="<?php echo site_url('admincp/addcate_img'); ?>"><i class="fa fa-angle-double-right"></i>Thêm mới Album</a></li> 
                <li><a href="<?php echo site_url('admincp/gallery'); ?>"><i class="fa fa-angle-double-right"></i>Nhập ảnh Album</a></li> 
                <li><a href="<?php echo site_url('admincp/list_gallery'); ?>"><i class="fa fa-angle-double-right"></i>Danh sách hình ảnh</a></li> 
            </ul>
        </li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Cấu hình website</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: block;">
                <li><a href="<?php echo site_url('admincp/siteconfig'); ?>"><i class="fa fa-angle-double-right"></i>Cấu hình website</a></li> 
                <li><a href="<?php echo site_url('admincp/seo_config'); ?>"><i class="fa fa-angle-double-right"></i>SEO Tool</a></li> 
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Quản trị viên</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: block;">
                <li><a href="<?php echo site_url('admincp/user'); ?>"><i class="fa fa-angle-double-right"></i>Danh sách</a></li> 
                <li><a href="<?php echo site_url('admincp/add_user'); ?>"><i class="fa fa-angle-double-right"></i>Thêm mới</a></li> 
            </ul>
        </li>
        
        
        
        
        <li>
            <a href="<?php echo site_url('admincp/logout'); ?>">
                <span>Thoát</span>
<!--                                 <small class="badge pull-right bg-yellow">12</small> -->
            </a>
        </li>

    </ul>
</section>