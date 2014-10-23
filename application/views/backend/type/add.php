<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Quick Example</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start --> 
	<?php echo form_open_multipart('admincp/add_type',array('role'=>'form')); ?>
		<div class="box-body"> 
			<div class="form-group">
				<label for="exampleInputEmail1">Tên Loại</label> 
				<input type="text" class="form-control" id="type_name" name="type_name" placeholder="Nhập tên">
			</div>
			 
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" name="type_submit" class="btn btn-primary">Đồng ý</button>
		</div>
	<?php echo form_close(); ?>
</div>