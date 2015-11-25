
    <ul class="list-group">
        <li class="list-group-item">
        <?php echo Kora\Permissions::get_link('admin/settings/basic', '', '<i class="fa fa-wrench"></i>  Basic settings', 'index', false, 1); ?>
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/settings/advanced', '', '<i class="fa fa-cogs"></i>  Advanced settings', 'index', false, 1); ?>
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/accounts', '', '<i class="fa fa-user-secret"></i>  Account settings', 'index', false, 1); ?>                
        </li>
    </ul>