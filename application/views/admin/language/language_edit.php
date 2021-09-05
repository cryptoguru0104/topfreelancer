<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Language</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/languages'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Languages List</a>
          <a href="<?= base_url('admin/languages/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Language</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php validation_errors(); ?>
          <?php echo form_open(base_url('admin/languages/edit/'.$language['lang_id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="lang_name" class="col-sm-2 control-label">Language Name</label>

                <div class="col-sm-9">
                  <input type="text" name="lang_name" value="<?= $language['lang_name']; ?>" class="form-control" id="language" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>

                <div class="col-sm-9">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($language['status'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($language['status'] == 0)?'selected': '' ?>>Inactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Language" class="btn btn-info pull-right">
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
  $("#language").addClass('active');
  </script>
