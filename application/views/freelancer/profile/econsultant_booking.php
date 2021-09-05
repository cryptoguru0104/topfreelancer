<!-- start banner Area -->
<script>

(function ($) {
  var editorId = 'dom-edit-' + Date.now();
  var editorHTML = '<textarea id="' + editorId + '"></textarea>';
  var $editor = $(editorHTML);
  var $currentTargetElement = null;

  function preventDefaultEvents(e) {
      e.preventDefault();
      e.stopPropagation();
  }

  function getTargetElementBoundingRect($aTargetElement) {
      var offset = $aTargetElement.offset();
      return {
          left: offset.left,
          top: offset.top,
          width: $aTargetElement.width(),
          height: $aTargetElement.height()
      };
  }


  function closeDomEditor(e) {
      $editor.remove();

      if ($currentTargetElement) {
          $currentTargetElement.html($editor.val());
      }

      $currentTargetElement = null;
      //$(document).off('click', closeDomEditor);
  }

  function editorClick(e) {
      preventDefaultEvents(e);
  }

  function setEditorStyle($element, opts) {
      $editor.css(getTargetElementBoundingRect($element));
      $editor.css('font-size', $element.css('font-size'));
      $editor.css('font-weight', $element.css('font-weight'));
      $editor.css('text-align', $element.css('text-align'));
      $editor.css('font-family', $element.css('font-family'));
      $editor.css('padding', $element.css('padding'));
      $editor.css('position', 'absolute');

      if (opts && opts.onSetEditorStyle) {
          opts.onSetEditorStyle($editor, $element);
      }
  }

  function setEditorState($element) {
      $editor.val($element.html());
      $editor.select();
      $editor.focus();
      $editor.click(editorClick);
      $editor.blur(closeDomEditor);
  }

  $.fn.domEdit = function (options) {
      var defaultOptions = {
          editorClass: ''
      }

      var opts = $.extend(defaultOptions, options);
      $editor.addClass(opts.editorClass);

      return this.each(function (idx, element) {
          $(element).dblclick(function (e) {
              preventDefaultEvents(e);
              var target = e.target;
              var $body = $(document.body);

              if (target === $editor[0] || target === document.body || !$body.has(target)) return;

              var $element = $(target);

              if (!$editor.parent().length) {
                  $body.append($editor);
              }

              setEditorStyle($element, opts);
              setEditorState($element);
              //$(document).on('click', closeDomEditor);
              $currentTargetElement = $element;
          });
      });
  }
})(jQuery);
</script>

<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?php if(isset($search_value)) :  ?>
					<?=trans('search_results')?>
					<?php else : ?>
					<?=trans('top_freelancers')?>
					<?php endif; ?>
				</h1>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area pb-5">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<div class="col-lg-12 post-list">

				<div class="profile_job_content col-lg-12 mt-5">
					<div class="col-lg-12 post-list">
						<div class="profile_job_detail">

							<div class="row py-3">
								<div class="col-xl-6 col-md-12 col-sm-12">
									<h3 class="" style="color:#008ae6;"><?=trans('econsultation_bookings')?>
									</h3>
								</div>

								<div class="col-md-6 d-inline-block">
									<div class="float-right">

										<input type="submit" class="btn btn-primary rounded bg1 mb-1" name="post_job"
											value="<?=trans('econsultant')?>">
									</div>
								</div>
							</div>

							<div class="container">
								<div class="row">
									<div class="col-lg-12" style="overflow:auto">
										<table id="econsultant-booking" class="table" style="width:100%;">
											<thead class="" style="background-color:#BE90D7">
												<tr>
													<th class="text-center">Name</th>
													<th class="text-center">Organization</th>
													<th class="text-center">Email</th>
													<th class="text-center">Date</th>
													<th class="text-center">Time</th>
													<th class="text-center">Duration</th>
													<th class="text-center">Time-Zone</th>
													<th class="text-center">Requirements</th>
													<th class="text-center">Status</th>
													<th class="text-center">Notes</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">

													<td class="editable">afdsa</td>
													<td>		gcjh		</td>
													<td>			rege	 </td>
													<td>		reg	</td>
													<td>		rhtr		</td>
													<td>		htrgreg	</td>
													<td>			rehgrth	</td>
													<td>			hrth	</td>
													<td style="background-color:rgba(162, 233, 150, 0.36)">
														erhbrt</td>
													<td class="flinfo"
														style="background-color:rgba(162, 233, 150, 0.36)">
														erbgef</td>
												</tr>
											</tbody>

										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- ------------------------------------------------------------------------ -->



	</div>


</section>

<script>
$(function(){
	$(document).ready(function(){
    $('body').domEdit({
        editorClass: 'editor',
        onSetEditorStyle: function($editor, $editingElement) {
            $editor.css('border-style', 'dotted');
            $editor.css('border-width', '1px');  
            $editor.css('outline', 'none');
        }
    });
});
	</script>