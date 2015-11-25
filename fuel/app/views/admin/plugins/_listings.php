<?php if ($plugins): ?>
<?php Config::load('plugins'); $select_options = Config::get('forms.select_options'); ?>
<table class="table table-striped vert-align">
	<thead>
		<tr>
			<th>Name</th>
			<th>Version</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($plugins as $item): ?>
		<tr>
			<td><?php echo Kora\Permissions::get_link('admin/plugins', $item->id, Inflector::humanize($item->name), 'edit'); ?></td>
			<td><?php echo $select_options['status'][$item->status]." ".$item->version; ?></td>
			<td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/plugins', $item->id); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
	No pages listed.
	<?php echo \Kora\Permissions::get_link('admin/plugins', '', 'Click here to create a new plugin.', 'create'); ?>
</div>
<?php endif; ?>
