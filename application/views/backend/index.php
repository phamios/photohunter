<!DOCTYPE html>
<html>
    <?php $this->load->view('backend/widget/header'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Admin Cpanel
            </a> 
            <nav class="navbar navbar-static-top" role="navigation">

            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas"> 
                <?php $this->load->view('backend/widget/sidebar'); ?> 
            </aside>

            <aside class="right-side"> 
                <section class="content">
                    <?php if ($this->router->fetch_method() == 'index'): ?>
                        <?php $this->load->view("backend/home"); ?> 
                    <?php endif; ?> 
                    <?php if ($this->router->fetch_method() == 'listcate_img'): ?>
                        <?php $this->load->view("backend/cate_image"); ?> 
                    <?php endif; ?> 
                    <?php if ($this->router->fetch_method() == 'addcate_img'): ?>
                        <?php $this->load->view("backend/_add_cate_image"); ?> 
                    <?php endif; ?> 
                    <?php if ($this->router->fetch_method() == 'gallery'): ?>
                        <?php $this->load->view("backend/gallery/index"); ?> 
                    <?php endif; ?>
                    <?php if ($this->router->fetch_method() == 'edit_cateimg'): ?>
                        <?php $this->load->view("backend/edit_category"); ?> 
                    <?php endif; ?>
                    
                     <?php if ($this->router->fetch_method() == 'list_gallery'): ?>
                        <?php $this->load->view("backend/gallery/list"); ?> 
                    <?php endif; ?>
                    <?php if ($this->router->fetch_method() == 'news'): ?>
                        <?php $this->load->view("backend/news/list"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'add_news'): ?>
                        <?php $this->load->view("backend/news/_add"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'update_news'): ?>
                        <?php $this->load->view("backend/news/_update"); ?> 
                    <?php endif; ?>
                    
                    
                    <?php if ($this->router->fetch_method() == 'list_type'): ?>
                        <?php $this->load->view("backend/type/list"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'add_type'): ?>
                        <?php $this->load->view("backend/type/add"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'update_type'): ?>
                        <?php $this->load->view("backend/type/update"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'siteconfig'): ?>
                        <?php $this->load->view("backend/site/index"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'seo_config'): ?>
                        <?php $this->load->view("backend/site/seo"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'user'): ?>
                        <?php $this->load->view("backend/admin/index"); ?> 
                    <?php endif; ?>
                     
                    <?php if ($this->router->fetch_method() == 'add_user'): ?>
                        <?php $this->load->view("backend/admin/_add"); ?> 
                    <?php endif; ?>
                    
                    <?php if ($this->router->fetch_method() == 'edit_user'): ?>
                        <?php $this->load->view("backend/admin/_edit"); ?> 
                    <?php endif; ?>
                    
                </section> 
            </aside> 
        </div> 

        <?php $this->load->view('backend/widget/js_footer'); ?>
    </body>
</html>