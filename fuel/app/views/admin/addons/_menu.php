
    <ul class="list-group">
        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/themes', '', '<i class="fa fa-paint-brush"></i>  Themes', 'index', false, 0); ?>	                
        </li>
        
        <li class="list-group-item">
        <?php echo Kora\Permissions::get_link('admin/plugins', '', '<i class="fa fa-plug"></i>  Plugins', 'index', false, 1); ?>
        </li>

        <li class="list-group-item">            
        <?php echo Kora\Permissions::get_link('admin/modules', '', '<i class="fa fa-tablet"></i>  Modules', 'index', false, 0); ?>
        </li>
    </ul>
