<?php echo Form::open(); ?>
	<div class="control-group">    
        <?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>
        <div class="input-group">
            <span class="input-group-addon" id="username_addon"><i id="username_spinner" class="fa fa-user"></i></span>
            <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Username', 'id'=>'username')); ?>        
            <span class="input-group-btn">
                <button id="submit" class="btn btn-warning" type="submit">
                    <i class="fa fa-save"></i> Update user
                </button>	
            </span>
        </div>
        <div id="username_message"></div>
    </div>
 	<?php if (Kora\Permissions::check_group_level(0)): ?>
    <?php Config::load('users'); $levels_array = Config::get('forms.select_options.levels'); ?>  
    <div class="form-group">
        <?php echo Form::label('Level', 'level', array('class'=>'control-label',)); ?>
        <?php echo Form::select('level', Input::post('level', isset($user) ? $user->level : ''), $levels_array, array('class' => 'form-control')); ?>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <?php echo Form::label('Group', 'group', array('class'=>'control-label', 'required' => 'required',)); ?>
        <?php echo Form::select('group', Input::post('group', isset($user) ? $user->group : ''), $groups_array, array('class' => 'form-control')); ?>
    </div>
    
    <div class="form-group">
        <?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
        <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'Email')); ?>
    </div>
    
	<?php echo render('admin/users/_profile'); ?>
    
<?php echo Form::close(); ?>