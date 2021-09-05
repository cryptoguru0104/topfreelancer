<div class="col-lg-4 sidebar">
	<div class="single-widget search-widget">
		<form class="example" action="<?= base_url('blog/search') ?>" style="margin:auto;max-width:300px">
			<input type="text" placeholder="Search Posts" name="title" value="<?= (isset($_GET['title'])) ? $_GET['title'] : '' ?>" required>
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>								
	</div>


	<div class="single-widget recent-posts-widget">
		<h4 class="title"><?=trans('recent_posts')?></h4>
		<div class="blog-list ">
			<?php 
			$recents = get_recent_blog_post();
			foreach($recents as $recent):
				?>
				<div class="single-recent-post d-flex flex-row">
					<div class="recent-thumb">
						<img class="img-fluid img-responsive" src="<?= base_url($recent['image_default']) ?>" alt="<?= $recent['title'] ?>" width="100">
					</div>
					<div class="recent-details">
						<a href="<?= base_url('blog/post/'.$recent['slug']) ?>">
							<h4><?= $recent['title'] ?></h4>
						</a>
						<p><?= date_time($recent['created_at']) ?></p>
					</div>
				</div>	
				
			<?php endforeach; ?>

		</div>								
	</div>

	<div class="single-widget tags-widget">
		<h4 class="title"><?=trans('tag_clouds')?></h4>
		<ul>
			<?php 
			$tags = get_tags_list();
			foreach($tags as $tag): 
				?>
				<li><a href="<?= base_url().'blog/tag/'.$tag['tag_slug'] ?>"><?= $tag['tag'] ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>				
</div>
