<?php
$totalsliders = count($sliders);
?>
<!-- Start Slider Area -->
<section class="slider-area relative" id="home">
	<div class="overlay overlay-bg"></div>

	<div id="homeSlider" class="carousel slide" data-ride="carousel" data-interval="1000">
		<ol class="carousel-indicators">
			<?php for($i = 0; $i < $totalsliders; $i++) { ?>
			<li data-target="#homeSlider" data-slide-to="<?php echo $i; ?>"
				<?php if($i == 0) { echo "class='active'"; }  ?>>
			</li>
			<?php } ?>
		</ol>
		<div class="carousel-inner" role="listbox" >
			<?php for($i = 0; $i < $totalsliders; $i++) { ?>
			<div class="carousel-item  <?php if($i == 0) { echo "active"; }  ?>" 
				style="background:url('<?= $sliders[$i]["image"] ?>')" >

				<div class="carousel-caption text-center shadow-lg" >
							<h5 class="text-center"><?= $sliders[$i]["subtitle"] ?></h5>
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
<!-- Start call-to-action Area -->
<section class="no-padding" id="join">
	<div class="container pt-80 pb-80">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h1 class="home-title"><?=trans('join_us')?></h1>
					<p class="fz-22 lh-3">Top Freelancer is a social responsibility platform for independent freelancers and consultants in the MENA region.<br />
						We help businesses and project managers find the right
						freelancer,
						at the right time, at the right location, for the right<br> project, and at no cost.</p>
					<div class="mt-5">
						<a class="btn btn-primary btn-lg rounded mx-2 mb-2 btn-lg text-center"
							style="padding: .8rem 1.2rem; font-size:1.25rem;"
							href="<?= base_url('freelancer'); ?>"><?=trans('i_need_cand')?></a>
						<a class="btn btn-primary btn-lg rounded mx-2 mb-2 btn-lg"
							style="padding: .8rem 1.2rem; font-size:1.25rem;"
							href="<?= base_url('auth/registration'); ?>"><?=trans('i_am_cand')?></a>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- End call-to-action Area -->

<!-- Start How it Works Area -->
<section class="bg-gray no-padding" id="works">
	<div class="container pt-80 pb-80">
		<div class="row">
			<div class="col-lg-12">
				<div class="how-it-works">
					<h2 class=" font-weight-bold fz-48 mb-3 text-center">
						<?=trans('how_it_works')?></h2>

					<h3 class="text-uppercase mt-4 font-weight-bold"><?=trans('for_business')?></h3>
					<ul class=" fz-22 lh-3" style="list-style:inside">
						<li>Click on<span class="font-weight-bold "> “Freelancers”</span> and search for the best-fit
							freelancers
							for your project vacancies and contact them <span
								class="font-weight-bold font-italic">directly.</span>
						</li>
						<li>Sign up and <span class="font-weight-bold"> “Post a new vacancy” </span> by entering vacancy
							requirements, interested and available freelancers will contact you <span
								class="font-weight-bold font-italic">directly</span>.</li>
						<li>Recieve instant <span class="font-weight-bold">“eConsultation” </span> online from any
							freelancer
							as per your business requirements by booking them <span
								class="font-weight-bold font-italic">directly</span>.</li>
					</ul>


					<h3 class="text-uppercase mt-4 font-weight-bold"><?=trans('for_freelancer')?></h3>
					<ul class=" fz-22 lh-3" style="list-style:inside">

						<li>Sign up and create your <span class="font-weight-bold"> “Freelancer Profile” </span> and
							upload
							your CV in minutes, interested businesses will contact you <span
								class="font-weight-bold font-italic">directly.</span> </li>
						<li>Click on <span class="font-weight-bold"> “Vacancies” </span> and search for a vacancy that
							fit
							your expertise and requirements and contact the project manager <span
								class="font-weight-bold font-italic">directly</span>.</li>
						<li> Provide instant <span class="font-weight-bold"> “eConsultation” </span> using zoom or
							another
							online conference platform to anyone and bill them <span
								class="font-weight-bold font-italic">directly.</span></li>
					</ul>
				</div>
				<div class="clear cleafix mt-5 mb-3"></div>

				<div class="col-lg-6 float-lg-left mb-4">
					<div class="container">
						<div class="row">
							<img src="https://via.placeholder.com/480x240" class="mx-auto my-0 img-fluid" />
						</div>
					</div>
				</div>

				<div class="col-lg-6 float-lg-left mb-0">
					<div class="container">
						<div class="row">
							<img src="https://via.placeholder.com/480x240" class="mx-auto my-0 img-fluid" />
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	</div>
</section>
<!-- End call-to-action Area -->

<!-- Start discover  Area -->
<section class="blg-height" id="join">

	<div class="container pt-80 pb-80">
		<div class="row">
			<div class="headline">

				<div class="col-md-6 py-3 fz-24 float-left">
					<div class="row">
					<div class="btn w-190 btn-sm rounded-pill bg3 w-5 bg-warning text-white">Freelancer </div>
					</div>
					
				</div>
			</div>
      
			<div class="col-lg-12 mb-1 text-center">
				<h1 style="color:rgba(15, 50, 52, 0.94)">Discover the power of our social</h1>
				<h1 style="color:rgba(15, 50, 52, 0.94)">platform for on-demand freelancers</h1>
				<p class="mt-4 mb-3 fz-22 lh-3">Don’t get lost in world of talent and try to choose from a big pool of
					people.
					Select
					on-demand freelancer from <br> a hand picked group of MENA consultants and industry experts that is
					assembled
					for your specific needs.</p>

			</div>
			<div class="col-lg-12 text-center">

				<div class="box col-lg-3 col-md-6 col-sm-12 my-5">
						<div class="feature-item-icon"><i class="fa fa-flask"></i></div>
						<h3>Driven by Expertise</h3>
						<p class="mt-3">Directly contact and hire
							the game changer
							industry experts and freelancers in any sector for your short or long-term projects.</p>

				</div>

				<div class="box col-lg-3 col-md-6 col-sm-12 my-5">
						<div class="feature-item-icon"><i class="fa fa-microchip"></i></div>
						<h3>Pioneered by Technology</h3>
						<p class="mt-3"> Self-manage external expertise
							requirements from a
							single free platform for all your projects, and rapidly
							access many qualified freelancers.</p>
				</div>

				<div class="box col-lg-3 col-md-6 col-sm-12 my-5">
						<div class="feature-item-icon"><i class="fa fa-users"></i></div>
						<h3>Relied on Platform Team</h3>
						
						<p class="mt-3">Our platform management team
							filter, select and
							approve the best freelancers and list them for you to
							choose from.</p>
				</div>

			</div>
			</div>

	</div>
</section>


<!-- End call-to-action Area -->

<!-- Start eConsultantion Area -->
<section class="no-padding bg-gray" id="cons">
	<div class="container pt-80 pb-80">
		<div class="row ">
		<div class="col-lg-6 6 col-md-6 col-sm-6 pt-2 pb-5 fz-24 w-auto">
				<div class="btn btn-sm shadow-lg rounded-pill bg1 w-5 bg-warning text-white">eConsultant </div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 d-inline-block w-auto">
				<div class="float-right">
				<img src="<?= base_url('assets/icons/icons8-technical-support-80.png') ?>" width="90px" height="90px"/>
				</div>
			</div>



			<div class="col-lg-12 mb-5 text-center">

				<h1 class="mb-3 fz-30 lh-3" style="color:rgba(15, 50, 52, 0.94)">Get your instant “eConsultation”<br>
					online from your favorite freelancer </h1>

				<p class="fz-22 lh-2">Businesses are increasingly using online consultancy services then ever
					before. We
					provide instant or<br>
					scheduled “eConsultation” with your favorite freelancers who are opting for this channel. For your
					short
					and<br>
					urgent specific requirements identify and book your favorite on-demand freelancer today …</p>
			</div>

			<div class="col-lg-12 text-center">

				<div class="box col-lg-3 col-md-6 col-sm-12 mt-3">
					<button class="btn btn-primary rounded bg1">Book
							eConsultant</button>
					<h3 class="my-4"> Booking </h3>
					<p class="lh-3 fz-20"> Directly book your appointment<br>
						with your favorite eConsultant by<br>
						selecting your best date and time. </p>

				</div>

				<div class="box col-lg-3 col-md-6 col-sm-12 mt-2">
				<img src="<?= base_url('assets/img/zoom.png') ?>" width="120px" height="50px"/>
				
						<h3 class="my-4"> Conference </h3>
						<p class="lh-3 fz-20"> Use Zoom or other conference<br>
							platform to effectively engage<br>
							and talk with your eConsultant.</p>
				</div>

					<div class="box col-lg-3 col-md-6 col-sm-12 mt-2">
					<img src="<?= base_url('assets/img/paypal.png') ?>" width="120px" height="50px"/>
						<h3 class="my-4"> Payment </h3>
						<p class="lh-3 fz-20"> Easily pay your fees to your<br>
							eConsultant directly using PayPal or<br>
							other preferred payment channels. </p>
					</div>

				</div>


			</div>

		</div>
</section>
<!-- end econsultation-->
<!-- Start Blog Area -->
<section class="no-padding pt-3 pb-5 section-full">

	<div class="container">

		<div class="row d-flex justify-content-center">
			<div class="menu-content pt-5 mb-4 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10"><?=trans('blogs')?></h1>
					<p class="fz-20"><?=trans('blogs_subtitle')?>.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php  foreach($posts as $post): ?>
			<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
				<div class="card" style="width: auto;">
					<img class="card-img-top mh-110" style="height: 17rem;"
						src="<?= base_url($post['image_default']) ?>" alt="">
					<div class="card-body " style="min-height:150px;overflow:auto">
						<h5 class="card-title"><a
								href="<?= base_url().'blog/post/'.$post['slug'] ?>"><?= $post['title'] ?></a></h5>
						<p class="card-text"><?= text_limit($post['content'], 150) ?></p>


					</div>
					<div class="card-body">
						<a href="<?= base_url().'blog/post/'.$post['slug'] ?>"
							class="btn btn-info"><?=trans('read_more')?>..</a>
					</div>

				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
