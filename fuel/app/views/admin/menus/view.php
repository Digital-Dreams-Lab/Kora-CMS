<h2>Viewing #<?php echo $menus->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $menus->name; ?></p>
<p>
	<strong>Short code:</strong>
	<?php echo $menus->short_code; ?></p>

<?php echo Html::anchor('admin/menus/edit/'.$menus->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/menus', 'Back'); ?>