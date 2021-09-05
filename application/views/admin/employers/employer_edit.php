<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Employer</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/employer'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Employer List</a>
        </div>
        
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Employer</h3>
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

          <?php echo form_open(base_url('admin/employer/edit/'.$emp_info['id']), 'class=""' )?> 

          <div class="row">
            <h4>Personal Info</h4><hr/>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>First Name *</label>
                <input class="form-control" type="text" name="firstname" value="<?= $emp_info['firstname']; ?>" placeholder="John Wick">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Last Name *</label>
                <input class="form-control" type="text" name="lastname" value="<?= $emp_info['lastname']; ?>" placeholder="John Wick">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Email *</label>
                <input class="form-control" type="email" name="email" value="<?= $emp_info['email']; ?>" placeholder="example@example.com">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Designation *</label>
                <input class="form-control" type="text" name="designation" value="<?= $emp_info['designation']; ?>" placeholder="CEO">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Phone Number *</label>
                <input class="form-control" type="tel" name="mobile_no" value="<?= $emp_info['mobile_no']; ?>" placeholder="11 333 444">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Country *</label>
                <select name="country" class="country form-control">
                  <option>Select Country</option>
                  <?php foreach($countries as $country):?>
                    <?php if($emp_info['country'] == $country['id']): ?>
                      <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                      <?php else: ?>
                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                      <?php endif; endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>State *</label>
                    <?php 
                    $states = get_country_cities($emp_info['country']);
                    $options = array('' => 'Select State')+array_column($states, 'name','id');
                    echo form_dropdown('state',$options,$emp_info['state'],'class="form-control state" required');
                    ?>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>City *</label>
                    <?php 
                    $cities = get_country_cities($emp_info['state']);
                    $options = array('' => 'Select City')+array_column($cities, 'name','id');
                    echo form_dropdown('city',$options,$emp_info['city'],'class="form-control city" required');
                    ?>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Address *</label>
                    <input class="form-control" type="text" name="address" value="<?= $emp_info['address']; ?>" placeholder="">
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?> 
              
              <?php $attributes = array('id' => '', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
             <?php echo form_open_multipart('admin/employer/update_business/'.$emp_info['id'],$attributes);?>
              <div class="row">
                <h4>Business Info</h4><hr/>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <h5>Business Logo *</h5>
                    <?php if(!empty($business_info['business_logo'])): ?>
                      <p><img src="<?= base_url().$business_info['business_logo']; ?>" alt="Logo" height="50"></p>
                    <?php endif; ?>
                    <input type="file" name="userfile" class="form-control" placeholder="Business Name" />
                    <input type="hidden" name="old_logo" value="<?= $business_info['business_logo']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <h5>Business Name *</h5>
                    <input class="form-control" type="text" name="business_name" value="<?= $business_info['business_name']; ?>" placeholder="Business Name">
                    <!-- Hidden input for business ID-->
                    <input class="form-control" type="hidden" name="business_id" value="<?= $business_info['id']; ?>" placeholder="Business Name">
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <h5>Email *</h5>
                    <input type="email" name="email" value="<?= $business_info['email']; ?>"  class="form-control" placeholder="example@example.com">
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <h5>Phone *</h5>
                    <input class="form-control" type="tel" name="phone_no" value="<?= $business_info['phone_no']; ?>" placeholder="123456789">
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <h5>Website:</h5>
                    <input class="form-control" type="text" name="website" value="<?= $business_info['website']; ?>" placeholder="www.example.com" >
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <h5>Category *</h5>
                    <select class="form-control" name="category">
                      <option value="">Select Category</option>
                      <?php foreach($categories as $category):?>
                        <?php if($business_info['category'] == $category['id']): ?>
                          <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                          <?php else: ?>
                            <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                          <?php endif; endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Founded Date </h5>
                        <input type="date" name="founded_date" value="<?= $business_info['founded_date']; ?>" class="form-control" >
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Organization Type *</h5>
                        <select name="org_type"  class="form-control" >
                          <option value="Public" <?php if($business_info['org_type'] == 'Public'){ echo "selected";} ?>>Public</option>
                          <option value="Private" <?php if($business_info['org_type'] == 'Private'){ echo "selected";} ?>>Private</option>
                          <option value="Government" <?php if($business_info['org_type'] == 'Government'){ echo "selected";} ?>>Government</option>
                          <option value="NGO" <?php if($business_info['org_type'] == 'NGO'){ echo "selected";} ?>>NGO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>No. of Employers *</h5>
                        <select name="no_of_employers" class="form-control">
                          <option value="1-10" <?php if($business_info['no_of_employers'] == '1-10'){ echo "selected";} ?>>1-10</option>
                          <option value="10-20" <?php if($business_info['no_of_employers'] == '10-20'){ echo "selected";} ?>>10-20</option>
                          <option value="20-30" <?php if($business_info['no_of_employers'] == '20-30'){ echo "selected";} ?>>20-30</option>
                          <option value="30-50" <?php if($business_info['no_of_employers'] == '30-50'){ echo "selected";} ?>>30-50</option>
                          <option value="50-100" <?php if($business_info['no_of_employers'] == '50-100'){ echo "selected";} ?>>50-100</option>
                          <option value="100+" <?php if($business_info['no_of_employers'] == '100+'){ echo "selected";} ?>>100+</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <h5>Business Description *</h5>
                        <textarea name="description" class="form-control" id="" rows="5" placeholder="Nulla bibendum commodo rhoncus. Sed mattis magna nunc, ac varius quam pharetra vitae."><?= $business_info['description']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Country *</h5>
                        <select name="country" class="country form-control">
                          <option>Select Country</option>
                          <?php foreach($countries as $country):?>
                            <?php if($business_info['country'] == $country['id']): ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                              <?php else: ?>
                                <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                              <?php endif; endforeach; ?>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>State *</h5>
                        <?php 
                        $states = get_country_cities($business_info['country']);
                        $options = array('' => 'Select State')+array_column($states, 'name','id');
                        echo form_dropdown('state',$options,$business_info['state'],'class="form-control state" required');
                        ?>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>City *</h5>
                        <?php 
                        $cities = get_country_cities($business_info['state']);
                        $options = array('' => 'Select City')+array_column($cities, 'name','id');
                        echo form_dropdown('city',$options,$business_info['city'],'class="form-control city" required');
                        ?>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Postcode *</h5>
                        <input type="text" name="postcode" value="<?= $business_info['postcode']; ?>" class="form-control" placeholder="50700">
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <h5>Full Address *</h5>
                        <input type="text" name="address"  value="<?= $business_info['address']; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Facebook</h5>
                        <input type="text" name="facebook_link" value="<?= $business_info['facebook_link']; ?>"  class="form-control" placeholder="http://www.facebook.com">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Twitter</h5>
                        <input type="text" name="twitter_link" value="<?= $business_info['twitter_link']; ?>" class="form-control"  placeholder="http://www.twitter.com">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Google Plus</h5>
                        <input type="text" name="google_link" value="<?= $business_info['google_link']; ?>" class="form-control" placeholder="http://www.google-plus.com">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Youtube</h5>
                        <input type="text" name="youtube_link" value="<?= $business_info['youtube_link']; ?>" class="form-control"  placeholder="http://www.youtube.com">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Vimeo</h5>
                        <input type="text" name="vimeo_link" value="<?= $business_info['vimeo_link']; ?>" class="form-control"  placeholder="http://www.vimeo.com">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <h5>Linkedin</h5>
                        <input type="text" name="linkedin_link" value="<?= $business_info['linkedin_link']; ?>" class="form-control" placeholder="http://www.linkedin.com">
                      </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                      <div class="form-group">
                        <input type="submit" name="update" value="Update" class="btn btn-primary">
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>  
        </section>
