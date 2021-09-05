<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Employer</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/employer'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Employers List</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if($this->session->userdata('error')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?= $this->session->userdata('error') ;?>
          </div>
          <?php endif; ?>

        <?php echo form_open(base_url('admin/employer/add'), 'class=""');  ?> 
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>First Name *</label>
              <input type="text" name="firstname" class="form-control" placeholder="Enter your first name" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Last Name *</label>
              <input type="text" name="lastname" class="form-control" placeholder="Enter your last name" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Email *</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Password *</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" />
            </div>
          </div>
          <div class="col-lg-6">      
           <div class="form-group">
            <label>Confirm Password *</label>
            <input type="password" name="confirmpassword" class="form-control" placeholder="Enter your password again" />
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <h4>Business Information</h4>
          <hr />
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Business Name *</label>
            <input type="text" name="business_name" class="form-control" placeholder="" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Category *</label>
            <select class="form-control" name="category" id="">
              <option value="">Select category</option>
              <?php foreach($categories as $category):?>
                <option value="<?= $category['id']?>"><?= $category['name']?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Organization Type</label>
            <select class="form-control" name="org_type" id="org_type">
              <option value="Private">Private</option>
              <option value="Public">Public</option>
              <option value="Government">Government</option>
              <option value="NGO">NGO</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Country *</label>
            <select class="form-control country" name="country" required>
              <option>Select Country</option>
              <?php foreach($countries as $country):?>
                <option value="<?= $country['id']?>"><?= $country['name']?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">State *</label>
            <select class="form-control state" name="state" required>
              <option>Select State</option>
            </select>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">City *</label>
            <select class="form-control city" name="city" required>
              <option>Select City</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Postal Code *</label>
            <input type="text" name="postcode" class="form-control" placeholder="" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Address *</label>
            <input type="text" name="address" class="form-control" placeholder="" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" name="phone_no" class="form-control" placeholder="" />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Website</label>
            <input type="text" name="website" class="form-control" placeholder="" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Business Description</label>
            <textarea name="description" class="form-control" placeholder=""></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Register">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.box-body -->
  </div>
</div>
</div>  
</section> 
