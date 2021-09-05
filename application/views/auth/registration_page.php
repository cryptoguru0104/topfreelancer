<div class="container-login100">
      <div class="wrap-login100">
        <?php $attributes = array('id' => 'registeration_form', 'method' => 'post',  'class' => 'login100-form validate-form'); ?>

        <?php echo form_open('auth/registration',$attributes); ?>
          <span class="login100-form-title pb-5">
            <?=trans('signup')?>
			
          </span>
           <?php 
              if($this->session->flashdata('validation_errors')){

                echo '<div class="alert alert-danger">' . $this->session->flashdata('validation_errors') . '</div>';
              }
          ?>
          <div class="wrap-input100 d-flex">
							<div class="col-md-6 mb-3" data-validate = "<?=trans('valid_name')?>: free">
								<input class="input100" type="text" name="firstname" value="<?= set_value('firstname'); ?>" placeholder="<?=trans('first_name')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-user"></span>
								</span>
							</div>
							<div class="col-md-6 mb-3" data-validate = "<?=trans('valid_name')?>: lancer">
								<input class="input100" type="text" name="lastname" value="<?= set_value('lastname'); ?>" placeholder="<?=trans('last_name')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-user"></span>
								</span>														
							</div>
          </div>

          <div class="wrap-input100 d-flex">
							<div class="col-md-6 mb-3" data-validate = "<?=trans('valid_email')?>: ex@abc.xyz">
								<input class="input100" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="<?=trans('email')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-envelope"></span>
								</span>
							</div>
							<div class="col-md-6 mb-3" data-validate = "<?=trans('valid_phone')?>: +10000000000">
								<input class="input100" type="text" name="phone" value="<?= set_value('phone'); ?>" placeholder="<?=trans('phone')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-phone"></span>
								</span>														
							</div>
          </div>

          <div class="wrap-input100 d-flex">
							<div class="col-md-6 mb-3" data-validate = "<?=trans('country_required')?>">
								<?php
									$options = array('--Select--');
									$class = array('class' => 'country input100');
									foreach ($countries as $country){
										$options[$country['id']] = $country['name'];
									}

									echo form_dropdown('country',$options,set_value('country'), $class);

								?>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-location"></span>
								</span>
						  </div>

							<div class="col-md-6 mb-3" data-validate = "<?=trans('city_required')?>">
								<input class="input100" type="text" name="city" placeholder="<?=trans('city')?>" value="<?= set_value('city'); ?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-map-marker"></span>
								</span>														
							</div>
          </div>

	
          <div class="wrap-input100 d-flex">
							<div class="col-md-6 mb-3" data-validate = "<?=trans('password_required')?>">
								<input class="input100" type="password" name="password" value="<?= old('password'); ?>" placeholder="<?=trans('password')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-lock"></span>
								</span>
							</div>
							<div class="col-md-6 mb-3" data-validate = "<?=trans('password_required')?>">
								<input class="input100" type="password" name="confirmpassword" placeholder="<?=trans('confirm_pass')?>">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<span class="lnr lnr-lock"></span>
								</span>														
							</div>
          </div>

          <div class="wrap-input100 captcha d-flex">
						<div class="col-md-6 mb-3">
							<div class="contact100-form-checkbox pt-2 ml-1">
								<input class="input-checkbox100" id="ckb1" type="checkbox" name="termsncondition">
								<label class="label-checkbox100" for="ckb1">
									<?=trans('agree_to')?>
									<a href="<?= base_url('p/terms-n-conditions'); ?>" title="<?=trans('terms')?>" target="_blank"><?=trans('terms')?></a>
									 & 
									<a href="<?= base_url('p/privacy-policy'); ?>" title="<?=trans('label_privacy')?>" target="_blank"><?=trans('label_privacy')?></a>
								</label>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<?php if($this->recaptcha_status): ?>
									<div class="recaptcha-cnt">
											<?php generate_recaptcha(); ?>
									</div>
							<?php endif; ?>
						</div>
					</div>

          <div class="container-login100-form-btn">
            <input type="submit" class="login100-form-btn" name="submit" value="<?=trans('signup')?>">
          </div>
        </form>

        <div class="text-center w-full pt-4">
            <span>
              <?=trans('already_member')?>
            </span>

            <a class="bo1 hov1" href="<?= base_url(); ?>auth/login">
              <?=trans('sign_in_now')?>
            </a>
        </div>
      </div>
    </div>