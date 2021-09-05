<!-- business-information-form-section start -->
<section id="business-info-form">
	<div class="container">
		<?php

			if ($this->session->flashdata('edit_business_info_success')) {

                echo '<div class="alert alert-success">' . $this->session->flashdata('edit_business_info_success') . '</div>';

            }

			if($this->session->flashdata('error_edit_business_info')){

                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_edit
            _business_info') . '</div>';

        	}

		?>
		<div class="row">
			<div class="col-md-8">
				<?php $attributes = array('id' => 'business_info_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

		        <?php echo form_open('employers/profile/edit',$attributes);?>
					<div class="bg-light card card-body mt-3">
						<h4>Edit Business Information</h4>
						<div class="bottom-line"></div>
						<div class="form-group row mt-4">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Industry:</label>
						    <div class="col-sm-9">
						        <input type="text" name="industry" class="form-control" id="" placeholder="Marketing & Advertisement" value="<?= $business_info['industry']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Business Name:</label>
						    <div class="col-sm-9">
						        <input type="text" name="business_name" class="form-control" id="inputEmail3" placeholder="e.g Ozient Technologies" value="<?= $business_info['business_name']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Email ID:</label>
						    <div class="col-sm-9">
						        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="e.g @OzientTechnologies.com" value="<?= $business_info['email']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Mobile Number:</label>
						    <div class="col-sm-9">
						        <input type="text" name="mobile_number" class="form-control" id="inputEmail3" placeholder="e.g 030000000" value="<?= $business_info['mobile_number']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Address:</label>
						    <div class="col-sm-9">
						        <input type="text" name="address" class="form-control" id="inputEmail3" placeholder="e.g Punjab, Pakistan." value="<?= $business_info['address']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
					    	<input type="submit" class="btn btn-success form-control" name="business_info_edit" value="Save">
					    </div>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</section>
<!-- business-information-form-section end -->
