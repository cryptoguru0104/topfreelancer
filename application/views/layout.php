<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($title)?$title. ' - '. $this->general_settings['application_name']: 'TopFreelancer PHP Job Portal'; ?></title>
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>">
	<meta charset="utf-8">
	<meta name="description" content="<?= isset($meta_description) ? $meta_description : ''; ?>">
	<meta name="keywords" content="<?= isset($keywords) ? $keywords : ''; ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="canonical"href="<?= current_url() ?>">
	
	<?php if (isset($show_og_tags)): ?>
	<meta property="og:title" content="<?= $og_title; ?>">
	<meta property="og:description" content="<?= $og_description; ?>">
	<meta property="og:image" content="<?= base_url($og_image); ?>">
	<meta property="og:image:secure_url" content="<?= base_url($og_image); ?>">
	<meta property="og:url" content="<?= $og_url; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<?php endif; ?>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/linearicons.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/nice-select.css">					
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.transitions.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" type="text/css" />

  	<script src="<?= base_url(); ?>assets/js/vendor/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js" type="text/javascript"></script>
</head>


<body>

	<!-- Navbar File-->
	<?php include('navbar.php'); ?>

	<!--main content start-->
	<?php $this->load->view($layout); ?>
	<!--main content end-->

	<!-- Footer File-->
	<?php include('footer.php'); ?>


	<!-- Scripts Files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/easing.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/hoverIntent.js"></script>
	<script src="<?= base_url(); ?>assets/js/superfish.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/jquery.sticky.js"></script>
	
	<script src="<?= base_url(); ?>assets/js/domEdit.js"></script>			

	<script src="<?= base_url(); ?>assets/js/jquery.nice-select.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/parallax.min.js"></script>		
	<!-- Notify JS -->
	<script src="<?= base_url() ?>assets/js/notify.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/main.js"></script>	
	<!-- Custom JS-->


	<?php include('js_footer.php'); ?>
</body>
</html>
