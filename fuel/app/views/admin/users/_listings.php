
				<?php if ($users): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Group</th>
                            <th>Last login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $item): ?>
                        <tr>
                            <td><?php echo Kora\Permissions::get_link('admin/users', $item->id, $item->username, 'edit'); ?></td>
                            <td><?php echo $groups_array[$item->group]; ?></td>
                            <td><small class="text-muted"><?php echo date('d/m/Y H:i:s', $item->last_login); ?></small></td>
                            <td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/users', $item->id); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <?php else: ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info-circle"></i> No groups listed. 
                    <?php echo \Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-plus"></i> Create new user', 'create', array('class'=>'btn btn-success')); ?>
                </div>                   
				<?php endif; ?>

