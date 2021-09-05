<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


<section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/include/_messages.php') ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i>&nbsp; Subscribers List</h4>
        </div>
        <div class="col-md-6 text-right">
          <button class="btn btn-success" data-toggle="modal" data-target="#subscriberModal"><i class="fa fa-list"></i> &nbsp;Compose Email</button>
        </div>
        
      </div>
    </div>
  </div>
  <div class="box box-default">
    <div class="box-body table-responsive">
      <table id="na_datatable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><input type="checkbox" class="all-subscribers-checkbox"></th>
            <th>Email</th>
            <th>Date</th>
            <th style="width: 150px;" >Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- Modal -->
<div id="subscriberModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Compose Email</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/newsletter/'));  ?> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <i class="fa fa-info-circle"></i> If you don't choose any recipeints then email will send to all subscribers
                </div>
            </div>
        </div>
        
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name" class="control-label">Subject</label>
                  <input type="text" name="title"  class="form-control" placeholder="Subject">
                  <input type="hidden" name="recipients" class="subscriber-recipients" value="all">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name" class="control-label">Content</label>
                  <textarea name="content" class="textarea form-control" rows="10"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="submit" name="submit" value="Send Email" class="btn btn-primary pull-right ml-5">
                &nbsp;&nbsp;
                <input type="button" value="Preview" class="btn btn-warning pull-right" id="btn_preview_email">
              </div>
            </div>
          </div>
        <?php echo form_close( ); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

  </div>

<!-- DataTables -->
<script src="<?php echo base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable({
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('admin/newsletter/subscribers_datatable_json')?>",
    "columnDefs": [
    { "targets": 0, "name": "checkbox", 'searchable':false, 'orderable':false},
    { "targets": 1, "name": "email", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "created_at", 'searchable':false, 'orderable':false},
    { "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,'width':'150px'}
    ]
  });
</script>
<script>
  $(function () {

    // 
    $('.all-subscribers-checkbox').on('click',function(){
      if($(this).is(':checked'))
      {
        $('.subscriber-checkbox').prop('checked',true);
        $('input[name=recipients]').val('all');
      }
      else
      {
        $('.subscriber-checkbox').prop('checked',false);
        $('input[name=recipients]').val('all');
      }
    });

    $('.subscriber-checkbox').on('click',function(){
      if($('.subscriber-checkbox:checked').length == $('.subscriber-checkbox').length)
      {
        $('.all-subscribers-checkbox').prop('checked',true);
        $('input[name=recipients]').val('all');
      }
      else
      {
        $('.all-subscribers-checkbox').prop('checked',false);
        var checkedVals = $('.subscriber-checkbox:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $('input[name=recipients]').val(checkedVals.join(","));
      }
    });

    // Preview Email
    $('#btn_preview_email').on('click',function(){
      $.post('<?=base_url("admin/newsletter/email_preview")?>',
      {
        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
        head : $('input[name=title]').val(),
        content : $('.textarea').val(),
      },
      function(data){
        var w = window.open();
        w.document.open();
        w.document.write(data);
        w.document.close();
      });
    });
  })
</script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    });
   })
</script>
<script>
$("#newsletter").addClass('active');
</script>

