<?php echo Form::open(); ?>
* need to change to select, disable already selected locations
<label class='control-label'>Access to ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning" id="access_name"></span> )</label>
<div class="input-group">
    <?php echo Form::input('name', $access->name, array('class' => 'form-control', 'placeholder'=>'Name', 'id'=>'name')); ?>
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
                <a
                    href="javascript:void(0)" 
                    data-toggle="button"
                    id="<?php echo $id;?>"
                    class="set_button_value label label-default<?php echo in_array($id, $access_groups)?' active label-success':''; ?>">
                    Grant access
                </a>
                <input type="hidden" name="<?php echo "groups[]"; ?>" class="get_button_value" value='<?php echo $id; ?>' /> 
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
	var access_name = $('#name').val();
	$('#access_name').html(access_name);
	
	$('#name').on('input', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('#access_name').html(temp);
	});
	
	$('.set_button_value').click(function () {
		$(this).toggleClass('label-success');
		var value;
		if ($(this).hasClass('active')) {
			value = 0;
		} else {	
			value = 1;		
		}
		$(this).next("input[type='hidden']").val(value);
		var get_val = $(this).next("input[type='hidden']").val();
		console.log(get_val);
	});
</script>