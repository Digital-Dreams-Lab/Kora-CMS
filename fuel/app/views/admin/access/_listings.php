			<?php if (Kora\Permissions::check_group_level(0)): ?>

  				<?php if ($accesses): ?>              
                <table class="table table-striped align-vert">
                    <thead>
                        <tr>
                            <th>Groups</th>
                            <th>Access</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accesses as $item): ?>
                        <tr>
                            <?php $access_group = explode(',',$item->groups); ?>
                            <td><?php echo Kora\Permissions::get_link('admin/access', $item->id, count($access_group).' <i class="fa fa-users"></i>', 'edit', array('class'=>'btn btn-xs btn-primary')); ?></td>
                            <td><?php echo Kora\Permissions::get_link('admin/access', $item->id, Uri::base(false).$item->name, 'edit'); ?></td>
                            <td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/access', $item->id); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
				<?php else: ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info-circle"></i> No access rules listed. 
                    <?php echo \Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-plus"></i> Create new access rules', 'create', array('class'=>'btn btn-success')); ?>
                </div>
                <?php endif; ?>
				
			<?php else: ?>
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-warning"></i> You do not have the required access level to view this page
                </div>                
            <?php endif; ?>
                                