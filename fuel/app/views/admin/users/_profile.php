
<hr />
<button type="button" class="btn btn-block btn-primary" data-toggle="collapse" data-target="#collapse_profile" aria-expanded="false" aria-controls="collapse_profile">Profile details</button>
<hr />

<?php Config::load('users'); $profile_fields_config = Config::get('forms.profile_fields'); ?>
<?php //var_dump($profile_fields); ?>
<div class="collapse in" id="collapse_profile">
	<?php foreach ($profile_fields_config['profile'] as $key => $value) : ?>
    <div class="form-group">
        <?php echo Form::label($value, $key, array('class'=>'control-label')); ?>
        <?php echo Form::input('profile_fields[profile]['.$key.']', Input::post('profile_fields[profile]['.$key.']',  isset($profile_fields->profile[$key]) ? $profile_fields->profile[$key]: ''), array('class' => 'form-control')); ?>
    </div>
    <?php endforeach; ?>
    <hr />
    <?php $call_back = function($v){ return date($v, time()); }; ?>
    <?php foreach ($profile_fields_config['preferences'] as $key => $value) : ?>
    <div class="form-group">        
    	<?php 
		switch ($value['type']) :
			// Select option
			case 'select';
				if (in_array($key,array('date_format','date_format'))) :
					$data_value = array_map($call_back, $value['data']); 
				else:
					$data_value = $value['data'];
				endif;
				echo Form::label($value['title'], $key, array('class'=>'control-label'));			
				 
				echo Form::select('profile_fields[preferences]['.$key.']', 
					Input::post('profile_fields[preferences]['.$key.']',  
					isset($profile_fields->preferences[$key]) ? $profile_fields->preferences[$key]: ''), 
					$data_value, 
					array('class' => 'form-control'));			
			break;
			// Input option
			case 'input';
				echo Form::label($value['title'], $key, array('class'=>'control-label'));			
				
				echo Form::input('profile_fields[preferences]['.$key.']', 
					Input::post('profile_fields[preferences]['.$key.']',  
					isset($profile_fields->preferences[$key]) ? $profile_fields->preferences[$key]: ''), 
					array('class' => 'form-control'));			
			break;
			// Radio option
			case 'radio';
				echo Form::label($value['title'], $key, array('class'=>'control-label')).'<br />';			
							
				foreach ($value['data'] as $data_key =>  $data_val) :
					$input_data = Input::post('profile_fields[preferences]['.$key.']', isset($profile_fields->preferences[$key]) ? $profile_fields->preferences[$key]: '');
					$checked = ($input_data==$data_key) ? ' checked="checked"': '';	
					echo '<div class="col-sm-2"><label class="radio"><input type="radio" name="profile_fields[preferences]['.$key.']" value="'.$data_key.'"'.$checked.'><img src="'.Uri::base(false).'assets/img/avatars/'.$data_val.'.png" width="50%"></label></div>';
				endforeach;				
			break;
			
		endswitch;			
		?>        
    </div>
    <?php endforeach; ?>
</div>
