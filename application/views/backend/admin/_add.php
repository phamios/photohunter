<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Thêm Quản trị viên</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start --> 
    <?php echo form_open_multipart('admincp/add_user', array('role' => 'form')); ?>
    <div class="box-body"> 
        <div class="form-group">
            <label for="exampleInputEmail1">Phân cấp quản trị viên </label> 
            <select name="admin_type" class="form-control">
                <option value="0" >Quản lý chung</option>
                <option value="1" > Quản lý cấp cao </option>
                <option value="2" selected="selected" > Quản lý nội dung </option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tên đăng nhập </label> 
            <input type="text" class="form-control" id="type_name" name="admin_name" placeholder="Nhập tên">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mật khẩu </label> 
            <input type="text" class="form-control" id="type_name" name="admin_pass" placeholder="Nhập mật khẩu">
        </div>

    </div>
    <!-- /.box-body -->
 

    <div class="box-footer">
        <button type="submit" name="btt_submit" class="btn btn-primary">Đồng ý</button>
    </div>
    <?php echo form_close(); ?>
</div>