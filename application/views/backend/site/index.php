 <?php foreach ($list_site as $site): ?>
<?php echo form_open_multipart('admincp/siteconfig',array('role'=>'form')); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Thông tin website</h3>
    </div>
   
        <div class="box-body">
            <div class="form-group">
                <label >Tên website</label>
                <input value="<?php echo $site->site_name; ?>" type="text" name="site_name" class="form-control" id="exampleInputEmail1" placeholder="Điền tên website">
            </div>
            <div class="form-group">
                <label >Title Webpage</label>
                <input value="<?php echo $site->site_title; ?>" type="text" name="site_title" class="form-control" id="exampleInputEmail1" placeholder="Điền tên website">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nội dung Footer</label>
                <input value="<?php echo $site->site_footer; ?>" type="text" class="form-control" id="exampleInputPassword1" name="site_footer" placeholder="Copyright....">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Số Image hiển thị mặc định ban đầu</label>
                <input value="<?php echo $site->site_image_count; ?>" type="text" name="site_image_count" class="form-control" placeholder="Ví dụ: 10..">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Địa chỉ Facebook</label>
                <input value="<?php echo $site->facebook_link; ?>" type="text" name="facebook_link" class="form-control" placeholder="http://www.facebook.com/konichiwachan" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Skype</label>
                <input value="<?php echo $site->skype_link; ?>" type="text" name="skype_link" class="form-control"  placeholder="sonpx03">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Twitter</label>
                <input value="<?php echo $site->twitter_link; ?>" type="text" name="twitter_link" class="form-control" placeholder="githubcodevn">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Link download bảng giá</label>
                <input value="<?php echo $site->download_link; ?>" type="text" name="download_link" class="form-control"  placeholder="http://www.fshare.vn/logdown">
            </div>
        </div> 

        <div class="box-footer">
            <button type="submit" name="submit_site" class="btn btn-primary">Cập nhật</button>
        </div>
    
</div> 
<?php echo form_close(); ?>
<?php endforeach; ?>