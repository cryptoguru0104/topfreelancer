<div class="row">
  <div class="col-lg-12">
    <?php if ($this->session->flashdata('success')) :?>
    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <strong>
      <?=$this->session->flashdata('success')?>
      </strong> 
    </div>
    <?php endif;?>

    <section  class="panel">
      <div class="panel-body">
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Jobs</strong></h4> 
          <div class="button-inline pull-right">
              <a href="<?= base_url('admin/job/post')?>" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New Job</a>
          </div>
      </div>
    </section>

    <section  class="panel" id="advanced_search">
        <div class="panel-body">
          <h4 style="display:inline-block;">Advance Search</h4>
          <hr style="margin:5px 0px;" />
        </div>
        <div class="panel-body">
          <?php echo form_open("/",'id="job_search"') ?> 
          <div class="col-md-2">
            <label>Experience:</label>
            <select onchange="job_filter()" name="job_search_experience" class="form-control">
              <option value=""> --Select--</option>
              <?php   foreach ($experiences as $experience): ?>
              <option value="<?php echo $experience['id']; ?>"> <?php echo $experience['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Nationality:</label>
            <select onchange="job_filter()" name="job_search_nationality"  class="form-control">
              <option value=""> --Select--</option>
              <?php   foreach ($countries as $nationality): ?>
              <option value="<?php echo $nationality['id']; ?>"> <?php echo $nationality['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Location:</label>
            <select onchange="job_filter()" name="job_search_location"  class="form-control">
              <option value=""> --Select--</option>
              <?php   foreach ($countries as $location): ?>
              <option value="<?php echo $location['id']; ?>"> <?php echo $location['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Date From:</label>
            <input name="job_search_from" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-2">
            <label>Date To:</label>
            <input name="job_search_to" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-2 text-right">
            <button type="button" style="margin-top:20px;" onclick="job_filter()" class="btn btn-info">Submit</button>
            <a href="<?= base_url('admin/job'); ?>" class="btn btn-danger" style="margin-top:20px;">
              <i class="fa fa-repeat"></i>
            </a>
          </div>
          <?php echo form_close(); ?>
        </div>
    </section>
    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Jobs</h4>
        </div>
        <div class="adv-table">
          <table  class="mv_datatable display table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Title</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- page end--> 
<script src="<?php echo base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
//---------------------------------------------------
	var table =	$('.mv_datatable').DataTable( {
			"processing": true,
			"serverSide": true,
			"pageLength": 25,
			"ajax": "<?=base_url('admin/job/datatable_json')?>",
			"order": [[5,'desc']],
			"columnDefs": [
			  { "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
				{ "targets": 1, "name": "title", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 2, "name": "country", 'searchable':false, 'orderable':false},
        { "targets": 3, "name": "created_date", 'searchable':true, 'orderable':true},
				{ "targets": 4, "name": "publish_vacancy", 'searchable':true, 'orderable':true},
			]
		});
		
	//---------------------------------------------------
	function job_filter()
	{
		$.post('<?=base_url('admin/job/search')?>',$('#job_search').serialize(),function(){
			table.ajax.reload( null, false );
		});
	}
	job_filter();
	//----------------------------------------------------------------				
</script>
<script>
    $('li#jobs').addClass('active');
</script>
