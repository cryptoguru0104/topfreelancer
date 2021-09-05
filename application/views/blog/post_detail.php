<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?= $title ?>				
				</h1>	
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start blog-posts Area -->
<section class="blog-posts-area section-gap">
	<div class="container">
		<div class="row">
            <?php 
                $tags = get_post_tags_by_id($post['id']); 
            ?>
			<div class="col-lg-8 post-list blog-post-list">
				<div class="single-post">
					<img class="img-fluid" src="<?= base_url($post['image_default']) ?>" alt="<?= $post['title'] ?>">

                    <ul class="tags">
                        <?php foreach($tags as $tag): ?>
                            <li><a href="<?= base_url('blog/tag/').$tag['tag_slug'] ?>"><?= $tag['tag'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    
					<a href="<?= base_url('blog/post/'.$post['slug']) ?>">
						<h1><?= $post['title'] ?></h1>
					</a>
					<div class="content-wrap">
						<p><?= $post['content'] ?></p>
					</div>

                <!-- Start nav Area -->
                <section class="nav-area pt-50 pb-100">
                    <div class="container">
                        <div class="row justify-content-between">

                            <?php $pre_post = get_previous_post($post['id']); ?>

                            <div class="col-sm-6 nav-left justify-content-start d-flex">
                                <div class="thumb">
                                    <img src="<?= base_url($pre_post['image_default']) ?>" alt="" width="100">
                                </div>
                                <div class="post-details">
                                    <p><?=trans('prev_post')?> </p>
                                    <p class="font-weight-bold"><a href="<?= base_url('blog/post/').$pre_post['slug'] ?>"><?= $pre_post['title'] ?></a></p>
                                </div>
                            </div>

                            <?php  $next_post = get_next_post($post['id']); ?>

                            <div class="col-sm-6 nav-right justify-content-end d-flex">
                                <div class="post-details">
                                    <p><?=trans('next_post')?> </p>
                                    <p class="font-weight-bold"><a href="<?= base_url('blog/post/').$next_post['slug'] ?>"><?= $next_post['title'] ?></a></p>
                                </div>             
                                <div class="thumb">
                                    <img src="<?= base_url($next_post['image_default']) ?>" alt="" width="100">
                                </div>                         
                            </div>
                        </div>
                    </div>    
                </section>
                <!-- End nav Area -->

				</div>																		
			</div>

			<?php $this->load->view('blog/right_nav'); ?>

		</div>
	</div>	
</section>
<!-- End blog-posts Area -->
