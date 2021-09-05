<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> Post a New Job</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/job'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Job List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row my-form-body">
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

			<?php $attributes = array('id' => 'post_job', 'method' => 'post');
			echo form_open('admin/job/post',$attributes);?>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Business *</label>
						<select name="employer_id" class="form-control">
							<option value="">Select Business</option>
							<?php foreach($businesses as $business): ?>
								<option value="<?= $business['employer_id']; ?>"><?= $business['business_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Job Title*</label>
						<input type="text" name="job_title" class="form-control">
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Job Type*</label>
						<?php 
						$types = get_job_type_list();
						$options = array('' => 'Select Job Type') + array_column($types, 'type','id');
						echo form_dropdown('job_type',$options,'','class="form-control" required')
						?>
					</div>
				</div>


				<div class="col-md-6 col-sm-12">
					<div class="form-group"> 
						<label>Position Available *</label>
						<select name="total_positions" class="form-control">	
							<?php for($i=1; $i<30; $i++): ?>
								<option value="<?= $i; ?>"><?= $i; ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>

				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Working Experience  *</label>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<?php 
									$options = get_experience_list('Minimum');
									echo form_dropdown('min_experience',$options,'','class="form-control"');
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php 
									$options = get_experience_list('Maximum');
									echo form_dropdown('max_experience',$options,'','class="form-control"');
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Salary  *</label>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="number" name="min_salary" class="form-control" placeholder="Minimum">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="number" name="max_salary" class="form-control" placeholder="Maximum">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Salary Period  *</label>
						<select name="salary_period" class="form-control">
							<option value="Hourly">Hourly</option>
							<option value="Weekly">Weekly</option>
							<option value="Monthly">Monthly</option>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label> Skills*</label>
						<input type="text" name="skills" class="form-control" placeholder="e.g. job title, responsibilites">
					</div>
				</div>

				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Job Description*</label>
						<textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-12">
					<div class="form-group"> 
						<label>Gender Requirement*</label>
						<select name="gender" class="form-control">	
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="No Preference" selected="">No Preference</option>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Workstation Type*</label>
						<?php 
						$types = get_employment_type_list();
						$options = array('' => 'Select Employement Type') + array_column($types, 'type','id');
						echo form_dropdown('employment_type',$options,'','class="form-control"');
						?>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Degree*</label>
						<select class="form-control" name="education">
							<option value="">Select Degree</option>
							<?php foreach($educations as $row): ?>
								<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Country *</label>
						<select class="country form-control" name="country">
						   <option>Select Country</option>
						    <?php foreach($countries as $country):?>
						   		<option value="<?= $country['id']?>"><?= $country['name']?></option>
						    <?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>State *</label>
						<select class="form-control state" name="state" required>
				            <option>Select State</option>
				        </select>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>City *</label>
						<select class="form-control city" name="city" required>
				            <option>Select City</option>
				         </select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Location*</label>
						<input type="text" name="location" class="form-control" placeholder="Type Address">
					</div>
				</div>
			</div>
		
			<div class="col-lg-12 mt-3">
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-block" name="post_job" value="Submit">
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
