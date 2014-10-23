<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Thay đổi thông tin Quản trị viên</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start --> 
    <?php if($details_user):?>
    <?php foreach($details_user as $user):?>
    <?php echo form_open_multipart('admincp/add_user', array('role' => 'form')); ?>
    <div class="box-body"> 
        <div class="form-group">
            <label for="exampleInputEmail1">Phân cấp quản trị viên </label> 
            <select name="admin_type" class="form-control">
                <option value="0" <?php if ($user->admin_type == 0):?> selected="selected"<?php endif;?>>Quản lý chung</option>
                <option value="1" <?php if ($user->admin_type == 1):?> selected="selected"<?php endif;?>> Quản lý cấp cao </option>
                <option value="2" <?php if ($user->admin_type == 2):?> selected="selected"<?php endif;?>> Quản lý nội dung </option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tên đăng nhập </label> 
            <?php echo $user->admin_name;?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Đổi Mật khẩu </label> 
            <input type="text" class="form-control" value="<?php echo $user->admin_pass;?>" id="type_name" name="admin_pass" placeholder="Nhập mật khẩu">
        </div>

    </div>
    <!-- /.box-body -->
 

    <div class="box-footer">
        <button type="submit" name="btt_submit" class="btn btn-primary">Đồng ý</button>
    </div>
    <?php echo form_close(); ?>
    <?php endforeach;?>
    <?php endif;?>
</div>