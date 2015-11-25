
<?php //var_dump($method = Request::main()->response); ?>
<?php //var_dump(Kora\Access::check('admin')); ?>
<?php //var_dump(Kora\Access::$__access); ?>
<?php //var_dump(Kora\Access::$_access); ?>
<div class="center-block hidden-xs hidden-sm">
	<p class="text-center"><?php echo Asset::img('koracms_logo_600x120.png', array('id' => 'logo','class' => 'img-responsive')); ?></p>
    <hr />
</div>
<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-edit"></i> Pages</h2>
		<p><i class="fa fa-pencil"></i> <a href="<?php echo Uri::base(false).'admin/pages'; ?>">Manage web pages</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-paint-brush"></i> Layout</h2>
		<p><i class="fa fa-bars"></i> <a href="<?php echo Uri::base(false).'admin/menus'; ?>">Manage menus</a></p>
		<p><i class="fa fa-th-large"></i> <a href="<?php echo Uri::base(false).'admin/blocks'; ?>">Manage blocks</a></p>
		<p><i class="fa fa-paint-brush"></i> <a href="<?php echo Uri::base(false).'admin/layout'; ?>">Manage layout</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-wrench"></i> Settings</h2>
		<p><i class="fa fa-globe"></i> <a href="<?php echo Uri::base(false).'admin/settings'; ?>">Manage site settings</a></p>
		<p><i class="fa fa-cogs"></i> <a href="<?php echo Uri::base(false).'admin/perferences'; ?>">Manage personal settings</a></p>
		<p><i class="fa fa-database"></i> <a href="<?php echo Uri::base(false).'admin/backups'; ?>">Manage backups</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-graduation-cap"></i> Learn</h2>
		<p><i class="fa fa-book"></i> <a href="<?php echo Uri::base(false).'admin/docs'; ?>">Documentation</a></p>
		<p><i class="fa fa-film"></i> <a href="<?php echo Uri::base(false).'admin/learn'; ?>">Tutorials</a></p>
		<p><i class="fa fa-code"></i> <a href="<?php echo Uri::base(false).'docs/api'; ?>">Api</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-files-o"></i> Media</h2>
		<p><i class="fa fa-file-image-o"></i> <a href="<?php echo Uri::base(false).'admin/media'; ?>">Manage media files</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-puzzle-piece"></i> Add-ons</h2>
		<p><i class="fa fa-plug"></i> <a href="<?php echo Uri::base(false).'admin/plugins'; ?>">Manage plugins</a></p>
		<p><i class="fa fa-paint-brush"></i> <a href="<?php echo Uri::base(false).'admin/themes'; ?>">Manage themes</a></p>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<h2><i class="fa fa-lock"></i> Access</h2>
		<p><i class="fa fa-user"></i> <a href="<?php echo Uri::base(false).'admin/users'; ?>">Manage users</a></p>
		<p><i class="fa fa-users"></i> <a href="<?php echo Uri::base(false).'admin/groups'; ?>">Manage groups</a></p>
	</div>
</div>