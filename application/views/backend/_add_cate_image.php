<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Quick Example</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start --> 
	<?php echo form_open_multipart('admincp/addcate_img',array('role'=>'form')); ?>
		<div class="box-body">
                    
                        <div class="form-group">
                            <label for="exampleInput">Danh mục cha</label>
                            <select name="cate_root" class="form-control">
                                <option value="0" selected="selected">--------Chọn danh mục cha--------</option>
                                <?php foreach($cateroot as $root): ?>
                                <option value="<?php echo $root->id?>"><?php echo $root->cate_name ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tên danh mục</label> 
				<input type="text" class="form-control" id="cate_name" name="cate_name" placeholder="Nhập tên">
			</div>
			<div class="form-group"> 
				 <input type="radio" name="cate_statuse" id="cate_statuse" value="1" checked> Kích hoạt
				 <input type="radio" name="cate_statuse" id="cate_statuse" value="0"  > Tạm dừng
			</div>
			 
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" name="cate_submit" class="btn btn-primary">Đồng ý</button>
		</div>
	<?php echo form_close(); ?>
</div>