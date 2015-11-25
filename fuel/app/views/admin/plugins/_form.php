

<?php echo Form::open(); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Active', 'active', array('class'=>'control-label')); ?>
			<?php echo Form::input('active', Input::post('active', isset($plugin) ? $plugin->active : ''), array('class' => 'form-control', 'placeholder'=>'Active')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?php echo Form::input('status', Input::post('status', isset($plugin) ? $plugin->status : ''), array('class' => 'form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type', 'type', array('class'=>'control-label')); ?>

				<?php echo Form::input('type', Input::post('type', isset($plugin) ? $plugin->type : ''), array('class' => 'form-control', 'placeholder'=>'Type')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Version', 'version', array('class'=>'control-label')); ?>

				<?php echo Form::input('version', Input::post('version', isset($plugin) ? $plugin->version : ''), array('class' => 'form-control', 'placeholder'=>'Version')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Plugin directory', 'plugin_dir', array('class'=>'control-label')); ?>
			<?php echo Form::input('plugin_dir', Input::post('plugin_dir', isset($plugin) ? $plugin->plugin_dir : ''), array('class' => 'form-control', 'placeholder'=>'Plugin directory')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($plugin) ? $plugin->name : ''), array('class' => 'form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Namespace', 'namespace', array('class'=>'control-label')); ?>

				<?php echo Form::input('namespace', Input::post('namespace', isset($plugin) ? $plugin->namespace : ''), array('class' => 'form-control', 'placeholder'=>'Namespace')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Path', 'path', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('path', Input::post('path', isset($plugin) ? $plugin->path : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Path')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Description', 'description', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('description', Input::post('description', isset($plugin) ? $plugin->description : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Description')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>