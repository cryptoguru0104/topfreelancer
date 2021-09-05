  
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Packages</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/packages/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Package</a>
        </div>
        
      </div>
    </div>
  </div> 

   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="na_datatable" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
          <th>#ID</th>
          <th>Package Title</th>
          <th>Price</th>
          <th>No. of Days</th>
          <th>No. of Posts</th>
          <th>Package For</th>
          <th>Status</th>
          <th style="width: 150px;" class="text-right">Action</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($packages as $package): ?>
            <tr>
              <td><?= $package['id']; ?></td>
              <td><?= $package['title']; ?></td>
              <td><?= $package['price']; ?></td>
              <td><?= $package['no_of_days']; ?></td>
              <td><?= $package['no_of_posts']; ?></td>
              <td><?= ($package['package_for'] == 0)? '<span class="btn btn-primary btn-xs">JobSeeker</span>' : '<span class="btn btn-primary btn-xs">Employer</span>' ?></td>
              <td><?= ($package['is_active'] == 1)? '<span class="btn btn-success btn-xs">Active</span>' : '<span class="btn btn-warning btn-xs">Inactive'; ?></td>
              <td class="text-right"><a class="btn btn-info btn-xs" href="<?= base_url('admin/packages/edit/'.$package['id']); ?>">Edit</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  
 