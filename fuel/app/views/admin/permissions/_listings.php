	<div class="row">
        
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<i class="fa fa-user"></i> Manage user accounts and details
					</h4>
				</div>
				<div class="panel-body">					
                	<?php echo render('admin/users/_listings'); ?>
                </div>
			</div>
		</div>
 		
        <div class="col-md-3">					
        	<?php echo render('admin/permissions/_menu'); ?>
		</div>
        
    </div>