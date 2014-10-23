<div class="box-body table-responsive">
    <p><?php echo $pages;?></p>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <td>Loại tin</td>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Ảnh đại diện</th> 
                <th>Ngày cập nhật</th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($list_news <> null): ?>
                <?php foreach ($list_news as $news): ?>
                    <tr>
                        <td><?php echo $news->id?></td>
                        <td> <?php foreach($list_type as $type): ?>
                             <?php if($type->id == $news->news_type):?>
                            <a href="<?php echo site_url('admincp/update_type/'.$type->id);?>"><?php echo $type->type_name;?></a>
                            <?php endif;?>
                            <?php endforeach; ?>
                        </td>
                        <td><a href="<?php echo site_url('admincp/update_news/'.$news->id);?>"><?php echo $news->news_title?></a></td>
                        <td><?php echo word_limiter($news->news_content,30)?></td>
                        <td >
                            <img src="<?php echo site_url('src/post/thumb_'.$news->news_image); ?>" width="50%" alt="<?php echo $news->news_title;?>"/> 
                        </td> 
                        <td><?php echo $news->news_date; ?></td> 
                        
                        <td>    
                            <a href="<?php echo site_url('admincp/update_news/'.$news->id);?>"><span class="badge bg-light-blue"> Sửa</span> </a>   
                            <a href="<?php echo site_url('admincp/del_news/'.$news->id);?>"><span class="badge bg-red"> Xóa </span> </a>         
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>
