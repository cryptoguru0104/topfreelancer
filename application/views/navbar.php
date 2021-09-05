 <!-- header start -->
<header id="header">
  <div class="container">
    <div class="row align-items-center d-flex">
      <div class="col-2">
        <div id="logo">
          <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/img/logo.png'); ?>" alt="" title="" /></a>
        </div>
      </div>
      <div class="col-10">
        <nav id="nav-menu-container">
          <ul class="nav-menu">
					<li <?=($this->uri->uri_string()==='freelancer')?'class="active"':''?>><a href="<?= base_url('freelancer'); ?>"><?=trans('label_freelancers')?></a></li>
					<li class="<?=($this->uri->uri_string()==='jobs')?'active':''?>"><a href="<?= base_url('jobs'); ?>"><?=trans('label_jobs')?></a></li>
					<li class="<?=($this->uri->uri_string()==='invite-friend')?'active':''?>"><a href="<?= base_url('invite-friend'); ?>"><?=trans('label_invite_friend')?></a></li>
					<li class="<?=($this->uri->uri_string()==='p/about-us')?'active':''?>"><a href="<?= base_url('p/about-us'); ?>"><?=trans('label_about')?></a></li>
					<li class="<?=($this->uri->uri_string()==='blog')?'active':''?>"><a href="<?= base_url('blog'); ?>"><?=trans('label_blog')?></a></li>
					<li class="<?=($this->uri->uri_string()==='contact')?'active':''?>"><a href="<?= base_url('contact'); ?>"><?=trans('label_contact')?></a></li>
					<?php if ($this->session->userdata('is_user_login')): ?>
              </li>   
                <?php 
                  $profile_picture = get_user_profile($this->session->userdata('user_id'));
                  $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
                ?>
              <li class="menu-has-children margin-left-400"><a href="#"> <?= $this->session->userdata('username'); ?> <img src="<?= base_url($profile_picture)?>" alt="user_img" height=35 /> </a> 
                <ul>
									<li><a href="<?= base_url('account') ?>"> <?=trans('label_my_account')?></a>
                  <li><a href="<?= base_url('profile'); ?>"><?=trans('label_freelancer_profile')?></a></li>
                  <li><a href="<?= base_url('favorite-freelancers'); ?>"><?=trans('label_favorite_freelancers')?></a></li>
                  <li><a href="<?= base_url('myjobs'); ?>"><?=trans('applied_jobs')?></a></li>
                  <li><a href="<?= base_url('myjobs/new-vacancy'); ?>"><?=trans('label_post_job')?></a></li>
                  <li><a href="<?= base_url('myjobs/posted'); ?>"><?=trans('posted_jobs')?></a></li>
									<li><a href="<?= base_url('favorite-vacancies'); ?>"><?=trans('label_favorite_vacancies')?></a></li>
									<li><a href="<?= base_url('econsultant-booking'); ?>"><?=trans('label_econsultant_booking')?></a></li>
                  <li><a href="<?= base_url('auth/logout')?>"><?=trans('label_logout')?></a></li>
                </ul>
              </li>
            <?php else: ?> 


	<li id="topbtn"><a class="ticker-btn-nav mt-1 btn btn-secondary" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-highlight pr-1"></i> <?=trans('label_login')?></a></li>
	<li id="topbtn"><a class="ticker-btn-nav mt-1 btn btn-secondary" href="<?= base_url('auth/registration') ?>"><i class="lnr lnr-plus-circle pr-1"></i> <?=trans('signup')?></a></li>

            <?php endif; ?>                                 
          </ul>
        </nav><!-- #nav-menu-container -->      
      </div>      
    </div>
  </div>
</header><!-- #header End
