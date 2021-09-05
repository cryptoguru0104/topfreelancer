<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> Edit Job</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/job'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Job List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if($this->session->flashdata('edit_job_error')){
		                echo '<div class="alert alert-danger">' . $this->session->flashdata('edit_job_error') . '</div>';
		        	}
				?>
			</div>

			<?php $attributes = array('id' => 'edit_job', 'method' => 'post');
			echo form_open('admin/job/edit/'.$job_detail['id'],$attributes);
			?>

			<div class="row my-form-body">
				<div class="col-lg-12">
					<div class="form-group">
						<label>Job Title*</label>
						<input type="text" name="job_title" value="<?= $job_detail['title']; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Job Type*</label>
						<?php 
						$types = get_job_type_list();
						$options = array('' => 'Select Job Type') + array_column($types, 'type','id');
						echo form_dropdown('job_type',$options,$job_detail['job_type'],'class="form-control" required')
						?>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Job Indusry*</label>
						<select class="form-control" name="industry">
						   <option>Select Indusry</option>
						   <?php foreach($industries as $industry):?>
						   		<?php if($job_detail['industry'] == $industry['id']): ?>
									<option value="<?= $industry['id']; ?>" selected> <?= $industry['name']; ?> </option>
								<?php else: ?>
									<option value="<?= $industry['id']; ?>"> <?= $industry['name']; ?> </option>
							<?php endif; endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group"> 
						<label>Position Available *</label>
						<select name="total_positions" class="form-control">	
					  	    <?php for($i=1; $i<30; $i++): ?>
					   			<?php if($job_detail['total_positions'] == $i): ?>
					   			<option value="<?= $i; ?>" selected><?= $i; ?></option>
					   			<?php else: ?>
					   			<option value="<?= $i; ?>" ><?= $i; ?></option>	
						    <?php endif; endfor; ?>
						</select>
					</div>
				</div>

				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Working Experience *</label>
						<?php 
							$exp = explode('-', $job_detail['experience']);
							$min = $exp[0];
							$max = $exp[1];
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<?php 
										$options = get_experience_list('Minimum');
										echo form_dropdown('min_experience',$options,$min,'class="form-control"');
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php 
										$options = get_experience_list('Maximum');
										echo form_dropdown('max_experience',$options,$max,'class="form-control"');
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Salary / Hourly Rate *</label>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="number" name="min_salary" class="form-control" placeholder="Minimum" value="<?= $job_detail['min_salary'] ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="number" name="max_salary" class="form-control" placeholder="Maximum" value="<?= $job_detail['max_salary'] ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Job Rate Type *</label>
						<select name="salary_period" class="form-control">
							<option value="Hourly" <?= ($job_detail['salary_period'] == 'Hourly') ? 'selected' : '' ?> >Hourly</option>
							<option value="Weekly" <?= ($job_detail['salary_period'] == 'Weekly') ? 'selected' : '' ?> >Weekly</option>
							<option value="Monthly" <?= ($job_detail['salary_period'] == 'Monthly') ? 'selected' : '' ?> >Monthly</option>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label> Skills*</label>
						<input type="text" name="skills" value="<?= $job_detail['skills']; ?>" class="form-control" placeholder="e.g. job title, responsibilites">
					</div>
				</div>

				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Job Description*</label>
						<textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"><?= $job_detail['requirements']; ?></textarea>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group"> 
						<label>Gender Requirement*</label>
						<select name="gender" class="form-control">	
					   		<option value="Male" <?php if($job_detail['gender'] == 'Male'){ echo "selected";} ?> >Male</option>
					   		<option value="Female" <?php if($job_detail['gender'] == 'Female'){ echo "selected";} ?> >Female</option>
					   		<option value="No Preference" <?php if($job_detail['gender'] == 'No Preference'){ echo "selected";} ?> >No Preference</option>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Workstation Type*</label>
						<?php
							$types = get_employment_type_list();
							$options = array('' => 'Select Employement Type') + array_column($types, 'type','id');
							echo form_dropdown('employment_type',$options,$job_detail['employment_type'],'class="form-control"');
						?>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Degree*</label>
						<select class="form-control" name="education">
							<option value="">Select Degree</option>
							<?php foreach($educations as $education):?>
					   			<?php if($job_detail['education'] == $education['id']): ?>
								<option value="<?= $education['id']; ?>" selected> <?= $education['type']; ?> </option>
								<?php else: ?>
									<option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
							<?php endif; endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Country *</label>
						<select class="country form-control" name="country">
						   <option>Select Country</option>
						    <?php foreach($countries as $country):?>
						   		<?php if($job_detail['country'] == $country['id']): ?>
									<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
								<?php else: ?>
									<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
							<?php endif; endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>State *</label>
						<?php 
	                        $states = get_country_cities($job_detail['country']);
	                        $options = array('' => 'Select State')+array_column($states, 'name','id');
	                        echo form_dropdown('state',$options,$job_detail['state'],'class="form-control state" required');
	                      ?>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>City *</label>
						<?php 
                        $cities = get_country_cities($job_detail['state']);
                        $options = array('' => 'Select City')+array_column($cities, 'name','id');
                        echo form_dropdown('city',$options,$job_detail['city'],'class="form-control city" required');
                        ?>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Location*</label>
						<input type="text" name="location" value="<?= $job_detail['location']; ?>" class="form-control" placeholder="Type Address">
					</div>
				</div>
				<div class="col-lg-12 mt-3">
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block" name="edit_job" value="Update">
					</div>
				</div>
			</div>
			
			
			<?php echo form_close(); ?>
		</div>
	</div>
</section>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    });
   })
</script>
