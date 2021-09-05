	<!-- start banner Area -->
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						<?=trans('business_details')?>
					</h1>	
				</div>											
			</div>
		</div>
	</section>
	<!-- End banner Area -->	

	<!-- Start post Area -->
	<section class="post-area section-gap">
		<div class="container">
			<div class="row justify-content-center d-flex">

				<div class="col-lg-12 post-list">
					
					<?php if ($this->session->flashdata('file_error')) {
		              echo '<div class="alert alert-danger">' . $this->session->flashdata('file_error') . '</div>';
		            } ?>

					<?php
					if ($this->session->flashdata('update_success')) {
						echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
					}
					if($this->session->flashdata('error_update')){
						echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
					}
					?>
					<?php $attributes = array('id' => 'update_employers_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
					<?php echo form_open_multipart('employers/business',$attributes);?>

					<div class="profile_job_content col-lg-12">
						<div class="headline">
							<h3> <?=trans('business_details')?></h3>
						</div>
						<div class="profile_job_detail">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('business_logo')?> *</h5>
										<?php if(!empty($business_info['business_logo'])): ?>
											<p><img src="<?= base_url().$business_info['business_logo']; ?>" alt="Logo" height="50"></p>
										<?php endif; ?>
										<input type="file" name="userfile" class="form-control" placeholder="Business Name" />
										<input type="hidden" name="old_logo" value="<?= $business_info['business_logo']; ?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('business_name')?> *</h5>
										<input class="form-control" type="text" name="business_name" value="<?= $business_info['business_name']; ?>" placeholder="<?=trans('business_name')?>">
										<!-- Hidden input for business ID-->
										<input class="form-control" type="hidden" name="business_id" value="<?= $business_info['id']; ?>" placeholder="Business Name">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('email')?> *</h5>
										<input type="email" name="email" value="<?= $business_info['email']; ?>"  class="form-control" placeholder="example@example.com">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('phone')?> *</h5>
										<input class="form-control" type="tel" name="phone_no" value="<?= $business_info['phone_no']; ?>" placeholder="123456789">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('website')?>:</h5>
										<input class="form-control" type="text" name="website" value="<?= $business_info['website']; ?>" placeholder="www.example.com" >
									</div>
								</div>

										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('founded_date')?> </h5>
												<input type="date" name="founded_date" value="<?= $business_info['founded_date']; ?>" class="form-control" >
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('organization_type')?> *</h5>
												<select name="org_type"  class="form-control" >
													<option value="Public" <?php if($business_info['org_type'] == 'Public'){ echo "selected";} ?>><?=trans('public')?></option>
													<option value="Private" <?php if($business_info['org_type'] == 'Private'){ echo "selected";} ?>><?=trans('private')?></option>
													<option value="Government" <?php if($business_info['org_type'] == 'Government'){ echo "selected";} ?>><?=trans('government')?></option>
													<option value="NGO" <?php if($business_info['org_type'] == 'NGO'){ echo "selected";} ?>><?=trans('ngo')?></option>
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('num_employees')?> *</h5>
												<select name="no_of_employers" class="form-control">
													<option value="1-10" <?php if($business_info['no_of_employers'] == '1-10'){ echo "selected";} ?>>1-10</option>
													<option value="10-20" <?php if($business_info['no_of_employers'] == '10-20'){ echo "selected";} ?>>10-20</option>
													<option value="20-30" <?php if($business_info['no_of_employers'] == '20-30'){ echo "selected";} ?>>20-30</option>
													<option value="30-50" <?php if($business_info['no_of_employers'] == '30-50'){ echo "selected";} ?>>30-50</option>
													<option value="50-100" <?php if($business_info['no_of_employers'] == '50-100'){ echo "selected";} ?>>50-100</option>
													<option value="100+" <?php if($business_info['no_of_employers'] == '100+'){ echo "selected";} ?>>100+</option>
												</select>
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('business_description')?> *</h5>
												<textarea name="description" class="form-control" id="" rows="5" placeholder="Nulla bibendum commodo rhoncus. Sed mattis magna nunc, ac varius quam pharetra vitae."><?= $business_info['description']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="profile_job_content col-lg-12 mt-5">
								<div class="headline">
									<h3><?=trans('address_location')?></h3>
								</div>
								<div class="profile_job_detail">
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('country')?> *</h5>
												<select name="country" class="country form-control">
							                        <option><?=trans('select_country')?></option>
							                         <?php foreach($countries as $country):?>
							                            <?php if($business_info['country'] == $country['id']): ?>
							                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
							                            <?php else: ?>
							                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
							                          <?php endif; endforeach; ?>
							                    </select>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('state')?> *</h5>
												<?php 
							                        $states = get_country_cities($business_info['country']);
							                        $options = array('' => 'Select State')+array_column($states, 'name','id');
							                        echo form_dropdown('state',$options,$business_info['state'],'class="form-control state" required');
							                      ?>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('city')?> *</h5>
												<?php 
						                        $cities = get_country_cities($business_info['state']);
						                        $options = array('' => 'Select City')+array_column($cities, 'name','id');
						                        echo form_dropdown('city',$options,$business_info['city'],'class="form-control city" required');
						                        ?>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('postcode')?> *</h5>
												<input type="text" name="postcode" value="<?= $business_info['postcode']; ?>" class="form-control" placeholder="50700">
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="submit-field">
												<h5><?=trans('full_address')?> *</h5>
												<input type="text" name="address"  value="<?= $business_info['address']; ?>" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>	

							<div class="profile_job_content col-lg-12 mt-5">
								<div class="headline">
									<h3><?=trans('business_social')?></h3>
								</div>
								<div class="profile_job_detail">
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Facebook</h5>
												<input type="text" name="facebook_link" value="<?= $business_info['facebook_link']; ?>"  class="form-control" placeholder="http://www.facebook.com">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Twitter</h5>
												<input type="text" name="twitter_link" value="<?= $business_info['twitter_link']; ?>" class="form-control"  placeholder="http://www.twitter.com">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Google Plus</h5>
												<input type="text" name="google_link" value="<?= $business_info['google_link']; ?>" class="form-control" placeholder="http://www.google-plus.com">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Youtube</h5>
												<input type="text" name="youtube_link" value="<?= $business_info['youtube_link']; ?>" class="form-control"  placeholder="http://www.youtube.com">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Vimeo</h5>
												<input type="text" name="vimeo_link" value="<?= $business_info['vimeo_link']; ?>" class="form-control"  placeholder="http://www.vimeo.com">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Linkedin</h5>
												<input type="text" name="linkedin_link" value="<?= $business_info['linkedin_link']; ?>" class="form-control" placeholder="http://www.linkedin.com">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="add_job_btn col-lg-12 mt-5">
								<div class="submit-field">
									<input type="submit" name="update" value="<?=trans('update')?>" class="job_detail_btn">
								</div>
							</div>	
							<?php echo form_close(); ?>														
						</div>
					</div>
				</div>	
			</section>
<!-- End post Area -->
