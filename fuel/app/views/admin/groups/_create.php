
<?php echo Form::open(); ?>
<label class='control-label'>Group name</label>
<div class="input-group">
    <?php echo Form::input('name', Input::post('name',''), array('class' => 'form-control required', 'placeholder'=>'Enter group name')); ?>
    <span class="input-group-btn">
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-save"></i> Save user group
        </button>
    </span>
</div>

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
                <?php $temp_val = ($action==='view') ? 1: 0; ?>
                <button
                    data-toggle="button"
                    id="<?php echo $controller.'_'.$action;?>"
                    class="set_button_value btn btn-xs btn-default<?php echo ($temp_val==1)?' active btn-success':''; ?>">
                    <?php echo Inflector::humanize($action); ?>
                </button>
                <input type="hidden" name="<?php echo "system_perms[{$controller}][{$action}]"; ?>" class="get_button_value" value='<?php echo $temp_val; ?>' />   
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
    	<tr>            
            <td class="col-md-3"><label><?php echo Inflector::humanize($plugins); ?></label></td>
            <td>
                <button
                    data-toggle="button"
                    id="<?php echo $plugins; ?>"
                    class="set_button_value btn btn-xs btn-default">
                    Grant access
                </button>
                <input type="hidden" name="<?php echo "plugin_perms[{$id}][{$plugins}]"; ?>" class="get_button_value" value="" />     
            </td> 
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo Form::close(); ?>
<style>
.label {margin-right:6px;}
</style>
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

