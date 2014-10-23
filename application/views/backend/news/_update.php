<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
        ],
        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        menubar: true,
        toolbar_items_size: 'small',
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
    });</script>

<?php foreach($detail_news as $news):?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Sửa nội dung</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start --> 
    <?php echo form_open_multipart('admincp/update_news/'.$news->id, array('role' => 'form')); ?>
    <div class="box-body"> 
        <div class="form-group">
            <label for="exampleInputEmail1">Loại tin</label> 
            <select name="type_news" class="form-control">
                <option value="0" selected="selected">-------------Chọn loại tin -----------</option>
                <?php foreach ($list_type as $type): ?> 
                    <option value="<?php echo $type->id ?>" <?php if($news->news_type == $type->id): ?> selected="selected" <?php endif;?>><?php echo $type->type_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tiêu đề tin</label> 
            <input type="text" class="form-control" id="type_name" name="news_title" placeholder="Nhập tên" value="<?php echo $news->news_title?>">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nội dung tin</label> 
            <textarea    class="form-control" name ="news_des" rows="3" placeholder="Nhập nội dung">
                <?php echo $news->news_content?> 
            </textarea>
        </div>

    </div>
    <!-- /.box-body -->

    <div class="form-group">
        <img src="<?php echo site_url('src/post/thumb_'.$news->news_image); ?>" width="10%" alt="<?php echo $news->news_title;?>"/>
        <input type="file" name="news_image" id="upload" />  
        <p class="help-block">Chỉ tải lên file định dạng <span class="label label-success">JPG</span></p> 
    </div>

    <div class="form-group">  
        <input type="radio" name="news_status" id="cate_statuse" value="1" <?php if($news->news_status == 1):?> checked <?php endif;?>> Kích hoạt
        <input type="radio" name="news_status" id="cate_statuse" value="0" <?php if($news->news_status == 0):?> checked <?php endif;?>  > Tạm dừng
    </div>


    <div class="box-footer">
        <button type="submit" name="news_submit" class="btn btn-primary">Đồng ý</button>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach; ?>