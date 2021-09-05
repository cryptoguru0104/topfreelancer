<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Country</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/location'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Country List</a>
          <a href="<?= base_url('admin/location/country/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Country</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php validation_errors(); ?>
          <?php echo form_open(base_url('admin/location/country/edit/'.$country['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="country_name" class="col-sm-2 control-label">Country Name</label>

                <div class="col-sm-9">
                  <input type="text" name="country" value="<?= $country['name']; ?>" class="form-control" id="country" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>

                <div class="col-sm-9">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($country['status'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($country['status'] == 0)?'selected': '' ?>>Inactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update country" class="btn btn-info pull-right">
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
  $("#country").addClass('active');
  </script>