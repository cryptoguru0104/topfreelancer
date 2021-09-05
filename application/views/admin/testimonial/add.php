<section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/include/_messages.php') ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Add Testimonial</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/testimonial'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Testimonials List</a>
        </div>
        
      </div>
    </div>
  </div>

  <div class="box box-default">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <!-- form start -->
          <?php echo validation_errors(); ?>           
          <?php echo form_open_multipart(base_url('admin/testimonial/add'), 'class="form-horizontal"');  ?> 
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Testimonial By</label>
              <div class="col-sm-9">
                <input type="text" name="testimonial_by" class="form-control" placeholder="Testimonial By">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Testimonial</label>
              <div class="col-sm-9">
                <textarea name="testimonial" class="form-control" rows="6" placeholder="Testimonial"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Business and Designation</label>
              <div class="col-sm-9">
                <input type="text" name="about" class="form-control" placeholder="Business and Designation">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">User Image</label>
              <div class="col-sm-9">
                <input type="file" name="photo" class="form-control" >
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Is default?</label>
              <div class="col-sm-9">
                <?php 
                  $options =  array('0' => 'No', '1' => 'Yes');
                  echo form_dropdown('default',$options,'','class="form-control select2"');
                ?>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Is Active?</label>
              <div class="col-sm-9">
                <?php 
                  $options =  array('1' => 'Yes', '0' => 'No');
                  echo form_dropdown('status',$options,'','class="form-control select2"');
                ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-11">
                <input type="submit" name="submit" value="Add Testimonial" class="btn btn-info pull-right">
              </div>
            </div>
          <?php echo form_close( ); ?>
        </div>
        <!-- /form -->
      </div>
    </div>  
  </div>
</section> 
<script>
  $("#testimonial").addClass('active');
</script>
