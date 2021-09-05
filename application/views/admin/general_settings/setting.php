<section class="content" id="general_settings">
	<div class="row">
   <div class="col-md-12">
     <div class="box box-body with-border">
      <h3>General Settings</h3>
    </div>
  </div>
</div>
<div class="row">
 <div class="col-md-12">
  <?php if($this->session->flashdata('success')):?>
   <div class="alert alert-success alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
     <?= $this->session->flashdata('success'); ?>
   </div>
 <?php endif; ?>
 <?php if($this->session->flashdata('error')):?>
   <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?= $this->session->flashdata('error'); ?>
  </div>
<?php endif; ?>
<div class="box box-body with-border">
  <div>
    <?php echo form_open_multipart(base_url('admin/general_settings/add')); ?>	
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
     <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">General Setting</a></li>
     <li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Setting</a></li>
     <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Social Media Setting</a></li>
     <li role="presentation"><a href="#reCAPTCHA" aria-controls="reCAPTCHA" role="tab" data-toggle="tab">Google reCAPTCHA</a></li>
     <li role="presentation"><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Payment Settings</a></li>
   </ul>
   
   <!-- Tab panes -->
   <div class="tab-content">

    <!-- General Setting -->
    <div role="tabpanel" class="tab-pane active" id="main">
   <div class="form-group">
    <label class="control-label">Application Name</label>
    <input type="text" class="form-control" name="application_name" placeholder="application name" value="<?php echo html_escape($general_settings['application_name']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Timezone</label>
    <input type="text" class="form-control" name="timezone" placeholder="timezone"
    value="<?php echo html_escape($general_settings['timezone']); ?>">
    <a href="http://php.net/manual/en/timezones.php" target="_blank">Timeszones</a>
  </div>
  <div class="form-group">
    <label class="control-label">Currency</label>
    <input type="text" class="form-control" name="currency" placeholder="currency"
    value="<?php echo html_escape($general_settings['currency']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Copyright</label>
    <input type="text" class="form-control" name="copyright"
    placeholder="Copyright"
    value="<?php echo html_escape($general_settings['copyright']); ?>">
  </div>

  <div class="row">
    <div class="col-md-12">
      <h5>Footer Settings</h5>
      <p>Manage your website footer</p>
    </div>
    <div class="col-md-12">
      <div class="footer-widget">
        <div class="footer-widget-header">
          <div class="row">
            <div class="col-md-3">
              <label class="control-label">Title</label> 
            </div>
            <div class="col-md-2">
              <label class="control-label">Size</label>
            </div>
            <div class="col-md-6">
              <label class="control-label">Content</label>
            </div>
            <div class="col-md-1">
              
            </div>
          </div>
        </div>

        <div class="footer-widget-body">

          <?php 
          foreach ($footer_settings as $footer):
            ?>

            <div class="widget">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="text" class="form-control" name="widget_field_title[]" value="<?= $footer['title'] ?>">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <?php 
                    $options = array('6' => '1/6', '4' => '1/4','3' => '1/3','2' => '1/2',);
                    $others = array('class' => 'form-control');
                    echo form_dropdown('widget_field_column[]',$options,$footer['grid_column'],$others);
                    ?>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" name="widget_field_content[]"><?= $footer['content'] ?></textarea>
                  </div>
                </div>
                <div class="col-md-1">
                  <button type="button" class="btn btn-danger remove-footer-widget"><i class="fa fa-trash"></i></button>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-info btn-add-widget"><i class="fa fa-plus"></i> Add Widget</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Email Setting -->
<div role="tabpanel" class="tab-pane" id="email">
  <div class="form-group">
    <label class="control-label">Admin Email</label>
    <input type="text" class="form-control" name="admin_email" placeholder= "my-email@admin.com" value="<?php echo html_escape($general_settings['admin_email']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Email From/ Reply to</label>
    <input type="text" class="form-control" name="email_from" placeholder= "no-reply@domain.com" value="<?php echo html_escape($general_settings['email_from']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">SMTP Host</label>
    <input type="text" class="form-control" name="smtp_host" placeholder="SMTP Host" value="<?php echo html_escape($general_settings['smtp_host']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">SMTP Port</label>
    <input type="text" class="form-control" name="smtp_port" placeholder="SMTP Port" value="<?php echo html_escape($general_settings['smtp_port']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">SMTP User</label>
    <input type="text" class="form-control" name="smtp_user" placeholder="SMTP Email" value="<?php echo html_escape($general_settings['smtp_user']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">SMTP Password</label>
    <input type="password" class="form-control" name="smtp_pass" placeholder="SMTP Password" value="<?php echo html_escape($general_settings['smtp_pass']); ?>">
  </div>
</div>

<!-- Social Media Setting -->
<div role="tabpanel" class="tab-pane" id="social">
  <div class="form-group">
    <label class="control-label">Facebook</label>
    <input type="text" class="form-control" name="facebook_link" placeholder="" value="<?php echo html_escape($general_settings['facebook_link']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Twitter</label>
    <input type="text" class="form-control" name="twitter_link" placeholder="" value="<?php echo html_escape($general_settings['twitter_link']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Google Plus</label>
    <input type="text" class="form-control" name="google_link" placeholder="" value="<?php echo html_escape($general_settings['google_link']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Youtube</label>
    <input type="text" class="form-control" name="youtube_link" placeholder="" value="<?php echo html_escape($general_settings['youtube_link']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">LinkedIn</label>
    <input type="text" class="form-control" name="linkedin_link" placeholder="" value="<?php echo html_escape($general_settings['linkedin_link']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Instagram</label>
    <input type="text" class="form-control" name="instagram_link" placeholder="" value="<?php echo html_escape($general_settings['instagram_link']); ?>">
  </div>
</div>

<!-- Google reCAPTCHA Setting-->
<div role="tabpanel" class="tab-pane" id="reCAPTCHA">
  <div class="form-group">
    <label class="control-label">Site Key</label>
    <input type="text" class="form-control" name="recaptcha_site_key" placeholder="Site Key" value="<?php echo ($general_settings['recaptcha_site_key']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Secret Key</label>
    <input type="text" class="form-control" name="recaptcha_secret_key" placeholder="Secret Key" value="<?php echo ($general_settings['recaptcha_secret_key']); ?>">
  </div>
  <div class="form-group">
    <label class="control-label">Language</label>
    <input type="text" class="form-control" name="recaptcha_lang" placeholder="Language code" value="<?php echo ($general_settings['recaptcha_lang']); ?>">
    <a href="https://developers.google.com/recaptcha/docs/language" target="_blank">https://developers.google.com/recaptcha/docs/language</a>
  </div>
</div>

<div class="tab-pane" id="payments">
 <div class="row">
  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Paypal Sandbox</label>
      <?= form_dropdown('paypal_sandbox',array('1' => 'Enable', '0' => 'Disable'),$general_settings['paypal_sandbox'],'class="form-control"') ?>
    </div>
  </div>

  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Paypal Sandbox URL</label>
      <input type="text" class="form-control" name="paypal_sandbox_url" placeholder="Paypal Sandbox URL" value="<?php echo html_escape($general_settings['paypal_sandbox_url']); ?>">
    </div>
  </div>
  
  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Paypal Live URL</label>
      <input type="text" class="form-control" name="paypal_live_url" placeholder="Paypal Live URL" value="<?php echo html_escape($general_settings['paypal_live_url']); ?>">
    </div>
  </div>

  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Paypal Email</label>
      <input type="text" class="form-control" name="paypal_email" placeholder="Enter Paypal Email" value="<?php echo html_escape($general_settings['paypal_email']); ?>">
    </div>
  </div>

  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Client ID</label>
      <input type="text" class="form-control" name="client_id" placeholder="Enter Client ID" value="<?php echo html_escape($general_settings['paypal_client_id']); ?>">
    </div>
  </div>

  <div class="col-6">
    <div class="form-group">
      <label class="control-label">Status</label>
      <?= form_dropdown('paypal_status',array('1' => 'Enable', '0' => 'Disable'),$general_settings['paypal_status'],'class="form-control"') ?>
    </div>
  </div>
</div>

<hr />

<div class="row form-group">
  <div class="col-6">
    <label>STRIPE Payment Settings</label>
  </div>
  <div class="col-6">
    &nbsp;
  </div>
</div>

<div class="row form-group">
  <div class="col-6">
    <label>Secret Key</label>
    <input type="text" name="stripe_secret_key" value="<?=$general_settings['stripe_secret_key'] ;?>" class="form-control" placeholder="">
  </div>
  <div class="col-6">
    <label>Publishable Key</label>
    <input type="text" name="stripe_publish_key" value="<?=$general_settings['stripe_publish_key'] ;?>" class="form-control" placeholder="">
  </div>
</div>
</div>

</div>

<div class="box-footer">
  <input type="submit" name="submit" value="Save Changes" class="btn btn-info pull-right">
</div>	
<?php echo form_close(); ?>
</div>
</div>
</div>
</div>
</section>

<script>
  $("#setting").addClass('active');
  $('#myTabs a').click(function (e) {
   e.preventDefault()
   $(this).tab('show')
 })
</script>
