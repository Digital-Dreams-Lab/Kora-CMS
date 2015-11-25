
  				<?php if ($groups): ?>              
                <table class="table table-striped vert-align">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groups as $item): ?>
                        <tr>
                            <td><?php echo Kora\Permissions::get_link('admin/groups', $item->id, $item->name, 'edit'); ?></td>
                            <td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/groups', $item->id); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
				<?php else: ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info-circle"></i> No groups listed. 
                    <?php echo \Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-plus"></i> Create new user group', 'create', array('class'=>'btn btn-success')); ?>
                </div>
                <?php endif; ?>

