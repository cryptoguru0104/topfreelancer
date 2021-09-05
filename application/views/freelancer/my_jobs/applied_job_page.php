f <!-- start banner Area -->
    <section class="banner-area relative" id="home">  
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="about-content col-lg-12">
            <h1 class="text-white">
				<?=trans('applied_jobs')?>
            </h1> 
          </div>                      
        </div>
      </div>
    </section>
    <!-- End banner Area -->  
<!-- Start post Area -->
<section class="post-area pt-5">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-12 post-list">

				<?php if ($this->session->flashdata('success')) :?>
		            <div class="alert alert-success">
		              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
		              <strong><?=$this->session->flashdata('success')?></strong> 
		            </div>
		        <?php endif;?>

                <?php if(empty($jobs)): ?>
                  <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_job_apps')?></p>
                <?php endif; ?>
                
				<?php foreach($jobs as $job): ?>

					<?php
							$appDate = $job["applied_date"];
							$appliedDate = date("d M Y", strtotime($appDate));
					?>
					<h4 class="text-muted text-center mb-2"><?=trans('applied_on')?> <?= $appliedDate; ?></h4>
		<div class="list_banner bg-white border col-lg-12 float-left">

			<div id="block-first" class="mb-3" style="min-height:auto">
				
				<div class="col-md-2 vac-list border-right mb-3" style="min-height:250px !important">
						<h4 class="mb-2 clr2"><?= trans('location'); ?></h4>
						<p><?= $job["city"]; ?><br />
						<?= get_country_name($job["country"]); ?><br />
						<?= trans('emp_type'); ?>: <?= get_employment_type($job["employment_type"]); ?><br />
						<?= trans('travel_req'); ?>: <?= $job["travel"]; ?></p>

						<h4 class="mt-3 clr2"><?= trans('post_expires'); ?></h4>
						<?php
							$expDate = $job["expiry_date"];
							$formDate = date("d-M-Y", strtotime($expDate));
							
							if ($formDate < date('d-M-yyyy')) :
						?>
							<p><?= trans('expired_on'); ?> <?= $formDate; ?></p>
						<?php else: ?>
							<p><?= $formDate; ?></p>
						<?php endif; ?>
				</div>
				
				<div class="col-md-6 vac-list border-right mb-3">
						<h4 class="mb-2 clr2"><?= $job["title"]; ?></h4>
						<div class="flinfo"><?= $job["skills"]; ?></div>

						<h4 class="mt-3 clr2"><?= trans('vac_req'); ?></h4>
						<div class="flinfo fldesc"><?= $job["requirements"]; ?></div>
				</div>

				<div class="col-md-2 vac-list border-right">
						<h4 class="mb-2 clr2"><?= trans('candidate'); ?></h4>
						<div class="flinfo"><?= trans('min_experience'); ?>: <?= $job["experience"]; ?> <?= trans('years'); ?></div>
						<div class="flinfo"><?= trans('language'); ?>: <?= get_language_name($job["lang1"]); ?> & <?= get_language_name($job["lang2"]); ?></div>
						<div class="flinfo"><?= trans('nationality'); ?>: <?= get_country_name($job["nationality"]); ?></div>

						<h4 class="mt-2 clr2"><?= trans('payment'); ?></h4>
						<div><?= trans('day_rate'); ?>: <?= $job["min_salary"]; ?> <?= $job["max_salary"]; ?></div>
						<div class="text-capitalize"><?= $job["pay_type"]; ?></div>
						<div><?= trans('flights'); ?>: <?php if ($job["flights"] == "1"): echo trans('paid');  else: echo trans('not_paid'); ?> <?php endif; ?></div>
						<div><?= trans('hotel'); ?>: <?php if ($job["hotel"] == "1"): echo trans('paid');  else: echo trans('not_paid'); ?> <?php endif; ?></div>

						<div class="row">
								<div class="col mb-2 w-auto">
									<?php if($job["trainer"]) : ?>
									<div class="btn bg-warning rounded text-white fz-14"><?=trans('trainer')?> </div>
									<?php endif; ?>
								</div>

								<div class="col w-auto ">
									<?php if($job["consultant"]) : ?>
									<div class="btn bg-info rounded text-white fz-14"><?=trans('consultant')?> </div>
									<?php endif; ?>
								</div>

							</div>

				</div>

						<?php
							$start_date = $job["start_date"];
							$startDate = date("d-M-Y", strtotime($start_date));
						?>
				<div class="col-md-2 vac-list">
						<h4 class="mb-2 clr2"><?= trans('time'); ?></h4>
						<div class="flinfo"><?= trans('start_date'); ?>: <?= $startDate; ?></div>
						<div class="flinfo"><?= trans('time_period'); ?>: <?= $job["time_period"]; ?> <?= trans('weeks') ?> </div>
						<div class="flinfo"><?= trans('min_availability'); ?>: <?= $job["availability"]; ?> <?= trans('daysweek') ?> </div>
					
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

	<?php endforeach; ?>
			</div>
				<div class="pull-right">
			        <?php echo $this->pagination->create_links(); ?>
			    </div>
		</div>

	
	</div>
		
</section>
<!-- End post Area -->		

<div class="clear">&nbsp;</div>
