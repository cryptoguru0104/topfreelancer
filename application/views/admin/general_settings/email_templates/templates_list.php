<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- Content Wrapper. Contains page content -->
<section class="content">
	<!-- For Messages -->
	<?php $this->load->view('admin/include/_messages.php') ?>
	<div class="row">
	    <div class="col-md-12">
            
	      <div class="box box-body">
	        <div class="col-md-6">
	          <h4><i class="fa fa-list"></i>&nbsp; Email Templates Settings</h4>
	        </div>
	      </div>
	    </div>
  	</div>
	<div class="box">
		<div class="box-body">
			<div class="row">
			    <!-- Message -->
			    <div class="template-alert-block"></div>

				<div class="col-md-3">
					<table class="table table-bordered table-hover templates-table text-center">
						<thead>
							<tr>
								<th style="background:#000; color:#fff; font-size:1.2em">Email Templates</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($templates as $row): ?>
							<tr>
								<td class="btn-template-link" data-type="<?= $row['id'] ?>">
									<span class="btn-template-link" data-type="<?= $row['id'] ?>" ><?= $row['name'] ?></span>
								</td>
							</tr>
							<?php  endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-9 template-wrapper">
					<div class="template-body empty-template text-center">
						<p>Select a Template</p>
					</div>
					<!-- form start -->
		            <?php echo validation_errors(); ?>           
		            <?php echo form_open(base_url('admin/general_settings/email_templates'), 'class="form-horizontal template-form"');  ?> 
					<div class="template-body non-empty-template hidden">
						<div class="row">
							<div class="col-md-12">
							    <div class="form-group">
					                <div class="col-md-12">
					                  <input type="text" name="subject" class="form-control" placeholder="Email Subject">
					                </div>
				                </div>
				             	<div class="form-group">
					                <div class="col-md-12">
					                  <textarea name="content" class="textarea form-control" rows="10"></textarea>
					                </div>
				              	</div>
				              	<div class="form-group">
					                <div class="col-md-12">
					                	<label>Variables</label>
					                  	<input type="text" name="variables" class="form-control" placeholder="Template's Variables"  disabled>
					                </div>
			                	</div>
				                <div class="form-group">
					                <div class="col-md-12">
					                  <input type="hidden" name="template_id">
					                  <input type="submit" name="submit" value="Save Template" class="btn btn-primary pull-right ml-5">
					                  <input type="button" value="Preview" class="btn btn-warning pull-right" id="btn_preview_email">
					                </div>
					            </div>
					        </div>
						</div>
					</div>
		            <?php echo form_close( ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    });

    //  get email template content
    $('.btn-template-link').on('click',function(){
    	$this = $(this);
    	$('.empty-template').addClass('hidden');
    	$('.non-empty-template').removeClass('hidden');

	    $.post('<?=base_url("admin/general_settings/get_email_template_content_by_id")?>',
		{
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				template_id : $this.data('type'),
		},
		function(data){
			obj = JSON.parse(data);
			template = obj['template'];
			variables = obj['variables'];

			$('input[name=subject]').val(template.subject);
			$('input[name=template_id]').val(template.id);
			$('input[name=variables]').val(variables);
			$('iframe').contents().find('.wysihtml5-editor').html(template.body);
		});
    });
    // 

    //  update email template content
    $('.template-form').on('submit',function(){
    	event.preventDefault();
	    $.post('<?=base_url("admin/general_settings/email_templates")?>',
		{
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				id : $('input[name=template_id]').val(),
				subject : $('input[name=subject]').val(),
				content : $('iframe').contents().find('.wysihtml5-editor').html(),
		},
		function(data){
		    $('.template-alert-block').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>\
                  Template Updated Successfully</div>');
			$('.template-alert-block').removeClass('hidden');
		});
    });
    // 

     // Preview Email
    $('#btn_preview_email').on('click',function(){
      $.post('<?=base_url("admin/general_settings/email_preview")?>',
      {
        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
        head : $('input[name=subject]').val(),
        content : $('.textarea').val(),
      },
      function(data){
        var w = window.open();
        w.document.open();
        w.document.write(data);
        w.document.close();
      });
    });
  })
</script>
<script>
  $("#setting").addClass('active');
</script>
