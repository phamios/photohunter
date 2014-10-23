<div class="box-body table-responsive">
    <p>
        <a href="<?php echo site_url('admincp/add_user/'); ?>"><span class="badge bg-red"> THÊM MỚI USER </span> </a>         
    </p>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <td>User Name </td>
                <th>Loại user</th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($list_users <> null): ?>
                <?php foreach ($list_users as $user): ?>
                    <tr>
                        <td><?php echo $user->id ?></td>
                        <td><?php echo $user->admin_name ?></td>
                        <td>
                            <?php if ($user->admin_type == 0): ?>
                                Quản lý chung 
                            <?php endif; ?>
                            <?php if ($user->admin_type == 1): ?>
                                Quản lý cấp cao 
                            <?php endif; ?>
                            <?php if ($user->admin_type == 2): ?>
                                Quản lý nội dung
                            <?php endif; ?>
                        </td>
                        <td>    
                            <a href="<?php echo site_url('admincp/edit_user/' . $user->id); ?>"><span class="badge bg-light-blue"> Cập nhật </span> </a>   
                            <a href="<?php echo site_url('admincp/del_user/' . $user->id); ?>"><span class="badge bg-red"> Xóa </span> </a>         
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>
