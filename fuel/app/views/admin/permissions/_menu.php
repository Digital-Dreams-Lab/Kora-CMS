
    <ul class="list-group">
        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/users', '', '<i class="fa fa-user"></i>  Users', 'index', false, 0); ?>	
        </li>
        
        <li class="list-group-item">
        <?php echo Kora\Permissions::get_link('admin/groups', '', '<i class="fa fa-users"></i>  User groups', 'index', false, 1); ?>	
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/access', '', '<i class="fa fa-user-secret"></i>  Access', 'index', false, 0); ?>	                
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/registers', '', '<i class="fa fa-sitemap"></i>  Registry', 'index', false, 0); ?>	                
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/backups', '', '<i class="fa fa-tasks"></i>  Backups', 'index', false, 0); ?>	                
        </li>
    </ul>