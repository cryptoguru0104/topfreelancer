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

<!-- start banner Area -->
<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?php if(isset($search_value)) :  ?>
					<?=trans('search_results')?>
					<?php else : ?>
					<?=trans('top_freelancers')?>
					<?php endif; ?>
				</h1>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area mt-5 mb-5">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<?php if($this->session->flashdata('success')): ?>
			<div class="col-lg-8 col-12">
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<?=$this->session->flashdata('success')?>
				</div>
			</div>
			<?php  endif; ?>

			<div class="col-lg-12">
				<div class="row search-bar">

				<div class="container"><h4 class="clr2 mb-2"><?= trans('search_freelancers') ?></h4></div>
					<?php $attributes = array('id' => 'search_freelancer', 'method' => 'post');
             		 echo form_open('freelancer/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters mt-3">

	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
					 	 <label class="text-muted font-weight-bold" for="kws"><?= trans('keywords') ?></label>
	            	 	 <input type="search" class="form-control" name="kws" value="<?php if(isset($search_value['kws'])) echo str_replace('-', ' ', $search_value['kws']); ?>" placeholder="<?=trans('what_looking')?>">
						</div>
	                  </div>


	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
					  	  <label class="text-muted font-weight-bold" for="language"><?= trans('language') ?></label>
	                      <select name="language" class="form-control">
	                        <option value=""><?=trans('select_language');?></option>
	                        <?php $languages = get_languages_list(); foreach($languages as $language):?>
	                          <?php if(isset($search_value['language']) == $language['lang_id']): ?>
	                            <option value="<?= $language['lang_id']; ?>" selected> <?= $language['lang_name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
						</div>
	                  </div>

	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
					  	  <label class="text-muted font-weight-bold" for="country"><?= trans('country') ?></label>
	                      <select name="country" class="form-control">
	                        <option value=""><?=trans('select_country');?></option>
	                        <?php foreach($countries as $country):?>
	                          <?php if(isset($search_value['country']) == $country['id']): ?>
	                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
						  </div>
	                  </div>

	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
						  <label class="text-muted font-weight-bold" for="city"><?= trans('city') ?></label>
	                      <input type="text" class="form-control" name="city" value="<?php if(isset($search_value['city'])) echo str_replace('-', ' ', $search_value['city']); ?>" placeholder="<?=trans('city')?>">
						</div>
	                  </div>

	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
					  	  <label class="text-muted font-weight-bold" for="nationality"><?= trans('nationality') ?></label>
	                      <select name="nationality" class="form-control">
	                        <option value=""><?=trans('select_nationality');?></option>
	                        <?php foreach($countries as $country):?>
	                          <?php if(isset($search_value['nationality']) == $country['id']): ?>
	                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
						  </div>
	                  </div>

	                  <div class="col-lg-2 form-cols">
					  	<div class="container">
					  	  <label class="text-muted font-weight-bold" for="sortby"><?= trans('sortby') ?></label>
	                      <select name="sortby" class="form-control">
						 	<option value="experience">Years of Experience</option>
						  	<option value="day_rate">Day Rate</option>
	                        <option value="availability"><?=trans('availability');?></option>
	                        <option value="residency"><?=trans('residency');?> Visa</option>
							<option value="econsultant">eConsultant</option>
							<option value="consultant">Consultant</option>
							<option value="trainers">Trainers</option>
	                      </select>
						  </div>
	                  </div>


					  <div class="col-12 d-block mt-1 mb-1">&nbsp;</div>

	                  <div class="col-lg-2 form-cols">
					    <div class="container">
	                      <input type="submit" name="search" class="btn btn-block btn-primary" value="<?=trans('btn_search_text')?>">
						</div>
	                  </div> 

	                  <div class="col-lg-2 form-cols">
					    <div class="container">
	                      <input type="reset" name="reset" onclick="resetForm(form); return false;"  class="btn btn-block btn-secondary" value="<?=trans('btn_reset')?>">
						</div>						  
	                  </div>

	                  <div class="col-lg-8 form-cols">
					    <div class="container">
	                      <div class="text-center">For more results keep search broader</div>
						</div>
	                  </div>

	                </div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>

			<?php if(isset($search_value)) {  ?>
			<div class="w-100 mb-4 fz-18 bg-gray p-4 text-center">
				Total Founded Results: <?php echo $count; ?>
			</div>
			<?php } ?>

			<?php foreach($freelancers as $freelancer): ?>
			<div class="list_banner bg-white border col-lg-12">
				<div id="block-header">
					<div class="container">
						<div class="row">

							<div class="col-lg-2 col-md-12 col-sm-12 col-12">
								<a href="" title="<?= $freelancer["firstname"]; ?> <?= $freelancer["lastname"]; ?>">
									<h3 class="text-center pt-2 clr2"><?= $freelancer["firstname"] ?>
										<?= $freelancer["lastname"]; ?></h3>
								</a>
							</div>

							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<h5 class="pt-3"><?= $freelancer["profile_header"]; ?></h5>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-12 col-12 pb-2">
								<div class="container">

									<?php if($freelancer["page_link"]):  ?>

									<a class="float-right" href="<?= $freelancer["page_link"]; ?>"
										title="<?= $freelancer["firstname"]; ?> <?= $freelancer["lastname"]; ?> <?= trans('page_link'); ?>">
										<img src="<?= base_url('assets/img/linkedin.png'); ?>" class="img-fluid icon-web" alt="" />
									</a>

									<?php endif; ?>

									<?php if($freelancer["page_link"]):  ?>

									<a class="float-right mx-2" href="<?= $freelancer["page_link"]; ?>"
										title="<?= $freelancer["firstname"]; ?> <?= $freelancer["lastname"]; ?> <?= trans('page_link'); ?>">
										<img src="<?= base_url('assets/img/www.png'); ?>" class="img-fluid icon-web"
											alt="" />
									</a>

									<?php endif; ?>

									<?php 
										$fid = $freelancer["id"];
										$uid = $this->session->userdata('user_id');

										$data = array(
											'freelancer_id' 	=> $fid,
											'user_id' 			=> $uid,
										);

										$saved = $this->freelancer_model->is_already_saved($data);
										if(!($fid == $uid)): 
											if($saved):														
									?>
										<a id="favoriteFreelancer<?= $freelancer['id']; ?>" class="float-right favorite_freelancer" data-freelancer_id="<?= $freelancer['id']; ?>" title="<?= $freelancer["firstname"]; ?> <?= $freelancer["lastname"]; ?>">
											<img src="<?= base_url('assets/icons/star-filled.png'); ?>" class="img-fluid icon-web" alt="" />
										</a>
											<?php else: ?>
										<a id="favoriteFreelancer<?= $freelancer['id']; ?>" class="float-right favorite_freelancer" data-freelancer_id="<?= $freelancer['id']; ?>" title="<?= $freelancer["firstname"]; ?> <?= $freelancer["lastname"]; ?>">
										<img src="<?= base_url('assets/icons/star-icon.png'); ?>" class="img-fluid icon-web" alt="" />
										</a>
											<?php endif; ?>
									<?php endif; ?>

								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-6 col-12 pb-2">
								<div class="container">
									<button type="button" class="btn btn-primary btn-block rounded theresume"
										data-toggle="modal" data-fid="<?= $freelancer["id"]; ?>"
										data-target="#resumeView"><?=trans('resume')?></button>
								</div>
							</div>

							<div class="col-lg-2 col-md-3 col-sm-6 col-12 pb-2">
								<div class="container">
									<button type="button" class="btn btn-secondary btn-block rounded"
										data-toggle="modal" data-fid="<?= $freelancer["id"]; ?>"
										data-email="<?= $freelancer["email"]; ?>"
										data-target="#emailFreelancer"><?=trans('message')?></button>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div id="block-body">
					<div class="container">
						<div class="row">
							<div class="col-lg-2 col-md-12">
								<div class="flog pt-4"><img src="<?= base_url($freelancer["profile_picture"]);  ?>"
										alt="" class="freelancerimg rounded-circle img-fluid" /></div>
								<div class="mt-3 text-center lh-2">
									<div class="mt-2 emp_city fz-16"><?= $freelancer["city"]; ?></div>
									<div class="emp_country fz-16"><?= get_country_name($freelancer["country"]);?>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="fldesc desc-height"><?= $freelancer["description"];  ?></div>
								<div class="bg-normal pb-2 pt-2 overflow-auto"><span
										class="font-weight-bold"><?= trans('skills'); ?>:</span>
									<?= $freelancer["skills"]; ?></div>


								<div class="float-right">
									
									<div class="btn  bg1 text-white btn-custom-style mt-1">eConsultant </div>

									<?php if($freelancer["consultant"]) : ?>
									<div class="btn  consultant-btn text-black btn-custom-style mt-1">
										<?=trans('consultant')?> </div>
									<?php endif; ?>

									<?php if($freelancer["trainer"]) : ?>
									<div class="btn bg-warning text-black btn-custom-style mt-1"><?=trans('trainer')?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-lg-2 col-12 lh-2">
								<div class=""><strong><?=trans('experience')?>: </strong>
									<?= $freelancer["experience"]; ?> <?=trans('years')?></div>
								<div class=""><strong><?=trans('education')?>: </strong>

									<?php if(isset($freelancer["education_level"])): ?>
									<?=get_education_level($freelancer["education_level"]) ?>
									<?php endif ?>
								</div>
								<div class=""><strong><?=trans('nationality')?>: </strong>
									<?php if(isset($freelancer["nationality"])): ?>
									<?=get_country_name($freelancer["nationality"]) ?>
									<?php endif ?>
								</div>
								<div class=""><strong><?=trans('residency')?>: </strong>
									<?php if(isset($freelancer["residency"])): ?>
									<?= get_country_name($freelancer["residency"]);  ?>
									<?php endif ?>

								</div>
								<div class=""><strong><?=trans('day_rate')?>: </strong> <?= $freelancer["day_rate"]; ?>
								</div>
								<div class=""><strong><?=trans('languages')?>: </strong>
									<?php if(isset($freelancer["lang1"]) || isset($freelancer["lang2"])): ?>
									<?= get_language_name($freelancer["lang1"]); ?>,
									<?= get_language_name($freelancer["lang2"]); ?>
									<?php endif ?>

								</div>
							</div>

							<div class="col-lg-2 col-12 lh-2">
								<div class=""><strong><?=trans('availability')?>: </strong>
									<?= $freelancer["availability"]; ?> <?=trans('daysweek')?></div>
								<div class=""><strong><?=trans('start_date')?>: </strong>
									<?= $freelancer["start_date"]; ?> </div>
								<div class=""><strong><?=trans('emp_type')?>: </strong>
									<?php if(isset($freelancer["employment"])): ?>
									<?= get_employment_type($freelancer["employment"]); ?>
									<?php endif ?>

								</div>
								<div class=""><strong><?=trans('travel_willingness')?>: </strong>
									<?= $freelancer["travel_willingness"];  ?> </div>
								<div data-email="<?= $freelancer["email"]; ?>" class="text-danger underline"
									style="overflow:auto;"><?= $freelancer["email"]; ?></div>
								<?php if($freelancer["ok_publish"] == '1'): ?> <div class="">
									<?= $freelancer["mobile_no"]; ?></div> <?php endif; ?>
								<?php if($freelancer["consultant"]) : ?>

								<div class="">
									<div class="mt-5">
									<button type="button" class="btn btn-primary btn-block rounded bg1 fz-18 text-white"
										data-toggle="modal" data-target=".bd-example-modal-lg">
										Book eConsultation
									</button>
									</div>
									<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
										aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg bg-gray">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="text-center clr2 mb-2"><?= trans('booking_information') ?></h4>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="container-fluid">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<h5 for="recipient-name"
																		class="col-form-label">Name *</h5>
																	<input type="text" class="form-control"
																		id="recipient-name">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<h5 for="recipient-name"
																		class="col-form-label">Organization</h5>
																	<input type="text" class="form-control"
																		id="recipient-name">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<h5 for="recipient-name"
																		class="col-form-label">Email *</h5>
																	<input type="text" class="form-control"
																		id="recipient-name">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<h5 for="recipient-name"
																		class="col-form-label">Phone *</h5>
																	<input type="text" class="form-control"
																		id="recipient-name">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="submit-field">
																	<h5>Select Preferred Date *</h5>
																	<div class="input-group date">
																		<input id="start_date"
																			class="form-control datepicker"
																			placeholder="DD-MMM-YYYY" type="text"
																			name="preferred_date">
																		<div class="input-group-append">
																			<div class="input-group-text"><span
																					class="fa fa-calendar"></span></div>
																		</div>
																	</div>
																</div>

															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<h5>Planned Duration *</h5>
																	<select name="travel_req" class="form-control mt-2">
																		<option value="" disabled selected>choose option
																		</option>
																		<option value="1 Hour">1 Hour</option>
																		<option value="2 Hour">2 Hour</option>
																		<option value="3 Hour">3 Hour</option>
																		<option value="4 Hour">4 Hour</option>
																		<option value="5 Hour">5 Hour</option>
																		<option value="6 Hour">6 Hour</option>
																		<option value="7 Hour">7 Hour</option>
																		<option value="8 Hour">8 Hour</option>
																		<option value="9 Hour">9 Hour</option>
																		<option value="10 Hours">10 Hours</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<h5>Time Zone *</h5>
																	<select class="form-control mt-3" name="timezone">
																		<option timeZoneId="1" gmtAdjustment="GMT-12:00"
																			useDaylightTime="0" value="-12">(GMT-12:00)
																			International Date Line West</option>
																		<option timeZoneId="2" gmtAdjustment="GMT-11:00"
																			useDaylightTime="0" value="-11">(GMT-11:00)
																			Midway Island, Samoa</option>
																		<option timeZoneId="3" gmtAdjustment="GMT-10:00"
																			useDaylightTime="0" value="-10">(GMT-10:00)
																			Hawaii</option>
																		<option timeZoneId="4" gmtAdjustment="GMT-09:00"
																			useDaylightTime="1" value="-9">
																			(GMT-09:00) Alaska</option>
																		<option timeZoneId="5" gmtAdjustment="GMT-08:00"
																			useDaylightTime="1" value="-8">
																			(GMT-08:00) Pacific Time (US & Canada)
																		</option>
																		<option timeZoneId="6" gmtAdjustment="GMT-08:00"
																			useDaylightTime="1" value="-8">
																			(GMT-08:00) Tijuana, Baja California
																		</option>
																		<option timeZoneId="7" gmtAdjustment="GMT-07:00"
																			useDaylightTime="0" value="-7">
																			(GMT-07:00) Arizona</option>
																		<option timeZoneId="8" gmtAdjustment="GMT-07:00"
																			useDaylightTime="1" value="-7">
																			(GMT-07:00) Chihuahua, La Paz, Mazatlan
																		</option>
																		<option timeZoneId="9" gmtAdjustment="GMT-07:00"
																			useDaylightTime="1" value="-7">
																			(GMT-07:00) Mountain Time (US & Canada)
																		</option>
																		<option timeZoneId="10"
																			gmtAdjustment="GMT-06:00"
																			useDaylightTime="0" value="-6">(GMT-06:00)
																			Central America</option>
																		<option timeZoneId="11"
																			gmtAdjustment="GMT-06:00"
																			useDaylightTime="1" value="-6">(GMT-06:00)
																			Central Time (US & Canada)</option>
																		<option timeZoneId="12"
																			gmtAdjustment="GMT-06:00"
																			useDaylightTime="1" value="-6">(GMT-06:00)
																			Guadalajara, Mexico City, Monterrey</option>
																		<option timeZoneId="13"
																			gmtAdjustment="GMT-06:00"
																			useDaylightTime="0" value="-6">(GMT-06:00)
																			Saskatchewan</option>
																		<option timeZoneId="14"
																			gmtAdjustment="GMT-05:00"
																			useDaylightTime="0" value="-5">(GMT-05:00)
																			Bogota, Lima, Quito, Rio Branco</option>
																		<option timeZoneId="15"
																			gmtAdjustment="GMT-05:00"
																			useDaylightTime="1" value="-5">(GMT-05:00)
																			Eastern Time (US & Canada)</option>
																		<option timeZoneId="16"
																			gmtAdjustment="GMT-05:00"
																			useDaylightTime="1" value="-5">(GMT-05:00)
																			Indiana (East)</option>
																		<option timeZoneId="17"
																			gmtAdjustment="GMT-04:00"
																			useDaylightTime="1" value="-4">(GMT-04:00)
																			Atlantic Time (Canada)</option>
																		<option timeZoneId="18"
																			gmtAdjustment="GMT-04:00"
																			useDaylightTime="0" value="-4">(GMT-04:00)
																			Caracas, La Paz</option>
																		<option timeZoneId="19"
																			gmtAdjustment="GMT-04:00"
																			useDaylightTime="0" value="-4">(GMT-04:00)
																			Manaus</option>
																		<option timeZoneId="20"
																			gmtAdjustment="GMT-04:00"
																			useDaylightTime="1" value="-4">(GMT-04:00)
																			Santiago</option>
																		<option timeZoneId="21"
																			gmtAdjustment="GMT-03:30"
																			useDaylightTime="1" value="-3.5">(GMT-03:30)
																			Newfoundland</option>
																		<option timeZoneId="22"
																			gmtAdjustment="GMT-03:00"
																			useDaylightTime="1" value="-3">(GMT-03:00)
																			Brasilia</option>
																		<option timeZoneId="23"
																			gmtAdjustment="GMT-03:00"
																			useDaylightTime="0" value="-3">(GMT-03:00)
																			Buenos Aires, Georgetown</option>
																		<option timeZoneId="24"
																			gmtAdjustment="GMT-03:00"
																			useDaylightTime="1" value="-3">(GMT-03:00)
																			Greenland</option>
																		<option timeZoneId="25"
																			gmtAdjustment="GMT-03:00"
																			useDaylightTime="1" value="-3">(GMT-03:00)
																			Montevideo</option>
																		<option timeZoneId="26"
																			gmtAdjustment="GMT-02:00"
																			useDaylightTime="1" value="-2">(GMT-02:00)
																			Mid-Atlantic</option>
																		<option timeZoneId="27"
																			gmtAdjustment="GMT-01:00"
																			useDaylightTime="0" value="-1">(GMT-01:00)
																			Cape Verde Is.</option>
																		<option timeZoneId="28"
																			gmtAdjustment="GMT-01:00"
																			useDaylightTime="1" value="-1">(GMT-01:00)
																			Azores</option>
																		<option timeZoneId="29"
																			gmtAdjustment="GMT+00:00"
																			useDaylightTime="0" value="0">
																			(GMT+00:00) Casablanca, Monrovia, Reykjavik
																		</option>
																		<option timeZoneId="30"
																			gmtAdjustment="GMT+00:00"
																			useDaylightTime="1" value="0">
																			(GMT+00:00) Greenwich Mean Time : Dublin,
																			Edinburgh, Lisbon, London
																		</option>
																		<option timeZoneId="31"
																			gmtAdjustment="GMT+01:00"
																			useDaylightTime="1" value="1">
																			(GMT+01:00) Amsterdam, Berlin, Bern, Rome,
																			Stockholm, Vienna</option>
																		<option timeZoneId="32"
																			gmtAdjustment="GMT+01:00"
																			useDaylightTime="1" value="1">
																			(GMT+01:00) Belgrade, Bratislava, Budapest,
																			Ljubljana, Prague</option>
																		<option timeZoneId="33"
																			gmtAdjustment="GMT+01:00"
																			useDaylightTime="1" value="1">
																			(GMT+01:00) Brussels, Copenhagen, Madrid,
																			Paris</option>
																		<option timeZoneId="34"
																			gmtAdjustment="GMT+01:00"
																			useDaylightTime="1" value="1">
																			(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb
																		</option>
																		<option timeZoneId="35"
																			gmtAdjustment="GMT+01:00"
																			useDaylightTime="1" value="1">
																			(GMT+01:00) West Central Africa</option>
																		<option timeZoneId="36"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Amman</option>
																		<option timeZoneId="37"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Athens, Bucharest, Istanbul
																		</option>
																		<option timeZoneId="38"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Beirut</option>
																		<option timeZoneId="39"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Cairo</option>
																		<option timeZoneId="40"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="0" value="2">
																			(GMT+02:00) Harare, Pretoria</option>
																		<option timeZoneId="41"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Helsinki, Kyiv, Riga, Sofia,
																			Tallinn, Vilnius</option>
																		<option timeZoneId="42"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Jerusalem</option>
																		<option timeZoneId="43"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Minsk</option>
																		<option timeZoneId="44"
																			gmtAdjustment="GMT+02:00"
																			useDaylightTime="1" value="2">
																			(GMT+02:00) Windhoek</option>
																		<option timeZoneId="45"
																			gmtAdjustment="GMT+03:00"
																			useDaylightTime="0" value="3">
																			(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
																		<option timeZoneId="46"
																			gmtAdjustment="GMT+03:00"
																			useDaylightTime="1" value="3">
																			(GMT+03:00) Moscow, St. Petersburg,
																			Volgograd</option>
																		<option timeZoneId="47"
																			gmtAdjustment="GMT+03:00"
																			useDaylightTime="0" value="3">
																			(GMT+03:00) Nairobi</option>
																		<option timeZoneId="48"
																			gmtAdjustment="GMT+03:00"
																			useDaylightTime="0" value="3">
																			(GMT+03:00) Tbilisi</option>
																		<option timeZoneId="49"
																			gmtAdjustment="GMT+03:30"
																			useDaylightTime="1" value="3.5">(GMT+03:30)
																			Tehran</option>
																		<option timeZoneId="50"
																			gmtAdjustment="GMT+04:00"
																			useDaylightTime="0" value="4">
																			(GMT+04:00) Abu Dhabi, Muscat</option>
																		<option timeZoneId="51"
																			gmtAdjustment="GMT+04:00"
																			useDaylightTime="1" value="4">
																			(GMT+04:00) Baku</option>
																		<option timeZoneId="52"
																			gmtAdjustment="GMT+04:00"
																			useDaylightTime="1" value="4">
																			(GMT+04:00) Yerevan</option>
																		<option timeZoneId="53"
																			gmtAdjustment="GMT+04:30"
																			useDaylightTime="0" value="4.5">(GMT+04:30)
																			Kabul</option>
																		<option timeZoneId="54"
																			gmtAdjustment="GMT+05:00"
																			useDaylightTime="1" value="5">
																			(GMT+05:00) Yekaterinburg</option>
																		<option timeZoneId="55"
																			gmtAdjustment="GMT+05:00"
																			useDaylightTime="0" value="5">
																			(GMT+05:00) Islamabad, Karachi, Tashkent
																		</option>
																		<option timeZoneId="56"
																			gmtAdjustment="GMT+05:30"
																			useDaylightTime="0" value="5.5">(GMT+05:30)
																			Sri Jayawardenapura</option>
																		<option timeZoneId="57"
																			gmtAdjustment="GMT+05:30"
																			useDaylightTime="0" value="5.5">(GMT+05:30)
																			Chennai, Kolkata, Mumbai, New Delhi</option>
																		<option timeZoneId="58"
																			gmtAdjustment="GMT+05:45"
																			useDaylightTime="0" value="5.75">(GMT+05:45)
																			Kathmandu</option>
																		<option timeZoneId="59"
																			gmtAdjustment="GMT+06:00"
																			useDaylightTime="1" value="6">
																			(GMT+06:00) Almaty, Novosibirsk</option>
																		<option timeZoneId="60"
																			gmtAdjustment="GMT+06:00"
																			useDaylightTime="0" value="6">
																			(GMT+06:00) Astana, Dhaka</option>
																		<option timeZoneId="61"
																			gmtAdjustment="GMT+06:30"
																			useDaylightTime="0" value="6.5">(GMT+06:30)
																			Yangon (Rangoon)</option>
																		<option timeZoneId="62"
																			gmtAdjustment="GMT+07:00"
																			useDaylightTime="0" value="7">
																			(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
																		<option timeZoneId="63"
																			gmtAdjustment="GMT+07:00"
																			useDaylightTime="1" value="7">
																			(GMT+07:00) Krasnoyarsk</option>
																		<option timeZoneId="64"
																			gmtAdjustment="GMT+08:00"
																			useDaylightTime="0" value="8">
																			(GMT+08:00) Beijing, Chongqing, Hong Kong,
																			Urumqi</option>
																		<option timeZoneId="65"
																			gmtAdjustment="GMT+08:00"
																			useDaylightTime="0" value="8">
																			(GMT+08:00) Kuala Lumpur, Singapore</option>
																		<option timeZoneId="66"
																			gmtAdjustment="GMT+08:00"
																			useDaylightTime="0" value="8">
																			(GMT+08:00) Irkutsk, Ulaan Bataar</option>
																		<option timeZoneId="67"
																			gmtAdjustment="GMT+08:00"
																			useDaylightTime="0" value="8">
																			(GMT+08:00) Perth</option>
																		<option timeZoneId="68"
																			gmtAdjustment="GMT+08:00"
																			useDaylightTime="0" value="8">
																			(GMT+08:00) Taipei</option>
																		<option timeZoneId="69"
																			gmtAdjustment="GMT+09:00"
																			useDaylightTime="0" value="9">
																			(GMT+09:00) Osaka, Sapporo, Tokyo</option>
																		<option timeZoneId="70"
																			gmtAdjustment="GMT+09:00"
																			useDaylightTime="0" value="9">
																			(GMT+09:00) Seoul</option>
																		<option timeZoneId="71"
																			gmtAdjustment="GMT+09:00"
																			useDaylightTime="1" value="9">
																			(GMT+09:00) Yakutsk</option>
																		<option timeZoneId="72"
																			gmtAdjustment="GMT+09:30"
																			useDaylightTime="0" value="9.5">(GMT+09:30)
																			Adelaide</option>
																		<option timeZoneId="73"
																			gmtAdjustment="GMT+09:30"
																			useDaylightTime="0" value="9.5">(GMT+09:30)
																			Darwin</option>
																		<option timeZoneId="74"
																			gmtAdjustment="GMT+10:00"
																			useDaylightTime="0" value="10">(GMT+10:00)
																			Brisbane</option>
																		<option timeZoneId="75"
																			gmtAdjustment="GMT+10:00"
																			useDaylightTime="1" value="10">(GMT+10:00)
																			Canberra, Melbourne, Sydney</option>
																		<option timeZoneId="76"
																			gmtAdjustment="GMT+10:00"
																			useDaylightTime="1" value="10">(GMT+10:00)
																			Hobart</option>
																		<option timeZoneId="77"
																			gmtAdjustment="GMT+10:00"
																			useDaylightTime="0" value="10">(GMT+10:00)
																			Guam, Port Moresby</option>
																		<option timeZoneId="78"
																			gmtAdjustment="GMT+10:00"
																			useDaylightTime="1" value="10">(GMT+10:00)
																			Vladivostok</option>
																		<option timeZoneId="79"
																			gmtAdjustment="GMT+11:00"
																			useDaylightTime="1" value="11">(GMT+11:00)
																			Magadan, Solomon Is., New Caledonia</option>
																		<option timeZoneId="80"
																			gmtAdjustment="GMT+12:00"
																			useDaylightTime="1" value="12">(GMT+12:00)
																			Auckland, Wellington</option>
																		<option timeZoneId="81"
																			gmtAdjustment="GMT+12:00"
																			useDaylightTime="0" value="12">(GMT+12:00)
																			Fiji, Kamchatka, Marshall Is.</option>
																		<option timeZoneId="82"
																			gmtAdjustment="GMT+13:00"
																			useDaylightTime="0" value="13">(GMT+13:00)
																			Nuku'alofa</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<h5>Hourly Rate(In US $)</h5>

																	<input type="text" class="form-control  mt-3"
																		id="recipient-name">
																</div>
															</div>

															<div class="col-md-12">

																<div class="submit-field">
																	<h5><?=trans('vacancy_requirements')?> *</h5>
																	<textarea
																		onKeyPress="return ( this.value.length < 500 );"
																		name="requirements"
																		value="<?= old('requirements');?>"
																		class="textarea form-control" maxlength="500"
																		id="vacancy_requirements" rows="3"
																		required></textarea>
																	<div class="float-right p-1 mt-1 fz-12 lh-1">
																		<small>500 Max Characters </small>
																	</div>
																</div>
															</div>
															<div class="col-md-12">
															<p class="font-weight-bold text-secondary">Notice: - This is a paid eConsultation due to be paid after
																 completion (based on actual hours) <br>
																- Total charges will be billed by and paid directly to the eConsultant as per preferred channel. <br>
																- Selected preferred date and time are subject to eConsultant availability.</p>
																
															</div>

															<div class="col-md-8">

																<div class="form-check form-check-inline">
																	<input class="form-check-input checkbox_size" type="checkbox"
																		name="" id="" value="">
																	<label class="form-check-label booking-text"
																		for="">I accept and confirm the above information</label>
																</div>
															</div>

															<div class="col-md-4">

															<?php if($this->recaptcha_status): ?>
																<div class="recaptcha-cnt">
																	<input type="hidden" class="form-control input-acf-captcha"
																		name="captcha" />
																	<?php generate_recaptcha(); ?>
																</div>
															<?php endif; ?>
															</div>
															<div class="col-md-12 mt-3">
															<button type="button" class="btn btn-primary btn-block rounded bg1 fz-18 text-white"
										data-toggle="modal" data-target=".bd-example-modal-lg">
										Book eConsultation
									</button>
														</div>

														</div>

													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary">Send
															message</button>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>


								<?php endif; ?>
							</div>

						</div><!-- Row -->
					</div><!-- Container -->
				</div>

				<div id="block-footer">
					<div class="container">
						<div class="row">

							<div class="col-lg-4 col-md-4 col-sm-4 col-4">

							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-12"></div>

							<!-- <?php if($freelancer["trainer"]) : ?>
				<div class="col-lg-2 col-md-4 col-sm-6 px-4 py-2">
					<div class="btn w-190 btn-sm bg-warning text-white" ><?=trans('trainer')?> </div></div>
			<?php endif; ?> -->
							<!-- base_url('econsultant-booking'); -->


						</div><!-- Row -->
					</div><!-- Container -->
				</div>

			</div><!-- End Block -->

			<?php endforeach; ?>


			<!-- Resume Modal -->
			<div class="modal fade" id="resumeView" tabindex="-1" role="dialog" aria-labelledby="resumeViewTitle"
				aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title resumeViewTitle"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div id="resumeFile" class="modal-body resumeFile"></div>
					</div>
				</div>
			</div>

			<!-- Message Modal -->
			<div class="modal fade" id="emailFreelancer" tabindex="-1" role="dialog"
				aria-labelledby="emailFreelancerTitle" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title messageTitle"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12"><span id="success-msg"></span></div>
							</div>
							<div class="row">
								<div class="col-lg-12 form-group">
									<form id="ajax-contact-frm"
										class="ajax-contact-frm form-area contact-form text-right"
										accept-charset="utf-8">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i
														class="fa fa-user"></i></span>
											</div>
											<input type="text" name="name" class="form-control input-acf-name" id="name"
												placeholder="<?=trans('enter_your_name')?>" required>
										</div>

										<div class="input-group mb-3">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i
														class="fa fa-envelope"></i></span>
											</div>
											<input type="email" name="email" class="form-control input-acf-email"
												id="email" placeholder="<?=trans('enter_email')?>" required>
										</div>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i
														class="fa fa-edit"></i></span>
											</div>
											<input type="text" name="subject" class="form-control input-acf-subject"
												id="subject" placeholder="<?=trans('enter_your_subject')?>">
										</div>

										<div class="input-group mb-3">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon4"><i
														class="fa fa-comments"></i></span>
											</div>
											<textarea name="message" cols="3" rows="5"
												class="form-control input-acf-message" id="message"
												placeholder="<?=trans('message')?>" required=""></textarea>
										</div>

										<div class="col-md-6 float-left">
											<?php if($this->recaptcha_status): ?>
											<div class="recaptcha-cnt">
												<input type="hidden" class="form-control input-acf-captcha"
													name="captcha" />
												<?php generate_recaptcha(); ?>
											</div>
											<?php endif; ?>
										</div>
										<div class="col-md-6 float-right">
												<button type="reset" name="reset_col" class="primary-btn" style="color:#fff !important;background-image:none !important; background:#d93025"><i class="fa fa-undo"></i></button>
												<button type="button" name="submit" class="primary-btn mt-20 text-white" id="send-query"><i class="fa fa-paper-plane"></i>
													<?=trans('send_message')?> </button>
										</div>

									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="pull-right">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		//------------------------------------------------------------
		// Saved Job as Favorite
		$(document).on('click', '.favorite_freelancer', function(){
		
			var data = {
				freelancer_id : $(this).data('freelancer_id'),
			}
			data[csfr_token_name] = csfr_token_value;

			$.ajax({
				type: 'POST',
				url: base_url + 'freelancer/save_freelancer',
				data: data,
				success: function (response) {
					console.log(response);
					if($.trim(response) == "not_login"){
						$.notify("Alert! Please login first", "danger");
					}
					if($.trim(response) == "already_saved"){
						$.notify("Alert! Freelancer is already favorited.", "danger");
					}
					if($.trim(response) == "saved"){
						$.notify("Freelancer has been favorite successfully", "success");
						$("#favoriteFreelancer<?= $freelancer['id']; ?> img").attr("src", "<?= base_url('assets/icons/star-filled.png') ?>");

					}
				}

			});

		}); // end save job

		$('.theresume').click(function (e) {

			var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
			var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

			var data = {
				id: $(this).attr('data-fid'),
			};
			data[csrfName] = csrfHash;

			$.ajax({
				cache: false,
				url: base_url + 'freelancer-data',
				dataType: 'json',
				type: 'POST',
				data: data,
				error: function (jqXHR, textStatus, errorThrown) {
					//console.log(JSON.stringify(jqXHR));
					//console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
					alert('Something is wrong');
				},
				success: function (data) {
					$(".resumeViewTitle").empty().append(data[0].firstname + " " + data[0].lastname +
						" <?= trans('resume'); ?>");
					$(".messageTitle").empty().append(" <?= trans('message'); ?> " + data[0].firstname +
						" " + data[0].lastname);
					$(".resumeFile").empty().append("<object data=" + base_url + data[0].resume +
						" width='100%' height='500px' type='application/pdf'> PDF Plugin Not Available </object>"
						);
					p1 = data[0].id;
					p2 = data[0].email;
				}
			});

		});

		$(document).on('click', 'button#send-query', function (event) {

			var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
			var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

			var data = {
				id: p1,
				fe: p2,
				name: $("input[name='name']").val(),
				email: $("input[name='email']").val(),
				subject: $("input[name='subject']").val(),
				message: $("textarea[name='message']").val(),
			};
			data[csrfName] = csrfHash;

			$.ajax({
				type: 'POST',
				url: base_url + 'freelancer/contactFreelancer',
				data: data,
				dataType: 'json',
				beforeSend: function () {
					jQuery('button#send-query').button('loading');
				},
				complete: function () {
					jQuery('button#send-query').button('reset');
					jQuery("form#ajax-contact-frm").find('textarea, input').each(function () {
						jQuery(this).val('');
					});
					setTimeout(function () {
						jQuery('span#success-msg').html('');
					}, 4000);
				},
				success: function (json) {
					$('.text-danger').remove();
					if (json['error']) {
						for (i in json['error']) {
							var element = $('.input-acf-' + i.replace('_', '-'));
							if ($(element).parent().hasClass('input-group')) {
								$(element).parent().after('<small class="text-danger">' + json['error'][
									i] + '</small>');
							} else {
								$(element).after('<small class="text-danger">' + json['error'][i] +
									'</small>');
							}
						}
					} else {
						$('span#success-msg').html('<div class="alert alert-success" role="alert">' +
							json['success'] + '</div>');
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});

	</script>

	<script>
		$('#start_date').datepicker({
			format: 'dd-M-yyyy',
			startDate: '+0d'
		});

	</script>
</section>
