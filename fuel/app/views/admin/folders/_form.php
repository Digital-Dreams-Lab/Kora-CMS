<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Parent id', 'parent_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('parent_id', Input::post('parent_id', isset($folder) ? $folder->parent_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Parent id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Order', 'order', array('class'=>'control-label')); ?>

				<?php echo Form::input('order', Input::post('order', isset($folder) ? $folder->order : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Order')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Active', 'active', array('class'=>'control-label')); ?>

				<?php echo Form::input('active', Input::post('active', isset($folder) ? $folder->active : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Active')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Base', 'base', array('class'=>'control-label')); ?>

				<?php echo Form::input('base', Input::post('base', isset($folder) ? $folder->base : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Base')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($folder) ? $folder->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Description', 'description', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('description', Input::post('description', isset($folder) ? $folder->description : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Description')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>