<?php foreach($category as $cate):?>
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Quick Example</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start --> 
	<?php echo form_open_multipart('admincp/edit_cateimg/'.$cate->id,array('role'=>'form')); ?>
		<div class="box-body">
                    
                        <div class="form-group">
                            <label for="exampleInput">Danh mục cha</label>
                            <select name="cate_root" class="form-control">
                                <option value="0"   selected="selected" >--------Chọn danh mục cha--------</option>
                                <?php foreach($cateroot as $root): ?>  
                                <option  <?php if($cate->cate_root == $root->id):?> selected="selected" <?php endif;?> value="<?php echo $root->id?>"><?php echo $root->cate_name ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tên danh mục</label> 
				<input type="text" value="<?php echo $cate->cate_name;?>" class="form-control" id="cate_name" name="cate_name" placeholder="Nhập tên">
			</div>
			<div class="form-group"> 
                            
				 <input type="radio" name="cate_statuse" id="cate_statuse" value="1" <?php if($cate->cate_status == 1):?> checked <?php endif;?>> Kích hoạt
				 <input type="radio" name="cate_statuse" id="cate_statuse" value="0" <?php if($cate->cate_status == 0):?> checked <?php endif;?> > Tạm dừng
			</div>
			 
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" name="cate_submit" class="btn btn-primary">Đồng ý</button>
		</div>
	<?php echo form_close(); ?>
</div>
<?php endforeach; ?>