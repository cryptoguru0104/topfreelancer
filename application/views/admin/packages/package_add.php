<!-- bootstrap datepicker -->

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">



<section class="content">

  <div class="row">

    <div class="col-md-12">

        <?php if(isset($msg) || validation_errors() !== ''): ?>

              <div class="alert alert-warning alert-dismissible">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                  <?= validation_errors();?>

                  <?= isset($msg)? $msg: ''; ?>

              </div>

        <?php endif; ?>

    </div>

  </div>

  



  <div class="row">

    <div class="col-md-12">

      <div class="box box-body">

        <div class="col-md-6">

          <h4><i class="fa fa-plus"></i> &nbsp; Add New Package</h4>

        </div>

        <div class="col-md-6 text-right">

          <a href="<?= base_url('admin/packages'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Package List</a>

        </div>

        

      </div>

    </div>

  </div>  



  <div class="row">

    <?php echo form_open( base_url('admin/packages/add')); ?>

    <div class="col-md-12">

      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Package Detail</h3>

        </div>

        <!-- /.box-header -->

        <!-- form start -->

        <div class="box-body my-form-body">



            <div class="form-group">

              <label for="title" class="control-label">Package Title</label>

              <input type="text" name="title" class="form-control" id="title" value="" placeholder="eg. basic, premium" required>

            </div>

            

            <div class="form-group">

              <label for="days" class="control-label">Price</label>

              <input type="price" name="price" class="form-control" id="" value="" placeholder="" required>

            </div>



            <div class="form-group">

              <label for="days" class="control-label">No of Days</label>

              <input type="number" name="no_of_days" class="form-control" id="" value="" placeholder="" required>

            </div>



            <div class="form-group">

              <label for="posts" class="control-label">No of Posts</label>

              <input type="number" name="no_of_posts" class="form-control" id="" value="" placeholder="" required>

            </div>



            <div class="form-group">

              <label for="posts" class="control-label">Package Detail</label>

              <input type="text" name="detail" class="form-control" id="" value="" placeholder="" required>

            </div>

            <div class="form-group">

              <label for="posts" class="control-label">Sort Order</label>

              <input type="number" name="sort_order" class="form-control" id="" value="" placeholder="">

            </div>



            <div class="form-group">

              <label for="package_for" class="control-label">Package For</label>

              <select name="package_for" class="form-control">

                <option value="1">Employer</option>

              </select>

            </div>



          </div>

          <!-- /.box-body -->

      </div>

    </div>



    <div class="col-md-12">

      <div class="box">

        <div class="box-body">

          <input type="submit" name="submit" value="Add Package" class="btn btn-primary pull-right">

        </div>

      </div>

    </div>



  </div>





    <?php echo form_close(); ?>



</section> 







  <script>

    $('#packages').addClass('active');

  </script>



 