<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Industry</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/industry'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Industry List</a>
          <a href="<?= base_url('admin/industry/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Industry</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php validation_errors(); ?>
          <?php echo form_open(base_url('admin/industry/edit/'.$industry['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="industry_name" class="col-sm-2 control-label">industry Name</label>

                <div class="col-sm-9">
                  <input type="text" name="industry" value="<?= $industry['name']; ?>" class="form-control" id="industry" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Industry" class="btn btn-info pull-right">
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
  $("#industry").addClass('active');
  </script>