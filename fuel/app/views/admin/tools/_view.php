<h2>Viewing #<?php echo $access->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $access->name; ?></p>
<p>
	<strong>System access:</strong>
	<?php echo $access->system_access; ?></p>

<?php echo Html::anchor('admin/access/edit/'.$access->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/access', 'Back'); ?>