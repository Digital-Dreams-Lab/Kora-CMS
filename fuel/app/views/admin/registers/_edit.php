<?php echo Form::open(); ?>

	<?php echo Form::hidden('id', Input::post('id',isset($register)?$register->id:'')); ?>
<div class="form-group">
    <label class='control-label'>Type</label>
	<?php echo Form::select('type', Input::post('type',isset($register)?$register->type:''), $types, array('class' => 'form-control')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Route ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning route_get">route</span> )</label>
	<?php echo Form::input('route', Input::post('route',isset($register)?$register->route:''), array('class' => 'form-control', 'placeholder'=>'Route', 'id'=>'route_set')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Controller ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning route_get">route</span>/<span class="text-warning controller_get">controller</span> )</label>
	<?php echo Form::input('controller', Input::post('controller',isset($register)?$register->controller:''), array('class' => 'form-control', 'placeholder'=>'Controller', 'id'=>'controller_set')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Actions ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning route_get">route</span>/<span class="text-warning controller_get">controller</span>/<span class="text-warning actions_get">actions</span> ) <span class="text-info">Eg. create,delete,edit,view</span></label>
	<?php echo Form::input('actions', Input::post('actions',isset($register)?$register->actions:''), array('placeholder'=>' Write actions then click enter or comma', 'id'=>'tokenfield_actions')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Methods <span class="text-info">Eg. POST,GET,PUT,DELETE</span></label>
	<?php echo Form::input('methods', Input::post('methods',isset($register)?$register->methods:''), array('class' => 'tokenfield', 'placeholder'=>' Write methods then click enter or comma')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Permissions</label>
	<?php echo Form::input('perms', Input::post('perms',isset($register)?$register->perms:''), array('class' => 'tokenfield', 'placeholder'=>' Write permissions then click enter or comma', 'id'=>'perms_get')); ?>
</div>

<div class="form-group">
    <label class='control-label'>Rules</label>
	<?php echo Form::input('rules', Input::post('rules',isset($register)?$register->rules:''), array('class' => 'tokenfield', 'placeholder'=>' Write rules then click enter or comma')); ?>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-warning">
        <i class="fa fa-save"></i> Update registry rules
    </button>
</div>

<?php echo Form::close(); ?>

<script>
	
	var num = {}, obj = {};
	
	function getValuesFromObj(obj) {		
		var array = $.map(obj, function(value, index) {
			return [value];
		});
		return array.toString();
	}
		
	function getCountFromObj(obj) {		
		var array = $.map(obj, function(value, index) {
			return [value];
		});
		return array.toString().replace(/[^a-z0-9-_]/g,'0');
	}
	
	$('#route_set').on('input', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('.route_get').html(temp);
	});
	
	$('#controller_set').on('input', function() { 
		var temp = $(this).val().toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
		$('.controller_get').html(temp);
	});
	
	$('.tokenfield').tokenfield();
	
	$('#tokenfield_actions')
	.tokenfield().on('tokenfield:createdtoken', function (e) {
		obj[e.attrs.value] = e.attrs.value;		
		$('.actions_get').html(getValuesFromObj(obj)); 
		$('#perms_get').html(getCountFromObj(obj)); 
		console.log(obj);
	})
	.tokenfield().on('tokenfield:removedtoken', function (e) {
		delete obj[e.attrs.value];
		$('.actions_get').html(getValuesFromObj(obj)); 
		$('#perms_get').html(getCountFromObj(obj)); 
	});

</script>