<style>
	.datepicker-days {
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;

		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;

		margin-bottom: 0;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		text-align: center;
		white-space: nowrap;
		background-color: #e9ecef;
		border: 1px solid #ced4da;
		border-radius: .25rem;
	}

	.datepicker table tr td.disabled,
	.datepicker table tr td.disabled:hover {
		padding: .375rem .75rem;
	}

</style>

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<div class="col-lg-12 post-list">
				<?php if ($this->session->flashdata('file_error')) {
				echo '<div class="alert alert-danger">' . $this->session->flashdata('file_error') . '</div>';
				} ?>

				<?php if ($this->session->flashdata('error_update')) {
				echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
				} ?>

				<?php if ($this->session->flashdata('update_success')) {
				echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
				} ?>
			</div>


			<div class="col-lg-12 post-list">
				<?php $attributes = array('id' => 'update_user_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

				<?php echo form_open_multipart('job',$attributes);?>
				<div class="profile_job_content col-lg-12">
					<div class="headline">
						<div class="container">
							<div class="row">
								<div class="col-xl-6 col-md-12 col-sm-12">
									<h3><?=trans('vacancy_information')?></h3>
								</div>

								<div class="col-xl-6 col-md-12 col-sm-12 d-inline-block">

									<div class="d-grid gap-2 d-md-flex justify-content-md-end">

										<input type="submit" class="btn btn-danger rounded w-60 mr-3 mb-1" name="edit"
											value="<?=trans('delete')?>">
										<input type="submit" class="btn btn-secondary rounded w-60  mr-3 mb-1"
											name="preview" value="<?=trans('preview')?>">
										<input type="submit" class="btn job_detail_btn rounded w-60 mb-1"
											name="post_job" value="<?=trans('update')?>">


									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="profile_job_detail">
						<div class="row">


							<div class="col-xl-4 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('job_title')?> *</h5>
									<input class="form-control" maxlength="50" onkeyup="countChars(this);" type="text" name="job_title"
										value="<?= old('job_title');?>" placeholder="<?=trans('job_title')?>" required>
									<div class="float-right p-1 mt-1 fz-12 lh-1"><small id="titleChar">0</small><small >/50 Max Characters </small> </small></div>
								</div>
							</div>

							<div class="col-xl-1 col-md-2 d-xl-block d-md-none">
								&nbsp;
							</div>

							<div class="col-xl-2 col-md-4 col-sm-6">
								<div class="submit-field">
									<h5><?=trans('publish_vacancy')?> *</h5>
									<select name="publish_vacancy" class="form-control">
										<option value="yes"><?= trans('yes'); ?></option>
										<option value="no"><?= trans('no'); ?></option>
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-md-4 col-sm-6">
								<div class="submit-field">
									<h5><?=trans('post_expiry_date')?> *</h5>
									<div class="input-group date">
										<input id="post_date" class="form-control datepicker" placeholder="DD-MMM-YYYY"
											type="text" name="expiry_date" value="<?= old('expiry_date');?>">
										<div class="input-group-append">
											<div class="input-group-text"><span class="fa fa-calendar"></span></div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-2 col-sm-6">
								<div class="submit-field">
									<h5><?=trans('upload_vacancy_info')?></h5>
									<input class="form-control full-width input-upload topfreelancer-upload" type="file"
										id="vacancy-upload" name="vacancy_info" value="<?= old('vacancy_info');?>">
									<div class="float-right p-1 mt-1 mr-4 fz-12 lh-1">
										<small>(<?=trans('resume_size_msg')?>)</small></div>
								</div>
							</div>


							<div class="col-md-12 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('skills')?> *</h5>
									<input type="text" name="skills" class="form-control" id="skills"
										placeholder="eg, html, css, php, javascript" value="<?= old('skills');?>"
										required>
									<div class="float-right p-1 mt-1 fz-12 lh-1"><small id="skills-rd">Max 10 Skills (Seperated by commas)</small></div>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 mb-5">
								<div class="submit-field">
									<h5><?=trans('vacancy_requirements')?> *</h5>
									<textarea onKeyPress="return ( this.value.length < 500 );" name="requirements"
										value="<?= old('requirements');?>" onkeyup="countChars(this);"  class="textarea form-control" maxlength="500"
										id="vacancy_requirements" rows="3" required></textarea>
									<div class="float-right p-1 mt-1 fz-12 lh-1"><small id="vacChar">0</small><small >/500 Max Characters </small> 
									</div>
								</div>
							</div>

							<div id="candidate" class="col-100-5 border-right min-w">
								<h4 class="mb-3 clr2 text-center"><?= trans('candidate'); ?></h4>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('working_experience')?> *</h5>
										<div class="input-group">
											<?php 
									$options = get_experience_list('');
									echo form_dropdown('experience',$options,'','class="form-control" required');
								?>
										</div>
									</div>
								</div>


								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?= trans('required'); ?> 1st <?=trans('language')?> *</h5>
										<select name="lang1" class="form-control" required>
											<option value="" disabled selected><?=trans('select_language')?></option>
											<?php $languages = get_languages_list(); foreach($languages as $language):?>
											<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?= trans('required'); ?> 2nd <?=trans('language')?></h5>
										<select name="lang2" class="form-control">
											<option value="" disabled selected><?=trans('select_language')?></option>
											<?php $languages = get_languages_list(); foreach($languages as $language):?>
											<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('nationality')?></h5>
										<select select name="nationality" class="form-control">
											<option value="" disabled selected><?=trans('select_nationality')?></option>
											<?php foreach($countries as $country):?>
											<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

							</div>

							<div id="location" class="col-100-5 border-right min-w">
								<h4 class="mb-3 clr2 text-center"><?= trans('location'); ?></h4>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('city')?> *</h5>
										<input class="form-control" type="text" name="city" placeholder="City" value="<?= old('city');?>" required>
									</div>
								</div>


								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('country')?> *</h5>
										<select select name="country" class="form-control" required>
											<option value="" disabled selected><?=trans('select_country')?></option>
											<?php foreach($countries as $country):?>
											<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('emp_type')?> *</h5>
										<select name="employment_type" class="form-control" required>
											<option value=""><?=trans('select_workstation')?></option>
											<?php $employment_type = get_employment_type_list(); foreach($employment_type as $employment):?>
											<option value="<?= $employment['id']; ?>"> <?= $employment['type']; ?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('travel_req')?></h5>
										<select name="travel_req" class="form-control">
											<option value="" disabled selected><?=trans('travel_req')?></option>
											<option value="0%">0%</option>
											<option value="25%">25%</option>
											<option value="50%">50%</option>
											<option value="75%">75%</option>
											<option value="100%">100%</option>
										</select>
									</div>
								</div>

							</div>
							<div id="time" class="col-100-5 border-right min-w">
								<h4 class="mb-3 clr2 text-center"><?= trans('time'); ?></h4>
								<!-- -------------------------------- -->
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('start_date')?> *</h5>
										<div class="input-group date">
											<input id="post_date" class="form-control datepicker"
												placeholder="DD-MMM-YYYY" type="text" name="start_date"
												value="<?= old('start_date') ?>" required>
											<div class="input-group-append">
												<div class="input-group-text"><span class="fa fa-calendar"></span></div>
											</div>
										</div>
										<div class="float-right p-1 mt-1 fz-12 lh-1"><small>DD-MMM-YYYY</small></div>
									</div>
								</div>
								<!-- -------------------------------- -->


								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('time_period')?> *</h5>
										<div class="input-group">
											<?php 
									$options = get_time_period();
									echo form_dropdown('time_period',$options,'','class="form-control" required');
								?>
										</div>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('min_availability')?> *</h5>
										<div class="input-group">
											<?php 
									$options = get_availability();
									echo form_dropdown('availability',$options,'','class="form-control" required');
								?>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('project_phase')?> *</h5>
										<select select name="project_phase" class="form-control" required>
											<option value="">Choose a Project Phase</option>
											<option value="0"><?= trans('project_awarded')?></option>
											<option value="1"><?= trans('proposal_preparation')?></option>
											<option value="2"><?= trans('project_inProgress')?></option>
										</select>
									</div>
								</div>


							</div>
							<div id="payment" class="col-100-5 border-right min-w">
								<h4 class="mb-3 clr2 text-center"><?= trans('payment'); ?></h4>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('day_rate')?> *</h5>
											<div class="row">
												<div class="col-md-6 col-sm-6 mb-2">
													<input class="form-control" type="text" name="min_salary"
														value="<?= old('min_salary');?>" placeholder="Negotiable" required>
												</div>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" name="max_salary"
														value="<?= old('max_salary');?>" placeholder="Negotiable" required>
												</div>
											</div>
											<div class="float-right fz-12"><small>In US $</small></div>
									</div>
								</div>


								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Pay Type</h5>
										<select select name="pay_type" class="form-control">
											<option value="" disabled selected>Choose Pay Type</option>
											<option value="delivery-based">Delivery-Based</option>
											<option value="time-based">Time-Based</option>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Flights</h5>
										<select select name="flights" class="form-control">
											<option value="" disabled selected>Choose Pay Type</option>
											<option value="">Flights Status</option>
											<option value="0"><?= trans('not_paid')?></option>
											<option value="1"><?= trans('paid')?></option>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Hotel</h5>
										<select select name="hotel" class="form-control">
											<option value="" disabled selected>Hotel Status</option>
											<option value="0"><?= trans('not_paid')?></option>
											<option value="1"><?= trans('paid')?></option>
										</select>
									</div>
								</div>

							</div>



							<div id="contact" class="col-100-5 border-right min-w">
								<h4 class="mb-3 clr2 text-center"><?= trans('contact'); ?></h4>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('name')?> *</h5>
										<input class="form-control" type="text" name="name" placeholder="John Doe"
											value="<?= old('name') ?>" required>
									</div>
								</div>


								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('email')?> *</h5>
										<input class="form-control" type="email" name="email"
											value="<?= old('email') ?>" placeholder="email@email.com" required>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('phone')?></h5>
										<input class="form-control" type="text" name="phone" placeholder="97112345678"
											value="<?= old('phone') ?>">
									</div>
								</div>


							</div>

							<div class="col-md-12 col-sm-12 mt-3">

								<div class="row">

									<div class="col-lg-2 col-sm-3 mt-2">
										<div class="form-check form-check-inline">Vacancy Highlight:</div>
									</div>

									<div class="col-lg-2 col-sm-3 ">
										<div class="submit-field">

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" name="trainer"
													id="trainer" value="1">
													<div class="btn bg-warning text-black btn-custom-style2 mt-1"><?=trans('trainer')?>
									</div>
												<!-- <label class="btn bg-warning text-black btn-custom-style mt-1"
													for="trainer"><?=trans('trainer')?> </label>
													</div> -->
										</div>
										</div>
										</div>
										<div class="col-lg-2 col-sm-3 ">

										<div class="submit-field">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" name="consultant"
													id="consultant" value="1">
													<div class="btn  btn-info text-white btn-custom-style2 mt-1">
										<?=trans('consultant')?> </div>
												<!-- <div calss="col-lg-6 col-md-6 col-sm-6 ">
												<label class="btn bg-info text-black btn-custom-style mt-1"
													for="consultant"><?=trans('consultant')?> </label>
													</div> -->
											</div>
										</div>
										</div>

									<div class="col-lg-8 col-sm-3">
										<div class="float-right">
											<span>* Required Fields</span>
										</div>
									</div>

								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close();?>



		</div>
	</div>
	</div>
</section>
<!-- End post Area -->
<script>
	$('.datepicker').datepicker({
		format: 'dd-M-yyyy',
		startDate: '+0d',
		orientation: 'bottom'
	});

</script>
<script>

function countChars(obj){
    document.getElementById("titleChar").innerHTML = obj.value.length+'';
	document.getElementById("titleChar").style.color = "red";

    document.getElementById("vacChar").innerHTML = obj.value.length+'';
	document.getElementById("vacChar").style.color = "red";
}
</script>

<script>
// 	$("#skills").keyup(function(){
//     var value = $(this).val().replace(" ", "");
//     var words = value.split(",");

//     if(words.length >= 11){
//         // alert("Hey! That's more than 5 words!");
//         // $(this).val("");
// 		document.getElementById("skills-rd").style.color = "red";
// 		document.onkeydown = function (e) {
//         return false;}		
//     }
// });
document.getElementById('skills').onkeydown = function(e){
    if (!e) var e = window.event;
    var list = this.value.split(',');
     if (list.length == 10 && e.keyCode  ==  '188' )
     {
         // what to do if more than 5 commas(,) are entered
         // i put a red border and make it go after 1 second
		 
		 document.getElementById("skills-rd").style.color = "red";
         this.style.borderColor ='red';
         var _this  =  this;
         setTimeout(function(){
              _this.style.borderColor='red';
              _this.disabled=false;
         },1000);
         // return false to forbid the surplus comma to be entered in the field
         return false;
     }
}
</script>