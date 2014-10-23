 
<div class="box-body table-responsive">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thứ tự Menu</th>
                <th>Danh mục cha</th>
                <th>Tên danh mục</th>
                <th>Tình trạng</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if ($list_cate_image <> null): ?>
                <?php foreach ($list_cate_image as $cate): ?>
                    <tr>
                        <td><a href="<?php echo site_url('admincp/edit_cateimg/' . $cate->id); ?>"><?php echo $cate->id ?></a></td>
                        <td>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#menu_order_<?php echo $cate->id ?>").on("change", function () {
                                        var id = $("#menu_id_<?php echo $cate->id ?>").val();
                                        var order = $("#menu_order_<?php echo $cate->id ?>").val();
                                        $.ajax({
                                            type: "POST",
                                            dataType: "json",
                                            url: "<?php echo site_url('ajax_load/update_order/'); ?>/" + id + "/" + order, //Relative or absolute path to response.php file
                                            success: function (data) {
                                                alert("Thiết lập thành công !");
                                            }
                                        });
                                        return false;
                                    });
                                });
                            </script>
                            <input type="hidden" name="menu_id_<?php echo $cate->id ?>" value="<?php echo $cate->id ?>" id="menu_id_<?php echo $cate->id ?>" />
                            <input type="text" size="2" name="menu_order_<?php echo $cate->id ?>" value="<?php echo $cate->menu_order?>" id="menu_order_<?php echo $cate->id ?>"/>
                        </td>
                        <td>
                            <?php foreach ($cateroot as $all): ?>
                                <?php if ($all->id == $cate->cate_root): ?>
                                    <a href="<?php echo site_url('admincp/edit_cateimg/' . $all->id); ?>"><?php echo $all->cate_name; ?></a>
                                <?php else: ?> 
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </td>
                        <td><a href="<?php echo site_url('admincp/edit_cateimg/' . $cate->id); ?>"><?php echo $cate->cate_name ?></a></td>
                        <td><?php if ($cate->cate_status == 1): ?>
                                <a href="<?php echo site_url('admincp/cate_status/' . $cate->id . "/" . $cate->cate_status); ?>"> Đang hoạt động</a>
                            <?php else: ?>
                                <a href="<?php echo site_url('admincp/cate_status/' . $cate->id . "/" . $cate->cate_status); ?>">  Dừng</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('admincp/edit_cateimg/' . $cate->id); ?>"><span class="badge bg-light-blue"> Sửa</span> </a>        
                            <a href="<?php echo site_url('admincp/del_cateimg/' . $cate->id); ?>"><span class="badge bg-red"> Xóa </span> </a>        
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>