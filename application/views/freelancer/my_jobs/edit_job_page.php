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
.datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
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
					<div class="col-xl-6 col-md-12 col-sm-12"><h3><?=trans('vacancy_information')?></h3></div>
					<div class="col-xl-6 col-md-12 col-sm-12 d-inline-block">
						<div class="float-right">
                    		<input type="submit" class="btn btn-secondary rounded" name="edit" value="<?=trans('delete')?>">
                      		<input type="submit" class="btn btn-secondary rounded" name="edit" value="<?=trans('edit')?>">
							<input type="submit" class="btn btn-secondary ml-2" name="preview" value="<?=trans('preview')?>">
							<input type="submit" class="btn job_detail_btn ml-2" name="post_job" value="<?=trans('update')?>">
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
						<input class="form-control" maxlength="50" type="text" name="job_title" value="<?= $job_detail['title'];?>" required>
						<div class="float-right p-1 mt-1 fz-12 lh-1"><small>50 Max Characters</small></div>
						</div>
                  	</div>

					<div class="col-xl-2 col-md-2 d-xl-block d-md-none">
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
								<input id="post_date" class="form-control datepicker" value="<?= $job_detail['expiry_date']; ?>"type="text" name="expiry_date">
								<div class="input-group-append"><div class="input-group-text"><span class="fa fa-calendar"></span></div></div>
							</div>
						</div>
          			</div>

					<div class="col-xl-2 col-md-4 col-sm-6">
						<div class="submit-field">
							<h5><?=trans('upload_vacancy_info')?></h5>
							<input class="form-control full-width input-upload topfreelancer-upload" type="file" id="vacancy-upload" name="vacancy_info" value="">
							<div class="float-right p-1 mt-1 mr-4 fz-12 lh-1"><small>(<?=trans('resume_size_msg')?>)</small></div>
						</div>
					</div>


					<div class="col-md-12 col-sm-12">
						<div class="submit-field">
						<h5><?=trans('skills')?> *</h5>
						<input type="text" name="skills" class="form-control" value="<?= $job_detail['skills']; ?>" required>
						<div class="float-right p-1 mt-1 fz-12 lh-1"><small>Max 10 Skills</small></div>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 mb-5">
						<div class="submit-field">
							<h5><?=trans('vacancy_requirements')?> *</h5>
							<textarea  onKeyPress="return ( this.value.length < 500 );" name="requirements" class="textarea form-control" maxlength="500" id="vacancy_requirements" rows="3" required><?= $job_detail['requirements']; ?>							
							</textarea>
							<div class="float-right p-1 mt-1 fz-12 lh-1"><small>500 Max Characters </small></div>
						</div>
					</div>
					
					<div id="candidate" class="col-md-2 border-right">
						<h4 class="mb-3 clr2 text-center"><?= trans('candidate'); ?></h4>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('working_experience')?>  *</h5>
							<div class="input-group">
								<?php 
									$options = get_experience_list('');
									echo form_dropdown('experience',$options,'','class="form-control"');
								?>
							</div>
							</div>
						</div>
				

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5><?= trans('required'); ?> 1st <?=trans('language')?> *</h5>
								<select name="lang1" class="form-control">
								<option value=""><?=trans('select_language')?></option>
									<?php $languages = get_languages_list(); foreach($languages as $language):?>
									<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?> </option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5><?= trans('required'); ?> 2nd <?=trans('language')?></h5>
								<select name="lang2" class="form-control">
								<option value=""><?=trans('select_language')?></option>
									<?php $languages = get_languages_list(); foreach($languages as $language):?>
									<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?> </option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5><?=trans('nationality')?></h5>
								<select	select name="nationality" class="form-control">
								<option value=""><?=trans('select_nationality')?></option>
									<?php foreach($countries as $country):?>
									<?php if($job_detail['nationality'] == $country['id']): ?>
										<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
									<?php else: ?>
										<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>

					</div>

					<div id="location" class="col-md-2 border-right">
						<h4 class="mb-3 clr2 text-center"><?= trans('location'); ?></h4>

						<div class="col-md-12 col-sm-12">
                 			 <div class="submit-field">
                    		<h5><?=trans('city')?> *</h5>
							<input class="form-control" value="<?= $job_detail['city'] ?>" type="text" name="city">
                  			</div>
               			</div>
				

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5><?=trans('country')?> *</h5>
								<select	select name="country" class="form-control">
									<option value=""><?=trans('select_country')?></option>
									<?php foreach($countries as $country):?>
									<?php if($job_detail['country'] == $country['id']): ?>
										<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
									<?php else: ?>
										<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('emp_type')?> *</h5>
							<select name="employment_type" class="form-control">
								<option value=""><?=trans('select_workstation')?></option>
								<?php $employment_type = get_employment_type_list(); foreach($employment_type as $employment):?>
								<?php if($job_detail['employment_type'] == $employment['id']): ?>
									<option value="<?= $employment['id']; ?>" selected> <?= $employment['type']; ?> </option>
								<?php else: ?>
									<option value="<?= $employment['id']; ?>"> <?= $employment['type']; ?> </option>
								<?php endif; endforeach; ?>
							</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('travel_req')?></h5>
								<select name="travel_req" class="form-control">
									<option value=""><?=trans('travel_req')?></option>
									<option value="0%">0%</option>
									<option value="25%">25%</option>
									<option value="50%">50%</option>
									<option value="75%">75%</option>
									<option value="100%">100%</option>
								</select>
							</div>
						</div>

					</div>

					<div id="payment" class="col-md-3 border-right">
						<h4 class="mb-3 clr2 text-center"><?= trans('payment'); ?></h4>

						<div class="col-md-12 col-sm-12">
                 			<div class="submit-field">
                    		<h5><?=trans('day_rate')?> *</h5>
								<div class="container">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<input class="form-control" type="text" name="min_salary" value="<?= $job_detail['min_salary'] ?>" required>
										</div>
										<div class="col-md-6 col-sm-6">
											<input class="form-control" type="text" name="max_salary" value="<?= $job_detail['max_salary'] ?>" required></div>
										</div>
										<div class="float-right p-1 mt-1 fz-12 lh-1"><small>In US $</small></div>
									</div>						
								</div>
               			</div>
				

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5>Pay Type</h5>
								<select	select name="pay_type" class="form-control">
									<option value="">Choose Pay Type</option>
									<option value="delivery-based" <?php if($job_detail['pay_type'] == "delivery-based") : ?> selected <?php endif; ?> >Delivery-Based</option>
									<option value="time-based" <?php if($job_detail['pay_type'] == "time-based") : ?> selected <?php endif; ?> >Time-Based</option>
								</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5>Flights</h5>
								<select	select name="flights" class="form-control">
									<option value="">Flights Status</option>
									<option value="0" <?php if($job_detail['flights'] == "0") : ?> selected <?php endif; ?> ><?= trans('not_paid')?></option>
									<option value="1" <?php if($job_detail['flights'] == "1") : ?> selected <?php endif; ?> ><?= trans('paid')?></option>
								</select>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
								<h5>Hotel</h5>
								<select	select name="hotel" class="form-control">
									<option value="">Hotel Status</option>
									<option value="0" <?php if($job_detail['hotel'] == "0") : ?> selected <?php endif; ?> ><?= trans('not_paid')?></option>
									<option value="1" <?php if($job_detail['hotel'] == "1") : ?> selected <?php endif; ?> ><?= trans('paid')?></option>
								</select>
							</div>
						</div>

					</div>

					<div id="time" class="col-md-2 border-right">
						<h4 class="mb-3 clr2 text-center"><?= trans('time'); ?></h4>

						<div class="col-md-12 col-sm-12">
                 			<div class="submit-field">
                    			<h5><?=trans('start_date')?> *</h5>
								<div class="input-group date">
								<input id="start_date" class="form-control datepicker" value="<?= $job_detail['start_date'] ?>" type="text" name="start_date">
									<div class="input-group-append"><div class="input-group-text"><span class="fa fa-calendar"></span></div></div>
								</div>
								<div class="float-right p-1 mt-1 fz-12 lh-1"><small>DD-MMM-YYYY</small></div>
							</div>
               			</div>
				

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('time_period')?>  *</h5>
							<div class="input-group">
								<?php 
									$options = get_time_period();
									echo form_dropdown('time_period',$options,$job_detail['time_period'],'class="form-control"');
								?>
							</div>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('min_availability')?>  *</h5>
							<div class="input-group">
								<?php 
									$options = get_availability();
									echo form_dropdown('availability',$options,$job_detail['availability'],'class="form-control"');
								?>
							</div>
							</div>
						</div>


					</div>

					<div id="contact" class="col-md-3 border-right">
						<h4 class="mb-3 clr2 text-center"><?= trans('contact'); ?></h4>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('name')?> *</h5>
							<input class="form-control" type="text" name="name" value="<?= $job_detail['name']; ?>" required>
							</div>
						</div>
				

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('email')?> *</h5>
							<input class="form-control" type="email" name="email" value="<?= $job_detail['email']; ?>" required>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="submit-field">
							<h5><?=trans('phone')?></h5>
							<input class="form-control" type="text" name="phone" value="<?= $job_detail['phone']; ?>">
							</div>
						</div>


					</div>

					<div class="col-md-12 col-sm-12 mt-5">
						<div class="submit-field">
							<div class="form-check form-check-inline">Vacancy Highlight:</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="trainer" id="trainer" value="1">
								<label class="form-check-label btn btn-sm btn-warning" for="trainer"><?=trans('trainer')?> </label>
							</div>			

							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="consultant" id="consultant" value="1">
								<label class="form-check-label btn btn-sm btn-info" for="consultant"><?=trans('consultant')?> </label>
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
	$('#post_date').datepicker({
		format: 'dd-M-yyyy',
		startDate: '+0d'
	});
</script>
