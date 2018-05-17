<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $__env->yieldContent('title'); ?></title>
	<meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
  <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="shortcut icon" href="<?php echo e(URL::to('favicon.ico')); ?>">

	<!-- include css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('css/font-awesome.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('css/custom.css')); ?>">

	<!-- include js -->
	<script type="text/javascript" src="<?php echo e(URL::to('js/jquery.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(URL::to('js/bootstrap.min.js')); ?>"></script>

	<!-- Child style goes here -->
  <?php echo $__env->yieldContent('stylesheet'); ?>
</head>

<body>
	<div id="page">
		<div class="header_container">
			<!-- Header -->
			<?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
		</div>
		<!-- Include flash msg to show error, warning and other messages -->
		<div class="container">
			<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div class="page_container">
			<!-- Middle content -->
			<?php echo $__env->yieldContent('content'); ?>
			<!-- Footer -->
			<?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
   
	<!-- Child javascript goes here -->
	<?php echo $__env->yieldContent('javascript'); ?>

</body>
</html>