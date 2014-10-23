 <?php foreach ($list_site as $site): ?>
<?php echo form_open_multipart('admincp/seo_config',array('role'=>'form')); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Thông tin website</h3>
    </div>
   
        <div class="box-body">
            <div class="form-group">
                <label >ID Google Analytics</label>
                <input value="<?php echo $site->ga_tracking; ?>" type="text" name="ga_tracking" class="form-control" id="exampleInputEmail1" placeholder="UA-51554009-17">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Thẻ giới thiệu Meta</label>
                <input value="<?php echo $site->site_des; ?>" type="text" class="form-control" id="exampleInputPassword1" name="site_des" placeholder=" ">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Thẻ từ khóa</label>
                <input value="<?php echo $site->site_keyword; ?>" type="text" name="site_keyword" class="form-control" placeholder=" ">
            </div>
            
        </div> 

        <div class="box-footer">
            <button type="submit" name="submit_seo" class="btn btn-primary">Cập nhật</button>
        </div>
    
</div> 
<?php echo form_close(); ?>
<?php endforeach; ?>