
<?php if ($pages): ?>
<table class="table table-striped vert-align">
	<thead>
		<tr>
			<th>Title</th>
			<th>Author</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody>    
		<?php foreach ($pagetree as $item): ?>
		<tr>
			<td><?php echo ((isset($item['depth']) && $item['depth'] > 0) ? str_repeat('<span class="text-muted"><i class="fa fa-arrow-right"></i> </span>', $item['depth']): '').'<span class="text-muted"><i class="fa fa-file-archive-o"></i></span> '; ?>
			<?php echo Kora\Permissions::get_link('admin/pages', $item['data']['id'], $item['data']['title'], 'edit', array('data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Edit ".$item['data']['title']." page.")); ?></td>
			<td><?php echo ($item['data']['user_id']) ? $users[$item['data']['user_id']]: ''; ?></td>
			<td><small class="text-muted"><?php echo date("$settings->default_date_format $settings->default_time_format",$item['data']['created_at']); ?></small></td>
			<td class="text-right">
				<?php echo Kora\Permissions::get_link('admin/pages', $item['data']['id'], '<i class="fa fa-edit fa-fw"></i>', 'edit', array('class'=>'btn btn-xs btn-warning', 'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Edit page.")); ?>
				<?php echo Kora\Permissions::get_link('admin/pages', $item['data']['id'], '<i class="fa fa-trash-o fa-fw"></i>', 'trash', array('class'=>'btn btn-xs btn-danger', 'data-toggle'=>"tooltip", 'data-placement'=>"top", 'title'=>"Send page to trash.", 'onclick' => "return confirm('Are you sure you want to send this to the trash?')")); ?>
            </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<i class="fa fa-info-circle"></i> No pages listed. 
	<?php // \Kora\Permissions::get_link('admin/pages', '', '<i class="fa fa-plus"></i> Create new page', 'create', array('class'=>'btn btn-success')); ?>
</div>
<?php endif; ?>
