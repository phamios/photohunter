<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Upload Gallery</h3>
    </div><!-- /.box-header -->
    <!-- form start -->

    <form method="post" action="<?php echo base_url('admincp/gallery/'); ?>" enctype="multipart/form-data" role="form">
        <div class="box-body">

            <div class="form-group">
                <label>Chọn loại Album</label>
                <select class="form-control" name="cate_albums">
                    <option value="0" selected="selected">------------Chọn Album---------</option>
                    <?php foreach ($categories as $cate): ?>
                        <?php if($cate->cate_root == 0 ):?>
                        <option value="<?php echo $cate->id . '-' . $cate->cate_name.'-0'; ?>"><?php echo $cate->cate_name ?></option>
                        <?php else: ?>
                        <option value="<?php echo $cate->id . '-' . $cate->cate_name.'-'.$cate->cate_root; ?>"><?php echo $cate->cate_name ?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"> 
                <input type="file" name="upload[]" id="upload" multiple="multiple" />  
                <p class="help-block">Chỉ tải lên file định dạng <span class="label label-success">JPG</span></p>
                <p class="help-block"><span class="badge bg-light-blue">Có thể chọn 1 hoặc nhiều file</span></p>
            </div>

            <div class="form-group">
                <label></label>
                <textarea  style="display:none;" class="form-control" name ="gallery_description" rows="3" placeholder="Nội dung của bộ ảnh này">
                    
                </textarea>
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
</div><!-- /.box -->