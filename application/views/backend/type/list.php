<div class="box-body table-responsive">
    <p><?php echo $pages;?></p>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <td>Tên loại</td> 
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($list_type <> null): ?>
                <?php foreach ($list_type as $type): ?>
                    <tr>
                        <td><?php echo $type->id?></td>
                        <td> <?php echo $type->type_name; ?>
                        </td>
                         
                        <td>    
                            <a href="<?php echo site_url('admincp/update_type/'.$type->id);?>"><span class="badge bg-light-blue"> Sửa</span> </a>   
                            <a href="<?php echo site_url('admincp/del_type/'.$type->id);?>"><span class="badge bg-red"> Xóa </span> </a>        
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>
