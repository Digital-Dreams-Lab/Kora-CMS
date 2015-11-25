
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Access granted to <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning"><?php echo $access->name; ?></span> to the following groups</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($groups_array as $id => $name) : ?>
    <?php $access_groups = explode(',', $access->groups); ?> 
        <tr>
            <td class="col-md-6"><label><?php echo Inflector::humanize($name); ?></label></td>
            <td>              
                <span class="label<?php echo in_array($id, $access_groups)?' label-success':''; ?>">
                    Access granted
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>