<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo @$title; ?></title>
		
		<?php echo @$js_files."\n"; ?>
		<?php echo @$css_files; ?>
		
		<?php echo @$metadata; ?>

	   <!-- StyleSheets -->
		<?php echo css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
	

	<?php echo js('https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'); ?>
	<!--[if lt IE 9]>
	<?php echo js('https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js'); ?>
	<?php echo js('https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js'); ?>
	<![endif]-->

</head>
<body>
	<?php echo @$layout."\n"; ?>

	<!-- JavaScripts -->
	<?php echo js('http://code.jquery.com/jquery-1.12.4.min.js'); ?>
	<?php echo js('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
	
	
</body>
</html>