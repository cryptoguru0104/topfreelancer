<!-- start banner Area -->
<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('contact_us')?>
				</h1>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start contact-page Area -->
<section class="contact-page-area">
	<div class="container">
		<div class="row">

			<div class="bg-gray col-lg-4 d-flex flex-column">
				<div class="mt-5 fz-14 lh-2">
					<p>Let us know how we can help you</p>
					<p>Consultancy firms can access highly rated freelancers and ensure the right fit by freely viewing their
						profiles and resumes.</p>
					<p>We aim to connect you with the top freelancers that have local experience, market understanding, and
						ability to get the job done.</p>
					<p>Email us at <span class="text-danger">info@top-freelancer.com</span> or use the form below</p>
				</div>
			</div>

			<div class="col-lg-8">
				<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<?=$this->session->flashdata('success')?>
				</div>
				<?php  endif; ?>

				<?php $attributes = array('id' => 'contact-us', 'method' => 'post' , 'class' => 'form-area contact-form text-right'); ?>
				<?php echo form_open('contact',$attributes);?>

				<div class="row mt-5">

					<div class="col-lg-12 form-group">
						<input name="username" placeholder="Enter your name" onfocus="this.placeholder = ''"
							onblur="this.placeholder = '<?=trans('enter_your_name')?>'" class="common-input mb-20 form-control"
							required="" type="text">
					</div>

					<div class="col-lg-12 form-group">
						<input name="email" placeholder="Enter email address"
							pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''"
							onblur="this.placeholder = '<?=trans('enter_email')?>'" class="common-input mb-20 form-control"
							required="" type="email">
					</div>

					<div class="col-lg-12 form-group">
						<input name="subject" placeholder="Enter your subject" onfocus="this.placeholder = ''"
							onblur="this.placeholder = '<?=trans('subject')?>'" class="common-input mb-20 form-control" required=""
							type="text">
					</div>

					<div class="col-lg-12 form-group">
						<textarea class="common-textarea mt-10 form-control" name="message" placeholder="<?=trans('message')?>"
							onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
					</div>

					<div class="col-lg-12 form-group" style="max-height:80px !important;">
						<?php if($this->recaptcha_status): ?>
						<div class="recaptcha-cnt col-md-6">
							<?php generate_recaptcha(); ?>
						</div>
						<?php endif; ?>
					</div>

          <div class="col-lg-8 form-group mx-auto">
						<input type="submit" name="submit" value="<?=trans('send_message')?>"
							class="btn btn-primary btn-lg btn-block" />
              </div>

				</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- End contact-page Area -->
