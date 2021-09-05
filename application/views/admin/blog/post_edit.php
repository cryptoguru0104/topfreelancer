<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> Edit Post</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/blog'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Post List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if($this->session->flashdata('error')){
		                echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
		        	}
				?>
			</div>

			<?php $attributes = array('id' => 'edit_job', 'method' => 'post');
			echo form_open_multipart('admin/blog/edit/'.$post_detail['id'],$attributes);
			?>

			<div class="add_job_content col-lg-12">
				<div class="add_job_detail">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Title*</label>
								<input type="text" name="title" class="form-control" value="<?= $post_detail['title'] ?>" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Media*</label><br/>
								<img src="<?= base_url($post_detail['image_default']) ?>" height="130" alt='blog image'>
								<input type="file" name="post_media" >
								<input type="hidden" name="old_media" value="<?= $post_detail['image_default'] ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Content*</label>
								<textarea name="content" class="form-control"required><?= $post_detail['content'] ?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tags*</label>
								<?php
									$tags = get_post_tags_by_id($post_detail['id']);
									$tags = implode(',', array_column($tags, 'tag'));
								?>
								<input type="text" name="tags" class="form-control" value="<?= $tags ?>" required="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Keywords*</label>
								<input type="text" name="keywords" class="form-control" value="<?= $post_detail['keywords'] ?>" required="">
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label>Category*</label>
								<?php 
									$result = get_blog_categories_list();
									$options = array('' => 'Select Option') + array_column($result, 'name','id');
									echo form_dropdown('category',$options,$post_detail['category_id'],'class="form-control"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="add_job_btn col-lg-12 mt-3">
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-block" name="edit_post" value="Update">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
