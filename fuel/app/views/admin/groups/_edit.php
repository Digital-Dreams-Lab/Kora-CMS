
<?php echo Form::open(); ?>
	<?php echo Form::hidden('id', $group->id); ?>
	<div class="form-group">
    <label class='control-label'>Group name</label>
    <div class="input-group">
        <?php echo Form::input('name', $group->name, array('class' => 'form-control')); ?>
        <span class="input-group-btn">
            <button type="submit" class="btn btn-warning">
                <i class="fa fa-save"></i> Update user group
            </button>
        </span>
    </div>
    </div>
 	<?php if (Kora\Permissions::check_group_level(0)): ?>
    <?php Config::load('users'); $levels_array = Config::get('forms.select_options.levels'); ?>  
    <div class="form-group">
        <?php echo Form::label('Level', 'level', array('class'=>'control-label',)); ?>
        <?php echo Form::select('level', Input::post('level', isset($user) ? $user->level : ''), $levels_array, array('class' => 'form-control')); ?>
    </div>
    <?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Group priviledges and permissions</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach ($actions_array as $controller => $actions) : ?>    
        <tr>
            <td class="col-md-3"><label><?php echo Inflector::humanize($controller); ?></label></td>
            <td>
                <?php foreach ($actions as $key => $action) : ?>
            	<?php $val = isset($system_perms_saved[$controller][$action]) ? $system_perms_saved[$controller][$action]: 0; ?>
                <button
                    data-toggle="button"
                    id="<?php echo $controller.'_'.$action;?>"
                    class="set_button_value btn btn-xs btn-default<?php echo ($val==1)?' active btn-success':''; ?>">
                    <?php echo Inflector::humanize($action); ?>
                </button>
                <input type="hidden" name="<?php echo "system_perms[{$controller}][{$action}]"; ?>" class="get_button_value" value='<?php echo $val; ?>' />   
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
    	<?php foreach ($plugins_array as $id => $plugins) : ?>
        <?php $val = isset($plugin_perms_saved[$id][$plugins]) ? $plugin_perms_saved[$id][$plugins]: 0; ?>
    	<tr>            
            <td class="col-md-3"><label><?php echo Inflector::humanize($plugins); ?></label></td>
            <td>
                <button
                    data-toggle="button"
                    id="<?php echo $plugins; ?>"
                    class="set_button_value btn btn-xs btn-default<?php echo ($val=='1')?' active btn-success':''; ?>">
                    Grant access
                </button>
                <input type="hidden" name="<?php echo "plugin_perms[{$id}][{$plugins}]"; ?>" class="get_button_value" value="<?php echo $val; ?>" />     
            </td> 
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo Form::close(); ?>

<script>
	$('.set_button_value').click(function () {
		$(this).toggleClass('btn-success');
		var value;
		if ($(this).hasClass('btn-success')) {
			value = 1;
		} else {	
			value = 0;		
		}
		$(this).next("input[type='hidden']").val(value);
		var get_val = $(this).next("input[type='hidden']").val();
		console.log(get_val);
	});
</script>
