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
			<div class="col-lg-8 post-list blog-post-list">

				<?php 
					foreach($posts as $post): 
					$tags = get_post_tags_by_id($post['post']);
				?>

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
						<p>
							<?= $post['content'] ?>
						</p>
				</div>

				<?php endforeach; ?>
			</div>

			<?php $this->load->view('blog/right_nav'); ?>

		</div>
	</div>	
</section>
<!-- End blog-posts Area -->
