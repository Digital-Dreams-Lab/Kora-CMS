<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
    <?php
    
	echo Asset::css(array(
		'bootstrap.css',
		'font-awesome.css',
		'custom.css',
		'fileinput.css',
		'bootstrap-tokenfield.css',
		'tokenfield-typeahead.css',
		'bootstrap-wysihtml5.css'
	));
	
	echo Asset::js(array(
		'wysihtml5-0.3.0.js',
		'jquery.js',
		'fileinput.js',
		'bootstrap.js',
		'custom.js',
		'jquery-sortable.js',
		'bootstrap-tokenfield.js',
		'bootstrap3-wysihtml5.js'
	));
	
	?>

	<script>
		$(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>

	<?php if ($current_user): ?>
		<?php echo render('admin/navbar'); ?>  
	<?php endif; ?>
	
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
					</p>
				</div>
				<?php endif; ?>
                <?php if (Session::get_flash('error')): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
					</p>
				</div>
				<?php endif; ?>
			</div>
            
			<div class="col-md-12">
				<?php echo $content; ?>
			</div>
		</div>
		<hr/>
		<footer>
			<p class="pull-right"><small class="text-muted">Page rendered in {exec_time}s using {mem_usage}mb of memory.</small></p>
			<p>
				<a href="http://www.digitaldreamslab.co.nz">Kor@ CMS</a> all rights reserved Digital Dreams Lab LTD 2015.
                <small class="text-muted">Version: <?php echo e(Kora::VERSION); ?> <?php echo e(Kora::RELEASE); ?> Release (Codename: <?php echo e(Kora::CODENAME); ?>)</small>
			</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.
                <small class="text-muted">Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	</div>
	<?php echo $scripts; ?>
</body>
</html>
