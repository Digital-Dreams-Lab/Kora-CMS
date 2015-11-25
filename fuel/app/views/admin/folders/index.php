<h2>Listing Folders</h2>
<br>
<?php if ($folders): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Parent id</th>
			<th>Order</th>
			<th>Active</th>
			<th>Base</th>
			<th>Name</th>
			<th>Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($folders as $item): ?>		<tr>

			<td><?php echo $item->parent_id; ?></td>
			<td><?php echo $item->order; ?></td>
			<td><?php echo $item->active; ?></td>
			<td><?php echo $item->base; ?></td>
			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->description; ?></td>
			<td>
				<?php echo Html::anchor('admin/folders/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/folders/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/folders/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Folders.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/folders/create', 'Add new Folder', array('class' => 'btn btn-success')); ?>

</p>
