
<!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Users</span>
              <span class="info-box-number"><?= $all_users; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-shield"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Users</span>
              <span class="info-box-number"><?= $active_users; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-window-close"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Deactive Users</span>
              <span class="info-box-number"><?= $deactive_users; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Vacancies</span>
              <span class="info-box-number"><?= $total_jobs; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-envelope"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Messages</span>
              <span class="info-box-number"><?= $all_employers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-globe"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Countries</span>
              <span class="info-box-number"><?= $total_countries; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total eConsultant</span>
              <span class="info-box-number"><?= $deactive_employers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-window-close"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Expired Jobs</span>
              <span class="info-box-number"><?= $expired_jobs; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
         

          <!-- TABLE: LATEST USERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Users</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin" style="font-size: 13px;">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Nationality</th>
                    <th>Workstation</th>
                    <th>LinkedIn</th>
                    <th>Link</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($latest_users as $row): ?>
                    <tr>
											<td><a href="#"><?= $row['user_id']; ?></a></td>
                      <td><a href="#"><?= $row['firstname']. ' '.$row['lastname'] ; ?></a></td>
                      <td><p><?= $row['email']; ?></td>
                      <td><?= $row['mobile_no']; ?></td>
											<td><?= get_country_name($row['country']); ?></td>
											<td><?= get_city_name($row['city']); ?></td>
											<td><?= get_country_name($row['nationality']); ?></td>
											<td><?= get_employment_type($row['employment']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="<?= base_url('admin/users'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <!-- PRODUCT LIST -->
           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Jobs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin" style="font-size: 13px;">
                  <thead>
                  <tr>
                    <th>Business</th>
                    <th>Title</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($latest_jobs as $row): ?>
                    <tr>
                      <td><a href="#"><?= $row['business_name'] ; ?></a></td>
                      <td><p><?= $row['title']; ?></td>
                      <td><span class="label label-success"><?= ucfirst($row['publish_vacancy']); ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="<?= base_url('admin/job'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Jobs</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<!-- Sparkline -->
<script src="<?= base_url() ?>public/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url() ?>public/plugins/chartjs/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>public/dist/js/demo.js"></script>

<script>
  $("#dashboard1").addClass('active');
</script>
