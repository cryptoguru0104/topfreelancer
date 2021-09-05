<script type="text/javascript">

var base_url = '<?php echo base_url(); ?>';
var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

//-------------------------------------------------------------------
// Country & City Change
  $(document).on('change','.country',function()
  {
    var data =  {
      country : this.value,
    }
    data[csfr_token_name] = csfr_token_value;

    $.ajax({
      type: "POST",
      url: "<?= base_url('account/get_country_cities') ?>",
      data: data,
      dataType: "json",
      success: function(obj) {
        $('.city').html(obj.msg);
     },

    });

  });

  $(document).on('change','.city',function()
  {
    var data =  {
      city : this.value,
    }
    data[csfr_token_name] = csfr_token_value;
    $.ajax({
      type: "POST",
      url: "<?= base_url('account/get_country_cities') ?>",
      data: data,
      dataType: "json",
      success: function(obj) {
        $('.city').html(obj.msg);
     },

    });

  });

//-------------------------------------------------------------------
// Delete Confirm Dialogue box
$(document).ready(function(){
  $(".btn-delete").click(function(){
    if (!confirm("Are you sure? you want to delete")){
      return false;
    }
  });
});

// ---------------------------------------------------
// Close Degree collapse
  $(document).on('click',".close_all_collapse",function(){
    $(".collapse").collapse('hide');
  });

// -------------------------------------------
// Edit user education
$(document).on('click','.edit-education',function(){
  var data = {
    edu_id : $(this).data('edu_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_education_by_id',
    data: data,
    success: function (response) {
      $('#user-education-edit').html(response);
      $('#user-education-edit').collapse('show');
    }

  });
});

// -------------------------------------------
// Edit user language
$(document).on('click','.edit-language',function(){
  var data = {
    lang_id : $(this).data('lang_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_language_by_id',
    data: data,
    success: function (response) {
      $('#user-language-edit').html(response);
      $('#user-language-edit').collapse('show');
    }

  });
});

//-------------------------------------
// 
// -------------------------------------------
// Edit user language
$(document).on('click','.edit-experience',function(){
  var data = {
    exp_id : $(this).data('exp_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_experience_by_id',
    data: data,
    success: function (response) {
      $('#user-experience-edit').html(response);
      $('#user-experience-edit').collapse('show');
    }

  });
});

//-------------------------------------------
// current working or not
$(document).on('click','.currently_working_here',function(){
  $this = $(this);
  if($this.is(':checked'))
    $('.exp-end-field').addClass('hidden');
  else
    $('.exp-end-field').removeClass('hidden');
});

//------------------------------------------------------------
// Saved Job as Favorite
$(document).on('click', '.saved_job', function(){
  
  var data = {
    job_id : $(this).data('job_id'),
  }
  data[csfr_token_name] = csfr_token_value;

  $.ajax({
    type: 'POST',
    url: base_url + 'myjobs/save_job',
    data: data,
    success: function (response) {
      console.log(response);
      if($.trim(response) == "not_login"){
       $.notify("Alert! Please login first", "danger");
      }
      if($.trim(response) == "already_saved"){
         $.notify("Alert! Job is already saved.", "danger");
      }
      if($.trim(response) == "saved"){
        $.notify("job has been saved Successfully", "success");
      }
    }

  });

}); // end save job

// shortlisted profile
$('.get_shortlisted_user_profile').on('click',function(){
  var data = {
    user_id : $(this).data('user'),
  }
  data[csfr_token_name] = csfr_token_value;

  $.ajax({
      data: data,
      type: 'POST',
      url: '<?php echo base_url();?>employers/applicants/get_shortlisted_user_profile',
      success: function(response){
        $('.shortlisted-profile-modal-body').html(response);
        $('#profileModal').modal('show');
      }
  });
  e.preventDefault();

});

//-------------------------------------------------------------------
// Sending Email to applicant

 $('#emailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #email').val(recipient);

    var send_email = $(this).find('.send_email');

    send_email.click(function(e) {

      var _form = $(".email-form").serialize();
      $.ajax({
          data: _form,
          type: 'POST',
          url: '<?php echo base_url();?>employers/applicants/email',
          success: function(response){
            $(this).removeData('bs.modal');
            $.notify("Email has been sent Successfully", "success");
            $('.close').trigger('click');
          }
      });
      e.preventDefault();
    }); 

    $(this).on('hide.bs.modal', function() {
      send_email.off('click');
      $(this).find('form').trigger('reset');
    });
    
  }); // end email function

/* Footer Widget Script */

// Remove Widget
$(document).on('click','.remove-footer-widget',function()
{
  a = confirm('are you sure?');
  (a) ? $(this).closest('div.widget').remove() : '';
    
});

// Remove Slide
$(document).on('click','.remove-slider-slide',function()
{
  a = confirm('are you sure?');
  (a) ? $(this).closest('div.slide').remove() : '';
    
});

//Show Profile Image on Upload
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#profilepic').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#profilepicupload").change(function() {
  readURL(this);
});

// Add new widget
$('.btn-add-widget').on('click',function()
{
widget = '<div class="widget">\
    <div class="row">\
        <div class="col-md-3">\
          <div class="form-group">\
            <input type="text" class="form-control" name="widget_field_title[]" >\
          </div>\
        </div>\
        <div class="col-md-2">\
        <div class="form-group">\
        <select class="form-control" name="widget_field_column[]">\
        <option value="4">1/4</option>\
        <option value="3">1/3</option>\
        <option value="2">1/2</option>\
        </select>\
        </div>\
        </div>\
        <div class="col-md-6">\
          <div class="form-group">\
            <textarea class="form-control" name="widget_field_content[]"></textarea>\
          </div>\
        </div>\
        <div class="col-md-1">\
            <button type="button" class="btn btn-danger remove-footer-widget"><i class="fa fa-trash"></i></button>\
        </div>\
    </div>\
</div>';

$('.footer-widget-body').append(widget);
});

// Add New Slide
$('.btn-add-slide').on('click',function()
{

widget = '<div class="slide ">\
	<div class="form-group">\
  <input type="hidden" name="id" value="" />\
  <input type="hidden" name="imageUpload" value="" />\
  <div class="row"><div class="col-md-12"><div class="mycss1"></div></div></div>\
		<div class="col-md-6">\
			<div class="box-file">\
        <label for="profilepicupload">\
                      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>\
                      <input type="file" value="" id="profilepicupload" accept="image/*" name="image[]" class="filePhoto" style="display :none" /> Choose Image\
        </label>\
					<p class="help-block">Recommended Size 1600x900 px (JPG)</p>\
			</div>\
			<div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">\
					<i class="glyphicon glyphicon-paperclip myicon-right"></i>\
					<small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-image btn pull-right" title="Delete"></i>\
			</div>\
		</div>\
		<div class="col-md-6">\
			<div id="slider_title">\
					<input type="text" class="form-control" name="title[]" placeholder="Slider Title">\
					<small id="slider_title" class="form-text text-muted">The main Slider Title (H1)</small>\
			</div>\
			<div class="clear" style="margin:1.3rem"></div>\
			<div class="slider_subtitle">\
					<textarea class="form-control" rows="4" cols="4" name="subtitle[]"></textarea>\
					<small id="slider_subtitle" class="form-text text-muted">A subtitle (H2) for the Slider. If left blank won\'t show on slider</small>\
			</div>\
		</div>\
	</div>\
	</div>\
	<hr class="bg-gray p-3 mb-4 mt-3" />';
$('.home-slide-body').append(widget);
});

$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".inputhere");
    var add_button = $(".add-new");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div id="email"><input type="email" name="email[]" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Enter email address" class="common-input mb-20 form-control"><span class="delete"><i class="fa fa-times"></span></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});

$('.carousel').carousel({
  interval: 5000,
  keyboard: true,
  ride: true,
})

if ($('#resume-upload').length > 0) {
  document.getElementById("resume-upload").value;
}

$(document).ready(function(){
  $('#biz_entity').click(function(){
    if($(this).is(":checked")) {
       $("#biz_name").removeAttr("disabled");
       $("#biz_name1").removeAttr("disabled");
    } else {
       $("#biz_name").attr("disabled" , "disabled");
       $("#biz_name1").attr("disabled" , "disabled");
    }
  });
});

function resetForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false; 
            case 'date':
                 inputs[i].value='mm/dd/yyyy';  
        }
    }

    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i<text.length; i++)
        text[i].innerHTML= '';

    return false;
}

</script>


