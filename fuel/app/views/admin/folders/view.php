<h2>Viewing #<?php echo $folder->id; ?></h2>

<p>
	<strong>Parent id:</strong>
	<?php echo $folder->parent_id; ?></p>
<p>
	<strong>Order:</strong>
	<?php echo $folder->order; ?></p>
<p>
	<strong>Active:</strong>
	<?php echo $folder->active; ?></p>
<p>
	<strong>Base:</strong>
	<?php echo $folder->base; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $folder->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $folder->description; ?></p>

<?php echo Html::anchor('admin/folders/edit/'.$folder->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/folders', 'Back'); ?>