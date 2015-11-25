<h2>Editing Folder</h2>
<br>

<?php echo render('admin/folders/_form'); ?>
<p>
	<?php echo Html::anchor('admin/folders/view/'.$folder->id, 'View'); ?> |
	<?php echo Html::anchor('admin/folders', 'Back'); ?></p>
