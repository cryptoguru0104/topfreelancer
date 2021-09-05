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
					<?=trans('jobs_avail')?>
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

					<div class="container">
						<h4 class="clr2 mb-2"><?= trans('search_jobs') ?></h4>
					</div>
					<?php $attributes = array('id' => 'search_jobs', 'method' => 'post');
             		 echo form_open('jobs/search',$attributes);?>
					<div class="row justify-content-center form-wrap no-gutters mt-3">

						<div class="col-lg-2 form-cols">
							<div class="container">
								<label class="text-muted font-weight-bold" for="title"><?= trans('keywords') ?>*</label>
								<input type="search" class="form-control" name="title"
									value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>"
									placeholder="what are you looking for?" required>
							</div>
						</div>


						<div class="col-lg-2 form-cols">
							<div class="container">
								<label class="text-muted font-weight-bold"
									for="language"><?= trans('language') ?></label>
								<select name="language" class="form-control">
									<option value=""><?=trans('select_language');?></option>
									<?php $languages = get_languages_list(); foreach($languages as $language):?>
									<?php if(isset($search_value['language']) == $language['lang_id']): ?>
									<option value="<?= $language['lang_id']; ?>" selected>
										<?= $language['lang_name']; ?> </option>
									<?php else: ?>
									<option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?>
									</option>
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
								<input type="text" class="form-control" name="city"
									value="<?php if(isset($search_value['city'])) echo str_replace('-', ' ', $search_value['city']); ?>"
									placeholder="<?=trans('city')?>">
							</div>
						</div>

						<div class="col-lg-2 form-cols">
							<div class="container">
								<label class="text-muted font-weight-bold"
									for="nationality"><?= trans('nationality') ?></label>
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
									<option value="created_date">Most Recent</option>
									<option value="is_featured">Most Relevant</option>
									<option value="consultant">Consultants</option>
									<option value="trainer">Trainers</option>
								</select>
							</div>
						</div>


						<div class="col-12 d-block mt-1 mb-1">&nbsp;</div>

						<div class="col-lg-2 form-cols">
							<div class="container">
								<input type="submit" name="search" class="btn btn-block btn-primary rounded"
									value="<?=trans('btn_search_text')?>">
							</div>
						</div>

						<div class="col-lg-2 form-cols">
							<div class="container">
								<input type="reset" name="reset" onclick="resetForm(form); return false;"
									class="btn btn-block btn-secondary rounded" value="<?=trans('btn_reset')?>">
							</div>
						</div>

						<div class="col-lg-6 form-cols">
							<div class="container">
								<div class="text-center">
									<p class="lead">For more results keep search broader</p>
								</div>
							</div>
						</div>

						<div class="col-lg-2 form-cols">
							<div class="container">
								<?php if ($this->session->userdata('is_user_login')) : ?>
								<a href="<?= base_url('/myjobs/new-vacancy'); ?>"
									class="btn btn-block btn-primary rounded"><?=trans('post_new_job')?></a>
								<?php endif; ?>
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

			<div class="col-lg-12 order-md-2  post-list">
				<!-- --------------------------------------------------------------- -->

				<?php foreach($jobs as $job):
		$jid = $job['id']; ?>
				<div class="list_banner bg-white border col-lg-12 float-left" style="min-height:200px !important;">

					<div id="block-first" class="mb-3">
						<div class="row">
							<div class="col vac-list border-right mb-3 " style="min-height:350px !important;">
								<h4 class="mb-2 clr2"><?= trans('location'); ?></h4>
								<p><?= $job["city"]; ?><br />
									<?= get_country_name($job["country"]); ?><br />
									<?= trans('emp_type'); ?>:
									<?= get_employment_type($job["employment_type"]); ?><br />
									<?= trans('travel_req'); ?>: <?= $job["travel"]; ?></p>

								<h4 class="mt-3 clr2"><?= trans('post_expires'); ?></h4>
								<?php
							$expDate = $job["expiry_date"];
							$formDate = date("d-M-Y", strtotime($expDate));
						?>
								<p><?= $formDate; ?></p>
								<?php if ($this->session->userdata('is_user_login')) : ?>
								<button type="button" class="btn btn-secondary btn-block rounded contactBiz my-6"
									data-toggle="modal" data-jid="<?= $jid; ?>"
									data-target="#modalApply"><?=trans('apply')?></button>
								<?php  else:
							$last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

							$this->session->set_userdata('last_request_page', $last_request_page); 
						?>
								<a href="<?= base_url(); ?>auth/login?id=<?= $job['id']; ?>" data-jid="<?= $jid; ?>"
									class="btn btn-secondary btn-block rounded preapply"><?=trans('apply')?></a>
								<?php endif; ?>
							</div>

							<div class="col-md-6 vac-list border-right mb-3  " style="min-height:350px !important;overflow:auto">

								<h4 class="mb-2 clr2 "><?= $job["title"]; ?></h4>
								<div class="flinfo fldesc"><?= $job["skills"]; ?></div>
								
								<h4 class="mt-3 clr2"><?= trans('vac_req'); ?></h4>
								<div class="flinfo fldesc" ><?= $job["requirements"]; ?></div>
								
							</div>

							<div class="col-md-2 vac-list border-right" style="min-height:300px !important;">

								<h4 class="mb-2 clr2"><?= trans('candidate'); ?></h4>
								<div class="flinfo"><?= trans('min_experience'); ?>: <?= $job["experience"]; ?>
									<?= trans('years'); ?></div>
								<div class="flinfo"><?= trans('language'); ?>: <?= get_language_name($job["lang1"]); ?>
									& <?= get_language_name($job["lang2"]); ?></div>
								<div class="flinfo"><?= trans('nationality'); ?>:
									<?= get_country_name($job["nationality"]); ?></div>

								<h4 class="mt-2 clr2"><?= trans('payment'); ?></h4>
								<div><?= trans('day_rate'); ?>: <?= $job["min_salary"]; ?> <?= $job["max_salary"]; ?>
								</div>
								<div class="text-capitalize"><?= $job["pay_type"]; ?></div>
								<div><?= trans('flights'); ?>:
									<?php if ($job["flights"] == "1"): echo trans('paid');  else: echo trans('not_paid'); ?>
									<?php endif; ?></div>
								<div><?= trans('hotel'); ?>:
									<?php if ($job["hotel"] == "1"): echo trans('paid');  else: echo trans('not_paid'); ?>
									<?php endif; ?></div>

								<?php if($job["trainer"]) : ?>
								<div class="btn bg-warning text-white float-left w-40 fz-14"><?=trans('trainer')?>
								</div>
								<?php endif; ?>

								<?php if($job["consultant"]) : ?>
								<div class="btn ml-2 bg-info text-white float-left w-40 fz-14"><?=trans('consultant')?>
								</div>
								<?php endif; ?>

							</div>

							<?php
							$start_date = $job["start_date"];
							$startDate = date("d-M-Y", strtotime($start_date));
						?>
							<div class="col-md-2 vac-list" style="min-height:250px !important;">
								<h4 class="mb-2 clr2"><?= trans('time'); ?></h4>
								<div class="flinfo"><?= trans('start_date'); ?>: <?= $startDate; ?></div>
								<div class="flinfo"><?= trans('time_period'); ?>: <?= $job["time_period"]; ?>
									<?= trans('weeks') ?> </div>
								<div class="flinfo"><?= trans('min_availability'); ?>: <?= $job["availability"]; ?>
									<?= trans('daysweek') ?> </div>
								<div ><?= trans('project_phase'); ?>: Proposal Preparation </div>

								<?php if ($this->session->userdata('is_user_login')) : ?>
								<h4 class="mt-2 clr2"><?= trans('contact'); ?></h4>
								<div class="flinfo"><?= $job["name"]; ?> </div>
								<div class="flinfo text-danger"><u><?= $job["email"]; ?></u></div>
								<div class="flinfo"><?= $job["phone"]; ?> </div>
								<?php if(!empty($job["vacancy_info"])):?>
								<div class="flinfo font-weight-bold fz-16"><a
										href="<?= $job["vacancy_info"]; ?>"><?= trans('vac_info_down'); ?> <i
											class="fa fa-arrow-down"></i> </a></div>
								<?php endif; ?>
								<?php endif; ?>

							</div>

						</div>

					</div>
				</div>
				<?php endforeach; ?>

				<!-- --------------------------------------------------------------- -->
				<?php if ($this->session->userdata('is_user_login')) : ?>
				<!-- Message Modal -->
				<div class="modal fade" id="modalApply" tabindex="-1" role="dialog" aria-labelledby="modalApplyTitle"
					aria-hidden="true">
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
										<form id="msg-frm" class="msg-frm form-area contact-form text-right"
											accept-charset="utf-8">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1"><i
															class="fa fa-user"></i></span>
												</div>
												<?php if ($this->session->userdata('is_user_login')) : ?>
												<input type="text" name="name" class="form-control input-acf-name"
													value="<?= get_user_fname($this->session->userdata('is_user_login')); ?> <?= get_user_lname($this->session->userdata('is_user_login')); ?>"
													id="name" disabled>
												<?php endif; ?>
											</div>

											<div class="input-group mb-3">
												<div class="input-group-append">
													<span class="input-group-text" id="basic-addon2"><i
															class="fa fa-envelope"></i></span>
												</div>
												<input type="email" name="email" class="form-control input-acf-email"
													id="email"
													value="<?= get_user_email($this->session->userdata('is_user_login')); ?>"
													disabled>
											</div>

											<div class="input-group mb-3">
												<div class="input-group-append">
													<span class="input-group-text" id="basic-addon2"><i
															class="fa fa-paperclip"></i></span>
												</div>
												<input type="text" name="resume" class="form-control input-acf-resume"
													id="resume"
													value="<?= base_url(get_user_resume($this->session->userdata('is_user_login'))); ?>"
													disabled>
											</div>

											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1"><i
															class="fa fa-edit"></i></span>
												</div>
												<div class="subjectTitle input-acf-subject"></div>
												<input type="text" name="subject" class="form-control input-acf-subject"
													id="subject" value="" disabled>
											</div>

											<div class="input-group mb-3">
												<div class="input-group-append">
													<span class="input-group-text" id="basic-addon4"><i
															class="fa fa-comments"></i></span>
												</div>
												<textarea name="cover_letter" cols="3" rows="5"
													class="form-control input-acf-cover_letter" id="cover_letter"
													placeholder="<?=trans('message')?>" required=""></textarea>
											</div>

											<div class="col-md-6 d-inline-block d-md-block float-left">
												<?php if($this->recaptcha_status): ?>
												<div class="recaptcha-cnt">
													<input type="hidden" class="form-control input-acf-captcha"
														name="captcha" />
													<?php generate_recaptcha(); ?>
												</div>
												<?php endif; ?>
											</div>
											<div class="col-md-6 d-inline-block d-md-block float-right">
												<button type="reset" name="reset_col" class="btn btn-danger"
													style="margin-top: -3px; height: 46px;"><i class="fa fa-undo"></i>
												</button>
												<button type="button" name="submit" class="primary-btn mt-20 text-white"
													id="send-query"><i class="fa fa-paper-plane"></i>
													<?=trans('send_message')?> </button>
												<input type="hidden" name="submit" value="" />
											</div>

										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>

			</div><!-- Post List -->
		</div>

		<div class="pull-right">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
	</div>
</section>

<?php
	if (!empty($event_id)){
?>
<script type="text/javascript">
	var a = < ? = $event_id; ? > ;
	console.log(a);
</script>

<?php
	}
?>
<script type="text/javascript">
	< ? php
	if (!empty($event_id)) {
		?
		>
		$(document).ready(function () {
			$(".contactBiz").trigger("click");
		}); <
		? php
	} ? >
	<
	? php
	if ($this - > session - > userdata('is_user_login')): ? >
		$('.contactBiz').click(function (e) {
				e.preventDefault();
				var
					csrfName =
					'<?php echo $this->security->get_csrf_token_name();?>';
				var
					csrfHash =
					'<?php echo $this->security->get_csrf_hash();?>';
				var
					data = {
						id: $(this).attr('data-jid'),
						uid:
							<
							? = $this - > session - > userdata('user_id'); ? > ,
					};
				data[csrfName] =
					csrfHash;
				$.ajax({
						cache: false,
						url: base_url +
							'job-data',
						dataType: 'json',
						type: 'POST',
						data: data,
						error: function (jqXHR,
							textStatus,
							errorThrown) {
							alert('Something
									is wrong ');
								},
								success:
								function (data) {
									$("#subject").val(data[0].title);
									$('#name').val(data[0].name);
									$('#email').val(data[0].email);
									$(".resume").val(
										"<?= base_url(get_user_resume($this->session->userdata('is_user_login'))); ?>"
										);
									$(".messageTitle").empty().append(
										" <
										? = trans('message'); ? >
										" +
										data[0].name +
										"
										about " +
										data[0].title
									);
									p1
										=
										data[0].business_id;
									p2
										=
										data[0].email;
									jid
										=
										data[0].id;
									uid
										= <
										? = $this - > session - > userdata('user_id'); ? > ;
								}
						});
				}); <
			? php endif; ? >
			$(document).on('click',
				'button#send-query',
				function (event) {
					//event.preventDefault();
					var
						csrfName =
						'<?php echo $this->security->get_csrf_token_name();?>';
					var
						csrfHash =
						'<?php echo $this->security->get_csrf_hash();?>';
					var
						data = {
							bid: p1,
							jid: jid,
							uid: uid,
							emp_email: p2,
							name: $("input[name='name']").val(),
							email: $("input[name='email']").val(),
							resume: $("input[name='resume']").val(),
							subject: $("input[name='subject']").val(),
							cover_letter: $("textarea[name='cover_letter']").val(),
							<
							? php
							if (!empty($this - > session - > userdata('event_id'))) {
								?
								>
								destroyEventID:
									true <
									? php
							} ? >
						};
					data[csrfName] =
						csrfHash;
					$.ajax({
							type: 'POST',
							url: base_url +
								'jobs/apply_job',
							data: data,
							dataType: 'json',
							beforeSend: function () {
								jQuery('button#send-query').button('loading');
							},
							complete: function () {
								jQuery('button#send-query').button('reset');
								jQuery("form#msg-frm").find('textarea,
									input ').each(function
									() {
										jQuery(this).val('');
									});
								setTimeout(function () {
										jQuery('span#success-msg').html('');
									},
									4000);
							},
							success: function (json) {
								jQuery('span#success-msg').html(' <
										div class = "alert alert-success"
										role = "alert" > ' + json['
										success '] + ' < /div>');
										setTimeout(function () {
											jQuery('#modalApply').modal('hide');
										}, 8000);

										//return false;
									},
									error: function (xhr, ajaxOptions, thrownError) {
										console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
											.responseText);
										setTimeout(function () {
											jQuery('#modalApply').modal('hide');
										}, 8000);

										//return false;
									}
							});
					});
</script>
<!-- End post Area -->