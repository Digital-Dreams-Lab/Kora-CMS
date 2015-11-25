<?php echo Form::open(); ?>
<label class='control-label'>Access to ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning" id="access_name"></span> )</label>
<div class="input-group">
    <select name="name" id="name" class="form-control required">
    	<?php foreach ($registers_array as $register): ?>
        <option value="<?php echo $register; ?>"<?php echo ($register==$access->name) ? '': ' disabled="disabled"'; ?>><?php echo $register; ?></option>
        <?php endforeach; ?>
    </select>
    <span class="input-group-btn">
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-save"></i> Update access rule
        </button>
    </span>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Grant access to the following groups</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($groups_array as $id => $name) : ?>
    <?php $access_groups = explode(',', $access->groups); ?> 
        <tr>
            <td class="col-md-6"><label><?php echo Inflector::humanize($name); ?></label></td>
            <td>              
                <button
                    data-toggle="button"
                    data-group-id="<?php echo $id;?>"
                    id="<?php echo $name;?>"
                    class="set_button_value btn btn-default btn-xs <?php echo in_array($id, $access_groups)?' active btn-success':''; ?>">
                    Grant access
                </button>
                <input type="hidden" name="<?php echo "groups[]"; ?>" class="get_button_value" value="<?php echo in_array($id, $access_groups)?$id:''; ?>" /> 
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo Form::close(); ?>

<script>
	var access_name = $('#name').val();
	$('#access_name').html(access_name);
	
	$('#name').on('change', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('#access_name').html(temp);
	});
	
	$('.set_button_value').click(function () {
		$(this).toggleClass('btn-success');
		//*
		var value;
		if ($(this).hasClass('btn-success')) {
			value = $(this).data('group-id');
		} else {	
			value = '';		
		}
		$(this).next("input[type='hidden']").val(value);
		var get_val = $(this).next("input[type='hidden']").val();
		//*/
		console.log(get_val);
	});
</script>