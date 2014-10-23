<div class="box-body table-responsive">
    <p><?php echo $pages;?></p>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Loại ảnh</th>
                <th>Albums</th>
                <th>Ảnh đại diện</th> 
                <th>Ngày cập nhật</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if ($list_image <> null): ?>
                <?php foreach ($list_image as $image): ?>
                    <tr>
                        <td><?php echo $image->id?></td>
                        <td><?php foreach($categories as $cate):?>
                            <?php if($cate->id == $image->cate_root ):?>
                                <?php echo $cate->cate_name;?>
                            <?php else: ?>
                                
                            <?php endif; ?>
                            <?php endforeach;?>
                        </td>
                        <td>
                            <?php foreach($categories as $cate):?>
                            <?php if($cate->id == $image->cate_id ):?>
                            <a href="<?php echo site_url('admincp/edit_cateimg/'.$cate->id);?>"><?php echo $cate->cate_name;?></a>
                            <?php endif; ?>
                            <?php endforeach;?>
                        </td>
                        <td  >
                            <img src="<?php echo $image->gallery_link; ?>" width="10%" alt="<?php echo $image->gallery_name;?>"/> 
                        </td> 
                        <td><?php echo $image->gallery_date; ?></td> 
                        
                        <td>    
                            <a href="<?php echo site_url('admincp/del_image_gallery/'.$image->id);?>"><span class="badge bg-red"> Xóa </span> </a>        
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>
