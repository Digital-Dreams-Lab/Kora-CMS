<?php Config::load('plugins'); $select_options = Config::get('forms.select_options'); ?>

<?php echo Form::open(); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Active', 'active', array('class'=>'control-label')); ?>
			<?php echo 	Form::select('active', 
						Input::post('active', isset($plugin) ? $plugin->active : ''),
						array('No', 'Yes'),
						array('class' => 'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo 	Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?php echo 	Form::select('status', 
						Input::post('status', isset($plugin) ? $plugin->status : ''),
						$select_options['status'],
						array('class' => 'form-control')); ?>

		</div>
		<div class="form-group">
			<?php echo 	Form::label('Type', 'type', array('class'=>'control-label')); ?>
			<?php echo 	Form::select('type', 
						Input::post('type', isset($plugin) ? $plugin->type : ''),
						$select_options['type'],
						array('class' => 'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo 	Form::label('Version', 'version', array('class'=>'control-label')); ?>
			<?php echo 	Form::input('version', 
					   	Input::post('version', isset($plugin) ? $plugin->version : ''), 
						array('class' => 'form-control', 'placeholder'=>'Version')); ?>

		</div>
		<div class="actions">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Update plugin', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>