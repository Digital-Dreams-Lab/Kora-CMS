<h2>Listing Blocks</h2>
<br>
<?php if ($blocks): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Short code</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($blocks as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->short_code; ?></td>
			<td>
				<?php echo Html::anchor('admin/blocks/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/blocks/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/blocks/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Blocks.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/blocks/create', 'Add new Block', array('class' => 'btn btn-success')); ?>

</p>
