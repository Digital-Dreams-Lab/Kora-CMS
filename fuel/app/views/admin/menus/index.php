<h2>Listing Menus</h2>
<br>
<?php if ($menus): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Short code</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($menus as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->short_code; ?></td>
			<td>
				<?php echo Html::anchor('admin/menus/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/menus/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/menus/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Menus.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/menus/create', 'Add new Menus', array('class' => 'btn btn-success')); ?>

</p>
