
<table class="table table-striped">
    <thead>
        <tr>
        	<th><i class="fa fa-users"></i> <a href="#collapse_perms" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_perms">Priviledges and permissions</a></th>
        	<th></th>
        </tr>
    </thead>
    <tbody class="collapse" id="collapse_perms">
        <?php  foreach ($actions_array as $controller => $actions) : ?>    
        <tr>
        	<td><?php echo Inflector::humanize($controller); ?></td>
            
            <td>
                <?php foreach ($actions as $key => $action) : ?>
	            <?php $val = isset($system_perms_saved[$controller][$action]) ? $system_perms_saved[$controller][$action]: $perms_array[$controller][$key]; ?>
                <span class="label<?php echo ($val==1)?' label-success':' label-default'; ?>">
                    <?php echo Inflector::humanize($action); ?>
                </span>
                
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <th><i class="fa fa-plug"></i> <a href="#collapse_plugins" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_plugins">Plugin priviledges and permissions</a></th>
        	<th></th>
        </tr>
    </thead>
    <tbody class="collapse" id="collapse_plugins">
    	<?php foreach ($plugin_perms_saved as $id => $plugins) : ?>
        <?php foreach ($plugins as $plugin =>  $val) : ?>
    	<tr>            
            <td><?php echo Inflector::humanize($plugin); ?></td>
            <td>
                <span class="label<?php echo ($val==1)?' label-success':' label-default'; ?>">
                    Access granted
                </span>     
            </td> 
        </tr>
        <?php endforeach; ?>
        <?php endforeach; //*/ ?>
    </tbody>
</table>
<style>
.label {margin-right: 6px;}
</style>