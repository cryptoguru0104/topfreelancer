  
 <section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Degree List</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/education/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Degree</a>
        </div>
        
      </div>
    </div>
  </div>

   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Degree Name</th>
          <th style="width: 150px;" class="text-right">Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $count=0; foreach($all_educations as $row):?>
          <tr>
            <td><?= ++$count; ?></td>
            <td><?= $row['type']; ?></td>
            <td><a title="Delete" class="btn-delete btn btn-sm btn-danger pull-right '.$disabled.'" href="<?= base_url('admin/education/del/'.$row['id']); ?>" > <i class="fa fa-trash-o"></i></a>
            <a title="Edit" class="update btn btn-sm btn-primary pull-right" href="<?= base_url('admin/education/edit/'.$row['id'])?>"> <i class="fa fa-pencil-square-o"></i></a>
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


  <!-- Scripts for this page -->
  <!-- Scripts for this page -->
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
    $("#misc").addClass('active');
  </script>

