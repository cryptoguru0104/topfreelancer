<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">   

<section class="content">

  <!-- For Messages -->
  <?php $this->load->view('admin/include/_messages.php') ?>
  
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Testimonials</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/testimonial/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Testimonial</a>
        </div>
        
      </div>
    </div>
  </div>

  <div class="box border-top-solid">
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Testimonial By</th>
          <th>Testimonial</th>
          <th>Status</th>
          <th style="width: 150px;" >Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $count=0; foreach($testimonials as $row):?>
          <tr>
            <td><?= ++$count; ?></td>
            <td><?= $row['testimonial_by']; ?></td>
            <td><?= $row['testimonial']; ?></td>
            <td><span class="btn btn-success btn-xs"><?= ($row['status'] == 1)? 'Active' : 'Inactive'; ?></span></td>
            <td>
            <a title="Edit" class="btn btn-warning btn-xs mr5" href="<?= base_url('admin/testimonial/edit/'.$row['id'])?>"> <i class="fa fa-pencil-square-o"></i></a>
            <a title="Delete" class="btn btn-danger btn-xs '.$disabled.'" onclick="return confirm('are you sure to delete?')" href="<?= base_url('admin/testimonial/del/'.$row['id']); ?>" > <i class="fa fa-remove"></i></a>
            
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

  <!-- DataTables -->

<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(function () {
  $("#example1").DataTable();
});
</script>
<script>
$("#testimonial").addClass('active');
</script>
