<section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box box-body">
            <div class="col-md-6">
              <h4><i class="fa fa-list"></i> &nbsp; Employers/ Business</h4>
          </div>
          <div class="col-md-6 text-right">
              <a href="<?= base_url('admin/employer/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Employer</a>
          </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php if ($this->session->flashdata('success')) :?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong><?=$this->session->flashdata('success')?></strong> 
                </div>
            <?php endif;?>

            <section  class="panel" id="advanced_search">
                <div class="panel-body">
                    <h4 class="head3" style="display: inline-block;">Advance Search</h4> 
                    <hr style="margin:5px 0px;" />
                    <?php echo form_open("/",'id="employer_search"') ?>
                    <div class="col-md-4">
                        <label>Date From:</label><input name="employer_search_from" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
                    </div>
                    <div class="col-md-4"> 
                        <label>Date To:</label><input name="employer_search_to" type="text" class="form-control form-control-inline input-medium hr_datepicker" /> 
                    </div>
                    <div class="col-md-2"> 
                        <button type="button" style="margin-top:20px;" onclick="employer_filter()" class="btn btn-info">Submit</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </section>

            <section class="panel">
                <div class="panel-body">
                    <div class="adv-table">
                        <table  id="na_datatable" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Business Name</th>
                                    <th>Email</th>
                                    <th>Employer Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- page end-->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
//---------------------------------------------------
var table = $('#na_datatable').DataTable( {
  "processing": true,
  "serverSide": true,
  "ajax": "<?=base_url('admin/employer/datatable_json')?>",
  "order": [[1,'desc']],
  "columnDefs": [
  { "targets": 0, "name": "", 'searchable':false, 'orderable':false},
  { "targets": 1, "name": "business_name", 'searchable':true, 'orderable':true},
  { "targets": 2, "name": "email", 'searchable':true, 'orderable':true},
  { "targets": 3, "name": "firstname", 'searchable':true, 'orderable':true},
  { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'130px'}
  ]
});
//---------------------------------------------------
function employer_filter()
{
	$.post('<?=base_url('admin/employer/search')?>',$('#employer_search').serialize(),function(){
		table.ajax.reload( null, false );
	});
}

</script>

<script>
    $('#employer').addClass('active');
</script>
