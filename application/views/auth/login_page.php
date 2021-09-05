<?php
	if(isset($_GET['id'])) {
		$this->session->set_userdata('event_id', $_GET['id']);
	}
?>
<?php
$totalsliders = count($sliders);
?>
<!-- Start Slider Area -->
<section class="slider-area relative" id="home">
	<div class="overlay overlay-bg"></div>

	<div id="homeSlider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php for($i = 0; $i < $totalsliders; $i++) { ?>
			<li data-target="#homeSlider" data-slide-to="<?php echo $i; ?>"
				<?php if($i == 0) { echo "class='active'"; }  ?>>
			</li>
			<?php } ?>
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php for($i = 0; $i < $totalsliders; $i++) { ?>
			<div class="carousel-item <?php if($i == 0) { echo "active"; }  ?>"
				style="background:url('<?= $sliders[$i]["image"] ?>')">

				<div class="carousel-caption carousel-<?= $sliders[$i]["position"] ?> d-sm-block d-md-block">
							<h5><?= $sliders[$i]["subtitle"] ?></h5>
				</div>
			</div>
			<?php } ?>
		</div>
		<a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	</div>

</section>
<!-- End Slider Area -->
<!-- Start post Area -->
<section class="mt-5 mb-5">
	<div class="container ">
		<div class="row justify-content-center d-flex ">
    <div class="wrap-login100 ">
      <span class="login100-form-title pb-4">
          ACCOUNT LOGIN
      </span>
      <?php    
        if ($this->session->flashdata('registration_success')) {

          echo  $this->session->flashdata('registration_success');
        }
        if($this->session->flashdata('error_login')){

          echo '<div class="alert alert-danger">' . $this->session->flashdata('error_login') . '</div>';
        }
        if($this->session->flashdata('success')){

          echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
        }
      ?> 

       <div class="content" id="login-page">

          <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
            echo form_open('auth/login',$attributes);?>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_email')?>: ex@abc.xyz">
              <input class="input100" type="text" name="email" value="<?=  set_value('email'); ?>" placeholder="<?=trans('email')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-envelope"></span>
              </span>
            </div>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('password_required')?>">
              <input class="input100" type="password" name="password" placeholder="<?=trans('password')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-lock"></span>
              </span>
            </div>

            <div class="contact100-form-checkbox pt-2 ml-1">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                <?=trans('remember_me')?>
              </label>
            </div>
						<div class="col-lg-12 form-group" style="max-height:80px !important;">
						<?php if($this->recaptcha_status): ?>
						<div class="recaptcha-cnt col-md-6">
							<?php generate_recaptcha(); ?>
						</div>
						<?php endif; ?>
					</div>
            <div class="container-login100-form-btn pt-4">
              <input type="submit" class="login100-form-btn" name="login" value="<?=trans('login')?>">
            </div>
          <?php echo form_close(); ?>

          <div class="text-center w-full pt-4">
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/forgot_password">
                <?=trans('forgot_pass')?>
              </a>
          </div>

          <div class="text-center w-full pt-3">
              <span class="txt1">
                <?=trans('dont_account')?>
              </span>
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/registration">
                <?=trans('signup_now')?>
              </a>
          </div>

        </div>

      </div>
		</div>
	</div>
			</section>
