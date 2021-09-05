<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit User</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Users List</a>
          <a href="<?= base_url('admin/users/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New User</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
					
          <?php if(isset($msg) || validation_errors() !== ''): ?>
             <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?= validation_errors();?>
                <?= isset($msg)? $msg: ''; ?>
            </div>
          <?php endif; ?>
           
            <?php echo form_open(base_url('admin/users/edit/'.$user['id']), 'class="form-horizontal"' )?> 
        
									<div class="col-xl-2 col-md-4 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('first_name')?> *</h5>
                      <input class="form-control" type="text" name="firstname" value="<?= $user['firstname']  ?>" placeholder="John">
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-4 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('last_name')?> *</h5>
                      <input class="form-control" type="text" name="lastname" value="<?= $user['lastname']  ?>" placeholder="Wick">
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-4 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('email')?> *</h5>
                      <input class="form-control" type="email" name="email" value="<?= $user['email']  ?>" placeholder="example@example.com">
                      <?php if($user["is_verify"] == 1) : ?>
                        <div class="bg-gray float-right p-1 mt-1 fz-12"><?=trans('email_confirmed')?></div>
                      <?php else: ?>
                        <div class="bg-gray float-right p-1 fz-12"><?=trans('email_not_confirmed')?></div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-4 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('phone')?></h5>
                      <input class="form-control" type="tel" name="mobile_no" value="<?= $user['mobile_no']  ?>" placeholder="1 5555 66666" >
                      <div class="float-right p-1 mt-1 fz-12 lh-1">
                        <label for="ok_publish"> <?=trans('ok_publish')?></label>
                        <input type="checkbox" id="ok_publish" name="ok_publish" value="1" <?php if($user['ok_publish'] == '1'): ?> checked <?php endif; ?>>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-4 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('country')?> *</h5>
                      <select name="country" class="country form-control" >
                        <option><?=trans('select_country')?></option>
                         <?php foreach($countries as $country):?>
                            <?php if($user['country'] == $country['id']): ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                            <?php else: ?>
                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                          <?php endif; endforeach; ?>
                    </select>
                    </div>
                  </div>

								<div class="col-xl-2 col-md-4 col-sm-12">
                  <div class="submit-field">
                    <h5><?=trans('city')?> *</h5>
										<input class="form-control" type="text" name="city" value="<?= $user['city']  ?>" >
                  </div>
                </div>
              
                <div class="col-lg-2 col-md-3 col-sm-4 col-12  mt-2">
                    <div class="submit-field">
                      <h5><?=trans('profile_picture')?> *</h5>
											<?php if ( $user['profile_picture'] ) : ?>
											 <img style="max-width:100%;height:auto;" src="<?= base_url($user['profile_picture']);  ?>" id="profilepic" class="img-fluid" alt="" title="<?= $user['firstname']  ?> <?= $user['lastname']  ?>" />
											<?php endif; ?>
                      <input type="file" id="profilepicupload" name="profile_picture" class="form-control" >
											<input type="hidden" name="profile_picture" value="<?= $user['profile_picture'];  ?>">
                      <input type="hidden" name="old_profile_picture" value="<?= $user['profile_picture'];  ?>">
                    </div>
                </div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="submit-field">
                      <h5><?=trans('profile_summary')?> *</h5>
											<textarea name="description" class="form-control" cols="6" rows="15"><?= $user['description']  ?></textarea>
                      <div class="float-right p-1 mt-1 fz-12 lh-1">800 Max Characters </div>
                    </div>
                </div>


								<div class="col-md-6 col-sm-12 mt-2">

									<div class="col-md-12">
										<div class="submit-field">
											<h5><?=trans('profile_header')?> *</h5>
											<input class="form-control" type="text" name="profile_header" value="<?= $user['profile_header']  ?>" placeholder="Profile Header">
                       <div class="float-right p-1 mt-1 mr-4 fz-12 lh-1"><small>100 Max Characters</small></div>
										</div>
									</div>

										<div class="col-md-12">
											<div class="submit-field">
												<h5><?=trans('linkedin_link')?></h5>
												<input class="form-control" type="text" name="linkedin_link" value="<?= $user['linkedin_link']  ?>" placeholder="http://linkedin.com/topfreelancer">
											</div>
										</div>

										<div class="col-md-12">
											<div class="submit-field">
												<h5><?=trans('page_link')?></h5>
												<input class="form-control" type="text" name="page_link" value="<?= $user['page_link']  ?>" placeholder="http://yourdomain.com/">
											</div>
										</div>
										
								<!-- resume -->
                  <div class="col-lg-12 mt-3 mb-3">
                      <h5><?=trans('resume')?> * </h5>
                      <?php if($user['resume']): ?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 float-left">
                          <?php else: ?>
                            <div class="w-100 float-left">
                          <?php endif; ?>
                          <input class="form-control full-width input-upload topfreelancer-upload" type="file" id="resume-upload" name="resume" value="">
                          <input class="form-control topfreelancer-upload" type="hidden" name="old_resume" value="<?= $user['resume']; ?>" >
                          <div class="float-right p-1 mt-1 mr-4 fz-12 lh-1"><small>(<?=trans('resume_size_msg')?>)</small></div>
                        </div>
                        
                      <?php if($user['resume']): ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 float-left">
                          <a class="btn btn-block btn-secondary lh-2" href="<?= base_url().$user['resume']; ?>" target="_blank"><small><?=trans('resume_down_msg')?></small></a>
                          <input type="hidden" name="resume" value="<?= $user['resume']; ?>" >
                        </div>
                      <?php endif; ?>

                    </div>

                  </div>

									

  					<div class="mt-4"></div>

					<div class="col-md-12 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('skills')?> *</h5>
                      <input type="tel" name="skills" value="<?= $user['skills']  ?>" class="form-control" placeholder="eg, html, css, php, javascript">
                    </div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
              <div class="submit-field">
									<?php 
										$exp = $user['experience'];
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
												<?php if($user['education_level'] == $education['id']): ?>
													<option value="<?= $education['id']; ?>" selected> <?= $education['type']; ?> </option>
												<?php else: ?>
													<option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
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
                      <?php if($user['nationality'] == $country['id']): ?>
                        <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
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
                      <?php if($user['residency'] == $country['id']): ?>
                        <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
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
                      <?php if($user['lang1'] == $language['lang_id']): ?>
                        <option value="<?= $language['lang_id']; ?>" selected> <?= $language['lang_name']; ?> </option>
                      <?php else: ?>
                        <option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?> </option>
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
                      <?php if($user['lang2'] == $language['lang_id']): ?>
                        <option value="<?= $language['lang_id']; ?>" selected> <?= $language['lang_name']; ?> </option>
                      <?php else: ?>
                        <option value="<?= $language['lang_id']; ?>"> <?= $language['lang_name']; ?> </option>
                    <?php endif; endforeach; ?>
                </select>
							</div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
              <div class="submit-field">
              <?php 
                $av = $user['availability'];
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
											<input id="start_date" class="form-control datepicker" placeholder="DD-MMM-YYYY" type="text" name="start_date" value="<?= $user['start_date']  ?>">
											<div class="input-group-append"><div class="input-group-text"><span class="fa fa-calendar"></span></div></div>
										</div>
									</div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
              <div class="submit-field">
                <h5><?=trans('emp_type')?> *</h5>
                <select name="employment" class="form-control">
                  <option value=""><?=trans('select_workstation')?></option>
                    <?php $employment_type = get_employment_type_list(); foreach($employment_type as $employment):?>
                      <?php if($user['employment'] == $employment['id']): ?>
                        <option value="<?= $employment['id']; ?>" selected> <?= $employment['type']; ?> </option>
                      <?php else: ?>
                        <option value="<?= $employment['id']; ?>"> <?= $employment['type']; ?> </option>
                      <?php endif; endforeach; ?>
                </select>
							</div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
              <div class="submit-field">
                <h5><?=trans('travel_willingness')?> *</h5>
                	<select name="travel_willingness" class="form-control">
										<option value=""><?=trans('select_travel_willingness')?></option>
                  	<option value="0%" <?php if($user['travel_willingness'] == '0%'){ echo "selected";} ?>>0%</option>
                    <option value="25%" <?php if($user['travel_willingness'] == '25%'){ echo "selected";} ?>>25%</option>
                    <option value="50%" <?php if($user['travel_willingness'] == '50%'){ echo "selected";} ?>>50%</option>
                    <option value="75%" <?php if($user['travel_willingness'] == '75%'){ echo "selected";} ?>>75%</option>
                    <option value="100%" <?php if($user['travel_willingness'] == '100%'){ echo "selected";} ?>>100%</option>
                  </select>
              </div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
                  <div class="submit-field">
                    <h5><?=trans('day_rate')?> *</h5>
										<input class="form-control" type="text" name="day_rate" value="<?= $user['day_rate']  ?>">
                  </div>
          </div>

					<div class="col-xl-2 col-md-4 col-sm-6">
              <div class="submit-field">
                <h5><?=trans('publish_profile')?> *</h5>
                	<select name="publish_profile" class="form-control">
                  	<option value="yes" <?php if($user['publish_profile'] == 'yes'){ echo "selected";} ?>>Yes</option>
                    <option value="no" <?php if($user['publish_profile'] == 'no'){ echo "selected";} ?>>No</option>
                  </select>
              </div>
          </div>

					<div class="col-md-12 col-sm-12">
              <div class="submit-field">					
                	<div class="d-inline-block"><?=trans('i_am_prof')?>: </div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" name="trainer" id="<?=trans('trainer')?>" value="1" <?php if($user['trainer'] == '1'){ echo "checked";} ?>>
										<label class="form-check-label btn btn-sm btn-warning" for="<?=trans('trainer')?>"><?=trans('trainer')?> </label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" name="consultant" id="<?=trans('consultant')?>" value="1" <?php if($user['consultant'] == '1'){ echo "checked";} ?>>
										<label class="form-check-label btn btn-sm btn-info" for="<?=trans('consultant')?>"><?=trans('consultant')?> </label>
									</div>
              </div>
          </div> 

              <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Select Status</label>

                <div class="col-sm-9">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($user['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($user['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
							
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update User" class="btn btn-info pull-right">
                </div>
              </div>

							</div>
              </div>
            </div>
            <?php echo form_close();?> 

            <!-- resume -->
            <?php $attributes = array('id' => 'update_user_resume', 'method' => 'post' , 'class' => 'form_horizontal'); ?> 
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
