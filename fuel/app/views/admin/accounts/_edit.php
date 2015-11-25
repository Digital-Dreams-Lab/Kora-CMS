<?php echo Form::open(); ?>
<div class="col-md-6">
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
    
    <div class="form-group">
        <?php echo Form::label('Group', 'group', array('class'=>'control-label', 'required' => 'required',)); ?>
        <?php echo Form::select('group', Input::post('group', isset($user) ? $user->group : ''), $groups_array, array('class' => 'form-control')); ?>

    </div>
    
    <div class="form-group">
        <?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
        <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'Email')); ?>
    </div>
</div>
    
<div class="col-md-6">
	<?php echo render('admin/users/_profile'); ?>
</div>
<?php echo Form::close(); ?>