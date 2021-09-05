<!-- start banner Area -->
      <section class="banner-area relative" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="container">
          <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
              <h1 class="text-white">
                <?=trans('invite_friend')?>
              </h1> 
            </div>                      
          </div>
        </div>
      </section>
      <!-- End banner Area -->  

      <!-- Start contact-page Area -->
      <section class="contact-page-area mt-5 mb-4">
        <div class="container">
          <div class="row">

            <div class="col-lg-12 bg-gray">
              <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?=$this->session->flashdata('success')?>
                </div>
              <?php  endif; ?>
         
              <?php $attributes = array('id' => '', 'method' => 'post' , 'class' => 'form-area contact-form text-right'); ?>
              <?php echo form_open('invite-friend',$attributes);?>  
                <div class="row mt-4"> 
                  <div id="invitations" class="col-lg-12 form-group">
                    
                    <input name="username" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=trans('enter_your_name')?>'" class="common-input mb-20 form-control" required="" type="text">
                    <div class="inputhere">
                      <div>
                        <input name="email[]" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=trans('enter_email')?>'" class="common-input mb-20 form-control" type="email">
                      </div>
                      <button class="add-new"><i class="fa fa-plus"></i></span></button>
                    </div>        
                    <?php if($this->recaptcha_status): ?>
                        <div class="recaptcha-cnt d-block col-md-12" style="width:100%; margin:0 auto;">
                            <?php generate_recaptcha(); ?>
                        </div>
                    <?php endif; ?>
                    <input type="submit" name="submit" value="<?=trans('send_message')?>" class="btn-block primary-btn mt-5 text-white" />
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>  
      </section>
      <!-- End contact-page Area -->
