<?php echo Form::open(); ?>

    <div class="form-group">
        <?php echo Form::label('Current password', 'current_password', array('class'=>'control-label')); ?>
        <?php echo Form::input('current_password', '', array('class' => 'form-control', 'placeholder'=>'Current password', 'required'=>'required')); ?>
    </div>
    
    <div class="form-group">
        <?php echo Form::label('New password', 'new_password', array('class'=>'control-label')); ?>
        <?php echo Form::input('new_password', '', array('class' => 'form-control', 'placeholder'=>'New password', 'required'=>'required')); ?>
    </div>
    
    <div class="form-group">
    	<button type="submit" role="button" class="btn btn-warning">
        	<i class="fa fa-save"></i> Change password
        </button>
    </div>
    
<?php echo Form::close(); ?>
