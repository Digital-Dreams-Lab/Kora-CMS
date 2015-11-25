
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Group priviledges and permissions for (<span class="text-warning"><?php echo $group->name; ?></span>)</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach ($actions_array as $controller => $actions) : ?>    
        <tr>
            <td class="col-md-3"><label><?php echo Inflector::humanize($controller); ?></label></td>
            
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
            <th colspan="2">Plugin priviledges and permissions</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($plugin_perms_saved as $id => $plugins) : ?>
        <?php foreach ($plugins as $plugin =>  $val) : ?>
    	<tr>            
            <td class="col-md-3"><label><?php echo Inflector::humanize($plugin); ?></label></td>
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