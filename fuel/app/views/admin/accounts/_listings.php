	<?php if (Kora\Permissions::check_group_level(0)): ?>
	<div class="row">   		
	
    	<div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-info-circle"></i> Account details</div>
                <div class="panel-body">
				
                	<?php echo render('admin/accounts/_details'); ?>

                	<?php echo render('admin/accounts/_profile'); ?>

                	<?php echo render('admin/accounts/_access'); ?>

                	<?php echo render('admin/accounts/_permissions'); ?>
				                
                </div>
            </div>
        </div>
        
    	<div class="col-md-3">
        	<ul class="list-group">
                <li class="list-group-item disabled"><i class="fa fa-bars"></i> <strong>Account menu</strong></li>
                <li class="list-group-item"><i class="fa fa-edit"></i> <a href="<?php echo Uri::base(false).'admin/accounts/edit/'; ?>">Edit account details</a></li>
                <li class="list-group-item"><i class="fa fa-key"></i> <a href="<?php echo Uri::base(false).'admin/accounts/password/'; ?>">Change password</a></li>
                <li class="list-group-item disabled"><i class="fa fa-globe"></i> <strong>Website menu</strong></li>
                <li class="list-group-item"><i class="fa fa-flag"></i> <a href="<?php echo Uri::base(false).'admin/notifications/'; ?>">View notifications</a></li>
                <li class="list-group-item"><i class="fa fa-comments-o"></i> <a href="<?php echo Uri::base(false).'admin/comments/'; ?>">View comments</a></li>
                <li class="list-group-item"><i class="fa fa-inbox"></i> <a href="<?php echo Uri::base(false).'admin/mail/'; ?>">View mailbox</a></li>
            </ul>
        </div>
	
	</div>
	<?php else: ?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-warning"></i> You do not have the required access level to view this page
	</div>                
	<?php endif; ?>
                                