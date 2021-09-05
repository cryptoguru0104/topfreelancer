<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> New Post</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/blog'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Post List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if ($this->session->flashdata('success')) {
		                echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
		            }
					if($this->session->flashdata('error')){
		                echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
		        	}
				?>
			</div>

			<?php $attributes = array('id' => 'blog_post', 'method' => 'post');
			echo form_open_multipart('admin/blog/post',$attributes);?>

			<div class="add_job_content col-lg-12">
				<div class="add_job_detail">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h5>Title*</h5>
								<input type="text" name="title" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h5>Content*</h5>
								<textarea name="content" class="form-control" required></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<h5>Tags*</h5>
								<input type="text" name="tags" class="form-control" required="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<h5>Keywords*</h5>
								<input type="text" name="keywords" class="form-control" required="">
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<h5>Category*</h5>
								<?php 
									$result = get_blog_categories_list();
									$options = array('' => 'Select Option') + array_column($result, 'name','id');
									echo form_dropdown('category',$options,'','class="form-control"');
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<h5>Media*</h5>
								<input type="file" name="post_media" class="form-control" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="add_job_btn col-lg-12 mt-3">
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-block" name="blog_post" value="Submit">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
