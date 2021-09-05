<!DOCTYPE html>
<html>
<head>
	<style>
		
		.mycss {
			border-color: #8080ff;
			background-color: whitesmoke;
			border-radius: 8px;
			margin: bottom 70px;
			border-style: solid;
			padding: 15px;
			border-width: 1px;

		}
		.mycss1{ 
			background-color: white;
			height: 10px;
		}
		label{
			display: inline-block;
			background-color:  #e6e6ff;
			color: white;
			padding: 0.5rem;
			font-family: sans-serif;
			border-radius: 0.3rem;
			cursor: pointer;
			margin-top: 1rem;
			border: outset 1px grey;
		}


		.myButton {
			box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
			background-color:#79bbff;
			border-radius:6px;
			border:1px solid #84bbf3;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:0px 1px 0px #528ecc;
		}
		.myButton:hover {
			background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
			background-color:#378de5;
		}
		.myButton:active {
			position:relative;
			top:1px;
		}

	</style>
	
</head>
<body>

<section class="content" id="general_settings">

<div class="row"><div class="col-md-12"><div class="box box-body with-border"><h3>Home Slider	</h3></div></div></div>

<div class="row">
 	<div class="col-md-12">
		<?php if($this->session->flashdata('success')):?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?= $this->session->flashdata('success'); ?>
			</div>
		<?php endif; ?>

		<?php if($this->session->flashdata('error')):?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?= $this->session->flashdata('error'); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<div class="box box-body with-border">
    <?php echo form_open_multipart(base_url('admin/home_slider/add')); ?>	

	<div class="home-slide-body">
		<?php foreach ($sliders as $slider): ?>

		<!-- Start Slider -->

		<div class="slide col-md-12 mycss">	
				<div class="form-group">

					<input type="hidden" name="id[]" value="<?= $slider['id'] ?>" />
					<input type="hidden" id="operation<?=$slider['id']?>" name="operation[]" value="1"/>
					<div class="col-md-6">	
						<div class="btn-block mb-5">
							<?php if($slider['image']) : ?>
								<img src="<?= base_url($slider['image']) ?>" style="width:550px ; border:inset 1px #000066">
								<div class="box-file">
									<!-- <input type="file" value="<?= $slider['image'] ?>" id="profilepicupload" accept="image/*" name="image[]" class="filePhoto"  onchange="changeMode(<?=$slider['id']?>)"/> 
									<span class="btn btn-info text-file"><i class="glyphicon glyphicon-cloud-upload myicon-right"></i> Choose Image</span> -->
									<label for="profilepicupload_<?=$slider['id']?>">
										<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
										<input type="file" value="<?= $slider['image'] ?>" id="profilepicupload_<?=$slider['id']?>" accept="image/*" name="image[]" class="filePhoto" style="display :none" onchange="changeMode(<?=$slider['id']?>)"/> Choose Image
									</label>
									<span class="help-block">Recommended Size 1600x900px </span>
								</div>
								<input type="hidden" value="<?= $slider['image'] ?>" name="image[]" />
								<input type="hidden" value="<?= $slider['image'] ?>" name="old_image[]" />
							<?php else : ?>
								<img src="https://via.placeholder.com/625x250" style="width:550px">
								<div class="box-file">
									<input type="file" id="profilepicupload" accept="image/*" name="image[]" class="filePhoto" onchange="changeMode(<?=$slider['id']?>)"/>
									<span class="btn btn-info text-file"><i class="glyphicon glyphicon-cloud-upload myicon-right"></i> Choose Image</span>
									<span class="help-block">Recommended Size 1600x900px </span>
								</div>
							<?php endif; ?>
						</div>

						<div class="col-md-12">
								<i class="glyphicon glyphicon-paperclip myicon-right"></i>
								<button type="button" class="btn btn-danger remove-slider-slide"><i class="fa fa-trash"></i></button>
						</div>
						
						
					</div>

					<div class="col-md-6">

						<div id="slider_title_<?= $slider['id'] ?>">
								<input type="text" class="form-control" name="title[]" aria-describedby="slider_title_<?= $slider['id'] ?>" value="<?= $slider['title'] ?>" placeholder="Slider Title" onkeypress="changeMode(<?=$slider['id']?>)">
								<small class="form-text text-muted">The main Slider Title (H1)</small>
						</div>
						<div class="clear" style="margin:1.3rem"></div>

						<div class="slider_subtitle_<?= $slider['id'] ?>">
								<textarea class="form-control" rows="4" cols="4" name="subtitle[]" onkeypress="changeMode(<?=$slider['id']?>)"><?= $slider['subtitle'] ?> </textarea>
								<small class="form-text text-muted">A subtitle (H2) for the Slider. If left blank won't show on slider</small>
						</div>
						
					</div>
								
				</div>
			
		</div>
		<div class="row"><div class="col-md-12"><div class="mycss1"><br><br></div></div></div>	
		<!-- End Slider -->
		<div class="clear">
		<div class="bg-dark mb-4 mt-3"></div>
		<?php endforeach; ?>
							
	</div>
	<div class="row"><div class="col-md-12"><div class="mycss1"></div></div></div>							
	<div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <button type="button" class="btn btn-info btn-add-slide myButton" ><i class="fa fa-plus"></i> Add Slide</button>
        </div>
		<div class="col-md-6">
			<div class="box-slider ">
				<input type="submit" name="submit" value="Save Changes" class="btn btn-info pull-right myButton">
			</div>
		</div>	
      </div>
    </div>
	
</div>

<?php echo form_close(); ?>


</section>

<script>
function changeMode(a)
{	
	$('#operation' + a).val(2);
}

</script>

</body>

</html>
