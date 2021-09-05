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
          <h4><i class="fa fa-list"></i> &nbsp; Payment List</h4>
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
          <th>ID</th>
          <th>TXN ID</th>
          <th>Package Name</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Payment Mode</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach($payment_detail as $row): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $row['txn_id'] ?></td>
              <td><?= get_pkg_name($row['purchased_plan']) ?></td>
              <td><?= $row['payment_amount'] ?></td>
              <td><?= date_time($row['payment_date']) ?></td>
              <td><?= $row['payment_method'] ?></td>
              <td><?= $row['payment_status'] ?></td>
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
  $("#payment").addClass('active');
  </script>

