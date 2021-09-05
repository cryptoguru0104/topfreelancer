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

				<?php $attributes = array('id' => 'update_user_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
				<?php echo form_open_multipart('profile',$attributes);?>

				<div class="profile_job_content col-lg-12">
					<div class="headline d-flex">
						<div class="col-md-6 col-sm-12">
							<h3><?=trans('personal_info')?></h3>
						</div>

						<div class="col-md-6 d-inline-block">
							<div class="d-grid gap-2 d-md-flex justify-content-md-end">
								<input type="submit" class="btn btn-secondary rounded w-30 mr-3 mb-1" name="preview"
									value="<?=trans('preview')?>">
								<input type="submit" class="btn job_detail_btn rounded w-30 mb-1" name="update"
									value="<?=trans('update')?>">
							</div>
						</div>
					</div>

					<div class="profile_job_detail">
						<div class="row">

							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('first_name')?> *</h5>
									<input class="form-control" type="text" name="firstname"
										value="<?= $user_info['firstname']  ?>" placeholder="John" disabled>
								</div>
							</div>
							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('last_name')?> *</h5>
									<input class="form-control" type="text" name="lastname"
										value="<?= $user_info['lastname']  ?>" placeholder="Wick" disabled>
								</div>
							</div>
							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('email')?> *</h5>
									<input class="form-control" type="email" name="email"
										value="<?= $user_info['email']  ?>" placeholder="example@example.com" disabled>
									<?php if($user_info["is_verify"] == 1) : ?>
									<div class="bg-gray float-right p-1 mt-1 fz-12"><?=trans('email_confirmed')?></div>
									<?php else: ?>
									<div class="bg-gray float-right p-1 fz-12"><?=trans('email_not_confirmed')?></div>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('phone')?></h5>
									<input class="form-control" type="tel" name="mobile_no"
										value="<?= $user_info['mobile_no']  ?>" placeholder="1 5555 66666" disabled>
									<div class="float-right p-1 mt-1 fz-12 lh-1">
										<label for="ok_publish"> <?=trans('ok_publish')?></label>
										<input type="checkbox" id="ok_publish" name="ok_publish" value="1"
											<?php if($user_info['ok_publish'] == '1'): ?> checked <?php endif; ?>>
									</div>
								</div>
							</div>


							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('country')?> *</h5>
									<select name="country" class="country form-control" disabled>
										<option><?=trans('select_country')?></option>
										<?php foreach($countries as $country):?>
										<?php if($user_info['country'] == $country['id']): ?>
										<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?>
										</option>
										<?php else: ?>
										<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
										<?php endif; endforeach; ?>
									</select>
								</div>
							</div>



							<!--<div class="col-xl-3 col-md-4 col-sm-12">
                    <div class="submit-field">
                    <h5><?=trans('state')?> *</h5>
                    <?php 
                      $states = get_country_cities($user_info['country']);
                      $options = array('' => 'Select State')+array_column($states, 'name','id');
                      echo form_dropdown('state',$options,$user_info['state'],'class="form-control state" required');
                    ?>
                  	</div>
									</div>-->

							<div class="col-xl-2 col-md-4 col-sm-12">
								<div class="submit-field">
									<h5><?=trans('city')?> *</h5>
									<input class="form-control" type="text" name="city"
										value="<?= $user_info['city']  ?>" disabled>
								</div>
							</div>






							<div class="col-lg-2 col-md-3 col-sm-4 col-12  mt-2">
								<div class="submit-field">
									<h5><?=trans('profile_picture')?> *</h5>
									<?php if ( $user_info['profile_picture'] ) : ?>
									<img src="<?= $user_info['profile_picture']  ?>" id="profilepic" class="img-fluid"
										width="150px" alt=""
										title="<?= $user_info['firstname']  ?> <?= $user_info['lastname']   ?>" />
									<input type="hidden" name="profile_picture"
										value="<?= $user_info['profile_picture']  ?>">
									<?php endif; ?>
									<input class="form-control full-width mt-2 topfreelancer-upload-p" type="file"
										id="profilepicupload" name="profile_picture" required>

									<input type="hidden" name="old_profile_picture"
										value="<?= $user_info['profile_picture']  ?>">
								</div>
							</div>

							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<div class="submit-field">
									<h5><?=trans('profile_summary')?> *</h5>
									<textarea name="description" class="form-control" maxlength="800"
										onkeyup="countChars(this);" cols="6" rows="15"
										required><?= $user_info['description']  ?></textarea>
									<div class="float-right p-1 mt-1 fz-12 lh-1"> <small class="charnum"
											id="charNum">0</small><small>/800 Max Characters </small> </div>
								</div>
							</div>


							<div class="col-md-6 col-sm-12 mt-2">

								<div class="col-md-12">
									<div class="submit-field">
										<h5><?=trans('profile_header')?> *</h5>
										<input class="form-control" type="text" name="profile_header"
											value="<?= $user_info['profile_header']  ?>" placeholder="Profile Header"
											required>
										<div class="float-right p-1 mt-1 mr-4 fz-12 lh-1"><small>100 Max
												Characters</small></div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="submit-field">
										<h5><?=trans('linkedin_link')?></h5>
										<input class="form-control" type="text" name="linkedin_link"
											value="<?= $user_info['linkedin_link']  ?>"
											placeholder="http://linkedin.com/topfreelancer">
									</div>
								</div>
								<div class="row container">
									
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="submit-field">
											<h5><?=trans('page_link')?></h5>
											<input class="form-control" type="text" name="page_link"
												value="<?= $user_info['page_link']  ?>"
												placeholder="http://yourdomain.com/">
										</div>
									</div>

									<div class="col-lg-6 col-md-12  col-sm-12">
										<div class="submit-field">
											<h5>Legal Business Name</h5>
											<input class="form-control" type="text" name="business_name" 
											value="<?= $user_info['business_name']  ?>" placeholder="Legal Business Name">
										</div>
									</div>
								</div>

								<?php echo form_open_multipart('profile/resume',$attributes);?>
								<div class="col-lg-12 my-3">
									<h5>Upload Resume * </h5>
									<?php if($user_info['resume']): ?>
									<div class="col-lg-8 col-md-8 col-sm-12 col-12 float-left">
										<?php else: ?>
										<div class="w-100 float-left">
											<?php endif; ?>
											<input class="form-control full-width input-upload topfreelancer-upload"
												type="file" id="resume-upload" name="resume" value="">
											<input class="form-control topfreelancer-upload" type="hidden"
												name="old_resume" value="<?= $user_info['resume']; ?>">
											<div class="float-right p-1 mt-1 mr-4 fz-12 lh-1">
												<small>(<?=trans('resume_size_msg')?>)</small>
											</div>
										</div>

										<?php if($user_info['resume']): ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="d-grid d-md-flex justify-content-md-end">
												<a class="btn btn-secondary rounded w-100"
													href="<?= base_url().$user_info['resume']; ?>"
													target="_blank"><?=trans('resume_down_msg')?></a>
												<input type="hidden" name="resume" value="<?= $user_info['resume']; ?>">
											</div>
										</div>
										<?php endif; ?>

									</div>
									<?php echo form_close();?>

								</div>



								<div class="mt-4"></div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('skills')?> *</h5>
										<input type="tel" name="skills" value="<?= $user_info['skills']  ?>"
											class="form-control" placeholder="eg, html, css, php, javascript">
										<div class="float-right p-1 mt-1 fz-12 lh-1"> <small>Separate using semicolon
												(;) | Max 10 Skills</small></div>


									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<?php 
										$exp = $user_info['experience'];
									?>
										<h5><?=trans('experience')?> *</h5>
										<?php 
											$options = get_experience_list('');
											echo form_dropdown('experience',$options,$exp,'class="form-control"');
										?>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('education')?> *</h5>
										<select name="education_level" class="form-control">
											<option value=""><?=trans('select_education')?></option>
											<?php foreach($educations as $education):?>
											<?php if($user_info['education_level'] == $education['id']): ?>
											<option value="<?= $education['id']; ?>" selected>
												<?= $education['type']; ?> </option>
											<?php else: ?>
											<option value="<?= $education['id']; ?>"> <?= $education['type']; ?>
											</option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('nationality')?> *</h5>
										<select name="nationality" class="form-control">
											<option value=""><?=trans('select_nationality')?></option>
											<?php foreach($countries as $country):?>
											<?php if($user_info['nationality'] == $country['id']): ?>
											<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?>
											</option>
											<?php else: ?>
											<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('residency_visa')?> *</h5>
										<select name="residency" class="form-control">
											<option value=""><?=trans('select_residency')?></option>
											<?php foreach($countries as $country):?>
											<?php if($user_info['residency'] == $country['id']): ?>
											<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?>
											</option>
											<?php else: ?>
											<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>


								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">

										<h5>1st <?=trans('language')?> *</h5>
										<select name="lang1" class="form-control">
											<option value=""><?=trans('select_language')?></option>
											<?php $languages = get_languages_list(); foreach($languages as $language):?>
											<?php if($user_info['lang1'] == $language['lang_id']): ?>
											<option value="<?= $language['lang_id']; ?>" selected>
												<?= $language['lang_name']; ?> </option>
											<?php else: ?>
											<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?>
											</option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>


								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5>2nd <?=trans('language')?> *</h5>
										<select name="lang2" class="form-control">
											<option value=""><?=trans('select_language')?></option>
											<?php $languages = get_languages_list(); foreach($languages as $language):?>
											<?php if($user_info['lang2'] == $language['lang_id']): ?>
											<option value="<?= $language['lang_id']; ?>" selected>
												<?= $language['lang_name']; ?> </option>
											<?php else: ?>
											<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?>
											</option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<?php 
                							$av = $user_info['availability'];
						  ?>
										<h5><?=trans('availability')?> *</h5>
										<?php 
										$options = get_availability();
										echo form_dropdown('availability',$options,$av,'class="form-control"');
									?>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('start_date')?> *</h5>
										<div class="input-group date">
											<input id="start_date" class="form-control datepicker"
												placeholder="DD-MMM-YYYY" type="text" name="start_date"
												value="<?= $user_info['start_date']  ?>">
											<div class="input-group-append">
												<div class="input-group-text"><span class="fa fa-calendar"></span></div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('emp_type')?> *</h5>
										<select name="employment" class="form-control">
											<option value=""><?=trans('select_workstation')?></option>
											<?php $employment_type = get_employment_type_list(); foreach($employment_type as $employment):?>
											<?php if($user_info['employment'] == $employment['id']): ?>
											<option value="<?= $employment['id']; ?>" selected>
												<?= $employment['type']; ?> </option>
											<?php else: ?>
											<option value="<?= $employment['id']; ?>"> <?= $employment['type']; ?>
											</option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('travel_willingness')?> *</h5>
										<select name="travel_willingness" class="form-control">
											<option value=""><?=trans('select_travel_willingness')?></option>
											<option value="0%"
												<?php if($user_info['travel_willingness'] == '0%'){ echo "selected";} ?>>
												0%
											</option>
											<option value="25%"
												<?php if($user_info['travel_willingness'] == '25%'){ echo "selected";} ?>>
												25%
											</option>
											<option value="50%"
												<?php if($user_info['travel_willingness'] == '50%'){ echo "selected";} ?>>
												50%
											</option>
											<option value="75%"
												<?php if($user_info['travel_willingness'] == '75%'){ echo "selected";} ?>>
												75%
											</option>
											<option value="100%"
												<?php if($user_info['travel_willingness'] == '100%'){ echo "selected";} ?>>
												100%</option>
										</select>
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('day_rate')?> *</h5>
										<input class="form-control" type="text" name="day_rate"
											value="<?= $user_info['day_rate']  ?>">
									</div>
								</div>

								<div class="col-xl-2 col-md-4 col-sm-6">
									<div class="submit-field">
										<h5><?=trans('publish_profile')?> *</h5>
										<select name="publish_profile" class="form-control">
											<option value="yes"
												<?php if($user_info['publish_profile'] == 'yes'){ echo "selected";} ?>>
												Yes
											</option>
											<option value="no"
												<?php if($user_info['publish_profile'] == 'no'){ echo "selected";} ?>>No
											</option>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<div class="d-inline-block col-md-2"><?=trans('i_am_prof')?>: </div>

										<div class="form-check col-md-1 form-check-inline">
											<input class="form-check-input" type="checkbox" name="trainer"
												id="<?=trans('trainer')?>" value="1"
												<?php if($user_info['trainer'] == '1'){ echo "checked";} ?>>
											<label class="form-check-label btn btn-sm btn-warning"
												for="<?=trans('trainer')?>"><?=trans('trainer')?> </label>
										</div>

										<div class="form-check col-md-1 form-check-inline">
											<input class="form-check-input" type="checkbox" name="consultant"
												id="<?=trans('consultant')?>" value="1"
												<?php if($user_info['consultant'] == '1'){ echo "checked";} ?>>
											<label class="form-check-label btn btn-sm btn-info"
												for="<?=trans('consultant')?>"><?=trans('consultant')?> </label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ------------------------------------------------------------------------ -->
<section class="post-area pb-5">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<div class="col-lg-12 post-list">

				<?php $attributes = array('id' => 'update_econsultation_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
				<?php echo form_open_multipart('profile/updateEconsultation',$attributes);?>

				<div class="profile_job_content col-lg-12">
					<div class="col-lg-12 post-list">
						<div class="profile_job_detail">
							<div class="headline d-flex">
								<div class="col-md-6 col-sm-12">
									<h3 class="py-3" style="color:#008ae6;"><?=trans('econsultation_title')?>
									</h3>
								</div>

								<div class="col-md-6 d-inline-block">
									<div class="d-grid gap-2 d-md-flex justify-content-md-end">

										<input type="submit" class="btn job_detail_btn rounded w-30 ml-2"
											name="updateEconsultation" value="<?=trans('update')?>">
									</div>
								</div>
							</div>

							<div class="row pt-3 pb-3">

								<div class="col-md-12 col-sm-12">

									<div class="form-check form-check-inline">
										<input class="form-check-input checkbox_size" type="checkbox"
											name="econsultation_participate" id="" value=""
											<?php if($econsultation_info['econsultation_participate'] == '1'){ echo "checked";} ?>>
										<label class="form-check-label consultant_txt"
											for=""><?= trans('eConsultation_participate') ?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-4 pt-5 mb-2">
									<div class="form-check form-check-inline">
										<input class="form-check-input checkbox_size" type="checkbox"
											name="conference_details" id="" value=""
											<?php if($econsultation_info['econsultation_participate'] == '1'){ echo "checked";} ?>>
										<label class="form-check-label consultant_txt" for="">
											<?= trans('conference_details') ?>
										</label>
									</div>
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="submit-field">
										<h5><?=trans('conference_name')?> *</h5>
										<input class="form-control" type="text" name="conference_name"
											value="<?=$econsultation_info['conference_name']?>" placeholder="">
									</div>
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="submit-field">
										<h5><?=trans('conference_link')?> *</h5>
										<input class="form-control" type="text" name="conference_link"
											value="<?=$econsultation_info['conference_link']?>" placeholder="">
									</div>
								</div>


								<div class="col-md-4 col-sm-4">

								</div>

								<div class="col-md-8 col-sm-8">
									<div class="submit-field">
										<h5><?=trans('conference_invmsg')?> </h5>
										<textarea class="form-control" type="text" name="conference_invmsg"
											placeholder=""><?= $econsultation_info['conference_invmsg'] ?>
										</textarea>
									</div>
								</div>

								<div class="col-md-4 col-sm-4 pt-5 mb-2">
									<div class="form-check form-check-inline">
										<input class="form-check-input checkbox_size" type="checkbox"
											name="send_payment_details" id="" value=""
											<?php if($econsultation_info['econsultation_participate'] == '1'){ echo "checked";} ?>>
										<label class="form-check-label consultant_txt"
											for=""><?= trans('send_payment_details') ?></label>
									</div>
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="submit-field">
										<h5><?=trans('payment_name')?> *</h5>
										<input class="form-control" type="text" name="payment_name"
											value="<?=$econsultation_info['payment_name']?>" placeholder="">
									</div>
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="submit-field">
										<h5><?=trans('payment_link')?> *</h5>
										<input class="form-control" type="text" name="payment_link"
											value="<?=$econsultation_info['payment_link']?>" placeholder="">
									</div>
								</div>


								<div class="col-md-4 col-sm-4">

								</div>

								<div class="col-md-8 col-sm-8">
									<div class="submit-field">
										<h5><?=trans('payment_details')?> *</h5>
										<textarea class="form-control" type="text" name="payment_details"
											placeholder="">
											<?= $econsultation_info['payment_details'] ?>
										</textarea>
									</div>
								</div>

								<div class="col-md-12">
									<h3 class="pt-5 px-5 pb-5" style="color:#008ae6;">
										<?=trans('econsultation_schedule_title')?>
									</h3>
								</div>
							</div>



							<div class="row">

								<div class="col-md-5">
									<div class="table-responsive-lg">

										<table class="table  table-hover table-sm">
											<thead>
												<div class="col-md-3">
													<tr>
														<th scope="col" class="consultant_txt">Day</th>
														<th scope="col" class="consultant_txt">From Hour</th>
														<th scope="col" class="consultant_txt">To Hour</th>
													</tr>
												</div>

											</thead>
											<tbody>

												<?php $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "saturday");?>

												<?php foreach($days as $day):?>
												<tr>
													<th scope="row" class="form-check form-check-inline pt-4">
														<input class="form-check-input checkbox_size" type="checkbox"
															name="" id="" value="" ?>
														<?= $day ?>
													</th>
													<td><input type="time" id="inputMDEx1" class="form-control"></td>
													<td><input type="time" id="inputMDEx1" class="form-control"></td>

												</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>

								</div>
								<div class="col-md-1"></div>

								<div class="col-md-2 pt-5">
									<div class="submit-field">
										<h5><?=trans('econsultation_hourly_rate')?> </h5>
										<input class="form-control" type="text" name="econsultation_hourly_rate"
											value="<?=$econsultation_info['econsultation_hourly_rate']?>"
											placeholder="">
										<label class="float-right" for=""><?=trans('in_usd')?> </label>
									</div>
								</div>



								<div class="col-md-2 pt-5">
									<div class="submit-field">
										<h5><?=trans('timezone')?> </h5>
										<select class="form-control" name="timezone">
											<option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0"
												value="-12">(GMT-12:00) International Date Line West</option>
											<option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0"
												value="-11">(GMT-11:00) Midway Island, Samoa</option>
											<option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0"
												value="-10">(GMT-10:00) Hawaii</option>
											<option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1"
												value="-9">
												(GMT-09:00) Alaska</option>
											<option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1"
												value="-8">
												(GMT-08:00) Pacific Time (US & Canada)</option>
											<option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1"
												value="-8">
												(GMT-08:00) Tijuana, Baja California</option>
											<option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0"
												value="-7">
												(GMT-07:00) Arizona</option>
											<option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1"
												value="-7">
												(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
											<option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1"
												value="-7">
												(GMT-07:00) Mountain Time (US & Canada)</option>
											<option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0"
												value="-6">(GMT-06:00) Central America</option>
											<option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1"
												value="-6">(GMT-06:00) Central Time (US & Canada)</option>
											<option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1"
												value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
											<option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0"
												value="-6">(GMT-06:00) Saskatchewan</option>
											<option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0"
												value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
											<option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1"
												value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
											<option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1"
												value="-5">(GMT-05:00) Indiana (East)</option>
											<option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1"
												value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
											<option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0"
												value="-4">(GMT-04:00) Caracas, La Paz</option>
											<option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0"
												value="-4">(GMT-04:00) Manaus</option>
											<option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1"
												value="-4">(GMT-04:00) Santiago</option>
											<option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1"
												value="-3.5">(GMT-03:30) Newfoundland</option>
											<option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1"
												value="-3">(GMT-03:00) Brasilia</option>
											<option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0"
												value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
											<option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1"
												value="-3">(GMT-03:00) Greenland</option>
											<option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1"
												value="-3">(GMT-03:00) Montevideo</option>
											<option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1"
												value="-2">(GMT-02:00) Mid-Atlantic</option>
											<option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0"
												value="-1">(GMT-01:00) Cape Verde Is.</option>
											<option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1"
												value="-1">(GMT-01:00) Azores</option>
											<option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0"
												value="0">
												(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
											<option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1"
												value="0">
												(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London
											</option>
											<option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1"
												value="1">
												(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
											<option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1"
												value="1">
												(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
											<option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1"
												value="1">
												(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
											<option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1"
												value="1">
												(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
											<option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1"
												value="1">
												(GMT+01:00) West Central Africa</option>
											<option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Amman</option>
											<option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Athens, Bucharest, Istanbul</option>
											<option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Beirut</option>
											<option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Cairo</option>
											<option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0"
												value="2">
												(GMT+02:00) Harare, Pretoria</option>
											<option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
											<option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Jerusalem</option>
											<option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Minsk</option>
											<option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1"
												value="2">
												(GMT+02:00) Windhoek</option>
											<option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0"
												value="3">
												(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
											<option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1"
												value="3">
												(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
											<option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0"
												value="3">
												(GMT+03:00) Nairobi</option>
											<option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0"
												value="3">
												(GMT+03:00) Tbilisi</option>
											<option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1"
												value="3.5">(GMT+03:30) Tehran</option>
											<option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0"
												value="4">
												(GMT+04:00) Abu Dhabi, Muscat</option>
											<option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1"
												value="4">
												(GMT+04:00) Baku</option>
											<option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1"
												value="4">
												(GMT+04:00) Yerevan</option>
											<option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0"
												value="4.5">(GMT+04:30) Kabul</option>
											<option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1"
												value="5">
												(GMT+05:00) Yekaterinburg</option>
											<option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0"
												value="5">
												(GMT+05:00) Islamabad, Karachi, Tashkent</option>
											<option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0"
												value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
											<option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0"
												value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
											<option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0"
												value="5.75">(GMT+05:45) Kathmandu</option>
											<option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1"
												value="6">
												(GMT+06:00) Almaty, Novosibirsk</option>
											<option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0"
												value="6">
												(GMT+06:00) Astana, Dhaka</option>
											<option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0"
												value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
											<option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0"
												value="7">
												(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
											<option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1"
												value="7">
												(GMT+07:00) Krasnoyarsk</option>
											<option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0"
												value="8">
												(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
											<option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0"
												value="8">
												(GMT+08:00) Kuala Lumpur, Singapore</option>
											<option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0"
												value="8">
												(GMT+08:00) Irkutsk, Ulaan Bataar</option>
											<option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0"
												value="8">
												(GMT+08:00) Perth</option>
											<option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0"
												value="8">
												(GMT+08:00) Taipei</option>
											<option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0"
												value="9">
												(GMT+09:00) Osaka, Sapporo, Tokyo</option>
											<option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0"
												value="9">
												(GMT+09:00) Seoul</option>
											<option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1"
												value="9">
												(GMT+09:00) Yakutsk</option>
											<option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0"
												value="9.5">(GMT+09:30) Adelaide</option>
											<option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0"
												value="9.5">(GMT+09:30) Darwin</option>
											<option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0"
												value="10">(GMT+10:00) Brisbane</option>
											<option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1"
												value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
											<option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1"
												value="10">(GMT+10:00) Hobart</option>
											<option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0"
												value="10">(GMT+10:00) Guam, Port Moresby</option>
											<option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1"
												value="10">(GMT+10:00) Vladivostok</option>
											<option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1"
												value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
											<option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1"
												value="12">(GMT+12:00) Auckland, Wellington</option>
											<option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0"
												value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
											<option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0"
												value="13">(GMT+13:00) Nuku'alofa</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- ------------------------------------------------------------------------ -->
					<?php echo form_close();?>

					<!-- resume -->
					<?php $attributes = array('id' => 'update_user_resume', 'method' => 'post' , 'class' => 'form_horizontal'); ?>


				</div>

			</div>

</section>
<!-- End post Area -->
<script>
	$('#start_date').datepicker({
		format: 'dd-M-yyyy',
		startDate: '+0d'
	});

</script>
<script>
	function countChars(obj) {
		document.getElementById("charNum").innerHTML = obj.value.length + '';
		document.getElementById("charNum").style.color = "red";

	}

</script>
