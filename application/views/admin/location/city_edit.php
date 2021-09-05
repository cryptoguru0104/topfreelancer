<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Edit City</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/location/city/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New City</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box border-top-solid">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
            <?php echo validation_errors(); ?>           
            <?php echo form_open(base_url('admin/location/city/edit/'.$city['id']), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Country</label>
                <div class="col-sm-7">
                  <select class="form-control" required name="country">
                      <option value="<?= $city['country_id']; ?>"> <?= get_country_name($city['country_id']); ?> </option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">City Name</label>
                <div class="col-sm-7">
                  <input type="text" name="city" class="form-control" value="<?= $city['name']; ?>" id="name" placeholder="City name" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-10">
                  <input type="submit" name="submit" value="Update City" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 


<script>
  $("#country").addClass('active');
  </script>
