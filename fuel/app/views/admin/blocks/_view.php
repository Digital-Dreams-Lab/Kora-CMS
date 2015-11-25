<h2>Viewing #<?php echo $block->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $block->name; ?></p>
<p>
	<strong>Short code:</strong>
	<?php echo $block->short_code; ?></p>

<?php echo Html::anchor('admin/blocks/edit/'.$block->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/blocks', 'Back'); ?>