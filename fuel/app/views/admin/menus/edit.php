<h2>Editing Menus</h2>
<br>

<?php echo render('admin/menus/_form'); ?>
<p>
	<?php echo Html::anchor('admin/menus/view/'.$menus->id, 'View'); ?> |
	<?php echo Html::anchor('admin/menus', 'Back'); ?></p>
