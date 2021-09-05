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
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Posts</strong></h4> 
          <div class="button-inline pull-right">
              <a href="<?= base_url('admin/blog/post')?>" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New Post</a>
          </div>
      </div>
    </section>

    <section  class="panel" id="advanced_search">
        <div class="panel-body">
          <h4 style="display:inline-block;">Advance Search</h4>
          <hr style="margin:5px 0px;" />
        </div>
        <div class="panel-body">
          <?php echo form_open("/",'id="blog_search"') ?> 
          <div class="col-md-3">
            <label>Category:</label>
            <select onchange="post_filter()" name="post_search_category"  class="form-control ">
              <option value=""> --Select--</option>
              <?php   foreach ($categories as $category): ?>
              <option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Date From:</label>
            <input name="post_search_from" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-3">
            <label>Date To:</label>
            <input name="post_search_to" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-2 text-right">
            <button type="button" style="margin-top:20px;" onclick="post_filter()" class="btn btn-info">Submit</button>
            <a href="<?= base_url('admin/blog'); ?>" class="btn btn-danger" style="margin-top:20px;">
              <i class="fa fa-repeat"></i>
            </a>
          </div>
          <?php echo form_close(); ?>
        </div>
    </section>

    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Posts</h4>
        </div>
        <div class="adv-table">
          <table  id="na_datatable"  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Image</th>
                <th>Title</th>
                <th>Keywords</th>
                <th>Category</th>
                <th>Published Date</th>
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
	var table =	$('#na_datatable').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?=base_url('admin/blog/datatable_json')?>",
			"order": [[5,'desc']],
			"columnDefs": [
			  { "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
        { "targets": 1, "name": "image_default", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 2, "name": "title", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 3, "name": "keywords", 'searchable':true, 'orderable':true},
				{ "targets": 4, "name": "category_id", 'searchable':true, 'orderable':true},
        { "targets": 5, "name": "created_at", 'searchable':true, 'orderable':true},
				{ "targets": 6, "name": "action", 'searchable':false, 'orderable':false,'width':'130px'}
			]
		});
		
	//---------------------------------------------------
	function post_filter()
	{
		$.post('<?=base_url('admin/blog/search')?>',$('#blog_search').serialize(),function(){
			table.ajax.reload( null, false );
		});
	}
	post_filter();
	//----------------------------------------------------------------				
</script>
<script>
    $('li#blog').addClass('active');
</script>