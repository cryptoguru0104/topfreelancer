<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Job Type</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/job_type'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Job Type List</a>
          <a href="<?= base_url('admin/job_type/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Job Type</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php validation_errors(); ?>
          <?php echo form_open(base_url('admin/job_type/edit/'.$type['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="job_type_name" class="col-sm-2 control-label">Job Type Name</label>

                <div class="col-sm-9">
                  <input type="text" name="type" value="<?= $type['type']; ?>" class="form-control" id="job_type" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Type" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 


<script>
  $("#job_type").addClass('active');
  </script>