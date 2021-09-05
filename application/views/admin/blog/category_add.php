<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Blog Category</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/blog/category'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Category List</a>
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
            <?php echo form_open(base_url('admin/blog/category/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Category Name</label>
                <div class="col-sm-7">
                  <input type="text" name="category" class="form-control" id="category" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-10">
                  <input type="submit" name="submit" value="Add Category" class="btn btn-info pull-right">
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
  $("#category").addClass('active');
  </script>