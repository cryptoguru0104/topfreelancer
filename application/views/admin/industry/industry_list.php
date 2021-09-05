 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">   
  
 <section class="content">
   <div class="row">
    <div class="col-md-12">
       <?php if($this->session->flashdata('success')):?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Job Industries</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/industry/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New industry</a>
        </div>
        
      </div>
    </div>
  </div>

   <div class="box border-top-solid">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Industry Name</th>
          <th>Status</th>
          <th style="width: 150px;" class="text-right">Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $count=0; foreach($industries as $row):?>
          <tr>
            <td><?= ++$count; ?></td>
            <td><?= $row['name']; ?></td>
             <td><?= ($row['status'] == 1)? '<span class="btn btn-success btn-xs">Active</span>': '<span class="btn btn-success btn-xs">Inactive</span>'; ?></td>
            <td><a title="Delete" class="btn-delete btn btn-sm btn-danger pull-right '.$disabled.'" href="<?= base_url('admin/industry/del/'.$row['id']); ?>" > <i class="fa fa-trash-o"></i></a>
            <a title="Edit" class="update btn btn-sm btn-primary pull-right" href="<?= base_url('admin/industry/edit/'.$row['id'])?>"> <i class="fa fa-pencil-square-o"></i></a>
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

 <script type="text/javascript">
     $(document).ready(function(){
      $(".btn-delete").click(function(){
        if (!confirm("Do you want to delete")){
          return false;
        }
      });
    });
  </script>

  <!-- DataTables -->
  <script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
  $(function () {
    $("#example1").DataTable();
  });
	</script>
  <script>
  $("#industry").addClass('active');
  </script>

