
<?php echo Form::open(); ?>

    <?php echo Form::hidden('user_id', $current_user->id); ?>  
    <?php echo Form::hidden('slug', '', array('id'=>'slug')); ?>  

    <!-- Text input-->
    <div class="form-group">
        <label class=" control-label" for="title">Page title</label>  
        <div class="">
            <input id="title" name="title" type="text" placeholder="Add page title" class="form-control input-md" required="">
        </div>
    </div>
                        
    <!-- Select Basic -->
    <div class="form-group">
        <label class=" control-label" for="plugin_id">Select plugin</label>
        <?php echo Form::select('plugin_id', '', $plugins, array('class' => 'form-control')); ?>  
    </div>
    
    <!-- Select Basic -->
    <div class="form-group">
        <label class=" control-label" for="parent_id">Select page parent</label>
        <?php echo Form::select('parent_id', '', $parents, array('class' => 'form-control')); ?>  
    </div>
    
    <!-- Select Basic -->
    <div class="form-group">
        <label class=" control-label" for="status">Visibility</label>
        <div class="">
        	<?php  echo Form::select('visibility', '', $select_options['visibility'], array('class' => 'form-control', 'id'=>'visibility')); ?>  
        </div>
    </div>
    <?php  echo Form::hidden('groups[]', '1'); ?> 
    <div id="show_groups">
    	<label>Groups</label>
        <?php foreach ($groups as $key => $value): ?>
        <div class="checkbox">
	        <label><input name="groups[]" type="checkbox" value="<?php echo $key ?>"<?php echo ($key=='1') ? ' checked="checked" disabled': ' class="clear_groups"'; ?>><?php echo $value ?></label>
        </div>
        <?php endforeach; ?>
    </div>
    <?php  echo Form::hidden('users[]', '1'); ?> 
    <div id="show_users">
	<?php foreach ($user_groups as $group_id => $user) : ?>
        <label><a href="javascript:void(0)" data-user-group="<?=$group_id?>" class="toggle_user_group"><?php echo $groups[$group_id]; ?></a></label><br />

        <?php foreach ($user as $key => $value): ?>
        <div class="checkbox show_user_group show_user_group_<?=$group_id?>">
            <label><input name="users[]" type="checkbox" value="<?php echo $key ?>"<?php echo ($key=='1') ? ' checked="checked" disabled': ' class="clear_users"'; ?>><?php echo $value ?></label>
        </div>
        <?php endforeach; ?>
   <?php endforeach; ?>
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class=" control-label" for="submit"></label>
        <div class="">
            <button id="submit" name="submit" class="btn btn-success btn-block">Create a new page</button>
        </div>
    </div>
<?php echo Form::close(); ?>
<script>
jQuery(document).ready(function($) {       
	

	$('#title').on('input', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('#slug').val(temp);
	});
	
	$('#slug').on('input', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('#slug').val(temp);
	});
	
	$('#show_groups').hide();
	$('#show_users').hide();
	$('.show_user_group').hide();
	
	$('.toggle_user_group').click(function() {
		var user_id = $(this).data('user-group');
		console.log(user_id);
		$('.show_user_group_'+user_id).toggle();		
	});
	
	$('#visibility').on('change', function() {
		var vid = $(this).find("option:selected").val();
		if (vid==='1') {
			$('#show_groups').show();
		} else {
			$('#show_groups').hide();
			$('.clear_groups').attr('checked', false);
			$('.clear_users').attr('checked', false);
		}
		if (vid==='2') {
			$('#show_users').show();
		} else {
			$('#show_users').hide();
			$('.clear_users').attr('checked', false);
			$('.clear_groups').attr('checked', false);
		}
		if (vid==='2') {
			$('#show_users').show();
		} else {
			$('#show_users').hide();
			$('.clear_users').attr('checked', false);
			$('.clear_groups').attr('checked', false);
		}
	});
	
	
});

</script>