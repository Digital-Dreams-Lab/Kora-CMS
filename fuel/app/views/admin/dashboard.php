
<?php //var_dump($method = Request::main()->response); ?>
<?php //var_dump(Kora\Access::check('admin')); ?>
<?php //var_dump(Kora\Access::$__access); ?>
<?php //var_dump(Kora\Access::$_access); ?>
<?php //var_dump($preferences); ?>
<div class="center-block hidden-xs hidden-sm">
	<p class="text-center"><?php echo Asset::img('koracms_logo_600x120.png', array('id' => 'logo','class' => 'img-responsive')); ?></p>
    <hr />
</div>
<div class="row">
	<div data-columns="" id="columns">
    
        <div class="panel column size-1of3">
            <div class="panel-heading">
            	<h4><i class="fa fa-edit"></i> Pages</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/pages/_menu'); ?>
        	</div>
        </div>
        
        <div class="panel column size-1of3">
            <div class="panel-heading">
            	<h4><i class="fa fa-wrench"></i> Settings</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/settings/_menu'); ?>
            </div>
        </div>
        
        <div class="panel column size-1of3">
            <div class="panel-heading">
           		<h4><i class="fa fa-graduation-cap"></i> Learn</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/learn/_menu'); ?>
            </div>
        </div>
        
        <div class="panel column size-1of3">
            <div class="panel-heading">
            	<h4><i class="fa fa-files-o"></i> Media</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/media/_menu'); ?>
            </div>
        </div>
        
        <div class="panel column size-1of3">
            <div class="panel-heading">
            	<h4><i class="fa fa-puzzle-piece"></i> Add-ons</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/addons/_menu'); ?>
            </div>
        </div>
        
        <div class="panel column size-1of3">
            <div class="panel-heading">
            	<h4><i class="fa fa-lock"></i> Permissions</h4>
            </div>
			<div class="panel-body">
            	<?php echo render('admin/permissions/_menu'); ?>
            </div>
        </div>
        
	</div>
</div>