<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('top_businesses')?>
        </h1> 
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->

<section class="post-area section-gap">
  <div class="container">
    <div class="row">
      <?php foreach($businesses as $business): ?>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="business-item-list text-center">
          <a href="<?= base_url('business/'.$business['business_slug']); ?>"><img src="<?= base_url().$business['business_logo']; ?>" alt="business-img" /></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
     