

<!-- Start post Area -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">

      <div class="col-lg-12 post-list">

         <?php if ($this->session->flashdata('error_update')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
          } ?>
          
         <?php if ($this->session->flashdata('update_success')) {
            echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
          } ?>

          <?php if ($this->session->flashdata('update_failed')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('update_failed') . '</div>';
          } ?> 

        <!-- <?=trans('user_info')?> --->
        <?php $attributes = array('id' => 'change_user_info_form', 'method' => 'post'); ?>
        <?php echo form_open('account/update_info',$attributes);?>

        <div class="profile_job_content col-lg-12">

          <div class="headline d-flex">
					  <div class="col-md-6 col-sm-6"><h3> <?=trans('user_info')?></h3></div>

            <div class="col-md-6">
                <div class="float-right">
                   <input class="btn job_detail_btn btn-md" value="<?=trans('update')?>" type="submit" name="submit">
                 </div>
            </div>
          </div>

          <div class="profile_job_detail">
            <div class="row">


                  <div class="col-100-5">
                    <div class="submit-field">
                      <h5><?=trans('first_name')?> *</h5>
                      <input class="form-control" type="text" name="firstname" value="<?= $user_info['firstname']  ?>" placeholder="John" required>
                    </div>
                  </div>

                  <div class="col-100-5">
                    <div class="submit-field">
                      <h5><?=trans('last_name')?> *</h5>
                      <input class="form-control" type="text" name="lastname" value="<?= $user_info['lastname']  ?>" placeholder="Wick" required>
                    </div>
                  </div>

                  <div class="col-100-5">
                    <div class="submit-field">
                      <h5><?=trans('phone')?> *</h5>
                      <input class="form-control" type="tel" name="mobile_no" value="<?= $user_info['mobile_no']  ?>" placeholder="1 5555 66666" required>
                    </div>
                  </div>


                  <div class="col-100-5">
                    <div class="submit-field">
                      <h5><?=trans('country')?> *</h5>
                      <select name="country" class="country form-control" required>
                        <option><?=trans('select_country')?></option>
                         <?php foreach($countries as $country):?>
                            <?php if($user_info['country'] == $country['id']): ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                            <?php else: ?>
                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                          <?php endif; endforeach; ?>
                    </select>
                    </div>
                  </div>

									<div class="col-100-5">
                  <div class="submit-field">
                    <h5><?=trans('city')?> *</h5>
										<?php 
											$cities = get_country_cities($user_info['country']);
				              $options = array('' => 'Select City')+array_column($cities, 'name','id');
				              echo form_dropdown('city',$options,$user_info['city'],'class="form-control city" required');
				            ?>
                  </div>
                </div>


            </div>
          </div>
        </div>                             
       <?php echo form_close(); ?>
      <!-- <?=trans('user_info')?> --->

      <div class="clearfix">&nbsp;</div>

        <!-- <?=trans('email')?> --->
        <?php $attributes = array('id' => 'change_email_form', 'method' => 'post'); ?>
        <?php echo form_open('account/change_email',$attributes);?>

        <div class="profile_job_content col-lg-12">

          <div class="headline d-flex">
					  <div class="col-md-6 col-sm-6"><h3> <?=trans('email')?></h3></div>

            <div class="col-md-6">
                <div class="float-right">
                   <input class="btn job_detail_btn btn-md" value="<?=trans('update')?>" type="submit" name="submit">
                 </div>
            </div>
          </div>

          <div class="profile_job_detail">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('current_email')?> *</h5>
                  <input type="email" name="current_email" class="form-control" required>
                </div>
              </div>
              <div class="clearfix">&nbsp;</div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('new_email')?> *</h5>
                  <input type="email" name="new_email" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('confirm_email')?> *</h5>
                  <input type="email" name="confirm_email" class="form-control" required>
                </div>
              </div>

            </div>
          </div>
        </div>                             
       <?php echo form_close(); ?>
      <!-- <?=trans('email')?> --->
        
        <div class="clearfix">&nbsp;</div>

        <!-- <?=trans('change_pass')?> --->
        <?php $attributes = array('id' => 'change_password_form', 'method' => 'post'); ?>
        <?php echo form_open('account/change_password',$attributes);?>

        <div class="profile_job_content col-lg-12">

          <div class="headline d-flex">
					  <div class="col-md-6 col-sm-6"><h3> <?=trans('change_pass')?></h3></div>

            <div class="col-md-6">
                <div class="float-right">
                   <input class="btn job_detail_btn btn-md" value="<?=trans('update')?>" type="submit" name="submit">
                 </div>
            </div>
          </div>

          <div class="profile_job_detail">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('old_pass')?> *</h5>
                  <input type="password" name="old_password" class="form-control" required>
                </div>
              </div>
              <div class="clearfix">&nbsp;</div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('new_pass')?> *</h5>
                  <input type="password" name="new_password" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5><?=trans('confirm_new_pass')?> *</h5>
                  <input type="password" name="confirm_password" class="form-control" required>
                </div>
              </div>

            </div>
          </div>
        </div>                             
       <?php echo form_close(); ?>
      <!-- <?=trans('change_pass')?> --->

     </div>
   </div>
 </div>  
</section>
<!-- End post Area -->    
